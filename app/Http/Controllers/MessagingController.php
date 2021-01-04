<?php

namespace App\Http\Controllers;

/*
  Vehicle Inspection and Maintenance Pro-Filr
   By: Adenuga Adebambo [- Pils36 -]
   Created: Monday 12 - 08 - 2019

   Time: 08:00AM
*/ 


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

class MessagingController extends Controller
{


    private $valid = 0;
    private $platform = "48cff60d45be26b6c4982d7c416175a8";
    private $useragent = "Profilr cURL Request";
    private $userid = "";
    private $level = "";
    private $userrole = "";
    private $username = "";

    public function __construct(Request $req){
      // dd($req->all());
      // dd($_SERVER['DOCUMENT_ROOT']);
        $this->gettrust($req);
    }

    public function index(Request $req){
    // return $this->returnJSON($req->all());
    if($this->valid != 0)
    {
        //Proceed
        switch($req->action){
            case 'fetch_all':
                return $this->returnJSON($this->getUser($req->level, $req->userrole, $req->username));
            break;                
            
            case 'validateimage':
                return $this->returnJSON(array('validateimage' => $this->validateImage($req->image)));
            break;    
            
            case 'connection':
                return $this->returnJSON($this->getConnections($req->userrole));
            break;    
            
            case 'get_profile':
                return $this->returnJSON(array($this->getProfile($req->getuserId, $req->userrole)));
            break;

            case 'chat_with':
                return $this->returnJSON(array($this->getRepresentative($req->identity)));
            break;
            
            default:
                return $this->returnJSON($req->all());
                break;
        }
    }
    else{
        //Terminate
        $this->returnJSON(array('err', 'Failed to connect'));
        }
    }

    // //Verify platform originator and domain
    public function gettrust($platform){
        $useragent = $platform->headers->all()['user-agent'][0];
        $theplatform = $platform['platform'];

        if($theplatform == $this->platform && $useragent == $this->useragent)
        {
            $this->valid = 1;
            $this->userid = $platform['userid'];
        }
        else{
            $this->valid = 0;
        }
    }

    public function getUser($level, $userrole, $username){

        if($level == "Individual"){
          
          return User::select('ref_code As user_id', 'name As firstname', 'name As lastname', 'station_name As company', 'userType As profession', 'city', 'state As cstate', 'country', 'email', 'phone_number As phone', 'image', 'userType As level', 'userType As userrole', 'username')->where('userType', 'Individual')->where('ref_code', $this->userid)->get();
        }
        elseif($level == "Commercial"){
          return User::select('ref_code As user_id', 'name As firstname', 'name As lastname', 'station_name As company', 'userType As profession', 'city', 'state As cstate', 'country', 'email', 'phone_number As phone', 'image', 'userType As level', 'userType As userrole', 'username')->where('userType', 'Commercial')->where('ref_code', $this->userid)->get();
        }
        elseif($level == "Business"){

          return User::select('ref_code As user_id', 'name As firstname', 'name As lastname', 'station_name As company', 'userType As profession', 'city', 'state As cstate', 'country', 'email', 'phone_number As phone', 'image', 'userType As level', 'userType As userrole', 'username')->where('userType', 'Business')->where('ref_code', $this->userid)->get();
        }
        elseif($level == "Auto Care"){

          return User::select('ref_code As user_id', 'name As firstname', 'name As lastname', 'station_name As company', 'userType As profession', 'city', 'state As cstate', 'country', 'email', 'phone_number As phone', 'image', 'userType As level', 'userType As userrole', 'username')->where('userType', 'Auto Care')->where('ref_code', $this->userid)->get();
        }
        elseif($level == "Certified Professional"){

          return User::select('ref_code As user_id', 'name As firstname', 'name As lastname', 'station_name As company', 'userType As profession', 'city', 'state As cstate', 'country', 'email', 'phone_number As phone', 'image', 'userType As level', 'userType As userrole', 'username')->where('userType', 'Certified Professional')->where('ref_code', $this->userid)->get();
        }
        elseif($level == "Auto Dealer"){

          return User::select('ref_code As user_id', 'name As firstname', 'name As lastname', 'station_name As company', 'userType As profession', 'city', 'state As cstate', 'country', 'email', 'phone_number As phone', 'image', 'userType As level', 'userType As userrole', 'username')->where('userType', 'Auto Dealer')->where('ref_code', $this->userid)->get();
        }
        

    }

