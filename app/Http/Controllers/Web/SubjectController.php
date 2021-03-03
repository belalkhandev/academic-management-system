<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectStoreFormRequest;
use App\Http\Requests\SubjectUpdateFormRequest;
use App\Models\AcademicClass;
use App\Models\Group;
use App\Models\Subject;
use App\Services\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index()
    {
        $data = [
            'page_title' => 'Subject List',
            'page_header' => 'Subject List',
            'subjects' => Subject::get(),
            'classes' => AcademicClass::get()
        ];

        return view('dashboard.subject.index')->with(array_merge($this->data, $data));
    }

    public function create()
    {
        $data = [
            'page_title' => 'Subject Create',
            'page_header' => 'Subject Create',
            'classes' => AcademicClass::get(),
            'groups' => Group::get(),
        ];

        return view('dashboard.subject.create')->with(array_merge($this->data, $data));
    }

    public function store(SubjectStoreFormRequest $request)
    {
        //check existing subject
        $is_exists = Subject::where('name', $request->get('name'))->where('academic_class_id', $request->get('class'))->first();
        
        if ($request->get('code')) {
            $is_exists = Subject::where('code', $request->get('code'))->first();
        }

        if ($is_exists) {
            return response()->json([
                'type' => 'warning',
                'title' => 'Already Exists!',
                'message' => 'Subject already exists'
            ]);
        }
        $subject = new Subject();
        $subject->academic_class_id = $request->get('class');   
        $subject->group_id = $request->get('group');   
        $subject->name = $request->get('name');   
        $subject->code = $request->get('code');   
        $subject->status = $request->get('status');
        $path = null;

        if ($request->hasFile('cover_photo')) {
            $path = Utility::file_upload($request, 'cover_photo', 'subjects');
        }

        $subject->photo = $path;
        
        if ($subject->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Successfully Store Subject'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Store Subject'
        ]);
    }

    public function edit($id)
    {
        $data = [
            'page_title' => 'Subject Update',
            'page_header' => 'Subject Update',
            'classes' => AcademicClass::get(),
            'groups' => Group::get(),
            'subject' => Subject::findOrFail($id)
        ];

        return view('dashboard.subject.edit')->with(array_merge($this->data, $data));
    }

    public function update(SubjectUpdateFormRequest $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->academic_class_id = $request->get('class');
        $subject->group_id = $request->get('group');
        $subject->name = $request->get('name');
        $subject->code = $request->get('code');
        $subject->status = $request->get('status');

        if ($request->hasFile('cover_photo')) {
            if ($subject->photo) {
                unlink($subject->photo);
            }

            $path = Utility::file_upload($request, 'cover_photo', 'subjects');
            $subject->photo = $path;
        }

        if ($subject->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Successfully Update Subject'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Update Subject'
        ]);
    }
    

    public function destroy(Subject $subject, $id)
    {
        if (!Auth::user()->canDo(['manage_admin'])) {
            abort(401, 'Unauthorized Access.');
        }

        $subject = $subject->findOrFail($id);

        if ($subject->photo) {
            unlink($subject->photo);
        }

        if ($subject->delete()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Subject Deleted Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Delete Subject'
        ]);
    }
}
