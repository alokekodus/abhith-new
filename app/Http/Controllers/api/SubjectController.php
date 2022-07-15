<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\Lesson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function findSubject(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'board' => 'required',
                'standard' => 'required',
            ]);
            if ($validator->fails()) {
                $data = [
                    "code" => 400,
                    "status" => 0,
                    "message" => $validator->errors(),

                ];
                return response()->json(['status' => 0, 'result' => $data]);
            }

            $subjects = AssignSubject::whereHas('boards', function ($query) use ($request) {
                $query->where('exam_board', $request->board);
            })->whereHas('assignClass', function ($query) use ($request) {
                $query->where('class', $request->standard);
            })->select('id', 'subject_name', 'image', 'subject_amount', 'subject_amount')->where('is_activate', 1)->get();
            $total_amount = $subjects->sum('subject_amount');
            $data = [
                'subjects' => $subjects,
                'total_amount' => $total_amount,
            ];
            if (!$subjects->isEmpty()) {
                $data = [
                    "code" => 200,
                    "status" => 1,
                    "message" => "all board",
                    "result" => $data,

                ];
                return response()->json(['status' => 1, 'result' => $data]);
            } else {
                $data = [
                    "code" => 200,
                    "status" => 0,
                    "message" => "No record found",

                ];
                return response()->json(['status' => 0, 'result' => $data]);
            }
        } catch (\Throwable $th) {
            $data = [
                "code" => 400,
                "status" => 0,
                "message" => "Something went wrong",

            ];
            return response()->json(['status' => 0, 'result' => $data]);
        }
    }
    public function subjectDetails($id)
    {
        try {
            $subject = AssignSubject::select('id', 'subject_name', 'subject_amount', 'assign_class_id', 'board_id', 'description', 'why_learn', 'created_at')->with(['assignClass:id,class', 'boards:id,exam_board', 'lesson', 'lesson.topics', 'subjectAttachment'])->where('id', $id)->first();
            $subject_promo_video = $subject->subjectAttachment->attachment_origin_url;
            if($subject_promo_video!=null){
                $attachment_type="video";
                $subject_video_thumbnail_image = $subject->subjectAttachment->video_thumbnail_image;
                $subject_attachment = $subject->subjectAttachment->attachment_origin_url;
             
             }else{
                $attachment_type="image";
                $subject_video_thumbnail_image=null;
                $subject_attachment = $subject->subjectAttachment->img_url;
             }
            $subject_attachment=[
                'attachment_type'=> $attachment_type,
                'subject_attachment'=>$subject_attachment,
                'subject_video_thumbnail_image'=>$subject_video_thumbnail_image,

            ];
           
           
            $total_lesson = $subject->lesson->count();
            $total_topic = Lesson::where('assign_subject_id', $id)->where('parent_id', '!=', null)->get()->count();
            $total_image_pdf = Lesson::where('assign_subject_id', $id)->where('type', 1)->get()->count();
            $total_video = Lesson::where('assign_subject_id', $id)->where('type', 2)->get()->count();
            $total_article = Lesson::where('assign_subject_id', $id)->where('type', 3)->get()->count();
            $subject_details = [
                'id' => $subject->id,
                'subject_name' => $subject->subject_name,
                'subject_amount' => $subject->subject_amount,
                'description' => $subject->description,
                'why_learn' => $subject->why_learn,
                'created_at' => $subject->created_at,
                'board_id' => $subject->boards->id,
                'board_name' => $subject->boards->exam_board,
                'class_id' => $subject->assignClass->id,
                'class_name' => $subject->assignClass->class,
                'total_lesson' => $total_lesson,
                'total_topic' => $total_topic,
                'total_image_pdf' => $total_image_pdf,
                'total_video' => $total_video,
                'total_article' => $total_article,

            ];
           
           

            if (!$subject == null) {
                $result = [
                    
                    'subject_details' => $subject_details,
                    'subject_attachment'=>$subject_attachment,
                    
                ];
                $data = [
                    "code" => 200,
                    "status" => 1,
                    "message" => "all board",
                    "result" => $result,

                ];
                return response()->json(['status' => 1, 'result' => $data]);
            }
        } catch (\Throwable $th) {
            $data = [
                "code" => 400,
                "status" => 0,
                "message" => "Something went wrong",

            ];
            return response()->json(['status' => 0, 'result' => $data]);
        }
    }
}
