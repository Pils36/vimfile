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
              <h3 class="box-title" style="text-transform: uppercase; font-weight: bolder;">Payment History</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">



        @if(count($paidTransactions) > 0)
          <h2>Payment History</h2> <hr>
              <table id="example7" class="table table-bordered table-striped">
                <thead>
                <tr style="font-size: 13px;">
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Amount</th>
                  <th>Payment For</th>
                  <th>Payment Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1;?>
                  @foreach($paidTransactions as $paid)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $paid->name }}</td>
                      <td>{{ $paid->email }}</td>
                      <td>{{ $paid->amount }}</td>
                      <td>Maintenance Estimate</td>
                      @if($paid->status == 1) <td style="color: green; font-weight: bold">Paid</td> @else <td style="color: red; font-weight: bold">Not Paid</td> @endif
                      <td><span class="label label-success" style="cursor: pointer;"  onclick="estimatepaydetails('{{ $paid->estimate_id }}','paydetails')">View full details </span></td>
                    </tr>

                  @endforeach
                
                </tbody>
              </table>

               @else

               <h4 class="text-center">No available posts</h4>

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
