<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoutine extends Model
{
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }
}
