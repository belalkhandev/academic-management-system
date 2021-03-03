<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function academicClass()
    {
        return $this->belongsTo('App\Models\AcademicClass', 'academic_class_id');
    }

    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

    public function session()
    {
        return $this->belongsTo('App\Models\Session', 'session_id');
    }
}
