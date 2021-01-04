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
               <div class="single-post">
                <div class="quote-wrapper animated fadeIn">
                        <div class="quotes">
                          @if($mypoints != "")

                          <div class="row">
                             <div class="col"><h4>My Ranking</h4></div>
                           </div> <hr>

                           <div class="row">
                             <div class="col">My Points: </div>
                             <div class="col" style="font-size: 16px; font-weight: bold;">{{ $mypoints[0]->alltime_point }} points</div>
                           </div> <br>

                           <div class="row">
                             <div class="col">Weekly Ranking: <span class="weekRank" style="font-size: 16px; font-weight: bold;"></span></div>
                             <div class="col">All-Time Ranking: <span class="alltimeRank" style="font-size: 16px; font-weight: bold;"></span></div><div class="col">Global Ranking: <span class="globalRank" style="font-size: 16px; font-weight: bold;"></span></div>
                           </div>

                           @else

                           <div class="row">
                             <div class="col">My Ranking: </div>
                             <div class="col">0</div>
                           </div>

                           <div class="row">
                             <div class="col">My Points: </div>
                             <div class="col">0 points</div>
                           </div>

                           <div class="row">
                             <div class="col">Weekly Ranking: 0</div>
                             <div class="col">All-Time Ranking: 0</div>
                             <div class="col">Global Ranking: 0</div>
                           </div>

                          @endif
                           
                        </div>
                     </div>


              <ul class="nav nav-tabs" id="myTab" role="tablist">

              <li class="nav-item">
                <a class="nav-link navweekRank active" id="weeklyRank-tab" data-toggle="tab" href="#weeklyRank" role="tab" aria-controls="weeklyRank" aria-selected="true">Weekly Ranking</a>
              </li>
              <li class="nav-item">
                <a class="nav-link navalltimeRank" id="alltimeRank-tab" data-toggle="tab" href="#alltimeRank" role="tab" aria-controls="alltimeRank" aria-selected="false">All Time Ranking</a>
              </li>

              <li class="nav-item">
                <a class="nav-link navglobalRank" id="globalRank-tab" data-toggle="tab" href="#globalRank" role="tab" aria-controls="alltimeRank" aria-selected="false">Global Ranking</a>
              </li>

              <li class="nav-item">
                <a class="nav-link navboostRank" id="boostRank-tab" data-toggle="tab" href="#boostRank" role="tab" aria-controls="boostRank" aria-selected="false">Boost Your Ranking</a>
              </li>

            </ul>

            <!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="weeklyRank" role="tabpanel" aria-labelledby="weeklyRank-tab">
    <div class="blog_details">
                     <div class="table table-responsive">
                       <table class="table table-striped table-bordered" id="rank_table" style="font-size: 13px;">
                        <input type="hidden" name="userrankid" id="userrankid" value="{{ Auth::user()->id }}">
                         <thead>
                          <tr>
                            <th>Ranking</th>
                            <th class="disp-0"></th>
                            <th>Username</th>
                            <th>State</th>
                            <th>Points</th>
                          </tr>
                           
                         </thead>

                         <tbody>
                          @if($points != "")

                          <?php $i = 1;?>
                          @foreach($points as $point)

                            <tr id="row{{ $point->id }}">
                             <td>{{ $i++ }}</td>
                             <td class="disp-0" id="point_id">{{ $point->id }}</td>
                             <td><?php echo substr($point->email, 0, -10) . "****";?></td>

                             <td>{{ $point->state }}</td>
                             <td>{{ $point->weekly_point }}</td>
                           </tr>

                          @endforeach

                          @else
                            <tr>
                              <td align="center">No record yet</td>
                            </tr>
                          @endif
                           
                         </tbody>
                       </table>
                     </div>
                  </div>

  </div>
  <div class="tab-pane" id="alltimeRank" role="tabpanel" aria-labelledby="alltimeRank-tab">
    
    <div class="blog_details">
                     <div class="table table-responsive">
                       <table class="table table-striped table-bordered" id="alltimerank_table" style="font-size: 13px;">
                        <input type="hidden" name="userrankid" class="userrankid" value="{{ Auth::user()->id }}">
                         <thead>
                          <tr>
                            <th>Ranking</th>
                            <th class="disp-0"></th>
                            <th>Username</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Points</th>
                          </tr>
                           
                         </thead>

                         <tbody>
                          @if($alltimepoints != "")

                          <?php $i = 1;?>
                          @foreach($alltimepoints as $alltimepoints)

                            <tr id="row{{ $alltimepoints->id }}">
                             <td>{{ $i++ }}</td>
                             <td class="disp-0" id="alltimepoints_id">{{ $alltimepoints->id }}</td>
                             <td><?php echo substr($alltimepoints->email, 0, -10) . "****";?> </td>
                             <td>{{ $alltimepoints->state }} </td>
                             <td>{{ $alltimepoints->country }} </td>



                             <td>{{ $alltimepoints->alltime_point }}</td>
                           </tr>

                          @endforeach

                          @else
                            <tr>
                              <td align="center">No record yet</td>
                            </tr>
                          @endif
                           
                         </tbody>
                       </table>
                     </div>
                  </div>
  </div>

  <div class="tab-pane" id="globalRank" role="tabpanel" aria-labelledby="globalRank-tab">
    
    <div class="blog_details">
                     <div class="table table-responsive">
                       <table class="table table-striped table-bordered" id="globalrank_table" style="font-size: 13px;">
                        <input type="hidden" name="userrankid" class="userrankid" value="{{ Auth::user()->id }}">
                         <thead>
                          <tr>
                            <th>Ranking</th>
                            <th class="disp-0"></th>
                            <th>Username</th>
                            <th>Country</th>
                            <th>Points</th>
                          </tr>
                           
                         </thead>

                         <tbody>
                          @if($globalpoints != "")

                          <?php $i = 1;?>
                          @foreach($globalpoints as $globalpoints)

                            <tr id="row{{ $globalpoints->id }}">
                             <td>{{ $i++ }}</td>
                             <td class="disp-0" id="globalpoints_id">{{ $globalpoints->id }}</td>
                             <td><?php echo substr($globalpoints->email, 0, -10) . "****";?> </td>



                             <td>{{ $globalpoints->country }}</td>
                             <td>{{ $globalpoints->global_point }}</td>
                           </tr>

                          @endforeach

                          @else
                            <tr>
                              <td align="center">No record yet</td>
                            </tr>
                          @endif
                           
                         </tbody>
                       </table>
                     </div>
                  </div>
  </div>

    <div class="tab-pane" id="boostRank" role="tabpanel" aria-labelledby="boostRank-tab">
    
    <div class="blog_details">
                     <div class="table table-responsive">
                       <table class="table table-striped table-bordered" id="alltimerank_table" style="font-size: 13px;">
                         <thead>
                          <tr>
                            <th colspan="3">Activities</th>
                            <th>Points</th>
                          </tr>
                           
                         </thead>

                         <tbody>
                           <tr>
                             <td colspan="3">Set up Maintenance Remiders</td>
                             <td>5</td>
                           </tr><tr>
                             <td colspan="3">Keep eCopy of Warranties and repairs receipts</td>
                             <td>5</td>
                           </tr><tr>
                             <td colspan="3">Search for Mobile Mechanics/AutoCare Centre</td>
                             <td>5</td>
                           </tr><tr>
                             <td colspan="3">Register a Vehicle</td>
                             <td>10</td>
                           </tr><tr>
                             <td colspan="3">Record a Maintenance</td>
                             <td>10</td>
                           </tr><tr>
                             <td colspan="3">Update Vehicle Information</td>
                             <td>15</td>
                           </tr><tr>
                             <td colspan="3">Ask Expert</td>
                             <td>15</td>
                           </tr><tr>
                             <td colspan="3">Experts Answer to Questions</td>
                             <td>15</td>
                           </tr><tr>
                             <td colspan="3">Refer a Business Account User</td>
                             <td>20</td>
                           </tr><tr>
                             <td colspan="3">Refer an Auto Dealer Account User</td>
                             <td>25</td>
                           </tr><tr>
                             <td colspan="3">Refer a Commercial Account User</td>
                             <td>25</td>
                           </tr><tr>
                             <td colspan="3">Refer an Autocare Centre Account User</td>
                             <td>30</td>
                           </tr><tr>
                             <td colspan="3">Refer a Mobile Mechanics Account User</td>
                             <td>35</td>
                           </tr><tr>
                             <td colspan="3">Request for Estimate-Post to Boards </td>
                             <td>40</td>
                           </tr><tr>
                             <td colspan="3">Update financial report</td>
                             <td>40</td>
                           </tr><tr>
                             <td colspan="3">Uses Tour Guide</td>
                             <td>50</td>
                           </tr><tr>
                             <td colspan="3">Upgrade to Next Plan</td>
                             <td>50</td>
                           </tr><tr>
                             <td colspan="3">Top weekly user in the State/Province</td>
                             <td>50</td>
                           </tr><tr>
                             <td colspan="3">Weekly Completed Repairs (Job Done)</td>
                             <td>100</td>
                           </tr><tr>
                             <td colspan="3">Add Review to Job done</td>
                             <td>150</td>
                           </tr>
                         </tbody>
                       </table>
                     </div>
                  </div>
  </div>
</div>


                  
               </div>

            </div>

            <div class="col-lg-4 posts-list">

              <center>
                <img src="{{ asset('img/banner_img.png') }}" class="animated slideInRight">
              </center>
            </div>
         </div>
      </div>
   </section>
   <!--================Blog Area end =================-->

@endsection