<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ExamTerm;
use Illuminate\Http\Request;

class ExamTermController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:exam_terms,name',
            'marks' => 'required'
        ]);

        $term = new ExamTerm();
        $term->name = $request->get('name');
        $term->total_marks = $request->get('marks');

        if ($term->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Success',
                'message' => 'Add successfullfy',
                'redirect' => route('exam.settings'),
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed',
            'message' => 'Something went wrong',
        ]);
    }
}
