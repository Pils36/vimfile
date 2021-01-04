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
    <section class="feature_part">
        <div class="container">
            <div class="row">

                    <div class="col-lg-12">
                         <br>
                        <div class="boxEmail">
                            <center><div class="card" style="width: 100%;">
                              <div class="card-header" style="background-color: #363f4e;">
                               <h4 class="text-left text-white">Provide your E-mail Address</h4> 
                              </div>
                              <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <center><input type="email" name="email" class="form-control" placeholder="E-mail Address" style="width: 100%" id="email"></center> <br>
                                    <center><button class="btn btn-primary" style="background-color: brown; outline: none !important; width: 100%; border: none !important;" onclick="forgotPassword('emailAddress')">Submit <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button></center>
                                </li>
                              </ul>
                            </div></center>
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