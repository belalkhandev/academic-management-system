<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\DayStoreFormRequest;
use App\Http\Requests\DayUpdateFormRequest;
use App\Models\Day;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DayController extends Controller
{
    public function index()
    {
        $data = [
            'page_title' => 'Department',
            'page_header' => 'Department List',
            'days' => Day::orderByRaw("FIELD(name, ".implode(', ', array_map(function ($val)
                            {
                                return sprintf("'%s'", $val);
                            }, getDaysList())).") ASC")
                            ->get(),
        ];

        return view('dashboard.day.index')->with(array_merge($this->data, $data));
    }

    public function create()
    {
        $data = [
            'page_title' => 'Create Day',
            'page_header' => 'Create Day'
        ];

        return view('dashboard.day.create')->with(array_merge($this->data, $data));
    }

    public function store(DayStoreFormRequest $request)
    {
        if (!in_array(ucfirst($request->get('name')), getDaysList())) {
            return response()->json([
                'type' => 'error',
                'title' => 'Warning!',
                'message' => 'Day name is wrong'
            ]);
        }

        $day = new Day();
        $day->name = $request->get('name');
        $day->status = $request->get('status');
        
        if ($day->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Day Stored Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Create Day'
        ]);
    }

    public function edit(Day $day, $id)
    {
        $data = [
            'page_title' => 'Update day',
            'page_header' => 'Update day',
            'day' => $day->findOrFail($id)
        ];

        return view('dashboard.day.edit')->with(array_merge($this->data, $data));
    }

    public function update(DayUpdateFormRequest $request, $id)
    {
        if (!in_array(ucfirst($request->get('name')), getDaysList())) {
            return response()->json([
                'type' => 'error',
                'title' => 'Warning!',
                'message' => 'Day name is wrong'
            ]);
        }

        $day = Day::findOrFail($id);
        $day->name = $request->get('name');
        $day->status = $request->get('status');
        
        if ($day->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Updated!',
                'message' => 'Day Update Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Update Day'
        ]);
    }

    public function destroy(Day $day, $id)
    {
        if (!Auth::user()->canDo(['manage_admin'])) {
            abort(401, 'Unauthorized Access.');
        }

        $day = $day->findOrFail($id);

        if ($day->delete()) {
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
