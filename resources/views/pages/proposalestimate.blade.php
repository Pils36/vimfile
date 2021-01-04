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
    <div class="table table-responsive m-t-120" id="estCheck">
        <h3 class="text-center">{{ $heading }}</h3> <hr>
        <table class="table table-striped table-bordered">
      @if(count($getEstPage) > 0)
      <tbody style="font-size: 13px;">

        @if($getEstPage[0]->vehicle_licence != "")
          <tr>
              <td>Vehicle Licence:</td>
              <td align='center'>{{ $getEstPage[0]->vehicle_licence }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->email != "")
          <tr>
              <td>E-mail Address:</td>
              <td align='center'>{{ $getEstPage[0]->email }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->make != "")
          <tr>
              <td>Make:</td>
              <td align='center'>{{ $getEstPage[0]->make }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->model != "")
          <tr>
              <td>Model:</td>
              <td align='center'>{{ $getEstPage[0]->model }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->mileage != "")
          <tr>
              <td>Mileage:</td>
              <td align='center'>{{ $getEstPage[0]->mileage }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->date != "")
          <tr>
              <td>Report Date:</td>
              <td align='center'>{{ $getEstPage[0]->date }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->service_type != "")
          <tr>
              <td>Service Type:</td>
              <td align='center'>{{ $getEstPage[0]->service_type }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->service_option != "")
          <tr>
              <td>Service Option:</td>
              <td align='center'>{{ $getEstPage[0]->service_option }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->telephone != "")
          <tr>
              <td>Phone Number:</td>
              <td align='center'>{{ $getEstPage[0]->telephone }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_qty != "")
          <tr>
              <td>Material Quantity 1:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_cost != "")
          <tr>
              <td>Material Cost 1:</td>
              <td align='center'>{{ number_format($getEstPage[0]->material_cost, 2) }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_qty2 != "")
          <tr>
              <td>Material Quantity 2:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty2 }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_cost2 != "" || $getEstPage[0]->material_cost2 != "0.00")
          <tr>
              <td>Material Cost 2:</td>
              <td align='center'>{{ number_format($getEstPage[0]->material_cost2, 2) }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_qty3 != "")
          <tr>
              <td>Material Quantity 3:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty3 }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_qty4 != "")
          <tr>
              <td>Material Quantity 4:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty4 }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_qty5 != "")
          <tr>
              <td>Material Quantity 5:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty5 }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_qty6 != "")
          <tr>
              <td>Material Quantity 6:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty6 }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_qty7 != "")
          <tr>
              <td>Material Quantity 7:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty7 }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_qty8 != "")
          <tr>
              <td>Material Quantity 8:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty8 }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_qty9 != "")
          <tr>
              <td>Material Quantity 9:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty9 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->material_qty10 != "")
          <tr>
              <td>Material Quantity 10:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty10 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->material_cost3 != "" && $getEstPage[0]->material_cost3 != 0.00)
          <tr>
              <td>Material Cost 3:</td>
              <td align='center'>{{ number_format($getEstPage[0]->material_cost3, 2) }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->material_cost4 != "" && $getEstPage[0]->material_cost4 != 0.00)
          <tr>
              <td>Material Cost 4:</td>
              <td align='center'>{{ number_format($getEstPage[0]->material_cost4, 2) }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->material_cost5 != "" && $getEstPage[0]->material_cost5 != 0.00)
          <tr>
              <td>Material Cost 5:</td>
              <td align='center'>{{ number_format($getEstPage[0]->material_cost5, 2) }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->material_cost6 != "" && $getEstPage[0]->material_cost6 != 0.00)
          <tr>
              <td>Material Cost 6:</td>
              <td align='center'>{{ number_format($getEstPage[0]->material_cost6, 2) }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->material_cost7 != "" && $getEstPage[0]->material_cost7 != 0.00)
          <tr>
              <td>Material Cost 7:</td>
              <td align='center'>{{ number_format($getEstPage[0]->material_cost7, 2) }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->material_cost8 != "" && $getEstPage[0]->material_cost8 != 0.00)
          <tr>
              <td>Material Cost 8:</td>
              <td align='center'>{{ number_format($getEstPage[0]->material_cost8, 2) }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->material_cost9 != "" && $getEstPage[0]->material_cost9 != 0.00)
          <tr>
              <td>Material Cost 9:</td>
              <td align='center'>{{ number_format($getEstPage[0]->material_cost9, 2) }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->material_cost10 != "" && $getEstPage[0]->material_cost10 != 0.00)
          <tr>
              <td>Material Cost 10:</td>
              <td align='center'>{{ number_format($getEstPage[0]->material_cost10, 2) }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty != "")
          <tr>
              <td>Labour Quantity 1:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost != "")
          <tr>
              <td>Labour Cost 1:</td>
              <td align='center'>{{ number_format($getEstPage[0]->labour_cost, 2) }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty2 != "")
          <tr>
              <td>Labour Quantity 2:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty2 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty3 != "")
          <tr>
              <td>Labour Quantity 3:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty3 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty4 != "")
          <tr>
              <td>Labour Quantity 4:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty4 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty5 != "")
          <tr>
              <td>Labour Quantity 5:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty5 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty6 != "")
          <tr>
              <td>Labour Quantity 6:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty6 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty7 != "")
          <tr>
              <td>Labour Quantity 7:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty7 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty8 != "")
          <tr>
              <td>Labour Quantity 8:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty8 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty9 != "")
          <tr>
              <td>Labour Quantity 9:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty9 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty10 != "")
          <tr>
              <td>Labour Quantity 10:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty10 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost2 != "" && $getEstPage[0]->labour_cost2 != 0.00)
          <tr>
              <td>Labour Cost 2:</td>
              <td align='center'>{{ number_format($getEstPage[0]->labour_cost2, 2) }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost3 != "" && $getEstPage[0]->labour_cost3 != 0.00)
          <tr>
              <td>Labour Cost 3:</td>
              <td align='center'>{{ number_format($getEstPage[0]->labour_cost3, 2) }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost4 != "" && $getEstPage[0]->labour_cost4 != 0.00)
          <tr>
              <td>Labour Cost 4:</td>
              <td align='center'>{{ number_format($getEstPage[0]->labour_cost4, 2) }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost5 != "" && $getEstPage[0]->labour_cost5 != 0.00)
          <tr>
              <td>Labour Cost 5:</td>
              <td align='center'>{{ number_format($getEstPage[0]->labour_cost5, 2) }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost6 != "" && $getEstPage[0]->labour_cost6 != 0.00)
          <tr>
              <td>Labour Cost 6:</td>
              <td align='center'>{{ number_format($getEstPage[0]->labour_cost6, 2) }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost7 != "" && $getEstPage[0]->labour_cost7 != 0.00)
          <tr>
              <td>Labour Cost 7:</td>
              <td align='center'>{{ number_format($getEstPage[0]->labour_cost7, 2) }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost8 != "" && $getEstPage[0]->labour_cost8 != 0.00)
          <tr>
              <td>Labour Cost 8:</td>
              <td align='center'>{{ number_format($getEstPage[0]->labour_cost8, 2) }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost9 != "" && $getEstPage[0]->labour_cost9 != 0.00)
          <tr>
              <td>Labour Cost 9:</td>
              <td align='center'>{{ number_format($getEstPage[0]->labour_cost9, 2) }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost10 != "" && $getEstPage[0]->labour_cost10 != 0.00)
          <tr>
              <td>Labour Cost 10:</td>
              <td align='center'>{{ number_format($getEstPage[0]->labour_cost10, 2) }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->other_cost != "" && $getEstPage[0]->other_cost != 0.00)
          <tr>
              <td>Other Cost:</td>
              <td align='center'>{{ number_format($getEstPage[0]->other_cost, 2) }}</td>
          </tr>
        @endif    
          

          @if($getPart != "")

          <tr>
            <td style="font-size: 24px; font-weight: bold;">Part Details</td>
            <td>&nbsp;</td>
          </tr>

          <tr>
            <td>Part No.:</td>
            <td align='center'>{{ $getPart[0]->part_no }}</td>
          </tr>
          <tr>
            <td>Part Description:</td>
            <td align='center'>{{ $getPart[0]->description }}</td>
          </tr>
          <tr>
            <td>Part Quantity:</td>
            <td align='center'>{{ $getPart[0]->quantity }}</td>
          </tr>
          <tr>
            <td>Part Total Price:</td>
            <td align='center' style="font-weight: bold; font-size: 18px">{{ number_format($getPart[0]->total_price, 2) }}</td>
          </tr>
          <tr>
            <td>Technician In-Charge:</td>

            @if($staffname = \App\User::where('email', $getPart[0]->technician)->get())
              @if(count($staffname) > 0)

                <td align='center'>{{ $staffname[0]->name }}</td>
              @else
                <td align='center'>--</td>
              @endif

              @else
              <td align='center'>--</td>
            @endif
            
          </tr>

          <tr>
              <td>Discount %:</td>
              <td align='center' style="font-weight: bold; font-size: 18px;">{{ $discount }}</td>
          </tr>

          <tr>
              <td>Total Cost:</td>
              <td align='center' style="font-weight: bold; font-size: 18px;">{{ number_format($getEstPage[0]->total_cost, 2) }}</td>
          </tr>

          <tr>
            <td>20% Admin charge:</td>
            <td align='center' style="font-weight: bold; color: blue; font-size: 18px;"><?php $vat = 20/100; $totalSum = $getEstPage[0]->total_cost; $addedVal = ($vat * $totalSum); ?> {{ number_format($addedVal) }}</td>
          </tr>

          <tr>
              <td>Grand Total Cost:</td>
              <td align='center' style="font-weight: bold; font-size: 18px; color: green">{{ number_format($addedVal + $getEstPage[0]->total_cost, 2) }}</td>
          </tr>


          @else

          <tr>
              <td>Total Cost:</td>
              <td align='center' style="font-weight: bold; font-size: 18px;">{{ number_format($getEstPage[0]->total_cost, 2) }}</td>
          </tr>

          <tr>
            <td>20% Admin charge:</td>
            <td align='center' style="font-weight: bold; color: blue; font-size: 18px;"><?php $vat = 20/100; $totalSum = $getEstPage[0]->total_cost; $addedVal = ($vat * $totalSum); ?> {{ number_format($addedVal) }}</td>
        </tr>


          <tr>
              <td>Grand Total Cost:</td>
              <td align='center' style="font-weight: bold; font-size: 18px; color: green">{{ number_format($addedVal + $getEstPage[0]->total_cost, 2) }}</td>
          </tr>



          @endif


        @if($getEstPage[0]->service_note != "")
          <tr>
              <td>Service Note:</td>
              <td align='center'>{{ $getEstPage[0]->service_note }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->file != "noImage.png")
          <tr>
              <td>Uploaded File:</td>
              <td align='center'><a style="color: navy; text-decoration: none; font-weight: bold;" href="https://vimfile.com/uploads/{{ $getEstPage[0]->file }}" download="">Download file</a></td>
          </tr>
        @endif

        @if($gettechdetail[0]->ref_code != "" || $gettechdetail[0]->ref_code != null)

          <tr>
              <td>Technician Details:</td>
              <td align='center'><a style="color: navy; text-decoration: none; font-weight: bold;" href="/techniciandetail/{{ $gettechdetail[0]->ref_code }}">View detail</a></td>
          </tr>

        @else

          <tr>
              <td>Technician Details:</td>
              <td align='center' style="font-weight: bold; color: red">Information not available.</td>
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
        
        <div class="col-md-4" align="center">
            <button style="text-align: center;" class="btn btn-danger" onclick="printCopy('estCheck')">Print Copy</button>
        </div>

        <div class="col-md-4" align="center">
            <button style="text-align: center; color: #fff" class="btn btn-warning" onclick="sendMails('{{ $getEstPage[0]->estimate_id }}','{{ $getEstPage[0]->email }}')">Send as mail <img class="spinnersMail disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
        </div>

        <?php $locale = explode('/', $location->timezone); $continent = $locale[0];?>
        @if($continent == "Africa")

        <div class="col-md-4" align="center">
          <?php $vat = 20/100; $totalSum = $getEstPage[0]->total_cost; $addedVal = ($vat * $totalSum) + $totalSum; ?> 
            <button style="text-align: center;" class="btn btn-success" onclick="payWithPaystack('{{ round($addedVal) }}', '{{ $getEstPage[0]->email }}', '{{ $getEstPage[0]->update_by }}', '{{ $getEstPage[0]->opportunity_id }}','{{ $getEstPage[0]->estimate_id }}', '{{ Auth::user()->name }}')">Agree with Estimate <img class="spin disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
        </div>

        @elseif($continent == "America")

        <div class="col-md-4" align="center">

          <button class="btn btn-success" id="proceedPay">Proceed to Pay</button>
          <input type="hidden" name="paymentPin" id="paymentPin" value="{{ $getEstPage[0]->estimate_id }}">

          {{-- Pay with Moneris --}}
          {{-- <button style="text-align: center;" class="btn btn-success" onclick="location.href = '/monerispay/{{ $getEstPage[0]->estimate_id }}'">Proceed to Pay</button> --}}

        </div>

        @else

        <button class="btn btn-success" id="proceedPay">Proceed to Pay</button>
          <input type="hidden" name="paymentPin" id="paymentPin" value="{{ $getEstPage[0]->estimate_id }}">

        {{-- <?php $vat = 20/100; $totalSum = $getEstPage[0]->total_cost; $addedVal = ($vat * $totalSum) + $totalSum; ?> --}}
          {{-- <form action="{{ route('paypalpay') }}" method="post" target="_top">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="email" id="usermail" value="{{ $getEstPage[0]->email }}">
              <input type="hidden" name="price" id="amount" value="{{ $getEstPage[0]->total_cost }}">
              <input type="hidden" name="payto" id="payto" value="{{ $getEstPage[0]->update_by }}">
              <input type="hidden" name="postid" id="postid" value="{{ $getEstPage[0]->opportunity_id }}">
              <input type="hidden" name="estimate_id" id="estimate_id" value="{{ $getEstPage[0]->estimate_id }}">
              <input type="hidden" name="name" id="name" value="{{ Auth::user()->name }}">
              <input type="hidden" name="currency" id="currency" value="{{ $location->currency }}">
              <input type="hidden" name="transactionid" id="transactionid" value="{{ mt_rand('10000000', '99999999') }}">
              <input type="hidden" name="cmd" value="_s-xclick">
              <input type="hidden" name="hosted_button_id" value="QJ7TYPRZNMM8N">
              <table style="width: 100%">
              <tr><td><input type="hidden" name="on0" value="Subscription Option"></td></tr><tr><td><select name="os0" class="form-control">
                  
                  <option value="Payment for Estimate">Payment for Estimate : {{ $location->currency.' '.number_format($getEstPage[0]->total_cost, 2) }}</option>
              </select> </td></tr>
              </table>
              <input type="hidden" name="currency_code" value="CAD">
              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
          </form> --}}

          {{-- <div id="paypal-button-container"></div> --}}

          {{-- Test API ID --}}
          {{-- <script src="https://www.paypal.com/sdk/js?client-id=ATcrhTyXUKBj8Owt88vUDcInuUXk8C6DeIYh2JXrMz7NubJCIxtnnyZSo0yTM_OEzoA3EPxRo7FeC2yZ"></script> --}}

          {{-- Live API ID --}}
          {{-- <script src="https://www.paypal.com/sdk/js?client-id=AX6SU_4a4_K_-w1GyTiJHkwYvEi5jWjQ5ojqu4D56VfXWgm2HzftIjOlrYS7JzBzf8qlk1gqmPLvfDcg"></script>

          <script>
              // Paypal

              paypal.Buttons({
                createOrder: function(data, actions) {
                  return actions.order.create({
                    purchase_units: [{
                      amount: {
                        value: '{{ $addedVal }}'
                      }
                    }]
                  });
                },
                onApprove: function(data, actions) {
                  return actions.order.capture().then(function(details) {
                    alert('Transaction completed by ' + details.payer.name.given_name);
                    // Call your server to save the transaction
                    return fetch('/paypal-transaction-complete', {
                      method: 'post',
                      headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      body: JSON.stringify({
                        orderID: data.orderID,
                        name: '{{ Auth::user()->name }}',
                        email: '{{ Auth::user()->email }}',
                        amount: '{{ $addedVal }}',
                        station: '{{ $getEstPage[0]->update_by }}',
                        post_id: '{{ $getEstPage[0]->opportunity_id }}',
                        estimate_id: '{{ $getEstPage[0]->estimate_id }}',
                      })
                    });
                  });
                }
              }).render('#paypal-button-container');
          </script> --}}

        @endif
        
      <br><br>
            

      </tbody>
    </div>
<br><br>


@endsection