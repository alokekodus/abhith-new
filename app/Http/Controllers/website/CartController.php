<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Chapter;
use App\Models\Order;
use App\Models\AssignSubject;
use App\Models\CartOrOrderAssignSubject;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class CartController extends Controller
{
    public function index(Request $request)
    {
        try {
            $cart = [];
            $countCartItem = 0;
            $price = [];
            if (Auth::check()) {
                $cart = Cart::with('board', 'assignClass')->where('user_id', Auth::user()->id)->where('is_paid', 0)->where('is_remove_from_cart', 0)->get();
                $countCartItem = Cart::where('user_id', Auth::user()->id)->where('is_paid', 0)->where('is_remove_from_cart', 0)->count();
                $totalPrice = 0;
                foreach ($cart as $item) {
                    $totalPrice = $totalPrice + $item->assignSubject->sum('amount');
                }
            } else {
                return redirect()->route('website.login');
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
      
        return view('website.cart.cart')->with(['cart' => $cart, 'countCartItem' => $countCartItem, 'countPrice' => $totalPrice]);
    }

    public function addToCart(Request $request)
    {
        try {
              
            if (!Auth::check()) {

                Toastr::success('please login for add the package!', '', ["positionClass" => "toast-top-right"]);
                return redirect()->route('website.login');
            }

            $board_id = $request->board_id;
            $class_id = $request->class_id;
            $course_type = $request->course_type;
            if ($course_type == 1) {
                $all_subjects = AssignSubject::where(['board_id' => $board_id, 'assign_class_id' => $class_id, 'is_activate' => 1])->get();
            } else {
                $all_subjects = $request->subjects;
            }
           
            $check_item_exists_inside_cart = Cart::with('assignSubject')->where('user_id', Auth::user()->id)->where('board_id', $board_id)->where('assign_class_id', $class_id)->where([['is_paid', '=', 0], ['is_remove_from_cart', '=', 0]])->where('is_full_course_selected',1)->get();
           
            if ($all_subjects == null) {
                Toastr::error('Please select subject for proccess !', '', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            }
            if ($check_item_exists_inside_cart->count() > 0) {

                Toastr::error('Package already in Cart!', '', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            } else {

                $cart_check = Cart::whereHas('assignSubject', function ($q) use ($all_subjects) {
                    $q->whereIn('assign_subject_id', $all_subjects);
                })->where('board_id', $board_id)->where('assign_class_id', $class_id)->where('is_remove_from_cart',0)->where('user_id',auth()->user()->id)->where('is_buy',$request->is_buy)->first();
                
                if ($cart_check) {
                   $already_in_cart=false;
                    foreach($all_subjects as $key=>$subject){
                        $is_available=$cart_check->assignSubject()->where('assign_subject_id',$all_subjects[$key])->first();
                        
                        
                    }
                   
                    if($cart_check->is_full_course_selected==$request->course_type && $cart_check->assignSubject()->count()==count($all_subjects) && $request->is_buy==0){
                        Toastr::error('Same Subjects already on your cart.', '', ["positionClass" => "toast-top-right"]);
                        return redirect()->back();
                    }
                    $cart_check->assignSubject()->delete();
                    $cart_check->update(['is_remove_from_cart'=>1]);
                 
                }
                $cart = Cart::create([
                    'user_id' => auth()->user()->id,
                    'board_id' => $board_id, //board_id
                    'assign_class_id' => $class_id, //class_id
                    'is_full_course_selected' => $course_type,
                    'is_buy' => $request->is_buy
                ]);
                foreach ($all_subjects as $key => $subject) {


                    $subject = AssignSubject::find($all_subjects[$key]);
    
                    $data = [
                        'cart_id' => $cart->id,
                        'assign_subject_id' => $subject->id,
                        'amount' => $subject->subject_amount,
                        'type' => 1,
                    ];
                    $assign_subject = CartOrOrderAssignSubject::create($data);
                }


                Toastr::success('Subjects was successfully added to your cart.', '', ["positionClass" => "toast-top-right"]);
                return redirect()->back();


            
            }
            
        } catch (\Throwable $th) {
            
            Toastr::error('Something want wrong.', '', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }


    public function removeFromCart(Request $request)
    {
        try {
            if (Auth::check()) {
                $cart=Cart::find($request->cart_id);
                $cart->update([ 'is_remove_from_cart' => 1]);
                $cart->assignSubject()->delete();
                return response()->json(['message' => 'Item removed successfully']);
            }else{
                return response()->json(['message' => ' Something want wrong']);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => ' Something want wrong']);
        }

    }
}
