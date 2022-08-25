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
            $set=Set::with('board','assignClass','assignSubject','question')->where('id',decrypt($set_id))->first();
            return view('website.my_account.mcq_start',compact('set'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function topicDetails($topic_id){
        try {
            return view('website.my_account.lesson_details');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
