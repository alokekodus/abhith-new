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
    public function cartDetails(){
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
        }
        return view('website.cart.cart-details')->with(['cart' => $cart, 'countCartItem' => $countCartItem, 'countPrice' => $totalPrice]);
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
            dd($all_subjects);
            
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
