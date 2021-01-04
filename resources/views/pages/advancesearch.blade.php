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
                        <h2>Book An Appointment</h2>
                        <p></p>
                    </div>
                </div>
            </div>

            <div class="appointment_section m-b-25">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h6>Fullname</h6>
                        <input type="hidden" name="busID" value="" id="appointmentID">
                        <input type="hidden" name="myID" value="" id="myID">
                        <input type="hidden" name="mypurpose" value="" id="mypurpose">
                        <input type="hidden" name="stationname" value="" id="stationname">

                        <input type="text" name="fullname" id="fullnames" class="form-control" placeholder="Enter your name"> <br>
                    </div>
                    <div class="col-md-6">
                        <h6>Email Address</h6>
                        <input type="email" name="email" id="mail_addr" class="form-control" placeholder="Enter your email"> <br>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h6>Subject</h6>
                        <input type="text" name="subject" id="subjects" class="form-control" placeholder="Enter Subject"> <br>
                    </div>
                    <div class="col-md-6">
                        <h6>Date to visit</h6>
                        <input type="date" name="date_of_visit" id="date_of_visit" class="form-control" placeholder="Date to visit"> <br>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h6>Message</h6>
                        <textarea class="form-control" name="message" id="messages" placeholder="Enter Message" style="height: 150px; resize: none;"></textarea>
                    </div>
                </div> <br>
                <div><button type="button" class="btn btn-info btn-block" onclick="appointment();">Submit <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button></div>
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

               <h5>Search Result for Auto Care - <span style="color: navy; font-weight: bolder;">{{ count($getRes) }} Result(s) Found</span></h5>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr style="font-size: 12px;">
                            <th>#</th>
                            <th>Branch Address</th>
                            <th>Company</th>
                            <th>Telephone</th>
                            <th>Service Offered</th>
                            <th style="text-align: center;">Locate on Map</th>
                            <th style="text-align: center;">Action <br> <small style="font-weight: bold; color: red;">(Calls & SMS available on mobile only)</small></th>
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
                                        <td align="center"><a title="Make a call" href="tel:{{ $data->station_phone }}"><img src="https://img.icons8.com/officel/30/000000/phone-disconnected.png"></a><a title="Send a message" href="sms:{{ $data->station_phone }}"><img src="https://img.icons8.com/cotton/30/000000/new-message.png"></a><button title="Book an Appointment" onclick="getAppointment('{{ $data->busID }}', 'registered', '{{ $data->station_name }}');"><img src="https://img.icons8.com/dusk/30/000000/google-calendar.png"></button></td>


                                        @else
                                        {{-- Notify Mail --}}
                                        <td align="center"><a title="Make a call" type="button" onclick="makeActions('{{ $data->station_phone }}', 'make call')"><img src="https://img.icons8.com/officel/30/000000/phone-disconnected.png"></a><a title="Send a message" type="button" onclick="makeActions('{{ $data->station_phone }}', 'send sms')"><img src="https://img.icons8.com/cotton/30/000000/new-message.png"></a><button title="Book an Appointment" onclick="makeActions('{{ $data->station_phone }}', 'book appointment')"><img src="https://img.icons8.com/dusk/30/000000/google-calendar.png"> <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button></td>

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

            <div class="row align-items-center justify-content-between table-responsive">
               @if($getProf != "")

               <h5>Other Search Results - <span style="color: navy; font-weight: bolder;">{{ count($getProf) }} Result(s) Found</span></h5>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr style="font-size: 12px;">
                            <th>#</th>
                            <th>Branch Address</th>
                            <th>Company</th>
                            <th>Telephone</th>
                            <th>Service Offered</th>
                            <th>Locate on Map</th>
                            <th style="text-align: center;">Action <br> <small style="font-weight: bold; color: red;">(Calls & SMS available on mobile only)</small></th>
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
                                        @if($info->station_phone) <td align="center">

                                            <a title="Make a call" href="tel:{{ $info->station_phone }}"><img src="https://img.icons8.com/officel/30/000000/phone-disconnected.png"></a>
                                            <a title="Send a message" href="sms:{{ $info->station_phone }}"><img src="https://img.icons8.com/cotton/30/000000/new-message.png"></a>

                                        </td> @else <td align="center">
                                            <a title="Make a call" href="tel:{{ $info->telephone }}"><img src="https://img.icons8.com/officel/30/000000/phone-disconnected.png"></a>
                                            <a title="Send a message" href="sms:{{ $info->telephone }}"><img src="https://img.icons8.com/cotton/30/000000/new-message.png"></a>
                                            
                                        </td> @endif


                                        @else
                                        {{-- Notify Mail --}}
                                        @if($info->station_phone) <td align="center"><a title="Make a call" type="button" onclick="makeActions('{{ $info->station_phone }}', 'make call')"><img src="https://img.icons8.com/officel/30/000000/phone-disconnected.png"></a><a title="Send a message" type="button" onclick="makeActions('{{ $info->station_phone }}', 'send sms')"><img src="https://img.icons8.com/cotton/30/000000/new-message.png"></a><a title="Book an appointment" type="button" onclick="getAppointment('{{ $info->id }}', 'unregistered', '{{ $info->name_of_company }}')"><img src="https://img.icons8.com/dusk/30/000000/google-calendar.png"></a></td> @else <td align="center"><a title="Make a call" type="button" onclick="makeActions('{{ $info->telephone }}', 'make call')"><img src="https://img.icons8.com/officel/30/000000/phone-disconnected.png"></a><a title="Send a message" type="button" onclick="makeActions('{{ $info->telephone }}', 'send sms')"><img src="https://img.icons8.com/cotton/30/000000/new-message.png"></a><a title="Book an appointment" type="button" onclick="getAppointment('{{ $info->id }}', 'unregistered', '{{ $info->name_of_company }}')"><img src="https://img.icons8.com/dusk/30/000000/google-calendar.png"></a></td> @endif

                                    @endif
                                

                                @else
                                    {{-- Notify Mail --}}
                                    @if($info->station_phone)<td align="center"><a title="Make a call" type="button" onclick="makeActions('{{ $info->station_phone }}', 'make call')"><img src="https://img.icons8.com/officel/30/000000/phone-disconnected.png"></a><a title="Send a message" type="button" onclick="makeActions('{{ $info->station_phone }}', 'send sms')"><img src="https://img.icons8.com/cotton/30/000000/new-message.png"></a><a title="Book an appointment" type="button" onclick="getAppointment('{{ $info->id }}', 'unregistered', '{{ $info->name_of_company }}')"><img src="https://img.icons8.com/dusk/30/000000/google-calendar.png"></a></td>@else <td align="center"><a title="Make a call" type="button" onclick="makeActions('{{ $info->telephone }}', 'make call')"><img src="https://img.icons8.com/officel/30/000000/phone-disconnected.png"></a><a title="Send a message" type="button" onclick="makeActions('{{ $info->telephone }}', 'send sms')"><img src="https://img.icons8.com/cotton/30/000000/new-message.png"></a><a title="Book an appointment" type="button" onclick="getAppointment('{{ $info->id }}', 'unregistered', '{{ $info->name_of_company }}')"><img src="https://img.icons8.com/dusk/30/000000/google-calendar.png"></a></td> @endif
                                @endif

                                



                            </tr>

                            @endif


                        @endif


                        @endforeach
                    </tbody>

                </table>




               @endif

                
                <button class="btn btn-danger" onclick="goBack()">Go back</button>
                <br><br>
            </div>
        </div>
        
        <img src="img/animate_icon/Shape-1.png" alt="" class="feature_icon_1">
        <img src="img/animate_icon/Shape-14.png" alt="" class="feature_icon_2">
        <img src="img/animate_icon/Shape.png" alt="" class="feature_icon_3">
        <img src="img/animate_icon/shape-3.png" alt="" class="feature_icon_4">
    </section>
    <!-- upcoming_event part start-->

@endsection