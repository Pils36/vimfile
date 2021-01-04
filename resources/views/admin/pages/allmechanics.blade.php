@extends('layouts.dashboard')

@section('title', 'Dashboard')

@show


@section('dashContent')
<div class="wrapper">

  @include('includes.dashhead')
  @include('includes.dashaside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('Admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
          <!-- Custom tabs (Charts with tabs)-->

            <div class="nav-tabs-custom">
            <h4 class="bg-aqua" style="padding: 5px;">List of all Mechanics</h4>

            <div class="table table-responsive">

                <table id="example1" class="table table-bordered table-hover">

                    <thead>
                    <tr>
                    <th>#</th>
                    <th>Company Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State/Province</th>
                    <th>Country</th>
                    <th>Zip code</th>
                    <th>Date</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                @if (count($allmechanic) > 0)
                    <tbody>
                    <?php $i = 1;?>
                    @foreach ($allmechanic as $mech_info)
                        <tr style="font-size: 12px;">
                        <td>{{ $i++ }}</td>
                        <td>@if(array_key_exists('station_name', $mech_info)) {{ $mech_info['station_name'] }} @else {{ $mech_info['name_of_company'] }} @endif</td>
                        <td>@if(array_key_exists('email', $mech_info)) {{ $mech_info['email'] }} @else - @endif </td>
                        <td>@if(array_key_exists('telephone', $mech_info)) {{ $mech_info['telephone'] }} @else {{ $mech_info['telephone'] }} @endif </td>
                        <td>@if(array_key_exists('address', $mech_info)) {{ $mech_info['address'] }} @else {{ $mech_info['address'] }} @endif </td>
                        <td>{{ $mech_info['city'] }}</td>
                        <td>{{ $mech_info['state'] }}</td>
                        <td>{{ $mech_info['country'] }}</td>
                        <td>{{ $mech_info['zipcode'] }}</td>
                        <td>{{ date('d/M/Y', strtotime($mech_info['created_at'])) }}</td>
                        <td>
                            <form action="{{ route('deletethismechanic') }}" method="post" id="delete_form">
                                @csrf
                                <input type="hidden" value="@if(array_key_exists('station_name', $mech_info)) {{ $mech_info['station_name'] }} @else {{ $mech_info['name_of_company'] }} @endif" name="station_name">
                                <i class="fa fa-trash" title="Delete" style="font-size: 20px; color: red; font-weight: bold; cursor: pointer;" onclick="deleteMechanics()"></i>

                            </form>

                            
                        </td>
                        </tr>
                    @endforeach

                    </tbody>

                    @else
                    <tr>
                        <td colspan="6" align="center">No record yet</td>
                    </tr>
                @endif


                </table>

            </div>




          </div>
          <!-- /.box -->

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
{{--         <section class="col-lg-4 connectedSortable">



        </section> --}}
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->



  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Vehicle Inspection & Maintenance</b>
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="mailto: info@vimfile.com" target="_blank">Vimfile</a>.</strong> All rights
    reserved.
  </footer>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@endsection
