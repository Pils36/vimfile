
@extends('layouts.dashboard')

@section('title', 'Dashboard')

@show
<?php use \App\Http\Controllers\User; ?>

@section('dashContent')

<div class="wrapper">

@include('includes.dashhead')
@include('includes.dashaside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile & Business Page
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('Admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile & Business Page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

              <img @if(count($getBussiness) > 0 && $getBussiness[0]->file2 != "") src="/company_logo/{{ $getBussiness[0]->file2 }}" @else src="{{ asset('company_logo/vimfile.jpg') }}" @endif  class="profile-user-img img-responsive img-circle" alt="User profile picture">

              <h3 class="profile-username text-center">{{ $profileDetails[0]['station_name'] }}</h3>

              <p class="text-muted text-center">{{ $profileDetails[0]['specialization'] }}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Reviews</b> <a class="pull-right">{{ $reviewcount }}</a>
                </li>
                <li class="list-group-item">
                  <b>Total Stations</b> <a class="pull-right">{{ $mystationcount }}</a>
                </li>
                <li class="list-group-item">
                  <b>Total Staffs</b> <a class="pull-right">{{ $mystaffcount }}</a>
                </li>
                <li class="list-group-item">
                  <b>Search Appearance</b> <a class="pull-right">{{ $profileDetails[0]['search_count'] }}</a>
                </li>
              </ul>

              <a href="{{ route('stationreviews') }}" class="btn btn-danger btn-block"><b>Station Reviews</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">History</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Background</strong>

              <p class="text-muted">
                {!! $profileDetails[0]['background'] !!}
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">{{ $profileDetails[0]['state'].', '.$profileDetails[0]['country'] }}</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Amenities & Others</strong>

              <p>
                @if($profileDetails[0]['wifi'] == "Yes")<span class="label label-danger">Wi-Fi</span>@endif
                @if($profileDetails[0]['restroom'] == "Yes")<span class="label label-success">Rest room</span>@endif
                @if($profileDetails[0]['parking_space'] == "Yes")<span class="label label-info">Parking space</span>@endif

              </p>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              {{-- <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li> --}}
              {{-- <li><a href="#timeline" data-toggle="tab">Timeline</a></li> --}}
              <li class="active"><a href="#company" data-toggle="tab">Company Info.</a></li>
              <li><a href="#contact" data-toggle="tab">Contact Info.</a></li>
              <li><a href="#speciality" data-toggle="tab">Speciality</a></li>
              <li><a href="#value" data-toggle="tab">Value Added</a></li>
              <li><a href="#amenity" data-toggle="tab">Amenities</a></li>
              <li><a href="#history" data-toggle="tab">History</a></li>
              <li><a href="#managephotos" data-toggle="tab">Photos</a></li>
              <li><a href="#serviceoffer" data-toggle="tab">Service Offered</a></li>
            </ul>

            <div class="tab-content">


              <div class="tab-pane disp-0" id="activity">
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Shared publicly - 7:30 PM today</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore the hate as they create awesome
                    tools to help create filler text for everyone from bacon lovers
                    to Charlie Sheen fans.
                  </p>
                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        (5)</a></li>
                  </ul>

                  <input class="form-control input-sm" type="text" placeholder="Type a comment">
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Ross</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Sent you a message - 3 days ago</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore the hate as they create awesome
                    tools to help create filler text for everyone from bacon lovers
                    to Charlie Sheen fans.
                  </p>

                  <form class="form-horizontal">
                    <div class="form-group margin-bottom-none">
                      <div class="col-sm-9">
                        <input class="form-control input-sm" placeholder="Response">
                      </div>
                      <div class="col-sm-3">
                        <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Adam Jones</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Posted 5 photos - 5 days ago</span>
                  </div>
                  <!-- /.user-block -->
                  <div class="row margin-bottom">
                    <div class="col-sm-6">
                      <img class="img-responsive" src="../../dist/img/photo1.png" alt="Photo">
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-6">
                          <img class="img-responsive" src="../../dist/img/photo2.png" alt="Photo">
                          <br>
                          <img class="img-responsive" src="../../dist/img/photo3.jpg" alt="Photo">
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                          <img class="img-responsive" src="../../dist/img/photo4.jpg" alt="Photo">
                          <br>
                          <img class="img-responsive" src="../../dist/img/photo1.png" alt="Photo">
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->

                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        (5)</a></li>
                  </ul>

                  <input class="form-control input-sm" type="text" placeholder="Type a comment">
                </div>
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->


              <div class="tab-pane disp-0" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                      <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->




              <div class="active tab-pane" id="company">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="size_of_employee" class="col-sm-2 control-label">Size of Employee</label>

                    <div class="col-sm-10">
                        <select name="size_of_employee" id="size_of_employee" class="form-control">
                           @if($profileDetails[0]['size_of_employee'] != "") <option value="{{ $profileDetails[0]['size_of_employee'] }}">{{ $profileDetails[0]['size_of_employee'] }}</option> @else <option value="">Select Option</option> @endif
                            <option value="1">1</option>
                            <option value="2-10">2-10</option>
                            <option value="11-20">11-20</option>
                            <option value="21-30">21-30</option>
                            <option value="31-40">31-40</option>
                            <option value="41-50">41-50</option>
                            <option value="50 above">50 above</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="company_name" class="col-sm-2 control-label">Company Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="company_name" placeholder="Company Name" value="{{ $profileDetails[0]['station_name'] }}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="company_address" class="col-sm-2 control-label">Company Address</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="company_address" placeholder="Company Address" value="{{ $profileDetails[0]['address'] }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="prof_city" class="col-sm-2 control-label">City</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="prof_city" placeholder="City" value="{{ $profileDetails[0]['city'] }}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="postal_code" class="col-sm-2 control-label">Zip/Postal Code</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="postal_code" placeholder="Zip/Postal Code" value="{{ $profileDetails[0]['zipcode'] }}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="country" class="col-sm-2 control-label">Country</label>

                    <div class="col-sm-10">
                        <select name="prof_country" id="prof_country" class="form-control">
                            <option value="{{ $profileDetails[0]['country'] }}">{{ $profileDetails[0]['country'] }}</option>
                        </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="state" class="col-sm-2 control-label">State</label>

                    <div class="col-sm-10">
                      <select name="prof_state" id="prof_state" class="form-control">
                          <option value="{{ $profileDetails[0]['state'] }}">{{ $profileDetails[0]['state'] }}</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="year_started_since" class="col-sm-2 control-label">Year Started</label>

                    <div class="col-sm-10">
                      <input type="month" min="1900-01" max="{{ date('Y-m') }}" class="form-control" id="year_started_since" placeholder="Year Started Since" value="{{ $profileDetails[0]['year_started_since'] }}">
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="practical_experience" class="col-sm-2 control-label">Years of Experience</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="practical_experience" placeholder="Year of practical experience" value="{{ $profileDetails[0]['year_of_practice'] }}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="practical_experience" class="col-sm-2 control-label">Social Media</label>

                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="facebook" placeholder="https://facebook.com/company" value="{{ $profileDetails[0]['facebook'] }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="twitter" placeholder="https://twitter.com/company" value="{{ $profileDetails[0]['twitter'] }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="instagram" placeholder="https://instagram.com/company" value="{{ $profileDetails[0]['instagram'] }}">
                        </div>


                    </div>
                  </div>





                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-primary" onclick="updateInfo('company')">Update Information <img class="spinnercompany disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->



              <div class="tab-pane" id="contact">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="fullname" class="col-sm-2 control-label">Fullname</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="fullname" placeholder="Fullname" value="{{ $profileDetails[0]['name'] }}" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="phone_number" class="col-sm-2 control-label">Telephone</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="phone_number" placeholder="Telephone" value="{{ $profileDetails[0]['phone_number'] }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email_address" class="col-sm-2 control-label">Email Address</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="email_address" placeholder="Email Address" value="{{ $profileDetails[0]['email'] }}" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="mobile" class="col-sm-2 control-label">Mobile</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="mobile" placeholder="Mobile" value="{{ $profileDetails[0]['mobile'] }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="office" class="col-sm-2 control-label">Office</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="office" placeholder="Office" value="{{ $profileDetails[0]['office'] }}">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-primary" onclick="updateInfo('contact')">Update Information <img class="spinnercontact disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->


              <div class="tab-pane" id="speciality">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="mechanical" class="col-sm-2 control-label">Mechanical</label>

                    <div class="col-sm-10">
                        <select name="mechanical" id="mechanical" class="form-control">
                            @if($profileDetails[0]['mechanical_skill'] != "") <option value="{{ $profileDetails[0]['mechanical_skill'] }}">{{ $profileDetails[0]['mechanical_skill'] }}</option> @else <option value="">Select Option</option> @endif
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="electrical" class="col-sm-2 control-label">Electrical</label>

                    <div class="col-sm-10">
                      <select name="electrical" id="electrical" class="form-control">
                            @if($profileDetails[0]['electrical_skill'] != "") <option value="{{ $profileDetails[0]['electrical_skill'] }}">{{ $profileDetails[0]['electrical_skill'] }}</option> @else <option value="">Select Option</option> @endif
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="transmissions" class="col-sm-2 control-label">Transmissions</label>

                    <div class="col-sm-10">
                      <select name="transmissions" id="transmissions" class="form-control">
                            @if($profileDetails[0]['transmission_skill'] != "") <option value="{{ $profileDetails[0]['transmission_skill'] }}">{{ $profileDetails[0]['transmission_skill'] }}</option> @else <option value="">Select Option</option> @endif
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="body_works" class="col-sm-2 control-label">Body Works</label>

                    <div class="col-sm-10">
                      <select name="body_works" id="body_works" class="form-control">
                            @if($profileDetails[0]['body_work_skill'] != "") <option value="{{ $profileDetails[0]['body_work_skill'] }}">{{ $profileDetails[0]['body_work_skill'] }}</option> @else <option value="">Select Option</option> @endif
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="others" class="col-sm-2 control-label">Other Skills</label>

                    <div class="col-sm-10">
                      <select name="others" id="others" class="form-control">
                            @if($profileDetails[0]['other_skills'] != "") <option value="{{ $profileDetails[0]['other_skills'] }}">{{ $profileDetails[0]['other_skills'] }}</option> @else <option value="">Select Option</option> @endif
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-primary" onclick="updateInfo('speciality')">Update Information <img class="spinnerspeciality disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->


              <div class="tab-pane" id="value">
                <form class="form-horizontal">

                  <div class="form-group">
                    <label for="vimfile_discount" class="col-sm-2 control-label">VIMFile Discount</label>

                    <div class="col-sm-10">
                      <select name="vimfile_discount" id="vimfile_discount" class="form-control">
                            @if($profileDetails[0]['vimfile_discount'] != "") <option value="{{ $profileDetails[0]['vimfile_discount'] }}">{{ $profileDetails[0]['vimfile_discount'] }}</option> @else <option value="">Select Option</option> @endif
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="repair_guaranteed" class="col-sm-2 control-label">Repair Guaranteed</label>

                    <div class="col-sm-10">
                      <select name="repair_guaranteed" id="repair_guaranteed" class="form-control">
                            @if($profileDetails[0]['repair_guaranteed'] != "") <option value="{{ $profileDetails[0]['repair_guaranteed'] }}">{{ $profileDetails[0]['repair_guaranteed'] }}</option> @else <option value="">Select Option</option> @endif
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="free_estimates" class="col-sm-2 control-label">Free Estimates</label>

                    <div class="col-sm-10">
                      <select name="free_estimates" id="free_estimates" class="form-control">
                            @if($profileDetails[0]['free_estimated'] != "") <option value="{{ $profileDetails[0]['free_estimated'] }}">{{ $profileDetails[0]['free_estimated'] }}</option> @else <option value="">Select Option</option> @endif
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="walk_in_welcome" class="col-sm-2 control-label">Walk-In Welcome</label>

                    <div class="col-sm-10">
                      <select name="walk_in_welcome" id="walk_in_welcome" class="form-control">
                            @if($profileDetails[0]['walk_in_specified'] != "") <option value="{{ $profileDetails[0]['walk_in_specified'] }}">{{ $profileDetails[0]['walk_in_specified'] }}</option> @else <option value="">Select Option</option> @endif
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="other_added_value" class="col-sm-2 control-label">Others</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="other_added_value" placeholder="Other Added Value" value="{{ $profileDetails[0]['other_value_added'] }}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="average_waiting_period" class="col-sm-2 control-label">Average Waiting Period</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="average_waiting_period" placeholder="Average Waiting Period" value="{{ $profileDetails[0]['average_waiting'] }}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="hours_of_operation" class="col-sm-2 control-label">Hours of Operation</label>

                    <div class="col-sm-10">
                        <textarea name="hours_of_operation" id="hours_of_operation" cols="30" rows="30">{!! $profileDetails[0]['hours_of_operation'] !!}</textarea>
                    </div>
                  </div>




                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-primary" onclick="updateInfo('value')">Update Information <img class="spinnervalue disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->


              <div class="tab-pane" id="amenity">
                <form class="form-horizontal">

                  <div class="form-group">
                    <label for="wifi" class="col-sm-2 control-label">Wi-Fi</label>

                    <div class="col-sm-10">
                      <select name="wifi" id="wifi" class="form-control">
                            @if($profileDetails[0]['wifi'] != "") <option value="{{ $profileDetails[0]['wifi'] }}">{{ $profileDetails[0]['wifi'] }}</option> @else <option value="">Select Option</option> @endif
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="rest_room" class="col-sm-2 control-label">Gender Neutral Rest Room</label>

                    <div class="col-sm-10">
                      <select name="rest_room" id="rest_room" class="form-control">
                            @if($profileDetails[0]['restroom'] != "") <option value="{{ $profileDetails[0]['restroom'] }}">{{ $profileDetails[0]['restroom'] }}</option> @else <option value="">Select Option</option> @endif
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="lounge" class="col-sm-2 control-label">Lounge</label>

                    <div class="col-sm-10">
                      <select name="lounge" id="lounge" class="form-control">
                            @if($profileDetails[0]['lounge'] != "") <option value="{{ $profileDetails[0]['lounge'] }}">{{ $profileDetails[0]['lounge'] }}</option> @else <option value="">Select Option</option> @endif
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="parking_space" class="col-sm-2 control-label">Parking Space</label>

                    <div class="col-sm-10">
                      <select name="parking_space" id="parking_space" class="form-control">
                            @if($profileDetails[0]['parking_space'] != "") <option value="{{ $profileDetails[0]['parking_space'] }}">{{ $profileDetails[0]['parking_space'] }}</option> @else <option value="">Select Option</option> @endif
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-primary" onclick="updateInfo('amenity')">Update Information <img class="spinneramenity disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->


              <div class="tab-pane" id="history">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="year_established" class="col-sm-2 control-label">Year Established</label>

                    <div class="col-sm-10">
                      <input type="month" min="1900-01" max="{{ date('Y-m') }}" class="form-control" id="year_established" placeholder="Year Established" value="{{ $profileDetails[0]['year_established'] }}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="background" class="col-sm-2 control-label">Background</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="background" placeholder="Background" rows="10">{!! $profileDetails[0]['background'] !!}</textarea>
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-primary" onclick="updateInfo('history')">Update Information <img class="spinnerhistory disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->


              <div class="tab-pane" id="managephotos">
                <form class="form-horizontal" action="{{ route('updatephoto') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                    <label for="file" class="col-sm-2 control-label">Company Logo</label>

                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="file">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="manageimage" class="col-sm-2 control-label">Manage Photos</label>

                    <div class="col-sm-10">
                      <input type="file" class="myphotos form-control" name="manageimage[]" id="manageimage" multiple data-jpreview-container="#preview-container">
                      <div id="preview-container" class="jpreview-container"></div>
                    </div>
                  </div>




                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="hidden" name="busID" value="{{ session('busID') }}">
                      <button type="submit" class="btn btn-primary">Update Information </button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->


              <div class="tab-pane" id="serviceoffer">
                <form class="form-horizontal" action="{{ route('serviceoffered') }}" method="POST" id="service_form">
                    @csrf

                    <div class="form-group">
                    <label for="manageimage" class="col-sm-2 control-label">Service List</label>

                    <div class="col-sm-10">
                      @if($servicecheck = \App\User::where('email', session('email'))->get())

                      @if(count($servicecheck) > 0)
                        <p>{{ strtoupper($servicecheck[0]->service_offered) }}</p>

                        @else
                        -

                      @endif

                      @endif
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="service_offered" class="col-sm-2 control-label">Service Offered</label>

                    <div class="col-sm-10">
                      <select name="service_offered[]" id="service_offered" class="form-control" multiple>
                            <option value="Service" selected="selected" disabled="disabled">Service</option>
                                <optgroup label="Admin"><option value="inspection">inspection</option><option value="registration">registration</option><option value="insurance">insurance</option><option value="road assistance">road assistance</option><option value="business taxes">business taxes</option><option value="Road Fines">Road Fines</option><option value="Ticket">Ticket</option></optgroup>
                                <optgroup label="Fuel"><option value="fuel">fuel</option><option value="car wash">car wash</option></optgroup>
                                <optgroup label="Maintenance"><option value="air conditioning recharge">air conditioning recharge</option><option value="air filter">air filter</option><option value="battery">battery</option><option value="brake fluid flush">brake fluid flush</option><option value="brake pads">brake pads</option><option value="brake rotors">brake rotors</option><option value="coolant flush">coolant flush</option><option value="distributor cap &amp; rotor">distributor cap &amp; rotor</option><option value="fuel filter">fuel filter</option><option value="headlight">headlight</option><option value="oil change">oil change</option><option value="power steering flush">power steering flush</option><option value="spark plugs">spark plugs</option><option value="timing belt">timing belt</option><option value="tire - new">tire - new</option><option value="tire balancing">tire balancing</option><option value="tire inflation">tire inflation</option><option value="tire rotation">tire rotation</option><option value="wheel rotation and tire balancing">Wheel Rotation & Tire Balancing</option><option value="transmission fluid flush">transmission fluid flush</option><option value="wheel alignment">wheel alignment</option><option value="wiper blades">wiper blades</option><option value="other">other</option><option value="cabin air filter">cabin air filter</option><option value="smog check">smog check</option></optgroup>
                                <optgroup label="Repairs"><option value="alternator">alternator</option><option value="belt">belt</option><option value="body work">body work</option><option value="brake caliper">brake caliper</option><option value="carburetor">carburetor</option><option value="catalytic converter">catalytic converter</option><option value="clutch">clutch</option><option value="control arm">control arm</option><option value="coolant temperature sensor">coolant temperature sensor</option><option value="exhaust">exhaust</option><option value="fuel injector">fuel injector</option><option value="fuel tank">fuel tank</option><option value="head gasket">head gasket</option><option value="heater core">heater core</option><option value="hose">hose</option><option value="line">line</option><option value="mass air flow sensor">mass air flow sensor</option><option value="muffler">muffler</option><option value="oxygen sensor">oxygen sensor</option><option value="radiator">radiator</option><option value="shock/strut">shock/strut</option><option value="starter">starter</option><option value="thermostat">thermostat</option><option value="tie rod">tie rod</option><option value="transmission">transmission</option><option value="water pump">water pump</option><option value="wheel bearings">wheel bearings</option><option value="window">window</option><option value="windshield">windshield</option><option value="road side assistance">road side assistance</option><option value="other">other</option><option value="sensor">sensor</option>
                                </optgroup>
                        </select>
                        <small style="color: red; font-weight: bold;">Hold ctrl + click to select multiple</small>
                    </div>
                  </div>




                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="hidden" name="busID" value="{{ session('busID') }}">
                        <input type="hidden" name="email" value="{{ session('email') }}">
                        <input type="hidden" name="addto" id="addto" value="">
                      <button type="button" class="btn btn-primary" onclick="serviceUpdate()">Update Information </button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->



            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



</div>
<!-- ./wrapper -->

@endsection
