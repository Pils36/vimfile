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
                    <div class="blog_left_sidebar">

                        @if(count($askExpert) > 0)


                        @foreach($askExpert as $askedQuest)

                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" @if($askedQuest->image == "https://soar.vimfile.com/expertupload/noImage.png" || $askedQuest->image == "askexperts.jpg") src="/expertupload/askexperts.jpg" @else src="{{ $askedQuest->image }}" @endif alt="{{ $askedQuest->image }}" style="width: 750px; height: 300px;">
                                <a href="#" class="blog_item_date">
                                    <h3>{{ date('d', strtotime($askedQuest->created_at)) }}</h3>
                                    <p>{{ date('M, Y', strtotime($askedQuest->created_at)) }}</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="single-blog.html">
                                    <h2>Question:</h2>
                                </a>
                                <p>{!! $askedQuest->question !!}</p>
                                <ul class="blog-info-link">
                                    <li><a href="#" style="text-transform: capitalize;"><i class="fas fa-info-circle"></i> {{ $askedQuest->service_type }}</a></li>

                                    @if($ans = \App\AnsFromExpert::where('post_id', $askedQuest->post_id)->get())

                                    @if(count($ans) > 1)

                                    <li><a href="{{ route('AnswerPost', $askedQuest->post_id) }}"><i class="far fa-comments"></i> {{ count($ans) }} Answers</a></li>

                                    @elseif(count($ans) > 0)
                                        <li><a href="{{ route('AnswerPost', $askedQuest->post_id) }}"><i class="far fa-comments"></i> {{ count($ans) }} Answer</a></li>

                                        @else
                                        <li><a href="{{ route('AnswerPost', $askedQuest->post_id) }}" style="cursor: pointer;"><i class="far fa-comments"></i> 0 Answer</a></li>
                                    @endif


                                    @else

                                    <li><a href="{{ route('AnswerPost', $askedQuest->post_id) }}" style="cursor: pointer;"><i class="far fa-comments"></i> 0 Answer</a></li>

                                    @endif


                                    <li><a><i class="far fa-user"></i> By - {{ $askedQuest->name }}</a></li>
                                    <li><a><i class="far fa-clock"></i> Date - {{ $askedQuest->created_at->diffForHumans() }}</a></li>
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
                                <a class="d-inline-block" href="single-blog.html">
                                    <h2>Get answers from EXPERTS on VIM File. </h2>
                                </a>
                                <p>All you need do is to type your question, select the service type, upload image (optional) and post it.</p>
                                <ul class="blog-info-link">
                                    <li><a style="cursor: pointer;"><i class="fas fa-info-circle"></i> Tips</a></li>
                                    <li><a style="cursor: pointer;"><i class="far fa-comments"></i> 0 Answers</a></li>
                                    <li><a style="cursor: pointer;"><i class="far fa-user"></i> By - Admin</a></li>
                                    <li><a style="cursor: pointer;"><i class="far fa-clock"></i> Date - {{ date('d-M-Y') }}</a></li>
                                </ul>
                            </div>
                        </article>

                        @endif

                        @if(count($askExpert) > 0)

                            <nav class="blog-pagination justify-content-center d-flex">
                            {{ $askExpert->links() }}
                        </nav>

                        @else
                        <nav class="blog-pagination justify-content-center d-flex">
                            </nav>

                        @endif

                    </div>
                </div>



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
                                <img src="https://brisbaneca.org/sites/default/files/node-images/website%20maintenance.png" alt="post" style="width: 50px; height: 50px;">
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>No record available</h3>
                                    </a>
                                </div>
                            </div>

                            @endif

                        </aside>

                        <aside class="single_sidebar_widget instagram_feeds">
                            <h4 class="widget_title">Related Posts</h4>
                            <ul class="instagram_row flex-wrap">

                                @if($relatedFeeds != "")

                                @foreach($relatedFeeds as $relatedFeed)

                                <li>
                                    <a href="{{ route('AnswerPost', $askedQuest->post_id) }}">
                                        <img class="img-fluid" @if($relatedFeed->image == "https://soar.vimfile.com/expertupload/noImage.png" || $relatedFeed->image == "askexperts.jpg") src="/expertupload/askexperts.jpg" @else src="{{ $relatedFeed->image }}" @endif style="width: 90px; height: 90px;">

                                        
                                    </a>
                                </li>

                                @endforeach

                                @else

                                   <center><img src="https://png.pngtree.com/element_our/png/20181227/caution-sign-png_287726.jpg" style="width: 100px; height: 100px;"><span style="font-size: 16px; font-weight: 600;">No Related Posts Yet</span></center>


                                @endif


                            </ul>
                        </aside>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection
