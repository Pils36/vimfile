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

use App\Admin as Admin;

use App\Vehicleinfo as Vehicleinfo;

use App\Business as Business;

use App\Carrecord as Carrecord;

use App\reminderNotify as reminderNotify;

use App\Stations as Stations;

use App\BusinessStaffs as BusinessStaffs;

use App\BookAppointment as BookAppointment;

use App\RevenueReport as RevenueReport;

use App\QuickMail as QuickMail;

use App\PayPlan as PayPlan;

use App\Activity as Activity;

use App\AskExpert as AskExpert;

use App\AnsFromExpert as AnsFromExpert;

use App\VehicleLogs as VehicleLogs;

use App\Ticketing as Ticketing;

use App\PayResult as PayResult;

use App\GoogleImport as GoogleImport;

use App\RedeemPoints as RedeemPoints;

use App\OpportunityPost as OpportunityPost;

use App\PrepareEstimate as PrepareEstimate;

use App\EstimatePay as EstimatePay;

use App\Estimate as Estimate;

use App\Newshappening as Newshappening;

use App\MinimumDiscount as MinimumDiscount;

use App\clientMinimum as clientMinimum;

use App\Feedback as Feedback;

use App\SuggestedMechanics as SuggestedMechanics;

use App\Review as Review;

use App\Message as Message;

use App\SuggestedDealers as SuggestedDealers;

use App\PromotionalMaterial as PromotionalMaterial;

use App\WorkFlow as WorkFlow;


//Session
use Session;

use PDF;
use App;

//Mail

use App\Mail\sendEmail;

use App\Traits\VimApp;

use Storage;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Mail;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\RedirectResponse;

use Illuminate\Routing\Redirector;

class AdminController extends Controller
{

	use VimApp;

	public $free_trial;

	public $workflowcount;

	public function __construct(Request $request)
    {

		


    	// RUN ChEck
    	$data = Admin::all();

    	foreach ($data as $key => $value) {
    		// Get stations
    		$user = user::where('email', $value->email)->get();

    		if(count($user) > 0){
    			// Do Nothing
    		}
    		else{
    			// Insert
    			// $username = explode(" ", $value->name);
    			// Get business
    			$business = Business::where('busID', $value->busID)->get();

    			if(count($business) > 0){
				$insAcct = User::insert(['ref_code' => '', 'name' => $value->name, 'email' => $value->email, 'password' => Hash::make($value->password), 'userType' => $value->accountType, 'phone_number' => $business[0]['telephone'], 'city' => $business[0]['city'], 'state' => $business[0]['state'], 'country' => $business[0]['country'], 'zipcode' => $business[0]['zipcode'], 'email1' => '', 'email2' => '', 'email3' => '', 'busID' => $business[0]['busID'], 'station_name' => $business[0]['name_of_company'], 'maiden_name' => $business[0]['maiden_name'], 'parent_meet' => $business[0]['parent_meet'], 'plan' => $business[0]['plan'], 'status' => '1', 'bankstatement' => '', 'creditcard' => '', 'market_place' => '', 'referred_by' => '', 'size_of_employee' => '', 'year_of_practice' => '', 'specialization' => '', 'mobile' => $business[0]['mobile'], 'office' => $business[0]['office'], 'trade_certificate' => ""]);

	        	// Insert Station Info
	        	Stations::insert(['busID' => $business[0]['busID'], 'station_name' => $business[0]['name_of_company'], 'station_address' => $business[0]['address'], 'station_phone' => $business[0]['telephone'], 'city' => $business[0]['city'], 'state' => $business[0]['state'], 'country' => $business[0]['country'], 'zipcode' => $business[0]['zipcode'], 'role' => $value->role, 'service_offered' => $value->role]);
    			}



    		}

    	}


        $this->getIp = $_SERVER['REMOTE_ADDR'];

        $this->arr_ip = geoip()->getLocation($this->getIp);
        // $this->arr_ip = geoip()->getLocation('105.112.52.58');

        $this->country = $this->arr_ip['country'];
		$this->continent = $this->arr_ip['continent'];



		$this->workflowcount = $this->getWorkflowcount();


	}
	

