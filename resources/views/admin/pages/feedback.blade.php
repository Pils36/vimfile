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
              <h3 class="box-title" style="text-transform: uppercase; font-weight: bolder;">CLIENT FEEDBACK ON VIMFILE</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">



        @if(count($feedbacks) > 0)
          <h2>All Posts</h2> <hr>
              <table id="example7" class="table table-bordered table-striped">
                <thead>
                <tr style="font-size: 13px;">
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1;?>
                  @foreach($feedbacks as $feedback)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $feedback->name }}</td>
                      <td>{{ $feedback->email }}</td>
                      <td>{{ $feedback->subject }}</td>
                      <td>{{ $feedback->description }}</td>
                      <td>{{ date('d-M-Y', strtotime($feedback->created_at)) }}</td>
                    </tr>

                  @endforeach
                
                </tbody>
              </table>

               @else

               <h4 class="text-center">No feedbacks yet</h4>

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
