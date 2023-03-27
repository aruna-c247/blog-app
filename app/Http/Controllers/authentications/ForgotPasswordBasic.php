<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\ResetPassword;
use Carbon\Carbon;

class ForgotPasswordBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-forgot-password-basic');
  }

  /**
   * load reset password view function
   */
  public function changePassword(Request $request)
  {
    $userEmail = ResetPassword::where('token', $request->token)->first();

    //Reset password link expired after 30 minutes
    $createdAt =  ResetPassword::select('created_at')->where('token', $request->token)->first();

    $expireTime = config('auth.passwords.users.expire');

    $time = Carbon::parse($createdAt['created_at'])->addSeconds($expireTime * 60)->isPast();

    if ($time == 'true') {

      echo "Oops, The link has been expired";
      // update token null
      ResetPassword::where('email', $userEmail->email)->update(['token' => '']);
    } else {

      return view('content.authentications.auth-reset-password-page', ['token' => $request->token]);
    }
    
  }

  /**
   * function to send password link via email
   */
  public function sendResetPasswordLink(Request $request)
  {
    //reset-password
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);
    
    // check user is exist
    if (!empty($request->input('email'))) {
        
      //generate token 
      $token = Str::random(64);
      
      $data['email'] = $request->input('email');
      $data['reset_link'] = 'reset-password?'.'token='.$token;
      
      // get user data
      $userData = User::where(['email'=> $data['email'], 'status'=> 1])->first();

      $data['userFullName'] = $userData->first_name.' '.$userData->last_name;
      // send link using mail
      try {
          
          Mail::to($data['email'])->send(new \App\Mail\NotifyForgotPasswordMail($data));
          
      }catch (\Exception $ex) {
          echo $ex->getMessage(); die;
      }

      // add token in password reset table
      ResetPassword::create(['email' => $request->input('email'), 'token' => $token]);
      Session()->flash('success', "We've emailed you the link to reset your password!.");
      
    } else {
      Session()->flash('error', 'Something went wrong, Please try again!');
    }
    return redirect('/login-page');
  }

  /**
   * password update
   */
  public function updateForgotPassword(Request $request) 
  {
    $request->validate([
      'password' => 'required|same:confirm_password',
    ]);
  
    //check token
    $userEmail = ResetPassword::where('token', $request->token)->first();
    
    if (!empty($userEmail)) {
        
      //update password
      User::where('email', $userEmail->email)->update(['password' => Hash::make($request->input('password'))]);

      // update token null
      ResetPassword::where('email', $userEmail->email)->update(['token' => '']);
      Session()->flash('success', 'Your password has been changed!');

    } else {
      Session()->flash('error', 'Invalid request.'); 
     
    }
    return redirect('/login-page');
  }

}
