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
    .btnsDef2{
        border: 1px solid #f96400;
        padding: 7px;
        font-size: 14px;
        width: 80%;
        text-align: center;
        font-weight: bold;
        background-color: #f96400;
        color: #fff;
        border-radius: 10px; 
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
                            <h1 class="m-t-0" id="headz">
                                Choose sign up page <img src="https://img.icons8.com/cotton/64/000000/hand-right--v2.png" style="width: 40px; height: 40px;">
                                </h1>
        
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 defined">
                    <div class="banner_text_iner">
                        <div class="row">
                            <div class="col-sm-4">
                                <button class="btnsDef" onclick='location.href="{{ route('Drivers') }}"'>For Vehicle Owners</button>
                            </div>
                            <div class="col-sm-4">
                                <button class="btnsDef" onclick='location.href="{{ route('Businesses') }}"'>For Business</button>
                            </div>
                            <div class="col-sm-4">
                                <button class="btnsDef" onclick='location.href="{{ route('Autocares') }}"'>For Professional Mechanics</button>
                            </div>
                        </div>

                        @if(Auth::user())
                        <div class="row">
                            <div class="col-sm-12">
                                <center><img class="animated slideInRight" src="https://crunchylinks.com/wp-content/uploads/2019/02/mechanic.png"></center>

                            </div>
                        </div>

                        @else
                        <div class="row">
                            <div class="col-sm-8">
                                <center><img class="animated slideInRight" src="https://crunchylinks.com/wp-content/uploads/2019/02/mechanic.png"></center>

                            </div>
                            <div class="col-sm-4">
                               <a href="{{ route('Signupfree') }}"> <img class="animated slideInRight" src="https://cdn.clipart.email/fdec85f2550eb868a0d791070573d3dc_discovery-bay-yacht-club-home_345-300.png" style="width: auto; height: 130px;">
                                <img class="animated slideInRight" src="https://www.freepngimg.com/thumb/free/8-2-free-png-clipart.png" style="width: auto; height: 90px; position: relative; top: -10px;"></a>
                            </div>
                        </div>

                        @endif

                        

                        
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- banner part start-->


@endsection