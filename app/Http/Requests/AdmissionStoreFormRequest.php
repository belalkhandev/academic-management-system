<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdmissionStoreFormRequest extends FormRequest
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
            'admission_date' => 'required',
            'session' => 'required',
            'class' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'birthdate' => 'required',
            'category' => 'required',
            'religion' => 'required',
            'father_name' => 'required',
            'father_phone' => 'required',
            'father_occupation' => 'required',
            'mother_name' => 'required',
            'mother_phone' => 'required',
            'mother_occupation' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'student_photo' => 'max:128|mimes:jpg,jpeg',
            'father_photo' => 'max:128|mimes:jpg,jpeg',
            'mather_photo' => 'max:128|mimes:jpg,jpeg',
        ];

        if ($this->request->get('student_id_checked')) {
            $rules['student_id'] = 'required|unique:admissions,student_id';
        }

        if ($this->request->get('student_roll_checked')) {
            $rules['roll_number'] = 'required';
        } 

        if ($this->request->get('guardian_type') == 'exists') {
            $rules['exists_guardian'] = 'required';
            $rules['exists_guardian_relation'] = 'required';
        } else{
            $rules['guardian_name'] = 'required';
            $rules['guardian_phone'] = 'required';
            $rules['guardian_email'] = 'required';
            $rules['guardian_relation'] = 'required';
            $rules['guardian_occupation'] = 'required';
            $rules['guardian_address'] = 'required';
            $rules['guardian_photo'] = 'max:128|mimes:jpg,jpeg';
        }

        return $rules;
    }
}
