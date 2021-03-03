<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupStoreFormRequest;
use App\Http\Requests\GroupUpdateFormRequest;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $data = [
            'page_title' => 'Acadmic Group',
            'page_header' => 'Group List',
            'groups' => Group::get(),
        ];

        return view('dashboard.group.index')->with(array_merge($this->data, $data));
    }

    public function create()
    {
        $data = [
            'page_title' => 'Create Acadmic Group',
            'page_header' => 'Create Group'
        ];

        return view('dashboard.group.create')->with(array_merge($this->data, $data));
    }

    public function store(GroupStoreFormRequest $request)
    {
        $group = new Group();
        $group->name = $request->get('name');
        $group->status = $request->get('status');
        
        if ($group->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Group Stored Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Store Group'
        ]);
    }

    public function edit(Group $group, $id)
    {
        $data = [
            'page_title' => 'Update Acadmic Class',
            'page_header' => 'Update Class',
            'group' => $group->findOrFail($id)
        ];

        return view('dashboard.group.edit')->with(array_merge($this->data, $data));
    }

    public function update(GroupUpdateFormRequest $request, $id)
    {
        $group = Group::findOrFail($id);
        $group->name = $request->get('name');
        $group->status = $request->get('status');

        if ($group->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Updated!',
                'message' => 'Group Updated Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Update Group'
        ]);
    }

    public function destroy(Group $group, $id)
    {
        $group = $group->findOrFail($id);

        if ($group->delete()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Group Deleted Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Delete Group'
        ]);
    }
}
