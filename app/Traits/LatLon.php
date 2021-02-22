<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

use Session;

use App\User as User;
use App\Business as Business;
use App\Carrecord as Carrecord;
use App\Vehicleinfo as Vehicleinfo;
use App\SuggestedMechanics as SuggestedMechanics;


trait LatLon{

    public function getDistance($latitudeFrom, $longitudeFrom, $state, $state_short){

        // dd("My latitude: ".$latitudeFrom." | My Longitude: ".$longitudeFrom);


        // Get Mechanic LAT ANd LON
        $getusers = User::where('userType', 'Auto Care')->where('lon', '!=', "")->where('ref_code', '!=', "")->orWhere('userType', 'Certified Mechanics')->get();
        
        $suggested = SuggestedMechanics::where('lon', '!=', NULL)->orWhere('lat', '!=', NULL)->get();
        
        
        
        
        $data = array_merge($getusers->toArray(), $suggested->toArray());
        
        
        

        // Customer Lat and Long
        $latitudeFrom = $latitudeFrom;
        $longitudeFrom = $longitudeFrom;

        if(count($data) > 0){
            foreach($data as $key => $value){
                    
                    if(isset($value->lat) || isset($value->lon)){
                        
                        
                        
                        $res = $this->distanceCalc($latitudeFrom, $longitudeFrom, $value->lat, $value->lon, $state, $state_short);
                    


                        
                    }
                    else{
                        $res = $this->distanceCalc($latitudeFrom, $longitudeFrom, $latitudeFrom, $longitudeFrom, $state, $state_short);
                    }
    
                    

                return $res;
            }
        }


        
    }


    public function distanceCalc($latFrom, $longFrom, $latTo, $longTo, $state, $state_short){
        
        
        

        //Calculate distance from latitude and longitude
        $theta = $longFrom - $longTo;


        $dist = sin(deg2rad($latFrom)) * sin(deg2rad($latTo)) +  cos(deg2rad($latFrom)) * cos(deg2rad($latTo)) * cos(deg2rad($theta));
        

        $dist = acos($dist);

        $dist = rad2deg($dist);


        $miles = $dist * 60 * 1.1515;

        


        $distance = round($miles * 1.609344, 2);
        

        if($distance <= 3000){
            // Get Mechanics
            
            
            $users =  User::distinct('email')->select(DB::raw('users.id, users.busID as station_id, users.name, station_name as stationName, users.email, users.phone_number as phoneNumber, users.address, users.city, users.state, users.specialization, users.image as imageUrl, users.zipcode as zipCode, users.lon as longitude, users.lat as latitude, business.name_of_company as companyName'))->join('business', 'users.busID', '=', 'business.busID')->where('users.userType', '!=', 'Individual')->where('users.state', $state)->where('users.lon', '!=', NULL)->where('users.email', '!=', NULL)->orWhere('users.state', $state_short)->where('users.ref_code', '!=', NULL)->where('users.lat', '!=', NULL)->get();
            
            $suggested = SuggestedMechanics::select('station_name as stationName', 'address', 'telephone as phoneNumber', 'location as city', 'state', 'station_name as companyName', 'lon as longitude', 'lat as latitude')->where('lon', '!=', NULL)->where('lat', '!=', NULL)->where('state', $state)->get();
            
            
            $data = array_merge($users->toArray(), $suggested->toArray());
             


            return $data;
        }
        else{

            return array();
        }

    }



    

}

