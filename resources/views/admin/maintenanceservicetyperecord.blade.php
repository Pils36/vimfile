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
            <div class="box-header bg-aqua">
              <h3 class="box-title" style="text-transform: uppercase; font-weight: bolder;">Maintenance Service Report</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">



        @if(count($getVehicleinfo) > 0)
              <div class="row">
                <div class="col-md-4">
                  <label>Service Types</label>
                  <input type="hidden" name="busID" id="businessIdd" value="{{ session('busID') }}">
                  <select class="form-control" name="service_type" id="serviceTypesname">
                    
                    <option value="">--Select Service Type--</option>
                    <option value="all">Select all</option>
                      @foreach($getVehicleinfo as $getVehicleinfos)

                      <option value="{{ $getVehicleinfos->service_type }}">{{ $getVehicleinfos->service_type }}</option>

                      @endforeach

                     
                  </select>
                </div>
                <div class="col-md-3">
                  <label>Date From</label>
                  <input type="date" name="date_from" id="dates_from" class="form-control">
                </div>
                <div class="col-md-3">
                  <label>Date To</label>
                  <input type="date" name="date_to" id="dates_to" class="form-control">
                </div>

                <div class="col-md-2">
                  <label>&nbsp;</label><br>
                  <button class="btn bg-green" id="station_repBtn" onclick="fetchReport('service_type');">Submit <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
              </div>

              <br><br>
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr style="font-size: 13px;">
                  <th>#</th>
                  <th>Licence</th>
                  <th>Make</th>
                  <th>Manufacturer</th>
                  <th>Mileage</th>
                  <th>Serv. Type</th>
                  <th>Mat. Qty.</th>
                  <th>Mat. Cost</th>
                  <th>Labour Qty.</th>
                  <th>Labour Cost</th>
                  <th>Other Qty.</th>
                  <th>Other Cost</th>
                  <th>Tot. Cost</th>
                  <th>File</th>
                </tr>
                </thead>
                <tbody id="report_servicetypes">
                
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
