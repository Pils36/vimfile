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
                
                {{-- Start --}}

                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">


                      @if(count($getSupportList) > 0)

                        @foreach($getSupportList as $SupportList)
                          <article class="blog_item">
                              <div class="blog_item_img">
                                  <h4 class="alert alert-success">Ticket Order No - {{ $SupportList->ticketID }}</h4>
                              </div>

                              <div class="blog_details">
                                <p>Subject: <span style="font-weight: bold; text-decoration: underline;">{{ $SupportList->ticketSubject }}</span></p>
                                  <a class="d-inline-block" href="single-blog.html">
                                      <h2>Message:</h2>
                                  </a>
                                  <p>{{ $SupportList->ticketMessage }}</p>

                                  <ul class="blog-info-link">
                                      <li><a href="#" style="text-transform: capitalize;"><i class="fas fa-info-circle"></i>Department - {{ $SupportList->ticketDepartment }}</a></li>

                                      <li><a href="#"><i class="far fa-comments"></i>Related Service - {{ $SupportList->ticketRelatedServices }}</a></li>

                                      <li><a><i class="far fa-user"></i> Priority - {{ $SupportList->ticketPriority }}</a></li>
                                      <li><a><i class="far fa-clock"></i> Date - {{ date('d-M-Y', strtotime($SupportList->created_at)) }}</a></li>
                                  </ul>
                              </div>
                          </article> 
                        @endforeach

                        @else
                        <article class="blog_item">
                              <div class="blog_item_img">
                                  <h4 class="alert alert-success">Ticket Order No - #XXXXXX</h4>
                              </div>

                              <div class="blog_details">
                                <p>Subject: <span style="font-weight: bold; text-decoration: underline;">N/A</span></p>
                                  <a class="d-inline-block" href="single-blog.html">
                                      <h2>Message:</h2>
                                  </a>
                                  <p class="alert alert-danger">No support ticket opened by you yet</p>

                                  <ul class="blog-info-link">
                                      <li><a href="#" style="text-transform: capitalize;"><i class="fas fa-info-circle"></i>Department - N/A</a></li>

                                      <li><a href="#"><i class="far fa-comments"></i>Related Service - N/A</a></li>

                                      <li><a><i class="far fa-user"></i> Priority - Low</a></li>
                                      <li><a><i class="far fa-clock"></i> Date - {{ date('d-M-Y') }}</a></li>
                                  </ul>
                              </div>
                          </article> 

                      @endif


                                              
                        
                    </div>
                </div>


                {{-- End --}}



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