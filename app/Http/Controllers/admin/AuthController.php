<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Common\Role;
use App\Common\Type;
use App\Models\User;

class AuthController extends Controller
{
  //
  protected function customLogin(Request $request)
  {
    try {
    
        $request->validate([
          'email' => 'required',
          'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email,  'password' => $request->password])) {

          if (Auth::user()->type_id == 1 || Auth::user()->type_id == 3) {
            return redirect()->route('admin.dashboard')
              ->withSuccess('Signed in');
          } else {
            return redirect()->back()->withErrors(['Credentials doesn\'t match with our record'])->withInput($request->input());
          }
        } else {
          return redirect()->back()->withErrors(['Credentials doesn\'t match with our record'])->withInput($request->input());
        }
      
    } catch (\Throwable $th) {
      //throw $th;
    }
  }

  protected function login()
  {
    # code...
    return redirect(route('login'));
  }

  protected function logout()
  {
    Auth::logout();
    return redirect()->route('login');
  }
}
