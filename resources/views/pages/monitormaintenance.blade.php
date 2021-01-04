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
                <table class="table table-striped table-bordered vehRecs" id="myvehRecs">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Licence</th>
                            <th>Mileage</th>
                            <th>Date</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Service Type</th>
                            <th>Service Option</th>
                            <th>Material Qty 1</th>
                            <th>Material Qty 2</th>
                            <th>Material Qty 3</th>
                            <th>Material Qty 4</th>
                            <th>Material Qty 5</th>
                            <th>Material Qty 6</th>
                            <th>Material Qty 7</th>
                            <th>Material Qty 8</th>
                            <th>Material Qty 9</th>
                            <th>Material Qty 10</th>
                            <th>Material Cost 1</th>
                            <th>Material Cost 2</th>
                            <th>Material Cost 3</th>
                            <th>Material Cost 4</th>
                            <th>Material Cost 5</th>
                            <th>Material Cost 6</th>
                            <th>Material Cost 7</th>
                            <th>Material Cost 8</th>
                            <th>Material Cost 9</th>
                            <th>Material Cost 10</th>
                            <th>Labour Qty 1</th>
                            <th>Labour Qty 2</th>
                            <th>Labour Qty 3</th>
                            <th>Labour Qty 4</th>
                            <th>Labour Qty 5</th>
                            <th>Labour Qty 6</th>
                            <th>Labour Qty 7</th>
                            <th>Labour Qty 8</th>
                            <th>Labour Qty 9</th>
                            <th>Labour Qty 10</th>
                            <th>Labour Cost 1</th>
                            <th>Labour Cost 2</th>
                            <th>Labour Cost 3</th>
                            <th>Labour Cost 4</th>
                            <th>Labour Cost 5</th>
                            <th>Labour Cost 6</th>
                            <th>Labour Cost 7</th>
                            <th>Labour Cost 8</th>
                            <th>Labour Cost 9</th>
                            <th>Labour Cost 10</th>
                            <th>Other Cost</th>
                            <th>Total Cost</th>
                            <th>Service Note</th>
                            <th>Document</th>
                            <th>Payment</th>
                            <th>Technician</th>
                            
                        </tr>
                    </thead>

                    <?php $i = 1;?>
                    <tbody>
                        @if($report != "")

                            @foreach($report as $reports)

                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $reports->vehicle_licence }}</td>
                                <td>{{ $reports->mileage }}</td>
                                <td>{{ $reports->date }}</td>
                                <td>{{ $reports->make }}</td>
                                <td>{{ $reports->model }}</td>
                                <td>{{ $reports->service_type }}</td>
                                <td>{{ $reports->service_option }}</td>
                                <td>{{ $reports->material_qty }}</td>
                                <td>{{ $reports->material_qty2 }}</td>
                                <td>{{ $reports->material_qty3 }}</td>
                                <td>{{ $reports->material_qty4 }}</td>
                                <td>{{ $reports->material_qty5 }}</td>
                                <td>{{ $reports->material_qty6 }}</td>
                                <td>{{ $reports->material_qty7 }}</td>
                                <td>{{ $reports->material_qty8 }}</td>
                                <td>{{ $reports->material_qty9 }}</td>
                                <td>{{ $reports->material_qty10 }}</td>
                                <td>{{ $reports->material_cost }}</td>
                                <td>{{ $reports->material_cost2 }}</td>
                                <td>{{ $reports->material_cost3 }}</td>
                                <td>{{ $reports->material_cost4 }}</td>
                                <td>{{ $reports->material_cost5 }}</td>
                                <td>{{ $reports->material_cost6 }}</td>
                                <td>{{ $reports->material_cost7 }}</td>
                                <td>{{ $reports->material_cost8 }}</td>
                                <td>{{ $reports->material_cost9 }}</td>
                                <td>{{ $reports->material_cost10 }}</td>
                                <td>{{ $reports->labour_qty }}</td>
                                <td>{{ $reports->labour_qty2 }}</td>
                                <td>{{ $reports->labour_qty3 }}</td>
                                <td>{{ $reports->labour_qty4 }}</td>
                                <td>{{ $reports->labour_qty5 }}</td>
                                <td>{{ $reports->labour_qty6 }}</td>
                                <td>{{ $reports->labour_qty7 }}</td>
                                <td>{{ $reports->labour_qty8 }}</td>
                                <td>{{ $reports->labour_qty9 }}</td>
                                <td>{{ $reports->labour_qty10 }}</td>
                                <td>{{ $reports->labour_cost }}</td>
                                <td>{{ $reports->labour_cost2 }}</td>
                                <td>{{ $reports->labour_cost3 }}</td>
                                <td>{{ $reports->labour_cost4 }}</td>
                                <td>{{ $reports->labour_cost5 }}</td>
                                <td>{{ $reports->labour_cost6 }}</td>
                                <td>{{ $reports->labour_cost7 }}</td>
                                <td>{{ $reports->labour_cost8 }}</td>
                                <td>{{ $reports->labour_cost9 }}</td>
                                <td>{{ $reports->labour_cost10 }}</td>
                                <td>{{ $reports->other_cost }}</td>
                                <td>{{ $reports->total_cost }}</td>
                                <td>{{ $reports->service_note }}</td>
                                <td>@if($reports->file != 'noImage.png') <a href="/uploads/{{ $reports->file }}">Open file</a> @else No file @endif</td>
                               @if($reports->payment == '2')<td style="font-weight: bold; color: green;"> PAID </td> @elseif($reports->payment == '1') <td style="font-weight: bold; color: red;"> NOT PAID </td> @elseif(!$reports->payment) <td style="font-weight: bold; color: red;"> NO PAYMENT STATUS YET </td>@else <td style="font-weight: bold; color: red;"> NO PAYMENT STATUS YET </td>  @endif

                               <td>{{ $reports->technician }}</td>

                            </tr>

                            @endforeach

                        @else
                        <tr>
                            <td align="center" colspan="70">No record found here</td>
                        </tr>
                        @endif
                    </tbody>


                </table>

                <center><button class="btn btn-primary btn-block" onclick="printCopy('myvehRecs')">Print Copy</button></center>
            </div>
            


        </div>


        </div>
        <img src="img/left_sharp.png" alt="" class="left_shape_1">
        <img src="img/animate_icon/Shape-1.png" alt="" class="feature_icon_1">
        <img src="img/animate_icon/shape.png" alt="" class="feature_icon_4">
    </section>
    <!-- pricing part end-->

@endsection