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
        $lessons=Lesson::where('parent_id',null)->get();
        return view('admin.course-management.lesson.index')->with(['boards' => $board_details,'lessons'=>$lessons]);
    }
    public function store(Request $request){
        try {
            if($request->has('parent_id')){
                $lesson=Lesson::find($request->parent_id);
                $data=[
                    'name'=>ucfirst($request->name),
                    'slug'=>Str::slug($request->name),
                    'parent_id'=>$request->parent_id,
                    'board_id'=>$lesson->board_id,
                    'assign_class_id'=>$lesson->assign_class_id,
                    'assign_subject_id' => $lesson->assign_subject_id,
                    'content'=>$request->content,
                ];
            }else{
                $data=[
                    'name'=>ucfirst($request->name),
                    'slug'=>Str::slug($request->name),
                    'board_id'=>$request->assignedBoard,
                    'assign_class_id'=>$request->assign_class_id,
                    'assign_subject_id' => $request->assign_subject_id,
                    'content'=>$request->content,
                ];
            }

                $lesson=Lesson::create($data);
                return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function storeFile(Request $request){
         return response()->json($request->all());
        $new_img_name = date('d-m-Y-H-i-s') . '_' . $request->file('lesson_image')->getClientOriginalName();
        $request->file('lessonImage')->move(public_path('/files/lesson/'), $new_img_name);
        $imgFile = 'files/lesson/' . $new_img_name;
        return $imgFile;
    }
    public function topicCreate($slug){
        $lesson=Lesson::where('slug',$slug)->first();
        return view('admin.course-management.lesson.topic.create',compact('lesson'));
    }
}
