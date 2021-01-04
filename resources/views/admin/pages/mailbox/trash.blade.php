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
          <a href="{{ route('Compose Mail') }}" class="btn btn-primary btn-block margin-bottom">Compose</a>

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
                    <span class="label label-danger pull-right">{{ count($trashMail) }}</span>
                </a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Trash Messages</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                </div>
                <!-- /.btn-group -->
                <div class="pull-right">
                  {{-- 1-50/200 --}}
                  &nbsp;
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->

              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                      @if (count($trashMail) > 0)
                          @foreach ($trashMail as $item)
                              <tr>
                                <td><input type="checkbox"></td>
                                <td class="mailbox-star"><a href="/Admin/read/{{ $item->id }}"><i class="fa fa-star text-yellow"></i></a></td>
                                <td class="mailbox-name"><a href="/Admin/read/{{ $item->id }}">{{ $item->subject }}</a></td>
                                <td class="mailbox-subject"><?php $string = $item->message; $output = strlen($string) > 20 ? substr($string,0,20)."..." : $string;?>

                                    {!! $output !!}
                                </td>
                                <td class="mailbox-attachment">@if($item->file != "")<img src="https://img.icons8.com/metro/16/000000/attach.png"/>@endif</td>
                                <td class="mailbox-date">{{ date('d/m/Y h:i a', strtotime($item->created_at)) }}</td>
                            </tr>
                          @endforeach
                      @else
                          <tr><td colspan="6" align="center">No trash message</td></tr>
                      @endif

                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                </div>
                <!-- /.btn-group -->
                <div class="pull-right">
                  {{-- 1-50/200 --}}
                  &nbsp;
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
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
