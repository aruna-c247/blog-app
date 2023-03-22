<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class RegisterBasic extends Controller
{
  /**
   * Display register page.
   * 
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
  
    return view('content.authentications.auth-register-basic');
  }

  /**
   * Handle account registration request
   * 
   * @param RegisterRequest $request
   * 
   * @return \Illuminate\Http\Response
   */
    public function registerUser(RegisterRequest $request) 
    {
        
      $userData['first_name'] = $request->first_name;
      $userData['last_name'] = $request->last_name;
      $userData['email'] = $request->email;
      $userData['password'] = Hash::make($request->password);
      //$userData['password'] = Str::random( 16 );
      $user = User::create($userData);

      auth()->login($user);

      return redirect('/')->with('success', "Account successfully registered.");
    }
}
