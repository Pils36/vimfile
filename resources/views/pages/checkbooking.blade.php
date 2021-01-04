@extends('layouts.app')

@section('text/css')

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



<?php use \App\Http\Controllers\User; ?>

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



    <div class="container table table-responsive m-t-120" id="bookCheck">
        <h3 class="text-center">Book Appointment Reference</h3> <hr>
        <table class="table table-striped table-bordered">
          @if(count($getmyAppointment) > 0)

          <tbody>
            <tr>
              <td>Booking Reference Code:</td>
              <td align='center' style="color: navy; font-weight: bold;">{{ $getmyAppointment[0]->ref_code }}</td>
            </tr>

            <tr>
              <td>Subject:</td>
              <td align='center'>{{ $getmyAppointment[0]->subject }}</td>
            </tr>

            <tr>
              <td>Service Option:</td>
              <td align='center'>{{ $getmyAppointment[0]->service_option }}</td>
            </tr>

            <tr>
              <td>Service Type:</td>
              <td align='center'>{{ $getmyAppointment[0]->service_type }}</td>
            </tr>

            <tr>
              <td>Current Mileage:</td>
              <td align='center'>{{ $getmyAppointment[0]->current_mileage }}</td>
            </tr>

            <tr>
              <td>Discount %:</td>
              <td align='center'>{{ $myRate }}</td>
            </tr>

            <tr>
              <td>Date of Visit:</td>
              <td align='center'>{{ date('d-M-Y', strtotime($getmyAppointment[0]->date_of_visit)) }}</td>
            </tr>

            <tr>
              <td>Description of Service:</td>
              <td align='center'>{{ $getmyAppointment[0]->message }}</td>
            </tr>
          </tbody>


          @else

          <tbody>
            <tr>
                <td>No record found</td>
            </tr>
        </tbody> 

          @endif
        </table>
    </div>

    <div class="container">
      <center><div class="col-md-12">
            <button style="text-align: center;" class="btn btn-danger btn-block" onclick="printCopy('bookCheck')">Print Copy</button>
        </div></center>
    </div>


<br>

@endsection