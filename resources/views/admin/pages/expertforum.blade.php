
@extends('layouts.dashboard')

@section('title', 'Dashboard')

@show
<?php use \App\Http\Controllers\AnsFromExpert; ?>
@section('dashContent')

<div class="wrapper">

@include('includes.dashhead')
@include('includes.dashaside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Expert Forum
        <small>Post articles, news and lots more...</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('Admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Expert Forum</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Expert Forum</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

            <div class="row">

                @if (count($askexpert) > 0)
                    @foreach ($askexpert as $blog)

                    <div class="col-md-12">
                    <!-- Box Comment -->
                    <div class="box box-widget">
                        <div class="box-header with-border">
                        <div class="user-block">
                            <img class="img-circle" src="https://res.cloudinary.com/pilstech/image/upload/v1602595088/3d-worker-hammer-question-24315963_qalye5.jpg" alt="User Image">
                            <span class="username"><a href="#">{{ $blog->name }}</a></span>
                            <span class="description">Shared publicly - {{ $blog->created_at->diffForHumans() }} <small>{{ date('d/M/Y', strtotime($blog->created_at)) }}</small></span>
                        </div>
                        <!-- /.user-block -->
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                        <img class="img-responsive pad" src="https://res.cloudinary.com/pilstech/image/upload/v1602592090/ask-expert_fn5fcm.png" alt="Photo" style="height: 200px;">

                        {!! $blog->question !!} <br><br>

                        @if ($blog->image != "askexperts.jpg")

                        <a href="{{ $blog->image }}" target="_blank">
                            <img src="https://res.cloudinary.com/pilstech/image/upload/v1602592793/323-3236838_computer-icons-directory-file-manager-shortcut-folder-icon-mac-png_a2qank.jpg" alt="{{ $blog->question }}" style="width: 50px; height: 50px;">
                        </a>

                        @endif

                        </div>
                        <!-- /.box-body -->
                        @if($comment = \App\AnsFromExpert::where('post_id', $blog->post_id)->orderBy('created_at', 'DESC')->get())

                        <div class="box-footer box-comments" @if(count($comment) > 5) style="height: 300px; overflow-y: auto;" @else style="height: auto;" @endif>

                                @if (count($comment) > 0)

                                    @foreach ($comment as $item)
                                        <div class="box-comment">
                                        <!-- User image -->
                                        <img class="img-circle img-sm" src="https://res.cloudinary.com/pilstech/image/upload/v1602595210/161-1616648_clip-art-car-repair-cartoon-car-not-starting_ppcz4w.png" alt="User Image">

                                        <div class="comment-text">
                                            <span class="username">
                                                {{ $item->autocare }}
                                                <span class="text-muted pull-right">{{ $item->created_at->diffForHumans() }} </span>
                                            </span><!-- /.username -->
                                                {!! $item->answer !!}
                                        </div>
                                        <!-- /.comment-text -->
                                    </div>
                                    <!-- /.box-comment -->
                                    @endforeach

                                @else

                                @endif

                            </div>
                            @endif

                        <!-- /.box-footer -->
                        <div class="box-footer">
                        <form action="{{ route('answerquestions') }}" method="post">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $blog->post_id }}">
                            <input type="hidden" name="name" value="{{ session('name').' of '.session('company') }}">
                            <img class="img-responsive img-circle img-sm" src="https://res.cloudinary.com/pilstech/image/upload/v1602595210/161-1616648_clip-art-car-repair-cartoon-car-not-starting_ppcz4w.png" alt="Alt Text">
                            <!-- .img-push is used to add margin to elements next to floating images -->
                            <div class="img-push">
                            <input type="text" class="form-control input-sm" name="message" placeholder="Press enter to post answer">
                            </div>
                        </form>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                    </div>

                    @endforeach
                @else
                    <div class="col-md-12">
                        <center>No question asked yet</center>
                    </div>
                @endif


            </div>

            {{-- NAv LINK --}}

            <center>

                <nav aria-label="...">
                    <ul class="pagination pagination-lg">
                        <li class="page-item">
                            {{ $askexpert->links() }}
                        </li>
                    </ul>
                    </nav>
            </center>

        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>

  @endsection
