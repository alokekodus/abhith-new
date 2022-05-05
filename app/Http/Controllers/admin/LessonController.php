<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Lesson;
use Str;
class LessonController extends Controller
{
    public function index(){
        $board_details = Board::where('is_activate', 1)->get();
        return view('admin.course-management.lesson.index')->with(['boards' => $board_details]);
    }
    public function store(Request $request){
        try {
             
             
                $new_img_name = date('d-m-Y-H-i-s') . '_' . $request->file('lesson_image')->getClientOriginalName();
                $request->file('lessonImage')->move(public_path('/files/lesson/'), $new_img_name);
                $imgFile = 'files/lesson/' . $new_img_name;
            
            
                $new_video_name = date('d-m-Y-H-i-s') . '_' . $request->file('lesson_video')->getClientOriginalName();
                $request->file('lessonVideo')->move(public_path('/files/lesson/'), $new_video_name);
                $videoFile = 'files/lesson/' . $new_video_name;
           
                $data=[
                    'name'=>$request->name,
                    'slug'=>Str::slug($request->name),
                    'board_id'=>$request->assignedBoard,
                    'assign_class_id'=>$request->assign_class_id,
                    'assign_subject_id' => $request->assign_subject_id,
                    'image_url'=>$imgFile,
                    'video_url'=>$videoFile,
                    'content'=>$request->content,
                ];
                $lesson=Lesson::create($data);
                return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
