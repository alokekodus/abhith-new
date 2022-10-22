<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\Lesson;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserCourseController extends Controller
{
    public function displayUserSubjects($order_id)
    {
        try {
            $order_id = Crypt::decrypt($order_id);
            $order = Order::find($order_id);
           
            $subjects=$order->assignSubject;
            return view('website.user.subject', compact('subjects', 'order'));
        } catch (\Throwable $th) {

            return redirect()->back();
            //throw $th;
        }
    }
    public function myLesson($order_id, $subject_id)
    {      
        try {
           

            $order_id = Crypt::decrypt($order_id);
            $subject_id = Crypt::decrypt($subject_id);
            $order = Order::find($order_id);
            visitorRecord($subject_id,$type=1);//visitor record store after login
            $subject = AssignSubject::where('assign_class_id', $order->assign_class_id)->where('board_id', $order->board_id)->where('id', $subject_id)->first();
            $lessons = Lesson::where('board_id', $order->board_id)->where('assign_class_id', $order->assign_class_id)->where('assign_subject_id', $subject_id)->where('parent_id', null)->get();
          
            return view('website.user.lesson', compact('lessons', 'order', 'subject'));
        } catch (\Throwable $th) {
         
            return redirect()->back();
            
        }
    }
}
