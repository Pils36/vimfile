@extends('layouts.app')

@section('text/css')

<style>
    .about_part{
        height: 45vh !important;
    }
</style>

@show

@section('content')

    <!-- banner part start-->
    <section class="banner_part about_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h1 class="m-t-100">{{ $pages }}</h1>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->



       <!-- feature_part start-->
    <section class="feature_part m-b-40 m-t-40">
        <div class="container">
            <div class="row maidenName">

                    <div class="col-lg-12">
                         <br>
                        <div class="boxEmail">
                            <center><div class="card" style="width: 100%;">
                              <div class="card-header" style="background-color: #363f4e;">
                               <h4 class="text-left text-white">Answer Security Question</h4> 
                              </div>
                              <ul class="list-group list-group-flush">
                                <li class="list-group-item"><h5 class="text-left">Security Question</h5></li>
                                <li class="list-group-item">
                                    <center>
                                        <input type="hidden" name="email1" value="{{ $email }}" id="email1">
                                        <input type="text" name="maidenname" class="form-control" placeholder="Security Question" style="width: 100%" id="maiden_name1"></center> <br>
                                    <center><button class="btn btn-primary" style="background-color: brown; outline: none !important; width: 100%; border: none !important;" onclick="forgotPassword('maidenname1')">Submit <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button></center>
                                </li>
                              </ul>
                            </div></center>
                        </div>
                </div>


                
            </div>

            <div class="row parentMeet disp-0">

                    <div class="col-lg-12">
                         <br>
                        <div class="boxEmail">
                            <center><div class="card" style="width: 100%;">
                              <div class="card-header" style="background-color: #363f4e;">
                               <h4 class="text-left text-white">Answer Security Question</h4> 
                              </div>
                              <ul class="list-group list-group-flush">
                                <li class="list-group-item"><h5 class="text-left">Security Answer</h5></li>
                                <li class="list-group-item">
                                    <center>
                                        <input type="hidden" name="email2" value="{{ $email }}" id="email2">
                                        <input type="text" name="maidenname" class="form-control" placeholder="Security Answer" style="width: 100%" id="maiden_name2"></center> <br>
                                    <center><button class="btn btn-primary" style="background-color: brown; outline: none !important; width: 100%; border: none !important;" onclick="forgotPassword('maidenname2')">Submit <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button></center>
                                </li>
                              </ul>
                            </div></center>
                        </div>
                </div>


                
            </div>


            <div class="row passwordChange disp-0">

                    <div class="col-lg-12">
                         <br>
                        <div class="boxEmail">
                            <center><div class="card" style="width: 100%;">
                              <div class="card-header" style="background-color: #363f4e;">
                               <h4 class="text-left text-white">Reset Password</h4> 
                              </div>
                              <ul class="list-group list-group-flush">
                                <li class="list-group-item"><h5 class="text-left">Enter Password</h5></li>
                                <li class="list-group-item">
                                    <center>
                                        <input type="hidden" name="email3" value="{{ $email }}" id="email3">
                                        <input type="password" name="new_password" class="form-control" placeholder="New Password" style="width: 100%" id="new_password">
                                    </center> <br>
                                        <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" style="width: 100%" id="cpassword">
                                    <br>
                                    <center>
                                        <button class="btn btn-primary" style="background-color: brown; outline: none !important; width: 100%; border: none !important;" onclick="forgotPassword('passwordchange')">Submit <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                                    </center>
                                </li>
                              </ul>
                            </div>
                            </center>
                        </div>
                </div>


                
            </div>
        </div>

    </section>
    <!-- upcoming_event part start-->


    <!-- cta part start-->
    <section class="cta_part section_padding disp-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="cta_text text-center">
                        <h2>Very useful Friendly</h2>
                        <p></p>
                        <a href="#" class="btn_2 banner_btn_1">Get Started </a>
                        <a href="#" class="btn_2 banner_btn_2">Sign up for free </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cta part end-->

@endsection