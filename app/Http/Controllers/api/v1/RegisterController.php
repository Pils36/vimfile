<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\User as User;
use App\TempUser as TempUser;
use App\Business as Business;
use App\Carrecord as Carrecord;
use App\Validateotp as Validateotp;

//Mail

use App\Mail\sendEmail;

class RegisterController extends Controller
{

	public $status;
    public $market_place;
    public $to;
    public $name;
    public $subject;
    public $description;
    public $message;

    public function register(Request $request){

        $code = 12345;

    	$validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if($validator->passes()){

        	$token = md5($request->email);
	        
	        

        	if($request->userType == 'Individual' || $request->userType == 'Commercial' || $request->userType == 'Mobile Mechanics'){



		    $create =  TempUser::create([
	            'name' => $request->firstname.' '.$request->lastname,
	            'userType' => $request->userType,
	            'email' => $request->email,
	            'phone_number'=> $request->phone_number,
	            'password' => Hash::make($request->password),
	            'status' => 1,
	            'verification_code' => $code,
	        ]);
	        	
	        $this->getOTP($token, $code, $request->email, $request->phone_number);

	        // Send Mail
		        $this->to = $request->email;
	            $this->name = $request->firstname.' '.$request->lastname;
	            $this->subject = "Verify OTP";
	            $this->message = "Welcome to VIMFile, We are glad to have you on board. <br><br> Kindly verify your registration with the code below. <br><br>OTP code: ".$code;
	            $this->file = NULL;

	            $this->sendEmail($this->to, "Compose Mail");

	            // Send SMS


			    $resData = ['data' => $create, 'message' => 'Success', 'status' => 200, 'action' => 'register'];
                $status = 200;
            }
            else{

                // Other account login here

                // Check if Email exist
                $email = TempUser::where('email', $request->email)->get();

                if(count($email) > 0){
                    // Check verification code status
                    $checkotp = Validateotp::where('email', $request->email)->where('status', 0)->get();
    
                    if(count($checkotp) > 0){
                        // Update Record
                        $data = TempUser::where('email', $request->email)->update([
                            'name' => $request->firstname.' '.$request->lastname,
                            'userType' => $request->userType,
                            'email' => $request->email,
                            'phone_number'=> $request->phone_number,
                            'password' => Hash::make($request->password),
                            'status' => 1,
                            'verification_code' => $code,
                        ]);
    
                        $this->getOTP($token, $code, $request->email, $request->phone_number);
    
                        // Send Mail
                        $this->to = $request->email;
                        $this->name = $request->firstname.' '.$request->lastname;
                        $this->subject = "Verify OTP";
                        $this->message = "Welcome to VIMFile, We are glad to have you on board. <br><br> Kindly verify your registration with the code below. <br><br>OTP code: ".$code;
                        $this->file = NULL;
    
                        $this->sendEmail($this->to, "Compose Mail");
    
                        // Send SMS
    
                        // Get user data
                        $user = TempUser::where('email', $request->email)->get();
    
                        $resData = ['data' => $user[0], 'message' => 'Success', 'status' => 200, 'action' => 'register'];
                        $status= 200;
                    }
                    else{
                        // Already Exist
                        $resData = ['data' => [], 'message' => 'This email already completed registration', 'status' => 400];
                        $status = 400;
                    }
                    
                }
                else{
                    $resData = ['data' => [], 'message' => 'Registration not successful, try again', 'status' => 400];
                    $status = 400;
                }

            }

        }
        else{

            $error = implode(",",$validator->messages()->all());

            $resData = ['data' => [], 'message' => $error, 'status' => 400];
            $status = 400;
        	
        }
        

        return $this->returnJSON($resData, $status);
    	
    }

    public function validateotp(Request $request){

        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);

        if($validator->passes()){
        	$getcode = Validateotp::where('verification_code', $request->code)->get();


            if(count($getcode) > 0){
                if($getcode[0]->token == md5($request->email)){

                    $resData = ['data' => $getcode, 'message' => 'Validation successful', 'status' => 200, 'token' => md5($request->email)];
                    $status = 200;
                }
                else{
                    // Check if email is available
                    $getcode = Validateotp::where('email', $request->email)->get();

                    $resData = ['data' => $getcode[0], 'message' => 'Validation successful', 'status' => 200, 'token' => md5($request->email)];
                    $status = 200;

                }

                $user = TempUser::where('email', $request->email)->get();

                // Create Users Registration

                $this->insertUser($user[0]->name, $user[0]->userType, $user[0]->email, $user[0]->phone_number, $user[0]->password, $user[0]->code, md5($request->email));


            }
            else{
                    $resData = ['data' => [], 'message' => 'Token mismatch', 'status' => 400];
                    $status = 400;
            }
	        
        }
        else{
        	$resData = ['data' => [], 'message' => 'otp code is required', 'status' => 400];
            $status= 400;
        }

