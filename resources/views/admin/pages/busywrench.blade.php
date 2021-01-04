@extends('layouts.dashboard')

@section('title', 'Dashboard')
<?php use \App\Http\Controllers\User; ?>
<?php use \App\Http\Controllers\Admin; ?>
<?php use \App\Http\Controllers\Stations; ?>

@show


@section('dashContent')

<div class="wrapper">

  @include('includes.dashhead')
  @include('includes.dashaside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <div class="box">
            <div class="box-header bg-blue">
              <h3 class="box-title" style="text-transform: uppercase; font-weight: bolder;">Busy Wrench Grant Request</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">



        @if(count($getStations) > 0)
          <h2>Busy Wrench Grant Request</h2> <hr>
              <table id="example7" class="table table-bordered table-striped">
                <thead>
                <tr style="font-size: 13px;">
                  <th>#</th>
                  <th>Station Name</th>
                  <th>Station Address</th>
                  <th>City</th>
                  <th>Zipcode</th>
                  <th>State</th>
                  <th>Country</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  

                  {{-- Start --}}

                  @if($agreement = \App\Admin::where('email', session('email'))->where('role', 'Agent')->get())

                  @if (count($agreement) > 0)

                    @php
                        $province = json_decode($agreement[0]->province);
                    @endphp

                    @foreach ($province as $thisstate)

                        @if($result = \App\Stations::where('state', 'LIKE', '%'.$thisstate.'%')->where('country', $agreement[0]->country)->where('claim_business', 1)->orderBy('created_at', 'DESC')->get())

                        @if (count($result) > 0)

                        <?php $i = 1;?>

                          @foreach ($result as $item)
                          <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->station_name }}</td>
                            <td>{{ $item->station_address }}</td>
                            <td>{{ $item->city }}</td>
                            <td>{{ $item->zipcode }}</td>
                            <td>{{ $item->state }}</td>
                            <td>{{ $item->country }}</td>
                            <td>{{ date('d/M/Y', strtotime($item->created_at)) }}</td>
                            
                            <td>
                                @if($item->platform_request == 1)
      
                                  <span class="label label-success" style="cursor: pointer;"  onclick="showBw('{{ $item->busID }}','busywrenchactivate')">Activate </span>
                                  <span class="label label-danger" style="cursor: pointer;"  onclick="showBw('{{ $item->busID }}','busywrenchdecline')">Decline </span>
      
                                @else
                                  <span class="label label-danger" style="cursor: not-allowed;">Business Activated </span>
                                @endif
      
                                <span class="label label-info" style="cursor: pointer;" onclick="location.href='{{ route('Profileinfo', $item->busID) }}'">Update </span>
      
                            </td>
                          </tr>
                          @endforeach

                        

                        @endif

                      @endif
                    @endforeach
                  

                  @else

                  <?php $i = 1;?>
                  @foreach($getStations as $paid)

                <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $paid->station_name }}</td>
                  <td>{{ $paid->station_address }}</td>
                  <td>{{ $paid->city }}</td>
                  <td>{{ $paid->zipcode }}</td>
                  <td>{{ $paid->state }}</td>
                  <td>{{ $paid->country }}</td>
                  <td>{{ date('d/M/Y', strtotime($paid->created_at)) }}</td>
                  
                  <td>
                      @if($paid->platform_request == 1)

                        <span class="label label-success" style="cursor: pointer;"  onclick="showBw('{{ $paid->busID }}','busywrenchactivate')">Activate </span>
                        <span class="label label-danger" style="cursor: pointer;"  onclick="showBw('{{ $paid->busID }}','busywrenchdecline')">Decline </span>

                      @else
                        <span class="label label-danger" style="cursor: not-allowed;">Business Activated </span>
                      @endif

                      <span class="label label-info" style="cursor: pointer;" onclick="location.href='{{ route('Profileinfo', $paid->busID) }}'">Update </span>

                  </td>
                </tr>

                @endforeach

                  @endif


                @else

                <?php $i = 1;?>
                  @foreach($getStations as $paid)

                <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $paid->station_name }}</td>
                  <td>{{ $paid->station_address }}</td>
                  <td>{{ $paid->city }}</td>
                  <td>{{ $paid->zipcode }}</td>
                  <td>{{ $paid->state }}</td>
                  <td>{{ $paid->country }}</td>
                  <td>{{ date('d/M/Y', strtotime($paid->created_at)) }}</td>
                  
                  <td>
                      @if($paid->platform_request == 1)

                        <span class="label label-success" style="cursor: pointer;"  onclick="showBw('{{ $paid->busID }}','busywrenchactivate')">Activate </span>
                        <span class="label label-danger" style="cursor: pointer;"  onclick="showBw('{{ $paid->busID }}','busywrenchdecline')">Decline </span>

                      @else
                        <span class="label label-danger" style="cursor: not-allowed;">Business Activated </span>
                      @endif

                      <span class="label label-info" style="cursor: pointer;" onclick="location.href='{{ route('Profileinfo', $paid->busID) }}'">Update </span>

                  </td>
                </tr>

                @endforeach


                @endif



                  {{-- End --}}



                    


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
