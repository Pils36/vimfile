@extends('layouts.app')

@section('text/css')

<style>
    .about_part{
        height: 45vh !important;
    }
    #planSchedule > tr{
        font-size: 13px;
        text-align: center;
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
              <h2>{{ $pages }}</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->

    <!-- pricing part start-->
    <section class="pricing_part section_padding single_page_pricing">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section_tittle text-center">
                        <h2>{{ $pages }}</h2>
                    </div>
                </div>
            </div>


        <div class="row justify-content-center">
            <h3 style="margin-bottom: 20px; color: darkorange;">Use for FREE for 30days. Cancel or Deactivate account  anytime</h3>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Free <img align='right' src="https://img.icons8.com/officel/30/000000/free-shipping.png"></th>
                            <th>Lite <img align='right' src="https://img.icons8.com/cotton/30/000000/donate--v2.png"></th>
                            <th>Start Up <img align='right' src="https://img.icons8.com/color/30/000000/engine.png"></th>
                            <th>Basic <img align='right' src="https://img.icons8.com/plasticine/30/000000/car.png"></th>
                            <th>Classic <img align='right' src="https://img.icons8.com/dusk/30/000000/car-service.png"></th>
                            <th>Super <img align='right' src="https://img.icons8.com/clouds/30/000000/truck.png"></th>
                            <th>Gold <img align='right' src="https://img.icons8.com/color/30/000000/trophy.png"></th>
                        </tr>
                    </thead>

                    <tbody id="planSchedule">
                        <tr>
                            <td>Annual Subscription</td>
                            <td>Free Forever</td>
                            <td>NGN 10,000</td>
                            <td>Free Forever</td>
                            <td>NGN 25,000</td>
                            <td>NGN 50,000</td>
                            <td>NGN 90,000</td>
                            <td>NGN 150,000</td>
                        </tr>
                        <tr>
                            <td>No of Users</td>
                            <td>1</td>
                            <td>1</td>
                            <td>4 <br> (1 Admin + 3 Users)</td>
                            <td>7 <br> (1 Admin+ 6 Users)</td>
                            <td>1 <br> Admin + Unlimited</td>
                            <td>1 <br> Admin + Unlimited</td>
                            <td>1 <br> Admin + Unlimited</td>
                        </tr>
                        <tr>
                            <td>Max # of  Vehicle  per month</td>
                            <td>1</td>
                            <td>4</td>
                            <td>10</td>
                            <td>20</td>
                            <td>50</td>
                            <td>120</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>Email Reminder</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>Access  to Own  Service Records</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>Access to all VIM Records</td>
                            <td>No</td>
                            <td>No</td>
                            <td>No</td>
                            <td>No</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>Document  Uploads</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>Data Export</td>
                            <td>No</td>
                            <td>Yes</td>
                            <td>No</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>Additional Emails</td>
                            <td>No</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <button class="btn btn-info" style="cursor: pointer; color: #fff;" onclick="makePay('{{ $email }}', '0', 'Free')">Select Plan <img class="spinnerfree disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                            </td>
                            <td>
                                <button class="btn btn-info" style="cursor: pointer; color: #fff;" onclick="makePay('{{ $email }}', '10000', 'Lite')">Select Plan <img class="spinnerlite disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                            </td>
                            <td>
                                <button class="btn btn-info" style="cursor: pointer; color: #fff;" onclick="makePay('{{ $email }}', '0', 'Start-Up')">Select Plan <img class="spinnerstartup disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                            </td>
                            <td>
                                <button class="btn btn-info" style="cursor: pointer; color: #fff;" onclick="makePay('{{ $email }}', '25000', 'Basic')">Select Plan <img class="spinnerbasic disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                            </td>
                            <td>
                                <button class="btn btn-info" style="cursor: pointer; color: #fff;" onclick="makePay('{{ $email }}', '50000', 'Classic')">Select Plan <img class="spinnerclassic disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                            </td>
                            <td>
                                <button class="btn btn-info" style="cursor: pointer; color: #fff;" onclick="makePay('{{ $email }}', '90000', 'Super')">Select Plan <img class="spinnersuper disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                            </td>
                            <td>
                                <button class="btn btn-info" style="cursor: pointer;" onclick="makePay('{{ $email }}', '150000', 'Super')">Select Plan <img class="spinnergold disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>


        </div>
        <img src="img/left_sharp.png" alt="" class="left_shape_1">
        <img src="img/animate_icon/Shape-1.png" alt="" class="feature_icon_1">
        <img src="img/animate_icon/shape.png" alt="" class="feature_icon_4">
    </section>
    <!-- pricing part end-->

@endsection