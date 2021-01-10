  {{-- Modals --}}

  {{-- Create Staff --}}
  <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-default" id="modal-Staff">
                Lauch Modal for Create Staff
              </button>


              <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-station" id="modal-Station">
                Lauch Modal for Create Station
              </button>


              <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-quickMail" id="modal-QuickMail">
                Launch Modal for Quick Mail
              </button>


              <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-checkPayment" id="modal-CheckPayment">
                Launch Modal for Check Payment
              </button>

              {{-- For Commercial Users --}}
              <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-checkDetails" id="modal-CheckDetails">
                Launch Modal for Check Details
              </button>


              <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-userList" id="modal-UserList">
                Launch Modal for User List
              </button>


              <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-personalList" id="modal-PersonalList">
                Launch Modal for Personal List
              </button>

              <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-downgrade" id="modal-Downgrade">
                Launch Modal for Downgrade
              </button>

              <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-revenueAdd" id="modal-RevenueAdd">
                  Launch Modal for Revenue Add
                </button>

                <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-setmin" id="modal-setMin">
                  Launch Modal for Set Minimum
                </button>


                <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-setmincharge" id="modal-setMinCharge">
                  Launch Modal for Set Minimum Charge
                </button>

                <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-clientProfile" id="modal-ClientProfile">
                  Launch Modal for Client Profile
                </button>

                <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-viewAnswer" id="modal-ViewAnswer">
                  Launch Modal for View Answer
                </button>


                <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-viewMM" id="modal-ViewMM">
                  Launch Modal for MM
                </button>

                <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-viewAD" id="modal-ViewAD">
                  Launch Modal for AD
                </button>


                <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-viewTicket" id="modal-ViewTicket">
                  Launch Modal for Tickets
                </button>


                <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-viewuserdetails" id="modal-ViewUserdetails">
                  Launch Modal for User Details
                </button>

                <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-viewestimatedetails" id="modal-ViewEstimatedetails">
                  Launch Modal for Estimate Details
                </button>

                <button type="button" class="btn btn-default disp-0" data-toggle="modal" data-target="#modal-viewestimatepaymentdetails" id="modal-ViewEstimatepaymentdetails">
                  Launch Modal for Estimate Payment Details
                </button>

                <!-- Button trigger modal -->
<button type="button" class="btn btn-primary disp-0" data-toggle="modal" data-target="#exampleSpecial" id="news">
  Launch demo modal news and hapenings
</button>

<button type="button" class="btn btn-primary disp-0" data-toggle="modal" data-target="#exampleviewnewspost" id="view_newsPost">
  Launch demo modal Member Record
</button>


<button type="button" class="btn btn-primary disp-0" data-toggle="modal" data-target="#exampleedit_info" id="edit_info">
  Launch demo modal Edit Mechanic Info
