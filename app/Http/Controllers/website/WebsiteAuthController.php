<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Common\Activation;
use App\Common\Type;

class WebsiteAuthController extends Controller
{
    public function signup(Request $request){
         
        $fname = $request->firstname;
        $lname = $request->lastname;
        $email = $request->email;
        $phone = $request->phone;
    

        $check_user_active = User::where([['email',$email],['role_id',Role::User],['phone',$phone],['verify_otp',1],['is_activate',1]])->exists();
        if($check_user_active){
            return response()->json(['message' => 'Oops! User already exists', 'status' => 2]);
        }else{
           
            $otp = rand(100000,999999);

            $check_otp_sent_but_user_not_verified = User::where([['email',$email],['role_id',Role::User],['phone',$phone],['verify_otp',0],['is_activate',0]])->exists();
            $check_otp_verified_but_user_not_activate = User::where([['email',$email],['role_id',Role::User],['phone',$phone],['verify_otp',1],['is_activate',0]])->exists();    
            if($check_otp_sent_but_user_not_verified){
                User::where([['email',$email],['role_id',Role::User],['phone',$phone],['verify_otp',0],['is_activate',0]])->update([
                    'otp' => $otp
                ]);

                $this->otpSend($phone, $otp);
                return response()->json(['message' => 'OTP sent successfully', 'status' => 1]);
            }else if( $check_otp_verified_but_user_not_activate){
                return response()->json(['message' => 'Oops! User already exists', 'status' => 2]);
            }else{
                $create = User::create([
                    'firstname' => $fname,
                    'lastname' => $lname,
                    'email' => $email,
                    'phone' => $phone,
                    'otp' => $otp,
                    'role_id' => Role::User,
                    'is_activate' => 0
                ]);

              
    
                $user = User::where('email',$email)->first();
    
                $userDetails = UserDetails::create([
                    'firstname' => $fname,
                    'lastname' => $lname,
                    'email' => $email,
                    'phone' => $phone,
                    'user_id' => $user->id,
                ]);

                $this->otpSend($phone, $otp);
    
                if($create && $userDetails){
                    return response()->json(['message'=> 'OTP sent successfully', 'status' => 1]);
                }else{
                    return response()->json(['message'=> 'Oops! Something went wrong', 'status' => 500]);
                }
            }

           
            


            

            
        }

    }


    public function otpSend($phone, $otp){
        $isError = 0;
        $errorMessage = true;

        //Your message to send, Adding URL encoding.
        $message = urlencode("<#> Use $otp as your verification code. The OTP expires within 10 mins. Do not share it with anyone. -regards Abhith Siksha");


        //Preparing post parameters
        $postData = array(
            'authkey' => '19403ARfxb6xCGLJ619221c6P15',
            'mobiles' => $phone,
            'message' => $message,
            'sender' => 'ABHSKH',
            'DLT_TE_ID'=> 1207164006513329391,
            'route' => 4,
            'response' => 'json'
        );

        $url = "http://login.yourbulksms.com/api/sendhttp.php";

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));
        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        //get response
        $output = curl_exec($ch);
        //Print error if any
        if (curl_errno($ch)) {
            $isError = true;
            $errorMessage = curl_error($ch);
        }
        curl_close($ch);
        if($isError){
            return array('error' => 1 , 'message' => $errorMessage);
        }else{
            return array('error' => 0 );
        }
    }





    public function verifyOtp(Request $request){
        $details = User::where([['email',$request->email],['phone',$request->phone],['verify_otp',0],['is_activate',0]])->first(); 
        if($request->otp == $details->otp){
            $details->verify_otp = 1;
            $details->save();
            return response()->json(['message' => 'OTP verified successfully', 'status' => 1]);
        }else{
            return response()->json(['message' => 'Whoops! Invalid OTP', 'status' => 2]);
        }

    }


    public function completeSignup(Request $request){
        $details = User::where([['email',$request->email],['phone',$request->phone],['verify_otp',1],['is_activate',0]])->first();
        if($details == null){
            return response()->json(['message' => 'Something went wrong. Signup failed.', 'status' => 2]);
        }else{
            $details->password = Hash::make($request->password);
            $details->is_activate = 1;
            $details->save();
            return response()->json(['message' => 'Signup successful', 'status' => 1]);
        }
    }


    public function login(Request $request){

        $email = $request->email;
        $password = $request->password;

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
       
        if (Auth::attempt(['email' => $request->email,  'password' => $request->password, 'type_id' => Type::User, 'is_activate'=> Activation::Activate ])) {
            if( $request->current_route == null ){
                
                Auth::LogoutOtherDevices($password); 
                return redirect()->route('website.dashboard');
            }else{
                return redirect($request->current_route);
            }   
        } else {
            return redirect()->back()->withErrors(['Credentials doesn\'t match with our record'])->withInput($request->input());
        }
    }

    public function logout(Request $request){

        Auth::logout();
        return redirect('');
    }
}
