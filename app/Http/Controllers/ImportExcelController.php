<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Excel;

use Rap2hpoutre\FastExcel\FastExcel;

use App\Business as Business;

class ImportExcelController extends Controller
{


    public function index(){


        return view('pages.importexcel');
    }

    public function uploadExcel(Request $req){

        if($req->file('file'))
        {
            //Get filename with extension
            $filenameWithExt = $req->file('file')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
            // Get just extension
            $extension = $req->file('file')->getClientOriginalExtension();

            if($extension == "xlsx" || $extension == "xls"){

                $path = $req->file('file')->getRealPath();

                // $data = Excel::import($path)->get();
                $data = (new FastExcel)->import($path);

                if($data->count() > 0){
                    foreach ($data->toArray() as $key) {

                        $getUser = DB::table('users')->where('email', '!=', $key['email'])->get();

                        if(count($getUser) > 0){
                            $insert_data[] = array(
                                'city' => $key['city'],
                                'station_name' => $key['name_of_company'],
                                'address' => $key['address'],
                                'phone_number' => $key['telephone'],
                                'email' => $key['email'],
                                'email1' => $key['email2'],
                                'email2' => $key['email3'],
                                'zipcode' => $key['zipcode'],
                                'state' => $key['state'],
                                'businesslogo' => 'logocaa.png',
                                'country' => 'Canada',
                                'userType' => 'Auto Care',
                            );
                        }
                        else{
                            // Do nothing
                        }

                        // Check the one that exists in business

                        DB::table('business')->where('name_of_company', $key['name_of_company'])->update(['file2' => 'logocaa.png', 'claims' => 1]);

                    }

                    try{
                        if(!empty($insert_data)){

                            DB::table('users')->insert($insert_data);

                            echo "Done";

                            return back()->with('success', 'Successful');
                        }
                    }
                    catch(Exception $e){
                        echo "Error: ".$e;

                        return back()->with('error', "Error: ".$e);
                    }

                    
                }


            }
            else{

                echo "Invalid Excel format";

            }
        }

    }
}
