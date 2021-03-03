<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public $appends = ['name'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function teacherAcademic()
    {
        return $this->hasOne('App\Models\TeacherAcademic', 'teacher_id')->orderBy('id', 'DESC');
    }

    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
}
