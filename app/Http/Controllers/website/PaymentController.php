<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Chapter;
use App\Models\UserDetails;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;


class PaymentController extends Controller
{
    public function checkout(Request $request){
        $cart = []; $countCartItem=0;  $price = [];
        if(Auth::check()){
            $cart = Cart::where('user_id',Auth::user()->id)->where('is_paid', 0)->where('is_remove_from_cart',0)->get();
            $countCartItem = Cart::where('user_id',Auth::user()->id)->where('is_paid', 0)->count();
            foreach($cart as $item){
                $countPrice = Chapter::where('id', $item->chapter_id)->sum('price');
               array_push($price, $countPrice);

            }
        }
        $total_amount = array_sum($price);
        
        if($total_amount == 0){
            return redirect()->route('website.dashboard');
        }else{
            $user_detail = UserDetails::where('user_id', Auth::user()->id)->first();

            /**********************  For Razorpay  *************************/
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $orderData = [
                'receipt'         => now()->timestamp,
                'amount'          => $total_amount * 100, // 39900 rupees in paise
                'currency'        => 'INR'
            ];
        
            $razorpayOrder = $api->order->create($orderData);

            $checkout_params = [
                "key"               => env('RAZORPAY_KEY'),
                "amount"            => ($total_amount * 100),
                "name"              => "Abhith Shiksha",
                "image"             => "https://cdn.razorpay.com/logos/FFATTsJeURNMxx_medium.png",
                "prefill"           => [
                "name"              => Auth::user()->name . Auth::user()->lastname,
                "email"             => Auth::user()->email,
                "contact"           => $user_detail->phone,
                ],
                "theme"             => [
                "color"             => "#528FF0"
                ],
                "order_id"          =>  $razorpayOrder['id'],
            ];

            foreach($cart as $item){
                Order::create([
                    'user_id' => Auth::user()->id,
                    'chapter_id' => $item->chapter_id,
                    'course_id' => $item->course_id,
                    'rzp_order_id' => $razorpayOrder['id'],
                    'payment_status' => 'pending',
                ]);
            }
            

            return view('website.cart.checkout')->with(['cart' => $cart, 'countCartItem' => $countCartItem, 'countPrice' => $total_amount, 'checkoutParam' => $checkout_params]);
        }
        
    }


    public function verifyPayment(Request $request){

        if ( !empty( $request->input('razorpay_payment_id') ) ){
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $order_id = Order::where('rzp_order_id', $request->razorpay_order_id)->first();
            $order = Order::where('user_id', Auth::user()->id)->get();
            try
            {
                $attributes = [
                    'razorpay_order_id' =>  $order_id->rzp_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature
                ];
                $api->utility->verifyPaymentSignature($attributes);

                Order::where('rzp_order_id', $request->razorpay_order_id)->update([
                    'rzp_payment_id' =>  $request->razorpay_payment_id,
                    'payment_status' => 'paid',
                ]);

               foreach($order as $item){
                    Cart::where('user_id', Auth::user()->id)->where('chapter_id', $item->chapter_id)->update([
                            'is_paid' => 1,
                    ]);
               }


               return redirect()->route('website.cart')->with('success','Payment Successfull!');

            return response( $attributes);

            }
            catch(SignatureVerificationError $e)
            {
                return redirect()->route('website.cart')->with('error','Payment Failed!');
            }
        }
    }
}
