@extends('layouts/blankLayout')

@section('title', 'Reset Password - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Forgot Password -->
      <div class="card">
      @include('content/pages/flash-message')
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">@include('_partials.macros',['width'=>25,'withbg' => "#696cff"])</span>
              <span class="app-brand-text demo text-body fw-bolder">{{ config('variables.templateName') }}</span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">Reset Password? 🔒</h4>
          <p class="mb-4">Enter your Password and Confirm password to reset your password</p>
          <form id="formAuthentication" class="mb-3" action="{{ url('update-forgot-password') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <!-- <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus>
              @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
              @endif
            </div> -->
            <!-- added password and update password -->
            <div class="mb-3 form-password-toggle">
                <label for="email" class="form-label">New Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" autofocus/>
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
                @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
              @endif
            </div>
            <div class="mb-3 form-password-toggle">
                <label for="email" class="form-label">Confirm Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="confirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
                @if ($errors->has('confirm_password'))
                <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
              @endif
            </div>
            <!-- end password -->
            <button class="btn btn-primary d-grid w-100">Reset Password</button>
          </form>
          <div class="text-center">
            <a href="{{url('/login-page')}}" class="d-flex align-items-center justify-content-center">
              <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
              Back to login
            </a>
          </div>
        </div>
      </div>
      <!-- /Forgot Password -->
    </div>
  </div>
</div>
@endsection
