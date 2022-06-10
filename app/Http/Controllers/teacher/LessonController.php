<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(){
        $board_details = Board::where('is_activate', 1)->get();
        $all_lessons = Lesson::with(['assignClass', 'board', 'topics', 'subTopics', 'assignSubject'=>function($query){
                    $query->where('teacher_id',auth()->user()->id);
        }])->where('parent_id', null)->get();

        return view('teacher.lesson.index')->with(['boards' => $board_details, 'all_lessons' => $all_lessons]);
    }
}
