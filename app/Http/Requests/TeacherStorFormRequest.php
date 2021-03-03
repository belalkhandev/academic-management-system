<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherStorFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:users',
            'gender' => 'required',
            'marital_status' => 'required',
            'birthdate' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'teacher_photo' => 'max:128|mimes:jpg,jpeg',
            'qualification' => 'required',
            'department' => 'required',
            'designation' => 'required',
            'job_type' => 'required',
            'joining_date' => 'required',
            'attached_file' => 'max:5120|mimes:pdf',
        ];

        if ($this->request->get('teacher_id_checked')) {
            $rules['teacher_id'] = 'required|unique:teachers,teacher_id';
        }

        return $rules;
    }
}