    public function getConnections($role){
        //Get this user's information
        // return $role;
        // dd($role);
      switch ($role) {
        case 'Individual':
          //Individual has connection of Business and Auto Care including Staff

           $busclients = User::select('ref_code As login_id','name As firstname', 'name As lastname','email','image As photo', 'userType As level', 'station_name As company', 'city', 'country','userType As profession', 'state As cstate', 'phone_number', 'userType As userrole', 'username')->where('userType', 'Certified Professional')->get();

          $autocarelients =  User::select('ref_code As login_id','name As firstname', 'name As lastname','email','image As photo', 'userType As level', 'station_name As company', 'city', 'country','userType As profession', 'state As cstate', 'phone_number', 'userType As userrole', 'username')->where('userType', 'Auto Care')->get();

          return $obj = array_merge($busclients->toArray(), $autocarelients->toArray());
                    
          break;

        case 'Commercial':
          //Commercial has connection of Business and Auto Care including Staff
          $bususerclients = User::select('ref_code As login_id','name As firstname', 'name As lastname','email','image As photo', 'userType As level', 'station_name As company', 'city', 'country','userType As profession', 'state As cstate', 'phone_number', 'userType As userrole', 'username')->where('userType', 'Certified Professional')->get();

          $autousercarelients =  User::select('ref_code As login_id','name As firstname', 'name As lastname','email','image As photo', 'userType As level', 'station_name As company', 'city', 'country','userType As profession', 'state As cstate', 'phone_number', 'userType As userrole', 'username')->where('userType', 'Auto Care')->get();

          return $obj = array_merge($bususerclients->toArray(), $autousercarelients->toArray());
          break;

          case 'Auto Dealer':
          //Commercial has connection of Business and Auto Care including Staff
          $bususerclients = User::select('ref_code As login_id','name As firstname', 'name As lastname','email','image As photo', 'userType As level', 'station_name As company', 'city', 'country','userType As profession', 'state As cstate', 'phone_number', 'userType As userrole', 'username')->where('userType', 'Certified Professional')->get();

          $autousercarelients =  User::select('ref_code As login_id','name As firstname', 'name As lastname','email','image As photo', 'userType As level', 'station_name As company', 'city', 'country','userType As profession', 'state As cstate', 'phone_number', 'userType As userrole', 'username')->where('userType', 'Auto Care')->get();

          return $obj = array_merge($bususerclients->toArray(), $autousercarelients->toArray());
          break;

        case 'Business':
          //Business has connection of Individual & Commercial

        $induserclients = User::select('ref_code As login_id','name As firstname', 'name As lastname','email','image As photo', 'userType As level', 'station_name As company', 'city', 'country','userType As profession', 'state As cstate', 'phone_number', 'userType As userrole', 'username')->where('userType', 'Certified Professional')->get();

          $comcarelients =  User::select('ref_code As login_id','name As firstname', 'name As lastname','email','image As photo', 'userType As level', 'station_name As company', 'city', 'country','userType As profession', 'state As cstate', 'phone_number', 'userType As userrole', 'username')->where('userType', 'Auto Care')->get();

          return $obj = array_merge($induserclients->toArray(), $comcarelients->toArray());

          break;

          case 'Certified Professional':
          //Business has connection of Individual & Commercial

        $induserclients = User::select('ref_code As login_id','name As firstname', 'name As lastname','email','image As photo', 'userType As level', 'station_name As company', 'city', 'country','userType As profession', 'state As cstate', 'phone_number', 'userType As userrole', 'username')->where('userType', 'Individual')->get();

          $comcarelients =  User::select('ref_code As login_id','name As firstname', 'name As lastname','email','image As photo', 'userType As level', 'station_name As company', 'city', 'country','userType As profession', 'state As cstate', 'phone_number', 'userType As userrole', 'username')->where('userType', 'Business')->get();

          return $obj = array_merge($induserclients->toArray(), $comcarelients->toArray());

          break;

        case 'Auto Care':
          //Auto Care has connection of Individual & Commercial
        $indusersclients = User::select('ref_code As login_id','name As firstname', 'name As lastname','email','image As photo', 'userType As level', 'station_name As company', 'city', 'country','userType As profession', 'state As cstate', 'phone_number', 'userType As userrole', 'username')->where('userType', 'Individual')->get();

          $comcareslients =  User::select('ref_code As login_id','name As firstname', 'name As lastname','email','image As photo', 'userType As level', 'station_name As company', 'city', 'country','userType As profession', 'state As cstate', 'phone_number', 'userType As userrole', 'username')->where('userType', 'Business')->get();

          return $obj = array_merge($indusersclients->toArray(), $comcareslients->toArray());

          break;

        default:
          break;
      }
      
    }

