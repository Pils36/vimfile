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
              <h3 class="box-title" style="text-transform: uppercase; font-weight: bolder;">Station Revenue Reports</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($getStations) > 0)
              <div class="row">
                <div class="col-md-4">
                  <label>Select Station</label>
                  <input type="hidden" name="busID" id="revenueID" value="{{ session('busID') }}">
                  <select class="form-control" name="revenue_name" id="revenue_nameReport">
                    
                    <option value="">--Select Station--</option>
                    <option value="all">Select all</option>
                      @foreach($getStations as $getStation)

                      <option value="{{ $getStation->station_name }}">{{ $getStation->station_name }}</option>

                      @endforeach

                     
                  </select>
                </div>
                <div class="col-md-3">
                  <label>Date From</label>
                  <input type="date" name="date_from" id="revdate_from" class="form-control">
                </div>
                <div class="col-md-3">
                  <label>Date To</label>
                  <input type="date" name="date_to" id="revdate_to" class="form-control">
                </div>

                <div class="col-md-2">
                  <label>&nbsp;</label><br>
                  <button class="btn bg-green" id="revenue_repBtn" onclick="fetchReport('revenue');">Submit <img class="spinnerRev disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                </div>
              </div>

              <br><br>
              <div class="table-responsive">
              <table id="example2" class="table  table-bordered table-striped">
                <thead>
                <tr style="font-size: 11px;">
                  <th>#</th>
                  <th>Date</th>
                  <th>Licence</th>
                  <th>Serv. Type</th>
                  <th>Serv. Option</th>
                  <th>Manufacturer</th>
                  <th>Mtr. Qty</th>
                  <th>Mtr. Cost</th>
                  <th>Labr. Qty</th>
                  <th>Labr. Cost</th>
                  <th>Other. Cost</th>
                  <th>Tot. Revenue</th>
                  <th>Update by</th>
                </tr>
                </thead>

                <tbody class="phpRevenue">
                  @if(count($getVehicleinfo) > 0)

                    <?php $i = 1;?>
                    @foreach($getVehicleinfo as $vehicleReport)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ date('d-M-Y', strtotime($vehicleReport->created_at)) }}</td>
                        <td>{{ $vehicleReport->vehicle_licence }}</td>
                        <td>{{ $vehicleReport->service_type }}</td>
                        <td>{{ $vehicleReport->service_option }}</td>
                        <td>{{ $vehicleReport->manufacturer }}</td>
                        <td>{{ number_format($vehicleReport->material_qty + $vehicleReport->material_qty2 + $vehicleReport->material_qty3) }}</td>
                        <td>{{ number_format($vehicleReport->material_cost + $vehicleReport->material_cost2 + $vehicleReport->material_cost3) }}</td>
                        <td>{{ number_format($vehicleReport->labour_qty + $vehicleReport->labour_qty2) }}</td>
                        <td>{{ number_format($vehicleReport->labour_cost + $vehicleReport->labour_cost2) }}</td>
                        <td>{{ number_format($vehicleReport->other_cost) }}</td>
                        <td>{{ number_format($vehicleReport->total_cost) }}</td>
                        <td>{{ $vehicleReport->update_by }}</td>
                      </tr>

                    @endforeach
                  @else

                  @endif
                </tbody>

                <div class="table-responsive">
                <tbody id="revenueReports" class="ajaxRevenue disp-0">
                
                </tbody>
                </div>
              </table>
            </div>

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
