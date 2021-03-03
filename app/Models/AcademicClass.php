<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicClass extends Model
{
    public function subjects()
    {
        return $this->hasMany('App\Models\Subject', 'academic_class_id');
    }
}
