<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Jobs\ConvertVideoForResolution;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Lesson;
use App\Models\LessonAttachment;
Use App\Traits\LessonAttachmentTrait;
use Illuminate\Support\Facades\Storage;
use Str;

class LessonController extends Controller
{
    public function index()
    {

        $board_details = Board::where('is_activate', 1)->get();
        $all_lessons = Lesson::with('assignClass', 'board', 'topics', 'subTopics', 'assignSubject')->where('parent_id', null)->get();

        return view('admin.course-management.lesson.index')->with(['boards' => $board_details, 'all_lessons' => $all_lessons]);
    }
    public function create(){
        $board_details = Board::where('is_activate', 1)->get();
        return view('admin.course-management.lesson.create')->with(['boards' => $board_details]);
    }
    public function store(Request $request)
    {
        try {
          
            $type = $this->findFormType($request);
            
            //validate all request according to it's type
            $validator = Validator::make($request->all(), Lesson::getRules($type), Lesson::getRuleMessages($type));
          
            if ($validator->fails()) {
                return response()->json(['message' => 'Whoop! Something went wrong.', 'error' => $validator->errors()]);
            } else {
              
                $file = null;
                $video_url = null;
                $document = $request->file('image_url');
                $lessonVideo = $request->file('video_url');
               
              
                if (!empty($document)) {
                    $image_path=LessonAttachmentTrait::uploadAttachment($document,"image"); //lesson image store

                }
                if (!empty($lessonVideo)) {

                    $video_path=LessonAttachmentTrait::uploadAttachment($lessonVideo, "video"); //lesson file store

                }
                if ($type =="create-lesson" || $type == "update-lesson") {
                 
                    $data = [
                        'name' => ucfirst($request->name),
                        'slug' => Str::slug($request->name),
                        'board_id' => $request->board_id,
                        'assign_class_id' => $request->assign_class_id,
                        'assign_subject_id' => $request->assign_subject_id,
                        'content' => $request->content,
                        'image_url' => $image_path,
                        'video_url' => $video_path,
                    ];

                    $lesson = Lesson::create($data);
                    
                   $path= $video_path;
                  
                    
                    $data_attachment = [
                        'lesson_id' =>  $lesson->id,
                        'disk'          => 'public',
                        'original_name' => $request->video_url->getClientOriginalName(),
                        'path'          => $path,
                        'type'          =>2,
                    ];
                    
                     $lesson_attachment=LessonAttachment::create($data_attachment);
                    // $lesson_attachment=LessonAttachment::create($data_attachment);
                    if($request->has('resizes')){
                        foreach($request->resizes as $key=>$resize){
                            if($resize==480){
                                $x_dime=640;
                                $y_dime =480;  
                            }
                            if($resize==720){
                                $x_dime=1280;
                                $y_dime =720;  
                            }
                            if($resize==1080){
                                $x_dime=1920;
                                $y_dime =1080;  
                            }
                            $this->dispatch(new ConvertVideoForResolution($lesson_attachment,$x_dime,$y_dime));
                        }

                    }
                     
                    // $this->dispatch(new ConvertVideoForStreaming($lesson_attachment));
                    return response()->json(['message' => 'Lesson Added Successfully','status' => 1]);
                }
                if ($type == "create-topic" || $type = "create-sub-topic") {

                    $lesson = Lesson::find($request->parent_id);
                    $data = [
                        'name' => ucfirst($request->name),
                        'slug' => Str::slug($request->name),
                        'parent_id' => $request->parent_id,
                        'parent_lesson_id' => $request->parent_lesson_id,
                        'board_id' => $lesson->board_id,
                        'assign_class_id' => $lesson->assign_class_id,
                        'assign_subject_id' => $lesson->assign_subject_id,
                        'image_url' => $file,
                        'video_url' => $video_url,
                        'content' => $request->content,
                    ];
                }
                if ($type == "create-lesson" || $type == "create-topic" || $type == "create-sub-topic") {

                    $create = Lesson::create($data);
                }
                if ($type == "update-lesson") {
                    $lesson = Lesson::find($request->lesson_id);

                    $create = $lesson->update($data);
                }
                $this->lessonFunctionResponse($type);
            }
        } catch (\Throwable $th) {
              dd($th);
            // return response()->json(['message' => 'Whoops! Something went wrong. Failed to add Lesson.', 'status' => 2]);
        }
    }
    public function storeFile(Request $request)
    {
        return response()->json($request->all());
        $new_img_name = date('d-m-Y-H-i-s') . '_' . $request->file('lesson_image')->getClientOriginalName();
        $request->file('lessonImage')->move(public_path('/files/lesson/'), $new_img_name);
        $imgFile = 'files/lesson/' . $new_img_name;
        return $imgFile;
    }
    public function topicCreate($slug)
    {
        $lesson = Lesson::where('slug', $slug)->first();
        return view('admin.course-management.lesson.topic.create', compact('lesson'));
    }
    public function subTopicCreate($lesson_slug, $topic_slug)
    {
        try {

            $lesson = Lesson::where('slug', $lesson_slug)->first();
            $topic = Lesson::where('slug', $topic_slug)->first();

            return view('admin.course-management.lesson.sub-topic.create', compact('lesson', 'topic'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function topicView($slug)
    {
        try {
            $lesson = Lesson::where('slug', $slug)->first();

            return view('admin.course-management.lesson.view', compact('lesson'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function edit($lesson_slug)
    {
        try {

            $lesson_edit_status = true;
            $board_details = Board::where('is_activate', 1)->get();
            $lesson = Lesson::with('boards', 'topics', 'subTopics')->where('slug', $lesson_slug)->first();
            return view('admin.course-management.lesson.edit')->with(['boards' => $board_details, 'lesson' => $lesson, 'lesson_edit_status' => $lesson_edit_status]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function lessonFunctionResponse($type)
    {
        if ($type == "create-lesson") {
            return response()->json(['message' => 'Lesson Added Successfully', 'status' => 1]);
        } elseif ($type == "create-topic") {
            return response()->json(['message' => 'Topic Added Successfully', 'status' => 1]);
        } elseif ($type == "create-sub-topic") {
            return response()->json(['message' => 'Sub Topic Added Successfully', 'status' => 1]);
        } elseif ($type == "update-lesson") {
            return response()->json(['message' => 'Lesson Update Successfully', 'status' => 1]);
        } else {
            return response()->json(['message' => 'Whoops! Something went wrong. Failed to add Lesson.', 'status' => 2]);
        }
    }

    public function findFormType(Request $request)
    {
        if ($request->assign_class_id != null) {
            return "create-lesson";
        }

        if ($request->parent_id != null &&  $request->parent_lesson_id == null) {
            return "create-topic";
        }
        if ($request->parent_id != null &&  $request->parent_lesson_id != null) {
            return "create-sub-topic";
        }
        if ($request->lesson_id != null && $request->parent_id == null &&  $request->parent_lesson_id == null) {
            return "update-lesson";
        }
    }
    public function displayAttachment($lesson_id, $url_type)
    {
        try {

            $lesson = Lesson::find(Crypt::decrypt($lesson_id));
            $url_type = Crypt::decrypt($url_type);
            if ($url_type == 1) {
                $attachment = $lesson->image_url;
            }
            if ($url_type == 2) {
                $attachment = $lesson->video_url;
            }
            $attachment_path = pathinfo(storage_path() . $attachment);
            $attachment_extension = $attachment_path['extension'];

            return view('admin.course-management.lesson.attachment', compact('lesson', 'attachment', 'attachment_extension'));
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
}
