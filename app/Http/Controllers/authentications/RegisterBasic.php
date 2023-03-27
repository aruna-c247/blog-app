<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\emailVerification;

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
      $userData['status'] = 1;
      $user = User::create($userData);

      // check user is exist
      if (!empty($user->id)) {
            
        //generate token 
        $token = Str::random(64);
       
        $userData['reset_link'] = 'verification?'.'token='.$token;
        
        // send link for email verification on mail
        try {
            
          Mail::to($userData['email'])->send(new \App\Mail\NotifyRegistrationVerifyMail($userData));
            
        }catch (\Exception $ex) {
          echo $ex->getMessage(); die;
        }

        // added token in password reset table
        emailVerification::create(['user_id' => $user->id, 'token' => $token, 'is_verify'=>0]);
      }


    return redirect('thank-you');


      // auth()->login($user);

      // return redirect('/')->with('success', "Account successfully registered.");
    }

    /**
     * show error page
     */
    public function thankYou()
    {
      //return view('content.pages.pages-misc-error');
      return view('content.pages.pages-thank-you');
    }

    /**
     * show error page
     */
    public function tokenExpire()
    {
      //return view('content.pages.pages-misc-error');
      return view('content.pages.pages-token-expired');
    }

    /**
     * check token is valid function
     *
     * @param Request $request
     * @return void
     */
    public function verifyToken(Request $request)
    {
      if (!empty($request->token))
      {
        $data = emailVerification::where('token', $request->token)->first();
        
        if (!empty($data)) {
            
          // after verification update is verify and token value.
          emailVerification::where('user_id',$data->user_id)->update(['is_verify' => 1, 'updated_at' => now(), 'token' => '']);

          User::where('id', $data->user_id)->update(['is_verify' => 1, 'updated_at' => now() ]);
          
          $userData  = User::findOrFail($data->user_id);

          auth()->login($userData);
          // redirect to dashboard 
          return redirect('/');
        } 
        else {
          return redirect('token-expire');
        }
      }
    }

    // method for check the view
    /**
     * show error page
     */
    public function mailVerifyPage()
    {
      return view('email.emailVerification');
    }

    /**
     * show error page
     */
    public function mailforgotpasswordPage()
    {
      return view('email.forgotPassword');
    }
}
