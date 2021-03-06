<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;



use App\Mail\sendEmail;

use App\Traits\LatLon;

use App\User as User;
use App\Business as Business;
use App\Carrecord as Carrecord;
use App\Vehicleinfo as Vehicleinfo;
use App\Review as Review;
use App\Validateotp as Validateotp;
use App\Points as Points;
use App\Estimate as Estimate;
use App\reminderNotify as reminderNotify;
use App\SuggestedMechanics as SuggestedMechanics;

use DateTime;

class VehicleController extends Controller
{

    use LatLon;

    public $getIp;
    public $getLocation;

    public $arr_ip;
    public $country;
    public $continent;

    public $to;
    public $name;
    public $email;
    public $licence;
    public $from;
    public $content1;
    public $content2;
    public $content3;

    public function __construct(Request $request){

        $this->getIp = $_SERVER['REMOTE_ADDR'];

        $this->arr_ip = geoip()->getLocation($this->getIp);
        // $this->arr_ip = geoip()->getLocation('154.120.86.96');
        // $this->arr_ip = geoip()->getLocation('206.189.30.235');
        // $this->arr_ip = geoip()->getLocation('165.227.36.202');
        // $this->arr_ip = geoip()->getLocation('64.235.200.107');

        $this->country = $this->arr_ip['country'];
        $this->continent = $this->arr_ip['continent'];

        // dd($this->arr_ip);

    }

    public function vehicleregistration(Request $request){

                $validator = Validator::make($request->all(), [
                     'vehicle_reg_no' => 'required|string',
                     'country_of_reg' => 'required|string',
                     'state' => 'required|string',
                     'city' => 'required|string',
                     'zipcode' => 'required|string',
                     'date_added' => 'required|string',
                     'purchase_type' => 'required|string',
                     'year_owned_since' => 'required|string',
                     'current_mileage' => 'required|string',
                     'owners_email' => 'required|string',
                     'owners_telephone' => 'required|string',
                     'vehicle_make' => 'required|string',
                     'vehicle_model' => 'required|string',
                ]);

        if($validator->passes()){

                $carexist = Carrecord::where('vehicle_reg_no', $request->vehicle_reg_no)->get();

                if(count($carexist) > 0){

                    $resData = ['data' => [] , 'message' => 'Vehicle detail already exist', 'status' => 200];
                    $status = 200;

                }
                else{

                                // Check Plans and Registration per month

                                $monthstart = date('Y-m-01');
                                $nextplan = date('Y-m-d', strtotime($monthstart. ' + 28 days'));


                                // Check user Plans

                                $plans = User::where('email', $request->owners_email)->get();



                                if(count($plans) > 0){

                                    switch ($plans[0]->plan) {
                                        case 'Free':
                                                $vehpermnth = 1;
                                            break;

                                        case 'Lite':
                                                $vehpermnth = 4;
                                            break;

                                        case 'Lite-Commercial':
                                                $vehpermnth = 1;
                                            break;

                                        case 'Commercial':
                                                $vehpermnth = 1;
                                            break;

                                        case 'Start Up':
                                                $vehpermnth = 10;
                                            break;

                                        case 'Basic':
                                                $vehpermnth = 20;
                                            break;

                                        case 'Classic':
                                                $vehpermnth = 50;
                                            break;

                                        case 'Super':
                                                $vehpermnth = 10000000000000000;
                                            break;

                                        case 'Sponsored':
                                                $vehpermnth = 50;
                                            break;

                                        default:
                                                $vehpermnth = 1;
                                            break;
                                    }


                                    // Check vehicle record if cars exist
                                    $carspresent = Carrecord::where('email', $request->owners_email)->where('date_added', '>', $nextplan)->get();

                                    if(count($carspresent) > 0){
                                        // Kindly upgrade your plan

                                        if($vehpermnth > count($carspresent)){
                                            $resData = ['data' => 'You have exceeded numbers of vehicle to register this month. Please upgrade your plan','message' => 'You have exceeded numbers of vehicle to register this month. Please upgrade your plan', 'status' => 200];
                                            $status = 200;
                                        }


                                    }
                                    else{
                                        // Insert car record

                                        // Check if has file

                                        if($request->hasFile('vehicle_image')){

                                            //Get filename with extension
                                            $filenameWithExt = $request->file('vehicle_image')->getClientOriginalName();
                                            // Get just filename
                                            $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
                                            // Get just extension
                                            $extension = $request->file('vehicle_image')->getClientOriginalExtension();
                                            // Filename to store
                                            // $fileNameToStore = rand().'_'.time().'.'.$extension;
                                            $filenamestore = rand().'_'.time().'.'.$extension;

                                            $fileNameToStore = "http://".$_SERVER['HTTP_HOST']."/uploads/".$filenamestore;


                                            // $path = $request->file('vehicle_image')->move(public_path('/uploads/'), $filenamestore);

                                            $path = $request->file('vehicle_image')->move(public_path('../../uploads/'), $filenamestore);
                                
                                            
                                
                                        }
                                        else{
                                            $fileNameToStore = 'https://vimfile.com/img/icon/vimlogo.png';
                                        }

                                        $insertRecord =  Carrecord::create([
                                            'vehicle_reg_no' => $request->vehicle_reg_no,
                                            'country_of_reg' => $request->country_of_reg,
                                            'state'=> $request->state,
                                            'city' => $request->city,
                                            'email' => $request->owners_email,
                                            'zipcode' => $request->zipcode,
                                            'date_added' => $request->date_added,
                                            'purchase_type' => $request->purchase_type,
                                            'year_owned_since' => $request->year_owned_since,
                                            'current_mileage' => $request->current_mileage,
                                            'chassis_no' => $request->chassis_no,
                                            'telephone' => $request->owners_telephone,
                                            'make' => $request->vehicle_make,
                                            'model' => $request->vehicle_model,
                                            'location' => $request->city.' '.$request->state,
                                            'vehicle_nickname' => $request->vehicle_make.'_'.$request->vehicle_model,
                                            'file' => $fileNameToStore

                                        ]);

                                    $this->earnYourPoints($plans[0]->name, $plans[0]->email, 10, $plans[0]->state, $plans[0]->country);
                                    $this->notifications($plans[0]->ref_code, 'You just earned 10 point', 'https://i.ya-webdesign.com/images/notification-bell-gif-png-youtube.png');


                                        $resData = ['data' => $insertRecord, 'message' => 'Successful', 'status' => 200];
                                        $status = 200;
                                    }


                                }
                                else{

                                    // Create User Information

                                    // Insert car record

                                    if($request->hasFile('vehicle_image')){

                                        //Get filename with extension
                                        $filenameWithExt = $request->file('vehicle_image')->getClientOriginalName();
                                        // Get just filename
                                        $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
                                        // Get just extension
                                        $extension = $request->file('vehicle_image')->getClientOriginalExtension();
                                        // Filename to store
                                        // $fileNameToStore = rand().'_'.time().'.'.$extension;
                                        $filenamestore = rand().'_'.time().'.'.$extension;

                                        $fileNameToStore = "http://".$_SERVER['HTTP_HOST']."/uploads/".$filenamestore;


                                        // $path = $request->file('vehicle_image')->move(public_path('/uploads/'), $filenamestore);

                                        $path = $request->file('vehicle_image')->move(public_path('../../uploads/'), $filenamestore);
                            
                                        
                            
                                    }
                                    else{
                                        $fileNameToStore = 'https://vimfile.com/img/icon/vimlogo.png';
                                    }

                                    $insertRecord =  Carrecord::create([
                                        'vehicle_reg_no' => $request->vehicle_reg_no,
                                        'country_of_reg' => $request->country_of_reg,
                                        'state'=> $request->state,
                                        'city' => $request->city,
                                        'email' => $request->owners_email,
                                        'zipcode' => $request->zipcode,
                                        'date_added' => $request->date_added,
                                        'purchase_type' => $request->purchase_type,
                                        'year_owned_since' => $request->year_owned_since,
                                        'current_mileage' => $request->current_mileage,
                                        'chassis_no' => $request->chassis_no,
                                        'telephone' => $request->owners_telephone,
                                        'make' => $request->vehicle_make,
                                        'model' => $request->vehicle_model,
                                        'location' => $request->city.' '.$request->state,
                                        'vehicle_nickname' => $request->vehicle_make.'_'.$request->vehicle_model,
                                        'file' => $fileNameToStore

                                    ]);


                                $this->earnYourPoints($plans[0]->name, $plans[0]->email, 10, $plans[0]->state, $plans[0]->country);


                                $this->notifications($plans[0]->ref_code, 'You just earned 10 point', 'https://i.ya-webdesign.com/images/notification-bell-gif-png-youtube.png');

                                    $resData = ['data' => $insertRecord, 'message' => 'Successful', 'status' => 200];
                                    $status = 200;

                                }


                }



                }
                else{

                    $error = implode(",",$validator->messages()->all());

                    // $resData = ['message' => $validator->errors(), 'status' => 400];
                    $resData = ['data' => [], 'message' => $error, 'status' => 400];
                    $status = 400;
                }


        return $this->returnJSON($resData, $status);
    }

