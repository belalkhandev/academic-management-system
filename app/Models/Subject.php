<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function academicClass()
    {
        return $this->belongsTo('App\Models\AcademicClass', 'academic_class_id');
    }

    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id');
    }
}
