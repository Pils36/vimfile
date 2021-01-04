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
              <h3 class="box-title" style="text-transform: uppercase; font-weight: bolder;">All Free Plan Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">



        @if(count($freeplanusers) > 0)
          <h2>All Free Plan Users</h2> <hr>
              <table id="example7" class="table table-bordered table-striped">
                <thead>
                <tr style="font-size: 13px;">
                  <th>#</th>
                  <th>Name</th>
                  <th>Company</th>
                  <th>Email</th>
                  <th>Number of logins</th>
                  <th>Joined VIMFile</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1;?>
                  @foreach($freeplanusers as $data)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $data->name }}</td>
                      <td>{{ $data->company }}</td>
                      <td>{{ $data->email }}</td>
                      <td>{{ $data->login_times }}</td>
                      <td>{{ $data->created_at->diffForHumans()." (".date('d/M/Y', strtotime($data->created_at)).")" }}</td>
                    </tr>

                  @endforeach

                </tbody>
              </table>

               @else

               <h4 class="text-center">No record yet</h4>

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
