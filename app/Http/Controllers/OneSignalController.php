<?php

/*
    Vehicle Inspection and Maintenance Pro-Filr
     By: Adenuga Adebambo [- Pils36 -]
     Created: Monday 12 - 08 - 2019

     Time: 08:00AM
*/ 

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\User as User;

use App\OneSignal as OneSignal;

use App\OneSignalAuto as OneSignalAuto;

use App\Vehicleinfo as Vehicleinfo;

use App\Business as Business;

use App\Carrecord as Carrecord;

use App\Stations as Stations;

use App\reminderNotify as reminderNotify;

use App\BookAppointment as BookAppointment;

use App\Contactus as Contactus;

use App\Activity as Activity;

use App\PayPlan as PayPlan;

use App\PasswordReset as PasswordReset;

use Analytics;
use Spatie\Analytics\Period;

//Session
use Session;

// Paystack
use Paystack;
//Mail

use DateTime;

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


class OneSignalController extends Controller
{


    private $image;
    private $platform_url;

    public function sendMessage(Request $req) {

        // Get Notifications from Onesignal Table and Populate the latest record

        $onesignal = OneSignal::orderBy('created_at', 'DESC')->take(1)->get();

        if(count($onesignal) > 0 && $onesignal[0]->state == 1){
            $heads = $onesignal[0]->heading;
            $notyContent = $onesignal[0]->content;

            if($onesignal[0]->category == "Record Maintenance"){
                $this->image = "https://media.ed.edmunds-media.com/non-make/fe/fe_320171_1600.jpg";
                $this->platform_url = "https://vimfile.com/userDashboard";

            }
            elseif ($onesignal[0]->category == "Record Vehicle") {
                $this->image = "http://chilliwackproautocare.com/wp-content/uploads/2014/01/maintenance.jpg";
                $this->platform_url = "https://vimfile.com/userDashboard";
            }

            elseif ($onesignal[0]->category == "Ask Expert") {
                $this->image = "https://www.dealerinstitute.org/wp-content/uploads/sites/2/2017/08/AskTheExpet-logo.jpg";
                $this->platform_url = "https://vimfile.com/userDashboard";
            }
            
            elseif ($onesignal[0]->category == "Answer From Expert") {
                $this->image = "https://www.dealerinstitute.org/wp-content/uploads/sites/2/2017/08/AskTheExpet-logo.jpg";
                $this->platform_url = "https://vimfile.com/userDashboard";
            }

            $content = array(
                "en" => $notyContent
            );
            
            $headings = array(
                "en" => $heads
            );
            $hashes_array = array();
            array_push($hashes_array, array(
                "id" => "like-button",
                "text" => "Like",
                "icon" => "https://img.icons8.com/dusk/64/000000/facebook-like.png",
                "url" => $this->platform_url
            ));

            $fields = array(
                // MAIN APP_ID
                'app_id' => "fd30d3b9-c1a5-4807-97d9-6c6ec1639c31",
    
                // LOCAL APP_ID
                // 'app_id' => "74f2c616-ae4a-4052-808a-6435dfea4861",
                'included_segments' => array(
                    'All'
                ),
                'data' => array(
                    "foo" => "bar"
                ),
                'contents' => $content,
                'headings' => $headings,
                "url" => $this->platform_url,
                'chrome_web_image' => $this->image,
                'web_buttons' => $hashes_array
            );
            
            $fields = json_encode($fields);
            print("\nJSON sent:\n");
            print($fields);

            $this->updateNoty($onesignal[0]->id);
    
            // MAIN REST_API ID
            // Y2NiNWRjNWQtZTVjNy00ODI0LWJmMDktNjhmZDlhMGQ5ZjVk
            
            $this->curlData($fields);

            
            
        }

        
    }

    public function newNotifications(Request $req) {

        // Get Notifications from Onesignal Table and Populate the latest record

        $newSignals = OneSignalAuto::inRandomOrder()->get();            

        if(count($newSignals) > 0 && $newSignals[0]->state == 1){


            $headz = $newSignals[0]->heading;
            $notyContentz = $newSignals[0]->content;

            $contentz = array(
                "en" => $notyContentz
            );
            
            $headingz = array(
                "en" => $headz
            );
            $hashes_arrayz = array();
            array_push($hashes_arrayz, array(
                "id" => "like-button",
                "text" => "Like",
                "icon" => "https://img.icons8.com/dusk/64/000000/facebook-like.png",
                "url" => "https://vimfile.com/userDashboard"
            ));

            $fieldz = array(
                // Production APP_ID
                'app_id' => "fd30d3b9-c1a5-4807-97d9-6c6ec1639c31",
    
                // Development APP_ID
                // 'app_id' => "74f2c616-ae4a-4052-808a-6435dfea4861",
                'included_segments' => array(
                    'All'
                ),
                'data' => array(
                    "foo" => "bar"
                ),
                'contents' => $contentz,
                'headings' => $headingz,
                'url' => 'https://vimfile.com/register',
                'web_buttons' => $hashes_arrayz
            );
            
            $fieldz = json_encode($fieldz);
            print("\nJSON sent:\n");
            print($fieldz);

            $this->updateNoty($newSignals[0]->id);
    
            // MAIN REST_API ID
            // Y2NiNWRjNWQtZTVjNy00ODI0LWJmMDktNjhmZDlhMGQ5ZjVk
                $this->curlData($fieldz);
            
            
            
            
        }

        
    }
    
    public function response(){
        
        $response = sendMessage();
        $return["allresponses"] = $response;
        $return = json_encode($return);
        
        $data = json_decode($response, true);
        print_r($data);
        $id = $data['id'];
        print_r($id);
        
        print("\n\nJSON received:\n");
        print($return);
        print("\n");
    }

    public function curlData($data){
        $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Authorization: Basic Y2NiNWRjNWQtZTVjNy00ODI0LWJmMDktNjhmZDlhMGQ5ZjVk'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            
            $response = curl_exec($ch);
            curl_close($ch);
            
            return $response;
    }

    public function updateNoty($id){
        // Updates Table
        OneSignal::where('id', $id)->update(['state' => 0]);
        OneSignalAuto::where('id', $id)->update(['state' => 1]);
    }
}
