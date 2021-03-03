<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassRoutineUpdateFormRequest extends FormRequest
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
        return [
            'session' => 'required',
            'class' => 'required',
            'day' => 'required',
            'subject' => 'required',
            'teacher' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
        ];
    }
}
