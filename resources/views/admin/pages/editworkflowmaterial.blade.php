
@extends('layouts.dashboard')

@section('title', 'Dashboard')

@show
<?php use \App\Http\Controllers\User; ?>

@section('dashContent')

<div class="wrapper">

@include('includes.dashhead')
@include('includes.dashaside')

<style>
    .box-title{
        font-weight: 700;
    }
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Workflow
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('Admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Workflow</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Upload Workflows | <a href="{{ route('uploaded workflow') }}" style="text-decoration: underline">View uploaded materials</a></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

            <form action="{{ route('editworkflowupload', $allmaterials[0]->id) }}" method="post" enctype="multipart/form-data">
            @csrf
                <h5 class="box-title">Workflow Title</h5>
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" name="title" id="title" class="form-control" placeholder="Workflow Title" value="{{ $allmaterials[0]->title }}" required>
                    </div>
                </div>

                <h5 class="box-title">File Upload</h5>
                <div class="row">
                    <div class="col-md-12">
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                </div>


                <h5 class="box-title">Category</h5>
                <div class="row">
                    <div class="col-md-12">
                        <select name="category" id="category" class="form-control" required>
                            <option value="">Select category</option>
                            <option value="{{ $allmaterials[0]->category }}" selected>{{ $allmaterials[0]->category }}</option>
                            <option value="Portal Resource">Portal Resource</option>
                            <option value="Engaging Mechanics">Engaging Mechanics</option>
                            <option value="More Resource">More Resource</option>
                        </select>
                    </div>
                </div>

                <h5>&nbsp;</h5>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </div>
                </div>




            </form>

            
        </div>
        <!-- /.box-body -->
        
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



</div>
<!-- ./wrapper -->

@endsection

