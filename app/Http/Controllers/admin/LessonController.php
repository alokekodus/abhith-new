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
    public function index()
    {

        $board_details = Board::where('is_activate', 1)->get();
        $lessons = Lesson::where('parent_id', null)->get();

        return view('admin.course-management.lesson.index')->with(['boards' => $board_details, 'lessons' => $lessons]);
    }
    public function store(Request $request)
    {
      
        try {
           return response()->json($data);
            if($request->assign_class_id!=null){
                $type = "create-lesson";
            }
          
            if ($request->parent_id != null &&  $request->parent_lesson_id == null) {
                $type = "create-topic";
            }
            if ($request->parent_id != null &&  $request->parent_lesson_id != null) {
                $type = "create-sub-topic";
            }
            //validate all request according to it's type
            $validator = Validator::make($request->all(), Lesson::getRules($request->type), Lesson::getRuleMessages($type));

            if ($validator->fails()) {
                return response()->json(['message' => 'Whoop! Something went wrong.', 'error' => $validator->errors()]);
            } else {
                $document = $request->file('image_url');
                if (isset($document) && !empty($document)) {
                    $file = Lesson::storeLessonFile($document, "image"); //lesson image store
                } else {
                    $file = null;
                }
                $lessonVideo = $request->file('video_url');
                if (isset($lessonVideo) && !empty($lessonVideo)) {

                    $video_url = Lesson::storeLessonFile($lessonVideo, "video"); //lesson file store

                } else {
                    $video_url = null;
                }
                if ($type == "create-lesson") {

                    $data = [
                        'name' => ucfirst($request->name),
                        'slug' => Str::slug($request->name),
                        'board_id' => $request->board_id,
                        'assign_class_id' => $request->assign_class_id,
                        'assign_subject_id' => $request->assign_subject_id,
                        'content' => $request->content,
                        'image_url' => $file,
                        'video_url' => $video_url,
                    ];
                }
                if($type="create-topic"){
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
                
                $create = Lesson::create($data);
                if ($request->parent_is != null) {
                    if ($request->parent_lesson_id != null) {
                        return redirect()->back()->with('success', 'topic added successfully.');
                    }
                    return redirect()->back()->with('success', 'sub topic added successfully.');
                }
                if ($create) {
                    return response()->json(['message' => 'Lesson Added Successfully', 'status' => 1]);
                } else {
                    return response()->json(['message' => 'Whoops! Something went wrong. Failed to add Lesson.', 'status' => 2]);
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Whoops! Something went wrong. Failed to add Lesson.', 'status' => 2]);
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
            $lesson = Lesson::with('boards', 'topics', 'subTopics')->where('slug', $slug)->first();
            return view('admin.course-management.lesson.view', compact('lesson'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function edit($lesson_slug)
    {
        try {

            $lesson = Lesson::with('boards', 'topics', 'subTopics')->where('slug', $lesson_slug)->first();

            return view('admin.course-management.lesson.edit', compact('lesson'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
