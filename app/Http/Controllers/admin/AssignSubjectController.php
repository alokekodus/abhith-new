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
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Crypt;

class AssignSubjectController extends Controller
{
    public function allSubjects()
    {

        $class_details =  AssignClass::with('boards')->where('is_activate', 1)->get();
        if (auth()->user()->hasRole('Teacher')) {
            $assign_subject = AssignSubject::with('assignClass', 'boards')->where('teacher_id', auth()->user()->id)->where('is_activate', 1)->orderBy('created_at', 'DESC')->paginate(4);
        } else {
            $assign_subject = AssignSubject::with('assignClass', 'boards')->orderBy('created_at', 'DESC')->paginate(4);
        }


        return view('admin.course-management.subjects.index')->with(['subjects' => $assign_subject, 'classes' => $class_details]);
    }
    public function store(Request $request)
    {

        try {

            $validate = Validator::make(
                $request->all(),
                [
                    'subjectName' => 'required',
                    'assignedClass' => 'required',
                    'subject_amount' => 'required',
                    'description' => 'required',
                    'why_learn' => 'required',
                    'image_url' => 'mimes:jpg,png,jpeg',
                    'video_thumbnail_image_url' => 'mimes:jpg,png,jpeg',
                    'video_url' => 'mimes:mp4,WEBM,MOV',

                ],
                [
                    'subjectName.required' => 'Subject name is required',
                    'assignedClass.required' => 'Subject class is required',
                    'subject_amount.required' => 'Amount filed is required',
                    'description.required' => 'Subject descripttion filed is required',
                    'why_learn.required' => 'Why learn filed is required',
                ]
            );

            if ($validate->fails()) {
                Toastr::error('Something Want wrong', '', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            }

            $split_assignedClass = str_split($request->assignedClass);

            $assignedClass = $split_assignedClass[0];
            $assignedBoard = $split_assignedClass[1];
            $document = $request->file('image_url');
            $lessonVideo = $request->file('video_url');
            $videoThumbnailImageUrl = $request->file('video_thumbnail_image_url');
            $name_slug = Str::slug($request->subjectName);
            if (!empty($document)) {
                $image_path = LessonAttachmentTrait::uploadAttachment($document, "image",$name_slug); //lesson image store
                $image_path = $image_path;
            } else {
                if ($request->subject_id == null) {
                    $image_path = '/files/subject/placeholder.jpg';
                    $image_path = $image_path;
                } else {
                    $assign_subject = AssignSubject::with('subjectAttachment')->where('id', $request->subject_id)->first();
                    $image_path = $assign_subject->subjectAttachment->img_url;
                }
            }

            if (!empty($lessonVideo)) {
                $video_path = LessonAttachmentTrait::uploadAttachment($lessonVideo, "video",$name_slug);
                $video_path = $video_path;
                if (!empty($videoThumbnailImageUrl)) {
                    $video_thumbnail_image_url_path = LessonAttachmentTrait::uploadAttachment($videoThumbnailImageUrl, "image",$name_slug); //lesson image store
                    $video_thumbnail_image_url_path = $video_thumbnail_image_url_path;
                } else {
                    if ($request->subject_id == null) {
                        $video_thumbnail_image_url_path = '/files/subject/placeholder.jpg';
                        $video_thumbnail_image_url_path = $video_thumbnail_image_url_path;
                    } else {
                        $assign_subject = AssignSubject::with('subjectAttachment')->where('id', $request->subject_id)->first();
                        $video_thumbnail_image_url_path = $assign_subject->subjectAttachment->video_thumbnail_image;
                    }
                }
            } else {
                if ($request->subject_id == null) {
                    $video_path = null;
                    $video_thumbnail_image_url_path = null;
                } else {
                    $assign_subject = AssignSubject::with('subjectAttachment')->where('id', $request->subject_id)->first();
                    $video_path=$assign_subject->attachment_origin_url;
                    $video_thumbnail_image_url_path = $assign_subject->subjectAttachment->video_thumbnail_image;
                }
            }

            $data = [
                'subject_name' => ucfirst($request->subjectName),
                'image' =>  $image_path,
                'teacher_id' => $request->teacher_id,
                'subject_amount' => $request->subject_amount,
                'assign_class_id' => $assignedClass,
                'board_id' => $assignedBoard,
                'is_activate' => 0, //initially subject not active
                'description' => $request->description,
                'why_learn' => $request->why_learn,
            ];
            if ($request->subject_id == null) {
                $assign_subject = AssignSubject::create($data);
            } else {
                $assign_subject = AssignSubject::find($request->subject_id);
                $assign_subject->update($data);
            }


            // $video_path=str_replace("public/", "",$video_path);
            $data_attachment = [
                'subject_lesson_id' =>  $assign_subject->id,
                'img_url' => $image_path,
                'attachment_origin_url' => $video_path,
                'video_thumbnail_image' => $video_thumbnail_image_url_path,
                'type' => 1,

            ];
            if ($request->subject_id == null) {
                $lesson_attachment = LessonAttachment::create($data_attachment);
            } else {
                $assign_subject = AssignSubject::with('subjectAttachment')->where('id', $request->subject_id)->first();
                $assign_subject->subjectAttachment->update($data_attachment);
            }
            if ($request->subject_id == null) {
                Toastr::success('Subject created successfully', '', ["positionClass" => "toast-top-right"]);
            } else {
                Toastr::success('Subject updated successfully', '', ["positionClass" => "toast-top-right"]);
            }
            return redirect()->route('admin.course.management.subject.all');
        } catch (\Throwable $th) {
            dd($th);
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
    public function edit($id)
    {
        $class_details =  AssignClass::with('boards')->where('is_activate', 1)->get();
        $assign_subject = AssignSubject::with('assignClass', 'boards')->where('is_activate', 1)->orderBy('created_at', 'DESC')->get();
        $teachers = $students = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'Teacher');
            }
        )->get();

        $subject_id = Crypt::decrypt($id);
        $subject = AssignSubject::with('subjectAttachment')->where('id', $subject_id)->first();
        $classBoard = $subject->assign_class_id . $subject->board_id;

        return view('admin.course-management.subjects.edit')->with(['subject' => $subject, 'subjects' => $assign_subject, 'classes' => $class_details, 'teachers' => $teachers, 'classBoard' => $classBoard]);
    }
    public function view($subject_id){
        try {
            $subject=AssignSubject::where('id',Crypt::decrypt($subject_id))->first();
            return view('admin.course-management.subjects.view')->with(['subject' => $subject]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
