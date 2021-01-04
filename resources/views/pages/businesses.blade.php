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
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h1 class="m-t-100" id="headz">Vimfile For Business
                                </h1>
                            <p class="memo">Monitoring and controlling maintenance of assets improve the value of the assets, and generate higher return on investment in the long term. <br><br>
                            Vimfile for Business is designed to achieve this objective.
                            Either you are a corporation with fleet of vehicles under management or an auto-dealer with heavy investments in leased vehicle,

                            <br><br>
                            Remember, track all your maintenance activities will reduce critical downtime, promote road safety, control maintenance costs 
                            and support insurance claims.
                            <br><br>
                            Vimfile for Business provides you with a simple and cost effective tool to keep track of maintenance costs, monitor and control critical maintenance 
                            and preserve the value of your assets or investments.
                            <br><br>
                            If you simply need to track mileage cost or want to ensure your leased vehicle are serviced as at when due, Vimfile for Business is all you need.
                        </p>
                               
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 defined">
                    <div class="banner_text_iner">
                        <div class="row">
                            <div class="col-sm-6">
                                <button class="btnsDef" onclick='location.href="{{ route('register', 'c=business') }}"'>Join us NOW</button>
                            </div>
                            <div class="col-sm-6">
                                <button class="btnsDef" onclick='location.href="{{ route('Contact') }}"'>Contact Us</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <center><img class="animated slideInRight" src="https://pro2-bar-s3-cdn-cf.myportfolio.com/43c72d352c5fe6d2082b108e381d6ec0/b8b132ca-8b8a-418d-93e9-5750049ce22e_rw_600.gif?h=6d48bf788f960033c2e18113f5c668ec"></center>
                            </div>
                            <div class="col-sm-4">
                               <a href="{{ route('register', 'c=business') }}"> <img class="animated slideInRight" src="https://cdn.clipart.email/fdec85f2550eb868a0d791070573d3dc_discovery-bay-yacht-club-home_345-300.png" style="width: auto; height: 130px;">
                                <img class="animated slideInRight" src="https://www.freepngimg.com/thumb/free/8-2-free-png-clipart.png" style="width: auto; height: 90px; position: relative; top: -10px;"></a>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
        {{-- <center><img src="https://img.icons8.com/ios-filled/50/000000/circled-down-2.png" class="animated infinite bounce delay-1s" style="width: 50px; height: 50px; position: relative; top: 0px; cursor: pointer;" onclick="scrollTarget('indexs_target')"></center> --}}
    </section>
    <!-- banner part start-->



       <!-- feature_part start-->
    <section class="feature_part" >
        <div class="container">
            <div class="row">

                    <div class="col-lg-10" style="margin-top: 15px;" >
                        <h5>Features:</h5> <hr>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Search  for vehicle and review maintenance activities with ease.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Set up maintenance reminders for each of the vehicle
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Send reminders to multiple emails
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Track Mileage and maintenance/ services costs
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Use analytics for planned and schedule maintenance
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Budget for your vehicle maintenance costs
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Access maintenance records anywhere, wherever
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Keep eCopy of Warranties and repairs receipts
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Export Data or integrate with other software
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Ask questions from Experts
                        </p> <br>

                        <p>
                           Click here to <a type="button" href="{{ route('register', 'c=business') }}" style="color: white !important; font-weight: bold !important;" class="btn btn-primary">Join us and use for FREE forever.</a>
                        </p>

                        <br> <br>


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
                        <a href="#" class="btn_2 banner_btn_2">Join us for free </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cta part end-->

@endsection