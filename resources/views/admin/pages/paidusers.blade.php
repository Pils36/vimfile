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
              <h3 class="box-title" style="text-transform: uppercase; font-weight: bolder;">All Paid Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">



        @if(count($paidusers) > 0)
          <h2>All Paid Users</h2> <hr>
              <table id="example7" class="table table-bordered table-striped">
                <thead>
                <tr style="font-size: 13px;">
                  <th>#</th>
                  <th>Name</th>
                  <th>Company</th>
                  <th>Email</th>
                  <th>Account Type</th>
                  <th>Plan</th>
                  <th>Amount</th>
                  <th>Sub. Start</th>
                  <th>Sub. End</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1;?>
                  @foreach($paidusers as $data)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $data->name }}</td>
                      <td>{{ $data->station_name }}</td>
                      <td>{{ $data->email }}</td>
                      <td>{{ $data->userType }}</td>
                      <td>
                          @if ($data->lite != null)
                              {{ $data->currency.' '.number_format($data->lite) }}
                          
                              @elseif($data->litecommercial != null)

                              {{ $data->currency.' '.number_format($data->litecommercial) }}


                              @elseif($data->basic != null)

                              {{ $data->currency.' '.number_format($data->basic) }}


                              @elseif($data->classic != null)

                              {{ $data->currency.' '.number_format($data->classic) }}


                              @elseif($data->super != null)

                              {{ $data->currency.' '.number_format($data->super) }}


                              @elseif($data->gold != null)

                              {{ $data->currency.' '.number_format($data->gold) }}

                              
                              
                          @endif
                      </td>
                      <td>{!! $data->plan.' <b>('.$data->subscription_plan.')</b>' !!}</td>
                      <td>{{ date('d/F/Y', strtotime($data->date_from)) }}</td>
                      <td>{{ date('d/F/Y', strtotime($data->date_to)) }}</td>
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
