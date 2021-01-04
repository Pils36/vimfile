<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Moneris
use CraigPaul\Moneris\Moneris;

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

use App\InstorePayment as InstorePayment;

use App\Classes\mpgGlobals;
use App\Classes\httpsPost;
use App\Classes\mpgHttpsPost;
use App\Classes\mpgHttpsPostStatus;
use App\Classes\mpgResponse;
use App\Classes\mpgRequest;
use App\Classes\mpgCustInfo;
use App\Classes\mpgRecur;
use App\Classes\mpgAvsInfo;
use App\Classes\mpgCvdInfo;
use App\Classes\mpgAchInfo;
use App\Classes\mpgConvFeeInfo;
use App\Classes\mpgTransaction;
use App\Classes\MpiHttpsPost;
use App\Classes\MpiResponse;
use App\Classes\MpiRequest;
use App\Classes\MpiTransaction;
use App\Classes\riskHttpsPost;
use App\Classes\riskResponse;
use App\Classes\riskRequest;
use App\Classes\mpgSessionAccountInfo;
use App\Classes\mpgAttributeAccountInfo;
use App\Classes\riskTransaction;
use App\Classes\mpgAxLevel23;
use App\Classes\axN1Loop;
use App\Classes\axRef;
use App\Classes\axIt1Loop;
use App\Classes\axIt106s;
use App\Classes\axTxi;
use App\Classes\mpgAxRaLevel23;
use App\Classes\mpgVsLevel23;
use App\Classes\vsPurcha;
use App\Classes\vsPurchl;
use App\Classes\vsCorpai;
use App\Classes\vsCorpas;
use App\Classes\vsTripLegInfo;
use App\Classes\mpgMcLevel23;
use App\Classes\mcCorpac;
use App\Classes\mcCorpai;
use App\Classes\mcCorpas;
use App\Classes\mcCorpal;
use App\Classes\mcCorpar;
use App\Classes\mcTax;
use App\Classes\CofInfo;
use App\Classes\MCPRate;


class MonerisController extends Controller
{
	public function __construct(Request $request){

		// $id = 'monca04155';
		// $token = 'KvTMr066FKlJm9rD3i71';
		
		// optional
		// $params = [
		//   'environment' => Moneris::ENV_TESTING, // default: Moneris::ENV_LIVE
		//   'avs' => true, // default: false
		//   'cvd' => true, // default: false
		//   'cof' => true, // default: false
		// ];

		// (new Moneris($id, $token, $params))->connect();
		// $gateway = Moneris::create($id, $token, $params);

		// dd($gateway);
	}

	public function index(){
		dd('Hello Moneris');
	}


