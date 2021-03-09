<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use App\Mail\sendEmail;
use App\User as User;
use App\Points as Points;
use App\RedeemPoints as RedeemPoints;
use App\Ticketing as Ticketing;
use App\OpportunityPost as OpportunityPost;
use App\PayPlan as PayPlan;
use App\Stations as Stations;
use App\BusinessStaffs as BusinessStaffs;
use App\Review as Review;
use App\GoogleImport as GoogleImport;
use App\AskExpert as AskExpert;
use App\AnsFromExpert as AnsFromExpert;
use App\VehicleLogs as VehicleLogs;
use App\Business as Business;
use App\Admin as Admin;
use App\Vehicleinfo as Vehicleinfo;
use App\QuickMail as QuickMail;


class UserController extends Controller
{

	public $imgRoute = 'https://vimfile.com/';

    public function accountType(Request $request){
        // Get All Account Types
        $accounttypes = User::select('userType')->distinct('userType')->get();

        $resData = ['data' => $accounttypes, 'status' => 200];
        $status = 200;

        return $this->returnJSON($resData, $status);
    }


    public function redeempoint(Request $request){
        // Get All Account Types

        $user = User::where('email', $request->email)->get();


        if(count($user) > 0){

        	// Check eligibliity
        	$geteligible = User::where('referred_by', $user[0]->ref_code)->get();

        	$process = count($geteligible) * 1000;

        	if($process < 50000){

        		$needed = 50000 - $process;

        		$resData = ['data' => $process. ' points available,  You need '.$needed.' points more to be eligible to redeem points', 'message' => $process. ' points available,  You need '.$needed.' points more to be eligible to redeem points', 'status' => 200];

				    $status = 200;
        	}
        	else{
        		// Start

            $updtTableuser = User::where('referred_by', $user[0]->ref_code)->where('redeem', '0')->update(['redeem' => '1']);


            if($updtTableuser){

                // Mail Admin and Mail User
                $getuserdetail = User::where('ref_code', $user[0]->ref_code)->get();

                if(count($getuserdetail) > 0){
                    // Check Redeempoint table
                    $redPoint = RedeemPoints::where('ref_code', $user[0]->ref_code)->get();

                    if(count($redPoint) > 0){
                        // Update record
                        RedeemPoints::where('ref_code', $user[0]->ref_code)->update(['ref_code' => $user[0]->ref_code, 'name' => $getuserdetail[0]->name, 'email' => $getuserdetail[0]->email, 'points' => count($getuserdetail), 'userType' => $getuserdetail[0]->userType]);
                    }
                    else{
                        // Insert
                        RedeemPoints::insert(['ref_code' => $user[0]->ref_code, 'name' => $getuserdetail[0]->name, 'email' => $getuserdetail[0]->email, 'points' => count($getuserdetail), 'userType' => $getuserdetail[0]->userType]);
                    }

                    if($getuserdetail[0]->email == 'info@vimfile.com'){
                    	$this->to = 'info@vimfile.com';
			            $this->name = $getuserdetail[0]->name;
			            $this->subject = "VIM FILE Admin- Client Redeemed points";
			            $this->description = "A user with the name <b>".$getuserdetail[0]->name."</b> whose account type is ".$getuserdetail[0]->userType." has just claimed his point on vimfile. <br><br> Details are stated below: <br /><br /> Name: ".$getuserdetail[0]->name."<br><br> User Account: ".$getuserdetail[0]->userType."<br><br> Redeemed Points: ".count($getuserdetail)." <br><br> <br /><br /> <a href='mailto:".$getuserdetail[0]->email."'>Send ".$getuserdetail[0]->name." a mail</a><br><br> Best <br><br> Vim File Team<br>";
			            $this->file = "";

			            // $this->sendEmail($this->to, $this->subject);
                    }
                    else{
                    	$this->to = $getuserdetail[0]->email;
			            $this->name = $getuserdetail[0]->name;
			            $this->subject = "VIM FILE - Redeem your points today";
			            $this->description = "We have received your request to redeem the referral points on <a href='https://vimfile.com'>vimfile.com</a><br><br> Details are stated below: <br /><br /> Name: ".$getuserdetail[0]->name."<br><br> Redeemed Points: ".count($getuserdetail)." <br><br> We would process the request and inform you of the next steps within the next 5 business days.<br><br> Best <br><br> Vim File Team<br>";
			            $this->file = "";

				            // $this->sendEmail($this->to, $this->subject);
                    }

                    $resData = ['data' =>$updtTableuser, 'message' => 'We successfully acknowledge your action, we will get back to you shortly', 'status' => 200];
				    $status = 200;

                }
                else{
                	$resData = ['data' => [], 'message' => 'You cannot claim points by this time', 'status' => 400];
				    $status = 400;
                }


            }

            else{
            	$resData = ['data' => [], 'message' => 'Something went wrong', 'status' => 400];
			    $status = 400;
            }


        	// End

        	}




        }
        else{
        	$resData = ['data' => [], 'message' => 'User not found', 'status' => 400];
		    $status = 400;
        }



        return $this->returnJSON($resData, $status);
    }


