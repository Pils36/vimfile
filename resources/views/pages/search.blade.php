@extends('layouts.app')


@section('text/css')

<?php use \App\Http\Controllers\User; ?>
<?php use \App\Http\Controllers\Admin; ?>

<style>
    .appointment_section{
        border: 1px solid #14485f;
        padding: 10px 5px;
        border-radius: 10px;
    }
    .memo{
        font-size: 16px;
        background: #000;
        width: 450px;
        text-align: justify;
        position: relative;
        top: -30px;

    }
    .banner_part {
        height: 65% !important;
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
        font-size: 33px; background-color: #394f75; padding: 10px; width: auto; margin-bottom: 150px;
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
                <div class="col-lg-12">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h1 class="m-t-0" id="headz">Vehicle Inspection &<br> Maintenance File
                                </h1>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

    <!-- use sasu part end-->
    <section class="use_sasu m-t-30 disp-0 bookings" id="makeBookings">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section_tittle text-center">
                        <h2><u>Book An Appointment</u></h2>
                        <p></p>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <h4>Name:</h4>
                </div>
                <div class="col-md-6">
                    <input type="hidden" name="appointstation_name" id="appointstation_name" value=""><input type="hidden" name="appointref_code" id="appointref_code" value="">
                    <h5 id="appointcoy_name"><img src="https://i.ya-webdesign.com/images/loading-gif-png-5.gif" style="width: 30px; height: 30px; border-radius: 100%;"></h5>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h4>Address:</h4>
                </div>
                <div class="col-md-6">
                    <h5 id="appointcoy_address"><img src="https://i.ya-webdesign.com/images/loading-gif-png-5.gif" style="width: 30px; height: 30px; border-radius: 100%;"></h5>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h4>Phone Number:</h4>
                </div>
                <div class="col-md-6">
                    <h5 id="appointcoy_phone"><img src="https://i.ya-webdesign.com/images/loading-gif-png-5.gif" style="width: 30px; height: 30px; border-radius: 100%;"></h5>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h4>Email:</h4>
                </div>
                <div class="col-md-6">
                    <h5 id="appointcoy_email"><img src="https://i.ya-webdesign.com/images/loading-gif-png-5.gif" style="width: 30px; height: 30px; border-radius: 100%;"></h5>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h4>Services Offer:</h4>
                </div>
                <div class="col-md-6">
                    <h5 id="appointcoy_service"><img src="https://i.ya-webdesign.com/images/loading-gif-png-5.gif" style="width: 30px; height: 30px; border-radius: 100%;"></h5>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h4>Discount Available:</h4>
                </div>
                <div class="col-md-6">
                    <h5 id="appointcoy_discount"><img src="https://i.ya-webdesign.com/images/loading-gif-png-5.gif" style="width: 30px; height: 30px; border-radius: 100%;"></h5>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h4>Google Location of the Store:</h4>
                </div>
                <div class="col-md-6">
                    <h5 id="appointcoy_location"><img src="https://i.ya-webdesign.com/images/loading-gif-png-5.gif" style="width: 30px; height: 30px; border-radius: 100%;"></h5>
                </div>
            </div>
            <br>

            <div class="appointment_section m-b-25">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h6>Fullname</h6>
                        <br>
                        <input type="hidden" name="busID" value="" id="appointmentID">
                        <input type="hidden" name="myID" value="" id="myID">
                        <input type="hidden" name="mypurpose" value="" id="mypurpose">
                        <input type="hidden" name="stationname" value="" id="stationname">
                        <input type="hidden" name="stationrecemail" value="" id="stationrecemail">

                        <input type="text" name="fullname" id="fullnames" class="form-control" placeholder="Enter your name" value="{{ Auth::user()->name }}" readonly="" disabled=""> <br>
                    </div>
                    <div class="col-md-6">
                        <h6>Email Address</h6>
                        <br>
                        <input type="email" name="email" id="mail_addr" class="form-control" placeholder="Enter your email" value="{{ Auth::user()->email }}" readonly="" disabled=""> <br>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h6>Subject</h6>
                        <br>
                        <input type="text" name="subject" id="subjects" class="form-control" placeholder="Enter Subject"> <br>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h6>Date of visit</h6>
                        <br>
                        <input type="date" name="date_of_visit" id="date_of_visit" class="form-control" placeholder="Date to visit"> <br>
                    </div>
                    <div class="col-md-6">
                        <h6>Service Option</h6>
                        <br>
                        <select name="appointservice_option" id="appointservice_option" class="form-control">
                            <option value="Major Repair">Major Repair</option>
                            <option value="Minor Repair">Minor Repair</option>
                            <option value="Scheduled Maintenance">Scheduled Maintenance</option>
                            <option value="Emergency Maintenance">Emergency Maintenance</option>
                        </select> 
                        <br>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h6>Service Type</h6>
                        <br>
                        <select name="appointservice_type" id="appointservice_type" class="form-control">
                            <option value="Service" selected="selected" disabled="disabled">Service</option>
                            <optgroup label="Admin"><option value="inspection">inspection</option><option value="registration">registration</option><option value="insurance">insurance</option><option value="road assistance">road assistance</option><option value="business taxes">business taxes</option><option value="Road Fines">Road Fines</option><option value="Ticket">Ticket</option></optgroup>
                            <optgroup label="Fuel"><option value="fuel">fuel</option><option value="car wash">car wash</option></optgroup>
                            <optgroup label="Maintenance"><option value="air conditioning recharge">air conditioning recharge</option><option value="air filter">air filter</option><option value="battery">battery</option><option value="brake fluid flush">brake fluid flush</option><option value="brake pads">brake pads</option><option value="brake rotors">brake rotors</option><option value="coolant flush">coolant flush</option><option value="distributor cap &amp; rotor">distributor cap &amp; rotor</option><option value="fuel filter">fuel filter</option><option value="headlight">headlight</option><option value="oil change">oil change</option><option value="power steering flush">power steering flush</option><option value="spark plugs">spark plugs</option><option value="timing belt">timing belt</option><option value="tire - new">tire - new</option><option value="tire balancing">tire balancing</option><option value="tire inflation">tire inflation</option><option value="tire rotation">tire rotation</option><option value="wheel rotation and tire balancing">Wheel Rotation & Tire Balancing</option><option value="transmission fluid flush">transmission fluid flush</option><option value="wheel alignment">wheel alignment</option><option value="wiper blades">wiper blades</option><option value="other">other</option><option value="cabin air filter">cabin air filter</option><option value="smog check">smog check</option></optgroup>
                            <optgroup label="Repairs"><option value="alternator">alternator</option><option value="belt">belt</option><option value="body work">body work</option><option value="brake caliper">brake caliper</option><option value="carburetor">carburetor</option><option value="catalytic converter">catalytic converter</option><option value="clutch">clutch</option><option value="control arm">control arm</option><option value="coolant temperature sensor">coolant temperature sensor</option><option value="exhaust">exhaust</option><option value="fuel injector">fuel injector</option><option value="fuel tank">fuel tank</option><option value="head gasket">head gasket</option><option value="heater core">heater core</option><option value="hose">hose</option><option value="line">line</option><option value="mass air flow sensor">mass air flow sensor</option><option value="muffler">muffler</option><option value="oxygen sensor">oxygen sensor</option><option value="radiator">radiator</option><option value="shock/strut">shock/strut</option><option value="starter">starter</option><option value="thermostat">thermostat</option><option value="tie rod">tie rod</option><option value="transmission">transmission</option><option value="water pump">water pump</option><option value="wheel bearings">wheel bearings</option><option value="window">window</option><option value="windshield">windshield</option><option value="road side assistance">road side assistance</option><option value="other">other</option><option value="sensor">sensor</option>
                            </optgroup>    
                        </select> 
                        <br>
                    </div>
                    <div class="col-md-6">
                        <h6>Current Mileage</h6>
                        <br>
                        <input type="text" name="appointcurrent_mileage" id="appointcurrent_mileage" class="form-control" placeholder="Type your current mileage"> <br>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h6>Description of Service Required</h6>
                        <br>
                        <textarea class="form-control" name="message" id="messages" placeholder="Enter Message" style="height: 150px; resize: none;"></textarea>
                    </div>
                </div> <br>
                <div><button type="button" class="btn btn-info btn-block" onclick="appointment();">Submit <img class="spinnerappoints disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button></div>
        </div>
        </div>
        <img src="img/animate_icon/Shape-14.png" alt="" class="feature_icon_1">
        <img src="img/animate_icon/Shape-10.png" alt="" class="feature_icon_2">
        <img src="img/animate_icon/Shape.png" alt="" class="feature_icon_3">
        <img src="img/animate_icon/shape-13.png" alt="" class="feature_icon_4">
    </section>
    <!-- use sasu part end-->


       <!-- feature_part start-->
    <section class="feature_part padding_top">
        <div class="container">

            <div class="row align-items-center justify-content-between">
                <div class="col-md-8">
                    <h6 style="color: red; text-transform: uppercase; font-weight: bolder;">Advance Search</h6>
                    <br>
                    <input type="text" name="advanceSearch" id="advanceSearch" class="form-control" placeholder="Enter your Postal/Zip code">
                </div>
                <div class="col-md-4">
                    <h6>&nbsp;</h6>
                    <br>
                    <button class="btn btn-primary btn-block" onclick="advancesearch()">Submit <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
            </div>
            <br><br>

            <div class="row align-items-center justify-content-between table-responsive">
               @if($getProf != "")

               <h5>Found Result For VIM Care Mechanics near you - <span style="color: navy; font-weight: bolder;">{{ count($getProf) }} Result(s) Found</span></h5>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr style="font-size: 12px;">
                            <th>#</th>
                            <th>Branch Address</th>
                            <th>Company</th>
                            <th>Telephone</th>
                            <th>Services Offer</th>
                            <th>Locate on Map</th>
                            <th style="text-align: center;">Action <br> <small style="font-weight: bold; color: red;">(Calls & SMS available on mobile device only)</small></th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php $i = 1;?>
                        @foreach($getProf as $info)
                        {{-- Check  Already active users --}}

                        @if($info->phone_number != null || $info->phone_number != "")

                            @if($info->email != "")

                            <tr style="font-size: 12px;">
                                <td>{{ $i++ }}</td>
                                @if($info->station_address)<td>{{ $info->station_address }}</td> @else <td>{{ $info->address }}</td> @endif
                                @if($info->station_name)<td>{{ $info->station_name }}</td>@else <td>{{ $info->name_of_company }}</td> @endif
                                @if($info->phone_number)<td>{{ $info->phone_number }}</td>@else <td>{{ $info->station_phone }}</td> @endif
                                @if(!$info->service_offered) <td>-</td> @else @if($info->service_offered != "" || $info->service_offered != NULL)<td>{{ $info->service_offered }}</td>@else <td>-</td> @endif @endif
                                @if($info->station_address)<td align="center"><a href="https://www.google.com/maps/search/{{ $info->station_address }}" target="_blank"><i type="button" class="fas fa-map-marker" style="color: darkorange; text-align: center; padding: 5px;"></i></a></td>@else <td align="center"><a href="https://www.google.com/maps/search/{{ $info->address }}" target="_blank"><i type="button" class="fas fa-map-marker" style="color: darkorange; text-align: center; padding: 5px;"></i></a></td> @endif


                                @if($activeProfessional = \App\User::where('busID', $info->busID)->get())

                                    @if(count($activeProfessional) > 0)
                                        @if($info->phone_number) <td align="center">

                                            <a title="Make a call" href="tel:{{ $info->phone_number }}"><img src="https://img.icons8.com/officel/30/000000/phone-disconnected.png"></a>
                                            <a title="Send a message" href="sms:{{ $info->phone_number }}"><img src="https://img.icons8.com/cotton/30/000000/new-message.png"></a>
                                            <a title="Book an appointment" type="button" onclick="getAppointment('{{ $info->busID }}', 'registered', '{{ $info->station_name }}')"><img src="https://img.icons8.com/dusk/30/000000/google-calendar.png"></a>
                                            <a title="Live Chat" href="https://web.prochatr.com/?c=chat_mech&platform=48cff60d45be26b6c4982d7c416175a8&userid={{ Auth::user()->ref_code }}&key=true&level={{ Auth::user()->userType }}&userrole={{ Auth::user()->userType }}&action=chat_with&identity={{ $info->station_name }}&username=NULL" target="_blank"><img src="https://img.icons8.com/color/30/000000/chat.png"></a>

                                        </td> @else <td align="center">
                                            <a title="Make a call" href="tel:{{ $info->phone_number }}"><img src="https://img.icons8.com/officel/30/000000/phone-disconnected.png"></a>
                                            <a title="Send a message" href="sms:{{ $info->phone_number }}"><img src="https://img.icons8.com/cotton/30/000000/new-message.png"></a>
                                            <a title="Book an appointment" type="button" onclick="getAppointment('{{ $info->busID }}', 'registered', '{{ $info->station_name }}')"><img src="https://img.icons8.com/dusk/30/000000/google-calendar.png"></a>
                                            <a title="Live Chat" href="https://web.prochatr.com/?c=chat_mech&platform=48cff60d45be26b6c4982d7c416175a8&userid={{ Auth::user()->ref_code }}&key=true&level={{ Auth::user()->userType }}&userrole={{ Auth::user()->userType }}&action=chat_with&identity={{ $info->station_name }}&username=NULL" target="_blank"><img src="https://img.icons8.com/color/30/000000/chat.png"></a>
                                            
                                        </td> 


                                        @endif


                                        @else
                                        {{-- Notify Mail --}}
                                        @if($info->phone_number) <td align="center"><a title="Make a call" type="button" onclick="makeActions('{{ $info->phone_number }}', 'make call')"><img src="https://img.icons8.com/officel/30/000000/phone-disconnected.png"></a><a title="Send a message" type="button" onclick="makeActions('{{ $info->phone_number }}', 'send sms')"><img src="https://img.icons8.com/cotton/30/000000/new-message.png"></a><a title="Book an appointment" type="button" onclick="getAppointment('{{ $info->id }}', 'unregistered', '{{ $info->name_of_company }}')"><img src="https://img.icons8.com/dusk/30/000000/google-calendar.png"></a></td> @else <td align="center"><a title="Make a call" type="button" onclick="makeActions('{{ $info->phone_number }}', 'make call')"><img src="https://img.icons8.com/officel/30/000000/phone-disconnected.png"></a><a title="Send a message" type="button" onclick="makeActions('{{ $info->phone_number }}', 'send sms')"><img src="https://img.icons8.com/cotton/30/000000/new-message.png"></a><a title="Book an appointment" type="button" onclick="getAppointment('{{ $info->id }}', 'unregistered', '{{ $info->name_of_company }}')"><img src="https://img.icons8.com/dusk/30/000000/google-calendar.png"></a>
                                        <a title="Live Chat" href="https://web.prochatr.com/?c=chat_mech&platform=48cff60d45be26b6c4982d7c416175a8&userid={{ Auth::user()->ref_code }}&key=true&level={{ Auth::user()->userType }}&userrole={{ Auth::user()->userType }}&action=chat_with&identity={{ $info->name_of_company }}&username=NULL" target="_blank"><img src="https://img.icons8.com/color/30/000000/chat.png"></a></td> @endif

                                    @endif
                                

                                @else
                                    {{-- Notify Mail --}}
                                    @if($info->station_phone)<td align="center"><a title="Make a call" type="button" onclick="makeActions('{{ $info->station_phone }}', 'make call')"><img src="https://img.icons8.com/officel/30/000000/phone-disconnected.png"></a><a title="Send a message" type="button" onclick="makeActions('{{ $info->station_phone }}', 'send sms')"><img src="https://img.icons8.com/cotton/30/000000/new-message.png"></a><a title="Book an appointment" type="button" onclick="getAppointment('{{ $info->id }}', 'unregistered', '{{ $info->name_of_company }}')"><img src="https://img.icons8.com/dusk/30/000000/google-calendar.png"></a></td>@else <td align="center"><a title="Make a call" type="button" onclick="makeActions('{{ $info->phone_number }}', 'make call')"><img src="https://img.icons8.com/officel/30/000000/phone-disconnected.png"></a><a title="Send a message" type="button" onclick="makeActions('{{ $info->phone_number }}', 'send sms')"><img src="https://img.icons8.com/cotton/30/000000/new-message.png"></a><a title="Book an appointment" type="button" onclick="getAppointment('{{ $info->id }}', 'unregistered', '{{ $info->name_of_company }}')"><img src="https://img.icons8.com/dusk/30/000000/google-calendar.png"></a>
                                        <a title="Live Chat" href="https://web.prochatr.com/?c=chat_mech&platform=48cff60d45be26b6c4982d7c416175a8&userid={{ Auth::user()->ref_code }}&key=true&level={{ Auth::user()->userType }}&userrole={{ Auth::user()->userType }}&action=chat_with&identity={{ $info->name_of_company }}&username=NULL" target="_blank"><img src="https://img.icons8.com/color/30/000000/chat.png"></a></td> @endif
                                @endif

                                



                            </tr>

                            @endif


                        @endif


                        @endforeach
                    </tbody>

                </table>




               @endif

                
                
            </div>

            <hr>
            <div class="row align-items-center justify-content-between table-responsive">

                
               @if($getRes != "")

               <h5>Found Result for Auto Care Stations near you - <span style="color: navy; font-weight: bolder;">{{ count($getRes) }} Result(s) Found</span></h5>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr style="font-size: 12px;">
                            <th>#</th>
                            <th>Branch Address</th>
                            <th>Company</th>
                            <th>Telephone</th>
                            <th>Services Offer</th>
                            <th style="text-align: center;">Locate on Map</th>
                            <th style="text-align: center;">Action <br> <small style="font-weight: bold; color: red;">(Calls & SMS available on mobile device only)</small></th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php $i = 1;?>
                        @foreach($getRes as $data)
                        {{-- Start Check  Already active users --}}

                            <tr style="font-size: 12px;">
                                <td>{{ $i++ }}</td>
                                <td>{{ $data->station_address }}</td>
                                <td>{{ $data->name_of_company }} ({{ $data->station_name }})</td>
                                <td>{{ $data->station_phone }}</td>
                                @if(!$data->service_offered) <td>-</td> @else <td>{{ $data->service_offered }}</td> @endif
                                <td align="center"><a href="https://www.google.com/maps/search/{{ $data->station_address }}" target="_blank"><i type="button" class="fas fa-map-marker" style="color: darkorange; text-align: center; padding: 5px;"></i></a></td>

                                @if($activeClient = \App\Admin::where('busID', $data->busID)->get())

                                    @if(count($activeClient) > 0)
                                        <td align="center"><a title="Make a call" href="tel:{{ $data->station_phone }}"><img src="https://img.icons8.com/officel/30/000000/phone-disconnected.png"></a><a title="Send a message" href="sms:{{ $data->station_phone }}"><img src="https://img.icons8.com/cotton/30/000000/new-message.png"></a><button title="Book an Appointment" onclick="getAppointment('{{ $data->busID }}', 'registered', '{{ $data->station_name }}');"><img src="https://img.icons8.com/dusk/30/000000/google-calendar.png"></button><a title="Live Chat" href="https://web.prochatr.com/?c=chat_mech&platform=48cff60d45be26b6c4982d7c416175a8&userid={{ Auth::user()->ref_code }}&key=true&level={{ Auth::user()->userType }}&userrole={{ Auth::user()->userType }}&action=chat_with&identity={{ $data->station_name }}&username=NULL" target="_blank"><img src="https://img.icons8.com/color/30/000000/chat.png"></a></td>


                                        @else
                                        {{-- Notify Mail --}}
                                        <td align="center"><a title="Make a call" type="button" onclick="makeActions('{{ $data->station_phone }}', 'make call')"><img src="https://img.icons8.com/officel/30/000000/phone-disconnected.png"></a><a title="Send a message" type="button" onclick="makeActions('{{ $data->station_phone }}', 'send sms')"><img src="https://img.icons8.com/cotton/30/000000/new-message.png"></a><button title="Book an Appointment" onclick="makeActions('{{ $data->station_phone }}', 'book appointment')"><img src="https://img.icons8.com/dusk/30/000000/google-calendar.png"> <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button><a title="Live Chat" href="https://web.prochatr.com/?c=chat_mech&platform=48cff60d45be26b6c4982d7c416175a8&userid={{ Auth::user()->ref_code }}&key=true&level={{ Auth::user()->userType }}&userrole={{ Auth::user()->userType }}&action=chat_with&identity={{ $data->station_name }}&username=NULL" target="_blank"><img src="https://img.icons8.com/color/30/000000/chat.png"></a></td>

                                    @endif
                                

                                @else
                                    {{-- Notify Mail --}}
                                    <td align="center"><a title="Make a call" type="button" onclick="makeActions('{{ $data->station_phone }}', 'make call')"><img src="https://img.icons8.com/officel/30/000000/phone-disconnected.png"></a><a title="Send a message" type="button" onclick="makeActions('{{ $data->station_phone }}', 'send sms')"><img src="https://img.icons8.com/cotton/30/000000/new-message.png"></a><button title="Book an Appointment" onclick="makeActions('{{ $data->station_phone }}', 'book appointment')"><img src="https://img.icons8.com/dusk/30/000000/google-calendar.png"> <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button></td>
                                @endif

                                
                                
                            </tr>
                        {{-- End Check Already active users --}}

                        @endforeach
                    </tbody>

                </table>




               @endif

                
                
            </div>

            <hr>

            
        </div>

    </section>
    <!-- upcoming_event part start-->

@endsection