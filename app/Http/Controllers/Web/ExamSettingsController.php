<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ExamTerm;
use App\Models\MarkScale;
use Illuminate\Http\Request;

class ExamSettingsController extends Controller
{
    public function index()
    {
        $data = [
            'page_title' => 'Exam Settings',
            'page_header' => 'Exam Settings',
            'exam_mark' => MarkScale::first(),
            'terms' => ExamTerm::get(),
        ];

        return view('dashboard.exam.settings')->with(array_merge($this->data, $data));
    }
}
