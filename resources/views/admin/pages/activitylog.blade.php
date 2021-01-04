@extends('layouts.dashboard')

@section('title', 'Dashboard')

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
      <ol class="breadcrumb">
        <li><a href="{{ route('Admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->

            <div class="nav-tabs-custom">
            <h4 class="bg-aqua" style="padding: 5px;">Activity Log</h4>

            <table id="example1" class="table table-bordered table-hover">
              
                <thead>
                <tr>
                  <th>#</th>
                  <th>IP Address</th>
                  <th>City</th>
                  <th>Country</th>
                  <th>Action</th>
                  <th>Platform</th>
                  <th>Date</th>
                </tr>
                </thead>
            @if (count($activityLog) > 0)
                <tbody>
                  <?php $i = 1;?>
                  @foreach ($activityLog as $activity)
                     <tr style="font-size: 12px;">
                      <td>{{ $i++ }}</td>
                      <td>{{ $activity->ipaddress }} </td>
                      <td>{{ $activity->city }}</td>
                      <td>{{ $activity->country }}</td>
                      <td>{{ $activity->action }}</td>
                      <td>{{ $activity->platform }}</td>
                      <td>{{ date('d/M/Y H:i A', strtotime($activity->created_at)) }}</td>
                    </tr>
                  @endforeach
               
                </tbody>

                @else
                  <tr>
                    <td colspan="6" align="center">No activity generated</td>
                  </tr>
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


   
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Vehicle Inspection & Maintenance</b>
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="mailto: info@vimfile.com" target="_blank">Vimfile</a>.</strong> All rights
    reserved.
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@endsection
