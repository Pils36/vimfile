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
            <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                    <div class="row">
                      <div class="col-md-12">
                        <p>
                            <div>
                                <p style="font-size: 20px; font-weight: bold; text-transform: capitalize; text-align: center;">{{ $transaction[0]->plan }} plan<p>
                                @if($transaction[0]->basic != '')
                                    <p style="font-size: 16px; text-align: center;">₦ {{ $transaction[0]->basic }}</p>
                                @elseif($transaction[0]->classic != '')
                                    <p style="font-size: 16px; text-align: center;">₦ {{ $transaction[0]->classic }}</p>
                                @elseif($transaction[0]->super != '')
                                    <p style="font-size: 16px; text-align: center;">₦ {{ $transaction[0]->super }}</p>
                                @elseif($transaction[0]->gold != '')
                                    <p style="font-size: 16px; text-align: center;">₦ {{ $transaction[0]->gold }}</p>
                                @elseif($transaction[0]->lite != '')
                                   <p style="font-size: 16px; text-align: center;">₦ {{ $transaction[0]->lite }}</p>
                                @endif
                                
                            </div>
                        </p>
                        <input type="hidden" name="email" value="{{ $transaction[0]->email }}"> {{-- required --}}
                        <input type="hidden" name="orderID" value="{{ $transaction[0]->transaction_id }}">
                        
                        @if($transaction[0]->basic != '')
                            <input type="hidden" name="amount" value="{{ $transaction[0]->basic * 100 }}"> {{-- required in kobo --}}
                        @elseif($transaction[0]->classic != '')
                            <input type="hidden" name="amount" value="{{ $transaction[0]->classic * 100 }}"> {{-- required in kobo --}}
                        @elseif($transaction[0]->super != '')
                            <input type="hidden" name="amount" value="{{ $transaction[0]->super * 100 }}"> {{-- required in kobo --}}
                        @elseif($transaction[0]->gold != '')
                            <input type="hidden" name="amount" value="{{ $transaction[0]->gold * 100 }}"> {{-- required in kobo --}}
                        @elseif($transaction[0]->lite != '')
                            <input type="hidden" name="amount" value="{{ $transaction[0]->lite * 100 }}"> {{-- required in kobo --}}
                        @endif
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="metadata" value="{{ json_encode($array = ['transaction_id' => $transaction[0]->transaction_id]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                        <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                        <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                        {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}
            
                         <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}
            
            
                        <p class="text-center">
                          <button class="btn btn-success btn-md" type="submit" value="Pay Now!">
                          <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                          </button>
                        </p>
                      </div>
                    </div>
            </form>
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
