@extends('layouts.dashboard')

@section('title', 'Dashboard')
<?php use \App\Http\Controllers\Admin; ?>
@show


@section('dashContent')

<div class="wrapper">

  @include('includes.dashhead')
  @include('includes.dashaside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      @if(session('role') == "Owner" && session('status') != 0)

      {{-- Start Promo Count down --}}

        <h4 style="font-weight: bold; color: navy;" id="demo"></h4>

      {{-- End Promo count down --}}

      <center>
        <div class="small-tag bg-red"><b>{{ $carNos }} @if($carNos > 1) vehicles @else vehicle @endif  registered between {{ date('01-M-Y') }} AND {{  date('d-M-Y')  }}</b></div>
      </center>


      @endif


      @if(session('role') == "Agent")

      @if($agents = \App\Admin::where('email', session('email'))->get())

        @if (count($agents) > 0)

      <h4 style="font-weight: bold; color: navy;">
        
        Country Allocated: @if($agents[0]->country != null) {{ $agents[0]->country }} @else NILL @endif<br><br>
        State / Province Allocated: @if($agents[0]->province != null) @php $state = json_decode($agents[0]->province); @endphp {{ implode(", ", $state) }}  @else - @endif
        <br>
      
      
      </h4>

      @endif
      @endif
      @endif



      <ol class="breadcrumb">
        <li><a href="{{ route('Admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>


    @if(session('role') == "Super" && session('status') == 1)

    {{-- Start super Admin view --}}

        <!-- Main content -->
    <section class="content">
<!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ count($getBusinessStaffs) + count($otherUsers) }}</h3>

              <p>Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('Allstaffs') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ count($getStations) }}</h3>

              <p>Stations</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('Allstations') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->


          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ count($CarReccount) }}</h3>

              <p>Vehicles with Maintenance Record</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a class="small-box-footer">&nbsp;</a>
            {{-- <a href="{{ route('Allcarrecords') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $maintReccount }}</h3>

              <p>Maintenance Records</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('Allmaintenancerecord') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>



      </div>
      <!-- /.row -->

      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-navy">
            <div class="inner">
              <h3>@if($registeredClients != ""){{ count($registeredClients) }} @else 0 @endif</h3>

              <p>Registered Invites</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a class="small-box-footer">&nbsp;</a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $unregisteredClients }}</h3>

              <p>Not Registered Invites</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a class="small-box-footer">&nbsp;</a>
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>{{ count($carwithoutcarrec) }}</h3>

              <p>Vehicles without Car records</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a class="small-box-footer">&nbsp;</a>
            {{-- <a href="{{ route('Allcarrecords') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        <!-- ./col -->


        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-black">
            <div class="inner">
              <h3>{{ count($regCars) }}</h3>

              <p>Users with Car records</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a class="small-box-footer">&nbsp;</a>
            {{-- <a href="{{ route('Allcarrecords') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        <!-- ./col -->

      </div>
      <!-- /.row -->


      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-navy">
            <div class="inner">
              <h3>{{ count($carwithcarrec) }}</h3>

              <p>Vehicles with Car records</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a class="small-box-footer">&nbsp;</a>
            {{-- <a href="{{ route('Allcarrecords') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>{{ $crawl }}</h3>

              <p>Crawled Mechanics</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a class="small-box-footer">&nbsp;</a>
            {{-- <a href="{{ route('Allcarrecords') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $crawldealers }}</h3>

              <p>Crawled Auto Dealers</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('crawled autodealers') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>Crawled by Country</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('crawlcountry') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-black">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>Mechanics without Emails</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('crawlsnoMail') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>Downloaded Letters</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('crawlprint') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>Support Tickets</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('supportticket') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>{{ $claimsCount }}</h3>

              <p>Claim Business</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('busywrench') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ count($allmechanic) }}</h3>

              <p>All Mechanics</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('allmechanics') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ count($supportagent) }}</h3>

              <p>Support Agents</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('supportagents') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>{{ count($agreementsign) }}</h3>

              <p>Agreement Signed</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('agreement signed') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $freeuserscount }}</h3>

              <p>Free Trial Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('freeusers') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>{{ $paiduserscount }}</h3>

              <p>Paid Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('paidusers') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $freeplanuserscount }}</h3>

              <p>Free Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('freeplanusers') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>Promotional Materials</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('promotional materials') }}" class="small-box-footer">Upload Documents <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>Workflow (PDF)</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('workflow upload') }}" class="small-box-footer">Upload Documents <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>





      </div>
      <!-- /.row -->



      <!-- Main row -->
      <div class="row">



        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">ACC & Business Accounts Awaiting Approval</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>#</th>
                  <th>Coy. Name</th>
                  <th>Sub. Plan</th>
                  <th>Details</th>
                  <th colspan="2" style="text-align: center;">Action</th>
                </tr>
                <?php $i = 1;?>
                @foreach($getAdmins as $getCoys)


                @if($getCoys->role == "Owner" && $getCoys->status == 0)
                <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $getCoys->company }}</td>
                  <td>{{ $getCoys->plan }}</td>
                  <td><span class="label label-success" style="cursor: pointer;"  onclick="accessAction('{{ $getCoys->id }}','Payment')">Check Details </span></td>
                  <td><span class="label label-primary" style="cursor: pointer;" onclick="accessAction('{{ $getCoys->id }}','Approve')">Approve <img class="spinner{{ $getCoys->id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span> <span class="label label-danger" style="cursor: pointer;" onclick="accessAction('{{ $getCoys->id }}','Decline')"> Decline <img class="spinners{{ $getCoys->id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span></td>
                </tr>

                @endif

                @endforeach

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>
          <!-- /.nav-tabs-custom -->


          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
              <div class="box">
              <div class="box-header">
                <h3 class="box-title">Commercial Users Awaiting Approval</h3>

                <div class="box-tools">
                  <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>User Type</th>
                    <th>Details</th>
                    <th colspan="2" style="text-align: center;">Action</th>
                  </tr>
                  <?php $i = 1;?>
                  @foreach($getUsers as $getUser)

                  @if($getUser->userType == "Commercial" && $getUser->status == 2)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $getUser->name }}</td>
                    <td>{{ $getUser->userType }}</td>
                    <td><span class="label label-success" style="cursor: pointer;"  onclick="accessAction('{{ $getUser->id }}','details')">View details </span></td>
                    <td><span class="label label-primary" style="cursor: pointer;" onclick="accessAction('{{ $getUser->id }}','Approval')">Approve <img class="spinnerappr{{ $getUser->id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span> <span class="label label-danger" style="cursor: pointer;" onclick="accessAction('{{ $getUser->id }}','Decliner')"> Decline <img class="spinnerdecl{{ $getUser->id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span></td>
                  </tr>

                  @endif

                  @endforeach

                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            </div>
            <!-- /.nav-tabs-custom -->

          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Active Clients</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>#</th>
                  <th>Coy. Name</th>
                  <th>Sub. Plan</th>
                  <th>Paymnt Status</th>
                  <th>Action</th>
                </tr>
                <?php $i = 1;?>
                @foreach($getAdmins as $getCoys)

                @if($getCoys->role == "Owner" && $getCoys->status == 1)
                <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $getCoys->company }}</td>
                  <td>{{ $getCoys->plan }}</td>
                  <td><span class="label label-success" style="cursor: pointer;" onclick="accessAction('{{ $getCoys->id }}','Payment')">Check Payment Status </span></td>
                  <td>
                    <span class="label label-info" style="cursor: pointer;" onclick="getautocaredetails('{{ $getCoys->email }}', 'autoStores')">Details</span>

                    <span class="label label-danger" style="cursor: pointer;" onclick="accessAction('{{ $getCoys->id }}','Decline')"> Decline <img class="spinners{{ $getCoys->id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span></td>
                </tr>

                @endif

                @endforeach

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>
          <!-- /.nav-tabs-custom -->

                    <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Declined Clients</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>#</th>
                  <th>Coy. Name</th>
                  <th>Sub. Plan</th>
                  <th>Paymnt Status</th>
                  <th>Action</th>
                </tr>
                <?php $i = 1;?>
                @foreach($getAdmins as $getCoys)

                @if($getCoys->role == "Owner" && $getCoys->status == 2)
                <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $getCoys->company }}</td>
                  <td>{{ $getCoys->plan }}</td>
                  <td><span class="label label-danger" style="cursor: pointer;" onclick="accessAction('{{ $getCoys->id }}','Payment')">Check Payment Status </span></td>
                  <td><span class="label label-primary" style="cursor: pointer;" onclick="accessAction('{{ $getCoys->id }}','Approve')">Approve <img class="spinner{{ $getCoys->id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span></td>
                </tr>

                @endif

                @endforeach

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>
          <!-- /.nav-tabs-custom -->

                              <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Declined Commercial Clients</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>User Type</th>
                    <th>Details</th>
                    <th colspan="2" style="text-align: center;">Action</th>
                </tr>
                <?php $i = 1;?>
                @foreach($getUsers as $getUser)

                  @if($getUser->userType == "Commercial" && $getUser->status == 0)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $getUser->name }}</td>
                    <td>{{ $getUser->userType }}</td>
                    <td><span class="label label-success" style="cursor: pointer;"  onclick="accessAction('{{ $getUser->id }}','details')">View details </span></td>
                    <td><span class="label label-primary" style="cursor: pointer;" onclick="accessAction('{{ $getUser->id }}','Approval')">Approve <img class="spinnerappr{{ $getUser->id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span></td>
                </tr>

                @endif

                @endforeach

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>
          <!-- /.nav-tabs-custom -->


          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Users Point Redeem</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>User Type</th>
                    <th>Point</th>
                    <th colspan="2" style="text-align: center;">Action</th>
                </tr>
                <?php $i = 1;?>
                @if($refree != "")

                @foreach($refree as $refrees)
                  @if($refrees->status == 0)

                    <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $refrees->name }}</td>
                    <td>{{ $refrees->userType }}</td>
                    <td>{{ $refrees->points }}</td>
                    <td align="center"><span class="label label-primary" style="cursor: pointer;" onclick="acceptPoint('{{ $refrees->ref_code }}','Approval')">Approve<img class="spinnerredeemappr{{ $refrees->ref_code }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span>  <span class="label label-danger" style="cursor: pointer;" onclick="ticketAction('{{ $refrees->ref_code }}','ReplyPoint')">Contact <img class="spinnerredeemapprcont{{ $refrees->ref_code }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span></td>
                </tr>

                  @endif


                @endforeach

                @else

                <tr>
                  <td align="center" colspan="5">No client to claim points</td>
                </tr>

                @endif



              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>
          <!-- /.nav-tabs-custom -->


        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-6 connectedSortable">


          <div class="box box-info disp-0">
            <div class="box-header">
              <i class="fa fa-user"></i>

              {{-- For Upgrade, Status change to 3 --}}

              <h3 class="box-title">Estimate Interest Payment List</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>

            <div class="box-body">
              {{-- Upgrading Client List --}}

          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
              <div class="box">
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Amount</th>
                    <th colspan="2" style="text-align: left;">Action</th>
                  </tr>

                  @if(count($estimatePayment) > 0)
                    <?php $i = 1;?>
                    @foreach($estimatePayment as $estimatePayments)

                    <tr>
                      <td>{{ $i++ }}</td>
                      <td><?php $string = $estimatePayments->name; $output = strlen($string) > 10 ? substr($string,0,10)."..." : $string; echo $output;?></td>
                      <td><?php $string = $estimatePayments->email; $output = strlen($string) > 20 ? substr($string,0,20)."..." : $string; echo $output;?></td>
                      <td>{{ $estimatePayments->currency.' '.number_format($estimatePayments->amount) }}</td>
                      <td><span class="label label-success" style="cursor: pointer;"  onclick="estimatepaydetails('{{ $estimatePayments->estimate_id }}','paydetails')">View details </span></td>
                    </tr>

                    @endforeach
                  @else
                    <tr><td colspan="5" align="center">No Estimate Payment yet</td></tr>
                  @endif

                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            </div>
            <!-- /.nav-tabs-custom -->

              {{-- End Upgrading Client List --}}

          </div>
          </div>

          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-user"></i>

              {{-- For Upgrade, Status change to 3 --}}

              <h3 class="box-title">Ongoing Jobs for Client List</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>

            <div class="box-body">
              {{-- Upgrading Client List --}}

          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
              <div class="box">
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tr>
                    <th>#</th>
                    <th>Technician/Station</th>
                    <th>Client Email</th>
                    <th>Client Phone</th>
                    <th colspan="2" style="text-align: left;">Action</th>
                  </tr>

                  @if(count($workinprogress) > 0)
                    <?php $i = 1;?>
                    @foreach($workinprogress as $ongoingJob)

                    @if($ongoingJob->maintenance == 1)


                    <tr>
                      <td>{{ $i++ }}</td>
                      <td><?php $string = $ongoingJob->update_by; $output = strlen($string) > 10 ? substr($string,0,10)."..." : $string; echo $output;?></td>
                      <td><?php $string = $ongoingJob->email; $output = strlen($string) > 10 ? substr($string,0,10)."..." : $string; echo $output;?></td>
                      <td><?php $string = $ongoingJob->telephone; $output = strlen($string) > 20 ? substr($string,0,20)."..." : $string; echo $output;?></td>
                      <td><span class="label label-success" style="cursor: pointer;"  onclick="mailClient('{{ $ongoingJob->email }}', 'ongoingjob', '{{ $ongoingJob->post_id }}')">Mail Client <img class="spinnerjob{{ $ongoingJob->post_id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span></td>
                    </tr>
                    @endif



                    @endforeach

                    @if(count($workinprogress) > 5)
                    <tr><td colspan="5"><button class="btn btn-primary btn-block" onclick="location.href = '{{ route('Workinprogress') }}'">View all</button></td></tr>
                    @endif
                  @else
                    <tr><td colspan="5" align="center">No Ongoing Jobs yet</td></tr>
                  @endif

                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            </div>
            <!-- /.nav-tabs-custom -->

              {{-- End Upgrading Client List --}}

          </div>
          </div>

                    <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-user"></i>

              {{-- For Upgrade, Status change to 3 --}}

              <h3 class="box-title">Jobs done for client <small style="color: red; font-weight: bold;">Kindly activate to notify vehicle owner</small></h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>

            <div class="box-body">
              {{-- Upgrading Client List --}}

          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
              <div class="box">
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tr>
                    <th>#</th>
                    <th>Technician/Station</th>
                    <th>Client Email</th>
                    <th>Client Phone</th>
                    <th colspan="2" style="text-align: left;">Action</th>
                  </tr>

                  @if(count($workinprogress) > 0)
                    <?php $i = 1;?>
                    @foreach($workinprogress as $ongoingJob)

                    @if($ongoingJob->maintenance == 2)

                    <tr>
                      <td>{{ $i++ }}</td>
                      <td><?php $string = $ongoingJob->update_by; $output = strlen($string) > 10 ? substr($string,0,10)."..." : $string; echo $output;?></td>
                      <td><?php $string = $ongoingJob->email; $output = strlen($string) > 10 ? substr($string,0,10)."..." : $string; echo $output;?></td>
                      <td><?php $string = $ongoingJob->telephone; $output = strlen($string) > 20 ? substr($string,0,20)."..." : $string; echo $output;?></td>
                      <td><span class="label label-success" style="cursor: pointer;"  onclick="activatejobdone('{{ $ongoingJob->opportunity_id }}', '{{ $ongoingJob->id }}',)">Activate job done <img class="spinneractivatejob{{ $ongoingJob->id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span></td>
                    </tr>

                    @endif


                    @endforeach

                    @if(count($workinprogress) > 5)
                    <tr><td colspan="5"><button class="btn btn-primary btn-block" onclick="location.href = '{{ route('Jobdone') }}'">View all</button></td></tr>
                    @endif
                  @else
                    <tr><td colspan="5" align="center">No Ongoing Jobs yet</td></tr>
                  @endif

                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            </div>
            <!-- /.nav-tabs-custom -->

              {{-- End Upgrading Client List --}}

          </div>
          </div>

                                        <!-- Individual Account -->
          <div class="box box-info disp-0">
            <div class="box-header">
              <i class="fa fa-user"></i>

              {{-- For Upgrade, Status change to 3 --}}

              <h3 class="box-title">Commercial Clients Activated</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>

            <div class="box-body">
              {{-- Upgrading Client List --}}

                                            <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
              <div class="box">
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>User Type</th>
                    <th>Details</th>
                    <th colspan="2" style="text-align: left;">Action</th>
                  </tr>
                  <?php $i = 1;?>
                  @foreach($getUsers as $getUser)

                  @if($getUser->userType == "Commercial" && $getUser->status == 1)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $getUser->name }}</td>
                    <td>{{ $getUser->userType }}</td>
                    <td><span class="label label-success" style="cursor: pointer;"  onclick="accessAction('{{ $getUser->id }}','details')">View details </span></td>
                    <td><span class="label label-danger" style="cursor: pointer;" onclick="accessAction('{{ $getUser->id }}','Decliner')"> Decline <img class="spinnerdecl{{ $getUser->id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span></td>
                  </tr>

                  @endif

                  @endforeach

                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            </div>
            <!-- /.nav-tabs-custom -->

              {{-- End Upgrading Client List --}}

          </div>
          </div>


          {{-- Start Mobile Mechanics --}}

                                                  <!-- Individual Account -->
          <div class="box box-info disp-0">
            <div class="box-header">
              <i class="fa fa-user"></i>

              {{-- For Upgrade, Status change to 3 --}}

              <h3 class="box-title">Mobile Mechanics</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>

            <div class="box-body">
              {{-- Upgrading Client List --}}

                                            <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
              <div class="box">
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <img class="spinnermm disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px; float: right;">
                <table class="table table-hover">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>User Type</th>
                    <th>Details</th>
                    <th colspan="2" style="text-align: left;">Action</th>
                  </tr>
                  @if(count($getUsers) > 0)

                    <?php $i = 1;?>
                  @foreach($getUsers as $getUser)

                  @if($getUser->userType == "Certified Professional")
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $getUser->name }}</td>
                    <td>Mobile Mechanics</td>
                    <td><span class="label label-success" style="cursor: pointer;"  onclick="checkInfo('{{ $getUser->id }}','details', 'mechanic')">View details </span></td>
                    <td>
                      @if($getUser->status == 1)

                        <i type="button" style="padding: 5px; color: green; cursor: not-allowed !important;" title="Activate" class="fa fa-lock"></i>
                      <i type="button" style="padding: 5px; color: brown; cursor: pointer !important;" title="Deactivate" class="fa fa-power-off" onclick="accountAction('{{ $getUser->id }}', 'deactivate', 'mechanic')"></i>

                      @else

                      <i type="button" style="padding: 5px; color: green; cursor: pointer !important;" title="Activate" class="fa fa-lock" onclick="accountAction('{{ $getUser->id }}', 'activate', 'mechanic')"></i>
                      <i type="button" style="padding: 5px; color: brown; cursor: not-allowed !important;" title="Deactivate" class="fa fa-power-off"></i>

                      @endif

                      <i type="button" style="padding: 5px; color: red; cursor: pointer !important;" title="Delete" class="fa fa-trash" onclick="accountAction('{{ $getUser->id }}', 'delete', 'mechanic')"></i>
                    </td>
                  </tr>

                  @endif

                  @endforeach

                  @else

                  <tr><td colspan="6" align="center">No Mobile Mechanic Yet</td></tr>

                  @endif

                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            </div>
            <!-- /.nav-tabs-custom -->

              {{-- End Upgrading Client List --}}

          </div>
          </div>

          {{-- End Mobile Mechanics --}}


          {{-- Start Auto Dealers --}}

                                                  <!-- Individual Account -->
          <div class="box box-info disp-0">
            <div class="box-header">
              <i class="fa fa-user"></i>

              {{-- For Upgrade, Status change to 3 --}}

              <h3 class="box-title">Auto Dealers</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>

            <div class="box-body">
              {{-- Upgrading Client List --}}

                                            <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
              <div class="box">
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <img class="spinnerad disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px; float: right;">
                <table class="table table-hover">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>User Type</th>
                    <th>Details</th>
                    <th colspan="2" style="text-align: left;">Action</th>
                  </tr>

                  @if($getAD != "")

                    <?php $i = 1;?>
                  @foreach($getAD as $getUser)

                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $getUser->name }}</td>
                    <td>{{ $getUser->accountType }}</td>
                    <td><span class="label label-success" style="cursor: pointer;"  onclick="checkInfo('{{ $getUser->id }}','details', 'dealer')">View details </span></td>
                    <td>
                      @if($statusCheck = \App\Admin::where('busID', $getUser->busID)->get())
                      @if(count($statusCheck) > 0)
                        @if($statusCheck[0]->status == 1)

                        <i type="button" style="padding: 5px; color: green; cursor: not-allowed !important;" title="Activate" class="fa fa-lock"></i>
                        <i type="button" style="padding: 5px; color: brown; cursor: pointer !important;" title="Deactivate" class="fa fa-power-off" onclick="accountAction('{{ $getUser->id }}', 'deactivate', 'dealer')"></i>
                        @elseif($statusCheck[0]->status == 0)

                        <i type="button" style="padding: 5px; color: green; cursor: pointer !important;" title="Activate" class="fa fa-lock" onclick="accountAction('{{ $getUser->id }}', 'activate', 'dealer')"></i>
                        <i type="button" style="padding: 5px; color: brown; cursor: not-allowed !important;" title="Deactivate" class="fa fa-power-off"></i>
                        @endif
                      @endif

                      @endif

                      <i type="button" style="padding: 5px; color: red; cursor: pointer !important;" title="Delete" class="fa fa-trash" onclick="accountAction('{{ $getUser->id }}', 'delete', 'dealer')"></i>
                    </td>
                  </tr>


                  @endforeach

                  @else
                    <tr><td colspan="6" align="center">No Auto Dealer Yet</td></tr>
                  @endif

                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            </div>
            <!-- /.nav-tabs-custom -->

              {{-- End Upgrading Client List --}}

          </div>
          </div>


          {{-- End Auto Dealers --}}


          {{-- Start Ticketing --}}

                                                            <!-- Individual Account -->
          <div class="box box-info disp-0">
            <div class="box-header">
              <i class="fa fa-user"></i>

              {{-- For Upgrade, Status change to 3 --}}

              <h3 class="box-title">Support Ticketing</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>

            <div class="box-body">
              {{-- Upgrading Client List --}}

                                            <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
              <div class="box">
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tr>
                    <th>#</th>
                    <th>Ticket ID</th>
                    <th>User Type</th>
                    <th>Details</th>
                    <th colspan="2" style="text-align: left;">Action</th>
                  </tr>

                  @if($ticketing != "")
                    <?php $i = 1;?>
                    @foreach($ticketing as $tickets)

                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $tickets->ticketID }}</td>
                      <td>{{ $tickets->ticketUsertype }}</td>
                      <td><span class="label label-success" style="cursor: pointer;"  onclick="ticketInfo('{{ $tickets->ticketID }}')">View details </span></td>
                      <td>
                        <i type="button" style="padding: 5px; color: green;" title="Reply" class="fa fa-reply" onclick="ticketAction('{{ $tickets->ticketID }}', 'reply')"></i>
                        <i type="button" style="padding: 5px; color: red;" title="Delete" class="fa fa-trash" onclick="ticketAction('{{ $tickets->ticketID }}', 'delete')"></i>
                      </td>
                    </tr>


                    @endforeach

                  @else

                    <tr><td colspan="5" align="center">No support ticket at the moment</td></tr>

                  @endif



                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            </div>
            <!-- /.nav-tabs-custom -->

              {{-- End Upgrading Client List --}}

          </div>
          </div>

          {{-- End Ticketing --}}



                              <!-- Individual Account -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-user"></i>

              {{-- For Upgrade, Status change to 3 --}}

              <h3 class="box-title">Paid Clients</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>

            <div class="box-body">
              {{-- Upgrading Client List --}}

                                            <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
              <div class="box">
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tr>
                    <th>#</th>
                    <th>Coy. Name</th>
                    <th>Sub. Plan</th>
                    <th>Paymnt Status</th>
                    <th>Action</th>
                  </tr>
                  <?php $i = 1;?>
                  @foreach($getAdmins as $getCoys)

                  @if($getCoys->role == "Owner" && $getCoys->status == 5)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $getCoys->company }}</td>
                    <td>{{ $getCoys->plan }}</td>
                    <td><span class="label label-danger" style="cursor: pointer;" onclick="accessAction('{{ $getCoys->id }}','Payment')">Check Payment Status </span></td>
                    <td><span class="label label-primary" style="cursor: pointer;" onclick="accessAction('{{ $getCoys->id }}','Approvepay')">Approve Payment <img class="spinnerz{{ $getCoys->id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span></td>
                  </tr>

                  @endif

                  @endforeach

                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            </div>
            <!-- /.nav-tabs-custom -->

              {{-- End Upgrading Client List --}}

          </div>
          </div>


                    <!-- Individual Account -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-user"></i>

              {{-- For Upgrade, Status change to 3 --}}

              <h3 class="box-title">Upgrade Clients</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              {{-- Upgrading Client List --}}

                                            <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
              <div class="box">
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tr>
                    <th>#</th>
                    <th>Coy. Name</th>
                    <th>Sub. Plan</th>
                    <th>Paymnt Status</th>
                    <th>Action</th>
                  </tr>
                  <?php $i = 1;?>
                  @foreach($getAdmins as $getCoys)

                  @if($getCoys->role == "Owner" && $getCoys->status == 3)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $getCoys->company }}</td>
                    <td>{{ $getCoys->plan }}</td>
                    <td><span class="label label-danger" style="cursor: pointer;" onclick="accessAction('{{ $getCoys->id }}','Payment')">Check Payment Status </span></td>
                    <td><span class="label label-primary" style="cursor: pointer;" onclick="accessAction('{{ $getCoys->id }}','Approve')">Approve <img class="spinner{{ $getCoys->id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span></td>
                  </tr>

                  @endif

                  @endforeach

                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            </div>
            <!-- /.nav-tabs-custom -->

              {{-- End Upgrading Client List --}}

          </div>
          </div>

          {{-- For Downgrade, Status change to 4 --}}
                                                  <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Downgrade Clients</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                                            <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
              <div class="box">
              <div class="box-body">
                <table class="table table-hover">
                  <tr>
                    <th>#</th>
                    <th>Coy. Name</th>
                    <th>Sub. Plan</th>
                    <th>Paymnt Status</th>
                    <th colspan="4" style="text-align: center">Reason</th>
                  </tr>
                  <?php $i = 1;?>
                  @foreach($getAdmins as $getCoys)

                  @if($getCoys->role == "Owner" && $getCoys->status == 4)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $getCoys->company }}</td>
                    <td>{{ $getCoys->plan }}</td>
                    <td ><span class="label label-danger" style="cursor: pointer;" onclick="accessAction('{{ $getCoys->id }}','Payment')">Check Payment Status </span></td>
                    <td colspan="4">{{ strip_tags($getCoys->reason) }}</td>
                  </tr>

                  @endif

                  @endforeach

                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            </div>
            <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>
          <!-- /.nav-tabs-custom -->

          <!-- Map box -->
          <div class="box box-solid bg-light-blue-gradient disp-0">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip"
                        title="Date range">
                  <i class="fa fa-calendar"></i></button>
                <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse"
                        data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->

              <i class="fa fa-map-marker"></i>

              <h3 class="box-title">
                Visitors
              </h3>
            </div>
            <div class="box-body">

            </div>
          </div>
          <!-- /.box -->

          <!-- solid sales graph -->
          <div class="box box-solid bg-teal-gradient disp-0">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Sales Graph</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- Calendar -->
          <div class="box box-solid bg-green-gradient disp-0">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Calendar</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                  <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="#">Add new event</a></li>
                    <li><a href="#">Clear events</a></li>
                    <li class="divider"></li>
                    <li><a href="#">View calendar</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->

    {{-- End super Admin view --}}


    {{-- Start Admin Agent View --}}

    @elseif(session('role') == "Agent" && session('status') == 1)

        @if($agreement = \App\Admin::where('email', session('email'))->get())

          @if (count($agreement) > 0 && $agreement[0]->signed_agreement == 1)

          <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">


              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                  <div class="inner">
                    <h3>&nbsp;</h3>
      
                    <p>Documents</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-folder"></i>
                  </div>
                  <a href="{{ route('agreementtemplate') }}" class="small-box-footer" target="_blank">View <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>

      
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                  <div class="inner">
                    <h3>&nbsp;</h3>
      
                    <p>Mechanic List</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="{{ route('crawlsnoMail') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
      
      
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                  <div class="inner">
                    <h3>&nbsp;</h3>
      
                    <p title="Generate Claim Business Letter">Generate Claim Business Lett..</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="{{ route('crawlprint') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
      
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                  <div class="inner">
                    <h3>&nbsp;</h3>
      
                    <p>Mechanic Profile</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="{{ route('crawlstoclaim') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
      
      
      
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3>&nbsp;</h3>
      
                    <p>Your Account Report</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" onclick='comingSoon()' class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
      
      
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>&nbsp;</h3>
      
                    <p>Commision</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" onclick='comingSoon()' class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>


              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>&nbsp;</h3>
      
                    <p>Signed Up Mechanics</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="{{ route('createdmechanics') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>

              
      
      
            </div>
          </section>
      
      
          @else

      
          <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">


              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                  <div class="inner">
                    <h3>&nbsp;</h3>
      
                    <p>Documents</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-folder"></i>
                  </div>
                  <a href="{{ route('agreementtemplate') }}" class="small-box-footer" target="_blank">View <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>

      
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                  <div class="inner">
                    <h3>&nbsp;</h3>
      
                    <p>Mechanic List</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="javascript:void(0)" onclick='signAppointment()' class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
      
      
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                  <div class="inner">
                    <h3>&nbsp;</h3>
      
                    <p title="Generate Claim Business Letter">Generate Claim Business Lett..</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="javascript:void(0)" onclick='signAppointment()' class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
      
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                  <div class="inner">
                    <h3>&nbsp;</h3>
      
                    <p>Mechanic Profile</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="javascript:void(0)" onclick='signAppointment()' class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
      
      
      
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3>&nbsp;</h3>
      
                    <p>Your Account Report</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="javascript:void(0)" onclick='signAppointment()' class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
      
      
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>&nbsp;</h3>
      
                    <p>Commision</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="javascript:void(0)" onclick='signAppointment()' class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>

              
      
      
            </div>
          </section>
          @endif

        @endif


        

    




    {{-- End Admin Agent View --}}


    @elseif(session('role') == "Owner" && session('status') == 0)

    {{-- Kindly Wait For Approval Section --}}

    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-12 mt-5">
          <center><h2 class="display-4">Thank you for choosing VIM File. Your page would be activated within 24hrs. <br><br>
        By: Management</h2></center>
        </div>

      </div>
    </section>


    {{-- End Kindly Wait For Approval Section --}}

    @elseif(session('role') == "Owner" && session('status') != 0)

     <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6" data-step="8" data-intro="View All Staffs">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ count($getBusinessStaffs) }}</h3>

              <p>Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('Allstaffs') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6" data-step="9" data-intro="View All Stations">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ count($getStations) }}</h3>

              <p>Stations</p>
            </div>
            <div class="icon">
              <i class="ion ion-location"></i>
            </div>
            <a href="{{ route('Allstations') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6" data-step="10" data-intro="View All Vehicles registered with you">
          <!-- small box -->

          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ count($CarReccount) }}</h3>

              <p>No of Vehicles</p>
            </div>
            <div class="icon">
              <i class="ion ion-model-s"></i>
            </div>
            <a href="{{ route('Allcarrecords') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6" data-step="11" data-intro="View All Maintenance Record">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $maintReccount }}</h3>

              <p>Maintenance Records</p>
            </div>
            <div class="icon">
              <i class="ion ion-paintbucket"></i>
            </div>
            <a href="{{ route('Allmaintenancerecord') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>{{ count($reviews) }}</h3>

              <p>Station Reviews</p>
            </div>
            <div class="icon">
              <i class="ion ion-ribbon-b"></i>
            </div>
            <a href="{{ route('stationreviews') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>Pricing</p>
            </div>
            <div class="icon">
              <i class="ion ion-card"></i>
            </div>
            <a href="{{ route('Pricings') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>Update Profile</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('Profile') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ count($newmail) }}</h3>

              <p>Mailbox</p>
            </div>
            <div class="icon">
              <i class="ion ion-at"></i>
            </div>
            <a href="{{ route('Compose Mail') }}" class="small-box-footer">Compose Mail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>{{ count($askexpert) }}</h3>

              <p>Expert Forum</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('Expert Forum') }}" class="small-box-footer">Proceed <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->




                                <!-- Individual Account -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-user"></i>

              <h3 class="box-title">List of Stations</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              {{-- Personal Users List --}}

              <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
              @if (count($getStations) > 0)
                <thead>
                <tr>
                  <th>#</th>
                  <th>Station Name</th>
                  <th>Address</th>
                  <th>Telephone</th>
                  <th>Area/City</th>
                  <th>State/Province</th>
                  <th>Country</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1;?>
                  @foreach ($getStations as $stations)
                     <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $stations->station_name }}</td>
                      <td>{{ $stations->station_address }}</td>
                      <td>{{ $stations->station_phone }}</td>
                      <td>{{ $stations->city }}</td>
                      <td>{{ $stations->state }}</td>
                      <td>{{ $stations->country }}</td>
                      {{-- <td><button onclick="crud('{{ $stations->id }}','editstation')"><span class="label label-primary pull-left">Edit</span></button><button onclick="crud('{{ $stations->id }}','delstation')"><span class="label label-danger pull-right">Del</span></button></td> --}}

                      <td><button onclick="crud('{{ $stations->id }}','editstation')" style="background: none;"><span class="label pull-left"><img src="https://img.icons8.com/color/48/000000/edit.png" style="width: 15px; height: 15px;"></span></button><button onclick="crud('{{ $stations->id }}','delstation')" style="background: none;"><span class="label pull-right"><img src="https://img.icons8.com/color/48/000000/delete-sign.png" style="width: 15px; height: 15px;"></span></button></td>

                    </tr>
                  @endforeach

                </tbody>

                @else

                <p class="text-center"><button onclick="create('station')" class="btn btn-default">Create Station</button></p>

              @endif


              </table>
            </div>
            <!-- /.box-body -->

              {{-- End Personal Users List --}}
            </div>
          </div>



          <!-- Creat Staffs -->

            <div class="nav-tabs-custom">
            <h4 class="bg-aqua" style="padding: 5px;">List of Staff(s)</h4>
            <table id="example5" class="table table-bordered table-hover">
              @if (count($getBusinessStaffs) > 0)
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Position</th>
                  <th>Station</th>
                  <th colspan="2">Action</th>

                </tr>
                </thead>
                <tbody>
                  <?php $i = 1;?>
                  @foreach ($getBusinessStaffs as $busStaffs)
                     <tr style="font-size: 12px;">
                      <td>{{ $i++ }}</td>
                      <td>{{ $busStaffs->firstname.' '.$busStaffs->lastname }} </td>
                      <td>{{ $busStaffs->email }}</td>
                      <td>{{ $busStaffs->position }}</td>
                      <td>{{ $busStaffs->station }}</td>
                      {{-- <td><button onclick="crud('{{ $busStaffs->id }}','editstaff')"><span class="label label-primary pull-left">Edit</span></button><button onclick="crud('{{ $busStaffs->id }}','delstaff')"><span class="label label-danger pull-right">Del</span></button></td> --}}

                      <td><button onclick="crud('{{ $busStaffs->id }}','editstaff')" style="background: none;"><span class="label pull-left"><img src="https://img.icons8.com/color/48/000000/edit.png" style="width: 15px; height: 15px;"></span></button><button onclick="crud('{{ $busStaffs->id }}','delstaff')" style="background: none;"><span class="label pull-right"><img src="https://img.icons8.com/color/48/000000/delete-sign.png" style="width: 15px; height: 15px;"></span></button></td>

                    </tr>
                  @endforeach

                </tbody>

                @else

                <p class="text-center"><button onclick="create('staff')" class="btn btn-default">Create User</button></p>
              @endif


              </table>




          </div>
          <!-- /.box -->

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
{{--         <section class="col-lg-4 connectedSortable">



        </section> --}}
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->

    @endif


  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer disp-0">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.13
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
    reserved.
  </footer>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<script>
  // Set the date we're counting down to
var countDownDate = new Date("{{ $free_trial }}").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = "30 days Free Trial: " + days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is over, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "<a href='/Pricings' class='btn btn-danger'>CURRENT PLAN ({{ session('plan') }}) - UPGRADE ACCOUNT</a> | <a href='#' class='btn btn-primary' onclick=extend('{{ session('busID') }}')>EXTEND FOR 15 Days <img class='spins disp-0' src='../img/loader/loader.gif' style='width: 50px; height: auto;'></a>";
  }
}, 1000);


function extend(busID){
  // Run Ajax for extension for 15 days
  var route = "{{ URL('Ajax/extendtrial') }}";
  var spinner = $('.spins');
  var thisdata = {busID: busID};
  setHeaders();
    jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
            spinner.removeClass('disp-0');
        },
        success: function(result){
            spinner.addClass('disp-0');
        if(result.message == 'success'){

          setTimeout(function(){ location.reload(); }, 1000);  

        }
        else{
            swal(result.title, result.res , result.message);
        }


    }

  });

}

</script>

@endsection