    public function updatevehicle(Request $request){

        $carexist = Carrecord::where('vehicle_reg_no', $request->vehicle_reg_no)->get();

        if(count($carexist) > 0){

            if($request->hasFile('vehicle_image')){

                //Get filename with extension
                $filenameWithExt = $request->file('vehicle_image')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
                // Get just extension
                $extension = $request->file('vehicle_image')->getClientOriginalExtension();
                // Filename to store
                // $fileNameToStore = rand().'_'.time().'.'.$extension;
                $filenamestore = rand().'_'.time().'.'.$extension;

                $fileNameToStore = "http://".$_SERVER['HTTP_HOST']."/uploads/".$filenamestore;


                // $path = $request->file('vehicle_image')->move(public_path('/uploads/'), $filenamestore);

                $path = $request->file('vehicle_image')->move(public_path('../../uploads/'), $filenamestore);
    
                Carrecord::where('vehicle_reg_no', $request->vehicle_reg_no)->update(['file' => $fileNameToStore]);
    
            }
            else{
                $fileNameToStore = 'https://vimfile.com/img/icon/vimlogo.png';
            }

            // Update
            $updtRecord =  Carrecord::where('vehicle_reg_no', $request->vehicle_reg_no)->update([
                'country_of_reg' => $request->country_of_reg,
                'state'=> $request->state,
                'city' => $request->city,
                'zipcode' => $request->zipcode,
                'purchase_type' => $request->purchase_type,
                'year_owned_since' => $request->year_owned_since,
                'current_mileage' => $request->current_mileage,
                'chassis_no' => $request->chassis_no,
                'make' => $request->vehicle_make,
                'model' => $request->vehicle_model,
                'vehicle_nickname' => $request->vehicle_nickname,
                'chassis_no' => $request->chassis_no,

            ]);


            $data = Carrecord::where('vehicle_reg_no', $request->vehicle_reg_no)->first();

            $currUser = User::where('api_token', $request->bearerToken())->first();


            $this->earnYourPoints($currUser->name, $currUser->email, 15, $currUser->state, $currUser->country);


            $this->notifications($currUser->ref_code, 'You just earned 15 point', 'https://i.ya-webdesign.com/images/notification-bell-gif-png-youtube.png');


            $resData = ['data' => $data, 'message' => 'Vehicle Information Updated', 'status' => 200];
            $status = 200;

        }
        else{

            $resData = ['data' => [], 'message' => 'Vehicle licence is not associated with your vehicle', 'status' => 400];
            $status = 400;
        }


        return $this->returnJSON($resData, $status);
    }

