<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Common\Role;
use App\Common\Activation;

class WebsiteAuthController extends Controller
{
    public function signup(Request $request){

        $fname = $request->fname;
        $lname = $request->lname;
        $email = $request->email;
        $password = $request->password;
        $confirm_pwd = $request->confirm_pwd;


        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'password' => 'required | min:5 | confirmed',
        ]);

        $check_email_exists = User::where([['email',$email],['role_id',Role::User]])->exists();
        if($check_email_exists){
            return response()->json(['message' => 'Oops! Email already exists', 'status' => 403]);
        }else{

            $create = User::create([
                'firstname' => $fname,
                'lastname' => $lname,
                'email' => $email,
                'role_id' => Role::User,
                'password' => Hash::make($password)
            ]);

            $user = User::where('email',$email)->first();

            $userDetails = UserDetails::create([
                'firstname' => $fname,
                'lastname' => $lname,
                'email' => $email,
                'user_id' => $user->id,
            ]);

            if($create && $userDetails){
                return response()->json(['message'=> 'Signup Successful', 'status' => 201]);
            }else{
                return response()->json(['message'=> 'Oops! Something went wrong', 'status' => 500]);
            }
        }

    }


    public function login(Request $request){

        $email = $request->email;
        $password = $request->password;

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
       
        if (Auth::attempt(['email' => $request->email,  'password' => $request->password, 'role_id' => Role::User, 'is_activate'=> Activation::Activate ])) {
            if( $request->current_route == null ){
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
