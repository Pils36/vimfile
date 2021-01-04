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



       <!-- feature_part start-->
    <section class="feature_part">
        <div class="container">
            <div class="row">

                    <div class="col-lg-12">
                        <h2 style="text-decoration: underline;">{{ $pages }}</h2> <br>

                        <ul style="font-size: 14px">
                            <li>Track vehicle maintenance activities</li> <br>
                            <li>Set up maintenance reminders</li><br>
                            <li>Send reminders to multiple emails</li><br>
                            <li>Track maintenane and services costs</li><br>
                            <li>Use analytics for planned and schedule maintenance</li><br>
                            <li>Budget for your vehicle maintenance costs</li><br>
                            <li>Access maintenance records anywhere, wherever</li><br>
                            <li>Keep eCopy of Warranties and repairs receipts</li><br>
                            <li>Export Data or integrate with other softwares</li><br>
                            <li>Ask questions from Experts</li> <br>
                        </ul> 
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