    // Upload vehicle Image
    public function uploadvehicleImage(Request $request){

        // Get vehicle number
        $validator = Validator::make($request->all(), [
            'vehicle_reg_no' => 'required',
            'vehicle_image' => 'required|file'
        ]);

        $platform = 'others';

        if($validator->passes()){
            // Get Vehicle
            $vehicle = Carrecord::where('vehicle_reg_no', $request->vehicle_reg_no)->get();




            if(count($vehicle) > 0){

                if($request->platform == $platform){

                    $fileNameToStore = $request->vehicle_image;
                }
                else{
                    if($request->file('vehicle_image'))
                    {
                        //Get filename with extension
                        $filenameWithExt = $request->file('vehicle_image')->getClientOriginalName();
                        // Get just filename
                        $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
                        // Get just extension
                        $extension = $request->file('vehicle_image')->getClientOriginalExtension();
                        // Filename to store
                        // $fileNameToStore = rand().'_'.time().'.'.$extension;
                        $filenamestore = rand().'_'.time().'.'.$extension;

                        $fileNameToStore = "http://".$_SERVER['HTTP_HOST']."/uploads/".$filenamestore;


                        // $path = $request->file('vehicle_image')->move(public_path('/uploads/'), $filenamestore);

                        $path = $request->file('vehicle_image')->move(public_path('../../uploads/'), $filenamestore);


                    }
                    else{

                        $fileNameToStore = 'https://vimfile.com/img/icon/vimlogo.png';
                    }
                }



                // update
                $updates = Carrecord::where('vehicle_reg_no', $request->vehicle_reg_no)->update(['file' => $fileNameToStore]);


                if($updates){
                    // Update OTP status = 1
                    $update = Validateotp::where('email', $vehicle[0]->email)->update(['status' => 1]);

                    $getimage = Carrecord::where('vehicle_reg_no', $request->vehicle_reg_no)->get();

                    $resData = ['data' => $getimage[0]->file, 'message' => 'Vehicle Image Saved', 'status' => 200];
                    $status = 200;
                }
                else{
                    $resData = ['data' => [], 'message' => 'Something went wrong', 'status' => 400];
                    $status = 400;
                }

            }
            else{
                $resData = ['data' => [], 'message' => 'Record not found', 'status' => 400];
                $status = 400;
            }
        }
        else{

            $error = implode(",",$validator->messages()->all());

            // $resData = ['message' => $validator->errors(), 'status' => 400];
            $resData = ['data' => [], 'message' => $error, 'status' => 400];
            $status = 400;
        }

        return $this->returnJSON($resData, $status);
    }


    // Get Nearby Mechanics
    public function getnearby(Request $request){

        $data = [];

        // Check for mechanics near me
        if($request->get('city')){

            $category = $request->get('city');


            $searchQuery = trim($category);
            
            $requestData = ['users.city', 'users.state', 'users.country', 'users.station_name', 'users.specialization'];

            $mechanics = User::select(DB::raw('users.id, users.busID as station_id, users.name, station_name as stationName, users.email, users.phone_number as phoneNumber, users.address, users.city, users.state, users.specialization, users.image as imageUrl, users.zipcode as zipCode, users.lon as longitude, users.lat as latitude, business.name_of_company as companyName'))->join('business', 'users.busID', '=', 'business.busID')->where(function($q) use($requestData, $searchQuery) {
                                    foreach ($requestData as $field)
                                    $q->orWhere($field, 'like', "%{$searchQuery}%");
                            })->where('userType', 'Auto Care')->orWhere('userType', 'Certified Professional')->get();


            $suggested = SuggestedMechanics::select('station_name as stationName', 'address', 'city', 'state', 'country', 'telephone as phoneNumber')->where('city', $category)->get();


            $data =  array_merge($mechanics->toArray(), $suggested->toArray());


            if (count($mechanics) > 0 || count($suggested) > 0) {

                // Get User
                $currUser = User::where('api_token', $request->bearerToken())->first();


                $this->earnYourPoints($currUser->name, $currUser->email, 5, $currUser->state, $currUser->country);


                $this->notifications($currUser->ref_code, 'You just earned 5 point', 'https://i.ya-webdesign.com/images/notification-bell-gif-png-youtube.png');

                $resData = ['data' => $data, 'message' => 'success', 'status' => 200];
                        $status = 200;


            } 
            else {
                $resData = ['data' => [], 'message' => 'No mechanics found in your area', 'status' => 400];
                $status = 400;
            }
        }
        elseif($request->get('lat') != null || $request->get('lon') != null){


            $data = $this->getDistance($this->arr_ip->lat, $this->arr_ip->lon, $this->arr_ip['state_name'], $this->arr_ip['state']);


            // Log::info($data);


            if($data != null){
                $resData = ['data' => $data, 'message' => 'success', 'status' => 200];
                $status = 200;
            }
            else{
                $resData = ['data' => [], 'message' => 'No mechanics found in your area', 'status' => 400];
                $status = 400;
            }


        }




        return $this->returnJSON($resData, $status);
    }


