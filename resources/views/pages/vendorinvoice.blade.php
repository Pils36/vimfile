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


    <div class="container table table-responsive m-t-120" id="vendCheck">
        <h3 class="text-center">Purchase Order Invoice</h3> <hr>
        <table class="table table-striped table-bordered">
      @if($getVendpage != "")
      <tbody style="font-size: 13px;">

        @if($getVendpage[0]->pay_order_date != "")
          <tr>
              <td>Purchase Order Date:</td>
              <td align='center'>{{ $getVendpage[0]->pay_order_date }}</td>
          </tr>

        @endif

        @if($getVendpage[0]->pay_date_expected != "")
          <tr>
              <td>Purchase Expected Date:</td>
              <td align='center'>{{ $getVendpage[0]->pay_date_expected }}</td>
          </tr>

        @endif

        @if($getVendpage[0]->pay_invent_item != "")
          <tr>
              <td>Inventory Item:</td>
              <td align='center'>{{ $getVendpage[0]->pay_invent_item }}</td>
          </tr>

        @endif

        @if($getVendpage[0]->pay_description_of_item != "")
          <tr>
              <td>Description of Item:</td>
              <td align='center'>{{ $getVendpage[0]->pay_description_of_item }}</td>
          </tr>

        @endif

        @if($getVendpage[0]->pay_description_of_item != "")
          <tr>
              <td>Quantity:</td>
              <td align='center'>{{ $getVendpage[0]->pay_quantity }}</td>
          </tr>

        @endif

        @if($getVendpage[0]->pay_rate != "")
          <tr>
              <td>Rate:</td>
              <td align='center'>{{ $getVendpage[0]->pay_rate }}</td>
          </tr>

        @endif

        @if($getVendpage[0]->pay_tot_cost != "")
          <tr>
              <td>Total Cost:</td>
              <td align='center'>{{ $getVendpage[0]->pay_tot_cost }}</td>
          </tr>

        @endif

        @if($getVendpage[0]->pay_shipping_cost != "")
          <tr>
              <td>Shipping Cost:</td>
              <td align='center'>{{ $getVendpage[0]->pay_shipping_cost }}</td>
          </tr>

        @endif

        @if($getVendpage[0]->pay_discount != "")
          <tr>
              <td>Discount:</td>
              <td align='center'>{{ $getVendpage[0]->pay_discount }}</td>
          </tr>

        @endif

        @if($getVendpage[0]->pay_othercosts != "")
          <tr>
              <td>Other Cost:</td>
              <td align='center'>{{ $getVendpage[0]->pay_othercosts }}</td>
          </tr>

        @endif

        @if($getVendpage[0]->pay_tax != "")
          <tr>
              <td>Tax:</td>
              <td align='center'>{{ $getVendpage[0]->pay_tax }}</td>
          </tr>

        @endif

        @if($getVendpage[0]->pay_po_total != "")
          <tr>
              <td>Total Cost:</td>
              <td align='center'>{{ $getVendpage[0]->pay_po_total }}</td>
          </tr>

        @endif

        @if($getVendpage[0]->pay_advance != "")
          <tr>
              <td>Advance Payment:</td>
              <td align='center'>{{ $getVendpage[0]->pay_advance }}</td>
          </tr>

        @endif

        @if($getVendpage[0]->pay_balance != "")
          <tr>
              <td>Balance Amount:</td>
              <td align='center'>{{ $getVendpage[0]->pay_balance }}</td>
          </tr>

        @endif

        @if($getVendpage[0]->pay_balance != "")
          <tr>
              <td>Cash Amount:</td>
              <td align='center'>{{ $getVendpage[0]->pay_cashamount }}</td>
          </tr>

        @endif
        

        @if($getVendpage[0]->pay_chequeno != "")
          <tr>
              <td>Cheque Number:</td>
              <td align='center'>{{ $getVendpage[0]->pay_chequeno }}</td>
          </tr>

        @endif

        @if($getVendpage[0]->pay_chequedate != "")
          <tr>
              <td>Cheque Date:</td>
              <td align='center'>{{ $getVendpage[0]->pay_chequedate }}</td>
          </tr>

        @endif 

        @if($getVendpage[0]->pay_chequeamount != "")
          <tr>
              <td>Cheque Amount:</td>
              <td align='center'>{{ $getVendpage[0]->pay_chequeamount }}</td>
          </tr>

        @endif 

        @if($getVendpage[0]->pay_credit != "")
          <tr>
              <td>Credit Card #:</td>
              <td align='center'>{{ $getVendpage[0]->pay_credit }}</td>
          </tr>

        @endif 

        @if($getVendpage[0]->pay_cc != "")
          <tr>
              <td>Card CC:</td>
              <td align='center'>{{ $getVendpage[0]->pay_cc }}</td>
          </tr>

        @endif

        @if($getVendpage[0]->pay_cardamount != "")
          <tr>
              <td>Card Amount:</td>
              <td align='center'>{{ $getVendpage[0]->pay_cardamount }}</td>
          </tr>

        @endif 

        @if($getVendpage[0]->pay_grandtotal != "")
          <tr>
              <td style="font-size: 20px; font-weight: bold;">Grand Total:</td>
              <td align='center' style="font-size: 20px; font-weight: bold;">{{ number_format($getVendpage[0]->pay_grandtotal, 2) }}</td>
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

    <div class="row">
        <div class="col-md-6" align="center">
            <button style="text-align: center;" class="btn btn-primary" onclick="vendorMails('{{ $getVendpage[0]->pay_po_number }}', '{{ $getVendpage[0]->vendor_email }}')">Resend Email <img class="spinnersMail disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
        </div>
        <div class="col-md-6" align="center">
            <button style="text-align: center;" class="btn btn-danger" onclick="printCopy('vendCheck')">Print Copy</button>
        </div>

    </div>

    <hr><br>



@endsection