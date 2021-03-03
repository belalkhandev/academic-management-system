<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    public $appends = ['name_phone'];

    public function getNamePhoneAttribute()
    {
        return $this->attributes['name'].' ('.$this->attributes['phone'].')';
    }
}
