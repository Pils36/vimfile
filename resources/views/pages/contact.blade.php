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
              <h2>contact us</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->

  <!-- ================ contact section start ================= -->

  @if($busInfo)

  <section class="contact-section section_padding">
    <div class="container">
      <div class="d-none d-sm-block mb-5 pb-4">
        <iframe src="https://www.google.com/maps/embed?{{ $busInfo[0]->address.' '.$busInfo[0]->city.' '.$busInfo[0]->state.' '.$busInfo[0]->country }}" width="1000" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>


      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">Get in Touch</h2>
        </div>
        <div class="col-lg-8">
          <form class="form-contact contact_form" action="#" method="post" id="contactForm"
            novalidate="novalidate">
            <div class="row">
             
              <div class="col-sm-6">
                <div class="form-group">
                  <input class="form-control" name="name" id="contact_namez" type="text" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Enter your name'" placeholder='Enter your name *'>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input class="form-control" name="email" id="contact_emailz" type="email" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Enter email address'" placeholder='Enter email address *'>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="subject" id="contact_subjectz" type="text" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Enter Subject'" placeholder='Enter Subject *'>
                </div>
              </div>
               <div class="col-12">
                <div class="form-group">

                  <textarea class="form-control w-100" name="message" id="contact_messagez" cols="30" rows="9"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'"
                    placeholder='Enter Message *'></textarea>
                </div>
              </div>
            </div>
            <div class="form-group mt-3">
              <button type="button" class="button button-contactForm btn_1" onclick="contactus('{{ $busInfo[0]->busID }}', 'Business');">Send Message <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"> <i class="far fa-envelope"></i> </button>
            </div>
          </form>
        </div>
        <div class="col-lg-4">
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="fas fa-map-marker"></i></span>
            <div class="media-body">
              <h3>{{ $busInfo[0]->name_of_company }}</h3>
              <p>{{ $busInfo[0]->address }},</p>
              <p>{{ $busInfo[0]->city.' '.$busInfo[0]->state }},</p>
              <p>{{ $busInfo[0]->country }}</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="far fa-envelope"></i></span>
            <div class="media-body">
              <h3> {{ $busInfo[0]->email }}</h3>
              <p>Send us your query anytime!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->


  @else

  <section class="contact-section section_padding">
    <div class="container">
      <div class="d-none d-sm-block mb-5 pb-4">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11540.856121918176!2d-79.76125808993915!3d43.68531360041938!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b1597c120173b%3A0x8c0309afa99d74d2!2s10+George+St+N%2C+Brampton%2C+ON+L6X+1R2%2C+Canada!5e0!3m2!1sen!2sng!4v1566552642826!5m2!1sen!2sng" width="1000" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>

      </div>


      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">Get in Touch</h2>
        </div>
        <div class="col-lg-8">
          <form class="form-contact contact_form" action="#" method="post" id="contactForm"
            novalidate="novalidate">
            <div class="row">
             
              <div class="col-sm-6">
                <div class="form-group">
                  <input class="form-control" name="name" id="contact_name" type="text" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Enter your name'" placeholder='Enter your name *'>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input class="form-control" name="email" id="contact_email" type="email" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Enter email address'" placeholder='Enter email address *'>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="subject" id="contact_subject" type="text" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Enter Subject'" placeholder='Enter Subject *'>
                </div>
              </div>
               <div class="col-12">
                <div class="form-group">

                  <textarea class="form-control w-100" name="message" id="contact_message" cols="30" rows="9"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'"
                    placeholder='Enter Message *'></textarea>
                </div>
              </div>
            </div>
            <div class="form-group mt-3">
              <button type="button" class="button button-contactForm btn_1" onclick="contactus('1', 'All');">Send Message <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"> <i class="far fa-envelope"></i> </button>
            </div>
          </form>
        </div>
        <div class="col-lg-4">
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="fas fa-map-marker"></i></span>
            <div class="media-body">
              <h3>Professionals' File Inc.</h3>
              <p>10 George St. North,</p>
              <p>Brampton ON L6X1R2,</p>
              <p>Canada</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="far fa-envelope"></i></span>
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


  @endif



@endsection