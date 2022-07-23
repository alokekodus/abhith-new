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
            $id = $_GET['subject_id'];
            $subject = AssignSubject::select('id', 'subject_name', 'subject_amount', 'assign_class_id', 'board_id', 'description', 'why_learn', 'created_at')->with(['assignClass:id,class', 'boards:id,exam_board', 'lesson', 'lesson.topics', 'subjectAttachment'])->where('id', $id)->first();
            $subject_promo_video = $subject->subjectAttachment->attachment_origin_url;
            if ($subject_promo_video != null) {
                $attachment_type = "video";
                $subject_attachment = $subject->subjectAttachment->attachment_origin_url;
            } else {
                $attachment_type = "image";
                $subject_attachment = $subject->subjectAttachment->img_url;
            }
            $subject_attachment = [
                'attachment_type' => $attachment_type,
                'attachment' => $subject_attachment,


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
                    'subject_attachment' => $subject_attachment,

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
    public function LessonDetails(Request $request)
    {
        try {
            $id = $_GET['subject_id'];

            $lessons = Lesson::select('id', 'name', 'assign_class_id', 'board_id', 'assign_subject_id', 'created_at')->with(['assignClass:id,class', 'board:id,exam_board', 'assignSubject:id,subject_name', 'topics', 'lessonAttachment'])->where('assign_subject_id', $id)->where('parent_id', null)->paginate(15);
            $total_lesson = Lesson::select('id', 'name', 'assign_class_id', 'board_id', 'assign_subject_id', 'created_at')->with(['assignClass:id,class', 'board:id,exam_board', 'assignSubject:id,subject_name', 'topics', 'lessonAttachment'])->where('assign_subject_id', $id)->where('parent_id', null)->get()->count();
            $lessonData = [];
            $lessons->getCollection()->transform(function ($lesson) {
                $pdf = 0;
                $img = 0;

                $topic = $lesson->topics->count();
                $total_image_pdfs = Lesson::with(['lessonAttachment'])->where('type', 1)->where('parent_id', $lesson->id)->get();
                if ($total_image_pdfs != null) {
                    foreach ($total_image_pdfs as $key => $data) {
                        $ext = pathinfo($data->lessonAttachment->img_url, PATHINFO_EXTENSION);
                        if ($ext == "pdf") {
                            $pdf += 1;
                        } else {
                            $img += 1;
                        }
                    }
                }
                $total_video = Lesson::with(['lessonAttachment'])->where('type', 2)->where('parent_id', $lesson->id)->get()->count();
                $total_article = Lesson::with(['lessonAttachment'])->where('type', 3)->where('parent_id', $lesson->id)->get()->count();
                $subject_content =
                    [
                        'total_pdf' => $pdf,
                        'total_image' => $img,
                        'total_video' => $total_video,
                        'total_article' => $total_article,
                    ];

                $lesson = [
                    'id' => $lesson->id,
                    'name' => $lesson->name,
                    'board_id' => $lesson->board->id,
                    'board_name' => $lesson->board->exam_board,
                    'class_id' => $lesson->assignClass->id,
                    'class_name' => $lesson->assignClass->class,
                    'subject_id' => $lesson->assignSubject->id,
                    'subject_name' => $lesson->assignSubject->subject_name,
                    'total_content' => $subject_content,

                ];
                return $lessonData[] = $lesson;
            });
            // foreach ($lessons as $key => $lesson) {

            // }
            if (!$lessons == null) {

                $data = [
                    "code" => 200,
                    "message" => "All Lesson",
                    "total_lesson" => $total_lesson,
                    "result" => $lessons,

                ];
                return response()->json(['status' => 1, 'result' => $data]);
            } else {
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
    public function LessonContentDetails(Request $request)
    {
        try {
            $id = $_GET['lesson_id'];
            $lesson = Lesson::with(["lessonAttachment", "topics" => function ($q) {
                $q->with(["lessonAttachment", "subTopics" => function ($query) {
                    $query->with("lessonAttachment");
                }]);
            }])->where('id', $id)->first();

            $topic_pdf = [];
            $topic_video = [];
            $topic_content = [];

            if ($lesson != null) {
                if ($lesson->topics) {
                    foreach ($lesson->topics as $key => $topic) {
                        if ($topic->type == 1) {

                            $topic_pdf_data =
                                [
                                    'id' => $topic->id,
                                    'title' => $topic->name,
                                    'file_path' => $topic->lessonAttachment->img_url,

                                ];
                            $topic_pdf['lesson_data'] = $topic_pdf_data;
                        }
                        if ($topic->type == 2) {
                            $topic_video_data =
                                [
                                    'id' => $topic->id,
                                    'title' => $topic->name,

                                    'original_video_path' => $topic->lessonAttachment->attachment_origin_url,
                                    'video_size_480' => $topic->lessonAttachment->video_resize_480,
                                    'video_size_720' => $topic->lessonAttachment->video_resize_720,

                                ];
                            $topic_video['lesson_data'] = $topic_video_data;
                        }
                        if ($topic->type == 3) {

                            $topic_content_data =
                                [
                                    'id' => $topic->id,
                                    'title' => $topic->name,
                                    'content' => $topic->content,

                                ];
                            $topic_content['lesson_data'] = $topic_content_data;
                        }
                        if ($topic->subTopics) {

                            foreach ($topic->subTopics as $key => $sub_topic) {
                                if ($sub_topic->type == 1) {
                                    $topic_pdf_data =
                                        [
                                            'id' => $sub_topic->id,
                                            'title' => $sub_topic->name,
                                            'file_path' => $sub_topic->lessonAttachment->img_url,

                                        ];
                                    $topic_pdf['lesson_data'] = $topic_pdf_data;
                                }
                                if ($sub_topic->type == 2) {
                                    $topic_video_data =
                                        [
                                            'id' => $sub_topic->id,
                                            'title' => $sub_topic->name,
                                            'img_url' => $sub_topic->lessonAttachment,
                                            'video_thumbnail_image' => $sub_topic->lessonAttachment->video_thumbnail_image ?? '',
                                            'original_video_path' => $sub_topic->lessonAttachment->attachment_origin_url ?? '',
                                            'video_size_480' => $sub_topic->lessonAttachment->video_resize_480 ?? '',
                                            'video_size_720' => $sub_topic->lessonAttachment->video_resize_720 ?? '',

                                        ];
                                    $topic_video['lesson_data'] = $topic_video_data;
                                }
                                if ($sub_topic->type == 3) {
                                    $topic_content_data =
                                        [
                                            'id' => $sub_topic->id,
                                            'title' => $sub_topic->name,
                                            'content' => $sub_topic->content,

                                        ];
                                    $topic_content['lesson_data'] = $topic_content_data;
                                }
                            }
                        }
                    }


                    $topic_pdf["total_pdf"] = count($topic_pdf);
                    $topic_video["total_video"] = count($topic_video);
                    $topic_content["total_content"] = count($topic_video);
                    $all_content = [

                        'lesson_pdf' => $topic_pdf,
                        'lesson_video' => $topic_video,
                        'lesson_content' => $topic_content,

                    ];
                }
                $data = [
                    "code" => 400,
                    "status" => 0,
                    "message" => "All lesson content",
                    "result" => $all_content,

                ];
                return response()->json(['status' => 1, 'result' => $data]);
            } else {

                $data = [
                    "code" => 400,
                    "status" => 0,
                    "message" => "No Records found",

                ];
                return response()->json(['status' => 0, 'result' => $data]);
            }







            $data = [
                "code" => 200,
                "status" => 0,
                "message" => "Lesson-Details",
                "result" => $lesson,

            ];
            return response()->json(['status' => 1, 'result' => $data]);
        } catch (\Throwable $th) {
            dd($th);
            $data = [
                "code" => 400,
                "status" => 0,
                "message" => "Something went wrong",

            ];
            return response()->json(['status' => 0, 'result' => $data]);
        }
    }
    public function LessonVideoDetails(Request $request)
    {
        try {


            $id = $_GET['lesson_id'];
            $sub_topic_video = [];
            $lesson = Lesson::with(["lessonAttachment", "topics" => function ($q) {
                $q->with(["lessonAttachment", "subTopics" => function ($query) {
                    $query->with("lessonAttachment");
                }]);
            }])->where('id', $id)->first();
            if ($lesson != null) {

                if ($lesson->topics) {
                    $topic_video = [];
                    foreach ($lesson->topics->where('type', 2) as $key => $topic) {


                        $topic_video_data =
                            [
                                'id' => $topic->id,
                                'title' => $topic->name,

                                'original_video_path' => $topic->lessonAttachment->attachment_origin_url ?? null,
                                'video_size_480' => $topic->lessonAttachment->video_resize_480 ?? null,
                                'video_size_720' => $topic->lessonAttachment->video_resize_720 ?? null,

                            ];
                       

                        if ($topic->subTopics->where('type', 2)) {
                           
                            foreach ($topic->subTopics->where('type',2) as $key => $sub_topic) {


                                $sub_topic_video =
                                    [
                                        'id' => $sub_topic->id,
                                        'title' => $sub_topic->name,

                                        'original_video_path' => $sub_topic->lessonAttachment->attachment_origin_url ?? null,
                                        'video_size_480' => $sub_topic->lessonAttachment->video_resize_480 ?? null,
                                        'video_size_720' => $sub_topic->lessonAttachment->video_resize_720 ?? null,

                                    ];
                                
                            }
                        }
                        $topic_video["topic_video"] = $topic_video_data;
                        $topic_video["sub_topic_video"]=$sub_topic_video;
                    }

                   

                    $topic_video["total_video"] = count($topic_video);
                   
                    $all_content = [
                        'lesson_video' => $topic_video,

                    ];
                }
                if ($all_content['lesson_video']['total_video'] == 0) {
                    $message = "Video Not Available";
                } else {
                    $message = "All lesson content";
                }
                $data = [
                    "code" => 200,
                    "status" => 1,
                    "message" => $message,
                    "result" => $all_content,

                ];
                return response()->json(['status' => 1, 'result' => $data]);
            } else {

                $data = [
                    "code" => 200,
                    "status" => 1,
                    "message" => "No Records found",
                    "result" => null,
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
    public function LessonTopics(Request $request){
        try {
            $id = $_GET['lesson_id'];
            $page = $_GET['page'];
          
            $lesson = Lesson::with(['topics:parent_id,name','subTopics'])->where('id', $id)->first();
           
            if($lesson->topics){
                $lesson_topic=$lesson->topics()->paginate();
                $topics=[];
                foreach($lesson_topic as $key=>$topic){
                    $sub_topic_count=$topic->subTopics->count();
                    $topic=[
                        'id'=>$topic->id,
                        'name'=>$topic->name,
                        'sub_topic_count'=>$sub_topic_count
                        
                    ];
                    $topics[] = $topic;
                }

               
                 
                $data = [
                    "code" => 200,
                    "status" => 1,
                    "message" => "All Topics",
                    "result"=>$topics,
                ];
                return response()->json(['status' => 1, 'result' => $data]);
            }else{
                $data = [
                    "code" => 200,
                    "status" => 1,
                    "message" => "No Data Available",
    
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