    // Get Mechanics by location
    public function getmechanicbyCity(Request $request){
        // Check for mechanics near me

        $data = [];

        $category = $request->get('city');


        $searchQuery = trim($category);
        
        $requestData = ['users.city', 'users.state', 'users.country', 'users.station_name', 'users.specialization'];

        $mechanics = User::select(DB::raw('users.id, users.busID as station_id, users.name, station_name as stationName, users.email, users.phone_number as phoneNumber, users.address, users.city, users.state, users.specialization, users.image as imageUrl, users.zipcode as zipCode, users.lon as longitude, users.lat as latitude, business.name_of_company as companyName'))->join('business', 'users.busID', '=', 'business.busID')->where(function($q) use($requestData, $searchQuery) {
                                foreach ($requestData as $field)
                                $q->orWhere($field, 'like', "%{$searchQuery}%");
                        })->where('userType', 'Auto Care')->orWhere('userType', 'Certified Professional')->get();


        // Get suggested mechanics

        $suggested = SuggestedMechanics::select('station_name as stationName', 'address', 'city', 'state', 'country', 'telephone as phoneNumber')->where('city', $category)->get();
        
        

        $data =  array_merge($mechanics->toArray(), $suggested->toArray());

            

        if (count($mechanics) > 0 || count($suggested) > 0) {
            $resData = ['data' => $data, 'message' => "Success", 'status' => 200];
            $status = 200;
        } 
        else {
            $resData = ['data' => [], 'message' => "No result found", 'status' => 400];
            $status = 400;
        }



        return $this->returnJSON($resData, $status);
    }

