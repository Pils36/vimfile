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
                <div class="col-lg-3 col-sm-6">
                    
                    <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
        <div class="row" style="margin-bottom:40px;">
          <div class="col-md-12 col-md-offset-2">
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
                    @elseif($transaction[0]->litecommercial != '')
                       <p style="font-size: 16px; text-align: center;">₦ {{ $transaction[0]->litecommercial }}</p>
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
            @elseif($transaction[0]->litecommercial != '')
                <input type="hidden" name="amount" value="{{ $transaction[0]->litecommercial * 100 }}"> {{-- required in kobo --}}
            @endif
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="metadata" value="{{ json_encode($array = ['transaction_id' => $transaction[0]->transaction_id]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
            <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
            {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

             <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}


            <p>
              <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
              <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
              </button>
            </p>
          </div>
        </div>
</form>
                </div>
                
            </div>
        </div>
        <img src="img/left_sharp.png" alt="" class="left_shape_1">
        <img src="img/animate_icon/Shape-1.png" alt="" class="feature_icon_1">
        <img src="img/animate_icon/shape.png" alt="" class="feature_icon_4">
    </section>
    <!-- pricing part end-->

@endsection