@extends('layouts.app')


@section('text/css')

<style>
    .first_info{
        margin-top: 50px;
    }
    .font-size-15{
        font-size: 16px;
    }
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
            width: 95% !important;

        }
        #headz, #linkz{
        font-size: 30px; background-color: #394f75; padding: 10px; width: 95%; margin-bottom: 50px;
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
            <div class="first_info">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="banner_text">
                                <div class="banner_text_iner">
                                    <h1 class="m-t-100" id="headz">FREE Listing: <br> 20X more traffic to your Auto Repair Shop

                                        </h1>

                                        <p class="memo">Reply to After-service reviews with a direct message.
                                <br><br>

                                Receive online appointment and submit estimates or quotes.
                                <br><br>

                                Track Profile views by visitors and generate leads, and<br><br>

                                Get found faster by vehicle owners within your postal/zip code.
                                <br><br>

                                @if(Auth::user())
                                    <button class="btnsDef2" onclick="location.href='{{ route('userDashboard') }}'">My Account</button>
                                @else
                                    <button class="btnsDef2" onclick="location.href='{{ route('register') }}'">Do you need Auto repair shop software? Use Busy Wrench for Free forever</button>
                                @endif
                            </p>

                            {{-- <a href="{{ route('register') }}" type="button" class="btn btn-primary" style="font-size: 16px; width: inherit">Do you need Auto repair shop software?<br> Use Busy Wrench for Free forever</a> --}}



                                        @if(Auth::user())
                                        @if(Auth::user()->userType == "Commercial" && Auth::user()->status == "2")

                                            <button class="btnsDef2" onclick="location.href='{{ route('Pricing') }}'">Account not yet activated. Kindly click to visit the pricing page to make payment</button>

                                            @elseif(Auth::user()->userType == "Certified Professional" && Auth::user()->status == "2")
                                            <button class="btnsDef2" onclick="location.href='{{ route('Contact') }}'">Account not yet activated. Kindly click to contact vimfile support team</button>
                                        @endif
                                        @endif

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 defined">
                            <div class="banner_text_iner">

                                <iframe width="100%" height="350" src="https://res.cloudinary.com/pilstech/video/upload/v1590059641/mechanic3_fuhazr.mp4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture; loop" allowfullscreen></iframe>


                                {{-- <div class="row">
                                    <div class="col-sm-4">
                                        <button class="btnsDef" onclick='location.href="{{ route('Drivers') }}"'>For Individuals</button>
                                    </div>
                                    <div class="col-sm-4">
                                        <button class="btnsDef" onclick='location.href="{{ route('Businesses') }}"'>For Business</button>
                                    </div>
                                    <div class="col-sm-4">
                                        <button class="btnsDef" onclick='location.href="{{ route('Autocares') }}"'>For Professional Mechanics</button>
                                    </div>
                                </div> --}}

                                {{-- @if(Auth::user())
                                <div class="row">
                                    <div class="col-sm-12">
                                        <center><img class="animated slideInRight" src="https://crunchylinks.com/wp-content/uploads/2019/02/mechanic.png" alt="mechanic"></center>

                                    </div>
                                </div>

                                @else
                                <div class="row">
                                    <div class="col-sm-8">
                                        <center><img class="animated slideInRight" src="https://crunchylinks.com/wp-content/uploads/2019/02/mechanic.png" alt="mechanic"></center>

                                    </div>
                                    <div class="col-sm-4">
                                    <a href="{{ route('Signupfree') }}"> <img class="animated slideInRight" src="https://cdn.clipart.email/fdec85f2550eb868a0d791070573d3dc_discovery-bay-yacht-club-home_345-300.png" alt="bay-yacht" style="width: auto; height: 130px;">
                                        <img class="animated slideInRight" src="https://www.freepngimg.com/thumb/free/8-2-free-png-clipart.png" alt="freepngimg" style="width: auto; height: 90px; position: relative; top: -10px;"></a>
                                    </div>
                                </div>

                                @endif --}}




                            </div>
                        </div>
                    </div>
            </div>

        </div>
        <center><img src="https://img.icons8.com/ios-filled/50/000000/circled-down-2.png" class="animated infinite bounce delay-1s" alt="icon8" style="width: 50px; height: 50px; position: relative; top: 0px; cursor: pointer;" onclick="scrollTarget('indexs_target')"></center>
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
                                    <img src="img/icon/feature_icon_1.png" alt="feature_icon_1">
                                    <h4>A Volunteer</h4>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="single_feature">
                                <div class="single_feature_part">
                                    <img src="img/icon/feature_icon_2.png" alt="feature_icon_2">
                                    <h4>A Volunteer</h4>
                                    <p></p>
                                </div>
                            </div>
                            <div class="single_feature">
                                <div class="single_feature_part single_feature_part_2">
                                    <img src="img/icon/feature_icon_3.png" alt="feature_icon_3">
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
                        <a href="#" class="btn_4">learn more <img src="img/icon/right-arrow.svg" alt="right-arrow"></a>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- upcoming_event part start-->


       <!-- feature_part start-->
    <section class="feature_part padding_top" id="indexs_target">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                <div class="col-md-12">
                    <div class="wprt-spacer clearfix" data-desktop="83" data-mobi="60" data-smobi="60"></div>

                    <div class="wprt-headings style-1 clearfix text-center">
                        <h2 class="heading clearfix">Vimfile for Auto Repair Shop <br>
                            (Auto Repair Shop Software)</h2>
                        <div class="sep clearfix"></div>
                    </div><!-- /.wprt-headings -->

                    <div class="wprt-spacer clearfix" data-desktop="50" data-mobi="40" data-smobi="40"></div>
                </div><!-- /.col-md-12 -->



                <div class="col-md-7">
                    <div class="wprt-spacer clearfix" data-desktop="104" data-mobi="60" data-smobi="60"></div>

                    <div class="wprt-headings style-1 clearfix">
                        <h2 class="heading clearfix">SHOP MANAGEMENT</h2>
                        <div class="sep clearfix"></div>
                    </div><!-- /.wprt-headings -->

                    <div class="wprt-spacer clearfix" data-desktop="30" data-mobi="25" data-smobi="25"></div>

                    <div class="wprt-tabs clearfix style-1">

                        <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">FEATURES</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">BENEFITS</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      <div class="item-content"><br>

                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                        <div class="inner">
                                            <span class="icon-wrap">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text font-size-15">Prepare Estimates (print/email).</span>
                                            </span>
                                        </div>
                                    </div><!-- /.wprt-list -->
                                    <br>
                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                        <div class="inner">
                                            <span class="icon-wrap">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text font-size-15">Generate Work Order (print/email).</span>
                                            </span>
                                        </div>
                                    </div><!-- /.wprt-list -->
                                    <br>
                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                        <div class="inner">
                                            <span class="icon-wrap">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text font-size-15">Track Work in Progress and close out.</span>
                                            </span>
                                        </div>
                                    </div><!-- /.wprt-list -->
                                    <br>
                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                        <div class="inner">
                                            <span class="icon-wrap">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text font-size-15">Multi-Location Inventory Management.</span>
                                            </span>
                                        </div>
                                    </div><!-- /.wprt-list -->
                                    <br>
                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                        <div class="inner">
                                            <span class="icon-wrap">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text font-size-15">Access to maintenance history of any vehicle.</span>
                                            </span>
                                        </div>
                                    </div><!-- /.wprt-list -->
                                    <br>
                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                        <div class="inner">
                                            <span class="icon-wrap">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text font-size-15">Cash report and management for outlets.</span>
                                            </span>
                                        </div>
                                    </div><!-- /.wprt-list -->
                                    <br>

                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                        <div class="inner">
                                            <span class="icon-wrap">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text font-size-15">Revenue Report on Parts and Outlets.</span>
                                            </span>
                                        </div>
                                    </div><!-- /.wprt-list -->
                                    <br>
                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                        <div class="inner">
                                            <span class="icon-wrap">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text font-size-15">Generate periodic Common Size Financial Statement for your autocare.</span>
                                            </span>
                                        </div>
                                    </div><!-- /.wprt-list -->

                                    <br>
                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                        <div class="inner">
                                            <span class="icon-wrap">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text font-size-15">Track Tax deductions and claims.</span>
                                            </span>
                                        </div>
                                    </div><!-- /.wprt-list -->

                                    <br>
                                </div>


  </div>


  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

      <div class="item-content"><br>


                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                        <div class="inner">
                                            <span class="icon-wrap">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text font-size-15">Online appointment booking.</span>
                                            </span>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- /.wprt-list -->

                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                        <div class="inner">
                                            <span class="icon-wrap">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text font-size-15">Free Directory Listing.</span>
                                            </span>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- /.wprt-list -->

                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                        <div class="inner">
                                            <span class="icon-wrap">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text font-size-15">Good system internal controls and checks.</span>
                                            </span>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- /.wprt-list -->

                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                        <div class="inner">
                                            <span class="icon-wrap">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text font-size-15">Good for multi-locations autocare centres.</span>
                                            </span>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- /.wprt-list -->


                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                        <div class="inner">
                                            <span class="icon-wrap">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text font-size-15">Manage Business from any device, anywhere, anytime.</span>
                                            </span>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- /.wprt-list -->

                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                        <div class="inner">
                                            <span class="icon-wrap">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text font-size-15">24/7 Support Services.</span>
                                            </span>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- /.wprt-list -->


                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                        <div class="inner">
                                            <span class="icon-wrap">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text font-size-15">No contract. Use for FREE for 30day. Cancel anytime.</span>
                                            </span>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- /.wprt-list -->


                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                        <div class="inner">
                                            <span class="icon-wrap">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text font-size-15">Migrate from existing software with ease.</span>
                                            </span>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- /.wprt-list -->

                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                        <div class="inner">
                                            <span class="icon-wrap">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text font-size-15">No limit to number of computers to use.</span>
                                            </span>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- /.wprt-list -->
                                </div>


  </div>
</div>


                    </div><!-- /.wprt-tabs -->

                    <div class="wprt-spacer clearfix" data-desktop="0" data-mobi="35" data-smobi="35"></div>
                </div><!-- /.col-md-7 -->

                <div class="col-md-5">
                    <div class="wprt-spacer clearfix" data-desktop="20" data-mobi="10" data-smobi="10"></div>

                    <img src="https://busywrench.vimfile.com/assets/img/technicial.png" alt="Image" />
                </div><!-- /.col-md-5 -->


                {{-- @if(Auth::user())

                <div class="col-lg-4" style="cursor: pointer;">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="img/icon/feature_icon_2.png" alt="feature_icon_2">
                            <h4>Search for a Certified Mechanic / an Auto care center near you</h4>
                            <p></p>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4" style="cursor: pointer;">
                    <div class="single_feature">
                        <div class="single_feature_part single_feature bookings">
                            <img src="img/icon/feature_icon_3.png" alt="feature_icon_3">
                            <h4>Book an Appointment</h4>
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4" style="cursor: pointer;">
                    <div class="single_feature">
                                <div class="single_feature_part bookings">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTfyT4idoO6VOoDZNVrFg0UncCQxLNwWT8BQc7P8AVf0IC9F44T" alt="encrypted-tbn0" style="height: 80px !important;">
                                    <a href="{{ route('userDashboard') }}"><h4>My Account</h4>
                                    <p></p>
                                </div>
                            </div>

                    </div>

                    @else

                    <div class="col-lg-4">
                    <div class="single_feature ">
                        <div class="single_feature_part bookings">
                            <img src="img/icon/feature_icon_2.png" alt="feature_icon_2">
                            <a href="{{ route('register') }}"><h4>Search for a Certified Mechanic / an Auto care center near you</h4></a>
                            <p></p>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="single_feature ">
                        <div class="single_feature_part single_feature_part bookings">
                            <img src="img/icon/feature_icon_3.png" alt="feature_icon_3">
                            <a href="{{ route('register') }}"><h4>Book an Appointment</h4></a>
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="single_feature">
                                <div class="single_feature_part bookings">
                                    <img src="https://www.fliff.com/wp-content/uploads/become_a_member.png" alt="become_a_member" style="height: 80px !important;">
                                    <a href="{{ route('Signupfree') }}"><h4>Become a Member</h4></a>
                                    <p></p>
                                </div>
                            </div>

                    </div>

                @endif --}}

            </div>
        </div>


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
                        <img src="https://konigwheels.com/wp-content/uploads/2018/12/tm-graph.png" alt="konigwheels">
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- about_us part end-->




    <!-- feature_part start-->
    <section class="feature_part padding_top">



        <div class="container">
            <div class="row align-items-center justify-content-between">




                <div class="col-md-5">
                    <div class="wprt-spacer clearfix" data-desktop="20" data-mobi="10" data-smobi="10"></div>

                    <img src="https://busywrench.vimfile.com/assets/img/technicial.png" alt="Image" />
                </div><!-- /.col-md-5 -->



                <div class="col-md-7">
                    <div class="wprt-spacer clearfix" data-desktop="104" data-mobi="60" data-smobi="60"></div>

                    <div class="wprt-headings style-1 clearfix">
                        <h2 class="heading clearfix">OPERATION MANAGEMENT</h2>
                        <div class="sep clearfix"></div>
                    </div><!-- /.wprt-headings -->

                    <div class="wprt-spacer clearfix" data-desktop="30" data-mobi="25" data-smobi="25"></div>

                    <div class="wprt-tabs clearfix style-1">

                        <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-customer-tab" data-toggle="tab" href="#nav-customer" role="tab" aria-controls="nav-customer" aria-selected="true">CUSTOMERS</a>
    <a class="nav-item nav-link" id="nav-inventory-tab" data-toggle="tab" href="#nav-inventory" role="tab" aria-controls="nav-inventory" aria-selected="false">INVENTORY</a>
    <a class="nav-item nav-link" id="nav-vendors-tab" data-toggle="tab" href="#nav-vendors" role="tab" aria-controls="nav-vendors" aria-selected="false">VENDORS</a>
    <a class="nav-item nav-link" id="nav-technicians-tab" data-toggle="tab" href="#nav-technicians" role="tab" aria-controls="nav-technicians" aria-selected="false">TECHNICIANS</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-customer" role="tabpanel" aria-labelledby="nav-customer-tab">
        <div class="item-content"><br>

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Generate and Send invoice (email/Print).</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Receive payment -Cash, Credit card, Bank Transfer, checks.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Automatically update client’s maintenance records.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Set up maintenance reminders for clients.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Online/Real time responds to technical questions.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->
        </div>


  </div>


  <div class="tab-pane fade" id="nav-inventory" role="tabpanel" aria-labelledby="nav-inventory-tab">

        <div class="item-content"><br>

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Generate Purchase order (print/email).</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Confirm Delivery (confirmation sent to Vendors).</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Purchase Order monitoring.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Transfer Parts from Purchase Order(PO) to Inventory.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Track Parts Consumed.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Track Profit/Margin on Parts consumed.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Track inventory balance by category.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->
        </div>


  </div>



  <div class="tab-pane fade" id="nav-vendors" role="tabpanel" aria-labelledby="nav-vendors-tab">

        <div class="item-content"><br>
            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Set up vendors & details.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Track Purchase Order(PO) issues to vendors.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Track delivery by Vendors.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Track Invoices paid and outstanding for vendors.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Generate Vendors balance and reconcile account.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->
        </div>


  </div>



  <div class="tab-pane fade" id="nav-technicians" role="tabpanel" aria-labelledby="nav-technicians-tab">

        <div class="item-content"><br>

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Set Up technicians & Details.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Track Time sheet.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Track hours work on work order.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Track Labour cost on Completed work.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Generate Labour cost report per category of work.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Review Labour Cost management schedule.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->

            <div class="wprt-list clearfix icon-left icon-top style-1">
                <div class="inner">
                    <span class="icon-wrap">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <span class="text font-size-15">Track Work order assigned to technician.</span>
                    </span>
                </div>
            </div><br>
            <!-- /.wprt-list -->
        </div>


  </div>





