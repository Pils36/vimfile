@extends('layouts.dashboard')

@section('title', 'Dashboard')
<?php use \App\Http\Controllers\MinimumDiscount; ?>

@show




@section('dashContent')

<style>
    .required{
        font-weight: bold;
        color: red;
    }
</style>

<div class="wrapper">

  @include('includes.dashhead')
  @include('includes.dashaside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Business Information
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('Admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Business Information</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              {{-- <li class="active"><a href="#timeline" data-toggle="tab">Timeline</a></li> --}}
              <li class="active"><a href="#settings" data-toggle="tab">{{ $profileDetails[0]['station_name'] }}</a></li>
            </ul>


            <div class="tab-content">

             

              <div class="active tab-pane" id="settings">
                <form class="form-horizontal" action="{{ route('supportupdateme') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h4>Company Information</h4> <br>

                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Employee Size</label>

                        <div class="col-sm-10">

                        <select id="size_of_employee" name="size_of_employee" value="" class="form-control" required>
                            <option value="{{ $profileDetails[0]['size_of_employee'] }}">{{ $profileDetails[0]['size_of_employee'] }}</option>
                            <option value="1">1</option>
                            <option value="2-10">2-10</option>
                            <option value="11-20">11-20</option>
                            <option value="21-30">21-30</option>
                            <option value="31-40">31-40</option>
                            <option value="41-50">41-50</option>
                            <option value="50 Above">50 Above</option>
                        </select>

                        </div>
                  </div>

                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Company Name</label>

                        <div class="col-sm-10">

                        <input type="text" tabindex="2" id="station_name" name="station_name" value="{{ $profileDetails[0]['station_name'] }}" class="form-control" placeholder="Company/Shop Name" required readonly>

                        </div>
                  </div>

                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Company Address</label>

                        <div class="col-sm-10">

                        <input type="text" tabindex="2" id="station_address" name="station_address" value="{{ $profileDetails[0]['address'] }}" class="form-control" placeholder="Company/Shop Address" required>

                        </div>
                  </div>

                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> City</label>

                        <div class="col-sm-10">

                        <input type="text" tabindex="2" id="station_city" name="city" value="{{ $profileDetails[0]['city'] }}" class="form-control" placeholder="City" required>

                        </div>
                  </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Zip/Postal Code</label>

                        <div class="col-sm-10">

                        <input type="text" tabindex="2" id="station_zipcode" name="zipcode" value="{{ $profileDetails[0]['zipcode'] }}" class="form-control" placeholder="Zip/Postal Code">

                        </div>
                  </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Country</label>

                        <div class="col-sm-10">

                        <select id="prof_country" tabindex="3" class="form-control" name="country" autocomplete="country" required>
                            <option value="{{ $profileDetails[0]['country'] }}"></option>
                        </select>

                        </div>
                  </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> State/Province</label>

                        <div class="col-sm-10">

                        <select id="prof_state" tabindex="3" class="form-control" name="state" autocomplete="state" required>
                            <option value="{{ $profileDetails[0]['state'] }}"></option>
                        </select>

                        </div>
                  </div>
                  <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Year Started Since</label>

                        <div class="col-sm-10">

                        <input type="month" min="1900-01" max="{{ date('Y-m') }}" value="{{ date('Y-m') }}" tabindex="2" id="year_started_since" name="year_started_since" class="form-control" placeholder="Year started since *" required>

                        </div>
                  </div>

                  <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label"> Company Logo</label>

                        <div class="col-sm-10">

                        <input type="file"  id="file" name="file" class="form-control">

                        </div>
                  </div>

                  <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label"> Manage Photos</label>

                        <div class="col-sm-10">
                          <input type="file" class="myphotos form-control" name="manageimage[]" id="manageimage" multiple data-jpreview-container="#preview-container">
                          <div id="preview-container" class="jpreview-container"></div>

                          <small style="font-weight: bold; color: red">Hold ctrl + click to select multiple</small>
                        </div>

                        
                  </div>
                    
                    <hr>

                  <h4>Contact Information</h4> <br>



                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Fullname</label>

                    <div class="col-sm-10">
                      <input type="text" tabindex="4" id="fullname" name="fullname" value="{{ $profileDetails[0]['name'] }}" class="form-control" placeholder="Fullname" @if($profileDetails[0]['name'] != "") readonly="" @else required @endif>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Telephone</label>

                    <div class="col-sm-10">
                      <input type="text" tabindex="7" id="phone_number" name="phone_number" value="{{ $profileDetails[0]['phone_number'] }}" class="form-control" placeholder="Telephone" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label"><span class="required">*</span> Email Address</label>

                    <div class="col-sm-10">
                      <input type="email" tabindex="7" id="email" name="email" value="{{ $profileDetails[0]['email'] }}" class="form-control" placeholder="Email Address" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Mobile</label>

                    <div class="col-sm-10">
                      <input type="text" tabindex="7" id="mobile" name="mobile" value="{{ $profileDetails[0]['mobile'] }}" class="form-control" placeholder="Mobile">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Office</label>

                    <div class="col-sm-10">
                      <input type="text" tabindex="7" id="office" name="office" value="{{ $profileDetails[0]['office'] }}" class="form-control" placeholder="Office">
                    </div>
                  </div>


                  <hr>

                  <h4>Specialties</h4> <br>

                  
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Mechanical</label>

                    <div class="col-sm-10">
                      <select tabindex="4" id="mechanical_skill" name="mechanical_skill" class="form-control" required>
                            <option value="{{ $profileDetails[0]['mechanical_skill'] }}">{{ $profileDetails[0]['mechanical_skill'] }}</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Electrical</label>

                    <div class="col-sm-10">
                      <select tabindex="4" id="electrical_skill" name="electrical_skill" class="form-control" required>
                            <option value="{{ $profileDetails[0]['electrical_skill'] }}">{{ $profileDetails[0]['electrical_skill'] }}</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Transmissions</label>

                    <div class="col-sm-10">
                      <select tabindex="4" id="transmission_skill" name="transmission_skill" class="form-control" required>
                            <option value="{{ $profileDetails[0]['transmission_skill'] }}">{{ $profileDetails[0]['transmission_skill'] }}</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                  </div>



                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Body Works</label>

                    <div class="col-sm-10">
                      <select tabindex="4" id="body_work_skill" name="body_work_skill" class="form-control" required>
                            <option value="{{ $profileDetails[0]['body_work_skill'] }}">{{ $profileDetails[0]['body_work_skill'] }}</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                  </div>
                  
                  
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Others</label>

                    <div class="col-sm-10">
                      <select tabindex="4" id="other_skills" name="other_skills" class="form-control" required>
                            <option value="{{ $profileDetails[0]['other_skills'] }}">{{ $profileDetails[0]['other_skills'] }}</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                  </div>

                  <div class="form-group specific disp-0">
                    <label for="inputName" class="col-sm-2 control-label">Please Specify</label>

                    <div class="col-sm-10">
                      <input type="text" tabindex="7" id="specify_other_skill" name="specify_other_skill" class="form-control" placeholder="Specify Skill">
                    </div>
                  </div>


                  <hr>

                  <h4>Value Added</h4> <br>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> VIMfile Discount</label>

                    <div class="col-sm-10">
                      <select tabindex="4" id="vimfile_discount" name="vimfile_discount" class="form-control" required>
                        <option value="{{ $profileDetails[0]['vimfile_discount'] }}">{{ $profileDetails[0]['vimfile_discount'] }}</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    </div>
                  </div>

                  <div class="form-group your-discount-select disp-0">
                    <label for="inputName" class="col-sm-2 control-label">Select Discount Range</label>

                    <div class="col-sm-10">
                      <select class="form-control" id="discountPercent" name="discountPercent">
                        <option>Select range</option>
                        @if($discount = \App\MinimumDiscount::where('discount', 'discount')->get())

                        @for($i=$discount[0]->percent; $i <= $discount[0]->percent + 50; $i++)

                        <option value="{{ $i }}">{{ $i }}</option>

                        @endfor


                        @endif
                    </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Repair Guaranteed</label>

                    <div class="col-sm-10">
                      <select tabindex="4" id="repair_guaranteed" name="repair_guaranteed" class="form-control" required>
                        <option value="{{ $profileDetails[0]['repair_guaranteed'] }}">{{ $profileDetails[0]['repair_guaranteed'] }}</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Free Estimates</label>

                    <div class="col-sm-10">
                      <select tabindex="4" id="free_estimated" name="free_estimated" class="form-control" required>
                        <option value="{{ $profileDetails[0]['free_estimated'] }}">{{ $profileDetails[0]['free_estimated'] }}</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Walks-in Welcome</label>

                    <div class="col-sm-10">
                      <select tabindex="4" id="walk_in_specified" name="walk_in_specified" class="form-control" required>
                        <option value="{{ $profileDetails[0]['walk_in_specified'] }}">{{ $profileDetails[0]['walk_in_specified'] }}</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Others</label>

                    <div class="col-sm-10">
                      <input type="text" tabindex="4" id="other_value_added" name="other_value_added" value="{{ $profileDetails[0]['other_value_added'] }}" class="form-control" placeholder="Other Added Value">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Average Waiting Period</label>

                    <div class="col-sm-10">
                      <input type="text" tabindex="4" id="average_waiting" name="average_waiting" value="{{ $profileDetails[0]['average_waiting'] }}" class="form-control" placeholder="Average Waiting Period" required>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Hours of Operation</label>

                    <div class="col-sm-10">
                      <textarea id="hours_of_operation" type="text" class="form-control" name="hours_of_operation" autocomplete="hours_of_operation">{!! $profileDetails[0]['hours_of_operation'] !!}</textarea>

                    </div>
                  </div>

                  <hr>

                  <h4>Amenities</h4> <br>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Wi-Fi</label>

                    <div class="col-sm-10">
                      <select tabindex="4" id="wifi" name="wifi" class="form-control" required>
                        <option value="{{ $profileDetails[0]['wifi'] }}">{{ $profileDetails[0]['wifi'] }}</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Gender Neutral Rest Room</label>

                    <div class="col-sm-10">
                      <select tabindex="4" id="restroom" name="restroom" class="form-control" required>
                        <option value="{{ $profileDetails[0]['restroom'] }}">{{ $profileDetails[0]['restroom'] }}</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Lounge</label>

                    <div class="col-sm-10">
                      <select tabindex="4" id="lounge" name="lounge" class="form-control" required>
                        <option value="{{ $profileDetails[0]['lounge'] }}">{{ $profileDetails[0]['lounge'] }}</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Parking Space</label>

                    <div class="col-sm-10">
                      <select tabindex="4" id="parking_space" name="parking_space" class="form-control" required>
                        <option value="{{ $profileDetails[0]['parking_space'] }}">{{ $profileDetails[0]['parking_space'] }}</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    </div>
                  </div>

                  <hr>

                  <h4>History</h4> <br>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><span class="required">*</span> Year Established</label>

                    <div class="col-sm-10">
                      <input type="month" min="1900-01" max="{{ date('Y-m') }}" value="{{ date('Y-m') }}" tabindex="4" id="year_established" name="year_established" class="form-control" placeholder="Year Established" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Background</label>

                    <div class="col-sm-10">
                      <textarea id="background" type="text" class="form-control" name="background" autocomplete="background">{!! $profileDetails[0]['background'] !!}</textarea>
                    </div>
                  </div>
                

                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary">Update Information</button>
                    </div>
                  </div>






                </form>
              </div>
              <!-- /.tab-pane -->





            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
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
