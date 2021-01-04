@extends('layouts.app')

@section('text/css')

<style>
    .about_part{
        height: 45vh !important;
    }
    #planSchedule > tr{
        font-size: 13px;
        text-align: center;
    }


</style>

@show

@section('content')


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

    <!-- pricing part start-->
    <section class="pricing_part section_padding single_page_pricing">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section_tittle text-center">
                        <h2>{{ $pages }}</h2>
                    </div>
                </div>
            </div>


        <div class="row justify-content-center">

            <div class="table table-responsive">
                <table class="table table-striped table-bordered" id="myuservehRecs">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Zip Code</th>
                            <th>Other Emails</th>
                            
                        </tr>
                    </thead>

                    <?php $i = 1;?>
                    <tbody>
                        @if($report != "")

                            <tr>
                              <td>{{ $report[0]->name }}</td>
                              <td>{{ $report[0]->email }}</td>
                              <td>{{ $report[0]->phone_number }}</td>
                              <td>{{ $report[0]->city }}</td>
                              <td>{{ $report[0]->state }}</td>
                              <td>{{ $report[0]->country }}</td>
                              <td>{{ $report[0]->zipcode }}</td>
                              <td>@if($report[0]->email1 != "" || $report[0]->email2 != "" || $report[0]->email3 != ""){{ $report[0]->email1.', '.$report[0]->email2.', '.$report[0]->email3 }} @else - @endif</td>
                            </tr>
                        @else
                        <tr>
                            <td align="center" colspan="70">No record found here</td>
                        </tr>
                        @endif
                    </tbody>


                </table>

            </div>
            


        </div>


        </div>
        <img src="img/left_sharp.png" alt="" class="left_shape_1">
        <img src="img/animate_icon/Shape-1.png" alt="" class="feature_icon_1">
        <img src="img/animate_icon/shape.png" alt="" class="feature_icon_4">
    </section>
    <!-- pricing part end-->

@endsection