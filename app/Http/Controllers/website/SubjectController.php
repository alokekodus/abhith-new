<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\Lesson;
use App\Models\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SubjectController extends Controller
{
    public function subjectDetails($subject_id)
    {
        $subject_id = Crypt::decrypt($subject_id);
        $subject = AssignSubject::with('lesson', 'subjectAttachment')->where('id', $subject_id)->first();
        $lessons = $subject->lesson;

        return view('website.user.lesson', compact('lessons', 'subject'));
    }
    public function subjectMCQ($subject_id)
    {
        try {
            $subject_id = Crypt::decrypt($subject_id);
            $subject = AssignSubject::with('lesson', 'subjectAttachment', 'sets')->where('id', $subject_id)->first();
            return view('website.my_account.mcq', compact('subject'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function mcqStart($set_id){
        try {
            $set=Set::with('board','assignClass','assignSubject','question')->where('id',decrypt($set_id))->first();
           return view('website.my_account.mcq_start',compact('set'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
