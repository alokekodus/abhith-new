<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Imports\QuestionImport;
use App\Jobs\ConvertVideoForResolution;
use App\Models\AssignSubject;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Lesson;
use App\Models\LessonAttachment;
use App\Models\Set;
use App\Models\User;
use App\Models\UserDetails;
use App\Traits\LessonAttachmentTrait;
use Brian2694\Toastr\Facades\Toastr;
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
    //create lesson against subject
    public function create($subject_id)
    {
        $assign_subject = AssignSubject::find(Crypt::decrypt($subject_id));

        return view('admin.course-management.lesson.create')->with(['subject' => $assign_subject]);
    }
    public function store(Request $request)
    {
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                ],
                [
                    'name.required' => 'Subject Name is required',
                ]
            );
            if ($validate->fails()) {
                Toastr::success($validate->errors(), '', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            }
            $assign_subject = AssignSubject::find(Crypt::decrypt($request->subject_id));
            if ($assign_subject == null) {
                Toastr::error('Something went wrong', '', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            }
            $data = [
                'name' => ucfirst($request->name),
                'slug' => Str::slug($request->name),
                'board_id' => $assign_subject->board_id,
                'assign_class_id' => $assign_subject->assign_class_id,
                'assign_subject_id' => $assign_subject->id,
            ];
            Lesson::create($data);
            Toastr::success('Lesson added successfully.', '', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        } catch (\Throwable $th) {
            Toastr::error('Something went wrong', '', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }
    // public function store(Request $request)
    // {
    //  try {

    //         $slug=Str::slug($request->name);
    //         if($request->has('parent_id')){
    //             $lesson=Lesson::find($request->parent_id);
    //             $board_id=$lesson->board_id;
    //             $assign_class_id=$lesson->assign_class_id;
    //             $assign_subject_id=$lesson->assign_subject_id;
    //         }else{
    //             $board_id=$request->board_id;
    //             $assign_class_id=$request->assign_class_id;
    //             $assign_subject_id=$request->assign_subject_id;
    //         }
    //         $data = [
    //             'name' => ucfirst($request->name),
    //             'slug' => $slug,
    //             'parent_id' => $request->parent_id,
    //             'parent_lesson_id' => $request->parent_lesson_id,
    //             'board_id' => $board_id,
    //             'assign_class_id' => $assign_class_id,
    //             'assign_subject_id' => $assign_subject_id,
    //             'type' => $request->content_type,
    //         ];

    //         $lesson = Lesson::create($data);
    //        
    //         
    //          if ($request->content_type == 3) {
    //             $lesson->update(['content'=>$request->content]);
    //             return response()->json(['message' => 'Lesson Created successfully.', 'status' => 1]);
    //          }
    //          if($request->content_type==4){
    //             dd($request->all());
    //          }

    //     } catch (\Throwable $th) {
    //         dd($th);
    //         // return response()->json(['message' => 'Whoops! Something went wrong. Failed to add Lesson.', 'status' => 2]);
    //     }
    // }
    public function storeFile(Request $request)
    {
        return response()->json($request->all());
        $new_img_name = date('d-m-Y-H-i-s') . '_' . $request->file('lesson_image')->getClientOriginalName();
        $request->file('lessonImage')->move(public_path('/files/lesson/'), $new_img_name);
        $imgFile = 'files/lesson/' . $new_img_name;
        return $imgFile;
    }
    public function topicCreate($id)
    {
        $lesson_id = Crypt::decrypt($id);
        $lesson = Lesson::with(['assignClass', 'board', 'assignSubject', 'lessonAttachment', 'topics'])->where('id', $lesson_id)->first();
        
        $teachers=UserDetails::where('assign_class_id',$lesson->assign_class_id)->where('assign_subject_id',$lesson->assign_subject_id)->where('status',2)->get();
        return view('admin.course-management.lesson.topic.create', compact('lesson','teachers'));
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
    public function topicView($id)
    {
        try {
            $lesson_id = Crypt::decrypt($id);
            $lesson = Lesson::with('lessonAttachment')->where('id', $lesson_id)->first();
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
    

    
    public function displayAttachment($lesson_id, $url_type)
    {
        try {

            $lesson = Lesson::with('lessonAttachment')->where('id', Crypt::decrypt($lesson_id))->first();
            $url_type = Crypt::decrypt($url_type);
            if ($url_type == 1) {
                $attachment = $lesson->lessonAttachment->img_url;
            }
            if ($url_type == 2) {
                $attachment = $lesson->lessonAttachment->origin_video_url;
            }
            $attachment_path = pathinfo(storage_path() . $attachment);
            $attachment_extension = $attachment_path['extension'];

            return view('admin.course-management.lesson.attachment', compact('lesson', 'attachment', 'attachment_extension'));
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function lessonDetails($lesson_id)
    {
        $lesson = Lesson::with(['Sets','assignClass', 'board', 'assignSubject', 'topics' => function ($query) {
            $query->with('subTopics');
        }])->where('id', $lesson_id)->first();
        $data = [
            'filter_data' => $lesson,
        ];
        return response()->json($data);
    }
    public function topicStore(Request $request)
    {
        try { 
            
            $isLessonNameAlreadyInUsed = Lesson::where('name', $request->name)->first();
            if ($isLessonNameAlreadyInUsed) {
                Toastr::error('This Resource name already in used.', '', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            }
            if ($request->resource_type == 1) {
                $validate = Validator::make(
                    $request->all(),
                    [
                        'name' => 'required',
                        'image_url' => 'required|mimes:pdf',
                    ],
                    [
                        'name.required' => 'Resource Name is required',
                        'image_url.required' => 'Please upload your resource'
                    ]
                );
                if ($validate->fails()) {
                    Toastr::error($validate->errors(), '', ["positionClass" => "toast-top-right"]);
                    return redirect()->back();
                }
                $lesson = Lesson::find($request->parent_id);
                $name_slug = Str::slug($request->name);
                $data = [
                    'name' => ucfirst($request->name),
                    'slug' => $name_slug,
                    'parent_id' => $request->parent_id,
                    'board_id' => $lesson->board_id,
                    'assign_class_id' => $lesson->assign_class_id,
                    'assign_subject_id' => $lesson->assign_subject_id,
                    'type' => $request->resource_type,
                    'teacher_id'=>$request->teacher_id,
                ];
                 
                $resourceStore = Lesson::create($data);
                $document = $request->file('image_url');
                $image_path = LessonAttachmentTrait::uploadAttachment($document, "image", $name_slug);

                $data_attachment = [
                    'subject_lesson_id' =>  $resourceStore->id,
                    'img_url' => $image_path,
                    'type' => 2,
                    'attachment_type' => $request->resource_type,

                ];
                LessonAttachment::create($data_attachment);
                Toastr::success('Resource stored successfully.', '', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            }
            if ($request->resource_type == 2) {
                
                $validate = Validator::make(
                    $request->all(),
                    [
                        'name' => 'required',
                        'video_thumbnail_image_url' => 'mimes:pdf',
                        'video_url'=>'required|'
                    ],
                    [
                        'name.required' => 'Resource Name is required',
                        'image_url.required' => 'Please upload your resource'
                    ]
                );
                if ($validate->fails()) {
                    Toastr::error($validate->errors(), '', ["positionClass" => "toast-top-right"]);
                    return redirect()->back();
                }
                $lesson = Lesson::find($request->parent_id);
                $name_slug = Str::slug($request->name);
                $data = [
                    'name' => ucfirst($request->name),
                    'slug' => $name_slug,
                    'parent_id' => $request->parent_id,
                    'board_id' => $lesson->board_id,
                    'assign_class_id' => $lesson->assign_class_id,
                    'assign_subject_id' => $lesson->assign_subject_id,
                    'type' => $request->resource_type,
                    'teacher_id'=>$request->teacher_id,
                ];

                $resourceStore = Lesson::create($data);
                $videoThumbnailImageUrl = $request->file('video_thumbnail_image_url');
                $video_thumbnail_image_url_path = LessonAttachmentTrait::uploadAttachment($videoThumbnailImageUrl, "image", $name_slug);
                $origin_video = LessonAttachmentTrait::uploadAttachment($request->file('video_url'), "video", $name_slug);
                // $video_path=$request->video_url->store('public');

                $data_attachment = [
                    'subject_lesson_id' => $resourceStore->id,
                    'attachment_origin_url' => $origin_video,
                    'video_thumbnail_image' =>  $video_thumbnail_image_url_path,
                    'video_origin_url' => $origin_video,
                    'video_resize_480' => $origin_video,
                    'video_resize_720' => $origin_video,
                    'type' => 2,
                    'progress_status' => 1,
                    'attachment_type' => $request->resource_type,
                    'video_duration' => $request->duration,
                ];

                $lesson_attachment = LessonAttachment::create($data_attachment);
                Toastr::success('Resource stored successfully.', '', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
                // $resizes = ["480", "720", "1080"];
                // foreach ($resizes as $key => $resize) {
                //     if ($resize == 480) {
                //         $x_dimension = 640;
                //         $y_dimension = 480;
                //     }
                //     if ($resize == 720) {
                //         $x_dimension = 1280;
                //         $y_dimension = 720;
                //     }
                //     // if($resize==1080){
                //     //     $x_dimension=1920;
                //     //     $y_dimension =1080;  
                //     // }
                //     $this->dispatch(new ConvertVideoForResolution($lesson_attachment, $x_dimension, $y_dimension,$slug));
                // }

            }
            if ($request->resource_type == 3) {
                $lesson = Lesson::find($request->parent_id);
                $name_slug = Str::slug($request->name);
                $data = [
                    'name' => ucfirst($request->name),
                    'slug' => $name_slug,
                    'parent_id' => $request->parent_id,
                    'board_id' => $lesson->board_id,
                    'assign_class_id' => $lesson->assign_class_id,
                    'assign_subject_id' => $lesson->assign_subject_id,
                    'type' => $request->resource_type,
                    'content' => $request->content,
                    'teacher_id'=>$request->teacher_id,
                ];

                $resourceStore = Lesson::create($data);
                Toastr::success('Resource stored successfully.', '', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            }
            if ($request->resource_type == 4) {
                $lesson = Lesson::find($request->parent_id);
                $setName = $request->name;
                $board_id = $lesson->board_id;
                $assign_class_id = $lesson->assign_class_id;
                $assign_subject_id = $lesson->assign_subject_id;
                $lesson_id=$lesson->id;
                $questionFile = $request->questionExcel;
                if ($request->hasFile('questionExcel')) {

                    $subject_id = $lesson->assign_subject_id;
                    $board_id = $lesson->board_id;
                    $assign_class_id = $lesson->assign_class_id;
                    $new_excel_name = date('d-m-Y-H-i-s') . '_' . $questionFile->getClientOriginalName();
                    $questionFileExtension = $questionFile->getClientOriginalExtension();

                    if ($questionFileExtension != 'xlsx') {
                        Toastr::error('Not a valid excel file.', '', ["positionClass" => "toast-top-right"]);
                        return redirect()->back();
                    } else {
                        $questionFile = $request->file('questionExcel');

                        $questionFile = $request->file('questionExcel')->store('imports');
                        $import = new QuestionImport($setName, $subject_id, $board_id, $assign_class_id,$lesson_id);
                        $import->import($questionFile);

                        Toastr::success('Resource stored successfully.', '', ["positionClass" => "toast-top-right"]);
                        return redirect()->back();
                    }
                }
            }
        } catch (\Throwable $th) {
           
            Toastr::error('Something went wrong.', '', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }
}
