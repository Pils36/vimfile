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
        Notification
        <small>New notification</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('Admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Notification</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">

            @isset($getNotification)
                <!-- timeline time label -->
            <li class="time-label">
                <span class="bg-red">
                    {{ date('d F. Y', strtotime($getNotification->created_at)) }}
                </span>
          </li>
          <!-- /.timeline-label -->
          <!-- timeline item -->
          <li>
            <i class="fa fa-envelope bg-blue"></i>

            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{ date('h:i', strtotime($getNotification->created_at)) }}</span>

              <h3 class="timeline-header"><a href="#">VIMFILE Team</a> sent you a message</h3>

              <div class="timeline-body">
                {!! $getNotification->activity !!}
              </div>
              {{--  <div class="timeline-footer">
                <a class="btn btn-danger btn-xs">Delete</a>
              </div>  --}}
            </div>
          </li>
          <!-- END timeline item -->
            @endisset

          
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


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

</div>
<!-- ./wrapper -->

@endsection
