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
        All Posted News and Happenings
        <small>full table list</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('Admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">View Posted News and Happenings</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Subject</th>
                  <th>Description</th>
                  <th>File Upload</th>
                  <th>State</th>
                  @if(session('role') == "Super")<th style="text-align: center">Action</th>@endif
                </tr>
                </thead>
                <tbody>
                @if(count($allPosts) > 0)
                    <?php $i = 1;?>
                    @foreach ($allPosts as $allPost)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $allPost->subject }}</td>
                            <td>{!! $allPost->description !!} </td>
                            @if($allPost->file_upload != "" || $allPost->file_upload != null) <td><a href="/newsfile/{{ $allPost->file_upload }}" target="_blank" style="font-weight:bold; color:navy; text-decoration:underline;">Open file</a></td> @else <td>No file attached</td> @endif

                            @if($allPost->state == 1) <td style="color:green; font-weight:bold">Activated</td> @else <td style="color:red; font-weight:bold">Not activated</td> @endif

                            @if(session('role') == "Super")
                                <td align="center"><i title="view" class="fa fa-eye" style="font-size: 16px; margin-left: 5px; color:navy; cursor:pointer;" onclick="allPostaction('{{ $allPost->id }}', 'view_news')"></i><i title="edit" class="fa fa-edit" style="font-size: 16px; margin-left: 5px; color:navy; cursor:pointer;" onclick="allPostaction('{{ $allPost->id }}', 'edit_news')"></i><i title="delete" class="fa fa-trash-o" style="font-size: 16px; margin-left: 5px; color:red; cursor:pointer;" onclick="allPostaction('{{ $allPost->id }}', 'delete_news')"></i></td>
                            @endif
                        </tr>
                    @endforeach

                @endif

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
