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


    <div class="container table table-responsive m-t-120" id="Cashbals">
        <h3 class="text-center">Cash Balance</h3> <hr>
        <table class="table table-striped table-bordered">
          <thead>
            <tr style="font-size: 12px">
              <th>Date</th>
              <th>Inflow</th>
              <th>Outflow</th>
              <th>Running Balance</th>
              <th>Available Balance</th>
            </tr>
          </thead>
          <tbody>
            @if($cashBals != 0)
              <tr style="font-size: 12px">
              <td>{{ date('D-M-Y') }}</td>
              <td>{{ number_format($cashBals[2]->vehiclepay_total) }}</td>
              <td>{{ number_format($cashBals[1]->total_cash) }}</td>
              <td>{{ number_format($cashBals[0]->total + $cashBals[2]->vehiclepay_total) }}</td>
              <td>{{ number_format($cashBals[0]->total + $cashBals[2]->vehiclepay_total - $cashBals[1]->total_cash) }}</td>
            </tr>

            @else
            <tr align="center"><td colspan="5">No record</td></tr>

            @endif
            
          </tbody>
        </table>
    </div>

    <div class="row">
      <div class="col-md-12">
        <center><button onclick="newBack('businessreportcashbalance')" class="btn btn-primary">Go back</button></center>
      </div>
    </div>
<br>


@endsection