</button>


  <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" id="close_staff" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create User</h4>
              </div>
              <div class="modal-body">
                <div class="box-body">
              {{-- Form Input Here --}}

              @if(count($getBussiness) > 0)

              <div class="row">
                <div><span style="margin-left: 15px; font-weight: 600; text-transform: uppercase;">Fullname:</span></div><br>
                <div class="col-md-6">
                  <input type="hidden" name="id" class="form-control" value="" id="id_staff">
                  <input type="hidden" name="busID" class="form-control" value="{{ session('busID') }}" id="busIDstaff">
                  <input type="hidden" name="userType" class="form-control" value="{{ $getBussiness[0]->accountType }}" id="userType">
                  <input type="text" name="firstname" class="form-control" placeholder="Firstname" id="firstname">
                </div>
                <div class="col-md-6">
                  <input type="text" name="lastname" class="form-control" placeholder="Lastname" id="lastname">
                </div>
              </div>

              <div class="row mt-1">
                <div><span style="margin-left: 15px; font-weight: 600; text-transform: uppercase;">Generate Login Details:</span></div><br>
                <div class="col-md-6">
                  <input type="email" name="email" class="form-control" placeholder="E-mail" id="email">
                  {{-- <input type="text" name="username" class="form-control" placeholder="Username" id="username"> --}}
                </div>
                <div class="col-md-6">
                  <input type="password" name="password" class="form-control" placeholder="Password" id="password">
                </div>
              </div>

              <div class="row mt-1">
                <div><span style="margin-left: 15px; font-weight: 600; text-transform: uppercase;">Official detail:</span></div><br>
                <div class="col-md-6">
                  <select name="station" class="form-control" id="station">
                    @if (count($getStations) > 0)
                    <option value="">--Select Station--</option>
                      @foreach($getStations as $stations)
                        <option value="{{ $stations->station_name }}">{{ $stations->station_name }}</option>
                      @endforeach
                    @endif


                  </select>
                  {{-- <input type="email" name="email" class="form-control" placeholder="E-mail" id="email"> --}}
                </div>
                <div class="col-md-6">
                  <input type="text" name="position" class="form-control" placeholder="Position" id="position">
                </div>
              </div>

              <div class="row mt-1">
               {{--  <div><span style="margin-left: 15px; font-weight: 600; text-transform: uppercase;">Station Assignment</span></div><br>
                <div class="col-md-6">
                  <select name="station" class="form-control" id="station">
                    @if (count($getStations) > 0)
                    <option value="">--Select Station--</option>
                      @foreach($getStations as $stations)
                        <option value="{{ $stations->station_name }}">{{ $stations->station_name }}</option>
                      @endforeach
                    @endif


                  </select>
                </div> --}}
                <div class="col-md-12">
                  <button type="button" class="btn btn-success" style="width: 100%;" id="staff_save" onclick="staff('create', 'staff')">Save</button>
                  <button type="button" class="btn btn-primary disp-0" style="width: 100%;" id="staff_update" onclick="staff('update', 'staff')">Update</button>
                </div>
              </div>

              @else

              <div class="row">
                <h4 style="text-align: center;">Cannot create user at the moment</h4>
              </div>


              @endif


            </div>
              </div>

            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
  {{-- End Create Staff --}}

  {{-- Create Station --}}

  <div class="modal fade" id="modal-station">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" id="close_station" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create Station</h4>
              </div>
              <div class="modal-body">
                <div class="box-body">
              {{-- Form Input Here --}}
              <div class="row">
                <div><span style="margin-left: 15px; font-weight: 600; text-transform: uppercase;">Station Name:</span></div><br>
                <div class="col-md-12">
                  <input type="hidden" name="id" class="form-control" value="" id="id">
                  <input type="hidden" name="busID" class="form-control" value="{{ session('busID') }}" id="busIDstation">
                  <input type="text" name="stations" class="form-control" placeholder="Station Name" id="stationz">
                </div>
              </div>

              <div class="row mt-1">
                <div><span style="margin-left: 15px; font-weight: 600; text-transform: uppercase;">Address:</span></div><br>
                  <div class="col-md-6">
                    <h6>Station Address</h6>
                    <input type="text" class="form-control" name="station_address" id="station_address" placeholder="Station Address">
                  </div>
                  <div class="col-md-6">
                    <h6>Phone Number</h6>
                    <input type="text" class="form-control" name="station_phone" id="station_phone" placeholder="Phone Number">
                  </div>
              </div>


              <div class="row mt-1">
                  <div class="col-md-6">
                  <h6>City</h6>
                  <input type="text" name="city" class="form-control" placeholder="Area/City" id="city">
                </div>

                <div class="col-md-6">
                  <h6>Zip code</h6>
                  <input type="text" name="zippcode" class="form-control" placeholder="Zip Code" id="zippcode">
                </div>
              </div>




                <div class="row mt-1">

                <div class="col-md-6">
                  <h6>Country</h6>
                  {{-- <input type="text" name="country" class="form-control" placeholder="Country" id="country"> --}}
                  <select id="country" name="country" class="form-control"></select>
                </div>
                <div class="col-md-6">
                  <h6>State/Province</h6>
                  {{-- <input type="text" name="state" class="form-control" placeholder="State/Province" id="state"> --}}
                  <select id="state" name="state" class="form-control"></select>
                </div>




              </div>

              <div class="row mt-1">
                <div class="col-md-12">
                  <button type="button" class="btn btn-danger" style="width: 100%;" id="station_save" onclick="staff('create', 'station')">Save</button>
                  <button type="button" class="btn btn-primary disp-0" style="width: 100%;" id="station_update" onclick="staff('update', 'station')">Update</button>
                </div>
              </div>

            </div>
              </div>

            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

  {{-- End Creeate Station --}}


  {{-- Create Quick Mail --}}



  <div class="modal fade" id="modal-quickMail">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <div class="box-header">
                <i class="fa fa-envelope"></i>

                <h3 class="box-title">Quick Email</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                  <button type="button" class="btn btn-info btn-sm" data-dismiss="modal" aria-label="Close" data-widget="remove" data-toggle="tooltip"
                          title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
                <!-- /. tools -->
              </div>
              </div>
              <div class="modal-body">
                          <!-- quick email widget -->
          <div class="box box-info">

            <div class="box-body">
              <form action="#" method="post">
                <div class="form-group">
                  <p>To: </p>
                  @if (session('role') == "Agent")
                    <input type="email" class="form-control" name="emailto" id="quickEmail" placeholder="Email to:" value="info@vimfile.com">
                  @else
                  <input type="email" class="form-control" name="emailto" id="quickEmail" placeholder="Email to:">
                  @endif
                </div>
                <div class="form-group">
                  <p>Subject: </p>
                  <input type="text" class="form-control" name="subject" id="quickSubject" placeholder="Subject">
                </div>
                <div>
                  <p>Message: </p>
                  <textarea id="quickMessage" class="textarea" placeholder="Message"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </form>
            </div>
            <div class="box-footer clearfix">
              <button type="button" class="pull-right btn btn-default" id="sendEmail" onclick="senderMail()">Send
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>

              </div>

            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


  {{-- End Quick Mail --}}




  {{-- Start Change Password --}}

        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary disp-0" data-toggle="modal" data-target="#changePassword" id="change_pass">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePasswordTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>

      </div>
      <form action="{{ route('passwordchange') }}" method="post">
        @csrf
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <h5>Old Password</h5>
                <input type="password" name="oldpassword" id="oldpassword" class="form-control" placeholder="Old Password">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5>New Password</h5>
                <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="New Password">
            </div>
        </div>
      </div>
      <div class="modal-footer">

        <input type="hidden" name="username" value="{{ session('email') }}">
        <button type="submit" class="btn btn-primary btn-block">Change Password</button>

      </div>
      </form>
    </div>
  </div>