    // Maintenance Record
    public function maintenancerecord(Request $request){

        if($request->platform == "others"){
            $fileNameToStore = $request->file;
        }
        else{
            if($request->file('file'))
            {
                //Get filename with extension
                $filenameWithExt = $request->file('file')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
                // Get just extension
                $extension = $request->file('file')->getClientOriginalExtension();
                // Filename to store

                $filenamestore = rand().'_'.time().'.'.$extension;
                $fileNameToStore = "http://".$_SERVER['HTTP_HOST']."/uploads/".$filenamestore;
                //Upload Image
                // $path = $request->file('file')->storeAs('public/uploads', $filenamestore);

                // $path = $request->file('file')->move(public_path('/uploads/'), $filenamestore);

                $path = $request->file('file')->move(public_path('../../uploads/'), $filenamestore);

            }
            else
            {
                $fileNameToStore = 'https://vimfile.com/img/icon/vimlogo.png';
            }
        }

        // Start

        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], $request->name.' added a new Vehicle Maintenance');

        // Insert new record

        $ins = Vehicleinfo::insert(['email' => $request->email, 'telephone' => $request->telephone, 'busID' => $request->busID, 'vehicle_licence' => $request->vehicle_reg_no, 'make' => $request->make, 'model' => $request->model, 'date' => $request->date, 'service_type' => $request->service_type, 'service_option' => $request->service_option, 'service_item_spec' => $request->item_spec1, 'manufacturer' => $request->manufacturer1, 'material_qty' => $request->material_qty1, 'material_cost' => $request->material_cost1, 'labour_qty' => $request->labour_rate1, 'labour_cost' => $request->labour_cost1,'material_qty2' => $request->material_qty2,'material_qty3' => $request->material_qty3,'labour_qty2' => $request->labour_rate2,'material_cost2' => $request->material_cost2,'material_cost3' => $request->material_cost3,'labour_cost2' => $request->labour_cost2, 'manufacturer2' => $request->manufacturer2, 'manufacturer3' => $request->manufacturer3, 'service_item_spec2' => $request->item_spec2, 'service_item_spec3' => $request->item_spec3, 'other_qty' => '', 'other_cost' => $request->other_cost, 'total_cost' => $request->total_cost, 'service_note' => $request->service_note, 'mileage' => $request->mileage, 'file' => $fileNameToStore, 'update_by' => $request->updated_by, 'material_name1' => $request->material_name1, 'material_name2' => $request->material_name2, 'material_name3' => $request->material_name3]);

        if($ins == true){
            if($request->update_by != $request->name){
                        $getname = User::where('email', $request->email)->get();
                        if(count($getname) > 0){
                            $this->name = $getname[0]->name;
                        }
                        else{
                            $this->name = "from VIMFile";
                        }

                        $this->to = $request->email;
                        // $this->to = "info@vimfile.com";
                        $this->from = $request->update_by;
                        $this->licence = $request->vehicle_licence;
                        $this->content1 = 'Service Option: '.$request->service_option;
                        $this->content2 = 'Service Type: '.$request->service_type;
                        $this->content3 = 'Total Cost: '.$request->total_cost;

                        // $this->sendEmail($this->to, 'VIM File - New Maintenace Record');
                    }

                        $this->earnYourPoints($request->name, $request->email, 10, $request->state, $request->country);


                        $this->notifications($request->ref_code, 'You just earned 10 point', 'https://i.ya-webdesign.com/images/notification-bell-gif-png-youtube.png');



                    $resData = ['data' => true, 'message' => "Record Added", 'status' => 200];
                    $status = 200;
        }
        else{
                    $resData = ['data' => [], 'message' => "Something went wrong!", 'status' => 400];
                    $status = 400;
        }

                // End


                return $this->returnJSON($resData, $status);

    }


    public function maintenancerecordlist(Request $request){
        // Check for mechanics near me


        $maintrec = Vehicleinfo::where('email', $request->email)->orderBy('created_at', 'DESC')->get();

        if(count($maintrec) > 0){

            $resData = ['data' => $maintrec, 'message' => "Success", 'status' => 200];
            $status = 200;
        }
        else{

            $resData = ['data' => [], 'message' => "Maintenance record not found", 'status' => 400];
            $status = 400;
        }

        return $this->returnJSON($resData, $status);
    }


    public function mycarrecord(Request $request){


        $validator = Validator::make($request->all(), [
            'vehicle_reg_no' => 'required'
        ]);

        if($validator->passes()){
            $checkcar = Carrecord::where('vehicle_reg_no', $request->vehicle_reg_no)->get();

            if(count($checkcar) > 0){

                $resData = ['data' => $checkcar[0], 'message' => "success", 'status' => 200];
                $status = 200;
            }
            else{
                $resData = ['data' => [], 'message' => "Car record not found", 'status' => 400];
                $status = 400;
            }
        }
        else{
            $resData = ['data' => [], 'message' => "Vehicle licence cannot be empty", 'status' => 400];
            $status = 400;
        }


        return $this->returnJSON($resData, $status);
    }


    

    public function myRequestBy(Request $request){

        if($request->request_by == "all"){
            $getmechcount = User::where('userType', 'Auto Care')->get();
        }
        else{
            $getmechcount = User::where('userType', 'Auto Care')->where('city', 'LIKE', '%'.$request->request_by.'%')->get();
            if(count($getmechcount) > 0){

            }
            else{
                $getmechcount = User::where('userType', 'Auto Care')->where('zipcode', 'LIKE', '%'.$request->request_by.'%')->get();
            }

        }

        if(count($getmechcount) > 0){

            $resData = ['data' => count($getmechcount), 'message' => "success", 'status' => 200];
            $status = 200;
        }
        else{
            $resData = ['data' => [], 'message' => "No mechanic found within the request location", 'status' => 400];
            $status = 400;
        }

        return $this->returnJSON($resData, $status);
    }



    // My Performance

    public function myperformance(Request $request){

            // Get vehicle record
           $getVehicle = Vehicleinfo::select(DB::raw('estimate_id, opportunity_id, email, telephone, busID, vehicle_licence, date, service_type, make, model, service_option, total_cost, service_note, mileage, created_at'))->where('vehicle_licence', $request->vehicle_reg_no)->where('service_type', 'LIKE', '%'.$request->service_type.'%')->orderBy('created_at', 'DESC')->get();

           if(count($getVehicle) > 0){

            // Get carrecord
            $carrecord = Carrecord::where('vehicle_reg_no', $request->vehicle_reg_no)->get();
            $user = User::select(DB::raw('id, name, email, avatar as imageUrl'))->where('email', $carrecord[0]->email)->get();
            

                $previous = Vehicleinfo::where('email', $carrecord[0]->email)->max('mileage');
                // get next user mileage
                $next = Vehicleinfo::where('email', $carrecord[0]->email)->min('mileage');

                $totmiles = $previous - $next;

                $from = date('Y-m-01', strtotime($request->created_at));
                $to = date('Y-m-d');

                $milespermonth = Vehicleinfo::where('email', $carrecord[0]->email)->whereBetween('created_at', [$from, $to])->get('mileage');

                $maintenancepermonth = Vehicleinfo::where('email', $carrecord[0]->email)->whereBetween('created_at', [$from, $to])->get('total_cost');

                // Tot Maint cost
                $totalmaintenancecost = Vehicleinfo::where('email', $carrecord[0]->email)->sum('total_cost');


                $first = date('Y-m-d', strtotime($carrecord[0]->created_at));

                $end = date('Y-m-d', strtotime($getVehicle[0]->created_at));
                $d1 = new DateTime($first);
                $d2 = new DateTime($end);
                $mDiff = $d1->diff($d2)->m;


                if($mDiff < 1){
                    $avg = 0;

                $results =$avg;

                }
                elseif($mDiff > 1){

                    $avg = $totmiles / $mDiff;

                    $results =round($avg, 0);
                }

                $today = date('Y-m-d H:i:s');
                $first = date('Y-m-d', strtotime($user[0]->created_at));

                $end = date('Y-m-d', strtotime($today));
                $d1 = new DateTime($first);
                $d2 = new DateTime($end);
                $mDiff = $d1->diff($d2)->m;

                if($mDiff < 1){
                $avg = 0;

                $res =$avg;

                }
                elseif($mDiff > 1){

                    $avg = $totalmaintenancecost / $mDiff;

                    $res =round($avg, 0);

                }


                $mileagedifference = $getVehicle[0]->mileage - $carrecord[0]->current_mileage;

                $today = date('Y-m-d H:i:s');
                $datetime1 = strtotime($getVehicle[0]->created_at);
                $datetime2 = strtotime($today);

                $secs = $datetime2 - $datetime1;// == <seconds between the two times>
                $daysago = $secs / 86400;

                /*
            
                Things needed as return for Performance

                => Name
                => Image URL
                => Maintenance per month
                => Miles per month
                => Total Miles
                => Total maintenance cost
            
            */ 


                // $resData = ['data' => array('performance' => array('user' => $user,'totalmiles' => $totmiles, 'totalmaintenancecost' => $totalmaintenancecost, 'milespermonth' => $milespermonth[0]->mileage, 'maintenancepermonth' => $maintenancepermonth[0]->total_cost, 'averagemaintenancecost' => $results, 'averagemiles' => $res, 'mileagedifference' => $mileagedifference, 'daysago' => $getVehicle[0]->created_at->diffForHumans()), 'ivim' => $getVehicle) ,'message' => "success", 'status' => 200, 'action' => 'performance'];

                $resData = ['data' => array('name' => $user[0]->name, 'imageUrl' => array($carrecord[0]->file), 'maintenancePerMonth' => $maintenancepermonth[0]->total_cost, 'milesPerMonth' => $milespermonth[0]->mileage, 'totalMiles' => $totmiles, 'totalMaintenanceCost' => number_format($totalmaintenancecost, 2), 'licenseNumber' => $getVehicle[0]->vehicle_licence, 'chassisNumber' => $carrecord[0]->chassis_no, 'currentMileage' => $carrecord[0]->current_mileage), 'message' => "success", 'status' => 200];

                    $status = 200;
           }
           else{
                $resData = ['data' => [], 'message' => "You do not have the performance record on the selected service type", 'status' => 400];
                    $status = 400;
           }

            return $this->returnJSON($resData, $status);
    }

    public function usercarrecord(Request $request){

        $checkcar = Carrecord::select(DB::raw('carrecord.id, carrecord.vehicle_nickname as name, carrecord.vehicle_reg_no as licenseNumber, carrecord.current_mileage as currentMileage, carrecord.chassis_no as chassisNumber, carrecord.file as imageUrl, (SUM(vehicleinfo.total_cost) / 30) as maintenancePerMonth, SUM(vehicleinfo.total_cost) as totalMaintenanceCost, MIN(vehicleinfo.mileage) as minimumMileage, MAX(vehicleinfo.mileage) as maximumMileage, ((MAX(vehicleinfo.mileage) - MIN(vehicleinfo.mileage)) / 30) as milesPerMonth, SUM(vehicleinfo.mileage) as totalMiles'))->join('vehicleinfo', 'carrecord.email', '=', 'vehicleinfo.email')->where('carrecord.email', $request->email)->get();


        $data;
        if(count($checkcar) > 0){

            $getother = Carrecord::select(DB::raw('carrecord.id, carrecord.vehicle_nickname as name, carrecord.vehicle_reg_no as licenseNumber, carrecord.current_mileage as currentMileage, carrecord.chassis_no as chassisNumber, carrecord.file as imageUrl'))->where('carrecord.email', $request->email)->get();


            $data =  array_merge($checkcar->toArray(), $getother->toArray());



            $resData = ['data' => $data, 'message' => "success", 'status' => 200];

            $status = 200;
        }
        else{

            // Get Vehicle details

            $checkcar = Carrecord::select(DB::raw('carrecord.id, carrecord.vehicle_nickname as name, carrecord.vehicle_reg_no as licenseNumber, carrecord.current_mileage as currentMileage, carrecord.chassis_no as chassisNumber, carrecord.file as imageUrl'))->where('carrecord.email', $request->email)->get();

            if(count($checkcar) > 0){ 

                $resData = ['data' => array('name' => $checkcar[0]->name, 'imageUrl' => $checkcar[0]->imageUrl, 'licenseNumber' => $checkcar[0]->licenseNumber, 'currentMileage' => $checkcar[0]->currentMileage, 'chassisNumber' => $checkcar[0]->chassisNumber, 'maintenancePerMonth' => 0, 'totalMaintenanceCost' => 0, 'minimumMileage' => 0, 'maximumMileage' => 0, 'milesPerMonth' => 0, 'totalMiles' => 0), 'message' => "success", 'status' => 200];

                $status = 200;
            }
            else{
                $resData = ['data' => [], 'message' => "No record", 'status' => 400];
                $status = 400;
            }


            
        }

        return $this->returnJSON($resData, $status);
    }


    public function workorderlist(Request $req){
        // Get vehicle information
        $getinfo = Estimate::where('vehicle_licence', $req->vehicle_reg_no)->where('busID', $req->busID)->where('work_order', 1)->orderBy('created_at', 'DESC')->get();

        if(count($getinfo) > 0){

            $resData = ['data' => $getinfo, 'message' => "success", 'status' => 200, 'licence' => $req->vehicle_reg_no, 'action' => 'work_order'];
            $status = 200;
        }
        else{

            $resData = ['data' => [], 'message' => "Work order not available for this station with this licence number", 'status' => 400];
            $status = 400;

        }

        return $this->returnJSON($resData, $status);
    }

    public function diagnosticlist(Request $req){
        // Get vehicle information
        $getinfo = Estimate::where('vehicle_licence', $req->vehicle_reg_no)->where('busID', $req->busID)->where('diagnostics', 1)->orderBy('created_at', 'DESC')->get();

        if(count($getinfo) > 0){

            $resData = ['data' => $getinfo, 'message' => "success", 'status' => 200, 'licence' => $req->vehicle_reg_no, 'action' => 'diagnostics'];
            $status = 200;
        }
        else{

            $resData = ['data' => [], 'message' => "No diagonistic record on vehicle with this station", 'status' => 400];
            $status = 400;

        }

        return $this->returnJSON($resData, $status);
    }


    public function movetodiagnostic(Request $req){
        // Get vehicle information
        $updtinfo = Estimate::where('estimate_id', $req->estimate_id)->where('busID', $req->busID)->update(['diagnostics' => 1, 'work_order' => 0]);

        if($updtinfo){

            $resData = ['data' => $updtinfo, 'message' => "Record Moved to Diagnostics", 'status' => 200];
            $status = 200;
        }
        else{

            $resData = ['data' => [], 'message' => "Cannot move record", 'status' => 400];
            $status = 400;

        }

        return $this->returnJSON($resData, $status);
    }


    public function proceedtoworkorder(Request $req){
        // Get vehicle information
        $updtinfo = Estimate::where('estimate_id', $req->estimate_id)->where('busID', $req->busID)->update(['diagnostics' => 0, 'work_order' => 1]);

        if($updtinfo){

            $resData = ['data' => $updtinfo, 'message' => "Record Moved to Work Order", 'status' => 200];
            $status = 200;
        }
        else{

            $resData = ['data' => [], 'message' => "Cannot move record", 'status' => 400];
            $status = 400;

        }

        return $this->returnJSON($resData, $status);
    }


    public function ongoingmaintenance(Request $req){

        $workinprogress = DB::table('estimate')->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')->where('opportunitypost.state', '=', 2)->where('estimate.work_order', 1)->where('estimate.email', $req->email)->orderBy('estimate.created_at', 'DESC')->get();

            if(count($workinprogress) > 0){
                $resData = ['data' => $workinprogress, 'message' => "success", 'status' => 200];
                $status = 200;
            }
            else{
                $resData = ['data' => [], 'message' => "There are no ongoing maintenance for you", 'status' => 400];
                $status = 400;
            }

        return $this->returnJSON($resData, $status);
    }

    public function receivedquotations(Request $req){

        $receivedquotes = DB::table('estimate')->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')->where('opportunitypost.state', '=', 1)->where('estimate.email', $req->email)->orderBy('estimate.created_at', 'DESC')->get();

            if(count($receivedquotes) > 0){
                $resData = ['data' => $receivedquotes, 'message' => "success", 'status' => 200];
                $status = 200;
            }
            else{
                $resData = ['data' => [], 'message' => "There are no ongoing maintenance for you", 'status' => 400];
                $status = 400;
            }

        return $this->returnJSON($resData, $status);
    }

    public function jobsdone(Request $req){

        $jobsdone = DB::table('estimate')->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')->where('opportunitypost.state', '=', 2)->where('estimate.email', $req->email)->where('estimate.maintenance', 4)->orWhere('estimate.maintenance', 5)->orderBy('estimate.created_at', 'DESC')->get();

            if(count($jobsdone) > 0){
                $resData = ['data' => $jobsdone, 'message' => "success", 'status' => 200];
                $status = 200;
            }
            else{
                $resData = ['data' => [], 'message' => "There are no ongoing maintenance for you", 'status' => 400];
                $status = 400;
            }

        return $this->returnJSON($resData, $status);
    }


    public function additionalemail(Request $req){

        // Get User by Carrecord
        $getuser = Carrecord::where('vehicle_reg_no', $req->vehicle_reg_no)->get();

        if(count($getuser) > 0){

            // Get exact user
            $user = User::where('email', $getuser[0]->email)->update(['email1' => $req->email1, 'email2' => $req->email2, 'email3' => $req->email3]);

            if($user){

                // Get additional email
                $addEmail = User::select('email1', 'email2', 'email3')->where('email', $getuser[0]->email)->get();

                $getRem = reminderNotify::where('email', $getuser[0]->email)->get();

                if(count($getRem) > 0){

                    reminderNotify::where('email', $getuser[0]->email)->update(['email1' => $req->email1, 'email2' => $req->email2, 'email3' => $req->email3]);

                    $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Addtional Emails Updated as '.$req->email1.', '.$req->email2.', '.$req->email3);

                    $resData = ['data' => $addEmail[0], 'message' => "Additional Emails Updated", 'status' => 200];
                    $status = 200;

                }
                else{
                    reminderNotify::insert(['email' => $getuser[0]->email, 'email1' => $req->email1, 'email2' => $req->email2, 'email3' => $req->email3]);




                    $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Addtional Emails Added as '.$req->email1.', '.$req->email2.', '.$req->email3);


                    $resData = ['data' => $addEmail[0], 'message' => "Additional Emails Added", 'status' => 200];
                    $status = 200;
                }


            }
            else{
                // Cannot update

                $resData = ['data' => [], 'message' => "Cannot update information", 'status' => 400];
                $status = 400;
            }

        }
        else{
            $resData = ['data' => [], 'message' => "This vehicle is not yet registered on the application", 'status' => 400];
            $status = 400;
        }




        return $this->returnJSON($resData, $status);
    }


    public function remindersettings(Request $req){


        // Get User by Carrecord
        $getuser = Carrecord::where('vehicle_reg_no', $req->vehicle_reg_no)->get();

        if(count($getuser) > 0){

            // Check if reminder exists on system
            $getNotify = reminderNotify::where('email', $getuser[0]->email)->get();

            if(count($getNotify) > 0){

                $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Reminder Settings Updated');

                reminderNotify::where('email', $getuser[0]->email)->update(['oilchange' => $req->oilchange, 'tirerotation' => $req->tyrerotation, 'airfilter' => $req->airfilter, 'inspection' => $req->inspection, 'registration' => $req->registration]);



                $resData = ['data' => true, 'message' => "Reminder Updated", 'status' => 200];
                $status = 200;
            }
            else{


                reminderNotify::insert(['email' => $getuser[0]->email, 'oilchange' => $req->oilchange, 'tirerotation' => $req->tyrerotation, 'airfilter' => $req->airfilter, 'inspection' => $req->inspection, 'registration' => $req->registration]);

                $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Reminder Settings Added');

                $resData = ['data' => true, 'message' => "Reminder Added", 'status' => 200];
                    $status = 200;


            }


        }
        else{
            $resData = ['data' => [], 'message' => "This vehicle is not yet registered on the application", 'status' => 400];
            $status = 400;
        }



        return $this->returnJSON($resData, $status);
    }


    public function getremindersettings(Request $req){

        // Check if reminder exists on system
        $getNotify = reminderNotify::where('email', $req->email)->get();

        if(count($getNotify) > 0){

            $resData = ['data' => $getNotify, 'message' => "success", 'status' => 200];
            $status = 200;
        }
        else{
            $resData = ['data' => [], 'message' => "No reminder settings set", 'status' => 400];
            $status = 400;
        }


        return $this->returnJSON($resData, $status);
    }


    public function updateongoingmaintenance(Request $req){

        $getEstimate = Estimate::where('opportunity_id', $req->post_id)->get();


            if($req->role == "mechanic"){
                if(count($getEstimate) > 0){
                $updEstimate = Estimate::where('opportunity_id', $req->post_id)->update(['maintenance' => 2]);
                if($updEstimate == 1){

                    $resData = ['data' => $workinprogress, 'message' => "Work done and closed", 'status' => 200, 'station_name' => $req->station_name];

                    $status = 200;
                }
                else{
                    $resData = ['data' => [], 'message' => "Something went wrong, Kindly contact the Administrator", 'status' => 400];
                    $status = 400;
                }
            }
            else{

                $resData = ['data' => [], 'message' => "Record not available", 'status' => 400];
                $status = 400;
            }
        }

        elseif($req->role == "owners"){


            if($req->satisfaction == "yes"){
                // Update Record
                $updEstimate = Estimate::where('opportunity_id', $req->post_id)->update(['work_order' => 0, 'maintenance' => 4]);
                if($updEstimate == 1){

                    $resData = ['data' => $updEstimate, 'message' => "Work done and satisfied. Please take a moment to review mechanic", 'status' => 200, 'station_name' => $req->station_name];

                    $status = 200;
                }
                else{
                    $resData = ['data' => [], 'message' => "Something went wrong, Kindly contact the Administrator", 'status' => 200];
                    $status = 200;
                }
            }
            elseif($req->satisfaction == "no"){
                // Update Record
                $updEstimate = Estimate::where('opportunity_id', $req->post_id)->update(['work_order' => 0, 'maintenance' => 5]);
                if($updEstimate == 1){

                    $resData = ['data' => $updEstimate, 'message' => "Work done but not satisfied. Please take a moment to review mechanic", 'status' => 200, 'station_name' => $req->station_name];

                        $status = 200;
                }
                else{

                    $resData = ['data' => [], 'message' => "Something went wrong, Kindly contact the Administrator", 'status' => 200];
                    $status = 200;
                }
            }


        }


        return $this->returnJSON($resData, $status);
    }


    public function recordListing($email){

        $maintrec = Vehicleinfo::select(DB::raw('id, vehicle_licence as vehicleLicence, date, service_type as serviceType, mileage, service_option as serviceOption, total_cost as totalCost, service_note as serviceNote, material_cost as materialCost1, material_cost2 as materialCost2, material_cost3 as materialCost3, material_cost4 as materialCost4, material_cost5 as materialCost5, material_cost6 as materialCost6, material_cost7 as materialCost7, material_cost8 as materialCost8, material_cost9 as materialCost9, material_cost10 as materialCost10, labour_cost as labourCost1, labour_cost2 as labourCost2, labour_cost3 as labourCost3, labour_cost4 as labourCost4, labour_cost5 as labourCost5, labour_cost6 as labourCost6, labour_cost7 as labourCost7, labour_cost8 as labourCost8, labour_cost9 as labourCost9, labour_cost10 as labourCost10, update_by as updatedBy'))->where('email', $email)->orderBy('created_at', 'DESC')->get();

            if(count($maintrec) > 0){

                $resData = ['data' => $maintrec, 'message' => "Success", 'status' => 200];
                $status = 200;
            }
            else{

                $resData = ['data' => [], 'message' => "Maintenance record not found", 'status' => 400];
                $status = 400;
            }

            return $this->returnJSON($resData, $status);

    }


    public function returnJSON($data, $status){
        return response($data, $status)->header('Content-Type', 'application/json');
    }

    // Notification Log
    public function notifications($ref_code, $about, $image_url){
        DB::table('notification')->insert(['ref_code' => $ref_code, 'about' => $about, 'image_url' => $image_url]);
    }

    // Activity Log
    public function activities($ip, $country, $city, $currency, $action){
        DB::table('activity')->insert(['ipaddress' => $ip, 'country' => $country, 'city' => $city, 'currency' => $currency, 'action' => $action]);
    }




}
