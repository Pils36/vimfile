<?php

/*
	Vehicle Inspection and Maintenance Pro-Filr
	 By: Adenuga Adebambo [- Pils36 -]
	 Created: Monday 12 - 08 - 2019

	 Time: 08:00AM
*/ 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Paystack;

use App\PayPlan as PayPlan;

use App\PayResult as PayResult;

use App\User as User;

use App\Business as Business;

use App\Admin as Admin;

//Session
use Session;

class PaymentController extends Controller
{

    public $nextPay;

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        // Update Users Information
        // dd($paymentDetails['data']);

        

        $getuserData = PayPlan::where('transaction_id', $paymentDetails['data']['metadata']['transaction_id'])->get();

        if(count($getuserData) > 0){
        	// Update User Fields
                $Date = $getuserData[0]->date_from;
                
                if($getuserData[0]->subscription_plan == 'monthly'){
                    $this->nextPay = date('Y-m-d', strtotime($Date. ' + 30 days'));
                }
                else{
                    $this->nextPay = date('Y-m-d', strtotime($Date. ' + 365 days'));
                }
			

        	$update = PayPlan::where('transaction_id', $paymentDetails['data']['metadata']['transaction_id'])->update(['payment_status' => 'Paid','date_to' => $this->nextPay]);

        	if($update == 1){
        		// Insert User Payment Record
        		$new = PayResult::insert(['transaction_id' => $paymentDetails['data']['metadata']['transaction_id'], 'email' => $paymentDetails['data']['customer']['email'], 'fee' => $paymentDetails['data']['amount'] / 100, 'authorization_code' => $paymentDetails['data']['authorization']['authorization_code'], 'card_type' => $paymentDetails['data']['authorization']['card_type'], 'bank' => $paymentDetails['data']['authorization']['bank'], 'country_code' => $paymentDetails['data']['authorization']['country_code'], 'brand' => $paymentDetails['data']['authorization']['brand'], 'currency' => $paymentDetails['data']['currency']]);

        		if($new == true){
                    $amount = $paymentDetails['data']['amount'] / 100;
                    $this->to = $paymentDetails['data']['customer']['email'];
                    $this->name = Auth::user()->name;
                    $this->subject = "Payment of ".$amount." successfull";
                    $this->message = "We have recevied your payment of ".$amount.". <br><br> Thank you.";
                    $this->file = NULL;

                    $this->sendEmail($this->to, "Compose Mail");
        			// Make Redirect to pages - Check Usertyp
		        	$checkBiz = PayPlan::where('email', $paymentDetails['data']['customer']['email'])->get();

		        	if($checkBiz[0]->userType == "Business"){
		        		return view('admin.login');
		        	}else{
                        $busInfo = '';
		        		return view('auth.login')->with('busInfo', $busInfo);
		        	}


        		}
        	}
        }
        
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}