</div>


  {{-- End Change Password --}}


    {{-- Check Payment State --}}



    <div class="modal fade" id="modal-checkPayment">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <div class="box-header">
              <i class="fa fa-shopping-cart"></i>

              <h3 class="box-title">Client Details, Payment Status & Plan</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm paystatsclose" data-dismiss="modal" aria-label="Close" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            </div>
            <div class="modal-body">
                        <!-- quick email widget -->
        <div class="box box-info">

          <div class="box-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tbody id="tablez">

                  </tbody>
                </table>
              </div>
          </div>

        </div>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


{{-- End Check Payment State --}}


    {{-- Check Commercial User Details --}}



    <div class="modal fade" id="modal-checkDetails">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <div class="box-header">
              <i class="fa fa-shopping-cart"></i>

              <h3 class="box-title">Commercial User Details</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-dismiss="modal" aria-label="Close" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            </div>
            <div class="modal-body">
                        <!-- quick email widget -->
        <div class="box box-info">

          <div class="box-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tbody id="tablezs">

                  </tbody>
                </table>
              </div>
          </div>

        </div>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


{{-- End Check Commercial User Details --}}


    {{-- All Personal & Business Account List --}}



    <div class="modal fade" id="modal-userList">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <div class="box-header">
              <i class="fa fa-user"></i>

              <h3 class="box-title">Personal & Business Account List</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-dismiss="modal" aria-label="Close" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            </div>
            <div class="modal-body">
                        <!-- quick email widget -->
        <div class="box box-info">

          <div class="box-body">
              <div class="table-responsive">
                  <table id="example3" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Account Type</th>
                      </tr>
                      </thead>
                      <tbody>

                        @if(count($users) > 0)
                        <?php $i = 1;?>
                        @foreach($users as $user)
                        {{-- $string = (strlen($string) > 13) ? substr($string,0,10).'...' : $string; --}}
                          <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->state }}</td>
                            <td>{{ $user->country }}</td>
                            <td style="font-weight: bold; text-transform: uppercase; font-size: 12px;">{{ $user->userType }}</td>
                          </tr>

                        @endforeach

                        @endif

                      </tbody>
                    </table>
              </div>
          </div>

        </div>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


{{-- End All Personal And Business List --}}


    {{-- All Personal List --}}



    <div class="modal fade" id="modal-personalList">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <div class="box-header">
              <i class="fa fa-user"></i>

              <h3 class="box-title">Personal & Business Account List</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm persClose" data-dismiss="modal" aria-label="Close" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            </div>
            <div class="modal-body">
                        <!-- quick email widget -->
        <div class="box box-info">

          <div class="box-body">
              <div class="table-responsive">
                  <table class="table table-hover" id="example4">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Detail</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if (count($getUsers) > 0)
                        <?php $i = 1;?>
                      @foreach($getUsers as $getUser)

                      @if ($getUser->status == 1)

                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $getUser->name }}</td>
                        <td>{{ $getUser->email }}</td>
                        <td><span class="label label-info" style="cursor: pointer;" onclick="getuserdetails('{{ $getUser->id }}')">Details</span></td>
                        <td><span class="label label-danger" style="cursor: pointer;" onclick="accessAction('{{ $getUser->id }}','personalDecline')">Decline <img class="spinner{{ $getUser->id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span></td>
                      </tr>

                      @endif


                      @endforeach
                      @endif
                    </tbody>




                    </table>
              </div>
          </div>

        </div>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


