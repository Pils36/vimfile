<?php

namespace App\Http\Controllers;

use Analytics;
use Spatie\Analytics\Period;

//Session
use Session;

// Paystack
use Paystack;
//Mail

use DateTime;

use Excel;

use Rap2hpoutre\FastExcel\FastExcel;


use Socialite;

use App\Mail\sendEmail;

use Storage;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;

use Illuminate\Routing\Redirector;

use Carbon\Carbon;

use App\User as User;

use App\Vehicleinfo as Vehicleinfo;

use App\Business as Business;

use App\Carrecord as Carrecord;

use App\Stations as Stations;

use App\reminderNotify as reminderNotify;

use App\BookAppointment as BookAppointment;

use App\Contactus as Contactus;

use App\Activity as Activity;

use App\PayPlan as PayPlan;

use App\OneSignal as OneSignal;

use App\PriceCurrency as PriceCurrency;

use App\CommercialRec as CommercialRec;

use App\PasswordReset as PasswordReset;

use App\RevenueReport as RevenueReport;

use App\PostEarns as PostEarns;

use App\AskExpert as AskExpert;

use App\AnsFromExpert as AnsFromExpert;

use App\VehicleLogs as VehicleLogs;

use App\Points as Points;

use App\GoogleImport as GoogleImport;

use App\Estimate as Estimate;

use App\LabourInventory as LabourInventory;

use App\MaterialInventory as MaterialInventory;

use App\ReceivePayment as ReceivePayment;

use App\Addpart as Addpart;

use App\MaterialInventoryRecord as MaterialInventoryRecord;

use App\PurchaseOrder as PurchaseOrder;

use App\CreateVendor as CreateVendor;

use App\CreateInventoryItem as CreateInventoryItem;

use App\PurchaseOrderPayment as PurchaseOrderPayment;

use App\CreateCategory as CreateCategory;

use App\ManageLabour as ManageLabour;

use App\ManageLabourCategory as ManageLabourCategory;

use App\ManageTimeSheet as ManageTimeSheet;

use App\AddLabour as AddLabour;

use App\PaySchedule as PaySchedule;

use App\LabourPaystub as LabourPaystub;

use App\Ticketing as Ticketing;

use App\RedeemPoints as RedeemPoints;

use App\OpportunityPost as OpportunityPost;

use App\PrepareEstimate as PrepareEstimate;

use App\EstimatePay as EstimatePay;

use App\Review as Review;

use App\Achievement as Achievement;

use App\InstorePayment as InstorePayment;

use App\Newshappening as Newshappening;

use App\Newsletter as Newsletter;

class TriplogController extends Controller
{

	public $action;
	public $url;
	public $curl_data;
    

	public function apiTripLog(Request $req){
		$this->action = $req->action;
		$carrecord = Carrecord::where('vehicle_reg_no', $req->licence)->get();

		if(count($carrecord) > 0){
			// Get User Infomation

		$client = DB::table('carrecord')
                ->join('users', 'users.email', '=', 'carrecord.email')
                ->where('carrecord.email', '=', $carrecord[0]->email)->groupBy('users.email')->get();

        $user = explode(" ", $client[0]->name);

                switch ($this->action) {
				case 'create_user':
					$this->url = "https://triplogmileage.com/web/api/users";

					$this->curl_data = array(
				        'firstName' => $user[0],
				        'lastName' => $user[1],
				        'email' => $client[0]->email,
				        'password' => null,
				        'phone' => $client[0]->phone_number,
				        'dept' => $client[0]->userType,
		                'isAdmin' => false,
		                'isMasterAdmin' => false,
		                'isDriver' => true,
		                'isAccountant' => false,
		                'locked' => false,
		                'disabled' => false,
		                'supervisorId' => null,
		                'dailyMileageExemption' => null,
		                'exemptionOnlyWeekdays' => true,
		                'territory' => null,
				    );

					break;

				case 'state_mileage':
					# code...
					break;

				case 'locations':
					# code...
					break;

				case 'user_current_location':
					# code...
					break;
				
				default:
					$resData = ['res' => 'Unable to send API request', 'message' => 'error'];
					break;
			}

			$resData = ['res' => 'Fetching data...', 'message' => 'success', 'action' => $this->action];
		}
		else{
			$resData = ['res' => 'Data does not exist', 'message' => 'error'];
		}

		// return($this->curl_data);
        $resp = $this->doCurl();

        // dd($resp);

        return $this->returnJSON($resData);

	}

// Mr Segun's API
// 351fa17c80cd4a729b1f9abe8f8a10c0

	// My personal API
	// 66b1c215efa547f6a54690ad6c5e303e


    // TripLOG CURL
    public function doCurl(){
        $curl = curl_init();
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: apikey 66b1c215efa547f6a54690ad6c5e303e';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';

		curl_setopt_array($curl, array(
			CURLOPT_HTTPHEADER => $headers,
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => $this->url,
		    CURLOPT_USERAGENT => 'Triplog cURL Request',
		    CURLOPT_POST => 1,
		    CURLOPT_POSTFIELDS => $this->curl_data
        ));

	        

		// Send the request & save response to $resp
        $resp = curl_exec($curl);

		// Close request to clear up some resources
        curl_close($curl);

        dd($resp);
        return json_decode($resp);


		// exit();
    }


    public function returnJSON($data){
        return response()->json($data);
    }
}

