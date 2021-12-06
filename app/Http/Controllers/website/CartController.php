<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Chapter;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request){
        $cart = []; $countCartItem=0;  $price = [];
        if(Auth::check()){
            $cart = Cart::with('course', 'chapter')->where('user_id',Auth::user()->id)->where('is_paid', 0)->where('is_remove_from_cart', 0)->get();
            $countCartItem = Cart::where('user_id',Auth::user()->id)->where('is_paid', 0)->where('is_remove_from_cart', 0)->count();
            foreach($cart as $item){
                $countPrice = Chapter::where('id', $item->chapter_id)->sum('price');
               array_push($price, $countPrice);

            }
            
        }
        return view('website.cart.cart')->with(['cart' => $cart, 'countCartItem' => $countCartItem, 'countPrice' =>  array_sum($price)]);
        
    }

    public function addToCart(Request $request){

        $course_id = $request->course_id;
        $chapter_id = $request->chapter_id;
        $is_full_course_selected = $request->is_full_course_selected;

        foreach($chapter_id as $key => $item){
            $check_item_exists_inside_cart = Cart::where('user_id', Auth::user()->id)->where('chapter_id', $chapter_id[$key])->where([['is_paid','=', 0], ['is_remove_from_cart','=', 0]])->exists();
            if($check_item_exists_inside_cart == true){
                return response()->json(['message' => "Chapter already exists inside cart."]);;
            }else{
                $create = Cart::create([
                    'user_id' => Auth::user()->id,
                    'course_id' => $course_id,
                    'chapter_id' => $item,
                    'is_full_course_selected' => $is_full_course_selected
                ]);
                
            } 
        }

        return response()->json(['message' => "Item added to cart successfully." , 'status' => 1]);

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
