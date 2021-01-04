@extends('layouts.app')

@section('text/css')

<style>
    .about_part{
        height: 45vh !important;
    }
</style>

@show

@section('content')

    <!-- banner part start-->
    <section class="banner_part about_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h1 class="m-t-100">{{ $pages }}</h1>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->



       <!-- feature_part start-->
    <section class="feature_part">
        <div class="container">
            <div class="row">

                    <div class="col-lg-12"> <br>
                        <h2 style="text-decoration: underline;">{{ $pages }}</h2> <br>
                        
                        @if(Auth::user()->userType == "Commercial")

                            <table class="table table-striped">
                                <thead>
                                    <th>Type of Account</th>
                                    <th>Referred</th>
                                    <th>Points</th>
                                    <th>Redeeming Point</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ Auth::user()->userType }}</td>
                                        <td>{{ $getRefs * 1000 }}</td>
                                        <td>{{ $getRefs * 1000 }}</td>
                                        <td>10000</td>
                                        @if($getRefs >= 10)<td><button class="btn btn-danger btn-sm" onclick="redeemPoint('{{ Auth::user()->ref_code }}', 'claim', 'Commercial', '{{ $getRefs }}')">Click to activate redemption <img class="spinredeem disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button></td>@else <td><button class="btn btn-primary btn-sm" onclick="redeemPoint('{{ Auth::user()->ref_code }}', 'noteligible', 'Commercial', '{{ $getRefs }}')">Click to activate redemption <img class="spinredeem disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button></td> @endif
                                    </tr>
                                </tbody>
                            </table>

                            <div>
                                <h3 style="background: darkorange; color: white; border: 1px solid darkorange; width: auto; padding: 7px; text-align: center;">Redeem for Free Oil Change</h3> <br>
                                <p style="color: black;">
                                    Redeem for 1-Year Free Oil Change at Approved Autocare Centre/ with Mobile Mechanics Near you.
                                </p> <br>
                                <p style="font-weight: bolder; color: black;">
                                    <em>Watch out for more redemption options</em>
                                </p>
                            </div>
                            <br><br>

                        @elseif(Auth::user()->userType == "Individual")

                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th>Type of Account</th>
                                    <th>Referred</th>
                                    <th>Points</th>
                                    <th>Redeeming Point</th>
                                    <th style="text-align: center;">Action</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ Auth::user()->userType }} (Non-Commercial)</td>
                                        <td>{{ $getRefs * 1000 }}</td>
                                        <td>{{ $getRefs * 1000 }}</td>
                                        <td>50000</td>
                                        @if($getRefs >= 50)<td align="center"><button class="btn btn-danger btn-sm" onclick="redeemPoint('{{ Auth::user()->ref_code }}', 'claim', 'Individual', '{{ $getRefs }}')">Click to activate redemption <img class="spinredeem disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button></td>@else <td align="center"><button class="btn btn-primary btn-sm" onclick="redeemPoint('{{ Auth::user()->ref_code }}', 'noteligible', 'Individual', '{{ $getRefs }}')">Click to activate redemption <img class="spinredeem disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button></td> @endif
                                    </tr>
                                </tbody>
                            </table>

                            <div>
                                <h3 style="background: darkorange; color: white; border: 1px solid darkorange; width: auto; padding: 7px; text-align: center;">Redeem for Free Oil Change</h3> <br>
                                <p style="color: black;">
                                    Redeem for 1-Year Free Oil Change at Approved Autocare Centre/ with Mobile Mechanics Near you.
                                </p> <br>
                                <p style="font-weight: bolder; color: black;">
                                    <em>Watch out for more redemption options</em>
                                </p>
                            </div>
                            <br><br>

                        @else

                        <table class="table table-striped">
                            <tbody>
                                <tr><td colspan="5" align="center">No redeeming offer for your plan yet.</td></tr>
                            </tbody>
                        </table>

                        @endif

                    </div>


                
            </div>
        </div>

    </section>
    <!-- upcoming_event part start-->


    <!-- cta part start-->
    <section class="cta_part section_padding disp-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="cta_text text-center">
                        <h2>Very useful Friendly</h2>
                        <p></p>
                        <a href="#" class="btn_2 banner_btn_1">Get Started </a>
                        <a href="#" class="btn_2 banner_btn_2">Sign up for free </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cta part end-->

@endsection