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
              <h3 class="box-title" style="text-transform: uppercase; font-weight: bolder;">All Clients</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">



        @if(count($getCarrecord) > 0)

              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr style="font-size: 13px;">
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Vehicle No</th>
                  <th></th>
                  
                </tr>
                </thead>
                <tbody>

                  <?php $i = 1;?>
                  @foreach($getCarrecord as $clients)
                    @if($clientName = \App\User::where('email', $clients->email)->get())
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>
                        @if(count($clientName) > 0)
                          {{ $clientName[0]->name }}
                          @else
                          -
                        @endif
                      </td>
                      <td>{{ $clients->email }}</td>
                      <td>{{ $clients->vehicle_reg_no }}</td>
                      <td>
                        <button type="button" class="btn btn-primary" style="width: 100%;" id="client_profile" onclick="viewProf('{{ $clients->id }}', '{{ $clients->email }}', '{{ session('busID') }}')">View Profile <img class="spinnersClient{{ $clients->id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></button>
                      </td>
                    </tr>
                    @endif
                  @endforeach

                  
                
                </tbody>
              </table>

               @else


               <h4 class="text-center">No client registered at any of the stations</h4>

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
