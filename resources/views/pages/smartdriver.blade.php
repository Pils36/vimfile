@extends('layouts.app')


@section('text/css')

<style>
    .bookings:hover{
        transition: all ease-in-out;
        background-color: #ec8e27 !important;
        color: #fff !important;
        -webkit-box-shadow: inset -8px -8px 28px 1px rgba(219,140,21,0.77);
-moz-box-shadow: inset -8px -8px 28px 1px rgba(219,140,21,0.77);
box-shadow: inset -8px -8px 28px 1px rgba(219,140,21,0.77);
    }
    .memo{
        font-size: 16px;
        background: #000;
        width: 450px;
        text-align: justify;
        position: relative;
        top: -30px;

    }
    .banner_part .banner_text p {
        padding: 20px !important;
    }
    #headz, #linkz{
        font-size: 33px; background-color: #394f75; padding: 10px; width: 450px;
    }
    #linkz{
        height: auto;
        position: relative;
    }
    .defined{
        background: #fff;
        border-radius: 10px;
        position: relative;
        top: -30px;
    }
    .defined .banner_text_iner{
        padding: 20px 0px 0px;
    }
    .btnsDef{
        border: 1px solid grey;
        padding: 7px;
        font-size: 12px;
        width: 100%;
        text-align: center;
        font-weight: bold;
        background-color: #14485f;
        color: #fff; 
    }

    .defined img{
        height: 220px;
    }
    .btnAct{
        position: relative; top: -60px;
    }


    @media (max-width: 700px){
        .memo{
            width: 100% !important;
            padding-right: 20px !important;

        }
        #headz, #linkz{
        font-size: 33px; background-color: #394f75; padding: 10px; width: auto; margin-bottom: 50px;
    }
    #linkz{
        position: relative;
        top: -110px;
    }
    .btnsDef{
        margin-bottom: 3px;
    }
    .defined{
        position: relative;
        top: 0px;
    }
    .btnAct{
        position: relative; top: -30px;
    }
    
    }
    @media (max-width: 576px){
        .btn_2 {
    padding: 10px 30px !important;
    margin-top: 0px !important; 
}
    }

</style>

@show

@section('content')

    <!-- banner part start-->
    <section class="banner_part userDash">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h1 id="headz" class="m-t-190">Vimfile <span style="text-transform: lowercase; color: #fff !important;">for</span> SMART Drivers
                                </h1>
                            <p class="memo" style="font-size: 15px;">In all that Vimfile.com offers, you can now: 
                                <br>* Track your Earnings and Profit per km or mile
                                    <br>* Claim Income Tax and HST Refunds with ease
                                    <br>* Auto-update maintenance records at<br> approved Autocare Centres
                                    <br>* Drive Smarter with our upcoming analytics and AI
                                    <br>* Sign up and use for FREE for 30days
                                    <br>* Cancel/Deactivate anytime
                            </p>

                            <div class="mt-0 btnAct">
                                @if (!Auth::user())
                                    <a href="{{ route('register') }}" class="btn_2 banner_btn_1">Sign Up for FREE</a>
                                    <a href="{{ route('login') }}" class="btn_2 banner_btn_1">Login</a>
                            
                                    @elseif(Auth::user()->status == 0)
                                    <a href="{{ route('Contact') }}" class="btn_2 banner_btn_1">Account Deactivated</a>

                            @elseif(Auth::user()->userType == 'Commercial' && Auth::user()->status == 2)
                            <a href="{{ route('Pricing') }}" class="btn_2 banner_btn_1">Make payment to activate account</a>

                            @else
                            <a href="{{ route('userDashboard') }}" class="btn_2 banner_btn_1">My Account</a>
                                @endif

                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 disp-0">
                    <div class="search_boxes">
                        <div class="auto_care">
                            <label><p>Search for an Auto Care Center Near You</p></label>
                            <input type="text" name="auto_care" id="auto_care" class="form-control" placeholder="Search by Area/City">
                        </div>
                        <div class="auto_care">
                            <label><p>Search for Tow Truck Company Near You</p></label>
                            <input type="text" name="tow_ruck" id="tow_ruck" class="form-control" placeholder="Search by Area/City" readonly="" disabled="">
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <center><img src="https://img.icons8.com/ios-filled/50/000000/circled-down-2.png" class="animated infinite bounce delay-1s" style="width: 40px; height: 40px; position: relative; top: 0px; cursor: pointer;" onclick="scrollTarget('indexs_target')"></center>
    </section>
    <!-- banner part start-->

    <!-- feature_part start-->
    <section class="feature_part padding_top disp-0">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 ">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-sm-6">
                            <div class="single_feature">
                                <div class="single_feature_part">
                                    <img src="img/icon/feature_icon_1.png" alt="">
                                    <h4>A Volunteer</h4>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="single_feature">
                                <div class="single_feature_part">
                                    <img src="img/icon/feature_icon_2.png" alt="">
                                    <h4>A Volunteer</h4>
                                    <p></p>
                                </div>
                            </div>
                            <div class="single_feature">
                                <div class="single_feature_part single_feature_part_2">
                                    <img src="img/icon/feature_icon_3.png" alt="">
                                    <h4>A Volunteer</h4>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="feature_part_text">
                        <h2>featured</h2>
                        <p></p>
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-5">
                                <div class="feature_part_text_iner">
                                    <h4>50k</h4>
                                    <p>Total Volunteer</p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-5">
                                <div class="feature_part_text_iner">
                                    <h4>100k</h4>
                                    <p>Successed Mission</p>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn_4">learn more <img src="img/icon/right-arrow.svg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
        
        <img src="{{ asset('img/animate_icon/shape-1.png') }}" alt="" class="feature_icon_1">
        <img src="{{ asset('img/animate_icon/Shape-14.png') }}" alt="" class="feature_icon_2">
        <img src="{{ asset('img/animate_icon/shape.png') }}" alt="" class="feature_icon_3">
        <img src="{{ asset('img/animate_icon/shape-3.png') }}" alt="" class="feature_icon_4">
    </section>
    <!-- upcoming_event part start--> 


       <!-- feature_part start-->
    <section class="feature_part padding_top" id="indexs_target">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                @if(Auth::user())

