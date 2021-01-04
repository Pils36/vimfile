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
            <div class="box-body" style="overflow-x: auto !important;">
    

              <table id="example1" class="table table-responsive table-bordered table-striped">
                <thead>
                <tr style="font-size: 11px;">
                  <th>Date</th>
                  <th>Licence</th>
                  <th>Make</th>
                  <th>Model</th>
                  <th>Mileage</th>
                  <th>Serv. Type</th>
                  <th>Serv. Option</th>
                  <th>Mat. Qty 1.</th>
                  <th>Mat. Cost 1</th>
                  <th>Serv. Itm. Spec.</th>
                  <th>Mat. Manuft.</th>
                  <th>Mat. Qty 2.</th>
                  <th>Mat. Cost 2</th>
                  <th>Serv. Itm. Spec.</th>
                  <th>Mat. Manuft.</th>
                  <th>Mat. Qty 3.</th>
                  <th>Mat. Cost 3</th>
                  <th>Serv. Itm. Spec.</th>
                  <th>Mat. Manuft.</th>
                  <th>Labour Qty 1.</th>
                  <th>Labour Cost 1</th>
                  <th>Labour Qty 2.</th>
                  <th>Labour Cost 2</th>
                  <th>Other Cost</th>
                  <th>Tot. Revenue</th>
                  <th>File</th>
                </tr>
                </thead>
                <tbody>

                  @if(count($data) > 0)
                  @foreach($data as $results)
                    <tr>
                      <td>{{ $results->date }}</td>
                      <td>{{ $results->vehicle_licence }}</td>
                      <td>{{ $results->make }}</td>
                      <td>{{ $results->model }}</td>
                      <td>{{ $results->mileage }}</td>
                      <td>{{ $results->service_type }}</td>
                      <td>{{ $results->service_option }}</td>
                      <td>{{ $results->material_qty }}</td>
                      <td>{{ $results->material_cost }}</td>
                      <td>{{ $results->service_item_spec }}</td>
                      <td>{{ $results->manufacturer }}</td>
                      <td>{{ $results->material_qty2 }}</td>
                      <td>{{ $results->material_cost2 }}</td>
                      <td>{{ $results->service_item_spec2 }}</td>
                      <td>{{ $results->manufacturer2 }}</td>
                      <td>{{ $results->material_qty3 }}</td>
                      <td>{{ $results->material_cost3 }}</td>
                      <td>{{ $results->service_item_spec3 }}</td>
                      <td>{{ $results->manufacturer3 }}</td>
                      <td>{{ $results->labour_qty }}</td>
                      <td>{{ $results->labour_cost }}</td>
                      <td>{{ $results->labour_qty2 }}</td>
                      <td>{{ $results->labour_cost2 }}</td>
                      <td>{{ $results->other_cost }}</td>
                      <td>{{ $results->total_cost }}</td>
                      <td>{{ $results->file }}</td>
                      
                    </tr>


                  @endforeach


                  @endif
                
                </tbody>
              </table>
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
