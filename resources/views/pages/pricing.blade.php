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

            {{-- <h3 style="margin-bottom: 20px; color: darkorange;">Use for FREE for 30days. Cancel or Deactivate account  anytime</h3> --}}
            <h3 style="margin-bottom: 20px; color: darkorange;">Use for FREE FOREVER. Cancel or Deactivate account  anytime</h3>

          {{-- This Plan And Pricing Goes for African Countries --}}

          {{-- @if ($continent == "Africa") --}}


            <div class="table-responsive disp-0">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th></th>

                            @if(Auth::user()->userType == "Individual")
                            <th>Free <img align='right' src="https://img.icons8.com/officel/30/000000/free-shipping.png"></th>
                            <th>Lite <img align='right' src="https://img.icons8.com/cotton/30/000000/donate--v2.png"></th>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <th style="font-size: 12px">Lite<br>Commercial <img align='right' src="https://img.icons8.com/cotton/30/000000/commercial--v1.png"></th>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <th>Start Up <img align='right' src="https://img.icons8.com/color/30/000000/engine.png"></th>
                            <th>Basic <img align='right' src="https://img.icons8.com/plasticine/30/000000/car.png"></th>
                            <th>Classic <img align='right' src="https://img.icons8.com/dusk/30/000000/car-service.png"></th>
                            <th>Super <img align='right' src="https://img.icons8.com/clouds/30/000000/truck.png"></th>
                            <th>Gold <img align='right' src="https://img.icons8.com/color/30/000000/trophy.png"></th>
                            @endif
                        </tr>
                    </thead>

                    <tbody id="planSchedule">
                        <tr style="font-weight: 600; font-size: 18px;">
                            <td style="font-weight: 600; font-size: 16px;">Monthly Subscription</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>Free Forever</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->monthly }}</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->monthly2 }}</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>Free Forever</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->monthly3 }}</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->monthly4 }}</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->monthly5 }}</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->monthly7 }}</td>
                            @endif
                        </tr>
                        <tr style="font-weight: 600; font-size: 18px;">
                            <td style="font-weight: 600; font-size: 16px;">Annual Subscription</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>Free Forever</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->yearly }}</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->yearly2 }}</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>Free Forever</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->yearly3 }}</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->yearly4 }}</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->yearly5 }}</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->yearly7 }}</td>
                            @endif
                        </tr>

                        <tr>
                            <td style="font-weight: bold; color: red;">Subscription Plan (mnt | yr)</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>n/a</td>
                            <input type="hidden" name="usersType" id="usersType" value="{{ Auth::user()->userType }}">
                            <td align="center">
                                    mnt <input type="radio" name="litesub" id="monthlitesub" value="{{ $priceTag[0]->monthly }}"> |
                                <input type="radio" name="litesub" id="yearlitesub" value="{{ $priceTag[0]->yearly }}"> yr
                            </td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td align="center">
                                    mnt <input type="radio" name="litesub" id="monthlitecomsub" value="{{ $priceTag[0]->monthly2 }}"> |
                                <input type="radio" name="litesub" id="yearlitecomsub" value="{{ $priceTag[0]->yearly2 }}"> yr
                            </td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>n/a</td>
                            <td align="center">
                                    mnt <input type="radio" name="litesub" id="monthbasicsub" value="{{ $priceTag[0]->monthly3 }}"> |
                                <input type="radio" name="litesub" id="yearbasicsub" value="{{ $priceTag[0]->yearly3 }}"> yr
                            </td>
                            <td align="center">
                                    mnt <input type="radio" name="litesub" id="monthclassicsub" value="{{ $priceTag[0]->monthly4 }}"> |
                                <input type="radio" name="litesub" id="yearclassicsub" value="{{ $priceTag[0]->yearly4 }}"> yr
                            </td>
                            <td align="center">
                                    mnt <input type="radio" name="litesub" id="monthsupersub" value="{{ $priceTag[0]->monthly5 }}"> |
                                <input type="radio" name="litesub" id="yearsupersub" value="{{ $priceTag[0]->yearly5 }}"> yr
                            </td>
                            <td align="center">
                                    mnt <input type="radio" name="litesub" id="monthgoldsub" value="{{ $priceTag[0]->monthly7 }}"> |
                                <input type="radio" name="litesub" id="yeargoldsub" value="{{ $priceTag[0]->yearly7 }}"> yr
                            </td>
                            @endif
                        </tr>
                        <tr>
                            <td>No of Users</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>1</td>
                            <td>1</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>1</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>4 <br> (1 Admin + 3 Users)</td>
                            <td>7 <br> (1 Admin+ 6 Users)</td>
                            <td>1 <br> Admin + Unlimited</td>
                            <td>1 <br> Admin + Unlimited</td>
                            <td>1 <br> Admin + Unlimited</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Max # of  Vehicle  per month</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>1</td>
                            <td>4</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>1</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>10</td>
                            <td>20</td>
                            <td>50</td>
                            <td>120</td>
                            <td>Unlimited</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Email Reminder</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>Yes</td>
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Access  to Own  Service Records</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Access to all VIM Records</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>No</td>
                            <td>No</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>No</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>No</td>
                            <td>No</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            @endif

                        </tr>
                        <tr>
                            <td>Document  Uploads</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>Yes</td>
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Data Export</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>No</td>
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>No</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Additional Emails</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>No</td>
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            @endif

                        </tr>

                        <tr>


                            @if(Auth::user()->userType == "Commercial")
                            <td>Roboust iVim</td>
                            <td>Yes</td>
                            @endif

                        </tr>

                        <tr>



                            @if(Auth::user()->userType == "Commercial")
                            <td>Financials</td>
                            <td>Yes</td>
                            @endif


                        </tr>




                        <tr>
                            <td></td>
                            @if(Auth::user()->userType == "Individual")
                            <td>

                                <button class="btn btn-info" style="cursor: pointer; color: #fff;" onclick="makePay('{{ $email }}', '0', 'Free')">Select Plan <img class="spinnerfree disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>


                            </td>
                            @endif

                            @if(Auth::user()->userType == "Individual")
                            <td>

                                    <input type="hidden" name="payplan" id="litepayplan" value="">
                                    <button class="btn btn-info" style="cursor: pointer; color: #fff;" onclick="makePay('{{ $email }}', '10000', 'Lite')">Select Plan <img class="spinnerlite disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>


                            </td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")

                            <td>
                                <input type="hidden" name="payplan" id="litecompayplan" value="">
                                <button class="btn btn-info" style="cursor: pointer; color: #fff;" onclick="makePay('{{ $email }}', '40000', 'Lite-Commercial')">Click to Pay <img class="spinnercommercial disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                            </td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>

                                    <button class="btn btn-info" style="cursor: pointer; color: #fff;" onclick="makePay('{{ $email }}', '0', 'Start-Up')">Select Plan <img class="spinnerstartup disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>


                            </td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>

                                <input type="hidden" name="payplan" id="basicpayplan" value="">
                                <button class="btn btn-info" style="cursor: pointer; color: #fff;" onclick="makePay('{{ $email }}', '25000', 'Basic')">Select Plan <img class="spinnerbasic disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>



                            </td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>

                                <input type="hidden" name="payplan" id="classicpayplan" value="">
                                <button class="btn btn-info" style="cursor: pointer; color: #fff;" onclick="makePay('{{ $email }}', '50000', 'Classic')">Select Plan <img class="spinnerclassic disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                            </td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>

                                <input type="hidden" name="payplan" id="superpayplan" value="">
                                <button class="btn btn-info" style="cursor: pointer; color: #fff;" onclick="makePay('{{ $email }}', '90000', 'Super')">Select Plan <img class="spinnersuper disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>



                            </td>
                            <td>

                                <input type="hidden" name="payplan" id="goldpayplan" value="">
                                <button class="btn btn-info" style="cursor: pointer; color: #fff;" onclick="makePay('{{ $email }}', '90000', 'Gold')">Select Plan <img class="spinnergold disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>



                            </td>
                             @endif
                        </tr>
                    </tbody>
                </table>
            </div>




            {{-- Paypal Payment --}}
            {{-- @else --}}



            <div class="table-responsive">
                @if ($error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
                @endif

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            @if(Auth::user()->userType == "Individual")
                            <th>Free <img align='right' src="https://img.icons8.com/officel/30/000000/free-shipping.png"></th>
                            <th>Lite <img align='right' src="https://img.icons8.com/cotton/30/000000/donate--v2.png"></th>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <th style="font-size: 12px">Lite<br>Commercial <img align='right' src="https://img.icons8.com/cotton/30/000000/commercial--v1.png"></th>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <th>Start Up <img align='right' src="https://img.icons8.com/color/30/000000/engine.png"></th>
                            <th>Basic <img align='right' src="https://img.icons8.com/plasticine/30/000000/car.png"></th>
                            <th>Classic <img align='right' src="https://img.icons8.com/dusk/30/000000/car-service.png"></th>
                            <th>Super <img align='right' src="https://img.icons8.com/clouds/30/000000/truck.png"></th>
                            <th>Gold <img align='right' src="https://img.icons8.com/color/30/000000/trophy.png"></th>
                            @endif
                        </tr>
                    </thead>

                    <tbody id="planSchedule">
                        <tr style="font-weight: 600; font-size: 18px;">
                            <td style="font-weight: 600; font-size: 16px;">Monthly Subscription</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>Free Forever</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->monthly }}</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->monthly2 }}</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>Free Forever</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->monthly3 }}</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->monthly4 }}</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->monthly5 }}</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->monthly7 }}</td>
                            @endif
                        </tr>
                        <tr style="font-weight: 600; font-size: 18px;">
                            <td style="font-weight: 600; font-size: 16px;">Annual Subscription</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>Free Forever</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->yearly }}</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->yearly2 }}</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>Free Forever</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->yearly3 }}</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->yearly4 }}</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->yearly5 }}</td>
                            <td>{{ $priceTag[0]->currency.' '.$priceTag[0]->yearly7 }}</td>
                            @endif

                        </tr>
                        <tr>
                            <td>No of Users</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>1</td>
                            <td>1</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>1</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>2 <br> (1 Admin + 1 Users)</td>
                            <td>3 <br> (1 Admin+ 2 Users)</td>
                            <td>1 <br> Admin + Unlimited</td>
                            <td>1 <br> Admin + Unlimited</td>
                            <td>1 <br> Admin + Unlimited</td>
                            @endif

                        </tr>
                        <tr>
                            <td>Max # of  Vehicle  per month</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>1</td>
                            <td>4</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>1</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>10</td>
                            <td>20</td>
                            <td>50</td>
                            <td>120</td>
                            <td>Unlimited</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Email Reminder</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>Yes</td>
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            @endif

                        </tr>
                        <tr>
                            <td>Access  to Own  Service Records</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>Yes</td>
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            @endif

                        </tr>
                        <tr>
                            <td>Access to all VIM Records</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>No</td>
                            <td>No</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>No</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>No</td>
                            <td>No</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            @endif

                        </tr>
                        <tr>
                            <td>Document  Uploads</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>Yes</td>
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            @endif

                        </tr>
                        <tr>
                            <td>Data Export</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>No</td>
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>No</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Additional Emails</td>
                            @if(Auth::user()->userType == "Individual")
                            <td>No</td>
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Commercial")
                            <td>Yes</td>
                            @endif

                            @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            @endif

                        </tr>

                        <tr>



                            @if(Auth::user()->userType == "Commercial")
                            <td>Roboust iVim</td>
                            <td>Yes</td>
                            @endif


                        </tr>

                        <tr>



                            @if(Auth::user()->userType == "Commercial")
                            <td>Financials</td>
                            <td>Yes</td>
                            @endif


                        </tr>

                        <tr>
                            <td></td>
                            <td colspan="8">
                                <center>
                                  {{-- <form action="{{ route('paypalpay') }}" method="post" target="_top">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="email" id="usermail" value="{{ $email }}">
                                  <input type="hidden" name="cmd" value="_s-xclick">
                                  <input type="hidden" name="hosted_button_id" value="PQZYMJVUVJMFE">
                                  <table style="width: 100%">
                                  <tr><td><input type="hidden" name="on0" value="Subscription Option">Subscription Option</td></tr><tr><td><select name="os0" class="form-control">
                                    <option value="Personal-Free">Personal-Free : Free Forever</option>
                                    <option value="Business-StartUp">Business-Start Up : Free Forever</option>
                                    <option value="Personal-Lite">Personal-Lite : $40.00 CAD - yearly</option>
                                    <option value="Business-Basic">Business-Basic : $100.00 CAD - yearly</option>
                                    <option value="Business-Classic">Business-Classic : $200.00 CAD - yearly</option>
                                    <option value="Business-Super">Business-Super : $360.00 CAD - yearly</option>
                                    <option value="Business-Gold">Business-Gold : $600.00 CAD - yearly</option>
                                  </select> </td></tr>
                                  </table>
                                  <input type="hidden" name="currency_code" value="CAD">
                                  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                  </form> --}}



                                  @if(Auth::user()->userType == "Commercial")

                                  <form action="{{ route('paypalpay') }}" method="post" target="_top">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="email" id="usermail" value="{{ $email }}">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="PQZYMJVUVJMFE">
                                    <table style="width: 100%">
                                    <tr><td><input type="hidden" name="on0" value="Subscription Option">Subscription Option</td></tr><tr><td><select name="os0" class="form-control">

                                        <option value="Personal-Lite (Commercial) (M)">Personal-Lite (Commercial) (M) : {{ $priceTag[0]->monthly2.' '.$priceTag[0]->currency }} - monthly</option>
                                        <option value="Personal-Lite (Commercial) (A)">Personal-Lite (Commercial) (A) : {{ $priceTag[0]->yearly2.' '.$priceTag[0]->currency }} - yearly</option>
                                    </select> </td></tr>
                                    </table>
                                    <input type="hidden" name="currency_code" value="CAD">
                                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                    </form>

                                  @else


                                  <form action="{{ route('paypalpay') }}" method="post" target="_top">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="email" id="usermail" value="{{ $email }}">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="PQZYMJVUVJMFE">
                                    <table style="width: 100%">
                                    <tr><td><input type="hidden" name="on0" value="Subscription Option">Subscription Option</td></tr><tr><td><select name="os0" class="form-control">
                                        @if(Auth::user()->userType == "Individual")
                                        <option value="Personal-Free">Personal-Free : Free Forever</option>
                                        @endif

                                        @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )
                                        <option value="Business-StartUp">Business-Start Up : Free Forever</option>
                                        @endif

                                        @if(Auth::user()->userType == "Individual")


                                        <option value="Personal-Lite (M)">Personal-Lite (M) : {{ $priceTag[0]->monthly.' '.$priceTag[0]->currency }} - monthly</option>
                                        <option value="Personal-Lite (A)">Personal-Lite (A) : {{ $priceTag[0]->yearly.' '.$priceTag[0]->currency }} - yearly</option>


                                        {{-- <option value="BusyWrench-Monthly">Personal-Lite (M) : {{ $priceTag[0]->monthly.' '.$priceTag[0]->currency }} - monthly</option>
                                        <option value="BusyWrench-Annually">Personal-Lite (A) : {{ $priceTag[0]->yearly.' '.$priceTag[0]->currency }} - yearly</option> --}}




                                        @endif

                                        @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Auto Dealer" )

                                        <option value="Basic  Plan (M)">Basic  Plan (M) : {{ $priceTag[0]->monthly3.' '.$priceTag[0]->currency }} - monthly</option>
                                        <option value="Basic Plan  (A)">Basic Plan  (A) : {{ $priceTag[0]->yearly3.' '.$priceTag[0]->currency }} - yearly</option>
                                        <option value="Classic Plan  (M)">Classic Plan  (M) : {{ $priceTag[0]->monthly4.' '.$priceTag[0]->currency }} - monthly</option>
                                        <option value="Classic Plan  (A)">Classic Plan  (A) : {{ $priceTag[0]->yearly4.' '.$priceTag[0]->currency }} - yearly</option>
                                        <option value="Super Plan (M)">Super Plan (M) : {{ $priceTag[0]->monthly5.' '.$priceTag[0]->currency }} - monthly</option>
                                        <option value="Super Plan (A)">Super Plan (A) : {{ $priceTag[0]->yearly5.' '.$priceTag[0]->currency }} - yearly</option>
                                        <option value="Gold Plan (M)">Gold Plan (M) : {{ $priceTag[0]->monthly7.' '.$priceTag[0]->currency }} - monthly</option>
                                        <option value="Gold Plan (A)">Gold Plan (A) : {{ $priceTag[0]->yearly7.' '.$priceTag[0]->currency }} - yearly</option>


                                        {{-- <option value="BusyWrench-Monthly">Business-Basic (M) : {{ $priceTag[0]->monthly3.' '.$priceTag[0]->currency }} - monthly</option>
                                        <option value="BusyWrench-Annually">Business-Basic (A) : {{ $priceTag[0]->yearly3.' '.$priceTag[0]->currency }} - yearly</option>
                                        <option value="BusyWrench-Monthly">Business-Classic (M) : {{ $priceTag[0]->monthly4.' '.$priceTag[0]->currency }} - monthly</option>
                                        <option value="BusyWrench-Annually">Business-Classic (A) : {{ $priceTag[0]->yearly4.' '.$priceTag[0]->currency }} - yearly</option>
                                        <option value="BusyWrench-Monthly">Business-Super (M) : {{ $priceTag[0]->monthly5.' '.$priceTag[0]->currency }} - monthly</option>
                                        <option value="BusyWrench-Annually">Business-Super (A) : {{ $priceTag[0]->yearly5.' '.$priceTag[0]->currency }} - yearly</option> --}}


                                        @endif

                                    </select> </td></tr>
                                    </table>
                                    <input type="hidden" name="currency_code" value="CAD">
                                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                    </form>

                                  @endif


                                </center>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- @endif --}}




        </div>


        </div>
        <img src="img/left_sharp.png" alt="" class="left_shape_1">
        <img src="img/animate_icon/Shape-1.png" alt="" class="feature_icon_1">
        <img src="img/animate_icon/shape.png" alt="" class="feature_icon_4">
    </section>
    <!-- pricing part end-->

@endsection
