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
            <div class="box-header bg-blue">
              <h3 class="box-title" style="text-transform: uppercase; font-weight: bolder;">Crawled List of Auto Dealers</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">



        @if(count($suggestedDealers) > 0)
          <h2>Crawled List of Auto Dealers</h2> <hr>
              <table id="example7" class="table table-bordered table-striped">
                <thead>
                <tr style="font-size: 13px;">
                  <th>#</th>
                  <th>Station Name</th>
                  <th>Station Address</th>
                  <th>Telephone</th>
                  <th>City</th>
                  <th>Zipcode</th>
                  <th>State</th>
                  <th>Country</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1;?>
                  @foreach($suggestedDealers as $data)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $data->station_name }}</td>
                      <td>{{ $data->address }}</td>
                      <td>{{ $data->telephone }}</td>
                      <td>{{ $data->city }}</td>
                      <td>{{ $data->zipcode }}</td>
                      <td>{{ $data->state }}</td>
                      <td>{{ $data->country }}</td>
                      <td>{{ date('d/M/Y', strtotime($data->created_at)) }}</td>
                    </tr>

                  @endforeach

                </tbody>
              </table>

               @else

               <h4 class="text-center">No busy wrench to claim business</h4>

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
