<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function allPerformance()
    {
        try {
            $carts = Cart::with(['assignClass', 'board', 'assignSubject' => function ($q) {
                $q->with(['subject' => function ($qu) {
                    $qu->with(['lesson'=>function($query){
                        $query->with('topics');
                    }]);
                }]);
            }])
                ->where('user_id', auth()->user()->id)
                ->where('is_paid', 1)
                ->where('is_remove_from_cart', 1)
                ->get();
            $subject = [];
            foreach ($carts as $key => $cart) {
                foreach ($cart->assignSubject as $key => $assign_subject) {
                    $subject[] = [
                        'name' => $assign_subject->subject->subject_name,
                        'total_video' => subjectTotalVideo($assign_subject->subject->id),
                        'total_watch_video'=>subjectTotalWatchVideo($assign_subject->subject->id),
                    ];
                }
            }
            return response()->json($subject);
        } catch (\Throwable $th) {
            $data = [
                "code" => 400,
                "message" => "Something went wrong",

            ];
            return response()->json(['status' => 0, 'result' => $th]);
        }
    }
}