        return $this->returnJSON($resData, $status);

    }

    public function resendotp(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if($validator->passes()){
        	$getcode = Validateotp::where('email', $request->email)->get();

	        if(count($getcode) > 0){
	        	// Send Mail

	        	$this->to = $request->email;
	            $this->name = "From VIMFILE";
	            $this->subject = "Resend OTP";
	            $this->message = "Your OTP code is: ".$getcode[0]->verification_code;
	            $this->file = NULL;

	            $this->sendEmail($this->to, "Compose Mail");

	        	// Send SMS

	        	$resData = ['data' => $getcode[0]->verification_code, 'message' => 'Sent', 'status' => 200];
                $status = 200;
	        }
	        else{
	        	$resData = ['data' => [], 'message' => 'No validation code available', 'status' => 400];
                $status = 400;
	        }
        }
        else{
        	$resData = ['data' => [], 'message' => 'email address is required', 'status' => 400];
            $status = 400;
        }

        


        return $this->returnJSON($resData, $status);
    }

    public function avatarUpload(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if($validator->passes()){
        	if($request->file('avatar'))
	        {
	        //Get filename with extension
	        $filenameWithExt = $request->file('avatar')->getClientOriginalName();
	        // Get just filename
	        $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
	        // Get just extension
	        $extension = $request->file('avatar')->getClientOriginalExtension();
            // Filename to store
            
            $filenamestore = rand().'_'.time().'.'.$extension;

	        $fileNameToStore = "http://".$_SERVER['HTTP_HOST']."/profile/avatar/".$filenamestore;
	        //Upload Image
	        // $path = $request->file('file')->storeAs('public/uploads', $filenamestore);

	        // $path = $request->file('avatar')->move(public_path('/profile/avatar/'), $filenamestore);
	        $path = $request->file('avatar')->move(public_path('../../profile/avatar/'), $filenamestore);

		    }
		    else{
		    	$fileNameToStore = 'https://vimfile.com/img/icon/vimlogo.png';
		    }

		    $updtUser = User::where('email', $request->email)->update(['avatar' => $fileNameToStore]);

		    if($updtUser == 1){

                // Get avatar
                $getUser = User::select('name', 'specialization', 'avatar as imageUrl')->where('email', $request->email)->get();

		    	$resData = ['data' => $getUser[0], 'message' => 'Profile Picture Saved', 'status' => 200];
                $status = 200;
		    }
		    else{
		    	$resData = ['data' => [], 'message' => 'Something went wrong', 'status' => 400];
                $status = 400;
		    }
        }
        else{
        	$resData = ['data' => [], 'message' => 'email address is required', 'status' => 400];
            $status = 400;
        }

    	


	    return $this->returnJSON($resData, $status);

    }

    public function getOTP($token, $code, $email, $phone_number){
        // Check exist
        $check = Validateotp::where('email', $email)->get();

        if(count($check) > 0){
            // Update Token
            Validateotp::where('email', $email)->update(['token' => $token, 'verification_code' => $code, 'email' => $email, 'phone_number' => $phone_number]);
        }
        else{
            // Insert Token
            Validateotp::insert(['token' => $token, 'verification_code' => $code, 'email' => $email, 'phone_number' => $phone_number]);
        }
    	
    }

    public function insertUser($name, $userType, $email, $phone_number, $password, $code, $token){

        User::insert([
            'name' => $name,
            'userType' => $userType,
            'email' => $email,
            'phone_number'=> $phone_number,
            'password' => $password,
            'status' => 1,
            'verification_code' => $code,
            'api_token' => $token
        ]);

        // Delete Temp User
        TempUser::where('email', $email)->delete();
    }

    // Response
    public function returnJSON($data, $status){
        return response($data, $status)->header('Content-Type', 'application/json');
    }



}
