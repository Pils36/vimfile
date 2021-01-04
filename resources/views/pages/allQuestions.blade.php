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

                        @if(count($askedQuest) > 0)


                        @foreach($askedQuest as $askedQuests)

                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="/expertupload/askexperts.jpg" alt="{{ $askedQuests->image }}" style="width: 750px; height: 300px;">
                                <a href="#" class="blog_item_date">
                                    <h3>{{ date('d', strtotime($askedQuests->created_at)) }}</h3>
                                    <p>{{ date('M, Y', strtotime($askedQuests->created_at)) }}</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="single-blog.html">
                                    <h2>Question:</h2>
                                </a>
                                <p>{!! $askedQuests->question !!}</p>
                                <ul class="blog-info-link">
                                    <li><a href="#" style="text-transform: capitalize;"><i class="fas fa-info-circle"></i> {{ $askedQuests->service_type }}</a></li>

                                    @if($ans = \App\AnsFromExpert::where('post_id', $askedQuests->post_id)->get())

                                    @if(count($ans) > 1)

                                    @if(Auth::user())
                                    <li><a style="cursor: pointer;" onclick="ansPost('{{ $askedQuests->post_id }}')"><i class="far fa-comments"></i> {{ count($ans) }} Answers</a></li>

                                    @else
                                        <li><a style="cursor: pointer;"><i class="far fa-comments"></i> {{ count($ans) }} Answers</a></li>
                                    @endif

                                    @elseif(count($ans) > 0)

                                    @if(Auth::user())
                                        <li><a style="cursor: pointer;" onclick="ansPost('{{ $askedQuests->post_id }}')"><i class="far fa-comments"></i> {{ count($ans) }} Answer</a></li>

                                        @else
                                        <li><a style="cursor: pointer;"><i class="far fa-comments"></i> {{ count($ans) }} Answer</a></li>
                                    @endif

                                        @else

                                        @if(Auth::user())
                                        <li><a style="cursor: pointer; color: red !important; font-weight: bold;" onclick="ansPost('{{ $askedQuests->post_id }}')"><i class="far fa-comments"></i> Answer this question</a></li>

                                        @else

                                        <li><a style="cursor: pointer;"><i class="far fa-comments"></i> Answer this question</a></li>

                                        @endif
                                    @endif


                                    @else

                                    @if(Auth::user())
                                    <li><a style="cursor: pointer; color: red !important; font-weight: bold;" onclick="ansPost('{{ $askedQuests->post_id }}')"><i class="far fa-comments"></i> Answer this question</a></li>

                                    @else

                                    <li><a style="cursor: pointer;"><i class="far fa-comments"></i> Answer this question</a></li>

                                    @endif

                                    @endif


                                    <li><a><i class="far fa-user"></i> From - {{ $askedQuests->name }}</a></li>
                                    <li><a><i class="far fa-clock"></i> Date - {{ $askedQuests->created_at->diffForHumans() }}</a></li>
                                </ul>
                            </div>
                        </article>

                        @endforeach


                        @else

                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="/expertupload/askexperts.jpg" alt="" style="width: 750px; height: 375px;">
                                <a style="cursor: pointer;" class="blog_item_date">
                                    <h3>{{ date('d') }}</h3>
                                    <p>{{ date('M') }}</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <h4 class="text-center">No Questions Asked</h4>
                            </div>
                        </article>

                        @endif


                        @if(count($askedQuest) > 0)

                            <nav class="blog-pagination justify-content-center d-flex">
                            {{ $askedQuest->links() }}
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
