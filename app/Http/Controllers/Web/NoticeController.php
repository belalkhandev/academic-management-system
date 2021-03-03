<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoticeStoreFormRequest;
use App\Http\Requests\NoticeUpdateFormRequest;
use App\Models\Notice;
use App\Services\Utility;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $data = [
            'page_title' => 'Notice',
            'page_header' => 'Notice List',
            'notices' => Notice::paginate(20),
        ];

        return view('dashboard.notice.index')->with(array_merge($this->data, $data));
    }

    public function create()
    {
        $data = [
            'page_title' => 'Create Notice',
            'page_header' => 'Create Notice'
        ];

        return view('dashboard.notice.create')->with(array_merge($this->data, $data));
    }

    public function store(NoticeStoreFormRequest $request)
    {
        $path = null;

        if ($request->hasFile('notice_file')) {
            $path = Utility::file_upload($request, 'notice_file', 'notices');
        }

        $notice = new Notice();
        $notice->title = $request->get('title');
        $notice->content = $request->get('notice_content');
        $notice->attached_file = $path;
        $notice->publish_date = database_formatted_date($request->get('publish_date'));
        $notice->status = $request->get('status');

        if ($notice->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Notice Stored Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Store Notice'
        ]);
    }

    public function show(Notice $notice, $id)
    {
        $data = [
            'page_title' => 'Details of Notice',
            'page_header' => 'Details of Notice',
            'notice' => $notice->findOrFail($id)
        ];

        return view('dashboard.notice.show')->with(array_merge($this->data, $data)); 
    }

    public function edit(Notice $notice, $id)
    {
        $data = [
            'page_title' => 'Update Notice',
            'page_header' => 'Update Notice',
            'notice' => $notice->findOrFail($id)
        ];

        return view('dashboard.notice.edit')->with(array_merge($this->data, $data));
    }

    public function update(NoticeUpdateFormRequest $request, $id)
    {
       

        $notice = Notice::findOrFail($id);
        $notice->title = $request->get('title');
        $notice->content = $request->get('notice_content');

        if ($request->hasFile('notice_file')) {
            if ($notice->attached_file) {
                unlink($notice->attached_file);
            }

            $notice->attached_file = Utility::file_upload($request, 'notice_file', 'notices');
        }

        $notice->publish_date = database_formatted_date($request->get('publish_date'));
        $notice->status = $request->get('status');

        if ($notice->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Updated!',
                'message' => 'Notice Update Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Update Notice'
        ]);
    }

    public function destroy(Notice $notice, $id)
    {
        $notice = $notice->findOrFail($id);

        //file delete
        if ($notice->attached_file) {
            unlink($notice->attached_file);
        }

        if ($notice->delete()) {

            return response()->json([
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Notice Deleted Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Delete Notice'
        ]);
    }
}
