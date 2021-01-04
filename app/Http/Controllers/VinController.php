<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User as User;
use App\VinLookup as VinLookup;


class VinController extends Controller
{

    // VIN Decode Info

    public function decodeInfo(Request $req){


        $data = $this->vinRequest($req->id, $req->vin);

        // $data = $this->vinRequest("decode", "2HKRM3H34EH003621");

        $resData = ['data' =>  json_encode($data), 'message' => 'success', 'action' => 'vinlookup'];


        return $this->returnJSON($resData);

    }



    public function vinRequest($id, $vinNumber){

        $apiPrefix = "https://api.vindecoder.eu/3.1";
        $apikey = "106fb0427813";   // Your API key
        $secretkey = "5b91223b4d";  // Your secret key
        $id = $id;
        $vin = mb_strtoupper($vinNumber);

        $controlsum = substr(sha1("{$vin}|{$id}|{$apikey}|{$secretkey}"), 0, 10);

        $data = file_get_contents("{$apiPrefix}/{$apikey}/{$controlsum}/decode/{$vin}.json", false);

        $result = json_decode($data);
        
        foreach($result->decode as $key => $item){


            VinLookup::updateOrInsert(['label' => $item->label, 'value' => $item->value, 'vin_number' => $vinNumber] ,['label' => $item->label, 'value' => $item->value, 'vin_number' => $vinNumber]);
        }

        return $result;
    }


     	// JSON Response
 	public function returnJSON($data){
        return response()->json($data);
    }
}
