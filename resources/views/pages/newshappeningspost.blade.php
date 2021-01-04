@extends('layouts.app')

@section('text/css')

<style>
    .about_part{
        height: 45vh !important;
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
   <section class="blog_area single-post-area section_padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">

              @if(count($postActive) > 0)

              <div class="single-post">
                  <div class="feature-img">
                    @if($postActive[0]->file_upload != null) <img class="img-fluid" src="/newsfile/{{ $postActive[0]->file_upload }}" alt=""> @else <img class="card-img rounded-0" src="https://i.ya-webdesign.com/images/no-png-transparent-1.png" alt=""> @endif
                  </div>
                  <div class="blog_details">
                     <h2>{{ $postActive[0]->subject }}
                     </h2>
                     
                     <p class="excert">
                        {!! $postActive[0]->description !!}
                     </p>
                     
                     
                  </div>
               </div>

              @else

              <div class="single-post">
                  <div class="feature-img">
                    <img class="img-fluid" src="https://i.ya-webdesign.com/images/no-png-transparent-1.png" alt="">
                  </div>
                  <div class="blog_details">
                     <h2>Post Not Available !
                     </h2>
                     
                     
                  </div>
               </div>


              @endif
               



            </div>

         </div>
      </div>
   </section>
   <!--================Blog Area end =================-->

@endsection