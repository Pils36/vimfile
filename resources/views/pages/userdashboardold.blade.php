@extends('layouts.app')

@section('text/css')

<?php use \App\Http\Controllers\Vehicleinfo; ?>
<?php use \App\Http\Controllers\User; ?>
<?php use \App\Http\Controllers\PaySchedule; ?>
<?php use \App\Http\Controllers\LabourPaystub; ?>
<?php use \App\Http\Controllers\GoogleImport; ?>
<?php use \App\Http\Controllers\PrepareEstimate; ?>

<style>
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
        border: 1px solid black;
        background-color: #394f75 !important;
    }
    #myTab > li{
        border: 1px solid black;
    }
    #myTab > li a{
        font-size: 12.5px;
    }
    .partSection{
    position: relative;
    background: aliceblue;
    width: 100%;
    height: auto;
    padding: 50px;
    }
    .nice-select{
        width: 100% !important;
    }
    .btn-default{
        border: 1px solid black !important;
    }
    .list{
        height: 40vh;
        overflow-y: auto !important;
    }
    .editPass{
        border: 1px solid #f2f2f2;
        padding: 15px;
        width: 100%;
        position: relative;
        margin: 0 auto;
        background: lightblue;
    }
    .insert{
        border: 1px solid #000;
        padding: 2px;
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

    #headz{
        font-size: 33px; background-color: #394f75; padding: 10px; width: 450px;
    }



    @media (max-width: 700px){
        .memo{
            width: 100% !important;
            padding-right: 20px !important;

        }
        #headz{
        font-size: 33px; background-color: #394f75; padding: 10px; width: auto; margin-bottom: 50px;
    }
    .search_boxes{
        position: relative;
        top: -30px;
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

                            <button class="btn btn-primary genfeed disp-0" onclick="genFeedback('{{ Auth::user()->ref_code }}')">Generate Feedback</button>

                            @if(Auth::user()->userType == "Commercial")
                            <div data-step="1" data-intro="My Name is 'Wrench', Your Vimfile Tour Guide. Thanks for signing up on vimfile.com.
I understand that you want to manage your Auto Repair Store more efficiently and i
would be glad assist you to walk-through Vimfile for Auto Repair Centre.
To proceed, click 'Next'"></div>
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
                            @else
                            <div data-step="1" @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional") data-intro="My Name is 'Wrench', Your Vimfile Tour Guide. Thanks for signing up on vimfile.com.
I understand that you want to manage your Auto Repair Store more efficiently and i
would be glad assist you to walk-through Vimfile for Auto Repair Centre.
To proceed, click 'Next' "  @else data-intro="My Name is 'Wrench', Your Vimfile Tour Guide. Thanks for signing up on vimfile.com
I understand that you want to track maintenance activities on your vehicle and i would be glad
to walk-through Vimfile for Vehicle Owner. To proceed, click 'Next' button below." @endif></div>
                                <h1>Maintenance <span style="text-transform: lowercase;">i</span>VIM
                                                                </h1>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-lg-5 disp-0">
                    <div class="search_boxes">
                        <img class="spinnerAutocare disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px; float: right;">
                        <div class="auto_care">
                            <label><p>Find Mobile Mechanics/Autocare Center Near You</p></label>
                            <input type="text" name="auto_care" id="auto_care" class="form-control" placeholder="Find by Area/City">
                        </div>
                        <div class="auto_care disp-0">
                            <label><p>Find for Tow Truck Company Near You</p></label>
                            <input type="text" name="tow_ruck" id="tow_ruck" class="form-control" placeholder="Find by Area/City" readonly="" disabled="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <center><img src="https://img.icons8.com/ios-filled/50/000000/circled-down-2.png" class="animated infinite bounce delay-1s" style="width: 40px; height: 40px; position: relative; top: 0px; cursor: pointer;" onclick="scrollTarget('userDash')"></center>
    </section>
    <!-- banner part start-->

    <!-- feature_part start-->
    <section class="feature_part p-t-70 p-b-70" id="userDash">


        <div class="container">

            @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")

                <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional") data-step="8" data-intro="Use this to respond to Request for Estimates from vehicle owners near you" @elseif(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer") data-step="4" data-intro="You can request for Estimate from all professional Autocare centres and mobile mechanics within your postal code/area by completing this form.
Simply describe the problem and you have a quality list of Estimates to select from." @elseif(Auth::user()->userType == "Individual") data-step="3" data-intro="You can request for Estimate from all professional Autocare centres and mobile mechanics within your postal code/area by completing this form.
Simply describe the problem and you have a quality list of Estimates to select from." @elseif(Auth::user()->userType == "Commercial") data-step="4" data-intro="You can request for Estimate from all professional Autocare centres and mobile mechanics within your postal code/area by completing this form.
Simply describe the problem and you have a quality list of Estimates to select from." @endif>

    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#opportunity" role="tab" aria-controls="opportunity" aria-selected="true">@if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional") Opportunity @else Request for Estimate <span style="color: #fff; background: brown; padding: 5px 10px; text-align: center; border-radius: 100%">@if(count($quotedEst) > 0) {{ count($quotedEst) }} @else 0 @endif</span> @endif @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional") <span style="color: #fff; background: brown; padding: 5px 10px; text-align: center; border-radius: 100%">@if(count($opportunities) > 0 || count($myBookings) > 0) {{ count($opportunities) + count($myBookings) }} @else 0 @endif</span> @endif</a>

  </li>
  <li class="nav-item">
    <a class="nav-link" id="myreviews-tab" data-toggle="tab" href="#myreviews" role="tab" aria-controls="myreviews" aria-selected="false">Service Review <span style="color: #fff; background: brown; padding: 5px 10px; text-align: center; border-radius: 100%">{{ count($myreviews) }}</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="recordmaintenance-tab" data-toggle="tab" href="#recordmaintenance" role="tab" aria-controls="recordmaintenance" aria-selected="false">Shop Management</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="opportunity" role="tabpanel" aria-labelledby="opportunity-tab">


{{-- Start Menu for Vehicle maint --}}
<br>

<ul class="nav nav-tabs" id="myTab" role="tablist">

    @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")

    <li class="nav-item">
    <a class="nav-link active" id="appointment-tab" data-toggle="tab" href="#appointment" role="tab" aria-controls="appointment" aria-selected="false">Appointment <span style="color: #fff; background: brown; padding: 5px 10px; text-align: center; border-radius: 100%">@if(count($myBookings) > 0) {{ count($myBookings) }} @else 0 @endif</span></a>
  </li>

    @endif

  <li class="nav-item">
    <a class="nav-link @if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == 'Commercial') active @endif" id="recordposttoboads-tab" data-toggle="tab" href="#recordposttoboads" role="tab" aria-controls="recordposttoboads" aria-selected="true">@if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == 'Commercial')Post to Boards @else Opportunity Posts <span style="color: #fff; background: brown; padding: 5px 10px; text-align: center; border-radius: 100%">@if(count($opportunities) > 0) {{ count($opportunities) }} @else 0 @endif</span> @endif</a>
  </li>

  @if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == 'Commercial')

  <li class="nav-item">
    <a class="nav-link" id="allpostedopport-tab" data-toggle="tab" href="#allpostedopport" role="tab" aria-controls="allpostedopport" aria-selected="false">Posted Opportunities</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="allestimatepropose-tab" data-toggle="tab" href="#allestimatepropose" role="tab" aria-controls="allestimatepropose" aria-selected="false">Estimate Received <span style="color: #fff; background: brown; padding: 5px 10px; text-align: center; border-radius: 100%">@if(count($quotedEst) > 0) {{ count($quotedEst) }} @else 0 @endif</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="ongoingmaintenance-tab" data-toggle="tab" href="#ongoingmaintenance" role="tab" aria-controls="ongoingmaintenance" aria-selected="false">Ongoing Maintenance</a>
  </li>

  @endif

  @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")
  <li class="nav-item">
    <a class="nav-link" id="allapprovedest-tab" data-toggle="tab" href="#allapprovedest" role="tab" aria-controls="allapprovedest" aria-selected="false">Approved Estimates</a>
  </li>


  <li class="nav-item">
    <a class="nav-link" id="allsubmittedest-tab" data-toggle="tab" href="#allsubmittedest" role="tab" aria-controls="allsubmittedest" aria-selected="false">Submitted Estimates</a>
  </li>


  @endif

  <li class="nav-item">
    <a class="nav-link" id="jobdone-tab" data-toggle="tab" href="#jobdone" role="tab" aria-controls="jobdone" aria-selected="false">Job Done</a>
  </li>


</ul>

<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade @if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == 'Commercial')show active @endif" id="recordposttoboads" role="tabpanel" aria-labelledby="recordposttoboads-tab">
      {{-- Start Post to Board --}}

        <div class="card">

            @if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == 'Commercial')


            <div id="connectioncollapse" class="collapse show" aria-labelledby="connectionHead" data-parent="#accordion">
              <div class="card-body">
                <div class="itembody">
                    <h5 style="color: darkorange; font-weight: bold;">Request for Auto Repair Estimate</h5> <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <h5 style="color: #394f75; font-weight: bold;">Service Type</h5>
                        </div>
                        <div class="col-md-9">
                            <input type="hidden" name="postIDs" id="postIDs" class="form-control" value="{{ 'POST_'.mt_rand('10000', '99999') }}">

                            <select name="postSubject" id="postSubject" class="form-control">
                                        <option value="Service" selected="selected" disabled="disabled">Service</option>
                                        <optgroup label="Admin"><option value="inspection">inspection</option><option value="registration">registration</option><option value="insurance">insurance</option><option value="road assistance">road assistance</option><option value="business taxes">business taxes</option><option value="Road Fines">Road Fines</option><option value="Ticket">Ticket</option></optgroup>
                                        <optgroup label="Fuel"><option value="fuel">fuel</option><option value="car wash">car wash</option></optgroup>
                                        <optgroup label="Maintenance"><option value="air conditioning recharge">air conditioning recharge</option><option value="air filter">air filter</option><option value="battery">battery</option><option value="brake fluid flush">brake fluid flush</option><option value="brake pads">brake pads</option><option value="brake rotors">brake rotors</option><option value="coolant flush">coolant flush</option><option value="distributor cap &amp; rotor">distributor cap &amp; rotor</option><option value="fuel filter">fuel filter</option><option value="headlight">headlight</option><option value="oil change">oil change</option><option value="power steering flush">power steering flush</option><option value="spark plugs">spark plugs</option><option value="timing belt">timing belt</option><option value="tire - new">tire - new</option><option value="tire balancing">tire balancing</option><option value="tire inflation">tire inflation</option><option value="tire rotation">tire rotation</option><option value="wheel rotation and tire balancing">Wheel Rotation & Tire Balancing</option><option value="transmission fluid flush">transmission fluid flush</option><option value="wheel alignment">wheel alignment</option><option value="wiper blades">wiper blades</option><option value="other">other</option><option value="cabin air filter">cabin air filter</option><option value="smog check">smog check</option></optgroup>
                                        <optgroup label="Repairs"><option value="alternator">alternator</option><option value="belt">belt</option><option value="body work">body work</option><option value="brake caliper">brake caliper</option><option value="carburetor">carburetor</option><option value="catalytic converter">catalytic converter</option><option value="clutch">clutch</option><option value="control arm">control arm</option><option value="coolant temperature sensor">coolant temperature sensor</option><option value="exhaust">exhaust</option><option value="fuel injector">fuel injector</option><option value="fuel tank">fuel tank</option><option value="head gasket">head gasket</option><option value="heater core">heater core</option><option value="hose">hose</option><option value="line">line</option><option value="mass air flow sensor">mass air flow sensor</option><option value="muffler">muffler</option><option value="oxygen sensor">oxygen sensor</option><option value="radiator">radiator</option><option value="shock/strut">shock/strut</option><option value="starter">starter</option><option value="thermostat">thermostat</option><option value="tie rod">tie rod</option><option value="transmission">transmission</option><option value="water pump">water pump</option><option value="wheel bearings">wheel bearings</option><option value="window">window</option><option value="windshield">windshield</option><option value="road side assistance">road side assistance</option><option value="other">other</option><option value="sensor">sensor</option>
                                        </optgroup>
                                    </select>

                            {{-- <input type="text" name="postSubject" id="postSubject" class="form-control" placeholder="Request Subject"> --}}
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-3">
                            <h5 style="color: #394f75; font-weight: bold;">Service Option</h5>
                        </div>
                        <div class="col-md-9">
                            <select name="postServeoption" id="postServeoption" class="form-control">
                                <option value="Major Repair">Major Repair</option>
                                <option value="Minor Repair">Minor Repair</option>
                                <option value="Scheduled Maintenance">Scheduled Maintenance</option>
                                <option value="Emergency Maintenance">Emergency Maintenance</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <h5 style="color: #394f75; font-weight: bold;">Vehicle Information</h5>
                        </div>
                        <div class="row col-md-9">

                            <div class="col-md-3">
                                <h6 style="color: #394f75; font-weight: bold;">Vehicle Licence</h6>
                                <select class="form-control" name="postlicence" id="postlicence">
                                    <option value="">Select Licence</option>
                                    @if(count($carrecord) > 0)

                                    @foreach($carrecord as $licence)

                                        <option value="{{ $licence->vehicle_reg_no }}">{{ $licence->vehicle_reg_no }}</option>

                                    @endforeach

                                    @else

                                    <option>Kindly Register your vehicle</option>

                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <h6 style="color: #394f75; font-weight: bold;">Make</h6>
                                <input type="text" name="postmake" class="form-control" id="postmake" style="width: 100% !important;" readonly="">
                            </div>
                            <div class="col-md-2">
                                <h6 style="color: #394f75; font-weight: bold;">Model</h6>
                                <input type="text" name="postmodel" class="form-control" id="postmodel" style="width: 100% !important;" readonly="">
                            </div>
                            <div class="col-md-2">
                                <h6 style="color: #394f75; font-weight: bold;">Mileage</h6>
                                <input type="text" name="postmileage" class="form-control" id="postmileage" style="width: 100% !important;" readonly="">
                            </div>
                            <div class="col-md-2">
                                <h6 style="color: #394f75; font-weight: bold;">Year</h6>
                                <input type="text" name="postyear" class="form-control" id="postyear" style="width: 100% !important;" readonly="">
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <h5 style="color: #394f75; font-weight: bold;">Current Mileage</h5>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="post_curr_mileage" class="form-control" id="post_curr_mileage" style="width: 100% !important;" placeholder="Type current mileage">
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <h5 style="color: #394f75; font-weight: bold;">Request by</h5>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" id="postrequestby">
                                <option value="">Select option</option>
                                <option value="zipcode">Within postal area</option>
                                <option value="city">Within city</option>
                            </select>
                            <br>
                            <p id="localeresult" style="color: red; font-weight: bold; font-size: 16px;"></p>
                            <hr>
                        </div>

                    </div>


                    <br>
                    <div class="row">
                        <div class="col-md-3"><h5 style="color: #394f75; font-weight: bold;">Request Description</h5></div>
                        <div class="col-md-9"><textarea type="text" name="postDescription" id="postDescription" class="form-control" placeholder="Request Description" style="height: 200px; resize: none;"></textarea>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <h5 style="color: darkorange; font-weight: bold;">Location where Repair is to Take Place</h5> <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <h5 style="color: #394f75; font-weight: bold;">Street</h5>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="postserviceneeded" id="postserviceneeded" class="form-control" placeholder="Street number and Street Name">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <h5 style="color: #394f75; font-weight: bold;">City</h5>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="postcity" id="postcity" class="form-control" placeholder="">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <h5 style="color: #394f75; font-weight: bold;">State</h5>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="poststate" id="poststate" class="form-control" placeholder="">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <h5 style="color: #394f75; font-weight: bold;">Postal / Zip code</h5>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="postzipcode" id="postzipcode" class="form-control" placeholder="">
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-md-3"><h5 style="color: #394f75; font-weight: bold;">Proposal Submission Timeline</h5></div>
                        <div class="col-md-9"><input type="date" name="posttimeline" id="posttimeline" class="form-control">

                            <br>
                    <center>
                        <button type="button" class="btn btn-primary savespost" style="width: 100%" onclick="createPost('{{ Auth::user()->ref_code }}', '{{ Auth::user()->email }}')">Post <img class="spinnerpost disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>

                        <button type="button" class="btn btn-secondary updatespost disp-0" style="width: 100%" onclick="updatePost()">Update <img class="spinnerpost disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                    </center>
                        </div>
                    </div>

                </div>
              </div>
            </div>


            @else

            <div id="connectioncollapse" class="collapse show" aria-labelledby="connectionHead" data-parent="#accordion">
              <div class="card-body">
                <div class="itembody">

                    <h5 style="color: darkorange; font-weight: bold;">@if(count($opportunities) > 0) {{ count($opportunities) }} @else 0 @endif Posted Opportunities</h5> <hr>

                    @if(count($opportunities) > 0)

                    @foreach($opportunities as $opportunity)

                        <div class="row">

                            <hr>
                            <div class="col-md-2">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQ4KcIqXiEAW0w28LMwALg11W_yN1wqkh0H3Pqeb4Mp3i4Tkjw7" style="width: 50px; height: 50px; border-radius: 100%;">
                            </div>
                            <br>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="post_info">
                                    <h6>Service type: <b>{{ $opportunity->post_subject }}</b></h6>
                                </div><br>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="post_info">
                                    <h6>Service Option: <b>{{ $opportunity->service_option }}</b></h6>
                                </div><br>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="post_info">
                                    <h6>Make / Model: <b>{{ $opportunity->post_make.' / '.$opportunity->post_model }}</b></h6>
                                </div><br>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="post_info">
                                    <h6>Previous Mileage: <b>{{ $opportunity->post_mileage }}</b></h6>
                                </div><br>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="post_info">
                                    <h6>Current Mileage: <b>{{ $opportunity->post_curr_mileage }}</b></h6>
                                </div><br>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="post_info">
                                    <h6>Year: <b>{{ $opportunity->post_year }}</b></h6>
                                </div><br>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="post_info">
                                    <h6 style="font-weight: 600">DESCRIPTION:</h6> <hr><p style="text-align: justify; font-size: 13px;">{!! $opportunity->post_description !!}</p><hr>
                                </div><br>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="post_info">
                                            <h6>&nbsp;</h6>
                                    <h6>Repair Location:</h6> <p style="text-align: justify; font-size: 13px;"><a href="https://www.google.ng/maps/place/{{ $opportunity->post_service_need }}" target="_blank" style="color: navy; font-weight: bold; text-decoration: underline;">{{ $opportunity->post_service_need }}</a></p>
                                    <br>
                                    <h6>City:</h6> <p style="text-align: justify; font-size: 13px;">
                                        {{ $opportunity->postcity }}
                                    </p>
                                    <br>
                                    <h6>State:</h6> <p style="text-align: justify; font-size: 13px;">
                                        {{ $opportunity->poststate }}
                                    </p>
                                    <br>
                                    <h6>Zipcode:</h6> <p style="text-align: justify; font-size: 13px;">
                                        {{ $opportunity->postzipcode }}
                                    </p>
                                </div><br>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="post_info">
                                    <h6>&nbsp;</h6>
                                    <p style="text-align: justify;">
                                        <button class="btn btn-secondary" onclick="checkIvim('{{ $opportunity->post_id }}')"><i class="fas fa-receipt" style="color: #fff;"></i> Check iVIM History <img class="spinnerivim{{ $opportunity->post_id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                                    </p>
                                </div><br>
                                    </div>

                                    <div class="col-sm-3">
                                        <h6>&nbsp;</h6>
                                        <button class="btn btn-danger" onclick="prepareEstimate('{{ $opportunity->post_id }}', '{{ $opportunity->email }}', '{{ Auth::user()->ref_code }}')"><i class="far fa-clock" style="color: #fff;"></i> Prepare Estimate <img class="spinnerprepestimate{{ $opportunity->post_id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                                    </div>

                                    <div class="col-sm-3">
                                        <h6>&nbsp;</h6>
                                        <button class="btn btn-primary" onclick="onlineChat('{{ $opportunity->email }}', '{{ Auth::user()->ref_code }}')"><i class="fas fa-comments" style="color: #fff;"></i> Chat with Client <img class="spinnerprochatr{{ $opportunity->post_id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                                    </div>
                                </div>







                            </div>


                        </div>

                        <hr>

                    @endforeach



                    @else

                    <h5 style="color: red; font-weight: bold; text-align: center;">No Active Opportunity</h5>

                    @endif


                </div>
              </div>
            </div>


            @endif


          </div>

      {{-- End Post to Board --}}
  </div>


  <div class="tab-pane fade" id="allpostedopport" role="tabpanel" aria-labelledby="allpostedopport-tab">
      {{-- Start Estimate Proposals --}}

      <div class="table table-responsive">
          <table class="table table-striped table-bordered">
              <thead>
                  <tr style="font-size: 13px;">
                      <th>#</th>
                      <th>Subject</th>
                      <th>Make</th>
                      <th>Model</th>
                      <th>Mileage</th>
                      <th>Description</th>
                      <th>Location</th>
                      <th>Timeline</th>
                      <th style="text-align: center;">Action <img class="spinneractionOpport disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></th>
                  </tr>
              </thead>

              <tbody>

                @if(count($postedopport) > 0)
                <?php $i = 1;?>
                @foreach($postedopport as $postedopports)
                    <tr style="font-size: 13px;">
                          <td>{{ $i++ }}</td>
                          <td>{{ $postedopports->post_subject }}</td>
                          <td>{{ $postedopports->post_make }}</td>
                          <td>{{ $postedopports->post_model }}</td>
                          <td>{{ $postedopports->post_mileage }}</td>
                          <td>{{ $postedopports->post_description }}</td>
                          <td>{{ $postedopports->post_service_need }}</td>
                          <td>{{ date('d/M/Y', strtotime($postedopports->post_timeline)) }}</td>
                          <td align="center" style="margin-right: 5px;"><i onclick="opportAction('{{ $postedopports->post_id }}', 'edit')" title="edit" class="fas fa-edit" style="color: black; font-size: 14px; cursor: pointer;"></i> <i onclick="opportAction('{{ $postedopports->post_id }}', 'delete')" title="delete" class="fas fa-trash" style="color: red; font-size: 14px; cursor: pointer;"></i></td>
                      </tr>
                @endforeach

                @else
                    <tr><td align="center" colspan="9">No posted opportunity yet.</td></tr>
                @endif

              </tbody>
          </table>
      </div>

      {{-- End Estimate Proposals --}}
  </div>



  <div class="tab-pane fade" id="allestimatepropose" role="tabpanel" aria-labelledby="allestimatepropose-tab">
      {{-- Start Estimate Proposals --}}

      <div class="table table-responsive">
          <table class="table table-striped table-bordered">
              <thead>
                  <tr style="font-size: 13px;">
                      <th>#</th>
                      <th>Name</th>
                      <th>Total Estimate</th>
                      <th style="text-align: center;">Action</th>
                  </tr>
              </thead>

              <tbody>

                @if(count($proposeEstimates) > 0)
                <?php $i = 1;?>
                @foreach($proposeEstimates as $proposeEstimate)
                    @if($proposeEstimate->estimate == 1)
                    <tr style="font-size: 13px;">
                          <td>{{ $i++ }}</td>
                          <td>{{ $proposeEstimate->update_by }}</td>
                          <td>{{ number_format($proposeEstimate->total_cost) }}</td>
                          <td align="center">
                            <button class="btn btn-primary" onclick="location.href= '/proposalestimate/{{ $proposeEstimate->estimate_id }}'">view detail</button>

                        {{-- <button class="btn btn-success" onclick="location.href= '/monerispay/{{ $proposeEstimate->estimate_id }}'">Proceed to Pay</button> --}}
                        <button class="btn btn-success" id="proceedPay">Proceed to Pay</button>
                        <input type="hidden" name="paymentPin" id="paymentPin" value="{{ $proposeEstimate->estimate_id }}">
                    </td>
                      </tr>
                  @endif
                @endforeach

                @else
                    <tr><td align="center" colspan="4">No proposal sent yet.</td></tr>
                @endif

              </tbody>
          </table>
      </div>

      {{-- End Estimate Proposals --}}
  </div>


@if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")

  <div class="tab-pane fade" id="allsubmittedest" role="tabpanel" aria-labelledby="allsubmittedest-tab">
      {{-- Start Estimate Submitted --}}

      <div class="table table-responsive">
          <table class="table table-striped table-bordered">
              <thead>
                  <tr style="font-size: 13px;">
                      <th>#</th>
                      <th>Vehicle Licence</th>
                      <th>Make</th>
                      <th>Model</th>
                      <th>Mileage</th>
                      <th>Subject</th>
                      <th>Description</th>
                      <th>Location</th>
                      <th>Timeline</th>
                  </tr>
              </thead>

              <tbody>

                @if(count($submittedEst) > 0)
                <?php $i = 1;?>
                @foreach($submittedEst as $submittedEsts)
                    <tr style="font-size: 13px;">
                          <td>{{ $i++ }}</td>
                          <td>{{ $submittedEsts->vehicle_licence }}</td>
                          <td>{{ $submittedEsts->make }}</td>
                          <td>{{ $submittedEsts->model }}</td>
                          <td>{{ $submittedEsts->post_mileage }}</td>
                          <td>{{ $submittedEsts->post_subject }}</td>
                          <td>{{ $submittedEsts->post_description }}</td>
                          <td>{{ $submittedEsts->post_service_need }}</td>
                          <td>{{ date('d/M/Y', strtotime($submittedEsts->post_timeline)) }}</td>
                    </tr>
                @endforeach

                @else
                    <tr><td align="center" colspan="9">No estimate submitted yet.</td></tr>
                @endif

              </tbody>
          </table>
      </div>

      {{-- End Estimate Submitted --}}
  </div>

  <div class="tab-pane fade" id="allapprovedest" role="tabpanel" aria-labelledby="allapprovedest-tab">
      {{-- Start Estimate Approved --}}

      <div class="table table-responsive">
          <table class="table table-striped table-bordered">
              <thead>
                  <tr style="font-size: 13px;">
                      <th>#</th>
                      <th>Vehicle Licence</th>
                      <th>Make</th>
                      <th>Model</th>
                      <th>Mileage</th>
                      <th>Subject</th>
                      <th>Description</th>
                      <th>Location</th>
                      <th>Timeline</th>
                      <th>Action</th>
                  </tr>
              </thead>

              <tbody>

                @if(count($approvedEst) > 0)
                <?php $i = 1;?>
                @foreach($approvedEst as $approvedEsts)
                    <tr style="font-size: 13px;">
                          <td>{{ $i++ }}</td>
                          <td>{{ $approvedEsts->vehicle_licence }}</td>
                          <td>{{ $approvedEsts->make }}</td>
                          <td>{{ $approvedEsts->model }}</td>
                          <td>{{ $approvedEsts->post_mileage }}</td>
                          <td>{{ $approvedEsts->post_subject }}</td>
                          <td>{{ $approvedEsts->post_description }}</td>
                          <td>{{ $approvedEsts->post_service_need }}</td>
                          <td>{{ date('d/M/Y', strtotime($approvedEsts->post_timeline)) }}</td>
                          <td>@if($approvedEsts->work_order == 0) <i type='button' style='padding: 10px;' title='Close to work order' class='fas fa-exchange-alt' onclick="workOrders('{{ $approvedEsts->estimate_id }}')"></i> @else <i type='button' style='padding: 10px;' title='View More' class='fas fa-eye text-danger' style='text-align: center; cursor: pointer;' onclick="getPage('{{ $approvedEsts->estimate_id }}')"></i> @endif </td>
                    </tr>
                @endforeach

                @else
                    <tr><td align="center" colspan="10">No estimate approved yet.</td></tr>
                @endif

              </tbody>
          </table>
      </div>

      {{-- End Estimate Approved --}}
  </div>


@endif



  <div class="tab-pane fade" id="ongoingmaintenance" role="tabpanel" aria-labelledby="ongoingmaintenance-tab">
      {{-- Start Ongoing Maintenance --}}

      <div class="table table-responsive">
          <table class="table table-striped table-bordered">
              <thead>
                  <tr style="font-size: 13px;">
                      <th>#</th>
                      <th>Name</th>
                      <th>Total Estimate</th>
                      <th>Action</th>
                  </tr>
              </thead>

              <tbody>

                @if(count($workinprogress) > 0)
                <?php $i = 1;?>
                @foreach($workinprogress as $proposeEstimate)
                @if($proposeEstimate->work_order == 1)

                <tr style="font-size: 13px;">
                          <td>{{ $i++ }}</td>
                          <td>{{ $proposeEstimate->update_by }}</td>
                          <td>{{ number_format($proposeEstimate->total_cost) }}</td>
                          <td><a style="color: navy; text-decoration: underline;" href="javascript:void(Tawk_API.toggle())">contact admin </a></td>
                      </tr>
                @endif

                @endforeach

                @else
                    <tr><td align="center" colspan="4">No maintenance in progress.</td></tr>
                @endif

              </tbody>
          </table>
      </div>

      {{-- End Ongoing Maintenance --}}
  </div>


  <div class="tab-pane fade" id="jobdone" role="tabpanel" aria-labelledby="jobdone-tab">
      {{-- Start Job Done --}}

        <div class="table table-responsive">
          <table class="table table-striped table-bordered">
              <thead>
                  <tr style="font-size: 13px;">
                      <th>#</th>
                      <th>Name</th>
                      <th>Total Estimate</th>
                      <th style="text-align: center;">Action <br> <small style="font-weight: bold; color: red;">@if(Auth::user()->userType == 'Certified Professional' || Auth::user()->userType == 'Auto Care')(You have to close work to notify client.) @else (You can reject or accept work done for you.) @endif</small></th>
                  </tr>
              </thead>

              <tbody>

                @if(count($workinprogress) > 0)
                <?php $i = 1;?>
                @foreach($workinprogress as $proposeEstimate)

                @if(Auth::user()->userType == 'Certified Professional' || Auth::user()->userType == 'Auto Care')

                @if($proposeEstimate->maintenance == 1)
                    <tr style="font-size: 13px;">
                          <td>{{ $i++ }}</td>
                          <td>{{ $proposeEstimate->update_by }}</td>
                          <td>{{ number_format($proposeEstimate->total_cost) }}</td>

                          <td align="center">
                            @if(Auth::user()->userType == 'Certified Professional' || Auth::user()->userType == 'Auto Care')

                            <i type="button" class="fas fa-check" title="Close work" style="padding: 7px; font-size: 16px; background: green; color: #fff;" onclick="jobDone('{{ $proposeEstimate->id }}','{{ $proposeEstimate->post_id }}', 'closework', 'mechanic')"> <img class="spinnerclosework_{{ $proposeEstimate->id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></i>


                            @else
                                <i type="button" class="fas fa-times" title="Reject & Report work" style="padding: 7px; font-size: 16px; background: brown; color: #fff;" onclick="jobDone('{{ $proposeEstimate->id }}','{{ $proposeEstimate->post_id }}', 'reject', 'owners')"><img class="spinnerreject_{{ $proposeEstimate->id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></i>
                              <i type="button" class="fas fa-check" title="Accept & Close work" style="padding: 7px; font-size: 16px; background: green; color: #fff;" onclick="jobDone('{{ $proposeEstimate->id }}','{{ $proposeEstimate->post_id }}', 'accept', 'owners')"><img class="spinneraccept_{{ $proposeEstimate->id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></i>

                            @endif

                          </td>
                      </tr>
                      @endif


                @else

                @if($proposeEstimate->maintenance == 4 || $proposeEstimate->maintenance == 5)
                    <tr style="font-size: 13px;">
                          <td>{{ $i++ }}</td>
                          <td>{{ $proposeEstimate->update_by }}</td>
                          <td>{{ number_format($proposeEstimate->total_cost) }}</td>

                          <td align="center">
                            @if(Auth::user()->userType == 'Certified Professional' || Auth::user()->userType == 'Auto Care')

                            <i type="button" class="fas fa-check" title="Close work" style="padding: 7px; font-size: 16px; background: green; color: #fff;" onclick="jobDone('{{ $proposeEstimate->id }}','{{ $proposeEstimate->post_id }}', 'closework', 'mechanic')"> <img class="spinnerclosework_{{ $proposeEstimate->id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></i>

                            @else
                                <i type="button" class="fas fa-times" title="Reject & Report work" style="padding: 7px; font-size: 16px; background: brown; color: #fff;" onclick="jobDone('{{ $proposeEstimate->id }}','{{ $proposeEstimate->post_id }}', 'reject', 'owners')"><img class="spinnerreject_{{ $proposeEstimate->id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></i>
                              <i type="button" class="fas fa-check" title="Accept & Close work" style="padding: 7px; font-size: 16px; background: green; color: #fff;" onclick="jobDone('{{ $proposeEstimate->id }}','{{ $proposeEstimate->post_id }}', 'accept', 'owners')"><img class="spinneraccept_{{ $proposeEstimate->id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></i>

                            @endif

                          </td>
                      </tr>
                      @endif


                @endif




                @endforeach

                @else
                    <tr><td align="center" colspan="4">No maintenance in progress.</td></tr>
                @endif

              </tbody>
          </table>
      </div>

      {{-- End Job Done --}}
  </div>

@if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")
  <div class="tab-pane fade show active" id="appointment" role="tabpanel" aria-labelledby="appointment-tab">
      {{-- Start Appointment --}}

        <div class="table table-responsive">
          <table class="table table-striped table-bordered">
              <thead>
                  <tr style="font-size: 13px;">
                      <th>#</th>
                      <th>Booking code</th>
                      <th>Appointment Date</th>
                      <th>Vehicle Licence</th>
                      <th>Expected Discount</th>
                      <th>Client Email</th>
                      <th>Client Phone</th>
                      <th>Service Option</th>
                      <th>Service Type</th>
                      <th>Vehicle Make / Model</th>
                      <th>Current Mileage</th>
                      <th>Year</th>
                      <th>Description</th>
                      <th style="text-align: center;">Action</th>
                  </tr>
              </thead>

              <tbody style="font-size: 12px;">

                @if(count($myBookings) > 0)

                <?php $i = 1;?>
                @foreach($myBookings as $myBooking)

                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $myBooking->ref_code }}</td>
                        <td>{{ date('d-M-Y', strtotime($myBooking->date_of_visit)) }}</td>
                        <td>{{ $myBooking->vehicle_reg_no }}</td>
                        <td>{{ $discountcharge }}</td>
                        <td>{{ $myBooking->email }}</td>
                        <td>{{ $myBooking->telephone }}</td>
                        <td>{{ $myBooking->service_option }}</td>
                        <td>{{ $myBooking->service_type }}</td>
                        <td>{{ $myBooking->make.' / '.$myBooking->model }}</td>
                        <td>{{ $myBooking->current_mileage }}</td>
                        <td>{{ $myBooking->year_owned_since }}</td>
                        <td>{{ $myBooking->message }}</td>
                        <td colspan="4" align="center"><button title="Check IVIM" style="font-size: 12px; margin-top: 10px;" class="btn btn-primary" onclick="clientIvim('{{ $myBooking->vehicle_reg_no }}')">Check IVIM </button>
                            <button title="Prepare Estimate" style="font-size: 12px; margin-top: 10px;" class="btn btn-success" onclick="newprepareEstimate('{{ $myBooking->ref_code }}', '{{ $myBooking->email }}', '{{ Auth::user()->ref_code }}')">Prepare Estimate <img class="spinnernewprepestimate{{ $myBooking->ref_code }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                            <button title="Visit took place" style="font-size: 12px; margin-top: 10px;" class="btn btn-danger" onclick="visittookPlace('{{ $myBooking->ref_code }}')">Close Appointment <img class="spinnertookplace{{ $myBooking->ref_code }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                            <button title="Visit took place" style="font-size: 12px; margin-top: 10px;" class="btn btn-danger" onclick="onlineChat('{{ $myBooking->email }}', '{{ Auth::user()->ref_code }}')">Chat with Client <img class="spinnertookplace{{ $myBooking->ref_code }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                        </td>
                    </tr>

                @endforeach

                    @else

                    <tr>
                        <td colspan="14" align="center">No appointment available</td>
                    </tr>

                @endif

              </tbody>
          </table>
      </div>

      {{-- End Appointment --}}
  </div>
@endif

</div>





  </div>


  <div class="tab-pane fade" id="myreviews" role="tabpanel" aria-labelledby="myreviews-tab">

      <br>
          {{-- Start Review Here --}}

      @if (count($myreviews) > 0)
        @foreach ($myreviews as $myreview)

        <div class="row">
            <div class="col-md-12">
                <h4>Quality of Service ({{ $myreview->rating }})</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                Review by: @if($user = \App\User::where('ref_code', $myreview->ref_code)->get()) @if(count($user) > 0) <?php echo substr($user[0]->name, 0, -10) . "****";?> @else Anonymous @endif  @endif
            </div>
            <div class="col-md-6">
                Date and time: {{ date('d-M-Y h:i A', strtotime($myreview->created_at)) }}
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-12">
                <p><b>Message: </b>{!! $myreview->comment !!}</p>

                <br>
                @if($myreview->reply != "")
                 <p><b>Reply: </b> {!! $myreview->reply !!}</p>
                @endif
            </div>
        </div>

        <br>
        <div class="row review_reply{{ $myreview->id }} disp-0">
            <div class="col-md-12">
                    <p>Send a reply</p>
                <form action="{{ route('reviewresponse') }}" method="post">
                    @csrf
                    <input type="hidden" name="post_message_id" value="{{ $myreview->post_id }}">
                    <textarea name="review_reply" cols="30" rows="10" class="form-control"></textarea>

                    <br><input type="submit" value="Submit reply" class="btn btn-primary">
                </form>

                <br>
            </div>
        </div>

        <div class="row replymessage{{ $myreview->id }}">
            <div class="col-md-6">
                <button class="btn btn-primary" onclick="showreplyBox('{{ $myreview->id }}')">Reply message <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
            </div>
        </div>
           <hr>
        @endforeach

      @else
          <div class="row">
            <div class="col-md-12">
                <p>No available reviews</p>
            </div>
        </div>
      @endif

        {{-- Nav Menu --}}
        <center>
            <nav aria-label="...">
            <ul class="pagination pagination-lg">
                <li class="page-item">
                    {{ $myreviews->links() }}
                </li>
            </ul>
            </nav>
        </center>

      {{-- End My Review --}}

  {{-- End Review Here --}}
  </div>
  
  <div class="tab-pane fade" id="recordmaintenance" role="tabpanel" aria-labelledby="recordmaintenance-tab">






            {{-- @if(Auth::user()->plan == "Free")
            <button class="btn btn-danger" style="float: right;" onclick="location.href='{{ route('Pricing') }}'">Upgrade Plan <img src="https://img.icons8.com/dusk/50/000000/donate.png" style="width: 30px; height: 30px;"></button> <br>
            @endif --}}

            <div id="partsAdd"></div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">

            @if(Auth::user()->userType != "Technician")

              <li class="nav-item" @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional") data-step="2" data-intro="Use this menu to record vehicle  maintenance. You will need to input materials, labour and other cost here"  @elseif(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer") data-step="2" data-intro="Use this menu to record vehicle maintenance. You will need to input materials, labour and other cost including taxes here" @elseif(Auth::user()->userType == "Individual") data-step="2" data-intro="Use this menu to record vehicle maintenance. You will need to input materials, labour and other cost including taxes here" @elseif(Auth::user()->userType == "Commercial") data-step="2" data-intro="Use this menu to record vehicle maintenance. You will need to input materials, labour and other cost including taxes here"  @endif>

                <a class="nav-link navMain active" id="maintenance-tab" data-toggle="tab" href="#maintenance" role="tab" aria-controls="maintenance" aria-selected="true">Vehicle Maintenance</a>
                
              </li>
              @endif

              @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")

              <li class="nav-item" @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional") data-step="3" data-intro="Use this menu to track inventories,from creating purchase order to paying vendors." @endif>
                  <a class="nav-link" id="manageinventory-tab" data-toggle="tab" href="#manageinventory" role="tab" aria-controls="manageinventory" aria-selected="false">Manage Inventory</a>
              </li>

              @endif

              @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Technician" || Auth::user()->userType == "Certified Professional")
              <li class="nav-item" @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Technician") data-step="4" data-intro="Track labour/technician hours on job assigned as well as your pay schedule." @endif>
                  <a class="nav-link @if(Auth::user()->userType == "Technician") active @endif" id="labourschedule-tab" data-toggle="tab" href="#labourschedule" role="tab" aria-controls="@if(Auth::user()->userType == "Technician") clockingsheet @else managelabourschedule @endif" aria-selected="@if(Auth::user()->userType != "Technician") false @else true @endif">Manage Labour</a>
              </li>
              @endif



              @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")
              <li class="nav-item" @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional") data-step="5" data-intro="Track invoices (paid, unpaid or cancel) and receive payments for Diagnostics and completed work order" @endif>
                  <a class="nav-link" id="revenue-tab" data-toggle="tab" href="#revenue" role="tab" aria-controls="revenue" aria-selected="false">Revenue</a>
              </li>
              <li class="nav-item" @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional") data-step="6" data-intro="Manage payment to vendors, generate Vendor's statement, Technicians' Payment and track payment history in general" @endif>
                  <a class="nav-link" id="expenditure-tab" data-toggle="tab" href="#expenditure" role="tab" aria-controls="expenditure" aria-selected="false">Expenditure</a>
              </li>

              <li class="nav-item" @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional") data-step="7" data-intro="Here is where you have all account balances, ranging from client balances to bank balances of your station" @endif>
                <a class="nav-link" id="businessreport-tab" data-toggle="tab" href="#businessreport" role="tab" aria-controls="receievepayment" aria-selected="false">Business Report</a>

                <input type="hidden" name="bizreportcheck" id="bizreportcheck" value="">
              </li>

              @endif

              @if(Auth::user()->userType == "Commercial")

                <li class="nav-item">
                    <a class="nav-link navFin" data-toggle="tab" href="#financials" role="tab" aria-controls="financials" aria-selected="true">Track your financial</a>
                </li>

                @endif




            @if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == 'Commercial')

            <li class="nav-item">
    <a class="nav-link" id="myappointment-tab" data-toggle="tab" href="#myappointment" role="tab" aria-controls="myappointment" aria-selected="false">Appointment</a>
  </li>

  @endif

              <li class="nav-item" @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional") data-step="9" data-intro="Do you want to personalize your account? Take a look and make vimfile works for you." @elseif(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer") data-step="5" data-intro="Do you want to personalize your account? Take a look and make vimfile works for you." @elseif(Auth::user()->userType == "Individual") data-step="4" data-intro="Do you want to personalize your account? Take a look and make vimfile works for you." @elseif(Auth::user()->userType == "Commercial") data-step="5" data-intro="Do you want to personalize your account? Take a look and make vimfile works for you." @endif>

                <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
              </li>

            </ul>


            <div class="tab-content" id="myTabContent">

@if(Auth::user()->userType != "Technician")
{{-- Start New Vehicle Maintenance --}}


<div class="tab-pane fade show active" id="maintenance" role="tabpanel" aria-labelledby="maintenance-tab">


{{-- Start Menu for Vehicle maint --}}
<br>

<ul class="nav nav-tabs" id="myTab" role="tablist">

    <input type="hidden" name="checkIvim" id="checkIvim" value="">
    <input type="hidden" name="prepEst" id="prepEst" value="">

  <li class="nav-item" @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional") data-step="10" data-intro="Use this to generate Estimates and email or print to client. You can also use this to raise Work order." @elseif(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer") data-step="6" data-intro="Ready to record a maintenance? simply click here and provide all the required information." @elseif(Auth::user()->userType == "Individual") data-step="5" data-intro="Ready to record a maintenance? simply click here and provide all the required information." @elseif(Auth::user()->userType == "Commercial") data-step="6" data-intro="Ready to record a maintenance? simply click here and provide all the required information." @endif>

    <a class="nav-link active" id="estimateprep-tab" data-toggle="tab" href="#estimateprep" role="tab" aria-controls="estimateprep" aria-selected="true">@if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional") Prepare Estimate @else Record Maintenance @endif</a>
    
  </li>
  @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")
  <li class="nav-item" @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional") data-step="11" data-intro="Use the find button to look for vehicle listed on your account or on Vimfile.com" @elseif(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer") data-step="7" data-intro="Use the find button to look for vehicle listed on your account" @endif>
    <a class="nav-link" id="search-tab" data-toggle="tab" href="#search" role="tab" aria-controls="search" aria-selected="false">Find Maintenance Record</a>
  </li>
  @endif
  <li class="nav-item" @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional") data-step="12" data-intro="Use this to add a new vehicle not listed on vimfile.com" @elseif(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer") data-step="8" data-intro="Do you have a new vehicle you want to add to the family of vehicles, click here to register and track all maintenance activities" @elseif(Auth::user()->userType == "Individual") data-step="6" data-intro="Do you have a new vehicle you want to add to the family of vehicles, click here to register and track all maintenance activities" @elseif(Auth::user()->userType == "Commercial") data-step="7" data-intro="Do you have a new vehicle you want to add to the family of vehicles, click here to register and track all maintenance activities" @endif>
    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register a Vehicle</a>
  </li>
  <li class="nav-item" @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional") data-step="13" data-intro="iVIM simpy means-Insights. Use this to have an insight into vehicle maintenance activities of your client. Simply type in
the vehicle or licence number and submit" @elseif(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer") data-step="9" data-intro="iVIM simpy means-Insights. Get insights into your vehicle maintenance activities. A copy of the
insights is mailed to you monthly.
" @elseif(Auth::user()->userType == "Individual") data-step="7" data-intro="iVIM simpy means-Insights. Get insights into your vehicle maintenance activities. A copy of the
insights is mailed to you monthly." @elseif(Auth::user()->userType == "Commercial") data-step="8" data-intro="iVIM simpy means-Insights. Get insights into your vehicle maintenance activities. A copy of the
insights is mailed to you monthly." @endif>
    <a class="nav-link" id="ivim-tab" data-toggle="tab" href="#ivim" role="tab" aria-controls="ivim" aria-selected="false">IVIM</a>
  </li>
  <li class="nav-item" @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional") data-step="14" data-intro="This shows you how well your client has been managing maintenance on the vehicle. It consists of
mileage and maintenance costs. Provide candid and professional advice on how the vehicle can be better maintained." @elseif(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer") data-step="10" data-intro="This shows you how well you have manage the use of your vehicle, mileage and maintenance costs
" @elseif(Auth::user()->userType == "Individual") data-step="8" data-intro="This shows you how well you have manage the use of your vehicle, mileage and maintenance costs" @elseif(Auth::user()->userType == "Commercial") data-step="9" data-intro="This shows you how well you have manage the use of your vehicle, mileage and maintenance costs" @endif>
    <a class="nav-link" id="performance-tab" data-toggle="tab" href="#performance" role="tab" aria-controls="performance" aria-selected="false">Performance</a>
  </li>

  @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Business")
  <li class="nav-item">
    <a class="nav-link" id="clientcheck-tab" data-toggle="tab" href="#clientcheck" role="tab" aria-controls="clientcheck" aria-selected="false">@if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional") My Client List  @else Vehicle List @endif</a>
  </li>

  @endif

  @if(Auth::user()->userType == "Auto Dealer")
  <li class="nav-item">
    <a class="nav-link" id="monitor-tab" data-toggle="tab" href="#monitor" role="tab" aria-controls="monitor" aria-selected="false">Monitor Vehicles</a>
  </li>

  @endif
</ul>


<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="estimateprep" role="tabpanel" aria-labelledby="estimateprep-tab">

    {{-- Start Record Maintenance Form --}}

            {{-- Start Record Maintenance --}}
        <div class="card">

        <div id="collapseestimateprep" class="collapse show" aria-labelledby="headingestimateprep" data-parent="#accordion">
          <div class="card-body" id="maintenances">
    @if (count($vehicleInfo) > 0 || count($carrecord) > 0 && Auth::user()->userType == "Individual" || Auth::user()->userType == "Commercial")

    <form method="POST">
                    @csrf
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                @if (Auth::user()->userType == "Individual" || Auth::user()->userType == "Commercial")
                    <div class="col-md-3 disp-0">
                    <label><span style="color: red;">*</span> Email</label> <input type="email" name="email" id="email" value="@if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Commercial") {{ Auth::user()->email }} @else @endif" class="form-control">
                    </div>
                    @else
                    <div class="col-md-3">
                    <label><span style="color: red;">*</span> Email</label> <input type="email" name="email" id="email" value="@if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Commercial") {{ Auth::user()->email }} @else @endif" class="form-control">
                    </div>
                @endif



                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Vehicle Licence:</label>
                    <select name="vehicle_licence" id="vehicle_licence" class="form-control">
                        @foreach ($carrecord as $carrecords)
                            <option value="{{ $carrecords->vehicle_reg_no }}">{{ $carrecords->vehicle_reg_no }}</option>

                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Date:</label> <input type="date" name="date" id="date" class="form-control">

                    @foreach($carrecord as $carrecords)

                    <input type="hidden" name="make" id="make" value="{{ $carrecords->make }}" class="form-control">
                    <input type="hidden" name="model" id="modelz" value="{{ $carrecords->model }}" class="form-control">
                    @endforeach


                </div>
                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Service Option:</label> <select name="service_option" id="service_option" class="form-control">
                                        <option value="Major Repair">Major Repair</option>
                                        <option value="Minor Repair">Minor Repair</option>
                                        <option value="Scheduled Maintenance">Scheduled Maintenance</option>
                                        <option value="Emergency Maintenance">Emergency Maintenance</option>
                                    </select>
                </div>

                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Service Type:</label> <select name="service_type" id="service_type" class="form-control">
                                        <option value="Service" selected="selected" disabled="disabled">Service</option>
                                        <optgroup label="Admin"><option value="inspection">inspection</option><option value="registration">registration</option><option value="insurance">insurance</option><option value="road assistance">road assistance</option><option value="business taxes">business taxes</option><option value="Road Fines">Road Fines</option><option value="Ticket">Ticket</option></optgroup>
                                        <optgroup label="Fuel"><option value="fuel">fuel</option><option value="car wash">car wash</option></optgroup>
                                        <optgroup label="Maintenance"><option value="air conditioning recharge">air conditioning recharge</option><option value="air filter">air filter</option><option value="battery">battery</option><option value="brake fluid flush">brake fluid flush</option><option value="brake pads">brake pads</option><option value="brake rotors">brake rotors</option><option value="coolant flush">coolant flush</option><option value="distributor cap &amp; rotor">distributor cap &amp; rotor</option><option value="fuel filter">fuel filter</option><option value="headlight">headlight</option><option value="oil change">oil change</option><option value="power steering flush">power steering flush</option><option value="spark plugs">spark plugs</option><option value="timing belt">timing belt</option><option value="tire - new">tire - new</option><option value="tire balancing">tire balancing</option><option value="tire inflation">tire inflation</option><option value="tire rotation">tire rotation</option><option value="wheel rotation and tire balancing">Wheel Rotation & Tire Balancing</option><option value="transmission fluid flush">transmission fluid flush</option><option value="wheel alignment">wheel alignment</option><option value="wiper blades">wiper blades</option><option value="other">other</option><option value="cabin air filter">cabin air filter</option><option value="smog check">smog check</option></optgroup>
                                        <optgroup label="Repairs"><option value="alternator">alternator</option><option value="belt">belt</option><option value="body work">body work</option><option value="brake caliper">brake caliper</option><option value="carburetor">carburetor</option><option value="catalytic converter">catalytic converter</option><option value="clutch">clutch</option><option value="control arm">control arm</option><option value="coolant temperature sensor">coolant temperature sensor</option><option value="exhaust">exhaust</option><option value="fuel injector">fuel injector</option><option value="fuel tank">fuel tank</option><option value="head gasket">head gasket</option><option value="heater core">heater core</option><option value="hose">hose</option><option value="line">line</option><option value="mass air flow sensor">mass air flow sensor</option><option value="muffler">muffler</option><option value="oxygen sensor">oxygen sensor</option><option value="radiator">radiator</option><option value="shock/strut">shock/strut</option><option value="starter">starter</option><option value="thermostat">thermostat</option><option value="tie rod">tie rod</option><option value="transmission">transmission</option><option value="water pump">water pump</option><option value="wheel bearings">wheel bearings</option><option value="window">window</option><option value="windshield">windshield</option><option value="road side assistance">road side assistance</option><option value="other">other</option><option value="sensor">sensor</option>
                                        </optgroup>
                                    </select>
                </div>


            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

            </div>
            <hr>
            <h6><span style="color: red;">*</span>Material Cost 1 (tax included): </h6>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-2">
                    <input type="number" name="material_qty" id="material_qty" class="form-control material_qty" placeholder="Qty">
                </div>
                <div class="col-md-2">
                    <input type="number" name="material_ratez1" id="material_ratez1" class="form-control material_ratez1" placeholder="Rate">
                </div>
                <div class="col-md-2">
                    <input type="number" name="material_cost" id="material_cost" class="form-control material_cost" placeholder="Amount" readonly="">
                </div>
                <div class="col-md-3">
                    <input type="text" name="service_item_spec" id="service_item_spec" class="form-control" placeholder="Service Item Spec.">
                </div>
                <div class="col-md-3">
                    <input type="text" name="manufacturer" id="manufacturer" class="form-control" placeholder="Material Manufacturer">
                </div>
                <br>
            </div>

            <hr>
            <h6><span style="color: red;">*</span>Material Cost 2 (tax included): </h6>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-2">
                    <input type="number" name="material_qty2" id="material_qty2" class="form-control material_qty2" placeholder="Qty">
                </div>
                <div class="col-md-2">
                    <input type="number" name="material_ratez2" id="material_ratez2" class="form-control material_ratez2" placeholder="Rate">
                </div>
                <div class="col-md-2">
                    <input type="number" name="material_cost2" id="material_cost2" class="form-control material_cost2" placeholder="Amount" readonly="">
                </div>
                <div class="col-md-3">
                    <input type="text" name="service_item_spec2" id="service_item_spec2" class="form-control" placeholder="Service Item Spec.">
                </div>
                <div class="col-md-3">
                    <input type="text" name="manufacturer2" id="manufacturer2" class="form-control" placeholder="Material Manufacturer">
                </div>
                <br>
            </div>

            <hr>
            <h6><span style="color: red;">*</span>Material Cost 3 (tax included): </h6>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-2">
                    <input type="number" name="material_qty3" id="material_qty3" class="form-control material_qty3" placeholder="Qty">
                </div>
                <div class="col-md-2">
                    <input type="number" name="material_ratez3" id="material_ratez3" class="form-control material_ratez3" placeholder="Rate">
                </div>
                <div class="col-md-2">
                    <input type="number" name="material_cost3" id="material_cost3" class="form-control material_cost3" placeholder="Amount" readonly="">
                </div>
                <div class="col-md-3">
                    <input type="text" name="service_item_spec3" id="service_item_spec3" class="form-control" placeholder="Service Item Spec.">
                </div>
                <div class="col-md-3">
                    <input type="text" name="manufacturer3" id="manufacturer3" class="form-control" placeholder="Material Manufacturer">
                </div>
                <br>
            </div>

            <hr>
            <h6><span style="color: red;">*</span>Labour Cost 1 (tax included): </h6>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4">
                    <input type="number" name="labour_qty" id="labour_qty" class="form-control labour_qty" placeholder="Rate">
                </div>
                <div class="col-md-4">
                    <input type="number" name="labour_hour" id="labour_hour" class="form-control labour_hour" placeholder="Hour">
                </div>
                <div class="col-md-4">
                    <input type="number" name="labour_cost" id="labour_cost" class="form-control labour_cost" placeholder="Amount" readonly="">
                </div>

                <br>

            </div>

            <hr>
            <h6><span style="color: red;">*</span>Labour Cost 2 (tax included): </h6>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-4">
                    <input type="number" name="labour_qty2" id="labour_qty2" class="form-control labour_qty2" placeholder="Rate">
                </div>
                <div class="col-md-4">
                    <input type="number" name="labour_hour2" id="labour_hour2" class="form-control labour_hour2" placeholder="Hour">
                </div>
                <div class="col-md-4">
                    <input type="number" name="labour_cost2" id="labour_cost2" class="form-control labour_cost2" placeholder="Amount" readonly="">
                </div>

                <br>
            </div>

            <hr>
            <h6><span style="color: red;">*</span>Other Cost: </h6>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-6">
                    <input type="hidden" name="other_qty" id="other_qty" value="NA" class="form-control other_qty" placeholder="Qty">
                </div>
                <div class="col-md-12">
                    <input type="number" name="other_cost" id="other_cost" class="form-control other_cost" placeholder="Amount">
                </div>

                <br>

            </div>

            <hr>
            <h6><span style="color: red;">*</span>Total Price: </h6>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-12">
                    <input type="number" name="total_cost" id="total_cost" class="form-control total_cost" placeholder="Total Amount" readonly="">
                </div>

                <br>

            </div>


            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-4">
                    <label>Service Note:</label> <input type="text" name="service_note" id="service_note" class="form-control">
                </div>
                <div class="col-md-2">
                    <label><span style="color: red;">*</span> Mileage:</label> <input type="text" name="mileage" id="mileage" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>File:</label> <input type="file" name="file" id="file" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Updated By:</label> <input type="text" name="update_by" value="{{ Auth::user()->name }}" id="update_by" class="form-control" readonly="">
                </div>

            </div>
            <br>
            <center><button type="button" class="btn btn-primary m-t-5" style="width: 100%;" onclick="addVehicle('new', '{{ Auth::user()->plan }}')">Save <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button></center>

        </form>


        @elseif(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer")

            <form method="POST">
                    @csrf

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Vehicle Licence:</label>
                    <input type="hidden" name="busID" value="{{ Auth::user()->busID }}" id="businessID">
                    <input type="text" name="vehicle_licence" id="vehicle_licence" class="form-control licenceKey">
                </div>

                @if (Auth::user()->userType == "Individual" || Auth::user()->userType == "Commercial")
                    <div class="col-md-3 disp-0">
                    <label><span style="color: red;">*</span> Email</label> <input type="email" name="email" id="email" value="@if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Commercial") {{ Auth::user()->email }} @else @endif" class="form-control">
                    </div>
                    @else
                    <div class="col-md-3">
                    <label><span style="color: red;">*</span> Email</label> <input type="email" name="email" id="email" value="@if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Commercial") {{ Auth::user()->email }} @else @endif" class="form-control" readonly="">
                    </div>
                @endif

                {{-- Add Telephone Number --}}
                    <div class="col-md-3">
                    <label>Telephone</label> <input type="text" name="telephone" id="telephone" class="form-control">
                    </div>

                    <div class="col-md-3">
                    <label><span style="color: red;">*</span> Date:</label> <input type="date" name="date" id="date" class="form-control">

                </div>

                </div>

                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Vehicle Make:</label>
                    <input type="text" name="make" id="make" class="form-control">
                </div>

                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Vehicle Model:</label>
                    <input type="text" name="model" id="modelz" class="form-control">
                </div>

                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Service Option:</label> <select name="service_option" id="service_option" class="form-control">
                                        <option value="Major Repair">Major Repair</option>
                                        <option value="Minor Repair">Minor Repair</option>
                                        <option value="Scheduled Maintenance">Scheduled Maintenance</option>
                                        <option value="Emergency Maintenance">Emergency Maintenance</option>
                                    </select>
                </div>

                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Service Type:</label> <select name="service_type" id="service_type" class="form-control">
                                        <option value="Service" selected="selected" disabled="disabled">Service</option>
                                        <optgroup label="Admin"><option value="inspection">inspection</option><option value="registration">registration</option><option value="insurance">insurance</option><option value="road assistance">road assistance</option><option value="business taxes">business taxes</option><option value="Road Fines">Road Fines</option><option value="Ticket">Ticket</option></optgroup>
                                        <optgroup label="Fuel"><option value="fuel">fuel</option><option value="car wash">car wash</option></optgroup>
                                        <optgroup label="Maintenance"><option value="air conditioning recharge">air conditioning recharge</option><option value="air filter">air filter</option><option value="battery">battery</option><option value="brake fluid flush">brake fluid flush</option><option value="brake pads">brake pads</option><option value="brake rotors">brake rotors</option><option value="coolant flush">coolant flush</option><option value="distributor cap &amp; rotor">distributor cap &amp; rotor</option><option value="fuel filter">fuel filter</option><option value="headlight">headlight</option><option value="oil change">oil change</option><option value="power steering flush">power steering flush</option><option value="spark plugs">spark plugs</option><option value="timing belt">timing belt</option><option value="tire - new">tire - new</option><option value="tire balancing">tire balancing</option><option value="tire inflation">tire inflation</option><option value="tire rotation">tire rotation</option><option value="wheel rotation and tire balancing">Wheel Rotation & Tire Balancing</option><option value="transmission fluid flush">transmission fluid flush</option><option value="wheel alignment">wheel alignment</option><option value="wiper blades">wiper blades</option><option value="other">other</option><option value="cabin air filter">cabin air filter</option><option value="smog check">smog check</option></optgroup>
                                        <optgroup label="Repairs"><option value="alternator">alternator</option><option value="belt">belt</option><option value="body work">body work</option><option value="brake caliper">brake caliper</option><option value="carburetor">carburetor</option><option value="catalytic converter">catalytic converter</option><option value="clutch">clutch</option><option value="control arm">control arm</option><option value="coolant temperature sensor">coolant temperature sensor</option><option value="exhaust">exhaust</option><option value="fuel injector">fuel injector</option><option value="fuel tank">fuel tank</option><option value="head gasket">head gasket</option><option value="heater core">heater core</option><option value="hose">hose</option><option value="line">line</option><option value="mass air flow sensor">mass air flow sensor</option><option value="muffler">muffler</option><option value="oxygen sensor">oxygen sensor</option><option value="radiator">radiator</option><option value="shock/strut">shock/strut</option><option value="starter">starter</option><option value="thermostat">thermostat</option><option value="tie rod">tie rod</option><option value="transmission">transmission</option><option value="water pump">water pump</option><option value="wheel bearings">wheel bearings</option><option value="window">window</option><option value="windshield">windshield</option><option value="road side assistance">road side assistance</option><option value="other">other</option><option value="sensor">sensor</option>
                                        </optgroup>
                                    </select>
                </div>


            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

            </div>
            <hr>
            <h6><span style="color: red;">*</span>Material Cost 1 (tax included): </h6>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-2">
                    <input type="number" name="material_qty" id="material_qty" class="form-control material_qty" placeholder="Qty">
                </div>
                <div class="col-md-2">
                    <input type="number" name="material_ratez1" id="material_ratez1" class="form-control material_ratez1" placeholder="Rate">
                </div>
                <div class="col-md-2">
                    <input type="number" name="material_cost" id="material_cost" class="form-control material_cost" placeholder="Amount" readonly="">
                </div>
                <div class="col-md-3">
                    <input type="text" name="service_item_spec" id="service_item_spec" class="form-control" placeholder="Service Item Spec.">
                </div>
                <div class="col-md-3">
                    <input type="text" name="manufacturer" id="manufacturer" class="form-control" placeholder="Material Manufacturer">
                </div>
                <br>
            </div>

            <hr>
            <h6><span style="color: red;">*</span>Material Cost 2 (tax included): </h6>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-2">
                    <input type="number" name="material_qty2" id="material_qty2" class="form-control material_qty2" placeholder="Qty">
                </div>
                <div class="col-md-2">
                    <input type="number" name="material_ratez2" id="material_ratez2" class="form-control material_ratez2" placeholder="Rate">
                </div>
                <div class="col-md-2">
                    <input type="number" name="material_cost2" id="material_cost2" class="form-control material_cost2" placeholder="Amount" readonly="">
                </div>
                <div class="col-md-3">
                    <input type="text" name="service_item_spec2" id="service_item_spec2" class="form-control" placeholder="Service Item Spec.">
                </div>
                <div class="col-md-3">
                    <input type="text" name="manufacturer2" id="manufacturer2" class="form-control" placeholder="Material Manufacturer">
                </div>
                <br>
            </div>

            <hr>
            <h6><span style="color: red;">*</span>Material Cost 3 (tax included): </h6>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-2">
                    <input type="number" name="material_qty3" id="material_qty3" class="form-control material_qty3" placeholder="Qty">
                </div>
                <div class="col-md-2">
                    <input type="number" name="material_ratez3" id="material_ratez3" class="form-control material_ratez3" placeholder="Rate">
                </div>
                <div class="col-md-2">
                    <input type="number" name="material_cost3" id="material_cost3" class="form-control material_cost3" placeholder="Amount" readonly="">
                </div>
                <div class="col-md-3">
                    <input type="text" name="service_item_spec3" id="service_item_spec3" class="form-control" placeholder="Service Item Spec.">
                </div>
                <div class="col-md-3">
                    <input type="text" name="manufacturer3" id="manufacturer3" class="form-control" placeholder="Material Manufacturer">
                </div>
                <br>
            </div>

            <hr>
            <h6><span style="color: red;">*</span>Labour Cost 1 (tax included): </h6>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4">
                    <input type="number" name="labour_qty" id="labour_qty" class="form-control labour_qty" placeholder="Rate">
                </div>
                <div class="col-md-4">
                    <input type="number" name="labour_hour" id="labour_hour" class="form-control labour_hour" placeholder="Hour">
                </div>
                <div class="col-md-4">
                    <input type="number" name="labour_cost" id="labour_cost" class="form-control labour_cost" placeholder="Amount" readonly="">
                </div>

                <br>

            </div>

            <hr>
            <h6><span style="color: red;">*</span>Labour Cost 2 (tax included): </h6>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-4">
                    <input type="number" name="labour_qty2" id="labour_qty2" class="form-control labour_qty2" placeholder="Rate">
                </div>
                <div class="col-md-4">
                    <input type="number" name="labour_hour2" id="labour_hour2" class="form-control labour_hour2" placeholder="Hour">
                </div>
                <div class="col-md-4">
                    <input type="number" name="labour_cost2" id="labour_cost2" class="form-control labour_cost2" placeholder="Amount" readonly="">
                </div>

                <br>
            </div>

            <hr>
            <h6><span style="color: red;">*</span>Other Cost: </h6>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-6">
                    <input type="hidden" name="other_qty" id="other_qty" value="NA" class="form-control other_qty" placeholder="Qty">
                </div>
                <div class="col-md-12">
                    <input type="number" name="other_cost" id="other_cost" class="form-control other_cost" placeholder="Amount">
                </div>

                <br>

            </div>

            <hr>
            <h6><span style="color: red;">*</span>Total Price: </h6>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-12">
                    <input type="number" name="total_cost" id="total_cost" class="form-control total_cost" placeholder="Total Amount" readonly="">
                </div>

                <br>

            </div>


            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-4">
                    <label>Service Note:</label> <input type="text" name="service_note" id="service_note" class="form-control">
                </div>
                <div class="col-md-2">
                    <label><span style="color: red;">*</span> Mileage:</label> <input type="text" name="mileage" id="mileage" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>File:</label> <input type="file" name="file" id="file" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Updated By:</label> <input type="text" name="update_by" value="{{ Auth::user()->station_name }}" id="update_by" class="form-control" readonly="">
                </div>

            </div>
            <br>
            <center><button type="button" class="btn btn-primary m-t-5" style="width: 100%;" onclick="addVehicle('new', '{{ Auth::user()->plan }}')">Save <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button></center>

        </form>



    @elseif (Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")
        <form method="POST">
                    @csrf

                    {{-- Add Part Section --}}
        <div class="partSection animated slideInRight disp-0">
                <h4 class="text-center">Part Details</h4>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-3">
                    <h6>Part #</h6>
                    <input type="text" name="part_number" id="part_number" class="form-control">
                </div>
                <div class="col-md-3">
                    <h6>Description</h6>
                    <input type="text" name="part_description" id="part_description" class="form-control">
                </div>
                <div class="col-md-3">
                    <h6>Category</h6>
                    <select name="part_category" id="part_category" class="form-control">
                        <option value="">Select One</option>
                        <option value="New">New</option>
                        <option value="Used">Used</option>
                        <option value="Rebuilt">Rebuilt</option>
                        <option value="OEM">OEM</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <h6>Upload warranty</h6>
                    <input type="file" name="part_warranty" id="part_warranty" class="form-control">
                </div>

            </div>
            <hr>
            <h4 class="text-center">Vendor</h4>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-3">
                    <h6>Vendor</h6>
                    <select name="vendor" id="vendor" class="form-control">
                        @if($vendor != "")
                            <option value="">Select one</option>
                            @foreach($vendor as $vendors)
                            <option value="{{ $vendors->vendor_email }}">{{ $vendors->vendor_name }}</option>
                            @endforeach

                            @else
                            <option value="">Kindly create vendor</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-3">
                    <h6>Vendor Code</h6>
                    <input type="text" name="vendor_code" id="vendor_code" class="form-control" readonly="">
                </div>

                <div class="col-md-3">
                    <h6>Manufacturer</h6>
                    <input type="text" name="part_manufacturer" id="part_manufacturer" class="form-control">
                </div>
                <div class="col-md-3">
                    <h6>Location</h6>
                    <input type="text" name="part_location" id="part_location" class="form-control">
                </div>

            </div>

            <hr>
            <h4 class="text-center">Items</h4>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-4">
                    <h6>Quantity</h6>
                    <input type="number" name="items_qty" id="items_qty" class="form-control">
                </div>
                <div class="col-md-4">
                    <h6>Unit Cost</h6>
                    <input type="number" name="items_unit_cost" id="items_unit_cost" class="form-control">
                </div>
                <div class="col-md-4">
                    <h6>Total Cost</h6>
                    <input type="number" name="items_total_cost" id="items_total_cost" class="form-control">
                </div>

            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4">
                    <h6>Mark-Up (%)</h6>
                    <input type="number" name="item_mark_up" id="item_mark_up" class="form-control">
                </div>
                <div class="col-md-4">
                    <h6>Discount (%)</h6>
                    <input type="number" name="item_discount" id="item_discount" class="form-control">
                </div>
                <div class="col-md-4">
                    <h6>Unit Price</h6>
                    <input type="number" name="item_unit_price" id="item_unit_price" class="form-control">
                </div>

            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4">
                    <h6>Total Discount</h6>
                    <input type="number" name="item_total_discount" id="item_total_discount" class="form-control">
                    <input type="hidden" name="item_total_mark_up" id="item_total_mark_up" class="form-control" value="">
                    <input type="hidden" name="item_total_taxrate" id="item_total_taxrate" class="form-control" value="">
                </div>
                <div class="col-md-4">
                    <h6>Tax Rate</h6>
                    <input type="number" name="item_tax_rate" id="item_tax_rate" class="form-control">
                </div>
                <div class="col-md-4">
                    <h6>Total Price</h6>
                    <input type="number" name="item_total_price" id="item_total_price" class="form-control">
                </div>

            </div>
            <hr>
            <h4 class="text-center">Assigned</h4>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4">
                    <h6>Technician</h6>
                    <select name="assigned_technician" id="assigned_technician" class="form-control">
                        @if($jobdescription != "")
                            <option value="">Select Technician</option>
                            @foreach($jobdescription as $technician)
                                <option value="{{ $technician->email }}">{{ $technician->firstname.' '.$technician->lastname }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <button type="button" class="btn btn-primary btn-block" onclick="addParts('{{ uniqid().'_'.time() }}', 'save')">Save <img class="spinnerParts disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <button type="button" class="btn btn-danger btn-block" onclick="addParts('{{ uniqid().'_'.time() }}', 'cancel')">Cancel</button>
                </div>

            </div>


        </div>


            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;" id="editEstimate">

                <div class="col-md-12">
                    <span style="color: darkblue; font-size: 14px; margin-right: 10px;">Estimate
                        <input type="hidden" name="estimate_id" id="estimate_id" value="{{ uniqid().'_'.time() }}">
                    <input type="hidden" name="opportunity_ids" id="opportunity_ids" value="">
                    <input type="hidden" name="discountscheck" id="discountscheck" value="">
                        <input type="checkbox" name="checkbox" id="estimate" onclick="checkEstimate()">
                    </span>


                    <span class="disp-0" style="color: darkblue; font-size: 14px; margin-right: 10px;">Work Order
                        <input type="checkbox" name="checkbox" id="work_order" onclick="checkWorkorder()">
                    </span>

                </div>


            </div>
<hr>


            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Vehicle Licence:</label>
                    <input type="text" name="vehicle_licence" id="vehicle_licence" class="form-control licenceKey">
                </div>

                @if (Auth::user()->userType == "Individual" || Auth::user()->userType == "Commercial")
                <br><br>
                    <div class="col-md-3 disp-0">
                    <label><span style="color: red;">*</span> Email</label> <input type="email" name="email" id="email" value="@if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Commercial") {{ Auth::user()->email }} @else @endif" class="form-control" readonly=""><input type="text" name="telephone" id="telephone" value="@if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Commercial") {{ Auth::user()->phone_number }} @else @endif" class="form-control">
                    </div>
                    @else
                    <br><br>
                    <div class="col-md-3">
                        <input type="hidden" name="busID" value="{{ Auth::user()->busID }}" id="businessID">
                    <label><span style="color: red;">*</span> Email</label> <input type="email" name="email" id="email" value="@if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Commercial") {{ Auth::user()->email }} @else @endif" class="form-control" readonly="">
                    </div>
                    {{-- Add Telephone Number --}}
                    <div class="col-md-3">
                    <label>Telephone</label> <input type="text" name="telephone" id="telephone" class="form-control">
                    </div>
                @endif



                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Vehicle Make:</label>
                    <input type="text" name="make" id="make" class="form-control">
                </div>




            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Vehicle Model:</label>
                    <input type="text" name="model" id="modelz" class="form-control">
                </div>

                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Date:</label> <input type="date" name="date" id="date" class="form-control">
                </div>

                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Service Option:</label> <select name="service_option" id="service_option" class="form-control">
                                        <option value="Major Repair">Major Repair</option>
                                        <option value="Minor Repair">Minor Repair</option>
                                        <option value="Scheduled Maintenance">Scheduled Maintenance</option>
                                        <option value="Emergency Maintenance">Emergency Maintenance</option>
                                    </select>
                </div>
                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Service Type:</label> <select name="service_type" id="service_type" class="form-control">
                                        <option value="Service" selected="selected" disabled="disabled">Service</option>
                                        <optgroup label="Admin"><option value="inspection">inspection</option><option value="registration">registration</option><option value="insurance">insurance</option><option value="road assistance">road assistance</option><option value="business taxes">business taxes</option><option value="Road Fines">Road Fines</option><option value="Ticket">Ticket</option></optgroup>
                                        <optgroup label="Fuel"><option value="fuel">fuel</option><option value="car wash">car wash</option></optgroup>
                                        <optgroup label="Maintenance"><option value="air conditioning recharge">air conditioning recharge</option><option value="air filter">air filter</option><option value="battery">battery</option><option value="brake fluid flush">brake fluid flush</option><option value="brake pads">brake pads</option><option value="brake rotors">brake rotors</option><option value="coolant flush">coolant flush</option><option value="distributor cap &amp; rotor">distributor cap &amp; rotor</option><option value="fuel filter">fuel filter</option><option value="headlight">headlight</option><option value="oil change">oil change</option><option value="power steering flush">power steering flush</option><option value="spark plugs">spark plugs</option><option value="timing belt">timing belt</option><option value="tire - new">tire - new</option><option value="tire balancing">tire balancing</option><option value="tire inflation">tire inflation</option><option value="tire rotation">tire rotation</option><option value="wheel rotation and tire balancing">Wheel Rotation & Tire Balancing</option><option value="transmission fluid flush">transmission fluid flush</option><option value="wheel alignment">wheel alignment</option><option value="wiper blades">wiper blades</option><option value="other">other</option><option value="cabin air filter">cabin air filter</option><option value="smog check">smog check</option></optgroup>
                                        <optgroup label="Repairs"><option value="alternator">alternator</option><option value="belt">belt</option><option value="body work">body work</option><option value="brake caliper">brake caliper</option><option value="carburetor">carburetor</option><option value="catalytic converter">catalytic converter</option><option value="clutch">clutch</option><option value="control arm">control arm</option><option value="coolant temperature sensor">coolant temperature sensor</option><option value="exhaust">exhaust</option><option value="fuel injector">fuel injector</option><option value="fuel tank">fuel tank</option><option value="head gasket">head gasket</option><option value="heater core">heater core</option><option value="hose">hose</option><option value="line">line</option><option value="mass air flow sensor">mass air flow sensor</option><option value="muffler">muffler</option><option value="oxygen sensor">oxygen sensor</option><option value="radiator">radiator</option><option value="shock/strut">shock/strut</option><option value="starter">starter</option><option value="thermostat">thermostat</option><option value="tie rod">tie rod</option><option value="transmission">transmission</option><option value="water pump">water pump</option><option value="wheel bearings">wheel bearings</option><option value="window">window</option><option value="windshield">windshield</option><option value="road side assistance">road side assistance</option><option value="other">other</option><option value="sensor">sensor</option>
                                        </optgroup>
                                    </select>
                </div>
                {{-- <div class="col-md-3">
                    <label>Service Item Spec.:</label> <input type="text" name="service_item_spec" id="service_item_spec" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Manufacturer:</label> <input type="text" name="manufacturer" id="manufacturer" class="form-control">
                </div> --}}


            </div>
            <br>
            <input type="hidden" name="inv_pos" id="inv_pos" value="">
            <input type="hidden" name="inv_position" id="inv_position" value="">
            <input type="hidden" name="inv_position2" id="inv_position2" value="">
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6" style="text-align: right; font-weight: bold; font-size: 14px;">
                    Do you want to record material detail
                </div>
                <div class="col-md-6">
                    <select class="form-control" name="material_select" id="material_select">
                        <option>--Select Material--</option>
                        <option value="material1">Material 1</option>
                    </select>
                </div>

            </div>
            <br>

            <div class="mat_cost1 disp-0">
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-3">
                    <select class="form-control myinventory" id="inventory_list1" name="inventory_list1">
                    @if($inventoryItem != "")
                        <option value="">Select Part from Inventory List</option>
                        @foreach($inventoryItem as $inventoryItems)
                        <option value="{{ $inventoryItems->description }}">{{ $inventoryItems->description }}</option>
                        @endforeach

                        @else
                        <option value="">No Inventory Item</option>
                    @endif
                    </select>
                </div>
                <div class="col-md-3"><input type="number" name="inventory_amount1" id="inventory_amount1" class="form-control" placeholder="Inventory Quantity" readonly=""></div>
                <div class="col-md-3"><button type="button" class="btn btn-secondary btn-block addParts" onclick="openappPart()">Add a Part</button></div>
                <div class="col-md-3"><button type="button" class="btn btn-primary btn-block addPO" onclick="openPO('create_po')">Purchase Order</button></div>
            </div>
            <br>
            <h6><span style="color: red;">*</span>Material Cost 1: </h6>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="material_unit_cost" id="material_unit_cost" class="form-control" placeholder="Unit Cost" readonly=""></div>
                <div class="col-md-6"><input type="number" name="material_markup" id="material_markup" class="form-control" placeholder="Mark Up %"></div>
            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-4"><input type="number" name="material_qty" id="material_qty" class="form-control" placeholder="Qty"></div>
                <div class="col-md-4"><input type="number" name="material_price" id="material_price" class="form-control" placeholder="Price"></div>
                <div class="col-md-4"><input type="number" name="material_cost" id="material_cost" class="form-control" placeholder="Amount"></div>
                <div class="col-md-3 disp-0"><input type="text" name="service_item_spec" id="service_item_spec" class="form-control" placeholder="Service Item Spec." value="NULL"></div>
                <div class="col-md-3 disp-0"><input type="text" name="manufacturer" id="manufacturer" class="form-control" placeholder="Material Manufacturer" value="NULL"></div>
            </div>


            <br>
            {{-- <button type="button" class="btn btn-primary btn-block" onclick="postMaterial('{{ uniqid().'_'.time() }}', 'material1')">Post</button> --}}
            <br>
            </div>


            <div class="row align-items-center justify-content-between mat_select2 disp-0" style="margin-top: 10px !important;">

                <div class="col-md-6" style="text-align: right; font-weight: bold; font-size: 14px;">
                    Do you want to record another material detail
                </div>
                <div class="col-md-6">
                    <select class="form-control" name="material_select2" id="material_select2">
                        <option>--Select Material--</option>
                        <option value="material2">Material 2</option>
                    </select>
                </div>
                <br>
            </div>


            <div class="mat_cost2 disp-0">
                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-3">
                    <select class="form-control myinventory" id="inventory_list2" name="inventory_list2">
                    @if($inventoryItem != "")
                        <option value="">Select Part from Inventory List</option>
                        @foreach($inventoryItem as $inventoryItems)
                        <option value="{{ $inventoryItems->description }}">{{ $inventoryItems->description }}</option>
                        @endforeach
                    @endif
                    </select>
                </div>
                <div class="col-md-3"><input type="number" name="inventory_amount2" id="inventory_amount2" class="form-control" placeholder="Inventory Quantity" readonly=""></div>
                <div class="col-md-3"><button type="button" class="btn btn-secondary btn-block" onclick="openappPart()">Add a Part</button></div>
                <div class="col-md-3"><button type="button" class="btn btn-primary btn-block addPO" onclick="openPO('create_po')">Purchase Order</button></div>
            </div> <br>
            <h6><span style="color: red;">*</span>Material Cost 2: </h6>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="material_unit_cost2" id="material_unit_cost2" class="form-control" placeholder="Unit Cost" readonly=""></div>
                <div class="col-md-6"><input type="number" name="material_markup2" id="material_markup2" class="form-control" placeholder="Mark Up %"></div>
            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4"><input type="number" name="material_qty2" id="material_qty2" class="form-control" placeholder="Qty"></div>
                <div class="col-md-4"><input type="number" name="material_price2" id="material_price2" class="form-control" placeholder="Price"></div>
                <div class="col-md-4"><input type="number" name="material_cost2" id="material_cost2" class="form-control" placeholder="Amount"></div>
                <div class="col-md-3 disp-0"><input type="text" name="service_item_spec2" id="service_item_spec2" class="form-control" placeholder="Service Item Spec." value="NULL"></div>
                <div class="col-md-3 disp-0"><input type="text" name="manufacturer2" id="manufacturer2" class="form-control" placeholder="Material Manufacturer" value="NULL"></div>
            </div>


            <br>
            {{-- <button type="button" class="btn btn-primary btn-block" onclick="postMaterial('{{ uniqid().'_'.time() }}', 'material2')">Post</button> --}}
                <br>
            </div>


            <div class="row align-items-center justify-content-between mat_select3 disp-0" style="margin-top: 10px !important;">

                <div class="col-md-6" style="text-align: right; font-weight: bold; font-size: 14px;">
                    Do you want to record another material detail
                </div>
                <div class="col-md-6">
                    <select class="form-control" name="material_select3" id="material_select3">
                        <option>--Select Material--</option>
                        <option value="material3">Material 3</option>
                    </select>
                </div>
                <br>
            </div>


            <div class="mat_cost3 disp-0">
                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-3">
                    <select class="form-control myinventory" id="inventory_list3" name="inventory_list3">
                    @if($inventoryItem != "")
                        <option value="">Select Part from Inventory List</option>
                        @foreach($inventoryItem as $inventoryItems)
                        <option value="{{ $inventoryItems->description }}">{{ $inventoryItems->description }}</option>
                        @endforeach
                    @endif
                    </select>
                </div>
                <div class="col-md-3"><input type="number" name="inventory_amount3" id="inventory_amount3" class="form-control" placeholder="Inventory Quantity" readonly=""></div>
                <div class="col-md-3"><button type="button" class="btn btn-secondary btn-block" onclick="openappPart()">Add a Part</button></div>
                <div class="col-md-3"><button type="button" class="btn btn-primary btn-block addPO" onclick="openPO('create_po')">Purchase Order</button></div>
            </div> <br>
            <h6><span style="color: red;">*</span>Material Cost 3: </h6>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="material_unit_cost3" id="material_unit_cost3" class="form-control" placeholder="Unit Cost"></div>
                <div class="col-md-6"><input type="number" name="material_markup3" id="material_markup3" class="form-control" placeholder="Mark Up %"></div>
            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4"><input type="number" name="material_qty3" id="material_qty3" class="form-control" placeholder="Qty"></div>
                <div class="col-md-4"><input type="number" name="material_price3" id="material_price3" class="form-control" placeholder="Price"></div>
                <div class="col-md-4"><input type="number" name="material_cost3" id="material_cost3" class="form-control" placeholder="Amount"></div>
                <div class="col-md-3 disp-0"><input type="text" name="service_item_spec3" id="service_item_spec3" class="form-control" placeholder="Service Item Spec." value="NULL"></div>
                <div class="col-md-3 disp-0"><input type="text" name="manufacturer3" id="manufacturer3" class="form-control" placeholder="Material Manufacturer" value="NULL"></div>
            </div>


            </div>
            <br>

            <div class="mat_cost4 disp-0">
                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-3">
                    <select class="form-control myinventory" id="inventory_list4" name="inventory_list4">
                    @if($inventoryItem != "")
                        <option value="">Select Part from Inventory List</option>
                        @foreach($inventoryItem as $inventoryItems)
                        <option value="{{ $inventoryItems->description }}">{{ $inventoryItems->description }}</option>
                        @endforeach
                    @endif
                    </select>
                </div>
                <div class="col-md-3"><input type="number" name="inventory_amount4" id="inventory_amount4" class="form-control" placeholder="Inventory Quantity"></div>
                <div class="col-md-3"><button type="button" class="btn btn-secondary btn-block" onclick="openappPart()">Add a Part</button></div>
                <div class="col-md-3"><button type="button" class="btn btn-primary btn-block addPO" onclick="openPO('create_po')">Purchase Order</button></div>
            </div> <br>
            <h6><span style="color: red;">*</span>Material Cost 4: </h6>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="material_unit_cost4" id="material_unit_cost4" class="form-control" placeholder="Unit Cost"></div>
                <div class="col-md-6"><input type="number" name="material_markup4" id="material_markup4" class="form-control" placeholder="Mark Up %"></div>
            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4"><input type="number" name="material_qty4" id="material_qty4" class="form-control" placeholder="Qty"></div>
                <div class="col-md-4"><input type="number" name="material_price4" id="material_price4" class="form-control" placeholder="Price"></div>
                <div class="col-md-4"><input type="number" name="material_cost4" id="material_cost4" class="form-control" placeholder="Amount"></div>
                <div class="col-md-3 disp-0"><input type="text" name="service_item_spec4" id="service_item_spec4" class="form-control" placeholder="Service Item Spec." value="NULL"></div>
                <div class="col-md-3 disp-0"><input type="text" name="manufacturer4" id="manufacturer4" class="form-control" placeholder="Material Manufacturer" value="NULL"></div>
            </div>

            </div>

                        <br>

            <div class="mat_cost5 disp-0">
                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-3">
                    <select class="form-control myinventory" id="inventory_list5" name="inventory_list5">
                    @if($inventoryItem != "")
                        <option value="">Select Part from Inventory List</option>
                        @foreach($inventoryItem as $inventoryItems)
                        <option value="{{ $inventoryItems->description }}">{{ $inventoryItems->description }}</option>
                        @endforeach
                    @endif
                    </select>
                </div>
                <div class="col-md-3"><input type="number" name="inventory_amount5" id="inventory_amount5" class="form-control" placeholder="Inventory Quantity"></div>
                <div class="col-md-3"><button type="button" class="btn btn-secondary btn-block" onclick="openappPart()">Add a Part</button></div>
                <div class="col-md-3"><button type="button" class="btn btn-primary btn-block addPO" onclick="openPO('create_po')">Purchase Order</button></div>
            </div> <br>
            <h6><span style="color: red;">*</span>Material Cost 5: </h6>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="material_unit_cost5" id="material_unit_cost5" class="form-control" placeholder="Unit Cost"></div>
                <div class="col-md-6"><input type="number" name="material_markup5" id="material_markup5" class="form-control" placeholder="Mark Up %"></div>
            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4"><input type="number" name="material_qty5" id="material_qty5" class="form-control" placeholder="Qty"></div>
                <div class="col-md-4"><input type="number" name="material_price5" id="material_price5" class="form-control" placeholder="Price"></div>
                <div class="col-md-4"><input type="number" name="material_cost5" id="material_cost5" class="form-control" placeholder="Amount"></div>
                <div class="col-md-3 disp-0"><input type="text" name="service_item_spec5" id="service_item_spec5" class="form-control" placeholder="Service Item Spec." value="NULL"></div>
                <div class="col-md-3 disp-0"><input type="text" name="manufacturer5" id="manufacturer5" class="form-control" placeholder="Material Manufacturer" value="NULL"></div>
            </div>

            </div>

                        <br>

            <div class="mat_cost6 disp-0">
                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-3">
                    <select class="form-control myinventory" id="inventory_list6" name="inventory_list6">
                    @if($inventoryItem != "")
                        <option value="">Select Part from Inventory List</option>
                        @foreach($inventoryItem as $inventoryItems)
                        <option value="{{ $inventoryItems->description }}">{{ $inventoryItems->description }}</option>
                        @endforeach
                    @endif
                    </select>
                </div>
                <div class="col-md-3"><input type="number" name="inventory_amount6" id="inventory_amount6" class="form-control" placeholder="Inventory Quantity"></div>
                <div class="col-md-3"><button type="button" class="btn btn-secondary btn-block" onclick="openappPart()">Add a Part</button></div>
                <div class="col-md-3"><button type="button" class="btn btn-primary btn-block addPO" onclick="openPO('create_po')">Purchase Order</button></div>
            </div> <br>
            <h6><span style="color: red;">*</span>Material Cost 6: </h6>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="material_unit_cost6" id="material_unit_cost6" class="form-control" placeholder="Unit Cost"></div>
                <div class="col-md-6"><input type="number" name="material_markup6" id="material_markup6" class="form-control" placeholder="Mark Up %"></div>
            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4"><input type="number" name="material_qty6" id="material_qty6" class="form-control" placeholder="Qty"></div>
                <div class="col-md-4"><input type="number" name="material_price6" id="material_price6" class="form-control" placeholder="Price"></div>
                <div class="col-md-4"><input type="number" name="material_cost6" id="material_cost6" class="form-control" placeholder="Amount"></div>
                <div class="col-md-3 disp-0"><input type="text" name="service_item_spec6" id="service_item_spec6" class="form-control" placeholder="Service Item Spec." value="NULL"></div>
                <div class="col-md-3 disp-0"><input type="text" name="manufacturer6" id="manufacturer6" class="form-control" placeholder="Material Manufacturer" value="NULL"></div>
            </div>

            </div>

                        <br>

            <div class="mat_cost7 disp-0">
                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-3">
                    <select class="form-control myinventory" id="inventory_list7" name="inventory_list7">
                    @if($inventoryItem != "")
                        <option value="">Select Part from Inventory List</option>
                        @foreach($inventoryItem as $inventoryItems)
                        <option value="{{ $inventoryItems->description }}">{{ $inventoryItems->description }}</option>
                        @endforeach
                    @endif
                    </select>
                </div>
                <div class="col-md-3"><input type="number" name="inventory_amount7" id="inventory_amount7" class="form-control" placeholder="Inventory Quantity"></div>
                <div class="col-md-3"><button type="button" class="btn btn-secondary btn-block" onclick="openappPart()">Add a Part</button></div>
                <div class="col-md-3"><button type="button" class="btn btn-primary btn-block addPO" onclick="openPO('create_po')">Purchase Order</button></div>
            </div> <br>
            <h6><span style="color: red;">*</span>Material Cost 7: </h6>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="material_unit_cost7" id="material_unit_cost7" class="form-control" placeholder="Unit Cost"></div>
                <div class="col-md-6"><input type="number" name="material_markup7" id="material_markup7" class="form-control" placeholder="Mark Up %"></div>
            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4"><input type="number" name="material_qty7" id="material_qty7" class="form-control" placeholder="Qty"></div>
                <div class="col-md-4"><input type="number" name="material_price7" id="material_price7" class="form-control" placeholder="Price"></div>
                <div class="col-md-4"><input type="number" name="material_cost7" id="material_cost7" class="form-control" placeholder="Amount"></div>
                <div class="col-md-3 disp-0"><input type="text" name="service_item_spec7" id="service_item_spec7" class="form-control" placeholder="Service Item Spec." value="NULL"></div>
                <div class="col-md-3 disp-0"><input type="text" name="manufacturer7" id="manufacturer7" class="form-control" placeholder="Material Manufacturer" value="NULL"></div>
            </div>

            </div>
            <br>

            <div class="mat_cost8 disp-0">
                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-3">
                    <select class="form-control myinventory" id="inventory_list8" name="inventory_list8">
                    @if($inventoryItem != "")
                        <option value="">Select Part from Inventory List</option>
                        @foreach($inventoryItem as $inventoryItems)
                        <option value="{{ $inventoryItems->description }}">{{ $inventoryItems->description }}</option>
                        @endforeach
                    @endif
                    </select>
                </div>
                <div class="col-md-3"><input type="number" name="inventory_amount8" id="inventory_amount8" class="form-control" placeholder="Inventory Quantity"></div>
                <div class="col-md-3"><button type="button" class="btn btn-secondary btn-block" onclick="openappPart()">Add a Part</button></div>
                <div class="col-md-3"><button type="button" class="btn btn-primary btn-block addPO" onclick="openPO('create_po')">Purchase Order</button></div>
            </div> <br>
            <h6><span style="color: red;">*</span>Material Cost 8: </h6>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="material_unit_cost8" id="material_unit_cost8" class="form-control" placeholder="Unit Cost"></div>
                <div class="col-md-6"><input type="number" name="material_markup8" id="material_markup8" class="form-control" placeholder="Mark Up %"></div>
            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4"><input type="number" name="material_qty8" id="material_qty8" class="form-control" placeholder="Qty"></div>
                <div class="col-md-4"><input type="number" name="material_price8" id="material_price8" class="form-control" placeholder="Price"></div>
                <div class="col-md-4"><input type="number" name="material_cost8" id="material_cost8" class="form-control" placeholder="Amount"></div>
                <div class="col-md-3 disp-0"><input type="text" name="service_item_spec8" id="service_item_spec8" class="form-control" placeholder="Service Item Spec." value="NULL"></div>
                <div class="col-md-3 disp-0"><input type="text" name="manufacturer8" id="manufacturer8" class="form-control" placeholder="Material Manufacturer" value="NULL"></div>
            </div>

            </div>
            <br>

            <div class="mat_cost9 disp-0">
                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-3">
                    <select class="form-control myinventory" id="inventory_list9" name="inventory_list9">
                    @if($inventoryItem != "")
                        <option value="">Select Part from Inventory List</option>
                        @foreach($inventoryItem as $inventoryItems)
                        <option value="{{ $inventoryItems->description }}">{{ $inventoryItems->description }}</option>
                        @endforeach
                    @endif
                    </select>
                </div>
                <div class="col-md-3"><input type="number" name="inventory_amount9" id="inventory_amount9" class="form-control" placeholder="Inventory Quantity"></div>
                <div class="col-md-3"><button type="button" class="btn btn-secondary btn-block" onclick="openappPart()">Add a Part</button></div>
                <div class="col-md-3"><button type="button" class="btn btn-primary btn-block addPO" onclick="openPO('create_po')">Purchase Order</button></div>
            </div> <br>
            <h6><span style="color: red;">*</span>Material Cost 9: </h6>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="material_unit_cost9" id="material_unit_cost9" class="form-control" placeholder="Unit Cost"></div>
                <div class="col-md-6"><input type="number" name="material_markup9" id="material_markup9" class="form-control" placeholder="Mark Up %"></div>
            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4"><input type="number" name="material_qty9" id="material_qty9" class="form-control" placeholder="Qty"></div>
                <div class="col-md-4"><input type="number" name="material_price9" id="material_price9" class="form-control" placeholder="Price"></div>
                <div class="col-md-4"><input type="number" name="material_cost9" id="material_cost9" class="form-control" placeholder="Amount"></div>
                <div class="col-md-3 disp-0"><input type="text" name="service_item_spec9" id="service_item_spec9" class="form-control" placeholder="Service Item Spec." value="NULL"></div>
                <div class="col-md-3 disp-0"><input type="text" name="manufacturer9" id="manufacturer9" class="form-control" placeholder="Material Manufacturer" value="NULL"></div>
            </div>

            </div>
            <br>

            <div class="mat_cost10 disp-0">
                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-3">
                    <select class="form-control myinventory" id="inventory_list10" name="inventory_list10">
                    @if($inventoryItem != "")
                        <option value="">Select Part from Inventory List</option>
                        @foreach($inventoryItem as $inventoryItems)
                        <option value="{{ $inventoryItems->description }}">{{ $inventoryItems->description }}</option>
                        @endforeach
                    @endif
                    </select>
                </div>
                <div class="col-md-3"><input type="number" name="inventory_amount10" id="inventory_amount10" class="form-control" placeholder="Inventory Quantity"></div>
                <div class="col-md-3"><button type="button" class="btn btn-secondary btn-block" onclick="openappPart()">Add a Part</button></div>
                <div class="col-md-3"><button type="button" class="btn btn-primary btn-block addPO" onclick="openPO('create_po')">Purchase Order</button></div>
            </div> <br>
            <h6><span style="color: red;">*</span>Material Cost 10: </h6>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="material_unit_cost10" id="material_unit_cost10" class="form-control" placeholder="Unit Cost"></div>
                <div class="col-md-6"><input type="number" name="material_markup10" id="material_markup10" class="form-control" placeholder="Mark Up %"></div>
            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4"><input type="number" name="material_qty10" id="material_qty10" class="form-control" placeholder="Qty"></div>
                <div class="col-md-4"><input type="number" name="material_price10" id="material_price10" class="form-control" placeholder="Price"></div>
                <div class="col-md-4"><input type="number" name="material_cost10" id="material_cost10" class="form-control" placeholder="Amount"></div>
                <div class="col-md-3 disp-0"><input type="text" name="service_item_spec10" id="service_item_spec10" class="form-control" placeholder="Service Item Spec." value="NULL"></div>
                <div class="col-md-3 disp-0"><input type="text" name="manufacturer10" id="manufacturer10" class="form-control" placeholder="Material Manufacturer" value="NULL"></div>
            </div>

            </div>
            <br>

            {{-- Add More Materials Button --}}
                <button type="button" class="btn btn-secondary addMatsNew disp-0" onclick="addnewRecs('material')"><i class="fa fa-plus"></i></button>
            {{-- End More Materials Button --}}

            <hr>
            <div class="lab_cost1">

            <h5 style="text-decoration: underline;">Labour Cost 1: </h5> <br>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4">
                    <h6>Labour Category</h6>
                <select name="labour_cat1" id="labour_cat1" class="form-control">
                    @if($myLabourCategory != "")
                        <option value="">Select one</option>
                        @foreach($myLabourCategory as $myLabourCategorys)
                            <option value="{{ $myLabourCategorys->labours_category }}">{{ $myLabourCategorys->labours_category }}</option>
                        @endforeach
                    @else
                    <option value="">No labour category</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Job Description</h6>
                <select name="labour_jobdescription1" id="labour_jobdescription1" class="form-control">
                    @if($jobdescription != "")
                        <option value="">Select one</option>
                        @foreach($jobdescription as $jobdescriptions)
                            <option value="{{ $jobdescriptions->job_description }}">{{ $jobdescriptions->job_description }}</option>
                        @endforeach
                    @else
                    <option value="">No Job Description Added</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Labour Rate</h6>
                <select name="labour_rate1" id="labour_rate1" class="form-control lab_rate">
                    <option value="">Select One</option>
                    <option value="rate_per_hour">Hour Rate</option>
                    <option value="flat_rate">Flat Rate</option>
                    <option value="wholesale_rate">Wholesale Rate</option>
                    <option value="retail_rate">Retail Rate</option>

                </select>
                </div>
            </div>
            <br>
            <h6><span style="color: red;">*</span>Labour Hour 1: </h6>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="labour_qty" id="labour_qty" class="form-control lab_qty" placeholder="# of Hours"></div>
                <div class="col-md-6"><input type="number" name="labour_cost" id="labour_cost" class="form-control" placeholder="Amount"></div>
            </div>
            <br>
            </div>

            <div class="lab_cost2 disp-0">
                <h5 style="text-decoration: underline;">Labour Cost 2: </h5> <br>
                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4">
                    <h6>Labour Category</h6>
                <select name="labour_cat2" id="labour_cat2" class="form-control">
                    @if($myLabourCategory != "")
                        <option value="">Select one</option>
                        @foreach($myLabourCategory as $myLabourCategorys)
                            <option value="{{ $myLabourCategorys->labours_category }}">{{ $myLabourCategorys->labours_category }}</option>
                        @endforeach
                    @else
                    <option value="">No labour category</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Job Description</h6>
                <select name="labour_jobdescription2" id="labour_jobdescription2" class="form-control">
                    @if($jobdescription != "")
                        <option value="">Select one</option>
                        @foreach($jobdescription as $jobdescriptions)
                            <option value="{{ $jobdescriptions->job_description }}">{{ $jobdescriptions->job_description }}</option>
                        @endforeach
                    @else
                    <option value="">No Job Description Added</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Labour Rate</h6>
                <select name="labour_rate2" id="labour_rate2" class="form-control lab_rate">
                    <option value="">Select One</option>
                    <option value="rate_per_hour">Hour Rate</option>
                    <option value="flat_rate">Flat Rate</option>
                    <option value="wholesale_rate">Wholesale Rate</option>
                    <option value="retail_rate">Retail Rate</option>

                </select>
                </div>
            </div>
            <br>


            <h6><span style="color: red;">*</span>Labour Hour 2: </h6>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="labour_qty2" id="labour_qty2" class="form-control lab_qty" placeholder="# of Hours"></div>
                <div class="col-md-6"><input type="number" name="labour_cost2" id="labour_cost2" class="form-control" placeholder="Amount"></div>
            </div>
            <br>
            </div>


            <div class="lab_cost3 disp-0">
                <h5 style="text-decoration: underline;">Labour Cost 3: </h5> <br>
                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4">
                    <h6>Labour Category</h6>
                <select name="labour_cat3" id="labour_cat3" class="form-control">
                    @if($myLabourCategory != "")
                        <option value="">Select one</option>
                        @foreach($myLabourCategory as $myLabourCategorys)
                            <option value="{{ $myLabourCategorys->labours_category }}">{{ $myLabourCategorys->labours_category }}</option>
                        @endforeach
                    @else
                    <option value="">No labour category</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Job Description</h6>
                <select name="labour_jobdescription3" id="labour_jobdescription3" class="form-control">
                    @if($jobdescription != "")
                        <option value="">Select one</option>
                        @foreach($jobdescription as $jobdescriptions)
                            <option value="{{ $jobdescriptions->job_description }}">{{ $jobdescriptions->job_description }}</option>
                        @endforeach
                    @else
                    <option value="">No Job Description Added</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Labour Rate</h6>
                <select name="labour_rate2" id="labour_rate3" class="form-control lab_rate">
                    <option value="">Select One</option>
                    <option value="rate_per_hour">Hour Rate</option>
                    <option value="flat_rate">Flat Rate</option>
                    <option value="wholesale_rate">Wholesale Rate</option>
                    <option value="retail_rate">Retail Rate</option>

                </select>
                </div>
            </div>
            <br>


            <h6><span style="color: red;">*</span>Labour Hour 3: </h6>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="labour_qty3" id="labour_qty3" class="form-control lab_qty" placeholder="# of Hours"></div>
                <div class="col-md-6"><input type="number" name="labour_cost3" id="labour_cost3" class="form-control" placeholder="Amount"></div>
            </div>
            <br>
            </div>

            <div class="lab_cost4 disp-0">
                <h5 style="text-decoration: underline;">Labour Cost 4: </h5> <br>
                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4">
                    <h6>Labour Category</h6>
                <select name="labour_cat4" id="labour_cat4" class="form-control">
                    @if($myLabourCategory != "")
                        <option value="">Select one</option>
                        @foreach($myLabourCategory as $myLabourCategorys)
                            <option value="{{ $myLabourCategorys->labours_category }}">{{ $myLabourCategorys->labours_category }}</option>
                        @endforeach
                    @else
                    <option value="">No labour category</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Job Description</h6>
                <select name="labour_jobdescription4" id="labour_jobdescription4" class="form-control">
                    @if($jobdescription != "")
                        <option value="">Select one</option>
                        @foreach($jobdescription as $jobdescriptions)
                            <option value="{{ $jobdescriptions->job_description }}">{{ $jobdescriptions->job_description }}</option>
                        @endforeach
                    @else
                    <option value="">No Job Description Added</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Labour Rate</h6>
                <select name="labour_rate4" id="labour_rate4" class="form-control lab_rate">
                    <option value="">Select One</option>
                    <option value="rate_per_hour">Hour Rate</option>
                    <option value="flat_rate">Flat Rate</option>
                    <option value="wholesale_rate">Wholesale Rate</option>
                    <option value="retail_rate">Retail Rate</option>

                </select>
                </div>
            </div>
            <br>


            <h6><span style="color: red;">*</span>Labour Hour 4: </h6>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="labour_qty4" id="labour_qty4" class="form-control lab_qty" placeholder="# of Hours"></div>
                <div class="col-md-6"><input type="number" name="labour_cost4" id="labour_cost4" class="form-control" placeholder="Amount"></div>
            </div>
            <br>
            </div>

            <hr>
            <div class="lab_cost5 disp-0">
                <h5 style="text-decoration: underline;">Labour Cost 5: </h5> <br>
                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4">
                    <h6>Labour Category</h6>
                <select name="labour_cat5" id="labour_cat5" class="form-control">
                    @if($myLabourCategory != "")
                        <option value="">Select one</option>
                        @foreach($myLabourCategory as $myLabourCategorys)
                            <option value="{{ $myLabourCategorys->labours_category }}">{{ $myLabourCategorys->labours_category }}</option>
                        @endforeach
                    @else
                    <option value="">No labour category</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Job Description</h6>
                <select name="labour_jobdescription5" id="labour_jobdescription5" class="form-control">
                    @if($jobdescription != "")
                        <option value="">Select one</option>
                        @foreach($jobdescription as $jobdescriptions)
                            <option value="{{ $jobdescriptions->job_description }}">{{ $jobdescriptions->job_description }}</option>
                        @endforeach
                    @else
                    <option value="">No Job Description Added</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Labour Rate</h6>
                <select name="labour_rate5" id="labour_rate5" class="form-control lab_rate">
                    <option value="">Select One</option>
                    <option value="rate_per_hour">Hour Rate</option>
                    <option value="flat_rate">Flat Rate</option>
                    <option value="wholesale_rate">Wholesale Rate</option>
                    <option value="retail_rate">Retail Rate</option>

                </select>
                </div>
            </div>
            <br>


            <h6><span style="color: red;">*</span>Labour Hour 5: </h6>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="labour_qty5" id="labour_qty5" class="form-control lab_qty" placeholder="# of Hours"></div>
                <div class="col-md-6"><input type="number" name="labour_cost5" id="labour_cost5" class="form-control" placeholder="Amount"></div>
            </div>
            <br>
            </div>

            <div class="lab_cost6 disp-0">
                <h5 style="text-decoration: underline;">Labour Cost 6: </h5> <br>
                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4">
                    <h6>Labour Category</h6>
                <select name="labour_cat6" id="labour_cat6" class="form-control">
                    @if($myLabourCategory != "")
                        <option value="">Select one</option>
                        @foreach($myLabourCategory as $myLabourCategorys)
                            <option value="{{ $myLabourCategorys->labours_category }}">{{ $myLabourCategorys->labours_category }}</option>
                        @endforeach
                    @else
                    <option value="">No labour category</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Job Description</h6>
                <select name="labour_jobdescription6" id="labour_jobdescription6" class="form-control">
                    @if($jobdescription != "")
                        <option value="">Select one</option>
                        @foreach($jobdescription as $jobdescriptions)
                            <option value="{{ $jobdescriptions->job_description }}">{{ $jobdescriptions->job_description }}</option>
                        @endforeach
                    @else
                    <option value="">No Job Description Added</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Labour Rate</h6>
                <select name="labour_rate6" id="labour_rate6" class="form-control lab_rate">
                    <option value="">Select One</option>
                    <option value="rate_per_hour">Hour Rate</option>
                    <option value="flat_rate">Flat Rate</option>
                    <option value="wholesale_rate">Wholesale Rate</option>
                    <option value="retail_rate">Retail Rate</option>

                </select>
                </div>
            </div>
            <br>


            <h6><span style="color: red;">*</span>Labour Hour 6: </h6>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="labour_qty6" id="labour_qty6" class="form-control lab_qty" placeholder="# of Hours"></div>
                <div class="col-md-6"><input type="number" name="labour_cost6" id="labour_cost6" class="form-control" placeholder="Amount"></div>
            </div>
            <br>
            </div>


            <div class="lab_cost7 disp-0">
                <h5 style="text-decoration: underline;">Labour Cost 7: </h5> <br>
                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4">
                    <h6>Labour Category</h6>
                <select name="labour_cat7" id="labour_cat7" class="form-control">
                    @if($myLabourCategory != "")
                        <option value="">Select one</option>
                        @foreach($myLabourCategory as $myLabourCategorys)
                            <option value="{{ $myLabourCategorys->labours_category }}">{{ $myLabourCategorys->labours_category }}</option>
                        @endforeach
                    @else
                    <option value="">No labour category</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Job Description</h6>
                <select name="labour_jobdescription7" id="labour_jobdescription7" class="form-control">
                    @if($jobdescription != "")
                        <option value="">Select one</option>
                        @foreach($jobdescription as $jobdescriptions)
                            <option value="{{ $jobdescriptions->job_description }}">{{ $jobdescriptions->job_description }}</option>
                        @endforeach
                    @else
                    <option value="">No Job Description Added</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Labour Rate</h6>
                <select name="labour_rate7" id="labour_rate7" class="form-control lab_rate">
                    <option value="">Select One</option>
                    <option value="rate_per_hour">Hour Rate</option>
                    <option value="flat_rate">Flat Rate</option>
                    <option value="wholesale_rate">Wholesale Rate</option>
                    <option value="retail_rate">Retail Rate</option>

                </select>
                </div>
            </div>
            <br>


            <h6><span style="color: red;">*</span>Labour Hour 7: </h6>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="labour_qty7" id="labour_qty7" class="form-control lab_qty" placeholder="# of Hours"></div>
                <div class="col-md-6"><input type="number" name="labour_cost7" id="labour_cost7" class="form-control" placeholder="Amount"></div>
            </div>
            <br>
            </div>

            <div class="lab_cost8 disp-0">
                <h5 style="text-decoration: underline;">Labour Cost 8: </h5> <br>
                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4">
                    <h6>Labour Category</h6>
                <select name="labour_cat8" id="labour_cat8" class="form-control">
                    @if($myLabourCategory != "")
                        <option value="">Select one</option>
                        @foreach($myLabourCategory as $myLabourCategorys)
                            <option value="{{ $myLabourCategorys->labours_category }}">{{ $myLabourCategorys->labours_category }}</option>
                        @endforeach
                    @else
                    <option value="">No labour category</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Job Description</h6>
                <select name="labour_jobdescription8" id="labour_jobdescription8" class="form-control">
                    @if($jobdescription != "")
                        <option value="">Select one</option>
                        @foreach($jobdescription as $jobdescriptions)
                            <option value="{{ $jobdescriptions->job_description }}">{{ $jobdescriptions->job_description }}</option>
                        @endforeach
                    @else
                    <option value="">No Job Description Added</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Labour Rate</h6>
                <select name="labour_rate8" id="labour_rate8" class="form-control lab_rate">
                    <option value="">Select One</option>
                    <option value="rate_per_hour">Hour Rate</option>
                    <option value="flat_rate">Flat Rate</option>
                    <option value="wholesale_rate">Wholesale Rate</option>
                    <option value="retail_rate">Retail Rate</option>

                </select>
                </div>
            </div>
            <br>


            <h6><span style="color: red;">*</span>Labour Hour 8: </h6>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="labour_qty8" id="labour_qty8" class="form-control lab_qty" placeholder="# of Hours"></div>
                <div class="col-md-6"><input type="number" name="labour_cost8" id="labour_cost8" class="form-control" placeholder="Amount"></div>
            </div>
            <br>
            </div>


            <div class="lab_cost9 disp-0">
                <h5 style="text-decoration: underline;">Labour Cost 9: </h5> <br>
                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4">
                    <h6>Labour Category</h6>
                <select name="labour_cat9" id="labour_cat9" class="form-control">
                    @if($myLabourCategory != "")
                        <option value="">Select one</option>
                        @foreach($myLabourCategory as $myLabourCategorys)
                            <option value="{{ $myLabourCategorys->labours_category }}">{{ $myLabourCategorys->labours_category }}</option>
                        @endforeach
                    @else
                    <option value="">No labour category</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Job Description</h6>
                <select name="labour_jobdescription9" id="labour_jobdescription9" class="form-control">
                    @if($jobdescription != "")
                        <option value="">Select one</option>
                        @foreach($jobdescription as $jobdescriptions)
                            <option value="{{ $jobdescriptions->job_description }}">{{ $jobdescriptions->job_description }}</option>
                        @endforeach
                    @else
                    <option value="">No Job Description Added</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Labour Rate</h6>
                <select name="labour_rate9" id="labour_rate9" class="form-control lab_rate">
                    <option value="">Select One</option>
                    <option value="rate_per_hour">Hour Rate</option>
                    <option value="flat_rate">Flat Rate</option>
                    <option value="wholesale_rate">Wholesale Rate</option>
                    <option value="retail_rate">Retail Rate</option>

                </select>
                </div>
            </div>
            <br>


            <h6><span style="color: red;">*</span>Labour Hour 9: </h6>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="labour_qty9" id="labour_qty9" class="form-control lab_qty" placeholder="# of Hours"></div>
                <div class="col-md-6"><input type="number" name="labour_cost9" id="labour_cost9" class="form-control" placeholder="Amount"></div>
            </div>
            <br>
            </div>

            <div class="lab_cost10 disp-0">
                <h5 style="text-decoration: underline;">Labour Cost 10: </h5> <br>
                <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-4">
                    <h6>Labour Category</h6>
                <select name="labour_cat10" id="labour_cat10" class="form-control">
                    @if($myLabourCategory != "")
                        <option value="">Select one</option>
                        @foreach($myLabourCategory as $myLabourCategorys)
                            <option value="{{ $myLabourCategorys->labours_category }}">{{ $myLabourCategorys->labours_category }}</option>
                        @endforeach
                    @else
                    <option value="">No labour category</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Job Description</h6>
                <select name="labour_jobdescription10" id="labour_jobdescription10" class="form-control">
                    @if($jobdescription != "")
                        <option value="">Select one</option>
                        @foreach($jobdescription as $jobdescriptions)
                            <option value="{{ $jobdescriptions->job_description }}">{{ $jobdescriptions->job_description }}</option>
                        @endforeach
                    @else
                    <option value="">No Job Description Added</option>
                    @endif

                </select>
                </div>

                <div class="col-md-4">
                    <h6>Labour Rate</h6>
                <select name="labour_rate10" id="labour_rate10" class="form-control lab_rate">
                    <option value="">Select One</option>
                    <option value="rate_per_hour">Hour Rate</option>
                    <option value="flat_rate">Flat Rate</option>
                    <option value="wholesale_rate">Wholesale Rate</option>
                    <option value="retail_rate">Retail Rate</option>

                </select>
                </div>
            </div>
            <br>


            <h6><span style="color: red;">*</span>Labour Hour 10: </h6>
            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6"><input type="number" name="labour_qty10" id="labour_qty10" class="form-control lab_qty" placeholder="# of Hours"></div>
                <div class="col-md-6"><input type="number" name="labour_cost10" id="labour_cost10" class="form-control" placeholder="Amount"></div>
            </div>
            <br>
            </div>

            {{-- Add More Materials Button --}}
                <button type="button" class="btn btn-secondary addMatLab disp-0" onclick="addnewRecs('labour')"><i class="fa fa-plus"></i></button>
            {{-- End More Materials Button --}}

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6" style="text-align: right; font-weight: bold; font-size: 14px;">
                    <span style="color: red;">*</span> Technician:
                </div>
                <div class="col-md-6">
                    <select name="technician_in_charge" id="technician_in_charge" class="form-control">
                        @if($jobdescription != "")
                            <option value="">Select Technician</option>
                            @foreach($jobdescription as $technician)
                                <option value="{{ $technician->email }}">{{ $technician->firstname.' '.$technician->lastname }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            <br>
            </div>


            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6" style="text-align: right; font-weight: bold; font-size: 14px;">
                    <span style="color: red;">*</span> Other Cost:
                </div>
                <div class="col-md-6">
                    <input type="number" name="other_cost" id="other_cost" class="form-control" placeholder="Amount">
                </div>
            <br>
            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6" style="text-align: right; font-weight: bold; font-size: 14px;">
                    <span style="color: red;">*</span> Part Cost:
                </div>
                <div class="col-md-6">
                    <input type="number" name="part_cost" id="part_cost" class="form-control" placeholder="Amount">
                </div>
            <br>
            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6" style="text-align: right; font-weight: bold; font-size: 14px;">
                    Total Labour Cost:
                </div>
                <div class="col-md-6">
                    <input type="number" name="tot_labourcost" id="tot_labourcost" class="form-control" placeholder="Labour cost" readonly="">
                </div>
            <br>
            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6" style="text-align: right; font-weight: bold; font-size: 14px;">
                    Sub-Total:
                </div>
                <div class="col-md-6">
                    <input type="number" name="sub_totcost" id="sub_totcost" class="form-control" placeholder="Sub Total" readonly="">
                </div>
            <br>
            </div>

            <div class="moreServ disp-0">

            <div class="row align-items-center justify-content-between " style="margin-top: 10px !important;">

                <div class="col-md-6" style="text-align: right; font-weight: bold; font-size: 14px;">
                    <span style="color: red;">*</span> Discount %:
                </div>
                <div class="col-md-6">
                    <input type="number" name="discountcost_percent" id="discountcost_percent" class="form-control" value="{{ $discountcharge }}" readonly="">
                </div>
            <br>
            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-6" style="text-align: right; font-weight: bold; font-size: 14px;">
                    <span style="color: red;">*</span> Discount Amount:
                </div>
                <div class="col-md-6">
                    <input type="number" name="discountcost_amount" id="discountcost_amount" class="form-control" value="" readonly="">
                </div>
            <br>
            </div>

            <div class="row align-items-center justify-content-between adminfee" style="margin-top: 10px !important;">

                <div class="col-md-6" style="text-align: right; font-weight: bold; font-size: 14px;">
                    <span style="color: red;">*</span> Admin Fee %:
                </div>
                <div class="col-md-6">
                    <input type="number" name="servicecost_percent" id="servicecost_percent" class="form-control" value="{{ $servicePercent }}" readonly="">
                </div>
            <br>
            </div>

            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">
                <div class="col-md-6" style="text-align: right; font-weight: bold; font-size: 14px;">
                    <span style="color: red;">*</span> Total Price:
                </div>
                <div class="col-md-6">
                    <input type="number" name="total_cost" id="total_cost" class="form-control" placeholder="Total Amount" readonly="">
                </div>
            </div>

            <div class="row align-items-center justify-content-between" style="margin-top: 10px !important;">

                <div class="col-md-4">
                    <label>Service Note:</label> <input type="text" name="service_note" id="service_note" class="form-control">
                </div>
                <div class="col-md-2">
                    <label><span style="color: red;">*</span> Mileage:</label> <input type="text" name="mileage" id="mileage" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>File:</label> <input type="file" name="file" id="file" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Updated By:</label> <input type="text" name="update_by" value="{{ Auth::user()->station_name }}" id="update_by" class="form-control" readonly="">
                </div>

            </div>
            <br>
            <button type="button" class="btn btn-primary m-t-5 addVehicle" style="width: 100%; cursor: not-allowed;" onclick="addVehicle('new', '{{ Auth::user()->plan }}')" disabled="">Kindly Check Estimate / Work Order Above To Activate Button <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>

            <button type="button" class="btn btn-primary m-t-5 addOns disp-0" style="width: 100%;" onclick="estimateSave()">Generate Estimate <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>

            <button type="button" class="btn btn-primary m-t-5 workorder disp-0" style="width: 100%;" onclick="workOrderSave()">Save to Work Order <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>

            <button type="button" class="btn btn-primary m-t-5 editable disp-0" style="width: 100%;" onclick="saveEdited()">Update <img class="spinneredit disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>

        </form>


                 <!-- use sasu part end-->
        <div class="container m-t-20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h3 class="text-center">Estimate Record</h3>
                        <div class="table table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr style="font-size: 11px;">
                                    <td>#</td>
                                    <th>Vehicle Licence</th>
                                    <th>Date</th>
                                    <th>Service Type</th>
                                    <th>Service Option</th>
                                    <th>Total Costs</th>
                                    <th>Service Note</th>
                                    <th>Mileage</th>
                                    <th>Uploaded Doc.</th>
                                    <th>Updated By</th>
                                    <th>Edit</th>
                                    <th>View More</th>
                                    <th>Close to Diagnostic</th>
                                    <th>Transfer to Work Order</th>
                                    <th>Email</th>
                                    <th>Print</th>
                                </tr>
                            </thead>




                                <tbody id="estimateRes" style="font-size: 13px;">
                                    <tr align="center">
                                        <td style="font-weight: bold; color: darkblue;" colspan="27">This section is active when an estimate is generated</td>
                                    </tr>
                                </tbody>

                                <tbody class="estimateorders" style="font-size: 13px;">

                            </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h3 class="text-center">Work Order Record</h3>
                        <div class="table table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr style="font-size: 11px;">
                                    <td>#</td>
                                    <th>Vehicle Licence</th>
                                    <th>Date</th>
                                    <th>Service Type</th>
                                    <th>Service Option</th>
                                    <th>Total Costs</th>
                                    <th>Service Note</th>
                                    <th>Mileage</th>
                                    <th>Uploaded Doc.</th>
                                    <th>Updated By</th>
                                    <th>View More</th>
                                    <th>Move to Estimate</th>
                                    <th>Move to Maintenance Record</th>
                                    <th>Email</th>
                                    <th>Print</th>
                                </tr>
                            </thead>



                                <tbody id="workorderRes" style="font-size: 13px;">
                                    <tr align="center">
                                        <td style="font-weight: bold; color: darkblue;" colspan="27">This section is active when work order is generated</td>
                                    </tr>
                                </tbody>

                                <tbody class="workorders" style="font-size: 13px;">

                            </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        @else

        <h6 class="text-center display-4">No maintenance record yet.</h6> <br>
        <span>* You can add a record by clicking on <button class="btn btn-primary" onclick="$('#register-tab').click()">REGISTER</button>.</span> <br>

    @endif


        <!-- use sasu part end-->
        <div class="container m-t-20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h3 class="text-center">Maintenance Record</h3>
                        <table class="table table-responsive table-bordered">
                            <thead>
                                <tr style="font-size: 11px;">
                                    <td>#</td>
                                    <th>Vehicle Licence</th>
                                    <th>Date</th>
                                    <th>Service Type</th>
                                    <th>Service Option</th>
                                    <th>Total Costs</th>
                                    <th>Service Note</th>
                                    <th>Mileage</th>
                                    <th>Uploaded Doc.</th>
                                    <th>&nbsp;</th>
                                    <th>Updated By</th>
                                    @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")<th>Payment</th>@endif
                                    <th>View More</th>
                                </tr>
                            </thead>
                            <tbody class="resultCar1">

                                @if(count($vehicleInfo) > 0)
                                    <?php $i = 1;?>
                                    @foreach($vehicleInfo as $vehicleInfos)

                                    <tr style="font-size: 11px;">
                                        <td>{{ $i++ }}</td>
                                    <td><span class="exs{{ $vehicleInfos->id }}">{{ $vehicleInfos->vehicle_licence }}</span>
                                        <input type="text" id="editLicence{{ $vehicleInfos->id }}" value="{{ $vehicleInfos->vehicle_licence }}" class="insert ins{{ $vehicleInfos->id }} disp-0">
                                    </td>
                                    <td><span class="exs{{ $vehicleInfos->id }}">{{ date('d/M/Y', strtotime($vehicleInfos->date)) }}</span>
                                        <input type="date" id="editDate{{ $vehicleInfos->id }}" value="{{ $vehicleInfos->date }}" class="insert ins{{ $vehicleInfos->id }} disp-0">
                                    </td>
                                    <td><span class="exs{{ $vehicleInfos->id }}">{{ $vehicleInfos->service_type }}</span>
                                        <input type="text" id="editservType{{ $vehicleInfos->id }}" value="{{ $vehicleInfos->service_type }}" class="insert ins{{ $vehicleInfos->id }} disp-0">
                                    </td>

                                    <td><span class="exs{{ $vehicleInfos->id }}">{{ $vehicleInfos->service_option }}</span>
                                        <input type="text" id="editservOption{{ $vehicleInfos->id }}" value="{{ $vehicleInfos->service_option }}" class="insert ins{{ $vehicleInfos->id }} disp-0">
                                    </td>

                                    <td><span class="exs{{ $vehicleInfos->id }}">{{ $vehicleInfos->total_cost }}</span>
                                        <input type="text" id="edittotalCost{{ $vehicleInfos->id }}" value="{{ $vehicleInfos->total_cost }}" class="insert ins{{ $vehicleInfos->id }} disp-0">
                                    </td>

                                    <td><span class="exs{{ $vehicleInfos->id }}">{{ $vehicleInfos->service_note }}</span>
                                        <input type="text" id="editserviceNote{{ $vehicleInfos->id }}" value="{{ $vehicleInfos->service_note }}" class="insert ins{{ $vehicleInfos->id }} disp-0">
                                    </td>

                                    <td><span class="exs{{ $vehicleInfos->id }}">{{ $vehicleInfos->mileage }}</span>
                                        <input type="text" id="editMileage{{ $vehicleInfos->id }}" value="{{ $vehicleInfos->mileage }}" class="insert ins{{ $vehicleInfos->id }} disp-0">
                                    </td>

                                    <td>@if($vehicleInfos->file != "" && $vehicleInfos->file != "noImage.png") <a href="/uploads/{{ $vehicleInfos->file }}" target="_blank" style="font-size: 12px; color: blue; text-decoration: underline;">Open File</a> @else @endif </td>

                                    @if(Auth::user()->name == $vehicleInfos->update_by)
                                    <td><button class="btn btn-default editMain{{ $vehicleInfos->id }}" onclick="maintenanceEdit('{{ $vehicleInfos->id }}');" style="font-size: 12px; background-color: #fff;color: blue; padding: 3px;">Edit</button>
                                        <button class="btn btn-default saveMain{{ $vehicleInfos->id }} disp-0" onclick="maintenanceSave('{{ $vehicleInfos->id }}');" style="font-size: 12px; background-color: #fff;color: blue; padding: 3px;">Save <img class="spinner{{ $vehicleInfos->id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 20px; height: 20px;"></button></td>

                                        @else

                                        <td>&nbsp;</td>
                                    @endif

                                    <td>{{ $vehicleInfos->update_by }}</td>

                                    @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")<td>@if($vehicleInfos->payment == '2') <span style="color: darkgreen; font-weight: bolder;">PAID</span> @elseif($vehicleInfos->payment == '1') <span style="color: red; font-weight: bolder;">NOT PAID</span> @else @endif</td>@endif

                                    @if($vehicleInfos->estimate_id != null) <td><span class="exs{{ $vehicleInfos->id }}"><a style="font-size: 12px; font-weight: bold; color: darkblue;" href="/invoicereport/{{ $vehicleInfos->estimate_id }}" target="_blank"><i type='button' style='padding: 10px;' title='View More' class='fas fa-eye text-danger' style='text-align: center; cursor: pointer;'></i></a></span></td> @else <td><span class="exs{{ $vehicleInfos->id }}">-</span></td>@endif

                                    </tr>

                                    @endforeach

                                @elseif(count($vehicleInfobiz) > 0)
                                    <?php $i = 1;?>
                                    @foreach($vehicleInfobiz as $vehicleInfobizs)

                                    <tr style="font-size: 11px;">
                                        <td>{{ $i++ }}</td>
                                    <td>{{ $vehicleInfobizs->vehicle_licence }}</td>
                                    <td>{{ date('d/M/Y', strtotime($vehicleInfobizs->date)) }}</td>
                                    <td>{{ $vehicleInfobizs->service_type }}</td>
                                    <td>{{ $vehicleInfobizs->service_option }}</td>
                                    <td>{{ $vehicleInfobizs->total_cost }}</td>
                                    <td>{{ $vehicleInfobizs->service_note }}</td>
                                    <td>{{ $vehicleInfobizs->mileage }}</td>
                                    <td>@if($vehicleInfobizs->file != "" && $vehicleInfobizs->file != "noImage.png") <a href="/uploads/{{ $vehicleInfobizs->file }}" target="_blank" style="font-size: 12px; color: blue; text-decoration: underline;">Open File</a> @else @endif </td>

                                    <td><button class="btn btn-default editMain{{ $vehicleInfobizs->id }}" onclick="maintenanceEdit('{{ $vehicleInfobizs->id }}');" style="font-size: 12px; background-color: #fff;color: blue; padding: 3px;">Edit</button>
                                        <button class="btn btn-default saveMain{{ $vehicleInfobizs->id }} disp-0" onclick="maintenanceSave('{{ $vehicleInfobizs->id }}');" style="font-size: 12px; background-color: #fff;color: green; padding: 3px;">Save</button></td>
                                    <td>{{ $vehicleInfobizs->update_by }}</td>
                                    @if($vehicleInfos->estimate_id != null) <td><span class="exs{{ $vehicleInfobizs->id }}"><a style="font-size: 12px; font-weight: bold; color: darkblue;" href="/invoicereport/{{ $vehicleInfobizs->estimate_id }}" target="_blank"><i type='button' style='padding: 10px;' title='View More' class='fas fa-eye text-danger' style='text-align: center; cursor: pointer;'></i></a></span></td> @else <td><span class="exs{{ $vehicleInfobizs->id }}">-</span></td>@endif
                                    </tr>

                                    @endforeach
                                @endif

                            </tbody>

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")

                                <tbody class="resultCar2 disp-0">


                                </tbody>

                            @endif

                        </table>
                    </div>
                </div>
            </div>
        </div>
          </div>
        </div>
    </div>

    {{-- End Record Maintenance --}}


    {{-- End Record Maintenance Form --}}


  </div>
  <div class="tab-pane fade" id="search" role="tabpanel" aria-labelledby="search-tab">
    {{-- Start Search Licence Form --}}

    {{-- Start Search --}}
@if (Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")
      <div class="card">


        <div id="collapsesearch" class="collapse show" aria-labelledby="headingsearch" data-parent="#accordion">
            <img align="right" class="spinnerorder disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;">
          <div class="card-body table table-responsive">


            @if (Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == 'Certified Professional')
    <div class="tab-pane fade show @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Auto Care") active @endif" id="search" role="tabpanel" aria-labelledby="search-tab">
        <div class="row m-t-20">
            <div class="col-md-6">
                <input type="text" name="vehicle_licence" id="licences" class="form-control searchLicence" placeholder="Search by Vehicle Licence">
            </div>
            <div class="col-md-4">
                <button type="button" id="licencesearch" class="btn btn-secondary" onclick="licenceSearch()">Find</button>
            </div>
        </div>
        <hr>
        {{-- Show Result --}}
            <table class="table table-striped table-bordered" cellpadding="2" style="border: 1px solid black;">
                <thead>
                    <p class="text-center">Found Results</p>
                    <p id="myCar"></p>
                    <tr style="font-size: 11px;">
                        <th>#</th>
                        <th>Vehicle licence</th>
                        <th>Date</th>
                        <th>Service Type</th>
                        <th>Service Option</th>
                        <th>Total Cost</th>
                        <th>Service Note</th>
                        <th>Mileage</th>
                        <th>Attachment</th>
                        <th>Updated By</th>
                        <th>Payment</th>
                        <th>View more</th>
                    </tr>
                </thead>
                <tbody id="list">

                </tbody>
            </table>
    </div>

    @endif


          </div>
        </div>
    </div>
@endif
    {{-- End Search --}}

    {{-- End Search Licence Form --}}


  </div>
  <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">

    {{-- Start Register Vehicle Form --}}

    {{-- Start Register Records --}}

        <div class="card">


        <div id="collapseregister" class="collapse show" aria-labelledby="headingregister" data-parent="#accordion">

          <div class="card-body">

                    <form method="POST" id="formReg">
                    @csrf
            <div class="row align-items-center justify-content-between">

                @if (Auth::user()->userType == "Individual" || Auth::user()->userType == "Commercial")
                    <div class="col-md-4 disp-0">

                    <label><span style="color: red;">*</span> Email</label> <input type="email" name="email" id="useremail" value="@if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Commercial") {{ Auth::user()->email }} @else @endif" class="form-control">
                    <input type="text" name="telephone" id="telphone" value="@if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Commercial") {{ Auth::user()->phone_number }} @else @endif" class="form-control">
                    </div>
                    @else
                    <div class="col-md-6">
                    <label><span style="color: red;">*</span> @if(Auth::user()->userType == "Auto Dealer") Vehicle Owner's Email @else Email @endif</label> <input type="email" name="email" id="useremail" value="@if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Commercial") {{ Auth::user()->email }} @else @endif" class="form-control">
                    </div>

                    {{-- Add Telephone --}}

                    <div class="col-md-6">
                    <label><span style="color: red;">*</span> @if(Auth::user()->userType == "Auto Dealer") Vehicle Owner's Telephone @else Telephone @endif</label> <input type="text" name="telephone" id="telphone" class="form-control">
                    </div>
                @endif

                <div class="col-md-3 disp-0">
                    <label>No of Vehicle</label>
                    <select name="no_of_vehicle" id="no_of_vehicle" class="form-control">
                        @for($i = 1; $i<=4; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    {{-- <input type="text" name="no_of_vehicle" id="no_of_vehicle" class="form-control"> --}}
                </div>
                <div class="col-md-6">
                    <label><span style="color: red;">*</span> Vehicle Nickname:</label> <input type="text" name="vehicle_nickname" id="vehicle_nickname" class="form-control">
                </div>
                <div class="col-md-6">
                    <label><span style="color: red;">*</span> Date Added</label><input type="text" name="date_added" id="date_added" value="{{ date('d-M-Y') }}" readonly="" class="form-control">
                </div>

            </div>

            <div class="row align-items-center justify-content-between">

                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Make</label><input type="text" name="vehicle_make" id="vehicle_make" class="form-control" required="">
                </div>
                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Model</label> <input type="text" name="model" id="model" class="form-control">
                </div>
                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Vehicle Reg No</label> <input type="text" name="vehicle_reg_no" id="vehicle_reg_no" class="form-control">
                </div>
                <div class="col-md-3">
                    <label><span style="color: red;">*</span> City</label> <input type="text" name="city" id="cityz" class="form-control">
                </div>


            </div>

            <div class="row align-items-center justify-content-between">

                <div class="col-md-3">
                    <label><span style="color: red;">*</span> Country of Registration</label>

                    <select id="country_of_reg" class="form-control @error('country_of_reg') is-invalid @enderror" name="country" value="{{ old('country_of_reg') }}" autocomplete="country_of_reg"></select>

                    {{-- <input type="text" name="country_of_reg" id="country_of_reg" class="form-control"> --}}
                </div>

                <div class="col-md-3">
                    <label><span style="color: red;">*</span> State/Province</label>
                        <select id="statez" class="form-control @error('statez') is-invalid @enderror" name="state" value="{{ old('statez') }}" required autocomplete="statez"></select>
                     {{-- <input type="text" name="state" id="statez" class="form-control"> --}}
                </div>

                <div class="col-md-2">
                    <label><span style="color: red;">*</span> Purchase Type</label> <select class="form-control" name="purchase_type" id="purchase_type">
                        <option value="">Select Option</option>
                        <option value="New from Dealer">New from Dealer</option>
                        <option value="Used from Dealer">Used from Dealer</option>
                        <option value="Private Individual">Private Individual</option>
                        <option value="Leased">Leased</option>
                        <option value="Gift">Gift</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label><span style="color: red;">*</span> Year Owned Since:</label>
                    <select class="form-control" name="year_owned_since" id="year_owned_since">
                        <?php $start = '1836'; $end = date('Y');?>
                        @for($i = $start; $i<=$end; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

            </div>

            <div class="row align-items-center justify-content-between">

                <div class="col-md-4">
                    <label><span style="color: red;">*</span> Zip Code</label> <input type="text" name="zipycode" id="zipycode" class="form-control">
                </div>

                <div class="col-md-4">
                    <input type="hidden" id="buszIDz" name="busID" @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Auto Care") value="{{ Auth::user()->busID }}" @else value="" @endif>
                    <label><span style="color: red;">*</span> Current Mileage</label> <input type="text" name="current_mileage" id="current_mileage" class="form-control">
                </div>

                <div class="col-md-4">
                    <label>Upload Vehicle Image</label> <input type="file" name="file"  id="file" class="form-control">
                </div>

                <div class="col-md-4 disp-0">
                    @if (count($carrecord) > 0)
                        <label>Choose if car is a parent of the option</label>
                        <select class="form-control" name="parentKey"  id="parentKey">
                        @foreach($carrecord as $carrecords)
                        <option value="{{ $carrecords->parentKey }}">{{ $carrecords->vehicle_nickname }}</option>
                        @endforeach
                        </select>

                        @else
                        <input type="hidden" name="parentKey" id="parentKey" value="VIM_<?php echo time();?>">
                    @endif
                </div>

            </div>
            @if(Auth::user()->userType == "Auto Dealer")
            <hr>
            <h4>User detail for vehicle management</h4><hr>
            <div class="row">
                <div class="col-md-6">
                    <h6>Vehicle Owner's Firstname</h6>
                    <input type="text" name="regFirstname" id="regFirstname" class="form-control">
                </div>
                <div class="col-md-6">
                    <h6>Vehicle Owner's Lastname</h6>
                    <input type="text" name="regLastname" id="regLastname" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h6>Password</h6>
                    <input type="password" name="regPassword" id="regPassword" class="form-control">
                </div>
                <div class="col-md-6">
                    <h6>Confirm Password</h6>
                    <input type="password" name="regCpassword" id="regCpassword" class="form-control">
                </div>
            </div>

            @endif

            <br>
            <button type="button" class="btn btn-secondary"  onclick="addVehicle('reganother', '{{ Auth::user()->plan }}')">Register another vehicle</button>
            <button type="button" class="btn btn-primary" onclick="addVehicle('regnew', '{{ Auth::user()->plan }}')">Save <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>

        </form>


          </div>
        </div>
    </div>

    {{-- End Register Records --}}

    {{-- End Register Vehicle Form --}}

  </div>
  <div class="tab-pane fade" id="ivim" role="tabpanel" aria-labelledby="ivim-tab">
      {{-- Start IVIM Record Form --}}

      {{-- Start IVIM --}}

        <div class="card">

        <div id="collapseivim" class="collapse show" aria-labelledby="headingivim" data-parent="#accordion">
          <div class="card-body">


    @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")

    <br>
    <div class="row">
        <div class="col-md-8">
            <input type="text" name="searchIvim" class="form-control" id="searchIvim" placeholder="Find by Licence Number">
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary" id="ivimSearchbtn" onclick="ivimSearch('ivim')">Find <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
            <button class="btn btn-secondary" id="ivimbackbtn" onclick="$('#opportunity-tab').click()">Goto Post</button>
        </div>
    </div>
    <br>
    <div id="ivimRec">
    <div class="itemheader">
      <table>
        <tbody>
            <tr><td></td>
            <td align="right" style="padding-right:20px;"></td>
              </tr>
      </tbody>
      </table>
      </div>


      <div class="itembody">
            <table style="width: 100%;">
                <tbody>

                    <tr style="font-size: 12px;">
                        <td colspan="15" align="center">
                            <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 40px; height: 40px;">
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @elseif(Auth::user()->userType == "Individual")


    @if (count($carrecord) > 0)

        @foreach($carrecord as $carrecords)
             <div class="itemheader">
      <table>
        <tbody>
            <tr><td>{{ $carrecords->vehicle_nickname }}</td>
            <td align="right" style="padding-right:20px;"></td>
              </tr>
      </tbody>
      </table>
      </div>

      <div class="itembody">
            <table style="width: 100%;">
                <tbody>

                    {{-- @if (count($vehicleInfo) > 0 ) --}}

                    <tr style="font-size: 12px;">
                        <td>Last Oil Change:</td>
                        <td></td>
                        @if($oilChange)
                        <td>Date: {{ date('d-M-Y', strtotime($oilChange[0]->created_at)) }} </td>
                        <td></td>
                        <td>Day Since: <?php
                        $today = date('Y-m-d H:i:s');
                        $datetime1 = strtotime($oilChange[0]->created_at);
                        $datetime2 = strtotime($today);

                        $secs = $datetime2 - $datetime1;// == <seconds between the two times>
                        $days = $secs / 86400;
                        echo round($days, 0);
                        ?> </td>
                        <td></td>
                        <td> Mileage: {{ $oilChange[0]->mileage }}</td>
                        <td></td>
                        <td> Mile Since: {{ ($oilChange[0]->mileage) - ($carrecord[0]->current_mileage) }}</td>

                        @else
                        <td> Date: NILL </td>
                        <td></td>
                        <td> Day Since: NILL </td>
                        <td></td>
                        <td> Mileage: NILL </td>
                        <td></td>
                        <td> Mile Since: NILL </td>

                        @endif
                    </tr>

                     <tr style="font-size: 12px;">
                        <td>Last Air Filter:</td>
                        <td></td>
                        @if($airFilter)
                        <td>Date: {{ date('d-M-Y', strtotime($airFilter[0]->created_at)) }} </td>
                        <td></td>
                        <td>Day Since: <?php
                        $today = date('Y-m-d H:i:s');
                        $datetime1 = strtotime($airFilter[0]->created_at);
                        $datetime2 = strtotime($today);

                        $secs = $datetime2 - $datetime1;// == <seconds between the two times>
                        $days = $secs / 86400;
                        echo round($days, 0);
                        ?> </td>
                        <td></td>
                        <td> Mileage: {{ $airFilter[0]->mileage }}</td>
                        <td></td>
                        <td> Mile Since: {{ ($airFilter[0]->mileage) - ($carrecord[0]->current_mileage) }}</td>

                        @else
                        <td> Date: NILL </td>
                        <td></td>
                        <td> Day Since: NILL </td>
                        <td></td>
                        <td> Mileage: NILL </td>
                        <td></td>
                        <td> Mile Since: NILL </td>

                        @endif
                    </tr>


                    <tr style="font-size: 12px;">
                        <td>Last Tire Rotation:</td>
                        <td></td>
                        @if($tyreRotation)
                        <td>Date: {{ date('d-M-Y', strtotime($tyreRotation[0]->created_at)) }} </td>
                        <td></td>
                        <td>Day Since: <?php
                        $today = date('Y-m-d H:i:s');
                        $datetime1 = strtotime($tyreRotation[0]->created_at);
                        $datetime2 = strtotime($today);

                        $secs = $datetime2 - $datetime1;// == <seconds between the two times>
                        $days = $secs / 86400;
                        echo round($days, 0);
                        ?> </td>
                        <td></td>
                        <td> Mileage: {{ $tyreRotation[0]->mileage }}</td>
                        <td></td>
                        <td> Mile Since: {{ ($tyreRotation[0]->mileage) - ($carrecord[0]->current_mileage) }}</td>

                        @else
                        <td> Date: NILL </td>
                        <td></td>
                        <td> Day Since: NILL </td>
                        <td></td>
                        <td> Mileage: NILL </td>
                        <td></td>
                        <td> Mile Since: NILL </td>

                        @endif
                    </tr>

                    <tr style="font-size: 12px;">
                        <td>Last Inspection:</td>
                        <td></td>
                        @if($inspection)
                        <td>Date: {{ date('d-M-Y', strtotime($inspection[0]->created_at)) }} </td>
                        <td></td>
                        <td>Day Since: <?php
                        $today = date('Y-m-d H:i:s');
                        $datetime1 = strtotime($inspection[0]->created_at);
                        $datetime2 = strtotime($today);

                        $secs = $datetime2 - $datetime1;// == <seconds between the two times>
                        $days = $secs / 86400;
                        echo round($days, 0);
                        ?> </td>
                        <td></td>
                        <td> Mileage: {{ $inspection[0]->mileage }}</td>
                        <td></td>
                        <td> Mile Since: {{ ($inspection[0]->mileage) - ($carrecord[0]->current_mileage) }}</td>

                        @else
                        <td> Date: NILL </td>
                        <td></td>
                        <td> Day Since: NILL </td>
                        <td></td>
                        <td> Mileage: NILL </td>
                        <td></td>
                        <td> Mile Since: NILL </td>

                        @endif
                    </tr>

                    <tr style="font-size: 12px;">
                        <td>Last Registration:</td>
                        <td></td>
                        @if($registration)
                        <td>Date: {{ date('d-M-Y', strtotime($registration[0]->created_at)) }} </td>
                        <td></td>
                        <td>Day Since: <?php
                        $today = date('Y-m-d H:i:s');
                        $datetime1 = strtotime($registration[0]->created_at);
                        $datetime2 = strtotime($today);

                        $secs = $datetime2 - $datetime1;// == <seconds between the two times>
                        $days = $secs / 86400;
                        echo round($days, 0);
                        ?> </td>
                        <td></td>
                        <td> Mileage: {{ $registration[0]->mileage }}</td>
                        <td></td>
                        <td> Mile Since: {{ ($registration[0]->mileage) - ($carrecord[0]->current_mileage) }}</td>

                        @else
                        <td> Date: NILL </td>
                        <td></td>
                        <td> Day Since: NILL </td>
                        <td></td>
                        <td> Mileage: NILL </td>
                        <td></td>
                        <td> Mile Since: NILL </td>

                        @endif
                    </tr>




                </tbody>
            </table>
        </div>



        @endforeach
        @else

        <h6 class="text-center">No vehicle added yet</h6>
    @endif


    @elseif(Auth::user()->userType == "Commercial")

    @if (count($carrecord) > 0)

        @foreach($carrecord as $carrecords)
             <div class="itemheader">
      <table>
        <tbody>
            <tr><td>{{ $carrecords->vehicle_nickname }}</td>
            <td align="right" style="padding-right:20px;"></td>
              </tr>
      </tbody>
      </table>
      </div>

      <div class="itembody">
            <table style="width: 100%;">
                <tbody class="response">

                    {{-- @if (count($vehicleInfo) > 0 ) --}}

                    <tr style="font-size: 12px;">
                        <td>Last Oil Change:</td>
                        <td></td>
                        @if($oilChange)
                        <td>Date: {{ date('d-M-Y', strtotime($oilChange[0]->created_at)) }} </td>
                        <td></td>
                        <td>Day Since: <?php
                        $today = date('Y-m-d H:i:s');
                        $datetime1 = strtotime($oilChange[0]->created_at);
                        $datetime2 = strtotime($today);

                        $secs = $datetime2 - $datetime1;// == <seconds between the two times>
                        $days = $secs / 86400;
                        echo round($days, 0);
                        ?> </td>
                        <td></td>
                        <td> Mileage: {{ $oilChange[0]->mileage }}</td>
                        <td></td>
                        <td> Mile Since: {{ ($oilChange[0]->mileage) - ($carrecord[0]->current_mileage) }}</td>

                        @else
                        <td> Date: NILL </td>
                        <td></td>
                        <td> Day Since: NILL </td>
                        <td></td>
                        <td> Mileage: NILL </td>
                        <td></td>
                        <td> Mile Since: NILL </td>

                        @endif
                    </tr>

                     <tr style="font-size: 12px;">
                        <td>Last Air Filter:</td>
                        <td></td>
                        @if($airFilter)
                        <td>Date: {{ date('d-M-Y', strtotime($airFilter[0]->created_at)) }} </td>
                        <td></td>
                        <td>Day Since: <?php
                        $today = date('Y-m-d H:i:s');
                        $datetime1 = strtotime($airFilter[0]->created_at);
                        $datetime2 = strtotime($today);

                        $secs = $datetime2 - $datetime1;// == <seconds between the two times>
                        $days = $secs / 86400;
                        echo round($days, 0);
                        ?> </td>
                        <td></td>
                        <td> Mileage: {{ $airFilter[0]->mileage }}</td>
                        <td></td>
                        <td> Mile Since: {{ ($airFilter[0]->mileage) - ($carrecord[0]->current_mileage) }}</td>

                        @else
                        <td> Date: NILL </td>
                        <td></td>
                        <td> Day Since: NILL </td>
                        <td></td>
                        <td> Mileage: NILL </td>
                        <td></td>
                        <td> Mile Since: NILL </td>

                        @endif
                    </tr>


                    <tr style="font-size: 12px;">
                        <td>Last Tire Rotation:</td>
                        <td></td>
                        @if($tyreRotation)
                        <td>Date: {{ date('d-M-Y', strtotime($tyreRotation[0]->created_at)) }} </td>
                        <td></td>
                        <td>Day Since: <?php
                        $today = date('Y-m-d H:i:s');
                        $datetime1 = strtotime($tyreRotation[0]->created_at);
                        $datetime2 = strtotime($today);

                        $secs = $datetime2 - $datetime1;// == <seconds between the two times>
                        $days = $secs / 86400;
                        echo round($days, 0);
                        ?> </td>
                        <td></td>
                        <td> Mileage: {{ $tyreRotation[0]->mileage }}</td>
                        <td></td>
                        <td> Mile Since: {{ ($tyreRotation[0]->mileage) - ($carrecord[0]->current_mileage) }}</td>

                        @else
                        <td> Date: NILL </td>
                        <td></td>
                        <td> Day Since: NILL </td>
                        <td></td>
                        <td> Mileage: NILL </td>
                        <td></td>
                        <td> Mile Since: NILL </td>

                        @endif
                    </tr>

                    <tr style="font-size: 12px;">
                        <td>Last Inspection:</td>
                        <td></td>
                        @if($inspection)
                        <td>Date: {{ date('d-M-Y', strtotime($inspection[0]->created_at)) }} </td>
                        <td></td>
                        <td>Day Since: <?php
                        $today = date('Y-m-d H:i:s');
                        $datetime1 = strtotime($inspection[0]->created_at);
                        $datetime2 = strtotime($today);

                        $secs = $datetime2 - $datetime1;// == <seconds between the two times>
                        $days = $secs / 86400;
                        echo round($days, 0);
                        ?> </td>
                        <td></td>
                        <td> Mileage: {{ $inspection[0]->mileage }}</td>
                        <td></td>
                        <td> Mile Since: {{ ($inspection[0]->mileage) - ($carrecord[0]->current_mileage) }}</td>

                        @else
                        <td> Date: NILL </td>
                        <td></td>
                        <td> Day Since: NILL </td>
                        <td></td>
                        <td> Mileage: NILL </td>
                        <td></td>
                        <td> Mile Since: NILL </td>

                        @endif
                    </tr>

                    <tr style="font-size: 12px;">
                        <td>Last Registration:</td>
                        <td></td>
                        @if($registration)
                        <td>Date: {{ date('d-M-Y', strtotime($registration[0]->created_at)) }} </td>
                        <td></td>
                        <td>Day Since: <?php
                        $today = date('Y-m-d H:i:s');
                        $datetime1 = strtotime($registration[0]->created_at);
                        $datetime2 = strtotime($today);

                        $secs = $datetime2 - $datetime1;// == <seconds between the two times>
                        $days = $secs / 86400;
                        echo round($days, 0);
                        ?> </td>
                        <td></td>
                        <td> Mileage: {{ $registration[0]->mileage }}</td>
                        <td></td>
                        <td> Mile Since: {{ ($registration[0]->mileage) - ($carrecord[0]->current_mileage) }}</td>

                        @else
                        <td> Date: NILL </td>
                        <td></td>
                        <td> Day Since: NILL </td>
                        <td></td>
                        <td> Mileage: NILL </td>
                        <td></td>
                        <td> Mile Since: NILL </td>

                        @endif
                    </tr>

                    @if(Auth::user()->userType == "Commercial")

                        @if($addedRec != "")

                        @foreach($addedRec as $recAdd)
                        <tr style="font-size: 12px;">
                            <td style="text-transform: capitalize;">Last {{ $recAdd->service_type }}: </td>
                            <td></td>
                            @if($new_rec != "")

                            @if($leftOver = \App\Vehicleinfo::where('service_type', $recAdd->service_type)->where('vehicle_licence', $recAdd->vehicle_licence)->latest('created_at')->limit(1)->get())
                                @if(count($leftOver) > 0)
                                    <td>Date: {{ date('d-M-Y', strtotime($leftOver[0]->created_at)) }} </td>
                                    <td></td>
                                    <td>Day Since: <?php
                                    $today = date('Y-m-d H:i:s');
                                    $datetime1 = strtotime($leftOver[0]->created_at);
                                    $datetime2 = strtotime($today);
                                    $secs = $datetime2 - $datetime1;// == <seconds between the two times>
                                    $days = $secs / 86400;

                                    echo round($days, 0);
                                    ?> </td>
                                    <td></td>
                                    <td> Mileage: {{ $leftOver[0]->mileage }}</td>
                                    <td></td>
                                    <td> Mile Since: {{ ($leftOver[0]->mileage) - ($carrecord[0]->current_mileage) }}</td>
                                @endif
                            @endif

                            @endif


                        </tr>

                        @endforeach

                        @endif

                    @endif






                </tbody>
                <tbody>
                    <tr style="font-size: 12px;">
                        <td align="center" colspan="12"><button class="btn btn-secondary btn-block" onclick="moreIvim('{{ Auth::user()->id }}');"><i class="fa fa-plus-circle"></i> Add More Fields</button></td>
                    </tr>
                </tbody>
            </table>

            <button id="moreFields" class="disp-0">Click</button>

        </div>



        @endforeach
        @else

        <h6 class="text-center">No vehicle added yet</h6>
    @endif

    @endif


          </div>
        </div>
    </div>

    {{-- End IVIM --}}

      {{-- End IVIM Record Form --}}
  </div>

  <div class="tab-pane fade" id="performance" role="tabpanel" aria-labelledby="performance-tab">

    {{-- Start Performance Record Form --}}

    {{-- Start Performance --}}

        <div class="card">

        <div id="collapseperformance" class="collapse show" aria-labelledby="headingperformance" data-parent="#accordion">

          <div class="card-body">

                @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == 'Certified Professional')

    <br>
    <div class="row">
        <div class="col-md-8">
            <input type="text" name="searchReport" class="form-control" id="searchReport" placeholder="Find by Licence Number">
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary" id="reportSearchbtn" onclick="ivimSearch('report')">Find <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
        </div>
    </div>
    <br>
    <div id="reportRec">
    <div class="itemheader">
      <table>
        <tbody>
            <tr><td></td>
            <td align="right" style="padding-right:20px;"></td>
              </tr>
      </tbody>
      </table>
      </div>


      <div class="itembody">
            <table style="width: 100%;">
                <tbody>

                    <tr style="font-size: 12px;">
                        <td colspan="15" align="center">
                            <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 40px; height: 40px;">
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    @elseif (count($carrecord) > 0)
    {{-- @foreach($carrecord as $carrecords) --}}

    <div class="itemheader">
      <table>
        <tbody>
            <tr><td>{{ $carrecords->vehicle_nickname }}</td>
            <td align="right" style="padding-right:20px;"></td>
              </tr>
      </tbody>
      </table>
      </div>

        <div class="itembody">
            <table id="mytable">
                <tbody>

                    @if (count($vehicleInfo) > 0)

                    <tr style="font-size: 12px;">
                        <td align="left" width="25%" style="font-weight: bold; text-transform: capitalize;">Total miles/Km driven:</td>
                        <td align="right">@if(null != $totMiles){{ $totMiles }}@else 0 @endif</td>
                    </tr>

                    <tr style="font-size: 12px;">
                        <td align="left" width="25%" style="font-weight: bold; text-transform: capitalize;">Avg. miles driven per month:</td>
                        <td align="right"><?php
                        $first = date('Y-m-d', strtotime($carrecord[0]->created_at));

                        $end = date('Y-m-d', strtotime($vehicleInfo[0]->created_at));
                        $d1 = new DateTime($first);
                        $d2 = new DateTime($end);
                        $mDiff = $d1->diff($d2)->m;

                        if($mDiff < 1){
                        $avg = 0;

                        $res =$avg;

                        echo $res;
                        }
                        elseif($mDiff > 1){

                            $avg = $totMiles / $mDiff;

                            $res =round($avg, 0);

                            echo number_format($res);
                        }



                        ?></td>
                    </tr>

                    <tr style="font-size: 12px;">
                        <td align="left" width="25%" style="font-weight: bold; text-transform: capitalize;">Total maintenance cost:</td>
                        <td align="right">{{ number_format($totMaint) }}</td>
                    </tr>

                    <tr style="font-size: 12px;">
                        <td align="left" width="25%" style="font-weight: bold; text-transform: capitalize;">Avg. maintenance cost per month:</td>

                        <td align="right"><?php
                        $first = date('Y-m-d', strtotime($carrecord[0]->created_at));

                        $end = date('Y-m-d', strtotime($vehicleInfo[0]->created_at));
                        $d1 = new DateTime($first);
                        $d2 = new DateTime($end);
                        $mDiff = $d1->diff($d2)->m;

                        if($mDiff < 1){
                            $avg = 0;

                        $results =$avg;

                        echo $results;
                        }
                        elseif($mDiff > 1){

                            $avg = $totMaint / $mDiff;

                            $results =round($avg, 0);

                            echo number_format($results);
                        }



                        ?></td>

                    </tr>


                    @if(Auth::user()->userType == "Commercial")

                    <tr style="font-size: 12px;">
                        <td align="left" width="25%" style="font-weight: bold; text-transform: capitalize;">Total Earnings:</td>
                        <td align="right">@if($totalKM) {{ number_format($totalKM) }} @else 0 @endif</td>
                    </tr>

                    <tr style="font-size: 12px;">
                        <td align="left" width="25%" style="font-weight: bold; text-transform: capitalize;">Avg. Earnings Per Month:</td>
                        @if($earnStart != "" || $earnEnd != "")
                            <td align="right"><?php
                            $today = date('Y-m-d H:i:s');
                        $first = date('Y-m-d', strtotime(Auth::user()->created_at));

                        $end = date('Y-m-d', strtotime($today));
                        $d1 = new DateTime($first);
                        $d2 = new DateTime($end);
                        $mDiff = $d1->diff($d2)->m;

                        if($mDiff < 1){
                        $avg = 0;

                        $res =$avg;

                        echo $res;
                        }
                        elseif($mDiff > 1){

                            $avg = $totalKM / $mDiff;

                            $res =round($avg, 0);

                            echo number_format($res);
                        }



                        ?></td>
                        @else
                            <td align="right">0</td>
                        @endif


                    </tr>

                    <tr style="font-size: 12px;">
                        <td align="left" width="25%" style="font-weight: bold; text-transform: capitalize;">Earnings per Miles/KM</td>
                        <td align="right">@if($totMiles != 0) {{ number_format($totalKM/$totMiles) }} @else 0 @endif</td>
                    </tr>


                    <tr class="text-danger" align="center"><td colspan="10" style="font-size: 15px; font-weight: bold; text-decoration: underline">Financial @ a Glance ( {{ date('d-M-Y') }} )<td></tr>

                    <tr style="font-size: 12px;">
                        <td align="center">&nbsp;</td>
                        <td align="right">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; ">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; ">&nbsp;</td>
                        <td align="center" width="25%" style="text-transform: capitalize; ">&nbsp;</td>
                        <td align="center" width="35%" style="text-transform: capitalize; ">&nbsp;</td>
                    </tr>

                    <tr class="text-primary" align="center">
                        <td style="border-right: 1px solid black;">&nbsp;</td>
                        <td style="border-right: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black; font-size: 12px; font-weight: bold;"><span class="mt-5">Get Reports By Date</span></td>
                        <td style="font-size: 12px;">
                            <label style="font-size: 12px; font-weight: bold;">Date From</label>
                            <input style="font-size: 12px; font-weight: bold;" type="date" name="date_from" id="date_from" class="form-control">
                        </td>
                        <td style="font-size: 12px;">
                            <label style="font-size: 12px; font-weight: bold;">Date To</label>
                            <input style="font-size: 12px; font-weight: bold;" type="date" name="date_to" id="date_to" class="form-control">
                        </td>
                        <td style="font-size: 12px;">
                            <button class="btn btn-primary mt-3" onclick="reporttoDate('{{ Auth::user()->email }}')" style="font-size: 12px; font-weight: bold;">Get Report <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                        </td>
                        <td>&nbsp;</td>
                    </tr>

                    <tr style="font-size: 12px;">
                        <td align="center">&nbsp;</td>
                        <td align="right">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; ">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; ">&nbsp;</td>
                        <td align="center" width="25%" style="text-transform: capitalize; ">&nbsp;</td>
                        <td align="center" width="35%" style="text-transform: capitalize; ">&nbsp;</td>
                    </tr>


                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="25%" style="font-weight: bold; text-transform: capitalize; border-right: 1px solid black">Gross</td>
                        <td align="center" width="25%" style="font-weight: bold; text-transform: capitalize; border-right: 1px solid black">Tax</td>
                    </tr>


                    <tr style="font-size: 12px; border: 1px solid black;" id="comEarns">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Commercial Earnings</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        {{-- <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($getEarns != "") {{ number_format($getEarns[0]->post_earnings) }} @else 0 @endif</td> --}}
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($totalKM) {{ number_format($totalKM) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($taxTot) {{ number_format($taxTot) }} @else 0 @endif</td>
                    </tr>

                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Total KM</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if(null != $totMiles){{ number_format($totMiles) }}@else 0 @endif</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                    </tr>

                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Business KM</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($getEarns != "") {{ number_format($getEarns[0]->post_mileage) }} @else 0 @endif</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                    </tr>

                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Expenses</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="font-weight: bold; text-transform: capitalize; border-right: 1px solid black">Tax Status</td>
                        <td align="center" width="10%" style="font-weight: bold; text-transform: capitalize; border-right: 1px solid black">Total Expenses</td>
                        <td align="center" width="25%" style="font-weight: bold; text-transform: capitalize; border-right: 1px solid black">Prorated Business Exp</td>
                        <td align="center" width="35%" style="font-weight: bold; text-transform: capitalize; border-right: 1px solid black">Total ITC/Adjustments</td>
                    </tr>

                    </tbody>

                <tbody class="tableReport1">

                    @if($totInsp != 0 || $totRegs != 0 || $totReg != 0 || $totAsst != 0 || $totInsurance != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold; font-size: 14px; color: red;">ADMIN</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="25%" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="35%" style="border-right: 1px solid black">&nbsp;</td>
                    </tr>
                    @endif



                    @if($totInsp != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Inspection</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totInsp) {{ number_format($totInsp) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proInsp) {{ number_format($proInsp) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($inspITC) {{ number_format($inspITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totRegs != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Registration</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">Exempted</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totRegs) {{ number_format($totRegs) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proRegs) {{ number_format($proRegs) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($regsITC) {{ number_format($regsITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totReg != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Business taxes</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">Exempted</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totReg) {{ number_format($totReg) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proReg) {{ number_format($proReg) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($regITC) {{ number_format($regITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totAsst != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Road Side Assistance</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totAsst) {{ number_format($totAsst) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proRsa) {{ number_format($proRsa) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($rsaITC) {{ number_format($rsaITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totInsurance != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Insurance</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">Exempted</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totInsurance) {{ number_format($totInsurance) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proIns) {{ number_format($proIns) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($insITC) {{ number_format($insITC) }} @else 0 @endif</td>
                    </tr>

                    @endif

                    @if($totWash != 0 || $totfuel != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold; font-size: 14px; color: red;">FUEL</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="25%" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="35%" style="border-right: 1px solid black">&nbsp;</td>
                    </tr>
                    @endif

                    @if($totWash != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Car Wash</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totWash) {{ number_format($totWash) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proWash) {{ number_format($proWash) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($washITC) {{ number_format($washITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totfuel != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Fuel</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totfuel) {{ number_format($totfuel) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proFuel) {{ number_format($proFuel) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($fuelITC) {{ number_format($fuelITC) }} @else 0 @endif</td>
                    </tr>
                    @endif


                    @if($totRepair != 0 || $totairFilter != 0 || $totBattery != 0 || $totbrakeFluids != 0 || $totbrakePads != 0 || $totbrakeRotors != 0 || $totcoolantwash != 0 || $totdispCap != 0 || $totfuelFilter != 0 || $totheadlight != 0 || $totoilchange != 0 || $totpowersteer != 0 || $totsparkplug != 0 || $tottimingbelt != 0 || $tottirenew != 0 || $tottirebalancing != 0 || $tottireinflation != 0 || $tottirerotation != 0 || $totwheelrotation != 0 || $tottransfluidflush != 0 || $totwheelalignment != 0 || $totwiperblade != 0 || $totcabinair != 0 || $totsmogcheck != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold; font-size: 14px; color: red;">MAINTENANCE</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="25%" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="35%" style="border-right: 1px solid black">&nbsp;</td>
                    </tr>
                    @endif


                    @if($totRepair != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Air Conditioning Recharge</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totRepair) {{ number_format($totRepair) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proRepair) {{ number_format($proRepair) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($repITC) {{ number_format($repITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totairFilter != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Air Filter</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totairFilter) {{ number_format($totairFilter) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proairFilter) {{ number_format($proairFilter) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($airfilterITC) {{ number_format($airfilterITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totBattery != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Battery</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totBattery) {{ number_format($totBattery) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proBattery) {{ number_format($proBattery) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($batteryITC) {{ number_format($batteryITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totbrakeFluids != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Brake Fluid Flush</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totbrakeFluids) {{ number_format($totbrakeFluids) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proBrakefluid) {{ number_format($proBrakefluid) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($brakefluidsITC) {{ number_format($brakefluidsITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totbrakePads != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Brake Pads</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totbrakePads) {{ number_format($totbrakePads) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proBrakepad) {{ number_format($proBrakepad) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($brakefluidsITC) {{ number_format($brakefluidsITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totbrakeRotors != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Brake Rotors</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totbrakeRotors) {{ number_format($totbrakeRotors) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proBrakerotor) {{ number_format($proBrakerotor) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($brakerotorsITC) {{ number_format($brakerotorsITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totcoolantwash != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Coolant Wash</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totcoolantwash) {{ number_format($totcoolantwash) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proCoolantwash) {{ number_format($proCoolantwash) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($coolantwashITC) {{ number_format($coolantwashITC) }} @else 0 @endif</td>
                    </tr>
                    @endif


                    @if($totdispCap != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Distributor Cap & Rotor</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totdispCap) {{ number_format($totdispCap) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($prodispcap) {{ number_format($prodispcap) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($distcapITC) {{ number_format($distcapITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totfuelFilter != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Fuel Filter</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totfuelFilter) {{ number_format($totfuelFilter) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($profuelfilter) {{ number_format($profuelfilter) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($fuelfilterITC) {{ number_format($fuelfilterITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totheadlight != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Headlight</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totheadlight) {{ number_format($totheadlight) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proheadlight) {{ number_format($proheadlight) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($headlightITC) {{ number_format($headlightITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totoilchange != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Oil Change</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totoilchange) {{ number_format($totoilchange) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($prooilchange) {{ number_format($prooilchange) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($oilchangeITC) {{ number_format($oilchangeITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totpowersteer != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Power Steering Flush</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totpowersteer) {{ number_format($totpowersteer) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($propowersteer) {{ number_format($propowersteer) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($powersteerITC) {{ number_format($powersteerITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totsparkplug != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Spark Plugs</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totsparkplug) {{ number_format($totsparkplug) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($prosparkplug) {{ number_format($prosparkplug) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($sparkplugITC) {{ number_format($sparkplugITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($tottimingbelt != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Timing Belt</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($tottimingbelt) {{ number_format($tottimingbelt) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($protimingbelt) {{ number_format($protimingbelt) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($timingbeltITC) {{ number_format($timingbeltITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($tottirenew != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Tire - New</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($tottirenew) {{ number_format($tottirenew) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($protirenew) {{ number_format($protirenew) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($tirenewITC) {{ number_format($tirenewITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($tottirebalancing != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Tire Balancing</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($tottirebalancing) {{ number_format($tottirebalancing) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($protirebalancing) {{ number_format($protirebalancing) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($tirebalancingITC) {{ number_format($tirebalancingITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($tottireinflation != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Tire Inflation</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($tottireinflation) {{ number_format($tottireinflation) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($protireinflation) {{ number_format($protireinflation) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($tireinflationITC) {{ number_format($tireinflationITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($tottirerotation != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Tire Rotation</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($tottirerotation) {{ number_format($tottirerotation) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($protirerotation) {{ number_format($protirerotation) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($tirerotationITC) {{ number_format($tirerotationITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totwheelrotation != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Wheel Rotation & Tire Balancing</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totwheelrotation) {{ number_format($totwheelrotation) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($prowheelrotation) {{ number_format($prowheelrotation) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($wheelrotationITC) {{ number_format($wheelrotationITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($tottransfluidflush != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Transmission Fluid Flush</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($tottransfluidflush) {{ number_format($tottransfluidflush) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($protransfluidflush) {{ number_format($protransfluidflush) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($transfluidflushITC) {{ number_format($transfluidflushITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totwheelalignment != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Wheel Alignment</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totwheelalignment) {{ number_format($totwheelalignment) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($prowheelalignment) {{ number_format($prowheelalignment) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($wheelalignmentITC) {{ number_format($wheelalignmentITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totwiperblade != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Wiper Blades</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totwiperblade) {{ number_format($totwiperblade) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($prowiperblade) {{ number_format($prowiperblade) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($wiperbladeITC) {{ number_format($wiperbladeITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totcabinair != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Cabin Air Filter</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totcabinair) {{ number_format($totcabinair) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($procabinair) {{ number_format($procabinair) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($cabinairITC) {{ number_format($cabinairITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totsmogcheck != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Smog Check</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totsmogcheck) {{ number_format($totsmogcheck) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($prosmogcheck) {{ number_format($prosmogcheck) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($smogcheckITC) {{ number_format($smogcheckITC) }} @else 0 @endif</td>
                    </tr>
                    @endif


                    @if($totalternator != 0 || $totbelt != 0 || $totbodywork != 0 || $totbrakecaliper != 0 || $totcarburetor != 0 || $totcatalytic != 0 || $totclutch != 0  || $totcontrolarm != 0  || $totcoolanttemp != 0  || $totexhaust != 0  || $totfuelinjection != 0  || $totfueltank != 0  || $totheadgasket != 0  || $totheatercore != 0  || $tothose != 0  || $totline != 0  || $totmassair != 0  || $totmuffler != 0  || $totoxygensensor != 0  || $totradiator != 0  || $totshock != 0  || $totstarter != 0  || $totthermostat != 0  || $tottierod != 0  || $tottransmission != 0  || $totwaterpump != 0  || $totwheelbearing != 0  || $totwindow != 0  || $totwindshield != 0  || $totsensor != 0 || $totother != 0 )
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold; font-size: 14px; color: red;">REPAIRS</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="25%" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="35%" style="border-right: 1px solid black">&nbsp;</td>
                    </tr>
                    @endif

                    @if($totalternator != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Alternator</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totalternator) {{ number_format($totalternator) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proalternator) {{ number_format($proalternator) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($alternatorITC) {{ number_format($alternatorITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totbelt != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Belt</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totbelt) {{ number_format($totbelt) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($probelt) {{ number_format($probelt) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($beltITC) {{ number_format($beltITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totbodywork != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Body Work</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totbodywork) {{ number_format($totbodywork) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($probodywork) {{ number_format($probodywork) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($bodyworkITC) {{ number_format($bodyworkITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totbrakecaliper != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Brake Caliper</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totbrakecaliper) {{ number_format($totbrakecaliper) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($probrakecaliper) {{ number_format($probrakecaliper) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($brakecaliperITC) {{ number_format($brakecaliperITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totcarburetor != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Carburetor</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totcarburetor) {{ number_format($totcarburetor) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($procarburetor) {{ number_format($procarburetor) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($carburetorITC) {{ number_format($carburetorITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totcatalytic != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Catalytic Converter</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totcatalytic) {{ number_format($totcatalytic) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($procatalytic) {{ number_format($procatalytic) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($catalyticITC) {{ number_format($catalyticITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totclutch != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Clutch</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totclutch) {{ number_format($totclutch) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proclutch) {{ number_format($proclutch) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($clutchITC) {{ number_format($clutchITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totcontrolarm != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Control Arm</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totcontrolarm) {{ number_format($totcontrolarm) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($procontrolarm) {{ number_format($procontrolarm) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($controlarmITC) {{ number_format($controlarmITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totcoolanttemp != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Coolant Temperature Sensor</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totcoolanttemp) {{ number_format($totcoolanttemp) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($procoolanttemp) {{ number_format($procoolanttemp) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($coolanttempITC) {{ number_format($coolanttempITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totexhaust != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Exhaust</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totexhaust) {{ number_format($totexhaust) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proexhaust) {{ number_format($proexhaust) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($exhaustITC) {{ number_format($exhaustITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totfuelinjection != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Fuel Injector</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totfuelinjection) {{ number_format($totfuelinjection) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($profuelinjection) {{ number_format($profuelinjection) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($fuelinjectionITC) {{ number_format($fuelinjectionITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totfueltank != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Fuel Tank</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totfueltank) {{ number_format($totfueltank) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($profueltank) {{ number_format($profueltank) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($fueltankITC) {{ number_format($fueltankITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totheadgasket != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Head Gasket</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totheadgasket) {{ number_format($totheadgasket) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proheadgasket) {{ number_format($proheadgasket) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($headgasketITC) {{ number_format($headgasketITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totheatercore != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Heater Core</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totheatercore) {{ number_format($totheatercore) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proheatercore) {{ number_format($proheatercore) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($heatercoreITC) {{ number_format($heatercoreITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($tothose != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Hose</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($tothose) {{ number_format($tothose) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($prohose) {{ number_format($prohose) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($hoseITC) {{ number_format($hoseITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totline != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Line</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totline) {{ number_format($totline) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proline) {{ number_format($proline) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($lineITC) {{ number_format($lineITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totmassair != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Mass Air Flow Sensor</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totmassair) {{ number_format($totmassair) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($promassair) {{ number_format($promassair) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($massairITC) {{ number_format($massairITC) }} @else 0 @endif</td>
                    </tr>
                    @endif


                    @if($totmuffler != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Muffler</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totmuffler) {{ number_format($totmuffler) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($promuffler) {{ number_format($promuffler) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($mufflerITC) {{ number_format($mufflerITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totoxygensensor != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Oxygen Sensor</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totoxygensensor) {{ number_format($totoxygensensor) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($prooxygensensor) {{ number_format($prooxygensensor) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($oxygensensorITC) {{ number_format($oxygensensorITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totradiator != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Radiator</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totradiator) {{ number_format($totradiator) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proradiator) {{ number_format($proradiator) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($radiatorITC) {{ number_format($radiatorITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totshock != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Shock/Strut</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totshock) {{ number_format($totshock) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proshock) {{ number_format($proshock) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($shockITC) {{ number_format($shockITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totstarter != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Starter</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totstarter) {{ number_format($totstarter) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($prostarter) {{ number_format($prostarter) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($starterITC) {{ number_format($starterITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totthermostat != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Thermostat</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totthermostat) {{ number_format($totthermostat) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($prothermostat) {{ number_format($prothermostat) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($thermostatITC) {{ number_format($thermostatITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($tottierod != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Tie Rod</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($tottierod) {{ number_format($tottierod) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($protierod) {{ number_format($protierod) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($tierodITC) {{ number_format($tierodITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($tottransmission != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Transmission</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($tottransmission) {{ number_format($tottransmission) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($protransmission) {{ number_format($protransmission) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($transmissionITC) {{ number_format($transmissionITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totwaterpump != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Water Pump</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totwaterpump) {{ number_format($totwaterpump) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($prowaterpump) {{ number_format($prowaterpump) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($waterpumpITC) {{ number_format($waterpumpITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totwheelbearing != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Wheel Bearings</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totwheelbearing) {{ number_format($totwheelbearing) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($prowheelbearing) {{ number_format($prowheelbearing) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($wheelbearingITC) {{ number_format($wheelbearingITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totwindow != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Window</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totwindow) {{ number_format($totwindow) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($prowindow) {{ number_format($prowindow) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($windowITC) {{ number_format($windowITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totwindshield != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Windshield</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totwindshield) {{ number_format($totwindshield) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($prowindshield) {{ number_format($prowindshield) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($windshieldITC) {{ number_format($windshieldITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totsensor != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Sensor</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totsensor) {{ number_format($totsensor) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($prosensor) {{ number_format($prosensor) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($sensorITC) {{ number_format($sensorITC) }} @else 0 @endif</td>
                    </tr>
                    @endif

                    @if($totother != 0)
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Others</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">HST</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">@if($totother) {{ number_format($totother) }} @else 0 @endif</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($proother) {{ number_format($proother) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($otherITC) {{ number_format($otherITC) }} @else 0 @endif</td>
                    </tr>
                    @endif



                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Total Expenses</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($totPro) {{ number_format($totPro) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($totITC) {{ number_format($totITC) }} @else 0 @endif</td>
                    </tr>
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center">&nbsp;</td>
                        <td align="right">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; ">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; ">&nbsp;</td>
                        <td align="center" width="25%" style="text-transform: capitalize; ">&nbsp;</td>
                        <td align="center" width="35%" style="text-transform: capitalize; ">&nbsp;</td>
                    </tr>
                    <tr style="font-size: 12px; border: 1px solid black;">
                        <td align="center" style="border-right: 1px solid black; font-weight: bold;">Business Profit/HST</td>
                        <td align="right" style="border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="10%" style="text-transform: capitalize; border-right: 1px solid black">&nbsp;</td>
                        <td align="center" width="25%" style="text-transform: capitalize; border-right: 1px solid black">@if($bizProfit) {{ number_format($bizProfit) }} @else 0 @endif</td>
                        <td align="center" width="35%" style="text-transform: capitalize; border-right: 1px solid black">@if($taxProfit) {{ number_format($taxProfit) }} @else 0 @endif</td>
                    </tr>

                    @endif

                    @endif

                </tbody>


                <tbody class="tableReport2">

                </tbody>
            </table>
        </div>
        {{-- @endforeach --}}

        @else

        <h6 class="text-center">No vehicle added yet</h6>
    @endif


          </div>
        </div>
    </div>

    {{-- End Performance --}}


    {{-- End Performance Record Form --}}

  </div>

{{-- Start Client / Vehicle List --}}

@if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Business")


{{-- Start Monitor Vehicle --}}
<div class="tab-pane fade" id="clientcheck" role="tabpanel" aria-labelledby="clientcheck-tab">

<div class="card">

    <div id="collapseclientcheck" class="collapse show" aria-labelledby="headingclientcheck" data-parent="#accordion">

        <div class="card-body table table-responsive">
            <img align="right" class="spinnerclientcheck disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;">
            <table class="table table-striped table-bordered" id="clientcheckRecs">
                <thead>
                    <tr style="font-size: 13px;">
                        <th>#</th>
                        <th style="text-align: center;">Vehicle Nick</th>
                        <th style="text-align: center;">Licence</th>
                        <th style="text-align: center;"><img src="https://triplogmileage.com/wp-content/uploads/2018/01/Sm_blue_logo-01.png"></th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($client) > 0)

                    <?php $i = 1;?>
                    @foreach($client as $clients)

                    <tr style="font-size: 13px;">
                        <td>{{ $i++ }}</td>
                        <td align="center">{{ $clients->vehicle_nickname }}</td>
                        <td align="center">{{ $clients->vehicle_reg_no }}</td>
                        <td align="center">
                            <i style="padding: 7px; color: darkorange;" title="Create User" class="fas fa-plus" type="button" onclick="triplogAction('create_user', '{{ $clients->vehicle_reg_no }}')"></i>
                            <i style="padding: 7px; color: brown;" title="State Mileage" class="fas fa-clipboard-list" type="button" onclick="triplogAction('state_mileage', '{{ $clients->vehicle_reg_no }}')"></i>
                            <i style="padding: 7px; color: green;" title="Locations" class="far fa-compass" type="button" onclick="triplogAction('locations', '{{ $clients->vehicle_reg_no }}')"></i>
                            <i style="padding: 7px; color: navy;" title="User Current Location" class="fas fa-street-view" type="button" onclick="triplogAction('user_current_location', '{{ $clients->vehicle_reg_no }}')"></i>
                            <i style="padding: 7px; color: tomato;" title="Delete Record" class="far fa-trash-alt" type="button" onclick="triplogAction('deleterec', '{{ $clients->vehicle_reg_no }}')"></i>
                        </td>
                    </tr>

                    @endforeach

                    @endif

                </tbody>
            </table>
        </div>

    </div>

</div>


</div>


{{-- End Monitor Vehicle --}}





@endif



@if(Auth::user()->userType == "Auto Dealer")


{{-- Start Monitor Vehicle --}}
<div class="tab-pane fade" id="monitor" role="tabpanel" aria-labelledby="monitor-tab">

<div class="card">

    <div id="collapsemonitor" class="collapse show" aria-labelledby="headingmonitor" data-parent="#accordion">

        <div class="card-body table table-responsive">
            <img align="right" class="spinnermonitor disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;">
            <table class="table table-striped table-bordered" id="monitorRecs">
                <thead>
                    <tr style="font-size: 13px;">
                        <th>#</th>
                        <th style="text-align: center;">Vehicle Nickname</th>
                        <th style="text-align: center;">Licence</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @if($dealervehicle != "")

                    <?php $i = 1;?>
                    @foreach($dealervehicle as $dealer)

                    <tr style="font-size: 13px;">
                        <td>{{ $i++ }}</td>
                        <td align="center">{{ $dealer->vehicle_nickname }}</td>
                        <td align="center">{{ $dealer->vehicle_reg_no }}</td>
                        <td align="center">
                            <i style="padding: 7px; color: darkorange;" title="View Estimate Record" class="far fa-eye" type="button" onclick="Monitor('{{ Auth::user()->busID }}', 'estimate', '{{ $dealer->vehicle_reg_no }}')"></i>
                            <i style="padding: 7px; color: brown;" title="View Work Order Record" class="fas fa-briefcase" type="button" onclick="Monitor('{{ Auth::user()->busID }}', 'workorder', '{{ $dealer->vehicle_reg_no }}')"></i>
                            <i style="padding: 7px; color: green;" title="View Maintenance Record" class="fas fa-tools" type="button" onclick="Monitor('{{ Auth::user()->busID }}', 'maintenance', '{{ $dealer->vehicle_reg_no }}')"></i>
                            <i style="padding: 7px; color: navy;" title="View Owner Record" class="fas fa-street-view" type="button" onclick="Monitor('{{ Auth::user()->busID }}', 'ownerrec', '{{ $dealer->vehicle_reg_no }}')"></i>
                            <i style="padding: 7px; color: tomato;" title="Delete Vehicle Record" class="far fa-trash-alt" type="button" onclick="Monitor('{{ Auth::user()->busID }}', 'deleterec', '{{ $dealer->vehicle_reg_no }}')"></i>
                        </td>
                    </tr>

                    @endforeach

                    @endif

                </tbody>
            </table>
        </div>

    </div>

</div>


</div>


{{-- End Monitor Vehicle --}}





@endif

</div>


{{-- End Menu for Vehicle maint --}}


</div>


{{-- End New Vehicle Maintenace --}}

@endif


{{-- PO136 --}}


{{-- Start Manage Inventory --}}
@if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")

<br>
<div class="tab-pane fade" id="manageinventory" role="tabpanel" aria-labelledby="manageinventory-tab">

{{-- Start Menu For Manage Inventory --}}

<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item">
    <a class="nav-link active" id="createvendor-tab" data-toggle="tab" href="#createvendor" role="tab" aria-controls="createvendor" aria-selected="false">Create Vendor</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="createcategory-tab" data-toggle="tab" href="#createcategory" role="tab" aria-controls="createcategory" aria-selected="false">Create Category</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="createinventoryitem-tab" data-toggle="tab" href="#createinventoryitem" role="tab" aria-controls="createinventoryitem" aria-selected="false">Create Inventory Item</a>
  </li>
<li class="nav-item">
    <a class="nav-link" id="createpurchase-tab" data-toggle="tab" href="#createpurchase" role="tab" aria-controls="createpurchase" aria-selected="false">Create Purchase Order</a>
</li>



  <li class="nav-item">
    <a class="nav-link" id="managepurchase-tab" data-toggle="tab" href="#managepurchase" role="tab" aria-controls="managepurchase" aria-selected="true">Manage Purchase Order</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="payvendor-tab" data-toggle="tab" href="#payvendor" role="tab" aria-controls="payvendor" aria-selected="false">Pay Vendors</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" id="inventory-tab" data-toggle="tab" href="#inventory" role="tab" aria-controls="inventory" aria-selected="false">Inventory Record</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" id="updatevendorprofile-tab" data-toggle="tab" href="#updatevendorprofile" role="tab" aria-controls="updatevendorprofile" aria-selected="false">Update Vendor's Profile</a>
  </li>

</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade" id="managepurchase" role="tabpanel" aria-labelledby="managepurchase-tab">
      {{-- Start Manage Purchase Order --}}

      {{-- Start Manage Purchase Order Schedule --}}
      <div class="card">

        <div id="collapseschedule" class="collapse show" aria-labelledby="headingschedule" data-parent="#accordion">
            <img align="right" class="spinnerorder disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;">
          <div class="card-body table table-responsive">

               <table class="table table-striped table-bordered">
                   <thead>
                       <tr style="font-size: 11px;">
                           <th>#</th>
                           <th>Purchase Order Code</th>
                           <th>Order Date</th>
                           <th>Expected Delivery Date</th>
                           <th>Vendor Name</th>
                           <th>Issued by</th>
                           <th>Vendor Sales Rep</th>
                           <th>Quantity</th>
                           <th>Rate</th>
                           <th>Total</th>
                           <th>Shipping Cost</th>
                           <th>Discount</th>
                           <th>Other Cost</th>
                           <th>Tax</th>
                           <th>Total Cost</th>
                           <th>Ship Via</th>
                           <th>Receive Order</th>
                           <th>Move to Inventory</th>
                       </tr>
                   </thead>
                   <tbody>


                    @if($purchaseOrder != "")
                        <?php $i=1;?>
                        @foreach($purchaseOrder as $purchaseOrders)

                        @if($purchaseOrders->move_to_inventory != 1)

                            <tr style="font-size: 11px;">
                               <td>{{ $i++ }}</td>
                               <td>{{ $purchaseOrders->purchase_order_no }}</td>
                               <td>{{ $purchaseOrders->order_date }}</td>
                               <td>{{ $purchaseOrders->expected_date }}</td>
                               <td>{{ $purchaseOrders->vendor_name }}</td>
                               <td>{{ $purchaseOrders->purchase_order_orderby }}</td>
                               <td>{{ $purchaseOrders->vendor_salesrep }}</td>
                               <td>{{ $purchaseOrders->purchase_order_qty }}</td>
                               <td>{{ $purchaseOrders->purchase_order_rate }}</td>
                               <td>{{ $purchaseOrders->purchase_order_totcost }}</td>
                               <td>{{ $purchaseOrders->purchase_order_shippingcost }}</td>
                               <td>{{ $purchaseOrders->purchase_order_discount }}</td>
                               <td>{{ $purchaseOrders->purchase_order_othercost }}</td>
                               <td>{{ $purchaseOrders->purchase_order_tax }}</td>
                               <td>{{ $purchaseOrders->purchase_order_totalpurchaseorder }}</td>
                               <td>{{ $purchaseOrders->purchase_order_shipto }}</td>

                               <td>@if($purchaseOrders->receive_order == 1 && $purchaseOrders->move_to_inventory == 0) <button type='button' style='border: 1px solid darkblue; border-radius: 10px; padding: 7px; cursor: not-allowed;' title='Receive Order' onclick="orderActions('{{ $purchaseOrders->post_id }}', 'receiveorder')" disabled><span style="color: red; font-size: 12px; font-weight: bold;">deactivate</span></button> @else <button type='button' style='border: 1px solid darkblue; border-radius: 10px; padding: 7px;' title='Receive Order' onclick="orderActions('{{ $purchaseOrders->post_id }}', 'receiveorder')"><span style="color: darkblue; font-size: 12px; font-weight: bold;">activate</span></button> @endif</td>
                               {{-- <td><i type='button' style='padding: 10px;' title='Make payment' class="fas fa-donate" onclick="orderActions('{{ $purchaseOrders->post_id }}', 'makepayment')"></i></td> --}}
                               <td>@if($purchaseOrders->move_to_inventory == 0 && $purchaseOrders->receive_order == 0) <button type='button' style='border: 1px solid darkblue; border-radius: 10px; padding: 7px; cursor: not-allowed;' title='Move to Inventory' onclick="orderActions('{{ $purchaseOrders->post_id }}', 'movetoinventory')" disabled><span style="color: red; font-size: 12px; font-weight: bold;">deactivate</span></button> @elseif($purchaseOrders->move_to_inventory == 0 && $purchaseOrders->receive_order == 1) <button type='button' style='border: 1px solid darkblue; border-radius: 10px; padding: 7px;' title='Move to Inventory' onclick="orderActions('{{ $purchaseOrders->post_id }}', 'movetoinventory')"><span style="color: darkblue; font-size: 12px; font-weight: bold;">activate</span></button> @else <button type='button' style='border: 1px solid darkblue; border-radius: 10px; padding: 7px; cursor: not-allowed;' title='Move to Inventory' onclick="orderActions('{{ $purchaseOrders->post_id }}', 'movetoinventory')" disabled><span style="color: red; font-size: 12px; font-weight: bold;">deactivate</span></button> @endif</td>
                           </tr>

                        @endif

                        @endforeach
                    @else
                        <tr><td align="center" colspan="20">No Purchase Order record</td></tr>
                    @endif

                   </tbody>
               </table>
          </div>
        </div>
    </div>

    {{-- End Manage Purchase Order Schedule --}}

      {{-- End Manage Purchase Order --}}

  </div>
  <div class="tab-pane fade" id="createpurchase" role="tabpanel" aria-labelledby="createpurchase-tab">
      {{-- Start Create Purchase Order --}}

      {{-- Start Create Purchase Order --}}
      <div class="card">

        <div id="collapseSeven" class="collapse show" aria-labelledby="headingSeven" data-parent="#accordion">
          <div class="card-body">
            <h2 class="text-center">General <i title="Purchase Order option" style="cursor: pointer; color: tomato;" class="fas fa-user-cog" onclick="$('.po_suggest').removeClass('disp-0')"></i></h2> <hr>

                <div class="row">
                    <div class="col-md-3">
                        <h6>Vendors</h6>
                        <select class="form-control" id="myVendor" name="myVendor">
                            <option value="">--Select Vendor--</option>
                            @if($vendor != "")
                                @foreach($vendor as $vendors)
                                    <option value="{{ $vendors->vendor_name }}">{{ $vendors->vendor_name }}</option>
                                @endforeach

                            @endif
                        </select>
                    </div>

            <div class="col-md-3 po_suggest">
                <h6>Choose Purchase Order</h6>
                <select name="po_suggest" id="po_suggestion" class="form-control">
                    <option value="">Select one</option>
                    <option value="auto generate">Auto generate</option>
                    <option value="user defined">User defined</option>
                </select>
            </div>

                    <div class="col-md-3 po_suggestion disp-0">
                        <h6>Purchase Order #</h6>
                        <input type="text" name="purchase_order_no_sugg" id="purchase_order_no_sugg" class="form-control po_sugg disp-0" value="{{ 'PO'.mt_rand(1000, 9000) }}" disabled="">
                        <input type="text" name="purchase_order_no" id="purchase_order_no" class="form-control po_no_sugg disp-0">
                    </div>
                    <div class="col-md-3">
                        <h6>Order Date</h6>
                        <input type="date" name="order_date" id="order_date" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Date Expected</h6>
                        <input type="date" name="expected_date" id="expected_date" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <h6>Inventory Item</h6>
                        <select class="form-control" name="purchase_order_inventory_item" id="purchase_order_inventory_item">
                        @if($inventoryItem != "")
                            <option value="">Select Inventory Item</option>
                            @foreach($inventoryItem as $inventoryItems)
                            <option value="{{ $inventoryItems->description }}">{{ $inventoryItems->description }}</option>
                            @endforeach

                            @else
                            <option value="">No Inventory Item</option>
                        @endif
                        </select>
                    </div>
                    <div class="col-md-3">
                        <h6>Quantity</h6>
                        <input type="number" name="purchase_order_qty" id="purchase_order_qty" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Rate</h6>
                        <input type="number" name="purchase_order_rate" id="purchase_order_rate" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Total Cost</h6>
                        <input type="number" name="purchase_order_totcost" id="purchase_order_totcost" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2">
                        <h6>Shipping Cost</h6>
                        <input type="number" name="purchase_order_shippingcost" id="purchase_order_shippingcost" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <h6>Less:Discount</h6>
                        <input type="number" name="purchase_order_discount" id="purchase_order_discount" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <h6>Other Costs</h6>
                        <input type="number" name="purchase_order_othercost" id="purchase_order_othercost" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Tax</h6>
                        <input type="number" name="purchase_order_tax" id="purchase_order_tax" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Purchase Order Total</h6>
                        <input type="number" name="purchase_order_totalpurchaseorder" id="purchase_order_totalpurchaseorder" class="form-control">
                    </div>
                </div>
                <hr>

                <h2 class="text-center">Shipping Information</h2> <hr>
                <div class="row">

                    <div class="col-md-4">
                        <h6>Ship To</h6>
                        <input type="text" name="purchase_order_shipto" id="purchase_order_shipto" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <h6>Address 1</h6>
                        <input type="text" name="purchase_order_address1" id="purchase_order_address1" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <h6>Address 2</h6>
                        <input type="text" name="purchase_order_address2" id="purchase_order_address2" class="form-control">
                    </div>

                </div>
                <br>
                <div class="row">

                    <div class="col-md-3">
                        <h6>Country</h6>
                        {{-- <select name="purchase_order_country" id="purchase_order_country" class="form-control"></select> --}}
                        <select id="countryeez" class="form-control @error('countryeez') is-invalid @enderror" name="country" value="{{ old('countryeez') }}" autocomplete="countryeez"></select>
                        {{-- <input type="text" > --}}
                    </div>
                    <div class="col-md-3">
                        <h6>State/Province</h6>
                        {{-- <select name="purchase_order_state" id="purchase_order_state" class="form-control"></select> --}}
                        <select id="stateez" class="form-control @error('stateez') is-invalid @enderror" name="state" value="{{ old('stateez') }}" required autocomplete="stateez"></select>
                        {{-- <input type="text" > --}}
                    </div>
                    <div class="col-md-3">
                        <h6>City</h6>
                        <input type="text" name="purchase_order_city" id="purchase_order_city" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <h6>Zip/Postal Code</h6>
                        <input type="text" name="purchase_order_zip" id="purchase_order_zip" class="form-control">
                    </div>

                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <h6>Destination Phone #</h6>
                        <input type="text" name="purchase_order_destphone" id="purchase_order_destphone" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Destination Fax</h6>
                        <input type="text" name="purchase_order_destfax" id="purchase_order_destfax" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Destination Email</h6>
                        <input type="text" name="purchase_order_destmail" id="purchase_order_destmail" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Ordered by Staff</h6>
                        <input type="text" name="purchase_order_orderby" id="purchase_order_orderby" class="form-control" value="{{ Auth::user()->name }}" readonly="">
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-md-4">
                        <h6>&nbsp;</h6>
                        &nbsp;
                    </div>
                    <div class="col-md-4">
                        <h6>&nbsp;</h6>
                        <button type="button" class="btn btn-primary btn-block" onclick="savePO('{{ uniqid().'_'.time() }}', 'submit')">Submit <img class="spinnerPOsubmit disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                    </div>
                    <div class="col-md-4">
                        <h6>&nbsp;</h6>
                        <button type="button" class="btn btn-secondary btn-block" onclick="savePO('{{ uniqid().'_'.time() }}', 'printmail')">Print/Email <img class="spinnerPOprintmail disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                    </div>

                </div>
          </div>
        </div>
      </div>

      {{-- End Create Purchase Order --}}


      {{-- End Create Purchase Order --}}
  </div>
  <div class="tab-pane fade" id="inventory" role="tabpanel" aria-labelledby="inventory-tab">
      {{-- Start Inventory Record Form --}}

      {{-- Start Inventory Records --}}

        <div class="card">

        <div id="collapseinvRecords" class="collapse show" aria-labelledby="headinginvRecords" data-parent="#accordion">

          <div class="card-body table table-responsive">

               <table class="table table-striped table-bordered">
                   <thead>
                       <tr style="font-size: 11px;">
                            <th>#</th>
                           <th>Part #</th>
                           <th>Description</th>
                           <th>Category</th>
                           <th>UPC Code</th>
                           <th>Quantity Received/(Issued)</th>
                           <th>PO # / Work Order #</th>
                           <th>Balance @ hand</th>
                           <th>Vendor Name/Customer Vehicle Ref</th>
                           <th>Location</th>
                       </tr>
                   </thead>
                   <tbody>
                        @if($getinvItem != "")
                        <?php $i = 1;?>
                            @foreach($getinvItem as $getinvItems)

                            @if($getinvItems->move_to_inventory == 1)
                                <tr style="font-size: 11px;">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $getinvItems->part_no }}</td>
                                    <td>{{ $getinvItems->description }}</td>
                                    <td>{{ $getinvItems->category }}</td>
                                    <td>{{ $getinvItems->upccode }}</td>
                                    <td>{{ $getinvItems->purchase_order_qty }}</td>
                                    <td>{{ $getinvItems->purchase_order_no }}</td>
                                    <td>{{ number_format($getinvItems->qtyathand + $getinvItems->purchase_order_qty)  }}</td>
                                    <td>{{ $getinvItems->vendor }}</td>
                                    <td>{{ $getinvItems->location }}</td>
                                </tr>
                            @endif

                            @endforeach
                        @else
                        <tr><td align="center" colspan="10">No Inventory Record</td></tr>
                        @endif

                   </tbody>

                   <tbody id="invItems"></tbody>
               </table>
          </div>
        </div>
    </div>

    {{-- End Inventory Records --}}

      {{-- End Inventory Record Form --}}
  </div>
  <div class="tab-pane fade" id="createcategory" role="tabpanel" aria-labelledby="createcategory-tab">

    {{-- Start Create Category Form Record --}}

    {{-- Start Create Part Category Records --}}

        <div class="card">

        <div id="collapsecategory" class="collapse show" aria-labelledby="headingcategory" data-parent="#accordion">

          <div class="card-body table table-responsive">
                <div class="row">
                    <div class="col-md-3">
                        <h6>Category</h6>
                        <input type="text" name="category_name" id="category_name" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Description</h6>
                        <input type="text" name="category_description" id="category_description" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>&nbsp;</h6>
                        <button type="button" class="btn btn-primary btn-block" onclick="createCategory('submit')">Submit <img class="spinnercat disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                    </div>
                    <div class="col-md-3">
                        <h6>&nbsp;</h6>
                        <button type="button" class="btn btn-danger btn-block" onclick="createCategory('cancel')">Cancel</button>
                    </div>
                </div>
          </div>
        </div>
    </div>

    {{-- End Create Part Category Records --}}

    {{-- End Create Category Form Record --}}


  </div>
  <div class="tab-pane fade" id="createinventoryitem" role="tabpanel" aria-labelledby="createinventoryitem-tab">
      {{-- Start Create Inventory Record Form --}}

      {{-- Start Create Inventory Records --}}

        <div class="card">

        <div id="collapsecreateInvRec" class="collapse show" aria-labelledby="headingcreateInvRec" data-parent="#accordion">
          <div class="card-body table table-responsive">
            <div class="row">
                <div class="col-md-3">
                    <h6>Part #</h6>
                    <input type="hidden" name="inv_post_id" class="form-control" id="inv_post_id" value="">
                    <input type="text" name="inv_parts_no" class="form-control" id="inv_parts_no">
                </div>
                <div class="col-md-3">
                    <h6>Description</h6>
                    <input type="text" name="inv_description" class="form-control" id="inv_description">
                </div>
                <div class="col-md-3">
                    <h6>Category</h6>
                    <select name="inv_category" class="form-control" id="inv_category">

                        @if($categoryItem != "")
                        <option value="">Select one</option>
                        @foreach($categoryItem as $categoryItems)
                        <option value="{{ $categoryItems->category }}">{{ $categoryItems->category }}</option>
                        @endforeach

                        @else
                        <option value="">No category created</option>
                    @endif
                    </select>

                </div>
                <div class="col-md-3">
                    <h6>UPC Code</h6>
                    <input type="text" name="inv_upccode" class="form-control" id="inv_upccode">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <h6>Location</h6>
                    <input type="text" name="inv_location" class="form-control" id="inv_location">
                </div>
                <div class="col-md-3">
                    <h6>Quantity @ hand</h6>
                    <input type="text" name="inv_qtyathand" class="form-control" id="inv_qtyathand">
                </div>
                <div class="col-md-3">
                    <h6>Created by</h6>
                    <input type="text" name="inv_createdby" class="form-control" id="inv_createdby" value="{{ Auth::user()->name }}" readonly="">
                </div>
                <div class="col-md-3">
                    <h6>&nbsp;</h6>
                    <button type="button" class="btn btn-primary btn-block" onclick="createInv()">Submit <img class="spinnerinvs disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
            </div>

          </div>
        </div>
    </div>

    {{-- End Create Inventory Records --}}


      {{-- End Create Inventory Record Form --}}
  </div>
  <div class="tab-pane fade show active" id="createvendor" role="tabpanel" aria-labelledby="createvendor-tab">

    {{-- Start Create Vendor Record Form --}}

    {{-- Start Create Vendor --}}
        <div class="card">

        <div id="collapsevendor" class="collapse show" aria-labelledby="headingvendor" data-parent="#accordion">
          <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <h6>Code</h6>
                        <input type="text" name="create_vendorcode" id="create_vendorcode" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Name</h6>
                        <input type="text" name="create_vendorname" id="create_vendorname" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Sales Rep Name</h6>
                        <input type="text" name="create_vendorsalesrep" id="create_vendorsalesrep" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Address</h6>
                        <input type="text" name="create_vendoraddress" id="create_vendoraddress" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <h6>Country</h6>
                        <select id="create_vendorcountry" class="form-control @error('create_vendorcountry') is-invalid @enderror" name="create_vendorcountry" value="{{ old('create_vendorcountry') }}" autocomplete="create_vendorcountry"></select>
                    </div>
                    <div class="col-md-4">
                        <h6>State/Province</h6>
                        <select id="create_vendorstate" class="form-control @error('create_vendorstate') is-invalid @enderror" name="create_vendorstate" value="{{ old('create_vendorstate') }}" autocomplete="create_vendorstate"></select>
                    </div>
                    <div class="col-md-4">
                        <h6>City</h6>
                        <input type="text" name="create_vendorcity" id="create_vendorcity" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <h6>Email</h6>
                        <input type="email" name="create_vendoremail" id="create_vendoremail" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Phone Number</h6>
                        <input type="text" name="create_vendorphone" id="create_vendorphone" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Fax</h6>
                        <input type="text" name="create_vendorfax" id="create_vendorfax" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Created By</h6>
                        <input type="text" name="create_vendorcreatedby" id="create_vendorcreatedby" class="form-control" value="{{ Auth::user()->name }}" readonly="">
                    </div>
                </div>
                <br>
                <center>

                           <button type="button" class="btn btn-primary btn-block" onclick="createVendor()">Submit <img class="spinnervendor disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </center>
                <br>
          </div>
        </div>
    </div>
{{-- End Create Vendor --}}


    {{-- End Create Vendor Record Form --}}

  </div>
  <div class="tab-pane fade" id="updatevendorprofile" role="tabpanel" aria-labelledby="updatevendorprofile-tab">
      {{-- Start Update Vendor Profile --}}

      {{-- Start Update Vendor's Profile --}}
        <div class="card">

        <div id="collapseupdatevendor" class="collapse show" aria-labelledby="headingupdatevendor" data-parent="#accordion">
          <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h6>Select Vendor</h6>
                        <select name="updateVendors" id="updateVendors" class="form-control">
                            @if($vendor != "")
                            <option value="">Select One</option>
                                @foreach($vendor as $vendors)
                                    <option value="{{ $vendors->vendor_code }}">{{ $vendors->vendor_name }}</option>
                                @endforeach
                            @else
                            <option>No vendor registered</option>
                            @endif
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <h6>Code</h6>
                        <input type="text" name="update_vendorcode" id="update_vendorcode" class="form-control" readonly="">
                    </div>
                    <div class="col-md-3">
                        <h6>Name</h6>
                        <input type="text" name="update_vendorname" id="update_vendorname" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Sales Rep Name</h6>
                        <input type="text" name="update_vendorsalesrep" id="update_vendorsalesrep" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Address</h6>
                        <input type="text" name="update_vendoraddress" id="update_vendoraddress" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <h6>Country</h6>
                        <select id="update_vendorcountry" class="form-control @error('update_vendorcountry') is-invalid @enderror" name="update_vendorcountry" value="{{ old('update_vendorcountry') }}" autocomplete="update_vendorcountry"></select>
                    </div>
                    <div class="col-md-4">
                        <h6>State/Province</h6>
                        <select id="update_vendorstate" class="form-control @error('update_vendorstate') is-invalid @enderror" name="update_vendorstate" value="{{ old('update_vendorstate') }}" autocomplete="update_vendorstate"></select>
                    </div>
                    <div class="col-md-4">
                        <h6>City</h6>
                        <input type="text" name="update_vendorcity" id="update_vendorcity" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <h6>Email</h6>
                        <input type="email" name="update_vendoremail" id="update_vendoremail" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Phone Number</h6>
                        <input type="text" name="update_vendorphone" id="update_vendorphone" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Fax</h6>
                        <input type="text" name="update_vendorfax" id="update_vendorfax" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <h6>Updated By</h6>
                        <input type="text" name="update_vendorupdatedby" id="update_vendorupdatedby" class="form-control" value="{{ Auth::user()->name }}" readonly="">
                    </div>
                </div>
                <br>
                <center>

                           <button type="button" class="btn btn-primary btn-block" onclick="updateVendor()">Update <img class="spinnervendorupdt disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </center>
                <br>
          </div>
        </div>
    </div>
{{-- End Update Vendor's Profile --}}


      {{-- End Update Vendor Profile --}}

  </div>
  <div class="tab-pane fade" id="payvendor" role="tabpanel" aria-labelledby="payvendor-tab">

      {{-- Start Pay vendor Record Form --}}

      {{-- Start Pay Vendors --}}

    <div class="card">


        <div id="collapsemakePayments" class="collapse show" aria-labelledby="headingmakePayments" data-parent="#accordion">

          <div class="card-body table table-responsive">
{{--             <div class="row">
                <div class="col-md-12">
                    <h6>Choose payment type</h6>

                    <select class="form-control" name="pay_type" id="pay_type">
                        <option value="">Select One</option>
                        <option value="Generate Invoice">Generate Invoice</option>
                        <option value="Make Payment">Make Payment</option>
                    </select>
                </div>
            </div> --}}
            <br>
            <div class="row">
                <div class="col-md-4">
                    <input type="hidden" name="pay_post_id" id="pay_post_id" value="{{ uniqid().'_'.time() }}">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Purchase Order Number</h6>
                </div>
                <div class="col-md-8">
                    <select class="form-control" name="pay_po_number" id="pay_po_number">
                        @if($purchaseOrder != "")
                        <option value="">Select one</option>
                            @foreach($purchaseOrder as $purchaseOrders)
                                <option value="{{ $purchaseOrders->purchase_order_no }}">{{ $purchaseOrders->purchase_order_no }}</option>
                            @endforeach
                        @else
                            <option value="">No Purchase Order</option>
                        @endif
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Vendor</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="vend_name" id="vend_name" class="form-control" readonly="">
                    {{-- <select name="vend_name" class="form-control" id="vend_name">
                        @if($vendor != "")
                        <option value="">Select vendor</option>
                            @foreach($vendor as $vendors)
                                <option value="{{ $vendors->vendor_email }}">{{ $vendors->vendor_name }}</option>
                            @endforeach
                            @else
                            <option value="">No vendor</option>
                        @endif
                    </select> --}}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Order Date</h6>
                </div>
                <div class="col-md-8">
                    <input type="date" name="pay_order_date" id="pay_order_date" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Date Expected</h6>
                </div>
                <div class="col-md-8">
                    <input type="date" name="pay_date_expected" id="pay_date_expected" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Inventory Item</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_invent_item" id="pay_invent_item" class="form-control">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Description of Item</h6>
                </div>
                <div class="col-md-8">
                    <textarea name="pay_description_of_item" id="pay_description_of_item" class="form-control" style="height: 200px; resize: none;"></textarea>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Quantity</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_quantity" id="pay_quantity" class="form-control">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Rate</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_rate" id="pay_rate" class="form-control">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Total Cost</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_tot_cost" id="pay_tot_cost" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Shipping Cost</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_shipping_cost" id="pay_shipping_cost" class="form-control">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Less:Discount</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_discount" id="pay_discount" class="form-control">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Other Costs</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_othercosts" id="pay_othercosts" class="form-control">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Tax</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_tax" id="pay_tax" class="form-control">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Purchase Order Total</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_po_total" id="pay_po_total" class="form-control">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Advance Payment</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_advance" id="pay_advance" class="form-control">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Balance Amount</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_balance" id="pay_balance" class="form-control" readonly="">
                </div>
            </div>
            <br>
            <hr><h2>Cash Payment</h2><hr>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Cash Amount</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_cashamount" id="pay_cashamount" class="form-control">
                </div>
            </div>
            <br>
            <hr><h2>Cheque Payment</h2><hr>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Cheque #</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_chequeno" id="pay_chequeno" class="form-control">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Cheque Date</h6>
                </div>
                <div class="col-md-8">
                    <input type="date" name="pay_chequedate" id="pay_chequedate" class="form-control">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Cheque Amount</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_chequeamount" id="pay_chequeamount" class="form-control">
                </div>
            </div>
            <br>

            <hr><h2>Card Payment</h2><hr>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Card #</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_credit" id="pay_credit" class="form-control">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">CC</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_cc" id="pay_cc" class="form-control">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Card Amount</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_cardamount" id="pay_cardamount" class="form-control">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Grand Total</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_grandtotal" id="pay_grandtotal" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <button class="btn btn-primary btn-block proPayment" onclick="poPay('payment')">Process Payment <img class="spinnerpay disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <button class="btn btn-secondary btn-block" onclick="poPay('printmail')">Print/Email <img class="spinnerprints disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <button class="btn btn-danger btn-block" onclick="poPay('cancel')">Cancel</button>
                </div>
            </div>

          </div>


        </div>
    </div>

    {{-- End Pay Vendors --}}

      {{-- End Pay vendor Record Form --}}


  </div>
</div>

{{-- End Menu For Manage Inventory --}}

</div>






@endif
{{-- End manage Inventory --}}




{{-- Start Manage Labour Schedule --}}
@if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Technician" || Auth::user()->userType == "Certified Professional")

<div class="tab-pane fade" id="labourschedule" role="tabpanel" aria-labelledby="labourschedule-tab">

{{-- Start Menu for Manage Labour Schedule --}}

<br>
<ul class="nav nav-tabs" id="myTab" role="tablist">
 @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")
  <li class="nav-item">
    <a class="nav-link @if(Auth::user()->userType != "Technician") active @endif" id="managelabourschedule-tab" data-toggle="tab" href="#managelabourschedule" role="tab" aria-controls="managelabourschedule" aria-selected="true">Manage Labour Schedule</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="createlabourcategory-tab" data-toggle="tab" href="#createlabourcategory" role="tab" aria-controls="createlabourcategory" aria-selected="false">Create Labour Category</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="createlabourrecord-tab" data-toggle="tab" href="#createlabourrecord" role="tab" aria-controls="createlabourrecord" aria-selected="false">Create Labour Record</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="addlabour-tab" data-toggle="tab" href="#addlabour" role="tab" aria-controls="addlabour" aria-selected="false">Add Labour</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="managetimesheet-tab" data-toggle="tab" href="#managetimesheet" role="tab" aria-controls="managetimesheet" aria-selected="false">Manage Time Sheet</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="listtechnicians-tab" data-toggle="tab" href="#listtechnicians" role="tab" aria-controls="listtechnicians" aria-selected="false">List Technicians</a>
  </li>
  @endif

  @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Technician" || Auth::user()->userType == "Certified Professional")
  <li class="nav-item">
    <a class="nav-link @if(Auth::user()->userType == "Technician") active @endif" id="clockingsheet-tab" data-toggle="tab" href="#clockingsheet" role="tab" aria-controls="clockingsheet" aria-selected="@if(Auth::user()->userType == "Technician") true @else false @endif">Clocking Sheet</a>
  </li>
  @endif

   @if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")
  <li class="nav-item">
    <a class="nav-link" id="paylabour-tab" data-toggle="tab" href="#paylabour" role="tab" aria-controls="paylabour" aria-selected="false">Pay Labour</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="payschedule-tab" data-toggle="tab" href="#payschedule" role="tab" aria-controls="payschedule" aria-selected="false">Pay Schedule</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="labourpaystub-tab" data-toggle="tab" href="#labourpaystub" role="tab" aria-controls="labourpaystub" aria-selected="false">Labour Pay Stub</a>
  </li>
  @endif
</ul>

<div class="tab-content" id="myTabContent">


@if(Auth::user()->userType != "Technician")
  <div class="tab-pane fade show active" id="managelabourschedule" role="tabpanel" aria-labelledby="managelabourschedule-tab">
      {{-- Start Manage Labour Schedule Record Form --}}

      {{-- Start Manage Labour Schedule --}}

              <div class="card">

        <div id="collapsemanagelabourschedule" class="collapse show" aria-labelledby="headingmanagelabourschedule" data-parent="#accordion">
          <div class="card-body table table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr style="font-size: 11px;">
                            <th>#</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Hours</th>
                            <th>Rates (Hourly)</th>
                            <th>Rates (Flat)</th>
                            <th>Rates (Wholesale)</th>
                            <th>Rates (Retail)</th>
                            <th>Media</th>
                            <th>Detailed Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($manageLabour != "")
                        <?php $i = 1;?>
                            @foreach($manageLabour as $manageLabours)
                                <tr style="font-size: 11px;">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $manageLabours->labours_description }}</td>
                                    <td>{{ $manageLabours->labours_categories }}</td>
                                    <td>{{ $manageLabours->hour }}</td>
                                    <td>{{ $manageLabours->rate_per_hour }}</td>
                                    <td>{{ $manageLabours->flat_rate }}</td>
                                    <td>{{ $manageLabours->wholesale_rate }}</td>
                                    <td>{{ $manageLabours->retail_rate }}</td>
                                    @if($manageLabours->labour_video != "noImage.png")
                                        <td align="center"><a href="/labourupload/{{ $manageLabours->labour_video }}" target="_blank" style="font-size: 13px; text-decoration: none; text-align: center;" class="animated infinite fadeIn"><i class="fas fa-play" style="color: red"></i></a></td>
                                    @else
                                        <td>No media</td>
                                    @endif

                                    <td>{{ $manageLabours->detailed_description }}</td>
                                </tr>
                            @endforeach

                        @else
                            <tr><td align="center" colspan="10">No Labour Schedule</td></tr>
                        @endif

                    </tbody>
                </table>
          </div>
        </div>
    </div>
      {{-- End Manage Labour Schedule --}}

      {{-- End Manage Labour Schedule Record Form --}}
  </div>
  <div class="tab-pane fade" id="createlabourcategory" role="tabpanel" aria-labelledby="createlabourcategory-tab">
      {{-- Start Create Labour Category Record Form --}}

      {{-- Start Create Labour Category --}}

      <div class="card">

        <div id="collapsecreatelabourcategory" class="collapse show" aria-labelledby="headingcreatelabourcategory" data-parent="#accordion">
          <div class="card-body">
            <h2 class="text-center">Labour Category</h2> <hr>
                <div class="row">
                    <div class="col-md-8">
                        <h6>&nbsp;</h6>
                        <input type="hidden" name="labours_busID" id="labours_busID" value="{{ Auth::user()->busID }}">
                        <input type="text" name="labours_category" id="labours_category" class="form-control" placeholder="Labour Category">
                    </div>
                    <div class="col-md-4">
                        <h6>&nbsp;</h6>
                        <button class="btn btn-primary btn-block" onclick="labourCreate('labours_category')">Submit <img class="spinnerlabours_category disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                    </div>
                </div>

          </div>
        </div>
      </div>

      {{-- End Create Labour Category --}}


      {{-- End Create Labour Category Record Form --}}
  </div>
  <div class="tab-pane fade" id="createlabourrecord" role="tabpanel" aria-labelledby="createlabourrecord-tab">
      {{-- Start Create Labour Record Form --}}

      {{-- Start Create Labour Record --}}

      <div class="card">

        <div id="collapselabourrecords" class="collapse show" aria-labelledby="headinglabourrecords" data-parent="#accordion">

          <div class="card-body table table-responsive">
            <h4 class="text-center">New Record</h4> <hr>
            <div class="row">
                <div class="col-md-4">
                    <h6>Labour Description</h6>
                    <input type="hidden" name="labourscat_busID" id="labourscat_busID" value="{{ Auth::user()->busID }}">
                    <input type="text" name="labours_description" id="labours_description" class="form-control">
                </div>
                <div class="col-md-4">
                    <h6>Labour Category</h6>
                    <select name="labours_categories" id="labours_categories" class="form-control">
                        @if($myLabourCategory != "")
                            <option value="">Select one</option>
                            @foreach($myLabourCategory as $myLabourCategorys)
                                <option value="{{ $myLabourCategorys->labours_category }}">{{ $myLabourCategorys->labours_category }}</option>
                            @endforeach
                        @else
                        <option value="">No labour category</option>
                        @endif

                    </select>
                </div>
                <div class="col-md-4">
                    <h6>Hour</h6>
                    <input type="text" name="hour" id="hour" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <h6>Rate Per Hour</h6>
                    <input type="text" name="rate_per_hour" id="rate_per_hour" class="form-control">
                </div>
                <div class="col-md-3">
                    <h6>Flat Rate</h6>
                    <input type="text" name="flat_rate" id="flat_rate" class="form-control">
                </div>
                <div class="col-md-3">
                    <h6>Wholesale Rate</h6>
                    <input type="text" name="wholesale_rate" id="wholesale_rate" class="form-control">
                </div>
                <div class="col-md-3">
                    <h6>Retail Rate</h6>
                    <input type="text" name="retail_rate" id="retail_rate" class="form-control">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col">
                    <h6>Detailed Description</h6>
                    <textarea name="detailed_description" id="detailed_description" class="form-control" style="height: 150px; resize: none;" ></textarea>
                </div>
            </div>
            <br>
            <h4 class="text-center">Media Link</h4> <hr>
            <div class="row">
                <div class="col-md-6">
                    <h6>Video</h6>
                    <input type="file" name="labour_video" id="labour_video" class="form-control">
                </div>
                <div class="col-md-6">
                    <h6>Note</h6>
                    <input type="text" name="labour_note" id="labour_note" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h6>&nbsp;</h6>
                    <button class="btn btn-primary btn-block" onclick="labourCreate('labours_record')">Submit <img class="spinnerlabours_record disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>

            </div>

          </div>
        </div>
    </div>

    {{-- End Create Labour Record --}}

      {{-- End Create Labour Record Form --}}
  </div>
  <div class="tab-pane fade" id="addlabour" role="tabpanel" aria-labelledby="addlabour-tab">
    {{-- Start Add Labour Record Form --}}

        {{-- Start Add Labour --}}

        <div class="card">

        <div id="collapseaddlabour" class="collapse show" aria-labelledby="headingaddlabour" data-parent="#accordion">
          <div class="card-body table table-responsive">
            <h4 class="text-center">Details</h4><hr>
            <div class="row">

                <div class="col-md-3">
                    <h6>Firstname</h6>
                    <input type="hidden" name="addlabour_id" id="addlabour_id" class="form-control" value="">
                    <input type="text" name="addlabour_firstname" id="addlabour_firstname" class="form-control">
                </div>
                <div class="col-md-3">
                    <h6>Lastname</h6>
                    <input type="text" name="addlabour_lastname" id="addlabour_lastname" class="form-control">
                </div>
                <div class="col-md-3">
                    <h6>Email</h6>
                    <input type="email" name="addlabour_email" id="addlabour_email" class="form-control">
                </div>
                <div class="col-md-3">
                    <h6>Password</h6>
                    <input type="password" name="addlabour_password" id="addlabour_password" class="form-control">
                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>Phone</h6>
                    <input type="hidden" name="addlabour_role" id="addlabour_role" class="form-control" value="Technician">
                    <input type="text" name="addlabour_phone" id="addlabour_phone" class="form-control">
                </div>
                <div class="col-md-4">
                    <h6>Description of Speciality</h6>
                    <input type="text" name="addlabour_speciality" id="addlabour_speciality" class="form-control">
                </div>
                <div class="col-md-4">
                    <h6>Category</h6>
                    <select name="addlabour_category" id="addlabour_category" class="form-control">
                        @if($myLabourCategory != "")
                            <option value="">Select one</option>
                            @foreach($myLabourCategory as $myLabourCategorys)
                                <option value="{{ $myLabourCategorys->labours_category }}">{{ $myLabourCategorys->labours_category }}</option>
                            @endforeach
                        @else
                        <option value="">No labour category</option>
                        @endif
                    </select>
                </div>
            </div>
            <br>
            <h4 class="text-center">Charge To Store</h4><hr>
            <div class="row">
                <div class="col-md-3">
                    <h6>Hourly Rate</h6>
                    <input type="number" name="addlabour_hourly_rate" id="addlabour_hourly_rate" class="form-control">
                </div>
                <div class="col-md-3">
                    <h6>Flat Rate</h6>
                    <input type="number" name="addlabour_flat_rate" id="addlabour_flat_rate" class="form-control">
                </div>
                <div class="col-md-3">
                    <h6>Budgeted Hours</h6>
                    <input type="number" name="addlabour_budgeted_hours" id="addlabour_budgeted_hours" class="form-control">
                </div>
                <div class="col-md-3">
                    <h6>Total Costs</h6>
                    <input type="number" name="addlabour_total_costs" id="addlabour_total_costs" class="form-control" readonly="">
                </div>
            </div>
            <br>
            <div class="row disp-0">
                <div class="col-md-4">
                    <h6>Actual Hours</h6>
                    <input type="text" name="addlabour_actual_hours" id="addlabour_actual_hours" class="form-control" value="n/a">
                </div>
                <div class="col-md-4">
                    <h6>Labour Costs</h6>
                    <input type="text" name="addlabour_labour_costs" id="addlabour_labour_costs" class="form-control" value="n/a">
                </div>

            </div>


            <br>
            <h4 class="text-center">Media</h4><hr>
            <div class="row">
                <div class="col-md-3">
                    <h6>Video Upload</h6>
                    <input type="file" name="addlabour_videoupload" id="addlabour_videoupload" class="form-control">
                </div>
                <div class="col-md-3">
                    <h6>Job Description</h6>
                    <input type="text" name="addlabour_job_description" id="addlabour_job_description" class="form-control">
                </div>
                <div class="col-md-3">
                    <h6>Note</h6>
                    <input type="text" name="addlabour_notes" id="addlabour_notes" class="form-control">
                </div>
                <div class="col-md-3">
                    <h6>&nbsp;</h6>
                    <button class="btn btn-secondary btn-block" onclick="$('#managetimesheet-tab').click()">Time Sheet Lookup</button>
                    <input type="hidden" name="addlabour_timesheet" id="addlabour_timesheet" class="form-control" value="n/a">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <h6>&nbsp;</h6>
                    <button class="btn btn-primary btn-block addlabour_sbmt" onclick="addLabour('{{ Auth::user()->busID }}')">Submit <img class="spinneraddlabour disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>

                    <button class="btn btn-primary btn-block addlabour_updt disp-0" onclick="updateLabour()">Update <img class="spinneraddlabour_updt disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
            </div>

          </div>
        </div>
    </div>

    {{-- End Add Labour --}}

    {{-- End Add Labour Record Form --}}

  </div>

  <div class="tab-pane fade" id="managetimesheet" role="tabpanel" aria-labelledby="managetimesheet-tab">

      {{-- Start Manage Time Sheet Record Form --}}

      {{-- Start Manage Time Sheet --}}

        <div class="card">

        <div id="collapsemanagetimesheet" class="collapse show" aria-labelledby="headingmanagetimesheet" data-parent="#accordion">

          <div class="card-body table table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr style="font-size: 11px">
                            <th>#</th>
                            <th>DATE IN</th>
                            <th>TIME IN</th>
                            <th>DATE OUT</th>
                            <th>TIME OUT</th>
                            <th>TECHNICIAN NAME</th>
                            <th>STATION MANAGEMENT NAME</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($timesheet != "")
                        <?php $i = 1;?>
                            @foreach($timesheet as $timesheets)
                                <tr style="font-size: 11px">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ date('d/M/Y', strtotime($timesheets->date_in)) }}</td>
                                    <td>{{ date('h:i A', strtotime($timesheets->time_in)) }}</td>
                                    <td>{{ date('d/M/Y', strtotime($timesheets->date_out)) }}</td>
                                    <td>{{ date('h:i A', strtotime($timesheets->time_out)) }}</td>
                                    <td>{{ $timesheets->technician_name }}</td>

                                    @if($staffname = \App\User::where('id', $timesheets->technician_id)->where('busID', $timesheets->busID)->get())

                                        @if(count($staffname) > 0)
                                            @if($stationMan = \App\User::where('ref_code', $staffname[0]->ref_code)->get())

                                            @if(count($stationMan) > 0)
                                                <td>{{ $stationMan[0]->name }}</td>
                                            @else
                                                <td>--</td>
                                            @endif

                                            @else
                                                <td>--</td>
                                            @endif

                                            @else
                                            <td>--</td>

                                        @endif

                                        @else
                                        <td>--</td>
                                    @endif


                                </tr>

                            @endforeach
                        @else
                        <tr><td align="center" colspan="7">No record</td></tr>
                        @endif
                        <tr></tr>
                    </tbody>
                </table>
          </div>
        </div>
    </div>

    {{-- End Manage Time Sheet --}}

      {{-- End Manage Time Sheet Record Form --}}


  </div>



    <div class="tab-pane fade" id="listtechnicians" role="tabpanel" aria-labelledby="listtechnicians-tab">

      {{-- Start List Technicians Form --}}

      {{-- Start List Technicians --}}

        <div class="card">

        <div id="collapselisttechnicians" class="collapse show" aria-labelledby="headinglisttechnicians" data-parent="#accordion">

          <div class="card-body table table-responsive">
                <table class="table table-striped table-bordered" id="technicianlist">
                    <thead>
                        <tr style="font-size: 11px">
                            <th>#</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Specialty</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($jobdescription != "")
                        <?php $i = 1;?>
                            @foreach($jobdescription as $jobdescriptions)
                                <tr style="font-size: 11px">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $jobdescriptions->firstname.' '.$jobdescriptions->lastname }}</td>
                                    <td>{{ $jobdescriptions->email }}</td>
                                    <td>{{ $jobdescriptions->phone }}</td>
                                    <td>{{ $jobdescriptions->speciality }}</td>
                                    <td align="center;"><center><img type="button" src="https://img.icons8.com/color/48/000000/edit.png" style="width: 30px; height: 30px;" onclick="editTech('{{ $jobdescriptions->id }}')"></center></td>
                                </tr>

                            @endforeach
                        @else
                        <tr><td align="center" colspan="7">No record</td></tr>
                        @endif
                        <tr></tr>
                    </tbody>
                </table>
          </div>
        </div>
    </div>

    {{-- End List Technicians --}}

      {{-- End List Technicians Form --}}


  </div>

  @endif


  <div class="tab-pane fade @if(Auth::user()->userType == "Technician") show active @endif" id="clockingsheet" role="tabpanel" aria-labelledby="clockingsheet-tab">
    {{-- Start Clocking Sheet Record Form --}}

    {{-- Start Clocking Sheet --}}

        <div class="card">

        <div id="collapseclockingsheet" class="collapse show" aria-labelledby="headingclockingsheet" data-parent="#accordion">

          <div class="card-body table table-responsive">
                <div class="row">

                    <div class="col-md-3">
                        <h6>DATE IN</h6>
                        <input type="date" name="timesheet_date_in" id="timesheet_date_in" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <h6>TIME IN</h6>
                        <input type="time" name="timesheet_time_in" id="timesheet_time_in" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <h6>DATE OUT</h6>
                        <input type="date" name="timesheet_date_out" id="timesheet_date_out" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <h6>TIME OUT</h6>
                        <input type="time" name="timesheet_time_out" id="timesheet_time_out" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">

                    <div class="col-md-4 disp-0">
                        <h6>Technician Name</h6>
                        <input type="text" name="timesheet_technician_name" id="timesheet_technician_name" class="form-control" value="{{ Auth::user()->name }}" readonly="">
                    </div>

                    <div class="col-md-4 disp-0">
                        <h6>Technician ID</h6>
                        <input type="text" name="timesheet_technician_id" id="timesheet_technician_id" class="form-control" value="{{ Auth::user()->id }}" readonly="">
                    </div>


                    <div class="col-md-12">
                        <h6>&nbsp;</h6>
                        <button class="btn btn-primary btn-block" onclick="manageTime()">Submit <img class="spinnertimesheet disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                    </div>

                </div>
          </div>
        </div>
    </div>

    {{-- End Clocking Sheet --}}

    {{-- End Clocking Sheet Record Form --}}

  </div>

  @if(Auth::user()->userType != "Technician")
  <div class="tab-pane fade" id="paylabour" role="tabpanel" aria-labelledby="paylabour-tab">
      {{-- Start Pay Labour Record Form --}}

      {{-- Start Pay Labour --}}

        <div class="card">

        <div id="collapsepaylabour" class="collapse show" aria-labelledby="headingpaylabour" data-parent="#accordion">
            <div class="card-body table table-responsive">

            <div class="row">
                <div class="col-md-4">
                    <input type="hidden" name="pay_post_id" id="pay_post_id" value="{{ uniqid().'_'.time() }}">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Vehicle Licence</h6>
                </div>
                <div class="col-md-8">
                    <select class="form-control" name="pay_labour_licence" id="pay_labour_licence">
                        @if($allVehicleinfo != "")
                        <option value="">Select one</option>
                            @foreach($allVehicleinfo as $allVehicleinfos)

                            @if($allVehicleinfos->estimate_id != "")

                                @if($check = \App\PaySchedule::where('busID', Auth::user()->busID)->where('licence', $allVehicleinfos->vehicle_licence)->where('estimate_id', $allVehicleinfos->estimate_id)->get())

                            @if(count($check) == 0)
                                <option value="{{ $allVehicleinfos->estimate_id }}">{{ $allVehicleinfos->vehicle_licence.' - ('.date('d/M/Y', strtotime($allVehicleinfos->date)).')' }}

                                </option>

                            @endif

                            @endif

                            @endif


                            @endforeach
                        @else
                            <option value="">No Vehicle Licence</option>
                        @endif
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Make</h6>
                </div>
                <div class="col-md-8">
                    <input type="hidden" name="pay_labour_correctLicence" id="pay_labour_correctLicence" class="form-control" value="" readonly>
                    <input type="text" name="pay_labour_make" id="pay_labour_make" class="form-control" readonly>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Model</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_labour_model" id="pay_labour_model" class="form-control" readonly>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Report Date</h6>
                </div>
                <div class="col-md-8">
                    <input type="date" name="pay_labour_reportdate" id="pay_labour_reportdate" class="form-control" readonly>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Service Type</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_labour_servicetype" id="pay_labour_servicetype" class="form-control" readonly>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Service Option</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_labour_serviceoption" id="pay_labour_serviceoption" class="form-control" readonly>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Labour Hour</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_labour_labourhour" id="pay_labour_labourhour" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Labour Rate</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_labour_labourrate" id="pay_labour_labourrate" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Labour Pay Due</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_labour_paydue" id="pay_labour_paydue" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Technician</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_labourtechnicians" id="pay_labourtechnicians" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <button class="btn btn-primary btn-block proPayment" onclick="paylabour('movetopayschedule')">Move To Pay Schedule <img class="spinnermovetopayschedule disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <button class="btn btn-secondary btn-block" onclick="paylabour('edit')"> Edit </button>
                </div>
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <button class="btn btn-success btn-block" onclick="paylabour('printmail')">Print/Email <img class="spinnerprintsmail disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
            </div>

          </div>
        </div>
    </div>

    {{-- End Pay Labour --}}

      {{-- End Pay Labour Record Form --}}
  </div>



  {{-- Start Pay Schedule --}}


  <div class="tab-pane fade" id="payschedule" role="tabpanel" aria-labelledby="payschedule-tab">
      {{-- Start Pay Schedule Record Form --}}


        <div class="card">

        <div id="collapsepayschedule" class="collapse show" aria-labelledby="headingpayschedule" data-parent="#accordion">
            <div class="card-body table table-responsive">

            <div class="row">
                <div class="col-md-4">
                    <input type="hidden" name="pay_post_id" id="pay_post_id" value="{{ uniqid().'_'.time() }}">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Technician name</h6>
                </div>
                <div class="col-md-8">
                    <select class="form-control" name="pay_schedule_labourname" id="pay_schedule_labourname">
                        @if($payschedules != "")
                        <option value="">Select Labour Name</option>
                            @foreach($payschedules as $schedules)

                            @if($schedules->pay_stub != "1")
                                <option value="{{ $schedules->estimate_id }}">{{ $schedules->technician }}</option>
                            @endif
                            @endforeach
                        @else
                            <option value="">No Technician</option>
                        @endif
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Start Date</h6>
                </div>
                <div class="col-md-8">
                    <input type="date" name="pay_schedule_labourstartdate" id="pay_schedule_labourstartdate" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">End Date</h6>
                </div>
                <div class="col-md-8">
                    <input type="date" name="pay_schedule_labourenddate" id="pay_schedule_labourenddate" class="form-control">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">&nbsp;</h6>
                </div>
                <div class="col-md-8">
                    <button onclick="checksomeInfo('paystub')" class="btn btn-primary btn-block">Check Stub <img class="spinstub disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
            </div>

            <hr>

            <div class="row">

                <div class="container col-md-12">
                    <img class="spinstubTabl disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px; float: right;">
                    <table class="table table-responsive table-striped table-bordered">
                <thead>
                    <tr style="font-size: 13px; width: 100%">
                        <th>#</th>
                        <th>Report date</th>
                        <th>Vehicle Licence</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Service Option</th>
                        <th>Service Type</th>
                        <th>Labour Hour</th>
                        <th>Labour Rate</th>
                        <th>Pay Due</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="stubreport">

                </tbody>
            </table>
                </div>
            </div>


            <div class="disp-0">
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Report Date</h6>
                </div>
                <div class="col-md-8">
                    <input type="date" name="pay_schedule_labourreportdate" id="pay_schedule_labourreportdate" class="form-control" readonly>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Vehicle Licence</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_schedule_labourlicence" id="pay_schedule_labourlicence" class="form-control" readonly>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Make</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_schedule_labourmake" id="pay_schedule_labourmake" class="form-control" readonly>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Model</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_schedule_labourmodel" id="pay_schedule_labourmodel" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Service Type</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_schedule_labourservicetype" id="pay_schedule_labourservicetype" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Service Option</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_schedule_labourserviceoption" id="pay_schedule_labourserviceoption" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Labour Hour</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_schedule_labourhour" id="pay_schedule_labourhour" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Labour Rate</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_schedule_labourrate" id="pay_schedule_labourrate" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Labour Pay Due</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_schedule_labourpaydue" id="pay_schedule_labourpaydue" class="form-control" readonly="">
                </div>
            </div>
            <hr>
            </div>

            <div class="disp-0">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center text-primary">Cash Payment</h3>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Cash Amount</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_schedule_labourcashamount" id="pay_schedule_labourcashamount" class="form-control">
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center text-primary">Cheque Payment</h3>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Cheque Number</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_schedule_labourchequeno" id="pay_schedule_labourchequeno" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Cheque Date</h6>
                </div>
                <div class="col-md-8">
                    <input type="date" name="pay_schedule_labourchequedate" id="pay_schedule_labourchequedate" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Cheque Amount</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_schedule_labourchequeamount" id="pay_schedule_labourchequeamount" class="form-control">
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center text-primary">Credit Card Payment</h3>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Credit Card Number</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_schedule_labourcreditcardno" id="pay_schedule_labourcreditcardno" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">CC</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_schedule_labourcreditcardcc" id="pay_schedule_labourcreditcardcc" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Credit Card Amount</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_schedule_labourcreditcardamount" id="pay_schedule_labourcreditcardamount" class="form-control">
                </div>
            </div>
            <hr>

            </div>

            <div class="disp-0">
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Total Amount</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_schedule_labourtotalamount" id="pay_schedule_labourtotalamount" class="form-control" readonly="">
                </div>
            </div>
            <br>
            </div>

            <div class="row disp-0">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <input type="hidden" name="paystubestimate" id="paystubestimate" value="">
                    <button class="btn btn-primary btn-block proPayment" id="payLabstore" onclick="paylabour('paystub')">Process Payment <img class="spinnerpaystub disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <button class="btn btn-secondary btn-block" onclick="paylabour('paystubmail')"> Print/Email <img class="spinnerprintsmail disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <button class="btn btn-danger btn-block" onclick="paylabour('paystubcancel')">Cancel</button>
                </div>
            </div>

          </div>
        </div>
    </div>


      {{-- End Pay Schedule Record Form --}}
  </div>

  {{-- End Pay Schedule --}}




{{-- Start Labour Pay Stub --}}


  <div class="tab-pane fade" id="labourpaystub" role="tabpanel" aria-labelledby="labourpaystub-tab">
      {{-- Start Labour Pay Stub Record Form --}}


        <div class="card">

        <div id="collapselabourpaystub" class="collapse show" aria-labelledby="headinglabourpaystub" data-parent="#accordion">
            <div class="card-body table table-responsive">

            <div class="row">
                <div class="col-md-4">
                    <input type="hidden" name="pay_post_id" id="pay_post_id" value="{{ uniqid().'_'.time() }}">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Vehicle Licence</h6>
                </div>
                <div class="col-md-8">
                    <select class="form-control" name="pay_stub_labourname" id="pay_stub_labourname">
                        @if($payschedules != "")
                        <option value="">Select Labour Name</option>
                            @foreach($payschedules as $schedules)

                                @if($schedules->pay_stub == "1")

                                @if($checkStub = \App\LabourPaystub::where('busID', Auth::user()->busID)->where('pay_stub', '2')->where('estimate_id', $schedules->estimate_id)->get())


                                @if(count($checkStub) == 0)
                                    <option value="{{ $schedules->estimate_id }}">{{ $schedules->technician }}</option>
                                @endif

                                @endif

                                @endif

                            @endforeach
                        @else
                            <option value="">No Technician</option>
                        @endif
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Start Date</h6>
                </div>
                <div class="col-md-8">
                    <input type="date" name="pay_stub_labourstartdate" id="pay_stub_labourstartdate" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">End Date</h6>
                </div>
                <div class="col-md-8">
                    <input type="date" name="pay_stub_labourenddate" id="pay_stub_labourenddate" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Report Date</h6>
                </div>
                <div class="col-md-8">
                    <input type="date" name="pay_stub_labourreportdate" id="pay_stub_labourreportdate" class="form-control" readonly>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Vehicle Licence</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_stub_labourlicence" id="pay_stub_labourlicence" class="form-control" readonly>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Make</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_stub_labourmake" id="pay_stub_labourmake" class="form-control" readonly>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Model</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_stub_labourmodel" id="pay_stub_labourmodel" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Service Type</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_stub_labourservicetype" id="pay_stub_labourservicetype" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Service Option</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_stub_labourserviceoption" id="pay_stub_labourserviceoption" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Labour Hour</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_stub_labourhour" id="pay_stub_labourhour" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Labour Rate</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_stub_labourrate" id="pay_stub_labourrate" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Labour Pay Due</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_stub_labourpaydue" id="pay_stub_labourpaydue" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Deduction</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_stub_labourdeduction" id="pay_stub_labourdeduction" class="form-control">
                </div>
            </div>
            <br>

            <div class="row disp-0">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Balance</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_stub_labourbalance" id="pay_stub_labourbalance" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Net Pay</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_stub_labourtotalpay" id="pay_stub_labourtotalpay" class="form-control" readonly="">
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center text-primary">Cash Payment</h3>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Cash Amount</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_stub_labourcashamount" id="pay_stub_labourcashamount" class="form-control">
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center text-primary">Cheque Payment</h3>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Cheque Number</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_stub_labourchequeno" id="pay_stub_labourchequeno" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Cheque Date</h6>
                </div>
                <div class="col-md-8">
                    <input type="date" name="pay_stub_labourchequedate" id="pay_stub_labourchequedate" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Cheque Amount</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_stub_labourchequeamount" id="pay_stub_labourchequeamount" class="form-control">
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center text-primary">Credit Card Payment</h3>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Credit Card Number</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_stub_labourcreditcardno" id="pay_stub_labourcreditcardno" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">CC</h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="pay_stub_labourcreditcardcc" id="pay_stub_labourcreditcardcc" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Credit Card Amount</h6>
                </div>
                <div class="col-md-8">
                    <input type="number" name="pay_stub_labourcreditcardamount" id="pay_stub_labourcreditcardamount" class="form-control">
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <h6 class="text-left">Total Amount</h6>
                </div>
                <div class="col-md-8">
                    <input type="hidden" name="pay_stub_labourtechnician" id="pay_stub_labourtechnician" class="form-control">
                    <input type="number" name="pay_stub_labourtotalamount" id="pay_stub_labourtotalamount" class="form-control" readonly="">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <button class="btn btn-primary btn-block proPayment" onclick="processStub('processpaystub')">Process Payment <img class="spinnerprocesspaystub disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <button class="btn btn-secondary btn-block" onclick="processStub('processpaystubmail')"> Print/Email <img class="spinnerprocesspaystubmail disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <button class="btn btn-danger btn-block" onclick="processStub('processpaystubcancel')">Cancel</button>
                </div>
            </div>

          </div>
        </div>
    </div>


      {{-- End Labour Pay Stub Record Form --}}
  </div>

  {{-- End Labour Pay Stub --}}


  @endif

</div>


{{-- End Menu for Manage Labour Schedule --}}

</div>

@endif
{{-- End Manage Labour Schedule --}}


{{-- Start Revenue --}}

@if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")

<div class="tab-pane fade" id="revenue" role="tabpanel" aria-labelledby="revenue-tab">

{{-- Start Revenue Menu --}}


<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="invoices-tab" data-toggle="tab" href="#invoices" role="tab" aria-controls="invoices" aria-selected="true">Invoices</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="receievepayment-tab" data-toggle="tab" href="#receievepayment" role="tab" aria-controls="receievepayment" aria-selected="false">Receive Payment</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="paidinvoices-tab" data-toggle="tab" href="#paidinvoices" role="tab" aria-controls="paidinvoices" aria-selected="false">View Paid Invoices</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="unpaidinvoices-tab" data-toggle="tab" href="#unpaidinvoices" role="tab" aria-controls="unpaidinvoices" aria-selected="false">View Unpaid Invoices</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="invoices" role="tabpanel" aria-labelledby="invoices-tab">
    {{-- Start Invoices Record --}}

    {{-- Start Invoices --}}
        <div class="card">

        <div id="collapseinvoices" class="collapse show" aria-labelledby="headinginvoices" data-parent="#accordion">
          <div class="card-body table table-responsive">
            <table class="table table-striped table-bordered" id="invoicing">
                <thead>
                    <tr style="font-size: 12px;">
                        <th>#</th>
                        <th>Licence</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Total Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($invoice) > 0)
                    <?php $i=1;?>
                        @foreach($invoice as $invoices)
                            @if($invoices->payment != 0 )
                                <tr style="font-size: 12px;">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $invoices->vehicle_licence }}</td>
                                    <td>{{ $invoices->email }}</td>
                                    <td>@if($invoices->telephone != "") {{ $invoices->telephone }} @else - @endif</td>
                                    <td>{{ $invoices->total_cost }}</td>
                                    <td>{{ date('d-M-Y', strtotime($invoices->date)) }}</td>
                                    @if($invoices->payment == 2) <td style="color: green; font-weight: bold;">PAID</td> @else <td style="color: red; font-weight: bold;">NOT PAID</td> @endif
                                    <td align="center"><a title="View to print" href="/invoicereport/{{ $invoices->estimate_id }}" style="text-decoration: none; color: green; font-size: 18px; text-align: center;" target="_blank"><i title="View to print" class="fas fa-file-signature"></i></a></td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                    <tr align="center"><td colspan="8">No record</td></tr>
                    @endif
                </tbody>
            </table>
          </div>
        </div>
    </div>

    {{-- End Invoices --}}

    {{-- End Invoices Record --}}

  </div>
  <div class="tab-pane fade" id="receievepayment" role="tabpanel" aria-labelledby="receievepayment-tab">
      {{-- Start Receive Payment Record Form --}}

      {{-- Start Receive Payment --}}

      <div class="card">

        <div id="collapsereceivepayment" class="collapse show" aria-labelledby="headingreceivepayment" data-parent="#accordion">
          <div class="card-body">

    <h4 class="text-center" style="color: darkblue;">Outstanding Invoices <img class="spinnerChecker disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;" align="right"><img class="spinnerdiagChecker disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;" align="right"></h4> <hr>
        <div class="row m-t-20">

            <div class="col-md-4">
                <h6>Specify Payment Type</h6>
                <input type="hidden" name="outstand_val" id="outstand_val" value="" class="form-control">
                <select class="form-control" name="spec_payment_type" id="spec_payment_type">
                    <option value="">Select One</option>
                    <option value="Diagnostics">Diagnostics</option>
                    <option value="Completed Works">Completed Works</option>
                </select>
            </div>
            <div class="col-md-4 diag_date disp-0">
                <h6>Find Licence</h6>
                <input type="text" name="diag_search_licence" id="diag_pay_search_licence" class="form-control">
            </div>

            <div class="col-md-4 diag_date disp-0">
                <h6>&nbsp;</h6>
                <button class="btn btn-primary btn-block" onclick="fetchdiagInvoice()">Get Data</button>
            </div>

            <div class="col-md-4 spec_date disp-0">
                <h6>Find Licence</h6>
                <input type="text" name="spec_search_licence" id="spec_pay_search_licence" class="form-control">
            </div>

            <div class="col-md-4 spec_date disp-0">
                <h6>&nbsp;</h6>
                <button class="btn btn-primary btn-block" onclick="fetchInvoice()">Get Data</button>
            </div>


    </div>

        <div class="row m-t-20 recsPay disp-0">
            <hr>
            <div class="col-md-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr style="font-size: 13px; text-align: center;">
                            <th>#</th>
                            <th>Vehicle Licenc</th>
                            <th>Date</th>
                            <th>Service Option</th>
                            <th>Service Type</th>
                            <th>Total Cost</th>
                            <th>Get Data</th>
                        </tr>
                    </thead>
                    <tbody id="payRecs">

                    </tbody>
                </table>
            </div>

        </div>
    <hr>
    <div class="row m-t-20">
            <div class="col-md-3">
                <h6>Vehicle Licence</h6>
                <input type="text" name="vehicle_licence" id="pay_licence" class="form-control">
            </div>
            <div class="col-md-3">
                <h6>Maintenance Date</h6>
                <input type="date" name="maintenace_date" id="pay_maintenace_date" class="form-control">
            </div>
            <div class="col-md-3">
                <h6>Service Option</h6>
                <input type="text" name="service_option" id="pay_service_option" class="form-control">
            </div>
            <div class="col-md-3">
                <h6>Service Type</h6>
                <input type="text" name="service_type" id="pay_service_type" class="form-control">
            </div>
    </div>
    <div class="row m-t-20">
            <div class="col-md-4">
                <h6>Total Bill Amount</h6>
                <input type="number" name="total_bill_amount" id="pay_total_bill_amount" class="form-control">
            </div>
            <div class="col-md-4">
                <h6>Deposit Made</h6>
                <input type="number" name="deposit_made" id="pay_deposit_made" class="form-control">
            </div>
            <div class="col-md-4">
                <h6>Balance</h6>
                <input type="number" name="additional_payment" id="pay_additional_payment" class="form-control">
            </div>
    </div>
    <br>
    <h4 class="text-center" style="color: darkblue;">Cash Payment</h4> <hr>
    <div class="row m-t-20">
    <div class="col-md-12">
        <h6>Cash Payment</h6>
        <input type="number" name="cash_payment" id="pay_cash_payment" class="form-control">
    </div>
    </div>
    <hr>
    <h4 class="text-center" style="color: darkblue;">Cheque Payment</h4> <hr>
    <div class="row m-t-20">
            <div class="col-md-4">
                <h6>Cheque Payment Number</h6>
                <input type="text" name="cheque_payment_number" id="pay_cheque_payment_number" class="form-control">
            </div>
            <div class="col-md-4">
                <h6>Cheque Payment Date</h6>
                <input type="date" name="cheque_payment_date" id="pay_cheque_payment_date" class="form-control">
            </div>
            <div class="col-md-4">
                <h6>Cheque Payment Amount</h6>
                <input type="number" name="cheque_payment_amount" id="pay_cheque_payment_amount" class="form-control">
            </div>
    </div>

    <br>
    <h4 class="text-center" style="color: darkblue;">Credit Card (MC/VC/Others)</h4> <hr>
    <div class="row m-t-20">
            <div class="col-md-4">
                <h6>Card Number</h6>
                <input type="text" name="card_number" id="pay_card_number" class="form-control">
            </div>
            <div class="col-md-4">
                <h6>Expiry Date</h6>
                <input type="number" name="cc" id="pay_cc" class="form-control" placeholder="MMYY">
            </div>
            <div class="col-md-4">
                <h6>Card Amount</h6>
                <input type="number" name="card_amount" id="pay_card_amount" class="form-control">
            </div>
    </div>

    <div class="row m-t-20">
            <div class="col-md-4">
                <h6>Total Payment Made</h6>
                <input type="number" name="total_payment_made" id="pay_total_payment_made" class="form-control">
            </div>

            <div class="col-md-4">
                <h6>&nbsp;</h6>
                <button class="btn btn-primary btn-block" onclick="processPay('payment')">Process Payment <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
            </div>
            <div class="col-md-4">
                <h6>&nbsp;</h6>
                <button class="btn btn-danger btn-block" onclick="processPay('cancel')">Cancel </button>
            </div>
    </div>

          </div>
        </div>
      </div>

      {{-- End Receive Payment --}}

      {{-- End Receive Payment Record Form --}}
  </div>
  <div class="tab-pane fade" id="paidinvoices" role="tabpanel" aria-labelledby="paidinvoices-tab">

    {{-- Start Paid Invoice Record Form --}}

    {{-- Start View Paid Invoices --}}

      <div class="card">

        <div id="collapseviewpaidinvoices" class="collapse show" aria-labelledby="headingviewpaidinvoices" data-parent="#accordion">

          <div class="card-body">

            <table class="table table-striped table-bordered" id="invoicingPaid">
                <thead>
                    <tr style="font-size: 12px;">
                        <th>#</th>
                        <th>Licence</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Total Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($invoice) > 0)
                    <?php $i=1;?>
                        @foreach($invoice as $invoices)
                            @if($invoices->payment != 0 && $invoices->payment == 2)
                                <tr style="font-size: 12px;">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $invoices->vehicle_licence }}</td>
                                    <td>{{ $invoices->email }}</td>
                                    <td>@if($invoices->telephone != "") {{ $invoices->telephone }} @else - @endif</td>
                                    <td>{{ $invoices->total_cost }}</td>
                                    <td>{{ date('d-M-Y', strtotime($invoices->date)) }}</td>
                                    @if($invoices->payment == 2) <td style="color: green; font-weight: bold;">PAID</td> @else <td style="color: red; font-weight: bold;">NOT PAID</td> @endif
                                    <td align="center"><a title="View to print" href="/invoicereport/{{ $invoices->estimate_id }}" style="text-decoration: none; color: green; font-size: 18px; text-align: center;" target="_blank"><i title="View to print" class="fas fa-file-signature"></i></a></td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                    <tr align="center"><td colspan="8">No record</td></tr>
                    @endif
                </tbody>
            </table>

          </div>
        </div>
    </div>

    {{-- End View Paid Invoices --}}

    {{-- End Paid Invoice Record Form --}}

  </div>
  <div class="tab-pane fade" id="unpaidinvoices" role="tabpanel" aria-labelledby="unpaidinvoices-tab">
      {{-- Start Unpaid Invoice Record Form --}}

      {{-- Start View Unpaid Invoices --}}

        <div class="card">

        <div id="collapseunpaidinvoices" class="collapse show" aria-labelledby="headingunpaidinvoices" data-parent="#accordion">
          <div class="card-body">

            <table class="table table-striped table-bordered" id="invoicingunPaid">
                <thead>
                    <tr style="font-size: 12px;">
                        <th>#</th>
                        <th>Licence</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Total Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($invoice) > 0)
                    <?php $i=1;?>
                        @foreach($invoice as $invoices)
                            @if($invoices->payment != 0 && $invoices->payment == 1)
                                <tr style="font-size: 12px;">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $invoices->vehicle_licence }}</td>
                                    <td>{{ $invoices->email }}</td>
                                    <td>@if($invoices->telephone != "") {{ $invoices->telephone }} @else - @endif</td>
                                    <td>{{ $invoices->total_cost }}</td>
                                    <td>{{ date('d-M-Y', strtotime($invoices->date)) }}</td>
                                    @if($invoices->payment == 2) <td style="color: green; font-weight: bold;">PAID</td> @else <td style="color: red; font-weight: bold;">NOT PAID</td> @endif
                                    <td align="center"><a title="View to print" href="/invoicereport/{{ $invoices->estimate_id }}" style="text-decoration: none; color: green; font-size: 18px; text-align: center;" target="_blank"><i title="View to print" class="fas fa-file-signature"></i></a></td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                    <tr align="center"><td colspan="8">No record</td></tr>
                    @endif
                </tbody>
            </table>

          </div>
        </div>
    </div>

    {{-- End View Unpaid Invoices --}}

    {{-- End Unpaid Invoice Record Form --}}
  </div>
</div>


{{-- End Revenue Menu --}}


</div>



@endif


{{-- End Revenue --}}







{{-- Start Expenditure --}}


@if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")

<div class="tab-pane fade" id="expenditure" role="tabpanel" aria-labelledby="expenditure-tab">

{{-- Start Expenditure Menu --}}


<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="vendorinvoices-tab" data-toggle="tab" href="#vendorinvoices" role="tab" aria-controls="vendorinvoices" aria-selected="true">Vendor Invoices</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="vendorsunpaid-tab" data-toggle="tab" href="#vendorsunpaid" role="tab" aria-controls="vendorsunpaid" aria-selected="false">Vendors Unpaid Invoices</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="vendorspaid-tab" data-toggle="tab" href="#vendorspaid" role="tab" aria-controls="vendorspaid" aria-selected="false">Vendors Paid Invoices</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" id="vendorstatement-tab" data-toggle="tab" href="#vendorstatement" role="tab" aria-controls="vendorstatement" aria-selected="false">Vendors Statement</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="technicianpayschedule-tab" data-toggle="tab" href="#technicianpayschedule" role="tab" aria-controls="technicianpayschedule" aria-selected="false">Technician Pay Schedule</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" id="technicianpaystub-tab" data-toggle="tab" href="#technicianpaystub" role="tab" aria-controls="technicianpaystub" aria-selected="false">Technician Pay Stub</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" id="technicianunpaidwork-tab" data-toggle="tab" href="#technicianunpaidwork" role="tab" aria-controls="technicianunpaidwork" aria-selected="false">Technician Unpaid work</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="technicianpaidwork-tab" data-toggle="tab" href="#technicianpaidwork" role="tab" aria-controls="technicianpaidwork" aria-selected="false">Technician Paid work</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" id="technicianpayhistory-tab" data-toggle="tab" href="#technicianpayhistory" role="tab" aria-controls="technicianpayhistory" aria-selected="false">Technician Payment History</a>
  </li>

</ul>
<div class="tab-content" id="myTabContent">

  <div class="tab-pane fade show active" id="vendorinvoices" role="tabpanel" aria-labelledby="vendorinvoices-tab">
      {{-- Start Vendor Invoice Payment Record --}}

      {{-- Start Vendor Invoices --}}

        <div class="card">

        <div id="collapsevendorinvoices" class="collapse show" aria-labelledby="headingvendorinvoices" data-parent="#accordion">
          <div class="card-body">

            <table class="table table-striped table-bordered" id="invoicingvendor">
                <thead>
                    <tr style="font-size: 12px;">
                        <th>#</th>
                        <th>Purchase Order #</th>
                        <th>Order Date</th>
                        <th>Expected Date</th>
                        <th>Inventory Item</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Total Cost</th>
                        <th>Shipping Cost</th>
                        <th>Discount</th>
                        <th>Tax</th>
                        <th>Total Amount</th>
                        <th>Payment Status</th>
                        <th>View invoice</th>
                    </tr>
                </thead>

                <tbody>
                    @if($purchaseOrder != "")
                    <?php $i=1;?>
                        @foreach($purchaseOrder as $purchaseOrders)
                                <tr style="font-size: 12px;">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_no }}</td>
                                    <td>{{ $purchaseOrders->order_date }}</td>
                                    <td>{{ $purchaseOrders->expected_date }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_inventory_item }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_qty }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_rate }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_totcost }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_shippingcost }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_discount }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_tax }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_totalpurchaseorder }}</td>
                                    @if($purchaseOrders->make_payment == 1) <td style="color: green; font-weight: bold;">PAID</td>  @else <td style="color: red; font-weight: bold;">NOT PAID</td> @endif

                                    @if($purchaseOrders->make_payment == 1) <td align="center"><a title="View invoice" href="/vendpaymentreport/{{ $purchaseOrders->post_id }}" style="text-decoration: none; color: green; font-size: 18px; text-align: center;" target="_blank"><i title="View to print" class="fas fa-file-signature"></i></a></td>  @else <td align="center"><a title="View invoice" href="/vendunpaidreport/{{ $purchaseOrders->post_id }}" style="text-decoration: none; color: green; font-size: 18px; text-align: center;" target="_blank"><i title="View to print" class="fas fa-file-signature"></i></a></td> @endif
                                </tr>
                        @endforeach
                    @else
                    <tr align="center"><td colspan="14">No record</td></tr>
                    @endif
                </tbody>
            </table>

          </div>
        </div>
    </div>

    {{-- End Vendor Invoices --}}


      {{-- End Vendor Invoice Payment Record --}}
  </div>



  {{-- Start Vendor Unpaid Invoice --}}


  <div class="tab-pane fade" id="vendorsunpaid" role="tabpanel" aria-labelledby="vendorsunpaid-tab">
      {{-- Start Vendor Unpaid Invoice Record --}}

      {{-- Start Vendor Unpaid Invoice --}}

        <div class="card">

        <div id="collapsevendorsunpaid" class="collapse show" aria-labelledby="headingvendorsunpaid" data-parent="#accordion">
          <div class="card-body">

            <table class="table table-striped table-bordered" id="invoicingunpaidvendor">
                <thead>
                    <tr style="font-size: 12px;">
                        <th>#</th>
                        <th>Purchase Order #</th>
                        <th>Order Date</th>
                        <th>Expected Date</th>
                        <th>Inventory Item</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Total Cost</th>
                        <th>Shipping Cost</th>
                        <th>Discount</th>
                        <th>Tax</th>
                        <th>Total Amount</th>
                        <th>View invoice</th>
                    </tr>
                </thead>

                <tbody>
                    @if($purchaseOrder != "")
                    <?php $i=1;?>
                        @foreach($purchaseOrder as $purchaseOrders)

                        @if($purchaseOrders->make_payment == 0)

                            <tr style="font-size: 12px;">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_no }}</td>
                                    <td>{{ $purchaseOrders->order_date }}</td>
                                    <td>{{ $purchaseOrders->expected_date }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_inventory_item }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_qty }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_rate }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_totcost }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_shippingcost }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_discount }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_tax }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_totalpurchaseorder }}</td>
                                    <td align="center"><a title="View invoice" href="/vendunpaidreport/{{ $purchaseOrders->post_id }}" style="text-decoration: none; color: green; font-size: 18px; text-align: center;" target="_blank"><i title="View to print" class="fas fa-file-signature"></i></a></td>
                                </tr>

                        @endif

                        @endforeach
                    @else
                    <tr align="center"><td colspan="13">No record</td></tr>
                    @endif
                </tbody>
            </table>

          </div>
        </div>
    </div>

    {{-- End Vendor Unpaid Invoice --}}


      {{-- End Vendor Unpaid Invoice Record --}}
  </div>

  {{-- End Vendor Unpaid Invoice --}}




  {{-- Start Vendor Paid Invoices --}}


    {{-- Start Vendor Paid Invoices --}}


  <div class="tab-pane fade" id="vendorspaid" role="tabpanel" aria-labelledby="vendorspaid-tab">
      {{-- Start Vendor Paid Invoices Record --}}

        <div class="card">

        <div id="collapsevendorspaid" class="collapse show" aria-labelledby="headingvendorspaid" data-parent="#accordion">
          <div class="card-body">

            <table class="table table-striped table-bordered" id="invoicingpaidvendor">
                <thead>
                    <tr style="font-size: 12px;">
                        <th>#</th>
                        <th>Purchase Order #</th>
                        <th>Order Date</th>
                        <th>Expected Date</th>
                        <th>Inventory Item</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Total Cost</th>
                        <th>Shipping Cost</th>
                        <th>Discount</th>
                        <th>Tax</th>
                        <th>Total Amount</th>
                        <th>View invoice</th>
                    </tr>
                </thead>

                <tbody>
                    @if($purchaseOrder != "")
                    <?php $i=1;?>
                        @foreach($purchaseOrder as $purchaseOrders)

                        @if($purchaseOrders->make_payment == 1)

                            <tr style="font-size: 12px;">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_no }}</td>
                                    <td>{{ $purchaseOrders->order_date }}</td>
                                    <td>{{ $purchaseOrders->expected_date }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_inventory_item }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_qty }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_rate }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_totcost }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_shippingcost }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_discount }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_tax }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_totalpurchaseorder }}</td>
                                    <td align="center"><a title="View invoice" href="/vendpaymentreport/{{ $purchaseOrders->post_id }}" style="text-decoration: none; color: green; font-size: 18px; text-align: center;" target="_blank"><i title="View to print" class="fas fa-file-signature"></i></a></td>
                                </tr>

                        @endif

                        @endforeach
                    @else
                    <tr align="center"><td colspan="13">No record</td></tr>
                    @endif
                </tbody>
            </table>

          </div>
        </div>
    </div>

      {{-- End Vendor Paid Invoices Record --}}
  </div>

  {{-- End Vendor Paid Invoices --}}



  {{-- End Vendor Paid Invoices --}}




  {{-- Start Vendor Statement --}}


  <div class="tab-pane fade" id="vendorstatement" role="tabpanel" aria-labelledby="vendorstatement-tab">
      {{-- Start Vendor Statement Record --}}

        <div class="card">

        <div id="collapsevendorstatement" class="collapse show" aria-labelledby="headingvendorstatement" data-parent="#accordion">
          <div class="card-body">

            <table class="table table-striped table-bordered" id="invoicingstatement">
                <thead>
                    <tr style="font-size: 12px;">
                        <th>#</th>
                        <th>Purchase Order #</th>
                        <th>Order Date</th>
                        <th>Expected Date</th>
                        <th>Inventory Item</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>View statement</th>
                    </tr>
                </thead>

                <tbody>
                    @if($purchaseOrder != "")
                    <?php $i=1;?>
                        @foreach($purchaseOrder as $purchaseOrders)
                            <tr style="font-size: 12px;">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_no }}</td>
                                    <td>{{ $purchaseOrders->order_date }}</td>
                                    <td>{{ $purchaseOrders->expected_date }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_inventory_item }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_qty }}</td>
                                    <td>{{ $purchaseOrders->purchase_order_rate }}</td>
                                    @if($purchaseOrders->make_payment == 1) <td align="center"><a title="View invoice" href="/vendpaymentreport/{{ $purchaseOrders->post_id }}" style="text-decoration: none; color: green; font-size: 18px; text-align: center;" target="_blank"><i title="View to print" class="fas fa-file-signature"></i></a></td> @else <td align="center"><a title="View invoice" href="/vendunpaidreport/{{ $purchaseOrders->post_id }}" style="text-decoration: none; color: red; font-size: 18px; text-align: center;" target="_blank"><i title="View to print" class="fas fa-file-signature"></i></a></td> @endif

                                </tr>

                        @endforeach
                    @else
                    <tr align="center"><td colspan="8">No record</td></tr>
                    @endif
                </tbody>
            </table>

          </div>
        </div>
    </div>

      {{-- End Vendor Statement Record --}}
  </div>


  {{-- End Vendor Statement --}}




{{-- Start Technician Pay Schedule --}}


  <div class="tab-pane fade" id="technicianpayschedule" role="tabpanel" aria-labelledby="technicianpayschedule-tab">
      {{-- Start Vendor Statement Record --}}

        <div class="card">

        <div id="collapsetechnicianpayschedule" class="collapse show" aria-labelledby="headingtechnicianpayschedule" data-parent="#accordion">
          <div class="card-body">

            <table class="table table-striped table-bordered" id="technicianpayschedule">
                <thead>
                    <tr style="font-size: 12px;">
                        <th>#</th>
                        <th>Technician</th>
                        <th>Work Done</th>
                        <th>Hour</th>
                        <th>Rate</th>
                        <th>Total Amount</th>
                        <th>View more</th>
                    </tr>
                </thead>

                <tbody>
                    @if($payschedules != "")
                    <?php $i=1;?>
                        @foreach($payschedules as $payscheduless)
                            <tr style="font-size: 12px;">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $payscheduless->technician }}</td>
                                    <td>{{ $payscheduless->service_option.' was carried out for '.$payscheduless->service_type.' purpose on '.$payscheduless->licence }}</td>
                                    <td>@if($payscheduless->hour != "") {{ $payscheduless->hour }}  @else <span style="color: red; font-weight: bold;">PENDING MOVE TO SCHEDULE</span> @endif </td>
                                    <td>@if($payscheduless->rate != "") {{ $payscheduless->rate }} @else <span style="color: red; font-weight: bold;">PENDING MOVE TO SCHEDULE</span> @endif </td>
                                    <td>@if($payscheduless->total_amount != ""){{ $payscheduless->total_amount }} @else <span style="color: red; font-weight: bold;">PENDING MOVE TO SCHEDULE</span> @endif </td>
                                    <td align="center"><a title="View more" href="/technicianreport/{{ $payscheduless->estimate_id }}" style="text-decoration: none; color: green; font-size: 18px; text-align: center;" target="_blank"><i title="View to print" class="fas fa-file-signature"></i></a></td>

                                </tr>

                        @endforeach
                    @else
                    <tr align="center"><td colspan="7">No record</td></tr>
                    @endif
                </tbody>
            </table>

          </div>
        </div>
    </div>

      {{-- End Vendor Statement Record --}}
  </div>

  {{-- End Technician Pay Schedule --}}





  {{-- Start Technician Pay Stub --}}

  <div class="tab-pane fade" id="technicianpaystub" role="tabpanel" aria-labelledby="technicianpaystub-tab">
      {{-- Start Technician Pay Stub Record --}}

        <div class="card">

        <div id="collapsetechnicianpaystub" class="collapse show" aria-labelledby="headingtechnicianpaystub" data-parent="#accordion">
          <div class="card-body">

            <table class="table table-striped table-bordered" id="technicianpaystub">
                <thead>
                    <tr style="font-size: 12px;">
                        <th>#</th>
                        <th>Technician</th>
                        <th>Work Done</th>
                        <th>Hour</th>
                        <th>Rate</th>
                        <th>Total Amount</th>
                        <th>View more</th>
                    </tr>
                </thead>

                <tbody>
                    @if($payschedules != "")
                    <?php $i=1;?>
                        @foreach($payschedules as $payscheduless)

                        @if($payscheduless->pay_stub == 1)

                            <tr style="font-size: 12px;">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $payscheduless->technician }}</td>
                                    <td>{{ $payscheduless->service_option.' was carried out for '.$payscheduless->service_type.' purpose on '.$payscheduless->licence }}</td>
                                    <td>@if($payscheduless->hour != "") {{ $payscheduless->hour }}  @else <span style="color: red; font-weight: bold;">PENDING MOVE TO SCHEDULE</span> @endif </td>
                                    <td>@if($payscheduless->rate != "") {{ $payscheduless->rate }} @else <span style="color: red; font-weight: bold;">PENDING MOVE TO SCHEDULE</span> @endif </td>
                                    <td>@if($payscheduless->total_amount != ""){{ $payscheduless->total_amount }} @else <span style="color: red; font-weight: bold;">PENDING MOVE TO SCHEDULE</span> @endif </td>
                                    <td align="center"><a title="View more" href="/technicianreport/{{ $payscheduless->estimate_id }}" style="text-decoration: none; color: green; font-size: 18px; text-align: center;" target="_blank"><i title="View to print" class="fas fa-file-signature"></i></a></td>

                                </tr>

                        @endif



                        @endforeach
                    @else
                    <tr align="center"><td colspan="7">No record</td></tr>
                    @endif
                </tbody>
            </table>

          </div>
        </div>
    </div>

      {{-- End Technician Pay Stub Record --}}
  </div>

  {{-- End Technician Pay Stub --}}



{{-- Start Technician Unpaid Work --}}


  <div class="tab-pane fade" id="technicianunpaidwork" role="tabpanel" aria-labelledby="technicianunpaidwork-tab">
      {{-- Start Technician Unpaid Work Record --}}

        <div class="card">

        <div id="collapsetechnicianunpaidwork" class="collapse show" aria-labelledby="headingtechnicianunpaidwork" data-parent="#accordion">
          <div class="card-body">

            <table class="table table-striped table-bordered" id="technicianunpaidwork">
                <thead>
                    <tr style="font-size: 12px;">
                        <th>#</th>
                        <th>Technician</th>
                        <th>Work Done</th>
                        <th>Hour</th>
                        <th>Rate</th>
                        <th>Total Amount</th>
                        <th>View more</th>
                    </tr>
                </thead>

                <tbody>
                    @if($payschedules != "")
                    <?php $i=1;?>
                        @foreach($payschedules as $payscheduless)

                        @if($payscheduless->pay_stub != 2)

                            <tr style="font-size: 12px;">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $payscheduless->technician }}</td>
                                    <td>{{ $payscheduless->service_option.' was carried out for '.$payscheduless->service_type.' purpose on '.$payscheduless->licence }}</td>
                                    <td>@if($payscheduless->hour != "") {{ $payscheduless->hour }}  @else <span style="color: red; font-weight: bold;">PENDING MOVE TO SCHEDULE</span> @endif </td>
                                    <td>@if($payscheduless->rate != "") {{ $payscheduless->rate }} @else <span style="color: red; font-weight: bold;">PENDING MOVE TO SCHEDULE</span> @endif </td>
                                    <td>@if($payscheduless->total_amount != ""){{ $payscheduless->total_amount }} @else <span style="color: red; font-weight: bold;">PENDING MOVE TO SCHEDULE</span> @endif </td>
                                    <td align="center"><a title="View more" href="/technicianreport/{{ $payscheduless->estimate_id }}" style="text-decoration: none; color: green; font-size: 18px; text-align: center;" target="_blank"><i title="View to print" class="fas fa-file-signature"></i></a></td>

                                </tr>

                        @endif



                        @endforeach
                    @else
                    <tr align="center"><td colspan="7">No record</td></tr>
                    @endif
                </tbody>
            </table>

          </div>
        </div>
    </div>

      {{-- End Technician Unpaid Work Record --}}
  </div>

{{-- End Technician Unpaid Work --}}



{{-- Start Technician Paid --}}



  <div class="tab-pane fade" id="technicianpaidwork" role="tabpanel" aria-labelledby="technicianpaidwork-tab">
      {{-- Start Technician Paid Record --}}

        <div class="card">

        <div id="collapsetechnicianpaidwork" class="collapse show" aria-labelledby="headingtechnicianpaidwork" data-parent="#accordion">
          <div class="card-body">

            <table class="table table-striped table-bordered" id="technicianpaidwork">
                <thead>
                    <tr style="font-size: 12px;">
                        <th>#</th>
                        <th>Technician</th>
                        <th>Work Done</th>
                        <th>Hour</th>
                        <th>Rate</th>
                        <th>Total Amount</th>
                        <th>View more</th>
                    </tr>
                </thead>

                <tbody>
                    @if($techpayStub != "")
                    <?php $i=1;?>
                        @foreach($techpayStub as $techpayStubs)


                            <tr style="font-size: 12px;">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $techpayStubs->technician }}</td>
                                    <td>{{ $techpayStubs->service_option.' was carried out for '.$techpayStubs->service_type.' purpose on '.$techpayStubs->licence }}</td>
                                    <td>@if($techpayStubs->hour != "") {{ $techpayStubs->hour }}  @else <span style="color: red; font-weight: bold;">PENDING MOVE TO SCHEDULE</span> @endif </td>
                                    <td>@if($techpayStubs->rate != "") {{ $techpayStubs->rate }} @else <span style="color: red; font-weight: bold;">PENDING MOVE TO SCHEDULE</span> @endif </td>
                                    <td>@if($techpayStubs->total_amount != ""){{ $techpayStubs->total_amount }} @else <span style="color: red; font-weight: bold;">PENDING MOVE TO SCHEDULE</span> @endif </td>
                                    <td align="center"><a title="View more" href="/technicianpaidreport/{{ $techpayStubs->estimate_id }}" style="text-decoration: none; color: green; font-size: 18px; text-align: center;" target="_blank"><i title="View to print" class="fas fa-file-signature"></i></a></td>

                                </tr>




                        @endforeach
                    @else
                    <tr align="center"><td colspan="7">No record</td></tr>
                    @endif
                </tbody>
            </table>

          </div>
        </div>
    </div>

      {{-- End Technician Paid Record --}}
  </div>

{{-- End Technician Paid --}}





{{-- Start Technicial History --}}


  <div class="tab-pane fade" id="technicianpayhistory" role="tabpanel" aria-labelledby="technicianpayhistory-tab">
      {{-- Start Technician Paid Record --}}

        <div class="card">

        <div id="collapsetechnicianpayhistory" class="collapse show" aria-labelledby="headingtechnicianpayhistory" data-parent="#accordion">
          <div class="card-body">

            <table class="table table-striped table-bordered" id="technicianpayhistorys">
                <thead>
                    <tr style="font-size: 12px;">
                        <th>#</th>
                        <th>Technician</th>
                        <th>Work Done</th>
                        <th>Hour</th>
                        <th>Rate</th>
                        <th>Total Amount</th>
                        <th>Payment Status</th>
                        <th>View more</th>
                    </tr>
                </thead>

                <tbody>
                    @if($payschedules != "")
                    <?php $i=1;?>
                        @foreach($payschedules as $payscheduless)

                            <tr style="font-size: 12px;">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $payscheduless->technician }}</td>
                                    <td>{{ $payscheduless->service_option.' was carried out for '.$payscheduless->service_type.' purpose on '.$payscheduless->licence }}</td>
                                    <td>@if($payscheduless->hour != "") {{ $payscheduless->hour }}  @else <span style="color: red; font-weight: bold;">PENDING MOVE TO SCHEDULE</span> @endif </td>
                                    <td>@if($payscheduless->rate != "") {{ $payscheduless->rate }} @else <span style="color: red; font-weight: bold;">PENDING MOVE TO SCHEDULE</span> @endif </td>
                                    <td>@if($payscheduless->total_amount != ""){{ $payscheduless->total_amount }} @else <span style="color: red; font-weight: bold;">PENDING MOVE TO SCHEDULE</span> @endif </td>

                                    @if($payscheduless->pay_stub == 2)<td style="color: green; font-weight: bold;">PAID</td>  @elseif($payscheduless->pay_stub == 1) <td style="color: darkblue; font-weight: bold;">MOVED TO PAY STUB</td> @else <td style="color: red; font-weight: bold;">NOT PAID</td> @endif

                                    @if($payscheduless->pay_stub == 2) <td align="center"><a title="View more" href="/technicianpaidreport/{{ $techpayStubs->estimate_id }}" style="text-decoration: none; color: green; font-size: 18px; text-align: center;" target="_blank"><i title="View to print" class="fas fa-file-signature"></i></a></td> @else <td align="center"><a title="View more" href="/technicianreport/{{ $payscheduless->estimate_id }}" style="text-decoration: none; color: green; font-size: 18px; text-align: center;" target="_blank"><i title="View to print" class="fas fa-file-signature"></i></a></td>   @endif

                                </tr>


                        @endforeach
                    @else
                    <tr align="center"><td colspan="8">No record</td></tr>
                    @endif
                </tbody>
            </table>

          </div>
        </div>
    </div>

      {{-- End Technician Paid Record --}}
  </div>


{{-- End Technicial History --}}



</div>

{{-- End Expenditure Menu --}}


</div>



@endif


{{-- End Expenditure --}}





{{-- Start Business Report --}}

@if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")

<div class="tab-pane fade" id="businessreport" role="tabpanel" aria-labelledby="businessreport-tab">

{{-- Start Menu For Business Report --}}

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="clientbalances-tab" data-toggle="tab" href="#clientbalances" role="tab" aria-controls="clientbalances" aria-selected="true">Client Balances</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="vendorbalances-tab" data-toggle="tab" href="#vendorbalances" role="tab" aria-controls="vendorbalances" aria-selected="false">Vendor Balances</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="labourbalances-tab" data-toggle="tab" href="#labourbalances" role="tab" aria-controls="labourbalances" aria-selected="false">Labour Balances</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="cashbalances-tab" data-toggle="tab" href="#cashbalances" role="tab" aria-controls="cashbalances" aria-selected="false">Cash Balances</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="creditcardbalances-tab" data-toggle="tab" href="#creditcardbalances" role="tab" aria-controls="creditcardbalances" aria-selected="false">Creditcard Balances</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="bankbalances-tab" data-toggle="tab" href="#bankbalances" role="tab" aria-controls="bankbalances" aria-selected="false">Bank Balances</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="clientbalances" role="tabpanel" aria-labelledby="clientbalances-tab">
    {{-- Start Client Balances Record --}}

    {{-- Start Client Balances --}}
        <div class="card">

        <div id="collapseclientbalances" class="collapse show" aria-labelledby="headingclientbalances" data-parent="#accordion">
          <div class="card-body">
                <table class="table table-striped table-bordered" id="clientBal">
                <thead>
                    <tr style="font-size: 13px;">
                        <th>#</th>
                        <th>Date Time</th>
                        <th>Client</th>
                        <th>Total Balance</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($clientBal) > 0)
                    <?php $i = 1;?>
                    @foreach($clientBal as $clientBals)

                    @if($clientBals->payment == 1)

                        <tr style="font-size: 13px;">
                            <td>{{ $i++ }}</td>
                            <td>{{ date('d-M-Y h:i A', strtotime($clientBals->created_at)) }}</td>

                           @if($getUser = \App\User::where('email', $clientBals->email)->get())
                            @if(count($getUser) > 0)
                                <td>{{ $getUser[0]->name }}</td>
                            @else
                                <td>{{ $clientBals->email }}</td>
                            @endif

                            @else
                            <td>{{ $clientBals->email }}</td>
                            @endif
                            <td>{{ number_format($clientBals->total_cost) }}</td>
                            {{-- This should update record maintenance to paid as 2 --}}
                            <td><a type="button" class="btn btn-default" onclick="viewBalance('clientBal', '{{ $clientBals->estimate_id }}')" style="color: darkblue; font-size: 12px; text-decoration: none;">Click to balance on vehicle <img class="spin{{ $clientBals->estimate_id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></a></td>
                        </tr>
                    @endif

                    @endforeach

                    @else
                    <tr align="center"><td colspan="5">No record</td></tr>
                    @endif
                </tbody>
            </table>
          </div>
        </div>
    </div>

    {{-- End Client Balances --}}

    {{-- End Client Balances Record --}}


  </div>
  <div class="tab-pane fade" id="vendorbalances" role="tabpanel" aria-labelledby="vendorbalances-tab">
      {{-- Start Vendor Balances Record --}}

      {{-- Start Vendor Balances --}}

      <div class="card">

        <div id="collapseviewpaidinvoices" class="collapse show" aria-labelledby="headingviewpaidinvoices" data-parent="#accordion">

          <div class="card-body">

            <table class="table table-striped table-bordered" id="vendorBal">
                <thead>
                    <tr style="font-size: 12px;">
                        <th>#</th>
                        <th>Date Time</th>
                        <th>Vendor Name</th>
                        <th>Item Purchased</th>
                        <th>Total Balance</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($vendorBal) > 0)
                    <?php $i=1;?>
                        @foreach($vendorBal as $vendorBals)
                            <tr style="font-size: 12px;">
                                <td>{{ $i++ }}</td>
                                <td>{{ date('d-M-Y h:i A') }}</td>
                                <td>{{ $vendorBals->vendor }}</td>
                                <td>{{ $vendorBals->item }}</td>
                                <td>{{ number_format($vendorBals->total, 2) }}</td>
                            </tr>
                        @endforeach

                    @else
                    <tr align="center"><td colspan="5">No record</td></tr>
                    @endif
                </tbody>
            </table>

          </div>
        </div>
    </div>

    {{-- End Vendor Balances --}}

      {{-- End Vendor Balances Record --}}

  </div>
  <div class="tab-pane fade" id="labourbalances" role="tabpanel" aria-labelledby="labourbalances-tab">

      {{-- Start Labour Balances Record --}}

       {{-- Start Labour Balances --}}

        <div class="card">

        <div id="collapselabourbalances" class="collapse show" aria-labelledby="headinglabourbalances" data-parent="#accordion">
          <div class="card-body">
                <table class="table table-striped table-bordered" id="labourBal">
                <thead>
                    <tr style="font-size: 13px;">
                        <th>#</th>
                        <th>Date Time</th>
                        <th>Name</th>
                        <th>Job Done</th>
                        <th>Total Balance</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($labourBal) > 0)
                    <?php $i= 1;?>
                    @foreach($labourBal as $labourBals)

                        @if($labourBals->work_order == 1 && $labourBals->technician_payment == 1)

                        <tr style="font-size: 13px;">
                            <td>{{ $i++ }}</td>
                            <td>{{ date('d-M-Y h:i A', strtotime($labourBals->created_at)) }}</td>

                            @if($getTech = \App\User::where('email', $labourBals->technician)->get())

                            @if(count($getTech) > 0)
                                <td>{{ $getTech[0]->name }}</td>
                                @else
                                <td>--</td>
                            @endif

                            @else
                            <td>--</td>
                            @endif
                                <td>{{ $labourBals->service_type }} on vehicle reg no: <b>{{ $labourBals->vehicle_licence }}</b>, and maintenance is a {{ $labourBals->service_option }} </td>

                            <td>{{ number_format($labourBals->labour_cost + $labourBals->labour_cost2) }}</td>
                            {{-- This should update estimate record of work order to paid as 2 --}}
                            <td><a type="button" class="btn btn-default" onclick="viewBalance('labourbal', '{{ $labourBals->estimate_id }}')" style="color: darkblue; font-size: 12px; text-decoration: none;">Click to see work order <img class="spin{{ $labourBals->estimate_id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></a></td>
                        </tr>

                        @else

                        @endif


                    @endforeach


                    @else
                    <tr align="center"><td colspan="6">No record</td></tr>
                    @endif
                </tbody>
            </table>

          </div>
        </div>
    </div>

    {{-- End Labour Balances --}}

      {{-- End Labour Balances Record --}}

  </div>
  <div class="tab-pane fade" id="cashbalances" role="tabpanel" aria-labelledby="cashbalances-tab">
      {{-- Start Cash Balance Record --}}

      {{-- Start cash Balances --}}

        <div class="card">

        <div id="collapsecashbalances" class="collapse show" aria-labelledby="headingcashbalances" data-parent="#accordion">
          <div class="card-body">

                <table class="table table-striped table-bordered" id="cashBal">
                <thead>
                    <tr style="font-size: 13px;">
                        <th>Date Time</th>
                        <th>Total Cash Received</th>
                        <th>Total Cash Paid</th>
                        <th>Cash Balance</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($cashBal) > 0)

                    @if($cashBal[0]->total == null)
                        <?php $total = 0;?>

                        @else
                        <?php $total = $cashBal[0]->total;?>
                    @endif

                    @if($cashBal[1]->total_cash == null)
                        <?php $total_cash = 0;?>

                        @else
                       <?php $total_cash = $cashBal[1]->total_cash;?>
                    @endif

                    @if($cashBal[2]->vehiclepay_total == null)
                        <?php $vehiclepay_total = 0;?>

                        @else
                        <?php $vehiclepay_total = $cashBal[2]->vehiclepay_total;?>
                    @endif

                        <tr style="font-size: 13px;">
                            <td>{{ date('d-M-Y h:i A') }}</td>
                            <td>{{ number_format($total + $vehiclepay_total) }}</td>
                            <td>{{ number_format($total_cash) }}</td>
                            <td>{{ number_format($total + $vehiclepay_total - $total_cash, 2)}}</td>

                            <td><a type="button" class="btn btn-default" onclick="viewBalance('cashbal', '{{ Auth::user()->busID }}')" style="color: darkblue; font-size: 12px; text-decoration: underline;">Click to view details <img class="spin{{ Auth::user()->busID }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></a></td>
                        </tr>
                    @else
                    <tr align="center"><td colspan="5">No record</td></tr>
                    @endif
                </tbody>
            </table>

          </div>
        </div>
    </div>

    {{-- End cash Balances --}}

      {{-- End Cash Balance Record --}}
  </div>
  <div class="tab-pane fade" id="creditcardbalances" role="tabpanel" aria-labelledby="creditcardbalances-tab">
      {{-- Start Credit Balance Record --}}

        {{-- Start creditcard Balances --}}

        <div class="card">

        <div id="collapsecreditcardbalances" class="collapse show" aria-labelledby="headingcreditcardbalances" data-parent="#accordion">
          <div class="card-body">

            <table class="table table-striped table-bordered" id="creditcardBal">
                <thead>
                    <tr style="font-size: 13px;">
                        <th>Date Time</th>
                        <th>Total Credit Card Received</th>
                        <th>Total Credit Card Paid</th>
                        <th>Credit Card Balance</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($creditcardBal) > 0)

                    @if($creditcardBal[0]->total == null)
                        <?php $total = 0;?>

                        @else
                        <?php $total = $creditcardBal[0]->total;?>
                    @endif

                    @if($creditcardBal[1]->total_cash == null)
                        <?php $total_cash = 0;?>

                        @else
                       <?php $total_cash = $creditcardBal[1]->total_cash;?>
                    @endif

                    @if($creditcardBal[2]->vehiclepay_total == null)
                        <?php $vehiclepay_total = 0;?>

                        @else
                        <?php $vehiclepay_total = $creditcardBal[2]->vehiclepay_total;?>
                    @endif

                        <tr style="font-size: 13px;">
                            <td>{{ date('d-M-Y h:i A') }}</td>
                            <td>{{ number_format($total + $vehiclepay_total) }}</td>
                            <td>{{ number_format($total_cash) }}</td>
                            <td>{{ number_format($total + $vehiclepay_total - $total_cash, 2)}}</td>

                            <td><a type="button" class="btn btn-default" onclick="viewBalance('creditcardBal', '{{ Auth::user()->busID }}')" style="color: darkblue; font-size: 12px; text-decoration: underline;">Click to view details <img class="spin{{ Auth::user()->busID }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></a></td>
                        </tr>
                    @else
                    <tr align="center"><td colspan="5">No record</td></tr>
                    @endif
                </tbody>
            </table>


          </div>
        </div>
    </div>

    {{-- End creditcard Balances --}}
      {{-- End Credit Balance Record --}}
  </div>
  <div class="tab-pane fade" id="bankbalances" role="tabpanel" aria-labelledby="bankbalances-tab">
      {{-- Start Bank Balance Record --}}

      {{-- Start bank Balances --}}

        <div class="card">

        <div id="collapsebankbalances" class="collapse show" aria-labelledby="headingbankbalances" data-parent="#accordion">
          <div class="card-body">
            <table class="table table-striped table-bordered" id="bankBal">
                <thead>
                    <tr style="font-size: 13px;">
                        <th>Date Time</th>
                        <th>Total Credit Card Received</th>
                        <th>Total Credit Card Paid</th>
                        <th>Credit Card Balance</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($bankBal) > 0)

                    @if($bankBal[0]->total == null)
                        <?php $total = 0;?>

                        @else
                        <?php $total = $bankBal[0]->total;?>
                    @endif

                    @if($bankBal[1]->total_cash == null)
                        <?php $total_cash = 0;?>

                        @else
                       <?php $total_cash = $bankBal[1]->total_cash;?>
                    @endif

                    @if($bankBal[2]->vehiclepay_total == null)
                        <?php $vehiclepay_total = 0;?>

                        @else
                        <?php $vehiclepay_total = $bankBal[2]->vehiclepay_total;?>
                    @endif

                        <tr style="font-size: 13px;">
                            <td>{{ date('d-M-Y h:i A') }}</td>
                            <td>{{ number_format($total + $vehiclepay_total) }}</td>
                            <td>{{ number_format($total_cash) }}</td>
                            <td>{{ number_format($total + $vehiclepay_total - $total_cash, 2)}}</td>

                            <td><a type="button" class="btn btn-default" onclick="viewBalance('bankBal', '{{ Auth::user()->busID }}')" style="color: darkblue; font-size: 12px; text-decoration: underline;">Click to view details <img class="spin{{ Auth::user()->busID }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></a></td>
                        </tr>
                    @else
                    <tr align="center"><td colspan="5">No record</td></tr>
                    @endif
                </tbody>
            </table>

          </div>
        </div>
    </div>

    {{-- End bank Balances --}}

      {{-- End Bank Balance Record --}}
  </div>
</div>


{{-- End Menu For Business Report --}}

</div>



@endif
{{-- End Business Report --}}



<div class="tab-pane fade" id="financials" role="tabpanel" aria-labelledby="financials-tab">
  @if (Auth::user()->userType == "Commercial")

  <br>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer") data-step="3" data-intro="Vimfile help you track how profitable your driving business. You can also track the taxes deductions and claims by providing
required information on regular basis." @elseif(Auth::user()->userType == "Commercial") data-step="3" data-intro="Vimfile help you track how profitable your driving business. You can also track the taxes deductions and claims by providing
required information on regular basis." @endif>
    <a class="nav-link active" id="trackfinancial-tab" data-toggle="tab" href="#trackfinancial" role="tab" aria-controls="trackfinancial" aria-selected="true">Track your financial</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="financialreport-tab" data-toggle="tab" href="#financialreport" role="tab" aria-controls="financialreport" aria-selected="false">Want detailed financial report from an accountant?</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="trackfinancial" role="tabpanel" aria-labelledby="trackfinancial-tab">

      {{-- Start TRack Financial --}}

            <div class="card">
    <div id="financialcollapse" class="collapse show" aria-labelledby="financialHead" data-parent="#accordion">
      <div class="card-body">
        <div class="itembody">
            <h3 style="font-weight: bold; text-align: center;">Update your Financial Report</h3> <hr>

            <div class="row">
                <div class="col-md-3 mt-2">
                   <p style="font-weight: 600;">Applicable tax in %</p>
                </div>
                <div class="col-md-6">
                    <input type="number" name="applicable_tax" id="applicable_tax" class="form-control">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-sm btn-primary" onclick="financial('applicable_tax', '{{ Auth::user()->id }}')">Post <img class="spinnerapplicable_tax{{ Auth::user()->id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
            </div> <br>

            <div class="row">
                <div class="col-md-3 mt-4">
                   <p style="font-weight: 600;">Post Earnings (tax inclusive)</p>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Start Date</label>
                            <input style="font-size: 12px !important;" type="date" name="startearn_date" id="startearn_date" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label>End Date</label>
                            <input style="font-size: 12px !important;" type="date" name="endearn_date" id="endearn_date" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label>Earnings</label>
                            <input style="font-size: 12px !important;" type="number" name="post_earnings" id="post_earnings" class="form-control">
                        </div>
                        {{-- <div class="col-sm-3">
                            <label>Tax</label>
                            <input style="font-size: 12px !important;" type="number" name="tax_earnings" id="tax_earnings" class="form-control">
                        </div> --}}
                    </div>
                </div>
                <div class="col-md-3 mt-4">
                    <button class="btn btn-sm btn-primary" onclick="financial('post_earnings', '{{ Auth::user()->id }}')">Post <img class="spinnerpost_earnings{{ Auth::user()->id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
            </div> <br>

            <div class="row">
                <div class="col-md-3 mt-4">
                   <p style="font-weight: 600;">Post Mileage</p>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Start Date</label>
                            <input style="font-size: 12px !important;" type="date" name="startmile_date" id="startmile_date" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>End Date</label>
                            <input style="font-size: 12px !important;" type="date" name="endmile_date" id="endmile_date" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>Mileage</label>
                            <input style="font-size: 12px !important;" type="number" name="mile_posts" id="mile_posts" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-4">
                    <button class="btn btn-sm btn-primary" onclick="financial('mile_posts', '{{ Auth::user()->id }}')">Post <img class="spinnermile_posts{{ Auth::user()->id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
            </div> <br>


            <div class="row disp-0">
                <div class="col-md-3 mt-4">
                   <p style="font-weight: 600;">Average Earnings per month</p>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Start Date</label>
                            <input style="font-size: 13px !important;" type="date" name="start_date" id="start_date" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>End Date</label>
                            <input style="font-size: 13px !important;" type="date" name="end_date" id="end_date" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>Earnings</label>
                            <input style="font-size: 13px !important;" type="number" name="avg_earnings" id="avg_earnings" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-4">
                    <button class="btn btn-sm btn-primary" onclick="financial('avg_earnings', '{{ Auth::user()->id }}')">Post <img class="spinneravg_earnings{{ Auth::user()->id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
            </div> <br>

            {{-- <div class="row">
                <div class="col-md-3 mt-2">
                   <p style="font-weight: 600;">Total Earnings</p>
                </div>
                <div class="col-md-6">
                    <input type="number" name="tot_earnings" id="tot_earnings" class="form-control">
                </div>
                <div class="col-md-3 mt-2">
                    <button class="btn btn-sm btn-primary" onclick="financial('tot_earnings', '{{ Auth::user()->id }}')">Post <img class="spinnertot_earnings{{ Auth::user()->id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
            </div> <br> --}}

        </div>
      </div>
    </div>
  </div>

      {{-- End TRack Financial --}}
  </div>
  <div class="tab-pane fade" id="financialreport" role="tabpanel" aria-labelledby="financialreport-tab">

    {{-- STart Financial Report  --}}
      <div class="card">
        <br>
    <div id="collapseSix" class="collapse show" aria-labelledby="headingSix" data-parent="#accordion">
        <h3 style="font-weight: bold; text-align: center;">Click for FREE Consultation</h3> <hr>
      <div class="card-body">
        <div class="itembody">
            {{-- <h3 style="font-weight: bold; text-align: center;">Upload Your Statements</h3> <hr>
            <div class="row">
                <div class="col-md-3 mt-2">
                    <p style="font-weight: 600;">Bank Statements</p>
                </div>
                <div class="col-md-6">
                    <input type="file" name="bankstatement" id="bankstatement" class="form-control">
                </div>
                <div class="col-md-3 mt-2">
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="val" value="bankstatement">
                    <button class="btn btn-sm btn-secondary" onclick="uploadDocs('bankstatement', '{{ Auth::user()->id }}')">Upload <img class="spinnerbank{{ Auth::user()->id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
            </div> <br> --}}

            {{-- <div class="row">
                <div class="col-md-3 mt-2">
                   <p style="font-weight: 600;">Credit Cards Statements</p>
                </div>
                <div class="col-md-6">
                    <input type="file" name="creditcards" id="creditcards" class="form-control">
                </div>
                <div class="col-md-3 mt-2">
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="val" value="creditcards">
                    <button class="btn btn-sm btn-secondary" onclick="uploadDocs('creditcards', '{{ Auth::user()->id }}')">Upload <img class="spinnercredit{{ Auth::user()->id }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
            </div> --}}

            <a type="button" class="btn btn-primary btn-block" href="https://jscglobalaccountingservices.com/Consultation" target="_blank">Free Consultation</a>
        </div>
      </div>
    </div>
  </div>
    {{-- End Financial Report  --}}

  </div>
</div>

  @endif


</div>




  {{-- Start Appointment Here --}}
  <div class="tab-pane fade" id="myappointment" role="tabpanel" aria-labelledby="myappointment-tab">
      {{-- Start My Appointment --}}

        <div class="table table-responsive">
          <table class="table table-striped table-bordered">
              <thead>
                  <tr style="font-size: 13px;">
                      <th>#</th>
                      <th>Booking code</th>
                      <th>Service Option</th>
                      <th>Service Type</th>
                      <th>Date of Visit</th>
                      <th style="text-align: center;">Action</th>
                  </tr>
              </thead>

              <tbody style="font-size: 12px;">
                @if(count($bookappoint) > 0)

                <?php $i = 1;?>
                @foreach($bookappoint as $bookappoints)

                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $bookappoints->ref_code }}</td>
                    <td>{{ $bookappoints->service_option }}</td>
                    <td>{{ $bookappoints->service_type }}</td>
                    <td>{{ date('d-M-Y', strtotime($bookappoints->date_of_visit)) }}</td>
                    <td align="center"><button style="font-size: 12px" class="btn btn-danger" onclick="window.open('checkbooking/{{ $bookappoints->ref_code }}', '_blank')">View to Print</button><button @if($bookappoints->accstate != 2) disabled="" style="font-size: 12px; cursor: not-allowed;" @endif style="font-size: 12px;" class="btn btn-success" onclick="confirmRequest('{{ $bookappoints->ref_code }}')">Confirm Request</button></td>
                </tr>

                @endforeach

                @else

                <tr>
                    <td colspan="6" align="center">No bookings made yet</td>
                </tr>

                @endif

              </tbody>
          </table>
      </div>

      {{-- End My Appointment --}}
  </div>

  {{-- End Appointment Here --}}





<div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">

<div id="accordion">


  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         @if(Auth::user()->userType == 'Business' || Auth::user()->userType == 'Auto Dealer') Station Information @else  Personal Information @endif
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
            <div class="itembody">
                <table width="100%">
                    <tbody>
                    <tr style="font-size: 13px;">
                        <td colspan="2"><b>@if(Auth::user()->userType == 'Business' || Auth::user()->userType == 'Auto Dealer') Station Name:  @else Name: @endif</b> @if(Auth::user()->userType == 'Business' || Auth::user()->userType == 'Auto Dealer') {{ Auth::user()->station_name }}  @else {{ Auth::user()->name }} @endif</td>
                    </tr>
                    <tr style="font-size: 13px;">
                        <td colspan="2"><b>Account Type: @if(Auth::user()->userType == 'Business') <span style="color: darkorange">Business Account - Corporate</span>  @elseif(Auth::user()->userType == 'Auto Dealer') <span style="color: darkorange">Business Account - Auto Dealer</span>  @elseif(Auth::user()->userType == 'Individual') <span style="color: darkorange">Personal Account - Non Commercial</span> @elseif(Auth::user()->userType == 'Commercial') <span style="color: darkorange">Personal Account - Commercial</span> @elseif(Auth::user()->userType == 'Certified Professional') <span style="color: darkorange">Professional Mechanics - Mobile Mechanics</span> @elseif(Auth::user()->userType == 'Auto Care') <span style="color: darkorange">Professional Mechanics - Auto Care Centre</span>  @endif</b></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr style="font-size: 13px;">

                        @if(Auth::user()->userType == 'Business' || Auth::user()->userType == 'Auto Dealer') <td colspan="2"><b>Private Email:</b> {{ Auth::user()->email }}</td>  @else <td colspan="2"><b>Primary Email:</b> {{ Auth::user()->email }}</td> @endif

                    </tr>
                    <tr style="font-size: 13px;">
                        <td><b>Password:</b> <input type="hidden" name="password" value="{{ Auth::user()->password }}" id="pass{{ Auth::user()->id }}"> <b>********</b></td>
                        <td align="right"><input style="padding: 7px 10px;" type="button" id="pass{{ Auth::user()->id }}" value="Edit" onclick="passChange('{{ Auth::user()->id }}')"></td>
                    </tr>

                    @if (count($carrecord) > 0)
                    <?php $i =1;?>
                        @foreach($carrecord as $carrecords)
                    <tr style="font-size: 13px;">

                        <td><b>Vehicle {{ $i++ }} : </b> {{ $carrecords->vehicle_nickname }}</td>

                    </tr>
                    @endforeach

                    @else
                    @endif

                    <span class="authMail disp-0">{{ Auth::user()->email }}</span>
                    @if(Auth::user()->userType == 'Individual' || Auth::user()->userType == 'Commercial')
                    <tr style="font-size: 13px;">

                        <td><b>Reminder emails: </b><select id="remindmailSet" name="reminderEmail">@if(count($reminderNotify) > 0 && $reminderNotify[0]->reminderEmail == 'on') <option value="on">On</option><option value="off">Off</option>@else <option value="off">Off</option><option value="on">On</option>@endif</select><br>
                            <b>Deal emails: </b><select id="dealmailSet" name="dealEmail">@if(count($reminderNotify) > 0 && $reminderNotify[0]->dealEmail == 'on') <option value="on">On</option><option value="off">Off</option>@else <option value="off">Off</option><option value="on">On</option>@endif</select><br>
                            <b>Newsletter emails: </b><select id="newslettermailSet" name="newsletterEmail">@if(count($reminderNotify) > 0 && $reminderNotify[0]->newsletterEmail == 'on') <option value="on">On</option><option value="off">Off</option>@else <option value="off">Off</option><option value="on">On</option>@endif</select>
                        </td>

                    </tr>
                    @endif
                    </tbody>

                </table>
                {{-- Edit Password --}}
                <div class="editPass m-t-15 animated fadeIn" style="display: none;">
                    <span><img align="right" src="https://img.icons8.com/flat_round/64/000000/delete-sign.png" style="width: 25px; height: 25px;" onclick="$('.editPass').toggle();"></span>
                    <div class="form-group">
                       <div class="row">
                            <div class="col-md-4">
                                <label><b>New Password</b></label>
                                <input type="hidden" name="user_id" value="" id="user_id">
                                <input type="password" name="new_password" id="new_password" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label><b>Confirm Password</b></label>
                                <input type="password" name="new_password" id="c_password" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>&nbsp;</label> <br>
                                <button class="btn btn-primary" onclick="savePass('{{ Auth::user()->email }}');" style="width: 100%;">Save <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingEleven">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="true" aria-controls="collapseEleven">
         My Connections
        </button>
      </h5>
    </div>

    <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="#accordion">
      <div class="card-body">
            <div class="itembody">
            @if(count($importClient) > 0)

            <h3 style="font-weight: bold; text-align: left;">{{ count($importClient) }} invited connections <button class="btn btn-primary btn-sm" onclick="resendInvite('{{ $importClient[0]->invite_from }}')">Resend Invite <img class="spinnerinv{{ $importClient[0]->invite_from }} disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button></h3> <hr>

                <table class="table table-striped table-bordered" id="connectionsList">

                    <h5 style="color: darkorange; font-weight: bold;">Connected Connections</h5> <hr>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name / E-mail</th>
                        </tr>
                    </thead>
                    <tbody>



                        <?php $i = 1;?>
                        @foreach($importClient as $importClients)

                        @if($resInv = \App\User::where('email', $importClients->email)->where('ref_code', $importClients->invite_from)->get())

                        @if(count($resInv) > 0)

                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>@if($resInv[0]->name != ""){{ $resInv[0]->name }} @else {{ $resInv[0]->email }} @endif</td>
                        </tr>

                        @endif

                        @endif


                        @endforeach
                    </tbody>

                </table>

            @else

                <h3 style="font-weight: bold; text-align: center;">0 invited connections</h3> <hr>
            @endif



        </div>
      </div>
    </div>
  </div>

  @if(Auth::user()->userType == 'Individual' || Auth::user()->userType == 'Commercial')

<div class="card">
  <div class="card-header" id="headingRef">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseRef" aria-expanded="true" aria-controls="collapseRef">
         My Referrals
        </button>
      </h5>
    </div>

    <div id="collapseRef" class="collapse" aria-labelledby="headingRef" data-parent="#accordion">
      <div class="card-body">
            <div class="itembody">
                <p>
                <span style="float: left; font-weight: 600; color: red;">MY REF CODE - @if($ref_code != "") {{ $ref_code }} @else  @endif</span><span class="text-left" style="float: right; font-weight: 600; color: blue;">POINTS - @if(Auth::user()->userType == "Commercial") {{ $getRefs * 10000 }}  @elseif(Auth::user()->userType == "Individual") {{ $getRefs * 50000 }} @endif <button class="btn btn-danger btn-sm" onclick="redeemPoint('{{ Auth::user()->ref_code }}', 'start')">Redeem Point <img class="spinredeem disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button></span></p>
            </div>
            <br>
      </div>
    </div>

</div>

  @endif

  <div class="card @if(Auth::user()->userType == 'Business' || Auth::user()->userType == 'Auto Dealer') disp-0 @else @endif">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Additional Emails
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <div class="itembody">
            <div class="form-group">
                <label>Email 1:</label>
                <input type="hidden" name="mainemail" id="mainemail" value="{{ Auth::user()->email }}">
                <input type="email" name="email1" id="email1" class="form-control" @if(null != Auth::user()->email1) value="{{ Auth::user()->email1 }}" @else @endif>
            </div>


            <div class="form-group">
                <label>Email 2:</label>
                <input type="email" name="email2" id="email2" class="form-control" @if(null != Auth::user()->email2) value="{{ Auth::user()->email2 }}" @else @endif>
            </div>

            <div class="form-group">
                <label>Email 3:</label>
                <input type="email" name="email3" id="email3" class="form-control" @if(null != Auth::user()->email3) value="{{ Auth::user()->email3 }}" @else @endif>
            </div>

            <span style="font-weight: 600">* Email reminders will still go to the primary email</span>
            <br>
            <button class="btn btn-primary" type="button" onclick="addSettings('additionalEmail')">Save <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
        </div>
      </div>
    </div>
  </div>


  @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")

  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Set Customer Additional Emails
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <div class="itembody">

            <div class="form-group">
                <label>Primary Email:</label>
                <input type="email" name="majoremail" id="majoremail" class="form-control">
            </div>

            <div class="form-group">
                <label>Email 1:</label>
                <input type="email" name="majoremail1" id="majoremail1" class="form-control">
            </div>


            <div class="form-group">
                <label>Email 2:</label>
                <input type="email" name="majoremail2" id="majoremail2" class="form-control">
            </div>

            <div class="form-group">
                <label>Email 3:</label>
                <input type="email" name="majoremail3" id="majoremail3" class="form-control">
            </div>
            <br>
            <span style="font-weight: 600">* Email reminders will still go to the primary email</span>
            <br>

            <button class="btn btn-primary addsettings" type="button" onclick="addSettings('additionalbusEmail')">Save <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
        </div>
      </div>
    </div>
  </div>

  @endif

  <div class="card @if(Auth::user()->userType == 'Business' || Auth::user()->userType == 'Auto Dealer') disp-0 @else @endif">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Reminder Settings
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        <div class="itembody">

            @if(count($carrecord) > 0)
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label style="text-transform: capitalize; font-style: 14px;">Oil Change</label>
                    </div>
                    <div class="col-md-6">

                        <select name="notifyoil" id="notifyoil" class="form-control">
                            @if(count($reminderNotify) > 0)
                            <option value="{{ $reminderNotify[0]->oilchange }}">{{ $reminderNotify[0]->oilchange }}</option>
                            <hr>
                            <option value="3 months">3 months</option>
                            <option value="6 months">6 months</option>
                            <option value="12 months">12 months</option>
                            <option value="off">Off</option>
                            @else
                            <option value="3 months">3 months</option>
                            <option value="6 months">6 months</option>
                            <option value="12 months">12 months</option>
                            <option value="off">Off</option>
                            @endif

                        </select>
                    </div>
                </div>

            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label style="text-transform: capitalize; font-style: 14px;">Air Filter</label>
                    </div>
                    <div class="col-md-6">

                        <select name="notifyair" id="notifyair" class="form-control">
                            @if(count($reminderNotify) > 0)
                            <option value="{{ $reminderNotify[0]->airfilter }}">{{ $reminderNotify[0]->airfilter }}</option>
                            <hr>
                            <option value="3 months">3 months</option>
                            <option value="6 months">6 months</option>
                            <option value="12 months">12 months</option>
                            <option value="off">Off</option>
                            @else
                            <option value="3 months">3 months</option>
                            <option value="6 months">6 months</option>
                            <option value="12 months">12 months</option>
                            <option value="off">Off</option>
                            @endif
                        </select>
                    </div>
                </div>

            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label style="text-transform: capitalize; font-style: 14px;">Tyre Rotation</label>
                    </div>
                    <div class="col-md-6">

                        <select name="notifytyre" id="notifytyre" class="form-control">
                            @if(count($reminderNotify) > 0)
                            <option value="{{ $reminderNotify[0]->tirerotation }}">{{ $reminderNotify[0]->tirerotation }}</option>
                            <hr>
                            <option value="3 months">3 months</option>
                            <option value="6 months">6 months</option>
                            <option value="12 months">12 months</option>
                            <option value="off">Off</option>
                            @else
                            <option value="3 months">3 months</option>
                            <option value="6 months">6 months</option>
                            <option value="12 months">12 months</option>
                            <option value="off">Off</option>
                            @endif
                        </select>
                    </div>
                </div>

            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label style="text-transform: capitalize; font-style: 14px;">Inspection</label>
                    </div>
                    <div class="col-md-6">

                        <select name="notifyinspect" id="notifyinspect" class="form-control">
                            @if(count($reminderNotify) > 0)
                            <option value="{{ $reminderNotify[0]->inspection }}">{{ $reminderNotify[0]->inspection }}</option>
                            <hr>
                            <option value="3 months">3 months</option>
                            <option value="6 months">6 months</option>
                            <option value="12 months">12 months</option>
                            <option value="off">Off</option>
                            @else
                            <option value="3 months">3 months</option>
                            <option value="6 months">6 months</option>
                            <option value="12 months">12 months</option>
                            <option value="off">Off</option>
                            @endif
                        </select>
                    </div>
                </div>

            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label style="text-transform: capitalize; font-style: 14px;">Registration</label>
                    </div>
                    <div class="col-md-6">

                        <select name="notifyregister" id="notifyregister" class="form-control">
                            @if(count($reminderNotify) > 0)
                            <option value="{{ $reminderNotify[0]->registration }}">{{ $reminderNotify[0]->registration }}</option>
                            <hr>
                            <option value="3 months">3 months</option>
                            <option value="6 months">6 months</option>
                            <option value="12 months">12 months</option>
                            <option value="off">Off</option>
                            @else
                            <option value="3 months">3 months</option>
                            <option value="6 months">6 months</option>
                            <option value="12 months">12 months</option>
                            <option value="off">Off</option>
                            @endif
                        </select>
                    </div>
                </div>

            </div>




            <span style="font-weight: 600">* If "Email reminders" is set to "Off" under Account settings, then no email reminders will be sent regardless of the above settings.</span>

            <br>
            <button class="btn btn-primary" type="button" onclick="addSettings('reminderSettings')">Save <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>

            @else

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <p>No vehicle registered yet</p>
                    </div>
                </div>
            </div>

            @endif

        </div>

      </div>
    </div>
  </div>


  @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional")

  <div class="card">
    <div class="card-header" id="headingTen">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
          Set Customer Reminder Settings
        </button>
      </h5>
    </div>
    <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordion">
      <div class="card-body">
        <div class="itembody">

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label style="text-transform: capitalize; font-style: 14px;">Primary E-mail Address</label>
                    </div>
                    <div class="col-md-6">
                        <input type="email" name="remEmail" id="remEmail" class="form-control">
                    </div>
                </div>

            </div>


            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label style="text-transform: capitalize; font-style: 14px;">Oil Change</label>
                    </div>
                    <div class="col-md-6">

                        <select name="notifyoil" id="notifyoil" class="form-control">

                            <option value="3 months">3 months</option>
                            <option value="6 months">6 months</option>
                            <option value="12 months">12 months</option>
                            <option value="off">Off</option>

                        </select>
                    </div>
                </div>

            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label style="text-transform: capitalize; font-style: 14px;">Air Filter</label>
                    </div>
                    <div class="col-md-6">

                        <select name="notifyair" id="notifyair" class="form-control">
                            <option value="3 months">3 months</option>
                            <option value="6 months">6 months</option>
                            <option value="12 months">12 months</option>
                            <option value="off">Off</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label style="text-transform: capitalize; font-style: 14px;">Tyre Rotation</label>
                    </div>
                    <div class="col-md-6">

                        <select name="notifytyre" id="notifytyre" class="form-control">
                            <option value="3 months">3 months</option>
                            <option value="6 months">6 months</option>
                            <option value="12 months">12 months</option>
                            <option value="off">Off</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label style="text-transform: capitalize; font-style: 14px;">Inspection</label>
                    </div>
                    <div class="col-md-6">

                        <select name="notifyinspect" id="notifyinspect" class="form-control">
                            <option value="3 months">3 months</option>
                            <option value="6 months">6 months</option>
                            <option value="12 months">12 months</option>
                            <option value="off">Off</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label style="text-transform: capitalize; font-style: 14px;">Registration</label>
                    </div>
                    <div class="col-md-6">

                        <select name="notifyregister" id="notifyregister" class="form-control">
                            <option value="3 months">3 months</option>
                            <option value="6 months">6 months</option>
                            <option value="12 months">12 months</option>
                            <option value="off">Off</option>
                        </select>
                    </div>
                </div>

            </div>




            <span style="font-weight: 600">* If "Email reminders" is set to "Off" under Account settings, then no email reminders will be sent regardless of the above settings.</span>

            <br>
            <button class="btn btn-primary" type="button" onclick="addSettings('reminderbusSettings')">Save <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>

        </div>

      </div>
    </div>
  </div>

  @endif


  <div class="card @if(Auth::user()->userType == 'Business' || Auth::user()->userType == 'Auto Dealer' || Auth::user()->userType == 'Auto Care' || Auth::user()->userType == 'Technician' || Auth::user()->userType == 'Certified Professional') disp-0 @else @endif">
    <div class="card-header" id="headingFour">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseTwo">
          Vehicle Information
        </button>
      </h5>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
      <div class="card-body">
        <div class="itembody">

            @if(count($carrecord) > 0)
                <div class="form-group">
                    <p>Licence Number: {{ $carrecord[0]->vehicle_reg_no }}</p> <br>
                    <input type="hidden" name="vehicle_reg_nosss" id="vehicle_reg_nosss" value="{{ $carrecord[0]->vehicle_reg_no }}" class="form-control">
                    <input type="hidden" name="positionzz" id="positionzz" value="{{ $carrecord[0]->id }}" class="form-control">
                <div class="row">
                    <div class="col-md-6">
                        <label style="text-transform: capitalize; font-style: 14px;">VIN / Chassis Number</label>
                    </div>
                    <div class="col-md-6">
                        @if ($carrecord[0]->chassis_no != "")
                            <input type="text" name="chassiss_no" id="chassiss_no" class="form-control" value="{{ $carrecord[0]->chassis_no }}">
                            @else
                            <input type="text" name="chassiss_no" id="chassiss_no" class="form-control">
                        @endif
                    </div>
                </div> <br>

                <div class="row">
                    <div class="col-md-6">
                        <label style="text-transform: capitalize; font-style: 14px;">Location</label>
                    </div>
                    <div class="col-md-6">
                        @if ($carrecord[0]->location != "")
                            <input type="text" name="locationss" id="locationss" class="form-control" value="{{ $carrecord[0]->location }}">
                            @else
                            <input type="text" name="locationss" id="locationss" class="form-control">
                        @endif
                    </div>
                </div> <br>

                <div class="row">
                    <div class="col-md-6">
                        <label style="text-transform: capitalize; font-style: 14px;">Update Vehicle Image</label>
                    </div>
                    <div class="col-md-6">
                        <input type="file" name="filess" id="filess{{ $carrecord[0]->id }}" class="form-control">
                    </div>
                </div>

            </div> <hr>


            <button class="btn btn-primary" type="button" onclick="addSettings('vehicleinfo')">Save Changes <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>

            @else

                <p>No vehicle registered yet</p>

            @endif

        </div>
      </div>
    </div>
  </div>



<div class="card">
    <div class="card-header" id="headingSix">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseTwo">
          Invite Contacts
        </button>
      </h5>
    </div>
    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
      <div class="card-body">
        <div class="itembody">
            <div class="row">
                <div class="col-md-6">
                    <a href="https://accounts.google.com/o/oauth2/auth?client_id=779231570694-3se2nma170k0rer6r82d2ogtudi5q32g.apps.googleusercontent.com&redirect_uri=https://vimfile.com/google/oauth&scope=https://www.google.com/m8/feeds/&response_type=code" class="btn btn-default" id="importGmail">Import from Google <img class="spinner" src="https://pluspng.com/img-png/google-logo-png-open-2000.png" style="width: 30px; height: 30px;"></a>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-default" id="importExcel" onclick="$('#excelFile').click()">Import from Excel <img class="spinner" src="https://hotmart.s3.amazonaws.com/product_pictures/aad7c973-a879-4995-9f98-f29ead0f1a3b/supportedplatformsexcellogo3.png" style="width: 30px; height: 30px;"> <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"> </button>

                    <input type="file" name="excelFile" id="excelFile" style="display: none;">
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  @if (Auth::user()->userType == "Individual" || Auth::user()->userType == "Commercial")
      <div class="card">
    <div class="card-header" id="headingFive">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseTwo">
          Account Settings
        </button>
      </h5>
    </div>
    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
      <div class="card-body">
        <div class="itembody">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-danger" onclick="deactivateAccount('{{ Auth::user()->id }}')" id="deactivateaccount">Deactivate Account <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  @endif



</div>



</div>


</div>


  </div>


</div>

            @endif










        </div>

    </section>
    <!-- upcoming_event part start-->

@endsection
