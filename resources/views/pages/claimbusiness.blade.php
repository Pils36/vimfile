@extends('layouts.app')

@section('text/css')

<style>
    .about_part{
        height: 45vh !important;
    }
    input[type="search"] {
        width: 300px;
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
                    <div class="col-lg-12">
                <br><br>

                        <h2 style="text-decoration: underline;">{{ $pages }}</h2> <br>
                        <div class="wprt-action-box style-1 has-icon">
                            <div class="inner">
                                <div class="heading-wrap">
                                    <div class="text-wrap">
                                        <h3 class="heading">Can not find your business? Don't worry!!! <a href="{{ route('register') }}" class="btn btn-primary" type="button">OPEN AN ACCOUNT</a> </h3>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <br>

                </div>


                
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="table table-responsive">
                        <table class="table table-striped table-bordered" id="claimstable">
                             <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Company</th>
                                        <th>Address</th>
                                        <th>City/State</th>
                                        <th>Search count</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($claims) > 0 || $claims != "")

                                    <?php $i= 1; ?>
                                    @foreach($claims as $datas)

                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $datas->company }}</td>
                                        <td>{{ $datas->address }}</td>
                                        <td>{{ $datas->location }}</td>
                                        <td>{{ $datas->search_count }}</td>
                                        <td>
                                            <button class="btn btn-primary" onclick="checkClaim('{{ $datas->company }}', '{{ $datas->telephone }}', {{ $i }})">Claim Business <img class="spin{{ $i }} disp-0" src="https://i.ya-webdesign.com/images/loading-gif-png-5.gif" style="width: 20px; height: 20px;"></button>
                                        </td>
                                    </tr>

                                    @endforeach

                                    @else

                                    <tr>
                                        <td colspan="5" align="center">No result found</td>
                                    </tr>
                                    
                                    @endif
                                    
                                </tbody>
                        </table>
                    </div>
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