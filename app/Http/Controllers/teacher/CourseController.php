<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){
        return view('teacher.course.index');
    }
    public function create(){
        $boards = Board::where('is_activate', 1)->get();
        return view('teacher.course.create',compact('boards'));
    }
}
