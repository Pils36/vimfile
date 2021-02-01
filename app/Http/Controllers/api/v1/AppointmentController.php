<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


use App\Mail\sendEmail;

use App\BookAppointment as BookAppointment;
use App\User as User;
use App\Stations as Stations;
use App\Business as Business;
use App\MinimumDiscount as MinimumDiscount;
use App\clientMinimum as clientMinimum;
use App\BusinessStaffs as BusinessStaffs;

class AppointmentController extends Controller
{

	public $to;
	public $sender;
	public $email;
	public $subject;
	public $message;
	public $date;
	public $service_option;
	public $service_type;
	public $current_mileage;
	public $company;
	public $company_name;
	public $station_address;
	public $ref_code;
	public $discount;

    public function bookAppointment(Request $req){

    	$validator = Validator::make($req->all(), [
             'station_id' => 'required|string',
             'station_name' => 'required|string',
             'subject' => 'required|string',
             'message' => 'required|string',
             'date_of_visit' => 'required|string',
             'service_option' => 'required|string',
             'service_type' => 'required|string',
             'current_mileage' => 'required|string',
        ]);

        if($validator->passes()){

        	$refrence_code = uniqid();
        	// Do insertion
                $insertRecord = BookAppointment::create(['busID'=>$req->station_id, 'ref_code' => $refrence_code, 'station_name' => $req->station_name, 'name' => $req->name, 'email' => $req->email, 'subject' => $req->subject, 'message' => $req->message, 'date_of_visit' => $req->date_of_visit, 'service_option' => $req->service_option, 'service_type' => $req->service_type, 'current_mileage' => $req->current_mileage]);

                if($insertRecord == true){
                	$getReceiver = Stations::where('station_name', 'LIKE', '%'.$req->station_name.'%')->get();

                	// Get discount
                    $getDiscount = MinimumDiscount::where('discount', 'discount')->get();


                    if(count($getReceiver) > 0){
                        $coyName = Business::where('busID', $getReceiver[0]->busID)->get();
                    
                    
                    $businessMail = BusinessStaffs::where('station', $getReceiver[0]->station_name)->get();

                        $this->to = $getReceiver[0]->email;
                        // $this->to = "bambo@vimfile.com";
                        $this->sender = $req->name;
                        $this->email = $req->email;
                        $this->subject = $req->subject;
                        $this->message = $req->message;
                        $this->date = $req->date_of_visit;
                        $this->service_option = $req->service_option;
                        $this->service_type = $req->service_type;
                        $this->current_mileage = $req->current_mileage;
                        $this->company = $req->station_name;
                        $this->company_name = $coyName[0]->name_of_company;
                        $this->station_address = $getReceiver[0]->station_address;
                        $this->ref_code = $refrence_code;
                        $this->discount = $getDiscount[0]->percent;
                    }
                    else{
                        $getReceivers = Business::where('busID', $req->station_id)->get();

                        // Get discount
                        $getDiscount = MinimumDiscount::where('discount', 'discount')->get();

                        if(count($getReceivers) > 0){
                            $getReceivers = Stations::where('busID', $req->station_id)->get();

                            $name_of_company = $getReceiver[0]->name_of_company;

                            $station_address = $getReceivers[0]->station_address;

                        }
                        else{
                            // Get Others
                            $getsReceivers = Stations::where('busID', $req->station_id)->get();

                            $coysName = User::where('busID', $getsReceivers[0]->station_id)->get();

                            $name_of_company = $coysName[0]->station_name;

                            $station_address = $getsReceivers[0]->station_address;

                        }


                        $this->to = $getReceivers[0]->email;
                        // $this->to = "bambo@vimfile.com";
                        $this->sender = $req->name;
                        $this->email = $req->email;
                        $this->subject = $req->subject;
                        $this->message = $req->message;
                        $this->date = $req->date_of_visit;
                        $this->service_option = $req->service_option;
                        $this->service_type = $req->service_type;
                        $this->current_mileage = $req->current_mileage;
                        $this->company = $req->station_name;
                        $this->company_name = $name_of_company;
                        $this->station_address = $station_address;
                        $this->ref_code = $refrence_code;
                        $this->discount = $getDiscount[0]->percent;
                    }
                    
                    // $this->sendEmail($this->to, 'VIM File - A client wants to book an appointment with you');

                    // $this->sendEmail($request->email, 'VIM File - Book an Appointment');


                	$resData = ['data' => $insertRecord, 'message' => 'Successful', 'status' => 200];
                    $status = 200;
                }
                else{
                	$resData = ['data' => [], 'message' => 'Something went wrong!', 'status' => 400];
                    $status = 400;
                }


        	
        }
        else{

            $error = implode(",",$validator->messages()->all());
            

        	$resData = ['data' => [], 'message' => $error, 'status' => 400];
            $status = 400;
        }


        return $this->returnJSON($resData, $status);

    }

