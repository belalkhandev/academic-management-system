<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherStorFormRequest;
use App\Models\Department;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\TeacherAcademic;
use App\Models\User;
use App\Services\Utility;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function index()
    {
        $data = [
            'page_title' => 'Teacher',
            'page_header' => 'Teacher List',
            'teachers' => Teacher::get(),
        ];

        return view('dashboard.teacher.index')->with(array_merge($this->data, $data));
    }

    public function create()
    {
        $data = [
            'page_title' => 'Teacher Create',
            'page_header' => 'Teacher Create',
            'departments' => Department::orderBy('name', 'ASC')->get()
        ];

        return view('dashboard.teacher.create')->with(array_merge($this->data, $data));
    }

    public function store(TeacherStorFormRequest $request)
    {
        try{
            DB::beginTransaction();

            //user add
            $user = new User();
            $user->name = $request->get('firstname').' '.$request->get('lastname');            
            $user->email = $request->get('email');
            $user->username = $request->get('email');
            $user->password = bcrypt('123456');
            $user->created_by = Auth::user()->id;
            $user->save();
            //attach student roll
            $user->attachRole(Role::where('name', 'teacher')->first());

            //get student ID generate
            //get student ID generate
            if ($request->get('teacher_id_checked')) {
                $teacher_id = $request->get('teacher_id');
                $id_type = 'user-define';
            } else {
                $teachers = Teacher::where('id_type', 'system-define')->orderBy('id', 'desc')->get();
                $year = Carbon::now()->year;

                if ($teachers->isNotEmpty()) {
                    $last_teacher_id = $teachers->first()->teacher_id;

                    if (substr($last_teacher_id, 0, 4) == $year) {
                        $teacher_id = $last_teacher_id + 1;
                    } else {
                        $teacher_id = $year . '01';
                    }
                } else {
                    $teacher_id = $year . '01';
                }

                $id_type = 'system-define';
            }

            $flag = 0;

            while ($flag == 1) {
                $exists_teacher = Teacher::where('teacher_id', $teacher_id)->first();
                if (!$exists_teacher) {
                    $flag = 1;
                } else {
                    $teacher_id++;
                }
            }

            //teacher add
            $teacher = new Teacher();
            $teacher->user_id = $user->id;
            $teacher->teacher_id = $teacher_id;
            $teacher->id_type = $id_type;
            $teacher->first_name = $request->get('firstname');
            $teacher->last_name = $request->get('lastname');
            $teacher->father_name = $request->get('father_name');
            $teacher->mother_name = $request->get('mother_name');
            $teacher->gender = $request->get('gender');
            $teacher->email = $request->get('email');
            $teacher->phone = $request->get('phone');
            $teacher->emergency_phone = $request->get('emergency_contact');
            $teacher->birthdate = database_formatted_date($request->get('birthdate'));
            $teacher->blood_group = $request->get('blood_group');
            $teacher->marital_status = $request->get('marital_status');
            $teacher->present_address = $request->get('present_address');
            $teacher->permanent_address = $request->get('permanent_address');
            $teacher->qulification = $request->get('qualification');

            //upload teacher photo
            if ($request->hasFile('teacher_photo')) {
                $teacher->photo = Utility::file_upload($request, 'teacher_photo', 'teachers');
            }

            //upload teacher resume
            if ($request->hasFile('attached_file')) {
                $teacher->resume = Utility::file_upload($request, 'attached_file', 'resumes');
            }

            $teacher->save();

            //teacher academic
            $teacher_academic = new TeacherAcademic();
            $teacher_academic->teacher_id = $teacher->id;
            $teacher_academic->department_id = $request->get('department');
            $teacher_academic->designation = $request->get('designation');
            $teacher_academic->joining_date = database_formatted_date($request->get('joining_date'));
            $teacher_academic->job_type = $request->get('job_type');
            $teacher_academic->save();

            DB::commit();
            return response()->json([
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Teacher Saved Successfully'
            ]);
        }
        catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'type' => 'error',
                'title' => 'Failed!',
                'message' => 'Failed to add Teacher, Try again please!'
            ]);

        }
        
    }

//     teacher_id
// first_name
// last_name
// father_name
// mother_name
// gender
// email
// phone
// emergency_phone
// birthdate
// blood_group
// marital_status
// present_address
// permanent_address
// qulification
// details
// photo
// resume
    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {
        
    }
}
