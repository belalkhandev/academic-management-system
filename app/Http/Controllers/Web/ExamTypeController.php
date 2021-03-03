<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\MarkScale;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    public function storeExamMark(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'mark' => 'required',
            'out_of' => 'required',
        ],[
            'mark.required' => 'Please enter the point or mark'
        ]);

        $mark = new MarkScale();
        $mark->name = $request->get('name');
        $mark->equal_one = $request->get('mark');
        $mark->out_of = $request->get('out_of');
        
        if ($mark->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Success',
                'message' => 'Added successfully',
                'redirect' => route('exam.settings'),
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed',
            'message' => 'Something went wrong',
        ]);


    }

    public function updateExamMark(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'mark' => 'required',
            'out_of' => 'required',
        ],[
            'mark.required' => 'Please enter the point or mark'
        ]);

        $mark = MarkScale::find($id);
        $mark->name = $request->get('name');
        $mark->equal_one = $request->get('mark');
        $mark->out_of = $request->get('out_of');
        
        if ($mark->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Updated',
                'message' => 'Updated successfully',
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
