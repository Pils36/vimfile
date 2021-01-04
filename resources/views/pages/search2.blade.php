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
                    <h5 id="appointcoy_name"><img src="https://bebep.id/demos/car/images/page-loader.gif" style="width: 30px; height: 30px; border-radius: 100%;"></h5>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h4>Address:</h4>
                </div>
                <div class="col-md-6">
                    <h5 id="appointcoy_address"><img src="https://bebep.id/demos/car/images/page-loader.gif" style="width: 30px; height: 30px; border-radius: 100%;"></h5>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h4>Phone Number:</h4>
                </div>
                <div class="col-md-6">
                    <h5 id="appointcoy_phone"><img src="https://bebep.id/demos/car/images/page-loader.gif" style="width: 30px; height: 30px; border-radius: 100%;"></h5>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h4>Email:</h4>
                </div>
                <div class="col-md-6">
                    <h5 id="appointcoy_email"><img src="https://bebep.id/demos/car/images/page-loader.gif" style="width: 30px; height: 30px; border-radius: 100%;"></h5>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h4>Services Offer:</h4>
                </div>
                <div class="col-md-6">
                    <h5 id="appointcoy_service"><img src="https://bebep.id/demos/car/images/page-loader.gif" style="width: 30px; height: 30px; border-radius: 100%;"></h5>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h4>Discount Available:</h4>
                </div>
                <div class="col-md-6">
                    <h5 id="appointcoy_discount"><img src="https://bebep.id/demos/car/images/page-loader.gif" style="width: 30px; height: 30px; border-radius: 100%;"></h5>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h4>Google Location of the Store:</h4>
                </div>
                <div class="col-md-6">
                    <h5 id="appointcoy_location"><img src="https://bebep.id/demos/car/images/page-loader.gif" style="width: 30px; height: 30px; border-radius: 100%;"></h5>
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

                        <input type="text" name="fullname" id="fullnames" class="form-control" placeholder="Enter your name" value="" readonly="" disabled=""> <br>
                    </div>
                    <div class="col-md-6">
                        <h6>Email Address</h6>
                        <br>
                        <input type="email" name="email" id="mail_addr" class="form-control" placeholder="Enter your email" value="" readonly="" disabled=""> <br>
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
                <div><button type="button" class="btn btn-info btn-block" onclick="appointmentPromo('{{ $link }}');">Submit <img class="spinnerappoints disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button></div>
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

            <div class="row align-items-center justify-content-between table-responsive">

                
               @if($getRes != "")

               <h5>Stations - <span style="color: navy; font-weight: bolder;">{{ count($getRes) }} Result(s) Found</span></h5>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr style="font-size: 12px;">
                            <th>#</th>
                            <th>Branch Address</th>
                            <th>Company</th>
                            <th>Telephone</th>
                            <th>Services Offer</th>
                            <th style="text-align: center;">Locate on Map</th>
                            <th style="text-align: center;">Action </th>
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
                                        <td align="center">
                                            <button class="btn btn-secondary" onclick="appointmentPromo('{{ $link }}');">Request Quote</button> <button class="btn btn-primary" onclick="appointmentPromo('{{ $link }}');">Book an Appointment</button>
                                        </td>


                                        @else
                                        {{-- Notify Mail --}}
                                        <td align="center">
                                            <button class="btn btn-secondary" onclick="appointmentPromo('{{ $link }}');">Request Quote</button> <button class="btn btn-primary" onclick="appointmentPromo('{{ $link }}');">Book an Appointment</button>
                                        </td>

                                    @endif
                                

                                @else
                                    {{-- Notify Mail --}}
                                    <td align="center">
                                            <button class="btn btn-secondary" onclick="appointmentPromo('{{ $link }}');">Request Quote</button> <button class="btn btn-primary" onclick="appointmentPromo('{{ $link }}');">Book an Appointment</button>
                                        </td>
                                @endif

                                
                                
                            </tr>
                        {{-- End Check Already active users --}}

                        @endforeach
                    </tbody>

                </table>




               @endif

                
                
            </div>

            <hr>

            <div class="row align-items-center justify-content-between table-responsive">
               @if($getProf != "")

               <h5>Company - <span style="color: navy; font-weight: bolder;">{{ count($getProf) }} Result(s) Found</span></h5>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr style="font-size: 12px;">
                            <th>#</th>
                            <th>Branch Address</th>
                            <th>Company</th>
                            <th>Telephone</th>
                            <th>Services Offer</th>
                            <th>Locate on Map</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>



                    <tbody>
                        <?php $i = 1;?>
                        @foreach($getProf as $info)

                        {{-- Check  Already active users --}}

                        @if($info->station_phone != "" || $info->telephone != "")

                            @if($info->email != "")

                            <tr style="font-size: 12px;">
                                <td>{{ $i++ }}</td>
                                @if($info->station_address)<td>{{ $info->station_address }}</td> @else <td>{{ $info->address }}</td> @endif
                                @if($info->station_name)<td>{{ $info->station_name }}</td>@else <td>{{ $info->name_of_company }}</td> @endif
                                @if($info->station_phone)<td>{{ $info->station_phone }}</td>@else <td>{{ $info->telephone }}</td> @endif
                                @if(!$info->service_offered) <td>-</td> @else @if($info->service_offered != "" || $info->service_offered != NULL)<td>{{ $info->service_offered }}</td>@else <td>-</td> @endif @endif
                                @if($info->station_address)<td align="center"><a href="https://www.google.com/maps/search/{{ $info->station_address }}" target="_blank"><i type="button" class="fas fa-map-marker" style="color: darkorange; text-align: center; padding: 5px;"></i></a></td>@else <td align="center"><a href="https://www.google.com/maps/search/{{ $info->address }}" target="_blank"><i type="button" class="fas fa-map-marker" style="color: darkorange; text-align: center; padding: 5px;"></i></a></td> @endif


                                @if($activeProfessional = \App\User::where('busID', $info->busID)->get())

                                    @if(count($activeProfessional) > 0)
                                        @if($info->station_phone)
                                            <td align="center">
                                            <button class="btn btn-secondary" onclick="appointmentPromo('{{ $link }}');">Request Quote</button> <button class="btn btn-primary" onclick="appointmentPromo('{{ $link }}');">Book an Appointment</button>
                                        </td>


                                        @endif


                                        @else
                                        {{-- Notify Mail --}}
                                        @if($info->station_phone) <td align="center">
                                            <button class="btn btn-secondary" onclick="appointmentPromo('{{ $link }}');">Request Quote</button> <button class="btn btn-primary" onclick="appointmentPromo('{{ $link }}');">Book an Appointment</button>
                                        </td> @endif

                                    @endif
                                

                                @else
                                    {{-- Notify Mail --}}
                                    @if($info->station_phone)<td align="center">
                                            <button class="btn btn-secondary" onclick="appointmentPromo('{{ $link }}');">Request Quote</button> <button class="btn btn-primary" onclick="appointmentPromo('{{ $link }}');">Book an Appointment</button>
                                        </td> @endif
                                @endif

                                
                                <td align="center">
                                            <button class="btn btn-secondary" onclick="appointmentPromo('{{ $link }}');">Request Quote</button> <br> <button class="btn btn-primary" onclick="appointmentPromo('{{ $link }}');">Book an Appointment</button>
                                        </td>


                            </tr>

                            @endif


                        @endif


                        @endforeach
                    </tbody>

                </table>




               @endif
                
            </div>
            <hr>

            <center><a href="{{ route('Businesses') }}" style="font-size: 18px; color: navy; font-weight: bold; text-align: center;">Learn about vimfile for Business</a></center>
            <hr>
            <br>
        </div>
        
        <img src="img/animate_icon/Shape-1.png" alt="" class="feature_icon_1">
        <img src="img/animate_icon/Shape-14.png" alt="" class="feature_icon_2">
        <img src="img/animate_icon/Shape.png" alt="" class="feature_icon_3">
        <img src="img/animate_icon/shape-3.png" alt="" class="feature_icon_4">
    </section>
    <!-- upcoming_event part start-->

@endsection