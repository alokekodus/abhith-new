<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserCourseController extends Controller
{
    public function displayUserSubjects($order_id){
        try {
            $order_id=Crypt::decrypt($order_id);
            $order=Order::find($order_id);
            if($order->is_full_course_selected==1){
               $subjects=AssignSubject::where('assign_class_id',$order->assign_class_id)->where('board_id',$order->board_id)->get();
            }
            return view('website.user.subject',compact('subjects','order'));
         } catch (\Throwable $th) {

            return redirect()->back();
             //throw $th;
         }
    }
}
