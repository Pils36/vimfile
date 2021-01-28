@extends('layouts.app')

@section('text/css')

<?php use \App\Http\Controllers\MinimumDiscount; ?>

<style>
    .banner_parts{
        height: 40% !important;
    }
    .box{
        border: 1px solid #14485f;
        padding: 10px 5px;
        border-radius: 10px;
    }
    #pills-tab li a.active{
        background-color: #14485f;
    }
    #pills-tab li a{
        font-weight: bold;
        text-transform: uppercase;
        border: 1px solid #14485f;
    }
    input, select{
        font-size: 13px !important;
    }
</style>

@show

<?php $pages = 'Register'?>


@section('content')

    <!-- banner part start-->
    <section class="banner_parts">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h1 class="m-t-150" style="color: #fff; font-weight: bold; text-align: center;">See BusyWrench in Action. Try for FREE for 30days</h1>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->
    <br><br>
    <div class="container">
        
        <div class="box">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          {{-- <li class="nav-item">
            <a class="nav-link active" id="personal-tab" data-toggle="pill" href="#personal" role="tab" aria-controls="personal" aria-selected="true"><img src="https://img.icons8.com/cotton/64/000000/personal-growth.png" style="width: 30px; height: 30px;"> Personal Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ser" id="business-tab" data-toggle="pill" href="#business" role="tab" aria-controls="business" aria-selected="false"><img src="https://img.icons8.com/cotton/64/000000/business.png" style="width: 30px; height: 30px;"> Business Account</a>
          </li>
 --}}
          <li class="nav-item">
            <a class="nav-link serAcc" id="autocare-tab" data-toggle="pill" href="#autocare" role="tab" aria-controls="autocare" aria-selected="false"><img src="https://img.icons8.com/color/48/000000/car-badge.png" style="width: 30px; height: 30px;"> Professional Mechanics Account</a>
          </li>
          
        </ul>
        <hr>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade disp-0" id="personal" role="tabpanel" aria-labelledby="personal-tab">


            {{-- Start Personal Account Split --}}


  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-noncom-tab" data-toggle="pill" href="#pills-noncom" role="tab" aria-controls="pills-noncom" aria-selected="true"><img src="https://img.icons8.com/color/48/000000/f1-race-car-side-view.png" style="width: 30px; height: 30px;"> Non-Commercial</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-com-tab" data-toggle="pill" href="#pills-com" role="tab" aria-controls="pills-com" aria-selected="false"><img src="https://img.icons8.com/cotton/50/000000/uber-taxi.png" style="width: 30px; height: 30px;"> Commercial</a>
  </li>
