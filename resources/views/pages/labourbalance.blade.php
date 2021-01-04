@extends('layouts.app')

@section('text/css')

<style>
    .appointment_section{
        border: 1px solid #14485f;
        padding: 10px 5px;
        border-radius: 10px;
    }
    .memo{
        font-size: 16px;
        background: #000;
        width: 450px;
        text-align: justify;
        position: relative;
        top: -30px;

    }
    .banner_part {
        height: 65% !important;
    }
    .banner_part .banner_text p {
        padding: 20px !important;
    }
    #headz, #linkz{
        font-size: 33px; background-color: #394f75; padding: 10px; width: 450px;
    }
    #linkz{
        height: auto;
        position: relative;
    }
    .defined{
        background: #fff;
        border-radius: 10px;
        position: relative;
        top: -30px;
    }
    .defined .banner_text_iner{
        padding: 20px 0px 0px;
    }
    .btnsDef{
        border: 1px solid grey;
        padding: 7px;
        font-size: 12px;
        width: 100%;
        text-align: center;
        font-weight: bold;
        background-color: #14485f;
        color: #fff; 
    }

    .defined img{
        height: 220px;
    }


    @media (max-width: 700px){
        .memo{
            width: 100% !important;
            padding-right: 20px !important;

        }
        #headz, #linkz{
        font-size: 33px; background-color: #394f75; padding: 10px; width: auto; margin-bottom: 150px;
    }
    #linkz{
        position: relative;
        top: -110px;
    }
    .btnsDef{
        margin-bottom: 3px;
    }
    .defined{
        position: relative;
        top: 0px;
    }
    
    }
    @media (max-width: 576px){
        .btn_2 {
    padding: 10px 30px !important;
    margin-top: 0px !important; 
}
    }

</style>



<?php use \App\Http\Controllers\User; ?>

@show
@section('content')

  <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h1 class="m-t-0" id="headz">Vehicle Inspection &<br> Maintenance File
                                </h1>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->



    <div class="container table table-responsive m-t-120" id="labourCheck">
        <h3 class="text-center">Work Order</h3> <hr>
        <table class="table table-striped table-bordered">
      @if($getlabourpage != "")
      <tbody style="font-size: 13px;">

        @if($getlabourpage[0]->vehicle_licence != "")
          <tr>
              <td>Vehicle Licence:</td>
              <td align='center'>{{ $getlabourpage[0]->vehicle_licence }}</td>
          </tr>

        @endif

        @if($getlabourpage[0]->email != "")
          <tr>
              <td>E-mail Address:</td>
              <td align='center'>{{ $getlabourpage[0]->email }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->make != "")
          <tr>
              <td>Make:</td>
              <td align='center'>{{ $getlabourpage[0]->make }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->model != "")
          <tr>
              <td>Model:</td>
              <td align='center'>{{ $getlabourpage[0]->model }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->mileage != "")
          <tr>
              <td>Mileage:</td>
              <td align='center'>{{ $getlabourpage[0]->mileage }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->date != "")
          <tr>
              <td>Report Date:</td>
              <td align='center'>{{ $getlabourpage[0]->date }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->service_type != "")
          <tr>
              <td>Service Type:</td>
              <td align='center'>{{ $getlabourpage[0]->service_type }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->service_option != "")
          <tr>
              <td>Service Option:</td>
              <td align='center'>{{ $getlabourpage[0]->service_option }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->telephone != "")
          <tr>
              <td>Phone Number:</td>
              <td align='center'>{{ $getlabourpage[0]->telephone }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->material_qty != "")
          <tr>
              <td>Material Quantity 1:</td>
              <td align='center'>{{ $getlabourpage[0]->material_qty }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->material_cost != "")
          <tr>
              <td>Material Cost 1:</td>
              <td align='center'>{{ $getlabourpage[0]->material_cost }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->material_qty2 != "")
          <tr>
              <td>Material Quantity 2:</td>
              <td align='center'>{{ $getlabourpage[0]->material_qty2 }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->material_cost2 != "")
          <tr>
              <td>Material Cost 2:</td>
              <td align='center'>{{ $getlabourpage[0]->material_cost2 }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->material_qty3 != "")
          <tr>
              <td>Material Quantity 3:</td>
              <td align='center'>{{ $getlabourpage[0]->material_qty3 }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->material_cost3 != "")
          <tr>
              <td>Material Cost 3:</td>
              <td align='center'>{{ $getlabourpage[0]->material_cost3 }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->labour_qty != "")
          <tr>
              <td>Labour Quantity 1:</td>
              <td align='center'>{{ $getlabourpage[0]->labour_qty }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->labour_cost != "")
          <tr>
              <td>Labour Cost 1:</td>
              <td align='center'>{{ $getlabourpage[0]->labour_cost }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->labour_qty2 != "")
          <tr>
              <td>Labour Quantity 2:</td>
              <td align='center'>{{ $getlabourpage[0]->labour_qty2 }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->labour_cost2 != "")
          <tr>
              <td>Labour Cost 2:</td>
              <td align='center'>{{ $getlabourpage[0]->labour_cost2 }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->other_cost != "")
          <tr>
              <td>Other Cost:</td>
              <td align='center'>{{ $getlabourpage[0]->other_cost }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->total_cost != "")
          <tr>
              <td>Total Cost:</td>
              <td align='center'>{{ $getlabourpage[0]->total_cost }}</td>
          </tr>
        @endif

        @if($getlabourpage[0]->service_note != "")
          <tr>
              <td>Service Note:</td>
              <td align='center'>{{ $getlabourpage[0]->service_note }}</td>
          </tr>
        @endif

        <tr>
          <td>Client Payment Status:</td>
          @if($getlabourpage[0]->payment == 2) <td align='center' style="color: darkblue; font-weight: bold;">PAID</td>  @else <td align='center' style="color: red; font-weight: bold;">NOT PAID</td> @endif
        </tr>

        @if($getlabourpage[0]->file != "noImage.png")
          <tr>
              <td>Uploaded File:</td>
              <td align='center'><a href="https://vimfile.com/uploads/{{ $getlabourpage[0]->file }}" download="">Download file</a></td>
          </tr>
        @endif
          
          
      </tbody>


      @else

        <tbody>
            <tr>
                <td>No record found</td>
            </tr>
        </tbody>

    @endif
  </table>
    </div>

    <div class="row">
        <div class="col-md-12" align="center">
            <button style="text-align: center;" class="btn btn-danger btn-block" onclick="printCopy('labourCheck')">Print Copy</button>
        </div>
        
      
            

      </tbody>
    </div>



@endsection