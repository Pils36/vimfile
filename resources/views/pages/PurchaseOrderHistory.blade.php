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


    

    <div class="container table table-responsive m-t-120" id="POCheck">
        <h3 class="text-center">Purchase Order</h3> <hr>
        <table class="table table-striped table-bordered">
      @if(count($getPOPage) > 0)
      <tbody style="font-size: 13px;">

        @if($getPOPage[0]->vendor != "")
          <tr>
              <td>Vendor</td>
              <td align='center'>{{ $getPOPage[0]->vendor }}</td>
          </tr>

        @endif

        @if($getPOPage[0]->purchase_order_no != "")
          <tr>
              <td>Purchase Order</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_no }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->order_date != "")
          <tr>
              <td>Order Date</td>
              <td align='center'>{{ $getPOPage[0]->order_date }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->expected_date != "")
          <tr>
              <td>Date Expected</td>
              <td align='center'>{{ $getPOPage[0]->expected_date }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_inventory_item != "")
          <tr>
              <td>Inventory Item</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_inventory_item }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_qty != "")
          <tr>
              <td>Quantity</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_qty }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_rate != "")
          <tr>
              <td>Rate</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_rate }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_totcost != "")
          <tr>
              <td>Total Cost</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_totcost }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_shippingcost != "")
          <tr>
              <td>Shipping Cost</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_shippingcost }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_discount != "")
          <tr>
              <td>Less:Discount</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_discount }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_othercost != "")
          <tr>
              <td>Other Costs</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_othercost }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_tax != "")
          <tr>
              <td>Tax</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_tax }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_totalpurchaseorder != "")
          <tr>
              <td>Purchase Order Total</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_totalpurchaseorder }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_shipto != "")
          <tr>
              <td>Ship To</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_shipto }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_address1 != "")
          <tr>
              <td>Address 1</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_address1 }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_address2 != "")
          <tr>
              <td>Address 2</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_address2 }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_city != "")
          <tr>
              <td>City</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_city }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_state != "")
          <tr>
              <td>State/Province</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_state }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_country != "")
          <tr>
              <td>Country</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_country }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_zip != "")
          <tr>
              <td>Zip/Postal Code</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_zip }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_destphone != "")
          <tr>
              <td>Destination Phone</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_destphone }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_destfax != "")
          <tr>
              <td>Destination Fax</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_destfax }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_destmail != "")
          <tr>
              <td>Destination Email</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_destmail }}</td>
          </tr>
        @endif

        @if($getPOPage[0]->purchase_order_orderby != "")
          <tr>
              <td>Ordered By Staff</td>
              <td align='center'>{{ $getPOPage[0]->purchase_order_orderby }}</td>
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
            <button style="text-align: center;" class="btn btn-primary" onclick="sendPOmails('{{ $getPOPage[0]->post_id }}','{{ $getPOPage[0]->purchase_order_destmail }}')">Send Email <img class="spinnersMail disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
        </div>
        <div class="col-md-6" align="center">
            <button style="text-align: center;" class="btn btn-danger" onclick="printCopy('POCheck')">Print Copy</button>
        </div>
        
      
            

      </tbody>
    </div>



@endsection