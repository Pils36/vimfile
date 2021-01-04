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
            <h4 class="bg-aqua" style="padding: 5px;">Workflow (PDF)</h4>

            <div class="table table-responsive">

                <table id="example1" class="table table-bordered table-hover">

                    <thead>
                    <tr>
                    <th>#</th>
                    <th>Workflow Title</th>
                    <th>Category</th>
                    <th>File</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($data['material']) > 0)
                    
                        <?php $i = 1;?>
                        @foreach ($data['material'] as $uploads)

                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $uploads->title }}</td>
                            <td>{{ $uploads->category }}</td>
                            <td><a href="{{ $uploads->file }}" target="_blank">View file</a></td>
                        </tr>
                            
                        @endforeach


                        @else
                        <tr>
                            <td colspan="4" align="center">No record yet</td>
                        </tr>
                    @endif

                </tbody>

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



</div>
<!-- ./wrapper -->

@endsection
