<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

use Session;

use App\User as User;
use App\Business as Business;
use App\Carrecord as Carrecord;
use App\Vehicleinfo as Vehicleinfo;


trait LatLon{

    public function getDistance($latitudeFrom, $longitudeFrom, $state, $state_short){

        // dd("My latitude:  ".$latitudeFrom." | My Longitude: ".$longitudeFrom);


        // Get Mechanic LAT ANd LON
        $getusers = User::where('userType', 'Auto Care')->where('lon', '!=', "")->where('ref_code', '!=', "")->orWhere('userType', 'Certified Mechanics')->get();

        // Customer Lat and Long
        $latitudeFrom = $latitudeFrom;
        $longitudeFrom = $longitudeFrom;

        if(count($getusers) > 0){
            foreach($getusers as $key => $value){


                    $res = $this->distanceCalc($value->ref_code, $latitudeFrom, $longitudeFrom, $value->lat, $value->lon, $state, $state_short);


                    return $res;

                
            }
        }


        
    }


    public function distanceCalc($ref_code, $latFrom, $longFrom, $latTo, $longTo, $state, $state_short){
        

        //Calculate distance from latitude and longitude
        $theta = $longFrom - $longTo;


        $dist = sin(deg2rad($latFrom)) * sin(deg2rad($latTo)) +  cos(deg2rad($latFrom)) * cos(deg2rad($latTo)) * cos(deg2rad($theta));
        

        $dist = acos($dist);

        $dist = rad2deg($dist);


        $miles = $dist * 60 * 1.1515;

        


        $distance = round($miles * 1.609344, 2);
        
        // dd($distance);

        if($distance <= 10000){
            // Get Mechanics
            $data = User::distinct('email')->select(DB::raw('id, busID as station_id, name, station_name as companyName, email, phone_number as phoneNumber, address, city, state, specialization, image as imageUrl, zipcode as zipCode, lon as longitude, lat as latitude'))->where('userType', '!=', 'Individual')->where('state', $state)->where('lon', '!=', NULL)->where('email', '!=', NULL)->orWhere('state', $state_short)->where('ref_code', '!=', NULL)->where('lat', '!=', NULL)->get();



            return $data;
        }
        else{
            return array();
        }

    }



    

}

