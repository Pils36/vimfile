@extends('layouts.dashboard')

@section('title', 'Dashboard')
<?php use \App\Http\Controllers\User; ?>
@show


@section('dashContent')

<div class="wrapper">

  @include('includes.dashhead')
  @include('includes.dashaside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <div class="box">
            <div class="box-header bg-blue">
              <h3 class="box-title" style="text-transform: uppercase; font-weight: bolder;">Mobile Mechanics</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">



        @if(count($mobileMechs) > 0)

              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr style="font-size: 13px;">
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>City</th>
                  <th>State</th>
                  <th>County</th>
                  <th>Zip Code</th>
                  <th>Date Added</th>
                  <th></th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>

                  <?php $i = 1;?>
                  @foreach($mobileMechs as $clients)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $clients->name }}</td>
                      <td>{{ $clients->email }}</td>
                      <td>{{ $clients->city }}</td>
                      <td>{{ $clients->state }}</td>
                      <td>{{ $clients->country }}</td>
                      <td>{{ $clients->zipcode }}</td>
                      <td>{{ date('d/M/Y', strtotime($clients->created_at)) }}</td>

                      <td><span class="label label-success" style="cursor: pointer;"  onclick="checkInfo('{{ $clients->id }}','details', 'mechanic')">View details </span></td>
                    <td>
                      @if($clients->status == 1)

                        <i type="button" style="padding: 5px; color: green; cursor: not-allowed !important;" title="Activate" class="fa fa-lock"></i>
                      <i type="button" style="padding: 5px; color: brown; cursor: pointer !important;" title="Deactivate" class="fa fa-power-off" onclick="accountAction('{{ $clients->id }}', 'deactivate', 'mechanic')"></i>

                      @else

                      <i type="button" style="padding: 5px; color: green; cursor: pointer !important;" title="Activate" class="fa fa-lock" onclick="accountAction('{{ $clients->id }}', 'activate', 'mechanic')"></i>
                      <i type="button" style="padding: 5px; color: brown; cursor: not-allowed !important;" title="Deactivate" class="fa fa-power-off"></i>

                      @endif
                      
                      <i type="button" style="padding: 5px; color: red; cursor: pointer !important;" title="Delete" class="fa fa-trash" onclick="accountAction('{{ $clients->id }}', 'delete', 'mechanic')"></i>
                    </td>

                      
                    </tr>
                  @endforeach

                  
                
                </tbody>
              </table>

               @else


               <h4 class="text-center">No user here yet</h4>

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
