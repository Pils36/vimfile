<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Vehicleinfo as Vehicleinfo;
use App\Carrecord as Carrecord;
use App\Estimate as Estimate;

class AjaxvehicleController extends Controller
{
    // COntroller for ajax request


    public function ajaxlicensesearch(Request $req){


        $getvehicle = Vehicleinfo::where('vehicle_licence', $req->vehicle_licence)->where('busID','=','undefined')->get();

        // dd($getvehicle);

        $getLicence = DB::table('vehicleinfo')
            ->join('business', 'vehicleinfo.busID', '=', 'business.busID')->where('vehicle_licence', $req->vehicle_licence)
            ->orderBy('vehicleinfo.created_at', 'DESC')->get();

        if(count($getLicence) > 0){

            if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer"){

                $getLicencez = DB::table('vehicleinfo')
            ->join('business', 'vehicleinfo.busID', '=', 'business.busID')->where('vehicleinfo.busID', Auth::user()->busID)->where('vehicle_licence', $req->vehicle_licence)
            ->orderBy('vehicleinfo.created_at', 'DESC')->get();

                if(count($getLicencez) > 0){
                    $resData = ['res' => 'Data Retrieved', 'message' => 'success', 'data' => json_encode($getLicencez)];
                }
                else{
                    $resData = ['res' => 'Vehicle not Registered with company', 'message' => 'info'];
                }
            }
            else{
                $resData = ['res' => 'Data Retrieved', 'message' => 'success', 'data' => json_encode($getLicence)];

                $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Searched for Licence Number for Maintenance Record '.$req->vehicle_licence);
            }


        }
        else{

            if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer"){
                $resData = ['res' => 'Vehicle not Registered with company', 'message' => 'info'];
            }
            else{
                if(count($getvehicle) > 0){
                $resData = ['res' => 'Data Retrieved', 'message' => 'success', 'data' => json_encode($getvehicle)];
                }
                else{
                    $resData = ['res' => 'Maintenance record not found. Register this vehicle', 'message' => 'info'];
                }
            }


        }

        return $this->returnJSON($resData);
    }


    public function ajaxlicensesearches(Request $req){

        $getCarinf = Carrecord::where('vehicle_reg_no', $req->vehicle_licence)->get();

        if(count($getCarinf) > 0){

            // Maintenance Record

            $getLicence = Vehicleinfo::where('vehicle_licence', $req->vehicle_licence)->groupBy('estimate_id')->orderBy('created_at', 'DESC')->get();

            // Estimate Record

           $getvehEst = Estimate::where('vehicle_licence', $req->vehicle_licence)->where('busID', Auth::user()->busID)->where('estimate', '1')->groupBy('estimate_id')->orderBy('created_at', 'DESC')->get();


            //    Work Order Record

           $getvehWO = Estimate::where('vehicle_licence', $req->vehicle_licence)->where('work_order', '1')->groupBy('estimate_id')->orderBy('created_at', 'DESC')->get();


           $resData = ['res' => 'Data Retrieved', 'message' => 'success', 'data' => json_encode($getLicence), 'data2' => json_encode($getCarinf), 'action' => 'main', 'data3' => json_encode($getvehEst), 'data4' => json_encode($getvehWO)];

           $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Searched for Licence Number for Maintenance Log '.$req->vehicle_licence);
        }
        else{
            $resData = ['res' => 'Car not registered. Register this vehicle', 'message' => 'info'];
        }

        return $this->returnJSON($resData);
    }



    public function returnJSON($data){
        return response()->json($data);
    }


}
