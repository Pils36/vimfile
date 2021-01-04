@extends('layouts.dashboard')

@section('title', 'Dashboard')

@show


@section('dashContent')
<div class="wrapper">

  @include('includes.dashhead')
  @include('includes.dashaside')
<?php use \App\Http\Controllers\User; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mailbox
        <small>{{ count($newmail) }} new messages</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('Admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailbox</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="{{ route('Inbox') }}" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{ route('Inbox') }}"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right">{{ count($newmail) }}</span></a></li>
                <li><a href="{{ route('Sent Mail') }}"><i class="fa fa-envelope-o"></i> Sent
                    <span class="label label-success pull-right">{{ count($sentmail) }}</span>
                </a></li>
                <li><a href="{{ route('Drafts') }}"><i class="fa fa-file-text-o"></i> Drafts
                    <span class="label label-info pull-right">{{ count($draftmail) }}</span>
                </a></li>
                <li><a href="{{ route('Trash') }}"><i class="fa fa-trash-o"></i> Trash
                    <span class="label label-danger pull-right">{{ count($trashmail) }}</span>
                </a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Compose New Message</h3>
            </div>
            <!-- /.box-header -->

            <form action="{{ route('composemessage') }}" method="post" enctype="multipart/form-data" id="form_submit">
               @csrf
                <div class="box-body">
                <div class="form-group">
                    <input class="form-control" name="sent_to" placeholder="To:" required>
                </div>
                <div class="form-group">
                    <input class="form-control" name="subject" placeholder="Subject:" required>
                </div>
                <div class="form-group">
                    <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px" required></textarea>
                </div>
                <div class="form-group">
                    <div class="btn btn-default btn-file">
                    <i class="fa fa-paperclip"></i> Attachment
                    <input type="file" class="demo" name="attachment[]" id="attachment" multiple data-jpreview-container="#preview-container">
                        <div id="preview-container" class="jpreview-container"></div>
                    </div>
                    <p class="help-block">Max. 10MB</p>
                </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                <div class="pull-right">
                    <input type="hidden" name="action" value="" id="action">
                    <button type="button" onclick="sendingMail('draft')" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                    <button type="button" onclick="sendingMail('send')" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                </div>
                <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
                </div>
                <!-- /.box-footer -->

            </form>

          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>

@endsection
