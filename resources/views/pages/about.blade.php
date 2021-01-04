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
                            <h1 class="m-t-100">About Busy Wrench</h1>

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

                    <div class="col-lg-10">
                        <h2 style="text-decoration: underline;">About Busy Wrench</h2> <br>
                        <p>Vehicle owners are always looking for qualified, reliable and professional mechanics nearby. Our system has been designed to connect you with vehicle owners around you.</p>
<p>Simply sign up for FREE, complete your Auto Repair Shop's profile and we share your information with vehicle owners near you.
We also provide you with Shop Management Software (SMS) that enables you to receive appointments, respond to reviews with a direct message, reply to messages or quote requests, track Users' view and customer leads, and manage end-to-end operations of your business from anywhere on any devices.</p> <br>

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
