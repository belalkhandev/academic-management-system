<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionStoreFormRequest;
use App\Http\Requests\SectionUpdateFormRequest;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $data = [
            'page_title' => 'Acadmic Section',
            'page_header' => 'Section List',
            'sections' => Section::get(),
        ];

        return view('dashboard.section.index')->with(array_merge($this->data, $data));
    }

    public function create()
    {
        $data = [
            'page_title' => 'Create Acadmic Section',
            'page_header' => 'Create Section'
        ];

        return view('dashboard.section.create')->with(array_merge($this->data, $data));
    }

    public function store(SectionStoreFormRequest $request)
    {
        $section = new Section();
        $section->name = $request->get('name');
        $section->nick_name = $request->get('nick_name');
        $section->status = $request->get('status');

        if ($section->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Section Stored Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Store Section'
        ]);
    }

    public function edit(Section $section, $id)
    {
        $data = [
            'page_title' => 'Update Acadmic Class',
            'page_header' => 'Update Class',
            'section' => $section->findOrFail($id)
        ];

        return view('dashboard.section.edit')->with(array_merge($this->data, $data));
    }

    public function update(SectionUpdateFormRequest $request, $id)
    {
        $section = Section::findOrFail($id);
        $section->name = $request->get('name');
        $section->nick_name = $request->get('nick_name');
        $section->status = $request->get('status');

        if ($section->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Updated!',
                'message' => 'Section Updated Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Update Section'
        ]);
    }

    public function destroy(Section $section, $id)
    {
        $section = $section->findOrFail($id);

        if ($section->delete()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Section Deleted Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Delete Section'
        ]);
    }
}
