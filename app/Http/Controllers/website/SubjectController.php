<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SubjectController extends Controller
{
    public function subjectDetails($subject_id){
        $subject_id=Crypt::decrypt($subject_id);
        $subject = AssignSubject::with('lesson','subjectAttachment')->where('id',$subject_id)->first();
        $lessons=$subject->lesson;
         
        return view('website.user.lesson', compact('lessons','subject'));
    }
}
