<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MobileAndEmailVerification;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class MobileEmailVerificationController extends Controller
{
    public function sendMobileOtp(Request $request){
        try {
            if($request->has('phone')){
               
                $user=User::where('phone',$request->phone)->where('is_activate',1)->first();
              
                if($user!=null){
                    $data = [
                        "code" => 400,
                        "status" => 0,
                        "message" => "Oops! User already exists",
                    ];
                    return response()->json(['status' => 1, 'result' => $data]);
                }

                $validator = Validator::make($request->all(), [
                    'phone' => 'required|numeric',
                ]);
                if ($validator->fails()) {
                    return response()->json(['status' => 0, 'message' => $validator->errors()]);
                }
               
                $phone = $request->phone;
                $otp = rand(100000, 999999);
                
                $mobile_email_verification_data=MobileAndEmailVerification::where('mobile',$phone)->first();
               
                $mobileEmailVerificationData=[
                    'mobile'=>$phone,
                    'mobile_email_otp'=>$otp

                ];
                if($mobile_email_verification_data!=null){
                    $mobile_email_verification_data->update($mobileEmailVerificationData);
                    
                }else{
                    MobileAndEmailVerification::create($mobileEmailVerificationData);
                }
               
                $otpsend=otpSend($phone, $otp);
                $data=[
                    'otp'=>$otp,
                    'phone'=>$phone,
                ];
                if($otpsend){
                    $data = [
                        "code" => 200,
                        "status" => 1,
                        "message" => "Otp sent successfully",
                        'data'=>$data
                        
    
                    ];
                    return response()->json(['status' => 1, 'result' => $data]);
                }else{
                    $data = [
                        "code" => 400,
                        "status" => 0,
                        "message" => "Something went wrong",
        
                    ];
                    return response()->json(['status' => 0, 'result' => $data]);
                }
            }
           

            
        } catch (\Throwable $th) {
            $data = [
                "code" => 400,
                "status" => 0,
                "message" => "Something went wrong",

            ];
            return response()->json(['status' => 0, 'result' => $data]);
        }
    }
    public function verifyMobileOtp(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'phone' => 'required|numeric',
                'otp' => 'required|numeric',

            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()]);
            }
            
            $mobile_email_verification_data=MobileAndEmailVerification::where('mobile',$request->phone)->where('mobile_email_otp',$request->otp)->first();
            if($mobile_email_verification_data){
                $mobile_email_verification_data->update(['mobile_email_verification'=>1]);
                $data = [
                    "code" => 200,
                    "status" => 1,
                    "message" => "Your Mobile Number Verified successfully",    

                ];
                return response()->json(['status' => 1, 'result' => $data]);
            }else{
                $data = [
                    "code" => 400,
                    "status" => 0,
                    "message" => "OTP verification Miamatch",    

                ];
                return response()->json(['status' => 1, 'result' => $data]);
            }

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
