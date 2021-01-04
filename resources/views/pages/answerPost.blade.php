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

<?php use \App\Http\Controllers\AskExpert; ?>

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
   <!--================Blog Area =================-->
   <section class="blog_area single-post-area section_padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">

            	@if($currPost = \App\AskExpert::where('post_id', $urlID)->get())

            	@if(count($currPost) > 0)

            	<div class="single-post">
                  <div class="feature-img">
                     <img class="img-fluid" @if($currPost[0]->image == "https://soar.vimfile.com/expertupload/noImage.png" || $currPost[0]->image == "askexperts.jpg") src="/expertupload/askexperts.jpg" @else src="{{ $currPost[0]->image }}" @endif style="width: 750px; height: 300px;">
                  </div>
                  <div class="blog_details">
                     <h2>Question:
                     </h2>
                     <p>{!! $currPost[0]->question !!}</p>
	                    <ul class="blog-info-link">
	                        <li><a href="#" style="text-transform: capitalize;"><i class="fas fa-info-circle"></i> {{ $currPost[0]->service_type }}</a></li>

	                        @if($ans = \App\AnsFromExpert::where('post_id', $currPost[0]->post_id)->get())

	                        @if(count($ans) > 1)

	                        <li><a style="cursor: pointer;"><i class="far fa-comments"></i> {{ count($ans) }} Answers</a></li>

	                        @elseif(count($ans) > 0)
	                            <li><a style="cursor: pointer;"><i class="far fa-comments"></i> {{ count($ans) }} Answer</a></li>

	                            @else
	                            <li><a style="cursor: pointer;"><i class="far fa-comments"></i> 0 Answer</a></li>
	                        @endif


	                        @else

	                        <li><a style="cursor: pointer;"><i class="far fa-comments"></i> 0 Answer</a></li>

	                        @endif


	                        <li><a><i class="far fa-user"></i> By - {{ $currPost[0]->name }}</a></li>
	                        <li><a><i class="far fa-clock"></i> Date - {{ $currPost[0]->created_at->diffForHumans() }}</a></li>
	                    </ul>

                  </div>
               </div>

            	@endif


            	@endif


            	@if($answerQuestions != "")

            	<div class="blog-author">
                  <div class="media align-items-center">
                     <img src="{{ asset('expertupload/askexperts.jpg') }}" alt="">
                     <div class="media-body">
                        <a href="#">
                           <h4>{{ $answerQuestions[0]->autocare }}</h4>
                        </a>
                        <p>{{ $answerQuestions[0]->answer }}</p>
                     </div>
                  </div>
               </div>


                 <div class="comments-area">
                  <h4>{{ $countAnswer }} Comments</h4>

                  @foreach($answerQuestions as $attempt)

                  	<div class="comment-list">
                     <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                           <div class="thumb">
                              <img src="{{ asset('expertupload/askexperts.jpg') }}" alt="">
                           </div>
                           <div class="desc">
                              <p class="comment">
                                 {{ $attempt->answer }}
                              </p>
                              <div class="d-flex justify-content-between">
                                 <div class="d-flex align-items-center">
                                    <h5>
                                       <a href="#">{{ $attempt->auto_care }}</a>
                                    </h5>
                                    <p class="date">{{ date('M d, Y h:i a', strtotime($attempt->created_at)) }}</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  @endforeach

               </div>

               @else
               <div class="comments-area">
               <div class="comment-list">
                     <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                           <div class="thumb">
                              <img src="{{ asset('expertupload/askexperts.jpg') }}" alt="">
                           </div>
                           <div class="desc">
                              <h2 class="comment">
                                 No Answer yet
                              </h2>
                           </div>
                        </div>
                     </div>
                  </div>
              </div>

            	@endif


            	@if(Auth::user())

            	<div class="comment-form">
                  <h4>Answer to Post</h4>
                  <form class="form-contact comment_form" action="#" id="commentForm">
                     <div class="row">
                        <div class="col-12">
                           <div class="form-group">
                           	<input type="hidden" name="station_name" id="busStation" value="{{ Auth::user()->station_name }}">
                              <textarea class="form-control w-100" name="comment" id="commentReply" cols="30" rows="9"
                                 placeholder="Write Comment"></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="form-group mt-3">
                        <button type="button" class="button button-contactForm btn_1 sendPost" onclick="postAnswer('{{ $urlID }}')">Send Post <img class="spinLoader disp-0" src="{{ asset('images/icons/spin.gif') }}" style="width: 50px; height: 50px;"><i
                              class="flaticon-right-arrow"></i> </button>
                     </div>
                  </form>
               </div>

            	@endif


            </div>