</ul>
<hr>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-noncom" role="tabpanel" aria-labelledby="pills-noncom-tab">
    
    {{-- Start Non-Commercial --}}

                  {{-- Start Personal Account Tab Panes --}}

              <form method="POST" action="{{ route('register') }}" id="register">
                  @csrf

                <div class="row">
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Firstname') }}</h6><br>
                      <input id="firstnameez" type="text" class="form-control @error('firstnameez') is-invalid @enderror" name="firstname" value="{{ old('firstnameez') }}" required autocomplete="firstnameez" placeholder="Enter your firstname" autofocus>

                            @error('firstnameez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Lastname') }}</h6><br>
                      <input id="lastnameez" type="text" class="form-control @error('lastnameez') is-invalid @enderror" name="lastname" value="{{ old('lastnameez') }}" required autocomplete="lastnameez" placeholder="Enter your firstname" autofocus>

                            @error('lastnameez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>
              <div class="row">
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('E-Mail Address') }}</h6><br>
                      <input id="emaileez" type="email" class="form-control @error('emaileez') is-invalid @enderror" name="email" value="{{ old('emaileez') }}" required autocomplete="emaileez" placeholder="E-Mail Address" autofocus>

                            @error('emaileez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Phone Number') }}</h6><br>
                      <input id="phone_numbereez" type="text" class="form-control @error('phone_numbereez') is-invalid @enderror" name="phone_number" value="{{ old('phone_numbereez') }}" required autocomplete="phone_numbereez" placeholder="Phone Number" autofocus>

                            @error('phone_numbereez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>              
              <br>
              <div class="row">
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Vehicle Licence') }}</h6><br>
                      <input id="vehicle_licenceA" type="text" class="form-control @error('vehicle_licenceA') is-invalid @enderror" name="vehicle_licence" value="{{ old('vehicle_licenceA') }}" required autocomplete="vehicle_licenceA" placeholder="Vehicle Licence" autofocus>

                            @error('vehicle_licenceA')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Vehicle Nickname') }}</h6><br>
                      <input id="vehicle_nicknameA" type="text" class="form-control @error('vehicle_nicknameA') is-invalid @enderror" name="vehicle_nickname" value="{{ old('vehicle_nicknameA') }}" required autocomplete="vehicle_nicknameA" placeholder="Vehicle Nickname" autofocus>

                            @error('vehicle_nicknameA')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>

                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Vehicle Make') }}</h6><br>
                      <input id="vehicle_makeA" type="text" class="form-control @error('vehicle_makeA') is-invalid @enderror" name="vehicle_make" value="{{ old('vehicle_makeA') }}" required autocomplete="vehicle_makeA" placeholder="Vehicle Make" autofocus>

                            @error('vehicle_makeA')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>

                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Vehicle Model') }}</h6><br>
                      <input id="vehicle_modelA" type="text" class="form-control @error('vehicle_modelA') is-invalid @enderror" name="vehicle_licence" value="{{ old('vehicle_modelA') }}" required autocomplete="vehicle_modelA" placeholder="Vehicle Model" autofocus>

                            @error('vehicle_modelA')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>

              <br>              

              <div class="row">
                  <div class="col-md-4">
                      <h6><span style="color: red;">*</span> {{ __('Purchase Type') }}</h6><br>
                      <select class="form-control" name="purchase_typeA" id="purchase_typeA">
                        <option value="">Select Option</option>
                        <option value="New from Dealer">New from Dealer</option>
                        <option value="Used from Dealer">Used from Dealer</option>
                        <option value="Private Individual">Private Individual</option>
                        <option value="Leased">Leased</option>
                        <option value="Gift">Gift</option>
                        <option value="Others">Others</option>
                    </select>

                            @error('purchase_typeA')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-4">
                      <h6><span style="color: red;">*</span> {{ __('Year Owned Since') }}</h6><br>
                      <select class="form-control" name="year_owned_sinceA" id="year_owned_sinceA">
                        <?php $start = '1836'; $end = date('Y');?>
                        @for($i = $start; $i<=$end; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>

                            @error('year_owned_sinceA')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-4">
                      <h6><span style="color: red;">*</span> {{ __('Mileage') }}</h6><br>
                      <input id="current_mileageA" type="text" class="form-control @error('current_mileageA') is-invalid @enderror" name="vehicle_licence" value="{{ old('current_mileageA') }}" required autocomplete="current_mileageA" placeholder="Current Mileage" autofocus>

                            @error('current_mileageA')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>

              <br>
              <div class="row">
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Country') }}</h6><br>
                      <select id="countryeez" class="form-control @error('countryeez') is-invalid @enderror" name="country" value="{{ old('countryeez') }}" autocomplete="countryeez"></select>

                            @error('countryeez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('State/Province') }}</h6><br>
                      <select id="stateez" class="form-control @error('stateez') is-invalid @enderror" name="state" value="{{ old('stateez') }}" required autocomplete="stateez"></select>

                            @error('stateez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('City') }}</h6><br>
                      <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" autocomplete="city" placeholder="City">

                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>

                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Zip code') }}</h6><br>
                      <input type="text" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ old('zipcode') }}" autocomplete="zipcode" placeholder="Zip Code" id="zipcode">

                            @error('zipcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Password') }}</h6><br>
                      <input id="passwordeez" type="password" class="form-control @error('passwordeez') is-invalid @enderror" name="password" value="{{ old('passwordeez') }}" autocomplete="passwordeez" placeholder="Password" >

                            @error('passwordeez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Confirm Password') }}</h6><br>
                      <input id="password-confirmeez" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                  </div>
              </div>

              <br>
              <div class="row">
                  <div class="col-md-12">
                      <h6> {{ __('How did you know about us?') }}</h6><br>
                      <select class="form-control" id="know_about1" name="know_about">
                            <option value="">Select an option</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Instagram">Instagram</option>
                            <option value="Twitter">Twitter</option>
                            <option value="Friends">Friends</option>
                            <option value="Invite Email">Invite Email</option>
                        </select>
                  </div>
              </div>

              <br>
              <div class="row">
                <div class="col-md-6 disp-0">
                      <h6><span style="color: red;">*</span> {{ __('Kindly select your type of account') }}</h6><br>
                      <input type="hidden" name="userType" id="userType" value="Individual">
                  </div>

                      <div class="col-md-12 ref1 disp-0">
                          <h6>{{ __('Referral Code') }} (Optional)</h6><br>
                          <input type="text" name="referred_by" id="referred_by" class="form-control" placeholder="Referral Code">
                      </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">
                      <h6> {{ __('Security Question') }}</h6><br>
                      <input id="maiden_nameez" type="text" class="form-control @error('maiden_nameez') is-invalid @enderror" name="maiden_name" value="{{ old('maiden_nameez') }}" autocomplete="maiden_nameez" placeholder="Security Question" >

                            @error('maiden_nameez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>

                    <div class="col-md-6">
                      <h6> {{ __('Security Answer') }}</h6><br>
                      <input id="parent_meeteez" type="text" class="form-control" name="parent_meet" required autocomplete="parent_meeteez" placeholder="Security Answer">

                            @error('parent_meeteez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
              </div>
              <br>
              <div class="row">
                  <div class="col-md-12">
                      <h6> {{ __('Select A Plan') }}</h6><br>
                      <select class="form-control" id="plan" name="plan">
                            <option value="">Select an option</option>
                            <option value="Free">Free</option>
                            <option value="Lite">Lite</option>
                        </select>
                  </div>
              </div>
              
              
              <br>
              <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button type="button" class="login100-form-btn" id="signupfree" onclick = "authCheck('individual')">
                            Sign Up for FREE
                        </button>
                    </div>

                    <p>Already have an account? <a href="{{ route('login') }}" style="text-decoration: underline; color: blue;">Click to Login</a></p>
                </div>


              </form>
              

              {{-- End Personal Account Tab Panes --}}


    {{-- End Non-Commercial --}}



  </div>

  <div class="tab-pane fade disp-0" id="pills-com" role="tabpanel" aria-labelledby="pills-com-tab">
    
    {{-- Start Commercial --}}

                  {{-- Start Personal Account Tab Panes --}}

              <form method="POST" action="{{ route('register') }}" id="registercom">
                  @csrf

                <div class="row">
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Firstname') }}</h6><br>
                      <input id="firstnameezcom" type="text" class="form-control @error('firstnameez') is-invalid @enderror" name="firstname" value="{{ old('firstnameez') }}" required autocomplete="firstnameez" placeholder="Enter your firstname" autofocus>

                            @error('firstnameez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Lastname') }}</h6><br>
                      <input id="lastnameezcom" type="text" class="form-control @error('lastnameez') is-invalid @enderror" name="lastname" value="{{ old('lastnameez') }}" required autocomplete="lastnameez" placeholder="Enter your firstname" autofocus>

                            @error('lastnameez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>
              <div class="row">
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('E-Mail Address') }}</h6><br>
                      <input id="emaileezcom" type="email" class="form-control @error('emaileez') is-invalid @enderror" name="email" value="{{ old('emaileez') }}" required autocomplete="emaileez" placeholder="E-Mail Address" autofocus>

                            @error('emaileez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Phone Number') }}</h6><br>
                      <input id="phone_numbereezcom" type="text" class="form-control @error('phone_numbereez') is-invalid @enderror" name="phone_number" value="{{ old('phone_numbereez') }}" required autocomplete="phone_numbereez" placeholder="Phone Number" autofocus>

                            @error('phone_numbereez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>

              </div>

              <br>
              <div class="row">
                    <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Vehicle Licence') }}</h6><br>
                      <input id="vehicle_licenceB" type="text" class="form-control @error('vehicle_licenceB') is-invalid @enderror" name="vehicle_licence" value="{{ old('vehicle_licenceB') }}" required autocomplete="vehicle_licenceB" placeholder="Vehicle Licence" autofocus>

                            @error('vehicle_licenceB')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Vehicle Nickname') }}</h6><br>
                      <input id="vehicle_nicknameB" type="text" class="form-control @error('vehicle_nicknameB') is-invalid @enderror" name="vehicle_nickname" value="{{ old('vehicle_nicknameB') }}" required autocomplete="vehicle_nicknameB" placeholder="Vehicle Nickname" autofocus>

                            @error('vehicle_nicknameB')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Vehicle Make') }}</h6><br>
                      <input id="vehicle_makeB" type="text" class="form-control @error('vehicle_makeB') is-invalid @enderror" name="vehicle_make" value="{{ old('vehicle_makeA') }}" required autocomplete="vehicle_makeB" placeholder="Vehicle Make" autofocus>

                            @error('vehicle_makeB')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Vehicle Model') }}</h6><br>
                      <input id="vehicle_modelB" type="text" class="form-control @error('vehicle_modelB') is-invalid @enderror" name="vehicle_licence" value="{{ old('vehicle_modelB') }}" required autocomplete="vehicle_modelB" placeholder="Vehicle Model" autofocus>

                            @error('vehicle_modelB')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>

              <br>              

              <div class="row">
                  <div class="col-md-4">
                      <h6><span style="color: red;">*</span> {{ __('Purchase Type') }}</h6><br>
                      <select class="form-control" name="purchase_typeB" id="purchase_typeB">
                        <option value="">Select Option</option>
                        <option value="New from Dealer">New from Dealer</option>
                        <option value="Used from Dealer">Used from Dealer</option>
                        <option value="Private Individual">Private Individual</option>
                        <option value="Leased">Leased</option>
                        <option value="Gift">Gift</option>
                        <option value="Others">Others</option>
                    </select>

                            @error('purchase_typeB')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-4">
                      <h6><span style="color: red;">*</span> {{ __('Year Owned Since') }}</h6><br>
                      <select class="form-control" name="year_owned_sinceB" id="year_owned_sinceB">
                        <?php $start = '1836'; $end = date('Y');?>
                        @for($i = $start; $i<=$end; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>

                            @error('year_owned_sinceB')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-4">
                      <h6><span style="color: red;">*</span> {{ __('Mileage') }}</h6><br>
                      <input id="current_mileageB" type="text" class="form-control @error('current_mileageB') is-invalid @enderror" name="vehicle_licence" value="{{ old('current_mileageB') }}" required autocomplete="current_mileageB" placeholder="Current Mileage" autofocus>

                            @error('current_mileageB')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>

              <br>
              <div class="row">
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Country') }}</h6><br>
                      <select id="countryeezcom" class="form-control @error('countryeez') is-invalid @enderror" name="country" value="{{ old('countryeez') }}" autocomplete="countryeez"></select>

                            @error('countryeez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('State/Province') }}</h6><br>
                      <select id="stateezcom" class="form-control @error('stateez') is-invalid @enderror" name="state" value="{{ old('stateez') }}" required autocomplete="stateez"></select>

                            @error('stateez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('City') }}</h6><br>
                      <input id="citycom" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" autocomplete="city" placeholder="City">

                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>

                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Zip code') }}</h6><br>
                      <input type="text" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ old('zipcode') }}" autocomplete="zipcode" placeholder="Zip Code" id="zipcodecom">

                            @error('zipcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Password') }}</h6><br>
                      <input id="passwordeezcom" type="password" class="form-control @error('passwordeez') is-invalid @enderror" name="password" value="{{ old('passwordeez') }}" autocomplete="passwordeez" placeholder="Password" >

                            @error('passwordeez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Confirm Password') }}</h6><br>
                      <input id="password-confirmeezcom" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                  </div>
              </div>
              <br>
              <div class="row">
                  <div class="col-md-12">
                      <h6> {{ __('How did you know about us?') }}</h6><br>
                      <select class="form-control" id="know_about2" name="know_about">
                            <option value="">Select an option</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Instagram">Instagram</option>
                            <option value="Twitter">Twitter</option>
                            <option value="Friends">Friends</option>
                            <option value="Invite Email">Invite Email</option>
                        </select>
                  </div>
              </div>

              <br>
              <div class="row">
                <div class="col-md-6 disp-0">
                      <h6><span style="color: red;">*</span> {{ __('Kindly select your type of account') }}</h6><br>
                      <input type="hidden" name="userType" id="userTypecom" value="Commercial">
                  </div>

                      <div class="col-md-12 ref2 disp-0">
                          <h6>{{ __('Referral Code') }} (Optional)</h6><br>
                          <input type="text" name="referred_by" id="referred_bycom" class="form-control" placeholder="Referral Code">
                      </div>
              </div>
            <br>
            
              <div class="row">
                <div class="col-md-6">
                      <h6> {{ __('Security Question') }}</h6><br>
                      <input id="maiden_nameezcom" type="text" class="form-control @error('maiden_nameez') is-invalid @enderror" name="maiden_name" value="{{ old('maiden_nameez') }}" autocomplete="maiden_nameez" placeholder="Security Question" >

                            @error('maiden_nameez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>

                    <div class="col-md-6">
                      <h6> {{ __('Security Answer') }}</h6><br>
                      <input id="parent_meeteezcom" type="text" class="form-control" name="parent_meet" required autocomplete="parent_meeteez" placeholder="Security Answer">

                            @error('parent_meeteez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
              </div>
              <br>
              <div class="row dropPlan">
                  <div class="col-md-12">
                      <h6> {{ __('Select A Plan') }}</h6><br>
                      <select class="form-control" id="plancom" name="plan">
                            <option value="">Select an option</option>
                            <option value="Free">Free</option>
                            <option value="Commercial">Commercial</option>
                        </select>
                  </div>
              </div>
              <br>
              <div class="market_box">
                  <div class="row">
                    <div class="col-md-12">
                          <h6><span style="color: red;">*</span> {{ __('Who do you drive with?. Hold cntrl + click to select multiple') }}</h6><br>
                          <select class="form-control" style="padding: 7px !important;" name="market_place[]" id="market_place" multiple="">
                            <option value="Lyft">Lyft</option>
                            <option value="Uber">Uber</option>
                            <option value="Taxify">Taxify</option>
                            <option value="Others">Other</option>
                        </select>
                      </div>
                  </div>
              </div>
              <br>
              <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button type="button" class="login100-form-btn" id="signupcomfree" onclick = "authCheck('commercial')">
                            Sign Up for FREE
                        </button>
                    </div>

                    <p>Already have an account? <a href="{{ route('login') }}" style="text-decoration: underline; color: blue;">Click to Login</a></p>
                </div>


              </form>
              

              {{-- End Personal Account Tab Panes --}}


    {{-- End Commercial --}}


  </div>
</div>


            {{-- End Personal Account Split --}}



          </div>



          <div class="tab-pane fade disp-0" id="business" role="tabpanel" aria-labelledby="business-tab">


            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="pills-corporate-tab" data-toggle="pill" href="#pills-corporate" role="tab" aria-controls="pills-corporate" aria-selected="true"><img src="https://img.icons8.com/color/48/000000/reseller.png" style="width: 30px; height: 30px;"> Corporate</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pills-autodealers-tab" data-toggle="pill" href="#pills-autodealers" role="tab" aria-controls="pills-autodealers" aria-selected="false"><img src="https://img.icons8.com/office/50/000000/key-exchange.png" style="width: 30px; height: 30px;"> Auto Dealers</a>
              </li>
            </ul>
            <hr>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-corporate" role="tabpanel" aria-labelledby="pills-corporate-tab">
                
                {{-- Start Corporate Business Tab --}}
            <form method="POST" action="{{ route('register') }}">
                        @csrf

                <div class="row">
                    <div class="col-md-12 disp-0">
                        <h6><span style="color: red;">*</span> {{ __('Kindly select your type of account') }}</h6><br>
                        <input type="hidden" name="" class="form-control" id="accountType" value="Business">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h6><span style="color: red;">*</span> {{ __('What is the size of your employee') }}</h6><br>
                        <select class="form-control" id="employeeSize" required>
                            <option value="">Select employee size</option>
                            <option value="1">1</option>
                            <option value="2-10">2-10</option>
                            <option value="11-20">11-20</option>
                            <option value="21-30">21-30</option>
                            <option value="31-40">31-40</option>
                            <option value="41-50">41-50</option>
                            <option value="50 Above">50 Above</option>
                        </select>

                        <input type="hidden" name="userType" id="userTypebis" value="Business">
                        <input type="hidden" name="userID" id="userID" value="<?php echo "VIM_".time(); ?>">
                        <input type="hidden" name="busID" id="busID" value="<?php echo "VIM_".mt_rand(1000, 10000); ?>">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h6><span style="color: red;">*</span> {{ __('Name of Company') }}</h6><br>
                        <input id="name_of_company" type="text" class="form-control @error('name_of_company') is-invalid @enderror" name="name_of_company" value="{{ old('name_of_company') }}" required autocomplete="name_of_company" placeholder="Company name" >

                            @error('name_of_company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h6><span style="color: red;">*</span> {{ __('Address') }}</h6><br>
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" placeholder="Company Address">

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Country') }}</h6><br>
                      <select id="countryz" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country"></select>

                            @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('State/Province') }}</h6><br>
                      <select id="statez" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}" required autocomplete="state"></select>

                            @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('City') }}</h6><br>
                      <input id="cityz" type="text" class="form-control @error('cityz') is-invalid @enderror" name="city" value="{{ old('cityz') }}" required autocomplete="city" placeholder="City">

                            @error('cityz')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>

                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Zip code') }}</h6><br>
                      <input type="text" class="form-control @error('zipcodez') is-invalid @enderror" name="zipcodez" value="{{ old('zipcodez') }}" autocomplete="zipcodez" placeholder="Zip Code" id="zipcodez">

                            @error('zipcodez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                </div>
                <hr>
                <h4><i class="fa fa-user"></i> {{ __('Contact Person') }}</h4><hr>
                <div class="row">
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Firstname') }}</h6><br>
                      <input id="firstnamez" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" autocomplete="firstname" placeholder="Firstname" >

                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Lastname') }}</h6><br>
                      <input id="lastnamez" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" autocomplete="lastname" placeholder="Lastname">

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>
              <div class="row">
                  <div class="col-md-12">
                      <h6><span style="color: red;">*</span> {{ __('Preferred Username') }}</h6><br>
                      <input id="usernamez" type="text" class="form-control @error('usernamez') is-invalid @enderror" name="usernamez" value="{{ old('usernamez') }}" autocomplete="usernamez" placeholder="Username" >

                            @error('usernamez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>
              <div class="row">
                  <div class="col-md-12">
                      <h6><span style="color: red;">*</span> {{ __('Position') }}</h6><br>
                      <input id="position" type="text" class="form-control @error('position') is-invalid @enderror" name="position" value="{{ old('position') }}" autocomplete="position" placeholder="Position" >

                            @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>

              

              <div class="row">
                  <div class="col-md-12">
                      <h6><span style="color: red;">*</span> {{ __('E-Mail Address') }}</h6><br>
                      <input id="emailz" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="E-mail">

                            @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>

              <div class="row">
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Password') }}</h6><br>
                      <input id="passwordz" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autocomplete="password" placeholder="Password" >

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Confirm Password') }}</h6><br>
                      <input id="password-confirmz" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                  </div>
              </div>
              <br>
                <div class="row">
                  <div class="col-md-4">
                      <h6><span style="color: red;">*</span> {{ __('Telephone') }}</h6><br>
                      <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" autocomplete="telephone" placeholder="Telephone" >

                            @error('telephone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-4">
                      <h6>{{ __('Mobile') }}</h6><br>
                      <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" autocomplete="mobile" placeholder="Mobile">

                            @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-4">
                      <h6>{{ __('Office') }}</h6><br>
                      <input id="office" type="text" class="form-control @error('office') is-invalid @enderror" name="office" value="{{ old('office') }}" autocomplete="office" placeholder="Office">

                            @error('office')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>

                </div>
                 <hr>
                <h4> <i class="fa fa-lock"></i> {{ __('Answer security question below') }}</h4><br>

                <div class="row">
                  <div class="col-md-6">
                      <h6> {{ __('Security Question') }}</h6><br>
                      <input id="maiden_namez" type="text" class="form-control @error('maiden_namez') is-invalid @enderror" name="maiden_name" value="{{ old('maiden_namez') }}" autocomplete="maiden_namez" placeholder="Security Question" >

                            @error('maiden_namez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-6">
                      <h6>{{ __('Security Answer') }}</h6><br>
                      <input id="parent_meetz" type="text" class="form-control" name="parent_meet" required autocomplete="parent_meetz" placeholder="Security Answer">

                            @error('parent_meetz')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>

              <div class="row">
                  <div class="col-md-12">
                      <h6><span style="color: red;">*</span> {{ __('Select A Plan') }}</h6><br>
                      <select class="form-control" id="planz" name="plan">
                            <option value="">Select an option</option>
                            <option value="Start Up">Free</option>
                            <option value="Basic">Basic</option>
                            <option value="Classic">Classic</option>
                            <option value="Super">Super</option>
                        </select>
                  </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6 incorp_doc">
                      <h6><span style="color: red;">*</span> {{ __('Upload Incorporation Document') }}</h6><br>
                      <input id="file" type="file" class="form-control" name="file">
                  </div>
                  <div class="col-md-6 bizcustom">
                      <h6><span style="color: red;">*</span> {{ __('Upload Company Logo For Business Account Customization') }}</h6><br>
                      <input id="file2" type="file" class="form-control" name="file2">
                  </div>

              </div>


              <br>
              <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button type="button" onclick="loginProcess('Registration','Business')" class="login100-form-btn signUpbtn">
                            Sign Up
                        </button>
                    </div>


                </div>


            </form>


                {{-- End Corporate Business Tab --}}

              </div>




              <div class="tab-pane fade" id="pills-autodealers" role="tabpanel" aria-labelledby="pills-autodealers-tab">
                

                {{-- Start Auto Dealers --}}
            <form method="POST" action="{{ route('register') }}">
                        @csrf

                <div class="row">
                    <div class="col-md-12 disp-0">
                        <h6><span style="color: red;">*</span> {{ __('Kindly select your type of account') }}</h6><br>
                        <input type="hidden" name="" class="form-control" id="accountTypedeal" value="Auto Dealer">
                    </div>
                </div>
                <br>
                <div class="row disp-0">
                    <div class="col-md-12">

                        <input type="hidden" name="userType" id="userTypebisdeal" value="Auto Dealer">
                        <input type="hidden" name="userID" id="userIDdeal" value="<?php echo "VIM_".time(); ?>">
                        <input type="hidden" name="busID" id="busIDdeal" value="<?php echo "VIM_".mt_rand(1000, 10000); ?>">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h6><span style="color: red;">*</span> {{ __('Name of Company') }}</h6><br>
                        <input id="name_of_companydeal" type="text" class="form-control @error('name_of_companydeal') is-invalid @enderror" name="name_of_companydeal" value="{{ old('name_of_company') }}" required autocomplete="name_of_company" placeholder="Company name" autofocus>

                            @error('name_of_companydeal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h6><span style="color: red;">*</span> {{ __('Address') }}</h6><br>
                        <input id="addressdeal" type="text" class="form-control @error('addressdeal') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="addressdeal" placeholder="Company Address">

                            @error('addressdeal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Country') }}</h6><br>
                      <select id="countryzdeal" class="form-control @error('countrydeal') is-invalid @enderror" name="country" value="{{ old('countrydeal') }}" required autocomplete="countrydeal"></select>

                            @error('countrydeal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('State/Province') }}</h6><br>
                      <select id="statezdeal" class="form-control @error('statedeal') is-invalid @enderror" name="state" value="{{ old('statedeal') }}" required autocomplete="statedeal"></select>

                            @error('statedeal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('City') }}</h6><br>
                      <input id="cityzdeal" type="text" class="form-control @error('cityzdeal') is-invalid @enderror" name="city" value="{{ old('cityzdeal') }}" required autocomplete="citydeal" placeholder="City">

                            @error('cityzdeal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>

                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Zip code') }}</h6><br>
                      <input type="text" class="form-control @error('zipcodezdeal') is-invalid @enderror" name="zipcodez" value="{{ old('zipcodezdeal') }}" autocomplete="zipcodezdeal" placeholder="Zip Code" id="zipcodezdeal">

                            @error('zipcodezdeal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                </div>
                <hr>
                <h4><i class="fa fa-user"></i> {{ __('Contact Person') }}</h4><hr>
                <div class="row">
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Firstname') }}</h6><br>
                      <input id="firstnamezdeal" type="text" class="form-control @error('firstnamedeal') is-invalid @enderror" name="firstname" value="{{ old('firstnamedeal') }}" autocomplete="firstnamedeal" placeholder="Firstname" >

                            @error('firstnamedeal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Lastname') }}</h6><br>
                      <input id="lastnamezdeal" type="text" class="form-control @error('lastnamedeal') is-invalid @enderror" name="lastname" value="{{ old('lastnamedeal') }}" autocomplete="lastnamedeal" placeholder="Lastname">

                            @error('lastnamedeal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>
              <div class="row">
                  <div class="col-md-12">
                      <h6><span style="color: red;">*</span> {{ __('Preferred Username') }}</h6><br>
                      <input id="usernamezdeal" type="text" class="form-control @error('usernamezdeal') is-invalid @enderror" name="username" value="{{ old('usernamezdeal') }}" autocomplete="usernamezdeal" placeholder="Username" >

                            @error('usernamezdeal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>
              <div class="row">
                  <div class="col-md-12">
                      <h6><span style="color: red;">*</span> {{ __('Position') }}</h6><br>
                      <input id="positiondeal" type="text" class="form-control @error('positiondeal') is-invalid @enderror" name="position" value="{{ old('positiondeal') }}" autocomplete="positiondeal" placeholder="Position" >

                            @error('positiondeal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>

              <div class="row">
                  <div class="col-md-12">
                      <h6><span style="color: red;">*</span> {{ __('E-Mail Address') }}</h6><br>
                      <input id="emailzdeal" type="email" class="form-control @error('emaildeal') is-invalid @enderror" name="email" value="{{ old('emailzdeal') }}" autocomplete="email" placeholder="E-mail">

                            @error('emailzdeal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>

              <div class="row">
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Password') }}</h6><br>
                      <input id="passwordzdeal" type="password" class="form-control @error('passworddeal') is-invalid @enderror" name="password" value="{{ old('passworddeal') }}" autocomplete="passworddeal" placeholder="Password" >

                            @error('passworddeal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Confirm Password') }}</h6><br>
                      <input id="password-confirmzdeal" type="password" class="form-control" name="password_confirmation" required autocomplete="new-passworddeal" placeholder="Confirm Password">
                  </div>
              </div>
              <br>
                <div class="row">
                  <div class="col-md-4">
                      <h6><span style="color: red;">*</span> {{ __('Telephone') }}</h6><br>
                      <input id="telephonedeal" type="text" class="form-control @error('telephonedeal') is-invalid @enderror" name="telephone" value="{{ old('telephonedeal') }}" autocomplete="telephonedeal" placeholder="Telephone" >

                            @error('telephonedeal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-4">
                      <h6>{{ __('Mobile') }}</h6><br>
                      <input id="mobiledeal" type="text" class="form-control @error('mobiledeal') is-invalid @enderror" name="mobile" value="{{ old('mobiledeal') }}" autocomplete="mobiledeal" placeholder="Mobile">

                            @error('mobiledeal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-4">
                      <h6>{{ __('Office') }}</h6><br>
                      <input id="officedeal" type="text" class="form-control @error('officedeal') is-invalid @enderror" name="office" value="{{ old('officedeal') }}" autocomplete="officedeal" placeholder="Office">

                            @error('officedeal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>

                </div>
                 <hr>
                <h4> <i class="fa fa-lock"></i> {{ __('Answer security question below') }}</h4><br>

                <div class="row">
                  <div class="col-md-6">
                      <h6> {{ __('Security Question') }}</h6><br>
                      <input id="maiden_namezdeal" type="text" class="form-control @error('maiden_namezdeal') is-invalid @enderror" name="maiden_name" value="{{ old('maiden_namezdeal') }}" autocomplete="maiden_namezdeal" placeholder="Security Question" >

                            @error('maiden_namezdeal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                  </div>
                  <div class="col-md-6">
                      <h6>{{ __('Security Answer') }}</h6><br>
                      <input id="parent_meetzdeal" type="text" class="form-control" name="parent_meet" required autocomplete="parent_meetzdeal" placeholder="Security Answer">

                            @error('parent_meetzdeal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>

              <div class="row">
                  <div class="col-md-12">
                      <h6><span style="color: red;">*</span> {{ __('Select A Plan') }}</h6><br>
                      <select class="form-control" id="planzdeal" name="plan">
                            <option value="">Select an option</option>
                            <option value="Start Up">Free</option>
                            <option value="Basic">Basic</option>
                            <option value="Classic">Classic</option>
                            <option value="Super">Super</option>
                        </select>
                  </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6 incorp_doc">
                      <h6><span style="color: red;">*</span> {{ __('Upload Incorporation Document') }}</h6><br>
                      <input id="filedeal" type="file" class="form-control" name="filedeal">
                  </div>
                  <div class="col-md-6 bizcustom">
                      <h6><span style="color: red;">*</span> {{ __('Upload Company Logo For Business Account Customization') }}</h6><br>
                      <input id="file2deal" type="file" class="form-control" name="file2deal">
                  </div>
                  

              </div>
              <br>
              <div class="row">
                <div class="col-md-12 bizdealerlicence">
                      <h6><span style="color: red;">*</span> {{ __('Upload Dealer\'s Licence') }}</h6><br>
                      <input id="file3deal" type="file" class="form-control" name="file3deal">
                  </div>
              </div>


              <br>
              <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button type="button" onclick="loginProcess('Registration','Auto Dealer')" class="login100-form-btn signUpbtn">
                            Sign Up
                        </button>
                    </div>


                </div>


            </form>

                {{-- End Auto Dealers --}}


              </div>
            </div>
              
          </div>




          {{-- Start Auto Care Center Account --}}

        <div class="tab-pane fade show active" id="autocare" role="tabpanel" aria-labelledby="autocare-tab">


          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            {{-- <li class="nav-item">
              <a class="nav-link active" id="pills-cm-tab" data-toggle="pill" href="#pills-cm" role="tab" aria-controls="pills-cm" aria-selected="true"><img src="https://img.icons8.com/color/48/000000/mechanic.png" style="width: 30px; height: 30px;"> Mobile Mechanics</a>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link active" id="pills-autocarecenter-tab" data-toggle="pill" href="#pills-autocarecenter" role="tab" aria-controls="pills-autocarecenter" aria-selected="false"><img src="https://img.icons8.com/dusk/64/000000/car-service.png" style="width: 30px; height: 30px;"> Auto Care Store</a>
            </li>
          </ul>
          <hr>


          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade disp-0" id="pills-cm" role="tabpanel" aria-labelledby="pills-cm-tab">
              

              {{-- Start CM Account --}}

              {{-- Start Auto Care Account Tab Panes --}}
            <form method="POST" action="{{ route('register') }}">
                        @csrf

                <div class="row">
                    <div class="col-md-12 disp-0">
                        <h6><span style="color: red;">*</span> {{ __('Kindly select your type of account') }}</h6><br>
                        <input type="hidden" name="accountTypecm" class="form-control" id="accountTypecm" value="Certified Professional">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h6><span style="color: red;">*</span> {{ __('What is the size of your employee') }}</h6><br>
                        <select class="form-control" id="employeeSizecm" required>
                            <option value="">Select employee size</option>
                            <option value="1">1</option>
                            <option value="2-10">2-10</option>
                            <option value="11-20">11-20</option>
                            <option value="21-30">21-30</option>
                            <option value="31-40">31-40</option>
                            <option value="41-50">41-50</option>
                            <option value="50 Above">50 Above</option>
                        </select>

                        <input type="hidden" name="userID" id="userIDcm" value="<?php echo "VIM_".time(); ?>">
                        <input type="hidden" name="busID" id="busIDcm" value="<?php echo "VIM_".mt_rand(1000, 10000); ?>">
                    </div>
                </div>
                <br>
                <div class="row certifiedInfo">
                    <div class="col-md-6">
                        <h6><span style="color: red;">*</span> {{ __('Station Name') }}</h6><br>
                        <input id="station_namezcm" type="text" class="form-control @error('station_namezcm') is-invalid @enderror" name="station_namezcm" value="{{ old('station_namez') }}" required autocomplete="station_namezcm" placeholder="Station Name">

                            @error('station_namezcm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="col-md-6">
                        <h6><span style="color: red;">*</span> {{ __('Station Address') }}</h6><br>
                        <input id="station_addrezcm" type="text" class="form-control @error('station_addrezcm') is-invalid @enderror" name="station_addrezcm" value="{{ old('station_addrezcm') }}" required autocomplete="station_addrezcm" placeholder="Station Address">

                            @error('station_addrezcm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Country') }}</h6><br>
                      <select id="countryzcm" class="form-control @error('country') is-invalid @enderror" name="countrycm" value="{{ old('country') }}" required autocomplete="country"></select>

                            @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('State/Province') }}</h6><br>
                      <select id="statezcm" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}" required autocomplete="state"></select>

                            @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('City') }}</h6><br>
                      <input id="cityzcm" type="text" class="form-control @error('cityz') is-invalid @enderror" name="city" value="{{ old('cityz') }}" required autocomplete="city" placeholder="City">

                            @error('cityz')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>

                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Zip code') }}</h6><br>
                      <input type="text" class="form-control @error('zipcodezcm') is-invalid @enderror" name="zipcodezcm" value="{{ old('zipcodezcm') }}" autocomplete="zipcodezcm" placeholder="Zip Code" id="zipcodezcm">

                            @error('zipcodezcm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                </div>
                <hr>
                <h4><i class="fa fa-money"></i> {{ __('Discount to Vimfile Members') }}</h4><hr>
                  <div class="row">
                  <div class="col-md-12">
                      <h6><span style="color: red;">*</span> {{ __('Setup Discount %') }}</h6><br>
                      <select class="form-control" id="discountPercent" name="discountPercent">
                        <option>Select range</option>
                        @if($discount = \App\MinimumDiscount::where('discount', 'discount')->get())

                        @for($i=$discount[0]->percent; $i <= $discount[0]->percent + 50; $i++)

                        <option value="{{ $i }}">{{ $i }}</option>

                        @endfor


                        @endif
                      </select>
                  </div>
              </div>
                <hr>
                <h4><i class="fa fa-user"></i> {{ __('Contact Person') }}</h4><hr>
                <div class="row">
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Firstname') }}</h6><br>
                      <input id="firstnamezcm" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" autocomplete="firstname" placeholder="Firstname" >

                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Lastname') }}</h6><br>
                      <input id="lastnamezcm" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" autocomplete="lastname" placeholder="Lastname">

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>

              <div class="row practice">
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Year of practical experience') }}</h6><br>
                      <input id="year_practicecm" type="text" class="form-control @error('year_practice') is-invalid @enderror" name="year_practice" value="{{ old('password') }}" autocomplete="year_practice" placeholder="Year of practical experience" >

                            @error('year_practice')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-6">
                      <h6>{{ __('Specialisation (If any)') }}</h6><br>
                      <input id="specializecm" type="text" class="form-control" name="specialize" required autocomplete="specialize" placeholder="Specialisation (If any)">

                      @error('specialize')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>

              <div class="row">
                  <div class="col-md-12">
                      <h6><span style="color: red;">*</span> {{ __('E-Mail Address') }}</h6><br>
                      <input id="emailzcm" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="E-mail">

                            @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>

              <div class="row">
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Password') }}</h6><br>
                      <input id="passwordzcm" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autocomplete="password" placeholder="Password" >

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Confirm Password') }}</h6><br>
                      <input id="password-confirmzcm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                  </div>
              </div>
              <br>
                <div class="row">
                  <div class="col-md-4">
                      <h6><span style="color: red;">*</span> {{ __('Telephone') }}</h6><br>
                      <input id="telephonecm" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" autocomplete="telephone" placeholder="Telephone" >

                            @error('telephone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-4">
                      <h6>{{ __('Mobile') }}</h6><br>
                      <input id="mobilecm" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" autocomplete="mobile" placeholder="Mobile">

                            @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-4">
                      <h6>{{ __('Office') }}</h6><br>
                      <input id="officecm" type="text" class="form-control @error('office') is-invalid @enderror" name="office" value="{{ old('office') }}" autocomplete="office" placeholder="Office">

                            @error('office')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>

                </div>
                 <hr>
                <h4> <i class="fa fa-lock"></i> {{ __('Answer security question below') }}</h4><br>

                <div class="row">
                  <div class="col-md-6">
                      <h6> {{ __('Security Question') }}</h6><br>
                      <input id="maiden_namezcm" type="text" class="form-control @error('maiden_namez') is-invalid @enderror" name="maiden_name" value="{{ old('maiden_namez') }}" autocomplete="maiden_namez" placeholder="Security Question" >

                            @error('maiden_namez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-6">
                      <h6>{{ __('Security Answer') }}</h6><br>
                      <input id="parent_meetzcm" type="text" class="form-control" name="parent_meet" required autocomplete="parent_meetz" placeholder="Security Answer">

                            @error('parent_meetz')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>

              <div class="row">
                  <div class="col-md-12">
                      <h6><span style="color: red;">*</span> {{ __('Select A Plan') }}</h6><br>
                      <select class="form-control" id="planzcm" name="plan">
                            <option value="">Select an option</option>
                            <option value="Start Up">Free</option>
                            <option value="Basic">Basic</option>
                            <option value="Classic">Classic</option>
                            <option value="Super">Super</option>
                        </select>
                  </div>
              </div>
              <br>
              <div class="row">
                  <div class="col-md-12 trade_doc">
                      <h6><span style="color: red;">*</span> {{ __('Upload Trade Certification') }}</h6><br>
                      <input id="file3" type="file" class="form-control" name="file3">
                  </div>
              </div>


              <br>
              <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button type="button" onclick="loginProcess('Registration','CM')" class="login100-form-btn signUpbtn">
                            Sign Up
                        </button>
                    </div>


                </div>


            </form>
                        


            {{-- End Auto Care Account Tab Panes --}}


              {{-- End CM Account --}}




            </div>
            <div class="tab-pane fade show active" id="pills-autocarecenter" role="tabpanel" aria-labelledby="pills-autocarecenter-tab">
              
              {{-- Start Auto Care Account Tab Panes --}}
            <form method="POST" action="{{ route('register') }}">
                        @csrf

                <div class="row">
                    <div class="col-md-12 disp-0">
                        <h6><span style="color: red;">*</span> {{ __('Kindly select your type of account') }}</h6><br>
                        <input type="hidden" name="accountTypeacc" class="form-control" id="accountTypeacc" value="Auto Care">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h6><span style="color: red;">*</span> {{ __('What is the size of your employee') }}</h6><br>
                        <select class="form-control" id="employeeSizeacc" required>
                            <option value="">Select employee size</option>
                            <option value="1">1</option>
                            <option value="2-10">2-10</option>
                            <option value="11-20">11-20</option>
                            <option value="21-30">21-30</option>
                            <option value="31-40">31-40</option>
                            <option value="41-50">41-50</option>
                            <option value="50 Above">50 Above</option>
                        </select>

                        <input type="hidden" name="userID" id="userIDacc" value="<?php echo "VIM_".time(); ?>">
                        <input type="hidden" name="busID" id="busIDacc" value="<?php echo "VIM_".mt_rand(1000, 10000); ?>">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h6><span style="color: red;">*</span> {{ __('Name of Company') }}</h6><br>
                        <input id="name_of_companyacc" type="text" class="form-control @error('name_of_companyacc') is-invalid @enderror" name="name_of_companyacc" value="{{ old('name_of_company') }}" required autocomplete="name_of_companyacc" placeholder="Company name" autofocus>

                            @error('name_of_companyacc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <br>
                <div class="row">

                    <div class="col-md-6">
                        <h6><span style="color: red;">*</span> {{ __('Street Number') }}</h6><br>
                        <input id="streetno_addressacc" type="text" class="form-control @error('streetno_addressacc') is-invalid @enderror" name="streetno_addressacc" value="{{ old('streetno_addressacc') }}" required autocomplete="streetno_addressacc" placeholder="Street Number">

                            @error('streetno_addressacc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="col-md-6">
                        <h6><span style="color: red;">*</span> {{ __('Street Name') }}</h6><br>
                        <input id="addressacc" type="text" class="form-control @error('addressacc') is-invalid @enderror" name="addressacc" value="{{ old('addressacc') }}" required autocomplete="addressacc" placeholder="Street Name">

                            @error('addressacc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Country') }}</h6><br>
                      <select id="countryzacc" class="form-control @error('country') is-invalid @enderror" name="countryacc" value="{{ old('country') }}" required autocomplete="country"></select>

                            @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('State/Province') }}</h6><br>
                      <select id="statezacc" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}" required autocomplete="state"></select>

                            @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('City') }}</h6><br>
                      <input id="cityzacc" type="text" class="form-control @error('cityz') is-invalid @enderror" name="city" value="{{ old('cityz') }}" required autocomplete="city" placeholder="City">

                            @error('cityz')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>

                  <div class="col-md-3">
                      <h6><span style="color: red;">*</span> {{ __('Zip code') }}</h6><br>
                      <input type="text" class="form-control @error('zipcodezacc') is-invalid @enderror" name="zipcodezacc" value="{{ old('zipcodezacc') }}" autocomplete="zipcodezacc" placeholder="Zip Code" id="zipcodezacc">

                            @error('zipcodezacc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Year Started (Since)') }}</h6><br>
                          <input type="date" class="form-control @error('year_started_since') is-invalid @enderror" name="year_started_since" value="{{ old('year_started_since') }}" autocomplete="year_started_since" id="year_started_since">

                            @error('year_started_since')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                
                  </div>
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Year of Practical Experience') }}</h6><br>
                          <input type="text" class="form-control @error('year_of_practice') is-invalid @enderror" name="year_of_practice" value="{{ old('year_of_practice') }}" autocomplete="year_of_practice" placeholder="Year of Practical Experience" id="year_of_practice">

                            @error('year_of_practice')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                
                  </div>
              </div>

                <hr>
                <h4><i class="fa fa-money"></i> {{ __('Discount to Vimfile Members') }}</h4><hr>
                  <div class="row">
                  <div class="col-md-12">
                      <h6><span style="color: red;">*</span> {{ __('Setup Discount %') }}</h6><br>
                      <select class="form-control" id="discountaccPercent" name="discountaccPercent">
                        <option>Select range</option>
                        @if($discount = \App\MinimumDiscount::where('discount', 'discount')->get())

                        @for($i=$discount[0]->percent; $i <= $discount[0]->percent + 50; $i++)

                        <option value="{{ $i }}">{{ $i }}</option>

                        @endfor


                        @endif
                      </select>
                  </div>
              </div>
                <hr>
                <h4><i class="fa fa-user"></i> {{ __('Contact Person') }}</h4><hr>
                <div class="row">
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Firstname') }}</h6><br>
                      <input id="firstnamezacc" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" autocomplete="firstname" placeholder="Firstname" >

                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Lastname') }}</h6><br>
                      <input id="lastnamezacc" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" autocomplete="lastname" placeholder="Lastname">

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>
              <div class="row">
                  <div class="col-md-12">
                      <h6><span style="color: red;">*</span> {{ __('Preferred Username') }}</h6><br>
                      <input id="usernamezacc" type="text" class="form-control @error('usernamez') is-invalid @enderror" name="usernamez" value="{{ old('usernamez') }}" autocomplete="usernamez" placeholder="Username" >

                            @error('usernamez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>
              <div class="row">
                  <div class="col-md-12">
                      <h6><span style="color: red;">*</span> {{ __('Position') }}</h6><br>
                      <input id="positionacc" type="text" class="form-control @error('position') is-invalid @enderror" name="position" value="{{ old('position') }}" autocomplete="position" placeholder="Position" >

                            @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>

              <div class="row">
                  <div class="col-md-12">
                      <h6><span style="color: red;">*</span> {{ __('What service do you offer?') }}</h6><br>
                      <input id="service_offer" type="text" class="form-control @error('service_offer') is-invalid @enderror" name="service_offer" value="{{ old('service_offer') }}" autocomplete="service_offer" placeholder="Service Offer" >

                            @error('service_offer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>

              <div class="row">
                  <div class="col-md-12">
                      <h6><span style="color: red;">*</span> {{ __('E-Mail Address') }}</h6><br>
                      <input id="emailzacc" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="E-mail">

                            @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>

              <div class="row">
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Password') }}</h6><br>
                      <input id="passwordzacc" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autocomplete="password" placeholder="Password" >

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-6">
                      <h6><span style="color: red;">*</span> {{ __('Confirm Password') }}</h6><br>
                      <input id="password-confirmzacc" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                  </div>
              </div>
              <br>
                <div class="row">
                  <div class="col-md-4">
                      <h6><span style="color: red;">*</span> {{ __('Telephone') }}</h6><br>
                      <input id="telephoneacc" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" autocomplete="telephone" placeholder="Telephone" >

                            @error('telephone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-4">
                      <h6>{{ __('Mobile') }}</h6><br>
                      <input id="mobileacc" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" autocomplete="mobile" placeholder="Mobile">

                            @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-4">
                      <h6>{{ __('Office') }}</h6><br>
                      <input id="officeacc" type="text" class="form-control @error('office') is-invalid @enderror" name="office" value="{{ old('office') }}" autocomplete="office" placeholder="Office">

                            @error('office')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>

                </div>
                 <hr>

                 <h4> <i class="fa fa-lock"></i> {{ __('Specialities') }}</h4><br>

                 <div class="row">
                      <div class="col-md-4">
                          <h6><span style="color: red;">*</span> {{ __('Mechanical') }}</h6><br>
                          <select id="mechanical_skill" class="form-control" name="mechanical_skill" value="{{ old('mechanical_skill') }}" required>
                              <option value="">Select option</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                          </select>

                                @error('mechanical_skill')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </div>
                      <div class="col-md-4">
                          <h6><span style="color: red;">*</span> {{ __('Electrical') }}</h6><br>
                          <select id="electrical_skill" class="form-control" name="electrical_skill" value="{{ old('electrical_skill') }}" required>
                              <option value="">Select option</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                          </select>

                                @error('electrical_skill')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </div>
                      <div class="col-md-4">
                          <h6><span style="color: red;">*</span> {{ __('Transmissions') }}</h6><br>
                          <select id="transmission_skill" class="form-control" name="transmission_skill" value="{{ old('transmission_skill') }}" required>
                              <option value="">Select option</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                          </select>

                                @error('transmission_skill')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </div>
                  </div>
                  <br>
                      <div class="row">
                          <div class="col-md-6">
                              <h6><span style="color: red;">*</span> {{ __('Body Works ') }}</h6><br>
                              <select id="body_work_skill" class="form-control" name="body_work_skill" value="{{ old('body_work_skill') }}" required>
                                  <option value="">Select option</option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                              </select>

                                    @error('body_work_skill')
                                        <span class="alert alert-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                          </div>

                          <div class="col-md-6">
                              <h6><span style="color: red;">*</span> {{ __('Others') }}</h6><br>
                              <input id="other_skills" type="text" class="form-control @error('other_skills') is-invalid @enderror" name="other_skills" value="{{ old('station_namez') }}" autocomplete="other_skills" placeholder="Please specify">

                                    @error('other_skills')
                                        <span class="alert alert-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                          </div>
                    </div>
                    <br>
                 <hr>


                     <h4><i class="fa fa-wrench"></i> {{ __('Our Value added') }}</h4><hr>

                            <div class="row">
                              <div class="col-md-4">
                                  <h6><span style="color: red;">*</span> {{ __('VIMfile Discount') }}</h6><br>
                                  <select id="vimfile_discount" class="form-control" name="vimfile_discount" value="{{ old('vimfile_discount') }}" required>
                                      <option value="">Select option</option>
                                      <option value="Yes">Yes</option>
                                      <option value="No">No</option>
                                  </select>

                                        @error('vimfile_discount')
                                            <span class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                              </div>
                              <div class="col-md-4">
                                  <h6><span style="color: red;">*</span> {{ __('Repair Guaranteed') }}</h6><br>
                                  <select id="repair_guaranteed" class="form-control" name="repair_guaranteed" value="{{ old('repair_guaranteed') }}" required>
                                      <option value="">Select option</option>
                                      <option value="Yes">Yes</option>
                                      <option value="No">No</option>
                                  </select>

                                        @error('repair_guaranteed')
                                            <span class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                              </div>
                              <div class="col-md-4">
                                  <h6><span style="color: red;">*</span> {{ __('Free Estimates') }}</h6><br>
                                  <select id="free_estimated" class="form-control" name="free_estimated" value="{{ old('free_estimated') }}" required>
                                      <option value="">Select option</option>
                                      <option value="Yes">Yes</option>
                                      <option value="No">No</option>
                                  </select>

                                        @error('free_estimated')
                                            <span class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                              </div>
                          </div> <br>

                          <div class="row">
                              <div class="col-md-6">
                                  <h6><span style="color: red;">*</span> {{ __('Walks-in Welcome') }}</h6><br>
                                  <select id="walk_in_specified" class="form-control" name="walk_in_specified" value="{{ old('walk_in_specified') }}" required>
                                      <option value="">Select option</option>
                                      <option value="Yes">Yes</option>
                                      <option value="No">No</option>
                                  </select>

                                        @error('walk_in_specified')
                                            <span class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                              </div>

                              <div class="col-md-6">
                                      <h6><span style="color: red;">*</span> {{ __('Others') }}</h6><br>
                                      <input id="other_value_added" type="text" class="form-control @error('other_value_added') is-invalid @enderror" name="other_value_added" value="{{ old('station_namez') }}" autocomplete="other_value_added" placeholder="Please specify">

                                            @error('other_value_added')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                  </div>
                          </div> <br>

                          <div class="row">

                              <div class="col-md-12">
                                      <h6><span style="color: red;">*</span> {{ __('Average Waiting Period in minutes (Scheduled Maintenance)') }}</h6><br>
                                      <input id="average_waiting" type="text" class="form-control @error('average_waiting') is-invalid @enderror" name="average_waiting" value="{{ old('station_namez') }}" required autocomplete="average_waiting" placeholder="Waiting period">

                                            @error('average_waiting')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                  </div>
                          </div> <br>
                          <div class="row">

                              <div class="col-md-12">
                                      <h6><span style="color: red;">*</span> {{ __('Hours of Operation') }}</h6><br>
                                      <input id="hours_of_operation" type="text" class="form-control @error('hours_of_operation') is-invalid @enderror" name="hours_of_operation" value="{{ old('station_namez') }}" required autocomplete="hours_of_operation" placeholder="Hours of Operation">

                                            @error('hours_of_operation')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                  </div>
                          </div>




                 <br>
                 <hr>

                    <h4><i class="fa fa-wrench"></i> {{ __('Amenities') }}</h4><hr>
                            
                            <div class="row">
                              <div class="col-md-6">
                                  <h6><span style="color: red;">*</span> {{ __('Wi-Fi') }}</h6> <br>
                                  <select id="wifi" class="form-control" name="wifi" value="{{ old('wifi') }}" required>
                                      <option value="">Select option</option>
                                      <option value="Yes">Yes</option>
                                      <option value="No">No</option>
                                  </select>

                                        @error('wifi')
                                            <span class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                              </div>
                              <div class="col-md-6">
                                  <h6><span style="color: red;">*</span> {{ __('Gender Neutral Rest Room') }}</h6> <br>
                                  <select id="restroom" class="form-control" name="restroom" value="{{ old('restroom') }}" required>
                                      <option value="">Select option</option>
                                      <option value="Yes">Yes</option>
                                      <option value="No">No</option>
                                  </select>

                                        @error('restroom')
                                            <span class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                              </div>
                          </div><br>
                            <div class="row">
                              <div class="col-md-6">
                                  <h6><span style="color: red;">*</span> {{ __('Lounge') }}</h6> <br>
                                  <select id="lounge" class="form-control" name="lounge" value="{{ old('lounge') }}" required>
                                      <option value="">Select option</option>
                                      <option value="Yes">Yes</option>
                                      <option value="No">No</option>
                                  </select>

                                        @error('lounge')
                                            <span class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                              </div>
                              <div class="col-md-6">
                                  <h6><span style="color: red;">*</span> {{ __('Parking Space') }}</h6> <br>
                                  <select id="parking_space" class="form-control" name="parking_space" value="{{ old('parking_space') }}" required>
                                      <option value="">Select option</option>
                                      <option value="Yes">Yes</option>
                                      <option value="No">No</option>
                                  </select>

                                        @error('parking_space')
                                            <span class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                              </div>
                          </div>

                 <br>
                 <hr>

                    <h4><i class="fa fa-wrench"></i> {{ __('History') }}</h4><hr>
                          <div class="row">
                              <div class="col-md-12">
                                <input type="hidden" name="stage3_busID" id="stage3_busID" value="">
                                  <h6><span style="color: red;">*</span> {{ __('Year Established') }}</h6><br>
                                  <input id="year_established" type="date" class="form-control" name="year_established" value="{{ old('year_established') }}" autocomplete="year_established" placeholder="Year Established" >

                                        @error('year_established')
                                            <span class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                              </div>
                          </div><br>
                          <div class="row">
                              <div class="col-md-12">
                                  <h6><span style="color: red;">*</span> {{ __('Background') }}</h6><br>
                                  <textarea id="background" type="text" class="form-control" name="background" value="{{ old('background') }}" autocomplete="background"></textarea>

                                        @error('background')
                                            <span class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                              </div>
                          </div><br>

                          <div class="row">
                            <div class="col-md-12">
                                <h6><span style="color: red;">*</span> {{ __('Photos & Videos') }}</h6><br>
                                <input id="photo_video" type="file" class="form-control" name="photo_video">
                            </div>
                        </div>

                 <br>
                 <hr>

                <h4> <i class="fa fa-lock"></i> {{ __('Answer security question below') }}</h4><br>

                <div class="row">
                  <div class="col-md-6">
                      <h6> {{ __('Security Question') }}</h6><br>
                      <input id="maiden_namezacc" type="text" class="form-control @error('maiden_namez') is-invalid @enderror" name="maiden_name" value="{{ old('maiden_namez') }}" autocomplete="maiden_namez" placeholder="Security Question" >

                            @error('maiden_namez')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="col-md-6">
                      <h6>{{ __('Security Answer') }}</h6><br>
                      <input id="parent_meetzacc" type="text" class="form-control" name="parent_meet" required autocomplete="parent_meetz" placeholder="Security Answer">

                            @error('parent_meetz')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
              </div>
              <br>

              <div class="row">
                  <div class="col-md-12">
                      <h6><span style="color: red;">*</span> {{ __('Select A Plan') }}</h6><br>
                      <select class="form-control" id="planzacc" name="plan">
                            <option value="">Select an option</option>
                            <option value="Start Up">Free</option>
                            <option value="Basic">Basic</option>
                            <option value="Classic">Classic</option>
                            <option value="Super">Super</option>
                        </select>
                  </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6 incorp_doc">
                      <h6><span style="color: red;">*</span> {{ __('Upload Incorporation Document') }}</h6><br>
                      <input id="fileacc" type="file" class="form-control" name="fileacc">
                  </div>
                  <div class="col-md-6 bizcustom">
                      <h6><span style="color: red;">*</span> {{ __('Upload Company Logo For Business Account Customization') }}</h6><br>
                      <input id="file2acc" type="file" class="form-control" name="file2acc">
                  </div>

              </div>


              <br>
              <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button type="button" onclick="loginProcess('Registration','Acc')" class="login100-form-btn signUpbtn">
                            Sign Up
                        </button>
                    </div>


                </div>


            </form>
                        


            {{-- End Auto Care Account Tab Panes --}}


            </div>
          </div>




              
            


          </div>


          {{-- End Auto Care Center Account --}}




        </div> 

        </div>   
    </div>

    <br><br>



@endsection
