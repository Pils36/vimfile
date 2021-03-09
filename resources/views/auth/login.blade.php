@extends('layouts.app')

<?php $pages = 'Login'?>

@section('content')

    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h1 class="m-t-50">Vehicle Inspection & Maintenance File
                                </h1>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-5 p-b-30">

                    <div class="wrap-login100 m-t-150 p-l-55 p-r-55 p-t-65 p-b-54">
                <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <span class="login100-form-title p-b-15">
                        Login
                    </span>

                    <div class="wrap-input100 validate-input m-b-23" data-validate = "E-mail address is required">
                        <span class="label-input100">E-mail Address</span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Type your email" autofocus>
                            
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <label for="password" class="label-input100">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Type your password">
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    
                    <div class="text-right p-t-5 p-b-15">
                        @if (Route::has('ResetsPassword'))
                            <a style="font-size: 14px;" class="btn btn-link" href="{{ route('ResetsPassword') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                    
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button type="submit" class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>

                    <div class="flex-col-c p-t-25 p-b-0">
                        <span class="txt1 p-b-5">
                            Don't have an account?
                        </span>

                        <a href="{{ route('register') }}">
                            Sign Up
                        </a>
                    </div>

                    
                </form>
            </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

@endsection