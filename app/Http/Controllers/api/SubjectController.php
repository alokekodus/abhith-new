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
    public function subjectDetails(Request $request)
    {
        try {
            $id=$_GET['subject_id'];
            $subject = AssignSubject::select('id', 'subject_name', 'subject_amount', 'assign_class_id', 'board_id', 'description', 'why_learn', 'created_at')->with(['assignClass:id,class', 'boards:id,exam_board', 'lesson', 'lesson.topics', 'subjectAttachment'])->where('id', $id)->first();
            $subject_promo_video = $subject->subjectAttachment->attachment_origin_url;
            if($subject_promo_video!=null){
                $attachment_type="video";
                $subject_attachment = $subject->subjectAttachment->attachment_origin_url;
             
             }else{
                $attachment_type="image";
                $subject_attachment = $subject->subjectAttachment->img_url;
             }
            $subject_attachment=[
                'attachment_type'=> $attachment_type,
                'attachment'=>$subject_attachment,
                

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
    public function LessonDetails(Request $request){
        try {
            $id=$_GET['subject_id'];
            
            $lessons = Lesson::select('id', 'name','assign_class_id', 'board_id','assign_subject_id','created_at')->with(['assignClass:id,class','board:id,exam_board','assignSubject:id,subject_name','topics','lessonAttachment'])->where('assign_subject_id',$id)->where('parent_id',null)->get();
            
            $lessonData=[];
           foreach($lessons as $key=>$lesson){
            $pdf=0;
            $img=0;
           
            $topic=$lesson->topics->count();
            $total_image_pdfs = Lesson::with(['lessonAttachment'])->where('type',1)->where('parent_id',$lesson->id)->get();
            if($total_image_pdfs!=null){
                foreach($total_image_pdfs as $key=>$data){
                    $ext = pathinfo( $data->lessonAttachment->img_url, PATHINFO_EXTENSION);
                   if($ext=="pdf"){
                    $pdf+=1;
                   }else{
                    $img+=1;
                   }
                }

            }
            $total_video = Lesson::with(['lessonAttachment'])->where('type',2)->where('parent_id',$lesson->id)->get()->count();
            $total_article = Lesson::with(['lessonAttachment'])->where('type',3)->where('parent_id',$lesson->id)->get()->count();
            $subject_content=
            [
                'total_pdf'=>$pdf,
                'total_image'=>$img,
                'total_video'=>$total_video,
                'total_article'=>$total_article,
            ];
            
            $lesson=[
                'id'=>$lesson->id,
                'name'=>$lesson->name,
                'board_id'=>$lesson->board->id,
                'board_name'=>$lesson->board->exam_board,
                'class_id'=>$lesson->assignClass->id,
                'class_name'=>$lesson->assignClass->class,
                'subject_id'=>$lesson->assignSubject->id,
                'subject_name'=>$lesson->assignSubject->subject_name,
                'total_content'=>$subject_content,
               
             ];
             $lessonData[] = $lesson;
           
           }
            if (!$lessonData == null) {
                
                $data = [
                    "code" => 200,
                    "message" => "all board",
                    "result" => $lessonData,

                ];
                return response()->json(['status' => 1, 'result' => $data]);
            }else{
                $data = [
                    "code" => 200,
                    "message" => "No record found",

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