@if(Auth::user())

                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <h4 class="widget_title">Ask The Expert</h4>
                            <form action="#">
                               <div class="form-group">
                                  <div class="input-group mb-3">
                                    <input type="hidden" name="post_id" id="post_id" value="<?php echo uniqid().'_'.time();?>">
                                    <textarea name="askquestion" id="askquestion" class="form-control" placeholder='Ask a Question'
                                        onfocus="this.placeholder = 'Ask an Expert'" onblur="this.placeholder = 'Ask a Question'" style="height: 200px;"></textarea>
                                     <div class="input-group-append">
                                        <button class="btn" type="button"><i class="ti-help"></i></button>
                                     </div>
                                  </div>

                                  <div class="input-group mb-3">
                                    <select name="service_type" id="service_type" class="form-control">
                                        <option value="Service" selected="selected" disabled="disabled">Service</option>
                                        <optgroup label="Admin"><option value="inspection">inspection</option><option value="registration">registration</option><option value="insurance">insurance</option><option value="road assistance">road assistance</option><option value="business taxes">business taxes</option><option value="Road Fines">Road Fines</option><option value="Ticket">Ticket</option></optgroup>
                                        <optgroup label="Fuel"><option value="fuel">fuel</option><option value="car wash">car wash</option></optgroup>
                                        <optgroup label="Maintenance"><option value="air conditioning recharge">air conditioning recharge</option><option value="air filter">air filter</option><option value="battery">battery</option><option value="brake fluid flush">brake fluid flush</option><option value="brake pads">brake pads</option><option value="brake rotors">brake rotors</option><option value="coolant flush">coolant flush</option><option value="distributor cap &amp; rotor">distributor cap &amp; rotor</option><option value="fuel filter">fuel filter</option><option value="headlight">headlight</option><option value="oil change">oil change</option><option value="power steering flush">power steering flush</option><option value="spark plugs">spark plugs</option><option value="timing belt">timing belt</option><option value="tire - new">tire - new</option><option value="tire balancing">tire balancing</option><option value="tire inflation">tire inflation</option><option value="tire rotation">tire rotation</option><option value="wheel rotation and tire balancing">Wheel Rotation & Tire Balancing</option><option value="transmission fluid flush">transmission fluid flush</option><option value="wheel alignment">wheel alignment</option><option value="wiper blades">wiper blades</option><option value="other">other</option><option value="cabin air filter">cabin air filter</option><option value="smog check">smog check</option></optgroup>
                                        <optgroup label="Repairs"><option value="alternator">alternator</option><option value="belt">belt</option><option value="body work">body work</option><option value="brake caliper">brake caliper</option><option value="carburetor">carburetor</option><option value="catalytic converter">catalytic converter</option><option value="clutch">clutch</option><option value="control arm">control arm</option><option value="coolant temperature sensor">coolant temperature sensor</option><option value="exhaust">exhaust</option><option value="fuel injector">fuel injector</option><option value="fuel tank">fuel tank</option><option value="head gasket">head gasket</option><option value="heater core">heater core</option><option value="hose">hose</option><option value="line">line</option><option value="mass air flow sensor">mass air flow sensor</option><option value="muffler">muffler</option><option value="oxygen sensor">oxygen sensor</option><option value="radiator">radiator</option><option value="shock/strut">shock/strut</option><option value="starter">starter</option><option value="thermostat">thermostat</option><option value="tie rod">tie rod</option><option value="transmission">transmission</option><option value="water pump">water pump</option><option value="wheel bearings">wheel bearings</option><option value="window">window</option><option value="windshield">windshield</option><option value="road side assistance">road side assistance</option><option value="other">other</option><option value="sensor">sensor</option>
                                        </optgroup>
                                    </select>
                                     <div class="input-group-append">
                                        <button class="btn" type="button"><i class="ti-more"></i></button>
                                     </div>
                                  </div>

                                  <div class="input-group mb-3">
                                    <input type="file" name="file" id="file" class="form-control">
                                     <div class="input-group-append">
                                        <button class="btn" type="button"><i class="ti-file"></i></button>
                                     </div>
                                  </div>

                               </div>
                               <center><img class="spinLoad disp-0" src="{{ asset('images/icons/spin.gif') }}" style="width: 50px; height: 50px;"></center>
                               <button class="button rounded-0 primary-bg text-white w-100 btn_1 btn_post" type="button" onclick="askExperts('{{ Auth::user()->name }}', '{{ Auth::user()->email }}')">Post</button>
                            </form>
                         </aside>

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h6 class="widget_title">Weekly Ranking</h6>

                            @if($points != "")

                                <?php $i = 1;?>
                                @foreach($points as $point)

                                <div class="media post_item">
                                <img src="https://img.icons8.com/flat_round/50/000000/three-stars.png" alt="post" style="width: 50px; height: 50px;">
                                <div class="media-body">
                                    <a style="cursor: pointer;">
                                        <h6 style="font-size: 15px;"><?php echo substr($point->email, 0, -10) . "****";?></h6>
                                    </a>
                                    <p style="font-size: 13px;">{{ $i++ }} - <small>{{ $point->weekly_point }} Points</small></p>
                                </div>
                            </div>

                                @endforeach

                            @else

                            <div class="media post_item">
                                <img src="https://brisbaneca.org/sites/default/files/node-images/website%20maintenance.png" alt="post" style="width: 50px; height: 50px;">
                                <div class="media-body">
                                    <a style="cursor: pointer;">
                                        <h3>No record available</h3>
                                    </a>
                                </div>
                            </div>

                            @endif

                        </aside>

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">All Time Ranking</h3>

                            @if($alltimepoints != "")

                                <?php $i = 1;?>
                                @foreach($alltimepoints as $alltimepoint)

                                <div class="media post_item">
                                <img src="https://img.icons8.com/flat_round/50/000000/three-stars.png" alt="post" style="width: 50px; height: 50px;">
                                <div class="media-body">
                                    <a style="cursor: pointer;">
                                        <h6><?php echo substr($alltimepoint->email, 0, -10) . "****";?></h6>
                                    </a>
                                    <p>{{ $i++ }} - <small>{{ $alltimepoint->alltime_point }} Points</small></p>
                                </div>
                            </div>

                                @endforeach

                            @else

                            <div class="media post_item">
                                <img src="https://brisbaneca.org/sites/default/files/node-images/website%20maintenance.png" alt="post" style="width: 80px; height: 80px;">
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>No record available</h3>
                                    </a>
                                </div>
                            </div>

                            @endif

                        </aside>

                    </div>
                </div>

@endif




         </div>
      </div>
   </section>
   <!--================Blog Area end =================-->
@endsection
