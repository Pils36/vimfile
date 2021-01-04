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
              <h2>Comment on Job done</h2>
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
          <h2 class="contact-title">Let's know what you think <b>{{ $technician_info[0]->station_name }}</b> service to you</h2>
        </div>
        <div class="col-lg-8">

          @if(count($getEstPage) > 0)

          <form class="form-contact contact_form" action="#" method="post" id="contactForm"
            novalidate="novalidate">
            <div class="row">
             
              <div class="col-sm-6">
                <div class="form-group">
                  <input type="hidden" name="refCode" id="refCode" value="{{ Auth::user()->ref_code }}">
                  <input type="hidden" name="station_name" id="station_name" value="{{ $getEstPage[0]->update_by }}">
                  <input type="hidden" name="post_id" id="post_id" value="{{ $getEstPage[0]->opportunity_id }}">
                  <input type="hidden" name="technician" id="technician" value="{{ $technician_info[0]->name }}">

                </div>
              </div>
              <div class="col-sm-12">
                <h6>Rating</h6><br>
                <div class="form-group">
                  <select class="form-control" name="rating" id="rating">
                    <option value="">Select from 1 - 10</option>
                    @for($i=1; $i<=10; $i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                  </select>
                  
                </div>
              </div>

              <div class="col-12">
                <h6>Comment</h6><br>
                <div class="form-group">
                  <textarea class="form-control" name="comment" id="comment" style="resize: none;" rows="5"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group mt-3">
              <button type="button" class="button button-monerisForm btn_1" onclick="reviewMechanic()">Submit <img class="spinnerReview disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"> <i class="flaticon-right-arrow arros"></i> </button>
            </div>
          </form>




          @endif

          
        </div>

      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->



@endsection