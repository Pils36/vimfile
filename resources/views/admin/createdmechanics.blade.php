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
              <h3 class="box-title" style="text-transform: uppercase; font-weight: bolder;">Created Mechanics</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">



        @if(count($mechCreated) > 0)

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="font-size: 13px;">
                  <th>#</th>
                  <th>Company Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>County</th>
                  <th>Date Added</th>
                  {{-- <th></th> --}}
                  <th>Action</th>

                </tr>
                </thead>
                <tbody>

                  <?php $i = 1;?>
                  @foreach($mechCreated as $clients)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $clients->name_of_company }}</td>
                      <td>{{ $clients->email }}</td>
                      <td>{{ $clients->telephone }}</td>
                      <td>{{ $clients->country }}</td>
                      <td>{{ date('d/M/Y', strtotime($clients->created_at)) }}</td>
                      <td>
                        <span class="label label-info" style="cursor: pointer;" onclick="getautocaredetails('{{ $clients->email }}', 'autoStores')">Details</span>
                        <span class="label label-danger" style="cursor: pointer;" onclick="accessAction('{{ $clients->busID }}','autostoreDecline')">Decline <img class="spinner{{ $clients->busID }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span>
                      </td>


                      {{-- <td><span class="label label-success" style="cursor: pointer;"  onclick="accessAction('{{ $clients->id }}','Payment')">Check Details </span></td>

                  <td><span class="label label-primary" style="cursor: pointer;" onclick="accessAction('{{ $clients->id }}','Approve')">Approve <img class="spinner{{ $clients->id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span> <span class="label label-danger" style="cursor: pointer;" onclick="accessAction('{{ $clients->id }}','Decline')"> Decline <img class="spinners{{ $clients->id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></span></td> --}}


                    </tr>
                  @endforeach



                </tbody>
              </table>

               @else


               <h4 class="text-center">No record</h4>

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
