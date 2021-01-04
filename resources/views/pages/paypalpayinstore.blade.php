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
          Powered by <img src="https://www.freepnglogos.com/uploads/paypal-logo-png-3.png" style="width: 200px; height: auto;">
          <p style="font-weight: bold;"><img src="https://img.icons8.com/color/64/000000/mastercard.png" style="width: 30px; height: 30px;"><img src="https://img.icons8.com/color/48/000000/visa.png" style="width: 30px; height: 30px;"><img src="https://img.icons8.com/color/48/000000/discover.png" style="width: 30px; height: 30px;"><img src="https://img.icons8.com/color/48/000000/amex.png" style="width: 30px; height: 30px;"></p><br>
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
                  <input type="hidden" name="updateby" id="updateby" value="{{ Auth::user()->station }}">
                  <input type="hidden" name="paidto" id="paidto" value="{{ $getEstPage[0]->technician }}">
                  <input type="hidden" name="estimateID" id="estimateID" value="{{ $getEstPage[0]->estimate_id }}">
                  <input type="hidden" name="paymentpurpose" id="paymentpurpose" value="Payment for labour work">

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
                    <?php $totalSum = $getEstPage[0]->total_amount; ?>
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
                    <?php $totalSum = $getEstPage[0]->total_amount; ?>
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
              
               <div id="paypal-button-container"></div>

          {{-- Test API ID --}}
          {{-- <script src="https://www.paypal.com/sdk/js?client-id=ATcrhTyXUKBj8Owt88vUDcInuUXk8C6DeIYh2JXrMz7NubJCIxtnnyZSo0yTM_OEzoA3EPxRo7FeC2yZ"></script> --}}

          {{-- Live API ID --}}
          <script src="https://www.paypal.com/sdk/js?client-id=AX6SU_4a4_K_-w1GyTiJHkwYvEi5jWjQ5ojqu4D56VfXWgm2HzftIjOlrYS7JzBzf8qlk1gqmPLvfDcg"></script>

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
                    return fetch('/paypal-transaction-instore', {
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
                        station: '{{ Auth::user()->station }}',
                        technician: '{{ $getEstPage[0]->technician }}',
                        estimate_id: '{{ $getEstPage[0]->estimate_id }}',
                        purpose: 'Payment for labour work',
                      })
                    });
                  });
                }
              }).render('#paypal-button-container');
          </script>
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