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
              <h3 class="box-title" style="text-transform: uppercase; font-weight: bolder;">MM & ACC Estimates</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">



        @if(count($preparedEstimate) > 0)
          <h2>All Posts</h2> <hr>
              <table id="example7" class="table table-bordered table-striped">
                <thead>
                <tr style="font-size: 13px;">
                  <th>#</th>
                  <th>Recognition Name</th>
                  <th>Amount Charged</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1;?>
                  @foreach($preparedEstimate as $posts)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $posts->update_by }}</td>
                      <td>{{ number_format($posts->total_cost) }}</td>
                      <td><span class="label label-danger" style="cursor: pointer;" onclick="estimatedetails('{{ $posts->opportunity_id }}','{{ $posts->estimate_id }}','more')">View estimate details <img class="spinner{{ $posts->opportunity_id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span></td>
                    </tr>

                  @endforeach
                
                </tbody>
              </table>

               @else

               <h4 class="text-center">No available estimates yets</h4>

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
