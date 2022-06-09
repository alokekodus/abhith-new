<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\AssignClass;
use App\Models\AssignSubject;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CourseController extends Controller
{
    public function index(){
        $class_details =  AssignClass::with('boards')->where('is_activate', 1)->get();
        $assign_subject = AssignSubject::with('assignClass', 'boards')->where('teacher_id',auth()->user()->id)->where('is_activate', 1)->orderBy('created_at', 'DESC')->get();
        return view('teacher.course.index')->with(['subjects' => $assign_subject, 'classes' => $class_details]);
    }
    public function create(){
        $boards = Board::where('is_activate', 1)->get();
        return view('teacher.course.create',compact('boards'));
    }
    public function view($subject_id){
        try {
            $subject_id=Crypt::decrypt($subject_id);
            $subject=AssignSubject::with('subjectAttachment')->where('id',$subject_id)->first();
        return view('teacher.course.view',compact('subject'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
