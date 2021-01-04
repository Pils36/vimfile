@extends('layouts.app')

@section('text/css')

<style>
    .about_part{
        height: 45vh !important;
    }
    .popular_post_widget{
        height: 370px !important;
        overflow-y: auto;
    }
    .media-body a h6{
        font-size: 14px !important;
    }
</style>

@show

@section('content')
<?php use \App\Http\Controllers\AnsFromExpert; ?>

  <!-- breadcrumb start-->
  <section class="breadcrumb banner_part">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb_iner text-center">
            <div class="breadcrumb_iner_item">
              <h2>{{ $pages }}</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->



    <!--================Blog Area =================-->
    <section class="blog_area section_padding">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <h1>Open Ticket</h1><hr>
                    <div class="blog_left_sidebar">

                        <div class="row">
                            <div class="col-md-6">
                              <h6>Name</h6> <br>
                                <input type="hidden" name="ticketID" id="ticketID" value="{{ '#'.mt_rand(10000, 99999) }}">
                                <input type="text" name="ticketName" class="form-control" id="ticketName" value="{{ Auth::user()->name }}" readonly="">
                            </div>
                            <div class="col-md-6">
                              <h6>Email</h6> <br>
                              <input type="text" name="ticketEmail" class="form-control" id="ticketEmail" value="{{ Auth::user()->email }}" readonly="">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-12">
                            <h6>Subject</h6> <br>
                            <input type="text" name="ticketSubject" id="ticketSubject" class="form-control">
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-4">
                            <h6>Department</h6> <br>
                            <select class="form-control" id="ticketDepartment" name="ticketDepartment">
                              <option value="General Enquiries">General Enquiries</option>
                              <option value="Support">Support</option>
                              <option value="Others">Others</option>
                            </select>
                          </div>
                          <div class="col-md-4">
                            <h6>Related Service</h6> <br>
                            <select class="form-control" id="ticketRelatedServices" name="ticketRelatedServices">
                              @if(Auth::user()->userType == "Individual")
                                <option value="Vehicle Maintenance">Vehicle Maintenance</option>
                              @endif

                              @if(Auth::user()->userType == "Commercial")
                                <option value="Vehicle Maintenance">Vehicle Maintenance</option>
                                <option value="Financial Report">Financial Report</option>
                              @endif

                              @if(Auth::user()->userType == "Technician")
                                <option value="Vehicle Maintenance">Vehicle Maintenance</option>
                                <option value="Clocking System">Clocking System</option>
                              @endif

                              @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" ||Auth::user()->userType == "Auto Care" )
                              <option value="Vehicle Maintenance">Vehicle Maintenance</option>
                              <option value="Manage Inventory">Manage Inventory</option>
                              <option value="Manage Labour">Manage Labour</option>
                              <option value="Revenue">Revenue</option>
                              <option value="Expenditure">Expenditure</option>
                              <option value="Business Report">Business Report</option>

                              @endif
                            </select>
                          </div>
                          <div class="col-md-4">
                            <h6>Priority</h6> <br>
                            <select class="form-control" id="ticketPriority" name="ticketPriority">
                              <option value="High">High</option>
                              <option value="Medium">Medium</option>
                              <option value="Low">Low</option>
                            </select>
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-12">
                            <h6>Message</h6><br>
                            <textarea class="form-control" id="ticketMessage" name="ticketMessage" style="height: 150px; resize: none; overflow-y: auto;"></textarea>
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-12">
                            <h6>Attachment</h6>
                            <br>
                            <input type="file" name="ticketAttachment" id="ticketAttachment" class="form-control">
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-12">
                            <center>
                              <button class="btn btn-primary" onclick="bookTicket('submit')">Submit <img align="right" class="spinTicket disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                              <button class="btn btn-danger" onclick="bookTicket('cancel')">Cancel</button>
                            </center>
                          </div>
                        </div>

                    </div>
                </div>



                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <h4 style="font-weight: bold;"><img style="width: 40px; height: 40px;" src="https://img.icons8.com/dusk/64/000000/globe-earth.png" class="fa fa-spin"> Support</h4> <hr>
                           <ul>
                               <li>
                                   <a href="{{ route('Supportticket') }}" style="color: darkblue !important; font-weight: bold;">
                                      <img style="width: 40px; height: 40px;" src="https://img.icons8.com/dusk/64/000000/starred-ticket.png"> My Support Ticket
                                   </a>
                               </li>
                               <hr> 
                               <li>
                                   <a href="{{ route('Opennewticket', 'c=Enquiries') }}" style="color: darkblue !important; font-weight: bold;">
                                      <img style="width: 40px; height: 40px;" src="https://img.icons8.com/cotton/64/000000/email-open.png"> Create Ticket
                                   </a>
                               </li>
                           </ul>
                         </aside>

                    </div>
                </div>

                
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection