<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LoginRequest;

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
        // if (!\Auth::attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ])) {
        //     throw new \Exception('Wrong email or password.');
        // }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')
                        ->with('success','Signed in!!');
        }
  
        return redirect('/login-page')->with('error','Login details are not valid');
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
