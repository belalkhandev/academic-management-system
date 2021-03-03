<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    public function setNameAttribute($value)
    {
        $this->attributes['name']=  ucfirst($value);
    }
}
