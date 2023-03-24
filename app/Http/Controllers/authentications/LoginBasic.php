<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LoginRequest;
use Carbon\Carbon;
use App\Models\ResetPassword;
use App\Models\User;

class LoginBasic extends Controller
{
  /**
   * Show specified view.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  /**
   * Authenticate login user.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function customLogin(LoginRequest $request)
  {
    $email = $request->email;
    $password = $request->password;
    
    $checkLogin = User::where('email', $email)->first();
      
    if (!empty($checkLogin) && $checkLogin->is_verify == 0) {
        
        Session()->flash('error', 'Account not verified yet');
        return redirect('/login-page');
    }

    if (Auth::attempt(['email' => $email, 'password' => $password])) {
      return redirect()->intended('/')
                  ->with('success','Signed in!!');
    } else {
      return redirect('/login-page')->with('error', 'Warning: email and password do not match');
    }

  }

  /**
   * Logout user.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function logout()
  {
      Session::flush();

      Auth::logout();
      return redirect('/login-page');
  }

}
