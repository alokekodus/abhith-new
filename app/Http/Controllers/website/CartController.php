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
use Illuminate\Support\Facades\Crypt;

class CartController extends Controller
{
    public function index(Request $request)
    {
        try {
            $cart = [];
            $countCartItem = 0;
            $price = [];
            if (Auth::check()) {
                $carts = Cart::with('board', 'assignClass')->where('user_id', Auth::user()->id)->where('is_paid', 0)->where('is_remove_from_cart', 0)->get();
            } else {
                return redirect()->route('website.login');
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }

        return view('website.cart.cart')->with(['carts' => $carts]);
    }
    public function cartDetails($cart_id)
    {
        try {

            if (Auth::check()) {
                $cart = Cart::with('board', 'assignClass', 'assignSubject')->where('id', Crypt::decrypt($cart_id))->first();
                $all_subjects = $cart->assignSubject;
                $totalPrice = $cart->assignSubject->sum('amount');
            }
            return view('website.cart.cart-details')->with(['cart' => $cart, 'all_subjects' => $all_subjects, 'countPrice' => $totalPrice]);
        } catch (\Throwable $th) {
            Toastr::error('Something went wrong.', '', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
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
                $all_subjects = AssignSubject::whereIn('id', $request->subjects)->get();
            }

            $cart = Cart::with('assignSubject')->where([['user_id', '=', Auth::user()->id], ['assign_class_id', '=', $class_id], ['board_id', '=', $board_id], ['is_paid', '=', 0], ['is_remove_from_cart', '=', 0], ['is_full_course_selected', '=', $course_type]])->first();
            if ($cart) {
                $assignSubjectAlreadyInCart = CartOrOrderAssignSubject::whereNotIn('assign_subject_id', $request->subjects)->get();
                if ($assignSubjectAlreadyInCart->count() == 0) {
                    Toastr::error('Package already in Cart!', '', ["positionClass" => "toast-top-right"]);
                    return redirect()->back();
                } else {

                    foreach ($all_subjects as $key => $subject) {
                        $subject_already_store = CartOrOrderAssignSubject::where('cart_id', $cart['id'])->where('assign_subject_id', $all_subjects[$key]['id'])->first();
                        if ($subject_already_store) {
                            $subject_already_store->update(['amount', '=', $all_subjects[$key]['subject_amount']]);
                        } else {
                            $data = [
                                'cart_id' => $cart['id'],
                                'assign_subject_id' => $all_subjects[$key]['id'],
                                'amount' => $all_subjects[$key]['subject_amount'],
                                'type' => 1,
                            ];
                            $assign_subject = CartOrOrderAssignSubject::create($data);
                        }
                    }
                    Toastr::success('Subjects was successfully added to your cart.', '', ["positionClass" => "toast-top-right"]);
                    return redirect()->back();
                }
            } else {
                $cartstore = Cart::create([
                    'user_id' => auth()->user()->id,
                    'board_id' => $board_id, //board_id
                    'assign_class_id' => $class_id, //class_id
                    'is_full_course_selected' => $course_type,
                    'is_buy' => $request->is_buy
                ]);

                foreach ($all_subjects as $key => $subject) {
                    $data = [
                        'cart_id' => $cartstore['id'],
                        'assign_subject_id' => $all_subjects[$key]['id'],
                        'amount' => $all_subjects[$key]['subject_amount'],
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
    public function removeCart($cart_id)
    {
        try {
            $cart=Cart::find(Crypt::decrypt($cart_id));
            $cart->delete();
            $cart->assignSubject()->delete();
            Toastr::success('Cart item remove successfully.', '', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        } catch (\Throwable $th) {
            Toastr::error('Something want wrong.', '', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }

    public function removeFromCart(Request $request)
    {
        try {
            if (Auth::check()) {
                $cart = Cart::find($request->cart_id);
                $cart->update(['is_remove_from_cart' => 1]);
                $cart->assignSubject()->delete();
                return response()->json(['message' => 'Item removed successfully']);
            } else {
                return response()->json(['message' => ' Something want wrong']);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => ' Something want wrong']);
        }
    }
}