    // Open Ticket
    public function openticket(Request $request){

    	$validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'department' => 'required',
                'service' => 'required',
            ]);

    	if($validator->passes()){


    		$platform = 'others';

    	if($request->platform == $platform){

            $fileNameToStore = $request->file;
            $docfile = "";
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
	            $fileNameToStore = rand().'_'.time().'.'.$extension;
	            //Upload Image
	            // $path = $request->file('file')->storeAs('public/uploads', $fileNameToStore);

	            // $path = $request->file('file')->move(public_path('/ticketing_file/'), $fileNameToStore);

	            $path = $request->file('file')->move(public_path('../../ticketing_file/'), $fileNameToStore);

	            $docfile = $fileNameToStore;


	            $fileNameToStore = $this->imgRoute.'ticketing_file/'.$docfile;


	        }
            else{

                $fileNameToStore = $this->imgRoute.'uploads/noImage.png';

                $docfile = "";
            }


        }


    	$insTicket = Ticketing::insert(['ticketID' => '#'.mt_rand(00000, 99999), 'ticketName' => $request->name, 'ticketEmail' => $request->email, 'ticketSubject' => $request->subject, 'ticketDepartment' => $request->department, 'ticketRelatedServices' => $request->service, 'ticketPriority' => $request->priority, 'ticketMessage' => $request->message, 'ticketUsertype' => $request->accounttype, 'ticketAttachment' => $fileNameToStore ]);

        if($insTicket == true){
            // Send Mail to Ticketing mail
            $this->to = "ticketing@vimfile.com";
            $this->name = $request->name;
            $this->subject = $request->subject;

            $this->description = "<h3>Hello Admin,</h3><br />A client with below information has booked a ticket on vimfile.com <hr/><b>Client Name:</b> ".$request->name." <br><br><b>Client Email:</b> <a href='mailto:".$request->email."'>".$request->email."</a> <br><br><b>Subject:</b> ".$request->subject." <br><br><b>Department:</b> ".$request->department." <br><br><b>Related Services:</b> ".$request->service." <br><br><b>Message:</b> ".$request->message." <br><br>Send Reply via mail to <a href='mailto:".$request->email."'>".$request->email."</a>Best <br><br>Vim File Team<br>";

            $this->file = $docfile;

            // $this->sendEmail($this->to, $this->subject);


            $resData = ['data' => $insTicket, 'message' => 'Your ticket order is generated', 'status' => 200];

            $status = 200;
        }
        else{
            $resData = ['data' => [], 'message' => 'Could not open at this time', 'status' => 400];
            $status = 400;
        }


    	}
    	else{
    		$resData = ['data' => [], 'message' => "Please select the options for department and related service", 'status' => 400];
            $status = 400;
    	}


        return $this->returnJSON($resData, $status);



    }

    public function opportunitypost(Request $req){

    	$post_id = 'POST_'.mt_rand('10000', '99999');
    	// Post Opprtunities
        $postOpport = OpportunityPost::insert(['post_id' => $post_id, 'ref_code' => $req->ref_code, 'email' => $req->email, 'post_subject' => $req->service_type, 'service_option' => $req->service_option, 'post_licence' => $req->vehicle_reg_no, 'post_make' => $req->make, 'post_model' => $req->model, 'post_mileage' => $req->mileage, 'post_curr_mileage' => $req->current_mileage,'post_year' => $req->year, 'post_description' => $req->message, 'post_timeline' => $req->submission_date, 'post_service_need' => $req->street, 'postcity' => $req->city, 'poststate' => $req->state, 'postzipcode' => $req->zipcode]);

        if($postOpport == true){
            OpportunityPost::where('post_id', $post_id)->update(['state' => '1']);
            // Mail MM & Auto care within Postal Area

            $getuser = User::where('email', $req->email)->get();

            if($req->request_by == "zipcode"){
                $infodata = $getuser[0]->zipcode;
            }
            elseif($req->request_by == "city"){
                $infodata = $getuser[0]->city;
            }

            $getReceive = User::where($req->request_by, 'LIKE', '%'.$infodata.'%')->where('userType', 'Auto Care')->get();
            if(count($getReceive) > 0){
                foreach ($getReceive as $key) {

                    // $this->to = "bambo@vimfile.com";
                    $this->to = $key['email'];
		            $this->name = $key['name'];
		            $this->subject = 'There is a new opportunity post within your proximity on '.$req->service_type;

		            $this->description = "<h3>Hello ".$key['name'].",</h3><br />There is a new opportunity post within your postal area on <a href='https://busywrench.vimfile.com/login'>busywrench.vimfile.com</a> by: <b>".$getuser[0]->name.". </b> <br><br> Below is an outline of what they want to do:<hr /><h3>REQUEST FOR ESTIMATE/QUOTE</h3><hr /><b>Name:</b> ".$getuser[0]->name." <br><br><b>Service Type:</b> ".$req->service_type." <br><br><b>Service Option:</b> ".$req->service_option." <br><br><h3>VEHICLE INFORMATION</h3><hr /><b>Vehicle Licence:</b> ".$req->vehicle_reg_no." <br><br><b>Make:</b> ".$req->make." <br><br><b>Model:</b> ".$req->model." <br><br><b>Mileage:</b> ".$req->mileage." <br><br><b>Year:</b> ".$req->year." <br><br><b>Current Mileage:</b> ".$req->current_mileage." <br><br><hr /><b>Request Description:</b> ".$req->message." <br><br><b>Location:</b> ".$req->street." <br><br><b>City:</b> ".$req->city." <br><br><b>State:</b> ".$req->state." <br><br><b>Postal/Zipcode:</b> ".$req->zipcode." <br><br><b>Estimate/Quote Submission Timeline:</b> ".$req->submission_date." <br><br><br /><br />Kindly <a href='https://busywrench.vimfile.com/login'><b>Login NOW</b></a> to make an estimate proposal for this service  today<br><br>Best <br><br>Vim File Team<br>";

		            $this->file = "";

                    // $this->sendEmail($this->to, $this->subject);

                }

                $resData = ['data' => $postOpport, 'message' => 'Successfully Posted', 'status' => 200];

	            $status = 200;
            }
            else{
                echo "0";
            }

        }
        else{

            $resData = ['data' => [], 'message' => 'Cannot post opportunity by this time', 'status' => 400];

            $status = 400;
        }


    	return $this->returnJSON($resData, $status);
    }


    public function passwordchange(Request $req){
    	// Check
    	if($req->newpassword == $req->confirmpassword){
    		// Continue to change password



    		// Check User if has account
	        $getUser = User::where('email', $req->email)->get();

	        if(count($getUser) > 0){

	        	if(Hash::check($req->currentpassword, $getUser[0]['password'])){
	        		// Update Password
	            $updtUser = User::where('email', $getUser[0]->email)->update(['password' => Hash::make($req->newpassword)]);

	            // $this->to = "bambo@vimfile.com";
                    $this->to = $req->email;
		            $this->name = $getUser[0]->name;
		            $this->subject = 'VIM File - Password Change';

		            $this->description = "<h3>Hello ".$getUser[0]->name.",</h3><br />Your password has been successfully changed by you.<br><br> <b>Below are your details to next login:</b><br /><br />Name: ".$getUser[0]->name." <br><br>E-mail: ".$req->email." <br><br>Password: ".$req->newpassword." <br><br><br /><br /><p>Please contact support at <a href='mailto:support@vimfile.com'>support@vimfile.com</a> if you did not initiate this action.</p>Best Regards<br><br>VIM File Team<br>";

		            $this->file = "";

                    // $this->sendEmail($this->to, $this->subject);

                    $resData = ['data' => $updtUser, 'message' => 'Password successfully changed', 'status' => 200];

		            $status = 200;

	    		}
	    		else{
	    			$resData = ['data' => [], 'message' => 'Current password not correct', 'status' => 400];

		            $status = 400;
	    		}


	        }
	        else{
	            $resData = ['data' => [], 'message' => 'User information not found', 'status' => 400];

		            $status = 400;
	        }
    	}
    	else{
    		$resData = ['data' => [], 'message' => 'Confirm password does not match', 'status' => 400];

            $status = 400;
    	}


    	return $this->returnJSON($resData, $status);
    }


    public function myachievement(Request $req){

    	$data  = Points::where('email', $req->email)->get();

    	if(count($data) > 0){
    		$resData = ['data' => $data[0], 'message' => 'success', 'status' => 200];

            $status = 200;
    	}
    	else{
    		$resData = ['data' => [], 'message' => 'No points achieved yet', 'status' => 400];

            $status = 400;
    	}


    	return $this->returnJSON($resData, $status);

    }

    public function allachievement(Request $req){

    	$data  = Points::all();

    	if(count($data) > 0){
    		$resData = ['data' => $data, 'message' => 'success', 'status' => 200];

            $status = 200;
    	}
    	else{
    		$resData = ['data' => [], 'message' => 'No points achieved yet', 'status' => 400];

            $status = 400;
    	}

    	return $this->returnJSON($resData, $status);

    }

    public function weeklyranking(Request $req){


    	$data  = User::where('email', $req->email)->get();


    	if(count($data) > 0){
    		$rank = Points::where('state', $data[0]->state)->orderBy('weekly_point', 'DESC')->get();

    		$resData = ['data' => $rank, 'message' => 'success', 'status' => 200];

            $status = 200;
    	}
    	else{
    		$resData = ['data' => [], 'message' => 'No weekly rank achieved yet', 'status' => 400];

            $status = 400;
    	}

    	return $this->returnJSON($resData, $status);

    }

    public function alltimeranking(Request $req){

    	$data  = User::where('email', $req->email)->get();


    	if(count($data) > 0){
    		$rank = Points::where('country', $data[0]->country)->orderBy('alltime_point', 'DESC')->get();

    		$resData = ['data' => $rank, 'message' => 'success', 'status' => 200];

            $status = 200;
    	}
    	else{
    		$resData = ['data' => [], 'message' => 'No all time rank achieved yet', 'status' => 400];

            $status = 400;
    	}

    	return $this->returnJSON($resData, $status);

    }

    public function globalranking(Request $req){

    	$data  = Points::all();


    	if(count($data) > 0){
    		$rank = Points::orderBy('global_point', 'DESC')->get();

    		$resData = ['data' => $rank, 'message' => 'success', 'status' => 200];

            $status = 200;
    	}
    	else{
    		$resData = ['data' => [], 'message' => 'No global rank achieved yet', 'status' => 400];

            $status = 400;
    	}

    	return $this->returnJSON($resData, $status);

    }

    public function subscriptionplan(Request $req){

    	$today = date('Y-m-d');

        $mypayment = PayPlan::where('email', $req->email)->get();

        if(count($mypayment) > 0){

            if($mypayment[0]->date_to >= $today){
                $plan = $mypayment[0];
            }
            else{
                $plan = array("plan" => "Free");
            }
        }
        else{
            $plan = array("plan" => "Free");
        }

        $resData = ['data' => $plan, 'message' => 'success', 'status' => 200];

        $status = 200;


    	return $this->returnJSON($resData, $status);

    }


    public function stations(Request $req){

    	// Get Stations
    	$mystations = Stations::where('busID', $req->busID)->orderBy('created_at', 'DESC')->get();

    	if(count($mystations) > 0){
    		$resData = ['data' => $mystations, 'message' => 'success', 'status' => 200];

	        $status = 200;
    	}
    	else{
    		$resData = ['data' => [], 'message' => 'No station created', 'status' => 400];

	        $status = 400;
    	}


    	return $this->returnJSON($resData, $status);
    }

    public function staffs(Request $req){

    	// Get Stations
    	$staffs = BusinessStaffs::where('busID', $req->busID)->get();

    	if(count($staffs) > 0){
    		$resData = ['data' => $staffs, 'message' => 'success', 'status' => 200];

	        $status = 200;
    	}
    	else{
    		$resData = ['data' => [], 'message' => 'No staffs created', 'status' => 400];

	        $status = 400;
    	}


    	return $this->returnJSON($resData, $status);
    }

    public function opportunitypostlist(Request $req){

    	// Get Stations
    	$opportunity = OpportunityPost::where('postcity', 'LIKE', '%'.$req->city.'%')->orderBy('created_at', 'DESC')->get();

    	if(count($opportunity) > 0){
    		$resData = ['data' => $opportunity, 'message' => 'success', 'status' => 200];

	        $status = 200;
    	}
    	else{
    		$opportunity = OpportunityPost::where('postzipcode', 'LIKE', '%'.$req->zipcode.'%')->orderBy('created_at', 'DESC')->get();

    		if(count($opportunity) > 0){

    			$resData = ['data' => $opportunity, 'message' => 'success', 'status' => 200];

		        $status = 200;

    		}else{
    			$resData = ['data' => [], 'message' => 'No available post for you', 'status' => 400];

		        $status = 400;
    		}

    	}


    	return $this->returnJSON($resData, $status);
    }


    public function reviewpost(Request $req){
    	// Check Station and The Technician

    	$technician = User::where('station_name', $req->station_name)->get();

    	if(count($technician) > 0){
            // Add Review

            $getmaint = Vehicleinfo::where('id', $req->id)->get();

            if(count($getmaint) > 0){
                $service_maint = $getmaint[0]->service_type." on ".$getmaint[0]->make." Licence No: ".$getmaint[0]->vehicle_licence." Date: ".$getmaint[0]->date;
            }
            else{
                $service_maint = "";
            }

    		$ins = Review::insert(['ref_code' => $req->ref_code, 'post_id' => "POST_".mt_rand(00000, 99999), 'technician' => $technician[0]->name, 'station_name' => $req->station_name, 'rating' => $req->rating, 'comment' => $req->message, 'busID' => $technician[0]->busID, 'service_maintenance' => $service_maint, 'service_type' => $req->service_type, 'period_visited' => $req->reservationtime, 'service_description' => $req->service_description, 'mechanic_email' => $req->mechanic_email]);

    		if($ins == true){
    			$resData = ['data' => $ins, 'message' => 'success', 'status' => 200];

		        $status = 200;
    		}
    		else{
    			$resData = ['data' => [], 'message' => 'Something went wrong!', 'status' => 400];

		        $status = 400;
    		}
    	}
    	else{
    		$resData = ['data' => [], 'message' => 'Station not found', 'status' => 400];

		        $status = 400;
    	}

    	return $this->returnJSON($resData, $status);
    }

    public function replyreview(Request $req){

    	// Get Post

    	$post = Review::where('post_id', $req->post_id)->get();

    	if(count($post) > 0){
    		// Update reply

    		$updt = Review::where('post_id', $req->post_id)->update(['reply' => $req->message]);

    		if($updt){
    			$resData = ['data' => $updt, 'message' => 'success', 'status' => 200];

		        $status = 200;
    		}
    		else{
    			$resData = ['data' => [], 'message' => 'Something went wrong!', 'status' => 400];

		        $status = 400;
    		}
    	}
    	else{
    		$resData = ['data' => [], 'message' => 'Review post not found', 'status' => 400];

		        $status = 400;
    	}


    	return $this->returnJSON($resData, $status);
    }


    public function connections(Request $req){
    	// Check Station and The Technician

    	$useremail = User::where('email', $req->email)->get();



    	if(count($useremail) > 0){
    		// Add Review

		   $importClient = GoogleImport::where('invite_from', $useremail[0]->ref_code)->orderBy('created_at', 'DESC')->get();


    		if(count($importClient) > 0){

    			$resData = ['data' => $importClient, 'message' => 'success', 'status' => 200];

		        $status = 200;
    		}
    		else{
    			$resData = ['data' => [], 'message' => 'No available connection', 'status' => 400];

		        $status = 400;
    		}
    	}
    	else{
    		$resData = ['data' => [], 'message' => 'User information not found', 'status' => 400];

		        $status = 400;
    	}

    	return $this->returnJSON($resData, $status);
    }

    public function deactivate(Request $req){

    	// Fetch User
        $user = User::where('id', $req->id)->get();


        if(count($user) > 0){
            // Update User
            User::where('id', $req->id)->update(['status' => '0']);


            $this->to = $user[0]->email;
            $this->name = $user[0]->name;
            $this->subject = "VIM File - Account Deactivated";
            $this->description = "<h3>Hello ".$this->name.",</h3><br />We regret to inform you that your account on vimfile.com has been deactivated.</b> <br><br>Kindly <a href='https://vimfile.com/Contact'>contact the admin</a> using the contact form if you think the decision should be reviewed.<br><br> <a href='https://vimfile.com/Contact' style='color: navy; font-weight: bold;'>Click here to contact Admin</a><br><br> Thank you for choosing VIM File<br /><br />Best <br><br>VIMFile Team.<br>";
            $this->file = "";

            // $this->sendEmail($this->to, $this->subject);

            $resData = ['data' => true, 'message' => 'Thank you for using VIMFile. Your account is now deactivated', 'status' => 200];

		        $status = 200;
        }
        else{

        	$resData = ['data' => [], 'message' => 'Something Went Wrong', 'status' => 400];

		        $status = 400;

        }

    	return $this->returnJSON($resData, $status);
    }


    public function questionforexperts(Request $req){

    	// Get All asked questions

    	$getasked = AskExpert::orderBy('created_at', 'DESC')->get();

    	if(count($getasked) > 0){

    		$resData = ['data' => $getasked, 'message' => 'success', 'status' => 200];

		    $status = 200;
    	}
    	else{

    		$resData = ['data' => [], 'message' => 'No available questions at the moment', 'status' => 400];

		    $status = 400;
    	}

    	return $this->returnJSON($resData, $status);
    }


    public function answerfromexpert(Request $req){

    	// Get All asked questions



    	$getanswer = DB::table('ansfromexpert')
		            ->join('askexpert', 'ansfromexpert.post_id', '=', 'askexpert.post_id')->where('askexpert.post_id', $req->post_id)
		            ->orderBy('ansfromexpert.created_at', 'DESC')->get();

    	if(count($getanswer) > 0){

    		$resData = ['data' => $getanswer, 'message' => 'success', 'status' => 200];

		    $status = 200;
    	}
    	else{

    		$resData = ['data' => [], 'message' => 'No available questions at the moment', 'status' => 400];

		    $status = 400;
    	}

    	return $this->returnJSON($resData, $status);
    }


    public function askexpertquestions(Request $req){

    	$post_id = uniqid();

    	$platform = 'others';

    	if($req->platform == $platform){

            $fileNameToStore = $req->file;
            $docfile = "";
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
	            $fileNameToStore = rand().'_'.time().'.'.$extension;
	            //Upload Image
	            // $path = $req->file('file')->storeAs('public/uploads', $fileNameToStore);

	            // $path = $req->file('file')->move(public_path('/expertupload/'), $fileNameToStore);

	            $path = $req->file('file')->move(public_path('../../expertupload/'), $fileNameToStore);

	            $docfile = $fileNameToStore;


	            $fileNameToStore = $this->imgRoute.'expertupload/'.$docfile;


	        }
            else{

                $fileNameToStore = $this->imgRoute.'uploads/noImage.png';

                $docfile = "";
            }

        }


        // Check if post already made
        $checkPost = AskExpert::where('post_id', $post_id)->get();

        if(count($checkPost) > 0){
        	// Post exists
        	$resData = ['data' => [], 'message' => 'This post was already sent', 'status' => 200];

		    $status = 200;
        }
        else{

        	// Insert
        	$insPost = AskExpert::insert(['name' => $req->name, 'email' => $req->email, 'post_id' => $post_id, 'question' => $req->question, 'service_type' => $req->service_type, 'image' => $fileNameToStore]);

        	$this->vehicleLogs($req->service_type, $post_id, $req->name);

        	if($insPost == true){


				$currUser = User::where('api_token', $request->bearerToken())->first();


				$this->earnYourPoints($currUser->name, $currUser->email, 15, $currUser->state, $currUser->country);


				$this->notifications($currUser->ref_code, 'You just earned 15 point', 'https://i.ya-webdesign.com/images/notification-bell-gif-png-youtube.png');


        		// Send Mail Here

        		$resData = ['data' => true, 'message' => 'success', 'status' => 200];

			    $status = 200;
        	}
        	else{
        		$resData = ['data' => [], 'message' => 'Something went wrong', 'status' => 400];

			    $status = 400;
        	}

        }


    	return $this->returnJSON($resData, $status);
    }


    public function answerexpertquestions(Request $req){

    	// Insert into Table

        $ansfromExpert = AnsFromExpert::insert(['autocare' => $req->name, 'post_id' => $req->post_id, 'answer' => $req->answer]);

        if($ansfromExpert == true){

            $addingPonts = Points::where('email', $req->email)->get();
            $quest = AskExpert::where('post_id', $req->post_id)->get();

            // get user
        	$userinfo = User::where('email', $req->email)->get();

            if(count($addingPonts) > 0){

            $weekPont = $addingPonts[0]->weekly_point + 15;
            $allPont = $addingPonts[0]->alltime_point + $weekPont;
            $point = Points::where('email', $req->email)->update(['weekly_point' => $weekPont, 'alltime_point' => $allPont, 'global_point' => $allPont, 'state' => $userinfo[0]->state, 'country' => $userinfo[0]->country]);

            }
            else{
                // Insert
                $inspoint = Points::insert(['name' => $req->name, 'email' => $req->email, 'weekly_point' => '15', 'alltime_point' => '15', 'global_point' => '15', 'state' => $userinfo[0]->state, 'country' => $userinfo[0]->country]);
            }


           $resData = ['data' => $ansfromExpert, 'message' => 'success', 'status' => 200];

		    $status = 200;


        }else{
            $resData = ['data' => [], 'message' => 'Something went wrong', 'status' => 400];

		    $status = 400;
        }



    	return $this->returnJSON($resData, $status);
    }


    public function mystations(Request $req){
    	$getBussiness = Stations::where('busID', $req->busID)->orderBy('created_at', 'DESC')->get();

    	if(count($getBussiness) > 0){
    		$resData = ['data' => $getBussiness, 'message' => 'success', 'status' => 200];

		    $status = 200;
    	}

    	else{
    		$resData = ['data' => [], 'message' => 'No available station created', 'status' => 400];

		    $status = 400;
    	}

    	return $this->returnJSON($resData, $status);
    }


    public function createstation(Request $req){

    	$mybusiness = Business::where('busID', $req->busID)->get();

    	if(count($mybusiness) > 0){

    		$insStation = Stations::insert(['busID' => $req->busID, 'station_name' => $req->station_name, 'station_address' => $req->station_address, 'station_phone' => $req->station_phone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'service_offered' => $mybusiness[0]->service_offered]);

    		if($insStation == true){
    			$resData = ['data' => $insStation, 'message' => 'Station created', 'status' => 200];

			    $status = 200;
    		}
    		else{
    			$resData = ['data' => [], 'message' => 'Something went wrong!', 'status' => 400];

			    $status = 400;
    		}
    	}
    	else{

    		$resData = ['data' => [], 'message' => 'Something seem wrong, as business is not found', 'status' => 400];

		    $status = 400;

    	}


    	return $this->returnJSON($resData, $status);
    }


    public function createstaff(Request $req){

    	// Check if staff exist
    	$getStaff = BusinessStaffs::where('email', $req->email)->get();

    	if(count($getStaff) > 0){

    		$resData = ['data' => [], 'message' => 'Staff already exist', 'status' => 200];

		    $status = 200;
    	}
    	else{
    		// Get Plan
    		$getPlan = Admin::where('busID', $req->busID)->get();

    		if(count($getPlan) > 0){

    			switch ($getPlan[0]->plan) {
    				case 'Start Up':
	    					$no_of_staff = 1;
    					break;

    				case 'Basic':
    						$no_of_staff = 2;
    					break;

    				case 'Classic':
    						$no_of_staff = 10000000000000000;
    					break;

    				case 'Super':
    						$no_of_staff = 1000000000000000000;
    					break;

    				default:
    						$no_of_staff = 1;
    					break;
    			}

    			$addUp = $getPlan[0]->no_of_staff_added;

    			if($addUp >= $no_of_staff){

    				$resData = ['data' => [], 'message' => 'You have exceeded the number of staff you can add. Your current plan enables you to add not more than '.$no_of_staff.' member and you have already added '.$addUp.' member. Kindly upgrade your account', 'status' => 200];

				    $status = 200;
    			}
    			else{
    				Admin::where('busID', $req->busID)->update(['no_of_staff_added' => $addUp+1]);

    				$username = $req->firstname.'_'.mt_rand(000, 999);

    				BusinessStaffs::insert(['firstname' => $req->firstname, 'lastname' => $req->lastname, 'email' => $req->email, 'username' => $username, 'position' => $req->position, 'station' => $req->station, 'busID' => $req->busID, 'userType' => $req->accountType]);

    				// Get Business
		      		$myBusinezz = Business::where('busID', $req->busID)->get();

		      		$getStation = Stations::where('station_name', $req->station)->get();


		      		if(count($getStation) > 0){
						User::insert(['name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->accountType, 'phone_number' => $getStation[0]->station_phone, 'city' => $getStation[0]->city, 'state' => $getStation[0]->state, 'country' => $getStation[0]->country, 'email1' => '', 'email2' => '', 'email3' => '', 'busID' => $req->busID, 'station_name' => $req->station, 'plan' => $getPlan[0]->plan, 'zipcode' => $getStation[0]->zipcode, 'specialization' => $myBusinezz[0]->service_offered]);
		      		}
		      		else{
		      			User::insert(['name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->accountType, 'phone_number' => '', 'city' => '', 'state' => '', 'country' => '', 'email1' => '', 'email2' => '', 'email3' => '', 'busID' => $req->busID, 'station_name' => $req->station, 'plan' => $getPlan[0]->plan, 'specialization' => $myBusinezz[0]->service_offered]);
		      		}


		      		$resData = ['data' => 'Staff Created with USERNAME: '.$req->email.' and PASSWORD: '.$req->password.' Kindly note details.', 'message' => 'success', 'status' => 200, 'action' => 'create_staff'];

					    $status = 200;

    			}
    		}
    		else{
    			$resData = ['data' => [], 'message' => 'Not permitted to create staff', 'status' => 400];

			    $status = 400;
    		}

    	}


    	return $this->returnJSON($resData, $status);
	}
	

	// Create Message
	public function createMessage(Request $req){
		// Insert Record
		QuickMail::insert(['receiver' => $req->receiver, 'subject' => $req->subject, 'message' => $req->message, 'sender' => $req->sender, 'msgId' => "PILS_".time()."_VIM", 'status' => 0]);

		$getUser = User::where('email', $req->receiver)->get();


		// Send A Mail
		// $this->to = "bambo@vimfile.com";
		$this->to = $req->receiver;
		$this->name = $getUser[0]->name;
		$this->subject = $req->subject;

		$this->message = $req->message;

		$this->file = NULL;

		// $this->sendEmail($this->to, "Compose Mail");


		$resData = ['data' => 'Message sent!', 'message' => 'success', 'status' => 200];

		$status = 200;


		return $this->returnJSON($resData, $status);
				
	}

	// List Message

	public function listMessage(Request $req, $email){

		$getmessage = DB::table('quickmail')->select(DB::raw('quickmail.message, users.name, quickmail.created_at'))->join('users', 'quickmail.receiver', '=', 'users.email')->where('quickmail.receiver', $email)->orWhere('quickmail.sender', $email)->orderBy('quickmail.created_at', 'DESC')->get();

		if(count($getmessage) > 0){

			$resData = ['data' => $getmessage, 'message' => 'Success', 'status' => 200];

			$status = 200;
		}
		else{
			$resData = ['data' => [], 'message' => 'No new message', 'status' => 400];

			$status = 400;
		}

		return $this->returnJSON($resData, $status);

	}

	// Edit Profile

	public function editProfile(Request $req, User $user, $id){


		if($req->hasFile('avatar')){

	        //Get filename with extension
	        $filenameWithExt = $req->file('avatar')->getClientOriginalName();
	        // Get just filename
	        $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
	        // Get just extension
	        $extension = $req->file('avatar')->getClientOriginalExtension();
			// Filename to store
			
			$filenamestore = rand().'_'.time().'.'.$extension;

			$fileNameToStore = "https://".$_SERVER['HTTP_HOST']."/profile/avatar/".$filenamestore;

			
	        //Upload Image
	        // $path = $req->file('file')->storeAs('public/uploads', $filenamestore);

	        // $path = $req->file('avatar')->move(public_path('/profile/avatar/'), $filenamestore);
			$path = $req->file('avatar')->move(public_path('../../profile/avatar/'), $filenamestore);


			// Update Proile
				$user->where('id', $id)->update(['avatar' => $fileNameToStore]);

			

		}
		else{
			$fileNameToStore = 'https://vimfile.com/img/icon/vimlogo.png';
		}


		$getUser = $user->select('name', 'specialization', 'avatar as imageUrl')->where('id', $id)->get();

		
		

		if($req->name != ""){
			$name = $req->name;
		}
		else{
			$name = $getUser[0]->name;
		}
		if($req->occupation != ""){
			$occupation = $req->occupation;
		}
		else{
			$occupation = $getUser[0]->specialization;
		}


		Log::info('Name: '.$name.' | Specialization: '.$occupation);


		// Update Proile
		$user->where('id', $id)->update(['name' => $name, 'specialization' => $occupation]);


		$updateUser = $user->select('name', 'specialization', 'avatar as imageUrl')->where('id', $id)->get();

		$resData = ['data' => $updateUser[0], 'message' => 'Success', 'status' => 200];

		$status = 200;


		return $this->returnJSON($resData, $status);
	}


    public function returnJSON($data, $status){
        return response($data, $status)->header('Content-Type', 'application/json');
    }

    // Achievement Log
    public function achievement($name, $email, $week, $global){
        DB::table('achievement')->updateOrCreate(['name' => $name, 'email' => $email, 'weekly_rank' => $week, 'global_rank' => $global]);
    }

    // Vehicle Log
    public function vehicleLogs($service_type, $post_id, $name){
        DB::table('vehiclelogs')->insert(['service_type' => $service_type, 'post_id' => $post_id, 'name' => $name]);
    }


    // Send Mail
//     public function sendEmail($objDemoa, $purpose){
//       $objDemo = new \stdClass();
//       $objDemo->purpose = $purpose;

//      if($purpose == $this->subject){
//         $objDemo->to = $this->to;
//         $objDemo->name = $this->name;
//         $objDemo->subject = $this->subject;
//         $objDemo->description = $this->description;
//         $objDemo->file = $this->file;
//       }

//       Mail::to($objDemoa)
//             ->send(new sendEmail($objDemo));
//    }

}
