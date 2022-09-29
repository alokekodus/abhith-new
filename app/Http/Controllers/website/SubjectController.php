<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\Lesson;
use App\Models\Review;
use App\Models\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SubjectController extends Controller
{
    public function subjectDetails($subject_id)
    {
       
        $subject_id = Crypt::decrypt($subject_id);
        $subject = AssignSubject::with('lesson', 'subjectAttachment')->where('id', $subject_id)->first();
        $lessons = $subject->lesson;

        $reviews=Review::with(['user'=>function($q){
            $q->with('userDetail');
        }
        ])->where('subject_id',$subject_id)->where('is_visible',1)->get();
        if(!$reviews->isEmpty()){
            $all_reviews=[];
            $total_rating=$reviews->count()*5;
            $rating_average=$reviews->sum('rating') / $total_rating * 5;
            foreach($reviews as $key=>$review){
                $review=[
                    'user_name'=>$review->user->userDetail->name,
                    'image'=>$review->user->userDetail->image,
                    'rating'=>$review->rating,
                    'review'=>$review->review,

                ];
                $all_reviews[]=$review;
            }
            $total_review=$reviews->count();
           
           
        }else{
            $reviews = null;
            $total_review=0;
            $rating_average=0;
            
        }
        
        return view('website.user.lesson', compact('lessons', 'subject','reviews','total_review','rating_average'));
    }
    public function subjectMCQ($subject_id)
    {
        try {
            $subject_id = Crypt::decrypt($subject_id);
            $subject = AssignSubject::with('lesson', 'subjectAttachment', 'sets')->where('id', $subject_id)->first();
            return view('website.my_account.mcq', compact('subject'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function mcqStart($set_id){
        try {
            $set_id=Crypt::decrypt($set_id);
            $set=Set::with('question')->where('id',$set_id)->first();
            $total_question=$set->question->count();
            $start=true;
            
            return view('website.my_account.mcq_start',compact('set','start','total_question'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function mcqResult(){
        
        return view('website.my_account.mcq_result');
    }

    public function topicDetails($topic_id){
        try {
            $lesson=Lesson::find(Crypt::decrypt($topic_id));
            $topicDocuments=Lesson::with('lessonAttachment')->where('parent_id',$lesson->id)->where('type',1)->get();
            $topicVideos=Lesson::with('lessonAttachment')->where('parent_id',$lesson->id)->where('type',2)->get();
            $topicArticles=Lesson::with('lessonAttachment')->where('parent_id',$lesson->id)->where('type',3)->get();
            $mcq_questions=Lesson::with('Sets')->where('id',$lesson->id)->first();
            
            return view('website.my_account.lesson_details',compact('lesson','topicDocuments','topicVideos','topicArticles','mcq_questions'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function mcqGetQuestion(Request $request){
        try {
           
            $set_id = $request->set_id;
            $page = $request->page;
            $set_question = Set::with('question')->where('id', $set_id)->first();
            if (!$set_question) {
                $result = [
                    'set_name' => null,
                    'total_question' => 0,
                    'mcq_question' => [],
                ];
                $data = [
                    "code" => 200,
                    "status" => 1,
                    "message" => "No Record Found",
                    "result" => $result,
                ];
                return response()->json(['status' => 1, 'result' => $data]);
            }
            if (!$set_question->question->isEmpty()) {
                $all_questions = $set_question->question()->paginate(1);
                $options = [];
                foreach ($all_questions as $key => $question) {

                    $options[] = $question->option_1;
                    $options[] = $question->option_2;
                    $options[] = $question->option_3;
                    $options[] = $question->option_4;
                    $data = [
                        'id' => $question->id,
                        'question' => $question->question,
                        'options' => $options,
                        'correct_answer' => $question->correct_answer,

                    ];
                }

                $result = [
                    'set_name' => $set_question->set_name,
                    'total_question' => $set_question->question->count(),
                    'mcq_question' => $data,
                    'page'=>$page,
                ];
                $data = [
                    "code" => 200,
                    "status" => 1,
                    "message" => "All MCQ Questions",
                    "result" => $result,
                ];
                return response()->json(['status' => 1, 'result' => $data]);
            } else {
                $result = [
                    'set_name' => null,
                    'total_question' => 0,
                    'mcq_question' => [],
                ];
                $data = [
                    "code" => 200,
                    "status" => 1,
                    "message" => "No Record Found",
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