    public function appointmentList(Request $req){

        

        if($req->email != ""){
            // Check for my appointments
            $check = BookAppointment::where('email', $req->email)->get();

            if(count($check) > 0){
                
                foreach($check as $key => $value){
                    // Get Client Minimum
                $statInfo = DB::table('book_appointment')
                ->join('users', 'book_appointment.station_name', '=', 'users.station_name')->where('book_appointment.station_name', $value->station_name)
                ->get();
    
                if(count($statInfo) > 0){
                    // Get Client Minimum
                    
                    $minimunRate = clientMinimum::where('busID', $statInfo[0]->busID)->get();
                    
    
                    if(count($minimunRate) > 0){
                        $myRate = $minimunRate[0]->percent;
                    }
                    else{
                        $minimunRate = MinimumDiscount::where('discount', 'discount')->get();
    
                        if(count($minimunRate) > 0){
                            $myRate = $minimunRate[0]->percent;
                        }
                        else{
                            $myRate = 0;
                        }
                    }
                }
                else{
                    $myRate = 0;
                }
    
    
                    $resData = ['data' => $check, 'discount' => $myRate, 'message' => 'Successful', 'status' => 200];
                    $status = 200;
                }

                
            }
            else{
                $resData = ['data' => [], 'message' => "No appointment", 'status' => 400];
                $status = 400;
            }

        }   
        else{
            $resData = ['data' => [], 'message' => "Unauthorized user, kindly login", 'status' => 400];
            $status = 400;
        }     
        

        return $this->returnJSON($resData, $status);
    }

    public function sendEmail($objDemoa, $purpose){
      $objDemo = new \stdClass();
      $objDemo->purpose = $purpose;
    
      if($purpose == "VIM File - A client wants to book an appointment with you"){
        $objDemo->to = $this->to;
        $objDemo->sender = $this->sender;
        $objDemo->email = $this->email;
        $objDemo->subject = $this->subject;
        $objDemo->message = $this->message;
        $objDemo->date = $this->date;
        $objDemo->service_option = $this->service_option;
        $objDemo->service_type = $this->service_type;
        $objDemo->current_mileage = $this->current_mileage;
        $objDemo->company = $this->company;
      }

      elseif($purpose == "VIM File - Book an Appointment"){
        $objDemo->to = $this->to;
        $objDemo->sender = $this->sender;
        $objDemo->ref_code = $this->ref_code;
        $objDemo->subject = $this->subject;
        $objDemo->date = $this->date;
        $objDemo->discount = $this->discount;
        $objDemo->service_option = $this->service_option;
        $objDemo->service_type = $this->service_type;
        $objDemo->current_mileage = $this->current_mileage;
        $objDemo->company = $this->company;
        $objDemo->company_name = $this->company_name;
        $objDemo->station_address = $this->station_address;
      }


      Mail::to($objDemoa)
            ->send(new sendEmail($objDemo));
   }

    public function returnJSON($data, $status){
        return response($data, $status)->header('Content-Type', 'application/json');
    }

}
