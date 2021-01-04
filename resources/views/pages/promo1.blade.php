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
                            <h1 class="m-t-0" id="headz">Vehicle Inspection &<br> Maintenance File
                                </h1>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 defined">
                    <div class="banner_text_iner">
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btnsDef" onclick="promoUser('appointment')">Request for Quote or Book An Appointment</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btnsDef" onclick="promoUser('search')">Search by City, <br>Postal/Zip Code</button>
                                <br><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6" onclick="promoUser('appointment')">
                                <center><img style="border-radius: 1px solid grey; cursor: pointer;" class="animated slideInRight" src="https://www.pngitem.com/pimgs/m/200-2005359_book-an-appointment-hd-png-download.png"></center>

                            </div>

                            <div class="col-md-6" onclick="promoUser('search')">

                                <center>
                                    <img style="border-radius: 1px solid grey; cursor: pointer;" class="animated slideInRight imgPromo " src="https://image.flaticon.com/icons/png/512/20/20699.png">
                                    <br><br>
                                    <div class="someSearch disp-0">
                                        <small style="color: red; font-weight: bolder; font-size: 14px;">Save up to 15% on Auto Repair</small>
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Search by City, Postal/Zip Code"><br>
                                    <button class="btn btn-secondary btn-block" onclick="doSearch()">Search <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                                    </div>
                                    <br>
                                </center>

                            </div>
                        </div>

            <center><a href="{{ route('Businesses') }}" style="font-size: 18px; color: navy; font-weight: bold; text-align: center;">Learn about vimfile for Business</a></center>
            
            <br>
                        
                    </div>
                </div>


            </div>



        </div>
    </section>
    <!-- banner part start-->

@endsection