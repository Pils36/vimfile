@extends('layouts.app')

@section('text/css')
<?php use \App\Http\Controllers\MinimumDiscount; ?>
<style>
    .about_part{
        height: 45vh !important;
    }
</style>

@show

@section('content')

    <!-- banner part start-->
    <section class="banner_part about_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h1 class="m-t-100">{{ $pages }}</h1>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->



       <!-- feature_part start-->
    <section class="feature_part">
        <div class="container">

           <div class="col-md-8">
                    <div class="wprt-appointment-form">
                        <br><br>
                        <form action="#" method="post" class="appointment-form">
                            @csrf
                            <div class="contact-wrap clearfix">
                                <div class="wprt-divider has-icon height-1px">
                                    <div class="divider-icon">
                                        <span class="divider-icon-before divider-center divider-double"></span>
                                        <h2 class="title">Company/Shop Information</h2>
                                        <span class="divider-icon-after divider-center divider-double"></span>
                                    </div>
                                </div>

                                <div class="wprt-spacer clearfix" data-desktop="15" data-mobi="15" data-smobi="15"></div>

                                <span class="form-control-wrap your-name">
                                    <label>Size of Employee</label>
                                    <select id="size_of_employee" name="size_of_employee" value="" class="form-control">
                                        <option value="{{ $userDetails[0]->size_of_employee }}">{{ $userDetails[0]->size_of_employee }}</option>
                                        <option value="1">1</option>
                                        <option value="2-10">2-10</option>
                                        <option value="11-20">11-20</option>
                                        <option value="21-30">21-30</option>
                                        <option value="31-40">31-40</option>
                                        <option value="41-50">41-50</option>
                                        <option value="50 Above">50 Above</option>
                                    </select>
                                </span>


                                <span class="form-control-wrap your-phone">
                                    <label>Company/Shop Name</label>
                                    <input type="text" tabindex="2" id="station_name" name="station_name" value="{{ $userDetails[0]->station_name }}" class="form-control" placeholder="Company/Shop Name" readonly>
                                </span>

                                <span class="form-control-wrap your-email">
                                    <label>Company/Shop Address</label>
                                    <input type="text" tabindex="3" id="station_address" name="station_address" value="{{ $userDetails[0]->address }}" class="form-control" placeholder="Company/Shop Address *" required>
                                </span>

                                <span class="form-control-wrap your-phone">
                                    <label>City</label>
                                    <input type="text" tabindex="2" id="city" name="city" value="{{ $userDetails[0]->city }}" class="form-control" placeholder="City *" required>
                                </span>

                                <span class="form-control-wrap your-name">
                                    <label>Zip/Postal Code</label>
                                    <input type="text" tabindex="1" id="zipcode" name="zipcode" value="{{ $userDetails[0]->zipcode }}" class="form-control" placeholder="Zip code *" required>
                                </span>

                                <span class="form-control-wrap your-phone">
                                    <label>Country</label>
                                    <select id="countryzee" tabindex="3" class="form-control" name="country" autocomplete="country">
                                        <option value="{{ $userDetails[0]->country }}"></option>
                                    </select>
                                </span>

                                <span class="form-control-wrap your-email">
                                    <label>State/Province</label>
                                    <select id="statezee" tabindex="2" class="form-control" name="state" autocomplete="state">
                                        <option value="{{ $userDetails[0]->state }}"></option>
                                    </select>
                                </span>



                                <span class="form-control-wrap your-phone">
                                    <label>Year Started Since</label>
                                    <input type="month" min="1900-01" max="{{ date('Y-m') }}" value="{{ date('Y-m') }}" tabindex="2" id="year_started_since" name="year_started_since" class="form-control" placeholder="Year started since *" required>
                                </span>

                                <span class="form-control-wrap">
                                    <label>Year of practical experience</label>
                                    <input type="text" tabindex="3" id="year_of_practice" name="year_of_practice" value="{{ $userDetails[0]->year_of_practice }}" class="form-control" placeholder="Year of practical experience *" required>
                                </span>


                            </div><!-- /.contact-wrap -->

                            <div class="wprt-spacer clearfix" data-desktop="22" data-mobi="22" data-smobi="22"></div>

                            <div class="vehicle-wrap clearfix">
                                <div class="wprt-divider has-icon height-1px">
                                    <div class="divider-icon">
                                        <span class="divider-icon-before divider-center divider-double"></span>
                                        <h2 class="title">Contact Information</h2>
                                        <span class="divider-icon-after divider-center divider-double"></span>
                                    </div>
                                </div>

                                <div class="wprt-spacer clearfix" data-desktop="15" data-mobi="15" data-smobi="15"></div>

                                <span class="form-control-wrap your-make">
                                    <label>Fullname</label>
                                    <input type="text" tabindex="4" id="fullname" name="fullname" value="{{ $userDetails[0]->name }}" class="form-control" placeholder="Fullname" @if($userDetails[0]->name != "") readonly="" @endif>
                                </span>

                                <span class="form-control-wrap your-mileage">
                                    <label>Telephone</label>
                                    <input type="text" tabindex="7" id="phone_number" name="phone_number" value="{{ $userDetails[0]->phone_number }}" class="form-control" placeholder="Telephone">
                                </span>

                                <span class="form-control-wrap">
                                    <label>Email Address</label>
                                    @php
                                        $email = explode(", ", $userDetails[0]->email);
                                        if(count($email) > 0){
                                            $email = $email[0];
                                        }
                                        else{
                                            $email = $userDetails[0]->email;
                                        }
                                    @endphp
                                    <input type="email" tabindex="5" id="email" name="email" value="{{ $email }}" class="form-control" placeholder="Email Address" @if($email != "") readonly="" @endif>
                                </span>

                                <span class="form-control-wrap your-year">
                                    <label>Mobile</label>
                                    <input type="text" tabindex="6" id="mobile" name="mobile" value="{{ $userDetails[0]->mobile }}" class="form-control" placeholder="Mobile">
                                </span>

                                <span class="form-control-wrap your-mileage">
                                    <label>Office</label>
                                    <input type="text" tabindex="7" id="office" name="office" value="{{ $userDetails[0]->office }}" class="form-control" placeholder="Office">
                                </span>

                            </div><!-- /.vehicle-wrap -->



                            <div class="wprt-spacer clearfix" data-desktop="22" data-mobi="22" data-smobi="22"></div>

                            <div class="vehicle-wrap clearfix">
                                <div class="wprt-divider has-icon height-1px">
                                    <div class="divider-icon">
                                        <span class="divider-icon-before divider-center divider-double"></span>
                                        <h2 class="title">Specialties</h2>
                                        <span class="divider-icon-after divider-center divider-double"></span>
                                    </div>
                                </div>

                                <div class="wprt-spacer clearfix" data-desktop="15" data-mobi="15" data-smobi="15"></div>

                                <span class="form-control-wrap your-make">
                                    <label>Mechanical</label>
                                    <select tabindex="4" id="mechanical_skill" name="mechanical_skill" class="form-control">
                                        <option value="{{ $userDetails[0]->mechanical_skill }}">{{ $userDetails[0]->mechanical_skill }}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </span>

                                <span class="form-control-wrap your-mileage">
                                    <label>Electrical</label>
                                    <select tabindex="4" id="electrical_skill" name="electrical_skill" class="form-control">
                                        <option value="{{ $userDetails[0]->electrical_skill }}">{{ $userDetails[0]->electrical_skill }}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </span>

                                <span class="form-control-wrap">
                                    <label>Transmissions</label>
                                    <select tabindex="4" id="transmission_skill" name="transmission_skill" class="form-control">
                                        <option value="{{ $userDetails[0]->transmission_skill }}">{{ $userDetails[0]->transmission_skill }}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </span>

                                <span class="form-control-wrap your-year">
                                    <label>Body Works</label>
                                    <select tabindex="4" id="body_work_skill" name="body_work_skill" class="form-control">
                                        <option value="{{ $userDetails[0]->body_work_skill }}">{{ $userDetails[0]->body_work_skill }}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                </span>

                                <span class="form-control-wrap your-mileage">
                                    <label>Others</label>
                                    <select tabindex="4" id="other_skills" name="other_skills" class="form-control">
                                        <option value="{{ $userDetails[0]->other_skills }}">{{ $userDetails[0]->other_skills }}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </span>
                                
                                
                                <span class="form-control-wrap specific disp-0">
                                    <label>Please Specify</label>
                                    <input type="text" tabindex="7" id="specify_other_skill" name="specify_other_skill" class="form-control" placeholder="Specify Skill">
                                </span>

                            </div><!-- /.vehicle-wrap -->


                            <div class="wprt-spacer clearfix" data-desktop="22" data-mobi="22" data-smobi="22"></div>

                            <div class="vehicle-wrap clearfix">
                                <div class="wprt-divider has-icon height-1px">
                                    <div class="divider-icon">
                                        <span class="divider-icon-before divider-center divider-double"></span>
                                        <h2 class="title">Value Added</h2>
                                        <span class="divider-icon-after divider-center divider-double"></span>
                                    </div>
                                </div>

                                <div class="wprt-spacer clearfix" data-desktop="15" data-mobi="15" data-smobi="15"></div>

                                <span class="form-control-wrap your-make">
                                    <label>VIMfile Discount</label>
                                    <select tabindex="4" id="vimfile_discount" name="vimfile_discount" class="form-control">
                                        <option value="{{ $userDetails[0]->vimfile_discount }}">{{ $userDetails[0]->vimfile_discount }}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </span>
                                
                                
                                <span class="form-control-wrap your-discount-select disp-0">
                                    <label>Select Discount Range</label>
                                    <select class="form-control" id="discountPercent" name="discountPercent">
                                        <option>Select range</option>
                                        @if($discount = \App\MinimumDiscount::where('discount', 'discount')->get())

                                        @for($i=$discount[0]->percent; $i <= $discount[0]->percent + 50; $i++)

                                        <option value="{{ $i }}">{{ $i }}</option>

                                        @endfor


                                        @endif
                                    </select>
                                </span>

                                <span class="form-control-wrap your-mileage">
                                    <label>Repair Guaranteed</label>
                                    <select tabindex="4" id="repair_guaranteed" name="repair_guaranteed" class="form-control">
                                        <option value="{{ $userDetails[0]->repair_guaranteed }}">{{ $userDetails[0]->repair_guaranteed }}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </span>

                                <span class="form-control-wrap">
                                    <label>Free Estimates</label>
                                    <select tabindex="4" id="free_estimated" name="free_estimated" class="form-control">
                                        <option value="{{ $userDetails[0]->free_estimated }}">{{ $userDetails[0]->free_estimated }}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </span>

                                <span class="form-control-wrap">
                                    <label>Walks-in Welcome</label>
                                    <select tabindex="4" id="walk_in_specified" name="walk_in_specified" class="form-control">
                                        <option value="{{ $userDetails[0]->walk_in_specified }}">{{ $userDetails[0]->walk_in_specified }}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </span>

                                <span class="form-control-wrap">
                                    <label>Others</label>
                                    <input type="text" tabindex="4" id="other_value_added" name="other_value_added" value="{{ $userDetails[0]->other_value_added }}" class="form-control" placeholder="Other Added Value">
                                </span>

                                <span class="form-control-wrap your-mileage">
                                    <label>Average Waiting Period</label>
                                    <input type="text" tabindex="4" id="average_waiting" name="average_waiting" value="{{ $userDetails[0]->average_waiting }}" class="form-control" placeholder="Average Waiting Period">
                                </span>

                                <span class="form-control-wrap your-year">
                                    <label>Hours of Operation</label>
                                    <input type="text" tabindex="4" id="hours_of_operation" name="hours_of_operation" value="{{ $userDetails[0]->hours_of_operation }}" class="form-control" placeholder="Hours of Operation">

                                </span>

                            </div><!-- /.vehicle-wrap -->


                            <div class="wprt-spacer clearfix" data-desktop="22" data-mobi="22" data-smobi="22"></div>

                            <div class="vehicle-wrap clearfix">
                                <div class="wprt-divider has-icon height-1px">
                                    <div class="divider-icon">
                                        <span class="divider-icon-before divider-center divider-double"></span>
                                        <h2 class="title">Amenities</h2>
                                        <span class="divider-icon-after divider-center divider-double"></span>
                                    </div>
                                </div>

                                <div class="wprt-spacer clearfix" data-desktop="15" data-mobi="15" data-smobi="15"></div>

                                <span class="form-control-wrap your-make">
                                    <label>Wi-Fi</label>
                                    <select tabindex="4" id="wifi" name="wifi" class="form-control">
                                        <option value="{{ $userDetails[0]->wifi }}">{{ $userDetails[0]->wifi }}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </span>

                                <span class="form-control-wrap your-mileage">
                                    <label>Gender Neutral Rest Room</label>
                                    <select tabindex="4" id="restroom" name="restroom" class="form-control">
                                        <option value="{{ $userDetails[0]->restroom }}">{{ $userDetails[0]->restroom }}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </span>

                                <span class="form-control-wrap">
                                    <label>Lounge</label>
                                    <select tabindex="4" id="lounge" name="lounge" class="form-control">
                                        <option value="{{ $userDetails[0]->lounge }}">{{ $userDetails[0]->lounge }}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </span>

                                <span class="form-control-wrap your-year">
                                    <label>Parking Space</label>
                                    <select tabindex="4" id="parking_space" name="parking_space" class="form-control">
                                        <option value="{{ $userDetails[0]->parking_space }}">{{ $userDetails[0]->parking_space }}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                </span>

                            </div><!-- /.vehicle-wrap -->


                            <div class="wprt-spacer clearfix" data-desktop="22" data-mobi="22" data-smobi="22"></div>

                            <div class="vehicle-wrap clearfix">
                                <div class="wprt-divider has-icon height-1px">
                                    <div class="divider-icon">
                                        <span class="divider-icon-before divider-center divider-double"></span>
                                        <h2 class="title">History</h2>
                                        <span class="divider-icon-after divider-center divider-double"></span>
                                    </div>
                                </div>

                                <div class="wprt-spacer clearfix" data-desktop="15" data-mobi="15" data-smobi="15"></div>



                                <span class="form-control-wrap">
                                    <label>Year Established</label>

                                    <input type="month" min="1900-01" max="{{ date('Y-m') }}" value="{{ date('Y-m') }}" tabindex="7" id="year_established" name="year_established" class="form-control" placeholder="Year Established">
                                </span>

                                <span class="form-control-wrap">
                                    <label>Background</label>
                                    <textarea id="background" type="text" class="form-control" name="background" autocomplete="background">{!! $userDetails[0]->background !!}</textarea>
                                </span>
                                <br>
                                <br>

                                <span class="form-control-wrap">

                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display(['data-theme' => 'dark']) !!}

                                </span>



                            </div><!-- /.vehicle-wrap -->
                             <br>
                                <br>

                            <div class="wrap-submit">
                                <input type="button" value="UPDATE" class="submit form-control btn btn-primary" id="update_btn" name="update_btn" @if($userDetails[0]->email != "") onclick="updateProfile('{{ $userDetails[0]->email }}')" @else onclick="updateProfile('info@vimfile.com')" @endif> <img class="spin disp-0" src="https://i.ya-webdesign.com/images/loading-gif-png-5.gif" style="width: 20px; height: 20px;">
                            </div>
                        </form>
                    </div><!-- /.wprt-contact-form -->
                </div><!-- /.col-md-8 -->
                <br><br>
        </div>

    </section>
    <!-- upcoming_event part start-->


@endsection