{{-- End All Personal List --}}



    {{-- All Personal List --}}



    <div class="modal fade" id="modal-revenueAdd">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <div class="box-header">
              <i class="fa fa-user"></i>

              <h3 class="box-title">Post Revenue Reports</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-dismiss="modal" aria-label="Close" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            </div>
            <div class="modal-body">
                        <!-- quick email widget -->
        <div class="box box-info">

          <div class="box-body">
              <div class="table-responsive">
                  <table class="table table-hover" id="example5">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Avg. Revenue</th>
                        <th>Total Revenue</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if (count($getUsers) > 0)
                        <?php $i = 1;?>
                      @foreach($getUsers as $getInfo)

                      @if ($getInfo->userType == "Commercial")

                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $getInfo->name }}</td>
                        <td>{{ $getInfo->email }}</td>
                        <td>
                          <input type="text" name="avg_rev" id="avg_rev" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="tot_rev" id="tot_rev" class="form-control">
                          </td>
                        <td><span class="label label-primary" style="cursor: pointer;" onclick="postRev('{{ $getInfo->id }}', '{{ $getInfo->name }}', '{{ $getInfo->email }}')">Post <img class="spinnerRev{{ $getInfo->id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span></td>
                      </tr>

                      @endif


                      @endforeach
                      @endif
                    </tbody>




                    </table>
              </div>
          </div>

        </div>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->



      <div class="modal fade" id="modal-setmin">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <div class="box-header">
              <i class="fa fa-user"></i>

              <h3 class="box-title">Set Minimal</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-dismiss="modal" aria-label="Close" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            </div>
            <div class="modal-body">
                        <!-- quick email widget -->
        <div class="box box-info">

          <div class="box-body">
                  <h4>1. Set Discount</h4>
                  <p>Current available minimum discount is: <b>{{ $discount[0]->percent }}%</b></p>

                  <div class="row">
                    <div class="col-md-12">
                      <input type="hidden" name="discount" id="discount" value="discount" class="form-control">
                      <input type="number" name="set_discount" id="set_discount" class="form-control">
                    </div>
                  </div>
                  <br>
                  <h4>2. Service Charge</h4>
                  <p>Current available minimum service charge is: <b>{{ $service_charge[0]->percent }}%</b></p>

                  <div class="row">
                    <div class="col-md-12">
                      <input type="hidden" name="service" id="service" value="service" class="form-control">
                      <input type="number" name="set_servicecharge" id="set_servicecharge" class="form-control">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                      <button class="btn btn-primary btn-block" onclick="discount()">Update Minimum <img class="animated fadeIn spin discountSpin disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 30px; height: 30px;"></button>
                    </div>
                  </div>
          </div>

        </div>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


      <div class="modal fade" id="modal-setmincharge">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <div class="box-header">
              <i class="fa fa-user"></i>

              <h3 class="box-title">Set Minimum Charges</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-dismiss="modal" aria-label="Close" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            </div>
            <div class="modal-body">
                        <!-- quick email widget -->
        <div class="box box-info">

          <div class="box-body">
                  <h4>Set Discount</h4>
                  <p>Current available minimum discount is: <b>@if(count($discountcharge) > 0){{ $discountcharge[0]->percent }}% @else 0% @endif</b></p>

                  <div class="row">
                    <div class="col-md-12">
                      <input type="hidden" name="discountcharge" id="discountcharge" value="discount" class="form-control">
                      <input type="number" name="set_discountcharge" id="set_discountcharge" class="form-control">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                      <button class="btn btn-primary btn-block" onclick="discountCharges()">Set Minimum Charge <img class="animated fadeIn spin discountSpinner disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 30px; height: 30px;"></button>
                    </div>
                  </div>
          </div>

        </div>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


{{-- End All Personal List --}}


