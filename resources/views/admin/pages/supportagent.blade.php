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
              <h3 class="box-title" style="text-transform: uppercase; font-weight: bolder;">All Support Agents</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">



        @if(count($supportagent) > 0)
          <h2>All Support Agents</h2> <hr>
              <table id="example7" class="table table-bordered table-striped">
                <thead>
                <tr style="font-size: 13px;">
                  <th>#</th>
                  <th>Name</th>
                  <th>Email Address</th>
                  <th>Username</th>
                  <th>Telephone</th>
                  <th>Country</th>
                  <th>State/Province</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1;?>
                  @foreach($supportagent as $data)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $data->name }}</td>
                      <td>{{ $data->email }}</td>
                      <td>{{ $data->username }}</td>
                      <td>{{ $data->telephone }}</td>
                      <td>@if($data->country != null) {{ $data->country }} @else NILL @endif</td>
                      <td>@if($data->province != null) @php $state = json_decode($data->province); @endphp {{ implode(", ", $state) }}  @else - @endif</td>
                      <td>
                          <form action="{{ route('delete_agent') }}" method="post" id="delete_agent">
                              @csrf
                              <input type="hidden" value="{{ $data->id }}" name="id">
                          </form>
                          <button class="btn btn-primary" onclick="action('edit_agent', '{{ $data->id }}')">Edit</button> | <button class="btn btn-danger" onclick="action('delete', '{{ $data->id }}')">Delete</button>
                      </td>
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
