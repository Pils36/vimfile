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



    <div class="container table table-responsive m-t-120" id="techCheck">
        <h3 class="text-center">Technician Report</h3> <hr>
        <table class="table table-striped table-bordered">
      @if($techpayStub != "")
      <tbody style="font-size: 13px;">

        @if($techpayStub[0]->licence != "")
        <tr>
              <td>Vehicle Licence:</td>
              <td align='center'>{{ $techpayStub[0]->licence }}</td>
          </tr>

        @endif

        @if($techpayStub[0]->make != "")
        <tr>
              <td>Make:</td>
              <td align='center'>{{ $techpayStub[0]->make }}</td>
          </tr>

        @endif

        @if($techpayStub[0]->model != "")
        <tr>
              <td>Model:</td>
              <td align='center'>{{ $techpayStub[0]->model }}</td>
          </tr>

        @endif

        @if($techpayStub[0]->date != "")
        <tr>
              <td>Report Date:</td>
              <td align='center'>{{ $techpayStub[0]->date }}</td>
          </tr>

        @endif

        @if($techpayStub[0]->service_type != "")
        <tr>
              <td>Service Type:</td>
              <td align='center'>{{ $techpayStub[0]->service_type }}</td>
          </tr>

        @endif

        @if($techpayStub[0]->service_option != "")
        <tr>
              <td>Service Option:</td>
              <td align='center'>{{ $techpayStub[0]->service_option }}</td>
          </tr>

        @endif

        @if($techpayStub[0]->hour != "")
        <tr>
              <td>Hour:</td>
              <td align='center'>{{ $techpayStub[0]->hour }}</td>
          </tr>

        @endif

        @if($techpayStub[0]->rate != "")
        <tr>
              <td>Rate:</td>
              <td align='center'>{{ $techpayStub[0]->rate }}</td>
          </tr>

        @endif

        @if($techpayStub[0]->pay_due != "")
        <tr>
              <td>Pay Due:</td>
              <td align='center'>{{ $techpayStub[0]->pay_due }}</td>
          </tr>

        @endif

        @if($techpayStub[0]->start_date != "")
        <tr>
              <td>Start Date:</td>
              <td align='center'>{{ $techpayStub[0]->start_date }}</td>
          </tr>

        @endif

        @if($techpayStub[0]->end_date != "")
        <tr>
              <td>End Date:</td>
              <td align='center'>{{ $techpayStub[0]->end_date }}</td>
          </tr>

        @endif

        @if($techpayStub[0]->deduction != "")
        <tr>
              <td>Deduction:</td>
              <td align='center'>{{ $techpayStub[0]->deduction }}</td>
          </tr>

        @endif

        @if($techpayStub[0]->balance != "")
        <tr>
              <td>Balance:</td>
              <td align='center'>{{ $techpayStub[0]->balance }}</td>
          </tr>

        @endif

        @if($techpayStub[0]->total_pay != "")
        <tr>
              <td>Total Pay:</td>
              <td align='center'>{{ $techpayStub[0]->total_pay }}</td>
          </tr>

        @endif

        @if($techpayStub[0]->cash_amount != "")
        <tr>
              <td>Cash Ammount:</td>
              <td align='center'>{{ $techpayStub[0]->cash_amount }}</td>
          </tr>

        @endif

        @if($techpayStub[0]->cheque_amout != "")
        <tr>
              <td>Cheque Amount:</td>
              <td align='center'>{{ $techpayStub[0]->cheque_amout }}</td>
          </tr>

        @endif

        @if($techpayStub[0]->creditcard_amount != "")
        <tr>
              <td>Credit Card Amount:</td>
              <td align='center'>{{ $techpayStub[0]->creditcard_amount }}</td>
          </tr>

        @endif

        @if($techpayStub[0]->total_amount != "")
        <tr>
              <td>Total Amount:</td>
              <td align='center'>{{ $techpayStub[0]->total_amount }}</td>
          </tr>

        @endif
          

          <tr>
            <td>Payment Status:</td>
            @if($techpayStub[0]->pay_stub == 2) <td align='center' style="color: green; font-weight: bold;">PAID</td>  @elseif($techpayStub[0]->pay_stub == 1) <td align='center' style="color: darkblue; font-weight: bold;">MOVED TO PAYMENT STUB</td> @else <td align='center' style="color: red; font-weight: bold;">NOT PAID</td> @endif
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

    <div class="row">
        <div class="col-md-12" align="center">
            <button style="text-align: center;" class="btn btn-danger btn-block" onclick="printCopy('techCheck')">Print Copy</button>
        </div>
        
      
            

      </tbody>
    </div>



@endsection