{{-- Create Downgrade Reason --}}



  <div class="modal fade" id="modal-downgrade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <div class="box-header">
                <i class="fa fa-envelope"></i>

                <h3 class="box-title">We would like to know your reason for a downgrade.</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                  <button type="button" class="btn btn-info btn-sm" data-dismiss="modal" aria-label="Close" data-widget="remove" data-toggle="tooltip"
                          title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
                <!-- /. tools -->
              </div>
              </div>
              <div class="modal-body">
                          <!-- quick email widget -->
          <div class="box box-info">

            <div class="box-body">
              <form action="#" method="post">
                <div>
                  <textarea id="quickReason" class="textarea" placeholder="Message"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </form>
            </div>
            <div class="box-footer clearfix">
              <button type="button" class="pull-right btn btn-default" id="sendDown" onclick="senderDowngrade('{{ session('busID') }}')">Send
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>

              </div>

            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


  {{-- End Downgrade Reason --}}


      {{-- Check Commercial User Details --}}



    <div class="modal fade" id="modal-clientProfile">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <div class="box-header">
              <i class="fa fa-shopping-cart"></i>

              <h3 class="box-title">Client Profile</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-dismiss="modal" aria-label="Close" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            </div>
            <div class="modal-body">
                        <!-- quick email widget -->
        <div class="box box-info">

          <div class="box-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tbody id="clientTable">

                  </tbody>
                </table>
              </div>
          </div>

        </div>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


{{-- End Check Commercial User Details --}}



      {{--Answer to Questions --}}



    <div class="modal fade" id="modal-viewAnswer">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <div class="box-header">
              <i class="fa fa-shopping-cart"></i>

              <h3 class="box-title">Answer</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-dismiss="modal" aria-label="Close" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            </div>
            <div class="modal-body">
                        <!-- quick email widget -->
        <div class="box box-info">

          <div class="box-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tbody id="answerTable">

                  </tbody>
                </table>
              </div>
          </div>

        </div>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


{{-- End Answer to Questions --}}


{{-- Start MM --}}

      <div class="modal fade" id="modal-viewMM">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <div class="box-header">
              <i class="fa fa-shopping-cart"></i>

              <h3 class="box-title">Mobile Mechanics</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" id="mmclose" data-dismiss="modal" aria-label="Close" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            </div>
            <div class="modal-body">
                        <!-- quick email widget -->
        <div class="box box-info">

          <div class="box-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tbody id="mmTable">

                  </tbody>
                </table>
              </div>
          </div>

        </div>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

{{-- End MM --}}


{{-- Start AD --}}


      <div class="modal fade" id="modal-viewAD">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <div class="box-header">
              <i class="fa fa-shopping-cart"></i>

              <h3 class="box-title">Auto Dealers</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" id="adclose" data-dismiss="modal" aria-label="Close" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            </div>
            <div class="modal-body">
                        <!-- quick email widget -->
        <div class="box box-info">

          <div class="box-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tbody id="adTable">

                  </tbody>
                </table>
              </div>
          </div>

        </div>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

{{-- End AD --}}


{{-- Start Ticket Details --}}


      <div class="modal fade" id="modal-viewTicket">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <div class="box-header">
              <i class="fa fa-shopping-cart"></i>

              <h3 class="box-title">Support Ticket</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" id="ticketclose" data-dismiss="modal" aria-label="Close" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            </div>
            <div class="modal-body">
                        <!-- quick email widget -->
        <div class="box box-info">

          <div class="box-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tbody id="ticketTable">


                  </tbody>
                </table>
                <hr>
                <div class="footer_table" id="foot_table">

                </div>
              </div>
          </div>

        </div>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

{{-- End Ticket Details --}}

{{-- Start View User Details --}}

      <div class="modal fade" id="modal-viewuserdetails">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <div class="box-header">
              <i class="fa fa-shopping-cart"></i>

              <h3 class="box-title">User Details</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" id="userdetailsclose" data-dismiss="modal" aria-label="Close" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            </div>
            <div class="modal-body">
                        <!-- quick email widget -->
        <div class="box box-info">

          <div class="box-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tbody id="userdetailsTable">


                  </tbody>
                </table>
                <hr>
                <div class="footer_table" id="user_foot_table">

                </div>
              </div>
          </div>

        </div>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

{{-- End View User Details --}}


{{-- Start View Estimate Details --}}

      <div class="modal fade" id="modal-viewestimatedetails">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <div class="box-header">
              <i class="fa fa-shopping-cart"></i>

              <h3 class="box-title">Estimate Details</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" id="estimatedetailsclose" data-dismiss="modal" aria-label="Close" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            </div>
            <div class="modal-body">
                        <!-- quick email widget -->
        <div class="box box-info">

          <div class="box-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tbody id="estimatedetailsTable">


                  </tbody>
                </table>
                <hr>
                <div class="footer_table" id="estimate_foot_table">

                </div>
              </div>
          </div>

        </div>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

{{-- End View Estimate Details --}}



