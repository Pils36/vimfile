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
    <section class="blog_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">

                        @if(count($postActive) > 0)

                        @foreach($postActive as $postActives)

                        <article class="blog_item">
                            <div class="blog_item_img">
                                @if($postActives->file_upload != null) <img class="card-img rounded-0" src="/newsfile/{{ $postActives->file_upload }}" alt=""> @else <img class="card-img rounded-0" src="https://i.ya-webdesign.com/images/no-png-transparent-1.png" alt=""> @endif

                                <a href="#" class="blog_item_date">
                                    <h3>{{ date('d', strtotime($postActives->created_at)) }}</h3>
                                    <p>{{ date('M', strtotime($postActives->created_at)) }}</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="#">
                                    <h2>{{ $postActives->subject }}</h2>
                                </a>
                                <p>{!! $postActives->description !!}</p>
                                <p>
                                @if($postActives->file_upload != null)
                                    <a style="color: navy !important; font-weight: bold;" href="/newsfile/{{ $postActives->file_upload }}" target="_blank">Open File</a>
                                @endif
                            </p>
                                
                            </div>
                        </article>

                        @endforeach

                        @else


                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="https://i.ya-webdesign.com/images/no-png-transparent-1.png" alt="">
                                <a href="#" class="blog_item_date">
                                    <h3>{{ date('d') }}</h3>
                                    <p>{{ date('M') }}</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="#">
                                    <h2>No Post Yet</h2>
                                </a>
                                <p></p>
                                
                            </div>
                        </article> 

                        @endif

                        

                        

                        @if(count($postActive) > 0)
                            
                            <nav class="blog-pagination justify-content-center d-flex">
                            {{ $postActive->links() }}
                        </nav>

                        @else
                        <nav class="blog-pagination justify-content-center d-flex">
                            </nav>

                        @endif
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection