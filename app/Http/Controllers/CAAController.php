<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CAA as CAA;
use App\Business as Business;
use App\SuggestedMechanics as SuggestedMechanics;

class CAAController extends Controller
{
    public function index(Request $req){
        $getbusiness = Business::all();

        if(count($getbusiness) > 0){


            foreach($getbusiness as $key => $value){
                $company = $value->name_of_company;



                $getCAA = CAA::where('name_of_company', '!=', $company)->get();



                if(count($getCAA) > 0){

                    // Insert
                    if($getCAA[0]->email != ""){
                        $ins = Business::insert(["city" => $getCAA[0]->city, "name_of_company"=> $getCAA[0]->name_of_company, "address"=> $getCAA[0]->address, "telephone"=> $getCAA[0]->telephone, "email"=> $getCAA[0]->email, "zipcode"=> $getCAA[0]->zipcode, "state"=> $getCAA[0]->state]);

                        if($ins = true){
                            // Delete
                            CAA::where("name_of_company", $getCAA[0]->name_of_company)->delete();
                        }
                    }
                    else{
                        // Suggested Mechanics
                       $ins = SuggestedMechanics::insert(["city" => $getCAA[0]->city, "station_name"=> $getCAA[0]->name_of_company, "address"=> $getCAA[0]->address, "telephone"=> $getCAA[0]->telephone, "zipcode"=> $getCAA[0]->zipcode, "state"=> $getCAA[0]->state]);

                       if($ins = true){
                            // Delete
                            CAA::where("name_of_company", $getCAA[0]->name_of_company)->delete();
                        }

                    }

                }
                else{

                    // Delete from list
                    // CAA::where("name_of_company", $getCAA[0]->name_of_company)->delete();
                }

            }

            echo "Done";
        }
    }
}
