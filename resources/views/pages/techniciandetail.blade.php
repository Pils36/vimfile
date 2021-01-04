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
    <div class="container table table-responsive m-t-120" id="estCheck">
        <h3 class="text-center">Technician Detail</h3> <hr>
        <table class="table table-striped table-bordered">
      @if(count($getEstPage) > 0)
      <tbody style="font-size: 13px;">
          <tr>
              <td>Name:</td>
              <td align='center'>{{ $getEstPage[0]->name }}</td>
          </tr>
          <tr>
              <td>E-mail Address:</td>
              <td align='center'>{{ $getEstPage[0]->email }}</td>
          </tr>

          <tr>
              <td>Phone Number:</td>
              <td align='center'>{{ $getEstPage[0]->phone_number }}</td>
          </tr>

          <tr>
              <td>City:</td>
              <td align='center'>{{ $getEstPage[0]->city }}</td>
          </tr>



          <tr>
              <td>State:</td>
              <td align='center'>{{ $getEstPage[0]->state }}</td>
          </tr>


          <tr>
              <td>Country:</td>
              <td align='center'>{{ $getEstPage[0]->country }}</td>
          </tr>

        @if($getEstPage[0]->station_name != "")
          <tr>
              <td>Station Name:</td>
              <td align='center'>{{ $getEstPage[0]->station_name }}</td>
          </tr>
        @endif



        @if($getEstPage[0]->year_of_practice != "")
          <tr>
              <td>Year of Experience:</td>
              <td align='center'>{{ $getEstPage[0]->year_of_practice }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->specialization != "")
          <tr>
              <td>Specialization:</td>
              <td align='center'>{{ $getEstPage[0]->specialization }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->trade_certificate != "")
          <tr>
              <td>Trade Certificate:</td>
              <td align='center'><a href="/trade_cert/{{ $getEstPage[0]->trade_certificate }}" target="_blank">view certificate</a></td>
          </tr>

        @endif

        
          
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
      <br><br>
            

      </tbody>
    </div>
<br><br>


@endsection