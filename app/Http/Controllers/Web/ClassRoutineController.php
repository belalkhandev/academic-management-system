<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRoutineStoreFormRequest;
use App\Models\AcademicClass;
use App\Models\ClassRoutine;
use App\Models\Day;
use App\Models\Group;
use App\Models\Section;
use App\Models\Session;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassRoutineController extends Controller
{
    public function index()
    {
        $data = [
            'page_title' => 'Class Routine',
            'page_header' => 'Class Routine',
            'days' => Day::orderByRaw("FIELD(name, ".implode(', ', array_map(function ($val)
                            {
                                return sprintf("'%s'", $val);
                            }, getDaysList())).") ASC")
                            ->get(),
            'session_list' => Session::get(),
            'classes' => AcademicClass::get(),
            'groups' => Group::get(),
            'sections' => Section::get(),
            'routines' => null
        ];
    
        return view('dashboard.class-routine.index')->with(array_merge($this->data, $data));
    }

    public function filterRoutine(Request $request)
    {
        $routines  = ClassRoutine::where('session_id', $request->get('session_id'))
                                    ->where('academic_class_id', $request->get('class_id'))
                                    ->orderBy('start_time', 'ASC')
                                    ->get();
        if ($request->get('group_id')) {
            //filter by group
        }

        if ($request->get('section_id')) {
            //filter by section
        }

        $data = [
            'page_title' => 'Class Routine',
            'page_header' => 'Class Routine',
            'days' => Day::orderByRaw("FIELD(name, ".implode(', ', array_map(function ($val)
                            {
                                return sprintf("'%s'", $val);
                            }, getDaysList())).") ASC")
                            ->get(),
            'session_list' => Session::get(),
            'classes' => AcademicClass::get(),
            'groups' => Group::get(),
            'sections' => Section::get(),
            'routines' => $routines,
            'request' => $request->all()
        ];
    
        return view('dashboard.class-routine.index')->with(array_merge($this->data, $data));
    }

    public function create()
    {
        $data = [
            'page_title' => 'Create Class Routine',
            'page_header' => 'Create Routine',
            'days' => Day::orderByRaw("FIELD(name, ".implode(', ', array_map(function ($val)
                        {
                            return sprintf("'%s'", $val);
                        }, getDaysList())).") ASC")
                        ->get(),
            'session_list' => Session::get(),
            'classes' => AcademicClass::get(),
            'groups' => Group::get(),
            'sections' => Section::get(),
            'teachers' => Teacher::get()
        ];

        return view('dashboard.class-routine.create')->with(array_merge($this->data, $data));
    }

    public function store(ClassRoutineStoreFormRequest $request)
    {
        //check if exist this class routine 

        //check if the time is assigned

        //store class routine
        $day = Day::find($request->get('day'))->name;
        $routine = new ClassRoutine();
        $routine->day_id = $request->get('day');
        $routine->session_id = $request->get('session');
        $routine->subject_id = $request->get('subject');
        $routine->teacher_id = $request->get('teacher');
        $routine->academic_class_id = $request->get('class');
        $routine->section_id = $request->get('section');
        $routine->group_id = $request->get('group');
        $routine->day = $day;
        $routine->start_time = database_formatted_time($request->get('start_time'));
        $routine->end_time = database_formatted_time($request->get('end_time'));
        $routine->status = $request->get('status');

        if ($routine->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Routine Created Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to create routine'
        ]);
    }

    public function edit($id)
    {
        $routine = ClassRoutine::findOrFail($id);
        $data = [
            'page_title' => 'Create Class Routine',
            'page_header' => 'Create Routine',
            'days' => Day::orderByRaw("FIELD(name, ".implode(', ', array_map(function ($val)
                        {
                            return sprintf("'%s'", $val);
                        }, getDaysList())).") ASC")
                        ->get(),
            'session_list' => Session::get(),
            'classes' => AcademicClass::get(),
            'groups' => Group::get(),
            'sections' => Section::get(),
            'teachers' => Teacher::get(),
            'routine' => $routine,
            'subjects' => Subject::where('academic_class_id', $routine->academic_class_id)->get()
        ];

        return view('dashboard.class-routine.edit')->with(array_merge($this->data, $data));
    }

    public function update(ClassRoutineStoreFormRequest $request, $id)
    {
        //check if exist this class routine 

        //check if the time is assigned

        //store class routine
        $day = Day::find($request->get('day'))->name;
        $routine = ClassRoutine::findOrFail($id);
        $routine->day_id = $request->get('day');
        $routine->session_id = $request->get('session');
        $routine->subject_id = $request->get('subject');
        $routine->teacher_id = $request->get('teacher');
        $routine->academic_class_id = $request->get('class');
        $routine->section_id = $request->get('section');
        $routine->group_id = $request->get('group');
        $routine->day = $day;
        $routine->start_time = database_formatted_time($request->get('start_time'));
        $routine->end_time = database_formatted_time($request->get('end_time'));
        $routine->status = $request->get('status');

        if ($routine->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Update!',
                'message' => 'Routine Update Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to update routine'
        ]);
    }

    public function destroy(ClassRoutine $routine, $id)
    {
        if (!Auth::user()->canDo(['manage_admin'])) {
            abort(401, 'Unauthorized Access.');
        }

        $routine = $routine->findOrFail($id);

        if ($routine->delete()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Routine Deleted Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Delete Routine'
        ]);
    }
}
