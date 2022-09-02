<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\SubjectLessonVisitor;
use Illuminate\Http\Request;

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
            foreach ($carts as $key => $cart) {

                foreach ($cart->assignSubject as $key => $assign_subject) {

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
            $data = [
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
            
           
            foreach ($all_watched_video_day_wises as $key => $watched_video_days) {
                $day_wise_video_watch=[];
                foreach($watched_video_days as $key=>$watched_video){
                    $day_wise_video_watch[]=$watched_video->created_at;
                }
              
            }
            return response()->json(['status' => 1, 'result' => $day_wise_video_watch]);
        } catch (\Throwable $th) {
            $data = [
                "code" => 400,
                "message" => "Something went wrong",

            ];
            return response()->json(['status' => 0, 'result' => $th]);
        }
    }
}