</div>


                    </div><!-- /.wprt-tabs -->

                    <div class="wprt-spacer clearfix" data-desktop="0" data-mobi="35" data-smobi="35"></div>
                </div><!-- /.col-md-7 -->




                {{-- @if(Auth::user())

                <div class="col-lg-4" style="cursor: pointer;">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="img/icon/feature_icon_2.png" alt="feature_icon_2">
                            <h4>Search for a Certified Mechanic / an Auto care center near you</h4>
                            <p></p>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4" style="cursor: pointer;">
                    <div class="single_feature">
                        <div class="single_feature_part single_feature bookings">
                            <img src="img/icon/feature_icon_3.png" alt="feature_icon_3">
                            <h4>Book an Appointment</h4>
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4" style="cursor: pointer;">
                    <div class="single_feature">
                                <div class="single_feature_part bookings">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTfyT4idoO6VOoDZNVrFg0UncCQxLNwWT8BQc7P8AVf0IC9F44T" alt="encrypted-tbn0" style="height: 80px !important;">
                                    <a href="{{ route('userDashboard') }}"><h4>My Account</h4>
                                    <p></p>
                                </div>
                            </div>

                    </div>

                    @else

                    <div class="col-lg-4">
                    <div class="single_feature ">
                        <div class="single_feature_part bookings">
                            <img src="img/icon/feature_icon_2.png" alt="feature_icon_2">
                            <a href="{{ route('register') }}"><h4>Search for a Certified Mechanic / an Auto care center near you</h4></a>
                            <p></p>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="single_feature ">
                        <div class="single_feature_part single_feature_part bookings">
                            <img src="img/icon/feature_icon_3.png" alt="feature_icon_3">
                            <a href="{{ route('register') }}"><h4>Book an Appointment</h4></a>
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="single_feature">
                                <div class="single_feature_part bookings">
                                    <img src="https://www.fliff.com/wp-content/uploads/become_a_member.png" alt="become_a_member" style="height: 80px !important;">
                                    <a href="{{ route('Signupfree') }}"><h4>Become a Member</h4></a>
                                    <p></p>
                                </div>
                            </div>

                    </div>

                @endif --}}

            </div>
        </div>


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
                        <img src="https://konigwheels.com/wp-content/uploads/2018/12/tm-graph.png" alt="konigwheels">
                    </div>
                </div>
            </div>
        </div>

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
                    <a href="{{ route('register') }}">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_dashboard_ojaaee.jpg" alt="SyuXx-GGl_large">
                            <a href="{{ route('register') }}"><h4>Individual</h4></a>
                            <p></p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="{{ route('register', 'c=business') }}">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_key_ww5mak.jpg" alt="2016_kia">
                            <a href="{{ route('register', 'c=business') }}"><h4>Business Owners</h4></a>
                            <p></p>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <a href="{{ route('Autocares') }}">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_gear_nzqipu.webp" alt="2.jpg">
                            <a href="{{ route('Autocares') }}"><h4>Professional Mechanics</h4></a>
                            <p></p>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>

    </section>
    <!-- use sasu part end-->
    @else

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
                    <a href="{{ route('register') }}">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_dashboard_ojaaee.jpg" alt="SyuXx-GGl_large">
                            <a href="{{ route('register') }}"><h4>Individual</h4></a>
                            <p></p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="{{ route('register', 'c=business') }}">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_key_ww5mak.jpg" alt="2016_kia">
                            <a href="{{ route('register', 'c=business') }}"><h4>Business Owners</h4></a>
                            <p></p>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <a href="{{ route('Autocares') }}">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_gear_nzqipu.webp" alt="2.jpg">
                            <a href="{{ route('Autocares') }}"><h4>Professional Mechanics</h4></a>
                            <p></p>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>

    </section>
    <!-- use sasu part end-->

    @endif


    @else

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
                    <a href="{{ route('register') }}">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_dashboard_ojaaee.jpg" alt="SyuXx-GGl_large">
                            <a href="{{ route('register') }}"><h4>Individual</h4></a>
                            <p></p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="{{ route('register', 'c=business') }}">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_key_ww5mak.jpg" alt="2016_kia">
                            <a href="{{ route('register', 'c=business') }}"><h4>Business Owners</h4></a>
                            <p></p>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <a href="{{ route('Autocares') }}">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_gear_nzqipu.webp" alt="2.jpg">
                            <a href="{{ route('Autocares') }}"><h4>Professional Mechanics</h4></a>
                            <p></p>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>

    </section>
    <!-- use sasu part end-->

    @endif


    @else

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
                    <a href="{{ route('register') }}">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_dashboard_ojaaee.jpg" alt="SyuXx-GGl_large">
                            <a href="{{ route('register') }}"><h4>Individual</h4></a>
                            <p></p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="{{ route('register', 'c=business') }}">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_key_ww5mak.jpg" alt="2016_kia">
                            <a href="{{ route('register', 'c=business') }}"><h4>Business Owners</h4></a>
                            <p></p>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <a href="{{ route('Autocares') }}">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1604505123/car_gear_nzqipu.webp" alt="2.jpg">
                            <a href="{{ route('Autocares') }}"><h4>Professional Mechanics</h4></a>
                            <p></p>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>

    </section>
    <!-- use sasu part end-->

    @endif

    {{-- News and Happenings --}}

    <section class="use_sasu m-t-100 m-b-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section_tittle text-center">
                        <h2>News and Happenings</h2>
                        <p> </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">

                @if(count($postActive) > 0)

                @foreach($postActive as $postActives)

                    <div class="col-lg-6 col-sm-6" style="cursor: pointer;" onclick="location.href='/newshappeningspost/{{ $postActives->id }}'">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            @if($postActives->file_upload != null) <img src="/newsfile/{{ $postActives->file_upload }}" alt="{{ $postActives->file_upload }}"> @else <img src="https://i.ya-webdesign.com/images/no-png-transparent-1.png" alt="nofile"> @endif
                            <h4>{{ $postActives->subject }}</h4>
                            <p>Date & Time Posted: {{ date('d-M-Y', strtotime($postActives->created_at)) }}</p>
                            <hr>
                            <p>

                                <?php $string = strip_tags($postActives->description); $output = strlen($string) > 500 ? substr($string,0,500)."..." : $string; echo $output;?>

                                {{-- {!! strip_tags($postActives->description) !!} --}}
                            </p>
                            <br>
                            <p>
                                @if($postActives->file_upload != null)
                                    <a style="color: navy; font-weight: bold;" href="/newsfile/{{ $postActives->file_upload }}" target="_blank">Open File</a>
                                @endif
                            </p>
                        </div>

                    </div>
                </div>

                @endforeach

                @else

                <div class="col-lg-12 col-sm-6">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTi-eWZzqnXsKDLccrhfVHituGb0ZgurkVtKq3C7ehIjNH5bsXY" alt="encrypted-tbn0">
                            <h4>No Post Yet</h4>
                            <p>
                            </p>
                        </div>
                    </div>
                </div>

                @endif


            </div>
            <br>
            @if(count($postActive) > 2)<center><button class="btn btn-secondary" onclick="location.href= '{{ route('News and hapenings') }}'">View More</button></center>@endif
        </div>

    </section>


    {{-- End News and Happenings --}}


    {{-- Blog Posts --}}

    <section class="use_sasu m-t-100 m-b-100 disp-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section_tittle text-center">
                        <h2>Blog Posts</h2>
                        <p> </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">

                @if(count($postActive) > 0)

                @foreach($postActive as $postActives)

                    <div class="col-lg-6 col-sm-6" style="cursor: pointer;" onclick="location.href='/newshappeningspost/{{ $postActives->id }}'">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://cdn3.iconfinder.com/data/icons/leaf/256/blogger.png" alt="blogger{{ $postActives->id }}">
                            <h4>{{ $postActives->subject }}</h4>
                            <p>Date & Time Posted: {{ date('d-M-Y', strtotime($postActives->created_at)) }}</p>
                            <hr>
                            <p>

                                <?php $string = strip_tags($postActives->description); $output = strlen($string) > 500 ? substr($string,0,500)."..." : $string; echo $output;?>

                                {{-- {!! strip_tags($postActives->description) !!} --}}
                            </p>
                            <br>
                            <p>
                                @if($postActives->file_upload != null)
                                    <a style="color: navy; font-weight: bold;" href="/newsfile/{{ $postActives->file_upload }}" target="_blank">Open File</a>
                                @endif
                            </p>
                        </div>

                    </div>
                </div>

                @endforeach

                @else

                <div class="col-lg-12 col-sm-6">
                    <div class="single_feature">
                        <div class="single_feature_part bookings">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTi-eWZzqnXsKDLccrhfVHituGb0ZgurkVtKq3C7ehIjNH5bsXY" alt="encrypted-tbn0">
                            <h4>No Post Yet</h4>
                            <p>
                            </p>
                        </div>
                    </div>
                </div>

                @endif


            </div>
            <br>
            @if(count($postActive) > 2)<center><button class="btn btn-secondary" onclick="location.href= '{{ route('News and hapenings') }}'">View More</button></center>@endif
        </div>

    </section>


    {{-- End Blog Posts --}}


    <!-- about_us part start-->
    <section class="about_us right_time section_padding disp-0">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-6 col-lg-6">
                    <div class="learning_img">
                        <img src="https://dustbowl.files.wordpress.com/2010/03/gear_shift_lever_thonet_2.jpg" alt="gear_shift">
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
