<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    public $appends = ['notice_file_type'];

    public function getNoticeFileTypeAttribute()
    {
        $file_type = '';

        if ($this->attached_file) {
            $file = (string) $this->attached_file;
            $div = explode('.', $file);
            $ext = strtolower(end($div));

            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                $file_type = 'image';
            } else if ($ext == 'pdf') {
                $file_type = 'pdf';
            }

        }

        return $file_type;
    }
}