{{-- Start View Estimate Payment Details --}}

      <div class="modal fade" id="modal-viewestimatepaymentdetails">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <div class="box-header">
              <i class="fa fa-shopping-cart"></i>

              <h3 class="box-title">Estimate Payment Details</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" id="estimatepaymentdetailsclose" data-dismiss="modal" aria-label="Close" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            </div>
            <div class="modal-body">
                        <!-- quick email widget -->
        <div class="box box-info">

          <div class="box-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tbody id="estimatepaymentdetailsTable">


                  </tbody>
                </table>
                <hr>
                <div class="footer_table" id="estimatepayment_foot_table">

                </div>
              </div>
          </div>

        </div>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

{{-- End View Estimate Payment Details --}}




<!-- Modal -->
<div class="modal fade" id="exampleSpecial" tabindex="-1" role="dialog" aria-labelledby="exampleSpecialTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green-gradient">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">News and Happenings</h5>

      </div>
      <div class="modal-body">
                            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list mg-t-30">
                        <div class="cmp-tb-hd">
                            <h4 style="font-weight: bold;">Post Here</h4>

                        </div>
                        <div class="alert alert-danger error text-center disp-0"></div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="nk-int-mk sl-dp-mn">
                                    <h5 style="font-weight: bold;">Subject</h5>
                                </div>
                                <div class="chosen-select-act fm-cmp-mg">
                                    <input type="hidden" name="newsPostid" id="newsPostid" class="form-control" value="">
                                    <input type="text" name="newsSubject" id="newsSubject" class="form-control">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="nk-label">Description</label>
                                <div class="summernote">
                                    <div class="html-editor" id="newsDesc" name="newsDesc"></div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                    <h5 style="font-weight: bold;">Media</h5>
                                </div>
                                <input type="file" name="newsUpload" id="newsUpload" class="form-control">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
                <div class="row mg-t-30">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <button class="btn btn-secondary btn-sm hec-button bg-black savenews" style="width: 100%;" onclick="newsHapening('{{ 'bambo_'.time() }}')">Save <img class="animated fadeIn spin newsSpins disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 30px; height: 30px;"></button>

                        <button class="btn btn-secondary btn-sm hec-button bg-navy updtnews disp-0" style="width: 100%;" onclick="newshapeningUpdt()">Update <img class="animated fadeIn spin newsSpins disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 30px; height: 30px;"></button>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="toggle-select-act fm-cmp-mg" align="right">
                            <div class="checkbox icheck" style="margin-top: 5px;">
                                <label>
                                    <input id="ts3" type="checkbox" value="" name="newsAction" class="newsAction minimal-red">
                                    <small style="color: red; font-weight: bold;">Activate This Post</small>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>


{{-- Start News and Happenings --}}




<!-- Modal -->
<div class="modal fade" id="exampleviewnewspost" tabindex="-1" role="dialog" aria-labelledby="exampleviewnewspostTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-navy-active">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">News and Happenings</h5>

      </div>
      <div class="modal-body">
            <table class="table table-hover table-striped">
                <tbody id="newspostresult">

                </tbody>
            </table>
      </div>
      <div class="modal-footer">
        <div class="row mg-t-30">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="newspostactivation">

                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>


{{-- End News and Happenings --}}



{{-- Start Edit Mechanic Info --}}

<!-- Modal -->
<div class="modal fade" id="exampleedit_info" tabindex="-1" role="dialog" aria-labelledby="exampleedit_infoTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-navy-active">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">Mechanic Information</h5>

      </div>
      <div class="modal-body">
          <div class="row">
            <div><span style="margin-left: 15px; font-weight: 600; text-transform: uppercase;">Station Name:</span></div><br>
            <div class="col-md-12">
              <input type="hidden" name="mechstation_id" class="form-control" placeholder="Station ID" id="mechstation_id">
              <input type="text" name="mechstation_name" class="form-control" placeholder="Station Name" id="mechstation_name">
            </div>

          </div>

          <div class="row">
            <div><span style="margin-left: 15px; font-weight: 600; text-transform: uppercase;">Address:</span></div><br>
            <div class="col-md-12">
              <input type="text" name="mechstation_address" class="form-control" placeholder="Address" id="mechstation_address">
            </div>

          </div>


          <div class="row">
            <div class="col-md-6">
                <h5>Postal Code</h5>
              <input type="text" name="mechstation_zipcode" class="form-control" placeholder="Zip Code/ Postal Code" id="mechstation_zipcode">
            </div>
            <div class="col-md-6">
                <h5>City</h5>
              <input type="text" name="mechstation_city" class="form-control" placeholder="City" id="mechstation_city">
            </div>

          </div>

          <div class="row">

            <div class="col-md-6">
                <h5>State/Province</h5>
                <select name="mechstation_state" id="mechstation_state" class="form-control"></select>
              {{-- <input type="text" name="mechstation_state" class="form-control" placeholder="State/Province" id="mechstation_state"> --}}
            </div>
            <div class="col-md-6">
                <h5>Country</h5>
                <select name="mechstation_country" id="mechstation_country" class="form-control"></select>
              {{-- <input type="text" name="mechstation_country" class="form-control" placeholder="Country" id="mechstation_country"> --}}
            </div>

          </div>



      </div>
      <div class="modal-footer">
          <button class="btn btn-primary" onclick="updateCrawl()">Update <img class="spinner disp-0" style='width: 30px; height: auto; position:relative; margin: 0 auto;' src='https://icon-library.net/images/spinner-icon-gif/spinner-icon-gif-28.jpg' /></button>
      </div>
    </div>
  </div>
