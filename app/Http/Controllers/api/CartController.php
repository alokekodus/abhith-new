<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\Cart;
use App\Models\CartOrOrderAssignSubject;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        try {
            
            $board_id = $request->board_id;
            $class_id = $request->class_id;
            $course_type = $request->course_type;
            $already_in_cart=Cart::where('user_id',auth()->user()->id)->where('board_id',$board_id)->where('assign_class_id',$class_id)->where('is_full_course_selected',1)->get();
            if($already_in_cart->count()>0){
                $data = [
                    "code" => 400,
                    "status" => 0,
                    "message" => "Subjects already in cart",
    
                ];
                return response()->json(['status' => 0, 'result' => $data]);
            }
            if ($course_type == 1) {
                $all_subjects = AssignSubject::where(['board_id' => $board_id, 'assign_class_id' => $class_id, 'is_activate' => 1])->get();
            } else {
                $all_subjects = $request->subjects;
            }

                $cart = Cart::create([
                    'user_id' => auth()->user()->id,
                    'board_id' => $board_id, //board_id
                    'assign_class_id' => $class_id, //class_id
                    'is_full_course_selected' => $course_type
                ]);
                
                foreach ($all_subjects as $key => $subject) {
                   
                    if ($course_type == 1) {
                        $subject = AssignSubject::find($subject->id);
                    } else {
                       
                        $subject = AssignSubject::find($all_subjects[$key]);
                    }
                    $data = [
                        'cart_id' => $cart->id,
                        'assign_subject_id' => $subject->id,
                        'amount' => $subject->subject_amount,
                        'type' => 1,
                    ];
                    $assign_subject = CartOrOrderAssignSubject::create($data);
                }
                $data = [
                    "code" => 200,
                    "status" => 1,
                    "message" => "Subjects was successfully added to your cart",

                ];
                return response()->json(['status' => 1, 'result' => $data]);
            
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