<div class="col-lg-4" style="cursor: pointer;">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="img/icon/feature_icon_2.png" alt="">
                            <h4>Search for an Auto care center near you</h4>
                            <p></p>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4" style="cursor: pointer;">
                    <div class="single_feature">
                        <div class="single_feature_part single_feature bookings">
                            <img src="img/icon/feature_icon_3.png" alt="">
                            <h4>Book an Appointment</h4>
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4" style="cursor: pointer;">
                    <div class="single_feature">
                                <div class="single_feature_part bookings">
                                    <img src="img/icon/feature_icon_1.png" alt="">
                                    <h4>Search for a Tow Truck Company</h4>
                                    <p></p>
                                </div>
                            </div>
                             
                    </div>

                    @else

                    <div class="col-lg-4">
                    <div class="single_feature ">
                        <div class="single_feature_part bookings">
                            <img src="img/icon/feature_icon_2.png" alt="">
                            <a href="{{ route('register') }}"><h4>Search for an Auto care center near you</h4></a>
                            <p></p>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="single_feature ">
                        <div class="single_feature_part single_feature_part bookings">
                            <img src="img/icon/feature_icon_3.png" alt="">
                            <a href="{{ route('register') }}"><h4>Book an Appointment</h4></a>
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="single_feature">
                                <div class="single_feature_part bookings">
                                    <img src="img/icon/feature_icon_1.png" alt="">
                                    <a href="{{ route('register') }}"><h4>Search for a Tow Truck Company</h4></a>
                                    <p></p>
                                </div>
                            </div>
                             
                    </div>

                @endif
                
            </div>
        </div>
        
        <img src="{{ asset('img/animate_icon/shape-1.png') }}" alt="" class="feature_icon_1">
        <img src="{{ asset('img/animate_icon/Shape-14.png') }}" alt="" class="feature_icon_2">
        <img src="{{ asset('img/animate_icon/shape.png') }}" alt="" class="feature_icon_3">
        <img src="{{ asset('img/animate_icon/shape-3.png') }}" alt="" class="feature_icon_4">
    </section>
    <!-- upcoming_event part start-->

    <!-- about_us part start-->
    <section class="about_us section_padding disp-0">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-6 col-lg-5">
                    <div class="about_us_text">
                        <h2>Right people at the
                            Right time.</h2>
                        <p></p>
                        @if (!Auth::user())
                                    <a href="{{ route('login') }}" class="btn_1">Get Started </a>
                            <a href="{{ route('register') }}" class="btn_1" style="margin-top: 0px">Sign up for free </a>

                            @else
                            <a href="#" class="btn_1">Dashboard</a>
                                @endif
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="learning_img">
                        <img src="https://konigwheels.com/wp-content/uploads/2018/12/tm-graph.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    <img src="{{ asset('img/left_sharp.png') }}" alt="" class="left_shape_1">
    <img src="{{ asset('img/about_shape.png') }}" alt="" class="about_shape_1">
    <img src="{{ asset('img/animate_icon/Shape-16.png') }}" alt="" class="feature_icon_1">
    <img src="{{ asset('img/animate_icon/shape-1.png') }}" alt="" class="feature_icon_4">
    </section>
    <!-- about_us part end-->


    @if(Auth::user())
    @if(Auth::user()->userType == "Business")
    @if($busInfo != "")
        <!-- use sasu part end-->
    <section class="use_sasu m-t-100 m-b-100 disp-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section_tittle text-center">
                        <h2>Who can use VIM?</h2>
                        <p> </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_dashboard_ojaaee.jpg" alt="">
                            <a href="{{ route('register') }}"><h4>Individual</h4></a>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_key_ww5mak.jpg" alt="">
                            <a href="{{ route('register', 'c=business') }}"><h4>Business Owners</h4></a>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_gear_nzqipu.webp" alt="">
                            <a href="{{ route('register', 'c=business') }}"><h4>Auto Care Centers</h4></a>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset('img/animate_icon/Shape-14.png') }}" alt="" class="feature_icon_1">
        <img src="{{ asset('img/animate_icon/shape-10.png') }}" alt="" class="feature_icon_2">
        <img src="{{ asset('img/animate_icon/shape.png') }}" alt="" class="feature_icon_3">
        <img src="{{ asset('img/animate_icon/Shape-13.png') }}" alt="" class="feature_icon_4">
    </section>
    <!-- use sasu part end-->
    @else

    <!-- use sasu part end-->
    <section class="use_sasu m-t-100 m-b-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section_tittle text-center">
                        <h2>Who can use VIM?</h2>
                        <p> </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_dashboard_ojaaee.jpg" alt="">
                            <a href="{{ route('register') }}"><h4>Individual</h4></a>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_key_ww5mak.jpg" alt="">
                            <a href="{{ route('register', 'c=business') }}"><h4>Business Owners</h4></a>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_gear_nzqipu.webp" alt="">
                            <a href="{{ route('register', 'c=business') }}"><h4>Auto Care Centers</h4></a>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset('img/animate_icon/Shape-14.png') }}" alt="" class="feature_icon_1">
        <img src="{{ asset('img/animate_icon/shape-10.png') }}" alt="" class="feature_icon_2">
        <img src="{{ asset('img/animate_icon/shape.png') }}" alt="" class="feature_icon_3">
        <img src="{{ asset('img/animate_icon/Shape-13.png') }}" alt="" class="feature_icon_4">
    </section>
    <!-- use sasu part end-->

    @endif


    @else

    <!-- use sasu part end-->
    <section class="use_sasu m-t-100 m-b-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section_tittle text-center">
                        <h2>Who can use VIM?</h2>
                        <p> </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_dashboard_ojaaee.jpg" alt="">
                            <a href="{{ route('register') }}"><h4>Individual</h4></a>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_key_ww5mak.jpg" alt="">
                            <a href="{{ route('register', 'c=business') }}"><h4>Business Owners</h4></a>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_gear_nzqipu.webp" alt="">
                            <a href="{{ route('register', 'c=business') }}"><h4>Auto Care Centers</h4></a>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <img src="{{ asset('img/animate_icon/Shape-14.png') }}" alt="" class="feature_icon_1">
    <img src="{{ asset('img/animate_icon/shape-10.png') }}" alt="" class="feature_icon_2">
    <img src="{{ asset('img/animate_icon/shape.png') }}" alt="" class="feature_icon_3">
    <img src="{{ asset('img/animate_icon/shape-13.png') }}" alt="" class="feature_icon_4">
    </section>
    <!-- use sasu part end-->

    @endif


    @else

    <!-- use sasu part end-->
    <section class="use_sasu m-t-100 m-b-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section_tittle text-center">
                        <h2>Who can use VIM?</h2>
                        <p> </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_dashboard_ojaaee.jpg" alt="">
                            <a href="{{ route('register') }}"><h4>Individual</h4></a>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_key_ww5mak.jpg" alt="">
                            <a href="{{ route('register', 'c=business') }}"><h4>Business Owners</h4></a>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_gear_nzqipu.webp" alt="">
                            <a href="{{ route('register', 'c=business') }}"><h4>Auto Care Centers</h4></a>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <img src="{{ asset('img/animate_icon/Shape-14.png') }}" alt="" class="feature_icon_1">
    <img src="{{ asset('img/animate_icon/shape-10.png') }}" alt="" class="feature_icon_2">
    <img src="{{ asset('img/animate_icon/shape.png') }}" alt="" class="feature_icon_3">
    <img src="{{ asset('img/animate_icon/Shape-13.png') }}" alt="" class="feature_icon_4">
    </section>
    <!-- use sasu part end-->

    @endif
    

    <!-- about_us part start-->
    <section class="about_us right_time section_padding disp-0">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-6 col-lg-6">
                    <div class="learning_img">
                        <img src="https://dustbowl.files.wordpress.com/2010/03/gear_shift_lever_thonet_2.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="about_us_text">
                        <h2>Easy to Use 
                            Mobile Application</h2>
                        <p></p>
                        <a href="#" class="btn_1">Get Started</a>
                        <a href="#" class="btn_2">Sign up for free</a>
                    </div>
                </div>
            </div>
        </div>
    <img src="{{ asset('img/about_shape.png') }}" alt="" class="about_shape_1">
    <img src="{{ asset('img/animate_icon/shape-1.png') }}" alt="" class="feature_icon_1">
    <img src="{{ asset('img/animate_icon/shape.png') }}" alt="" class="feature_icon_4">
    </section>
    <!-- about_us part end-->

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