</div>




{{-- End Edit Mechanic Info --}}



{{-- Start Activate Platform Product --}}

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary disp-0" data-toggle="modal" data-target="#busywrenchproduct" id="clickBW">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="busywrenchproduct" tabindex="-1" role="dialog" aria-labelledby="busywrenchproductTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Activation Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
            <input type="hidden" name="bwbusid" id="bwbusid" value="">
            <input type="hidden" name="bwaction" id="bwaction" value="">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label class="nk-label">Description</label>
                <div class="summernote">
                    <div class="html-editor" id="bwDesc" name="bwDesc"></div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="activateBW()">Activate <img class="spins disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></button>
      </div>
    </div>
  </div>
</div>



{{-- End Activate Platform Product --}}




{{-- Create Support Agent --}}


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary disp-0" data-toggle="modal" data-target="#agentModal" id="agent">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="agentModal" tabindex="-1" role="dialog" aria-labelledby="agentModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h5 class="modal-title" id="exampleModalLongTitle">Create Support/Rep Agent</h5>
        
      </div>
      <div class="modal-body">
        <div class="box-body">
            <form action="{{ route('createagent') }}" method="post">
                @csrf
                <div class="row">
                <div><span style="margin-left: 15px; font-weight: 600; text-transform: uppercase;">Personal Information</span></div><br>
                <div class="col-md-6">
                    <p>Firstname</p>
                    <input type="hidden" name="busID" class="form-control" value="{{ session('busID') }}" id="busIDstaff">
                    <input type="text" name="firstname" class="form-control" placeholder="Firstname" id="firstname" required>
                </div>
                <div class="col-md-6">
                    <p>Lastname</p>
                    <input type="text" name="lastname" class="form-control" placeholder="Lastname" id="lastname" required>
                </div>
                </div>

                <div class="row mt-1">
                  <div class="col-md-12">
                      <p>Address</p>
                      <input type="text" name="address" class="form-control" placeholder="Address" id="address">
                  </div>
                  
                  </div>

                <div class="row mt-1">
                  <div class="col-md-12">
                    <p>Email Address</p>
                    <input type="email" name="email" class="form-control" placeholder="E-mail" id="email" required>
                </div>
                  
                  </div>


                <div class="row mt-1">
                  <div class="col-md-12">
                    <p>Phone Number</p>
                    <input type="text" name="telephone" class="form-control" placeholder="Phone Number" id="telephone">
                </div>
                  
                  </div>

                
                
                <hr>
                <div class="row mt-1">
                <div><span style="margin-left: 15px; font-weight: 600; text-transform: uppercase;">Assignment Details:</span></div><br>
                <div class="col-md-12">
                    <p>Country</p>
                    <select name="country" id="agent_country" class="form-control" required></select>
                </div>
                
                </div>
                <div class="row mt-1">
                <div class="col-md-12">
                    <p>State/Province</p>
                    <select name="state[]" id="agent_state" class="form-control" required multiple></select>
                </div>
                
                </div>

                <p style="font-weight: bold; color: red;">Hold ctrl + click to select multiple</p>

                <br>

                <div class="row mt-1">
                
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success" style="width: 100%;">Submit</button>
                </div>
                </div>
            </form>
            


        </div>
      </div>
    </div>
  </div>
</div>



{{-- End Create Support Agent --}}




