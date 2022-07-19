<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\Cart;
use App\Models\CartOrOrderAssignSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        
        $cart = Cart::select('id','user_id','is_full_course_selected','assign_class_id','board_id','is_paid','is_remove_from_cart')
        ->with(['assignClass:id,class','board:id,exam_board','assignSubject:id,cart_id,assign_subject_id,amount','assignSubject.subject:id,subject_name'])
        ->where('user_id', Auth::user()->id)
        ->where('is_paid', 0)
        ->where('is_remove_from_cart', 0)
        ->get();
       
        if (!$cart->isEmpty()) {

            $data = [
                "code" => 200,
                "status" => 1,
                "message" => "All cart items",
                "carts"=>$cart,

            ];
            return response()->json(['status' => 1, 'result' => $data]);
        } else {
            $data = [
                "code" => 200,
                "status" => 0,
                "message" => "Your cart is empty",

            ];
            return response()->json(['status' => 0, 'result' => $data]);
        }
    }
    public function store(Request $request)
    {
        try {
            $all_subjects = $request->subjects;
            if($all_subjects==null){
                $data = [
                    "code" => 400,
                    "message" => "Please select subject",

                ];
                return response()->json(['status' => 0, 'result' => $data]);
            }
            $subject = AssignSubject::find($all_subjects[0]);
            $board_id = $subject->board_id;
            $class_id = $subject->assign_class_id;
            $course_type = $request->course_type;
            // $already_in_cart = Cart::where('user_id', auth()->user()->id)->where('board_id', $board_id)->where('assign_class_id', $class_id)->where('is_full_course_selected', 1)->get();
            // // if ($already_in_cart->count() > 0) {
            // //     $data = [
            // //         "code" => 400,
            // //         "status" => 0,
            // //         "message" => "Subjects already in cart",

            // //     ];
            // //     return response()->json(['status' => 0, 'result' => $data]);
            // // }
             
            

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
                "cart_id"=>$cart->id,
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
    public function remove($id)
    {
        try {
            $cart = Cart::find($id);
            $cart->update(['is_remove_from_cart' => 1]);
            $cart->assignSubject()->delete();
            
            $data = [
                "code" => 200,
                "status" => 1,
                "message" => "Subjects was successfully removed from your cart",

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
