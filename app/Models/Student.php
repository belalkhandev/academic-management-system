<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $appends = ['name'];

    public function getNameAttribute()
    {
        $name = $this->attributes['first_name'].' '.$this->attributes['last_name'];

        return $name;
    }

    public function studentAcademic()
    {
        return $this->hasMany('App\Models\StudentAcademic', 'student_id')->latest();
    }

    public function guardian()
    {
        return $this->belongsTo('App\Models\Guardian', 'guardian_id');
    }

}