{{-- Start Create Users --}}

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary disp-0" data-toggle="modal" data-target="#createusersModal" id="createusers">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="createusersModal" tabindex="-1" role="dialog" aria-labelledby="createusersModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h5 class="modal-title" id="exampleModalLongTitle">Create Mechanics by Admin</h5>
        
      </div>
      <div class="modal-body">
        <div class="box-body">
            <form action="{{ route('createnewusers') }}" method="post">
                @csrf
                <div class="row">
                <div><span style="margin-left: 15px; font-weight: 600; text-transform: uppercase;">Personal Information</span></div><br>
                <div class="col-md-6">
                    <p>Firstname</p>
                    <input type="hidden" name="busID" class="form-control" value="{{ "BW_".mt_rand(1000, 9999) }}" id="busIDstaff">
                    <input type="text" name="firstname" class="form-control" placeholder="Firstname" required>
                </div>
                <div class="col-md-6">
                    <p>Lastname</p>
                    <input type="text" name="lastname" class="form-control" placeholder="Lastname" required>
                </div>
                </div>
                <hr>
                <div class="row mt-1">
                <br>
                <div class="col-md-12">
                    <p>Email Address</p>
                    <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                </div>
                
                
                </div>
                <div class="row mt-1">
                <br>
                <div class="col-md-12">
                  <p>Phone Number</p>
                  <input type="text" name="telephone" class="form-control" placeholder="Phone Number" required>
              </div>
                
                
                </div>


                <div class="row mt-1">
                <br>
                <div class="col-md-12">
                  <p>Country</p>
                  {{-- <input type="text" name="telephone" class="form-control" placeholder="Country" required> --}}
                  <select name="country" id="mech_country" class="form-control" required></select>
              </div>
                
                
                </div>
                
                <br>

                <div class="row mt-1">
                
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success" style="width: 100%;">Submit</button>
                </div>
                </div>
            </form>
            


        </div>
      </div>
    </div>
  </div>
</div>


{{-- End Create Users --}}



{{-- Edit Support Agent --}}


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary disp-0" data-toggle="modal" data-target="#editagentModal" id="edit_agent">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="editagentModal" tabindex="-1" role="dialog" aria-labelledby="editagentModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h5 class="modal-title" id="exampleModalLongTitle">Edit Support Agent Information</h5>
        
      </div>
      <div class="modal-body">
        <div class="box-body">
            <form action="{{ route('updateagent') }}" method="post">
                @csrf
                <div class="row">
                <div><span style="margin-left: 15px; font-weight: 600; text-transform: uppercase;">Personal Information</span></div><br>
                <div class="col-md-6">
                    <p>Firstname</p>
                    <input type="hidden" name="id" id="agent_id" class="form-control" value="">
                    <input type="text" name="firstname" class="form-control" placeholder="Firstname" id="agent_firstname" required>
                </div>
                <div class="col-md-6">
                    <p>Lastname</p>
                    <input type="text" name="lastname" class="form-control" placeholder="Lastname" id="agent_lastname" required>
                </div>
                </div>

                <div class="row mt-1">
                  <div class="col-md-12">
                      <p>Address</p>
                      <input type="text" name="address" class="form-control" placeholder="Address" id="agent_address">
                  </div>
                  
                  </div>

                <div class="row mt-1">
                  <div class="col-md-12">
                    <p>Email Address</p>
                    <input type="text" name="email" class="form-control" placeholder="E-mail" id="agent_email" required>
                </div>
                </div>


                <div class="row mt-1">
                  <div class="col-md-12">
                    <p>Phone Number</p>
                    <input type="text" name="telephone" class="form-control" placeholder="Phone Number" id="agent_telephone" required>
                </div>
                </div>


                <hr>
                <div class="row mt-1">
                <div><span style="margin-left: 15px; font-weight: 600; text-transform: uppercase;">Login Details:</span></div><br>
                
                </div>
                <div class="row mt-1">
                <div class="col-md-12">
                    <p>Username</p>
                    <input type="text" name="username" class="form-control" placeholder="Password" id="agent_username" readonly required>
                </div>
                
                </div>
                <br>

                <div class="row mt-1">
                  <div><span style="margin-left: 15px; font-weight: 600; text-transform: uppercase;">Assignment Details:</span></div><br>
                  <div class="col-md-12">
                      <p>Country</p>
                      <select name="country" id="agents_country" class="form-control" required></select>
                  </div>
                  
                  </div>
                  <div class="row mt-1">
                  <div class="col-md-12">
                      <p>State/Province</p>
                      <select name="state[]" id="agents_state" class="form-control" required multiple></select>
                  </div>
                  
                  </div>

                  

                  <p style="font-weight: bold; color: red;">Hold ctrl + click to select multiple</p>

                  <br>

                <div class="row mt-1">
                
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Update</button>
                </div>
                </div>
            </form>
            


        </div>
      </div>
    </div>
  </div>
</div>



{{-- End Edit Support Agent --}}