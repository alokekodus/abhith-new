<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\SubjectLessonVisitor;
use App\Models\UserPracticeTest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PerformanceController extends Controller
{
    public function allPerformance()
    {
        try {
            $carts = Cart::with(['assignClass', 'board', 'assignSubject' => function ($q) {
                $q->with(['subject' => function ($qu) {
                    $qu->with(['lesson' => function ($query) {
                        $query->with('topics');
                    }]);
                }]);
            }])
                ->where('user_id', auth()->user()->id)
                ->where('is_paid', 1)
                ->where('is_remove_from_cart', 1)
                ->get();
            $subjects = [];
            $total_video_count = 0;
            $total_watch_video_count = 0;
            $all_subjects=[];
            foreach ($carts as $key => $cart) {

                foreach ($cart->assignSubject as $key => $assign_subject) {
                    $all_subjects[]=[
                        'id'=>$assign_subject->subject->id,
                        'name'=>$assign_subject->subject->subject_name,
                        'board'=>$assign_subject->subject->boards->exam_board,
                        'class'=>$assign_subject->subject->assignClass->class,
                    ];
                    $subjects[] = [
                        
                        'total_video' => $total_video_count + subjectTotalVideo($assign_subject->subject->id),
                        'total_watch_video' => $total_watch_video_count + subjectTotalWatchVideo($assign_subject->subject->id),
                    ];
                }
            }
            $total_video = 0;
            $total_watch_video = 0;
            foreach ($subjects as $key => $subject) {
                $total_video = $total_video + $subject['total_video'];
                $total_watch_video = $total_watch_video + $subject['total_watch_video'];
            }
            $watched_percentage = ($total_watch_video / $total_video) * 100;
            $not_watched_percentage = ($total_video - $total_watch_video) / $total_video * 100;
            $day = date('D', strtotime('2022-09-01 01:22:15'));
            $subject_progress = [
                'watched_percentage' => round($watched_percentage),
                'not_watched_percentage' => round($not_watched_percentage),
                'subject_progress' => round($watched_percentage),
            ];

            // $all_watched_video=SubjectLessonVisitor::where('visitor_id',auth()->user()->id)->groupBy(date('D',strtotime('created_at')))->get();
            $all_watched_video_day_wises = SubjectLessonVisitor::query()
                ->where('visitor_id', auth()->user()->id)
                ->get()
                ->groupBy(function ($item) {
                    return $item->created_at->format('D');
                });

            $date = Carbon::now()->subDays(7);

            $all_watched_video_day_wises = SubjectLessonVisitor::where('created_at', '>=', $date)->get();

            $total_mon_day_watch_video = 0;
            $total_tue_day_watch_video = 0;
            $total_wed_day_watch_video = 0;
            $total_thu_day_watch_video = 0;
            $total_fri_day_watch_video = 0;
            $total_sat_day_watch_video = 0;
            $total_sun_day_watch_video = 0;



            $mon_day_watch_video = $tue_day_watch_video = $wed_day_watch_video = $thu_day_watch_video = $fri_day_watch_video = $sat_day_watch_video = $sun_day_watch_video = [];
            $mon_day_total_video_duration = $tue_day_total_video_duration = $wed_day_total_video_duration = $thu_day_total_video_duration = $fri_day_total_video_duration = $sat_day_total_video_duration = $sun_day_total_video_duration = [];
            foreach ($all_watched_video_day_wises as $key => $all_watched_video_day_wise) {
                if ($all_watched_video_day_wise->created_at->format('D') == "Mon") {
                    $mon_day_watch_video[] = $all_watched_video_day_wise->video_watch_time;
                    $mon_day_total_video_duration[] = $all_watched_video_day_wise->total_video_duration;
                }
                if ($all_watched_video_day_wise->created_at->format('D') == "Tue") {
                    $tue_day_watch_video[] = $all_watched_video_day_wise->video_watch_time;
                    $tue_day_total_video_duration[] = $all_watched_video_day_wise->total_video_duration;
                }
                if ($all_watched_video_day_wise->created_at->format('D') == "Wed") {
                    $wed_day_watch_video[] = $all_watched_video_day_wise->video_watch_time;
                    $wed_day_total_video_duration[] = $all_watched_video_day_wise->total_video_duration;
                }
                if ($all_watched_video_day_wise->created_at->format('D') == "Thu") {
                    $thu_day_watch_video[] = $all_watched_video_day_wise->video_watch_time;
                    $thu_day_total_video_duration[] = $all_watched_video_day_wise->total_video_duration;
                }
                if ($all_watched_video_day_wise->created_at->format('D') == "Fri") {
                    $fri_day_watch_video[] = $all_watched_video_day_wise->video_watch_time;
                    $fri_day_total_video_duration[] = $all_watched_video_day_wise->total_video_duration;
                }
                if ($all_watched_video_day_wise->created_at->format('D') == "Sat") {
                    $sat_day_watch_video[] = $all_watched_video_day_wise->video_watch_time;
                    $sat_day_total_video_duration[] = $all_watched_video_day_wise->total_video_duration;
                }
                if ($all_watched_video_day_wise->created_at->format('D') == "Sun") {
                    $sun_day_watch_video[] = $all_watched_video_day_wise->video_watch_time;
                    $sun_day_total_video_duration[] = $all_watched_video_day_wise->total_video_duration;
                }
            }
            // $total_rating = $subject->review()->count() * 5;
            // $rating_average = round($subject->review()->sum('rating') / $total_rating * 5);
            if (!$mon_day_total_video_duration == []) {
                $total_mon_day_watch_video = round((totalTime($mon_day_watch_video) / totalTime($mon_day_total_video_duration)) * 100);
            }
            if (!$tue_day_total_video_duration == []) {
                $total_tue_day_watch_video = round((totalTime($tue_day_watch_video) / totalTime($tue_day_total_video_duration)) * 100);
            }

            if (!$wed_day_total_video_duration == []) {
                $total_wed_day_watch_video = round((totalTime($wed_day_watch_video) / totalTime($wed_day_total_video_duration)) * 100);
            }
            if (!$thu_day_total_video_duration == []) {
                $total_thu_day_watch_video = round((totalTime($thu_day_watch_video) / totalTime($thu_day_total_video_duration)) * 100);
            }
            if (!$fri_day_total_video_duration == []) {
                $total_fri_day_watch_video = round((totalTime($fri_day_watch_video) / totalTime($fri_day_total_video_duration)) * 100);
            }
            if (!$sat_day_total_video_duration == []) {
                $total_sat_day_watch_video = round((totalTime($sat_day_watch_video) / totalTime($sat_day_total_video_duration)) * 100);
            }
            if (!$sun_day_total_video_duration == []) {
                $total_sun_day_watch_video = round((totalTime($sun_day_watch_video) / totalTime($sun_day_total_video_duration)) * 100);
            }
            $time_spent = [
                'Mon' => $total_mon_day_watch_video,
                'Tue' => $total_tue_day_watch_video,
                'Wed' => $total_wed_day_watch_video,
                'Thu' => $total_thu_day_watch_video,
                'Fri' => $total_fri_day_watch_video,
                'Sat' => $total_sat_day_watch_video,
                'Sun' => $total_sun_day_watch_video,
            ];

            //MCQ test performance

            $user_practice_tests = UserPracticeTest::with('userPracticeTestAnswer')->where('user_id', auth()->user()->id)->get();
            if($user_practice_tests->count()>0){
                foreach( $user_practice_tests as $key=>$user_practice_tests){

                }
            }
            // $update_user_practice_test_store =
            //     [
            //         'total_attempts' => $user_practice_test->UserPracticeTestAnswer->count(),
            //         'total_correct_count' => $user_practice_test->correctAnswer->count(),
            //     ];
            // $user_practice_test->update($update_user_practice_test_store);
            // $attempted_question = $user_practice_test->userPracticeTestAnswer->count();
            // $correct_attempted = $user_practice_test->correctAnswer->count();
            // $analysis_on_attempted_question = ($correct_attempted / $attempted_question) * 100;

            $data = [
                'all_subjects'=>$all_subjects,
                'subject_progress' => $subject_progress,
                'time_spent' => $time_spent,
            ];
            return response()->json(['status' => 1, 'result' => $data]);
        } catch (\Throwable $th) {
            $data = [
                "code" => 400,
                "message" => "Something went wrong",

            ];
            return response()->json(['status' => 0, 'result' => $data]);
        }
    }
}