 	public function index(Request $req){

//  		dd($req->session()->all());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
         $autoStaffs = $this->autoStaffs();
         $supportagent = $this->supportagent(session('busID'));
         $mechCreated = $this->mechCreates();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);
		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

		

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);

		 // if(count($regCars) > 0){
			// 	foreach ($regCars as $key => $value) {
			// 		// Check Car rec not in maintenance
			// 		$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

			// 		$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
			// 	}
			// }

		 $crawl = $this->crawledmechanics();
		 $crawldealers = $this->crawledautodealers();
		 $claimsCount = $this->claimcount();
		 $askexpert = $this->expertInformation();

		//  Get Free Users
		$freeusers = $this->getFreetrial();
		$paidusers = $this->getPaidPlan();
		$freeplanusers = $this->getfreePlan();

         $nomails = $this->noemails();

         $busMechs = Business::orderBy('created_at', 'DESC')->get();
         $sugMechs = SuggestedMechanics::orderBy('created_at', 'DESC')->get();

         $allmechanic = array_merge($busMechs->toArray(), $sugMechs->toArray());

         $reviews = Review::where('busID', session('busID'))->get();

         $this->checkplanExp(session('email'));

		 $newmail = $this->newMails(session('email'));
		 

		 $getUser = Admin::where('busID', session('busID'))->get();

		$this->free_trial = $getUser[0]->free_trial_expire;

		$workflowcount = $this->workflowcount;

		$agreementsign = Admin::where('signed_agreement', 1)->orderBy('updated_at', 'DESC')->get();

		$agentNotification = DB::table('agent_notification')->where('agent_id', session('id'))->where('read_state', 0)
		->orderBy('created_at', 'DESC')->get();

		if(session('role') == "Agent"){

			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits the Dashboard');
		}


		

 		return view('admin.index')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'crawl' => $crawl, 'crawldealers' => $crawldealers, 'nomails' => $nomails, 'claimsCount' => $claimsCount, 'allmechanic' => $allmechanic, 'reviews' => $reviews, 'newmail' => $newmail, 'askexpert' => $askexpert, 'supportagent' => $supportagent, 'free_trial' => $this->free_trial, 'freeusers' => $freeusers, 'paidusers' => $paidusers, 'freeuserscount' => $this->getFreetrialcount(), 'paiduserscount' => $this->getPaidPlancount(), 'freeplanusers' => $freeplanusers, 'freeplanuserscount' => $this->getfreePlancount(), 'workflowcount' => $workflowcount, 'agreementsign' => $agreementsign, 'mechCreated' => $mechCreated, 'agentNotification' => $agentNotification]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


	 }

	 
 	public function createdMechanics(Request $req){

//  		dd($req->session()->all());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
         $autoStaffs = $this->autoStaffs();
         $supportagent = $this->supportagent(session('busID'));
         $mechCreated = $this->mechCreates();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);
		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);

		 // if(count($regCars) > 0){
			// 	foreach ($regCars as $key => $value) {
			// 		// Check Car rec not in maintenance
			// 		$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

			// 		$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
			// 	}
			// }

		 $crawl = $this->crawledmechanics();
		 $crawldealers = $this->crawledautodealers();
		 $claimsCount = $this->claimcount();
		 $askexpert = $this->expertInformation();

		//  Get Free Users
		$freeusers = $this->getFreetrial();
		$paidusers = $this->getPaidPlan();
		$freeplanusers = $this->getfreePlan();

         $nomails = $this->noemails();

         $busMechs = Business::orderBy('created_at', 'DESC')->get();
         $sugMechs = SuggestedMechanics::orderBy('created_at', 'DESC')->get();

         $allmechanic = array_merge($busMechs->toArray(), $sugMechs->toArray());

         $reviews = Review::where('busID', session('busID'))->get();

         $this->checkplanExp(session('email'));

		 $newmail = $this->newMails(session('email'));
		 

		 $getUser = Admin::where('busID', session('busID'))->get();

		$this->free_trial = $getUser[0]->free_trial_expire;

		$workflowcount = $this->workflowcount;

		$agreementsign = Admin::where('signed_agreement', 1)->orderBy('updated_at', 'DESC')->get();

		if(session('role') == "Agent"){

			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits signed up mechanics page');
		}

 		return view('admin.createdmechanics')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'crawl' => $crawl, 'crawldealers' => $crawldealers, 'nomails' => $nomails, 'claimsCount' => $claimsCount, 'allmechanic' => $allmechanic, 'reviews' => $reviews, 'newmail' => $newmail, 'askexpert' => $askexpert, 'supportagent' => $supportagent, 'free_trial' => $this->free_trial, 'freeusers' => $freeusers, 'paidusers' => $paidusers, 'freeuserscount' => $this->getFreetrialcount(), 'paiduserscount' => $this->getPaidPlancount(), 'freeplanusers' => $freeplanusers, 'freeplanuserscount' => $this->getfreePlancount(), 'workflowcount' => $workflowcount, 'agreementsign' => $agreementsign, 'mechCreated' => $mechCreated]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


	 }
	 

	 public function mechCreates(){
		 $data = Admin::where('created_by', '!=', NULL)->orderBy('created_at', 'DESC')->get();

		 return $data;
	 }


 	public function adminnoncommercial(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$noncommercial = User::where('userType', 'Individual')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);
		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);

		$workflowcount = $this->workflowcount;

		if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits list of non-commercial vehicle owners page');
		}


 		return view('admin.pages.noncommercial')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'noncommercial' => $noncommercial, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


     }



 	public function allMechanics(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 		$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$noncommercial = User::where('userType', 'Individual')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);
		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }


        //  Get All Mechanics and SUggested Mechanics

         $busMechs = Business::orderBy('created_at', 'DESC')->get();
         $sugMechs = SuggestedMechanics::orderBy('created_at', 'DESC')->get();

         $allmechanic = array_merge($busMechs->toArray(), $sugMechs->toArray());

		 $workflowcount = $this->workflowcount;

		 if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits all mechanics page');
		}


 		return view('admin.pages.allmechanics')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'noncommercial' => $noncommercial, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'allmechanic' => $allmechanic, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


	 }
	 


    //  Mailing Modules

 	public function composemail(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 		$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$noncommercial = User::where('userType', 'Individual')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);
		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }


        //  Get All Mechanics and SUggested Mechanics

         $busMechs = Business::orderBy('created_at', 'DESC')->get();
         $sugMechs = SuggestedMechanics::orderBy('created_at', 'DESC')->get();

         $allmechanic = array_merge($busMechs->toArray(), $sugMechs->toArray());

         $newmail = $this->newMails(session('email'));
        $sentmail = $this->sentMails(session('busID'));
        $draftmail = $this->draftMails(session('busID'));
        $trashmail = $this->trashMails(session('busID'));

		$workflowcount = $this->workflowcount;

		if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits compose mail page');
		}

 		return view('admin.pages.mailbox.compose')->with(['pages'=> 'Compose Mail', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'noncommercial' => $noncommercial, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'allmechanic' => $allmechanic, 'newmail' => $newmail, 'sentmail' => $sentmail, 'draftmail' => $draftmail, 'trashmail' => $trashmail, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


     }


 	public function inbox(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 		$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$noncommercial = User::where('userType', 'Individual')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);
		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }


        //  Get All Mechanics and SUggested Mechanics

         $busMechs = Business::orderBy('created_at', 'DESC')->get();
         $sugMechs = SuggestedMechanics::orderBy('created_at', 'DESC')->get();

         $allmechanic = array_merge($busMechs->toArray(), $sugMechs->toArray());

         $newmail = $this->newMails(session('email'));
        $sentmail = $this->sentMails(session('busID'));
        $draftmail = $this->draftMails(session('busID'));
        $trashmail = $this->trashMails(session('busID'));

        $receivedmail = $this->receivedMails(session('email'));

		$workflowcount = $this->workflowcount;

		if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits mail inbox page');
		}

 		return view('admin.pages.mailbox.mailbox')->with(['pages'=> 'Inbox', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'noncommercial' => $noncommercial, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'allmechanic' => $allmechanic, 'newmail' => $newmail, 'receivedmail' => $receivedmail, 'sentmail' => $sentmail, 'draftmail' => $draftmail, 'trashmail' => $trashmail, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


     }


 	public function sentmail(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 		$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$noncommercial = User::where('userType', 'Individual')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);
		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }


        //  Get All Mechanics and SUggested Mechanics

         $busMechs = Business::orderBy('created_at', 'DESC')->get();
         $sugMechs = SuggestedMechanics::orderBy('created_at', 'DESC')->get();

         $allmechanic = array_merge($busMechs->toArray(), $sugMechs->toArray());

         $newmail = $this->newMails(session('email'));
        $draftmail = $this->draftMails(session('busID'));
        $trashmail = $this->trashMails(session('busID'));

        $sentMail = $this->sentMails(session('busID'));

		$workflowcount = $this->workflowcount;


		if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits sent mail page');
		}

 		return view('admin.pages.mailbox.sentmail')->with(['pages'=> 'Sent Mail', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'noncommercial' => $noncommercial, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'allmechanic' => $allmechanic, 'newmail' => $newmail, 'sentMail' => $sentMail, 'draftmail' => $draftmail, 'trashmail' => $trashmail, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


     }


 	public function drafts(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 		$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$noncommercial = User::where('userType', 'Individual')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);
		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }


        //  Get All Mechanics and SUggested Mechanics

         $busMechs = Business::orderBy('created_at', 'DESC')->get();
         $sugMechs = SuggestedMechanics::orderBy('created_at', 'DESC')->get();

         $allmechanic = array_merge($busMechs->toArray(), $sugMechs->toArray());

         $newmail = $this->newMails(session('email'));

        $sentmail = $this->sentMails(session('busID'));
        $trashmail = $this->trashMails(session('busID'));

        $draftMail = $this->draftMails(session('busID'));

		$workflowcount = $this->workflowcount;

		if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits drafted mail page');
		}

 		return view('admin.pages.mailbox.drafts')->with(['pages'=> 'Draft Mail', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'noncommercial' => $noncommercial, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'allmechanic' => $allmechanic, 'newmail' => $newmail, 'draftMail' => $draftMail, 'sentmail' => $sentmail, 'trashmail' => $trashmail, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


 	}


 	public function trash(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 		$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$noncommercial = User::where('userType', 'Individual')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);
		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }


        //  Get All Mechanics and SUggested Mechanics

         $busMechs = Business::orderBy('created_at', 'DESC')->get();
         $sugMechs = SuggestedMechanics::orderBy('created_at', 'DESC')->get();

         $allmechanic = array_merge($busMechs->toArray(), $sugMechs->toArray());

        $newmail = $this->newMails(session('email'));

        $sentmail = $this->sentMails(session('busID'));
        $draftmail = $this->draftMails(session('busID'));
        $trashmail = $this->trashMails(session('busID'));

        $trashMail = $this->trashMails(session('busID'));

		$workflowcount = $this->workflowcount;

		if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits trashed mail page');
		}

 		return view('admin.pages.mailbox.trash')->with(['pages'=> 'Trash Mail', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'noncommercial' => $noncommercial, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'allmechanic' => $allmechanic, 'newmail' => $newmail, 'trashMail' => $trashMail, 'sentmail' => $sentmail, 'draftmail' => $draftmail, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


     }


 	public function readmail(Request $req, $id){

 		// dd(session());

 		if(Session::has('username') == true){
 		$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$noncommercial = User::where('userType', 'Individual')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);
		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }


        //  Get All Mechanics and SUggested Mechanics

         $busMechs = Business::orderBy('created_at', 'DESC')->get();
         $sugMechs = SuggestedMechanics::orderBy('created_at', 'DESC')->get();

         $allmechanic = array_merge($busMechs->toArray(), $sugMechs->toArray());

        $newmail = $this->newMails(session('email'));
        $sentmail = $this->sentMails(session('busID'));
        $draftmail = $this->draftMails(session('busID'));
        $trashmail = $this->trashMails(session('busID'));



        $readMail = $this->readMails($id);

		$workflowcount = $this->workflowcount;


		if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits to read mail');
		}

 		return view('admin.pages.mailbox.readmail')->with(['pages'=> 'Read Mail', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'noncommercial' => $noncommercial, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'allmechanic' => $allmechanic, 'newmail' => $newmail, 'readMail' => $readMail, 'sentmail' => $sentmail, 'draftmail' => $draftmail, 'trashmail' => $trashmail, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


 	}

 	public function admincommercial(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		// $commercial = DB::table('users')
			// ->join('business', 'users.busID', '=', 'business.busID')
			// ->where('users.userType', 'Commercial')->orWhere('business.accountType', 'Commercial')
			// ->orderBy('business.created_at', 'DESC')->get();
 		$commercial = User::where('userType', 'Commercial')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);

		$workflowcount = $this->workflowcount;

		if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits list of commercial vehicle owners page');
		}

 		return view('admin.pages.commercial')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'commercial' => $commercial, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


 	}

 	public function admincorporate(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$corporate = User::where('userType', 'Business')->orderBy('created_at', 'DESC')->get();
 		$corporate_owner = Business::where('accountType', 'Business')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();

			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);

		$workflowcount = $this->workflowcount;

		if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits list of corporate vehicle owners page');
		}


 		return view('admin.pages.corporate')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'corporate' => $corporate, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'corporate_owner' => $corporate_owner, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


 	}

 	public function adminautodeals(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$autodeals = User::where('userType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();

			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}


			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);

		$workflowcount = $this->workflowcount;


		if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits list of auto dealers page');
		}

 		return view('admin.pages.autodeals')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'autodeals' => $autodeals, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


 	}

 	public function adminmobilemechs(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$mobileMechs = User::where('userType', 'Certified Professional')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();

			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);


		$workflowcount = $this->workflowcount;

		if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits list of mobile mechanics page');
		}

 		return view('admin.pages.mobilemechs')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'mobileMechs' => $mobileMechs, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


 	}


 	public function adminautocare(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$autocares = User::where('userType', 'Auto Care')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}


		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);

		$workflowcount = $this->workflowcount;


		if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits list of auto care page');
		}

 		return view('admin.pages.autocare')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'autocares' => $autocares, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


 	}


 	public function adminautocarestaff(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$autocares = User::where('userType', 'Auto Care')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}


		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);

		$workflowcount = $this->workflowcount;

		if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits list of auto care staff page');
		}


 		return view('admin.pages.autocarestaff')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'autocares' => $autocares, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


 	}




    public function supportticket(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$autocares = User::where('userType', 'Auto Care')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}


		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);

		$workflowcount = $this->workflowcount;

		if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits support ticket page');
		}

 		return view('admin.pages.supportticket')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'autocares' => $autocares, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


 	}


     public function profile(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$autocares = User::where('userType', 'Auto Care')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}


		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);

            $userDetails = User::where('email', session('email'))->get();
            $station = Business::where('email', session('email'))->get();
            $stationreviews = Review::where('busID', session('busID'))->count();
            $mystaffcount = User::where('busID', session('busID'))->count();
            $mystationcount = Stations::where('busID', session('busID'))->count();

           $profileDetails = array_merge($userDetails->toArray(), $station->toArray());


		   $workflowcount = $this->workflowcount;


		   if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits profile page');
		}

 		return view('admin.pages.profile')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'autocares' => $autocares, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'profileDetails' => $profileDetails, 'reviewcount' => $stationreviews, 'mystaffcount' => $mystaffcount, 'mystationcount' => $mystationcount, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


	 }
	 

	//  Agent Update Information
	public function agentprofileInfo(Request $req, $busID){

		// dd(session());

		if(Session::has('username') == true){
			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		$getUsers = User::orderBy('created_at', 'DESC')->get();
		$autocares = User::where('userType', 'Auto Care')->orderBy('created_at', 'DESC')->get();
		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

		$countnonCom = User::where('userType', 'Individual')->count();
		$countCom = User::where('userType', 'Commercial')->count();
		$countCorp = User::where('userType', 'Business')->count();
		$countstaffCorp = Business::where('accountType', 'Business')->count();
		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
		$countcertProf = User::where('userType', 'Certified Professional')->count();
		$countautCare = User::where('userType', 'Auto Care')->count();

		$autoStores = $this->autoStores();
		$autoStaffs = $this->autoStaffs();

		// GEt Maintenance Record count
		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		// $CarRec = Carrecord::where('busID', session('busID'))->get();
		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
	   $CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

	   $regCars = Carrecord::orderBy('created_at', 'DESC')->get();

	   if(count($regCars) > 0){
			   foreach ($regCars as $key => $value) {
				   // Check Car rec not in maintenance
				   $carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

				   $carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
			   }
		   }


	   $discount = MinimumDiscount::where('discount', 'discount')->get();
	   $service_charge = MinimumDiscount::where('discount', 'service')->get();

	   $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
	   $service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

	   // dd($discountcharge);

	   // dd(count($CarReccount));

	   // Get Clients Subscription Plans
	   $this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


	   $from = date('Y-m-01');
	   $to = date('Y-m-d');

	   $nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

	   $carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


		// Get No of vehicles count
		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

		// Ticketing
		   $tickets = Ticketing::orderBy('created_at', 'DESC')->get();
		   if(count($tickets) > 0){
			   $this->ticketing = $tickets;
		   }
		   else{
			   $this->ticketing = "";
		   }

		   $getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

		   if(count($getAD) > 0){
			   $this->getAD = $getAD;
		   }
		   else{
			   $this->getAD = "";
		   }



		   // Registered & Unregistered clients
		   $_RegClient = GoogleImport::where('status', 'registered')->get();
		   if(count($_RegClient) > 0){
			   $this->RegClient = $_RegClient;
		   }
		   else{
			   $this->RegClient = "";
		   }


		   $_UnregClient = GoogleImport::where('status', 'not registered')->count();

		   if($_UnregClient > 0){
			   $this->unregisteredClients = $_UnregClient;
		   }
		   else{
			   $this->unregisteredClients = 0;
		   }

		   $estimatePayment = DB::table('estimatepay')
					   ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
					   ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
					   ->where('opportunitypost.state', '=', 1)
					   ->orderBy('estimatepay.created_at', 'DESC')->get();

					   // dd($estimatePayment);

		   $workinprogress = DB::table('estimate')
					   ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
					   ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
					   ->where('opportunitypost.state', '=', 2)
					   ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

					   // dd($workinprogress);

		if(session('role') == "Super"){
			$getStations = Stations::orderBy('created_at', 'DESC')->get();
			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
			$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
			$getBussiness = Business::all();
			$usersPersonal = User::orderBy('created_at', 'DESC')->get();
			$this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			$this->getPayment = DB::table('payment_plan')
		   ->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
		   ->orderBy('payment_plan.created_at', 'DESC')->get();
		   $CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
		   $regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		   $maintReccount = Vehicleinfo::count();
		   $maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


		   // Ticketing
		   $tickets = Ticketing::orderBy('created_at', 'DESC')->get();
		   if(count($tickets) > 0){
			   $this->ticketing = $tickets;
		   }
		   else{
			   $this->ticketing = "";
		   }

		   $getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

		   if(count($getAD) > 0){
			   $this->getAD = $getAD;
		   }
		   else{
			   $this->getAD = "";
		   }



		   // Registered & Unregistered clients
		   $_RegClient = GoogleImport::where('status', 'registered')->get();
		   if(count($_RegClient) > 0){
			   $this->RegClient = $_RegClient;
		   }
		   else{
			   $this->RegClient = "";
		   }


		   $_UnregClient = GoogleImport::where('status', 'not registered')->count();

		   if($_UnregClient > 0){
			   $this->unregisteredClients = $_UnregClient;
		   }
		   else{
			   $this->unregisteredClients = 0;
		   }

		   // Get User with referals

		   $getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

		   if(count($getUserref) > 0){

			   $this->refree = $getUserref;
		   }
		   else{
			   $this->refree = "";
		   }

		}

	   //  dd($this->getPayment);

		   $userDetails = User::where('busID', $busID)->get();
		   $station = Business::where('busID', $busID)->get();

		   $stationreviews = Review::where('busID', session('busID'))->count();
		   $mystaffcount = User::where('busID', session('busID'))->count();
		   $mystationcount = Stations::where('busID', session('busID'))->count();

		  $profileDetails = array_merge($userDetails->toArray(), $station->toArray());


		  $workflowcount = $this->workflowcount;

		  if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits profile page');
		}

		return view('admin.pages.agentprofile')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'autocares' => $autocares, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'profileDetails' => $profileDetails, 'reviewcount' => $stationreviews, 'mystaffcount' => $mystaffcount, 'mystationcount' => $mystationcount, 'workflowcount' => $workflowcount]);
		}
		else{
			return redirect()->route('AdminLogin');
		}


	}



 	public function crawlcountry(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$autocares = User::where('userType', 'Auto Care')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}


		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);

		 $crawlsort = $this->crawlcountrysort();

		 $workflowcount = $this->workflowcount;

		 if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits list of mechanics categorized by country');
		}

 		return view('admin.pages.crawlcountry')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'autocares' => $autocares, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'crawlsort' => $crawlsort, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


 	}



 	public function crawlState(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$autocares = User::where('userType', 'Auto Care')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}


		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);

		 $crawlsort = $this->crawlstateSort($req->get('country'));

		 $workflowcount = $this->workflowcount;

		 if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits list of mechanics categorized by state/province');
		}

 		return view('admin.pages.crawlstate')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'autocares' => $autocares, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'crawlsort' => $crawlsort, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


 	}



 	public function crawlletter(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$autocares = User::where('userType', 'Auto Care')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}


		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);

		 $crawlsort = $this->crawLetter($req->get('country'));

		 $workflowcount = $this->workflowcount;

		 if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits page to print letter');
		}

 		return view('admin.pages.crawlletter')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'autocares' => $autocares, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'crawlsort' => $crawlsort, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


 	}



 	public function crawlsnoMail(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$autocares = User::where('userType', 'Auto Care')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}


		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);

		 $crawlsort = $this->noemails();

		 $workflowcount = $this->workflowcount;

		 if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits list of mechanics not yet registered');
		}

 		return view('admin.pages.noemail')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'autocares' => $autocares, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'crawlsort' => $crawlsort, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


     }
     

 	public function crawlstoclaim(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$autocares = User::where('userType', 'Auto Care')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}


		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);

		 $crawlsort = $this->noemails();

		 $workflowcount = $this->workflowcount;

		 if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits list of mechanics claiming business');
		}

 		return view('admin.pages.crawlstoclaim')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'autocares' => $autocares, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'crawlsort' => $crawlsort, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


 	}


 	public function crawlprint(Request $req){

 		// dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$autocares = User::where('userType', 'Auto Care')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}


		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);

		 $crawlsort = $this->justcountry();

		 $workflowcount = $this->workflowcount;

		 if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits list of mechanics to print letter');
		}

 		return view('admin.pages.crawlprint')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'autocares' => $autocares, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'crawlsort' => $crawlsort, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


 	}



 	public function mechanicsIn(Request $req, $country){

 		// dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$autocares = User::where('userType', 'Auto Care')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}


		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);

		 $crawlsort = $this->noemailmechanicbycountry($country);

		 $workflowcount = $this->workflowcount;

		 if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits list of mechanics in '.$country);
		}
		 

 		return view('admin.pages.mechanicsIn')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'autocares' => $autocares, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'crawlsort' => $crawlsort, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


     }
     

 	public function supportmechanicsIn(Request $req, $country){

 		// dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$autocares = User::where('userType', 'Auto Care')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}


		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);

		 $crawlsort = $this->noemailmechanicbycountry($country);

		 $workflowcount = $this->workflowcount;

		 if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits list of mechanics in '.$country);
		}

 		return view('admin.pages.supportmechanicsIn')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'autocares' => $autocares, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'crawlsort' => $crawlsort, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


 	}

	 public function pricing(Request $req){

		$continents = explode('/', $this->arr_ip['timezone']);

 		$this->checkSession(session('_token'));

 		$getAdmins = Admin::where('role', '!=', 'Super')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		$discount = MinimumDiscount::where('discount', 'discount')->get();
 		$service_charge = MinimumDiscount::where('discount', 'service')->get();

 		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		//  dd($this->getPayment);


		$workflowcount = $this->workflowcount;

		if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits the pricing page');
		}

 		return view('admin.pages.pricing')->with(['pages'=> 'Pricing', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'email' => session('email'), 'continent' => $continents[0], 'error' => $this->error, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
	 }

	 // Payment Page
	 public function makepay(Request $req)
	 {
		 if(session('role') == "Owner"){
			 // Get Client Info
		 $client = Admin::where('email', session('email'))->get();

		 if(count($client) > 0 && $client[0]->busID != null){
			 // Get Company Logo and Address
			 $getbusInfo = Business::where('busID', $client[0]->busID)->get();

			 if(count($getbusInfo) > 0){
				 $this->busInfo = $getbusInfo;
			 }
			 else{
				 $this->busInfo = "";
			 }
		 }
			 // GEt Transaction ID for user
			 $this->transID = PayPlan::where('transaction_id', $req->route('id'))->get();
		 }
		 else{
			 $this->transID = '';
		 }

		 $this->checkSession(session('_token'));

 		$getAdmins = Admin::where('role', '!=', 'Super')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);
		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->get();

		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Making A Payment');

		 $workflowcount = $this->workflowcount;

		 if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits the pricing page');
		}

		 return view('admin.pages.makepay')->with(['pages' => 'Payment', 'location' => $this->arr_ip, 'transaction' => $this->transID, 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'email' => session('email'), 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' =>$countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
	 }

	public function allnews(Request $req){

        // dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);
		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

		$allPosts = Newshappening::orderBy('created_at', 'DESC')->get();


		$workflowcount = $this->workflowcount;

		if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits the news happening now page');
		}

 		return view('admin.pages.allnews')->with(['pages'=> 'All News and Happenings', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'allPosts' => $allPosts, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}

    }

    public function allpostaction(Request $req){

        // Get News Post
        $getPost = Newshappening::where('id', $req->id)->get();
        if(count($getPost) > 0){
            if($req->val == "delete_news"){
                $postDel = Newshappening::where('id', $req->id)->delete();
                $resData = ['message' => 'Successfully deleted', 'title' => ' Good ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'success', 'link' => 'Allnews', 'action' => 'delete_news'];
            }
            elseif($req->val == "view_news"){
                $resData = ['message' => 'Fetching..', 'title' => ' Good ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'success', 'data' => json_encode($getPost), 'action' => 'view_news'];
            }
            elseif($req->val == "edit_news"){
                $resData = ['message' => 'Fetching..', 'title' => ' Good ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'success', 'data' => json_encode($getPost), 'action' => 'edit_news'];
            }
        }
        else{
            $resData = ['message' => 'Post does not exist', 'title' => ' Oops ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'error'];
        }

        return $this->returnJSON($resData);
    }

 	public function stationreport(Request $req){
 		$this->checkSession(session('_token'));

 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}


		 if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();

			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $workflowcount = $this->workflowcount;

		 if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits the station report page');
		}

 		return view('admin.stationreport')->with(['pages'=> 'Dashboard', 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}

 	public function maintenanceservicetypereport(Request $req){
 		$this->checkSession(session('_token'));

 		$getStations = Stations::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		 if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $workflowcount = $this->workflowcount;

		 if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits the station report page');
		}

		 return view('admin.maintenanceservicetyperecord')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);

 	}

 	public function maintenanceserviceoptionreport(Request $req){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $workflowcount = $this->workflowcount;

		 if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits the station report page');
		}

 		return view('admin.maintenanceserviceoptionrecord')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}

 	// Registered Clients
 	public function registeredclients(Request $req){
 		$this->checkSession(session('_token'));

		 		$getAdmins = Admin::where('role', '!=', 'Super')->get();
		 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getUsers = User::orderBy('created_at', 'DESC')->get();
		 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

		 		// GEt Maintenance Record count
		 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
		 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->get();

		 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		        $CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
		        $regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		        if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		 		// Get No of vehicles count
		 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
		 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getBussiness = Business::where('busID', session('busID'))->get();
		 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

		 		$discount = MinimumDiscount::where('discount', 'discount')->get();
		 		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		 		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
				$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 		if(session('role') == "Super"){
		 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
		 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
			 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
			 		$getBussiness = Business::all();
			 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			 		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			 		$maintReccount = Vehicleinfo::count();
			 		$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();
			 		$this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();

					 		// Registered Invites
				 $regInvites = GoogleImport::where('status', 'registered')->get();
		 		}

				 $workflowcount = $this->workflowcount;

				 if(session('role') == "Agent"){
					$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits the registered users page');
				}

		 return view('admin.registeredclient')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'maintRec' => $maintRec, 'carRec' => $CarRec, 'otherUsers' => $this->otherUsers, 'reginvites' => $regInvites, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}

 	// Not Registered Clients
 	public function unregisteredclients(Request $req){
 		$this->checkSession(session('_token'));

		 		$getAdmins = Admin::where('role', '!=', 'Super')->get();
		 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getUsers = User::orderBy('created_at', 'DESC')->get();
		 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

		 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();


 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 		// GEt Maintenance Record count
		 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
		 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->get();

		 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		        $CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();

		        $regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		        if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		 		// Get No of vehicles count
		 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
		 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getBussiness = Business::where('busID', session('busID'))->get();
		 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

		 		$discount = MinimumDiscount::where('discount', 'discount')->get();
		 		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		 		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
				$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 		if(session('role') == "Super"){
		 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
		 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
			 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
			 		$getBussiness = Business::all();
			 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			 		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			 		$maintReccount = Vehicleinfo::count();
			 		$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();
			 		$this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();

			 		// Unregistered Invites
					$unregInvites = GoogleImport::where('status', 'not registered')->get();
		 		}


				 $workflowcount = $this->workflowcount;

				 if(session('role') == "Agent"){
					$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits the not yet registered users page');
				}

		 		return view('admin.unregisteredclient')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, '$regCars' => $regCars, 'maintRec' => $maintRec, 'carRec' => $CarRec, 'otherUsers' => $this->otherUsers, 'unreginvites' => $unregInvites, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}

 	public function clientprofile(Request $req){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();
		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }


		 $workflowcount = $this->workflowcount;

		 if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' views users profile');
		}

 		return view('admin.clientprofile')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
     }
     
        
    
     public function claimSupport(Request $req, $id){

 		// dd(session());

 		if(Session::has('username') == true){
 			$getAdmins = Admin::where('role', '!=', 'Super')->orderBy('created_at', 'DESC')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$autocares = User::where('userType', 'Auto Care')->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get(['vehicle_licence']);

		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}


		$discount = MinimumDiscount::where('discount', 'discount')->get();
		$service_charge = MinimumDiscount::where('discount', 'service')->get();

		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// dd($discountcharge);

		// dd(count($CarReccount));

		// Get Clients Subscription Plans
		$this->getPayment = Payplan::where('email', session('email'))->orderBy('created_at', 'DESC')->get();


		$from = date('Y-m-01');
		$to = date('Y-m-d');

		$nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

		$carNos = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->whereBetween('created_at', [$from, $nextDay])->count();


 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			$estimatePayment = DB::table('estimatepay')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimatepay.created_at', 'DESC')->get();

                        // dd($estimatePayment);

            $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->take(5)->get();

                        // dd($workinprogress);

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();

			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();


			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}

		 }

        //  dd($this->getPayment);
        
            $suggestClaims = $this->suggestedMechanic($id);


            $userDetails = User::where('station_name', $id)->get();
            $station = Stations::where('station_name', $id)->get();
            $stationreviews = Review::where('busID', session('busID'))->count();
            $mystaffcount = User::where('busID', session('busID'))->count();
            $mystationcount = Stations::where('busID', session('busID'))->count();


           $profileDetails = array_merge($userDetails->toArray(), $station->toArray());

		   $workflowcount = $this->workflowcount;

		   if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits the claim business page');
		}


 		return view('admin.pages.claimbusiness')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'carNos' => $carNos, 'paymentStatus' => $this->getPayment, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'estimatePayment' => $estimatePayment, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'autocares' => $autocares, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'profileDetails' => $profileDetails, 'reviewcount' => $stationreviews, 'mystaffcount' => $mystaffcount, 'mystationcount' => $mystationcount, 'suggestClaims' => $suggestClaims, 'userDetails' => $userDetails, 'mystation' => $station, 'workflowcount' => $workflowcount]);
 		}
 		else{
 			return redirect()->route('AdminLogin');
 		}


 	}

 	public function opportunity(Request $req){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();


		 $OpportunityPost = OpportunityPost::orderBy('created_at', 'DESC')->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.opportunity')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'OpportunityPost' => $OpportunityPost, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}



 	public function paymenthistory(Request $req){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();


		 $OpportunityPost = OpportunityPost::orderBy('created_at', 'DESC')->get();

		 $paidTransactions = EstimatePay::orderBy('created_at', 'DESC')->get();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.paymenthistory')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'OpportunityPost' => $OpportunityPost, 'paidTransactions' => $paidTransactions, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}




 	public function busywrench(Request $req){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();


		 $OpportunityPost = OpportunityPost::orderBy('created_at', 'DESC')->get();

		 $paidTransactions = EstimatePay::orderBy('created_at', 'DESC')->get();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.busywrench')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'OpportunityPost' => $OpportunityPost, 'paidTransactions' => $paidTransactions, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
     }
     


 	public function crawledautodealer(Request $req){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();
        $suggestedDealers = $this->suggestedDealers();
         


		 $OpportunityPost = OpportunityPost::orderBy('created_at', 'DESC')->get();

		 $paidTransactions = EstimatePay::orderBy('created_at', 'DESC')->get();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }


		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.suggesteddealers')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'OpportunityPost' => $OpportunityPost, 'paidTransactions' => $paidTransactions, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'suggestedDealers' => $suggestedDealers, 'workflowcount' => $workflowcount]);
	 }
	 


	 
	
	
	 public function promotionalmaterials(Request $req){

 		$this->checkSession(session('_token'));
 		$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();
        $suggestedDealers = $this->suggestedDealers();
         


		 $OpportunityPost = OpportunityPost::orderBy('created_at', 'DESC')->get();

		 $paidTransactions = EstimatePay::orderBy('created_at', 'DESC')->get();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.promotionalmaterials')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'OpportunityPost' => $OpportunityPost, 'paidTransactions' => $paidTransactions, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'suggestedDealers' => $suggestedDealers, 'workflowcount' => $workflowcount]);
	 }



	 public function workflowupload(Request $req){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();
        $suggestedDealers = $this->suggestedDealers();
         


		 $OpportunityPost = OpportunityPost::orderBy('created_at', 'DESC')->get();

		 $paidTransactions = EstimatePay::orderBy('created_at', 'DESC')->get();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.workflowupload')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'OpportunityPost' => $OpportunityPost, 'paidTransactions' => $paidTransactions, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'suggestedDealers' => $suggestedDealers, 'workflowcount' => $workflowcount]);
	 }
	 


	 public function uploadedmaterials(Request $req){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();
        $suggestedDealers = $this->suggestedDealers();
         


		 $OpportunityPost = OpportunityPost::orderBy('created_at', 'DESC')->get();

		 $paidTransactions = EstimatePay::orderBy('created_at', 'DESC')->get();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $allmaterials = PromotionalMaterial::orderBy('created_at', 'DESC')->get();


		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.uploadedmaterials')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'OpportunityPost' => $OpportunityPost, 'paidTransactions' => $paidTransactions, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'suggestedDealers' => $suggestedDealers, 'allmaterials' => $allmaterials, 'workflowcount' => $workflowcount]);
	 }


	 public function uploadedworkflow(Request $req){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();
        $suggestedDealers = $this->suggestedDealers();
         


		 $OpportunityPost = OpportunityPost::orderBy('created_at', 'DESC')->get();

		 $paidTransactions = EstimatePay::orderBy('created_at', 'DESC')->get();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $allmaterials = Workflow::orderBy('created_at', 'DESC')->get();

		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.uploadedworkflow')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'OpportunityPost' => $OpportunityPost, 'paidTransactions' => $paidTransactions, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'suggestedDealers' => $suggestedDealers, 'allmaterials' => $allmaterials, 'workflowcount' => $workflowcount]);
	 }
	 


	 public function editpromotionalmaterial(Request $req, $id){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();
        $suggestedDealers = $this->suggestedDealers();
         


		 $OpportunityPost = OpportunityPost::orderBy('created_at', 'DESC')->get();

		 $paidTransactions = EstimatePay::orderBy('created_at', 'DESC')->get();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $allmaterials = PromotionalMaterial::where('id', $id)->get();

		 $workflowcount = $this->workflowcount;


		 if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits the promotional material page');
		}

 		return view('admin.pages.editpromotionalmaterial')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'OpportunityPost' => $OpportunityPost, 'paidTransactions' => $paidTransactions, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'suggestedDealers' => $suggestedDealers, 'allmaterials' => $allmaterials, 'workflowcount' => $workflowcount]);
	 }
	 

	 public function editworkflowmaterial(Request $req, $id){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();
        $suggestedDealers = $this->suggestedDealers();
         


		 $OpportunityPost = OpportunityPost::orderBy('created_at', 'DESC')->get();

		 $paidTransactions = EstimatePay::orderBy('created_at', 'DESC')->get();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $allmaterials = WorkFlow::where('id', $id)->get();

		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.editworkflowmaterial')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'OpportunityPost' => $OpportunityPost, 'paidTransactions' => $paidTransactions, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'suggestedDealers' => $suggestedDealers, 'allmaterials' => $allmaterials, 'workflowcount' => $workflowcount]);
     }



	 
	 public function promotionmaterial(Request $req, $category){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();
        $suggestedDealers = $this->suggestedDealers();
         


		 $OpportunityPost = OpportunityPost::orderBy('created_at', 'DESC')->get();

		 $paidTransactions = EstimatePay::orderBy('created_at', 'DESC')->get();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $data = array(
            'material' => $this->promotionView($category)
        );

		$workflowcount = $this->workflowcount;

 		return view('admin.pages.supportagent.promotionview')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'OpportunityPost' => $OpportunityPost, 'paidTransactions' => $paidTransactions, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'suggestedDealers' => $suggestedDealers, 'data' => $data, 'workflowcount' => $workflowcount]);
	 }
	 

	 public function workflowmaterials(Request $req, $category){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();
        $suggestedDealers = $this->suggestedDealers();
         


		 $OpportunityPost = OpportunityPost::orderBy('created_at', 'DESC')->get();

		 $paidTransactions = EstimatePay::orderBy('created_at', 'DESC')->get();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $data = array(
            'material' => $this->workflowView($category)
        );


		$workflowcount = $this->workflowcount;


		if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits the work flow material page');
		}


 		return view('admin.pages.supportagent.workflowview')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'OpportunityPost' => $OpportunityPost, 'paidTransactions' => $paidTransactions, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'suggestedDealers' => $suggestedDealers, 'data' => $data, 'workflowcount' => $workflowcount]);
     }
     

 	public function supportagents(Request $req){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();
        $supportagent = $this->supportagent(session('busID'));
         


		 $OpportunityPost = OpportunityPost::orderBy('created_at', 'DESC')->get();

		 $paidTransactions = EstimatePay::orderBy('created_at', 'DESC')->get();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.supportagent')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'OpportunityPost' => $OpportunityPost, 'paidTransactions' => $paidTransactions, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'supportagent' => $supportagent, 'workflowcount' => $workflowcount]); 
	 }



 	public function agreementsigned(Request $req){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();
        $supportagent = $this->supportagent(session('busID'));
         


		 $OpportunityPost = OpportunityPost::orderBy('created_at', 'DESC')->get();

		 $paidTransactions = EstimatePay::orderBy('created_at', 'DESC')->get();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $workflowcount = $this->workflowcount;

		 $agreementsign = Admin::where('signed_agreement', 1)->orderBy('updated_at', 'DESC')->get();

		 if(session('role') == "Agent"){
			$this->supportActivities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], session('name').' visits the agreement template page');
		}

 		return view('admin.pages.agreementsigned')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'OpportunityPost' => $OpportunityPost, 'paidTransactions' => $paidTransactions, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'supportagent' => $supportagent, 'workflowcount' => $workflowcount, 'agreementsign' => $agreementsign]); 
	 }
	 


 	public function freeusers(Request $req){
		 
 		$this->checkSession(session('_token'));
 		$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();
        $freeusers = $this->getFreetrial();
         


		 $OpportunityPost = OpportunityPost::orderBy('created_at', 'DESC')->get();

		 $paidTransactions = EstimatePay::orderBy('created_at', 'DESC')->get();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 
		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.freeusers')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'OpportunityPost' => $OpportunityPost, 'paidTransactions' => $paidTransactions, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'freeusers' => $freeusers, 'workflowcount' => $workflowcount]);
	 }
	 


 	public function paidusers(Request $req){

 		$this->checkSession(session('_token'));
 		$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();
        $paidusers = $this->getPaidPlan();
         


		 $OpportunityPost = OpportunityPost::orderBy('created_at', 'DESC')->get();

		 $paidTransactions = EstimatePay::orderBy('created_at', 'DESC')->get();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }


		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.paidusers')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'OpportunityPost' => $OpportunityPost, 'paidTransactions' => $paidTransactions, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'paidusers' => $paidusers, 'workflowcount' => $workflowcount]);
	 }
	 


 	public function freeplanusers(Request $req){

 		$this->checkSession(session('_token'));
 		$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();
        $freeplanusers = $this->getfreePlan();
         


		 $OpportunityPost = OpportunityPost::orderBy('created_at', 'DESC')->get();

		 $paidTransactions = EstimatePay::orderBy('created_at', 'DESC')->get();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.freeplanusers')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'OpportunityPost' => $OpportunityPost, 'paidTransactions' => $paidTransactions, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'freeplanusers' => $freeplanusers, 'workflowcount' => $workflowcount]);
 	}

 	public function postedEstimate(Request $req){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();


 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();


		 $preparedEstimate = DB::table('prepareestimate')
			->join('estimate', 'prepareestimate.post_id', '=', 'estimate.opportunity_id')->where('estimate.opportunity_id', '!=', null)
			->orderBy('prepareestimate.created_at', 'DESC')->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.preparedestimates')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'preparedEstimate' => $preparedEstimate, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}

 	public function workinprogress(Request $req){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();


		 $preparedEstimate = DB::table('prepareestimate')
			->join('estimate', 'prepareestimate.post_id', '=', 'estimate.opportunity_id')->where('estimate.opportunity_id', '!=', null)
			->orderBy('prepareestimate.created_at', 'DESC')->get();

			$workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)->where('estimate.work_order', '=', 1)
                        ->orderBy('estimate.created_at', 'DESC')->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.workinprogress')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'preparedEstimate' => $preparedEstimate, 'workinprogress' => $workinprogress, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}

 	public function jobdone(Request $req){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();


		 $preparedEstimate = DB::table('prepareestimate')
			->join('estimate', 'prepareestimate.post_id', '=', 'estimate.opportunity_id')->where('estimate.opportunity_id', '!=', null)
			->orderBy('prepareestimate.created_at', 'DESC')->get();

			$jobdone = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)->where('estimate.maintenance', '=', 4)
                        ->orderBy('estimate.created_at', 'DESC')->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.jobdone')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'preparedEstimate' => $preparedEstimate, 'jobdone' => $jobdone, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}


 	public function Feedback(Request $req){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();
		 $feedbacks = Feedback::orderBy('created_at', 'DESC')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();


		 $preparedEstimate = DB::table('prepareestimate')
			->join('estimate', 'prepareestimate.post_id', '=', 'estimate.opportunity_id')->where('estimate.opportunity_id', '!=', null)
			->orderBy('prepareestimate.created_at', 'DESC')->get();

			$jobdone = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)->where('estimate.maintenance', '=', 4)
                        ->orderBy('estimate.created_at', 'DESC')->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }


		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.feedback')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'preparedEstimate' => $preparedEstimate, 'jobdone' => $jobdone, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'feedbacks' => $feedbacks, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
     }


 	public function stationReviews(Request $req){

 		$this->checkSession(session('_token'));
 		$getStations = Stations::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();
		 $feedbacks = Feedback::orderBy('created_at', 'DESC')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();


		 $preparedEstimate = DB::table('prepareestimate')
			->join('estimate', 'prepareestimate.post_id', '=', 'estimate.opportunity_id')->where('estimate.opportunity_id', '!=', null)
			->orderBy('prepareestimate.created_at', 'DESC')->get();

			$jobdone = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)->where('estimate.maintenance', '=', 4)
                        ->orderBy('estimate.created_at', 'DESC')->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
         }

		 $reviews = Review::where('busID', session('busID'))->orderBy('created_at', 'DESC')->paginate(5);
		 
		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.stationreviews')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'preparedEstimate' => $preparedEstimate, 'jobdone' => $jobdone, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'feedbacks' => $feedbacks, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'reviews' => $reviews, 'workflowcount' => $workflowcount]);
     }



 	public function expertforum(Request $req){

 		$this->checkSession(session('_token'));
 		$getStations = Stations::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();
		 $feedbacks = Feedback::orderBy('created_at', 'DESC')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();


		 $preparedEstimate = DB::table('prepareestimate')
			->join('estimate', 'prepareestimate.post_id', '=', 'estimate.opportunity_id')->where('estimate.opportunity_id', '!=', null)
			->orderBy('prepareestimate.created_at', 'DESC')->get();

			$jobdone = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)->where('estimate.maintenance', '=', 4)
                        ->orderBy('estimate.created_at', 'DESC')->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
         }

         $askexpert = $this->expertinformationPage();

		 $reviews = Review::where('busID', session('busID'))->orderBy('created_at', 'DESC')->paginate(5);
		 
		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.expertforum')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'preparedEstimate' => $preparedEstimate, 'jobdone' => $jobdone, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'feedbacks' => $feedbacks, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'reviews' => $reviews, 'askexpert' => $askexpert, 'workflowcount' => $workflowcount]);
     }




 	public function revenuereport(Request $req){
 		$this->checkSession(session('_token'));
 		$getStations = Stations::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
		 $getUsers = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $workflowcount = $this->workflowcount;

 		return view('admin.revenue')->with(['pages'=> 'Dashboard', 'getVehicleinfo' => $getVehicleinfo, 'getStations' => $getStations, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'getUsers' => $getUsers, 'getCarrecord' => $getCarrecord, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}


 	public function readmessage(Request $req){
 		$this->checkSession(session('_token'));
 		$getAdmins = Admin::all();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

		 $getMessage = BookAppointment::where('id', $req->route('key'))->where('busID', session('busID'))->get();

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
        $service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

        $autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $workflowcount = $this->workflowcount;


 		return view('admin.readMessage')->with(['pages'=> 'Read Message', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'getMessage' => $getMessage, 'users' => $usersPersonal, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}


 	public function readNotification(Request $req, $id){
 		$this->checkSession(session('_token'));
 		$getAdmins = Admin::all();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();
		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

		 $getNotification = DB::table('agent_notification')->where('id', $id)->first();

		 DB::table('agent_notification')->where('id', $id)->update(['read_state' => 1]);

		 $discount = MinimumDiscount::where('discount', 'discount')->get();
		 $service_charge = MinimumDiscount::where('discount', 'service')->get();

		 $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
        $service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

        $autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $workflowcount = $this->workflowcount;


 		return view('admin.readnotification')->with(['pages'=> 'Read Notification', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'getNotification' => $getNotification, 'users' => $usersPersonal, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}

 	public function stationreportexport(Request $req){
 		$this->checkSession(session('_token'));
 		$getAdmins = Admin::all();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		$getMessage = BookAppointment::where('id', $req->route('key'))->where('busID', session('busID'))->get();

 		$discount = MinimumDiscount::where('discount', 'discount')->get();
 		$service_charge = MinimumDiscount::where('discount', 'service')->get();

 		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

 		// get Search report
 		// Get personal stations report - Limited Plan -
		$getStation = Vehicleinfo::where('busID', session('busID'))->get();

		if(count($getStation) > 0){
			// Fetch all Stations report for me
			if($req->route('search') == "all"){
				$getbySearches = Vehicleinfo::where('busID', session('busID'))->where('created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->route('dayz'))).'%', '>=', 'created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->route('dayzl'))).'%')->orderBy('created_at', 'DESC')->get();

				$this->data = $getbySearches;
			}else{

				$getbySearch = Vehicleinfo::where('update_by', 'LIKE', '%'.$req->route('search').'%')->where('busID', session('busID'))->where('created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->route('dayz'))).'%', '>=', 'created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->route('dayzl'))).'%')->orderBy('created_at', 'DESC')->get();

				// dd($getbySearch);

				if(count($getbySearch) > 0){
					$this->data = $getbySearch;
				}
				else{
					$this->data = "";
				}


			}
		}
		else{
			$this->data = "";
		}

		// dd($this->data);

		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }

		 $workflowcount = $this->workflowcount;

 		return view('admin.stationreportexport')->with(['pages'=> 'Read Message', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'getMessage' => $getMessage, 'data' => $this->data,'users' => $usersPersonal, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}


 	public function revenuereportexport(Request $req){
 		$this->checkSession(session('_token'));
 		$getAdmins = Admin::all();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 $getBussiness = Business::where('busID', session('busID'))->get();

		 $countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 $usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		$getMessage = BookAppointment::where('id', $req->route('key'))->where('busID', session('busID'))->get();

 		$discount = MinimumDiscount::where('discount', 'discount')->get();
 		$service_charge = MinimumDiscount::where('discount', 'service')->get();

 		$discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

 		// get Search report
 		// Get personal stations report - Limited Plan -
		$getStation = Vehicleinfo::where('busID', session('busID'))->get();

		if(count($getStation) > 0){
			// Fetch all Stations report for me
			if($req->route('search') == "all"){
				$getbySearches = Vehicleinfo::where('busID', session('busID'))->where('created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->route('dayz'))).'%', '>=', 'created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->route('dayzl'))).'%')->orderBy('created_at', 'DESC')->get();

				$this->data = $getbySearches;
			}else{

				$getbySearch = Vehicleinfo::where('update_by', 'LIKE', '%'.$req->route('search').'%')->where('busID', session('busID'))->where('created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->route('dayz'))).'%', '>=', 'created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->route('dayzl'))).'%')->orderBy('created_at', 'DESC')->get();

				// dd($getbySearch);

				if(count($getbySearch) > 0){
					$this->data = $getbySearch;
				}
				else{
					$this->data = "";
				}


			}
		}
		else{
			$this->data = "";
		}

		// dd($this->data);

		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
			 $usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 $this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 $this->getPayment = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')
			->orderBy('payment_plan.created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();

			// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 }


		 $workflowcount = $this->workflowcount;

 		return view('admin.revenuereportexport')->with(['pages'=> 'Revenue Report', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'getMessage' => $getMessage, 'data' => $this->data,'users' => $usersPersonal, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}


 	public function allstaffs(){




 		$this->checkSession(session('_token'));

 		$getAdmins = Admin::where('role', '!=', 'Super')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
        $CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
        $regCars = Carrecord::orderBy('created_at', 'DESC')->get();

        $discount = MinimumDiscount::where('discount', 'discount')->get();
        $service_charge = MinimumDiscount::where('discount', 'service')->get();

        $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
	 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();
	 		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			 
			 
	 		$maintReccount = Vehicleinfo::count();
	 		$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();
	 		$this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();

	 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
 		}


		 $regCars = Carrecord::orderBy('created_at', 'DESC')->get();
	 		if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

			$workflowcount = $this->workflowcount;

 		return view('admin.viewallstaff')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'maintRec' => $maintRec, 'carRec' => $CarRec, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}

 	public function activity(){
 		$this->checkSession(session('_token'));

 		$getAdmins = Admin::where('role', '!=', 'Super')->get();
 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getUsers = User::orderBy('created_at', 'DESC')->get();
 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

 		// GEt Maintenance Record count
 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->get();

 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
        $CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();

        $regCars = Carrecord::orderBy('created_at', 'DESC')->get();

        if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

        $discount = MinimumDiscount::where('discount', 'discount')->get();
        $service_charge = MinimumDiscount::where('discount', 'service')->get();

        $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

 		// Get No of vehicles count
 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
 		$getBussiness = Business::where('busID', session('busID'))->get();
 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();
 		$activityLog = Activity::orderBy('created_at', 'DESC')->take(2000)->get();

 		if(session('role') == "Super"){
 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
	 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
	 		$getBussiness = Business::all();
	 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();
	 		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();

	 		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
	 		$maintReccount = Vehicleinfo::count();
	 		$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();
	 		$this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();

	 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
 		}


		 $workflowcount = $this->workflowcount;

 		return view('admin.pages.activitylog')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'maintRec' => $maintRec, 'carRec' => $CarRec, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'activityLog' => $activityLog, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
	 }
	 


	 public function supportactivity(){
		$this->checkSession(session('_token'));

		$getAdmins = Admin::where('role', '!=', 'Super')->get();
		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		$getUsers = User::orderBy('created_at', 'DESC')->get();
		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

		$countnonCom = User::where('userType', 'Individual')->count();
		$countCom = User::where('userType', 'Commercial')->count();
		$countCorp = User::where('userType', 'Business')->count();
		$countstaffCorp = Business::where('accountType', 'Business')->count();
		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
		$countcertProf = User::where('userType', 'Certified Professional')->count();
		$countautCare = User::where('userType', 'Auto Care')->count();

		$autoStores = $this->autoStores();
		$autoStaffs = $this->autoStaffs();

		// GEt Maintenance Record count
		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		// $CarRec = Carrecord::where('busID', session('busID'))->get();
		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->get();

		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
	   $CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();

	   $regCars = Carrecord::orderBy('created_at', 'DESC')->get();

	   if(count($regCars) > 0){
			   foreach ($regCars as $key => $value) {
				   // Check Car rec not in maintenance
				   $carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

				   $carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
			   }
		   }

	   $discount = MinimumDiscount::where('discount', 'discount')->get();
	   $service_charge = MinimumDiscount::where('discount', 'service')->get();

	   $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
	   $service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		// Get No of vehicles count
		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		$getBussiness = Business::where('busID', session('busID'))->get();
		$usersPersonal = User::orderBy('created_at', 'DESC')->get();
		$activityLog = Activity::orderBy('created_at', 'DESC')->take(2000)->get();
		$supportactivityLog = DB::table('support_activity')->orderBy('created_at', 'DESC')->take(3000)->get();

		if(session('role') == "Super"){
			$getStations = Stations::orderBy('created_at', 'DESC')->get();
			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
			$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
			$getBussiness = Business::all();
			$usersPersonal = User::orderBy('created_at', 'DESC')->get();
			$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();

			$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			$maintReccount = Vehicleinfo::count();
			$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();
			$this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();

			// Ticketing
		   $tickets = Ticketing::orderBy('created_at', 'DESC')->get();
		   if(count($tickets) > 0){
			   $this->ticketing = $tickets;
		   }
		   else{
			   $this->ticketing = "";
		   }

		   $getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

		   if(count($getAD) > 0){
			   $this->getAD = $getAD;
		   }
		   else{
			   $this->getAD = "";
		   }



		   // Registered & Unregistered clients
		   $_RegClient = GoogleImport::where('status', 'registered')->get();
		   if(count($_RegClient) > 0){
			   $this->RegClient = $_RegClient;
		   }
		   else{
			   $this->RegClient = "";
		   }


		   $_UnregClient = GoogleImport::where('status', 'not registered')->count();

		   if($_UnregClient > 0){
			   $this->unregisteredClients = $_UnregClient;
		   }
		   else{
			   $this->unregisteredClients = 0;
		   }

		   // Get User with referals

		   $getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

		   if(count($getUserref) > 0){

			   $this->refree = $getUserref;
		   }
		   else{
			   $this->refree = "";
		   }
		}


		$workflowcount = $this->workflowcount;

		return view('admin.pages.supportactivitylog')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'maintRec' => $maintRec, 'carRec' => $CarRec, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'activityLog' => $activityLog, 'supportactivityLog' => $supportactivityLog, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
	}

 	public function allstations(){
		$this->checkSession(session('_token'));

		 		$getAdmins = Admin::where('role', '!=', 'Super')->get();
		 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getUsers = User::orderBy('created_at', 'DESC')->get();
		 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

		 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 		// GEt Maintenance Record count
		 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
		 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->get();

		 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		        $CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->orderBy('created_at', 'DESC')->get();

		        $regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		        if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		        $discount = MinimumDiscount::where('discount', 'discount')->get();
		        $service_charge = MinimumDiscount::where('discount', 'service')->get();

		        $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 		// Get No of vehicles count
		 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
		 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getBussiness = Business::where('busID', session('busID'))->get();
		 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

		 		if(session('role') == "Super"){
		 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
		 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
			 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
			 		$getBussiness = Business::all();
			 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			 		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			 		$maintReccount = Vehicleinfo::count();
			 		$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();
			 		$this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();


			 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 		}

		 		// dd($maintReccount);

				 $workflowcount = $this->workflowcount;


		 		return view('admin.viewallstation')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'maintRec' => $maintRec, 'carRec' => $CarRec, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}

 	 	public function question(){
		$this->checkSession(Session::has('role'));

		 		$getAdmins = Admin::where('role', '!=', 'Super')->get();
		 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getUsers = User::orderBy('created_at', 'DESC')->get();
		 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

		 		$countnonCom = User::where('userType', 'Individual')->count();
 		$countCom = User::where('userType', 'Commercial')->count();
 		$countCorp = User::where('userType', 'Business')->count();
 		$countstaffCorp = Business::where('accountType', 'Business')->count();
 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
 		$countcertProf = User::where('userType', 'Certified Professional')->count();
 		$countautCare = User::where('userType', 'Auto Care')->count();

 		$autoStores = $this->autoStores();
 		$autoStaffs = $this->autoStaffs();

		 		// GEt Maintenance Record count
		 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
		 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->get();

		 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		        $CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->orderBy('created_at', 'DESC')->get();

		        $regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		        if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		        $discount = MinimumDiscount::where('discount', 'discount')->get();
		        $service_charge = MinimumDiscount::where('discount', 'service')->get();

		        $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();


		 		// Get No of vehicles count
		 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
		 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getBussiness = Business::where('busID', session('busID'))->get();
		 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

		 		if(session('role') == "Super"){
		 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
		 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
			 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
			 		$getBussiness = Business::all();
			 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			 		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			 		$maintReccount = Vehicleinfo::count();
			 		$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();
			 		$this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 		$askExpert = $this->expertInformation();

			 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 		}

		 		// dd($maintReccount);


				 $workflowcount = $this->workflowcount;

		 		return view('admin.question')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'maintRec' => $maintRec, 'carRec' => $CarRec, 'otherUsers' => $this->otherUsers, 'askExpert' => $askExpert, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}


 	public function QuestAns(Request $req){
		$this->checkSession(Session::has('role'));

		 		$getAdmins = Admin::where('role', '!=', 'Super')->get();
		 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getUsers = User::orderBy('created_at', 'DESC')->get();
		 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

		 		$countnonCom = User::where('userType', 'Individual')->count();
		 		$countCom = User::where('userType', 'Commercial')->count();
		 		$countCorp = User::where('userType', 'Business')->count();
		 		$countstaffCorp = Business::where('accountType', 'Business')->count();
		 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
		 		$countcertProf = User::where('userType', 'Certified Professional')->count();
		 		$countautCare = User::where('userType', 'Auto Care')->count();

		 		$autoStores = $this->autoStores();
		 		$autoStaffs = $this->autoStaffs();

		 		// GEt Maintenance Record count
		 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
		 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->get();

		 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		        $CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->orderBy('created_at', 'DESC')->get();

		        $regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		        if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		        $discount = MinimumDiscount::where('discount', 'discount')->get();
		        $service_charge = MinimumDiscount::where('discount', 'service')->get();

		        $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();


		 		// Get No of vehicles count
		 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
		 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getBussiness = Business::where('busID', session('busID'))->get();
		 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

		 		if(session('role') == "Super"){
		 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
		 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
			 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
			 		$getBussiness = Business::all();
			 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			 		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			 		$maintReccount = Vehicleinfo::count();
			 		$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();
			 		$this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();
			 		$askExpert = $this->expertInformation();

			 		// $getAns = DB::table('ansfromexpert')
				  //           ->join('askexpert', 'ansfromexpert.post_id', '=', 'askexpert.post_id')->where('askexpert.post_id', $req->route('id'))
				  //           ->get();
							$getAns = DB::table('askexpert')
				            ->join('ansfromexpert', 'askexpert.post_id', '=', 'ansfromexpert.post_id')->where('askexpert.post_id', $req->route('id'))
				            ->get();


				            // Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 		}

		 		// dd($maintReccount);


				 $workflowcount = $this->workflowcount;

		 		return view('admin.QuestAns')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'maintRec' => $maintRec, 'carRec' => $CarRec, 'otherUsers' => $this->otherUsers, 'askExpert' => $askExpert, 'getAns' => $getAns, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}

 	public function allcarrecords(){
		$this->checkSession(session('_token'));

		 		$getAdmins = Admin::where('role', '!=', 'Super')->get();
		 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getUsers = User::orderBy('created_at', 'DESC')->get();
		 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

		 		$countnonCom = User::where('userType', 'Individual')->count();
		 		$countCom = User::where('userType', 'Commercial')->count();
		 		$countCorp = User::where('userType', 'Business')->count();
		 		$countstaffCorp = Business::where('accountType', 'Business')->count();
		 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
		 		$countcertProf = User::where('userType', 'Certified Professional')->count();
		 		$countautCare = User::where('userType', 'Auto Care')->count();

		 		$autoStores = $this->autoStores();
		 		$autoStaffs = $this->autoStaffs();

		 		// GEt Maintenance Record count
		 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
		 		$CarRec = Vehicleinfo::select('*')->distinct()->where('busID', session('busID'))->get();
		 		// dd($CarRec);
		 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		        $CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
		            // dd($CarReccount);
		        $regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		        if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		        $discount = MinimumDiscount::where('discount', 'discount')->get();
		        $service_charge = MinimumDiscount::where('discount', 'service')->get();

		        $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();


		 		// Get No of vehicles count
		 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
		 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getBussiness = Business::where('busID', session('busID'))->get();
		 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

		 		if(session('role') == "Super"){
		 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
		 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
			 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
			 		$getBussiness = Business::all();
			 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			 		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			 		$maintReccount = Vehicleinfo::count();
			 		$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();
			 		$this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();



			 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 		}


				 $workflowcount = $this->workflowcount;

		 		return view('admin.viewallcarrecord')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'maintRec' => $maintRec, 'carRec' => $CarRec, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}

 	public function allregcars(){
		$this->checkSession(session('_token'));

		 		$getAdmins = Admin::where('role', '!=', 'Super')->get();
		 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getUsers = User::orderBy('created_at', 'DESC')->get();
		 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

		 		$countnonCom = User::where('userType', 'Individual')->count();
		 		$countCom = User::where('userType', 'Commercial')->count();
		 		$countCorp = User::where('userType', 'Business')->count();
		 		$countstaffCorp = Business::where('accountType', 'Business')->count();
		 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
		 		$countcertProf = User::where('userType', 'Certified Professional')->count();
		 		$countautCare = User::where('userType', 'Auto Care')->count();

		 		$autoStores = $this->autoStores();
		 		$autoStaffs = $this->autoStaffs();

		 		// GEt Maintenance Record count
		 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
		 		$CarRec = Vehicleinfo::select('*')->distinct()->where('busID', session('busID'))->get();
		 		// dd($CarRec);
		 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		        $CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
		            // dd($CarReccount);
		        $regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		        if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		        $discount = MinimumDiscount::where('discount', 'discount')->get();
		        $service_charge = MinimumDiscount::where('discount', 'service')->get();

		        $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();


		 		// Get No of vehicles count
		 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
		 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getBussiness = Business::where('busID', session('busID'))->get();
		 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

		 		if(session('role') == "Super"){
		 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
		 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
			 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
			 		$getBussiness = Business::all();
			 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			 		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			 		$maintReccount = Vehicleinfo::count();
			 		$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();
			 		$this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();



			 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 		}


				 $workflowcount = $this->workflowcount;

		 		return view('admin.viewallregcar')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'maintRec' => $maintRec, 'carRec' => $CarRec, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]); 
 	}

 	public function allmaintenancerecord(){
		$this->checkSession(session('_token'));

		 		$getAdmins = Admin::where('role', '!=', 'Super')->get();
		 		$getStations = Stations::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getUsers = User::orderBy('created_at', 'DESC')->get();
		 		$getVehicleinfo = Vehicleinfo::orderBy('created_at', 'DESC')->get();

		 		$countnonCom = User::where('userType', 'Individual')->count();
		 		$countCom = User::where('userType', 'Commercial')->count();
		 		$countCorp = User::where('userType', 'Business')->count();
		 		$countstaffCorp = Business::where('accountType', 'Business')->count();
		 		$countautoDeal = User::where('userType', 'Auto Dealer')->count();
		 		$countcertProf = User::where('userType', 'Certified Professional')->count();
		 		$countautCare = User::where('userType', 'Auto Care')->count();

		 		$autoStores = $this->autoStores();
				$autoStaffs = $this->autoStaffs();

		 		// GEt Maintenance Record count
		 		$maintRec = Vehicleinfo::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		// $CarRec = Carrecord::where('busID', session('busID'))->get();
		 		$CarRec = Vehicleinfo::select('vehicle_licence')->distinct()->where('busID', session('busID'))->get();

		 		$maintReccount = Vehicleinfo::where('busID', session('busID'))->count();
		        $CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->where('busID', session('busID'))->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
		        $regCars = Carrecord::orderBy('created_at', 'DESC')->get();

		        if(count($regCars) > 0){
				foreach ($regCars as $key => $value) {
					// Check Car rec not in maintenance
					$carwithoutcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', '!=', $value->vehicle_reg_no)->get();

					$carwithcarrec = Vehicleinfo::distinct('vehicle_licence')->where('vehicle_licence', $value->vehicle_reg_no)->get();
				}
			}

		        $discount = MinimumDiscount::where('discount', 'discount')->get();
		        $service_charge = MinimumDiscount::where('discount', 'service')->get();

		        $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', session('busID'))->get();
		$service_charges = clientMinimum::where('discount', 'service')->where('busID', session('busID'))->get();

		 		// Get No of vehicles count
		 		$getCarrecord = Carrecord::orderBy('created_at', 'DESC')->get();
		 		$getBusinessStaffs = BusinessStaffs::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getAppointment = BookAppointment::where('busID', session('busID'))->orderBy('created_at', 'DESC')->get();
		 		$getBussiness = Business::where('busID', session('busID'))->get();
		 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();

		 		if(session('role') == "Super"){
		 			$getStations = Stations::orderBy('created_at', 'DESC')->get();
		 			$getBusinessStaffs = BusinessStaffs::orderBy('created_at', 'DESC')->get();
			 		$getAppointment = BookAppointment::orderBy('created_at', 'DESC')->get();
			 		$getBussiness = Business::all();
			 		$usersPersonal = User::orderBy('created_at', 'DESC')->get();
			 		$CarReccount = Vehicleinfo::select('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->distinct()->groupby('vehicle_licence', 'date', 'make', 'model', 'update_by', 'created_at')->orderBy('created_at', 'DESC')->get();
			 		$regCars = Carrecord::orderBy('created_at', 'DESC')->get();
			 		$maintReccount = Vehicleinfo::count();
			 		$maintRec = Vehicleinfo::orderBy('created_at', 'DESC')->get();
			 		$this->otherUsers = User::where('userType', '!=', 'Business')->orderBy('created_at', 'DESC')->get();


			 		// Ticketing
			$tickets = Ticketing::orderBy('created_at', 'DESC')->get();
			if(count($tickets) > 0){
				$this->ticketing = $tickets;
			}
			else{
				$this->ticketing = "";
			}

			$getAD = Admin::where('accountType', 'Auto Dealer')->orderBy('created_at', 'DESC')->get();

			if(count($getAD) > 0){
				$this->getAD = $getAD;
			}
			else{
				$this->getAD = "";
			}



			// Registered & Unregistered clients
			$_RegClient = GoogleImport::where('status', 'registered')->get();
			if(count($_RegClient) > 0){
				$this->RegClient = $_RegClient;
			}
			else{
				$this->RegClient = "";
			}


			$_UnregClient = GoogleImport::where('status', 'not registered')->count();

			if($_UnregClient > 0){
				$this->unregisteredClients = $_UnregClient;
			}
			else{
				$this->unregisteredClients = 0;
			}

			// Get User with referals

			$getUserref = RedeemPoints::orderBy('created_at', 'DESC')->get();

			if(count($getUserref) > 0){

				$this->refree = $getUserref;
			}
			else{
				$this->refree = "";
			}
		 		}

				 $workflowcount = $this->workflowcount;


		 		return view('admin.viewallmaintenancerecord')->with(['pages'=> 'Dashboard', 'getAdmins' => $getAdmins, 'getStations' => $getStations, 'getUsers' => $getUsers, 'getVehicleinfo' => $getVehicleinfo, 'getCarrecord' => $getCarrecord, 'getBusinessStaffs' => $getBusinessStaffs, 'getAppointment' => $getAppointment, 'getBussiness' => $getBussiness, 'users' => $usersPersonal, 'maintReccount' => $maintReccount, 'CarReccount' => $CarReccount, 'regCars' => $regCars, 'maintRec' => $maintRec, 'carRec' => $CarRec, 'otherUsers' => $this->otherUsers, 'ticketing' => $this->ticketing, 'getAD' => $this->getAD, 'registeredClients' => $this->RegClient, 'unregisteredClients' => $this->unregisteredClients, 'refree' => $this->refree, 'discount' => $discount, 'service_charge' => $service_charge, 'discountcharge' => $discountcharge, 'service_charges' => $service_charges, 'countnonCom' => $countnonCom, 'countCom' => $countCom, 'countCorp' => $countCorp, 'countstaffCorp' => $countstaffCorp, 'countautoDeal' => $countautoDeal, 'countcertProf' => $countcertProf, 'countautCare' => $countautCare, 'carwithoutcarrec' => $carwithoutcarrec, 'carwithcarrec' => $carwithcarrec, 'autoStores' => $autoStores, 'autoStaffs' => $autoStaffs, 'workflowcount' => $workflowcount]);
 	}

 	public function login(){
 		return view('admin.login')->with(['pages'=> 'Admin Login']);
 	}






 	// Admin Login
 	public function ajaxadminlogin(Request $req){

 		// Check Purpose....

 		// If Registration...

 		if($req->purpose == "Registration"){

 			$validator = Validator::make($req->all(),

         array(
             'accountType' => 'required',

             'city' => 'required',

             'state' => 'required',

             'country' => 'required',

             'email' => 'required',

         ));

	      if ($validator->fails()) {

	         //Response Data

	         $resData = ['res' => 'Please do complete the form', 'message' => 'info', 'link' => 'register'];

	      }
	      else{
	      	// Check if business practitioner already exists
 			$getBiz = Business::where('email', $req->email)->get();
 			$getusername = Admin::where('username', $req->username)->get();

 			if(count($getBiz) > 0){
 				// User Exists...
 				if($req->accountType == "Certified Professional"){
 					$_GetUser = User::where('email', $req->email)->get();

 					if(count($_GetUser) > 0){
 						$resData = ['res' => 'User already exist. Kindly Login', 'message' => 'info', 'link' => 'login'];
 					}
 				}
 				else{
 					$resData = ['res' => 'User already exist. Kindly Login', 'message' => 'info', 'link' => 'AdminLogin'];
 				}

 			}
 			elseif(count($getusername) > 0){
 				// Username Exists...
 				$resData = ['res' => 'Username already chosen.', 'message' => 'info', 'username' => 'Exist'];
 			}


 			elseif($req->accountType == "Certified Professional"){
 				// Direct to User Registration
 				$req = request();


		        if($req->file('file3'))
		        {
		            //Get filename with extension
		            $filenameWithExt = $req->file('file3')->getClientOriginalName();
		            // Get just filename
		            $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
		            // Get just extension
		            $extension = $req->file('file3')->getClientOriginalExtension();
		            // Filename to store
		            $fileNameToStore = rand().'_'.time().'.'.$extension;
		            //Upload Image
		            // $path = $req->file('file')->storeAs('public/uploads', $fileNameToStore);

		            // $path = $req->file('file3')->move(public_path('/trade_cert/'), $fileNameToStore);
		            $path = $req->file('file3')->move(public_path('../../trade_cert/'), $fileNameToStore);

		        }
		        else{
		        	$fileNameToStore = 'noImage.png';
		        }

		        // Check if Exist
		        $checkAccount = User::where('email', $req->email)->get();
		        if(count($checkAccount) > 0){
		        	$resData = ['res' => 'Account Already Exit', 'message' => 'error'];
		        }
		        else{
		        	// Insert
		        	$insAcct = User::insert(['ref_code' => '', 'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->accountType, 'phone_number' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'email1' => '', 'email2' => '', 'email3' => '', 'busID' => $req->busID, 'station_name' => $req->firstname.' '.$req->lastname, 'maiden_name' => $req->maiden_name, 'parent_meet' => $req->parent_meet, 'plan' => $req->plan, 'status' => '2', 'bankstatement' => '', 'creditcard' => '', 'market_place' => '', 'referred_by' => '', 'size_of_employee' => $req->employeeSize, 'year_of_practice' => $req->year_practice, 'specialization' => $req->specialize, 'mobile' => $req->mobile, 'office' => $req->office, 'trade_certificate' => $fileNameToStore]);

		        	// Insert Station Info
		        	Stations::insert(['busID' => $req->busID, 'station_name' => $req->station_name, 'station_address' => $req->station_address, 'station_phone' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'role' => 'Certified Professional', 'service_offered' => $req->specialize]);

		        	// Insert Discount
		        	clientMinimum::insert(['busID' => $req->busID, 'discount' => 'discount', 'percent' => $req->discountPercent]);

		        	if($insAcct == true){
		        		// Send Mail to Individual in city
		        		// $getUserinarea = User::where('city', $req->city)->get();
		        		$getUserinarea = User::where('state', $req->state)->get();
		        		if(count($getUserinarea) > 0){
		        			// Send mail
		        			$this->to = $getUserinarea[0]->email;
		        			$this->name = $getUserinarea[0]->name;
		        			$this->mechanic = $req->firstname.' '.$req->lastname;
		        			$this->city = $req->city;
		        			$this->state = $req->state;
		        			$this->zipcode = $req->zipcode;
		        			$this->service_offer = $req->specialize;
		        			$this->discount = $req->discountPercent;
		        			$this->country = $req->country;
		        			$this->station_name = $req->station_name;
		        			$this->station_address = $req->station_address;

		        			$this->sendEmail($this->to, 'A new mobile mechanic just signed up on VIM File');

		        			$resData = ['res' => 'Welcome'.' '.$req->firstname.' Kindly login with your registered email and password', 'message' => 'success', 'link' => 'login'];

		        		}
		        		else{

		        			$resData = ['res' => 'Welcome'.' '.$req->firstname.' Kindly login with your registered email and password', 'message' => 'success', 'link' => 'login'];
		        		}


		        	}
		        	else{
		        		$resData = ['res' => 'Something went wrong!', 'message' => 'error'];
		        	}
		        }
 			}

 			// Start

 			 elseif($req->accountType == "Auto Care"){

 				$req = request();


		        if($req->file('fileacc'))
		        {
		            //Get filename with extension
		            $filenameWithExt = $req->file('fileacc')->getClientOriginalName();
		            // Get just filename
		            $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
		            // Get just extension
		            $extension = $req->file('fileacc')->getClientOriginalExtension();
		            // Filename to store
		            $fileNameToStore = rand().'_'.time().'.'.$extension;
		            //Upload Image
		            // $path = $req->file('fileacc')->storeAs('public/uploads', $fileNameToStore);

		            // $path = $req->file('fileacc')->move(public_path('/business_docs/'), $fileNameToStore);
		            $path = $req->file('fileacc')->move(public_path('../../business_docs/'), $fileNameToStore);

		        }
		        if ($req->file('file2acc')) {
		        	//Get filename with extension
		            $filenameWithExts = $req->file('file2acc')->getClientOriginalName();
		            // Get just filename
		            $filenames = pathinfo($filenameWithExts , PATHINFO_FILENAME);
		            // Get just extension
		            $extensions = $req->file('file2acc')->getClientOriginalExtension();
		            // Filename to store
		            $fileNameToStore = rand().'_'.time().'.'.$extensions;
		            //Upload Image
		            // $path = $req->file('file2acc')->storeAs('public/uploads', $fileNameToStore);

		            // $path = $req->file('file2acc')->move(public_path('/company_logo/'), $fileNameToStore);
		            $path = $req->file('file2acc')->move(public_path('../../company_logo/'), $fileNameToStore);
			        }


		        else
		        {
		            $fileNameToStore = 'noImage.png';
		        }

		        if ($req->file('photo_video')) {
		        	//Get filename with extension
		            $filenameWithExts = $req->file('photo_video')->getClientOriginalName();
		            // Get just filename
		            $filenames = pathinfo($filenameWithExts , PATHINFO_FILENAME);
		            // Get just extension
		            $extent = $req->file('photo_video')->getClientOriginalExtension();
		            // Filename to store
		            $fileNameToStored = rand().'_'.time().'.'.$extent;
		            //Upload Image
		            // $path = $req->file('photo_video')->storeAs('public/uploads', $fileNameToStore);

		            // $path = $req->file('photo_video')->move(public_path('/uploads/'), $fileNameToStore);
		            $path = $req->file('photo_video')->move(public_path('../../uploads/'), $fileNameToStore);
		        }
		        else{
		        	$fileNameToStored = 'noImage.png';
		        }

		        	// Check if Business doesnt already exist
		        	$checkBiz = Business::where('name_of_company', 'LIKE', '%'.$req->name_of_company.'%')->get();

		        	if(count($checkBiz) > 0){
		        		// Update tables -  Business and Admin
	 				$updtBiz = Business::where('name_of_company', 'LIKE', '%'.$req->name_of_company.'%')->update(['busID' => $req->busID, 'name_of_company' => $req->name_of_company, 'address' => $req->street_no.' '.$req->address, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'name' => $req->firstname.' '.$req->lastname, 'position' => $req->position, 'email' => $req->email, 'telephone' => $req->telephone, 'mobile' => $req->mobile, 'office' => $req->office, 'maiden_name' => $req->maiden_name, 'parent_meet' => $req->parent_meet, 'accountType' => $req->accountType, 'plan' => 'Super', 'file' => $fileNameToStore, 'file2' => $fileNameToStore, 'service_offered' => $req->service_offer]);

	 					// Insert into Admin

						 $insertAdmin = Admin::insert(['busID' => $req->busID, 'userID' => $req->userID, 'name' => $req->firstname.' '.$req->lastname, 'company' => $req->name_of_company, 'role' => 'Owner', 'no_of_staff_added' => 0, 'plan' => 'Super', 'accountType' => $req->accountType, 'username' => $req->username, 'email' => $req->email, 'password' => Hash::make($req->password), 'status' => 0]);

						 // Check If User Exist
						 $checkExist = User::where('email', $req->email)->get();
						 if(count($checkExist) > 0){
						 	// Update
				        	$insAcct = User::where('email', $req->email)->update(['ref_code' => $checkExist[0]->ref_code, 'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->accountType, 'phone_number' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'email1' => '', 'email2' => '', 'email3' => '', 'busID' => $req->busID, 'station_name' => $req->name_of_company, 'maiden_name' => $req->maiden_name, 'parent_meet' => $req->parent_meet, 'plan' => 'Super', 'status' => '1', 'bankstatement' => '', 'creditcard' => '', 'market_place' => '', 'referred_by' => '', 'size_of_employee' => $req->employeeSize, 'year_of_practice' => '', 'specialization' => $req->service_offer, 'mobile' => $req->mobile, 'office' => $req->office, 'year_started_since' => $req->year_started_since, 'year_of_practice' => $req->year_of_practice, 'mechanical_skill' => $req->mechanical_skill, 'electrical_skill' => $req->electrical_skill, 'transmission_skill' => $req->transmission_skill, 'body_work_skill' => $req->body_work_skill, 'other_skills' => $req->other_skills, 'vimfile_discount' => $req->vimfile_discount, 'repair_guaranteed' => $req->repair_guaranteed, 'free_estimated' => $req->free_estimated, 'walk_in_specified' => $req->walk_in_specified, 'other_value_added' => $req->other_value_added, 'average_waiting' => $req->average_waiting, 'hours_of_operation' => $req->hours_of_operation, 'wifi' => $req->wifi, 'restroom' => $req->restroom, 'lounge' => $req->lounge, 'parking_space' => $req->parking_space, 'year_established' => $req->year_established, 'background' => $req->background, 'photo_video' => $fileNameToStored, 'sponsored_mechanics' => 1]);
						 }
						 else{
						 	// Insert
				        	$insAcct = User::insert(['ref_code' => '', 'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->accountType, 'phone_number' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'email1' => '', 'email2' => '', 'email3' => '', 'busID' => $req->busID, 'station_name' => $req->name_of_company, 'maiden_name' => $req->maiden_name, 'parent_meet' => $req->parent_meet, 'plan' => 'Super', 'status' => '1', 'bankstatement' => '', 'creditcard' => '', 'market_place' => '', 'referred_by' => '', 'size_of_employee' => $req->employeeSize, 'year_of_practice' => '', 'specialization' => $req->service_offer, 'mobile' => $req->mobile, 'office' => $req->office, 'year_started_since' => $req->year_started_since, 'year_of_practice' => $req->year_of_practice, 'mechanical_skill' => $req->mechanical_skill, 'electrical_skill' => $req->electrical_skill, 'transmission_skill' => $req->transmission_skill, 'body_work_skill' => $req->body_work_skill, 'other_skills' => $req->other_skills, 'vimfile_discount' => $req->vimfile_discount, 'repair_guaranteed' => $req->repair_guaranteed, 'free_estimated' => $req->free_estimated, 'walk_in_specified' => $req->walk_in_specified, 'other_value_added' => $req->other_value_added, 'average_waiting' => $req->average_waiting, 'hours_of_operation' => $req->hours_of_operation, 'wifi' => $req->wifi, 'restroom' => $req->restroom, 'lounge' => $req->lounge, 'parking_space' => $req->parking_space, 'year_established' => $req->year_established, 'background' => $req->background, 'photo_video' => $fileNameToStored, 'sponsored_mechanics' => 1]);
						 }





						 // Insert Station Info
		        	Stations::insert(['busID' => $req->busID, 'station_name' => $req->name_of_company, 'station_address' => $req->address, 'station_phone' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'role' => $req->accountType, 'service_offered' => $req->service_offer]);



						 // Insert Discount
		        	clientMinimum::insert(['busID' => $req->busID, 'discount' => 'discount', 'percent' => $req->discountaccPercent]);



		 				$req->session()->put(['id' => '', 'busID' => $req->busID, 'userID' => $req->userID, 'username' => $req->username, 'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'company' => $req->name_of_company, 'role' => 'Owner', 'plan' => 'Super', 'status' => 0, 'accountType' => $req->accountType, 'free_trial_expire' => date("Y-m-d", strtotime("+30 days"))]);

		 				if($req->plan == 'Start Up'){
		 					$resData = ['res' => 'Welcome'.' '.$req->firstname.' we are redirecting you to your Dashboard', 'message' => 'success', 'link' => 'Admin'];
		 				}
		 				else{
		 					$resData = ['res' => 'Welcome'.' '.$req->firstname.' we are redirecting you to your Dashboard', 'message' => 'success', 'link' => 'Admin'];
		 				}

		        	}
		        	else{
		        		// Insert to tables -  Business and Admin

		        		// Send Mail to Individual in city
		        		// $getUserinarea = User::where('city', $req->city)->get();
		        		$getUserinarea = User::where('state', $req->state)->get();
		        		if(count($getUserinarea) > 0){
		        			// Send mail
		        			$this->to = $getUserinarea[0]->email;
		        			$this->name = $getUserinarea[0]->name;
		        			$this->mechanic = $req->firstname.' '.$req->lastname;
		        			$this->city = $req->city;
		        			$this->state = $req->state;
		        			$this->zipcode = $req->zipcode;
		        			$this->country = $req->country;
		        			$this->service_offer = $req->service_offer;
		        			$this->discount = $req->discountaccPercent;
		        			$this->station_name = $req->name_of_company;
		        			$this->station_address = $req->address;

		        			$this->sendEmail($this->to, 'A new auto care center just signed up on VIM File');

		        			$insertBiz = Business::insert(['busID' => $req->busID, 'name_of_company' => $req->name_of_company, 'address' => $req->address, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'name' => $req->firstname.' '.$req->lastname, 'position' => $req->position, 'email' => $req->email, 'telephone' => $req->telephone, 'mobile' => $req->mobile, 'office' => $req->office, 'maiden_name' => $req->maiden_name, 'parent_meet' => $req->parent_meet, 'accountType' => $req->accountType, 'plan' => 'Super', 'file' => $fileNameToStore, 'file2' => $fileNameToStore, 'service_offered' => $req->service_offer]);

			 				// Insert into Admin

						 $insertAdmin = Admin::insert(['busID' => $req->busID, 'userID' => $req->userID, 'name' => $req->firstname.' '.$req->lastname, 'company' => $req->name_of_company, 'role' => 'Owner', 'no_of_staff_added' => 0, 'plan' => 'Super', 'accountType' => $req->accountType, 'username' => $req->username, 'email' => $req->email, 'password' => Hash::make($req->password), 'status' => 0]);

						 // Check If User Exist
						 $checkExist = User::where('email', $req->email)->get();
						 if(count($checkExist) > 0){
						 	// Update
				        	$insAcct = User::where('email', $req->email)->update(['ref_code' => $checkExist[0]->ref_code, 'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->accountType, 'phone_number' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'email1' => '', 'email2' => '', 'email3' => '', 'busID' => $req->busID, 'station_name' => $req->name_of_company, 'maiden_name' => $req->maiden_name, 'parent_meet' => $req->parent_meet, 'plan' => 'Super', 'status' => '1', 'bankstatement' => '', 'creditcard' => '', 'market_place' => '', 'referred_by' => '', 'size_of_employee' => $req->employeeSize, 'year_of_practice' => '', 'specialization' => $req->service_offer, 'mobile' => $req->mobile, 'office' => $req->office, 'year_started_since' => $req->year_started_since, 'year_of_practice' => $req->year_of_practice, 'mechanical_skill' => $req->mechanical_skill, 'electrical_skill' => $req->electrical_skill, 'transmission_skill' => $req->transmission_skill, 'body_work_skill' => $req->body_work_skill, 'other_skills' => $req->other_skills, 'vimfile_discount' => $req->vimfile_discount, 'repair_guaranteed' => $req->repair_guaranteed, 'free_estimated' => $req->free_estimated, 'walk_in_specified' => $req->walk_in_specified, 'other_value_added' => $req->other_value_added, 'average_waiting' => $req->average_waiting, 'hours_of_operation' => $req->hours_of_operation, 'wifi' => $req->wifi, 'restroom' => $req->restroom, 'lounge' => $req->lounge, 'parking_space' => $req->parking_space, 'year_established' => $req->year_established, 'background' => $req->background, 'photo_video' => $fileNameToStored, 'sponsored_mechanics' => 1]);
						 }
						 else{
						 	// Insert
				        	$insAcct = User::insert(['ref_code' => '', 'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->accountType, 'phone_number' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'email1' => '', 'email2' => '', 'email3' => '', 'busID' => $req->busID, 'station_name' => $req->name_of_company, 'maiden_name' => $req->maiden_name, 'parent_meet' => $req->parent_meet, 'plan' => 'Super', 'status' => '1', 'bankstatement' => '', 'creditcard' => '', 'market_place' => '', 'referred_by' => '', 'size_of_employee' => $req->employeeSize, 'year_of_practice' => '', 'specialization' => $req->service_offer, 'mobile' => $req->mobile, 'office' => $req->office, 'year_started_since' => $req->year_started_since, 'year_of_practice' => $req->year_of_practice, 'mechanical_skill' => $req->mechanical_skill, 'electrical_skill' => $req->electrical_skill, 'transmission_skill' => $req->transmission_skill, 'body_work_skill' => $req->body_work_skill, 'other_skills' => $req->other_skills, 'vimfile_discount' => $req->vimfile_discount, 'repair_guaranteed' => $req->repair_guaranteed, 'free_estimated' => $req->free_estimated, 'walk_in_specified' => $req->walk_in_specified, 'other_value_added' => $req->other_value_added, 'average_waiting' => $req->average_waiting, 'hours_of_operation' => $req->hours_of_operation, 'wifi' => $req->wifi, 'restroom' => $req->restroom, 'lounge' => $req->lounge, 'parking_space' => $req->parking_space, 'year_established' => $req->year_established, 'background' => $req->background, 'photo_video' => $fileNameToStored, 'sponsored_mechanics' => 1]);
						 }


						 // Insert Station Info
		        	Stations::insert(['busID' => $req->busID, 'station_name' => $req->name_of_company, 'station_address' => $req->address, 'station_phone' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'role' => $req->accountType, 'service_offered' => $req->service_offer]);



		 				$req->session()->put(['id' => '', 'busID' => $req->busID, 'userID' => $req->userID, 'username' => $req->username, 'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'company' => $req->name_of_company, 'role' => 'Owner', 'plan' => 'Super', 'status' => 0, 'accountType' => $req->accountType, 'free_trial_expire' => date("Y-m-d", strtotime("+30 days"))]);

		 				if($req->plan == 'Start Up'){
		 					$resData = ['res' => 'Welcome'.' '.$req->firstname.' we are redirecting you to your Dashboard', 'message' => 'success', 'link' => 'Admin'];
		 				}
		 				else{
		 					$resData = ['res' => 'Welcome'.' '.$req->firstname.' we are redirecting you to your Dashboard', 'message' => 'success', 'link' => 'Admin'];
		 				}

		        		}
		        		else{
		        			$insertBiz = Business::insert(['busID' => $req->busID, 'name_of_company' => $req->name_of_company, 'address' => $req->address, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'name' => $req->firstname.' '.$req->lastname, 'position' => $req->position, 'email' => $req->email, 'telephone' => $req->telephone, 'mobile' => $req->mobile, 'office' => $req->office, 'maiden_name' => $req->maiden_name, 'parent_meet' => $req->parent_meet, 'accountType' => $req->accountType, 'plan' => 'Super', 'file' => $fileNameToStore, 'file2' => $fileNameToStore, 'service_offered' => $req->service_offer]);

			 				// Insert into Admin

						 $insertAdmin = Admin::insert(['busID' => $req->busID, 'userID' => $req->userID, 'name' => $req->firstname.' '.$req->lastname, 'company' => $req->name_of_company, 'role' => 'Owner', 'no_of_staff_added' => 0, 'plan' => 'Super', 'accountType' => $req->accountType, 'username' => $req->username, 'email' => $req->email, 'password' => Hash::make($req->password), 'status' => 0]);

						 // Check If User Exist
						 $checkExist = User::where('email', $req->email)->get();
						 if(count($checkExist) > 0){
						 	// Update
				        	$insAcct = User::where('email', $req->email)->update(['ref_code' => $checkExist[0]->ref_code, 'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->accountType, 'phone_number' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'email1' => '', 'email2' => '', 'email3' => '', 'busID' => $req->busID, 'station_name' => $req->name_of_company, 'maiden_name' => $req->maiden_name, 'parent_meet' => $req->parent_meet, 'plan' => 'Super', 'status' => '1', 'bankstatement' => '', 'creditcard' => '', 'market_place' => '', 'referred_by' => '', 'size_of_employee' => $req->employeeSize, 'year_of_practice' => '', 'specialization' => $req->service_offer, 'mobile' => $req->mobile, 'office' => $req->office, 'year_started_since' => $req->year_started_since, 'year_of_practice' => $req->year_of_practice, 'mechanical_skill' => $req->mechanical_skill, 'electrical_skill' => $req->electrical_skill, 'transmission_skill' => $req->transmission_skill, 'body_work_skill' => $req->body_work_skill, 'other_skills' => $req->other_skills, 'vimfile_discount' => $req->vimfile_discount, 'repair_guaranteed' => $req->repair_guaranteed, 'free_estimated' => $req->free_estimated, 'walk_in_specified' => $req->walk_in_specified, 'other_value_added' => $req->other_value_added, 'average_waiting' => $req->average_waiting, 'hours_of_operation' => $req->hours_of_operation, 'wifi' => $req->wifi, 'restroom' => $req->restroom, 'lounge' => $req->lounge, 'parking_space' => $req->parking_space, 'year_established' => $req->year_established, 'background' => $req->background, 'photo_video' => $fileNameToStored, 'sponsored_mechanics' => 1]);
						 }
						 else{
						 	// Insert
				        	$insAcct = User::insert(['ref_code' => '', 'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->accountType, 'phone_number' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'email1' => '', 'email2' => '', 'email3' => '', 'busID' => $req->busID, 'station_name' => $req->name_of_company, 'maiden_name' => $req->maiden_name, 'parent_meet' => $req->parent_meet, 'plan' => 'Super', 'status' => '1', 'bankstatement' => '', 'creditcard' => '', 'market_place' => '', 'referred_by' => '', 'size_of_employee' => $req->employeeSize, 'year_of_practice' => '', 'specialization' => $req->service_offer, 'mobile' => $req->mobile, 'office' => $req->office, 'year_started_since' => $req->year_started_since, 'year_of_practice' => $req->year_of_practice, 'mechanical_skill' => $req->mechanical_skill, 'electrical_skill' => $req->electrical_skill, 'transmission_skill' => $req->transmission_skill, 'body_work_skill' => $req->body_work_skill, 'other_skills' => $req->other_skills, 'vimfile_discount' => $req->vimfile_discount, 'repair_guaranteed' => $req->repair_guaranteed, 'free_estimated' => $req->free_estimated, 'walk_in_specified' => $req->walk_in_specified, 'other_value_added' => $req->other_value_added, 'average_waiting' => $req->average_waiting, 'hours_of_operation' => $req->hours_of_operation, 'wifi' => $req->wifi, 'restroom' => $req->restroom, 'lounge' => $req->lounge, 'parking_space' => $req->parking_space, 'year_established' => $req->year_established, 'background' => $req->background, 'photo_video' => $fileNameToStored, 'sponsored_mechanics' => 1]);
						 }


						 // Insert Station Info
		        	Stations::insert(['busID' => $req->busID, 'station_name' => $req->name_of_company, 'station_address' => $req->address, 'station_phone' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'role' => $req->accountType, 'service_offered' => $req->service_offer]);



		 				$req->session()->put(['id' => '', 'busID' => $req->busID, 'userID' => $req->userID, 'username' => $req->username, 'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'company' => $req->name_of_company, 'role' => 'Owner', 'plan' => 'Super', 'status' => 0, 'accountType' => $req->accountType, 'free_trial_expire' => date("Y-m-d", strtotime("+30 days"))]);

		 				if($req->plan == 'Start Up'){
		 					$resData = ['res' => 'Welcome'.' '.$req->firstname.' we are redirecting you to your Dashboard', 'message' => 'success', 'link' => 'Admin'];
		 				}
		 				else{
		 					$resData = ['res' => 'Welcome'.' '.$req->firstname.' we are redirecting you to your Dashboard', 'message' => 'success', 'link' => 'Admin'];
		 				}
		        		}





		        	}








 			}

 			// End

 			elseif($req->accountType == "Business"){

 				$req = request();


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

		            // $path = $req->file('file')->move(public_path('/business_docs/'), $fileNameToStore);
		            $path = $req->file('file')->move(public_path('../../business_docs/'), $fileNameToStore);

		        }
		        if ($req->file('file2')) {
		        	//Get filename with extension
		            $filenameWithExts = $req->file('file2')->getClientOriginalName();
		            // Get just filename
		            $filenames = pathinfo($filenameWithExts , PATHINFO_FILENAME);
		            // Get just extension
		            $extensions = $req->file('file2')->getClientOriginalExtension();
		            // Filename to store
		            $fileNameToStore = rand().'_'.time().'.'.$extensions;
		            //Upload Image
		            // $path = $req->file('file')->storeAs('public/uploads', $fileNameToStore);

		            // $path = $req->file('file2')->move(public_path('/company_logo/'), $fileNameToStore);
		            $path = $req->file('file2')->move(public_path('../../company_logo/'), $fileNameToStore);
			        }
		        else
		        {
		            $fileNameToStore = 'noImage.png';
		        }



 				// Insert to tables -  Business and Admin

 				$insertBiz = Business::insert(['busID' => $req->busID, 'name_of_company' => $req->name_of_company, 'address' => $req->address, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'name' => $req->firstname.' '.$req->lastname, 'position' => $req->position, 'email' => $req->email, 'telephone' => $req->telephone, 'mobile' => $req->mobile, 'office' => $req->office, 'maiden_name' => $req->maiden_name, 'parent_meet' => $req->parent_meet, 'accountType' => $req->accountType, 'plan' => $req->plan, 'file' => $fileNameToStore, 'file2' => $fileNameToStore]);

 				// Insert into Admin

				 $insertAdmin = Admin::insert(['busID' => $req->busID, 'userID' => $req->userID, 'name' => $req->firstname.' '.$req->lastname, 'company' => $req->name_of_company, 'role' => 'Owner', 'no_of_staff_added' => 0, 'plan' => $req->plan, 'accountType' => $req->accountType, 'username' => $req->username, 'email' => $req->email, 'password' => Hash::make($req->password), 'status' => 0]);

				 // Check If User Exist
						 $checkExist = User::where('email', $req->email)->get();
						 if(count($checkExist) > 0){
						 	// Update
				        	$insAcct = User::where('email', $req->email)->update(['ref_code' => $checkExist[0]->ref_code, 'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->accountType, 'phone_number' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'email1' => '', 'email2' => '', 'email3' => '', 'busID' => $req->busID, 'station_name' => $req->name_of_company, 'maiden_name' => $req->maiden_name, 'parent_meet' => $req->parent_meet, 'plan' => $req->plan, 'status' => '1', 'bankstatement' => '', 'creditcard' => '', 'market_place' => '', 'referred_by' => '', 'size_of_employee' => $req->employeeSize, 'year_of_practice' => '', 'specialization' => $req->service_offer, 'mobile' => $req->mobile, 'office' => $req->office]);
						 }
						 else{
						 	// Insert
				        	$insAcct = User::insert(['ref_code' => '', 'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->accountType, 'phone_number' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'email1' => '', 'email2' => '', 'email3' => '', 'busID' => $req->busID, 'station_name' => $req->name_of_company, 'maiden_name' => $req->maiden_name, 'parent_meet' => $req->parent_meet, 'plan' => $req->plan, 'status' => '1', 'bankstatement' => '', 'creditcard' => '', 'market_place' => '', 'referred_by' => '', 'size_of_employee' => $req->employeeSize, 'year_of_practice' => '', 'specialization' => $req->service_offer, 'mobile' => $req->mobile, 'office' => $req->office]);
						 }


						 // Insert Station Info
		        	Stations::insert(['busID' => $req->busID, 'station_name' => $req->name_of_company, 'station_address' => $req->address, 'station_phone' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'role' => $req->accountType, 'service_offered' => $req->service_offer]);



 				$req->session()->put(['id' => '', 'busID' => $req->busID, 'userID' => $req->userID, 'username' => $req->username, 'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'company' => $req->name_of_company, 'role' => 'Owner', 'plan' => $req->plan, 'status' => 0, 'accountType' => $req->accountType, 'free_trial_expire' => date("Y-m-d", strtotime("+30 days"))]);

 				if($req->plan == 'Start Up'){
 					$resData = ['res' => 'Welcome'.' '.$req->firstname.' we are redirecting you to your Dashboard', 'message' => 'success', 'link' => 'Admin'];
 				}
 				else{
 					$resData = ['res' => 'Welcome'.' '.$req->firstname.' we are redirecting you to your Dashboard', 'message' => 'success', 'link' => 'Admin'];
 				}



 			}


 			// STart

 			elseif($req->accountType == "Auto Dealer"){

 				$req = request();


		        if($req->file('filedeal'))
		        {
		            //Get filename with extension
		            $filenameWithExt = $req->file('filedeal')->getClientOriginalName();
		            // Get just filename
		            $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
		            // Get just extension
		            $extension = $req->file('filedeal')->getClientOriginalExtension();
		            // Filename to store
		            $fileNameToStore = rand().'_'.time().'.'.$extension;
		            //Upload Image
		            // $path = $req->file('filedeal')->storeAs('public/uploads', $fileNameToStore);

		            // $path = $req->file('filedeal')->move(public_path('/business_docs/'), $fileNameToStore);
		            $path = $req->file('filedeal')->move(public_path('../../business_docs/'), $fileNameToStore);

		        }
		        if ($req->file('file2deal')) {
		        	//Get filename with extension
		            $filenameWithExts = $req->file('file2deal')->getClientOriginalName();
		            // Get just filename
		            $filenames = pathinfo($filenameWithExts , PATHINFO_FILENAME);
		            // Get just extension
		            $extensions = $req->file('file2deal')->getClientOriginalExtension();
		            // Filename to store
		            $fileNameToStore = rand().'_'.time().'.'.$extensions;
		            //Upload Image
		            // $path = $req->file('file2deal')->storeAs('public/uploads', $fileNameToStore);

		            // $path = $req->file('file2deal')->move(public_path('/company_logo/'), $fileNameToStore);
		            $path = $req->file('file2deal')->move(public_path('../../company_logo/'), $fileNameToStore);
			        }

			     if ($req->file('file3deal')) {
		        	//Get filename with extension
		            $filenameWithExts = $req->file('file3deal')->getClientOriginalName();
		            // Get just filename
		            $filenames = pathinfo($filenameWithExts , PATHINFO_FILENAME);
		            // Get just extension
		            $extensions = $req->file('file3deal')->getClientOriginalExtension();
		            // Filename to store
		            $fileNameToStore = rand().'_'.time().'.'.$extensions;
		            //Upload Image
		            // $path = $req->file('file3deal')->storeAs('public/uploads', $fileNameToStore);

		            // $path = $req->file('file3deal')->move(public_path('/dealer_licence/'), $fileNameToStore);
		            $path = $req->file('file3deal')->move(public_path('../../dealer_licence/'), $fileNameToStore);
			        }
		        else
		        {
		            $fileNameToStore = 'noImage.png';
		        }

		       	// Insert to tables -  Business and Admin

 				$insertBizez = Business::insert(['busID' => $req->busID, 'name_of_company' => $req->name_of_company, 'address' => $req->address, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'name' => $req->firstname.' '.$req->lastname, 'position' => $req->position, 'email' => $req->email, 'telephone' => $req->telephone, 'mobile' => $req->mobile, 'office' => $req->office, 'maiden_name' => $req->maiden_name, 'parent_meet' => $req->parent_meet, 'accountType' => $req->accountType, 'plan' => $req->plan, 'file' => $fileNameToStore, 'file2' => $fileNameToStore, 'file3' => $fileNameToStore]);

 				// Insert into Admin

				 $insertAdminz = Admin::insert(['busID' => $req->busID, 'userID' => $req->userID, 'name' => $req->firstname.' '.$req->lastname, 'company' => $req->name_of_company, 'role' => 'Owner', 'no_of_staff_added' => 0, 'plan' => $req->plan, 'accountType' => $req->accountType, 'username' => $req->username, 'email' => $req->email, 'password' => Hash::make($req->password), 'status' => 0]);

				 // Check If User Exist
						 $checkExist = User::where('email', $req->email)->get();
						 if(count($checkExist) > 0){
						 	// Update
				        	$insAcct = User::where('email', $req->email)->update(['ref_code' => $checkExist[0]->ref_code, 'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->accountType, 'phone_number' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'email1' => '', 'email2' => '', 'email3' => '', 'busID' => $req->busID, 'station_name' => $req->name_of_company, 'maiden_name' => $req->maiden_name, 'parent_meet' => $req->parent_meet, 'plan' => $req->plan, 'status' => '1', 'bankstatement' => '', 'creditcard' => '', 'market_place' => '', 'referred_by' => '', 'size_of_employee' => $req->employeeSize, 'year_of_practice' => '', 'specialization' => $req->service_offer, 'mobile' => $req->mobile, 'office' => $req->office]);
						 }
						 else{
						 	// Insert
				        	$insAcct = User::insert(['ref_code' => '', 'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->accountType, 'phone_number' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'email1' => '', 'email2' => '', 'email3' => '', 'busID' => $req->busID, 'station_name' => $req->name_of_company, 'maiden_name' => $req->maiden_name, 'parent_meet' => $req->parent_meet, 'plan' => $req->plan, 'status' => '1', 'bankstatement' => '', 'creditcard' => '', 'market_place' => '', 'referred_by' => '', 'size_of_employee' => $req->employeeSize, 'year_of_practice' => '', 'specialization' => $req->service_offer, 'mobile' => $req->mobile, 'office' => $req->office]);
						 }


						 // Insert Station Info
		        	Stations::insert(['busID' => $req->busID, 'station_name' => $req->name_of_company, 'station_address' => $req->address, 'station_phone' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'role' => $req->accountType, 'service_offered' => $req->service_offer]);



 				$req->session()->put(['id' => '', 'busID' => $req->busID, 'userID' => $req->userID, 'username' => $req->username, 'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'company' => $req->name_of_company, 'role' => 'Owner', 'plan' => $req->plan, 'status' => 0, 'accountType' => $req->accountType, 'free_trial_expire' => date("Y-m-d", strtotime("+30 days"))]);

 				if($req->plan == 'Start Up'){
 					$resData = ['res' => 'Welcome'.' '.$req->firstname.' we are redirecting you to your Dashboard', 'message' => 'success', 'link' => 'Admin'];
 				}
 				else{
 					$resData = ['res' => 'Welcome'.' '.$req->firstname.' we are redirecting you to your Dashboard', 'message' => 'success', 'link' => 'Admin'];
 				}



 			}

 			// ENd

	      }



 		}


 		elseif($req->purpose == "Login"){
 			// If Login
	 		// Check For Administrative Purpose
	 		$checkUser = Admin::where('username', $req->username)->get();


	 		if(count($checkUser) > 0){
				// Check password
	            if(Hash::check($req->password, $checkUser[0]['password'])){

					// Check Payment
					$getPay = Payplan::where('email', $checkUser[0]['email'])->get();

					if(count($getPay) > 0){
						$this->payment_status = $getPay[0]->payment_status;
					}
					else{
						$this->payment_status = "not paid";
					}

					if($checkUser[0]['free_trial_expire'] != null){
					    $trial_free = $checkUser[0]['free_trial_expire'];
					}
					else{
					    $trial_free = date("Y-m-d", strtotime("+30 days"));
					}

                    $req->session()->put(['id' => $checkUser[0]['id'], 'busID' => $checkUser[0]['busID'], 'userID' => $checkUser[0]['userID'], 'username' => $checkUser[0]['username'], 'name' => $checkUser[0]['name'], 'email' => $checkUser[0]['email'], 'company' => $checkUser[0]['company'], 'role' => $checkUser[0]['role'], 'plan' => $checkUser[0]['plan'], 'status' => $checkUser[0]['status'], 'payment' => $this->payment_status, 'accountType' => $checkUser[0]['accountType'], 'free_trial_expire' => $trial_free]);

                    // Check Login
                    $this->logTrial($checkUser[0]['email']);

	                $resData = ['res' => 'Welcome'.' '.$checkUser[0]['name'], 'message' => 'success', 'link' => 'Admin'];
	            }
	            else{
	                $resData = ['res' => 'Invalid username or password', 'message' => 'info', 'link' => 'AdminLogin'];
	            }
	 		}
	 		else{

	 			$resData = ['res' => 'Does not exist', 'message' => 'error'];
	 		}
 		}

    return $this->returnJSON($resData);
}


// Extend Trial

public function extendtrial(Request $req, Admin $admin){

	// Get Member
	$getUser = $admin->where('busID', $req->busID)->get();

	if(count($getUser) > 0){
		// Update Free Trial

		$trial_expire = date("Y-m-d", strtotime("+15 days"));

		$admin->where('busID', $req->busID)->update(['free_trial_expire' => $trial_expire]);
		
		$resData = ['res' => 'Successfull', 'message' => 'success', 'title' => 'Great!'];

	}
	else{
		$resData = ['res' => 'Information not found!', 'message' => 'error', 'title' => 'Oops!'];
	}

	return $this->returnJSON($resData);
}

// Client Create Activities [Staffs, Stations]

	public function ajaxcreatestaff(Request $req){

		$validator = Validator::make($req->all(),

         array(
             'firstname' => 'required',

             'lastname' => 'required',

             'password' => 'required',

             'email' => 'required',

             'station' => 'required',
         ));

	      if ($validator->fails()) {

	         //Response Data

	         $resData = ['res' => 'Please do complete the form', 'message' => 'info'];

	      }
	      else{

	      	// Check if staff already exist in BusinessStaffs
	      	$getbus = BusinessStaffs::where('email', $req->email)->get();

	      	if(count($getbus) > 0 && $req->action != "update"){
	      		$resData = ['res' => 'Staff already created', 'message' => 'info'];
	      	}else{

	      		if($req->action == "create"){

	      			$no_of_staffs = Admin::where('busID', session('busID'))->get();

	      		if(count($no_of_staffs) > 0){
	      			// Check No of users

	      			$addUp = $no_of_staffs[0]->no_of_staff_added;

	      			if($addUp > 3){
	      				// Do not Register Staff for this Account Because membership is free at the moment

	      				$resData = ['res' => 'You have exceeded the number of staff you can register for now. Kindly upgrade your account', 'message' => 'error'];

	      			}
	      			else{

	      				$updateNousers = Admin::where('busID', session('busID'))->update(['no_of_staff_added' => $addUp+1]);
	      				//Insert into business table
			      		BusinessStaffs::insert(['firstname' => $req->firstname, 'lastname' => $req->lastname, 'email' => $req->email, 'username' => $req->username, 'position' => $req->position, 'station' => $req->station, 'busID' => $req->busID, 'userType' => $req->userType]);

			      		// Get Business
			      		$myBusinezz = Business::where('busID', session('busID'))->get();

			      		$getStation = Stations::where('station_name', $req->station)->get();


			      		if(count($getStation) > 0){
							User::insert(['name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->userType, 'phone_number' => $getStation[0]->station_phone, 'city' => $getStation[0]->city, 'state' => $getStation[0]->state, 'country' => $getStation[0]->country, 'email1' => '', 'email2' => '', 'email3' => '', 'busID' => $req->busID, 'station_name' => $req->station, 'plan' => session('plan'), 'zipcode' => $getStation[0]->zipcode, 'specialization' => $myBusinezz[0]->service_offered, 'staff' => 1]);
			      		}
			      		else{
			      			User::insert(['name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->userType, 'phone_number' => '', 'city' => '', 'state' => '', 'country' => '', 'email1' => '', 'email2' => '', 'email3' => '', 'busID' => $req->busID, 'station_name' => $req->station, 'plan' => session('plan'), 'specialization' => $myBusinezz[0]->service_offered, 'staff' => 1]);
			      		}



			      		$resData = ['res' => 'Staff Created with USERNAME: '.$req->email.' and PASSWORD: '.$req->password.' Kindly note details. ', 'message' => 'success', 'link' => 'Admin', 'action' => 'staff_created'];

	      			}


	      		}


	      		}


	      		elseif ($req->action == "update") {
	      			//Update into business table
	      			$getUser = BusinessStaffs::where('id', $req->id)->get();

	      			if(count($getUser) > 0){
	      				$updtStaffuser = User::where('email', $getUser[0]->email)->update(['name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->userType, 'state' => '', 'country' => '', 'email1' => '', 'email2' => '', 'email3' => '', 'busID' => $req->busID, 'station_name' => $req->station, 'plan' => session('plan'), 'specialization' => $myBusinezz[0]->service_offered]);
	      				if($updtStaffuser){

	      					$updtStaff = BusinessStaffs::where('id', $req->id)->update(['firstname' => $req->firstname, 'lastname' => $req->lastname, 'email' => $req->email, 'username' => $req->username, 'position' => $req->position, 'station' => $req->station, 'busID' => $req->busID, 'userType' => $req->userType]);
	      				}
	      			}
	      		$resData = ['res' => 'Staff Updated with USERNAME: '.$req->email.' and PASSWORD: '.$req->password.' Kindly note details. ', 'message' => 'success', 'link' => 'Admin', 'action' => 'staff_updated'];
	      		}


	      	}

	      }

	      return $this->returnJSON($resData);

	}

	public function ajaxcreatestation(Request $req){

		$validator = Validator::make($req->all(),

         array(
             'stations' => 'required',

             'city' => 'required',

             'state' => 'required',

             'country' => 'required',

             'zipcode' => 'required',
         ));

	      if ($validator->fails()) {

	         //Response Data

	         $resData = ['res' => 'Please do complete the form', 'message' => 'info'];

	      }
	      else{
	      	// Insert new Station

	      	// Get Business
	      		$myBusinezz = Business::where('busID', session('busID'))->get();

	      	if($req->action == "create"){
	      		$insertStation = Stations::insert(['busID' => $req->busID, 'station_name' => $req->stations, 'station_address' => $req->station_address, 'station_phone' => $req->station_phone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'service_offered' => $myBusinezz[0]->service_offered]);

	      	 $resData = ['res' => 'Station Added', 'message' => 'success', 'link' => 'Admin'];
	      	}

	      	// Update Station
	      	elseif ($req->action == "update") {
	      		$updateStation = Stations::where('id', $req->id)->update(['busID' => $req->busID, 'station_name' => $req->stations, 'station_address' => $req->station_address, 'station_phone' => $req->station_phone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'service_offered' => $myBusinezz[0]->service_offered]);

	      		$updateStaff = BusinessStaffs::where('busID', $req->busID)->update(['station' => $req->stations]);

	      	 $resData = ['res' => 'Station Updated', 'message' => 'success', 'link' => 'Admin'];
	      	}

	      }

	      return $this->returnJSON($resData);

	}


	public function ajaxbusinesscrud(Request $req){
		// dd($req->all());
		// Check Purpose
		if($req->purpose ==  "editstation"){
			$getStation = Stations::where('id', $req->id)->get();

			if(count($getStation) > 0){
				$resData = ['res' => 'Fetched', 'message' => 'success', 'data' => json_encode($getStation), 'action' => 'editstation'];
			}
			else{
				$resData = ['res' => 'No record found', 'message' => 'success'];
			}
		}
		elseif ($req->purpose == "delstation") {
			$getStation = Stations::where('id', $req->id)->delete();
			$resData = ['res' => 'Deleted', 'message' => 'success', 'action' => 'delete', 'link' => 'Admin'];
		}

		elseif ($req->purpose == "editstaff") {
			$getStaff = BusinessStaffs::where('id', $req->id)->get();

			if(count($getStaff) > 0){
				$resData = ['res' => 'Fetched', 'message' => 'success', 'data' => json_encode($getStaff), 'action' => 'editstaff'];
			}
			else{
				$resData = ['res' => 'No record found', 'message' => 'success'];
			}
		}

		elseif ($req->purpose == "delstaff") {
			
			$getStaff = BusinessStaffs::where('id', $req->id)->get();

			if(count($getStaff) > 0){
				$delStaff = User::where('email', $getStaff[0]->email)->delete();
				$delStaff = BusinessStaffs::where('id', $req->id)->delete();

				$resData = ['res' => 'Deleted', 'message' => 'success', 'action' => 'delete', 'link' => 'Admin'];
			}
		}
		elseif ($req->purpose == "deluser") {
			
			User::where('email', $req->id)->delete();
			BusinessStaffs::where('email', $req->id)->delete();
			Business::where('email', $req->id)->delete();

			$resData = ['res' => 'Deleted', 'message' => 'success', 'action' => 'delete', 'link' => 'Admin'];
		}

		return $this->returnJSON($resData);
	}


	// Station Report fetch
	public function ajaxstationreport(Request $req){
		// Get personal stations report - Limited Plan -
		$getStation = Vehicleinfo::where('busID', $req->busID)->get();
		if(count($getStation) > 0){
			// Fetch all Stations report for me
			if($req->station_name == "all"){
				$getbySearches = Vehicleinfo::where('busID', $req->busID)->where('busID', '!=', 'undefined')->where('created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->date_from)).'%', '>=', 'created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->date_to)).'%')->orderBy('date', 'DESC')->get();

				$resData = ['res' => 'Fetched', 'message' => 'success', 'data' => json_encode($getbySearches), 'action' => 'stationreport', 'resp' => $req->station_name, 'dayfrom' => $req->date_from, 'dayto' => $req->date_to];
			}else{

				$getbySearch = Vehicleinfo::where('update_by', 'LIKE', '%'.$req->station_name.'%')->where('busID', $req->busID)->where('created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->date_from)).'%', '>=', 'created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->date_to)).'%')->orderBy('date', 'DESC')->get();

				// dd($getbySearch);

				if(count($getbySearch) > 0){
					$resData = ['res' => 'Fetched', 'message' => 'success', 'data' => json_encode($getbySearch), 'action' => 'stationreport', 'resp' => $req->station_name, 'dayfrom' => $req->date_from, 'dayto' => $req->date_to];
				}
				else{
					$resData = ['res' => 'No record found', 'message' => 'fail', 'data' => '', 'action' => 'stationreport'];
				}


			}
		}
		else{
			$resData = ['res' => 'No record found', 'message' => 'fail', 'data' => '', 'action' => 'stationreport'];
		}

		return $this->returnJSON($resData);
	}


	public function ajaxRevenueReport(Request $req){
		// Get personal stations report - Limited Plan -
		$getmyStation = Vehicleinfo::where('busID', $req->busID)->get();
		if(count($getmyStation) > 0){
			// Fetch all Stations report for me
			if($req->station_name == "all"){
				$getmySearches = Vehicleinfo::where('busID', $req->busID)->where('busID', '!=', 'undefined')->where('created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->date_from)).'%', '>=', 'created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->date_to)).'%')->orderBy('created_at', 'DESC')->get();

				$resData = ['res' => 'Fetched', 'message' => 'success', 'data' => json_encode($getmySearches), 'action' => 'revenuereport', 'resp' => $req->station_name, 'dayfrom' => $req->date_from, 'dayto' => $req->date_to];
			}else{

				$getmySearch = Vehicleinfo::where('update_by', 'LIKE', '%'.$req->station_name.'%')->where('busID', $req->busID)->where('created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->date_from)).'%', '>=', 'created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->date_to)).'%')->orderBy('date', 'DESC')->get();

				// dd($getmySearch);

				if(count($getmySearch) > 0){
					$resData = ['res' => 'Fetched', 'message' => 'success', 'data' => json_encode($getmySearch), 'action' => 'revenuereport', 'resp' => $req->station_name, 'dayfrom' => $req->date_from, 'dayto' => $req->date_to];
				}
				else{
					$resData = ['res' => 'No record found', 'message' => 'fail', 'data' => '', 'action' => 'revenuereport'];
				}


			}
		}
		else{
			$resData = ['res' => 'No record found', 'message' => 'fail', 'data' => '', 'action' => 'revenuereport'];
		}

		return $this->returnJSON($resData);
	}

	public function ajaxservicetypesreport(Request $req){
		// Get personal stations report - Limited Plan -
		$getServicetypes = Vehicleinfo::where('busID', $req->busID)->get();

		if(count($getServicetypes) > 0){
			if($req->service_type == "all"){
				$getbySearches = Vehicleinfo::where('busID', $req->busID)->get();
				$resData = ['res' => 'Fetched', 'message' => 'success', 'data' => json_encode($getbySearches), 'action' => 'service_type_report'];
			}
			else{
				$getbySearch = Vehicleinfo::where('service_type', 'LIKE', '%'.$req->service_type.'%')->where('busID', $req->busID)->where('created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->date_from)).'%', '>=', 'created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->date_to)).'%')->get();

				$resData = ['res' => 'Fetched', 'message' => 'success', 'data' => json_encode($getbySearch), 'action' => 'service_type_report'];
			}
	}
	else{
			$resData = ['res' => 'No record found', 'message' => 'fail', 'data' => '', 'action' => 'service_type_report'];
		}

	return $this->returnJSON($resData);
}


	public function ajaxserviceoptionsreport(Request $req){

		// Get personal stations report - Limited Plan -
		$getServiceoptions = Vehicleinfo::where('busID', $req->busID)->get();

		if(count($getServiceoptions) > 0){
			if($req->service_option == "all"){
				$getbySearches = Vehicleinfo::where('busID', $req->busID)->get();
				$resData = ['res' => 'Fetched', 'message' => 'success', 'data' => json_encode($getbySearches), 'action' => 'service_type_report'];
			}
			else{
				$getbySearch = Vehicleinfo::where('service_option', 'LIKE', '%'.$req->service_option.'%')->where('busID', $req->busID)->where('created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->date_from)).'%', '>=', 'created_at', 'LIKE', '%'.date('Y-m-d', strtotime($req->date_to)).'%')->get();

				$resData = ['res' => 'Fetched', 'message' => 'success', 'data' => json_encode($getbySearch), 'action' => 'service_type_report'];
			}
	}
	else{
			$resData = ['res' => 'No record found', 'message' => 'fail', 'data' => '', 'action' => 'service_type_report'];
		}

	return $this->returnJSON($resData);

	}

// Client Create Activities [Staffs, Stations]





// Super Admin Approve Business Owners

public function ajaxapproval(Request $req){

	// dd($req->all());

	if($req->purpose == "Approve"){
		// Fetch User
		$user = Admin::where('id', $req->id)->get();


		if(count($user) > 0){
			// Update User
			$getuser = Admin::where('id', $req->id)->get();
			$user = Admin::where('id', $req->id)->update(['status' => '1']);
			$resInfo = ['res' => 'Approval Granted', 'message' => 'success', 'link' => 'Admin', 'action' => 'approve'];


			$this->name = $getuser[0]->name;
            $this->to = $getuser[0]->email;

            $this->sendEmail($this->to, 'VIM File - Account Approval');
		}
		else{
			$resInfo = ['res' => 'Something Went Wrong', 'message' => 'error'];
		}
	}
	elseif($req->purpose == "Approval"){
		// Fetch User
		$user = User::where('id', $req->id)->get();


		if(count($user) > 0){
			// Update User
			$getuserplan = PayPlan::where('email', $user[0]->email)->get();
			if(count($getuserplan) > 0){
				User::where('id', $req->id)->update(['status' => '1', 'plan' => $getuserplan[0]->plan]);
				$resInfo = ['res' => 'Approval Granted', 'message' => 'success', 'link' => 'Admin', 'action' => 'approve'];


				$this->name = $user[0]->name;
				$this->to = $user[0]->email;

				$this->sendEmail($this->to, 'VIM File - Account Approval');
			}
			else{
				$resInfo = ['res' => 'This user does not have a payment record', 'message' => 'info', 'action' => 'approve'];
			}

		}
		else{
			$resInfo = ['res' => 'Something Went Wrong', 'message' => 'error'];
		}
	}

	elseif($req->purpose == "Approvepay"){
		// Fetch User
		$user = Admin::where('id', $req->id)->get();


		if(count($user) > 0){
			// Update User
			$getuser = Admin::where('id', $req->id)->get();
			$user = Admin::where('id', $req->id)->update(['status' => '3']);
			$resInfo = ['res' => 'Approval Granted', 'message' => 'success', 'link' => 'Admin', 'action' => 'approve'];


			$this->name = $getuser[0]->name;
            $this->to = $getuser[0]->email;

            $this->sendEmail($this->to, 'VIM File - Payment Acknowledged');
		}
		else{
			$resInfo = ['res' => 'Something Went Wrong', 'message' => 'error'];
		}
	}


	elseif ($req->purpose == "Decline") {
		// Fetch User
		$user = Admin::where('id', $req->id)->get();

		if(count($user) > 0){
			// Update User
			$getuser = Admin::where('id', $req->id)->get();
			$user = Admin::where('id', $req->id)->update(['status' => '2']);
			$resInfo = ['res' => 'Approval Denied', 'message' => 'success', 'link' => 'Admin', 'action' => 'approve'];

			$this->name = $getuser[0]->name;
            $this->to = $getuser[0]->email;

            $this->sendEmail($this->to, 'VIM File - Account Declined');
		}
		else{
			$resInfo = ['res' => 'Something Went Wrong', 'message' => 'error'];
		}

	}

	elseif ($req->purpose == "Decliner") {
		// Fetch User
		$user = User::where('id', $req->id)->get();

		if(count($user) > 0){
			// Update User
			User::where('id', $req->id)->update(['status' => '0']);
			$resInfo = ['res' => 'Approval Denied', 'message' => 'success', 'link' => 'Admin', 'action' => 'approve'];

			$this->name = $user[0]->name;
            $this->to = $user[0]->email;

            $this->sendEmail($this->to, 'VIM File - Account Declined');
		}
		else{
			$resInfo = ['res' => 'Something Went Wrong', 'message' => 'error'];
		}

	}

	elseif ($req->purpose == "personalDecline") {
		// Fetch User
		$user = User::where('id', $req->id)->get();

		if(count($user) > 0){
			// Update User
			$getuser = User::where('id', $req->id)->get();
			$user = User::where('id', $req->id)->update(['status' => '0']);
			$resInfo = ['res' => 'Account Declined', 'message' => 'success', 'link' => 'Admin', 'action' => 'approve'];

			// dd($resInfo);
			$this->name = $getuser[0]->name;
            $this->to = $getuser[0]->email;

            $this->sendEmail($this->to, 'VIM File - Account Declined');
		}
		else{
			$resInfo = ['res' => 'Something Went Wrong', 'message' => 'error'];
		}

	}

	elseif ($req->purpose == "autostoreDecline") {
		// Fetch User
		$user = Business::where('busID', $req->id)->get();

		if(count($user) > 0){
			// Update User
			$getuser = Business::where('busID', $user[0]->busID)->get();
			$user = User::where('busID', $user[0]->busID)->update(['status' => '0']);
			$resInfo = ['res' => 'Account Declined', 'message' => 'success', 'link' => 'Admin', 'action' => 'approve'];

			// dd($resInfo);
			$this->name = $getuser[0]->name_of_company;
            $this->to = $getuser[0]->email;

            $this->sendEmail($this->to, 'VIM File - Account Declined');
		}
		else{
			$resInfo = ['res' => 'Something Went Wrong', 'message' => 'error'];
		}

	}

	elseif ($req->purpose == "autostorestaffDecline") {
		// Fetch User
		$user = User::where('email', $req->id)->get();

		if(count($user) > 0){
			// Update User
			$getuser = User::where('email', $req->id)->get();
			$user = User::where('email', $req->id)->update(['status' => '0']);
			$resInfo = ['res' => 'Account Declined', 'message' => 'success', 'link' => 'Admin', 'action' => 'approve'];

			// dd($resInfo);
			$this->name = $getuser[0]->name;
            $this->to = $getuser[0]->email;

            $this->sendEmail($this->to, 'VIM File - Account Declined');
		}
		else{
			$resInfo = ['res' => 'Something Went Wrong', 'message' => 'error'];
		}

	}

	// Check Client Status for Payment

	elseif ($req->purpose == "Payment") {
		// Fetch User
		$user = Admin::where('id', $req->id)->get();

		if(count($user) > 0){
			// Check Payment State
			$getuser = DB::table('payment_plan')
			->join('vim_admin', 'payment_plan.email', '=', 'vim_admin.email')->where('vim_admin.email', $user[0]->email)
			->orderBy('payment_plan.created_at', 'DESC')->take(1)->get();

			if(count($getuser) > 0){
				$resInfo = ['res' => 'Data Fetched', 'message' => 'success', 'data' => json_encode($getuser), 'action' => 'paymentstatus'];
			}
			else{
				// Get Client Details
				$resInfo = ['res' => 'Data Fetched', 'message' => 'error', 'data' => json_encode($user), 'action' => 'paymentstatus'];

				// $resInfo = ['res' => 'No Payment Made Yet', 'message' => 'error', 'action' => 'paymentstatus'];
			}
		}
		else{
			$resInfo = ['res' => 'Something Went Wrong', 'message' => 'error'];
		}

	}

	// Check Commercial User Details

	elseif ($req->purpose == "details") {
		// Fetch User
		$userz = User::where('id', $req->id)->get();

		if(count($userz) > 0){
			// Check Payment State
			$getuserDet = DB::table('users')
			->join('payment_plan', 'users.email', '=', 'payment_plan.email')->where('users.email', $userz[0]->email)
			->orderBy('users.created_at', 'DESC')->take(1)->get();

			if(count($getuserDet) > 0){
				$resInfo = ['res' => 'Data Fetched', 'message' => 'success', 'datas' => json_encode($getuserDet), 'action' => 'details'];
			}
			else{
				$resInfo = ['res' => 'No Specific Details', 'message' => 'error', 'datas' => json_encode($userz), 'action' => 'details'];
			}
		}
		else{
			$resInfo = ['res' => 'Something Went Wrong', 'message' => 'error'];
		}

	}

	return $this->returnJSON($resInfo);
}


public function ajaxquickmail(Request $req){

	// dd(session('email'));
	// Insert to DB
	$newMessage = QuickMail::insert(['receiver' => $req->email, 'subject' => $req->subject, 'message' => $req->message, 'sender' => session('email'), 'status' => 0, 'msgId' => 'PILS_'.time().'_VIM']);

	if($newMessage == true){
			$resInfo = ['res' => 'Message Sent', 'message' => 'success', 'link' => 'Admin'];

			$this->sender = session('email');
			$this->subject = $req->subject;
			$this->message = $req->message;
            $this->to = $req->email;

            $this->sendEmail($this->to, 'VIM File - New Message');
	}
	else{
		$resInfo = ['res' => 'Something Went Wrong!', 'message' => 'info'];
	}

	return $this->returnJSON($resInfo);
}



// End Super Admin Approval



    // Make Payment
    public function ajaxmakePay(Request $req){
        if($req->plan == "Basic"){
            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => '', 'lite' => '', 'basic'=> $req->amount, 'classic' => '', 'super' => '', 'gold' => '', 'userType' => 'Business', 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                if($douserpayUpt == true){
					$getTrans = PayPlan::where('email', $req->email)->get();

					// Update Status to Status of 5 on Payment...
					Admin::where('email', $req->email)->update(['status' => 5]);

                    // Redirect to Paystack Form
                    $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePays/'.$getTrans[0]->transaction_id];
                }
                else{
                    // Redirect to Paystack Form
                    $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                }


            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => '', 'lite' => '', 'basic'=> $req->amount, 'classic' => '', 'super' => '', 'gold' => '', 'userType' => 'Business', 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                if($douserpayIns == true){
                    $getTrans = PayPlan::where('email', $req->email)->get();

					// Update Status to Status of 5 on Payment...
					Admin::where('email', $req->email)->update(['status' => 5]);

                    // Redirect to Paystack Form
                    $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePays/'.$getTrans[0]->transaction_id];
                }
                else{
                    // Redirect to Paystack Form
                    $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                }
            }
        }

        elseif($req->plan == "Classic"){

            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => '', 'lite' => '', 'basic'=> '', 'classic' => $req->amount, 'super' => '', 'gold' => '', 'userType' => 'Business', 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                if($douserpayUpt == true){
					$getTrans = PayPlan::where('email', $req->email)->get();

					// Update Status to Status of 5 on Payment...
					Admin::where('email', $req->email)->update(['status' => 5]);

                    // Redirect to Paystack Form
                    $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePays/'.$getTrans[0]->transaction_id];
                }
                else{
                    // Redirect to Paystack Form
                    $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                }


            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => '', 'lite' => '', 'basic'=> '', 'classic' => $req->amount, 'super' => '', 'gold' => '', 'userType' => 'Business', 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                if($douserpayIns == true){
					$getTrans = PayPlan::where('email', $req->email)->get();

					// Update Status to Status of 5 on Payment...
					Admin::where('email', $req->email)->update(['status' => 5]);

                    // Redirect to Paystack Form
                    $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePays/'.$getTrans[0]->transaction_id];
                }
                else{
                    // Redirect to Paystack Form
                    $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                }
            }

        }

        elseif($req->plan == "Super"){

            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => '', 'lite' => '', 'basic'=> '', 'classic' => '', 'super' => $req->amount, 'gold' => '', 'userType' => 'Business', 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                if($douserpayUpt == true){
					$getTrans = PayPlan::where('email', $req->email)->get();

					// Update Status to Status of 5 on Payment...
					Admin::where('email', $req->email)->update(['status' => 5]);

                    // Redirect to Paystack Form
                    $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePays/'.$getTrans[0]->transaction_id];
                }
                else{
                    // Redirect to Paystack Form
                    $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                }


            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => '', 'lite' => '', 'basic'=> '', 'classic' => '', 'super' => $req->amount, 'gold' => '', 'userType' => 'Business', 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                if($douserpayIns == true){
					$getTrans = PayPlan::where('email', $req->email)->get();

					// Update Status to Status of 5 on Payment...
					Admin::where('email', $req->email)->update(['status' => 5]);

                    // Redirect to Paystack Form
                    $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePays/'.$getTrans[0]->transaction_id];
                }
                else{
                    // Redirect to Paystack Form
                    $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                }
            }

        }

        elseif($req->plan == "Gold"){
            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => '', 'lite' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => $req->amount, 'userType' => 'Business', 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                if($douserpayUpt == true){
					$getTrans = PayPlan::where('email', $req->email)->get();

					// Update Status to Status of 5 on Payment...
					Admin::where('email', $req->email)->update(['status' => 5]);

                    // Redirect to Paystack Form
                    $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePays/'.$getTrans[0]->transaction_id];
                }
                else{
                    // Redirect to Paystack Form
                    $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                }


            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => '', 'lite' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => $req->amount, 'userType' => 'Business', 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                if($douserpayIns == true){
					$getTrans = PayPlan::where('email', $req->email)->get();

					// Update Status to Status of 5 on Payment...
					Admin::where('email', $req->email)->update(['status' => 5]);

                    // Redirect to Paystack Form
                    $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePays/'.$getTrans[0]->transaction_id];
                }
                else{
                    // Redirect to Paystack Form
                    $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                }
            }
        }

        elseif($req->plan == "Lite"){
            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => '', 'lite' => $req->amount, 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $req->userType, 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                if($douserpayUpt == true){
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paystack Form
                    $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePays/'.$getTrans[0]->transaction_id];
                }
                else{
                    // Redirect to Paystack Form
                    $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                }


            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => '', 'lite' => $req->amount, 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $req->userType, 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                if($douserpayIns == true){
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paystack Form
                    $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePays/'.$getTrans[0]->transaction_id];
                }
                else{
                    // Redirect to Paystack Form
                    $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                }
            }
        }

        elseif($req->plan == "Free"){
            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => $req->amount, 'lite' => '', 'startup' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $req->userType, 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                if($douserpayUpt == true){
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paystack Form
                    $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'login'];
                }
                else{
                    // Redirect to Paystack Form
                    $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                }


            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => $req->amount, 'lite' => '', 'startup' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $req->userType, 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                if($douserpayIns == true){
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paystack Form
                    $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'login'];
                }
                else{
                    // Redirect to Paystack Form
                    $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                }
            }
        }


        // DO Some Logics here to migerate user info from Individual to Business, Generate Username and Password from User info for login.... Delete user personal account.

        elseif($req->plan == "Start-Up"){
            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => $req->amount, 'lite' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $req->userType, 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                if($douserpayUpt == true){
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paystack Form
                    $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'Admin'];
                }
                else{
                    // Redirect to Paystack Form
                    $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                }


            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'lite' => '', 'startup' => $req->amount, 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $req->userType, 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                if($douserpayIns == true){
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paystack Form
                    $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'Admin'];
                }
                else{
                    // Redirect to Paystack Form
                    $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                }
            }
        }


        return $this->returnJSON($resData);
    }
    // End Make Payment


	public function ajaxdowngrade(Request $req){
		$getAdmin = Admin::where('busID', $req->busID)->get();

		if(count($getAdmin) > 0){
			// Update Status
			Admin::where('busID', $getAdmin[0]->busID)->update(['status' => 4, 'reason' => $req->reason]);

			$resData = ['res' => 'Please note that downgrade will be effective after the expiration of your current plan.', 'message' => 'success'];
		}
		else{
			$resData = ['res' => 'Something went wrong', 'message' => 'error'];
		}

		return $this->returnJSON($resData);
	}


	public function ajaxpostrevenue(Request $req){
		// Get Commercial Client Details if Exist in DB
		$checkData = RevenueReport::where('email', $req->email)->get();

		if(count($checkData) > 0){
			// Update Revenue Info
			$updateInfo = RevenueReport::where('email', $req->email)->update(['name' => $req->name, 'email' => $req->email, 'avg_rev_month' => $req->avg_rev, 'tot_rev' => $req->tot_rev]);

			if($updateInfo ==  true){
				$resData = ['res' => 'Post Successfull', 'message' => 'success'];
			}
		}
		else{
			$updateInfo = RevenueReport::insert(['name' => $req->name, 'email' => $req->email, 'avg_rev_month' => $req->avg, 'tot_rev' => $req->tot]);

			$resData = ['res' => 'Post Successfull', 'message' => 'success'];
		}


		return $this->returnJSON($resData);
	}


	public function ajaxgetclientprofile(Request $req){

			$getclient = DB::table('vehicleinfo')
			->join('carrecord', 'vehicleinfo.email', '=', 'carrecord.email')
			->where('vehicleinfo.busID', $req->busID)
			->where('vehicleinfo.email', $req->email)
			->orderBy('vehicleinfo.created_at', 'DESC')->get();



			if(count($getclient) > 0){
				$this->getName = User::where('email', $getclient[0]->email)->get();
				if(count($this->getName) > 0){
					$this->myName = $this->getName[0]->name;
				}
				else{
					$this->myName = '-';
				}

				// Fetch result
				$resData = ['res' => 'Fetching', 'message' => 'success', 'info' => 'full detail', 'data' => json_encode($getclient), 'name' =>json_encode($this->myName)];

			}else{
				// Get Carrecord
				$userCar = Carrecord::where('email', $req->email)->where('busID', $req->busID)->orderBy('created_at', 'DESC')->get();

				if(count($userCar)){
					$this->getName = User::where('email', $userCar[0]->email)->get();

					if(count($this->getName) > 0){
					$this->myName = $this->getName[0]->name;
				}
				else{
					$this->myName = '-';
				}

					$resData = ['res' => 'Fetching', 'message' => 'success', 'info' => 'half detail', 'data2' => json_encode($userCar), 'name2' =>json_encode($this->myName)];
				}
				else{
					$resData = ['res' => 'Seems user doesnt have any record in the system', 'message' => 'info'];
				}

			}


		return $this->returnJSON($resData);
	}



	public function ajaxgetstaffprofile(Request $req){

			$getstaff = DB::table('users')
			->where('busID', $req->busID)
			->where('email', $req->email)->get();



			if(count($getstaff) > 0){

				// Fetch result
				$resData = ['res' => 'Fetching', 'message' => 'success', 'info' => 'full detail', 'data' => json_encode($getstaff)];

			}else{

				$resData = ['res' => 'Seems user doesnt have any record in the system', 'message' => 'info'];

			}

		return $this->returnJSON($resData);
	}


	public function ajaxQuestions(Request $req){

		// Get Questions and answers
		$getquestDetail = AskExpert::where('post_id', $req->post_id)->get();

			if($req->purpose == 'viewquest'){
			if(count($getquestDetail) > 0){
				$resData = ['res' => 'Fetched', 'message' => 'success', 'link' => $req->post_id, 'purpose' => 'view'];
			}
			else{
				$resData = ['res' => 'This question doesnt exist', 'message' => 'info'];
			}
			}
			elseif($req->purpose == 'delquest'){
				// Delete Questions and Ans

			$delquestAns = AskExpert::where('post_id', $req->post_id)->delete();

			if($delquestAns == 1){
				// Delete Answers
				AnsFromExpert::where('post_id', $req->post_id)->delete();

				$resData = ['res' => 'Question and Answers related to this post are deleted', 'message' => 'success', 'link' => 'Question', 'purpose' => 'delete'];
			}
			else{
				$resData = ['res' => 'Post Already Deleted', 'message' => 'error', 'purpose' => 'delete'];
			}


			}

			elseif($req->purpose == 'delpost'){
				// Delete Questions and Ans

			$delAns = AnsFromExpert::where('id', $req->post_id)->delete();

			if($delAns == 1){
				// Delete Answers
				$resData = ['res' => 'Answer deleted', 'message' => 'success', 'link' => 'QuestAns', 'purpose' => 'deleted post'];
			}
			else{
				$resData = ['res' => 'Post Already Deleted', 'message' => 'error', 'purpose' => 'deleted post'];
			}


			}

			elseif($req->purpose == 'viewpost'){
				// Delete Questions and Ans

			$Anstopost = AnsFromExpert::where('id', $req->post_id)->get();


			if(count($Anstopost) > 0){
				// Delete Answers
				$resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($Anstopost), 'purpose' => 'viewpost'];
			}
			else{
				$resData = ['res' => 'Post Not Available', 'message' => 'error', 'purpose' => 'viewpost'];
			}


			}


		return $this->returnJSON($resData);
    }


    public function answerquestions(Request $req){

        $insInfo = AnsFromExpert::insert(['autocare' => $req->name, 'post_id' => $req->post_id, 'answer' => $req->message]);

        if($insInfo == true){

            $quest = AskExpert::where('post_id', $req->post_id)->get();

            $this->onesignal('Vehicle Inspection & Maintenance', 'Recent Activity Alert: '.$req->name.' replied with an answer: '.$req->message.' to this Question: '.$quest[0]->question, 'Answer From Expert');

            $response = 'success';
            $message = 'Post successful';
        }
        else{
            $response = 'warning';
            $message = 'Something went wrong, try again!';
        }


        return redirect()->back()->with($response, $message);

	}



    public function promotionupload(Request $req){

		
		if($req->hasFile('file')){

			if($req->file('file'))
            {
                //Get filename with extension
                $filenameWithExt = $req->file('file')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
                // Get just extension
                $extension = $req->file('file')->getClientOriginalExtension();

				$media_name = $req->file('file')->getRealPath();
				
				$folder = 'promotionmaterial/'.$req->category;
				if(!file_exists($folder)){
					mkdir($folder, 0777, true);
				}

                // Filename to store

				$path = $req->file('file')->move(public_path('../../'.$folder.'/'), $req->title.'.'.$extension);

				// $path = $req->file('newsUpload')->move(public_path('../../newsfile/'), $fileNameToStore);

				$fileNameToStore = "http://".$_SERVER['HTTP_HOST']."/".$folder."/".$req->title.'.'.$extension;
				

				$insInfo = PromotionalMaterial::insert(['title' => $req->title, 'file' => $fileNameToStore, 'category' => $req->category]);

				// Notification to Agents
				$allagents = Admin::where('role', 'Agent')->get();

				

				if($insInfo == true){

					if(count($allagents) > 0){
						// Save notification and mail
						foreach($allagents as $key => $value){
							$id = $value->id;
							$name = $value->name;
							$email = $value->email;
							$username = $value->username;


							// Save notification for agent
							DB::table('agent_notification')->insert(['activity' => "<p>New promotional material on <b>".$req->title."</b></p><p><a href='".$fileNameToStore."' style='color: navy; text-decoration: underline;'>Open file</a></p>", 'agent_id' => $id, 'read_state' => 0]);

							$this->to = $email;
							// $this->to = 'bambo@vimfile.com';
							$this->name = $name;

							$this->subject = "VIMFILE - Promotional Material";
							$this->message = "<p>Hello ".$this->name.", </p><p>There is a promotional material for you on VIMFile.</p><hr><p>Material Title: <b>".$req->title."</b></p><p>File: <b><a href='".$fileNameToStore."'>Open File</a></b></p><p>Material Category: <b>".$req->category."</b></p><p><a href='https://vimfile.com/AdminLogin'>Login to your account today!</a></p>";
							$this->file = NULL;
					
							$this->sendEmail($this->to, "Compose Mail");
						}
					}
					else{
						// DO nothing
					}
		
					$response = 'success';
					$message = 'Successful';
				}
				else{
		
					$response = 'warning';
					$message = 'Something went wrong, try again!';
				}
				

            }
            else{

            	$response = 'warning';
				$message = 'File not detected';
            }


		}
		else{
			$response = 'warning';
			$message = 'File not detected';
		}

        return redirect()->back()->with($response, $message);

	}



    public function uploadworkflow(Request $req){

		
		if($req->hasFile('file')){

			if($req->file('file'))
            {
                //Get filename with extension
                $filenameWithExt = $req->file('file')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
                // Get just extension
                $extension = $req->file('file')->getClientOriginalExtension();

				$media_name = $req->file('file')->getRealPath();
				
				$folder = 'workflowmaterial/'.$req->category;
				if(!file_exists($folder)){
					mkdir($folder, 0777, true);
				}

                // Filename to store

				$path = $req->file('file')->move(public_path('../../'.$folder.'/'), $req->title.'.'.$extension);

				// $path = $req->file('newsUpload')->move(public_path('../../newsfile/'), $fileNameToStore);

				$fileNameToStore = "http://".$_SERVER['HTTP_HOST']."/".$folder."/".$req->title.'.'.$extension;
				

				$insInfo = WorkFlow::insert(['title' => $req->title, 'file' => $fileNameToStore, 'category' => $req->category]);

				if($insInfo == true){
		
					$response = 'success';
					$message = 'Successful';
				}
				else{
		
					$response = 'warning';
					$message = 'Something went wrong, try again!';
				}
				

            }
            else{

            	$response = 'warning';
				$message = 'File not detected';
            }


		}
		else{
			$response = 'warning';
			$message = 'File not detected';
		}

        return redirect()->back()->with($response, $message);

	}


    public function editpromotionupload(Request $req, $id){

		$getmaterial = PromotionalMaterial::where('id', $id)->get();
		
		if($req->hasFile('file')){

			if($req->file('file'))
            {
                //Get filename with extension
                $filenameWithExt = $req->file('file')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
                // Get just extension
                $extension = $req->file('file')->getClientOriginalExtension();

				$media_name = $req->file('file')->getRealPath();
				
				$folder = 'promotionmaterial/'.$req->category;
				if(!file_exists($folder)){
					mkdir($folder, 0777, true);
				}

                // Filename to store

				$path = $req->file('file')->move(public_path('../../'.$folder.'/'), $req->title.'.'.$extension);

				// $path = $req->file('newsUpload')->move(public_path('../../newsfile/'), $fileNameToStore);

				$fileNameToStore = "http://".$_SERVER['HTTP_HOST']."/".$folder."/".$req->title.'.'.$extension;
				

            }
            else{

            	$fileNameToStore = $getmaterial[0]->file;
            }


		}
		else{

			$fileNameToStore = $getmaterial[0]->file;
		}


		$insInfo = PromotionalMaterial::where('id', $id)->update(['title' => $req->title, 'file' => $fileNameToStore, 'category' => $req->category]);

		if($insInfo == 1){

			$response = 'success';
			$message = 'Update Successful';
		}
		else{

			$response = 'warning';
			$message = 'Something went wrong, try again!';
		}


        return redirect()->route('uploaded materials')->with($response, $message);

	}

	
    public function editworkflowupload(Request $req, $id){

		$getmaterial = WorkFlow::where('id', $id)->get();
		
		if($req->hasFile('file')){

			if($req->file('file'))
            {
                //Get filename with extension
                $filenameWithExt = $req->file('file')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
                // Get just extension
                $extension = $req->file('file')->getClientOriginalExtension();

				$media_name = $req->file('file')->getRealPath();
				
				$folder = 'workflowmaterial/'.$req->category;
				if(!file_exists($folder)){
					mkdir($folder, 0777, true);
				}

                // Filename to store

				$path = $req->file('file')->move(public_path('../../'.$folder.'/'), $req->title.'.'.$extension);

				// $path = $req->file('newsUpload')->move(public_path('../../newsfile/'), $fileNameToStore);

				$fileNameToStore = "http://".$_SERVER['HTTP_HOST']."/".$folder."/".$req->title.'.'.$extension;
				

            }
            else{

            	$fileNameToStore = $getmaterial[0]->file;
            }


		}
		else{

			$fileNameToStore = $getmaterial[0]->file;
		}


		$insInfo = WorkFlow::where('id', $id)->update(['title' => $req->title, 'file' => $fileNameToStore, 'category' => $req->category]);

		if($insInfo == 1){

			$response = 'success';
			$message = 'Update Successful';
		}
		else{

			$response = 'warning';
			$message = 'Something went wrong, try again!';
		}


        return redirect()->route('uploaded workflow')->with($response, $message);

	}
	
    public function deletepromotionalmaterial(Request $req, $id){

		$getmaterial = PromotionalMaterial::where('id', $id)->delete();

		$response = 'success';
		$message = 'Deleted Successful';

        return redirect()->back()->with($response, $message);

	}

    public function deleteworkflowmaterial(Request $req, $id){

		$getmaterial = WorkFlow::where('id', $id)->delete();

		$response = 'success';
		$message = 'Deleted Successful';

        return redirect()->back()->with($response, $message);

	}
	




    public function deletethismechanic(Request $req){

        Business::where('name_of_company', $req->station_name)->delete();

        SuggestedMechanics::where('station_name', $req->station_name)->delete();

        $response = 'success';
        $message = 'Deleted successfully';

        return redirect()->back()->with($response, $message);

    }

        // OneSignal Activity Log
    public function onesignal($heading, $content, $category){
        DB::table('onesignal')->insert(['heading' => $heading, 'content' => $content, 'category' => $category]);
    }

	public function checkInformations(Request $req){

		if($req->purpose == "mechanic"){
			// Get MM details
			$getMM = User::where('id', $req->id)->get();

			if(count($getMM) > 0){
				$resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($getMM), 'action' => 'mechanic'];
			}
			else{
				$resData = ['res' => 'User information not available', 'message' => 'error', 'action' => 'mechanic'];
			}
		}
		elseif($req->purpose == "dealer"){
			// Get MM details
			$getAD = Admin::where('id', $req->id)->get();

			if(count($getAD) > 0){

				$getInfo = Business::where('busID', $getAD[0]->busID)->get();

				if(count($getInfo)){
					$resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($getInfo), 'action' => 'dealer'];
				}
				else{
					$resData = ['res' => 'No valid information for this user', 'message' => 'error', 'action' => 'dealer'];
				}


			}
			else{
				$resData = ['res' => 'User information not available', 'message' => 'error', 'action' => 'dealer'];
			}
		}


		return $this->returnJSON($resData);
	}


	public function ticketInformation(Request $req){
		// Fetch Ticket Info
		$getTickets = Ticketing::where('ticketID', $req->ticketID)->get();

		if(count($getTickets) > 0){
			$resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($getTickets)];
		}
		else{
			$resData = ['res' => 'Invalid Ticket Raised', 'message' => 'error'];
		}

		return $this->returnJSON($resData);
	}

	public function ticketActions(Request $req){
		$getdetails = Ticketing::where('ticketID', $req->ticketID)->get();

		if(count($getdetails) > 0){
			if($req->action == "Reply"){
				$resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($getdetails), 'action' => 'Reply'];
			}
			elseif($req->action == "Delete"){
				// Delete ticket
				Ticketing::where('ticketID', $getdetails[0]->ticketID)->delete();
				$resData = ['res' => 'Ticket Deleted', 'message' => 'success', 'action' => 'Delete', 'link' => 'Admin'];
			}
		}
		else{
			$resData = ['res' => 'Error Getting Ticket', 'message' => 'error'];
		}


		return $this->returnJSON($resData);
	}


	public function accountAction(Request $req){
		if($req->purpose == "mechanic"){

			$userInf = User::where('id', $req->id)->get();
			if(count($userInf) > 0){
				if($req->action == "activate"){
					// Update Status
					User::where('id', $req->id)->update(['status' => '1']);

					$resData = ['res' => 'Successfully Activated', 'message' => 'success', 'action' => 'mechanic', 'link' => 'Admin'];
				}
				elseif($req->action == "deactivate"){
					User::where('id', $req->id)->update(['status' => '2']);

					$resData = ['res' => 'Successfully Deactivated', 'message' => 'success', 'action' => 'mechanic', 'link' => 'Admin'];
				}

				elseif($req->action == "delete"){
					User::where('id', $req->id)->delete();

					$resData = ['res' => 'Successfully Deleted', 'message' => 'success', 'action' => 'mechanic', 'link' => 'Admin'];
				}
			}
			else{
				$resData = ['res' => 'User information not available', 'message' => 'error', 'action' => 'mechanic'];
			}


		}
		elseif($req->purpose == "dealer"){

			$busInf = Business::where('id', $req->id)->get();

			if(count($busInf) > 0){
				if($req->action == "activate"){
					// Update Status
					Admin::where('id', $req->id)->update(['status' => '1']);

					$resData = ['res' => 'Successfully Activated', 'message' => 'success', 'action' => 'dealer', 'link' => 'Admin'];
				}
				elseif($req->action == "deactivate"){
					// Update Status
					Admin::where('id', $req->id)->update(['status' => '0']);

					$resData = ['res' => 'Successfully Deactivated', 'message' => 'success', 'action' => 'dealer', 'link' => 'Admin'];
				}

				elseif($req->action == "delete"){
					// Update Status
					$check = Admin::where('id', $req->id)->get();

					if(count($check) > 0){
						Admin::where('busID', $check[0]->busID)->delete();
						Business::where('busID', $check[0]->busID)->delete();
						BusinessStaffs::where('busID', $check[0]->busID)->delete();
						User::where('busID', $check[0]->busID)->delete();

						$resData = ['res' => 'Successfully Deleted', 'message' => 'success', 'action' => 'dealer', 'link' => 'Admin'];
					}
					else{
						$resData = ['res' => 'Cannot be deleted at the moment', 'message' => 'error', 'action' => 'dealer', 'link' => 'Admin'];
					}


				}
			}
			else{
				$resData = ['res' => 'User information not available', 'message' => 'error', 'action' => 'dealer'];
			}


		}

		return $this->returnJSON($resData);
	}

	public function acceptPoints(Request $req){
		// Do update state
		if($req->action == "Approval"){
			$pointsred = RedeemPoints::where('ref_code', $req->ref_code)->update(['status' => '1']);

			$resData = ['res' => 'Successfully Approved', 'message' => 'success', 'action' => 'Approval', 'link' => 'Admin'];
		}


		return $this->returnJSON($resData);
	}

	public function contactRedeem(Request $req){
		// Do update state
		if($req->action == "ReplyPoint"){
			$pointsredx = RedeemPoints::where('ref_code', $req->ref_code)->get();

			if(count($pointsredx) > 0){
				RedeemPoints::where('ref_code', $req->ref_code)->update(['status' => '1']);
				$resData = ['res' => 'Fetching...', 'message' => 'success', 'action' => 'ReplyPoint', 'data' => json_encode($pointsredx)];
			}
			else{
				$resData = ['res' => 'Cannot contact user at the moment', 'message' => 'info', 'action' => 'ReplyPoint'];
			}

		}


		return $this->returnJSON($resData);
	}


	public function userfulldetails(Request $req){
		// Get User Details
		$userinfs = User::where('id', $req->id)->get();

		if(count($userinfs) > 0){
			$resData = ['res' => 'Fetching...', 'message' => 'success', 'data' => json_encode($userinfs)];
		}
		else{
			$resData = ['res' => 'Cannot get contact details at the moment', 'message' => 'info'];
		}

		return $this->returnJSON($resData);
	}

	public function userautofulldetails(Request $req){

		if($req->val == "autoStaffs"){
			// Get Info
			$userinfs = User::where('email', $req->email)->get();

			if(count($userinfs) > 0){
			$resData = ['res' => 'Fetching...', 'message' => 'success', 'data' => json_encode($userinfs), 'action' => 'autoStaffs'];
			}
			else{
				$resData = ['res' => 'Cannot get contact details at the moment', 'message' => 'info'];
			}



		}
		elseif($req->val == "autoStores"){
			// Get Info
			$userinfs = Business::where('email', $req->email)->get();

			if(count($userinfs) > 0){

				// Get Status
				$status = Admin::where('busID', $userinfs[0]->busID)->get();
			$resData = ['res' => 'Fetching...', 'message' => 'success', 'data' => json_encode($userinfs), 'action' => 'autoStores', 'status' => $status[0]->status];
			}
			else{
				$resData = ['res' => 'Cannot get contact details at the moment', 'message' => 'info'];
			}
		}

		return $this->returnJSON($resData);
	}

	public function getdetailEstimate(Request $req){
		// Fetch Details of estimate
		$getData = DB::table('prepareestimate')
			->join('estimate', 'prepareestimate.post_id', '=', 'estimate.opportunity_id')->where('estimate.opportunity_id', $req->post_id)->where('estimate.estimate_id', $req->estimate_id)
			->get();

			if(count($getData) > 0){
				$resData = ['res' => 'Fetching...', 'message' => 'success', 'data' => json_encode($getData), 'action' => $req->action];
			}
			else{
				$resData = ['res' => 'Cannot get contact details at the moment', 'message' => 'info'];
			}

		return $this->returnJSON($resData);
	}

	public function estimatePaydetails(Request $req){

		if($req->action == "paydetails"){
					// Fetch Details of estimate
			// $getPayinfo = DB::table('estimatepay')
   //              ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
   //              ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
   //              ->where('estimatepay.estimate_id', $req->estimate_id)
   //              ->get();

                $getPayinfo = EstimatePay::where('estimate_id', $req->estimate_id)->get();

                // dd($getPayinfo);

			if(count($getPayinfo) > 0){

				$resData = ['res' => 'Fetching...', 'message' => 'success', 'data' => json_encode($getPayinfo), 'action' => $req->action];
			}
			else{
				$resData = ['res' => 'Payment not found for this user', 'message' => 'info'];
			}

		}
		elseif($req->action == "activate"){

			$getactivityData = DB::table('estimatepay')
                ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimatepay.post_id')
                ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimatepay.estimate_id')
                ->where('estimatepay.estimate_id', $req->estimate_id)
                ->get();

              if(count($getactivityData) > 0){
              	// Get Project contractor
              	$getInfoCont = Estimate::where('estimate_id', $req->estimate_id)->get();
              	if(count($getInfoCont) > 0){
              		// Get client detail
              		$clientDetail = User::where('station_name', $getInfoCont[0]->update_by)->get();
              		if(count($clientDetail) > 0){
              			EstimatePay::where('post_id', $req->post_id)->update(['state' => '1']);

              			$this->name = $clientDetail[0]->name;
              			$this->to = $clientDetail[0]->email;
              			$this->message = "We wish to notify you that payment has been processed and delivered for the maintenance job done on VEHICLE NO: ".$getInfoCont[0]->vehicle_licence.". Thank you for choosing Vimfile. ";

              			$this->sendEmail($this->to, 'Payment Successfully processed');

              			$resData = ['res' => 'Successfull', 'message' => 'success', 'link' => 'Paymenthistory', 'action' => 'activate'];
              		}
              		else{
              			$resData = ['res' => 'No valid Mechanic or Auto Care Center for this project', 'message' => 'info'];
              		}

              	}
              	else{
              		$resData = ['res' => 'No valid project selected', 'message' => 'info'];
              	}

              }
              else{

              }
		}

		return $this->returnJSON($resData);
	}

	public function ajaxactivateJobdone(Request $req){
		// Get data
		$getestData = Estimate::where('opportunity_id', $req->post_id)->where('maintenance', '2')->get();
		if(count($getestData) > 0){
			// Update
			// dd($getestData[0]->opportunity_id);
			$updtdata = Estimate::where('opportunity_id', $getestData[0]->opportunity_id)->update(['maintenance' => '3']);

			if($updtdata == 1){
				// Send mail
				$userDet = User::where('email', $getestData[0]->email)->get();
				if(count($userDet) > 0){
					$this->name = $userDet[0]->name;
				}
				else{
					$this->name = "from VIMFile";
				}



      			$this->to = $getestData[0]->email;

      			// $this->message = $getestData[0]->update_by." just confirmed they have finished with the maintenance on your vehicle with licence number: ".$getestData[0]->vehicle_licence." on this day: ".date('d-M-Y')." . This is from Vimfile.";

      			$this->sendEmail($this->to, 'Your vehicle maintenance is completed');

      			$resData = ['res' => 'Notification sent', 'message' => 'success', 'action' => 'activate', 'link' => 'Admin'];
			}
			else{
				$resData = ['res' => 'Something went wrong', 'message' => 'info'];
			}
		}
		else{
			$resData = ['res' => 'Cannot activate this job', 'message' => 'error'];
		}


		return $this->returnJSON($resData);
	}

	public function ajaxmailclient(Request $req){
		// Get data
		if($req->val == "ongoingjob"){
			$getdata = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)->where('opportunitypost.post_id', $req->post_id)->get();

			if(count($getdata) > 0){
				// Send mail
				$this->to = $getdata[0]->email;
				$this->subject = $getdata[0]->post_subject." for your ".$getdata[0]->post_make." / ".$getdata[0]->post_model." is undergoing maintenance.";
				$this->heading = 'On-going Maintenance Job';
				$this->message = 'This is from Vimfile. Your vehicle is presently undergoing maintenance with your mechanic. Thanks';

				$this->sendEmail($this->to, 'Vehicle maintenance');

				$resData = ['res' => 'Notification sent', 'message' => 'success', 'link' => 'Admin'];
			}
			else{
				$resData = ['res' => 'Cannot retrieve data', 'message' => 'error'];
			}
		}


		return $this->returnJSON($resData);
	}


 	public function ajaxadminLogout(Request $req){

        $getAdmin = Admin::where('username', $req->username)->get();
        // dd($getAdmin);
        if($getAdmin){
          Session::flush();
          $site = "AdminLogin";
          $resData = ['res' => 'Login out', 'message' => 'success', 'link' => $site];

        }
        else{
          $resData = ['res' => 'Network Fail. Try Later !', 'message' => 'fail'];
        }

          return $this->returnJSON($resData);

    }

        public function newsandhappenings(Request $req){
        $req = request();
        // Check if post already exist
        $checkNews = Newshappening::where('post_id', $req->post_id)->get();
        if(count($checkNews) > 0){
            // Post Already Exist
            $resData = ['message' => 'Post already exists', 'title' => ' Oops ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'error'];
        }
        else{
            // Insert Record

            if($req->file('newsUpload'))
            {
                //Get filename with extension
                $filenameWithExt = $req->file('newsUpload')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
                // Get just extension
                $extension = $req->file('newsUpload')->getClientOriginalExtension();

                $media_name = $req->file('newsUpload')->getRealPath();

                // Filename to store
                $fileNameToStore = rand().'_'.time().'.'.$extension;
                // Upload Image
                // $path = $req->file('newsUpload')->storeAs('public/uploads', $fileNameToStore);

                // $path = $req->file('newsUpload')->move(public_path('/newsfile/'), $fileNameToStore);
                $path = $req->file('newsUpload')->move(public_path('../../newsfile/'), $fileNameToStore);
            }
            else{
            	$fileNameToStore = 'noImage.png';
            }


            $doIns = Newshappening::insert(['post_id' => $req->post_id, 'subject' => $req->subject, 'description' => $req->description, 'file_upload' => $fileNameToStore, 'state' => $req->state]);

            if($doIns ==  true){
                // Send Mail to Registered Users
                $getReguser = User::inRandomOrder()->get();
                if(count($getReguser) > 0){
                    foreach($getReguser as $key){
                        $this->to = $key['email'];
                        // $this->to = 'adenugaadebambo41@gmail.com';
                        $this->name = $key['firstname'].' '.$key['lastname'];
                        $this->subject = $req->subject;
                        $this->description = $req->description;
                        $this->file = $fileNameToStore;

                        $this->sendEmail($this->to, $this->subject);
                    }
                }


                $resData = ['message' => 'Successfully posted', 'title' => ' Good ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'success', 'link' => 'Admin'];
            }
            else{
                $resData = ['message' => 'Something went wrong!', 'title' => ' Oops ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'info'];
            }

        }

        return $this->returnJSON($resData);
    }


    public function newshappeningupdates(Request $req){
        $req = request();
        // Check if post already exist
        $checkNews = Newshappening::where('post_id', $req->post_id)->get();
            // Insert Record
            if($req->file('newsUpload') == null){
                // Update
                $updtPost = Newshappening::where('post_id', $req->post_id)->update(['post_id' => $req->post_id, 'subject' => $req->subject, 'description' => $req->description, 'state' => $req->state]);

                if($updtPost == 1){
                    $resData = ['message' => 'Successfully Updated', 'title' => ' Good ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'success', 'link' => 'Admin'];
                }
                else{
                    $resData = ['message' => 'Something went wrong!', 'title' => ' Oops ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'info'];
                }

            }
            else{
                if($req->file('newsUpload'))
                {
                    //Get filename with extension
                    $filenameWithExt = $req->file('newsUpload')->getClientOriginalName();
                    // Get just filename
                    $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
                    // Get just extension
                    $extension = $req->file('newsUpload')->getClientOriginalExtension();

                    $media_name = $req->file('newsUpload')->getRealPath();

                    // Filename to store
                    $fileNameToStore = rand().'_'.time().'.'.$extension;
                    // Upload Image
                    // $path = $req->file('newsUpload')->storeAs('public/uploads', $fileNameToStore);

                    // $path = $req->file('newsUpload')->move(public_path('/newsfile/'), $fileNameToStore);
                    $path = $req->file('newsUpload')->move(public_path('../../newsfile/'), $fileNameToStore);
                }

                $updtPost = Newshappening::where('post_id', $req->post_id)->update(['post_id' => $req->post_id, 'subject' => $req->subject, 'description' => $req->description, 'file_upload' => $fileNameToStore, 'state' => $req->state]);

                if($updtPost == 1){
                    $resData = ['message' => 'Successfully Updated', 'title' => ' Good ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'success', 'link' => 'Admin'];
                }
                else{
                    $resData = ['message' => 'Something went wrong!', 'title' => ' Oops ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'info'];
                }
            }




        return $this->returnJSON($resData);
    }

        public function updateUploadaction(Request $req){

        if($req->val == "newsposts"){
            // Get News Post
            $getPost = Newshappening::where('id', $req->id)->get();
            if(count($getPost) > 0){
                $state = $getPost[0]->state;
                if($state == 1){
                    $this->state = 0;
                }
                else{
                    $this->state = 1;
                }
                // Update
                $updtPost = Newshappening::where('id', $req->id)->update(['state' => $this->state]);

                if($updtPost == 1){
                    $resData = ['message' => 'Updated', 'title' => ' Changes ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'success', 'action' => 'newsposts', 'link' => 'Allnews'];
                }
                else{
                    $resData = ['message' => 'Something went wrong!', 'title' => ' Oops, ', 'icon' => 'glyphicon glyphicon-warning-sign ', 'type' => 'danger', 'state' => 'error'];
                }


            }
            else{
                $resData = ['message' => 'Post not found', 'title' => ' Oops, ', 'icon' => 'glyphicon glyphicon-warning-sign ', 'type' => 'danger', 'state' => 'error'];
            }

        }

        return $this->returnJSON($resData);
    }

    public function setDiscount(Request $req){
    	// Update Discount
    	$updtDisc = MinimumDiscount::where('discount', $req->discount)->update(['percent' => $req->percent]);

    	if($updtDisc == 1){
    		MinimumDiscount::where('discount', $req->service)->update(['percent' => $req->service_percent]);
    		$resData = ['message' => 'Updated', 'title' => ' Changes ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'success', 'action' => 'newsposts', 'link' => 'Admin'];
    	}
    	else{
    		$resData = ['message' => 'Discount error', 'title' => ' Oops, ', 'icon' => 'glyphicon glyphicon-warning-sign ', 'type' => 'danger', 'state' => 'error'];
    	}

    	return $this->returnJSON($resData);
    }

    public function setDiscountCharges(Request $req){

    	// Check if exist
    	$checkDisc = clientMinimum::where('busID', session('busID'))->where('discount', $req->discount)->get();

    	if(count($checkDisc) > 0){
    		// Update discount
    		$updtDisc = clientMinimum::where('busID', session('busID'))->where('discount', $req->discount)->update(['percent' => $req->percent]);

    		if($updtDisc == 1){
    			$resData = ['message' => 'Updated', 'title' => ' Changes ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'success', 'action' => 'newsposts', 'link' => 'Admin'];
    		}
    		else{
    			$resData = ['message' => 'Cannot update record', 'title' => ' Oops, ', 'icon' => 'glyphicon glyphicon-warning-sign ', 'type' => 'danger', 'state' => 'error'];
    		}
    	}
    	else{
    		// Insert Fresh
    		$insDisc = clientMinimum::insert(['busID' => session('busID'), 'discount' => $req->discount, 'percent' => $req->percent]);

    		if($insDisc ==  true){

    			$resData = ['message' => 'Values Set', 'title' => ' Minimum ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'success', 'action' => 'newsposts', 'link' => 'Admin'];
    		}
    		else{
    			$resData = ['message' => 'Cannot insert record', 'title' => ' Oops, ', 'icon' => 'glyphicon glyphicon-warning-sign ', 'type' => 'danger', 'state' => 'error'];
    		}
    	}

    	return $this->returnJSON($resData);
    }


    public function activateBW(Request $req){
    	// Activate user and generate login details
    	$getuser = User::where('busID', $req->busID)->get();

    	if(count($getuser) > 0){



    		if($req->action == "busywrenchactivate"){
    			// Generate Password and Update
                        $password = Hash::make($req->busID);
                        $user = User::where('busID', $req->busID)->get();

                        $updt = User::where('busID', $req->busID)->update(['password' => $password, 'admin' => 1, 'sponsored_mechanics' => 1, 'verified_mechanics' => 1, 'unverified_mechanics' => 0, 'plan' => 'Super']);




                        // Insert Record to Admin

			    		if($updt){

                            Stations::where('busID', $req->busID)->update(['platform_request' => 0, 'claim_business' => 1]);



                            //Check in admin
                            $checkAdmin = Admin::where('busID', $req->busID)->get();

                            $username = explode(" ", $getuser[0]->name);


                            $user_name = $username[0]."".mt_rand(000, 999);

                                $suggest = SuggestedMechanics::where('station_name', $getuser[0]->station_name)->get();

                                if(count($suggest) > 0){
                                    $searchcount = $suggest[0]->search_count;
                                }
                                else{
                                    $searchcount = 0;
                                }




                            if(count($checkAdmin) > 0){
                                SuggestedMechanics::where('station_name', $getuser[0]->station_name)->delete();

                                // update
                                Admin::where('busID', $req->busID)->update(['busID' => $req->busID, 'userID' => 'VIM_'.time(), 'name' => $getuser[0]->name, 'company' => $getuser[0]->station_name, 'role' => 'Owner', 'no_of_staff_added' => 0, 'plan' => 'Super', 'username' => $user_name, 'email' => $getuser[0]->email, 'password' => $password, 'status' => 1, 'accountType' => 'Auto Care']);

                                Business::where('busID', $req->busID)->update(['busID' => $req->busID, 'name_of_company' => $getuser[0]->station_name, 'address' => $getuser[0]->address, 'city' => $getuser[0]->city, 'state' => $getuser[0]->state, 'country' => $getuser[0]->country, 'zipcode' => $getuser[0]->zipcode, 'name' => $getuser[0]->name, 'position' => 'Owner', 'email' => $getuser[0]->email, 'telephone' => $getuser[0]->phone_number, 'mobile' => $getuser[0]->mobile, 'office' => $getuser[0]->office, 'accountType' => 'Auto Care', 'plan' => 'Super', 'specialty' => 'Automotive Service', 'service_offered' => $getuser[0]->specialization, 'claims' => 0, 'search_count' => $searchcount]);


                            }
                            else{
                                SuggestedMechanics::where('station_name', $getuser[0]->station_name)->delete();

                                // Insert
                                Admin::insert(['busID' => $req->busID, 'userID' => 'VIM_'.time(), 'name' => $getuser[0]->name, 'company' => $getuser[0]->station_name, 'role' => 'Owner', 'no_of_staff_added' => 0, 'plan' => 'Super', 'username' => $user_name, 'email' => $getuser[0]->email, 'password' => $password, 'status' => 1, 'accountType' => 'Auto Care']);

                                // Insert Business

                                Business::insert(['busID' => $req->busID, 'name_of_company' => $getuser[0]->station_name, 'address' => $getuser[0]->address, 'city' => $getuser[0]->city, 'state' => $getuser[0]->state, 'country' => $getuser[0]->country, 'zipcode' => $getuser[0]->zipcode, 'name' => $getuser[0]->name, 'position' => 'Owner', 'email' => $getuser[0]->email, 'telephone' => $getuser[0]->phone_number, 'mobile' => $getuser[0]->mobile, 'office' => $getuser[0]->office, 'accountType' => 'Auto Care', 'plan' => 'Super', 'specialty' => 'Automotive Service', 'service_offered' => $getuser[0]->specialization, 'claims' => 0, 'search_count' => $searchcount]);


                            }

                            $discountRate = clientMinimum::where('busID', $req->busID)->get();

                            if(count($discountRate) > 0){
                                // Update
                                clientMinimum::where('busID', $req->busID)->update(['discount' => 'discount', 'percent' => $user[0]->discountPercent]);
                            }
                            else{
                                // Insert
                                clientMinimum::insert(['busID' => $req->busID, 'discount' => 'discount', 'percent' => $user[0]->discountPercent]);
                            }

			    			// Send Mail with description

				    			$this->to = $getuser[0]->email;
		                        // $this->to = 'adenugaadebambo41@gmail.com';
		                        $this->name = $getuser[0]->station_name;
		                        $this->subject = "Busy Wrench Profile Reviewed and Account Activated";
		                        $this->description = $req->description."<hr><br>Below is your login details to <a href='https://vimfile.com/AdminLogin' target='_blank'>https://vimfile.com/AdminLogin</a> <br> Username: <b>".$user_name."</b> <br> Password: <b>".$req->busID."</b> <br>Kindly update your password when you login. <br><br>Thanks";
		                        $this->file = "noImage.png";

		                        $this->sendEmail($this->to, "Profile Reviewed and Account Activated");


			    			$resData = ['message' => 'Account Activated', 'title' => ' Busy Wrench ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'success', 'action' => 'busywrench'];
			    		}
			    		else{
			    			$resData = ['message' => 'Something went wrong', 'title' => ' Oops, ', 'icon' => 'glyphicon glyphicon-warning-sign ', 'type' => 'danger', 'state' => 'error'];
			    		}
    		}
    		else{
    			$this->to = $getuser[0]->email;
                // $this->to = 'adenugaadebambo41@gmail.com';
                $this->name = $getuser[0]->station_name;
                $this->subject = "Busy Wrench Profile Reviewed and Account Declined";
                $this->description = $req->description."<hr>";
                $this->file = "";

                $this->sendEmail($this->to, "Profile Reviewed and Account Declined");


			$resData = ['message' => 'Account Declined', 'title' => ' Busy Wrench ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'success', 'action' => 'busywrench'];
    		}

    	}
    	else{
    		$resData = ['message' => 'Cannot find this user', 'title' => ' Oops, ', 'icon' => 'glyphicon glyphicon-warning-sign ', 'type' => 'danger', 'state' => 'error'];
    	}


    	return $this->returnJSON($resData);
    }



    public function updateCrawls(Request $req){

    	$check = DB::table('suggestedmechanics')->where('id', $req->id)->get();

    	if(count($check) > 0){
    		// Update

    		$updt = DB::table('suggestedmechanics')->where('id', $req->id)->update(['station_name' => $req->station_name, 'address' => $req->address, 'location' => $req->city, 'state' => $req->state, 'city' => $req->city, 'zipcode' => $req->zipcode, 'country' => $req->country]);

    		if($updt == 1){
    			$resData = ['message' => 'Information Updated', 'title' => ' Great ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'success'];
    		}
    		else{
    			$resData = ['message' => 'Something went wrong', 'title' => ' Oops, ', 'icon' => 'glyphicon glyphicon-warning-sign ', 'type' => 'danger', 'state' => 'error'];
    		}
    	}
    	else{
    		$resData = ['message' => 'Information not found', 'title' => ' Oops, ', 'icon' => 'glyphicon glyphicon-warning-sign ', 'type' => 'danger', 'state' => 'error'];
    	}

    	return $this->returnJSON($resData);
    }



    public function getCrawled(Request $req){

    	$check = DB::table('suggestedmechanics')->where('id', $req->id)->get();

    	if(count($check) > 0){
    		// Get Information
    		$resData = ['message' => 'Fetching..', 'title' => ' Good ', 'icon' => 'glyphicon glyphicon-hand-right ', 'type' => 'inverse', 'state' => 'success', 'data' => json_encode($check)];
    	}
    	else{
    		$resData = ['message' => 'Information not found', 'title' => ' Oops, ', 'icon' => 'glyphicon glyphicon-warning-sign ', 'type' => 'danger', 'state' => 'error'];
    	}

    	return $this->returnJSON($resData);
    }



    public function businessUpdate(Request $req){

		if(session('role') == "Agent"){
			$email = $req->emailval;
		}
		else{
			$email = session('email');
		}

        $getuser = User::where('email', $email)->get();

        // dd($req->all());

        if(count($getuser) > 0){

            switch ($req->val) {
                case "company":
                    // Code
                    $updt = User::where('email', $email)->update(['address' => $req->company_address,'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->postal_code, 'station_name' => $req->company_name, 'size_of_employee' => $req->size_of_employee, 'year_of_practice' => $req->practical_experience, 'facebook' => $req->facebook, 'twitter' => $req->twitter, 'instagram' => $req->instagram, 'year_started_since' => $req->year_started_since, 'admin' => 1]);

                    User::where('busID', $getuser[0]->busID)->update(['facebook' => $req->facebook, 'twitter' => $req->twitter, 'instagram' => $req->instagram]);


                    $resData = ['message' => 'Company Information Updated. Changes will be effective on next refresh', 'title' => 'Good!', 'state' => 'success'];

                    break;


                case "contact":
                    // Code
                    $updt = User::where('email', $email)->update(['name' => $req->fullname, 'email' => $email, 'phone_number' => $req->phone_number, 'mobile' => $req->mobile, 'office' => $req->office, 'admin' => 1]);

                    $resData = ['message' => 'Contact Information Updated. Changes will be effective on next refresh', 'title' => 'Good!', 'state' => 'success'];

                    break;


                case "speciality":



                    // Code
                    $updt = User::where('email', $email)->update(['mechanical_skill' => $req->mechanical, 'electrical_skill' => $req->electrical, 'transmission_skill' => $req->transmissions, 'body_work_skill' => $req->body_works, 'other_skills' => $req->others, 'admin' => 1]);

                    User::where('busID', $getuser[0]->busID)->update(['mechanical_skill' => $req->mechanical, 'electrical_skill' => $req->electrical, 'transmission_skill' => $req->transmissions, 'body_work_skill' => $req->body_works, 'other_skills' => $req->others]);

                    $resData = ['message' => 'Speciality Information Updated. Changes will be effective on next refresh', 'title' => 'Good!', 'state' => 'success'];

                    break;

                case "value":
                    // Code
                    $updt = User::where('email', $email)->update(['vimfile_discount' => $req->vimfile_discount, 'repair_guaranteed' => $req->repair_guaranteed, 'free_estimated' => $req->free_estimates, 'walk_in_specified' => $req->walk_in_welcome, 'other_value_added' => $req->other_added_value, 'average_waiting' => $req->average_waiting_period, 'hours_of_operation' => $req->hours_of_operation]);

                    User::where('busID', $getuser[0]->busID)->update(['vimfile_discount' => $req->vimfile_discount, 'repair_guaranteed' => $req->repair_guaranteed, 'free_estimated' => $req->free_estimates, 'walk_in_specified' => $req->walk_in_welcome, 'other_value_added' => $req->other_added_value, 'average_waiting' => $req->average_waiting_period, 'hours_of_operation' => $req->hours_of_operation]);



                    $resData = ['message' => 'Value Added Information Updated. Changes will be effective on next refresh', 'title' => 'Good!', 'state' => 'success'];

                    break;

                case "amenity":
                    // Code
                    $updt = User::where('email', $email)->update(['wifi' => $req->wifi, 'restroom' => $req->rest_room, 'lounge' => $req->lounge, 'parking_space' => $req->parking_space, 'admin' => 1]);

                    $resData = ['message' => 'Amenities Information Updated. Changes will be effective on next refresh', 'title' => 'Good!', 'state' => 'success'];

                    break;

                case "history":
                    // Code
                    $updt = User::where('email', $email)->update(['year_established' => $req->year_established, 'background' => $req->background, 'admin' => 1]);

                    $resData = ['message' => 'History Information Updated. Changes will be effective on next refresh', 'title' => 'Good!', 'state' => 'success'];

                    break;

                default:
                    $resData = ['message' => 'Unrecognized request format', 'title' => ' Oops!', 'state' => 'error'];

                }
        }
        else{
            $resData = ['message' => 'Information not found', 'title' => ' Oops!', 'state' => 'error'];
        }

    	return $this->returnJSON($resData);
    }








    public function printLetter(Request $req){

        // dd($req->all());

		$getinfo = DB::table('suggestedmechanics')->whereIn('id', $req->checkme)->get();

	             foreach($getinfo as $key => $value)
				{
					$folder = 'bulk_claims/'.$value->country;
					if(!file_exists($folder)){
						mkdir($folder, 0777, true);
					}

					$html = '';
					$view = view('admin.pdf.claimbusiness')->with(compact('value'));
					$html .= $view->render();
					PDF::loadHTML($html)->save(public_path('../..')."/".$folder."/".$value->station_name.'.pdf');
					// PDF::loadHTML($html)->save(public_path()."/".$folder."/".$value->station_name.'.pdf');

					// $pdf = App::make('dompdf.wrapper');
					// $pdf->loadHTML("<div style='font-size: 14px; margin-top: 100px;'><img src='https://res.cloudinary.com/pilstech/image/upload/v1600186029/vimnewlogo_pndv6i.png' style='width:200px; height: 100px;'><img src='https://res.cloudinary.com/pilstech/image/upload/v1600186031/bw_ncbz2n.png' style='width:100px; height: 50px;'><div style='float: right; font-weigth: bold;'> Professionals' File Inc. <br> 10 George St. North, <br> Brampton ON L6X1R2, Canada. <br> E: info@vimfile.com | W: https://www.vimfile.com </div> <br> <b>".date('d - F - Y')."</b> <br><br> The Business Owner/Manager <br> ".$value->station_name." <br> <b>".$value->address."</b> <br> <b>".$value->city."</b> <b>".$value->zipcode."</b>, <b>".$value->state."</b>  <b>".$value->country."</b> <br><br> <b>Dear Sir/Madam,</b> <br><br> <b>RE: CLAIM YOUR AUTO REPAIR SHOP ON BUSY WRENCH</b> <br> Busy Wrench by vimfile is an online directory of auto repair shops. The service connects vehicle owners with auto repair shops through the free listing services. <br><br> <b> What is a claimed business?</b> <br> A claimed business page is one that has been claimed by the owner or representative of the business through our verification process. Claiming is free and enable you to enjoy our free listing services and other services with Busy Wrench. <br><br> <b>Why should business owners claim their business pages?</b> <br> By claiming business pages, business owners gain access to a suite of free tools to showcase their businesses on Busy Wrench. With claimed business pages, you can: <br> <ul><li>Respond to reviews with a direct message or public comment</li><li>Reply to messages or quote requests from potential customers</li><li>Track User Views and Customer Leads generated</li><li>Upload and manage photos</li><li>Update business information like address, phone number, opening hours, services, available facilities, website, and other critical business information</li><li>Add further information to the page, like a business owner biography, specialties, and more</li></ul> <br> <b>Does it cost anything to claim a business page?</b> <br> No, it's completely free to claim a business page on Busy Wrench. <br><br> <b>What are the steps to claim Business on Busy Wrench.</b> <ul style='list-style-type: lower-alpha;'><li>Go to <a href='https://vimfile.com'>www.vimfile.com</a></li><li>Click on <b>“Claim Business”</b> on the menu</li><li>Use Search Field to search for your company</li><li>If found, click on claim business, provide missing information and submit</li><li>If not found, no problem, simply create a new account and provide required details.</li></ul> Thanks <br> Busy Wrench&reg; <br> Professionals’ File Inc</div>");
					// 	return $pdf->stream();
				}

			return back();


    }


    public function crawledmechanics(){
    	$crawled = DB::table('suggestedmechanics')->count();

    	return $crawled;
    }

    public function crawledautodealers(){
    	$crawled = DB::table('suggesteddealers')->count();

    	return $crawled;
    }

    public function claimcount(){
        $getcount = Stations::where('claim_business', 1)->orderBy('created_at', 'DESC')->count();

        return $getcount;
    }

    public function crawlcountrysort(){
    	$crawled = DB::table('suggestedmechanics')
                 ->select('country', DB::raw('count(*) as total'))
                 ->where('country', '!=', NULL)
                 ->groupBy('country')
                 ->get();

    	return $crawled;
    }

    public function crawlstateSort($country){
    	$crawled = DB::table('suggestedmechanics')
                 ->select('state', DB::raw('count(*) as total'))
                 ->where('country', $country)
                 ->groupBy('state')
                 ->get();

    	return $crawled;
    }


    public function crawLetter($country){


    	$dir = 'bulk_claims/'.$country;



    	if(!file_exists($dir)){
    		// Do nothing
    		$dir = '#';
    	}
    	else{
    		$dir = $dir;
    	}


    	return $dir;
    }


    public function noemails(){
    	$noemail = DB::table('suggestedmechanics')
			    	->select('*', DB::raw('count(*) as total'))
			    	->where('country', '!=', NULL)
	                ->groupBy('country')
	                ->get();

    	return $noemail;
    }


    public function justcountry(){
    	$jsutcountries = DB::table('suggestedmechanics')
			    	->select('country')
			    	->where('country', '!=', NULL)
			    	->groupBy('country')
	                ->get();

    	return $jsutcountries;
    }


    public function noemailmechanicbycountry($country){
    	$noemail = DB::table('suggestedmechanics')
			    	->select('*')
			    	->where('country', '=', $country)
	                ->orderBy('created_at', 'DESC')
	                ->get();

    	return $noemail;
    }


    public function passwordChange(Request $req){
        $admin = Admin::where('email', $req->username)->get();

        if(count($admin) > 0){
            if(Hash::check($req->oldpassword, $admin[0]->password)){

                // Update Password
                $update = Admin::where('email', $req->username)->update(['password' => Hash::make($req->newpassword)]);

                if($update == 1){
                    // Return response back
                    return redirect()->back()->with('success', 'Password updated');
                }
                else{
                    return redirect()->back()->with('warning', 'Something went wrong!');
                }
            }
            else{
                // Return response back
                return redirect()->back()->with('warning', 'Old password does not match');
            }
        }
        else{
            // Return response back
            return redirect('Admin')->with('warning', 'Invalid username');
        }
    }


    // Login counts and trial activation

    public function logTrial($email){

        $getUser = Admin::where('email', $email)->get();

        $times = $getUser[0]->login_times + 1;

        $trial_expire = date("Y-m-d", strtotime("+30 days"));

        if(session('role') != "Super"){
            if($getUser[0]->login_times > 0){
                $updateLogin = Admin::where('email', $email)->update(['login_times' => $times]);
            }
            else{
                Admin::where('email', $email)->update(['login_times' => $times, 'free_trial_expire' => $trial_expire]);
            }
        }

    }


    public function expertInformation(){
        $askExpert = AskExpert::orderBy('created_at', 'DESC')->get();

        return $askExpert;
    }

    public function expertinformationPage(){
        $askExpert = AskExpert::orderBy('created_at', 'DESC')->paginate(5);

        return $askExpert;
    }


    public function checkplanExp($email){
        $getUser = Admin::where('email', $email)->get();

        // $trial_expire = $getUser[0]->free_trial_expire;
        $trial_expire = date("Y-m-d", strtotime("+30 days"));

        $next = date_create($trial_expire);

        $today = date("Y-m-d");


        $fifteen_days = date_sub($next, date_interval_create_from_date_string("15 days"));

        $seven_days = date_sub($next, date_interval_create_from_date_string("23 days"));

        if($trial_expire == $today){
            // Subscription Expired
            Admin::where('email', $getUser[0]->email)->update(['plan' => 'Start Up']);
            Business::where('email', $getUser[0]->email)->update(['plan' => 'Start Up']);
            User::where('busID', $getUser[0]->busID)->update(['plan' => 'Start Up']);

            // Send Mail for renewal

            $this->sender = "info@vimfile.com";
			$this->subject = "Free trial has ended";
			$this->message = "We wish to notify you that your free trial has ended. Kindly <a href='https://vimfile.com/AdminLogin'>click here to login</a> to your account. <br><br> Upgrade your account today to keep enjoying more. <br><br> Thanks for choosing VIMFile";
            $this->to = $getUser[0]->email;

            $this->sendEmail($this->to, 'VIM File - New Message');

        }

        elseif($today == $fifteen_days){
            // Send Mail for expiration left with 15 days
            $this->sender = "info@vimfile.com";
			$this->subject = "15 days remaining to the end of free trial";
			$this->message = "We wish to notify you that your free trial expires on <b>".date('d/F/Y', strtotime($getUser[0]->free_trial_expire))."</b>. You have <b>15days</b> to left renewal. <br><br> Thanks for choosing VIMFile";
            $this->to = $getUser[0]->email;

            $this->sendEmail($this->to, 'VIM File - New Message');

        }

        elseif($today == $seven_days){
            // Send Mail for expiration left with 15 days

            $this->sender = "info@vimfile.com";
			$this->subject = "7 days remaining to the end of free trial";
			$this->message = "We wish to notify you that your free trial expires on <b>".date('d/F/Y', strtotime($getUser[0]->free_trial_expire))."</b>. You have <b>7days</b> to left renewal. <br><br> Thanks for choosing VIMFile";
            $this->to = $getUser[0]->email;

            $this->sendEmail($this->to, 'VIM File - New Message');

        }



	}
	

	// Cron for created mechanics
	public function createdMechanicCrons(Request $req){

		// Get all created mechanics that has 0 login
		
		$userinf = Admin::where('login_times', 0)->where('accountType', '!=', 'Super User')->get();

		if(count($userinf) > 0){
			foreach ($userinf as $key => $value) {
				$this->to = $value->email;
				// $this->to = 'bambo@vimfile.com';
				$this->name = $value->name;

				$this->subject = "VIMFILE - 30 DAYS FREE TRIAL";
				$this->message = "<p>Hello ".$this->name.", </p><p>Enjoy your 30 days FREE-TRIAL on busywrench.com when you login to your account. </p><p><a href='https://vimfile.com/AdminLogin'>Login to your account today!</a></p>";
				$this->file = NULL;
		
				$this->sendEmail($this->to, "Compose Mail");

			}

			echo "Done";
		}
		else{
			// Do nothing
			echo 0;
		}

	}




   public function checkSession($token){

   		if($token != 1){
   			return view('admin.login');
   		}
   }

   // Activity Log
   public function activities($ip, $country, $city, $currency, $action){
	DB::table('activity')->insert(['ipaddress' => $ip, 'country' => $country, 'city' => $city, 'currency' => $currency, 'action' => $action]);
}


// Get Auto care stores
public function autoStores(){
	// Mapped with Admin & business

	$autoStores = DB::table('business')->distinct()
	            ->join('vim_admin', 'vim_admin.busID', '=', 'business.busID')
	            ->orderBy('business.created_at', 'DESC')->get();

	return $autoStores;

}

// Get Auto care staffs
public function autoStaffs(){
	// Mapped with station

	$autoStores = DB::table('users')->where('userType', 'Auto Care')
	            ->orderBy('users.created_at', 'DESC')->get();

	return $autoStores;
}

 	// JSON Response
 	public function returnJSON($data){
        return response()->json($data);
    }

}

