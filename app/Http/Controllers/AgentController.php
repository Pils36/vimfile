<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\RedirectResponse;

use Illuminate\Routing\Redirector;

use Session;


use App\Admin as Admin;

use App\SuggestedMechanics as SuggestedMechanics;

use App\User as User;

use App\Business as Business;

use App\Stations as Stations;


class AgentController extends Controller
{


    public function __construct(Request $request)
    {

        $this->getIp = $_SERVER['REMOTE_ADDR'];


        $this->arr_ip = geoip()->getLocation($this->getIp);

        $this->country = $this->arr_ip['country'];
        $this->continent = $this->arr_ip['continent'];

        // dd($this->arr_ip);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Admin $admin)
    {

            // Check if email exist
            $user = $admin->where('email', $request->email)->get();

            if(count($user) > 0){
                $resData = "User already exist with this email.";
                $resp = "error";
            }
            else{
                $adminRec = $admin->where('busID', $request->busID)->get();

                // Insert Record
                
                $username = $request->firstname.mt_rand(001, 999);
                $admin->busID = $request->busID;
                $admin->userID = "VIM_".time();
                $admin->name = $request->firstname.' '.$request->lastname;
                $admin->company = $adminRec[0]->company;
                $admin->role = "Agent";
                $admin->no_of_staff_added = "unlimited";
                $admin->plan = "unlimited";
                $admin->username = $username;
                $admin->email = $request->email;
                $admin->telephone = $request->telephone;
                $admin->address = $request->address;
                $admin->country = $request->country;
                $admin->province = json_encode($request->state);
                $admin->password = Hash::make($username);
                $admin->status = 1;
                $admin->accountType = "Super User";

                $admin->save();

                // Send Mail

                $name = $request->firstname.' '.$request->lastname;
                $subject = "Login to VIMFile";
                $message = "Dear ".$request->firstname.' '.$request->lastname.", <br><br> Thanks for choosing to work with VIMfile on Busy Wrench. We believe this relationship would be highly rewarding to all parties. <br><br> Kindly find below the login credentials to your Account on <a href='https://vimfile.com'>Vimfile.com</a>. <br><br> With this access, you will be able to  review the agreement (see under document folder) and once signed, you will have access to other features that are required to engage, convert and on-board mechanics. <br><br> Your login details to VIMFile is: <br><br> <b>Username:</b> ".$username."<br><b>Password:</b> ".$username;
                $file = NULL;

                $this->agentmailprocess($request->email, $name, $subject, $message, $file);

                $resData = "Successfull. Login details sent to ".$request->email;
                $resp = "success";
            }




        return redirect()->back()->with($resp, $resData);
    }


    public function createnewusers(Request $request, User $user, Business $business, Admin $admin)
    {

            // Check if email exist
            $thisuser = $user->where('email', $request->email)->get();

            if(count($thisuser) > 0){



                $resData = "User already exist with this email.";
                $resp = "error";
            }
            else{
                // Insert Record

                $letter = chr(rand(65,90));
                $ref_code = $letter.mt_rand(1000, 9999);


                // Create User

                $username = $request->firstname.mt_rand(001, 999);
                
                $user->busID = $request->busID;
                $user->ref_code = $ref_code;
                $user->name = $request->firstname.' '.$request->lastname;
                $user->email = $request->email;
                $user->phone_number = $request->telephone;
                $user->password = Hash::make($username);
                $user->admin = 1;
                $user->status = 1;
                $user->plan = "Super";
                $user->userType = "Auto Care";

                $user->save();


                // Create Business
                $business->busID = $request->busID;
                $business->name_of_company = "";
                $business->name = $request->firstname.' '.$request->lastname;
                $business->email = $request->email;
                $business->telephone = $request->telephone;
                $business->accountType = "Auto Care";
                $business->plan = "Super";
                $business->specialty = "Automotive Service";

                $business->save();


                // Create Admin


                $admin->busID = $request->busID;
                $admin->userID = "VIM_".time();
                $admin->name = $request->firstname.' '.$request->lastname;
                $admin->company = "";
                $admin->role = "Owner";
                $admin->no_of_staff_added = 0;
                $admin->plan = "Super";
                $admin->username = $username;
                $admin->email = $request->email;
                $admin->telephone = $request->telephone;
                $admin->password = Hash::make($username);
                $admin->status = 1;
                $admin->accountType = "Auto Care";
                $admin->created_by = session('userID');


                $admin->save();
                // Send Mail

                $name = $request->firstname.' '.$request->lastname;
                $subject = "Account created on VIMFile BusyWrench";
                $message = "Hello ".$name.", <br><br>Your BusyWrench account has been created on VIMFile. <br> Your login details are: <br><br> <b>Username:</b> ".$username."<br><b>Password:</b> ".$username."<br><br> <a href='https://vimfile.com/AdminLogin'>Click here to login to your account and reset password.</a> <br>Update Business Profile and enjoy 30-Day FREE trial. <br><br> Thank you for choosing BusyWrench by VIMFile.";
                $file = NULL;

                $this->mailprocess($request->email, $name, $subject, $message, $file);

                $resData = "Successfull. Login details sent to ".$request->email;
                $resp = "success";
            }




        return redirect()->back()->with($resp, $resData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $admin->where('id', $request->id)->update(['name' => $request->firstname.' '.$request->lastname, 'email' => $request->email, 'address' => $request->address, 'country' => $request->country, 'province' => json_encode($request->state), 'telephone' => $request->telephone]);

        // Send Mail

        $name = $request->firstname.' '.$request->lastname;
        $subject = "Update information on VIMFile";
        $message = "VIMFile Admin just updated your information. <b>Name:</b> ".$request->firstname.' '.$request->lastname." <br><br><b>Email Address: </b> ".$request->email;
        $file = NULL;

        $this->mailprocess($request->email, $name, $subject, $message, $file);

        $resData = "Successfully updated!";
        $resp = "success";

        return redirect()->back()->with($resp, $resData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getAgent(Request $request, Admin $admin)
    {
        $agent = $admin->where('id', $request->id)->get();

        if(count($agent) > 0){
            $name = $agent[0]->name;
            $first = explode(" ", $name);
             $resData = ['title' => 'Oops!', 'res' => 'Fetching', 'message' => 'success', 'data' => json_encode($agent), 'firstname' => $first[0], 'lastname' => $first[1]];
        }
        else{
            $resData = ['title' => 'Oops!', 'res' => 'Does not exist', 'message' => 'error'];
        }


        return $this->returnJSON($resData);
    }

    public function delete(Request $request, Admin $admin)
    {
        $admin->where('id', $request->id)->delete();

        $resData = "Successfully deleted!";
        $resp = "success";

        return redirect()->back()->with($resp, $resData);
    }


    public function agentmailprocess($email, $name, $subject, $message, $file){

    	$this->to = $email;
    	// $this->to = "bambo@vimfile.com";
        $this->name = $name;
        $this->subject = $subject;
        $this->message = $message." <hr><br> Kindly <a href='https://vimfile.com/support/login'> click here to login to your account now</a> <br><br> Thanks <br><br> Welcome to our Winning Team <br><br> VIMfile  Success Team";
        $this->file = $file;

        $this->sendEmail($this->to, "Compose Mail");

        // return "Sent!";
    }


    public function mailprocess($email, $name, $subject, $message, $file){

    	$this->to = $email;
    	// $this->to = "bambo@vimfile.com";
        $this->name = $name;
        $this->subject = $subject;
        $this->message = $message." <hr><br> Kindly <a href='https://vimfile.com/support/login'> click here to login to your account now</a> <br><br> Thanks";
        $this->file = $file;

        $this->sendEmail($this->to, "Compose Mail");

        // return "Sent!";
    }


        public function ajaxcheckClaims(Request $req){

        // Check user information if registered, if not, direct to sign up to register

        // Else if user has information, take to update profile information, then login

        $checkuser = User::where('station_name', $req->company)->get();


        if(count($checkuser) > 0){
            // check if station exist
            $checkStation = Stations::where('station_name', $checkuser[0]->station_name)->get();

            if(count($checkStation) > 0){
                $resData = ['title' => 'Great!', 'res' => 'Profile already updated', 'message' => 'success'];
            }
            else{
                // Update Information
                User::where('station_name', $req->company)->update(['city' => $checkuser[0]->city, 'state' => $checkuser[0]->state, 'country' => $checkuser[0]->country, 'zipcode' => $checkuser[0]->zipcode]);

                $resData = ['title' => 'Great!', 'res' => 'You shall be redirected shortly', 'message' => 'success', 'link' => "Admin/support/claimbusiness/".$checkuser[0]->station_name, 'action' => 'claim'];
            }

        }
        else{
            $checkStation = Business::where('name_of_company', $req->company)->get();

            if(count($checkStation) > 0){


                $action = $checkStation[0]->name_of_company.' just claimed business';
                $platform = 'Busy Wrench';
                $currency = $this->arr_ip['currency'];
                $city = $this->arr_ip['city'];
                $country = $this->arr_ip['country'];
                $ip = $this->arr_ip['ip'];
                $this->activities($ip, $country, $city, $currency, $action);


                // Insert Record
                $ins = User::insert(['busID' => "BW_".mt_rand(00001, 99999), 'userType' => "Auto Care", 'phone_number' => $checkStation[0]->telephone, 'email' => $checkStation[0]->email, 'address' => $checkStation[0]->address, 'city' => $checkStation[0]->city, 'state' => $checkStation[0]->state, 'country' => $checkStation[0]->country, 'zipcode' => $checkStation[0]->zipcode, 'station_name' => $checkStation[0]->name_of_company, 'platform' => "Busy Wrench", 'specialization' => $checkStation[0]->service_offered]);

                if($ins == true){

                    $resData = ['title' => 'Great!', 'res' => 'You shall be redirected shortly', 'message' => 'success', 'link' => "Admin/support/claimbusiness/".$checkStation[0]->name_of_company, 'action' => 'claim'];
                }
                else{
                    // Requets to Open An Account
                    $resData = ['title' => 'Oops!', 'res' => 'Something went wrong!', 'message' => 'info'];
                }
            }
            else{
                // Check Crawled
                $checkStation = SuggestedMechanics::where('station_name', $req->company)->get();

                // Insert Record
                $ins = User::insert(['busID' => "BW_".mt_rand(00001, 99999), 'userType' => "Auto Care", 'phone_number' => $checkStation[0]->telephone, 'address' => $checkStation[0]->address, 'station_name' => $checkStation[0]->station_name, 'city' => $checkStation[0]->city, 'state' => $checkStation[0]->state, 'country' => "Admin/support/claimbusiness/".$checkStation[0]->country, 'platform' => "Busy Wrench"]);

                if($ins == true){


                    $action = $checkStation[0]->station_name.' just claimed business';
                    $platform = 'Busy Wrench';
                    $currency = $this->arr_ip['currency'];
                    $city = $this->arr_ip['city'];
                    $country = $this->arr_ip['country'];
                    $ip = $this->arr_ip['ip'];
                    $this->activities($ip, $country, $city, $currency, $action);

                    $resData = ['title' => 'Great!', 'res' => 'You shall be redirected shortly', 'message' => 'success', 'link' => "Admin/support/claimbusiness/".$checkStation[0]->station_name, 'action' => 'claim'];
                }
                else{
                    // Requets to Open An Account
                    $resData = ['title' => 'Oops!', 'res' => 'Something went wrong!', 'message' => 'info'];
                }

            }




        }


        return $this->returnJSON($resData);

    }


    public function updateme(Request $req){

        
            $letter = chr(rand(65,90));
            $ref_code = $letter.mt_rand(1000, 9999);

            $userIns = User::where('email', $req->email)->get();

            if(count($userIns) > 0){

                $resData = "Profile information already updated";
                $resp = "info";

            }
            else{


                if($req->file('file'))
                {
                    //Get filename with extension
                    $filenameWithExt = $req->file('file')->getClientOriginalName();
                    // Get just filename
                    $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
                    // Get just extension
                    $extension = $req->file('file')->getClientOriginalExtension();
                    // Filename to store
                    $logoNameToStore = rand().'_'.time().'.'.$extension;


                    //Upload Image
                    // $path = $req->file('file')->storeAs('public/company_logo', $logoNameToStore);
        
                    // $path = $req->file('file')->move(public_path('/company_logo/'), $logoNameToStore);


        
                    $path = $req->file('file')->move(public_path('../../company_logo/'), $logoNameToStore);
                }
                else
                {
        
                    $logoNameToStore = 'noImage.png';
        
                }

                    $fileToStore = "";

                    if($req->file('manageimage') && count($req->file('manageimage')) > 0)
                    {

                        $i = 0;
                        foreach($req->file('manageimage') as $key => $value){
                            //Get filename with extension
                            $filenameWithExt = $value->getClientOriginalName();
                            // Get just filename
                            $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
                            // Get just extension
                            $extension = $value->getClientOriginalExtension();

                            // Filename to store
                            $manageNameToStore = rand().'_'.time().'.'.$extension;

                            $fileToStore .=  $manageNameToStore.",";


                            //Upload Image
                            // $path = $value->storeAs('public/uploads', $manageNameToStore);

                            // $path = $value->move(public_path('/uploads/'), $manageNameToStore);
                            
                            $path = $value->move(public_path('../../uploads/'), $manageNameToStore);
                        }

                        // Update file

                    }
                    else
                    {

                        $fileToStore = 'noImage.png';

                    }

                    $update = User::where('email', $req->email)->update(['ref_code' => $ref_code, 'name' => $req->fullname, 'email' => $req->email, 'phone_number' => $req->phone_number, 'address' => $req->station_address, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'station_name' => $req->station_name, 'size_of_employee' => $req->size_of_employee, 'year_of_practice' => $req->year_of_practice, 'mobile' => $req->mobile, 'office' => $req->office, 'year_started_since' => $req->year_started_since, 'mechanical_skill' => $req->mechanical_skill, 'electrical_skill' => $req->electrical_skill, 'transmission_skill' => $req->transmission_skill, 'body_work_skill' => $req->body_work_skill, 'other_skills' => $req->other_skills, 'vimfile_discount' => $req->vimfile_discount, 'repair_guaranteed' => $req->repair_guaranteed, 'free_estimated' => $req->free_estimated, 'walk_in_specified' => $req->walk_in_specified, 'other_value_added' => $req->other_value_added, 'average_waiting' => $req->average_waiting, 'hours_of_operation' => $req->hours_of_operation, 'wifi' => $req->wifi, 'restroom' => $req->restroom, 'lounge' => $req->lounge, 'parking_space' => $req->parking_space, 'year_established' => $req->year_established, 'background' => $req->background, 'other_skills_specify' => $req->other_skills_specify, 'discountPercent' => $req->discountPercent, 'businesslogo' => $logoNameToStore, 'photo_video' => $fileToStore]);

                
                    Business::where('email', $req->email)->update(['file2' => $logoNameToStore]);


                if($update){

                        $action = $req->station_name.' just updated their profile';
                        $platform = 'Busy Wrench';
                        $currency = $this->arr_ip['currency'];
                        $city = $this->arr_ip['city'];
                        $country = $this->arr_ip['country'];
                        $ip = $this->arr_ip['ip'];
                        $this->activities($ip, $country, $city, $currency, $action);

                        // Get user
                        $getID = User::where('email', $req->email)->get();

                        // Update Station and send Mail for account is active


                        $stationupdate = Stations::updateOrCreate([
                                    'busID' => $getID[0]->busID,

                                ],[
                                    'station_name' => $req->station_name, 'station_address' => $req->station_address, 'station_phone' => $req->phone_number, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'platform_request' => 1, 'claim_business' => 1
                                ]);



                        Business::where('busID', $getID[0]->busID)->update(['claims' => 1]);

                        SuggestedMechanics::where('station_name', $req->station_name)->delete();

                        $this->email = $req->email;
                        // $this->email = "bambo@vimfile.com";
                        $this->file = "";
                        $this->name = $req->station_name;
                        $this->subject = "Profile updated and will be reviewed";
                        $this->message = "Your profile is now updated and will be reviewed. Your login details will be forwarded to you immediately your profile is verified. <br><br>Thanks";

                        $this->sendEmail($this->email, $this->subject);

                    $resData = "Profile updated";
                    $resp = "success";
                }
                else{

                    

                    if($req->file('file'))
                {
                    //Get filename with extension
                    $filenameWithExt = $req->file('file')->getClientOriginalName();
                    // Get just filename
                    $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
                    // Get just extension
                    $extension = $req->file('file')->getClientOriginalExtension();
                    // Filename to store
                    $logoNameToStore = rand().'_'.time().'.'.$extension;
                    //Upload Image
                    // $path = $req->file('file')->storeAs('public/company_logo', $logoNameToStore);
        
                    // $path = $req->file('file')->move(public_path('/company_logo/'), $logoNameToStore);
        
                    $path = $req->file('file')->move(public_path('../../company_logo/'), $logoNameToStore);
                }
                else
                {
        
                    $logoNameToStore = 'noImage.png';
        
        
                }

                $fileToStore = "";
                    if($req->file('manageimage') && count($req->file('manageimage')) > 0)
                    {

                        $i = 0;
                        foreach($req->file('manageimage') as $key => $value){
                            //Get filename with extension
                            $filenameWithExt = $value->getClientOriginalName();
                            // Get just filename
                            $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
                            // Get just extension
                            $extension = $value->getClientOriginalExtension();

                            // Filename to store
                            $manageNameToStore = rand().'_'.time().'.'.$extension;

                            $fileToStore .=  $manageNameToStore.",";
                            //Upload Image
                            // $path = $value->storeAs('public/uploads', $manageNameToStore);

                            // $path = $value->move(public_path('/uploads/'), $manageNameToStore);
                            
                            $path = $value->move(public_path('../../uploads/'), $manageNameToStore);
                        }

                        // Update file

                    }
                    else
                    {

                        $fileToStore = 'noImage.png';

                    }

                    $update = User::where('station_name', $req->station_name)->update(['ref_code' => $ref_code, 'name' => $req->fullname, 'email' => $req->email, 'phone_number' => $req->phone_number, 'address' => $req->station_address, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'station_name' => $req->station_name, 'size_of_employee' => $req->size_of_employee, 'year_of_practice' => $req->year_of_practice, 'mobile' => $req->mobile, 'office' => $req->office, 'year_started_since' => $req->year_started_since, 'mechanical_skill' => $req->mechanical_skill, 'electrical_skill' => $req->electrical_skill, 'transmission_skill' => $req->transmission_skill, 'body_work_skill' => $req->body_work_skill, 'other_skills' => $req->other_skills, 'vimfile_discount' => $req->vimfile_discount, 'repair_guaranteed' => $req->repair_guaranteed, 'free_estimated' => $req->free_estimated, 'walk_in_specified' => $req->walk_in_specified, 'other_value_added' => $req->other_value_added, 'average_waiting' => $req->average_waiting, 'hours_of_operation' => $req->hours_of_operation, 'wifi' => $req->wifi, 'restroom' => $req->restroom, 'lounge' => $req->lounge, 'parking_space' => $req->parking_space, 'year_established' => $req->year_established, 'background' => $req->background, 'other_skills_specify' => $req->other_skills_specify, 'discountPercent' => $req->discountPercent, 'photo_video' => $fileToStore, 'businesslogo' => $logoNameToStore]);
                    
                    Business::where('email', $req->email)->update(['file2' => $logoNameToStore]);


                    if($update){

                        $action = $req->station_name.' just updated their profile';
                        $platform = 'Busy Wrench';
                        $currency = $this->arr_ip['currency'];
                        $city = $this->arr_ip['city'];
                        $country = $this->arr_ip['country'];
                        $ip = $this->arr_ip['ip'];
                        $this->activities($ip, $country, $city, $currency, $action);


                        // Get user
                        $getID = User::where('station_name', $req->station_name)->get();

                        // Update Station and send Mail for account is active


                        $stationupdate = Stations::updateOrCreate([
                                    'busID' => $getID[0]->busID,

                                ],[
                                    'station_name' => $req->station_name, 'station_address' => $req->station_address, 'station_phone' => $req->phone_number, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'platform_request' => 1, 'claim_business' => 1
                                ]);



                        Business::where('busID', $getID[0]->busID)->update(['claims' => 1]);
                                
                        SuggestedMechanics::where('station_name', $req->station_name)->delete();

                        $this->email = $req->email;
                        // $this->email = "bambo@vimfile.com";
                        $this->file = "";
                        $this->name = $req->station_name;
                        $this->subject = "Profile updated and will be reviewed";
                        $this->message = "Your profile is now updated and will be reviewed. Your login details will be forwarded to you immediately your profile is verified. <br><br>Thanks";

                        $this->sendEmail($this->email, $this->subject);

                        $resData = "Profile updated";
                        $resp = "success";

                    }

                    else{

                        $resData = "Something went wrong";
                        $resp = "error";

                    }


                }


            }


        return redirect()->route('supportmechanicsin', ['country' => $req->country])->with($resp, $resData);
    }

     	// JSON Response
 	public function returnJSON($data){
        return response()->json($data);
    }
}
