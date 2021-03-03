<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdmissionStoreFormRequest;
use App\Models\AcademicClass;
use Illuminate\Http\Request;
use App\Models\Admission;
use App\Models\Group;
use App\Models\Guardian;
use App\Models\Role;
use App\Models\Section;
use App\Models\Session;
use App\Models\Student;
use App\Models\StudentAcademic;
use App\Models\User;
use App\Services\Utility;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdmissionController extends Controller
{
    public function index()
    {
        $data = [
            'page_title' => 'Admission List',
            'page_header' => 'Admission List',
            'admissions' => Admission::paginate(20),
        ];
    
        return view('dashboard.admission.index')->with(array_merge($this->data, $data));
    }

    public function create()
    {
        $data = [
            'page_title' => 'Acadmic Class',
            'page_header' => 'Admission List',
            'sessions' => Session::get(),
            'classes' => AcademicClass::get(),
            'groups' => Group::get(),
            'sections' => Section::get(),
            'guardians' => Guardian::orderBy('name', 'ASC')->get(),
        ];
    
        return view('dashboard.admission.create')->with(array_merge($this->data, $data));
    }

    public function store(AdmissionStoreFormRequest $request)
    {
        DB::beginTransaction();

        try {
            //store guardian
            if ($request->guardian_type != 'exists') {
                $guardian = new Guardian();
                $guardian->name = $request->get('guardian_name');
                $guardian->phone = $request->get('guardian_phone');
                $guardian->email = $request->get('guardian_email');
                $guardian->occupation = $request->get('guardian_occupation');
                $guardian->address = $request->get('guardian_address');
                $guardian->guardian_type = $request->get('guardian_type');

                if ($request->hasFile('guardian_photo')) {
                    $guardian->photo = Utility::file_upload($request, 'guardian_photo', 'guardians');
                }

                $guardian->save();
                $guardian_id = $guardian->id;
            } else {
                $guardian_id = $request->get('exists_guardian');
            }

            //get student ID generate
            if ($request->get('student_id_checked')) {
                $student_id = $request->get('student_id');
                $id_type = 'user-define';
            } else {
                $admissions = Student::where('id_type', 'system-define')->orderBy('id', 'desc')->get();
                $year = Carbon::now()->year;

                if ($admissions->isNotEmpty()) {
                    $last_student_id = $admissions->first()->student_id;

                    if (substr($last_student_id, 0, 4) == $year) {
                        $student_id = $last_student_id + 1;
                    } else {
                        $student_id = $year . '001';
                    }
                } else {
                    $student_id = $year . '001';
                }

                $id_type = 'system-define';
            }

            $flag = 0;

            while ($flag == 1) {
                $exists_admission = Student::where('student_id', $student_id)->first();
                if (!$exists_admission) {
                    $flag = 1;
                } else {
                    $student_id++;
                }
            }

            //store as user
            if ($request->get('email')) {
                $email_id = $request->get('email');
            } else {
                $email_id = $student_id.'@abschool.com';
            }

            $user = new User();
            $user->name = $request->get('firstname').' '.$request->get('lastname');            
            $user->email = $email_id;
            $user->username = $student_id;
            $user->password = bcrypt($student_id);
            $user->created_by = Auth::user()->id;
            $user->save();
            //attach student roll
            $user->attachRole(Role::where('name', 'student')->first());

            //store student 
            $student = new Student();
            $student->user_id = $user->id;
            $student->student_id = $student_id;
            $student->id_type = $id_type;
            $student->first_name = $request->get('firstname');
            $student->last_name = $request->get('lastname');
            $student->father_name = $request->get('father_name');
            $student->mother_name = $request->get('mother_name');
            $student->phone = $request->get('phone');
            $student->email = $request->get('email');
            $student->gender = $request->get('gender');
            $student->birthdate = database_formatted_date($request->get('birthdate'));
            $student->birth_id = $request->get('birth_id');
            $student->category = $request->get('category');
            $student->religion = $request->get('religion');
            $student->caste = $request->get('caste');
            $student->blood_group = $request->get('blood_group');
            $student->present_address = $request->get('present_address');
            $student->permanent_address = $request->get('permanent_address');
            $student->father_occupation = $request->get('father_occupation');
            $student->mother_occupation = $request->get('mother_occupation');
            $student->father_phone = $request->get('father_phone');
            $student->mother_phone = $request->get('mother_phone');

            if ($request->hasFile('student_photo')) {
                $student->photo = Utility::file_upload($request, 'student_photo', 'students');
            }

            if ($request->hasFile('father_photo')) {
                $student->father_photo = Utility::file_upload($request, 'father_photo', 'fathers');
            }

            if ($request->hasFile('mother_photo')) {
                $student->mother_photo = Utility::file_upload($request, 'mother_photo', 'mothers');
            }

            $student->guardian_id = $guardian_id;
            $student->relation = $request->get('guardian_relation');

            $student->save();

            //store admission information
            $admission = new Admission();
            $admission->student_id = $student->id;
            $admission->academic_class_id = $request->get('class');
            $admission->group_id = $request->get('group');
            $admission->section_id = $request->get('section');
            $admission->session_id = $request->get('session');
            $admission->admission_date = database_formatted_date($request->get('admission_date'));
            $admission->save();

            //store student academic information
            $student_academic = new StudentAcademic();
            $student_academic->student_id = $admission->student_id;
            
            if ($request->get('student_roll_checked')) {
                $student_academic->roll_no = $request->student_roll;
            }

            $student_academic->academic_class_id = $request->get('class');
            $student_academic->group_id = $request->get('group');
            $student_academic->section_id = $request->get('section');
            $student_academic->session_id = $request->get('session');
            $student_academic->save();

            DB::commit();

            return response()->json([
                'type' => 'success',
                'title' => 'Congratulation!',
                'message' => 'Student Admitted Successfully'
            ]);

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'type' => 'error',
                'title' => 'Failed!',
                'message' => 'Failed to Admission, Try again please!'
            ]);
        }        
    }
}