	public function purchase(Request $req){

		/**************************** Request Variables *******************************/
		
/************************* Transactional Variables ****************************/

// Test API
// $store_id='monca04155';
// $api_token='KvTMr066FKlJm9rD3i71';

// Live API
$store_id='gwca026583';
$api_token='sssLFi2U8VFO0oWvPWax';
        
// $type='purchase';
// $cust_id='cust id';
// $order_id='ord-'.date("dmy-Gis");
// $amount='1.00';
// $pan='4242424242424242';
// $expiry_date='2011';
// $crypt='7';
// $dynamic_descriptor='123';
// $status_check = 'false';



$type='purchase';
$cust_id= $req->customerID;
$order_id='ord-'.date("dmy-Gis");
$amount= $req->tot_amount;
$pan= $req->creditcard_no;
$expiry_date= $req->expirydate.$req->card_month;
$crypt='7';
$dynamic_descriptor= $req->trans_description;
$status_check = 'false';


/*********************** Transactional Associative Array **********************/
$txnArray=array('type'=>$type,
     		    'order_id'=>$order_id,
     		    'cust_id'=>$cust_id,
    		    'amount'=>$amount,
   			    'pan'=>$pan,
   			    'expdate'=>$expiry_date,
   			    'crypt_type'=>$crypt,
   			    'dynamic_descriptor'=>$dynamic_descriptor
				//,'wallet_indicator' => '' //Refer to documentation for details
				//,'cm_id' => '8nAK8712sGaAkls56' //set only for usage with Offlinx - Unique max 50 alphanumeric characters transaction id generated by merchant
				  );

/**************************** Transaction Object *****************************/
$mpgTxn = new mpgTransaction($txnArray);


/******************* Credential on File **********************************/
$cof = new CofInfo();
$cof->setPaymentIndicator("U");
$cof->setPaymentInformation("2");
$cof->setIssuerId("168451306048014");
$mpgTxn->setCofInfo($cof);

/****************************** Request Object *******************************/
$mpgRequest = new mpgRequest($mpgTxn);
$mpgRequest->setProcCountryCode("CA"); //"US" for sending transaction to US environment
$mpgRequest->setTestMode(false); //false or comment out this line for production transactions
/***************************** HTTPS Post Object *****************************/
/* Status Check Example
$mpgHttpPost  =new mpgHttpsPostStatus($store_id,$api_token,$status_check,$mpgRequest);
*/
$mpgHttpPost = new mpgHttpsPost($store_id,$api_token,$mpgRequest);
/******************************* Response ************************************/
$mpgResponse=$mpgHttpPost->getMpgResponse();

// dd($mpgResponse);

if($mpgResponse->responseData['Message'] == "APPROVED           *                    ="){
	// Check if record already exist
	$getPay = EstimatePay::where('estimate_id', $req->estimateID)->get();
	if(count($getPay) > 0){
		// Payment already made for this estimate
		$resData = ['res' => 'You have already made payment for this transaction, contact Admin', 'message' => 'info'];
	}
	else{
		// Insert Record to DB...
		$insPay = EstimatePay::insert(['transactionid' => $mpgResponse->responseData['ReceiptId'], 'name' => $req->name, 'email' => $req->email, 'amount' => $mpgResponse->responseData['TransAmount'], 'station' => $req->updateby, 'post_id' => $req->opportID, 'estimate_id' => $req->estimateID, 'ReceiptId' => $mpgResponse->responseData['ReceiptId'], 'ReferenceNum'=> $mpgResponse->responseData['ReferenceNum'], 'ResponseCode'=> $mpgResponse->responseData['ResponseCode'], 'ISO'=> $mpgResponse->responseData['ISO'], 'AuthCode'=> $mpgResponse->responseData['AuthCode'], 'TransTime'=> $mpgResponse->responseData['TransTime'], 'TransDate'=> $mpgResponse->responseData['TransDate'], 'TransType'=> $mpgResponse->responseData['TransType'], 'Complete'=> $mpgResponse->responseData['Complete'], 'Message'=> $mpgResponse->responseData['Message'], 'TransAmount'=> $mpgResponse->responseData['TransAmount'], 'CardType'=> $mpgResponse->responseData['CardType'], 'TransID'=> $mpgResponse->responseData['TransID'], 'TimedOut'=> $mpgResponse->responseData['TimedOut'], 'Ticket'=> $mpgResponse->responseData['Ticket'], 'IssuerId'=> $mpgResponse->responseData['IssuerId'], 'IsVisaDebit'=> $mpgResponse->responseData['IsVisaDebit'], 'gateway' => 'Moneris']);
		if($insPay == true){
			// Update OpportunityPost
            OpportunityPost::where('post_id', $req->opportID)->update(['state' => 2]);
            
            $this->to = $req->email;
            $this->name = Auth::user()->name;
            $this->subject = "Payment of ".$mpgResponse->responseData['TransAmount']." successfull";
            $this->message = "We have received your payment of ".$mpgResponse->responseData['TransAmount'].". <br><br> Thank you.";
            $this->file = NULL;

            $this->sendEmail($this->to, "Compose Mail");

			$resData = ['res' => 'Payment Approved', 'message' => 'success', 'link' => 'userDashboard'];
		}
		else{
			$resData = ['res' => 'Information not documented, contact Admin', 'message' => 'info'];
		}
	}
	
}
else{
	$resData = ['res' => $mpgResponse->responseData['Message'], 'message' => 'error'];
}

return $this->returnJSON($resData); 

// dd($mpgResponse->responseData['Message']);

// print("\nCardType = " . $mpgResponse->getCardType());
// print("\nTransAmount = " . $mpgResponse->getTransAmount());
// print("\nTxnNumber = " . $mpgResponse->getTxnNumber());
// print("\nReceiptId = " . $mpgResponse->getReceiptId());
// print("\nTransType = " . $mpgResponse->getTransType());
// print("\nReferenceNum = " . $mpgResponse->getReferenceNum());
// print("\nResponseCode = " . $mpgResponse->getResponseCode());
// print("\nISO = " . $mpgResponse->getISO());
// print("\nMessage = " . $mpgResponse->getMessage());
// print("\nIsVisaDebit = " . $mpgResponse->getIsVisaDebit());
// print("\nAuthCode = " . $mpgResponse->getAuthCode());
// print("\nComplete = " . $mpgResponse->getComplete());
// print("\nTransDate = " . $mpgResponse->getTransDate());
// print("\nTransTime = " . $mpgResponse->getTransTime());
// print("\nTicket = " . $mpgResponse->getTicket());
// print("\nTimedOut = " . $mpgResponse->getTimedOut());
// print("\nStatusCode = " . $mpgResponse->getStatusCode());
// print("\nStatusMessage = " . $mpgResponse->getStatusMessage());
// print("\nHostId = " . $mpgResponse->getHostId());
// print("\nIssuerId = " . $mpgResponse->getIssuerId());
	}	



public function purchaseinstore(Request $req){

		/**************************** Request Variables *******************************/
		
/************************* Transactional Variables ****************************/

// Test API
// $store_id='monca04155';
// $api_token='KvTMr066FKlJm9rD3i71';

// Live API
$store_id='gwca026583';
$api_token='sssLFi2U8VFO0oWvPWax';
        
// $type='purchase';
// $cust_id='cust id';
// $order_id='ord-'.date("dmy-Gis");
// $amount='1.00';
// $pan='4242424242424242';
// $expiry_date='2011';
// $crypt='7';
// $dynamic_descriptor='123';
// $status_check = 'false';

$type='purchase';
$cust_id= $req->customerID;
$order_id='ord-'.date("dmy-Gis");
$amount= number_format($req->tot_amount, 2);
$pan= $req->creditcard_no;
$expiry_date= $req->expirydate.$req->card_month;
$crypt='7';
$dynamic_descriptor= $req->trans_description;
$status_check = 'false';


/*********************** Transactional Associative Array **********************/
$txnArray=array('type'=>$type,
     		    'order_id'=>$order_id,
     		    'cust_id'=>$cust_id,
    		    'amount'=>$amount,
   			    'pan'=>$pan,
   			    'expdate'=>$expiry_date,
   			    'crypt_type'=>$crypt,
   			    'dynamic_descriptor'=>$dynamic_descriptor
				//,'wallet_indicator' => '' //Refer to documentation for details
				//,'cm_id' => '8nAK8712sGaAkls56' //set only for usage with Offlinx - Unique max 50 alphanumeric characters transaction id generated by merchant
   		       );
/**************************** Transaction Object *****************************/
$mpgTxn = new mpgTransaction($txnArray);


/******************* Credential on File **********************************/
$cof = new CofInfo();
$cof->setPaymentIndicator("U");
$cof->setPaymentInformation("2");
$cof->setIssuerId("168451306048014");
$mpgTxn->setCofInfo($cof);

/****************************** Request Object *******************************/
$mpgRequest = new mpgRequest($mpgTxn);
$mpgRequest->setProcCountryCode("CA"); //"US" for sending transaction to US environment
$mpgRequest->setTestMode(false); //false or comment out this line for production transactions
/***************************** HTTPS Post Object *****************************/
/* Status Check Example
$mpgHttpPost  =new mpgHttpsPostStatus($store_id,$api_token,$status_check,$mpgRequest);
*/
$mpgHttpPost = new mpgHttpsPost($store_id,$api_token,$mpgRequest);
/******************************* Response ************************************/
$mpgResponse=$mpgHttpPost->getMpgResponse();

// dd($mpgResponse);

if($mpgResponse->responseData['Message'] == "APPROVED           *                    ="){
	// Check if record already exist
	$getPay = InstorePayment::where('estimate_id', $req->estimate_id)->get();

    if(count($getPay) > 0){
        // Payment already made for this estimate
        $resData = ['res' => 'You have already made payment for this transaction', 'message' => 'info'];
    }
    else{
        // Insert Record to DB...
        $insPay = InstorePayment::insert(['transactionid' => $req->orderID, 'estimate_id' => $req->estimate_id, 'name' => $req->name, 'email' => $req->email, 'amount' => $req->amount, 'station' => $req->station, 'technician' => $req->technician, 'purpose' => $req->purpose, 'gateway' => 'Moneris']);

        if($insPay == true){

            $this->to = $req->email;
            $this->name = Auth::user()->name;
            $this->subject = "Payment of ".$req->amount." successfull";
            $this->message = "We have received your payment of ".$req->amount.". <br><br> Thank you.";
            $this->file = NULL;

            $this->sendEmail($this->to, "Compose Mail");

            $resData = ['res' => 'Payment Made', 'message' => 'success', 'link' => 'userDashboard'];
        }
        else{
            $resData = ['res' => 'Information not documented, contact Admin', 'message' => 'info'];
        }
    }
	
}
else{
	$resData = ['res' => $mpgResponse->responseData['Message'], 'message' => 'error'];
}

return $this->returnJSON($resData); 

	}


public function processPayment(Request $req){

	// Test API
$store_id='monca04155';
$api_token='KvTMr066FKlJm9rD3i71';

// Live API
// $store_id='gwca026583';
// $api_token='sssLFi2U8VFO0oWvPWax';

$orderid='ord-'.date("dmy-G:i:s");
$dynamic_descriptor='Receive Payment for vehicle licence: '.$req->licence;

## step 1) create transaction array ###
$txnArray=array('type'=>'ind_refund',
         'order_id'=> $orderid,
         'cust_id'=> $req->licence,
         'amount'=> number_format((float)$req->total_payment_made, 2, '.', ''),
         'pan'=>$req->card_number,
         'expdate'=>$req->cc,
         'crypt_type'=>'7',
         'dynamic_descriptor'=>$dynamic_descriptor
           );

## step 2) create a transaction  object passing the array created in
## step 1.

$mpgTxn = new mpgTransaction($txnArray);

## step 3) create a mpgRequest object passing the transaction object created
## in step 2
$mpgRequest = new mpgRequest($mpgTxn);
$mpgRequest->setProcCountryCode("CA"); //"US" for sending transaction to US environment
$mpgRequest->setTestMode(true); //false or comment out this line for production transactions

## step 4) create mpgHttpsPost object which does an https post ##
$mpgHttpPost  =new mpgHttpsPost($store_id,$api_token,$mpgRequest);

## step 5) get an mpgResponse object ##
$mpgResponse=$mpgHttpPost->getMpgResponse();

## step 6) retrieve data using get methods

dd($mpgResponse);

print("\nCardType = " . $mpgResponse->getCardType());
print("\nTransAmount = " . $mpgResponse->getTransAmount());
print("\nTxnNumber = " . $mpgResponse->getTxnNumber());
print("\nReceiptId = " . $mpgResponse->getReceiptId());
print("\nTransType = " . $mpgResponse->getTransType());
print("\nReferenceNum = " . $mpgResponse->getReferenceNum());
print("\nResponseCode = " . $mpgResponse->getResponseCode());
print("\nISO = " . $mpgResponse->getISO());
print("\nMessage = " . $mpgResponse->getMessage());
print("\nIsVisaDebit = " . $mpgResponse->getIsVisaDebit());
print("\nAuthCode = " . $mpgResponse->getAuthCode());
print("\nComplete = " . $mpgResponse->getComplete());
print("\nTransDate = " . $mpgResponse->getTransDate());
print("\nTransTime = " . $mpgResponse->getTransTime());
print("\nTicket = " . $mpgResponse->getTicket());
print("\nTimedOut = " . $mpgResponse->getTimedOut());



return $this->returnJSON($resData);
}	




	public function returnJSON($data){
        return response()->json($data);
    }

}

