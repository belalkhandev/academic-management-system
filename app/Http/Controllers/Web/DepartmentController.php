<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentStoreFormRequest;
use App\Http\Requests\DepartmentUpdateFormRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index()
    {
        $data = [
            'page_title' => 'Department',
            'page_header' => 'Department List',
            'departments' => Department::get(),
        ];

        return view('dashboard.department.index')->with(array_merge($this->data, $data));
    }

    public function create()
    {
        $data = [
            'page_title' => 'Create Department',
            'page_header' => 'Create Department'
        ];

        return view('dashboard.department.create')->with(array_merge($this->data, $data));
    }

    public function store(DepartmentStoreFormRequest $request)
    {
        $department = new Department();
        $department->name = $request->get('name');
        $department->department_details = $request->get('description');
        $department->status = $request->get('status');
        
        if ($department->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Department Created Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Create Deapartment'
        ]);
    }

    public function edit(Department $department, $id)
    {
        $data = [
            'page_title' => 'Update Department',
            'page_header' => 'Update Department',
            'department' => $department->findOrFail($id)
        ];

        return view('dashboard.department.edit')->with(array_merge($this->data, $data));
    }

    public function update(DepartmentUpdateFormRequest $request, $id)
    {
        $department = Department::findOrFail($id);
        $department->name = $request->get('name');
        $department->department_details = $request->get('description');
        $department->status = $request->get('status');

        if ($department->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Updated!',
                'message' => 'Department Updated Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Update Department'
        ]);
    }

    public function destroy(Department $department, $id)
    {
        if (!Auth::user()->canDo(['manage_admin'])) {
            abort(401, 'Unauthorized Access.');
        }

        $department = $department->findOrFail($id);

        if ($department->delete()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Department Deleted Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Delete Department'
        ]);
    }
}
