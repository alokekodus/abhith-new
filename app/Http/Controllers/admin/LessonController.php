<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Lesson;
use Illuminate\Support\Facades\Validator;
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
           
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                
            ]);
           
            if($validator->fails()){
                return response()->json(['message' => 'Whoop! Something went wrong.', 'error' => $validator->errors()]);
            }else{
            $document = $request->file('lessonImage');
            if (isset($document) && !empty($document)) {
                $new_name = date('d-m-Y-H-i-s') . '_' . $document->getClientOriginalName();
                $document->move(public_path('/files/course/subject/lesson'), $new_name);
                $file = '/files/course/subject/lesson/' . $new_name;
            }else{
                $file=null;
                
            }
            $lessonVideo=$request->file('lessonVideo');
            if (isset($document) && !empty($lessonVideo)) {
                $new_name = date('d-m-Y-H-i-s') . '_' . $lessonVideo->getClientOriginalName();
                $lessonVideo->move(public_path('/files/course/subject/lesson'), $new_name);
                $video_url = '/files/course/subject/lesson/' . $new_name;
            }else{
                $video_url=null;
                
            }
          
            if($request->has('parent_id')){
                $lesson=Lesson::find($request->parent_id);
                $data=[
                    'name'=>ucfirst($request->name),
                    'slug'=>Str::slug($request->name),
                    'parent_id'=>$request->parent_id,
                    'board_id'=>$lesson->board_id,
                    'assign_class_id'=>$lesson->assign_class_id,
                    'assign_subject_id' => $lesson->assign_subject_id,
                    'image_url'=> $file,
                    'video_url'=>$video_url,
                    'content'=>$request->Content,
                ];
            }else{
                $data=[
                    'name'=>ucfirst($request->name),
                    'slug'=>Str::slug($request->name),
                    'board_id'=>$request->assignedBoard,
                    'assign_class_id'=>$request->assign_class_id,
                    'assign_subject_id' => $request->assign_subject_id,
                    'content'=>$request->Content,
                    'image_url'=> $file,
                    'video_url'=>$video_url,
                ];
            }

                $create=Lesson::create($data);
                if($request->parent_is!=null){
                    return redirect()->back()->with('success','topic added successfully.');   
                }
                if($create){
                    return response()->json(['message' => 'Lesson Added Successfully', 'status' => 1]);
                }else{
                    return response()->json(['message' => 'Whoops! Something went wrong. Failed to add Lesson.', 'status' => 2]);
                }
            }
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
