<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Jobs\ConvertVideoForResolution;
use App\Models\AssignClass;
use App\Models\AssignSubject;
use App\Models\LessonAttachment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Traits\LessonAttachmentTrait;

class AssignSubjectController extends Controller
{
    public function allSubjects()
    {

        $class_details =  AssignClass::with('boards')->where('is_activate', 1)->get();
        if (auth()->user()->hasRole('Teacher')) {
            $assign_subject = AssignSubject::with('assignClass', 'boards')->where('teacher_id', auth()->user()->id)->where('is_activate', 1)->orderBy('created_at', 'DESC')->get();
        } else {
            $assign_subject = AssignSubject::with('assignClass', 'boards')->orderBy('created_at', 'DESC')->paginate(2);
        }
     

        return view('admin.course-management.subjects.subject')->with(['subjects' => $assign_subject, 'classes' => $class_details]);
    }
    public function store(Request $request)
    {
      
        try {
            $split_assignedClass = str_split($request->assignedClass);

            $assignedClass = $split_assignedClass[0];
            $assignedBoard = $split_assignedClass[1];
            $document = $request->file('image_url');
            $lessonVideo = $request->file('video_url');
            $videoThumbnailImageUrl = $request->file('video_thumbnail_image_url');

            if (!empty($document)) {
                $image_path = LessonAttachmentTrait::uploadAttachment($document, "image"); //lesson image store

            }else{
                $image_path ='/files/subject/placeholder.jpg';
            }
            if (!empty($lessonVideo)) {
                $video_path = $request->video_url->store('public');
                if (!empty($videoThumbnailImageUrl)) {
                    $video_thumbnail_image_url_path = LessonAttachmentTrait::uploadAttachment($videoThumbnailImageUrl, "image"); //lesson image store
    
                }else{
                    $image_path='/files/subject/placeholder.jpg';
                }
            }
            $data = [
                'subject_name' => ucfirst($request->subjectName),
                'image' =>  base_path().'/public'.$image_path,
                'teacher_id' => $request->teacher_id,
                'subject_amount' => $request->subject_amount,
                'assign_class_id' => $assignedClass,
                'board_id' => $assignedBoard,
                'is_activate' => 0, //initially subject not active
                'description' => $request->description,
                'why_learn' => $request->why_learn,
            ];
            $assign_subject = AssignSubject::create($data);

            // $video_path=str_replace("public/", "",$video_path);
            $data_attachment = [
                'subject_lesson_id' =>  $assign_subject->id,
                'img_url' =>base_path().'/public'.$image_path,
                'origin_video_url' => $video_path,
                'video_thumbnail_image' => $video_thumbnail_image_url_path,
                'type' => 1,

            ];

            $lesson_attachment = LessonAttachment::create($data_attachment);
            $resizes = ["480", "720", "1080"];
            foreach ($resizes as $key => $resize) {
                if ($resize == 480) {
                    $x_dimension = 640;
                    $y_dimension = 480;
                }
                if ($resize == 720) {
                    $x_dimension = 1280;
                    $y_dimension = 720;
                }
                // if($resize==1080){
                //     $x_dimension=1920;
                //     $y_dimension =1080;  
                // }
                $this->dispatch(new ConvertVideoForResolution($lesson_attachment, $x_dimension, $y_dimension));
            }



            $request->session()->flash('subject_created', 'Subject created successfully');
            return \redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function assignSubject(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'subjectName' => 'required',
                'subjectCoverPic' => 'required',
                'assignedClass' => 'required',
                'subjectAmount' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Whoop! Something went wrong.', 'error' => $validator->errors()]);
            } else {
                $split_assignedClass = str_split($request->assignedClass);

                $assignedClass = $split_assignedClass[0];
                $assignedBoard = $split_assignedClass[1];

                $is_subject_assigned_already = AssignSubject::where('subject_name', $request->subjectName)->where('assign_class_id', $assignedClass)->where('board_id', $assignedBoard)->exists();
                if ($is_subject_assigned_already) {
                    return response()->json(['message' => 'Whoops! Subject already assigned with the class.', 'status' => 2]);
                } else {

                    $document = $request->subjectCoverPic;
                    $file = '';
                    if (isset($document) && !empty($document)) {
                        $new_name = date('d-m-Y-H-i-s') . '_' . $document->getClientOriginalName();
                        $document->move(public_path('/files/course/subject/'), $new_name);
                        $file = '/files/course/subject/' . $new_name;
                    }

                    $create = AssignSubject::create([
                        'subject_name' => strtoupper($request->subjectName),
                        'image' => $file,
                        'assign_class_id' => $assignedClass,
                        'board_id' => $assignedBoard,
                        'subject_amount' => $request->subjectAmount,
                    ]);

                    if ($create) {
                        return response()->json(['message' => 'Subject assigned successfully', 'status' => 1]);
                    } else {
                        return response()->json(['message' => 'Whoops! Something went wrong. Failed to assign subject.', 'status' => 2]);
                    }
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Whoops! Something went wrong. Failed to assign subject.', 'status' => 2]);
        }
    }
    public function create()
    {
        $class_details =  AssignClass::with('boards')->where('is_activate', 1)->get();
        $assign_subject = AssignSubject::with('assignClass', 'boards')->where('is_activate', 1)->orderBy('created_at', 'DESC')->get();
        $teachers = $students = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'Teacher');
            }
        )->get();

        return view('admin.course-management.subjects.create')->with(['subjects' => $assign_subject, 'classes' => $class_details, 'teachers' => $teachers]);
    }
}
