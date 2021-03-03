<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class AjaxFindController extends Controller
{
    //get subject by class & groups | section | null
    public function getSubjects(Request $request)
    {
        $subjects = Subject::where('academic_class_id', $request->get('class_id'))->orderBy('name', 'ASC')->get();

        if ($request->get('group_id')) {
            $subjects = $subjects->where('group_id', $request->get('group_id'));
        }

        return $subjects;
    }
}
