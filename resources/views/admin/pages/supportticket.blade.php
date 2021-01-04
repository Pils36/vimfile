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
              <h3 class="box-title" style="text-transform: uppercase; font-weight: bolder;">SUPPORT TICKET</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">



        @if($ticketing != "")
          <h2>Support Tickets</h2> <hr>
              <table id="example7" class="table table-bordered table-striped">
                <thead>
                <tr style="font-size: 13px;">
                  <th>#</th>
                  <th>Ticket ID</th>
                  <th>UserType</th>
                  <th>Details</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1;?>
                  @foreach($ticketing as $tickets)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $tickets->ticketID }}</td>
                      <td>{{ $tickets->ticketUsertype }}</td>
                      <td><span class="label label-success" style="cursor: pointer;"  onclick="ticketInfo('{{ $tickets->ticketID }}')">View details </span></td>
                      <td>
                        <i type="button" style="padding: 5px; color: green;" title="Reply" class="fa fa-reply" onclick="ticketAction('{{ $tickets->ticketID }}', 'reply')"></i>
                        <i type="button" style="padding: 5px; color: red;" title="Delete" class="fa fa-trash" onclick="ticketAction('{{ $tickets->ticketID }}', 'delete')"></i>
                      </td>
                    </tr>

                  @endforeach

                </tbody>
              </table>

               @else
               <h4 class="text-center">No support ticket at the moment</h4>

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
