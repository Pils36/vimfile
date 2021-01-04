@extends('layouts.dashboard')

@section('title', 'Dashboard')

@show


@section('dashContent')

<div class="wrapper">

  @include('includes.dashhead')
  @include('includes.dashaside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <div class="box">

        <h4></h4>

            {{-- @if ($continent == "Africa") --}}

            <div class="table-responsive disp-0">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            
                            <th>Start Up <img align='right' src="https://img.icons8.com/color/30/000000/engine.png"></th>
                            <th>Basic <img align='right' src="https://img.icons8.com/plasticine/30/000000/car.png"></th>
                            <th>Classic <img align='right' src="https://img.icons8.com/dusk/30/000000/car-service.png"></th>
                            <th>Super <img align='right' src="https://img.icons8.com/clouds/30/000000/truck.png"></th>
                            <th>Gold <img align='right' src="https://img.icons8.com/color/30/000000/trophy.png"></th>
                        </tr>
                    </thead>

                    <tbody id="planSchedule">
                        <tr style="font-weight: 600; font-size: 18px;">
                            <td style="font-weight: 600; font-size: 16px;">Monthly Subscription</td>
                            
                            <td>Free Forever</td>
                            <td>NGN 2,500</td>
                            <td>NGN 5,000</td>
                            <td>NGN 9,000</td>
                            <td>NGN 15,000</td>
                        </tr>
                        <tr style="font-weight: 600; font-size: 18px;">
                            <td style="font-weight: 600; font-size: 16px;">Annual Subscription</td>
                            
                            <td>Free Forever</td>
                            <td>NGN 25,000</td>
                            <td>NGN 50,000</td>
                            <td>NGN 90,000</td>
                            <td>NGN 150,000</td>
                        </tr>
                        <tr>
                            <td>No of Users</td>
                            
                            <td>4 <br> (1 Admin + 3 Users)</td>
                            <td>7 <br> (1 Admin+ 6 Users)</td>
                            <td>1 <br> Admin + Unlimited</td>
                            <td>1 <br> Admin + Unlimited</td>
                            <td>1 <br> Admin + Unlimited</td>
                        </tr>
                        <tr>
                            <td>Max # of  Vehicle  per month</td>
                            
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
                        </tr>
                        <tr>
                            <td>Access  to Own  Service Records</td>
                            
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
                        </tr>
                        <tr>
                            <td>Data Export</td>
                           
                            <td>No</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>Additional Emails</td>
                            
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                        </tr>

                        <tr>
                            <td></td>
                            
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
                            
                            <th>Start Up <img align='right' src="https://img.icons8.com/color/30/000000/engine.png"></th>
                            <th>Basic <img align='right' src="https://img.icons8.com/plasticine/30/000000/car.png"></th>
                            <th>Classic <img align='right' src="https://img.icons8.com/dusk/30/000000/car-service.png"></th>
                            <th>Super <img align='right' src="https://img.icons8.com/clouds/30/000000/truck.png"></th>
                            <th>Gold <img align='right' src="https://img.icons8.com/color/30/000000/trophy.png"></th>
                        </tr>
                    </thead>

                    <tbody id="planSchedule">
                        <tr style="font-weight: 600; font-size: 18px;">
                            <td style="font-weight: 600; font-size: 16px;">Monthly Subscription</td>
                            
                            <td>Free Forever</td>
                            <td>$ 10 CAD</td>
                            <td>$ 20 CAD</td>
                            <td>$ 36 CAD</td>
                            <td>$ 60 CAD</td>
                        </tr>
                        <tr style="font-weight: 600; font-size: 18px;">
                            <td style="font-weight: 600; font-size: 16px;">Annual Subscription</td>
                            
                            <td>Free Forever</td>
                            <td>$ 100 CAD</td>
                            <td>$ 200 CAD</td>
                            <td>$ 360 CAD</td>
                            <td>$ 600 CAD</td>
                        </tr>
                        <tr>
                            <td>No of Users</td>
                            
                            <td>4 <br> (1 Admin + 3 Users)</td>
                            <td>7 <br> (1 Admin+ 6 Users)</td>
                            <td>1 <br> Admin + Unlimited</td>
                            <td>1 <br> Admin + Unlimited</td>
                            <td>1 <br> Admin + Unlimited</td>
                        </tr>
                        <tr>
                            <td>Max # of  Vehicle  per month</td>
                            
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
                        </tr>
                        <tr>
                            <td>Access  to Own  Service Records</td>
                            
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
                        </tr>
                        <tr>
                            <td>Data Export</td>
                            
                            <td>No</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>Additional Emails</td>
                            
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td colspan="8">
                                <center>
                                  <form action="{{ route('paypalpay') }}" method="post" target="_top">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="email" id="usermail" value="{{ $email }}">
                                  <input type="hidden" name="cmd" value="_s-xclick">
                                  <input type="hidden" name="hosted_button_id" value="PQZYMJVUVJMFE">
                                  <table style="width: 100%">
                                  <tr><td><input type="hidden" name="on0" value="Subscription Option">Subscription Option</td></tr><tr><td><select name="os0" class="form-control">
                                    <option value="Business-StartUp">Business-Start Up : Free Forever</option>
                                    {{-- <option value="Business-Basic">Business-Basic : $100.00 CAD - yearly</option>
                                    <option value="Business-Classic">Business-Classic : $200.00 CAD - yearly</option>
                                    <option value="Business-Super">Business-Super : $360.00 CAD - yearly</option>
                                    <option value="Business-Gold">Business-Gold : $600.00 CAD - yearly</option> --}}
                                    
                                    {{-- <option value="BusyWrench-Monthly">BusyWrench-Monthly : $10.00 CAD - monthly</option>
                                    <option value="BusyWrench-Annually">BusyWrench-Annually : $100.00 CAD - yearly</option> --}}

                                    <option value="Basic  Plan (M)">Basic  Plan (M) : $10.00 CAD - monthly</option>
                                    <option value="Basic Plan  (A)">Basic Plan  (A) : $100.00 CAD - yearly</option>
                                    <option value="Classic Plan  (M)">Classic Plan  (M) : $20.00 CAD - monthly</option>
                                    <option value="Classic Plan  (A)">Classic Plan  (A) : $200.00 CAD - yearly</option>
                                    <option value="Super Plan (M)">Super Plan (M) : $36.00 CAD - monthly</option>
                                    <option value="Super Plan (A)">Super Plan (A) : $360.00 CAD - yearly</option>
                                    <option value="Gold Plan (M)">Gold Plan (M) : $60.00 CAD - monthly</option>
                                    <option value="Gold Plan (A)">Gold Plan (A) : $600.00 CAD - yearly</option>

                                  </select> </td></tr>
                                  </table>
                                  <input type="hidden" name="currency_code" value="CAD">
                                  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                  </form>
                                </center>                                  
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- @endif --}}
    </div>
    <!-- /.box -->

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer disp-0">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.13
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
    reserved.
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@endsection