    public function validateImage($image){

        if(file_exists($_SERVER['DOCUMENT_ROOT']."/img/icon/vimlogo.png")){
            return 1;
        }else{
            return 0;
        }
    } 

    public function getProfile($user, $role){
        //Get user's profile information
        switch ($role) {
          case 'Individual':
          return User::select('name As firstname', 'email', 'image', 'userType As position', 'userType As profession')->where('id', $user)->where('userType', 'Individual')->get()[0];

            break;

          case 'Business':
           return User::select('name As firstname', 'email', 'image', 'userType As position', 'userType As profession')->where('id', $user)->where('userType', 'Business')->get()[0];
            break;

          case 'Commercial':
            return User::select('name As firstname', 'email', 'image', 'userType As position', 'userType As profession')->where('id', $user)->where('userType', 'Commercial')->get()[0];
            break;

          case 'Auto Dealer':
            return User::select('name As firstname', 'email', 'image', 'userType As position', 'userType As profession')->where('id', $user)->where('userType', 'Auto Dealer')->get()[0];
            break;

          case 'Auto Care':
            return User::select('name As firstname', 'email', 'image', 'userType As position', 'userType As profession')->where('id', $user)->where('userType', 'Auto Care')->get()[0];
            break;

          case 'Certified Professional':
            return User::select('name As firstname', 'email', 'image', 'userType As position', 'userType As profession')->where('id', $user)->where('userType', 'Certified Professional')->get()[0];
            break;
          
          default:
            # code...
            break;
        }
        // return Personal_detail::select('city', 'company', 'country', 'email', 'firstname', 'lastname', 'image', 'position', 'profession')->where('user_id', $user)->get()[0];
    }


    public function getRepresentative($identity){

      // Check if station exist
      $station = Stations::where('station_name', $identity)->get();

      if(count($station) > 0){
        // Check Staff from user table

        
        
        return User::select('ref_code As login_id','name As firstname', 'name As lastname','email','image As photo', 'userType As level', 'station_name As company', 'city', 'country','userType As profession', 'state As cstate', 'phone_number', 'userType As userrole', 'username')->where('station_name', $station[0]->station_name)->get();
      }
      else{
        // Goto User Table
        $userInfo = User::where('station_name', $identity)->get();

        if(count($userInfo) > 0){
          return User::select('ref_code As login_id','name As firstname', 'name As lastname','email','image As photo', 'userType As level', 'station_name As company', 'city', 'country','userType As profession', 'state As cstate', 'phone_number', 'userType As userrole', 'username')->where('station_name', $userInfo[0]->station_name)->get();
        }
        else{
          return "No representative to chat with";
        }
      }


    }
    
   public function returnJSON($data){
      return response()->json($data);
    }





   //   public function sendToApi($url, $data){
   //      $curl = curl_init();

   //      curl_setopt_array($curl, array(
   //          CURLOPT_RETURNTRANSFER => 1,
   //          CURLOPT_URL => $url,
   //          CURLOPT_USERAGENT => 'Pro-EXECUTES Application',
   //          CURLOPT_POST => 1,
   //          CURLOPT_POSTFIELDS => $data
   //      ));

   //      $response = curl_exec($curl);
   //      $err = curl_error($curl);
   //      curl_close($curl);

   //      if ($err) {
   //          echo "cURL Error #:" . $err;
   //          $resData = ['res' => 'Thread Exception', 'color' => $this->color, 'title' => 'Error', 'state' => 3];
   //          return $this->returnJSON($resData);
   //      } else {
   //        // return $response;
   //          $data = json_decode($response);
   //          // return $data[0]->status;
   //          return $this->returnJSON($data[0]);
   //      }
   // } 

}
