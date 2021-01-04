@extends('layouts.dashboard')

@section('title', 'Dashboard')

@show


@section('dashContent')
<?php use \App\Http\Controllers\Business; ?>
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
      <ol class="breadcrumb">
        <li><a href="{{ route('Admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              @if(session('role') == 'Super')
              <h3>{{ count($getBusinessStaffs) + count($otherUsers) }}</h3>
              @else
              <h3>{{ count($getBusinessStaffs) }}</h3>
              @endif

              <p>@if(session('role') == 'Super') Users @else Staffs @endif</p>
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
            <a href="{{ route('Allcarrecords') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
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
        <!-- ./col -->

        @if(session('role') == 'Super')

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
        

      </div>
      <!-- /.row -->

        @endif



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

              <h3 class="box-title">All Stations</h3>
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

              @if(session('role') == 'Super')

              <table id="example2" class="table table-bordered table-hover">
              @if (count($getStations) > 0)
                <thead>
                <tr>
                  <th>#</th>
                  <th>Company</th>
                  <th>Station</th>
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
                      @if($coy = \App\Business::where('busID', $stations->busID)->get())
                      @if(count($coy) > 0)
                      <td>{{ $coy[0]->name_of_company }}</td>

                      @else
                      <td>-</td>
                      @endif
                      @endif
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


              @else

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

              @endif


            </div>
            <!-- /.box-body -->

              {{-- End Personal Users List --}}
            </div>
          </div>


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

@endsection
