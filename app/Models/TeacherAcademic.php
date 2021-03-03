<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherAcademic extends Model
{
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }
}
