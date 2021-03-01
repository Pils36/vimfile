@extends('layouts.app')

@section('text/css')

<style type="text/css">
    .main_menu{
        background-color: #101d2e !important;
    }
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


    <div class="table table-responsive m-t-120" id="estCheck">
        <h3 class="text-center">{{ $heading }}</h3> <hr>
        <table class="table table-striped table-bordered">

      @if(isset($getEstPage) && count($getEstPage) > 0)
      <tbody style="font-size: 13px;">


        @if($getEstPage[0]->vehicle_licence != "")
          <tr>
              <td>Vehicle Licence:</td>
              <td align='center'>{{ $getEstPage[0]->vehicle_licence }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->email != "")
          <tr>
              <td>E-mail Address:</td>
              <td align='center'>{{ $getEstPage[0]->email }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->make != "")
          <tr>
              <td>Make:</td>
              <td align='center'>{{ $getEstPage[0]->make }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->model != "")
          <tr>
              <td>Model:</td>
              <td align='center'>{{ $getEstPage[0]->model }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->mileage != "")
          <tr>
              <td>Mileage:</td>
              <td align='center'>{{ $getEstPage[0]->mileage }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->date != "")
          <tr>
              <td>Report Date:</td>
              <td align='center'>{{ $getEstPage[0]->date }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->service_type != "")
          <tr>
              <td>Service Type:</td>
              <td align='center'>{{ $getEstPage[0]->service_type }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->service_option != "")
          <tr>
              <td>Service Option:</td>
              <td align='center'>{{ $getEstPage[0]->service_option }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->telephone != "")
          <tr>
              <td>Phone Number:</td>
              <td align='center'>{{ $getEstPage[0]->telephone }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_qty != "")
          <tr>
              <td>Material Quantity 1:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_cost != "")
          <tr>
              <td>Material Cost 1:</td>
              <td align='center'>{{ $getEstPage[0]->material_cost }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_qty2 != "")
          <tr>
              <td>Material Quantity 2:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty2 }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_cost2 != "")
          <tr>
              <td>Material Cost 2:</td>
              <td align='center'>{{ $getEstPage[0]->material_cost2 }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_qty3 != "")
          <tr>
              <td>Material Quantity 3:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty3 }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_qty4 != "")
          <tr>
              <td>Material Quantity 4:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty4 }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_qty5 != "")
          <tr>
              <td>Material Quantity 5:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty5 }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_qty6 != "")
          <tr>
              <td>Material Quantity 6:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty6 }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_qty7 != "")
          <tr>
              <td>Material Quantity 7:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty7 }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_qty8 != "")
          <tr>
              <td>Material Quantity 8:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty8 }}</td>
          </tr>

        @endif

        @if($getEstPage[0]->material_qty9 != "")
          <tr>
              <td>Material Quantity 9:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty9 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->material_qty10 != "")
          <tr>
              <td>Material Quantity 10:</td>
              <td align='center'>{{ $getEstPage[0]->material_qty10 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->material_cost3 != "")
          <tr>
              <td>Material Cost 3:</td>
              <td align='center'>{{ $getEstPage[0]->material_cost3 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->material_cost4 != "")
          <tr>
              <td>Material Cost 4:</td>
              <td align='center'>{{ $getEstPage[0]->material_cost4 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->material_cost5 != "")
          <tr>
              <td>Material Cost 5:</td>
              <td align='center'>{{ $getEstPage[0]->material_cost5 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->material_cost6 != "")
          <tr>
              <td>Material Cost 6:</td>
              <td align='center'>{{ $getEstPage[0]->material_cost6 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->material_cost7 != "")
          <tr>
              <td>Material Cost 7:</td>
              <td align='center'>{{ $getEstPage[0]->material_cost7 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->material_cost8 != "")
          <tr>
              <td>Material Cost 8:</td>
              <td align='center'>{{ $getEstPage[0]->material_cost8 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->material_cost9 != "")
          <tr>
              <td>Material Cost 9:</td>
              <td align='center'>{{ $getEstPage[0]->material_cost9 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->material_cost10 != "")
          <tr>
              <td>Material Cost 10:</td>
              <td align='center'>{{ $getEstPage[0]->material_cost10 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty != "")
          <tr>
              <td>Labour Quantity 1:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost != "")
          <tr>
              <td>Labour Cost 1:</td>
              <td align='center'>{{ $getEstPage[0]->labour_cost }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty2 != "")
          <tr>
              <td>Labour Quantity 2:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty2 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty3 != "")
          <tr>
              <td>Labour Quantity 3:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty3 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty4 != "")
          <tr>
              <td>Labour Quantity 4:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty4 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty5 != "")
          <tr>
              <td>Labour Quantity 5:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty5 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty6 != "")
          <tr>
              <td>Labour Quantity 6:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty6 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty7 != "")
          <tr>
              <td>Labour Quantity 7:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty7 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty8 != "")
          <tr>
              <td>Labour Quantity 8:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty8 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty9 != "")
          <tr>
              <td>Labour Quantity 9:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty9 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_qty10 != "")
          <tr>
              <td>Labour Quantity 10:</td>
              <td align='center'>{{ $getEstPage[0]->labour_qty10 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost2 != "")
          <tr>
              <td>Labour Cost 2:</td>
              <td align='center'>{{ $getEstPage[0]->labour_cost2 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost3 != "")
          <tr>
              <td>Labour Cost 3:</td>
              <td align='center'>{{ $getEstPage[0]->labour_cost3 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost4 != "")
          <tr>
              <td>Labour Cost 4:</td>
              <td align='center'>{{ $getEstPage[0]->labour_cost4 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost5 != "")
          <tr>
              <td>Labour Cost 5:</td>
              <td align='center'>{{ $getEstPage[0]->labour_cost5 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost6 != "")
          <tr>
              <td>Labour Cost 6:</td>
              <td align='center'>{{ $getEstPage[0]->labour_cost6 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost7 != "")
          <tr>
              <td>Labour Cost 7:</td>
              <td align='center'>{{ $getEstPage[0]->labour_cost7 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost8 != "")
          <tr>
              <td>Labour Cost 8:</td>
              <td align='center'>{{ $getEstPage[0]->labour_cost8 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost9 != "")
          <tr>
              <td>Labour Cost 9:</td>
              <td align='center'>{{ $getEstPage[0]->labour_cost9 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->labour_cost10 != "")
          <tr>
              <td>Labour Cost 10:</td>
              <td align='center'>{{ $getEstPage[0]->labour_cost10 }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->other_cost != "")
          <tr>
              <td>Other Cost:</td>
              <td align='center'>{{ $getEstPage[0]->other_cost }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->total_cost != "")
          <tr>
              <td>Total Cost:</td>
              <td align='center'>{{ $getEstPage[0]->total_cost }}</td>
          </tr>
        @endif
          

          @if($getPart != "")

          <tr>
            <td style="font-size: 24px; font-weight: bold;">Part Details</td>
            <td>&nbsp;</td>
          </tr>

          <tr>
            <td>Part No.:</td>
            <td align='center'>{{ $getPart[0]->part_no }}</td>
          </tr>
          <tr>
            <td>Part Description:</td>
            <td align='center'>{{ $getPart[0]->description }}</td>
          </tr>
          <tr>
            <td>Part Quantity:</td>
            <td align='center'>{{ $getPart[0]->quantity }}</td>
          </tr>
          <tr>
            <td>Part Total Price:</td>
            <td align='center'>{{ $getPart[0]->total_price }}</td>
          </tr>
          <tr>
            <td>Technician In-Charge:</td>

            @if($staffname = \App\User::where('email', $getPart[0]->technician)->get())
              @if(count($staffname) > 0)

                <td align='center'>{{ $staffname[0]->name }}</td>
              @else
                <td align='center'>--</td>
              @endif

              @else
              <td align='center'>--</td>
            @endif
            
          </tr>

          @endif


        @if($getEstPage[0]->service_note != "")
          <tr>
              <td>Service Note:</td>
              <td align='center'>{{ $getEstPage[0]->service_note }}</td>
          </tr>
        @endif

        @if($getEstPage[0]->file != "noImage.png")
          <tr>
              <td>Uploaded File:</td>
              <td align='center'><a href="https://vimfile.com/uploads/{{ $getEstPage[0]->file }}" download="">Download file</a></td>
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

    @if (isset($getEstPage) && count($getEstPage) > 0)
        
        <div class="row">
        <div class="col-md-6" align="center">
            <button style="text-align: center;" class="btn btn-primary" onclick="sendMails('{{ $getEstPage[0]->estimate_id }}','{{ $getEstPage[0]->email }}')">Send as mail <img class="spinnersMail disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
        </div>
        <div class="col-md-6" align="center">
            <button style="text-align: center;" class="btn btn-danger" onclick="printCopy('estCheck')">Print Copy</button>
        </div>
        
      
      </div>
    @endif

    



    </tbody>



@endsection