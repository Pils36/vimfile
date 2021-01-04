@extends('layouts.app')

@section('text/css')

<style>
    .about_part{
        height: 45vh !important;
    }
    .popular_post_widget{
        height: 370px !important;
        overflow-y: auto;
    }
    .media-body a h6{
        font-size: 14px !important;
    }
</style>

@show

@section('content')
<?php use \App\Http\Controllers\AnsFromExpert; ?>

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



    <!--================Blog Area =================-->
    <section class="blog_area section_padding">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <h1>Open Ticket</h1><hr>
                    <div class="blog_left_sidebar">

                        <p>
                            If you can't find a solution to your problems in our knowledgebase, you can submit a ticket by selecting the appropriate department below.
                        </p>
                        <br><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="ticket-btn" onclick="location.href='{{ route('Opennewticket', 'c=Enquiries') }}'">
                                    <span class="ticket-btn-span"><a href="{{ route('Opennewticket', 'c=Enquiries') }}" style="color: darkblue !important;"><img style="width: 50px; height: 50px;" src="https://img.icons8.com/cute-clipart/64/000000/questions.png"> General Enquiries</a></span>
                                </div>
                                
                            </div>

                            <div class="col-md-6">
                                <div class="ticket-btn" onclick="location.href='{{ route('Opennewticket', 'c=Support') }}'">
                                    <span class="ticket-btn-span"><a href="{{ route('Opennewticket', 'c=Support') }}" style="color: darkblue !important;"><img style="width: 50px; height: 50px;" src="https://img.icons8.com/plasticine/100/000000/online-support.png"> Support</a></span>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                </div>



                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <h4 style="font-weight: bold;"><img style="width: 40px; height: 40px;" src="https://img.icons8.com/dusk/64/000000/globe-earth.png" class="fa fa-spin"> Support</h4> <hr>
                           <ul>
                               <li>
                                   <a href="{{ route('Supportticket') }}" style="color: darkblue !important; font-weight: bold;">
                                      <img style="width: 40px; height: 40px;" src="https://img.icons8.com/dusk/64/000000/starred-ticket.png"> My Support Ticket
                                   </a>
                               </li>
                               <hr> 
                               <li>
                                   <a href="{{ route('Opennewticket', 'c=Enquiries') }}" style="color: darkblue !important; font-weight: bold;">
                                      <img style="width: 40px; height: 40px;" src="https://img.icons8.com/cotton/64/000000/email-open.png"> Create Ticket
                                   </a>
                               </li>
                           </ul>
                         </aside>

                    </div>
                </div>

                
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection