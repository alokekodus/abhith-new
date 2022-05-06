<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Chapter;
use App\Models\Order;
use App\Models\AssignSubject;
use Illuminate\Support\Facades\Auth;
use Yoeunes\Toastr\Facades\Toastr;

class CartController extends Controller
{
    public function index(Request $request){
        try {
            $cart = []; $countCartItem=0;  $price = [];
          if(Auth::check()){
            $cart = Cart::with('board','assignClass')->where('user_id',Auth::user()->id)->where('is_paid', 0)->where('is_remove_from_cart', 0)->get();
            $countCartItem = Cart::where('user_id',Auth::user()->id)->where('is_paid', 0)->where('is_remove_from_cart', 0)->count();
            $totalPrice=0;
            foreach($cart as $item){
                $totalPrice=$totalPrice+$item->assignClass->subjects->sum('subject_amount');
              
            }
           
        }else{
            return redirect()->back();
        }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
       
        return view('website.cart.cart')->with(['cart' => $cart, 'countCartItem' => $countCartItem, 'countPrice' =>$totalPrice  ]);
        
    }

    public function addToCart(Request $request){
        try {
                     
            if (!Auth::check()) {
                Toastr::success('please login for add the package!', '', ["positionClass" => "toast-top-right"]);
                return redirect()->route('website.login');
              
            }
            
            $board_id = $request->board_id;
            $class_id = $request->class_id;
            $is_full_course_selected = $request->is_full_course_selected;
            $check_item_exists_inside_cart = Cart::where('user_id', Auth::user()->id)->where('board_id', $board_id)->where('assign_class_id', $class_id)->where([['is_paid','=', 0], ['is_remove_from_cart','=', 0]])->exists();
                       
                if($check_item_exists_inside_cart == true){
                   
                    return redirect()->route('website.course')->with('error','Package already in Cart!');
                }else{
                  
                    $create = Cart::create([
                        'user_id' => Auth::user()->id,
                        'board_id' => $board_id,//board_id
                        'assign_class_id' => $class_id,//class_id
                        'is_full_course_selected' => $is_full_course_selected
                    ]);
                    
                } 
           
    
            return redirect()->route('website.course')->with('success','Item added to cart successfully.');
        } catch (\Throwable $th) {
            dd($th);
        }
        

    }


    public function removeFromCart(Request $request){
        if(Auth::check()){
            Cart::where('user_id', Auth::user()->id)->where('is_paid', 0)->where('chapter_id', $request->chapter_id)->update([
                'is_remove_from_cart' => 1
            ]);
            return response()->json(['message' => 'Item removed successfully']);
        }
    }
}
