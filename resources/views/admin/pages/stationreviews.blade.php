@extends('layouts.dashboard')

@section('title', 'Dashboard')

@show


@section('dashContent')

<?php use \App\Http\Controllers\BusinessStaffs; ?>
<?php use \App\Http\Controllers\ReplyRating; ?>

<div class="wrapper">

@include('includes.dashhead')
@include('includes.dashaside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reviews
        <br>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('Admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reviews</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row respondbox disp-0" style="margin-top: 10px;">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-chat"></i> Respond to Review </h3>
            </div>
            <div class="box-body">
                
              <form role="form" action="{{ route('reviewresponse') }}" method="POST">
                @csrf
              <div class="box-body">
              
              <div class="row">

                <div class="col-md-12">
                  <div class="form-group">
                  <label for="message">Reply Message</label>
                        <input type="hidden" name="post_message_id" id="post_message_id" value="">
                    <textarea id="review_reply" name="review_reply"></textarea>
                </div>
                </div>
              </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
              </div>

            </form>



            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">



            @if(count($reviews) > 0)


              @foreach($reviews as $review)

                <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          {{ date('d F. Y', strtotime($review->created_at)) }}
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> {{ date('d/F/Y, H:i', strtotime($review->created_at)) }}</span>

                      <h3 class="timeline-header"><a href="#">Quality of Service ({{ $review->rating }}) <br> <small style="font-weight: bold; color: red;">Station name: {{ $review->station_name }}</small></a></h3>

                      <div class="timeline-body">
                        
                        <b>Service Type:</b> {{ $review->service_type }} <br><br>
                        <b>Date & Time Visited:</b> {{ $review->period_visited }} <br><br>
                        <b>Service Description:</b> {{ $review->service_description }} <br><br>
                        <b>Service Comment:</b><br> {!! $review->comment !!} <br>
                      

                      @if($review->reply != "")
                        <hr>

                      @if($postReply = \App\ReplyRating::where('post_id', $review->post_id)->get()) 

                      @if(count($postReply) > 0)  
                        <h4 style="font-weight: bold; text-decoration: underline;">Replies: </h4>
                      @foreach ($postReply as $postItem)
                      <br>

                      <div @if(strlen($postItem->reply) >= 700) class="reviewreply" @else class="reviewothereply" @endif>
                          {!! $postItem->reply !!}
                      </div>
                      @endforeach

                      

                      @else 

                      <div class="reviewothereply">
                          No reply yet
                      </div>

                      @endif  
                  
                  @endif



                      @endif
                      </div>


                        <div class="timeline-footer">
                            <button class="btn btn-primary" onclick="showreplyBox('{{ $review->post_id }}')">Reply</button>
                      </div>

                    </div>
                  </li>
                  <!-- END timeline item -->

              @endforeach

            @else

               <li class="time-label">
                        <span class="bg-red">
                          {{ date('d F. Y') }}
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> {{ date('H:i A') }}</span>

                      <h3 class="timeline-header"><a href="#">Quality of Service (0)</a></h3>

                      <div class="timeline-body">
                          No post available yet
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->

            @endif
            
           
          </ul>

          {{-- Nav --}}
          <center>
              <nav aria-label="...">
            <ul class="pagination pagination-lg">
                <li class="page-item">
                    {{ $reviews->links() }}
                </li>
            </ul>
            </nav>
          </center>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

@endsection