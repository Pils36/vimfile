@extends('layouts.app')

@section('text/css')

<style>
    .about_part{
        height: 45vh !important;
    }
</style>

@show

@section('content')

  <!-- breadcrumb start-->
  <section class="breadcrumb banner_part">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb_iner text-center">
            <div class="breadcrumb_iner_item">
              <h2>Make Payment</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->


  <section class="contact-section section_padding">
    <div class="container">


      <div class="row">
        <div class="col-12">
          Powered by <img src="https://logodix.com/logo/2028590.png" style="width: 200px; height: auto;">
          <p style="font-weight: bold;"><img src="https://img.icons8.com/color/64/000000/mastercard.png" style="width: 30px; height: 30px;"><img src="https://img.icons8.com/color/48/000000/visa.png" style="width: 30px; height: 30px;"><img src="https://img.icons8.com/color/48/000000/discover.png" style="width: 30px; height: 30px;"><img src="https://img.icons8.com/color/48/000000/amex.png" style="width: 30px; height: 30px;"><img src="https://img.icons8.com/color/48/000000/unionpay.png" style="width: 30px; height: 30px;"><img src="https://img.icons8.com/officel/40/000000/jcb.png" style="width: 30px; height: 30px;"><img src="https://camo.githubusercontent.com/8a230dcc51bc201e8b1b5589c35bb8c43ee9bf6f/687474703a2f2f692e696d6775722e636f6d2f316a32647156372e706e67" style="width: 30px; height: 30px;"></p><br>
          <h2 class="contact-title">All fields are required</h2>
        </div>
        <div class="col-lg-8">

          @if(count($getEstPage) > 0)

          <form class="form-contact contact_form" action="#" method="post" id="contactForm"
            novalidate="novalidate">
            <div class="row">
             
              <div class="col-sm-6">
                <h6>Fullname</h6><br>
                <div class="form-group">
                  <input type="hidden" name="customerID" id="customerID" value="{{ Auth::user()->ref_code }}">
                  <input type="hidden" name="updateby" id="updateby" value="{{ $getEstPage[0]->update_by }}">
                  <input type="hidden" name="opportID" id="opportID" value="{{ $getEstPage[0]->opportunity_id }}">
                  <input type="hidden" name="estimateID" id="estimateID" value="{{ $getEstPage[0]->estimate_id }}">

                  <input class="form-control" name="name" id="full_name" type="text" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Enter your name'" value="{{ Auth::user()->name }}" readonly="">
                </div>
              </div>
              <div class="col-sm-6">
                <h6>Email</h6><br>
                <div class="form-group">
                  <input class="form-control" name="email" id="my_email" type="email" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Enter email address'" value="{{ Auth::user()->email }}" readonly="">
                </div>
              </div>


              @if($getPart != "")
                <div class="col-12">
                  <h6>Amount </h6><br>
                  <div class="form-group">
                    <?php $totalSum = $getEstPage[0]->total_cost; ?>
                    <input class="form-control" name="tot_amount" id="tot_amount" type="text" onfocus="this.placeholder = ''"
                      onblur="this.placeholder = 'Total Amount'" value="{{ str_replace(",", "", number_format($totalSum, 2)) }}" readonly="">
                  </div>
                </div>
                <div class="col-12">
                  <h6>Tax inclusive </h6><br><small style="color: red; font-size: 14px; font-weight: bold;">20% Admin charges would be added to the final amount payable as vimfile charges</small><br>
                  <div class="form-group">
                    <?php $vat = 20/100; $addedVal = ($vat * $totalSum) + $totalSum; ?>
                    <input class="form-control" name="addedvat_amount" id="addedvat_amount" type="text" onfocus="this.placeholder = ''"
                      onblur="this.placeholder = 'Total Amount'" value="{{ str_replace(",", "", number_format($addedVal, 2)) }}" readonly="">
                  </div>
                </div>
              @else

              <div class="col-12">
                  <h6>Amount </h6><br>
                  <div class="form-group">
                    <?php $totalSum = $getEstPage[0]->total_cost; ?>
                    <input class="form-control" name="tot_amount" id="tot_amount" type="text" onfocus="this.placeholder = ''"
                      onblur="this.placeholder = 'Total Amount'" value="{{ str_replace(",", "", number_format($totalSum, 2)) }}" readonly="">
                  </div>
                </div>

                <div class="col-12">
                  <h6>Tax inclusive </h6><br><small style="color: red; font-size: 14px; font-weight: bold;">20% Admin charges would be added to the final amount payable as vimfile charges</small><br>
                  <div class="form-group">
                    <?php $vat = 20/100; $addedVal = ($vat * $totalSum) + $totalSum; ?>
                    <input class="form-control" name="addedvat_amount" id="addedvat_amount" type="text" onfocus="this.placeholder = ''"
                      onblur="this.placeholder = 'Total Amount'" value="{{ str_replace(",", "", number_format($addedVal, 2)) }}" readonly="">
                  </div>
                </div>

              @endif

              <div class="col-4">
                <h6>Currency</h6><br>
                <div class="form-group">
                  <select name="currency" id="currency" class="form-control">
                    <option value="CAD">CAD</option>
                    <option value="USD">USD</option>
                  </select>
                </div>
              </div>
              
               <div class="col-8">
                <h6>Credit Card Number</h6><br>
                <div class="form-group">
                  <input class="form-control" maxlength="16" name="creditcard_no" id="creditcard_no" type="text" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Credit Card Number'" placeholder='Enter Credit Card Number *'>
                </div>
              </div>

              <div class="col-6">
                <h6>Card Expiry Month</h6><br>
                <div class="form-group">
                  <select name="card_month" id="card_month" class="form-control">
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                </div>
              </div>

              <div class="col-6">
                <h6>Card Expiry Year</h6><br>
                <div class="form-group">
                  <select name="expirydate" id="expirydate" class="form-control">
                    @for ($i = date('Y'); $i <= date('Y')+30; $i++)
                      <option value="{{ preg_replace('~\d~', '', $i, 2) }}">{{ $i }}</option>
                    @endfor
                </select>

                </div>
              </div>

              <div class="col-12">
                <h6>Transaction Description</h6><br>
                <div class="form-group">
                  <input class="form-control" name="trans_description" id="trans_description" type="text" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Transaction Description'" placeholder='Enter Description *'>
                </div>
              </div>
            </div>

            <div class="form-group mt-3">
              <button type="button" class="button button-monerisForm btn_2" onclick="monerisPay()" style="width: 100%;">Make Payment <img class="spinnerMoneris disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"> <i class="fas fa-credit-card"></i> </button>
            </div>

          </form>



          @endif

          
        </div>
        <div class="col-lg-4 disp-0">
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-home"></i></span>
            <div class="media-body">
              <h3>Professionals' File Inc.</h3>
              <p>10 George St. North,</p>
              <p>Brampton ON L6X1R2,</p>
              <p>Canada</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-email"></i></span>
            <div class="media-body">
              <h3> info@vimfile.com</h3>
              <p>Send us your query anytime!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->



@endsection