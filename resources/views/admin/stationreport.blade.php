@extends('layouts.dashboard')

@section('title', 'Dashboard')

@show


@section('dashContent')

<div class="wrapper">

  @include('includes.dashhead')
  @include('includes.dashaside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <div class="box">
            <div class="box-header bg-orange">
              <h3 class="box-title" style="text-transform: uppercase; font-weight: bolder;">Station Report</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
        @if(count($getStations) > 0)
              <div class="row">
                <div class="col-md-4">
                  <label>Select Station</label>
                  <input type="hidden" name="busID" id="stationID" value="{{ session('busID') }}">
                  <select class="form-control" name="station_name" id="station_nameReport">
                    
                    <option value="">--Select Station--</option>
                    <option value="all">Select all</option>
                      @foreach($getStations as $getStation)

                      <option value="{{ $getStation->station_name }}">{{ $getStation->station_name }}</option>

                      @endforeach

                     
                  </select>
                </div>
                <div class="col-md-3">
                  <label>Date From</label>
                  <input type="date" name="date_from" id="date_from" class="form-control">
                </div>
                <div class="col-md-3">
                  <label>Date To</label>
                  <input type="date" name="date_to" id="date_to" class="form-control">
                </div>

                <div class="col-md-2">
                  <label>&nbsp;</label><br>
                  <button class="btn bg-green" id="station_repBtn" onclick="fetchReport('station');">Submit <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
              </div>

              <br><br>
              <table id="example2" class="table table-responsive table-bordered table-striped">
                <thead>
                <tr style="font-size: 11px;">
                  <th>Date</th>
                  <th>Licence</th>
                  <th>Make</th>
                  <th>Model</th>
                  <th>Mileage</th>
                  <th>Serv. Type</th>
                  <th>Serv. Option</th>
                  <th>Tot. Revenue</th>
                  <th>File</th>
                </tr>
                </thead>
                <tbody id="stationReports">
                
                </tbody>
              </table>

               @else


               <h4 class="text-center">You have not created a station yet</h4>

        @endif
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

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
