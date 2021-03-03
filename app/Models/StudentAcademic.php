<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAcademic extends Model
{
    public function academicClass()
    {
        return $this->belongsTo('App\Models\AcademicClass', 'academic_class_id');
    }
}
