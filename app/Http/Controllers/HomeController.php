<?php

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

use App\BusinessStaffs as BusinessStaffs;

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

use App\Notification as Notification;

use App\MinimumDiscount as MinimumDiscount;

use App\clientMinimum as clientMinimum;

use App\AppointmentFeedback as AppointmentFeedback;

use App\AccAppointmentFeedback as AccAppointmentFeedback;

use App\Feedback as Feedback;

use App\SuggestedMechanics as SuggestedMechanics;

use App\PhoneAppointment as PhoneAppointment;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {

        $this->middleware('auth')->except(['startup', 'promo_1', 'promo_2', 'index', 'about', 'features', 'contact', 'privacy', 'terms', 'ajaxcontactus', 'pricing', 'makepay', 'resetpassword', 'forgotPassword', 'resetspassword', 'prices', 'ajaxmakePay', 'smartdriver', 'pointCalc', 'autocares', 'drivers', 'businesses', 'signupfree', 'checkuserRegistration', 'triggeruser', 'registervehicleReminder', 'recordmaintenanceReminder', 'uploadcontactReminder', 'vehicleinfoReminder', 'ivimreportReminder', 'myweeklyPoints', 'myglobalPoints', 'subscribeNews', 'otherSearch', 'promosearch2', 'migrate', 'claimbusiness', 'ajaxcheckClaims', 'profileupdate', 'ajaxupdateme', 'checkbusiness', 'webForm']);

        $this->getIp = $_SERVER['REMOTE_ADDR'];


        $this->arr_ip = geoip()->getLocation($this->getIp);
        // $this->arr_ip = geoip()->getLocation('154.120.86.96');
        // $this->arr_ip = geoip()->getLocation('206.189.30.235');
        // $this->arr_ip = geoip()->getLocation('165.227.36.202');
        // $this->arr_ip = geoip()->getLocation('64.235.204.107');

        $this->country = $this->arr_ip['country'];
        $this->continent = $this->arr_ip['continent'];

        // dd($this->arr_ip);

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function checkbusiness()
    {
        if(Auth::user()){

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }


        }

        $notify = $this->notify();

        $busInfo = $this->clientinfo();

        $postActive = Newshappening::where('state', '1')->orderBy('created_at', 'DESC')->take(2)->get();




        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Home page');
        return view('admin.pdf.claimbusiness')->with(['pages' => 'Home', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'postActive' => $postActive, 'notify' => $notify]);
    }


    public function index()
    {
        if(Auth::user()){

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }


        }

        $notify = $this->notify();

        $busInfo = $this->clientinfo();

        $postActive = Newshappening::where('state', '1')->orderBy('created_at', 'DESC')->take(2)->get();




        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Home page');
        return view('pages.index')->with(['pages' => 'Home', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'postActive' => $postActive, 'notify' => $notify]);
    }

    public function startup()
    {
        if(Auth::user()){

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }


        }

        // Get Client Info
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();

        $postActive = Newshappening::where('state', '1')->orderBy('created_at', 'DESC')->take(2)->get();

        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Welcome Page');
        return view('pages.startup')->with(['pages' => 'Welcome', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->generateRefcode()['ref_code'], 'getRefs' => $this->generateRefcode()['get_ref'], 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'postActive' => $postActive, 'notify' => $notify]);
    }



    public function claimbusiness()
    {
        if(Auth::user()){


            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }


        }

        // Get Client Info
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();

        $postActive = Newshappening::where('state', '1')->orderBy('created_at', 'DESC')->take(2)->get();
        $claims = $this->claimdata();


        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Welcome Page');
        return view('pages.claimbusiness')->with(['pages' => 'Claim Business For FREE', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'postActive' => $postActive, 'notify' => $notify, 'claims' => $claims]);
    }



    public function profileupdate(Request $req)
    {
        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }


        }

        // Get Client Info
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();

        $postActive = Newshappening::where('state', '1')->orderBy('created_at', 'DESC')->take(2)->get();
        $claims = $this->claimdata();
        $userDetails = User::where('station_name', $req->route('key'))->get();
        $station = Stations::where('station_name', $req->route('key'))->get();


        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Welcome Page');
        return view('pages.profileupdate')->with(['pages' => 'Update Profile Information', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'postActive' => $postActive, 'notify' => $notify, 'claims' => $claims, 'userDetails' => $userDetails, 'mystation' => $station]);
    }





    public function promo_1()
    {
        if(Auth::user()){
        

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }


        }
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();

        $postActive = Newshappening::where('state', '1')->orderBy('created_at', 'DESC')->take(2)->get();

        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Promo Page');
        return view('pages.promo1')->with(['pages' => 'Promo Page', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'postActive' => $postActive, 'notify' => $notify]);
    }

    public function promo_2()
    {
        if(Auth::user()){

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }


        }

        $notify = $this->notify();

        $busInfo = $this->clientinfo();

        $postActive = Newshappening::where('state', '1')->orderBy('created_at', 'DESC')->take(2)->get();

        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Promo Page');
        return view('pages.promo2')->with(['pages' => 'Welcome', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'postActive' => $postActive, 'notify' => $notify]);
    }


    public function checkbooking(Request $req)
    {
        if(Auth::user()){

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }


        }

                
        $notify = $this->notify();

        $busInfo = $this->clientinfo();

        $postActive = Newshappening::where('state', '1')->orderBy('created_at', 'DESC')->take(2)->get();

        $getmyAppointment = BookAppointment::where('ref_code', $req->route('key'))->get();

        // Get Client Minimum
        $statInfo = DB::table('book_appointment')
            ->join('users', 'book_appointment.station_name', '=', 'users.station_name')->where('book_appointment.station_name', $getmyAppointment[0]->station_name)
            ->get();

            if(count($statInfo) > 0){
                // Get Client Minimum
                $minimunRate = clientMinimum::where('busID', $statInfo[0]->busID)->get();

                if(count($minimunRate) > 0){
                    $myRate = $minimunRate[0]->percent;
                }
                else{
                    $minimunRate = MinimumDiscount::where('discount', 'discount')->get();

                    if(count($minimunRate) > 0){
                        $myRate = $minimunRate[0]->percent;
                    }
                    else{
                        $myRate = 0;
                    }
                }
            }
            else{
                // Get Admin Rate
                $minimunRate = MinimumDiscount::where('discount', 'discount')->get();

                if(count($minimunRate) > 0){
                    $myRate = $minimunRate[0]->percent;
                }
                else{
                    $myRate = 0;
                }
            }


        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited to Check Booking Details');
        return view('pages.checkbooking')->with(['pages' => 'Book Appointment Details', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'postActive' => $postActive, 'notify' => $notify, 'getmyAppointment' => $getmyAppointment, 'myRate' => $myRate]);
    }


    public function newsandhapenings(Request $req)
    {
        if(Auth::user()){

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }


        }

                
        $notify = $this->notify();

        $busInfo = $this->clientinfo();

        $postActive = Newshappening::where('state', '1')->orderBy('created_at', 'DESC')->paginate(5);




        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited News and Happenings Page');

        return view('pages.newsandhapenings')->with(['pages' => 'News and Happenings', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'postActive' => $postActive, 'notify' => $notify]);

    }



    public function notification(Request $req)
    {
        if(Auth::user()){

            Notification::where('ref_code', Auth::user()->ref_code)->update(['state' => 1, 'read_state' => 1]);
            // Update Notification
        
        $notificationz = Notification::where('ref_code', Auth::user()->ref_code)->orderBy('created_at', 'DESC')->get();



        

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }


        }


        $notify = $this->notify();

        $busInfo = $this->clientinfo();


        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited News and Happenings Page');

        return view('pages.notifications')->with(['pages' => 'My Notifications', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify, 'notificationz' => $notificationz]);

    }


    public function newshappeningspost(Request $req)
    {
        if(Auth::user()){

            // Get Client Info


        

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }


        }

                
        $notify = $this->notify();

        $busInfo = $this->clientinfo();

        $postActive = Newshappening::where('state', '1')->where('id', $req->route('id'))->orderBy('created_at', 'DESC')->paginate(5);




        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited News and Happenings Post');

        return view('pages.newshappeningspost')->with(['pages' => 'News and Happenings', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'postActive' => $postActive, 'notify' => $notify]);

    }


    public function smartdriver()
    {
        if(Auth::user()){



        

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }


        }

                    // Get Client Info
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();



        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Smart Driver page');
        return view('pages.smartdriver')->with(['pages' => 'Smart Drivers', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);
    }

    public function prices()
    {
        // dd($req->all());
        if(Auth::user()){

            $this->email = Auth::user()->email;

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
        else{

            $this->email = "";
        }
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();


        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Another Pricing Test');
        return view('pages.prices')->with(['pages' => 'Test Pricing', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'email' => $this->email, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);
    }

    public function about()
    {
        if(Auth::user()){



        

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }

                    // Get Client Info
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();



        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited About Us page');
        return view('pages.about')->with(['pages' => 'About us', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);
    }


    public function redeem()
    {
        if(Auth::user()){



        

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }


         // Get Client Info
        $notify = $this->notify();

        $busInfo = $this->clientinfo();


        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited To Redeem Points');
        return view('pages.redeem')->with(['pages' => 'Redeem Points', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);
    }

    public function features()
    {
        if(Auth::user()){

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }

        // Get Client Info
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();


        return view('pages.features')->with(['pages' => 'Features', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);
    }

    public function contact()
    {
        if(Auth::user()){

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }

            // Get Client Info
            
            $notify = $this->notify();

            $busInfo = $this->clientinfo();


        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Contact Us page');
        return view('pages.contact')->with(['pages' => 'Contact', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);
    }


    public function webForm(){

        if(Auth::user()){

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }

            // Get Client Info
            
            $notify = $this->notify();

            $busInfo = $this->clientinfo();


        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Contact Us page');
        return view('pages.webform')->with(['pages' => 'Contact Form', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }

    public function privacy()
    {
        if(Auth::user()){

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }

        // Get Client Info
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();


        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Privacy Policy page');
        return view('pages.privacy')->with(['pages' => 'Privacy', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);
    }


    public function autocares()
    {
        if(Auth::user()){

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }

        // Get Client Info
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();



        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Auto care center page');
        return view('pages.autocare')->with(['pages' => 'Auto care centers', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);
    }

    public function drivers()
    {
        if(Auth::user()){
        

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }

                
        $notify = $this->notify();

        $busInfo = $this->clientinfo();



        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Drivers page');
        return view('pages.drivers')->with(['pages' => 'Drivers', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);
    }


    public function businesses()
    {
        if(Auth::user()){


        

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();


        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Business page');
        return view('pages.businesses')->with(['pages' => 'Business', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);
    }

    public function signupfree()
    {
        if(Auth::user()){


        

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }

        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();


        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Business page');
        return view('pages.signupfree')->with(['pages' => 'Sign up free', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);
    }

    public function pricing(Request $req)
    {
        $continents = explode('/', $this->arr_ip['timezone']);
        if(Auth::user()){

            $this->email = Auth::user()->email;


            // Get All Available Payment Plans
            if($continents[0] == "Africa"){
                $this->continent = "Africa";
            }
            elseif($continents[0] == "Europe"){
                $this->continent = "Europe";
            }
            elseif($this->arr_ip['timezone'] == "America/Toronto"){
                $this->continent = "Canada";
            }
            elseif($continents[0] == "America" && $this->arr_ip['timezone'] == "Europe/London"){
                $this->continent = "Britain";
            }
            elseif($continents[0] == "America" && $this->arr_ip['timezone'] != "Europe/London"){
                $this->continent = "USA";
            }
            else{
                $this->continent = "Other";
            }


            $priceTags = PriceCurrency::where('country', $this->continent)->get();


            

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }

        }
        else{
            // if(){

            // }
            $this->email = "";
        }

                    // Get Client Info
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();


        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Plan & Pricing page');
        return view('pages.pricing')->with(['pages' => 'Plan & Pricing', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'email' => $this->email, 'continent' => $continents[0], 'error' => $this->error, 'countryPlan' => $this->continent, 'priceTag' => $priceTags, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);
    }

    public function terms()
    {
        if(Auth::user()){


        

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }

        $notify = $this->notify();

        $busInfo = $this->clientinfo();



        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Terms of Use page');
        return view('pages.terms')->with(['pages' => 'Terms', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);
    }


    public function askExpert(Request $req)
    {
        if(Auth::user()){


        



            // Check for All Feeds
            $askExpert = AskExpert::orderBy('created_at', 'DESC')->paginate(3);

            // if(count($this->askExpert) > 0){
            //     $this->askExpert = $this->askExpert;
            // }else{
            //     $this->askExpert = "";
            // }

            // Get all Points
            $this->points = Points::where('points.state', Auth::user()->state)->orderBy('weekly_point', 'DESC')
            ->get();

            if(count($this->points) > 0){
                $this->points = $this->points;
            }
            else{
                $this->points = "";
            }

            // Get all time
            $this->alltimepoints = Points::where('points.country', Auth::user()->country)->orderBy('alltime_point', 'DESC')
            ->get();

            if(count($this->alltimepoints) > 0){
                $this->alltimepoints = $this->alltimepoints;
            }
            else{
                $this->alltimepoints = "";
            }

            // dd($this->points);

            $this->relatedFeeds = AskExpert::where('email', '!=', Auth::user()->email)->inRandomOrder()->take(6)->get();

            if(count($this->relatedFeeds) > 0){
                $this->relatedFeeds= $this->relatedFeeds;
            }
            else{
                $this->relatedFeeds = "";
            }

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }


        }
        else{
            // Do Nothing
        }
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();


        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Ask an Expert page');
        return view('pages.askexperts')->with(['pages' => 'Ask Expert', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'askExpert' => $askExpert, 'points' => $this->points, 'alltimepoints' => $this->alltimepoints, 'relatedFeeds' => $this->relatedFeeds, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);
    }




    public function openticket(Request $req)
    {
        if(Auth::user()){

            // Check for All Feeds
            $askExpert = AskExpert::orderBy('created_at', 'DESC')->paginate(3);

            // if(count($this->askExpert) > 0){
            //     $this->askExpert = $this->askExpert;
            // }else{
            //     $this->askExpert = "";
            // }

            // Get all Points
            $this->points = Points::where('points.state', Auth::user()->state)->orderBy('weekly_point', 'DESC')
            ->get();

            if(count($this->points) > 0){
                $this->points = $this->points;
            }
            else{
                $this->points = "";
            }

            // Get all time
            $this->alltimepoints = Points::where('points.country', Auth::user()->country)->orderBy('alltime_point', 'DESC')
            ->get();

            if(count($this->alltimepoints) > 0){
                $this->alltimepoints = $this->alltimepoints;
            }
            else{
                $this->alltimepoints = "";
            }

            // dd($this->points);

            $this->relatedFeeds = AskExpert::where('email', '!=', Auth::user()->email)->inRandomOrder()->take(6)->get();

            if(count($this->relatedFeeds) > 0){
                $this->relatedFeeds= $this->relatedFeeds;
            }
            else{
                $this->relatedFeeds = "";
            }

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }


        }
        else{
            // Do Nothing
        }

                    // Get Client Info
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();



        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Open Ticket');
        return view('pages.openticket')->with(['pages' => 'Open Ticket', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'askExpert' => $askExpert, 'points' => $this->points, 'alltimepoints' => $this->alltimepoints, 'relatedFeeds' => $this->relatedFeeds, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);
    }


    public function opennewticket(Request $req)
    {
        if(Auth::user()){


        



            // Check for All Feeds
            $askExpert = AskExpert::orderBy('created_at', 'DESC')->paginate(3);

            // if(count($this->askExpert) > 0){
            //     $this->askExpert = $this->askExpert;
            // }else{
            //     $this->askExpert = "";
            // }

            // Get all Points
            $this->points = Points::where('points.state', Auth::user()->state)->orderBy('weekly_point', 'DESC')
            ->get();

            if(count($this->points) > 0){
                $this->points = $this->points;
            }
            else{
                $this->points = "";
            }

            // Get all time
            $this->alltimepoints = Points::where('points.country', Auth::user()->country)->orderBy('alltime_point', 'DESC')
            ->get();

            if(count($this->alltimepoints) > 0){
                $this->alltimepoints = $this->alltimepoints;
            }
            else{
                $this->alltimepoints = "";
            }

            // dd($this->points);

            $this->relatedFeeds = AskExpert::where('email', '!=', Auth::user()->email)->inRandomOrder()->take(6)->get();

            if(count($this->relatedFeeds) > 0){
                $this->relatedFeeds= $this->relatedFeeds;
            }
            else{
                $this->relatedFeeds = "";
            }

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }


        }
        else{
            // Do Nothing
        }

                    // Get Client Info
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();



        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Open Ticket');
        return view('pages.opennewticket')->with(['pages' => 'Open Ticket', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'askExpert' => $askExpert, 'points' => $this->points, 'alltimepoints' => $this->alltimepoints, 'relatedFeeds' => $this->relatedFeeds, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);
    }



    public function supportticket(Request $req)
    {
        if(Auth::user()){


        



            // Check for All Feeds
            $askExpert = AskExpert::orderBy('created_at', 'DESC')->paginate(3);

            // if(count($this->askExpert) > 0){
            //     $this->askExpert = $this->askExpert;
            // }else{
            //     $this->askExpert = "";
            // }

            // Get all Points
            $this->points = Points::where('points.state', Auth::user()->state)->orderBy('weekly_point', 'DESC')
            ->get();

            if(count($this->points) > 0){
                $this->points = $this->points;
            }
            else{
                $this->points = "";
            }

            // Get all time
            $this->alltimepoints = Points::where('points.country', Auth::user()->country)->orderBy('alltime_point', 'DESC')
            ->get();

            if(count($this->alltimepoints) > 0){
                $this->alltimepoints = $this->alltimepoints;
            }
            else{
                $this->alltimepoints = "";
            }

            // dd($this->points);

            $this->relatedFeeds = AskExpert::where('email', '!=', Auth::user()->email)->inRandomOrder()->take(6)->get();

            if(count($this->relatedFeeds) > 0){
                $this->relatedFeeds= $this->relatedFeeds;
            }
            else{
                $this->relatedFeeds = "";
            }

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }


        }
        else{
            // Do Nothing
        }

        $getSupportList = Ticketing::where('ticketEmail', Auth::user()->email)->get();

                    // Get Client Info
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();



        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Open Ticket');
        return view('pages.supportticket')->with(['pages' => 'My Support Ticket', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'askExpert' => $askExpert, 'points' => $this->points, 'alltimepoints' => $this->alltimepoints, 'relatedFeeds' => $this->relatedFeeds, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'getSupportList' => $getSupportList, 'notify' => $notify]);
    }


    public function allQuestions(Request $req)
    {

        

        if(Auth::user()){


        



            // Check for All Feeds
            $this->askExpert = AskExpert::orderBy('created_at', 'DESC')->get();

            if(count($this->askExpert) > 0){
                $this->askExpert = $this->askExpert;
            }else{
                $this->askExpert = "";
            }

            // Get all Points
            $this->points = Points::orderBy('weekly_point', 'DESC')
            ->get();

            if(count($this->points) > 0){
                $this->points = $this->points;
            }
            else{
                $this->points = "";
            }

            // Get all time
            $this->alltimepoints = Points::orderBy('alltime_point', 'DESC')
            ->get();

            if(count($this->alltimepoints) > 0){
                $this->alltimepoints = $this->alltimepoints;
            }
            else{
                $this->alltimepoints = "";
            }

            // dd($this->points);

            $this->relatedFeeds = AskExpert::where('email', '!=', Auth::user()->email)->inRandomOrder()->take(6)->get();

            if(count($this->relatedFeeds) > 0){
                $this->relatedFeeds= $this->relatedFeeds;
            }
            else{
                $this->relatedFeeds = "";
            }

            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::orderBy('created_at', 'DESC')->paginate(3);

            // if(count($getQuest) > 0){
            //     $this->askedQuest = $getQuest;
            // }
            // else{
            //     $this->askedQuest = "";
            // }


        }
        else{
            // Do Nothing
        }


                    // Get Client Info
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();


        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Ask an Expert page');
        return view('pages.allQuestions')->with(['pages' => 'All Questions', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'askExpert' => $this->askExpert, 'points' => $this->points, 'alltimepoints' => $this->alltimepoints, 'relatedFeeds' => $this->relatedFeeds, 'countQuest' => $this->countQuest, 'askedQuest' => $getQuest, 'notify' => $notify]);
    }

    public function answerPost(Request $req)
    {
        if(Auth::user()){


        

            // Get Answers
            $this->getAns = DB::table('ansfromexpert')
            ->join('askexpert', 'ansfromexpert.post_id', '=', 'askexpert.post_id')->where('askexpert.post_id', $req->route('key'))
            ->get();

            if(count($this->getAns) > 0){
                $this->getAns = $this->getAns;
            }
            else{
                $this->getAns = "";
            }


            // Check for All Feeds
            $this->askExpert = AskExpert::orderBy('created_at', 'DESC')->get();

            if(count($this->askExpert) > 0){
                $this->askExpert = $this->askExpert;
            }else{
                $this->askExpert = "";
            }

            // Get all Points
            $this->points = Points::orderBy('weekly_point', 'DESC')->take(5)
            ->get();

            if(count($this->points) > 0){
                $this->points = $this->points;
            }
            else{
                $this->points = "";
            }

            // Get all time
            $this->alltimepoints = Points::orderBy('alltime_point', 'DESC')->take(5)
            ->get();

            if(count($this->alltimepoints) > 0){
                $this->alltimepoints = $this->alltimepoints;
            }
            else{
                $this->alltimepoints = "";
            }

            // dd($this->points);

            $this->relatedFeeds = AskExpert::where('email', '!=', Auth::user()->email)->inRandomOrder()->take(6)->get();

            if(count($this->relatedFeeds) > 0){
                $this->relatedFeeds= $this->relatedFeeds;
            }
            else{
                $this->relatedFeeds = "";
            }


            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }

            // Check Answered Questions
            $answeredQuest = AnsFromExpert::where('post_id', $req->route('key'))->orderBy('created_at', 'DESC')->get();

            if(count($answeredQuest) > 0){
                $countAnswer = count($answeredQuest);
                $answerQuestions = $answeredQuest;
            }
            else{
                $countAnswer = 0;
                $answerQuestions = '';
            }

        }
        else{
            // Do Nothing
        }
                    // Get Client Info
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();


        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Ask an Expert page');
        return view('pages.answerPost')->with(['pages' => 'Answer to Post', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'askExpert' => $this->askExpert, 'points' => $this->points, 'alltimepoints' => $this->alltimepoints, 'relatedFeeds' => $this->relatedFeeds, 'getAns' => $this->getAns, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'urlID' => $req->route('key'), 'answerQuestions' => $answerQuestions, 'countAnswer' => $countAnswer, 'notify' => $notify]);
    }




    public function monitorecord(Request $req)
    {
        if(Auth::user()){


        

            // Get Answers
            $this->getAns = DB::table('ansfromexpert')
            ->join('askexpert', 'ansfromexpert.post_id', '=', 'askexpert.post_id')->where('askexpert.post_id', $req->route('key'))
            ->get();

            if(count($this->getAns) > 0){
                $this->getAns = $this->getAns;
            }
            else{
                $this->getAns = "";
            }


            // Check for All Feeds
            $this->askExpert = AskExpert::orderBy('created_at', 'DESC')->get();

            if(count($this->askExpert) > 0){
                $this->askExpert = $this->askExpert;
            }else{
                $this->askExpert = "";
            }

            // Get all Points
            $this->points = Points::orderBy('weekly_point', 'DESC')->take(5)
            ->get();

            if(count($this->points) > 0){
                $this->points = $this->points;
            }
            else{
                $this->points = "";
            }

            // Get all time
            $this->alltimepoints = Points::orderBy('alltime_point', 'DESC')->take(5)
            ->get();

            if(count($this->alltimepoints) > 0){
                $this->alltimepoints = $this->alltimepoints;
            }
            else{
                $this->alltimepoints = "";
            }

            // dd($this->points);

            $this->relatedFeeds = AskExpert::where('email', '!=', Auth::user()->email)->inRandomOrder()->take(6)->get();

            if(count($this->relatedFeeds) > 0){
                $this->relatedFeeds= $this->relatedFeeds;
            }
            else{
                $this->relatedFeeds = "";
            }


            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }

            // Check Answered Questions
            $answeredQuest = AnsFromExpert::where('post_id', $req->route('key'))->orderBy('created_at', 'DESC')->get();

            if(count($answeredQuest) > 0){
                $countAnswer = count($answeredQuest);
                $answerQuestions = $answeredQuest;
            }
            else{
                $countAnswer = 0;
                $answerQuestions = '';
            }

        }
        else{
            // Do Nothing
        }

            // Check What to View
            $_CheckViewEst = Estimate::where('vehicle_licence', $req->route('key'))->where('estimate', '1')->orderBy('created_at', 'DESC')->get();

            if(count($_CheckViewEst) > 0){
                $this->report = $_CheckViewEst;
            }
            else{
                $_CheckViewWO = Estimate::where('vehicle_licence', $req->route('key'))->where('work_order', '1')->orderBy('created_at', 'DESC')->get();

                if(count($_CheckViewWO) > 0){
                    $this->report = $_CheckViewWO;
                }
                else{
                    $_CheckViewMaint = Vehicleinfo::where('vehicle_licence', $req->route('key'))->orderBy('created_at', 'DESC')->get();
                    if(count($_CheckViewMaint) > 0){
                        $this->report = $_CheckViewMaint;
                    }
                    else{
                        $this->report = "";
                    }
                }
            }


                        // Get Client Info
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();

        return view('pages.monitormaintenance')->with(['pages' => 'Monitor Maintenance Record', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'askExpert' => $this->askExpert, 'points' => $this->points, 'alltimepoints' => $this->alltimepoints, 'relatedFeeds' => $this->relatedFeeds, 'getAns' => $this->getAns, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'urlID' => $req->route('key'), 'answerQuestions' => $answerQuestions, 'countAnswer' => $countAnswer, 'report' => $this->report, 'notify' => $notify]);
    }


    public function monitoruserecord(Request $req)
    {
        if(Auth::user()){


        

            // Get Answers
            $this->getAns = DB::table('ansfromexpert')
            ->join('askexpert', 'ansfromexpert.post_id', '=', 'askexpert.post_id')->where('askexpert.post_id', $req->route('key'))
            ->get();

            if(count($this->getAns) > 0){
                $this->getAns = $this->getAns;
            }
            else{
                $this->getAns = "";
            }


            // Check for All Feeds
            $this->askExpert = AskExpert::orderBy('created_at', 'DESC')->get();

            if(count($this->askExpert) > 0){
                $this->askExpert = $this->askExpert;
            }else{
                $this->askExpert = "";
            }

            // Get all Points
            $this->points = Points::orderBy('weekly_point', 'DESC')->take(5)
            ->get();

            if(count($this->points) > 0){
                $this->points = $this->points;
            }
            else{
                $this->points = "";
            }

            // Get all time
            $this->alltimepoints = Points::orderBy('alltime_point', 'DESC')->take(5)
            ->get();

            if(count($this->alltimepoints) > 0){
                $this->alltimepoints = $this->alltimepoints;
            }
            else{
                $this->alltimepoints = "";
            }

            // dd($this->points);

            $this->relatedFeeds = AskExpert::where('email', '!=', Auth::user()->email)->inRandomOrder()->take(6)->get();

            if(count($this->relatedFeeds) > 0){
                $this->relatedFeeds= $this->relatedFeeds;
            }
            else{
                $this->relatedFeeds = "";
            }


            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }

            // Check Answered Questions
            $answeredQuest = AnsFromExpert::where('post_id', $req->route('key'))->orderBy('created_at', 'DESC')->get();

            if(count($answeredQuest) > 0){
                $countAnswer = count($answeredQuest);
                $answerQuestions = $answeredQuest;
            }
            else{
                $countAnswer = 0;
                $answerQuestions = '';
            }

        }
        else{
            // Do Nothing
        }

            // Check What to View
            $_CheckuserRec = User::where('email', $req->route('key'))->orderBy('created_at', 'DESC')->get();

            if(count($_CheckuserRec) > 0){
                $this->report = $_CheckuserRec;
            }
            else{
                $this->report = "";
            }

                        // Get Client Info
        $notify = $this->notify();

        $busInfo = $this->clientinfo();

        return view('pages.monitoruser')->with(['pages' => 'Monitor User Record', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'askExpert' => $this->askExpert, 'points' => $this->points, 'alltimepoints' => $this->alltimepoints, 'relatedFeeds' => $this->relatedFeeds, 'getAns' => $this->getAns, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'urlID' => $req->route('key'), 'answerQuestions' => $answerQuestions, 'countAnswer' => $countAnswer, 'report' => $this->report, 'notify' => $notify]);
    }


    public function review(Request $req)
    {
        if(Auth::user()){


        

            // Get Answers
            $this->getAns = DB::table('ansfromexpert')
            ->join('askexpert', 'ansfromexpert.post_id', '=', 'askexpert.post_id')->where('askexpert.post_id', $req->route('key'))
            ->get();

            if(count($this->getAns) > 0){
                $this->getAns = $this->getAns;
            }
            else{
                $this->getAns = "";
            }


            // Check for All Feeds
            $this->askExpert = AskExpert::orderBy('created_at', 'DESC')->get();

            if(count($this->askExpert) > 0){
                $this->askExpert = $this->askExpert;
            }else{
                $this->askExpert = "";
            }

            // Get all Points
            $this->points = Points::orderBy('weekly_point', 'DESC')->take(5)
            ->get();

            if(count($this->points) > 0){
                $this->points = $this->points;
            }
            else{
                $this->points = "";
            }

            // Get all time
            $this->alltimepoints = Points::orderBy('alltime_point', 'DESC')->take(5)
            ->get();

            if(count($this->alltimepoints) > 0){
                $this->alltimepoints = $this->alltimepoints;
            }
            else{
                $this->alltimepoints = "";
            }

            // dd($this->points);

            $this->relatedFeeds = AskExpert::where('email', '!=', Auth::user()->email)->inRandomOrder()->take(6)->get();

            if(count($this->relatedFeeds) > 0){
                $this->relatedFeeds= $this->relatedFeeds;
            }
            else{
                $this->relatedFeeds = "";
            }


            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }

            // Check Answered Questions
            $answeredQuest = AnsFromExpert::where('post_id', $req->route('key'))->orderBy('created_at', 'DESC')->get();

            if(count($answeredQuest) > 0){
                $countAnswer = count($answeredQuest);
                $answerQuestions = $answeredQuest;
            }
            else{
                $countAnswer = 0;
                $answerQuestions = '';
            }

        }
        else{
            // Do Nothing
        }

            // Check What to View
            $_CheckuserRec = User::where('email', $req->route('key'))->orderBy('created_at', 'DESC')->get();

            if(count($_CheckuserRec) > 0){
                $this->report = $_CheckuserRec;
            }
            else{
                $this->report = "";
            }

            $getEstPage = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)->where('estimate.opportunity_id', $req->route('key'))
                        ->orderBy('estimate.created_at', 'DESC')->get();

                $technician_info = User::where('email', $getEstPage[0]->technician)->get();

            // dd($technician_name);

                        // Get Client Info
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();

        return view('pages.review')->with(['pages' => 'Review', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'askExpert' => $this->askExpert, 'points' => $this->points, 'alltimepoints' => $this->alltimepoints, 'relatedFeeds' => $this->relatedFeeds, 'getAns' => $this->getAns, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'urlID' => $req->route('key'), 'answerQuestions' => $answerQuestions, 'countAnswer' => $countAnswer, 'report' => $this->report, 'getEstPage' => $getEstPage, 'technician_info' => $technician_info, 'notify' => $notify]);
    }


    public function ranking(Request $req)
    {
        if(Auth::user()){


        


            // Get Points by States

            $this->points = DB::table('points')
            ->join('users', 'points.email', '=', 'users.email')->where('points.state', Auth::user()->state)->orderBy('points.weekly_point', 'DESC')
            ->get();

            // dd($this->points);
            if(count($this->points) > 0){
                // Get Auth ID

                $this->points = $this->points;

            }
            else{
                $this->points = "";
            }


            // Get all time for Countries

            $this->alltimepoints = DB::table('points')
            ->join('users', 'points.email', '=', 'users.email')->where('points.country', Auth::user()->country)->orderBy('points.alltime_point', 'DESC')
            ->get();

            if(count($this->alltimepoints) > 0){
                $this->alltimepoints = $this->alltimepoints;
            }
            else{
                $this->alltimepoints = "";
            }


            // Get All Points Globally
            $this->globalpoints = DB::table('points')
            ->join('users', 'points.email', '=', 'users.email')->orderBy('global_point', 'DESC')
            ->get();

            if(count($this->globalpoints) > 0){
                $this->globalpoints = $this->globalpoints;
            }
            else{
                $this->globalpoints = "";
            }

            // dd($this->points);

            $this->mypoints = Points::where('email', Auth::user()->email)->get();

            if(count($this->mypoints) > 0){
                $this->mypoints= $this->mypoints;
            }
            else{
                $this->mypoints = "";
            }

                        // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }


        }
        else{
            // Do Nothing
        }

                    // Get Client Info
        
        $notify = $this->notify();

        $busInfo = $this->clientinfo();


        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Ask an Expert page');
        return view('pages.ranking')->with(['pages' => 'My Ranking', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'points' => $this->points, 'alltimepoints' => $this->alltimepoints, 'globalpoints' => $this->globalpoints, 'mypoints' => $this->mypoints, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);
    }


    public function resetspassword(){


        // dd($req->route('key'));
        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Forgot Password Page');

        return view('pages.resetspassword')->with(['pages' => 'Forgot Password']);
    }

    public function resetpassword(Request $req){

        $getUseremail = PasswordReset::where('token', $req->route('key'))->get();

        if(count($getUseremail) > 0){
            $this->email = $getUseremail[0]->email;
        }
        else{
            $this->email = '';
        }
        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited Forgot Password Redirect Page');

        return view('pages.resetpassword')->with(['pages' => 'Password Security Questions', 'email' => $this->email]);
    }


    

    public function userDashboard(Request $req)
    {


        // Redirect
        if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Business" || Auth::user()->userType == "Commercial" || Auth::user()->userType == "Auto Dealer"){

            // Redirect to SOAR
            // dd($getUser);
            header('Location: https://soar.vimfile.com/login');
            exit;
        }

        // elseif(Auth::user()->userType == "Auto Care"){
        //     // REDIRECT TO BW
        //     // header('Location: https://busywrench.vimfile.com/login');
        //     // exit;
        //     header('Location: https://busywrench.vimfile.com/login');
        //     exit;
        // }

        if(Auth::user()->status == 0 || Auth::user()->status == 2){
            return redirect('login')->with('status', 'Account Deactivated');
        }

        if(Auth::user()){
             // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();


            $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', Auth::user()->busID)->get();
            $servicecharge = MinimumDiscount::where('discount', 'service')->get();

            if(count($discountcharge) > 0){
                $this->discount = $discountcharge[0]->percent;
                $servicePercent = $servicecharge[0]->percent;
            }
            else{
                // Get Admin Discount
                $getDiscount = MinimumDiscount::where('discount', 'discount')->get();

                $this->discount = $getDiscount[0]->percent;
                $servicePercent = $servicecharge[0]->percent;
            }

        // dd($service_charges);

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }

        // Get users and update carrecord telephone
        $getuserInfo = User::where('email', Auth::user()->email)->get();

        if(count($getuserInfo) > 0){
            // Get Carrecord
            $getcarrecInfo = Carrecord::where('email', $getuserInfo[0]->email)->get();
            if(count($getcarrecInfo) > 0){
                // Update Telephone
                Carrecord::where('email', $getuserInfo[0]->email)->update(['telephone' => $getuserInfo[0]->phone_number]);
            }
            else{
                Carrecord::where('email', $getuserInfo[0]->email)->update(['telephone' => ""]);
            }
        }

        

    if(Auth::user()->userType == 'Individual' || Auth::user()->userType == 'Commercial' || Auth::user()->userType == 'Certified Professional'){
// Check Important Service Types
        $oil = vehicleInfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%Oil change%')->orderBy('created_at', 'DESC')->get();

        if(count($oil) > 0){
            $this->oilChange = $oil;
        }else{
            $this->oilChange = '';
        }

        $tyre = vehicleInfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%Wheel balancing%')->orderBy('created_at', 'DESC')->take(1)->get();

        if(count($tyre) > 0){
            $this->tyreRotation = $tyre;
        }else{
            $this->tyreRotation = '';
        }

        // dd($this->tyreRotation);

        $air = vehicleInfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%Air Filter%')->orderBy('created_at', 'DESC')->take(1)->get();

        if(count($air) > 0){
            $this->airFilter = $air;
        }else{
            $this->airFilter = '';
        }

        $inspection = vehicleInfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%Inspection%')->orderBy('created_at', 'DESC')->take(1)->get();

        if(count($inspection) > 0){
            $this->inspection = $inspection;
        }else{
            $this->inspection = '';
        }

        $registration = vehicleInfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%Registration%')->orderBy('created_at', 'DESC')->take(1)->get();

        if(count($registration) > 0){
            $this->registration = $registration;
        }else{
            $this->registration = '';
        }




        $previous = Vehicleinfo::where('email', Auth::user()->email)->max('mileage');


        // get next user mileage
        $next = Vehicleinfo::where('email', Auth::user()->email)->min('mileage');

        $tot = $previous - $next;

        $this->totMiles = $tot;

            // Tot Maint cost
            $this->totMaint = Vehicleinfo::where('email', Auth::user()->email)->sum('total_cost');


            // Start Tag Auth::user()->userType == "Commercial"
            if(Auth::user()->userType == "Commercial"){

                // Goes for Commercial Revenue
                $revReport = RevenueReport::where('email', Auth::user()->email)->orderBy('created_at', 'DESC')->take(1)->get();



                if(count($revReport) > 0){
                    $this->post = $revReport;
                }
                else{
                    $this->post  = "";
                }

                $getRec = Vehicleinfo::where('email', Auth::user()->email)->get('vehicle_licence');

            if(count($getRec) > 0){
                // Get Records for Add more fields
                $addedField = CommercialRec::where('vehicle_licence', $getRec[0]->vehicle_licence)->orderBy('created_at', 'DESC')->get();



                if(count($addedField) > 0){
                    $this->addedRec = $addedField;
                }
                else{
                    $this->addedRec = "";
                }


                foreach ($addedField as $key) {
                    $newRecs = $this->moreRecords(Auth::user()->email, $key->service_type);

                    if(count($newRecs) > 0){
                        $this->new_rec = $newRecs;
                    }
                    else{
                        $this->new_rec = "";
                    }

                // dd($this->new_rec);

                }


            }

            // Get Post Earning and Mileage Made by Commercial Users
            $getEarns = PostEarns::where('email', Auth::user()->email)->orderBy('created_at', 'DESC')->get();

            if(count($getEarns) > 0){
                $this->getEarn = $getEarns;
            }
            else{
                $this->getEarn = "";
            }
            // Get Expences to report as to commercial users
            $this->totEarnings = PostEarns::where('email', Auth::user()->email)->sum('post_earnings');




            $this->earnStart = PostEarns::where('email', Auth::user()->email)->orderBy('created_at', 'ASC')->take(1)->get('start_date');
            if(count($this->earnStart) > 0){
                $this->earnStart = $this->earnStart;
            }
            else{
                $this->earnStart = "";
            }
            $this->earnEnd = PostEarns::where('email', Auth::user()->email)->orderBy('created_at', 'DESC')->take(1)->get('end_date');

            if(count($this->earnEnd) > 0){
                $this->earnEnd = $this->earnEnd;
            }
            else{
                $this->earnEnd = "";
            }

            $this->inspect = $this->vehicleinfoSum('inspection');

            $this->regs = $this->vehicleinfoSum('registration');

            $this->fuelExp = $this->vehicleinfoSum('fuel');

            $this->insuranceExp = $this->vehicleinfoSum('insurance');

            $this->regExp = $this->vehicleinfoSum('business taxes');

            $this->repairExpence = $this->vehicleinfoSum('air conditioning recharge');

            $this->airFilters = $this->vehicleinfoSum('air filter');

            $this->batterys = $this->vehicleinfoSum('battery');

            $this->brakefluids = $this->vehicleinfoSum('brake fluid flush');

            $this->brakepads = $this->vehicleinfoSum('brake pads');

            $this->brakerotors = $this->vehicleinfoSum('brake rotors');

            $this->coolantwash = $this->vehicleinfoSum('coolant wash');

            $this->washExpence = $this->vehicleinfoSum('wash');

            $this->distcap = $this->vehicleinfoSum('distributor cap & rotor');

            $this->fuelfilters = $this->vehicleinfoSum('fuel filter');

            $this->headlights = $this->vehicleinfoSum('headlight');

            $this->oilchanges = $this->vehicleinfoSum('oil change');

            $this->powersteers = $this->vehicleinfoSum('power steering flush');

            $this->sparkplugs = $this->vehicleinfoSum('spark plugs');

            $this->timingbelts = $this->vehicleinfoSum('timing belt');

            $this->tirenews = $this->vehicleinfoSum('tire - new');

            $this->tirebalancings = $this->vehicleinfoSum('tire balancing');

            $this->tireinflations = $this->vehicleinfoSum('tire inflation');

            $this->tirerotations = $this->vehicleinfoSum('tire rotation');

            $this->wheelrotations = $this->vehicleinfoSum('Wheel Rotation & Tire Balancing');

            $this->transfluidflushs = $this->vehicleinfoSum('transmission fluid flush');

            $this->wheelalignments = $this->vehicleinfoSum('wheel alignment');

            $this->wiperblades = $this->vehicleinfoSum('wiper blades');

            $this->cabinairs = $this->vehicleinfoSum('cabin air filter');

            $this->smogchecks = $this->vehicleinfoSum('smog check');

            $this->alternators = $this->vehicleinfoSum('alternator');

            $this->belts = $this->vehicleinfoSum('belt');

            $this->bodyworks = $this->vehicleinfoSum('body work');

            $this->brakecalipers = $this->vehicleinfoSum('brake caliper');

            $this->carburetors = $this->vehicleinfoSum('carburetor');

            $this->catalytics = $this->vehicleinfoSum('catalytic converter');

            $this->clutchs = $this->vehicleinfoSum('clutch');

            $this->controlarms = $this->vehicleinfoSum('control arm');

            $this->coolanttemps = $this->vehicleinfoSum('coolant temperature sensor');

            $this->exhausts = $this->vehicleinfoSum('exhaust');

            $this->fuelinjections = $this->vehicleinfoSum('fuel injection');

            $this->fueltanks = $this->vehicleinfoSum('fuel tank');

            $this->headgaskets = $this->vehicleinfoSum('head gasket');

            $this->heatercores = $this->vehicleinfoSum('heater core');

            $this->hoses = $this->vehicleinfoSum('hose');

            $this->lines = $this->vehicleinfoSum('line');

            $this->massairs = $this->vehicleinfoSum('mass air flow sensor');

            $this->mufflers = $this->vehicleinfoSum('muffler');

            $this->oxygensensors = $this->vehicleinfoSum('oxygen sensor');

            $this->radiators = $this->vehicleinfoSum('radiator');

            $this->shocks = $this->vehicleinfoSum('shock/strut');

            $this->starters = $this->vehicleinfoSum('starter');

            $this->thermostats = $this->vehicleinfoSum('thermostat');

            $this->tierods = $this->vehicleinfoSum('tie rod');

            $this->transmissions = $this->vehicleinfoSum('transmission');

            $this->waterpumps = $this->vehicleinfoSum('water pump');

            $this->wheelbearings = $this->vehicleinfoSum('wheel bearings');

            $this->windows = $this->vehicleinfoSum('window');

            $this->windshields = $this->vehicleinfoSum('windshield');

            $this->sensors = $this->vehicleinfoSum('sensor');

            $this->others = $this->vehicleinfoSum('other');

            $this->roadasstExpence = $this->vehicleinfoSum('road side assistance');


            // Prorated Expenses
            /*
                Get (current mileage used / mileage on reg) * amount spent on service
            */

                // General Mileage on reg
                $mainMileage = Carrecord::where('email', Auth::user()->email)->get('current_mileage');
                if(count($mainMileage) > 0){
                    $mainMile = $mainMileage[0]->current_mileage;
                }
                else{
                    $mainMile = "";
                }



                $getVat = PostEarns::where('email', Auth::user()->email)->get('applicable_tax');

                if(count($getVat) > 0 && $getVat[0]->applicable_tax != NULL || count($getVat) > 0 && $getVat[0]->applicable_tax != ""){
                    $vat = $getVat[0]->applicable_tax / (100 + $getVat[0]->applicable_tax);

                    $this->totTaxing = $this->totEarnings * $vat;
                }
                else{
                    $vat = 0;
                    $this->totTaxing = $this->totEarnings * $vat;
                }

                if($mainMile != NULL || $mainMile != ""){

                    $currInspMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%inspection%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currInspMile) > 0){
                        $inspMile = $currInspMile[0]->mileage;

                    // Calc Inspection Prorated
                        if($this->totMiles != 0){
                            $this->resInsp = $this->getEarn[0]->post_mileage/$this->totMiles * $this->inspect;
                        }else{
                            $this->resInsp = 0;
                        }


                    $this->inspITC = $this->resInsp * $vat;
                    }
                    else{
                       $this->resInsp = 0;
                       $this->inspITC = $this->resInsp * $vat;
                    }

                    $currregsMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%registration%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currregsMile) > 0){
                        $respMile = $currregsMile[0]->mileage;

                    // Calc Registration Prorated
                        if($this->totMiles != 0){
                            $this->resRegs = $this->getEarn[0]->post_mileage/$this->totMiles * $this->regs;
                        }else{
                            $this->resRegs = 0;
                        }


                        $this->regsITC = 0;
                    }
                    else{
                       $this->resRegs = 0;
                       $this->regsITC = 0;
                    }

                    $currfuelMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%fuel%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currfuelMile) > 0){
                        $fuelMile = $currfuelMile[0]->mileage;

                    // Calc Fuel Prorated
                        if($this->totMiles != 0){
                            $this->resFuel = $this->getEarn[0]->post_mileage/$this->totMiles * $this->fuelExp;
                        }else{
                            $this->resFuel = 0;
                        }


                    $this->fuelITC = $this->resFuel * $vat;
                    }
                    else{
                       $this->resFuel = 0;
                       $this->fuelITC = $this->resFuel * $vat;
                    }

                    $currinsMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%insurance%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');

                    if(count($currinsMile) > 0){
                        $insMile = $currinsMile[0]->mileage;

                        // Calc inspection Prorated
                        if($this->totMiles != 0){
                            $this->resIns = $this->getEarn[0]->post_mileage/$this->totMiles * $this->insuranceExp;
                        }else{
                            $this->resIns = 0;
                        }


                        $this->insITC = 0;
                    }
                    else{
                        $this->resIns = 0;
                        $this->insITC = 0;
                    }

                    $currregMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%business taxes%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');

                    if(count($currregMile) > 0){
                       $regMile = $currregMile[0]->mileage;

                        // Calc inspection Prorated
                       if($this->totMiles != 0){
                            $this->resReg = $this->getEarn[0]->post_mileage/$this->totMiles * $this->regExp;
                       }else{
                            $this->resReg = 0;
                       }


                        $this->regITC = 0;

                    }
                    else{
                        $this->resReg = 0;
                        $this->regITC = 0;
                    }

                    $currrepairMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%air conditioning recharge%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');

                    if(count($currrepairMile) > 0){
                       $repairMile = $currrepairMile[0]->mileage;

                        // Calc inspection Prorated
                       if($this->totMiles != 0){
                            $this->resRepair = $this->getEarn[0]->post_mileage/$this->totMiles * $this->repairExpence;
                       }else{
                        $this->resRepair = 0;
                       }


                        $this->repITC = $this->resRepair * $vat;
                    }
                    else{
                        $this->resRepair = 0;
                        $this->repITC = $this->resRepair * $vat;
                    }

                    $currwashMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%wash%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');

                    if(count($currwashMile) > 0){
                        $washMile = $currwashMile[0]->mileage;
                        // Calc inspection Prorated
                        $this->resWash = $this->getEarn[0]->post_mileage/$this->totMiles * $this->washExpence;

                        $this->washITC = $this->resWash * $vat;
                    }
                    else{
                        $this->resWash = 0;
                        $this->washITC = $this->resWash * $vat;
                    }


                    $currrsaMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%road side assistance%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');

                    if(count($currrsaMile) > 0){
                        $rsaMile = $currrsaMile[0]->mileage;
                        // Calc inspection Prorated
                        if($this->totMiles != 0){
                            $this->resRsa = $this->getEarn[0]->post_mileage/$this->totMiles * $this->roadasstExpence;
                        }else{
                            $this->resRsa = 0;
                        }


                        $this->rsaITC = $this->resRsa * $vat;
                    }
                    else{
                        $this->resRsa = 0;
                        $this->rsaITC = $this->resRsa * $vat;
                    }

                    $currairFilterMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%air filter%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currairFilterMile) > 0){
                        $airFilterMile = $currairFilterMile[0]->mileage;

                    // Calc Air Filter Prorated
                        if($this->totMiles != 0){
                            $this->resairFilter = $this->getEarn[0]->post_mileage/$this->totMiles * $this->airFilters;
                        }else{
                            $this->resairFilter = 0;
                        }


                    $this->airfilterITC = $this->resairFilter * $vat;
                    }
                    else{
                       $this->resairFilter = 0;
                       $this->airfilterITC = $this->resairFilter * $vat;
                    }

                    $currbatteryMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%battery%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currbatteryMile) > 0){
                        $batteryMile = $currbatteryMile[0]->mileage;

                    // Calc Air Filter Prorated
                        if($this->totMiles != 0){
                            $this->resBattery = $this->getEarn[0]->post_mileage/$this->totMiles * $this->batterys;
                        }else{
                            $this->resBattery = 0;
                        }


                    $this->batteryITC = $this->resBattery * $vat;
                    }
                    else{
                       $this->resBattery = 0;
                       $this->batteryITC = $this->resBattery * $vat;
                    }

                    $currbrakefluidMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%brake fluid flush%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currbrakefluidMile) > 0){
                        $brakefluidMile = $currbrakefluidMile[0]->mileage;

                    // Calc Brake Fluid Prorated
                        if($this->totMiles != 0){
                            $this->resBrakefluid = $this->getEarn[0]->post_mileage/$this->totMiles * $this->brakefluids;
                        }else{
                            $this->resBrakefluid = 0;
                        }


                    $this->brakefluidITC = $this->resBrakefluid * $vat;
                    }
                    else{
                       $this->resBrakefluid = 0;
                       $this->brakefluidITC = $this->resBrakefluid * $vat;
                    }

                    $currbrakepadMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%brake pads%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currbrakepadMile) > 0){
                        $brakepadMile = $currbrakepadMile[0]->mileage;

                    // Calc Brake pad Prorated
                        if($this->totMiles != 0){
                            $this->resBrakepad = $this->getEarn[0]->post_mileage/$this->totMiles * $this->brakepads;
                        }else{
                            $this->resBrakepad = 0;
                        }


                    $this->brakepadITC = $this->resBrakepad * $vat;
                    }
                    else{
                       $this->resBrakepad = 0;
                       $this->brakepadITC = $this->resBrakepad * $vat;
                    }

                    $currbrakerotorMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%brake rotors%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currbrakerotorMile) > 0){
                        $brakerotorMile = $currbrakerotorMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resBrakerotor = $this->getEarn[0]->post_mileage/$this->totMiles * $this->brakerotors;
                        }else{
                            $this->resBrakerotor = 0;
                        }


                    $this->brakerotorITC = $this->resBrakerotor * $vat;
                    }
                    else{
                       $this->resBrakerotor = 0;
                       $this->brakerotorITC = $this->resBrakerotor * $vat;
                    }

                    $currcoolantMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%coolant flush%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currcoolantMile) > 0){
                        $coolantMile = $currcoolantMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resCoolantwash = $this->getEarn[0]->post_mileage/$this->totMiles * $this->coolantwash;
                        }else{
                            $this->resCoolantwash = 0;
                        }


                    $this->coolantwashITC = $this->resCoolantwash * $vat;
                    }
                    else{
                       $this->resCoolantwash = 0;
                       $this->coolantwashITC = $this->resCoolantwash * $vat;
                    }

                    $currdistCapMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%distributor cap & rotor%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currdistCapMile) > 0){
                        $distCapMile = $currdistCapMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resDistcap = $this->getEarn[0]->post_mileage/$this->totMiles * $this->distcap;
                        }else{
                            $this->resDistcap = 0;
                        }


                    $this->distcapITC = $this->resDistcap * $vat;
                    }
                    else{
                       $this->resDistcap = 0;
                       $this->distcapITC = $this->resDistcap * $vat;
                    }

                    $currfuelFilterMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%fuel filter%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currfuelFilterMile) > 0){
                        $fuelFilterMile = $currfuelFilterMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resFuelfilter= $this->getEarn[0]->post_mileage/$this->totMiles * $this->fuelfilters;
                        }else{
                            $this->resFuelfilter = 0;
                        }


                        $this->fuelfilterITC = $this->resFuelfilter * $vat;
                    }
                    else{
                       $this->resFuelfilter = 0;
                       $this->fuelfilterITC = $this->resFuelfilter * $vat;
                    }

                    $currheadlightMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%headlight%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currheadlightMile) > 0){
                        $headlightMile = $currheadlightMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resHeadlight= $this->getEarn[0]->post_mileage/$this->totMiles * $this->headlights;
                        }else{
                            $this->resHeadlight = 0;
                        }


                        $this->headlightITC = $this->resHeadlight * $vat;
                    }
                    else{
                       $this->resHeadlight = 0;
                       $this->headlightITC = $this->resHeadlight * $vat;
                    }

                    $curroilchangeMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%oil change%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($curroilchangeMile) > 0){
                        $oilchangeMile = $curroilchangeMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resoilchange= $this->getEarn[0]->post_mileage/$this->totMiles * $this->oilchanges;
                        }else{
                            $this->resoilchange = 0;
                        }


                        $this->oilchangeITC = $this->resoilchange * $vat;
                    }
                    else{
                       $this->resoilchange = 0;
                       $this->oilchangeITC = $this->resoilchange * $vat;
                    }

                    $currpowersteerMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%power steering flush%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currpowersteerMile) > 0){
                        $powersteerMile = $currpowersteerMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->respowersteer= $this->getEarn[0]->post_mileage/$this->totMiles * $this->powersteers;
                        }else{
                            $this->respowersteer = 0;
                        }


                        $this->powersteerITC = $this->respowersteer * $vat;
                    }
                    else{
                       $this->respowersteer = 0;
                       $this->powersteerITC = $this->respowersteer * $vat;
                    }

                    $currsparkplugMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%spark plugs%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currsparkplugMile) > 0){
                        $sparkplugMile = $currsparkplugMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->ressparkplug= $this->getEarn[0]->post_mileage/$this->totMiles * $this->sparkplugs;
                        }else{
                            $this->ressparkplug = 0;
                        }


                        $this->sparkplugITC = $this->ressparkplug * $vat;
                    }
                    else{
                       $this->ressparkplug = 0;
                       $this->sparkplugITC = $this->ressparkplug * $vat;
                    }

                    $currtimingbeltMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%timing belt%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currtimingbeltMile) > 0){
                        $timingbeltMile = $currtimingbeltMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->restimingbelt= $this->getEarn[0]->post_mileage/$this->totMiles * $this->timingbelts;
                        }else{
                            $this->restimingbelt = 0;
                        }


                        $this->timingbeltITC = $this->restimingbelt * $vat;
                    }
                    else{
                       $this->restimingbelt = 0;
                       $this->timingbeltITC = $this->restimingbelt * $vat;
                    }

                    $currtirenewMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%tire - new%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currtirenewMile) > 0){
                        $tirenewMile = $currtirenewMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->restirenew= $this->getEarn[0]->post_mileage/$this->totMiles * $this->tirenews;
                        }else{
                            $this->restirenew = 0;
                        }


                        $this->tirenewITC = $this->restirenew * $vat;
                    }
                    else{
                       $this->restirenew = 0;
                       $this->tirenewITC = $this->restirenew * $vat;
                    }

                    $currtirebalancingMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%tire balancing%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currtirebalancingMile) > 0){
                        $tirebalancingMile = $currtirebalancingMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->restirebalancing= $this->getEarn[0]->post_mileage/$this->totMiles * $this->tirebalancings;
                        }else{
                            $this->restirebalancing = 0;
                        }


                        $this->tirebalancingITC = $this->restirebalancing * $vat;
                    }
                    else{
                       $this->restirebalancing = 0;
                       $this->tirebalancingITC = $this->restirebalancing * $vat;
                    }

                    $currtireinflationMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%tire inflation%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currtireinflationMile) > 0){
                        $tireinflationMile = $currtireinflationMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->restireinflation= $this->getEarn[0]->post_mileage/$this->totMiles * $this->tireinflations;
                        }else{
                            $this->restireinflation = 0;
                        }


                        $this->tireinflationITC = $this->restireinflation * $vat;
                    }
                    else{
                       $this->restireinflation = 0;
                       $this->tireinflationITC = $this->restireinflation * $vat;
                    }

                    $currtirerotationMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%tire inflation%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currtirerotationMile) > 0){
                        $tirerotationMile = $currtirerotationMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->restirerotation= $this->getEarn[0]->post_mileage/$this->totMiles * $this->tirerotations;
                        }else{
                            $this->restirerotation = 0;
                        }


                        $this->tirerotationITC = $this->restirerotation * $vat;
                    }
                    else{
                       $this->restirerotation = 0;
                       $this->tirerotationITC = $this->restirerotation * $vat;
                    }

                    $currwheelrotationMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%Wheel Rotation & Tire Balancing%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currwheelrotationMile) > 0){
                        $wheelrotationMile = $currwheelrotationMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->reswheelrotation= $this->getEarn[0]->post_mileage/$this->totMiles * $this->wheelrotations;
                        }else{
                            $this->reswheelrotation = 0;
                        }


                        $this->wheelrotationITC = $this->reswheelrotation * $vat;
                    }
                    else{
                       $this->reswheelrotation = 0;
                       $this->wheelrotationITC = $this->reswheelrotation * $vat;
                    }

                    $currtransfluidflushMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%Wheel Rotation & Tire Balancing%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currtransfluidflushMile) > 0){
                        $transfluidflushMile = $currtransfluidflushMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->restransfluidflush= $this->getEarn[0]->post_mileage/$this->totMiles * $this->transfluidflushs;
                        }else{
                            $this->restransfluidflush = 0;
                        }


                        $this->transfluidflushITC = $this->restransfluidflush * $vat;
                    }
                    else{
                       $this->restransfluidflush = 0;
                       $this->transfluidflushITC = $this->restransfluidflush * $vat;
                    }

                    $currwheelalignmentMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%wheel alignment%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currwheelalignmentMile) > 0){
                        $wheelalignmentMile = $currwheelalignmentMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->reswheelalignment= $this->getEarn[0]->post_mileage/$this->totMiles * $this->wheelalignments;
                        }else{
                            $this->reswheelalignment = 0;
                        }


                        $this->wheelalignmentITC = $this->reswheelalignment * $vat;
                    }
                    else{
                       $this->reswheelalignment = 0;
                       $this->wheelalignmentITC = $this->reswheelalignment * $vat;
                    }

                    $currwiperbladeMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%wiper blades%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currwiperbladeMile) > 0){
                        $wiperbladeMile = $currwiperbladeMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->reswiperblade= $this->getEarn[0]->post_mileage/$this->totMiles * $this->wiperblades;
                        }else{
                            $this->reswiperblade = 0;
                        }


                        $this->wiperbladeITC = $this->reswiperblade * $vat;
                    }
                    else{
                       $this->reswiperblade = 0;
                       $this->wiperbladeITC = $this->reswiperblade * $vat;
                    }

                    $currcabinairMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%cabin air filter%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currcabinairMile) > 0){
                        $cabinairMile = $currcabinairMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->rescabinair= $this->getEarn[0]->post_mileage/$this->totMiles * $this->cabinairs;
                        }else{
                            $this->rescabinair = 0;
                        }


                        $this->cabinairITC = $this->rescabinair * $vat;
                    }
                    else{
                       $this->rescabinair = 0;
                       $this->cabinairITC = $this->rescabinair * $vat;
                    }

                    $currsmogcheckMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%smog check%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currsmogcheckMile) > 0){
                        $smogcheckMile = $currsmogcheckMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->ressmogcheck= $this->getEarn[0]->post_mileage/$this->totMiles * $this->smogchecks;
                        }else{
                            $this->ressmogcheck = 0;
                        }


                        $this->smogcheckITC = $this->ressmogcheck * $vat;
                    }
                    else{
                       $this->ressmogcheck = 0;
                       $this->smogcheckITC = $this->ressmogcheck * $vat;
                    }

                    $curralternatorMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%alternator%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($curralternatorMile) > 0){
                        $alternatorMile = $curralternatorMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resalternator= $this->getEarn[0]->post_mileage/$this->totMiles * $this->alternators;
                        }else{
                            $this->resalternator = 0;
                        }


                        $this->alternatorITC = $this->resalternator * $vat;
                    }
                    else{
                       $this->resalternator = 0;
                       $this->alternatorITC = $this->resalternator * $vat;
                    }


                    $currbeltMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%belt%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currbeltMile) > 0){
                        $beltMile = $currbeltMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resbelt= $this->getEarn[0]->post_mileage/$this->totMiles * $this->belts;
                        }else{
                            $this->resbelt = 0;
                        }


                        $this->beltITC = $this->resbelt * $vat;
                    }
                    else{
                       $this->resbelt = 0;
                       $this->beltITC = $this->resbelt * $vat;
                    }

                    $currbodyworkMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%body work%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currbodyworkMile) > 0){
                        $bodyworkMile = $currbodyworkMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resbodywork= $this->getEarn[0]->post_mileage/$this->totMiles * $this->bodyworks;
                        }else{
                            $this->resbodywork = 0;
                        }


                        $this->bodyworkITC = $this->resbodywork * $vat;
                    }
                    else{
                       $this->resbodywork = 0;
                       $this->bodyworkITC = $this->resbodywork * $vat;
                    }

                    $currbrakecaliperMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%brake caliper%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currbrakecaliperMile) > 0){
                        $brakecaliperMile = $currbrakecaliperMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resbrakecaliper= $this->getEarn[0]->post_mileage/$this->totMiles * $this->brakecalipers;
                        }else{
                            $this->resbrakecaliper = 0;
                        }


                        $this->brakecaliperITC = $this->resbrakecaliper * $vat;
                    }
                    else{
                       $this->resbrakecaliper = 0;
                       $this->brakecaliperITC = $this->resbrakecaliper * $vat;
                    }

                    $currcarburetorMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%carburetor%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currcarburetorMile) > 0){
                        $carburetorMile = $currcarburetorMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->rescarburetor= $this->getEarn[0]->post_mileage/$this->totMiles * $this->carburetors;
                        }else{
                            $this->rescarburetor = 0;
                        }


                        $this->carburetorITC = $this->rescarburetor * $vat;
                    }
                    else{
                       $this->rescarburetor = 0;
                       $this->carburetorITC = $this->rescarburetor * $vat;
                    }

                    $currcatalyticMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%catalytic converter%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currcatalyticMile) > 0){
                        $catalyticMile = $currcatalyticMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->rescatalytic= $this->getEarn[0]->post_mileage/$this->totMiles * $this->catalytics;
                        }else{
                            $this->rescatalytic = 0;
                        }


                        $this->catalyticITC = $this->rescatalytic * $vat;
                    }
                    else{
                       $this->rescatalytic = 0;
                       $this->catalyticITC = $this->rescatalytic * $vat;
                    }

                    $currclutchMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%clutch%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currclutchMile) > 0){
                        $clutchMile = $currclutchMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resclutch= $this->getEarn[0]->post_mileage/$this->totMiles * $this->clutchs;
                        }else{
                            $this->resclutch = 0;
                        }


                        $this->clutchITC = $this->resclutch * $vat;
                    }
                    else{
                       $this->resclutch = 0;
                       $this->clutchITC = $this->resclutch * $vat;
                    }


                    $currcontrolarmMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%control arm%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currcontrolarmMile) > 0){
                        $controlarmMile = $currcontrolarmMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->rescontrolarm= $this->getEarn[0]->post_mileage/$this->totMiles * $this->controlarms;
                        }else{
                            $this->rescontrolarm = 0;
                        }


                        $this->controlarmITC = $this->rescontrolarm * $vat;
                    }
                    else{
                       $this->rescontrolarm = 0;
                       $this->controlarmITC = $this->rescontrolarm * $vat;
                    }

                    $currcoolanttempMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%coolant temperature sensor%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currcoolanttempMile) > 0){
                        $coolanttempMile = $currcoolanttempMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->rescoolanttemp= $this->getEarn[0]->post_mileage/$this->totMiles * $this->coolanttemps;
                        }else{
                            $this->rescoolanttemp = 0;
                        }


                        $this->coolanttempITC = $this->rescoolanttemp * $vat;
                    }
                    else{
                       $this->rescoolanttemp = 0;
                       $this->coolanttempITC = $this->rescoolanttemp * $vat;
                    }

                    $currexhaustMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%exhaust%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currexhaustMile) > 0){
                        $exhaustMile = $currexhaustMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resexhaust= $this->getEarn[0]->post_mileage/$this->totMiles * $this->exhausts;
                        }else{
                            $this->resexhaust = 0;
                        }


                        $this->exhaustITC = $this->resexhaust * $vat;
                    }
                    else{
                       $this->resexhaust = 0;
                       $this->exhaustITC = $this->resexhaust * $vat;
                    }


                    $currfuelinjectionMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%fuel injection%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currfuelinjectionMile) > 0){
                        $fuelinjectionMile = $currfuelinjectionMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resfuelinjection= $this->getEarn[0]->post_mileage/$this->totMiles * $this->fuelinjections;
                        }else{
                            $this->resfuelinjection = 0;
                        }


                        $this->fuelinjectionITC = $this->resfuelinjection * $vat;
                    }
                    else{
                       $this->resfuelinjection = 0;
                       $this->fuelinjectionITC = $this->resfuelinjection * $vat;
                    }

                    $currfueltankMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%fuel tank%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currfueltankMile) > 0){
                        $fueltankMile = $currfueltankMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resfueltank= $this->getEarn[0]->post_mileage/$this->totMiles * $this->fueltanks;
                        }else{
                            $this->resfueltank = 0;
                        }


                        $this->fueltankITC = $this->resfueltank * $vat;
                    }
                    else{
                       $this->resfueltank = 0;
                       $this->fueltankITC = $this->resfueltank * $vat;
                    }

                    $currheadgasketMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%head gasket%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currheadgasketMile) > 0){
                        $headgasketMile = $currheadgasketMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resheadgasket= $this->getEarn[0]->post_mileage/$this->totMiles * $this->headgaskets;
                        }else{
                            $this->resheadgasket = 0;
                        }


                        $this->headgasketITC = $this->resheadgasket * $vat;
                    }
                    else{
                       $this->resheadgasket = 0;
                       $this->headgasketITC = $this->resheadgasket * $vat;
                    }

                    $currheatercoreMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%heater core%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currheatercoreMile) > 0){
                        $heatercoreMile = $currheatercoreMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resheatercore= $this->getEarn[0]->post_mileage/$this->totMiles * $this->heatercores;
                        }else{
                            $this->resheatercore = 0;
                        }


                        $this->heatercoreITC = $this->resheatercore * $vat;
                    }
                    else{
                       $this->resheatercore = 0;
                       $this->heatercoreITC = $this->resheatercore * $vat;
                    }

                    $currhoseMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%hose%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currhoseMile) > 0){
                        $hoseMile = $currhoseMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->reshose= $this->getEarn[0]->post_mileage/$this->totMiles * $this->hoses;
                        }else{
                            $this->reshose = 0;
                        }


                        $this->hoseITC = $this->reshose * $vat;
                    }
                    else{
                       $this->reshose = 0;
                       $this->hoseITC = $this->reshose * $vat;
                    }

                    $currlineMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%line%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currlineMile) > 0){
                        $lineMile = $currlineMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resline= $this->getEarn[0]->post_mileage/$this->totMiles * $this->lines;
                        }else{
                            $this->resline = 0;
                        }


                        $this->lineITC = $this->resline * $vat;
                    }
                    else{
                       $this->resline = 0;
                       $this->lineITC = $this->resline * $vat;
                    }

                    $currmassairMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%mass air flow sensor%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currmassairMile) > 0){
                        $massairMile = $currmassairMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resmassair= $this->getEarn[0]->post_mileage/$this->totMiles * $this->massairs;
                        }else{
                            $this->resmassair = 0;
                        }


                        $this->massairITC = $this->resmassair * $vat;
                    }
                    else{
                       $this->resmassair = 0;
                       $this->massairITC = $this->resmassair * $vat;
                    }

                    $curroxygensensorMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%oxygen sensor%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($curroxygensensorMile) > 0){
                        $oxygensensorMile = $curroxygensensorMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resoxygensensor= $this->getEarn[0]->post_mileage/$this->totMiles * $this->oxygensensors;
                        }else{
                            $this->resoxygensensor = 0;
                        }


                        $this->oxygensensorITC = $this->resoxygensensor * $vat;
                    }
                    else{
                       $this->resoxygensensor = 0;
                       $this->oxygensensorITC = $this->resoxygensensor * $vat;
                    }

                    $currradiatorMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%radiator%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currradiatorMile) > 0){
                        $radiatorMile = $currradiatorMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resradiator= $this->getEarn[0]->post_mileage/$this->totMiles * $this->radiators;
                        }else{
                            $this->resradiator = 0;
                        }


                        $this->radiatorITC = $this->resradiator * $vat;
                    }
                    else{
                       $this->resradiator = 0;
                       $this->radiatorITC = $this->resradiator * $vat;
                    }

                    $currshockMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%shock/strut%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currshockMile) > 0){
                        $shockMile = $currshockMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resshock= $this->getEarn[0]->post_mileage/$this->totMiles * $this->shocks;
                        }else{
                            $this->resshock = 0;
                        }


                        $this->shockITC = $this->resshock * $vat;
                    }
                    else{
                       $this->resshock = 0;
                       $this->shockITC = $this->resshock * $vat;
                    }

                    $currstarterMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%starter%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currstarterMile) > 0){
                        $starterMile = $currstarterMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resstarter= $this->getEarn[0]->post_mileage/$this->totMiles * $this->starters;
                        }else{
                            $this->resstarter = 0;
                        }


                        $this->starterITC = $this->resstarter * $vat;
                    }
                    else{
                       $this->resstarter = 0;
                       $this->starterITC = $this->resstarter * $vat;
                    }

                    $currthermostatMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%thermostat%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currthermostatMile) > 0){
                        $thermostatMile = $currthermostatMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resthermostat= $this->getEarn[0]->post_mileage/$this->totMiles * $this->thermostats;
                        }else{
                            $this->resthermostat = 0;
                        }


                        $this->thermostatITC = $this->resthermostat * $vat;
                    }
                    else{
                       $this->resthermostat = 0;
                       $this->thermostatITC = $this->resthermostat * $vat;
                    }

                    $currtierodMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%tie rod%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currtierodMile) > 0){
                        $tierodMile = $currtierodMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->restierod= $this->getEarn[0]->post_mileage/$this->totMiles * $this->tierods;
                        }else{
                            $this->restierod = 0;
                        }


                        $this->tierodITC = $this->restierod * $vat;
                    }
                    else{
                       $this->restierod = 0;
                       $this->tierodITC = $this->restierod * $vat;
                    }


                    $currtransmissionMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%transmission%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currtransmissionMile) > 0){
                        $transmissionMile = $currtransmissionMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->restransmission= $this->getEarn[0]->post_mileage/$this->totMiles * $this->transmissions;
                        }else{
                            $this->restransmission = 0;
                        }


                        $this->transmissionITC = $this->restransmission * $vat;
                    }
                    else{
                       $this->restransmission = 0;
                       $this->transmissionITC = $this->restransmission * $vat;
                    }

                    $currwaterpumpMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%water pump%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currwaterpumpMile) > 0){
                        $waterpumpMile = $currwaterpumpMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->reswaterpump= $this->getEarn[0]->post_mileage/$this->totMiles * $this->waterpumps;
                        }else{
                            $this->reswaterpump = 0;
                        }


                        $this->waterpumpITC = $this->reswaterpump * $vat;
                    }
                    else{
                       $this->reswaterpump = 0;
                       $this->waterpumpITC = $this->reswaterpump * $vat;
                    }

                    $currwheelbearingMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%wheel bearings%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currwheelbearingMile) > 0){
                        $wheelbearingMile = $currwheelbearingMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->reswheelbearing= $this->getEarn[0]->post_mileage/$this->totMiles * $this->wheelbearings;
                        }else{
                            $this->reswheelbearing = 0;
                        }


                        $this->wheelbearingITC = $this->reswheelbearing * $vat;
                    }
                    else{
                       $this->reswheelbearing = 0;
                       $this->wheelbearingITC = $this->reswheelbearing * $vat;
                    }

                    $currwindowMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%window%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currwindowMile) > 0){
                        $windowMile = $currwindowMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->reswindow= $this->getEarn[0]->post_mileage/$this->totMiles * $this->windows;
                        }else{
                            $this->reswindow = 0;
                        }


                        $this->windowITC = $this->reswindow * $vat;
                    }
                    else{
                       $this->reswindow = 0;
                       $this->windowITC = $this->reswindow * $vat;
                    }

                    $currwindshieldMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%windshield%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currwindshieldMile) > 0){
                        $windshieldMile = $currwindshieldMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->reswindshield= $this->getEarn[0]->post_mileage/$this->totMiles * $this->windshields;
                        }else{
                            $this->reswindshield = 0;
                        }


                        $this->windshieldITC = $this->reswindshield * $vat;
                    }
                    else{
                       $this->reswindshield = 0;
                       $this->windshieldITC = $this->reswindshield * $vat;
                    }

                    $currsensorMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%sensor%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currsensorMile) > 0){
                        $sensorMile = $currsensorMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->ressensor= $this->getEarn[0]->post_mileage/$this->totMiles * $this->sensors;
                        }else{
                            $this->ressensor = 0;
                        }


                        $this->sensorITC = $this->ressensor * $vat;
                    }
                    else{
                       $this->ressensor = 0;
                       $this->sensorITC = $this->ressensor * $vat;
                    }

                    $currotherMile = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%other%')->orderBy('created_at', 'DESC')->take(1)->get('mileage');
                    if(count($currotherMile) > 0){
                        $otherMile = $currotherMile[0]->mileage;

                    // Calc Brake rotor Prorated
                        if($this->totMiles != 0){
                            $this->resother= $this->getEarn[0]->post_mileage/$this->totMiles * $this->others;
                        }else{
                            $this->resother = 0;
                        }


                        $this->otherITC = $this->resother * $vat;
                    }
                    else{
                       $this->resother = 0;
                       $this->otherITC = $this->resother * $vat;
                    }

                    $this->totalPro = $this->resInsp + $this->resRegs + $this->resFuel + $this->resIns + $this->resReg + $this->resRepair + $this->resWash + $this->resRsa + $this->resairFilter + $this->resBattery + $this->resBrakefluid + $this->resBrakepad + $this->resBrakerotor + $this->resCoolantwash + $this->resDistcap + $this->resFuelfilter + $this->resHeadlight + $this->resoilchange + $this->respowersteer + $this->ressparkplug + $this->ressparkplug + $this->restimingbelt + $this->restirenew + $this->restirebalancing + $this->restireinflation + $this->restirerotation + $this->reswheelrotation + $this->restransfluidflush + $this->reswheelalignment + $this->reswiperblade + $this->rescabinair + $this->ressmogcheck + $this->resalternator + $this->resbelt + $this->resbodywork + $this->resbrakecaliper + $this->rescarburetor + $this->rescatalytic + $this->resclutch + $this->rescontrolarm + $this->rescoolanttemp + $this->resexhaust + $this->resfuelinjection + $this->resfueltank + $this->resheadgasket + $this->resheatercore + $this->reshose + $this->resline + $this->resmassair + $this->resmuffler + $this->resoxygensensor + $this->resradiator + $this->resshock + $this->resstarter + $this->resthermostat + $this->restierod + $this->restransmission + $this->reswaterpump + $this->reswheelbearing + $this->reswindow + $this->reswindshield + $this->ressensor + $this->resother;

                    $this->totalITC = $this->inspITC + $this->regsITC + $this->fuelITC + $this->insITC + $this->regITC + $this->repITC + $this->washITC + $this->rsaITC + $this->airfilterITC + $this->batteryITC + $this->brakefluidITC + $this->brakepadITC + $this->brakerotorITC + $this->coolantwashITC + $this->distcapITC + $this->fuelfilterITC + $this->headlightITC + $this->oilchangeITC + $this->powersteerITC + $this->sparkplugITC + $this->sparkplugITC + $this->timingbeltITC + $this->tirenewITC + $this->tirebalancingITC + $this->tireinflationITC + $this->tirerotationITC + $this->wheelrotationITC + $this->transfluidflushITC + $this->wheelalignmentITC + $this->wiperbladeITC + $this->cabinairITC + $this->smogcheckITC + $this->alternatorITC + $this->beltITC + $this->bodyworkITC + $this->brakecaliperITC + $this->carburetorITC + $this->catalyticITC + $this->clutchITC + $this->controlarmITC + $this->coolanttempITC + $this->exhaustITC + $this->fuelinjectionITC + $this->fueltankITC + $this->headgasketITC + $this->heatercoreITC + $this->hoseITC + $this->lineITC + $this->massairITC + $this->mufflerITC + $this->oxygensensorITC + $this->radiatorITC + $this->shockITC + $this->starterITC + $this->thermostatITC + $this->tierodITC + $this->transmissionITC + $this->waterpumpITC + $this->wheelbearingITC + $this->windowITC + $this->windshieldITC + $this->sensorITC + $this->otherITC;

                    $this->bizProfit = $this->totEarnings - $this->totalPro;
                    $this->taxProfit = $this->totTaxing - $this->totalITC;

                    // dd($this->totalITC);

                }


// End Tag Auth::user()->userType == "Commercial"

            }


        }
        else{
            // Return if not exist
        }


        $labourInv = LabourInventory::orderBy('created_at', 'DESC')->get();
        $materialInv = MaterialInventory::orderBy('created_at', 'DESC')->get();

        $allVehicleinfo = Vehicleinfo::where('busID', Auth::user()->busID)->where('update_by', Auth::user()->station_name)->orderBy('created_at', 'DESC')->get();

        $labCats = ManageLabourCategory::where('busID', Auth::user()->busID)->orderBy('created_at', 'DESC')->get();

        $manLabour = ManageLabour::where('busID', Auth::user()->busID)->orderBy('created_at', 'DESC')->get();

        $Invitems = CreateInventoryItem::where('busID', Auth::user()->busID)->orderBy('created_at', 'DESC')->get();

        $getVendor = CreateVendor::where('busID', Auth::user()->busID)->orderBy('created_at', 'DESC')->get();

        $getTimesheet = ManageTimeSheet::where('busID', Auth::user()->busID)->orderBy('created_at', 'DESC')->get();

        $getCategory = CreateCategory::where('busID', Auth::user()->busID)->orderBy('created_at', 'DESC')->get();

        $getpayschedule = PaySchedule::where('busID', Auth::user()->busID)->orderBy('created_at', 'DESC')->get();

        // dd($getpayschedule);

        $getVendpay = PurchaseOrderPayment::where('busID', Auth::user()->busID)->orderBy('created_at', 'DESC')->get();

        $gettechpayStub = LabourPaystub::where('busID', Auth::user()->busID)->orderBy('created_at', 'DESC')->get();


        $getdealerVehicle = Carrecord::where('busID', Auth::user()->busID)->orderBy('created_at', 'DESC')->get();

        $getinvItem = DB::table('create_inventory_item')
            ->join('purchase_order', 'create_inventory_item.busID', '=', 'purchase_order.busID')
            ->orderBy('create_inventory_item.created_at', 'DESC')->get();

        $getPurchaseOrder = PurchaseOrder::where('busID', Auth::user()->busID)->orderBy('created_at', 'DESC')->get();

        $getJD = AddLabour::where('busID', Auth::user()->busID)->orderBy('created_at', 'DESC')->get();

         $getPurchaseOrder = DB::table('purchase_order')
            ->join('create_vendor', 'purchase_order.busID', '=', 'create_vendor.busID')->where('purchase_order.busID', Auth::user()->busID)
            ->orderBy('purchase_order.created_at', 'DESC')->get();

        if(count($allVehicleinfo) > 0){
            $this->vehicleRecs = $allVehicleinfo;
        }
        else{
            $this->vehicleRecs = "";
        }

        if(count($getVendor) > 0){
            $this->vendor = $getVendor;
        }
        else{
            $this->vendor = "";
        }

        if(count($getPurchaseOrder) > 0){
            $this->purchaseOrder = $getPurchaseOrder;
        }
        else{
            $this->purchaseOrder = "";
        }

        if(count($getinvItem) > 0){
            $this->invItem = $getinvItem;
        }
        else{
            $this->invItem = "";
        }

        if(count($getCategory) > 0){
            $this->categoryItem = $getCategory;
        }
        else{
            $this->categoryItem = "";
        }

        if(count($Invitems) > 0){
            $this->inventoryItem = $Invitems;
        }
        else{
            $this->inventoryItem = "";
        }

        if(count($labCats) > 0){
            $this->myLabourCategory = $labCats;
        }
        else{
            $this->myLabourCategory = "";
        }

        if(count($manLabour) > 0){
            $this->manageLabour = $manLabour;
        }
        else{
            $this->manageLabour = "";
        }

        if(count($getJD) > 0){
            $this->jobdescription = $getJD;
        }
        else{
            $this->jobdescription = "";
        }

        if(count($getTimesheet) > 0){
            $this->timesheets = $getTimesheet;
        }
        else{
            $this->timesheets = "";
        }

        if(count($getVendpay) > 0){
            $this->vendpayment = $getVendpay;
        }
        else{
            $this->vendpayment = "";
        }

        if(count($getpayschedule) > 0){
            $this->payschedules = $getpayschedule;
        }
        else{
            $this->payschedules = "";
        }

        if(count($gettechpayStub) > 0){
            $this->techpayStub = $gettechpayStub;
        }
        else{
            $this->techpayStub = "";
        }

        if(count($getdealerVehicle) > 0){
            $this->dealervehicle = $getdealerVehicle;
        }
        else{
            $this->dealervehicle = "";
        }

        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Visited User Dashboard page');


        $getmyVehicle = Carrecord::where('email', Auth::user()->email)->get();

        $vehicleInfo = Vehicleinfo::where('email', Auth::user()->email)->orderBy('created_at', 'DESC')->get();

        $forInvoice = Vehicleinfo::where('busID', Auth::user()->busID)->orderBy('created_at', 'DESC')->get();


        $clientBal = DB::table('vehicleinfo')
                     ->select(DB::raw('count(*) as client_count, SUM(total_cost) as total, email, created_at'))
                     ->where('busID', Auth::user()->busID)->where('update_by', Auth::user()->station_name)
                     ->get();

        $clientBal = Vehicleinfo::where('busID', Auth::user()->busID)->orderBy('created_at', 'DESC')->get();

        $stationBal = Stations::where('busID', Auth::user()->busID)->groupBy('station_name')->orderBy('created_at', 'DESC')->get();

        $vendorBal = DB::table('purchase_order')
                     ->select(DB::raw('vendor, SUM(purchase_order_totalpurchaseorder) as total, purchase_order_inventory_item as item'))
                     ->where('busID', Auth::user()->busID)
                     ->orderBy('created_at', 'DESC')
                     ->get();

        $labourBal = Estimate::where('busID', Auth::user()->busID)->where('update_by', Auth::user()->station_name)->orderBy('created_at', 'DESC')->get();

        $cashBal1 = DB::table('receive_payment')
                     ->select(DB::raw('SUM(cash_payment_amount) as total'))
                     ->where('busID', Auth::user()->busID)
                     ->get();
        $cashBal2 = DB::table('purchase_order_payment')
                     ->select(DB::raw('SUM(pay_cashamount) as total_cash'))
                     ->where('busID', Auth::user()->busID)
                     ->get();

        $cashBal3 = DB::table('vehicleinfo')
                     ->select(DB::raw('SUM(total_cost) as vehiclepay_total'))
                     ->where('busID', Auth::user()->busID)
                     ->get();

                     $cashBal = array_merge($cashBal1->toArray(), $cashBal2->toArray(), $cashBal3->toArray());

                     // dd($cashBal);


        $creditcardBal1 = DB::table('receive_payment')
                     ->select(DB::raw('SUM(creditcard_amount) as total'))
                     ->where('busID', Auth::user()->busID)
                     ->get();
        $creditcardBal2 = DB::table('purchase_order_payment')
                     ->select(DB::raw('SUM(pay_cardamount) as total_cash'))
                     ->where('busID', Auth::user()->busID)
                     ->get();

        $creditcardBal3 = DB::table('vehicleinfo')
                     ->select(DB::raw('SUM(total_cost) as vehiclepay_total'))
                     ->where('busID', Auth::user()->busID)
                     ->get();

                     $creditcardBal = array_merge($creditcardBal1->toArray(), $creditcardBal2->toArray(), $creditcardBal3->toArray());


        $bankBal1 = DB::table('receive_payment')
                     ->select(DB::raw('SUM(cheque_amount) as total'))
                     ->where('busID', Auth::user()->busID)
                     ->get();
        $bankBal2 = DB::table('purchase_order_payment')
                     ->select(DB::raw('SUM(pay_chequeamount) as total_cash'))
                     ->where('busID', Auth::user()->busID)
                     ->get();

        $bankBal3 = DB::table('vehicleinfo')
                     ->select(DB::raw('SUM(total_cost) as vehiclepay_total'))
                     ->where('busID', Auth::user()->busID)
                     ->get();

                $bankBal = array_merge($bankBal1->toArray(), $bankBal2->toArray(), $bankBal3->toArray());

                     // dd($labourBal);


        // for Business
        $vehicleInfobiz = Vehicleinfo::where('update_by', Auth::user()->name)->orderBy('created_at', 'DESC')->get();

        $reminderNotify = reminderNotify::where('email', Auth::user()->email)->get();


        // Get Imported contacts
        $importClient = GoogleImport::where('invite_from', Auth::user()->ref_code)->orderBy('created_at', 'DESC')->get();


        $opportunities = OpportunityPost::where('state', '1')->where('poststate', Auth::user()->state)->orderBy('created_at', 'DESC')->get();
        $postedopport = OpportunityPost::where('email', Auth::user()->email)->orderBy('created_at', 'DESC')->get();

        // Prepared Estimates
        $estimates = Estimate::orderBy('created_at', 'DESC')->get();



        $proposeEstimates = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 1)
                        ->orderBy('estimate.created_at', 'DESC')->get();

        $quotedEst = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('estimate.estimate', '=', 1)
                        ->orderBy('estimate.created_at', 'DESC')->get();

        $workinprogress = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->get();

        $submittedEst = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 1)->where('estimate.update_by', Auth::user()->station_name)
                        ->orderBy('estimate.created_at', 'DESC')->get();

        $approvedEst = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)->where('estimate.update_by', Auth::user()->station_name)
                        ->orderBy('estimate.created_at', 'DESC')->get();


        // $proposeEstimates = DB::table('estimate')
        //     ->join('opportunitypost', 'estimate.opportunity_id', '=', 'opportunitypost.post_id')->where('opportunitypost.state', '1')
        //     ->orderBy('estimate.created_at', 'DESC')->get();



        $posjobdone = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)
                        ->orderBy('estimate.created_at', 'DESC')->get();

            // dd($workinprogress);

            // Get client / vehicle info

            // $client = Vehicleinfo::where('busID', Auth::user()->busID)->get();
            $client = DB::table('carrecord')
                        ->join('vehicleinfo', 'vehicleinfo.vehicle_licence', '=', 'carrecord.vehicle_reg_no')
                        ->where('vehicleinfo.busID', '=', Auth::user()->busID)->groupBy('carrecord.vehicle_reg_no')
                        ->orderBy('carrecord.created_at', 'DESC')->get();

                        // Get my bookings
                        $getEstPage = DB::table('estimate')
                        ->join('opportunitypost', 'opportunitypost.post_id', '=', 'estimate.opportunity_id')
                        ->join('prepareestimate', 'prepareestimate.estimate_id', '=', 'estimate.estimate_id')
                        ->where('opportunitypost.state', '=', 2)->where('estimate.opportunity_id', $req->route('key'))
                        ->orderBy('estimate.created_at', 'DESC')->get();

                        $myBookings = DB::table('carrecord')
                        ->join('book_appointment', 'book_appointment.email', '=', 'carrecord.email')
                        ->where('book_appointment.station_name', Auth::user()->station_name)
                        ->where('book_appointment.accstate', 0)
                        ->orderBy('book_appointment.created_at', 'DESC')->get();

                        $bookappoint = BookAppointment::where('email', Auth::user()->email)->where('state', 0)->orderBy('created_at', 'DESC')->get();


                        $myreviews = Review::where('station_name', Auth::user()->station_name)->orderBy('created_at', 'DESC')->get();
                        $myreviewcount = Review::where('station_name', Auth::user()->station_name)->count();

        $notify = $this->notify();

        $busInfo = $this->clientinfo();

        $phoneappointment = $this->phoneappointmentDetails();

        return view('pages.userdashboard')->with(['pages' => 'User Dashboard', 'vehicleInfo' => $vehicleInfo, 'carrecord' => $getmyVehicle, 'difference' => $this->difference, 'reminderNotify' => $reminderNotify, 'vehicleInfobiz' => $vehicleInfobiz, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'oilChange' => $this->oilChange, 'tyreRotation' => $this->tyreRotation, 'airFilter' => $this->airFilter, 'inspection' => $this->inspection, 'registration' =>$this->registration, 'totMiles' => $this->totMiles, 'totMaint' => $this->totMaint, 'revPost' => $this->post, 'getEarns' => $this->getEarn, 'totfuel' => $this->fuelExp, 'totInsurance' => $this->insuranceExp, 'totReg' => $this->regExp, 'totRepair' => $this->repairExpence, 'totWash' => $this->washExpence, 'totAsst' => $this->roadasstExpence, 'totalKM' => $this->totEarnings, 'taxTot' => $this->totTaxing, 'proFuel' => $this->resFuel, 'proIns'=> $this->resIns, 'proReg'=> $this->resReg, 'proRepair'=> $this->resRepair, 'proWash'=> $this->resWash, 'proRsa'=> $this->resRsa, 'fuelITC' => $this->fuelITC, 'insITC'=> $this->insITC, 'regITC'=> $this->regITC, 'repITC'=> $this->repITC, 'washITC'=> $this->washITC, 'rsaITC'=> $this->rsaITC, 'totPro' => $this->totalPro, 'totITC' => $this->totalITC, 'bizProfit' => $this->bizProfit, 'taxProfit' => $this->taxProfit, 'addedRec' => $this->addedRec, 'new_rec' => $this->new_rec, 'earnStart' => $this->earnStart, 'earnEnd' => $this->earnEnd, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'totInsp' => $this->inspect, 'proInsp' => $this->resInsp, 'inspITC' => $this->inspITC, 'totRegs' => $this->regs, 'proRegs' => $this->resRegs, 'regsITC' => $this->regsITC, 'totairFilter' => $this->airFilters, 'proairFilter' => $this->resairFilter, 'airfilterITC' => $this->airfilterITC, 'totBattery' => $this->batterys, 'proBattery' => $this->resBattery, 'batteryITC' => $this->batteryITC, 'totbrakeFluids' => $this->brakefluids, 'proBrakefluid' => $this->resBrakefluid, 'brakefluidsITC' => $this->brakefluidITC, 'totbrakePads' => $this->brakepads, 'proBrakepad' => $this->resBrakepad, 'brakepadsITC' => $this->brakepadITC, 'totbrakeRotors' => $this->brakerotors, 'proBrakerotor' => $this->resBrakerotor, 'brakerotorsITC' => $this->brakerotorITC, 'totcoolantwash' => $this->coolantwash, 'proCoolantwash' => $this->resCoolantwash, 'coolantwashITC' => $this->coolantwashITC, 'totdispCap' => $this->distcap, 'prodispcap' => $this->resDistcap, 'distcapITC' => $this->distcapITC, 'totfuelFilter' => $this->fuelfilters, 'profuelfilter' => $this->resFuelfilter, 'fuelfilterITC' => $this->fuelfilterITC, 'totheadlight' => $this->headlights, 'proheadlight' => $this->resHeadlight, 'headlightITC' => $this->headlightITC, 'totoilchange' => $this->oilchanges, 'prooilchange' => $this->resoilchange, 'oilchangeITC' => $this->oilchangeITC, 'totpowersteer' => $this->powersteers, 'propowersteer' => $this->respowersteer, 'powersteerITC' => $this->powersteerITC, 'totsparkplug' => $this->sparkplugs, 'prosparkplug' => $this->ressparkplug, 'sparkplugITC' => $this->sparkplugITC, 'tottimingbelt' => $this->timingbelts, 'protimingbelt' => $this->restimingbelt, 'timingbeltITC' => $this->timingbeltITC, 'tottirenew' => $this->tirenews, 'protirenew' => $this->restirenew, 'tirenewITC' => $this->tirenewITC, 'tottirebalancing' => $this->tirebalancings, 'protirebalancing' => $this->restirebalancing, 'tirebalancingITC' => $this->tirebalancingITC, 'tottireinflation' => $this->tireinflations, 'protireinflation' => $this->restireinflation, 'tireinflationITC' => $this->tireinflationITC, 'tottirerotation' => $this->tirerotations, 'protirerotation' => $this->restirerotation, 'tirerotationITC' => $this->tirerotationITC, 'totwheelrotation' => $this->wheelrotations, 'prowheelrotation' => $this->reswheelrotation, 'wheelrotationITC' => $this->wheelrotationITC, 'tottransfluidflush' => $this->transfluidflushs, 'protransfluidflush' => $this->restransfluidflush, 'transfluidflushITC' => $this->transfluidflushITC, 'totwheelalignment' => $this->wheelalignments, 'prowheelalignment' => $this->reswheelalignment, 'wheelalignmentITC' => $this->wheelalignmentITC, 'totwiperblade' => $this->wiperblades, 'prowiperblade' => $this->reswiperblade, 'wiperbladeITC' => $this->wiperbladeITC, 'totcabinair' => $this->cabinairs, 'procabinair' => $this->rescabinair, 'cabinairITC' => $this->cabinairITC, 'totsmogcheck' => $this->smogchecks, 'prosmogcheck' => $this->ressmogcheck, 'smogcheckITC' => $this->smogcheckITC, 'totalternator' => $this->alternators, 'proalternator' => $this->resalternator, 'alternatorITC' => $this->alternatorITC, 'totbelt' => $this->belts, 'probelt' => $this->resbelt, 'beltITC' => $this->beltITC, 'totbodywork' => $this->bodyworks, 'probodywork' => $this->resbodywork, 'bodyworkITC' => $this->bodyworkITC, 'totbrakecaliper' => $this->brakecalipers, 'probrakecaliper' => $this->resbrakecaliper, 'brakecaliperITC' => $this->brakecaliperITC, 'totcarburetor' => $this->carburetors, 'procarburetor' => $this->rescarburetor, 'carburetorITC' => $this->carburetorITC, 'totcatalytic' => $this->catalytics, 'procatalytic' => $this->rescatalytic, 'catalyticITC' => $this->catalyticITC, 'totclutch' => $this->clutchs, 'proclutch' => $this->resclutch, 'clutchITC' => $this->clutchITC, 'totcontrolarm' => $this->controlarms, 'procontrolarm' => $this->rescontrolarm, 'controlarmITC' => $this->controlarmITC, 'totcoolanttemp' => $this->coolanttemps, 'procoolanttemp' => $this->rescoolanttemp, 'coolanttempITC' => $this->coolanttempITC, 'totexhaust' => $this->exhausts, 'proexhaust' => $this->resexhaust, 'exhaustITC' => $this->exhaustITC, 'totfuelinjection' => $this->fuelinjections, 'profuelinjection' => $this->resfuelinjection, 'fuelinjectionITC' => $this->fuelinjectionITC, 'totfueltank' => $this->fueltanks, 'profueltank' => $this->resfueltank, 'fueltankITC' => $this->fueltankITC, 'totheadgasket' => $this->headgaskets, 'proheadgasket' => $this->resheadgasket, 'headgasketITC' => $this->headgasketITC, 'totheatercore' => $this->heatercores, 'proheatercore' => $this->resheatercore, 'heatercoreITC' => $this->heatercoreITC, 'tothose' => $this->hoses, 'prohose' => $this->reshose, 'hoseITC' => $this->hoseITC, 'totline' => $this->lines, 'proline' => $this->resline, 'lineITC' => $this->lineITC, 'totmassair' => $this->massairs, 'promassair' => $this->resmassair, 'massairITC' => $this->massairITC, 'totmuffler' => $this->mufflers, 'promuffler' => $this->resmuffler, 'mufflerITC' => $this->mufflerITC, 'totoxygensensor' => $this->oxygensensors, 'prooxygensensor' => $this->resoxygensensor, 'oxygensensorITC' => $this->oxygensensorITC, 'totradiator' => $this->radiators, 'proradiator' => $this->resradiator, 'radiatorITC' => $this->radiatorITC, 'totshock' => $this->shocks, 'proshock' => $this->resshock, 'shockITC' => $this->shockITC, 'totstarter' => $this->starters, 'prostarter' => $this->resstarter, 'starterITC' => $this->starterITC, 'totthermostat' => $this->thermostats, 'prothermostat' => $this->resthermostat, 'thermostatITC' => $this->thermostatITC, 'tottierod' => $this->tierods, 'protierod' => $this->restierod, 'tierodITC' => $this->tierodITC, 'tottransmission' => $this->transmissions, 'protransmission' => $this->restransmission, 'transmissionITC' => $this->transmissionITC, 'totwaterpump' => $this->waterpumps, 'prowaterpump' => $this->reswaterpump, 'waterpumpITC' => $this->waterpumpITC, 'totwheelbearing' => $this->wheelbearings, 'prowheelbearing' => $this->reswheelbearing, 'wheelbearingITC' => $this->wheelbearingITC, 'totwindow' => $this->windows, 'prowindow' => $this->reswindow, 'windowITC' => $this->windowITC, 'totwindshield' => $this->windshields, 'prowindshield' => $this->reswindshield, 'windshieldITC' => $this->windshieldITC, 'totsensor' => $this->sensors, 'prosensor' => $this->ressensor, 'sensorITC' => $this->sensorITC, 'totother' => $this->others, 'proother' => $this->resother, 'otherITC' => $this->otherITC, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'importClient' => $importClient, 'labourInv' => $labourInv, 'materialInv' => $materialInv, 'vendor' => $this->vendor, 'purchaseOrder' => $this->purchaseOrder, 'getinvItem' => $this->invItem, 'categoryItem' => $this->categoryItem, 'inventoryItem' => $this->inventoryItem, 'myLabourCategory' => $this->myLabourCategory, 'manageLabour' => $this->manageLabour, 'jobdescription' => $this->jobdescription, 'timesheet' => $this->timesheets, 'invoice' => $forInvoice, 'clientBal' => $clientBal, 'stationBal' => $stationBal, 'vendorBal' => $vendorBal,'labourBal' => $labourBal,'cashBal' => $cashBal,'creditcardBal' => $creditcardBal,'bankBal' => $bankBal,'vendpayment' => $this->vendpayment, 'allVehicleinfo' => $this->vehicleRecs, 'payschedules' => $this->payschedules, 'techpayStub' => $this->techpayStub, 'dealervehicle' => $this->dealervehicle, 'opportunities' => $opportunities, 'proposeEstimates' => $proposeEstimates, 'workinprogress' => $workinprogress, 'postedopport' => $postedopport, 'submittedEst' => $submittedEst, 'approvedEst' => $approvedEst, 'quotedEst' => $quotedEst, 'client' => $client, 'notify' => $notify, 'myBookings' => $myBookings, 'bookappoint' => $bookappoint, 'discountcharge' => $this->discount, 'servicePercent' => $servicePercent, 'myreviews' => $myreviews, 'myreviewcount' => $myreviewcount, 'phoneappointment' => $phoneappointment]);
    }




    public function Search(Request $req){



        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            
            $getQuest = AskExpert::all();
            
            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }

                // Get Client Info
        
        $notify = $this->notify();
        $busInfo = $this->clientinfo();
        
        // GEt Searched result



        $getRes = DB::table('stations')
            ->join('business', 'stations.busID', '=', 'business.busID')->where('stations.city', 'LIKE', '%'.$req->route('key').'%')->orderBy('stations.created_at', 'DESC')
            ->get();


        if(count($getRes) > 0){
            if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Individual" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Technician" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == 'Commercial'){

                // dd($getRes[0]->country);
                // Auth::user()->country

                if(Auth::user()->country == $getRes[0]->country){
                    $this->getRes = $getRes;
                }
                else{
                    $this->getRes = "";
                }
            }
            else{
                $this->getRes = "";
            }
        }
        else{
            $this->getRes = "";
        }




            // dd($this->getRes);


       $getProf = DB::table('users')
            ->join('stations', 'stations.busID', '=', 'users.busID')->where('stations.city', 'LIKE', '%'.$req->route('key').'%')->orderBy('stations.created_at', 'DESC')
            ->get();



            if(count($getProf) > 0){
                $this->getProf = $getProf;
            }else{

                // Search Business Table
               $otherProf =  Business::where('city', 'LIKE', '%'.$req->route('key').'%')->where('telephone', '!=', 'NULL')->orderBy('created_at', 'DESC')->get();

               if(count($otherProf) > 0){
                $this->getProf = $otherProf;
               }
               else{
                $this->getProf = "";
               }


            }

        // dd($this->getProf);

        // $getRes = Stations::where('city', 'LIKE', '%'.$req->route('key').'%')->get();

        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Searches for Auto care centers in '.$req->route('key'));

        // dd($getProf);
        return view('pages.search')->with(['pages' => 'Search Result', 'getRes' => $this->getRes,'getProf' => $this->getProf, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'country' => $this->arr_ip['country'], 'city' => $this->arr_ip['city'], 'notify' => $notify]);

    }

    public function promosearch2(Request $req){



        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            
            $getQuest = AskExpert::all();
            
            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }


                


        }



        // GEt Searched result

                    
            // Get Client Info
            $notify = $this->notify();
        
        $busInfo = $this->clientinfo();


        $getRes = DB::table('stations')
            ->join('business', 'stations.busID', '=', 'business.busID')->where('stations.city', 'LIKE', '%'.$req->route('key').'%')->orderBy('stations.created_at', 'DESC')
            ->get();


        if(count($getRes) > 0){

                if($this->arr_ip['country'] == $getRes[0]->country){
                    $this->getRes = $getRes;
                }
                else{
                    $this->getRes = "";
                }
        }
        else{
            $this->getRes = "";
        }



       $getProf = DB::table('stations')
            ->join('users', 'stations.role', '=', 'users.userType')->where('stations.city', 'LIKE', '%'.$req->route('key').'%')->orderBy('stations.created_at', 'DESC')
            ->get();



            if(count($getProf) > 0){
                $this->getProf = $getProf;
            }else{

                // Search Business Table
               $otherProf =  Business::where('city', 'LIKE', '%'.$req->route('key').'%')->where('telephone', '!=', 'NULL')->orderBy('created_at', 'DESC')->get();

               if(count($otherProf) > 0){
                $this->getProf = $otherProf;
               }
               else{
                $this->getProf = "";
               }


            }

        // dd($this->getProf);

        // $getRes = Stations::where('city', 'LIKE', '%'.$req->route('key').'%')->get();

        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Searches for Auto care centers in '.$req->route('key'));


        return view('pages.search2')->with(['pages' => 'Search Result', 'getRes' => $this->getRes,'getProf' => $this->getProf, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'country' => $this->arr_ip['country'], 'city' => $this->arr_ip['city'], 'notify' => $notify, 'link' => $req->route('key')]);

    }


    public function advancesearch(Request $req){



        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }


        
        // GEt Searched result

        $getRes = DB::table('stations')
            ->join('business', 'stations.busID', '=', 'business.busID')->where('stations.zipcode', 'LIKE', '%'.$req->route('key').'%')->orderBy('stations.created_at', 'DESC')
            ->get();

        if(count($getRes) > 0){
            if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Individual" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Technician" || Auth::user()->userType == "Certified Professional"){
                if(Auth::user()->zipcode == $getRes[0]->zipcode){
                    $this->getRes = $getRes;
                }
                else{
                    $this->getRes = "";
                }
            }
            else{
                $this->getRes = "";
            }
        }
        else{
            $this->getRes = "";
        }



            // dd($this->getRes);


       $getProf = DB::table('stations')
            ->join('users', 'stations.role', '=', 'users.userType')->where('stations.zipcode', 'LIKE', '%'.$req->route('key').'%')->orderBy('stations.created_at', 'DESC')
            ->get();



            if(count($getProf) > 0){
                $this->getProf = $getProf;
            }else{

                // Search Business Table
               $otherProf =  Business::where('zipcode', 'LIKE', '%'.$req->route('key').'%')->where('telephone', '!=', 'NULL')->orderBy('created_at', 'DESC')->get();

               if(count($otherProf) > 0){
                $this->getProf = $otherProf;
               }
               else{
                $this->getProf = "";
               }


            }

        // dd($this->getProf);

        // $getRes = Stations::where('city', 'LIKE', '%'.$req->route('key').'%')->get();

        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Searches for Auto care centers via Postal Code '.$req->route('key'));

                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        return view('pages.advancesearch')->with(['pages' => 'Search Result', 'getRes' => $this->getRes,'getProf' => $this->getProf, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'country' => $this->arr_ip['country'], 'city' => $this->arr_ip['city'], 'notify' => $notify]);

    }

    public function estimatedetail(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();



            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }

                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();
        

            $getEstPage = Estimate::where('estimate_id', $req->route('id'))->where('estimate', '1')->get();
            $getPart = Addpart::where('post_id', $req->route('id'))->get();

            if(count($getEstPage) > 0){
                $this->heading = "Estimate Report";
                $this->Page = $getEstPage;

            }
            else{
                $this->heading = "Work Order Report";
                $getWorkorderPage = Estimate::where('estimate_id', $req->route('id'))->where('work_order', '1')->get();

                $this->Page = $getWorkorderPage;
            }

            if(count($getPart) > 0){
                $this->getPart = $getPart;
            }
            else{
                $this->getPart = "";
            }


        return view('pages.estimatedetail')->with(['pages' => 'Estimate', 'getEstPage' => $this->Page, 'getPart' => $this->getPart, 'heading' => $this->heading, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }

    public function monerispayment(Request $req){


        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();


            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }


        

            $getEstPage = Estimate::where('estimate_id', $req->route('id'))->where('estimate', '1')->get();

            $getPart = Addpart::where('post_id', $req->route('id'))->get();

            if(count($getEstPage) > 0){
                $this->heading = "Estimate Report";
                $this->Page = $getEstPage;

            }
            else{
                $this->heading = "Work Order Report";
                $getWorkorderPage = Estimate::where('estimate_id', $req->route('id'))->where('work_order', '1')->get();

                $this->Page = $getWorkorderPage;
            }

            if(count($getPart) > 0){
                $this->getPart = $getPart;
            }
            else{
                $this->getPart = "";
            }

                    // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        return view('pages.monerispay')->with(['pages' => 'Estimate', 'getEstPage' => $this->Page, 'getPart' => $this->getPart, 'heading' => $this->heading, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }


    public function paypalpay(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();


            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        

            $getEstPage = Estimate::where('estimate_id', $req->route('id'))->where('estimate', '1')->get();
            $getPart = Addpart::where('post_id', $req->route('id'))->get();

            if(count($getEstPage) > 0){
                $this->heading = "Estimate Report";
                $this->Page = $getEstPage;

            }
            else{
                $this->heading = "Work Order Report";
                $getWorkorderPage = Estimate::where('estimate_id', $req->route('id'))->where('work_order', '1')->get();

                $this->Page = $getWorkorderPage;
            }

            if(count($getPart) > 0){
                $this->getPart = $getPart;
            }
            else{
                $this->getPart = "";
            }


        return view('pages.paypalpay')->with(['pages' => 'Estimate', 'getEstPage' => $this->Page, 'getPart' => $this->getPart, 'heading' => $this->heading, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }

        public function monerispaymentinstore(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        

            $getEstPage = PaySchedule::where('estimate_id', $req->route('id'))->where('busID', Auth::user()->busID)->get();

            $getPart = Addpart::where('post_id', $req->route('id'))->get();

            if(count($getEstPage) > 0){
                $this->heading = "Estimate Report";
                $this->Page = $getEstPage;

            }
            else{
                $this->heading = "Work Order Report";
                $getWorkorderPage = Estimate::where('estimate_id', $req->route('id'))->where('work_order', '1')->get();

                $this->Page = $getWorkorderPage;
            }

            if(count($getPart) > 0){
                $this->getPart = $getPart;
            }
            else{
                $this->getPart = "";
            }


        return view('pages.monerispayinstore')->with(['pages' => 'Moneris Payment In-Store', 'getEstPage' => $this->Page, 'getPart' => $this->getPart, 'heading' => $this->heading, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }

    public function paypalpayinstore(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        

            $getEstPage = PaySchedule::where('estimate_id', $req->route('id'))->where('busID', Auth::user()->busID)->get();

            $getPart = Addpart::where('post_id', $req->route('id'))->get();

            if(count($getEstPage) > 0){
                $this->heading = "Estimate Report";
                $this->Page = $getEstPage;

            }
            else{
                $this->heading = "Work Order Report";
                $getWorkorderPage = Estimate::where('estimate_id', $req->route('id'))->where('work_order', '1')->get();

                $this->Page = $getWorkorderPage;
            }

            if(count($getPart) > 0){
                $this->getPart = $getPart;
            }
            else{
                $this->getPart = "";
            }


        return view('pages.paypalpayinstore')->with(['pages' => 'Paypal Payment In-Store', 'getEstPage' => $this->Page, 'getPart' => $this->getPart, 'heading' => $this->heading, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }

    public function proposalestimate(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }

            $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', Auth::user()->busID)->get();
            $servicecharge = MinimumDiscount::where('discount', 'service')->get();

            if(count($discountcharge) > 0){
                $this->discount = $discountcharge[0]->percent;
                $servicePercent = $servicecharge[0]->percent;
            }
            else{
                // Get Admin Discount
                $getDiscount = MinimumDiscount::where('discount', 'discount')->get();

                $this->discount = $getDiscount[0]->percent;
                $servicePercent = $servicecharge[0]->percent;
            }
        }
                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        

            $getEstPage = Estimate::where('estimate_id', $req->route('id'))->where('estimate', '1')->get();



            // Get Technician detail/Certificate
            $gettechdetail = User::where('email', $getEstPage[0]->technician)->get();


            $getPart = Addpart::where('post_id', $req->route('id'))->get();

            if(count($getEstPage) > 0){
                $this->heading = "Estimate Report";
                $this->Page = $getEstPage;

            }
            else{
                $this->heading = "Work Order Report";
                $getWorkorderPage = Estimate::where('estimate_id', $req->route('id'))->where('work_order', '1')->get();

                $this->Page = $getWorkorderPage;
            }

            if(count($getPart) > 0){
                $this->getPart = $getPart;
            }
            else{
                $this->getPart = "";
            }

            // dd($this->arr_ip);

        return view('pages.proposalestimate')->with(['pages' => 'Estimate Proposal', 'getEstPage' => $this->Page, 'getPart' => $this->getPart, 'heading' => $this->heading, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'gettechdetail' => $gettechdetail, 'notify' => $notify, 'discount' => $this->discount, 'servicecharge' => $servicecharge]);

    }


    public function techniciandetail(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        

            $getEstPage = User::where('ref_code', $req->route('key'))->get();



            $getPart = Addpart::where('post_id', $req->route('id'))->get();

            if(count($getEstPage) > 0){
                $this->heading = "Estimate Report";
                $this->Page = $getEstPage;

            }
            else{
                $this->heading = "Work Order Report";
                $getWorkorderPage = Estimate::where('estimate_id', $req->route('id'))->where('work_order', '1')->get();

                $this->Page = $getWorkorderPage;
            }

            if(count($getPart) > 0){
                $this->getPart = $getPart;
            }
            else{
                $this->getPart = "";
            }

            // dd($this->arr_ip);

        return view('pages.techniciandetail')->with(['pages' => 'Technician Detail', 'getEstPage' => $this->Page, 'getPart' => $this->getPart, 'heading' => $this->heading, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }


    public function invoicereport(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }

            $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', Auth::user()->busID)->get();

            if(count($discountcharge) > 0){
                $this->discount = $discountcharge[0]->percent;
            }
            else{
                // Get Admin Discount
                $getDiscount = MinimumDiscount::where('discount', 'discount')->get();

                $this->discount = $getDiscount[0]->percent;
            }
        }
                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        

            $getInvpage = Vehicleinfo::where('estimate_id', $req->route('id'))->get();

            if(count($getInvpage) > 0){
                $this->invPage = $getInvpage;
            }
            else{
                $this->invPage = "";
            }




        return view('pages.invoicereport')->with(['pages' => 'Invoice', 'getInvpage' => $this->invPage, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify, 'discountcharge' => $this->discount]);

    }


    public function clientbalance(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        

            $getclientbalpage = Vehicleinfo::where('estimate_id', $req->route('id'))->where('busID', Auth::user()->busID)->where('update_by', Auth::user()->station_name)->get();

            if(count($getclientbalpage) > 0){
                $this->invPage = $getclientbalpage;
            }
            else{
                $this->invPage = "";
            }


        return view('pages.clientbalance')->with(['pages' => 'Payment Receipt', 'getclientpage' => $this->invPage, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }


    public function labourbalance(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        

            $getlabourbalpage = Estimate::where('estimate_id', $req->route('id'))->where('busID', Auth::user()->busID)->where('update_by', Auth::user()->station_name)->get();

            if(count($getlabourbalpage) > 0){
                $this->invPage = $getlabourbalpage;
            }
            else{
                $this->invPage = "";
            }


        return view('pages.labourbalance')->with(['pages' => 'Work Order', 'getlabourpage' => $this->invPage, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }

    public function cashbalance(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        

                $cashBals1 = DB::table('receive_payment')
                         ->select(DB::raw('SUM(cash_payment_amount) as total'))
                         ->where('busID', Auth::user()->busID)
                         ->get();
            $cashBals2 = DB::table('purchase_order_payment')
                         ->select(DB::raw('SUM(pay_cashamount) as total_cash'))
                         ->where('busID', Auth::user()->busID)
                         ->get();

            $cashBals3 = DB::table('vehicleinfo')
                         ->select(DB::raw('SUM(total_cost) as vehiclepay_total'))
                         ->where('busID', Auth::user()->busID)
                         ->get();

                     $cashBals = array_merge($cashBals1->toArray(), $cashBals2->toArray(), $cashBals3->toArray());


            if($cashBals > 0){
                $this->invPage = $cashBals;
            }
            else{
                $this->invPage = 0;
            }


        return view('pages.cashbalance')->with(['pages' => 'Cash Balance', 'cashBals' => $this->invPage, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }


    public function creditcardbalance(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();
        

                $creditcardBals1 = DB::table('receive_payment')
                     ->select(DB::raw('SUM(creditcard_amount) as total'))
                     ->where('busID', Auth::user()->busID)
                     ->get();
        $creditcardBals2 = DB::table('purchase_order_payment')
                     ->select(DB::raw('SUM(pay_cardamount) as total_cash'))
                     ->where('busID', Auth::user()->busID)
                     ->get();

        $creditcardBals3 = DB::table('vehicleinfo')
                     ->select(DB::raw('SUM(total_cost) as vehiclepay_total'))
                     ->where('busID', Auth::user()->busID)
                     ->get();

                     $creditcardBals = array_merge($creditcardBals1->toArray(), $creditcardBals2->toArray(), $creditcardBals3->toArray());


            if($creditcardBals > 0){
                $this->invPage = $creditcardBals;
            }
            else{
                $this->invPage = 0;
            }


        return view('pages.creditcardbalance')->with(['pages' => 'Credit Card Balance', 'creditcardBals' => $this->invPage, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }


    public function bankbalance(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        

                $bankBals1 = DB::table('receive_payment')
                     ->select(DB::raw('SUM(cheque_amount) as total'))
                     ->where('busID', Auth::user()->busID)
                     ->get();
        $bankBals2 = DB::table('purchase_order_payment')
                     ->select(DB::raw('SUM(pay_chequeamount) as total_cash'))
                     ->where('busID', Auth::user()->busID)
                     ->get();

        $bankBals3 = DB::table('vehicleinfo')
                     ->select(DB::raw('SUM(total_cost) as vehiclepay_total'))
                     ->where('busID', Auth::user()->busID)
                     ->get();

                $bankBals = array_merge($bankBals1->toArray(), $bankBals2->toArray(), $bankBals3->toArray());


            if($bankBals > 0){
                $this->invPage = $bankBals;
            }
            else{
                $this->invPage = 0;
            }


        return view('pages.bankBals')->with(['pages' => 'Bank Balance', 'bankBals' => $this->invPage, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }


    public function purchaseprint(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        

            $getpoPayment = PurchaseOrderPayment::where('post_id', $req->route('id'))->where('busID', Auth::user()->busID)->get();

            if(count($getpoPayment) > 0){
                $this->invPage = $getpoPayment;
            }
            else{
                $this->invPage = "";
            }


        return view('pages.purchaseprint')->with(['pages' => 'Purchase Order Payment', 'getpoPayment' => $this->invPage, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }


    public function Paystubmail(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        

            $getpaysched = PaySchedule::where('estimate_id', $req->route('id'))->where('busID', Auth::user()->busID)->get();

            if(count($getpaysched) > 0){
                $this->invPage = $getpaysched;
            }
            else{
                $getlabpayment = LabourPaystub::where('estimate_id', $req->route('id'))->where('busID', Auth::user()->busID)->get();

                if(count($getlabpayment) > 0){
                    $this->invPage = $getlabpayment;
                }
                else{
                    $this->invPage = "";
                }
            }


        return view('pages.Paystubmail')->with(['pages' => 'Labour Payment', 'labourspay' => $this->invPage, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }

    public function technicianreport(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        

            $gettechscheds = PaySchedule::where('estimate_id', $req->route('id'))->where('busID', Auth::user()->busID)->where('pay_stub', '0')->get();

            if(count($gettechscheds) > 0){
                $this->invPage = $gettechscheds;
            }
            else{
                $gettechschedstub = PaySchedule::where('estimate_id', $req->route('id'))->where('busID', Auth::user()->busID)->where('pay_stub', '1')->get();

                if(count($gettechschedstub) > 0){
                    $this->invPage = $gettechschedstub;
                }
                else{
                    $this->invPage = "";
                }
            }


        return view('pages.technicianreport')->with(['pages' => 'Technician Report', 'technicianreport' => $this->invPage, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }


    public function technicianpaidreport(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        

            $getpayreport = LabourPaystub::where('estimate_id', $req->route('id'))->where('busID', Auth::user()->busID)->where('pay_stub', '2')->get();

            if(count($getpayreport) > 0){
                $this->invPage = $getpayreport;
            }
            else{
                $this->invPage = "";
            }


        return view('pages.technicianpaidreport')->with(['pages' => 'Technician Payment Report', 'techpayStub' => $this->invPage, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }


    public function vendpaymentreport(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        

            $getVendpage = PurchaseOrderPayment::where('post_id', $req->route('id'))->get();

            if(count($getVendpage) > 0){
                $this->invPage = $getVendpage;
            }
            else{
                $this->invPage = "";
            }


        return view('pages.vendorinvoice')->with(['pages' => 'Vendor Invoice', 'getVendpage' => $this->invPage, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }


    public function vendunpaidreport(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        

            $getVendunpaidpage = PurchaseOrder::where('post_id', $req->route('id'))->get();

            if(count($getVendunpaidpage) > 0){
                $this->invPage = $getVendunpaidpage;
            }
            else{
                $this->invPage = "";
            }


        return view('pages.vendunpaidreport')->with(['pages' => 'Vendor Invoice', 'getunpaidVendpage' => $this->invPage, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }

    public function purchaseorderhistory(Request $req){

        if(Auth::user()){
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();

        

            $getPOPage = PurchaseOrder::where('post_id', $req->route('id'))->get();

            if(count($getPOPage) > 0){
                $this->Page = $getPOPage;
            }
            else{
                $this->Page = 0;
            }


        return view('pages.PurchaseOrderHistory')->with(['pages' => 'Purchase Order', 'getPOPage' => $this->Page, 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);

    }


    // Payment Page
    public function makepay(Request $req)
    {
        if(Auth::user()){

        $busInfo = $this->clientinfo();
            // GEt Transaction ID for user
            $this->transID = PayPlan::where('transaction_id', $req->route('id'))->get();

            
            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
        else{
            $this->transID = '';
        }

                // Get Client Info
        $notify = $this->notify();
        $busInfo = $this->clientinfo();


        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Making A Payment');
        return view('pages.makepay')->with(['pages' => 'Payment', 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'transaction' => $this->transID, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest, 'notify' => $notify]);
    }



    public function ajaxnewvehicle(Request $req){

        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Added New Vehicle Maintenance');

        // $this->onesignal('Vehicle Inspection & Maintenance', 'Licence/Reg No '.$req->vehicle_licence.' has a '.$req->service_option.' which was recoded by '.$req->update_by.'. Click now to register your vehicle, keep track of your maintenance.', 'Record Maintenance');

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

            // $path = $req->file('file')->move(public_path('/uploads/'), $fileNameToStore);

            $path = $req->file('file')->move(public_path('../../uploads/'), $fileNameToStore);

                                // Check if exist
                $addreceiptPoints = Points::where('email', Auth::user()->email)->get();

                if(count($addreceiptPoints) > 0){
                    $weekreceiptPoint = $addreceiptPoints[0]->weekly_point + 5;
                    $allreceiptPoint = $addreceiptPoints[0]->alltime_point + $weekreceiptPoint;
                    $point = Points::where('email', Auth::user()->email)->update(['weekly_point' => $weekreceiptPoint, 'alltime_point' => $allreceiptPoint, 'global_point' => $allreceiptPoint, 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                    $this->activities(Auth::user()->ref_code, 'You current earned point is: '.$allreceiptPoint);


                }
                else{
                    // Insert
                    $inspoint = Points::insert(['name' => Auth::user()->name, 'email' => Auth::user()->email, 'weekly_point' => '5', 'alltime_point' => '5', 'global_point' => '5', 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                    $this->activities(Auth::user()->ref_code, 'You just earned 5 point');

                }


        }
        else
        {
            $fileNameToStore = 'noImage.png';
        }
        // Insert new record

        Vehicleinfo::insert(['email' => $req->email, 'telephone' => $req->telephone, 'busID' => $req->busID, 'vehicle_licence' => $req->vehicle_licence, 'make' => $req->make, 'model' => $req->model, 'date' => $req->date, 'service_type' => $req->service_type, 'service_option' => $req->service_option, 'service_item_spec' => $req->service_item_spec, 'manufacturer' => $req->manufacturer, 'material_qty' => $req->material_qty, 'material_cost' => $req->material_cost, 'labour_qty' => $req->labour_qty, 'labour_cost' => $req->labour_cost,'material_qty2' => $req->material_qty2,'material_qty3' => $req->material_qty3,'labour_qty2' => $req->labour_qty2,'material_cost2' => $req->material_cost2,'material_cost3' => $req->material_cost3,'labour_cost2' => $req->labour_cost2, 'manufacturer2' => $req->manufacturer2, 'manufacturer3' => $req->manufacturer3, 'service_item_spec2' => $req->service_item_spec2, 'service_item_spec3' => $req->service_item_spec3, 'other_qty' => $req->other_qty, 'other_cost' => $req->other_cost, 'total_cost' => $req->total_cost, 'service_note' => $req->service_note, 'mileage' => $req->mileage, 'file' => $fileNameToStore, 'update_by' => $req->update_by]);

        if($req->update_by != Auth::user()->name){
            $getname = User::where('email', $req->email)->get();
            if(count($getname) > 0){
                $this->name = $getname[0]->name;
            }
            else{
                $this->name = "from VIM File";
            }

            $this->to = $req->email;
            // $this->to = "info@vimfile.com";
            $this->from = $req->update_by;
            $this->licence = $req->vehicle_licence;
            $this->content1 = 'Service Option: '.$req->service_option;
            $this->content2 = 'Service Type: '.$req->service_type;
            $this->content3 = 'Total Cost: '.$req->total_cost;

            $this->sendEmail($this->to, 'VIM File - New Maintenace Record');
        }

            // Check if exist
            $addnewPoints = Points::where('email', Auth::user()->email)->get();

            if(count($addnewPoints) > 0){
                $weeknewPoint = $addnewPoints[0]->weekly_point + 10;
                $allnewPoint = $addnewPoints[0]->alltime_point + $weeknewPoint;
                $point = Points::where('email', Auth::user()->email)->update(['weekly_point' => $weeknewPoint, 'alltime_point' => $allnewPoint, 'global_point' => $allnewPoint, 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                $this->activities(Auth::user()->ref_code, 'You current earned point is: '.$allnewPoint);


            }
            else{
                // Insert
                $inspoint = Points::insert(['name' => Auth::user()->name, 'email' => Auth::user()->email, 'weekly_point' => '10', 'alltime_point' => '10', 'global_point' => '10', 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                $this->notifications(Auth::user()->ref_code, 'You just earned 10 point', 'https://i.ya-webdesign.com/images/notification-bell-gif-png-youtube.png');

            }


        $resData = ['res' => 'Added', 'message' => 'success', 'link' => 'userDashboard'];

            return $this->returnJSON($resData);
    }

    public function ajaxcarrecord(Request $req){
        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Added New Vehicle Record');

        $this->onesignal('Vehicle Inspection & Maintenance', 'Recent Activity Alert: A vehicle with Licence/Reg No: '.$req->vehicle_reg_no.' has just been added on vimfile.com. Open an account TODAY.', 'Record Vehicle');


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

            // $path = $req->file('file')->move(public_path('/uploads/'), $fileNameToStore);

            $path = $req->file('file')->move(public_path('../../uploads/'), $fileNameToStore);

        }
        else
        {
            $fileNameToStore = 'noImage.png';
        }
        // Inseert new record


        // Check if car licence already exist
        $getLicence = Carrecord::where('vehicle_reg_no', $req->vehicle_reg_no)->get();

        if(count($getLicence) > 0){
            $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Car Already Exists');
            // Already Exist
        $resData = ['res' => 'Car Already in Database', 'message' => 'success', 'link' => 'userDashboard?c=maintenance'];


        }else{

            $getParent = Carrecord::where('parentKey', $req->parentKey)->get();

            if(count($getParent) > 0){

                $userPlan = User::where('email', $getParent[0]->email)->get();

                if($userPlan[0]->plan != 'Free'){
                    if(null != $getParent[0]->parentKey || $getParent[0]->parentKey != ""){
                     // Insert
                    Carrecord::insert(['email' => $req->email, 'telephone' => $req->telephone, 'parentKey' => $req->parentKey, 'child_of_parent' => $req->parentKey, 'no_of_vehicle' => $req->no_of_vehicle, 'vehicle_nickname' => $req->vehicle_nickname, 'date_added' => $req->date_added, 'make' => $req->vehicle_make, 'model' => $req->model, 'vehicle_reg_no' => $req->vehicle_reg_no, 'city' => $req->city, 'state' => $req->state, 'country_of_reg' => $req->country_of_reg, 'zipcode' => $req->zipcode, 'purchase_type' => $req->purchase_type, 'year_owned_since' => $req->year_owned_since, 'current_mileage' => $req->current_mileage, 'file' => $fileNameToStore, 'busID' => $req->busID]);



                    if(Auth::user()->userType == "Auto Dealer"){
                        if($req->firstname != "" || $req->lastname != "" || $req->password != ""){
                            // Check User if eXist
                            $_CheckExistUser = User::where('email', $req->email)->get();

                            if(count($_CheckExistUser) > 0){
                                $resData = ['res' => 'This user account already exist', 'message' => 'info'];
                            }
                            else{
                                // Insert New user Record
                                $_NewUser = User::insert(['name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => 'Individual', 'phone_number' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country_of_reg, 'zipcode' => $req->zipcode, 'busID' => $req->busID, 'station_name' => Auth::user()->station_name, 'plan' => Auth::user()->plan, 'status' => '1', 'referred_by' => Auth::user()->ref_code]);
                            }
                        }

                    }


                    $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Has registered a car with the same family');

                    $this->notifications(Auth::user()->ref_code, 'You have registered a vehicle with licence '.$req->vehicle_reg_no, 'https://image.flaticon.com/icons/png/512/2080/2080904.png');

                    }
                }
                else{
                    $resData = ['res' => 'You have to upgrade your account. Check Pricing', 'message' => 'success', 'link' => 'pricing'];
                }


            }else{


            if(Auth::user()->userType == "Auto Dealer"){
                        if($req->firstname != "" || $req->lastname != "" || $req->password != ""){
                            // Check User if eXist
                            $_CheckExistUser = User::where('email', $req->email)->get();

                            if(count($_CheckExistUser) > 0){
                                $resData = ['res' => 'This user account already exist', 'message' => 'info'];
                            }
                            else{
                                // Insert
                                Carrecord::insert(['email' => $req->email, 'telephone' => $req->telephone, 'parentKey' => $req->parentKey, 'child_of_parent' => '', 'no_of_vehicle' => $req->no_of_vehicle, 'vehicle_nickname' => $req->vehicle_nickname, 'date_added' => $req->date_added, 'make' => $req->vehicle_make, 'model' => $req->model, 'vehicle_reg_no' => $req->vehicle_reg_no, 'city' => $req->city, 'state' => $req->state, 'country_of_reg' => $req->country_of_reg, 'zipcode' => $req->zipcode, 'purchase_type' => $req->purchase_type, 'year_owned_since' => $req->year_owned_since, 'current_mileage' => $req->current_mileage, 'file' => $fileNameToStore, 'busID' => $req->busID]);

                                // Insert New user Record
                                $_NewUser = User::insert(['name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => 'Individual', 'phone_number' => $req->telephone, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country_of_reg, 'zipcode' => $req->zipcode, 'busID' => $req->busID, 'station_name' => Auth::user()->station_name, 'plan' => Auth::user()->plan, 'status' => '1', 'referred_by' => Auth::user()->ref_code]);
                            }
                        }

            }
            else{
                // Insert
            Carrecord::insert(['email' => $req->email, 'telephone' => $req->telephone, 'parentKey' => $req->parentKey, 'child_of_parent' => '', 'no_of_vehicle' => $req->no_of_vehicle, 'vehicle_nickname' => $req->vehicle_nickname, 'date_added' => $req->date_added, 'make' => $req->vehicle_make, 'model' => $req->model, 'vehicle_reg_no' => $req->vehicle_reg_no, 'city' => $req->city, 'state' => $req->state, 'country_of_reg' => $req->country_of_reg, 'zipcode' => $req->zipcode, 'purchase_type' => $req->purchase_type, 'year_owned_since' => $req->year_owned_since, 'current_mileage' => $req->current_mileage, 'file' => $fileNameToStore, 'busID' => $req->busID]);
            }


                if($req->email != Auth::user()->email){
                    $getname = User::where('email', $req->email)->get();
                    $getstation = User::where('id', Auth::user()->id)->get();
                    if(count($getname) > 0){
                        $this->name = $getname[0]->name;
                    }
                    else{
                        $this->name = "from VIM File";
                    }

                    $this->to = $req->email;
                    // $this->to = "info@vimfile.com";
                    $this->from = $getstation[0]->station_name;
                    $this->licence = $req->vehicle_reg_no;
                    $this->sendEmail($this->to, 'VIM File - New Vehicle Registration');
                }


                // Check if exist
                $addregnewPoints = Points::where('email', Auth::user()->email)->get();

                if(count($addregnewPoints) > 0){
                    $weekregnewPoint = $addregnewPoints[0]->weekly_point + 10;
                    $allregnewPoint = $addregnewPoints[0]->alltime_point + $weekregnewPoint;
                    $point = Points::where('email', Auth::user()->email)->update(['weekly_point' => $weekregnewPoint, 'alltime_point' => $allregnewPoint, 'global_point' => $allregnewPoint, 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                    $this->notifications(Auth::user()->ref_code, 'You have registered a new vehicle record with licence '.$req->vehicle_reg_no. ' and received '.$allregnewPoint.' points', 'https://image.flaticon.com/icons/png/512/2080/2080904.png');

                }
                else{
                    // Insert
                    $inspoint = Points::insert(['name' => Auth::user()->name, 'email' => Auth::user()->email, 'weekly_point' => '10', 'alltime_point' => '10', 'global_point' => '10', 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                    $this->notifications(Auth::user()->ref_code, 'You have registered a new vehicle record with licence '.$req->vehicle_reg_no. ' and received 10 points', 'https://image.flaticon.com/icons/png/512/2080/2080904.png');

                }

            }



        $resData = ['res' => 'New Record Added', 'message' => 'success', 'link' => 'userDashboard?c=maintenance'];
        }
            return $this->returnJSON($resData);
    }

    public function ajaxadditionalemail(Request $req){


        // Get exact user
        $getUser = User::where('email', $req->email)->get();

        if(count($getUser) > 0){
            // Update Record
            User::where('email', $req->email)->update(['email1' => $req->email1, 'email2' => $req->email2, 'email3' => $req->email3]);

            $getRem = reminderNotify::where('email', $req->email)->get();
            if(count($getRem) > 0){
                reminderNotify::where('email', $req->email)->update(['email1' => $req->email1, 'email2' => $req->email2, 'email3' => $req->email3]);

                $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Addtional Emails Updated as '.$req->email1.', '.$req->email2.', '.$req->email3);
            }
            else{
                reminderNotify::insert(['email' => $req->email,'email1' => $req->email1, 'email2' => $req->email2, 'email3' => $req->email3]);

                $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Addtional Emails Added as '.$req->email1.', '.$req->email2.', '.$req->email3);

                $this->notifications(Auth::user()->ref_code, 'Additional emails added to your account', 'https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-email-512.png');
            }

            $resData = ['res' => 'Data Updated', 'message' => 'success'];
        }
        else{
            $resData = ['res' => 'No record found', 'message' => 'error'];
        }

        return $this->returnJSON($resData);
    }

    public function ajaxremindersettings(Request $req){
        // Check if reminder exists on system
        $getNotify = reminderNotify::where('email', $req->pryemail)->get();

        if(count($getNotify) > 0){
            $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Reminder Settings Updated');

            reminderNotify::where('email', $req->pryemail)->update(['oilchange' => $req->notifyoil, 'tirerotation' => $req->notifytyre, 'airfilter' => $req->notifyair, 'inspection' => $req->notifyinspect, 'registration' => $req->notifyregister]);


            // Check if exist
                $addremPoints = Points::where('email', Auth::user()->email)->get();

                if(count($addremPoints) > 0){
                    $weekremPoint = $addremPoints[0]->weekly_point + 5;
                    $allremPoint = $addremPoints[0]->alltime_point + $weekremPoint;
                    $point = Points::where('email', Auth::user()->email)->update(['weekly_point' => $weekremPoint, 'alltime_point' => $allremPoint, 'global_point' => $allremPoint, 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                    $this->notifications(Auth::user()->ref_code, 'You have updated reminder settings and you have '.$allremPoint.' points', 'https://img.icons8.com/plasticine/2x/approve-and-update.png');


                }
                else{
                    // Insert
                    $inspoint = Points::insert(['name' => Auth::user()->name, 'email' => Auth::user()->email, 'weekly_point' => '5', 'alltime_point' => '5', 'global_point' => '5', 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                    $this->notifications(Auth::user()->ref_code, 'You have updated reminder settings and you have 5 points', 'https://img.icons8.com/plasticine/2x/approve-and-update.png');

                }

            $resData = ['res' => 'Reminder Updated', 'message' => 'success'];


        }
        else{

                        // Check if exist
                $addremPoints = Points::where('email', Auth::user()->email)->get();

                if(count($addremPoints) > 0){

                    $weekremPoint = $addremPoints[0]->weekly_point + 5;
                    $allremPoint = $addremPoints[0]->alltime_point + $weekremPoint;
                    $point = Points::where('email', Auth::user()->email)->update(['weekly_point' => $weekremPoint, 'alltime_point' => $allremPoint, 'global_point' => $allremPoint, 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                    $this->notifications(Auth::user()->ref_code, 'You have updated reminder settings and you have '.$allremPoint.' points', 'https://img.icons8.com/plasticine/2x/approve-and-update.png');


                }
                else{
                    // Insert
                    $inspoint = Points::insert(['name' => Auth::user()->name, 'email' => Auth::user()->email, 'weekly_point' => '5', 'alltime_point' => '5', 'global_point' => '5', 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                    $this->notifications(Auth::user()->ref_code, 'You have updated reminder settings and you have 5 points', 'https://img.icons8.com/plasticine/2x/approve-and-update.png');

                }

            reminderNotify::insert(['email' => $req->pryemail, 'oilchange' => $req->notifyoil, 'tirerotation' => $req->notifytyre, 'airfilter' => $req->notifyair, 'inspection' => $req->notifyinspect, 'registration' => $req->notifyregister]);
            $resData = ['res' => 'Reminder Added', 'message' => 'success'];

            $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Reminder Settings Added');
        }

        return $this->returnJSON($resData);
    }

    public function ajaxreminderbussettings(Request $req){
        // Check if reminder exists on system
        $getmail = reminderNotify::where('email', $req->majoremail)->get();

        if(count($getmail) > 0){
            // Check for add emails exist
            $mail1 = reminderNotify::where('email1', $req->majoremail1)->get();
            $mail2 = reminderNotify::where('email2', $req->majoremail2)->get();
            $mail3 = reminderNotify::where('email3', $req->majoremail3)->get();
            if(count($mail1) > 0 && count($mail2) > 0 && count($mail3) > 0){
                $resData = ['res' => 'Email Already Exists', 'message' => 'error'];
            }
            else{
                // Update Field


                reminderNotify::where('email', $req->majoremail)->update(['email1' => $req->majoremail1, 'email2' => $req->majoremail2, 'email3' => $req->majoremail3]);

                // Send Mail
                $getusersmail = User::where('email', $req->majoremail)->get();
                $this->name = $getusersmail[0]->name;
                $this->sender = Auth::user()->station_name;
                $this->content1 = $req->majoremail1;
                $this->content2 = $req->majoremail2;
                $this->content3 = $req->majoremail3;
                $this->to = $req->majoremail;
                // $this->to = "info@vimfile.com";

                $this->sendEmail($this->to, 'VIM File - Additional Email Update');

                $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Additional Email Updated by Station '.Auth::user()->station_name.' for '.$req->majoremail);

                $resData = ['res' => 'Updated Successfully', 'message' => 'success', 'link' => 'userDashboard'];
            }

        }
        else{
            // Insert
            $getusersmail = User::where('email', $req->majoremail)->get();

            reminderNotify::insert(['email' => $req->majoremail, 'email1' => $req->majoremail1, 'email2' => $req->majoremail2, 'email3' => $req->majoremail3]);

            // Send Mail


            $this->name = $getusersmail[0]->name;
            $this->sender = Auth::user()->station_name;
            $this->content1 = $req->majoremail1;
            $this->content2 = $req->majoremail2;
            $this->content3 = $req->majoremail3;
            $this->to = $req->majoremail;
            // $this->to = "info@vimfile.com";

            $this->sendEmail($this->to, 'VIM File - Additional Email Update');



            $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Additional Email Added by Station '.Auth::user()->station_name.' for '.$req->majoremail);

                $resData = ['res' => 'Emails Added', 'message' => 'success', 'link' => 'userDashboard'];
        }

        return $this->returnJSON($resData);
    }


    public function ajaxvehiclesettings(Request $req){
        $getVeh = Carrecord::where('vehicle_reg_no', $req->vehicle_reg_nosss)->get();

        if(count($getVeh) > 0){
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

                // $path = $req->file('file')->move(public_path('/uploads/'), $fileNameToStore);

                $path = $req->file('file')->move(public_path('../../uploads/'), $fileNameToStore);

            }
            // Update Car details

            Carrecord::where('vehicle_reg_no', $req->vehicle_reg_nosss)->update(['chassis_no' => $req->chassiss_no, 'location' => $req->locationss, 'file' => $fileNameToStore]);

            Vehicleinfo::where('vehicle_licence', $req->vehicle_reg_nosss)->update(['chassis_no' => $req->chassiss_no, 'location' => $req->locationss]);

            $resData = ['res' => 'Saved', 'message' => 'success'];

            $this->notifications(Auth::user()->ref_code, 'You added your vehicle information', 'https://img.icons8.com/cotton/2x/add.png');

            $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Added Vehicle Info');
        }
        else{
            $resData = ['res' => 'Something went wrong', 'message' => 'error'];
        }

        return $this->returnJSON($resData);
    }

    public function ajaxaddreminderbussettings(Request $req){
        // Check if reminder exists on system
        $getNotify = reminderNotify::where('email', $req->remEmail)->get();

        if(count($getNotify) > 0){
            reminderNotify::where('email', $req->remEmail)->update(['oilchange' => $req->notifyoil, 'tirerotation' => $req->notifytyre, 'airfilter' => $req->notifyair, 'inspection' => $req->notifyinspect, 'registration' => $req->notifyregister]);


            $resData = ['res' => 'Reminder Updated', 'message' => 'success', 'link' => 'userDashboard'];

            $getusersmail = User::where('email', $req->remEmail)->get();
            $this->name = $getusersmail[0]->name;
            $this->sender = Auth::user()->station_name;
            $this->content1 = 'Oil Change: '.$req->notifyoil;
            $this->content2 = 'Tyre Rotation: '.$req->notifytyre;
            $this->content3 = 'Air Filter : '.$req->notifyair;
            $this->content4 = 'Inspection: '.$req->notifyinspect;
            $this->content5 = 'Registration: '.$req->notifyregister;
            $this->to = $req->remEmail;
            // $this->to = "info@vimfile.com";

            $this->sendEmail($this->to, 'VIM File - Reminder Settings Update');


           $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Reminder Settings Updated by Station '.Auth::user()->station_name.' for '.$req->remEmail);

           $this->notifications(Auth::user()->ref_code, 'Reminder Settings Updated for '.$req->remEmail, 'https://img.icons8.com/plasticine/2x/approve-and-update.png');
        }
        else{
            reminderNotify::insert(['email' => $req->remEmail, 'oilchange' => $req->notifyoil, 'tirerotation' => $req->notifytyre, 'airfilter' => $req->notifyair, 'inspection' => $req->notifyinspect, 'registration' => $req->notifyregister]);

            $resData = ['res' => 'Reminder Added', 'message' => 'success', 'link' => 'userDashboard'];

            $getusersmail = User::where('email', $req->remEmail)->get();
            $this->name = $getusersmail[0]->name;
            $this->sender = Auth::user()->station_name;
            $this->content1 = 'Oil Change: '.$req->notifyoil;
            $this->content2 = 'Tyre Rotation: '.$req->notifytyre;
            $this->content3 = 'Air Filter : '.$req->notifyair;
            $this->content4 = 'Inspection: '.$req->notifyinspect;
            $this->content5 = 'Registration: '.$req->notifyregister;
            $this->to = $req->remEmail;
            // $this->to = "info@vimfile.com";

            $this->sendEmail($this->to, 'VIM File - Reminder Settings Update');

            $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Reminder Settings Added by Station '.Auth::user()->station_name.' for '.$req->remEmail);

            $this->notifications(Auth::user()->ref_code, 'Reminder Settings Updated for '.$req->remEmail, 'https://img.icons8.com/plasticine/2x/approve-and-update.png');
        }

        return $this->returnJSON($resData);
    }


    public function ajaxalertaction(Request $req){

        // Check if User Exist
        $userMail = reminderNotify::where('email', $req->email)->get();

        if(count($userMail) > 0){
            // Update Mail Record
            if($req->action == 'remindermail'){

                reminderNotify::where('email', $req->email)->update(['reminderEmail' => $req->val]);

                $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Reminder Mail updated to '.$req->val);

                $this->notifications(Auth::user()->ref_code, 'Reminder Mail Updated to '.$req->val, 'https://img.icons8.com/plasticine/2x/approve-and-update.png');

                $resData = ['res' => 'Reminder Mail is '.$req->val, 'message' => 'Success'];
            }
            elseif ($req->action == 'dealmail') {
                reminderNotify::where('email', $req->email)->update(['dealEmail' => $req->val]);
                $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Deal Mail updated to '.$req->val);

                $resData = ['res' => 'Deal Mail is '.$req->val, 'message' => 'Success'];

                $this->notifications(Auth::user()->ref_code, 'Deal Mail Updated to '.$req->val, 'https://img.icons8.com/plasticine/2x/approve-and-update.png');

            }
            elseif ($req->action == 'newslettermail') {
                reminderNotify::where('email', $req->email)->update(['newsletterEmail' => $req->val]);
                $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Newsletter Mail updated to '.$req->val);

                $resData = ['res' => 'Newsletter Mail is '.$req->val, 'message' => 'Success'];
                $this->notifications(Auth::user()->ref_code, 'Newsletter Mail Updated to '.$req->val, 'https://img.icons8.com/plasticine/2x/approve-and-update.png');
            }
        }
        else{
            // Insert New User

            if($req->action == 'remindermail'){
                reminderNotify::insert(['email' => $req->email, 'reminderEmail' => $req->val]);

                $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Reminder Mail Set to '.$req->val);

                $this->notifications(Auth::user()->ref_code, 'Reminder Mail Set to '.$req->val, 'https://img.icons8.com/cotton/2x/add.png');

                $resData = ['res' => 'Reminder Mail is '.$req->val, 'message' => 'Success'];
            }
            elseif ($req->action == 'dealmail') {
                reminderNotify::insert(['email' => $req->email, 'dealEmail' => $req->val]);

                $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Deal Mail Set to '.$req->val);

                $this->notifications(Auth::user()->ref_code, 'Deal Mail Set to '.$req->val, 'https://img.icons8.com/cotton/2x/add.png');

                $resData = ['res' => 'Deal Mail is '.$req->val, 'message' => 'Success'];
            }
            elseif ($req->action == 'newslettermail') {
                reminderNotify::insert(['email' => $req->email, 'newsletterEmail' => $req->val]);

                $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Newsletter Mail Set to '.$req->val);

                $this->notifications(Auth::user()->ref_code, 'Newsletter Mail Set to '.$req->val, 'https://img.icons8.com/cotton/2x/add.png');

                $resData = ['res' => 'Newsletter Mail is '.$req->val, 'message' => 'Success'];
            }
        }

        return $this->returnJSON($resData);
    }



    // Auto Care Search
    public function ajaxautocare(Request $req){
        // Get Search text by city
        $getAutocare = Stations::where('city', 'LIKE', '%'.$req->auto_care.'%')->get();

        if(count($getAutocare) > 0){

            if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Technician" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Commercial"){


                if(Auth::user()->country == $getAutocare[0]->country){
                    $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Searched for Auto Care Centers '.$req->auto_care);

            // Check if exist
                $addingPoints = Points::where('email', Auth::user()->email)->get();

                if(count($addingPoints) > 0){
                    $weekingPoint = $addingPoints[0]->weekly_point + 5;
                    $allingPoint = $addingPoints[0]->alltime_point + $weekingPoint;
                    $point = Points::where('email', Auth::user()->email)->update(['weekly_point' => $weekingPoint, 'alltime_point' => $allingPoint, 'global_point' => $allingPoint, 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                    $this->notifications(Auth::user()->ref_code, 'You now have '.$allingPoint.' points', 'https://i.ya-webdesign.com/images/notification-bell-gif-png-youtube.png');


                }
                else{
                    // Insert
                    $inspoint = Points::insert(['name' => Auth::user()->name, 'email' => Auth::user()->email, 'weekly_point' => '5', 'alltime_point' => '5', 'global_point' => '5', 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                    $this->notifications(Auth::user()->ref_code, 'You now have 5 points', 'https://i.ya-webdesign.com/images/notification-bell-gif-png-youtube.png');

                }

                // Send Mass Mail here
                foreach ($getAutocare as $key) {
                    // Get Email
                    $busid = $key['busID'];
                    $getemailuser = Business::where('busID', $busid)->get();

                    if(count($getemailuser) > 0){
                        // Send Mail
                        $this->to = $getemailuser[0]->email;
                        // $this->to = "info@vimfile.com";
                        $this->company = $getemailuser[0]->name_of_company;
                        $this->sender = Auth::user()->name;
                        $this->city = Auth::user()->city;
                        $this->state = Auth::user()->state;
                        $this->country = Auth::user()->country;

                        $this->sendEmail($this->to, 'VIM File - Search Appearance');
                    }

                }


                $resData = ['res' => 'Success', 'message' => 'success', 'data' => json_encode($getAutocare), 'link' => 'Search/'.$req->auto_care];
                }

                else{
                    $resData = ['res' => 'Not within the resident country', 'message' => 'info'];
                }


            }


        }
        else{
            $getAutocenters = Business::where('city', 'LIKE', '%'.$req->auto_care.'%')->get();

                    if(count($getAutocenters) > 0){
                        if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Technician" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Commercial"){

                            if(Auth::user()->country == $getAutocenters[0]->country){
                                $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Searched for Auto Care Centers '.$req->auto_care);

            // Check if exist
                $addingPoints = Points::where('email', Auth::user()->email)->get();

                if(count($addingPoints) > 0){
                    $weekingPoint = $addingPoints[0]->weekly_point + 5;
                    $allingPoint = $addingPoints[0]->alltime_point + $weekingPoint;
                    $point = Points::where('email', Auth::user()->email)->update(['weekly_point' => $weekingPoint, 'alltime_point' => $allingPoint, 'global_point' => $allingPoint, 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                    $this->notifications(Auth::user()->ref_code, 'You now have '.$allingPoint.' points', 'https://i.ya-webdesign.com/images/notification-bell-gif-png-youtube.png');

                }
                else{
                    // Insert
                    $inspoint = Points::insert(['name' => Auth::user()->name, 'email' => Auth::user()->email, 'weekly_point' => '5', 'alltime_point' => '5', 'global_point' => '5', 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                    $this->notifications(Auth::user()->ref_code, 'You now have 5 points', 'https://i.ya-webdesign.com/images/notification-bell-gif-png-youtube.png');

                }

                foreach ($getAutocenters as $key) {
                    // Get Email
                    $email = explode(", ", $key['email']);
                    // Send Mail
                    $this->to = $email[0];
                    // $this->to = "info@vimfile.com";
                    $this->company = $key['name_of_company'];
                    $this->sender = Auth::user()->name;
                    $this->city = Auth::user()->city;
                    $this->state = Auth::user()->state;
                    $this->country = Auth::user()->country;

                    $this->sendEmail($this->to, 'VIM File - Search Appearance');
                }


            $resData = ['res' => 'Success', 'message' => 'success', 'data' => json_encode($getAutocenters), 'link' => 'Search/'.$req->auto_care];
                            }
                            else{
                                $resData = ['res' => 'Not within the resident country', 'message' => 'info'];
                            }
                        }

        }

        else{
            $resData = ['res' => 'Record not found', 'message' => 'info'];
        }


        }

         return $this->returnJSON($resData);
    }


    public function otherSearch(Request $req){
        // Get Search text by city
        $getAutocare = Stations::where('city', 'LIKE', '%'.$req->auto_care.'%')->get();

        if(count($getAutocare) > 0){

            if($this->arr_ip['country'] == $getAutocare[0]->country){
                    // Send Mass Mail here
                    foreach ($getAutocare as $key) {
                        // Get Email
                        $busid = $key['busID'];
                        $getemailuser = Business::where('busID', $busid)->get();

                        if(count($getemailuser) > 0){
                            // Send Mail
                            $this->to = $getemailuser[0]->email;
                            // $this->to = "info@vimfile.com";
                            $this->company = $getemailuser[0]->name_of_company;
                            $this->sender = "Promo User";
                            $this->city = $this->arr_ip['city'];
                            $this->state = $this->arr_ip['state_name'];
                            $this->country = $this->arr_ip['country'];

                            $this->sendEmail($this->to, 'VIM File - Search Appearance');
                        }

                    }

                $resData = ['res' => 'Success', 'message' => 'success', 'data' => json_encode($getAutocare), 'link' => 'Search2/'.$req->auto_care];
            }
            else{
                $resData = ['res' => 'Not within the resident country', 'message' => 'info'];
            }

        }
        else{
            $getAutocenters = Business::where('city', 'LIKE', '%'.$req->auto_care.'%')->get();

            if(count($getAutocenters) > 0){

                if($this->arr_ip['country'] == $getAutocenters[0]->country){

                    foreach ($getAutocenters as $key) {
                    // Get Email
                    $email = explode(", ", $key['email']);
                    // Send Mail
                    $this->to = $email[0];
                    // $this->to = "info@vimfile.com";
                    $this->company = $key['name_of_company'];
                    $this->sender = "Promo User";
                    $this->city = $this->arr_ip['city'];
                    $this->state = $this->arr_ip['state_name'];
                    $this->country = $this->arr_ip['country'];


                    $this->sendEmail($this->to, 'VIM File - Search Appearance');
                    }


                    $resData = ['res' => 'Success', 'message' => 'success', 'data' => json_encode($getAutocenters), 'link' => 'Search2/'.$req->auto_care];

                }
                else{
                    $resData = ['res' => 'Not within the resident country', 'message' => 'info'];
                }

            }

        else{
            $resData = ['res' => 'Record not found', 'message' => 'info'];
        }


        }

         return $this->returnJSON($resData);
    }



    public function ajaxcheckClaims(Request $req){

        // Check user information if registered, if not, direct to sign up to register

        // Else if user has information, take to update profile information, then login

        $checkuser = User::where('station_name', $req->company)->get();


        if(count($checkuser) > 0){
            // check if station exist
            $checkStation = Stations::where('station_name', $checkuser[0]->station_name)->get();

            if(count($checkStation) > 0){
                $resData = ['title' => 'Great!', 'res' => 'Your profile is up to date. Login to account now', 'message' => 'success'];
            }
            else{
                // Update Information
                User::where('station_name', $req->company)->update(['city' => $checkuser[0]->city, 'state' => $checkuser[0]->state, 'country' => $checkuser[0]->country, 'zipcode' => $checkuser[0]->zipcode, 'verified_mechanics' => 0]);

                $resData = ['title' => 'Great!', 'res' => 'We noticed that some of your informations are not complete. You shall be redirected shortly', 'message' => 'success', 'link' => $checkuser[0]->station_name, 'action' => 'claim'];
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
                $ins = User::insert(['busID' => "BW_".mt_rand(00001, 99999), 'userType' => "Auto Care", 'phone_number' => $checkStation[0]->telephone, 'email' => $checkStation[0]->email, 'address' => $checkStation[0]->address, 'city' => $checkStation[0]->city, 'state' => $checkStation[0]->state, 'country' => $checkStation[0]->country, 'zipcode' => $checkStation[0]->zipcode, 'station_name' => $checkStation[0]->name_of_company, 'platform' => "Busy Wrench", 'specialization' => $checkStation[0]->service_offered, 'verified_mechanics' => 0]);

                if($ins == true){

                    $resData = ['title' => 'Great!', 'res' => 'We noticed that some of your informations are not complete. You shall be redirected shortly', 'message' => 'success', 'link' => $checkStation[0]->name_of_company, 'action' => 'claim'];
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
                $ins = User::insert(['busID' => "BW_".mt_rand(00001, 99999), 'userType' => "Auto Care", 'phone_number' => $checkStation[0]->telephone, 'address' => $checkStation[0]->address, 'station_name' => $checkStation[0]->station_name, 'city' => $checkStation[0]->city, 'state' => $checkStation[0]->state, 'country' => $checkStation[0]->country, 'platform' => "Busy Wrench", 'verified_mechanics' => 0]);

                if($ins == true){


                    $action = $checkStation[0]->station_name.' just claimed business';
                    $platform = 'Busy Wrench';
                    $currency = $this->arr_ip['currency'];
                    $city = $this->arr_ip['city'];
                    $country = $this->arr_ip['country'];
                    $ip = $this->arr_ip['ip'];
                    $this->activities($ip, $country, $city, $currency, $action);

                    $resData = ['title' => 'Great!', 'res' => 'We noticed that some of your informations are not complete. You shall be redirected shortly', 'message' => 'success', 'link' => $checkStation[0]->station_name, 'action' => 'claim'];
                }
                else{
                    // Requets to Open An Account
                    $resData = ['title' => 'Oops!', 'res' => 'Something went wrong!', 'message' => 'info'];
                }

            }




        }


        return $this->returnJSON($resData);

    }



    public function ajaxupdateme(Request $req){
            $letter = chr(rand(65,90));
            $ref_code = $letter.mt_rand(1000, 9999);

            $userIns = User::where('email', $req->email)->get();

            if(count($userIns) > 0){
                $resData = ['title' => 'Oops!', 'res' => 'User with this email address already exist', 'message' => 'info'];
            }
            else{

                $update = User::where('email', $req->email)->update(['ref_code' => $ref_code, 'name' => $req->fullname, 'email' => $req->email, 'phone_number' => $req->phone_number, 'address' => $req->station_address, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'station_name' => $req->station_name, 'size_of_employee' => $req->size_of_employee, 'year_of_practice' => $req->year_of_practice, 'mobile' => $req->mobile, 'office' => $req->office, 'year_started_since' => $req->year_started_since, 'mechanical_skill' => $req->mechanical_skill, 'electrical_skill' => $req->electrical_skill, 'transmission_skill' => $req->transmission_skill, 'body_work_skill' => $req->body_work_skill, 'other_skills' => $req->other_skills, 'vimfile_discount' => $req->vimfile_discount, 'repair_guaranteed' => $req->repair_guaranteed, 'free_estimated' => $req->free_estimated, 'walk_in_specified' => $req->walk_in_specified, 'other_value_added' => $req->other_value_added, 'average_waiting' => $req->average_waiting, 'hours_of_operation' => $req->hours_of_operation, 'wifi' => $req->wifi, 'restroom' => $req->restroom, 'lounge' => $req->lounge, 'parking_space' => $req->parking_space, 'year_established' => $req->year_established, 'background' => $req->background, 'other_skills_specify' => $req->other_skills_specify, 'discountPercent' => $req->discountPercent, 'verified_mechanics' => 1, 'unverified_mechanics' => 0]);



                if($update){

                    if(Auth::check() == true){

                        $action = Auth::user()->name.' just updated their profile';
                        $platform = 'Busy Wrench';
                        $currency = $this->arr_ip['currency'];
                        $city = $this->arr_ip['city'];
                        $country = $this->arr_ip['country'];
                        $ip = $this->arr_ip['ip'];
                        $this->activities($ip, $country, $city, $currency, $action);


                        Stations::where('busID', Auth::user()->busID)->update(['station_name' => $req->station_name, 'station_address' => $req->station_address, 'station_phone' => $req->phone_number, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'claim_business' => 1]);


                        // Update Business
                        Business::where('busID', Auth::user()->busID)->update(['claims' => 1]);
                    }
                    else{

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

                        User::where('email', $req->email)->update(['station_name' => $req->station_name]);


                        $this->email = $req->email;
                        // $this->email = "bambo@vimfile.com";
                        $this->file = "";
                        $this->name = $req->station_name;
                        $this->subject = "Profile updated and will be reviewed";
                        $this->message = "Your profile is now updated and will be reviewed. Your login details will be forwarded to you immediately your profile is verified. <br><br>Thanks";

                        $this->sendEmail($this->email, $this->subject);
                    }


                    $resData = ['title' => 'Great!', 'res' => 'Profile updated', 'message' => 'success', 'action' => 'update'];
                }
                else{

                    $update = User::where('station_name', $req->station_name)->update(['ref_code' => $ref_code, 'name' => $req->fullname, 'email' => $req->email, 'phone_number' => $req->phone_number, 'address' => $req->station_address, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country, 'zipcode' => $req->zipcode, 'station_name' => $req->station_name, 'size_of_employee' => $req->size_of_employee, 'year_of_practice' => $req->year_of_practice, 'mobile' => $req->mobile, 'office' => $req->office, 'year_started_since' => $req->year_started_since, 'mechanical_skill' => $req->mechanical_skill, 'electrical_skill' => $req->electrical_skill, 'transmission_skill' => $req->transmission_skill, 'body_work_skill' => $req->body_work_skill, 'other_skills' => $req->other_skills, 'vimfile_discount' => $req->vimfile_discount, 'repair_guaranteed' => $req->repair_guaranteed, 'free_estimated' => $req->free_estimated, 'walk_in_specified' => $req->walk_in_specified, 'other_value_added' => $req->other_value_added, 'average_waiting' => $req->average_waiting, 'hours_of_operation' => $req->hours_of_operation, 'wifi' => $req->wifi, 'restroom' => $req->restroom, 'lounge' => $req->lounge, 'parking_space' => $req->parking_space, 'year_established' => $req->year_established, 'background' => $req->background, 'other_skills_specify' => $req->other_skills_specify, 'discountPercent' => $req->discountPercent, 'verified_mechanics' => 1, 'unverified_mechanics' => 0]);

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

                        User::where('station_name', $req->station_name)->update(['station_name' => $req->station_name]);


                        $this->email = $req->email;
                        // $this->email = "bambo@vimfile.com";
                        $this->file = "";
                        $this->name = $req->station_name;
                        $this->subject = "Profile updated and will be reviewed";
                        $this->message = "Your profile is now updated and will be reviewed. Your login details will be forwarded to you immediately your profile is verified. <br><br>Thanks";

                        $this->sendEmail($this->email, $this->subject);

                        $resData = ['title' => 'Great!', 'res' => 'Profile updated', 'message' => 'success', 'action' => 'update'];

                    }

                    else{
                        $resData = ['title' => 'Oops!', 'res' => 'Something went wrong', 'message' => 'error'];

                    }


                }


            }

        return $this->returnJSON($resData);
    }



    public function ajaxbookappointment(Request $req){
        // Validate Information
        $validator = Validator::make($req->all(),

         array(
             'name' => 'required',

             'email' => 'required',

             'subject' => 'required',

             'message' => 'required',

         ));

          if ($validator->fails()) {

             //Response Data

             $resData = ['res' => 'Please do complete the form', 'message' => 'info'];

          }
          else{

            $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Booked An Appointment');
            // Check Later to Book appointment
            // Insert to DB

            // Start Checks
            if($req->purpose == "registered"){

                $insertData = BookAppointment::insert(['busID'=>$req->busID, 'ref_code' => $req->ref_code, 'station_name' => $req->station_name, 'name' => $req->name, 'email' => $req->email, 'subject' => $req->subject, 'message' => $req->message, 'date_of_visit' => $req->date_of_visit, 'service_option' => $req->service_option, 'service_type' => $req->service_type, 'current_mileage' => $req->current_mileage]);
                if($insertData == true){
                    // Get Receiver Mail
                    $getReceiver = Stations::where('station_name', 'LIKE', '%'.$req->station.'%')->get();

                    // Get discount
                    $getDiscount = MinimumDiscount::where('discount', 'discount')->get();

                    if(count($getReceiver) > 0){
                        $coyName = Business::where('busID', $getReceiver[0]->busID)->get();


                    $businessMail = BusinessStaffs::where('station', $getReceiver[0]->station_name)->get();
                        $this->to = $req->station_email;
                        // $this->to = "info@vimfile.com";
                        $this->sender = $req->name;
                        $this->email = $req->email;
                        $this->subject = $req->subject;
                        $this->message = $req->message;
                        $this->date = $req->date_of_visit;
                        $this->service_option = $req->service_option;
                        $this->service_type = $req->service_type;
                        $this->current_mileage = $req->current_mileage;
                        $this->company = $req->station;
                        $this->company_name = $coyName[0]->name_of_company;
                        $this->station_address = $getReceiver[0]->station_address;
                        $this->ref_code = $req->ref_code;
                        $this->discount = $getDiscount[0]->percent;
                    }
                    else{
                        $getReceivers = Business::where('busID', $req->busID)->get();

                        // Get discount
                        $getDiscount = MinimumDiscount::where('discount', 'discount')->get();

                        if(count($getReceivers) > 0){
                            $getReceivers = Stations::where('busID', $req->busID)->get();

                            $name_of_company = $getReceiver[0]->name_of_company;

                            $station_address = $getReceivers[0]->station_address;

                        }
                        else{
                            // Get Others
                            $getsReceivers = Stations::where('busID', $req->busID)->get();

                            $coysName = User::where('busID', $getsReceivers[0]->busID)->get();

                            $name_of_company = $coysName[0]->station_name;

                            $station_address = $getsReceivers[0]->station_address;

                        }


                        $this->to = $req->station_email;
                        // $this->to = "info@vimfile.com";
                        $this->sender = $req->name;
                        $this->email = $req->email;
                        $this->subject = $req->subject;
                        $this->message = $req->message;
                        $this->date = $req->date_of_visit;
                        $this->service_option = $req->service_option;
                        $this->service_type = $req->service_type;
                        $this->current_mileage = $req->current_mileage;
                        $this->company = $req->station;
                        $this->company_name = $name_of_company;
                        $this->station_address = $station_address;
                        $this->ref_code = $req->ref_code;
                        $this->discount = $getDiscount[0]->percent;
                    }

                    $this->sendEmail($this->to, 'VIM File - A client wants to book an appointment with you');

                    $this->sendEmail(Auth::user()->email, 'VIM File - Book an Appointment');

                    $resData = ['res' => 'Your Appointment with '.$req->station_name.' has been submitted. Kindly present your book code for your discount. Thanks', 'message' => 'success'];
                }
                else{
                    $resData = ['res' => 'An error occured!', 'message' => 'error'];
                }

            }
            elseif($req->purpose == "unregistered"){
                // Make Changes and send mail
                $insertData = BookAppointment::insert(['busID'=>$req->id, 'ref_code' => $req->ref_code, 'station_name' => $req->station_name, 'name' => $req->name, 'email' => $req->email, 'subject' => $req->subject, 'message' => $req->message, 'date_of_visit' => $req->date_of_visit, 'service_option' => $req->service_option, 'service_type' => $req->service_type, 'current_mileage' => $req->current_mileage]);
                if($insertData == true){
                    // Get Mail Data of Receiver
                    $dataBus = Business::where('id', $req->id)->get();
                    // Get discount
                    $getDiscount = MinimumDiscount::where('discount', 'discount')->get();

                    if(count($dataBus) > 0){
                        $email = explode(", ", $dataBus[0]->email);

                        $this->to = $email[0];
                        // $this->to = "info@vimfile.com";
                        $this->sender = $req->name;
                        $this->email = $req->email;
                        $this->subject = $req->subject;
                        $this->message = $req->message;
                        $this->date = $req->date_of_visit;
                        $this->service_option = $req->service_option;
                        $this->service_type = $req->service_type;
                        $this->current_mileage = $req->current_mileage;
                        $this->company = $req->station;
                        $this->company_name = $dataBus[0]->name_of_company;
                        $this->station_address = $dataBus[0]->address;
                        $this->ref_code = $req->ref_code;
                        $this->discount = $getDiscount[0]->percent;
                    }
                    else{
                        $this->to = "info@vimfile.com";
                        $this->sender = $req->name;
                        $this->email = $req->email;
                        $this->subject = $req->subject;
                        $this->message = $req->message;
                        $this->date = $req->date_of_visit;
                        $this->service_option = $req->service_option;
                        $this->service_type = $req->service_type;
                        $this->current_mileage = $req->current_mileage;
                        $this->company = $req->station;
                        $this->company_name = "VIMFILE";
                        $this->station_address = "Professionals' File Inc. 10 George St. North, Brampton ON L6X1R2, Canada";
                        $this->ref_code = $req->ref_code;
                        $this->discount = $getDiscount[0]->percent;
                    }

                    $this->sendEmail($this->to, 'VIM File - A client wants to book an appointment with you');

                    $this->sendEmail(Auth::user()->email, 'VIM File - Book an Appointment');

                    $resData = ['res' => 'Message Sent Successfully', 'message' => 'success'];
                }
                else{
                    $resData = ['res' => 'An error occured!', 'message' => 'error'];
                }
            }


            // End Checks


          }

          return $this->returnJSON($resData);
    }


    public function stationDetails(Request $req){

    // $getRes = DB::table('stations')
    //     ->join('business', 'stations.busID', '=', 'business.busID')->where('stations.busID', $req->busID)
    //     ->get();

        $getRes = DB::table('stations')
        ->join('business_owner_staffs', 'stations.station_name', '=', 'business_owner_staffs.station')->where('business_owner_staffs.station', $req->station)
        ->get();
        

        // dd($getRes);

        if(count($getRes) > 0){

            // Get Business name

            $businessName = Business::where('busID', $req->busID)->get();

            // Check if Company has discount
            $coydisc = clientMinimum::where('discount', 'discount')->where('busID', $req->busID)->get();

            if(count($coydisc) > 0){
                $this->discount = $coydisc[0]->percent;
            }
            else{
                // Get discount
            $getDiscount = MinimumDiscount::where('discount', 'discount')->get();

                $this->discount = $getDiscount[0]->percent;

            }
            // Else take system discount

            $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => $getRes, 'discount' => $this->discount, 'coy_name' => $businessName[0]->name_of_company];
        }
        else{
            // Check for Certified Mechanics

            $getRest = DB::table('stations')
        ->join('users', 'stations.busID', '=', 'users.busID')->where('users.busID', $req->busID)
        ->get();

            if(count($getRest) > 0){
                $CPbusinessName = User::where('busID', $req->busID)->get();

                // Check if Company has discount
            $coydisc = clientMinimum::where('discount', 'discount')->where('busID', $req->busID)->get();

            if(count($coydisc) > 0){
                $this->discount = $coydisc[0]->percent;
            }
            else{
                // Get discount
            $getDiscount = MinimumDiscount::where('discount', 'discount')->get();

                $this->discount = $getDiscount[0]->percent;

            }
            // Else take system discount

            $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => $getRest, 'discount' => $this->discount, 'coy_name' => $CPbusinessName[0]->station_name];

            }
            else{
                $resData = ['res' => 'An error occured! try Later!!', 'message' => 'error'];
            }


        }


        return $this->returnJSON($resData);
    }


    public function ajaxcontactus(Request $req){

        // Insert to DB
        $insertRec = Contactus::insert(['name' => $req->name, 'email' => $req->email, 'subject' => $req->subject, 'message' => $req->message]);

        if($insertRec == true){
            $resData = ['res' => 'Message Sent Successfully', 'message' => 'success'];

            $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Contacted Us with'.$req->email);

            if($req->purpose == "Business"){
                // Get Business email
                $getEmail = Business::where('busID', $req->id)->get();

                if(count($getEmail) > 0){
                    $this->to = $getEmail[0]->email;
                    // $this->to = "info@vimfile.com";
                }
            }

            $this->name = $req->name;
            $this->email = $req->email;
            $this->subject = $req->subject;
            $this->message = $req->message;

            $this->sendEmail($req->email, 'VIM File - Contact Us');
            $this->sendEmail($this->to, 'Admin Team - Contact');



        }
        else{
            $resData = ['res' => 'An error occured!. Please try again later', 'message' => 'error'];
        }

        return $this->returnJSON($resData);
    }

    public function ajaxpasswordchange(Request $req){
        // Check User if has account
        $getUser = User::where('email', $req->email)->get();
        if(count($getUser) > 0){
            // Update Password
            $updtUser = User::where('email', $getUser[0]->email)->update(['password' => Hash::make($req->password)]);
            $resData = ['res' => 'Password Successfully Changed', 'message' => 'success'];

            $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], $getUser[0]->email.' edited their password');

            $this->notifications(Auth::user()->ref_code, 'Password was changed', 'https://www.pinclipart.com/picdir/middle/389-3892916_password-icon-png-change-password-icon-transparent-clipart.png');

            $this->name = $getUser[0]->name;
            $this->to = $req->email;
            // $this->to = "info@vimfile.com";
            $this->email = $getUser[0]->email;
            $this->password = $req->password;

            $this->sendEmail($this->to, 'VIM File - Password Change');
        }
        else{
            $resData = ['res' => 'An error occured!. Please try again later', 'message' => 'error'];
        }

        return $this->returnJSON($resData);
    }


        // Make Payment
        public function ajaxmakePay(Request $req){
            if($req->plan == "Basic"){
                // Get User if exist
                $checkUser = PayPlan::where('email', $req->email)->get();

                if(count($checkUser) > 0){
                    // Update User Payment Plan
                    $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'litecommercial' => '', 'startup' => '', 'lite' => '', 'basic'=> $req->amount, 'classic' => '', 'super' => '', 'gold' => '', 'userType' => 'Business', 'subscription_plan' => $req->duration, 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                    if($douserpayUpt == true){
                        $getTrans = PayPlan::where('email', $req->email)->get();

                        // Redirect to Paystack Form
                        $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePay/'.$getTrans[0]->transaction_id];
                    }
                    else{
                        // Redirect to Paystack Form
                        $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                    }


                }
                else{
                    // insert
                    $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'litecommercial' => '', 'startup' => '', 'lite' => '', 'basic'=> $req->amount, 'classic' => '', 'super' => '', 'gold' => '', 'userType' => 'Business', 'subscription_plan' => $req->duration, 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                    if($douserpayIns == true){
                        $getTrans = PayPlan::where('email', $req->email)->get();

                        // Redirect to Paystack Form
                        $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePay/'.$getTrans[0]->transaction_id];
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
                    $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => '', 'basic'=> '', 'classic' => $req->amount, 'super' => '', 'gold' => '', 'userType' => 'Business', 'subscription_plan' => $req->duration, 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                    if($douserpayUpt == true){
                        $getTrans = PayPlan::where('email', $req->email)->get();

                        // Redirect to Paystack Form
                        $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePay/'.$getTrans[0]->transaction_id];
                    }
                    else{
                        // Redirect to Paystack Form
                        $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                    }


                }
                else{
                    // insert
                    $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => '', 'basic'=> '', 'classic' => $req->amount, 'super' => '', 'gold' => '', 'userType' => 'Business', 'subscription_plan' => $req->duration, 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                    if($douserpayIns == true){
                        $getTrans = PayPlan::where('email', $req->email)->get();

                        // Redirect to Paystack Form
                        $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePay/'.$getTrans[0]->transaction_id];
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
                    $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => '', 'basic'=> '', 'classic' => '', 'super' => $req->amount, 'gold' => '', 'userType' => 'Business', 'subscription_plan' => $req->duration, 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                    if($douserpayUpt == true){
                        $getTrans = PayPlan::where('email', $req->email)->get();

                        // Redirect to Paystack Form
                        $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePay/'.$getTrans[0]->transaction_id];
                    }
                    else{
                        // Redirect to Paystack Form
                        $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                    }


                }
                else{
                    // insert
                    $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => '', 'basic'=> '', 'classic' => '', 'super' => $req->amount, 'gold' => '', 'userType' => 'Business', 'subscription_plan' => $req->duration, 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                    if($douserpayIns == true){
                        $getTrans = PayPlan::where('email', $req->email)->get();

                        // Redirect to Paystack Form
                        $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePay/'.$getTrans[0]->transaction_id];
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
                    $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => $req->amount, 'userType' => 'Business', 'subscription_plan' => $req->duration, 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                    if($douserpayUpt == true){
                        $getTrans = PayPlan::where('email', $req->email)->get();

                        // Redirect to Paystack Form
                        $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePay/'.$getTrans[0]->transaction_id];
                    }
                    else{
                        // Redirect to Paystack Form
                        $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                    }


                }
                else{
                    // insert
                    $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => $req->amount, 'userType' => 'Business', 'subscription_plan' => $req->duration, 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                    if($douserpayIns == true){
                        $getTrans = PayPlan::where('email', $req->email)->get();

                        // Redirect to Paystack Form
                        $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePay/'.$getTrans[0]->transaction_id];
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
                    $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => '', 'lite' => $req->amount, 'litecommercial' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $req->userType, 'subscription_plan' => $req->duration, 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                    if($douserpayUpt == true){
                        $getTrans = PayPlan::where('email', $req->email)->get();

                        // Redirect to Paystack Form
                        $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePay/'.$getTrans[0]->transaction_id];
                    }
                    else{
                        // Redirect to Paystack Form
                        $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                    }


                }
                else{
                    // insert
                    $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $req->plan, 'free' => '', 'startup' => '', 'lite' => $req->amount, 'litecommercial' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $req->userType, 'subscription_plan' => $req->duration, 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                    if($douserpayIns == true){
                        $getTrans = PayPlan::where('email', $req->email)->get();

                        // Redirect to Paystack Form
                        $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePay/'.$getTrans[0]->transaction_id];
                    }
                    else{
                        // Redirect to Paystack Form
                        $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                    }
                }
            }

            elseif($req->plan == "Lite-Commercial"){
                // Get User if exist
                $checkUser = PayPlan::where('email', $req->email)->get();

                if(count($checkUser) > 0){
                    // Update User Payment Plan
                    $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => 'Commercial', 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => $req->amount, 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $req->userType, 'subscription_plan' => $req->duration, 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                    if($douserpayUpt == true){
                        $getTrans = PayPlan::where('email', $req->email)->get();

                        // Redirect to Paystack Form
                        $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePay/'.$getTrans[0]->transaction_id];
                    }
                    else{
                        // Redirect to Paystack Form
                        $resData = ['res' => 'Something Went Wrong! Try Again', 'message' => 'error'];
                    }


                }
                else{
                    // insert
                    $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => 'Commercial', 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => $req->amount, 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $req->userType, 'subscription_plan' => $req->duration, 'date_from' => date('Y-m-d'), 'currency' => $this->arr_ip['currency'] ]);

                    if($douserpayIns == true){
                        $getTrans = PayPlan::where('email', $req->email)->get();

                        // Redirect to Paystack Form
                        $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'MakePay/'.$getTrans[0]->transaction_id];
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
                        $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'userDashboard'];
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
                        $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'userDashboard'];
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
                        $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'AdminLogin'];
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
                        $resData = ['res' => 'Success', 'message' => 'success', 'link' => 'AdminLogin'];
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


    // Edit Maintenance Record
    public function ajaxmaintenancesave(Request $req){
            // Do update
            $updtRec = Vehicleinfo::where('id', $req->id)->update(['vehicle_licence' => $req->vehicle_licence, 'date'=> $req->date, 'service_type'=> $req->service_type, 'service_option'=> $req->service_option, 'service_item_spec'=> $req->service_item_spec, 'manufacturer'=> $req->manufacturer, 'material_qty'=> $req->material_qty, 'material_cost'=> $req->material_cost, 'labour_qty'=> $req->labour_qty, 'labour_cost'=> $req->labour_cost, 'other_cost'=> $req->other_cost, 'total_cost'=> $req->total_cost, 'service_note'=> $req->service_note, 'mileage'=> $req->mileage, 'material_qty2'=> $req->material_qty2, 'material_qty3'=> $req->material_qty3, 'labour_qty2'=> $req->labour_qty2, 'material_cost2'=> $req->material_cost2, 'material_cost3'=> $req->material_cost3, 'labour_cost2'=> $req->labour_cost2]);

            if($updtRec == true){
                // get data
                $getRec = Vehicleinfo::where('id', $req->id)->get();

                $resData = ['res' => 'Saved', 'message' => 'success', 'data' => json_encode($getRec), 'link' => 'userDashboard'];
            }

        return $this->returnJSON($resData);
    }

    public function ajaxivimsearch(Request $req){
        // Check for Details


        if($req->purpose == 'ivim' || $req->purpose == 'report'){

            if(Auth::user()->userType == "Business"){
                $this->vehicle_inf = Carrecord::where('vehicle_reg_no', $req->licence)->where('busID', Auth::user()->busID)->get();
            }
            else{
                $this->vehicle_inf = Carrecord::where('vehicle_reg_no', $req->licence)->get();
            }


            if(count($this->vehicle_inf) > 0){

                // dd(Auth::user()->country);
                // BFKL055
                // Condition

                if(Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Technician" || Auth::user()->userType == "Certified Professional"){

                if(Auth::user()->country == $this->vehicle_inf[0]->country_of_reg && $this->vehicle_inf[0]->country_of_reg != null){

                    $lastestReg = vehicleInfo::where('vehicle_licence', $req->licence)->orderBy('created_at', 'DESC')->take(1)->get();

                    $oil = vehicleInfo::where('vehicle_licence', $req->licence)->where('service_type', 'LIKE', '%Oil change%')->orderBy('created_at', 'DESC')->get();

                if(count($oil) > 0){
                    $this->oilChange = $oil;
                }else{
                    $this->oilChange = '';
                }

                $tyre = vehicleInfo::where('vehicle_licence', $req->licence)->where('service_type', 'LIKE', '%Wheel balancing%')->orderBy('created_at', 'DESC')->take(1)->get();

                if(count($tyre) > 0){
                    $this->tyreRotation = $tyre;
                }else{
                    $this->tyreRotation = '';
                }

                // dd($this->tyreRotation);

                $air = vehicleInfo::where('vehicle_licence', $req->licence)->where('service_type', 'LIKE', '%Air Filter%')->orderBy('created_at', 'DESC')->take(1)->get();

                if(count($air) > 0){
                    $this->airFilter = $air;
                }else{
                    $this->airFilter = '';
                }

                $inspection = vehicleInfo::where('vehicle_licence', $req->licence)->where('service_type', 'LIKE', '%Inspection%')->orderBy('created_at', 'DESC')->take(1)->get();

                if(count($inspection) > 0){
                    $this->inspection = $inspection;
                }else{
                    $this->inspection = '';
                }

                $registration = vehicleInfo::where('vehicle_licence', $req->licence)->where('service_type', 'LIKE', '%Registration%')->orderBy('created_at', 'DESC')->take(1)->get();

                if(count($registration) > 0){
                    $this->registration = $registration;
                }else{
                    $this->registration = '';
                }


                $previous = Vehicleinfo::where('vehicle_licence', $req->licence)->max('mileage');


                // get next user mileage
                $next = Vehicleinfo::where('vehicle_licence', $req->licence)->min('mileage');

                $tot = $previous - $next;

                $this->totMiles = $tot;

                // Tot Maint cost
                $this->totMaint = Vehicleinfo::where('vehicle_licence', $req->licence)->sum('total_cost');


                if($req->purpose == 'ivim'){
                    $resData = ['res' => 'Data Retrieved', 'message' => 'success', 'action' => 'ivim', 'data0' => json_encode($this->vehicle_inf), 'data1' => json_encode($this->oilChange), 'data2' => json_encode($this->tyreRotation), 'data3' => json_encode($this->airFilter), 'data4' => json_encode($this->inspection), 'data5' => json_encode($this->registration), 'data6' => json_encode($this->totMiles), 'data7' => json_encode($this->totMaint)];
                }
                elseif($req->purpose == 'report'){
                    $resData = ['res' => 'Data Retrieved', 'message' => 'success', 'action' => 'report', 'data0' => json_encode($this->vehicle_inf), 'data6' => json_encode($this->totMiles), 'data7' => json_encode($this->totMaint), 'data8' => json_encode($lastestReg)];
                }
            }
            else{
                $resData = ['res' => 'Car record not within resident country', 'message' => 'info'];
            }
        }



        }


    else{
        $resData = ['res' => 'Car record not available', 'message' => 'info'];
    }

        }

        return $this->returnJSON($resData);
    }

    public function ajaxdeactivateuser(Request $req){
        // Fetch User
        $user = User::where('id', $req->id)->get();

        if(count($user) > 0){
            // Update User
            $getuser = User::where('id', $req->id)->get();
            $user = User::where('id', $req->id)->update(['status' => '0']);
            $resData = ['res' => 'Thank you for using VIMFile. Your account is now deactivated', 'message' => 'success'];

            // dd($resData);
            $this->name = $getuser[0]->name;
            $this->to = $getuser[0]->email;
            // $this->to = "info@vimfile.com";

            $this->sendEmail($this->to, 'VIM File - Account Declined');
        }
        else{
            $resData = ['res' => 'Something Went Wrong', 'message' => 'error'];
        }

        return $this->returnJSON($resData);

    }


    public function forgotPassword(Request $req){
        $useremail = User:: where('email', $req->email)->get();

        if($req->val == 'emailAddress'){
            $token = mt_rand().'_PILS_'.uniqid();
            if(count($useremail) > 0){

            $checkPR = PasswordReset::where('email', $req->email)->get();

                if(count($checkPR)){
                    // Insert table
                    $resetUpdate = PasswordReset::where('email', $req->email)->update(['token' => $token, 'email' => $req->email, 'verifylink' => $_SERVER['HTTP_HOST'].'/ResetPassword/'.$token, 'state' => 0]);
                }
                else{
                   // Insert into table
                $resetInsert = PasswordReset::insert(['token' => $token, 'email' => $req->email, 'verifylink' => $_SERVER['HTTP_HOST'].'/ResetPassword/'.$token, 'state' => 0]);
                }

                $resData = ['res' => 'E-mail Confirmed', 'message' => 'success', 'link' => $token, 'action' => 'email check'];
            }
            else{
                $resData = ['res' => 'E-mail not registered', 'message' => 'info', 'link' => ''];
            }
        }

        elseif($req->val == 'maidenname1'){
            // Check for User Info from User Table
            $checkUser = User::where('email', $req->email)->get();
            if(count($checkUser) > 0){
                // Get Security Question 1
                $getQuest = User::where('email', $checkUser[0]->email)->where('maiden_name', 'LIKE', '%'.$req->maiden_name.'%')->get();

                $getUsertoken = PasswordReset::where('email', $checkUser[0]->email)->get();

                $token = $getUsertoken[0]->token;
                if(count($getQuest) > 0){
                    // Message:: success , Redirect to Password Reset
                    $resData = ['res' => 'Answer Correct', 'message' => 'success', 'link' => $token.'?c=NewPassword', 'action' => 'maiden name'];
                }
                else{
                    // Redirect to Second Quest
                    $resData = ['res' => 'Answer is Wrong, Lets ask another question', 'message' => 'error', 'link' => $token.'?c=SecurityQuest2', 'action' => 'maiden name'];
                }
            }
            else{
                $resData = ['res' => 'E-mail not registered', 'message' => 'info', 'link' => ''];
            }
        }

        elseif($req->val == 'maidenname2'){
            // Check for User Info from User Table
            $checkUser = User::where('email', $req->email)->get();
            if(count($checkUser) > 0){
                // Get Security Question 1
                $getQuest = User::where('email', $checkUser[0]->email)->where('parent_meet', 'LIKE', '%'.$req->parent_meet.'%')->get();
                $getUsertoken = PasswordReset::where('email', $checkUser[0]->email)->get();

                $token = $getUsertoken[0]->token;
                if(count($getQuest) > 0){
                    // Message:: success , Redirect to Password Reset
                    $resData = ['res' => 'Answer Correct', 'message' => 'success', 'link' => $token.'?c=NewPassword', 'action' => 'parent meet'];
                }
                else{
                    // Reset Password

                    // Update Password
                $updatePass = User::where('email', $checkUser[0]->email)->update(['password' => Hash::make($checkUser[0]->phone_number)]);

                    $resData = ['res' => 'Answer is Wrong. Check your mail for an auto generated password for you. Remember to change it on next login', 'message' => 'error', 'link' => 'login', 'action' => 'parent meet'];

                    $this->name = $checkUser[0]->name;
                    $this->to = $req->email;
                    // $this->to = "info@vimfile.com";
                    $this->email = $checkUser[0]->email;
                    $this->password = $checkUser[0]->phone_number;

                    $this->sendEmail($this->to, 'VIM File - Password Change');

                }
            }
            else{
                $resData = ['res' => 'E-mail not registered', 'message' => 'info', 'link' => ''];
            }
        }

        elseif($req->val == 'passwordchange'){
            // Check for User Info from User Table
            $checkUser = User::where('email', $req->email)->get();
            if(count($checkUser) > 0){
                // Update Password
                $updatePass = User::where('email', $checkUser[0]->email)->update(['password' => Hash::make($req->new_password)]);

                if($updatePass == true){
                    // Message:: success , Redirect to Password Reset
                    $resData = ['res' => 'Password Changed Successfully', 'message' => 'success', 'link' => 'login', 'action' => 'passwordchange'];

                    // Receive Mail of Password Change

                    $this->name = $checkUser[0]->name;
                    $this->to = $req->email;
                    // $this->to = "info@vimfile.com";
                    $this->email = $checkUser[0]->email;
                    $this->password = $req->new_password;

                    $this->sendEmail($this->to, 'VIM File - Password Change');
                }
                else{
                    $resData = ['res' => 'Something Went Wrong, Try again', 'message' => 'error', 'action' => 'passwordchange'];
                }
            }
            else{
                $resData = ['res' => 'E-mail not registered', 'message' => 'info', 'link' => ''];
            }
        }



        return $this->returnJSON($resData);
    }


    public function ajaxuploadstatement(Request $req){
        $req = request();
        $getUser = User::where('id', $req->id)->get();


        if($req->val == 'bankstatement'){
        if(count($getUser) > 0){
            if($req->file('bankstatement'))
            {
                //Get filename with extension
                $filenameWithExt = $req->file('bankstatement')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
                // Get just extension
                $extension = $req->file('bankstatement')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = rand().'_'.time().'.'.$extension;
                //Upload Image
                // $path = $req->file('file')->storeAs('public/uploads', $fileNameToStore);

                // $path = $req->file('bankstatement')->move(public_path('/bankstatement/'), $fileNameToStore);

                $path = $req->file('bankstatement')->move(public_path('../../bankstatement/'), $fileNameToStore);

            }
            else{
                $fileNameToStore = "nofile.png";
            }

            if($fileNameToStore != "nofile.png"){
                // Update Users Info
            $userUpdt = User::where('id', $getUser[0]->id)->update(['bankstatement' => $fileNameToStore]);
            if($userUpdt == true){
                $resData = ['res' => 'File uploaded successfully', 'message' => 'Success', 'link' => 'userDashboard', 'action' => 'bankstatement'];
            }else{
                $resData = ['res' => 'Bank statement not uploaded, Try again', 'message' => 'Error'];
            }
            }
            else{
                $resData = ['res' => 'Please choose a file to upload and try again', 'message' => 'Error'];
            }


        }

        }

        elseif($req->val == 'creditcards'){
        if(count($getUser) > 0){
            if($req->file('creditcards'))
            {
                //Get filename with extension
                $filenameWithExt = $req->file('creditcards')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
                // Get just extension
                $extension = $req->file('creditcards')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = rand().'_'.time().'.'.$extension;
                //Upload Image
                // $path = $req->file('file')->storeAs('public/uploads', $fileNameToStore);

                // $path = $req->file('creditcards')->move(public_path('/creditcard/'), $fileNameToStore);

                $path = $req->file('creditcards')->move(public_path('../../creditcard/'), $fileNameToStore);

            }
            else{
                $fileNameToStore = "nofile.png";
            }

            if($fileNameToStore != "nofile.png"){
                // Update Users Info
            $userUpdt = User::where('id', $getUser[0]->id)->update(['creditcard' => $fileNameToStore]);
            if($userUpdt == true){
                $resData = ['res' => 'File uploaded successfully', 'message' => 'Success', 'link' => 'userDashboard', 'action' => 'creditcards'];
            }else{
                $resData = ['res' => 'Credit card statement not uploaded, Try again', 'message' => 'Error'];
            }
            }
            else{
                $resData = ['res' => 'Please choose a file to upload and try again', 'message' => 'Error'];
            }


        }


        }

        return $this->returnJSON($resData);
    }

    public function ajaxmoredetails(Request $req){
        // Add other details
        if($req->service_type == "inspection" || $req->service_type == "registration" || $req->service_type == "oil change" || $req->service_type == "air filter" || $req->service_type == "tire rotation"){

            $resData = ['res' => 'Record already exist', 'message' => 'info'];
        }
        else{
            $servicesDet = vehicleInfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%'.$req->service_type.'%')->orderBy('created_at', 'DESC')->get();

        if(count($servicesDet) > 0){
            $vehicle_inf = Carrecord::where('vehicle_reg_no', $servicesDet[0]->vehicle_licence)->get();
            // Check if Rec exist
            $checkExt = CommercialRec::where('service_type', $req->service_type)->get();
            if(count($checkExt) > 0){
                $resData = ['res' => 'Record already exist on the list', 'message' => 'info'];
            }
            else{
                // Insert
                $recIns = CommercialRec::insert(['vehicle_licence' => $servicesDet[0]->vehicle_licence, 'service_type' => $req->service_type]);
                $resData = ['res' => 'Data Retrieved', 'message' => 'success', 'data' => json_encode($servicesDet), 'data2' => json_encode($vehicle_inf)];
            }

        }
        else{
            $resData = ['res' => 'No record found for this selection', 'message' => 'info'];
        }
        }



        return $this->returnJSON($resData);
    }


    public function ajaxcommercialfinance(Request $req){
        // Get user
        $takeUser = User::where('id', $req->id)->get();


        if(count($takeUser) > 0){
            if($req->val == "applicable_tax"){

                $revRec = PostEarns::where('email', Auth::user()->email)->where('applicable_tax', NULL)->get();

                if(count($revRec) > 0){
                PostEarns::where('email', Auth::user()->email)->update(['applicable_tax' => $req->inflowVal]);

                $resData = ['res' => 'Post Updated', 'message' => 'Success', 'action' => 'applicable_tax'];

                }

                else{
                    PostEarns::insert(['name' => $takeUser[0]->name, 'email' => $takeUser[0]->email, 'applicable_tax' => $req->inflowVal]);

                    $resData = ['res' => 'Post Inserted', 'message' => 'Success', 'action' => 'applicable_tax'];

                }



        }
        elseif($req->val == "post_earnings"){

                $revRec = PostEarns::where('email', $takeUser[0]->email)->where('post_earnings', NULL)->where('tax_earnings', NULL)->get();

                if(count($revRec) > 0){
            PostEarns::where('email', $takeUser[0]->email)->update(['name' => $takeUser[0]->name, 'email' => $takeUser[0]->email, 'post_earnings' => $req->inflowEarn, 'start_date' => $req->start_date, 'end_date' => $req->end_date]);

            // Check if exist
                $addpostearnsPoints = Points::where('email', Auth::user()->email)->get();

                if(count($addregnewPoints) > 0){
                    $weekpostearnsPoint = $addpostearnsPoints[0]->weekly_point + 40;
                    $allregnewPoint = $addpostearnsPoints[0]->alltime_point + $weekpostearnsPoint;
                    $point = Points::where('email', Auth::user()->email)->update(['weekly_point' => $weekpostearnsPoint, 'alltime_point' => $allregnewPoint, 'global_point' => $allregnewPoint, 'state' => Auth::user()->state, 'country' => Auth::user()->country]);


                }
                else{
                    // Insert
                    $inspoint = Points::insert(['name' => Auth::user()->name, 'email' => Auth::user()->email, 'weekly_point' => '40', 'alltime_point' => '40', 'global_point' => '40', 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                }

            $resData = ['res' => 'Post Updated', 'message' => 'Success', 'action' => 'post_earnings'];

                }

                else{
                    PostEarns::insert(['name' => $takeUser[0]->name, 'email' => $takeUser[0]->email, 'post_earnings' => $req->inflowEarn, 'start_date' => $req->start_date, 'end_date' => $req->end_date]);


                    // Check if exist
                $addpostearnsPoints = Points::where('email', Auth::user()->email)->get();

                if(count($addregnewPoints) > 0){
                    $weekpostearnsPoint = $addpostearnsPoints[0]->weekly_point + 40;
                    $allregnewPoint = $addpostearnsPoints[0]->alltime_point + $weekpostearnsPoint;
                    $point = Points::where('email', Auth::user()->email)->update(['weekly_point' => $weekpostearnsPoint, 'alltime_point' => $allregnewPoint, 'global_point' => $allregnewPoint, 'state' => Auth::user()->state, 'country' => Auth::user()->country]);


                }
                else{
                    // Insert
                    $inspoint = Points::insert(['name' => Auth::user()->name, 'email' => Auth::user()->email, 'weekly_point' => '40', 'alltime_point' => '40', 'global_point' => '40', 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                }

            $resData = ['res' => 'Post Inserted', 'message' => 'Success', 'action' => 'post_earnings'];

                }



        }
        elseif ($req->val == "mile_posts") {

            $revRec = PostEarns::where('email', $takeUser[0]->email)->where('post_mileage', NULL)->get();

            if(count($revRec) > 0){
                 PostEarns::where('email', $takeUser[0]->email)->update(['name' => $takeUser[0]->name, 'email' => $takeUser[0]->email, 'post_mileage' => $req->inflowVal, 'start_date' => $req->start_date, 'end_date' => $req->end_date]);
            $resData = ['res' => 'Post Updated', 'message' => 'Success', 'action' => 'mile_posts'];

            }
            else{
                // Insert User Record
            PostEarns::insert(['name' => $takeUser[0]->name, 'email' => $takeUser[0]->email, 'post_mileage' => $req->inflowVal, 'start_date' => $req->start_date, 'end_date' => $req->end_date]);
            $resData = ['res' => 'Post Inserted', 'message' => 'Success', 'action' => 'mile_posts'];

            }

        }
        elseif ($req->val == "avg_earnings") {

            // Check if record is in existence
            $revRec = RevenueReport::where('email', $takeUser[0]->email)->where('avg_rev_month', NULL)->get();

            if(count($revRec) > 0){
                // update rec
                RevenueReport::where('email', $takeUser[0]->email)->update(['name' => $takeUser[0]->name, 'email' => $takeUser[0]->email, 'start_date' => $req->start_date, 'end_date' => $req->end_date, 'avg_rev_month' => $req->inflowVal]);

                $resData = ['res' => 'Post Updated', 'message' => 'Success', 'action' => 'avg_earnings'];
            }
            else{
                // Insert rec
                RevenueReport::where('email', $takeUser[0]->email)->insert(['name' => $takeUser[0]->name, 'email' => $takeUser[0]->email, 'start_date' => $req->start_date, 'end_date' => $req->end_date, 'avg_rev_month' => $req->inflowVal]);

                $resData = ['res' => 'Post Inserted', 'message' => 'Success', 'action' => 'avg_earnings'];
            }

        }
        elseif ($req->val == "tot_earnings") {
            // Check if record is in existence
            $revRec = RevenueReport::where('email', $takeUser[0]->email)->where('tot_rev', NULL)->get();

            if(count($revRec) > 0){
                // update rec
                RevenueReport::where('email', $takeUser[0]->email)->update(['name' => $takeUser[0]->name, 'email' => $takeUser[0]->email, 'tot_rev' => $req->inflowVal]);

                $resData = ['res' => 'Post Updated', 'message' => 'Success', 'action' => 'tot_earnings'];
            }
            else{
                // Insert rec
                RevenueReport::where('email', $takeUser[0]->email)->insert(['name' => $takeUser[0]->name, 'email' => $takeUser[0]->email, 'tot_rev' => $req->inflowVal]);

                $resData = ['res' => 'Post Inserted', 'message' => 'Success', 'action' => 'tot_earnings'];
            }
        }

        }
        else{
            $resData = ['res' => 'Something Went Wrong', 'message' => 'error'];
        }

        return $this->returnJSON($resData);
    }


    public function ajaxmorereports(Request $req){


        $from = date('Y-m-d', strtotime($req->date_from));
        $to = $req->date_to;

        $nextDay = date('Y-m-d', strtotime($to. ' + 1 days'));

        // Check if Report Revenue exist
        $getrepRev = PostEarns::where('email', $req->email)->get();



        if(count($getrepRev) > 0){

        $getmyRecord = Vehicleinfo::select(\DB::raw('SUM(total_cost) as total_cost, service_type, COUNT(*)'))
        ->where('email', $req->email)
        ->whereBetween('created_at', [$from, $nextDay])
        ->groupBy(\DB::raw('service_type'))
        ->get();



        // Get Expences to report as to commercial users
            $this->totEarnings = PostEarns::where('email', $req->email)->whereBetween('created_at', [$from, $nextDay])->sum('post_earnings');


            $getearnbydate = PostEarns::where('email', $req->email)->whereBetween('created_at', [$from, $nextDay])->orderBy('created_at', 'DESC')->get();



            if(count($getearnbydate) > 0){
                 $this->getEarn = $getearnbydate[0]->post_mileage;
                 $this->getVats = $getearnbydate[0]->applicable_tax / (100 + $getearnbydate[0]->applicable_tax);
            }
            else{
                 $this->getEarn = 0;
                 $this->getVats = 0;
            }



            $previous = Vehicleinfo::where('email', $req->email)->max('mileage');


            // get next user mileage
            $next = Vehicleinfo::where('email', $req->email)->min('mileage');

            $tot = $previous - $next;

            $this->totMiles = $tot;

            if($this->totMiles != 0){
                // Get pro calc.
            $calcPro =  $this->getEarn / $this->totMiles;
            }else{
                $calcPro = 0;
            }

            $this->totTaxing = $this->totEarnings * $this->getVats;




        if(count($getmyRecord) > 0){
            $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($getmyRecord), 'proRact' => json_encode($calcPro), 'vat' => json_encode($this->getVats), 'totEarn' => $this->totEarnings, 'totTax' => $this->totTaxing, 'busKM' => json_encode($this->getEarn)];
        }
        else{
            $resData = ['res' => 'No report for this date', 'message' => 'info'];
        }

        }
        else{
            $resData = ['res' => 'No revenue return to fetch', 'message' => 'info'];
        }



      return $this->returnJSON($resData);
    }


    public function ajaxexpertise(Request $req){

        $ip_server = $_SERVER['REMOTE_ADDR'];

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

            // $path = $req->file('file')->move(public_path('/expertupload/'), $fileNameToStore);

            $path = $req->file('file')->move(public_path('../../expertupload/'), $fileNameToStore);

        }
        else
        {
            $fileNameToStore = 'askexperts.jpg';
        }

        // Check Record if exist

        $checkQuest = AskExpert::where('post_id', $req->post_id)->get();
        if(count($checkQuest) > 0){
            $resData = ['res' => 'Post already made', 'message' => 'Info'];
        }
        else{
            // Insert
            $this->vehicleLogs($req->service_type, $req->post_id, $req->name);
            $this->onesignal('Vehicle Inspection & Maintenance', 'Question: '.$req->askquestion, 'Ask Expert');

            $insQuest = AskExpert::insert(['name' => $req->name, 'email' => $req->email, 'post_id' => $req->post_id, 'question' => $req->askquestion, 'service_type' => $req->service_type, 'image' => "https://".$ip_server."/expertupload/".$fileNameToStore]);

            if($insQuest == true){

                // Send Mail to Mechanics



                // Check if exist
                $addPoints = Points::where('email', $req->email)->get();
                if(count($addPoints) > 0){
                    $weekPoint = $addPoints[0]->weekly_point + 15;
                    $allPoint = $addPoints[0]->alltime_point + $weekPoint;
                    $point = Points::where('email', $req->email)->update(['weekly_point' => $weekPoint, 'alltime_point' => $allPoint, 'global_point' => $allPoint, 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                    $resData = ['res' => 'Post Submitted. You now have '.$weekPoint.' points', 'message' => 'Success', 'link' => 'askexpert'];

                }
                else{
                    // Insert
                    $inspoint = Points::insert(['name' => $req->name, 'email' => $req->email, 'weekly_point' => '15', 'alltime_point' => '15', 'global_point' => '15', 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                    $resData = ['res' => 'Post Submitted. You have recieved 15 points', 'message' => 'Success', 'link' => 'askexpert'];
                }


            }
            else{
                $resData = ['res' => 'Something went wrong!', 'message' => 'Alert'];
            }
        }

        return $this->returnJSON($resData);
    }


    public function ajaxmyRank(Request $req){

        // Get Points
        $getPoints = Points::where('id', $req->id)->where('email', $req->email)->orderBy('weekly_point', 'DESC')->get();

        if(count($getPoints) > 0){
           $resData = ['res' => 'Fetched', 'message' => 'Success', 'data' => json_encode($getPoints)];

        }else{
            $resData = ['res' => 'No data', 'message' => 'info'];
        }

        return $this->returnJSON($resData);
    }

    public function ajaxansPost(Request $req){

        // Get Points
        $getPostid = AskExpert::where('post_id', $req->post_id)->update(['state' => 0]);

        if($getPostid == true){
           $resData = ['res' => 'Fetched', 'message' => 'success', 'link' => 'answerPost/'.$req->post_id];

        }else{
            $resData = ['res' => 'No data', 'message' => 'info'];
        }

        return $this->returnJSON($resData);
    }

    public function ajaxanscurrPost(Request $req){

        // Insert into Table

        $ansfromExpert = AnsFromExpert::insert(['autocare' => $req->auto_care, 'post_id' => $req->post_id, 'answer' => $req->answer]);

        if($ansfromExpert == true){
            $addingPonts = Points::where('email', Auth::user()->email)->get();
            $quest = AskExpert::where('post_id', $req->post_id)->get();
            if(count($addingPonts) > 0){
                $weekPont = $addingPonts[0]->weekly_point + 15;
                $allPont = $addingPonts[0]->alltime_point + $weekPont;
                $point = Points::where('email', Auth::user()->email)->update(['weekly_point' => $weekPont, 'alltime_point' => $allPont, 'global_point' => $allPont, 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                $this->onesignal('Vehicle Inspection & Maintenance', 'Recent Activity Alert: '.$req->auto_care.' replied with an answer: '.$req->answer.' to this Question: '.$quest[0]->question, 'Answer From Expert');
                }
                else{
                    // Insert
                    $inspoint = Points::insert(['name' => Auth::user()->name, 'email' => Auth::user()->email, 'weekly_point' => '15', 'alltime_point' => '15', 'global_point' => '15', 'state' => Auth::user()->state, 'country' => Auth::user()->country]);

                    $this->onesignal('Vehicle Inspection & Maintenance', 'Recent Activity Alert: '.$req->auto_care.' replied with an answer: '.$req->answer.' to this Question: '.$quest[0]->question, 'Answer From Expert');
                }

           $resData = ['res' => 'Post Sent', 'message' => 'Success', 'link' => $req->post_id];

        }else{
            $resData = ['res' => 'Something Went Wrong', 'message' => 'info'];
        }

        return $this->returnJSON($resData);
    }

    // Check if exist


    public function InviteContact(Request $req){
        $checkContact = GoogleImport::where('email', $req->email)->get();
        $mainUser = User::where('email', Auth::user()->email)->get();

        if(count($checkContact) > 0){
            // Update Record
            $updteContact = GoogleImport::where('email', $checkContact[0]->email)->update(['name' => $req->name, 'email' => $req->email, 'invite_from' => $req->from]);

            $resData = ['res' => 'Updated last imports', 'message' => 'Success'];
        }
        else{
            $insContact = GoogleImport::insert(['name' => $req->name, 'email' => $req->email, 'invite_from' => $req->from]);

            // Send Mails

            $this->name = $mainUser[0]->name;
            $this->to = $req->email;
            // $this->to = "info@vimfile.com";
            // $this->to = 'adenugaadebambo41@gmail.com';
            $this->ref_code = $mainUser[0]->ref_code;

            $this->sendEmail($this->to, 'VIM FILE -You can now do vehicle maintenance, wherever, whenever');

            $resData = ['res' => 'Invite to '.$req->name.' sent', 'message' => 'Success'];
        }


        return $this->returnJSON($resData);
    }


    public function uploadExcel(Request $req){

        $actUser = User::where('email', Auth::user()->email)->get();
        if($req->file('file'))
        {
            //Get filename with extension
            $filenameWithExt = $req->file('file')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
            // Get just extension
            $extension = $req->file('file')->getClientOriginalExtension();

            if($extension == "xlsx" || $extension == "xls"){

                $path = $req->file('file')->getRealPath();

                // $data = Excel::import($path)->get();
                $data = (new FastExcel)->import($path);

                if($data->count() > 0){
                    foreach ($data->toArray() as $key) {

                            $insert_data[] = array(
                                'name' => $key['name'],
                                'email' => $key['email'],
                                'invite_from' => Auth::user()->ref_code
                            );


                            $this->name = $actUser[0]->name;
                            $this->to = $key['email'];
                            // $this->to = "info@vimfile.com";
                            // $this->to = 'adenugaadebambo41@gmail.com';
                            $this->ref_code = $actUser[0]->ref_code;

                            $this->sendEmail($this->to, 'VIM FILE -You can now do vehicle maintenance, wherever, whenever');

                    }

                    if(!empty($insert_data)){
                        DB::table('googleimport')->insert($insert_data);
                    }
                }

                // Filename to store
            $fileNameToStore = rand().'_'.time().'.'.$extension;

            // $req->file('file')->move(public_path('/excelUpload/'), $fileNameToStore);

            $req->file('file')->move(public_path('../../excelUpload/'), $fileNameToStore);

            $resData = ['res' => 'Upload Successfull', 'message' => 'success', 'link' => 'userDashboard'];
            }
            else{

                $resData = ['res' => 'Invalid worksheet', 'message' => 'error'];

            }
        }
        else{
            $resData = ['res' => 'Kindly upload an excel document', 'message' => 'error'];
        }


        return $this->returnJSON($resData);
    }


    public function pointCalc(Request $req){
        // get Highest


        $getUserspoint = Points::orderBy('weekly_point', 'DESC')->get();

        if(count($getUserspoint) > 0){
             // Update Points
            $getWeekpoint = $getUserspoint[0]['weekly_point'] + 50;
            $allpointacq = $getUserspoint[0]['alltime_point'] + $getWeekpoint;
            $updtPoint = Points::where('email', $getUserspoint[0]['email'])->update(['alltime_point' => $allpointacq, 'global_point' => $allpointacq]);

            if($updtPoint == true){

                foreach($getUserspoint as $key){
            $email = $key['email'];
            $indWeek = $key['weekly_point'];
            $alltWeek = $key['alltime_point'] + $indWeek;

            Points::where('email', $email)->update(['weekly_point' => 0, 'alltime_point' => $alltWeek, 'global_point' => $alltWeek]);
        }

                echo "Done!";
            }
            else{
               return 0;
            }
        }
        else{
            return 0;
        }
    }


    public function estimateMail(Request $req){
        // Send mail to car owners mail

        // Get data
        $getEstdata = Estimate::where('estimate_id', $req->est_id)->where('estimate', '1')->get();

        // Get Discount
        $mydiscount = clientMinimum::where('busID', Auth::user()->busID)->get();
        $adminFee = MinimumDiscount::where('discount', 'service')->get();

        if(count($mydiscount) > 0){
            $this->discount = $mydiscount[0]->percent;
        }
        else{
            // Get Admin Discount
            $adminDiscount = MinimumDiscount::where('discount', 'discount')->get();

            $this->discount = $adminDiscount[0]->percent;
        }

        if(count($getEstdata) > 0){
            $this->name = Auth::user()->station_name;
            $this->to = $getEstdata[0]['email'];
            // $this->to = "info@vimfile.com";
            $this->licence = $getEstdata[0]['vehicle_licence'];
            $this->make = $getEstdata[0]['make'];
            $this->model = $getEstdata[0]['model'];
            $this->phone = $getEstdata[0]['telephone'];
            $this->date = $getEstdata[0]['date'];
            $this->service_type = $getEstdata[0]['service_type'];
            $this->service_option = $getEstdata[0]['service_option'];
            $this->service_item_spec = $getEstdata[0]['service_item_spec'];
            $this->manufacturer = $getEstdata[0]['manufacturer'];
            $this->material_qty = $getEstdata[0]['material_qty'];
            $this->material_cost = $getEstdata[0]['material_cost'];
            $this->labour_qty = $getEstdata[0]['labour_qty'];
            $this->labour_cost = $getEstdata[0]['labour_cost'];
            $this->material_qty2 = $getEstdata[0]['material_qty2'];
            $this->material_qty3 = $getEstdata[0]['material_qty3'];
            $this->material_qty4 = $getEstdata[0]['material_qty4'];
            $this->material_qty5 = $getEstdata[0]['material_qty5'];
            $this->material_qty6 = $getEstdata[0]['material_qty6'];
            $this->material_qty7 = $getEstdata[0]['material_qty7'];
            $this->material_qty8 = $getEstdata[0]['material_qty8'];
            $this->material_qty9 = $getEstdata[0]['material_qty9'];
            $this->material_qty10 = $getEstdata[0]['material_qty10'];
            $this->labour_qty2 = $getEstdata[0]['labour_qty2'];
            $this->labour_qty3 = $getEstdata[0]['labour_qty3'];
            $this->labour_qty4 = $getEstdata[0]['labour_qty4'];
            $this->labour_qty5 = $getEstdata[0]['labour_qty5'];
            $this->labour_qty6 = $getEstdata[0]['labour_qty6'];
            $this->labour_qty7 = $getEstdata[0]['labour_qty7'];
            $this->labour_qty8 = $getEstdata[0]['labour_qty8'];
            $this->labour_qty9 = $getEstdata[0]['labour_qty9'];
            $this->labour_qty10 = $getEstdata[0]['labour_qty10'];
            $this->material_cost2 = $getEstdata[0]['material_cost2'];
            $this->material_cost3 = $getEstdata[0]['material_cost3'];
            $this->material_cost4 = $getEstdata[0]['material_cost4'];
            $this->material_cost5 = $getEstdata[0]['material_cost5'];
            $this->material_cost6 = $getEstdata[0]['material_cost6'];
            $this->material_cost7 = $getEstdata[0]['material_cost7'];
            $this->material_cost8 = $getEstdata[0]['material_cost8'];
            $this->material_cost9 = $getEstdata[0]['material_cost9'];
            $this->material_cost10 = $getEstdata[0]['material_cost10'];
            $this->labour_cost2 = $getEstdata[0]['labour_cost2'];
            $this->labour_cost3 = $getEstdata[0]['labour_cost3'];
            $this->labour_cost4 = $getEstdata[0]['labour_cost4'];
            $this->labour_cost5 = $getEstdata[0]['labour_cost5'];
            $this->labour_cost6 = $getEstdata[0]['labour_cost6'];
            $this->labour_cost7 = $getEstdata[0]['labour_cost7'];
            $this->labour_cost8 = $getEstdata[0]['labour_cost8'];
            $this->labour_cost9 = $getEstdata[0]['labour_cost9'];
            $this->labour_cost10 = $getEstdata[0]['labour_cost10'];
            $this->manufacturer2 = $getEstdata[0]['manufacturer2'];
            $this->manufacturer3 = $getEstdata[0]['manufacturer3'];
            $this->service_item_spec2 = $getEstdata[0]['service_item_spec2'];
            $this->service_item_spec3 = $getEstdata[0]['service_item_spec3'];
            $this->other_qty = $getEstdata[0]['other_qty'];
            $this->other_cost = $getEstdata[0]['other_cost'];
            $this->sub_total = $getEstdata[0]['total_cost'];
            $this->discount = $this->discount;
            $this->admin_fee = $adminFee[0]->percent;

            if($getEstdata[0]['labour_cost'] != ""){$labour1 = $getEstdata[0]['labour_cost']; }else{$labour1 = 0;}
            if($getEstdata[0]['labour_cost2'] != ""){$labour2 = $getEstdata[0]['labour_cost2']; }else{$labour2 = 0;}
            if($getEstdata[0]['labour_cost3'] != ""){$labour3 = $getEstdata[0]['labour_cost3']; }else{$labour3 = 0;}
            if($getEstdata[0]['labour_cost4'] != ""){$labour4 = $getEstdata[0]['labour_cost4']; }else{$labour4 = 0;}
            if($getEstdata[0]['labour_cost5'] != ""){$labour5 = $getEstdata[0]['labour_cost5']; }else{$labour5 = 0;}
            if($getEstdata[0]['labour_cost6'] != ""){$labour6 = $getEstdata[0]['labour_cost6']; }else{$labour6 = 0;}
            if($getEstdata[0]['labour_cost7'] != ""){$labour7 = $getEstdata[0]['labour_cost7']; }else{$labour7 = 0;}
            if($getEstdata[0]['labour_cost8'] != ""){$labour8 = $getEstdata[0]['labour_cost8']; }else{$labour8 = 0;}
            if($getEstdata[0]['labour_cost9'] != ""){$labour9 = $getEstdata[0]['labour_cost9']; }else{$labour9 = 0;}
            if($getEstdata[0]['labour_cost10'] != ""){$labour10 = $getEstdata[0]['labour_cost10']; }else{$labour10 = 0;}

            $labourTot = $labour1 + $labour2 + $labour3 + $labour4 + $labour5 + $labour6 + $labour7 + $labour8 + $labour9 + $labour10;

            $discFee = $labourTot * ($this->discount / 100);
            $discCharge = $getEstdata[0]['total_cost'] - $discFee;

            $servFee = $discCharge * ($adminFee[0]->percent / 100);

            $serveCharge = $discCharge + $servFee;

            $this->total_cost = $serveCharge;
            $this->service_note = $getEstdata[0]['service_note'];
            $this->mileage = $getEstdata[0]['mileage'];
            $this->file = $getEstdata[0]['file'];

        // dd($this->to);

            $this->sendEmail($this->to, 'VIM File - Estimate Process');

            $resData = ['res' => 'Mail Sent', 'message' => 'success', 'link' => 'userDashboard'];
        }
        else{
            $resData = ['res' => 'Something went wrong', 'message' => 'error'];
        }



        return $this->returnJSON($resData);
    }


    public function labourstubMails(Request $req){
        // Send mail to car owners mail

        // Get data
        $getrecorddata = PaySchedule::where('estimate_id', $req->estimate_id)->where('busID', Auth::user()->busID)->get();

        if(count($getrecorddata) > 0){

            // Get email
            $userschecker = User::where('name', 'LIKE', '%'.$getrecorddata[0]->technician.'%')->where('busID', Auth::user()->busID)->get();

            if(count($userschecker) > 0){
            $this->name = Auth::user()->station_name;
            $this->to = $userschecker[0]['email'];
            // $this->to = "info@vimfile.com";
            $this->licence = $getrecorddata[0]['vehicle_licence'];
            $this->make = $getrecorddata[0]['make'];
            $this->model = $getrecorddata[0]['model'];
            $this->date = $getrecorddata[0]['date'];
            $this->service_type = $getrecorddata[0]['service_type'];
            $this->service_option = $getrecorddata[0]['service_option'];
            $this->hour = $getrecorddata[0]['hour'];
            $this->rate = $getrecorddata[0]['rate'];
            $this->pay_due = $getrecorddata[0]['pay_due'];
            $this->start_date = $getrecorddata[0]['start_date'];
            $this->end_date = $getrecorddata[0]['end_date'];
            $this->deduction = $getrecorddata[0]['deduction'];
            $this->balance = $getrecorddata[0]['balance'];
            $this->total_pay = $getrecorddata[0]['total_pay'];
            $this->cash_amount = $getrecorddata[0]['cash_amount'];
            $this->cheque_amout = $getrecorddata[0]['cheque_amout'];
            $this->creditcard_amount = $getrecorddata[0]['creditcard_amount'];
            $this->total_cost = $getrecorddata[0]['total_amount'];

        // dd($this->to);

            $this->sendEmail($this->to, 'VIM File - Labour Payment Invoice');

            $resData = ['res' => 'Mail Sent', 'message' => 'success', 'link' => 'userDashboard?c=labourschedule'];
            }
            else{
                $resData = ['res' => 'Cannot Send Mail to this technician', 'message' => 'info'];
            }


        }

        else{
            // Get data
            $getrecorddatas = LabourPaystub::where('estimate_id', $req->estimate_id)->where('busID', Auth::user()->busID)->get();

            if(count($getrecorddatas) > 0){

                // Get email
            $userscheckers = User::where('name', 'LIKE', '%'.$getrecorddatas[0]->technician.'%')->where('busID', Auth::user()->busID)->get();

            if(count($userscheckers) > 0){
            $this->name = Auth::user()->station_name;
            $this->to = $userscheckers[0]['email'];
            // $this->to = "info@vimfile.com";
            $this->licence = $getrecorddata[0]['vehicle_licence'];
            $this->make = $getrecorddata[0]['make'];
            $this->model = $getrecorddata[0]['model'];
            $this->date = $getrecorddata[0]['date'];
            $this->service_type = $getrecorddata[0]['service_type'];
            $this->service_option = $getrecorddata[0]['service_option'];
            $this->hour = $getrecorddata[0]['hour'];
            $this->rate = $getrecorddata[0]['rate'];
            $this->pay_due = $getrecorddata[0]['pay_due'];
            $this->start_date = $getrecorddata[0]['start_date'];
            $this->end_date = $getrecorddata[0]['end_date'];
            $this->deduction = $getrecorddata[0]['deduction'];
            $this->balance = $getrecorddata[0]['balance'];
            $this->total_pay = $getrecorddata[0]['total_pay'];
            $this->cash_amount = $getrecorddata[0]['cash_amount'];
            $this->cheque_amout = $getrecorddata[0]['cheque_amout'];
            $this->creditcard_amount = $getrecorddata[0]['creditcard_amount'];
            $this->total_cost = $getrecorddata[0]['total_amount'];

        // dd($this->to);

                $this->sendEmail($this->to, 'VIM File - Labour Payment Invoice');

                $resData = ['res' => 'Mail Sent', 'message' => 'success', 'link' => 'userDashboard?c=labourschedule'];
                }
                else{
                    $resData = ['res' => 'Cannot Send Mail to this technician', 'message' => 'error'];
                }

            }
            else{
                $resData = ['res' => 'Cannot Send Mail to this technician', 'message' => 'error'];
            }

        }



        return $this->returnJSON($resData);
    }

    public function vehiclebalMails(Request $req){
        // Send mail to car owners mail

        // Get data
        $getEstdata = Vehicleinfo::where('estimate_id', $req->est_id)->where('busID', Auth::user()->busID)->where('update_by', Auth::user()->station_name)->where('payment', '2')->get();

        if(count($getEstdata) > 0){
            $this->name = Auth::user()->station_name;
            $this->to = $getEstdata[0]['email'];
            // $this->to = "info@vimfile.com";
            $this->licence = $getEstdata[0]['vehicle_licence'];
            $this->make = $getEstdata[0]['make'];
            $this->model = $getEstdata[0]['model'];
            $this->phone = $getEstdata[0]['telephone'];
            $this->date = $getEstdata[0]['date'];
            $this->service_type = $getEstdata[0]['service_type'];
            $this->service_option = $getEstdata[0]['service_option'];
            $this->service_item_spec = $getEstdata[0]['service_item_spec'];
            $this->manufacturer = $getEstdata[0]['manufacturer'];
            $this->material_qty = $getEstdata[0]['material_qty'];
            $this->material_cost = $getEstdata[0]['material_cost'];
            $this->labour_qty = $getEstdata[0]['labour_qty'];
            $this->labour_cost = $getEstdata[0]['labour_cost'];
            $this->material_qty2 = $getEstdata[0]['material_qty2'];
            $this->material_qty3 = $getEstdata[0]['material_qty3'];
            $this->labour_qty2 = $getEstdata[0]['labour_qty2'];
            $this->material_cost2 = $getEstdata[0]['material_cost2'];
            $this->material_cost3 = $getEstdata[0]['material_cost3'];
            $this->labour_cost2 = $getEstdata[0]['labour_cost2'];
            $this->manufacturer2 = $getEstdata[0]['manufacturer2'];
            $this->manufacturer3 = $getEstdata[0]['manufacturer3'];
            $this->service_item_spec2 = $getEstdata[0]['service_item_spec2'];
            $this->service_item_spec3 = $getEstdata[0]['service_item_spec3'];
            $this->other_qty = $getEstdata[0]['other_qty'];
            $this->other_cost = $getEstdata[0]['other_cost'];
            $this->total_cost = $getEstdata[0]['total_cost'];
            $this->service_note = $getEstdata[0]['service_note'];
            $this->mileage = $getEstdata[0]['mileage'];
            $this->file = $getEstdata[0]['file'];

        // dd($this->to);

            $this->sendEmail($this->to, 'VIM File - Payment Receipt');

            $resData = ['res' => 'Mail Sent', 'message' => 'success', 'link' => 'userDashboard'];
        }
        else{
            $resData = ['res' => 'Something went wrong', 'message' => 'error'];
        }



        return $this->returnJSON($resData);
    }


    public function vendormail(Request $req){
        // Send mail to car owners mail

        // Get data
        $getvendata = PurchaseOrderPayment::where('post_id', $req->pay_po_number)->get();

        // get vendor mail

        if(count($getvendata) > 0){

            // GEt receiver mail
            $getmail = CreateVendor::where('vendor_name', $getvendata[0]['vendor_email'])->pluck('vendor_email');

            $this->name = Auth::user()->station_name;
            $this->to = $getmail[0];
            // $this->to = "info@vimfile.com";
            $this->pay_po_number = $getvendata[0]['pay_po_number'];
            $this->pay_order_date = $getvendata[0]['pay_order_date'];
            $this->pay_date_expected = $getvendata[0]['pay_date_expected'];
            $this->pay_invent_item = $getvendata[0]['pay_invent_item'];
            $this->pay_description_of_item = $getvendata[0]['pay_description_of_item'];
            $this->pay_quantity = $getvendata[0]['pay_quantity'];
            $this->pay_rate = $getvendata[0]['pay_rate'];
            $this->pay_tot_cost = $getvendata[0]['pay_tot_cost'];
            $this->pay_shipping_cost = $getvendata[0]['pay_shipping_cost'];
            $this->pay_discount = $getvendata[0]['pay_discount'];
            $this->pay_othercosts = $getvendata[0]['pay_othercosts'];
            $this->pay_tax = $getvendata[0]['pay_tax'];
            $this->pay_po_total = $getvendata[0]['pay_po_total'];
            $this->pay_advance = $getvendata[0]['pay_advance'];
            $this->pay_balance = $getvendata[0]['pay_balance'];
            $this->pay_cashamount = $getvendata[0]['pay_cashamount'];
            $this->pay_chequeno = $getvendata[0]['pay_chequeno'];
            $this->pay_chequedate = $getvendata[0]['pay_chequedate'];
            $this->pay_chequeamount = $getvendata[0]['pay_chequeamount'];
            $this->pay_credit = $getvendata[0]['pay_credit'];
            $this->pay_cc = $getvendata[0]['pay_cc'];
            $this->pay_cardamount = $getvendata[0]['pay_cardamount'];
            $this->pay_grandtotal = $getvendata[0]['pay_grandtotal'];

        // dd($this->to);

            $this->sendEmail($this->to, 'VIM File - Vendor Invoice');

            $resData = ['res' => 'Mail Sent', 'message' => 'success', 'link' => 'userDashboard?c=manageinventory'];
        }
        else{

            // Get data
        $getvendatas = PurchaseOrderPayment::where('post_id', $req->pay_po_number)->get();

        if(count($getvendatas) > 0){
            $this->name = Auth::user()->station_name;
            $this->to = $getvendatas[0]['vendor_email'];
            // $this->to = "info@vimfile.com";
            $this->pay_po_number = $getvendatas[0]['pay_po_number'];
            $this->pay_order_date = $getvendatas[0]['pay_order_date'];
            $this->pay_date_expected = $getvendatas[0]['pay_date_expected'];
            $this->pay_invent_item = $getvendatas[0]['pay_invent_item'];
            $this->pay_description_of_item = $getvendatas[0]['pay_description_of_item'];
            $this->pay_quantity = $getvendatas[0]['pay_quantity'];
            $this->pay_rate = $getvendatas[0]['pay_rate'];
            $this->pay_tot_cost = $getvendatas[0]['pay_tot_cost'];
            $this->pay_shipping_cost = $getvendatas[0]['pay_shipping_cost'];
            $this->pay_discount = $getvendatas[0]['pay_discount'];
            $this->pay_othercosts = $getvendatas[0]['pay_othercosts'];
            $this->pay_tax = $getvendatas[0]['pay_tax'];
            $this->pay_po_total = $getvendatas[0]['pay_po_total'];
            $this->pay_advance = $getvendatas[0]['pay_advance'];
            $this->pay_balance = $getvendatas[0]['pay_balance'];
            $this->pay_cashamount = $getvendatas[0]['pay_cashamount'];
            $this->pay_chequeno = $getvendatas[0]['pay_chequeno'];
            $this->pay_chequedate = $getvendatas[0]['pay_chequedate'];
            $this->pay_chequeamount = $getvendatas[0]['pay_chequeamount'];
            $this->pay_credit = $getvendatas[0]['pay_credit'];
            $this->pay_cc = $getvendatas[0]['pay_cc'];
            $this->pay_cardamount = $getvendatas[0]['pay_cardamount'];
            $this->pay_grandtotal = $getvendatas[0]['pay_grandtotal'];

        // dd($this->to);

            $this->sendEmail($this->to, 'VIM File - Vendor Invoice');

            $resData = ['res' => 'Mail Sent', 'message' => 'success', 'link' => 'userDashboard?c=manageinventory'];
        }
        else{
            $resData = ['res' => 'Something went wrong', 'message' => 'error'];
        }

        }



        return $this->returnJSON($resData);
    }


    public function POemail(Request $req){
        // Send mail to car owners mail

        // Get data
        $getPOdata = PurchaseOrder::where('post_id', $req->post_id)->get();

        if(count($getPOdata) > 0){
            $this->name = Auth::user()->station_name;
            $this->to = $getPOdata[0]['purchase_order_destmail'];
            // $this->to = "info@vimfile.com";
            $this->vendor = $getPOdata[0]['vendor'];
            $this->purchase_order_no = $getPOdata[0]['purchase_order_no'];
            $this->order_date = $getPOdata[0]['order_date'];
            $this->expected_date = $getPOdata[0]['expected_date'];
            $this->purchase_order_inventory_item = $getPOdata[0]['purchase_order_inventory_item'];
            $this->purchase_order_qty = $getPOdata[0]['purchase_order_qty'];
            $this->purchase_order_rate = $getPOdata[0]['purchase_order_rate'];
            $this->purchase_order_totcost = $getPOdata[0]['purchase_order_totcost'];
            $this->purchase_order_shippingcost = $getPOdata[0]['purchase_order_shippingcost'];
            $this->purchase_order_discount = $getPOdata[0]['purchase_order_discount'];
            $this->purchase_order_othercost = $getPOdata[0]['purchase_order_othercost'];
            $this->purchase_order_tax = $getPOdata[0]['purchase_order_tax'];
            $this->purchase_order_totalpurchaseorder = $getPOdata[0]['purchase_order_totalpurchaseorder'];
            $this->purchase_order_shipto = $getPOdata[0]['purchase_order_shipto'];
            $this->purchase_order_address1 = $getPOdata[0]['purchase_order_address1'];
            $this->purchase_order_address2 = $getPOdata[0]['purchase_order_address2'];
            $this->purchase_order_city = $getPOdata[0]['purchase_order_city'];
            $this->purchase_order_state = $getPOdata[0]['purchase_order_state'];
            $this->purchase_order_country = $getPOdata[0]['purchase_order_country'];
            $this->purchase_order_zip = $getPOdata[0]['purchase_order_zip'];
            $this->purchase_order_destphone = $getPOdata[0]['purchase_order_destphone'];
            $this->purchase_order_destfax = $getPOdata[0]['purchase_order_destfax'];
            $this->purchase_order_destmail = $getPOdata[0]['purchase_order_destmail'];
            $this->purchase_order_orderby = $getPOdata[0]['purchase_order_orderby'];

        // dd($this->to);

            $this->sendEmail($this->to, 'VIM File - Purchase Order');

            $resData = ['res' => 'Mail Sent', 'message' => 'success', 'link' => 'userDashboard'];
        }
        else{
            $resData = ['res' => 'Something went wrong', 'message' => 'error'];
        }



        return $this->returnJSON($resData);
    }

    public function estimatSave(Request $req){
        // Save Record
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

            // $path = $req->file('file')->move(public_path('/uploads/'), $fileNameToStore);

            $path = $req->file('file')->move(public_path('../../uploads/'), $fileNameToStore);

        }
        else
        {
            $fileNameToStore = 'noImage.png';
        }
        // Insert new record

        $estRec = Estimate::insert(['estimate_id' => $req->estimate_id, 'opportunity_id' => $req->opportunity_id, 'email' => $req->email, 'telephone' => $req->telephone, 'busID' => $req->busID, 'vehicle_licence' => $req->vehicle_licence, 'make' => $req->make, 'model' => $req->model, 'date' => $req->date, 'service_type' => $req->service_type, 'service_option' => $req->service_option, 'service_item_spec' => $req->service_item_spec, 'manufacturer' => $req->manufacturer, 'material_qty' => $req->material_qty, 'material_cost' => $req->material_cost, 'labour_qty' => $req->labour_qty, 'labour_cost' => $req->labour_cost,'material_qty2' => $req->material_qty2,'material_qty3' => $req->material_qty3,'material_qty4' => $req->material_qty4,'material_qty5' => $req->material_qty5,'material_qty6' => $req->material_qty6,'material_qty7' => $req->material_qty7,'material_qty8' => $req->material_qty8,'material_qty9' => $req->material_qty9,'material_qty10' => $req->material_qty10,'labour_qty2' => $req->labour_qty2,'labour_qty3' => $req->labour_qty3,'labour_qty4' => $req->labour_qty4,'labour_qty5' => $req->labour_qty5,'labour_qty6' => $req->labour_qty6,'labour_qty7' => $req->labour_qty7,'labour_qty8' => $req->labour_qty8,'labour_qty9' => $req->labour_qty9,'labour_qty10' => $req->labour_qty10,'material_cost2' => $req->material_cost2,'material_cost3' => $req->material_cost3,'material_cost4' => $req->material_cost4,'material_cost5' => $req->material_cost5,'material_cost6' => $req->material_cost6,'material_cost7' => $req->material_cost7,'material_cost8' => $req->material_cost8,'material_cost9' => $req->material_cost9,'material_cost10' => $req->material_cost10,'labour_cost2' => $req->labour_cost2,'labour_cost3' => $req->labour_cost3,'labour_cost4' => $req->labour_cost4,'labour_cost5' => $req->labour_cost5,'labour_cost6' => $req->labour_cost6,'labour_cost7' => $req->labour_cost7,'labour_cost8' => $req->labour_cost8,'labour_cost9' => $req->labour_cost9,'labour_cost10' => $req->labour_cost10, 'labour_hour' => $req->labour_hour, 'labour_rate' => $req->labour_rate, 'manufacturer2' => $req->manufacturer2, 'manufacturer3' => $req->manufacturer3, 'service_item_spec2' => $req->service_item_spec2, 'service_item_spec3' => $req->service_item_spec3, 'other_qty' => $req->other_qty, 'other_cost' => $req->other_cost, 'total_cost' => $req->total_cost, 'service_note' => $req->service_note, 'mileage' => $req->mileage, 'file' => $fileNameToStore, 'update_by' => $req->update_by, 'estimate' => '1', 'work_order' => '0', 'diagnostics' => '0', 'inventory_list' => $req->inventory_list1, 'inventory_amount' => $req->inventory_amount1, 'inventory_note' => $req->inventory_addnote1, 'inventory_list2' => $req->inventory_list2, 'inventory_amount2' => $req->inventory_amount2, 'inventory_note2' => $req->inventory_addnote2, 'inventory_list3' => $req->inventory_list3, 'inventory_amount3' => $req->inventory_amount3, 'inventory_note3' => $req->inventory_addnote3, 'technician' => $req->technician]);

        if($req->opportunity_id != ""){
        PrepareEstimate::where('post_id', $req->opportunity_id)->update(['estimate_id' => $req->estimate_id, 'est_prepared' => '1']);
        }

        // dd($estRec);

        if($estRec == true){

            // Get Discount
            $mydiscount = clientMinimum::where('busID', $req->busID)->get();
            $adminFee = MinimumDiscount::where('discount', 'service')->get();

            if(count($mydiscount) > 0){
                $this->discount = $mydiscount[0]->percent;
            }
            else{
                // Get Admin Discount
                $adminDiscount = MinimumDiscount::where('discount', 'discount')->get();

                $this->discount = $adminDiscount[0]->percent;
            }

            $getData = Estimate::where('estimate_id', $req->estimate_id)->where('estimate', '1')->get();

            $this->name = Auth::user()->station_name;
            $this->to = $req->email;
            // $this->to = "info@vimfile.com";
            $this->licence = $req->vehicle_licence;
            $this->make = $req->make;
            $this->model = $req->model;
            $this->phone = $req->telephone;
            $this->date = $req->date;
            $this->service_type = $req->service_type;
            $this->service_option = $req->service_option;
            $this->service_item_spec = $req->service_item_spec;
            $this->manufacturer = $req->manufacturer;
            $this->material_qty = $req->material_qty;
            $this->material_cost = $req->material_cost;
            $this->labour_qty = $req->labour_qty;
            $this->labour_cost = $req->labour_cost;
            $this->material_qty2 = $req->material_qty2;
            $this->material_qty3 = $req->material_qty3;
            $this->material_qty4 = $req->material_qty4;
            $this->material_qty5 = $req->material_qty5;
            $this->material_qty6 = $req->material_qty6;
            $this->material_qty7 = $req->material_qty7;
            $this->material_qty8 = $req->material_qty8;
            $this->material_qty9 = $req->material_qty9;
            $this->material_qty10 = $req->material_qty10;
            $this->labour_qty2 = $req->labour_qty2;
            $this->labour_qty3 = $req->labour_qty3;
            $this->labour_qty4 = $req->labour_qty4;
            $this->labour_qty5 = $req->labour_qty5;
            $this->labour_qty6 = $req->labour_qty6;
            $this->labour_qty7 = $req->labour_qty7;
            $this->labour_qty8 = $req->labour_qty8;
            $this->labour_qty9 = $req->labour_qty9;
            $this->labour_qty10 = $req->labour_qty10;
            $this->material_cost2 = $req->material_cost2;
            $this->material_cost3 = $req->material_cost3;
            $this->material_cost4 = $req->material_cost4;
            $this->material_cost5 = $req->material_cost5;
            $this->material_cost6 = $req->material_cost6;
            $this->material_cost7 = $req->material_cost7;
            $this->material_cost8 = $req->material_cost8;
            $this->material_cost9 = $req->material_cost9;
            $this->material_cost10 = $req->material_cost10;
            $this->labour_cost2 = $req->labour_cost2;
            $this->labour_cost3 = $req->labour_cost3;
            $this->labour_cost4 = $req->labour_cost4;
            $this->labour_cost5 = $req->labour_cost5;
            $this->labour_cost6 = $req->labour_cost6;
            $this->labour_cost7 = $req->labour_cost7;
            $this->labour_cost8 = $req->labour_cost8;
            $this->labour_cost9 = $req->labour_cost9;
            $this->labour_cost10 = $req->labour_cost10;
            $this->manufacturer2 = $req->manufacturer2;
            $this->manufacturer3 = $req->manufacturer3;
            $this->service_item_spec2 = $req->service_item_spec2;
            $this->service_item_spec3 = $req->service_item_spec3;
            $this->other_qty = $req->other_qty;
            $this->other_cost = $req->other_cost;

            $this->sub_total = $req->total_cost;
            $this->discount = $this->discount;
            $this->admin_fee = $adminFee[0]->percent;

            if($req->labour_cost != ""){$labour1 = $req->labour_cost; }else{$labour1 = 0;}
            if($req->labour_cost2 != ""){$labour2 = $req->labour_cost2; }else{$labour2 = 0;}
            if($req->labour_cost3 != ""){$labour3 = $req->labour_cost3; }else{$labour3 = 0;}
            if($req->labour_cost4 != ""){$labour4 = $req->labour_cost4; }else{$labour4 = 0;}
            if($req->labour_cost5 != ""){$labour5 = $req->labour_cost5; }else{$labour5 = 0;}
            if($req->labour_cost6 != ""){$labour6 = $req->labour_cost6; }else{$labour6 = 0;}
            if($req->labour_cost7 != ""){$labour7 = $req->labour_cost7; }else{$labour7 = 0;}
            if($req->labour_cost8 != ""){$labour8 = $req->labour_cost8; }else{$labour8 = 0;}
            if($req->labour_cost9 != ""){$labour9 = $req->labour_cost9; }else{$labour9 = 0;}
            if($req->labour_cost10 != ""){$labour10 = $req->labour_cost10; }else{$labour10 = 0;}

            $labourTot = $labour1 + $labour2 + $labour3 + $labour4 + $labour5 + $labour6 + $labour7 + $labour8 + $labour9 + $labour10;

            $discFee = $labourTot * ($this->discount / 100);
            $discCharge = $req->total_cost - $discFee;

            $servFee = $discCharge * ($adminFee[0]->percent / 100);

            $serveCharge = $discCharge + $servFee;

            $this->total_cost = $serveCharge;
            $this->service_note = $req->service_note;
            $this->mileage = $req->mileage;
            $this->file = $fileNameToStore;

        // dd($this->to);

        $this->sendEmail($this->to, 'VIM File - Estimate Process');


        $resData = ['res' => 'Maintenance Estimation Saved', 'message' => 'success', 'info' => $req->estimate_id, 'email' => $req->email, 'data' => json_encode($getData)];
        }
        else{
            $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
        }



        return $this->returnJSON($resData);
    }


    public function workorderSave(Request $req){
        // Save Record
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

            // $path = $req->file('file')->move(public_path('/uploads/'), $fileNameToStore);

            $path = $req->file('file')->move(public_path('../../uploads/'), $fileNameToStore);

        }
        else
        {
            $fileNameToStore = 'noImage.png';
        }
        // Insert new record

        $getpart = Addpart::where('post_id', $req->opportunity_id)->get();

        if(count($getPart) > 0){
            $this->getPart = $getPart;
        }
        else{
            $this->getPart = 0;
        }

        $sumTotal = $req->total_cost + $this->getPart;

        $estRec = Estimate::insert(['estimate_id' => $req->estimate_id, 'opportunity_id' => $req->opportunity_id, 'email' => $req->email, 'telephone' => $req->telephone, 'busID' => $req->busID, 'vehicle_licence' => $req->vehicle_licence, 'make' => $req->make, 'model' => $req->model, 'date' => $req->date, 'service_type' => $req->service_type, 'service_option' => $req->service_option, 'service_item_spec' => $req->service_item_spec, 'manufacturer' => $req->manufacturer, 'material_qty' => $req->material_qty, 'material_cost' => $req->material_cost, 'labour_qty' => $req->labour_qty, 'labour_cost' => $req->labour_cost,'material_qty2' => $req->material_qty2,'material_qty3' => $req->material_qty3,'material_qty4' => $req->material_qty4,'material_qty5' => $req->material_qty5,'material_qty6' => $req->material_qty6,'material_qty7' => $req->material_qty7,'material_qty8' => $req->material_qty8,'material_qty9' => $req->material_qty9,'material_qty10' => $req->material_qty10,'labour_qty2' => $req->labour_qty2,'labour_qty3' => $req->labour_qty3,'labour_qty4' => $req->labour_qty4,'labour_qty5' => $req->labour_qty5,'labour_qty6' => $req->labour_qty6,'labour_qty7' => $req->labour_qty7,'labour_qty8' => $req->labour_qty8,'labour_qty9' => $req->labour_qty9,'labour_qty10' => $req->labour_qty10, 'material_cost2' => $req->material_cost2,'material_cost3' => $req->material_cost3,'material_cost4' => $req->material_cost4,'material_cost5' => $req->material_cost5,'material_cost6' => $req->material_cost6,'material_cost7' => $req->material_cost7,'material_cost8' => $req->material_cost8,'material_cost9' => $req->material_cost9,'material_cost10' => $req->material_cost10,'labour_cost2' => $req->labour_cost2,'labour_cost3' => $req->labour_cost3,'labour_cost4' => $req->labour_cost4,'labour_cost5' => $req->labour_cost5,'labour_cost6' => $req->labour_cost6,'labour_cost7' => $req->labour_cost7,'labour_cost8' => $req->labour_cost8,'labour_cost9' => $req->labour_cost9,'labour_cost10' => $req->labour_cost10, 'manufacturer2' => $req->manufacturer2, 'manufacturer3' => $req->manufacturer3, 'service_item_spec2' => $req->service_item_spec2, 'service_item_spec3' => $req->service_item_spec3, 'other_qty' => $req->other_qty, 'other_cost' => $req->other_cost, 'total_cost' => $sumTotal, 'service_note' => $req->service_note, 'mileage' => $req->mileage, 'file' => $fileNameToStore, 'update_by' => $req->update_by, 'estimate' => '0', 'work_order' => '1', 'diagnostics' => '0', 'inventory_list' => $req->inventory_list1, 'inventory_amount' => $req->inventory_amount1, 'inventory_note' => $req->inventory_addnote1, 'inventory_list2' => $req->inventory_list2, 'inventory_amount2' => $req->inventory_amount2, 'inventory_note2' => $req->inventory_addnote2, 'inventory_list3' => $req->inventory_list3, 'inventory_amount3' => $req->inventory_amount3, 'inventory_note3' => $req->inventory_addnote3, 'technician' => $req->technician]);

        // dd($estRec);

        if($estRec == true){

            $getWOData = Estimate::where('estimate_id', $req->estimate_id)->where('work_order', '1')->get();

            // Update Create Inventory Table;
            $minQtys = CreateInventoryItem::where('description', $req->inventory_list1)->where('busID', $req->busID)->get();
            $minQtys2 = CreateInventoryItem::where('description', $req->inventory_list2)->where('busID', $req->busID)->get();
            $minQtys3 = CreateInventoryItem::where('description', $req->inventory_list3)->where('busID', $req->busID)->get();

            if(count($minQtys) > 0){
                // Update
                $matQty = $req->material_qty;
                $newRes = $minQtys[0]['qtyathand'] - $matQty;

                CreateInventoryItem::where('description', $req->inventory_list1)->where('busID', $req->busID)->update(['qtyathand' => $newRes]);
            }
            else{
                $resData = ['res' => 'Inventory out of store', 'message' => 'warning'];
            }

            if(count($minQtys2) > 0){
                // Update
                $matQty2 = $req->material_qty2;
                $newRes2 = $minQtys2[0]['qtyathand'] - $matQty2;

                CreateInventoryItem::where('description', $req->inventory_list2)->where('busID', $req->busID)->update(['qtyathand' => $newRes2]);
            }
            else
            {
                $resData = ['res' => 'Inventory out of store', 'message' => 'warning'];
            }
            if(count($minQtys3) > 0){
                // Update
                $matQty3 = $req->material_qty3;
                $newRes3 = $minQtys3[0]['qtyathand'] - $matQty3;

                CreateInventoryItem::where('description', $req->inventory_list3)->where('busID', $req->busID)->update(['qtyathand' => $newRes3]);
            }
            else
            {
                $resData = ['res' => 'Inventory out of store', 'message' => 'warning'];
            }

            // Get Discount
            $mydiscount = clientMinimum::where('busID', $req->busID)->get();
            $adminFee = MinimumDiscount::where('discount', 'service')->get();

            if(count($mydiscount) > 0){
                $this->discount = $mydiscount[0]->percent;
            }
            else{
                // Get Admin Discount
                $adminDiscount = MinimumDiscount::where('discount', 'discount')->get();

                $this->discount = $adminDiscount[0]->percent;
            }


            $this->name = Auth::user()->station_name;
            $this->to = $req->email;
            // $this->to = "info@vimfile.com";
            $this->licence = $req->vehicle_licence;
            $this->make = $req->make;
            $this->model = $req->model;
            $this->phone = $req->telephone;
            $this->date = $req->date;
            $this->service_type = $req->service_type;
            $this->service_option = $req->service_option;
            $this->service_item_spec = $req->service_item_spec;
            $this->manufacturer = $req->manufacturer;
            $this->material_qty = $req->material_qty;
            $this->material_cost = $req->material_cost;
            $this->labour_qty = $req->labour_qty;
            $this->labour_cost = $req->labour_cost;
            $this->material_qty2 = $req->material_qty2;
            $this->material_qty3 = $req->material_qty3;
            $this->material_qty4 = $req->material_qty4;
            $this->material_qty5 = $req->material_qty5;
            $this->material_qty6 = $req->material_qty6;
            $this->material_qty7 = $req->material_qty7;
            $this->material_qty8 = $req->material_qty8;
            $this->material_qty9 = $req->material_qty9;
            $this->material_qty10 = $req->material_qty10;
            $this->labour_qty2 = $req->labour_qty2;
            $this->labour_qty3 = $req->labour_qty3;
            $this->labour_qty4 = $req->labour_qty4;
            $this->labour_qty5 = $req->labour_qty5;
            $this->labour_qty6 = $req->labour_qty6;
            $this->labour_qty7 = $req->labour_qty7;
            $this->labour_qty8 = $req->labour_qty8;
            $this->labour_qty9 = $req->labour_qty9;
            $this->labour_qty10 = $req->labour_qty10;
            $this->material_cost2 = $req->material_cost2;
            $this->material_cost3 = $req->material_cost3;
            $this->material_cost4 = $req->material_cost4;
            $this->material_cost5 = $req->material_cost5;
            $this->material_cost6 = $req->material_cost6;
            $this->material_cost7 = $req->material_cost7;
            $this->material_cost8 = $req->material_cost8;
            $this->material_cost9 = $req->material_cost9;
            $this->material_cost10 = $req->material_cost10;
            $this->labour_cost2 = $req->labour_cost2;
            $this->labour_cost3 = $req->labour_cost3;
            $this->labour_cost4 = $req->labour_cost4;
            $this->labour_cost5 = $req->labour_cost5;
            $this->labour_cost6 = $req->labour_cost6;
            $this->labour_cost7 = $req->labour_cost7;
            $this->labour_cost8 = $req->labour_cost8;
            $this->labour_cost9 = $req->labour_cost9;
            $this->labour_cost10 = $req->labour_cost10;
            $this->manufacturer2 = $req->manufacturer2;
            $this->manufacturer3 = $req->manufacturer3;
            $this->service_item_spec2 = $req->service_item_spec2;
            $this->service_item_spec3 = $req->service_item_spec3;
            $this->other_qty = $req->other_qty;
            $this->other_cost = $req->other_cost;

            $this->sub_total = $req->total_cost;
            $this->discount = $this->discount;
            $this->admin_fee = $adminFee[0]->percent;

            if($req->labour_cost != ""){$labour1 = $req->labour_cost; }else{$labour1 = 0;}
            if($req->labour_cost2 != ""){$labour2 = $req->labour_cost2; }else{$labour2 = 0;}
            if($req->labour_cost3 != ""){$labour3 = $req->labour_cost3; }else{$labour3 = 0;}
            if($req->labour_cost4 != ""){$labour4 = $req->labour_cost4; }else{$labour4 = 0;}
            if($req->labour_cost5 != ""){$labour5 = $req->labour_cost5; }else{$labour5 = 0;}
            if($req->labour_cost6 != ""){$labour6 = $req->labour_cost6; }else{$labour6 = 0;}
            if($req->labour_cost7 != ""){$labour7 = $req->labour_cost7; }else{$labour7 = 0;}
            if($req->labour_cost8 != ""){$labour8 = $req->labour_cost8; }else{$labour8 = 0;}
            if($req->labour_cost9 != ""){$labour9 = $req->labour_cost9; }else{$labour9 = 0;}
            if($req->labour_cost10 != ""){$labour10 = $req->labour_cost10; }else{$labour10 = 0;}

            $labourTot = $labour1 + $labour2 + $labour3 + $labour4 + $labour5 + $labour6 + $labour7 + $labour8 + $labour9 + $labour10;

            $discFee = $labourTot * ($this->discount / 100);
            $discCharge = $req->total_cost - $discFee;

            $servFee = $discCharge * ($adminFee[0]->percent / 100);

            $serveCharge = $discCharge + $servFee;

            $this->total_cost = $serveCharge;
            $this->service_note = $req->service_note;
            $this->mileage = $req->mileage;
            $this->file = $fileNameToStore;

        // dd($this->to);

        $this->sendEmail($this->to, 'VIM File - Estimate Process');


            $resData = ['res' => 'Maintenance Work Order Saved', 'message' => 'success', 'info' => $req->estimate_id, 'email' => $req->email, 'data' => json_encode($getWOData)];
        }
        else{
            $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
        }

        return $this->returnJSON($resData);
    }

    public function moveWorkorder(Request $req){
        // Get id
        $getEstval = Estimate::where('estimate_id', $req->post_id)->get();

        if(count($getEstval) > 0){
            // Update table

            // Technician Payment == 1 means Job completed, when 2 means Paid

            Estimate::where('estimate_id', $req->post_id)->update(['estimate' => '0', 'work_order' => '1', 'diagnostics' => '0', 'technician_payment' => '1']);

            $getWO = Estimate::where('estimate_id', $req->post_id)->where('work_order', '1')->get();

            // Update Create Inventory Table;
            $minQtys = CreateInventoryItem::where('description', $req->inventory_list1)->where('busID', $req->busID)->get();
            $minQtys2 = CreateInventoryItem::where('description', $req->inventory_list2)->where('busID', $req->busID)->get();
            $minQtys3 = CreateInventoryItem::where('description', $req->inventory_list3)->where('busID', $req->busID)->get();

            if(count($minQtys) > 0){
                // Update
                $matQty = $req->material_qty;
                $newRes = $minQty[0]['qtyathand'] - $matQty;

                CreateInventoryItem::where('description', $req->inventory_list1)->where('busID', $req->busID)->update(['qtyathand' => $newRes]);
            }
            else{
                $resData = ['res' => 'Inventory out of store', 'message' => 'warning'];
            }

            if(count($minQtys2) > 0){
                // Update
                $matQty2 = $req->material_qty2;
                $newRes2 = $minQty[0]['qtyathand'] - $matQty2;

                CreateInventoryItem::where('description', $req->inventory_list2)->where('busID', $req->busID)->update(['qtyathand' => $newRes2]);
            }
            else
            {
                $resData = ['res' => 'Inventory out of store', 'message' => 'warning'];
            }
            if(count($minQtys3) > 0){
                // Update
                $matQty3 = $req->material_qty3;
                $newRes3 = $minQty[0]['qtyathand'] - $matQty3;

                CreateInventoryItem::where('description', $req->inventory_list3)->where('busID', $req->busID)->update(['qtyathand' => $newRes3]);
            }
            else
            {
                $resData = ['res' => 'Inventory out of store', 'message' => 'warning'];
            }

            // Send Mail

            $resData = ['res' => 'Successfully transferred to work order', 'message' => 'success', 'info' => $req->post_id, 'data' => json_encode($getWO)];
        }
        else{
            $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
        }

        return $this->returnJSON($resData);
    }


    public function movemaintenanceOrder(Request $req){
        // Get id
        $getrecs = Estimate::where('estimate_id', $req->post_id)->where('work_order', '1')->get();

        if(count($getrecs) > 0){

            // dd($getrecs);
            // Update table
            $insVehicleinfo = Vehicleinfo::insert(['estimate_id' => $req->post_id, 'opportunity_id' => $req->opportunity_id, 'email' => $getrecs[0]['email'], 'telephone' => $getrecs[0]['telephone'], 'busID' => $getrecs[0]['busID'], 'vehicle_licence' => $getrecs[0]['vehicle_licence'], 'date' => $getrecs[0]['date'], 'service_type' => $getrecs[0]['service_type'], 'make' => $getrecs[0]['make'], 'model' => $getrecs[0]['model'], 'service_option' => $getrecs[0]['service_option'], 'service_item_spec' => $getrecs[0]['service_item_spec'], 'manufacturer' => $getrecs[0]['manufacturer'], 'material_qty' => $getrecs[0]['material_qty'], 'material_cost' => $getrecs[0]['material_cost'], 'labour_qty' => $getrecs[0]['labour_qty'], 'labour_cost' => $getrecs[0]['labour_cost'], 'other_qty' => $getrecs[0]['other_qty'], 'other_cost' => $getrecs[0]['other_cost'], 'total_cost' => $getrecs[0]['total_cost'], 'service_note' => $getrecs[0]['service_note'], 'mileage' => $getrecs[0]['mileage'], 'chassis_no' => $getrecs[0]['chassis_no'], 'location' => $getrecs[0]['location'], 'file' => $getrecs[0]['file'], 'update_by' => $getrecs[0]['update_by'], 'material_qty2' => $getrecs[0]['material_qty2'], 'material_qty3' => $getrecs[0]['material_qty3'],'material_qty4' => $getrecs[0]['material_qty4'],'material_qty5' => $getrecs[0]['material_qty5'],'material_qty6' => $getrecs[0]['material_qty6'],'material_qty7' => $getrecs[0]['material_qty7'],'material_qty8' => $getrecs[0]['material_qty8'],'material_qty9' => $getrecs[0]['material_qty9'],'material_qty10' => $getrecs[0]['material_qty10'], 'labour_qty2' => $getrecs[0]['labour_qty2'],'labour_qty3' => $getrecs[0]['labour_qty3'],'labour_qty3' => $getrecs[0]['labour_qty3'],'labour_qty4' => $getrecs[0]['labour_qty4'],'labour_qty5' => $getrecs[0]['labour_qty5'],'labour_qty6' => $getrecs[0]['labour_qty6'],'labour_qty7' => $getrecs[0]['labour_qty7'],'labour_qty8' => $getrecs[0]['labour_qty8'],'labour_qty9' => $getrecs[0]['labour_qty9'],'labour_qty10' => $getrecs[0]['labour_qty10'], 'material_cost2' => $getrecs[0]['material_cost2'], 'material_cost3' => $getrecs[0]['material_cost3'],'material_cost4' => $getrecs[0]['material_cost4'],'material_cost5' => $getrecs[0]['material_cost5'],'material_cost6' => $getrecs[0]['material_cost6'],'material_cost7' => $getrecs[0]['material_cost7'],'material_cost8' => $getrecs[0]['material_cost8'],'material_cost9' => $getrecs[0]['material_cost9'],'material_cost10' => $getrecs[0]['material_cost10'], 'labour_cost2' => $getrecs[0]['labour_cost2'],'labour_cost3' => $getrecs[0]['labour_cost3'],'labour_cost4' => $getrecs[0]['labour_cost4'],'labour_cost5' => $getrecs[0]['labour_cost5'],'labour_cost6' => $getrecs[0]['labour_cost6'],'labour_cost7' => $getrecs[0]['labour_cost7'],'labour_cost8' => $getrecs[0]['labour_cost8'],'labour_cost9' => $getrecs[0]['labour_cost9'],'labour_cost10' => $getrecs[0]['labour_cost10'],'labour_hour' => $getrecs[0]['labour_hour'],'labour_rate' => $getrecs[0]['labour_rate'], 'manufacturer2' => $getrecs[0]['manufacturer2'], 'manufacturer3' => $getrecs[0]['manufacturer3'], 'service_item_spec2' => $getrecs[0]['service_item_spec2'], 'service_item_spec3' => $getrecs[0]['service_item_spec3'], 'inventory_list' => $getrecs[0]['inventory_list1'], 'inventory_amount' => $getrecs[0]['inventory_amount1'], 'inventory_note' => $getrecs[0]['inventory_addnote1'], 'inventory_list2' => $getrecs[0]['inventory_list2'], 'inventory_amount2' => $getrecs[0]['inventory_amount2'], 'inventory_note2' => $getrecs[0]['inventory_addnote2'], 'inventory_list3' => $getrecs[0]['inventory_list3'], 'inventory_amount3' => $getrecs[0]['inventory_amount3'], 'inventory_note3' => $getrecs[0]['inventory_addnote3'], 'technician' => $getrecs[0]['technician']]);

            if($insVehicleinfo == true){
                Estimate::where('estimate_id', $req->post_id)->update(['estimate' => '0', 'work_order' => '0', 'diagnostics' => '0', 'maintenance' => '1']);
                Vehicleinfo::where('estimate_id', $req->post_id)->where('date', $getrecs[0]['date'])->update(['payment' => '1']);

                $userDet = User::where('email', $getrecs[0]->email)->get();

                // Get Company
                $coy = Business::where('busID', $getrecs[0]['busID'])->get();
                // Station Address
                    $stationAddress = Stations::where('station_name', $getrecs[0]['update_by'])->get();

                if(count($coy) > 0){

                    $companyNameis = $coy[0]->company_name.', ('.$getrecs[0]['update_by'].', '.$stationAddress[0]['station_address'].')';
                }
                else{
                    $companyNameis = $getrecs[0]['update_by'].', '.$stationAddress[0]['station_address'];
                }

                // Send Mail
            $this->to = $getrecs[0]['email'];
                // $this->to = "info@vimfile.com";
                $this->name = $userDet[0]->name;
            $this->from = $companyNameis;
            $this->licence = $getrecs[0]['vehicle_licence'];
            $this->make = $getrecs[0]['make'];
            $this->model = $getrecs[0]['model'];
            $this->date = $getrecs[0]['date'];
            $this->mileage = $getrecs[0]['mileage'];
            $this->content1 = 'Service Option: '.$getrecs[0]['service_option'];
            $this->content2 = 'Service Type: '.$getrecs[0]['service_type'];
            $this->content3 = 'Total Cost: '.$getrecs[0]['total_cost'];

            $this->sendEmail($this->to, 'VIM File - New Maintenace Record');

            $this->sendEmail($this->to, 'Your vehicle maintenance is completed');

            $resData = ['res' => 'Successfully completed Maintenace', 'message' => 'success', 'link' => 'userDashboard'];
            }



        }
        else{
            $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
        }

        return $this->returnJSON($resData);
    }

    public function diagnostics(Request $req){
        // Get id
        $getdiagRec = Estimate::where('estimate_id', $req->post_id)->get();

        if(count($getdiagRec) > 0){

            Estimate::where('estimate_id', $req->post_id)->update(['estimate' => '0', 'work_order' => '0', 'diagnostics' => '1', ]);
            // Get Data
            $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($getdiagRec)];
        }
        else{
            $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
        }

        return $this->returnJSON($resData);
    }


    public function processPayment(Request $req){
        // Get id
        $insPayment = ReceivePayment::insert(['busID' => Auth::user()->busID,'vehicle_licence' => $req->licence, 'maintenace_date' => $req->maintenace_date, 'service_option' => $req->service_option, 'service_type' => $req->service_type, 'total_bill_amount' => $req->total_bill_amount, 'deposit_made' => $req->deposit_made, 'additional_payment' => $req->additional_payment, 'cash_payment_amount' => $req->cash_payment, 'cheque_no' => $req->cheque_payment_number, 'cheque_date' => $req->cheque_payment_date, 'cheque_amount' => $req->cheque_payment_amount, 'creditcard_no' => $req->card_number, 'creditcard_cc' => $req->cc, 'creditcard_amount' => $req->card_amount, 'total_payment_made' => $req->total_payment_made, 'spec_payment_type' => $req->spec_payment_type]);

        if($insPayment == true){
            // Update Maintenance Record
            // Make 2, paid, 1 repesent not paid
            Vehicleinfo::where('vehicle_licence', $req->licence)->where('date', $req->maintenace_date)->update(['payment' => '2']);
            $resData = ['res' => 'Process Completed', 'message' => 'success', 'vehicle_licence' => $req->licence];
        }
        else{
            $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
        }

        return $this->returnJSON($resData);
    }

    public function checkcompletedWorks(Request $req){
        // Get id
        $inscheck = Estimate::where('vehicle_licence', $req->licence)->where('busID', Auth::user()->busID)->where('maintenance', '1')->orderBy('created_at', 'DESC')->get();

        // dd($inscheck);

        if(count($inscheck) > 0){
            $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($inscheck)];
        }
        else{
            $resData = ['res' => 'No outstanding invoice', 'message' => 'info'];
        }

        return $this->returnJSON($resData);
    }

    public function checkdiaginvoice(Request $req){
        // Get id
        $insdiagcheck = Estimate::where('vehicle_licence', $req->licence)->where('busID', Auth::user()->busID)->where('diagnostics', '1')->orderBy('created_at', 'DESC')->get();

        // dd($inscheck);

        if(count($insdiagcheck) > 0){
            $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($insdiagcheck)];
        }
        else{
            $resData = ['res' => 'No outstanding invoice', 'message' => 'info'];
        }

        return $this->returnJSON($resData);
    }

    public function getPaymentRec(Request $req){
        // Get id
        $getpayCheck = Estimate::where('id', $req->id)->where('busID', Auth::user()->busID)->get();

        // dd($inscheck);

        if(count($getpayCheck) > 0){
            $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($getpayCheck)];
        }
        else{
            $resData = ['res' => 'No available invoice for the selected item', 'message' => 'info'];
        }

        return $this->returnJSON($resData);
    }

    public function moveEstimateorder(Request $req){
        // Get id
        $getEstval = Estimate::where('estimate_id', $req->post_id)->get();

        if(count($getEstval) > 0){
            // Update table
            Estimate::where('estimate_id', $req->post_id)->update(['estimate' => '1', 'work_order' => '0', 'diagnostics' => '0']);

            // Start Addition

            $getEO = Estimate::where('estimate_id', $req->post_id)->where('estimate', '1')->get();

            // Update Create Inventory Table;
            $minQtyzs = CreateInventoryItem::where('post_id', $req->post_id)->where('busID', $req->busID)->get();

            if(count($minQtyzs) > 0){
                // Update
                $matQtys = $getEO[0]['material_qty']+$getEO[0]['material_qty2']+$getEO[0]['material_qty3']+$getEO[0]['material_qty4']+$getEO[0]['material_qty5']+$getEO[0]['material_qty6']+$getEO[0]['material_qty7']+$getEO[0]['material_qty8']+$getEO[0]['material_qty9']+$getEO[0]['material_qty10'];

                $newReses = $minQty[0]['qtyathand'] + $matQtys;

                CreateInventoryItem::where('post_id', $req->post_id)->where('busID', $req->busID)->update(['qtyathand' => $newReses]);
            }
            else{
                $resData = ['res' => 'Inventory out of store', 'message' => 'warning'];
            }

            // End Addition





            $resData = ['res' => 'Successfully moved to estimate record', 'message' => 'success', 'info' => $req->post_id, 'data' => json_encode($getEO)];
        }
        else{
            $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
        }

        return $this->returnJSON($resData);
    }

    public function addnewPart(Request $req){

        $req = request();

        if($req->file('part_warranty'))
        {
            //Get filename with extension
            $filenameWithExt = $req->file('part_warranty')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
            // Get just extension
            $extension = $req->file('part_warranty')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = rand().'_'.time().'.'.$extension;
            //Upload Image
            // $path = $req->file('file')->storeAs('public/uploads', $fileNameToStore);

            // $path = $req->file('part_warranty')->move(public_path('/partsDocs/'), $fileNameToStore);

            $path = $req->file('part_warranty')->move(public_path('../../partsDocs/'), $fileNameToStore);

        }
        else
        {
            $fileNameToStore = 'noImage.png';
        }
        // Insert new record
        $addnewPart = Addpart::insert(['busID' => Auth::user()->busID, 'post_id' => $req->post_id, 'part_no' => $req->part_number, 'description' => $req->part_description, 'category' => $req->part_category, 'upload' => $fileNameToStore, 'vendor_code' => $req->vendor_code, 'vendor' => $req->vendor, 'manufacturer' => $req->part_manufacturer, 'location' => $req->part_location, 'quantity' => $req->items_qty, 'unit_cost' => $req->items_unit_cost, 'total_cost' => $req->items_total_cost, 'mark_up' => $req->item_mark_up, 'discount' => $req->item_discount, 'unit_price' => $req->item_unit_price, 'total_discount' => $req->item_total_discount, 'tax_rate' => $req->item_tax_rate, 'total_price' => $req->item_total_price, 'technician' => $req->assigned_technician]);




        if($addnewPart == true){

            // Start Vendor Profile
            $getVendchecker = CreateVendor::where('vendor_email', $req->vendor)->where('busID', Auth::user()->busID)->get();
        if(count($getVendchecker) > 0){
            // Update Vendor
            $updtVendorer = CreateVendor::where('vendor_email', $req->vendor)->where('busID', Auth::user()->busID)->update(['busID' => Auth::user()->busID, 'vendor_code' => $getVendchecker[0]['vendor_code'], 'vendor_name' => $getVendchecker[0]['vendor_name'], 'vendor_salesrep' => $getVendchecker[0]['vendor_salesrep'], 'vendor_address' => $getVendchecker[0]['vendor_address'], 'vendor_email' => $getVendchecker[0]['vendor_email'], 'vendor_phone' => $getVendchecker[0]['vendor_phone'], 'vendor_fax' => $getVendchecker[0]['vendor_fax'], 'vendor_createdby' => $getVendchecker[0]['vendor_createdby']]);

            if($updtVendorer == true){

                // Insert Record To Purchase Order
            PurchaseOrder::insert(['busID'  => Auth::user()->busID, 'post_id'  => $req->post_id, 'vendor' => $getVendchecker[0]['vendor_name'], 'purchase_order_no' => 'PO'.mt_rand(1000, 9000), 'order_date' => date('Y-m-d'), 'purchase_order_qty' => $req->items_qty, 'purchase_order_rate' => $req->items_unit_cost, 'purchase_order_totcost'  => $req->items_total_cost, 'purchase_order_destmail' => $req->assigned_technician, 'purchase_order_orderby' => Auth::user()->name]);

                // End Insert Record To Purchase Order


                $resData = ['res' => 'Updated Vendor'];
            }
            else{
                $resData = ['res' => 'Something went wrong!'];
            }
        }
        else{
            // Insert Vendor
            $insVendorer = CreateVendor::insert(['busID' => Auth::user()->busID, 'vendor_code' => '', 'vendor_name' => '', 'vendor_salesrep' => '', 'vendor_address' => '', 'vendor_country' => '', 'vendor_state' => '', 'vendor_city' => '', 'vendor_email' => $req->vendor, 'vendor_phone' => '', 'vendor_fax' => '', 'vendor_createdby' => Auth::user()->name]);

            if($insVendorer == true){

                    // Insert Record To Purchase Order
            PurchaseOrder::insert(['busID'  => Auth::user()->busID, 'post_id'  => $req->post_id, 'vendor' => $req->vendor, 'purchase_order_no' => 'PO'.mt_rand(1000, 9000), 'order_date' => date('Y-m-d'), 'purchase_order_qty' => $req->items_qty, 'purchase_order_rate' => $req->items_unit_cost, 'purchase_order_totcost'  => $req->items_total_cost, 'purchase_order_destmail' => $req->assigned_technician, 'purchase_order_orderby' => Auth::user()->name]);

                // End Insert Record To Purchase Order

                $resData = ['res' => 'Vendor Saved'];
            }
            else{
                $resData = ['res' => 'Something went wrong!'];
            }
        }
            // End Vendor Profile

            LabourInventory::insert(['description' => $req->part_description, 'category' => $req->part_category]);

            $resData = ['res' => 'Part Added', 'message' => 'success', 'data' => $req->part_description.', '.$req->part_category];
        }
        else{
            $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
        }

        return $this->returnJSON($resData);
    }


    public function createPO(Request $req){

        $getPO = PurchaseOrder::where('purchase_order_no', $req->purchase_order_no)->where('busID', Auth::user()->busID)->get();

        if(count($getPO) > 0){
            // Update Record
            PurchaseOrder::where('purchase_order_no', $req->purchase_order_no)->where('busID', Auth::user()->busID)->update(['busID' => Auth::user()->busID,'post_id' => $req->post_id, 'vendor' => $req->vendor, 'purchase_order_no'=> $req->purchase_order_no, 'order_date'=> $req->order_date, 'expected_date'=> $req->expected_date, 'purchase_order_inventory_item'=> $req->purchase_order_inventory_item, 'purchase_order_qty'=> $req->purchase_order_qty, 'purchase_order_rate'=> $req->purchase_order_rate, 'purchase_order_totcost'=> $req->purchase_order_totcost, 'purchase_order_shippingcost'=> $req->purchase_order_shippingcost, 'purchase_order_discount'=> $req->purchase_order_discount, 'purchase_order_othercost'=> $req->purchase_order_othercost, 'purchase_order_tax'=> $req->purchase_order_tax, 'purchase_order_totalpurchaseorder'=> $req->purchase_order_totalpurchaseorder, 'purchase_order_shipto'=> $req->purchase_order_shipto, 'purchase_order_address1'=> $req->purchase_order_address1, 'purchase_order_address2'=> $req->purchase_order_address2, 'purchase_order_city'=> $req->purchase_order_city, 'purchase_order_state'=> $req->purchase_order_state, 'purchase_order_country'=> $req->purchase_order_country, 'purchase_order_zip'=> $req->purchase_order_zip, 'purchase_order_destphone'=> $req->purchase_order_destphone, 'purchase_order_destfax'=> $req->purchase_order_destfax, 'purchase_order_destmail'=> $req->purchase_order_destmail, 'purchase_order_orderby'=> $req->purchase_order_orderby]);
        }
        else{
            $insPO = PurchaseOrder::insert(['busID' => Auth::user()->busID,'post_id' => $req->post_id, 'vendor' => $req->vendor, 'purchase_order_no'=> $req->purchase_order_no, 'order_date'=> $req->order_date, 'expected_date'=> $req->expected_date, 'purchase_order_inventory_item'=> $req->purchase_order_inventory_item, 'purchase_order_qty'=> $req->purchase_order_qty, 'purchase_order_rate'=> $req->purchase_order_rate, 'purchase_order_totcost'=> $req->purchase_order_totcost, 'purchase_order_shippingcost'=> $req->purchase_order_shippingcost, 'purchase_order_discount'=> $req->purchase_order_discount, 'purchase_order_othercost'=> $req->purchase_order_othercost, 'purchase_order_tax'=> $req->purchase_order_tax, 'purchase_order_totalpurchaseorder'=> $req->purchase_order_totalpurchaseorder, 'purchase_order_shipto'=> $req->purchase_order_shipto, 'purchase_order_address1'=> $req->purchase_order_address1, 'purchase_order_address2'=> $req->purchase_order_address2, 'purchase_order_city'=> $req->purchase_order_city, 'purchase_order_state'=> $req->purchase_order_state, 'purchase_order_country'=> $req->purchase_order_country, 'purchase_order_zip'=> $req->purchase_order_zip, 'purchase_order_destphone'=> $req->purchase_order_destphone, 'purchase_order_destfax'=> $req->purchase_order_destfax, 'purchase_order_destmail'=> $req->purchase_order_destmail, 'purchase_order_orderby'=> $req->purchase_order_orderby]);

            if($insPO == true){
                if($req->action == "submit"){
                    $resData = ['res' => 'Successfully Submitted', 'message' => 'success', 'link' => 'userDashboard?c=manageinventory', 'action' => 'submit'];
                }
                elseif ($req->action == 'printmail') {
                    $resData = ['res' => 'Fetching', 'message' => 'success', 'link' => $req->post_id, 'action' => 'printmail'];
                }
            }
            else{
                $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
            }
        }

        return $this->returnJSON($resData);
    }

    public function createVendor(Request $req){
        // Check if exist
        $getVendcheck = CreateVendor::where('vendor_email', $req->vendor_email)->where('busID', Auth::user()->busID)->get();
        if(count($getVendcheck) > 0){
            // Update Vendor
            $updtVendor = CreateVendor::where('vendor_email', $req->vendor_email)->where('busID', Auth::user()->busID)->update(['busID' => Auth::user()->busID, 'vendor_code' => $getVendcheck[0]['vendor_code'], 'vendor_name' => $getVendcheck[0]['vendor_name'], 'vendor_salesrep' => $getVendcheck[0]['vendor_salesrep'], 'vendor_address' => $getVendcheck[0]['vendor_address'], 'vendor_email' => $getVendcheck[0]['vendor_email'], 'vendor_phone' => $getVendcheck[0]['vendor_phone'], 'vendor_fax' => $getVendcheck[0]['vendor_fax'], 'vendor_createdby' => $getVendcheck[0]['vendor_createdby']]);

            if($updtVendor == true){
                $resData = ['res' => 'Updated Vendor', 'message' => 'success', 'action' => 'update'];
            }
            else{
                $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
            }
        }
        else{
            // Insert Vendor
            $insVendor = CreateVendor::insert(['busID' => Auth::user()->busID, 'vendor_code' => $req->vendor_code, 'vendor_name' => $req->vendor_name, 'vendor_salesrep' => $req->vendor_salesrep, 'vendor_address' => $req->vendor_address, 'vendor_country' => $req->vendor_country, 'vendor_state' => $req->vendor_state, 'vendor_city' => $req->vendor_city, 'vendor_email' => $req->vendor_email, 'vendor_phone' => $req->vendor_phone, 'vendor_fax' => $req->vendor_fax, 'vendor_createdby' => $req->vendor_createdby]);

            if($insVendor == true){
                $resData = ['res' => 'Vendor Saved', 'message' => 'success', 'action' => 'insert', 'data' => $req->vendor_name];
            }
            else{
                $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
            }
        }

        return $this->returnJSON($resData);
    }


    public function orderActions(Request $req){
        // Select Record
        $getrecordedPO = PurchaseOrder::where('post_id', $req->post_id)->get();

        if(count($getrecordedPO) > 0){
            if($req->val == "receiveorder"){
                // Update Table, and Generate Invoice
                 PurchaseOrder::where('post_id', $req->post_id)->update(['receive_order' => '1', 'make_payment' => '0', 'move_to_inventory' => '0']);

                    $genInv = PurchaseOrder::where('post_id', $req->post_id)->where('receive_order', '1')->get();

                $resData = ['res' => 'Generating Invoice..', 'message' => 'success', 'action' => 'receiveorder', 'data' => json_encode($genInv)];
            }
            elseif($req->val == "makepayment"){
                // Update Table, and goto payment
                PurchaseOrder::where('post_id', $req->post_id)->update(['receive_order' => '0', 'make_payment' => '1', 'move_to_inventory' => '0']);
                $genmkPay = PurchaseOrder::where('post_id', $req->post_id)->where('make_payment', '1')->get();
                $resData = ['res' => 'Please wait...', 'message' => 'success', 'action' => 'makepayment', 'data' => json_encode($genmkPay)];
            }
            elseif($req->val == "movetoinventory"){
                // Update Table, and Move record to Inventory
                PurchaseOrder::where('post_id', $req->post_id)->update(['receive_order' => '0', 'make_payment' => '0', 'move_to_inventory' => '1']);

               $genmoveInv = DB::table('create_inventory_item')
            ->join('purchase_order', 'create_inventory_item.busID', '=', 'purchase_order.busID')->where('purchase_order.move_to_inventory', '1')
            ->orderBy('create_inventory_item.created_at', 'DESC')->get();

            // Get current qty @ hand
            $getCurr = CreateInventoryItem::where('post_id', $req->post_id)->get();

            if(count($getCurr) > 0){
                // Update qty at hand
                $qtyRead = $getCurr[0]['qtyathand'];
                $totRes = $qtyRead + $getrecordedPO[0]['purchase_order_qty'];

                $updtQty = CreateInventoryItem::where('post_id', $req->post_id)->update(['qtyathand' => $totRes]);
            }
            else{

            }

                $resData = ['res' => 'Moved to Inventory', 'message' => 'success', 'action' => 'movetoinventory', 'data' => json_encode($genmoveInv), 'link' => 'userDashboard?c=manageinventory'];
            }
        }
        else{
            $resData = ['res' => 'Record not found!', 'message' => 'error'];
        }

        return $this->returnJSON($resData);
    }

    public function createInvItem(Request $req){
        // Check if record exist
        $checkInvitem = CreateInventoryItem::where('post_id', $req->post_id)->get();
        if(count($checkInvitem) > 0){
            $resData = ['res' => 'Inventory record already exist', 'message' => 'info'];
        }
        else{
            // Insert
            $insInvitem = CreateInventoryItem::insert(['busID' => Auth::user()->busID, 'post_id' => $req->post_id, 'part_no' => $req->part_no, 'description' => $req->description, 'category' => $req->category, 'upccode' => $req->upccode, 'location' => $req->location, 'qtyathand' => $req->qtyathand, 'createdby' => $req->createdby]);

            if($insInvitem == true){
                $resData = ['res' => 'Inventory Created', 'message' => 'success', 'link' => 'userDashboard?c=manageinventory'];
            }
            else{
                $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
            }
        }

        return $this->returnJSON($resData);
    }

    public function poPayments(Request $req){
        // Check if id exist
            $checkPOpay = PurchaseOrderPayment::where('busID', Auth::user()->busID)->where('post_id', $req->post_id)->get();

            if(count($checkPOpay) > 0){
                // Update Record
                // Insert Rec
            $upPoPay = PurchaseOrderPayment::where('busID', Auth::user()->busID)->where('post_id', $req->post_id)->update(['busID' => Auth::user()->busID, 'post_id' => $req->post_id, 'vendor_email' => $req->vend_name, 'pay_type' => $req->pay_type, 'pay_po_number' => $req->pay_po_number, 'pay_order_date' => $req->pay_order_date, 'pay_date_expected' => $req->pay_date_expected, 'pay_invent_item' => $req->pay_invent_item, 'pay_description_of_item' => $req->pay_description_of_item, 'pay_quantity' => $req->pay_quantity, 'pay_rate' => $req->pay_rate, 'pay_tot_cost' => $req->pay_tot_cost, 'pay_shipping_cost' => $req->pay_shipping_cost, 'pay_discount' => $req->pay_discount, 'pay_othercosts' => $req->pay_othercosts, 'pay_tax' => $req->pay_tax, 'pay_po_total' => $req->pay_po_total, 'pay_advance' => $req->pay_advance, 'pay_balance' => $req->pay_balance, 'pay_cashamount' => $req->pay_cashamount, 'pay_chequeno' => $req->pay_chequeno, 'pay_chequedate' => $req->pay_chequedate, 'pay_chequeamount' => $req->pay_chequeamount, 'pay_credit' => $req->pay_credit, 'pay_cc' => $req->pay_cc, 'pay_cardamount' => $req->pay_cardamount, 'pay_grandtotal' => $req->pay_grandtotal]);

                if($upPoPay == 1){

                    if($req->val == "payment"){

                    // Update Purchase Order
                    $updtPOorder = PurchaseOrder::where('post_id', $req->post_id)->where('busID', Auth::user()->busID)->update(['receive_order' => '0', 'make_payment' => '1']);
                    if($updtPOorder == 1){
                        $resData = ['res' => 'Saved Payment', 'message' => 'success', 'action' => 'payment', 'link' => 'userDashboard?c=manageinventory'];
                    }
                    else{
                        $resData = ['res' => 'Payment Record not successfull', 'message' => 'warning'];
                    }

                }
                 elseif ($req->val == "printmail") {
                    $resData = ['res' => 'Saved Payment', 'message' => 'success', 'link' => $req->post_id, 'action' => 'printmail'];
                 }

                }
                else{
                    $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
                }
            }
            else{
                        // Insert Rec
        $insPoPay = PurchaseOrderPayment::insert(['busID' => Auth::user()->busID, 'post_id' => $req->post_id, 'vendor_email' => $req->vend_name, 'pay_type' => $req->pay_type, 'pay_po_number' => $req->pay_po_number, 'pay_order_date' => $req->pay_order_date, 'pay_date_expected' => $req->pay_date_expected, 'pay_invent_item' => $req->pay_invent_item, 'pay_description_of_item' => $req->pay_description_of_item, 'pay_quantity' => $req->pay_quantity, 'pay_rate' => $req->pay_rate, 'pay_tot_cost' => $req->pay_tot_cost, 'pay_shipping_cost' => $req->pay_shipping_cost, 'pay_discount' => $req->pay_discount, 'pay_othercosts' => $req->pay_othercosts, 'pay_tax' => $req->pay_tax, 'pay_po_total' => $req->pay_po_total, 'pay_advance' => $req->pay_advance, 'pay_balance' => $req->pay_balance, 'pay_cashamount' => $req->pay_cashamount, 'pay_chequeno' => $req->pay_chequeno, 'pay_chequedate' => $req->pay_chequedate, 'pay_chequeamount' => $req->pay_chequeamount, 'pay_credit' => $req->pay_credit, 'pay_cc' => $req->pay_cc, 'pay_cardamount' => $req->pay_cardamount, 'pay_grandtotal' => $req->pay_grandtotal]);

        if($insPoPay ==  true){
            if($req->val == "payment"){

                // Update Purchase Order
                $updtPOorder = PurchaseOrder::where('post_id', $req->post_id)->where('busID', Auth::user()->busID)->update(['receive_order' => '0', 'make_payment' => '1']);
                if($updtPOorder == 1){
                    $resData = ['res' => 'Saved Payment', 'message' => 'success', 'action' => 'payment', 'link' => 'userDashboard?c=manageinventory'];
                }
                else{
                    $resData = ['res' => 'Payment Record not successfull', 'message' => 'warning'];
                }

            }
             elseif ($req->val == "printmail") {
                $resData = ['res' => 'Saved Payment', 'message' => 'success', 'link' => $req->post_id, 'action' => 'printmail'];
             }
        }
        else{
          $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
        }

            }



          return $this->returnJSON($resData);
    }

    public function createCategory(Request $req){
        // Check if exist
        $checkcategory = CreateCategory::where('category', 'LIKE', '%'.$req->category.'%')->get();

        if(count($checkcategory) > 0){
            $resData = ['res' => 'This Item already exist in the category', 'message' => 'info'];
        }
        else{
            // Insert
            $insCategory = CreateCategory::insert(['busID' => Auth::user()->busID, 'category' => $req->category, 'description' => $req->description]);

            if($insCategory == true){
                $resData = ['res' => 'Category Added', 'message' => 'success', 'data' => $req->category];
            }
            else{
                $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
            }
        }

        return $this->returnJSON($resData);
    }

    public function autoPayment(Request $req){
        // Get Data
        $getData = PurchaseOrder::where('purchase_order_no', $req->pay_po_number)->where('busID', Auth::user()->busID)->get();

        if(count($getData) > 0){
            $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($getData)];
        }
        else{
            $resData = ['res' => 'Record not found', 'message' => 'info'];
        }
        return $this->returnJSON($resData);
    }

    public function manageLabour(Request $req){

        if($req->action == "labours_category"){
            // Check if Category Exist
            $checkCat = ManageLabourCategory::where('busID', $req->busID)->where('labours_category', '%'.$req->labours_category.'%')->get();

            if(count($checkCat) > 0){
                $resData = ['res' => 'This category already exists', 'message' => 'info'];
            }
            else{
                // Insert Record
                $insCat = ManageLabourCategory::insert(['busID' => $req->busID, 'labours_category' => $req->labours_category]);

                if($insCat == true){
                    $resData = ['res' => 'Category Created', 'message' => 'success', 'action' => 'labours_category', 'link' => 'userDashboard?c=labourschedule'];
                }
                else{
                    $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
                }
            }
        }
        elseif($req->action == "labours_record"){
            $req = request();

        if($req->file('labour_video'))
        {
            //Get filename with extension
            $filenameWithExt = $req->file('labour_video')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
            // Get just extension
            $extension = $req->file('labour_video')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = rand().'_'.time().'.'.$extension;
            //Upload Image
            // $path = $req->file('file')->storeAs('public/uploads', $fileNameToStore);

            // $path = $req->file('labour_video')->move(public_path('/labourupload/'), $fileNameToStore);

            $path = $req->file('labour_video')->move(public_path('../../labourupload/'), $fileNameToStore);

        }
        else
        {
            $fileNameToStore = 'noImage.png';
        }
            // Insert new record
            $insLabsch = ManageLabour::insert(['busID' => $req->busID, 'labours_description' => $req->labours_description, 'labours_categories' => $req->labours_categories, 'hour' => $req->hour, 'rate_per_hour' => $req->rate_per_hour, 'flat_rate' => $req->flat_rate, 'wholesale_rate' => $req->wholesale_rate, 'retail_rate' => $req->retail_rate, 'detailed_description' => $req->detailed_description, 'labour_video' => $fileNameToStore, 'labour_note' => $req->labour_note]);

            if($insLabsch == true){
                $resData = ['res' => 'Record Created', 'message' => 'success', 'action' => 'labours_record', 'link' => 'userDashboard?c=labourschedule'];
            }
            else{
                $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
            }

        }
        return $this->returnJSON($resData);
    }

    public function manageTime(Request $req){
        // Insert
        $checkTech = ManageTimeSheet::insert(['busID' => Auth::user()->busID, 'date_in' => $req->date_in, 'time_in' => $req->time_in, 'date_out' => $req->date_out, 'time_out' => $req->time_out, 'technician_name' => $req->technician_name, 'technician_id' => $req->technician_id]);

        if($checkTech ==  true){
            $resData = ['res' => 'Record Saved', 'message' => 'success', 'link' => 'userDashboard?c=labourschedule'];
        }
        else{
            $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
        }
        return $this->returnJSON($resData);
    }

    public function addLabour(Request $req){
        // Check is technician exists
        $checklabour = AddLabour::where('busID', $req->busID)->where('email', $req->email)->get();

        if(count($checklabour) > 0){
            $resData = ['res' => 'User already registered', 'message' => 'info'];
        }
        else{

            // Check if user exist

            $thistechnician = User::where('email', $req->email)->get();

            if(count($thistechnician) > 0){
                $resData = ['res' => 'User already registered', 'message' => 'info'];
            }
            else{

            $req = request();

        if($req->file('addlabour_videoupload'))
        {
            //Get filename with extension
            $filenameWithExt = $req->file('addlabour_videoupload')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
            // Get just extension
            $extension = $req->file('addlabour_videoupload')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = rand().'_'.time().'.'.$extension;
            //Upload Image
            // $path = $req->file('file')->storeAs('public/uploads', $fileNameToStore);

            // $path = $req->file('addlabour_videoupload')->move(public_path('/addlabourupload/'), $fileNameToStore);

            $path = $req->file('addlabour_videoupload')->move(public_path('../../addlabourupload/'), $fileNameToStore);

        }
        else
        {
            $fileNameToStore = 'noImage.png';
        }

        // Insert
        $insLabourer = AddLabour::insert(['busID' => $req->busID, 'firstname' => $req->firstname, 'lastname' => $req->lastname, 'category' => $req->category, 'speciality' => $req->speciality, 'email' => $req->email, 'phone' => $req->phone, 'hourly_rate' => $req->hourly_rate, 'flat_rate' => $req->flat_rate, 'budgeted_hours' => $req->budgeted_hours, 'actual_hours' => $req->actual_hours, 'labour_cost' => $req->labour_cost, 'total_cost' => $req->total_cost, 'job_description' => $req->job_description, 'notes' => $req->notes, 'timesheet' => $req->timesheet, 'file' => $fileNameToStore]);

        if($insLabourer ==  true){
            // Insert Technician Registration, Check if user exists
            $checkTechnician = User::where('email', $req->email)->get();
            if(count($checkTechnician) > 0){
                // Update
                $updtTechnician = User::where('email', $req->email)->update(['ref_code' => Auth::user()->ref_code,'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->userType, 'phone_number' => $req->phone, 'city' => Auth::user()->city, 'state' => Auth::user()->state, 'country' => Auth::user()->country, 'busID' => Auth::user()->busID, 'station_name' => Auth::user()->station_name, 'maiden_name' => Auth::user()->maiden_name, 'parent_meet' => Auth::user()->parent_meet, 'plan' => Auth::user()->plan, 'status' => '1', 'referred_by' => Auth::user()->name]);

            }
            else{
                // Insert
                $insertTechnician = User::insert(['ref_code' => Auth::user()->ref_code,'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->userType, 'phone_number' => $req->phone, 'city' => Auth::user()->city, 'state' => Auth::user()->state, 'country' => Auth::user()->country, 'busID' => Auth::user()->busID, 'station_name' => Auth::user()->station_name, 'maiden_name' => Auth::user()->maiden_name, 'parent_meet' => Auth::user()->parent_meet, 'plan' => Auth::user()->plan, 'status' => '1', 'referred_by' => Auth::user()->ref_code]);
            }

            $resData = ['res' => 'Record Saved', 'message' => 'success', 'link' => 'userDashboard?c=labourschedule'];
        }
        else{
            $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
        }

        }






        }
        return $this->returnJSON($resData);
    }


    public function UpdateLabour(Request $req){

        // Start Here
        $vallabour = AddLabour::where('id', $req->id)->where('busID', Auth::user()->busID)->get();

        if(count($vallabour) > 0){
            // Perform update action

             $req = request();

            if($req->file('addlabour_videoupload') != null)
            {
                //Get filename with extension
                $filenameWithExt = $req->file('addlabour_videoupload')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
                // Get just extension
                $extension = $req->file('addlabour_videoupload')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = rand().'_'.time().'.'.$extension;
                //Upload Image
                // $path = $req->file('file')->storeAs('public/uploads', $fileNameToStore);

                // $path = $req->file('addlabour_videoupload')->move(public_path('/addlabourupload/'), $fileNameToStore);

                $path = $req->file('addlabour_videoupload')->move(public_path('../../addlabourupload/'), $fileNameToStore);

            }
            else
            {
                $fileNameToStore = $vallabour[0]['file'];
            }

            // Start
                            if($req->password != ""){

                    // Update
                    $insLabourer = AddLabour::where('id', $req->id)->update(['firstname' => $req->firstname, 'lastname' => $req->lastname, 'category' => $req->category, 'speciality' => $req->speciality, 'email' => $req->email, 'phone' => $req->phone, 'hourly_rate' => $req->hourly_rate, 'flat_rate' => $req->flat_rate, 'budgeted_hours' => $req->budgeted_hours, 'actual_hours' => $req->actual_hours, 'labour_cost' => $req->labour_cost, 'total_cost' => $req->total_cost, 'job_description' => $req->job_description, 'notes' => $req->notes, 'timesheet' => $req->timesheet, 'file' => $fileNameToStore]);

                    if($insLabourer ==  1){
                        // Insert Technician Registration, Check if user exists
                        $checkTechnician = User::where('email', $req->email)->get();
                        if(count($checkTechnician) > 0){
                            // Update
                            $updtTechnicians = User::where('email', $req->email)->update(['ref_code' => Auth::user()->ref_code,'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->userType, 'phone_number' => $req->phone, 'city' => Auth::user()->city, 'state' => Auth::user()->state, 'country' => Auth::user()->country, 'busID' => Auth::user()->busID, 'station_name' => Auth::user()->station_name, 'maiden_name' => Auth::user()->maiden_name, 'parent_meet' => Auth::user()->parent_meet, 'plan' => Auth::user()->plan, 'status' => '1', 'referred_by' => Auth::user()->name]);

                        }
                        else{
                            // Insert
                            $insertTechnicians = User::insert(['ref_code' => Auth::user()->ref_code,'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'password' => Hash::make($req->password), 'userType' => $req->userType, 'phone_number' => $req->phone, 'city' => Auth::user()->city, 'state' => Auth::user()->state, 'country' => Auth::user()->country, 'busID' => Auth::user()->busID, 'station_name' => Auth::user()->station_name, 'maiden_name' => Auth::user()->maiden_name, 'parent_meet' => Auth::user()->parent_meet, 'plan' => Auth::user()->plan, 'status' => '1', 'referred_by' => Auth::user()->ref_code]);
                        }

                        $resData = ['res' => 'Record Updated', 'message' => 'success', 'link' => 'userDashboard?c=labourschedule'];
                    }
                    else{
                        $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
                    }
            }
            else{
                // Update
                    $insLabourer = AddLabour::where('id', $req->id)->update(['firstname' => $req->firstname, 'lastname' => $req->lastname, 'category' => $req->category, 'speciality' => $req->speciality, 'email' => $req->email, 'phone' => $req->phone, 'hourly_rate' => $req->hourly_rate, 'flat_rate' => $req->flat_rate, 'budgeted_hours' => $req->budgeted_hours, 'actual_hours' => $req->actual_hours, 'labour_cost' => $req->labour_cost, 'total_cost' => $req->total_cost, 'job_description' => $req->job_description, 'notes' => $req->notes, 'timesheet' => $req->timesheet, 'file' => $fileNameToStore]);

                    if($insLabourer ==  1){
                        // Insert Technician Registration, Check if user exists
                        $checkTechnician = User::where('email', $req->email)->get();
                        if(count($checkTechnician) > 0){
                            // Update
                            $updtTechnicians = User::where('email', $req->email)->update(['ref_code' => Auth::user()->ref_code,'name' => $req->firstname.' '.$req->lastname, 'email' => $req->email, 'userType' => $req->userType, 'phone_number' => $req->phone, 'city' => Auth::user()->city, 'state' => Auth::user()->state, 'country' => Auth::user()->country, 'busID' => Auth::user()->busID, 'station_name' => Auth::user()->station_name, 'maiden_name' => Auth::user()->maiden_name, 'parent_meet' => Auth::user()->parent_meet, 'plan' => Auth::user()->plan, 'status' => '1', 'referred_by' => Auth::user()->name]);

                        }

                        $resData = ['res' => 'Record Updated', 'message' => 'success', 'link' => 'userDashboard?c=labourschedule'];
                    }
                    else{
                        $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
                    }
            }

            // End

        }
        else{
            $resData = ['res' => 'Technician Record not found!', 'message' => 'info'];
        }

        // End Here

        return $this->returnJSON($resData);
    }

    public function technicianEdit(Request $req){
        // Fetch Technician Details
        $getTechy = AddLabour::where('id', $req->id)->get();
        if(count($getTechy) > 0){
            $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($getTechy)];
        }
        else{
            $resData = ['res' => 'Technician detail missing!', 'message' => 'info'];
        }

        return $this->returnJSON($resData);
    }


    // Feedbacks
    public function Feedbacks(Request $req){
        // Insert to Feedbacks
        $insFeed = Feedback::insert(['ref_code' => $req->ref_code, 'name' => Auth::user()->name, 'email' => Auth::user()->email, 'subject' => $req->subject, 'description' => $req->description, 'state' => 1]);

        if($insFeed == true){
            $resData = ['res' => 'Thank you for your feedback', 'message' => 'success'];
        }
        else{
            $resData = ['res' => 'Something went wrong!', 'message' => 'info'];
        }

        return $this->returnJSON($resData);
    }

    public function fetchtheNeedful(Request $req){
        if($req->action == "inventory"){
            $getrec = DB::table('create_inventory_item')
            ->join('purchase_order', 'create_inventory_item.busID', '=', 'purchase_order.busID')->where('create_inventory_item.description', $req->inventory)
            ->orderBy('create_inventory_item.created_at', 'DESC')->get();

            if(count($getrec) > 0){
                $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($getrec), 'position' => $req->pos];
            }
            else{
                $resData = ['res' => 'Inventory record not found', 'message' => 'info'];
            }

            // dd($getrec);
        }
        elseif($req->action == "labour_rate"){

            if($req->pos == "1"){

                $getdata =  DB::table('manage_labour')
            ->join('add_labour', 'manage_labour.busID', '=', 'add_labour.busID')->where('add_labour.category', $req->category)->orWhere('add_labour.job_description', $req->description)
            ->get();

           // $getdata =  ManageLabour::where('busID', Auth::user()->busID)->where('labours_categories', $req->category)->where('labours_description', $req->description)->get();

           // dd($getdata);
           if(count($getdata) > 0){

                $hour_rate = $getdata[0]->rate_per_hour;
                $flate_rate = $getdata[0]->flat_rate;
                $wholesale_rate = $getdata[0]->wholesale_rate;
                $retail_rate = $getdata[0]->retail_rate;
                $userRate = $req->lab_qty;

                if($req->labour == "rate_per_hour"){
                    $this->resultData = $hour_rate * $userRate;
                }
                elseif($req->labour == "flat_rate"){
                    $this->resultData = $flate_rate * $userRate;
                }
                elseif($req->labour == "wholesale_rate"){
                    $this->resultData = $wholesale_rate * $userRate;
                }
                elseif($req->labour == "retail_rate"){
                    $this->resultData = $retail_rate * $userRate;
                }
                $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($this->resultData), 'position' => $req->pos];
           }
           else{
            $resData = ['res' => 'Cannot calculate labour amount for the selected field', 'message' => 'info'];
           }


            }

            else if($req->pos == "2"){

                $getdata =  DB::table('manage_labour')
            ->join('add_labour', 'manage_labour.busID', '=', 'add_labour.busID')->where('add_labour.category', $req->category)->orWhere('add_labour.job_description', $req->description)
            ->get();

           // $getdata =  ManageLabour::where('busID', Auth::user()->busID)->where('labours_categories', $req->category)->where('labours_description', $req->description)->get();

           if(count($getdata) > 0){

                $hour_rate = $getdata[0]->rate_per_hour;
                $flate_rate = $getdata[0]->flat_rate;
                $wholesale_rate = $getdata[0]->wholesale_rate;
                $retail_rate = $getdata[0]->retail_rate;
                $userRate = $req->lab_qty;

                if($req->labour == "rate_per_hour"){
                    $this->resultData = $hour_rate * $userRate;
                }
                elseif($req->labour == "flat_rate"){
                    $this->resultData = $flate_rate * $userRate;
                }
                elseif($req->labour == "wholesale_rate"){
                    $this->resultData = $wholesale_rate * $userRate;
                }
                elseif($req->labour == "retail_rate"){
                    $this->resultData = $retail_rate * $userRate;
                }
                $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($this->resultData), 'position' => $req->pos];
           }
           else{
            $resData = ['res' => 'Cannot calculate labour amount for the selected field', 'message' => 'info'];
           }


            }


        }
        elseif ($req->action == "getLabour") {
            // Fetch Information

            if($req->licence == ""){
                $resData = ['res' => 'No labour record for this vehicle', 'message' => 'info'];
            }
            else{
                $getvehInfo = Vehicleinfo::where('estimate_id', $req->licence)->get();


            if(count($getvehInfo) > 0){
                // Get technician name
                $getTechnician = Vehicleinfo::where('technician', $getvehInfo[0]->technician)->get();

                if(count($getTechnician) > 0){
                    $techStaff = User::where('email', $getTechnician[0]->technician)->where('busID', Auth::user()->busID)->get();

                    if(count($techStaff) > 0){
                        $this->technician = $techStaff[0]->name;
                    }
                    else{
                        $this->technician = Auth::user()->station_name;
                    }
                }
                else{
                    $this->technician = Auth::user()->station_name;
                }

                // dd($getvehInfo);

                $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($getvehInfo), 'data2' => $this->technician, 'action' => "getLabour"];

                // dd($getvehInfo);
            }
            else{
                $resData = ['res' => 'No labour record for this vehicle', 'message' => 'info'];
            }
            }


        }
        elseif ($req->action == "payschedule") {
            // Fetch
            $getStaff = PaySchedule::where('estimate_id', $req->estimate_id)->get();

            if(count($getStaff) > 0){
                $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($getStaff), 'action' => "payschedule"];
            }
            else{
                $resData = ['res' => 'No pay record for this staff', 'message' => 'info'];
            }
        }

        elseif ($req->action == "paystublabour") {
            // Fetch
            $getpayStub = PaySchedule::where('estimate_id', $req->estimate_id)->where('pay_stub', '1')->get();

            if(count($getpayStub) > 0){
                $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($getpayStub), 'action' => "paystublabour"];
            }
            else{
                $resData = ['res' => 'No pay stub record for this staff', 'message' => 'info'];
            }
        }

        return $this->returnJSON($resData);
    }



    public function getvendors(Request $req){

        // Get Info
        $getVend = CreateVendor::where('busID', Auth::user()->busID)->where('vendor_code', $req->vendor_code)->get();

        if(count($getVend) > 0){
            $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($getVend)];
        }
        else{
            $resData = ['res' => 'Vendor not found', 'message' => 'info'];
        }

        return $this->returnJSON($resData);
    }

    public function updatevendors(Request $req){

        // Update
        $updtVend = CreateVendor::where('busID', Auth::user()->busID)->where('vendor_code', $req->vendor_code)->update(['busID' => Auth::user()->busID, 'vendor_code' => $req->vendor_code, 'vendor_name' => $req->vendor_name, 'vendor_salesrep' => $req->vendor_salesrep, 'vendor_address' => $req->vendor_address, 'vendor_country' => $req->vendor_country, 'vendor_state' => $req->vendor_state, 'vendor_city' => $req->vendor_city, 'vendor_email' => $req->vendor_email, 'vendor_phone' => $req->vendor_phone, 'vendor_fax' => $req->vendor_fax, 'vendor_createdby' => $req->vendor_createdby]);

        if($updtVend ==  1){
            $resData = ['res' => 'Update Successfull', 'message' => 'success', 'link' => 'userDashboard?c=manageinventory'];
        }
        else{
            $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
        }

        return $this->returnJSON($resData);
    }

    public function vendDetails(Request $req){

        // Get Info
        $getVendetails = CreateVendor::where('busID', Auth::user()->busID)->where('vendor_email', $req->vendor_email)->get();

        if(count($getVendetails) > 0){
            $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($getVendetails)];
        }
        else{
            $resData = ['res' => 'Vendor not found', 'message' => 'info'];
        }

        return $this->returnJSON($resData);
    }

    public function balanceReview(Request $req){
         if($req->purpose == "clientBal"){
            // Update Client Payment detail
            $updtClient = Vehicleinfo::where('estimate_id', $req->estimate_id)->update(['payment' => 2]);

            if($updtClient == 1){
                $resData = ['res' => 'Maintenance balanced. Generating receipt...', 'message' => 'success', 'link' => $req->estimate_id, 'action' => 'clientBal'];
            }
            else{
                $resData = ['res' => 'Something went wrong. Cant balance maintenance record', 'message' => 'info'];
            }
         }

         elseif ($req->purpose == "labourbal") {
             // Update Client Payment detail
            $updtLabour = Estimate::where('estimate_id', $req->estimate_id)->update(['technician_payment' => 2]);

            if($updtLabour == 1){
                $resData = ['res' => 'Technician Paid. Loading work order...', 'message' => 'success', 'link' => $req->estimate_id, 'action' => 'labourbal'];
            }
            else{
                $resData = ['res' => 'Something went wrong. Cant load work order', 'message' => 'info'];
            }
         }

         elseif ($req->purpose == "cashbal") {

            $resData = ['res' => 'Please hold, Data computing...', 'message' => 'success', 'link' => $req->estimate_id, 'action' => 'cashbal'];
         }
         elseif ($req->purpose == "creditcardBal") {

            $resData = ['res' => 'Please hold, Data computing...', 'message' => 'success', 'link' => $req->estimate_id, 'action' => 'creditcardBal'];
         }
         elseif ($req->purpose == "bankBal") {

            $resData = ['res' => 'Please hold, Data computing...', 'message' => 'success', 'link' => $req->estimate_id, 'action' => 'bankBal'];
         }


         return $this->returnJSON($resData);
    }


    public function paySchedule(Request $req){
         if($req->purpose == "movetopayschedule"){

            // Insert
            $checkPayschedule = PaySchedule::insert(['estimate_id' => $req->estimate_id, 'busID' => Auth::user()->busID, 'licence' => $req->licence, 'make' => $req->make, 'model' => $req->model, 'date' => $req->date, 'service_type' => $req->service_type, 'service_option' => $req->service_option, 'hour' => $req->labour_hour, 'rate' => $req->labour_rate, 'pay_due' => $req->labour_paydue, 'technician' => $req->technician]);

            if($checkPayschedule == true){
                $resData = ['res' => 'Record moved', 'message' => 'success', 'link' => 'userDashboard?c=labourschedule', 'action' => 'movetopayschedule'];
            }
            else{
                $resData = ['res' => 'Something went wrong. Cant load payment schedule', 'message' => 'info'];
            }
         }

         elseif($req->purpose == "printmail"){
            // Insert
            $checkPayschedule = PaySchedule::insert(['estimate_id' => $req->estimate_id, 'busID' => Auth::user()->busID, 'licence' => $req->licence, 'make' => $req->make, 'model' => $req->model, 'date' => $req->date, 'service_type' => $req->service_type, 'service_option' => $req->service_option, 'hour' => $req->labour_hour, 'rate' => $req->labour_rate, 'pay_due' => $req->labour_paydue, 'technician' => $req->technician]);

            if($checkPayschedule == true){
                $resData = ['res' => 'Processing...', 'message' => 'success', 'link' => $req->estimate_id, 'action' => 'printmail'];
            }
            else{
                $resData = ['res' => 'Something went wrong. Cant load payment schedule', 'message' => 'info'];
            }
         }

         elseif($req->purpose == "paystub"){
            // Update Record
            $gettechstaff = PaySchedule::where('estimate_id', $req->estimate_id)->where('busID', Auth::user()->busID)->update(['pay_stub' => '1', 'start_date' => $req->start_date, 'end_date' => $req->end_date, 'cash_amount' => $req->cashamount, 'cheque_no' => $req->chequeno, 'cheque_date' => $req->chequedate, 'cheque_amout' => $req->chequeamount, 'creditcard_no' => $req->creditcardno, 'creditcard_cc' => $req->creditcardcc, 'creditcard_amount' => $req->creditcardamount, 'total_amount' => $req->totalamount]);

            if($gettechstaff ==  1){
                $resData = ['res' => 'Process payment moved to labour pay stub  ', 'message' => 'success', 'link' => 'userDashboard?c=labourschedule', 'action' => 'paystub', 'estimate_id' => $req->estimate_id];
            }
            else{
                $resData = ['res' => 'Something went wrong. Cant process payment', 'message' => 'info'];
            }
         }

         elseif($req->purpose == "paystubmail"){
            // Update Record
            $printtechstaff = PaySchedule::where('estimate_id', $req->estimate_id)->where('busID', Auth::user()->busID)->update(['pay_stub' => '0', 'start_date' => $req->start_date, 'end_date' => $req->end_date, 'cash_amount' => $req->cashamount, 'cheque_no' => $req->chequeno, 'cheque_date' => $req->chequedate, 'cheque_amout' => $req->chequeamount, 'creditcard_no' => $req->creditcardno, 'creditcard_cc' => $req->creditcardcc, 'creditcard_amount' => $req->creditcardamount, 'total_amount' => $req->totalamount]);

            if($printtechstaff ==  1){
                $resData = ['res' => 'Processing Invoice', 'message' => 'success', 'link' => $req->estimate_id, 'action' => 'paystubmail'];
            }
            else{
                $resData = ['res' => 'Something went wrong. Cant process print/email', 'message' => 'info'];
            }
         }

         return $this->returnJSON($resData);
    }


    public function informationCheck(Request $req){
        // Get data by joining payschedule table and estimate table....

        if($req->val == "paystub"){
            $from = date('Y-m-d', strtotime($req->start_date));
        $to = date('Y-m-d', strtotime($req->end_date));

        // Get Technician email
        $technicianMail = Estimate::where('estimate_id', $req->estimate_id)->get();

        // dd($technicianMail);

        if(count($technicianMail) > 0){
            $getinfo = DB::table('estimate')
                ->join('pay_schedule', 'pay_schedule.estimate_id', '=', 'estimate.estimate_id')->where('estimate.technician', $technicianMail[0]->technician)->where('pay_schedule.busID', Auth::user()->busID)->whereBetween('estimate.created_at', [$from, $to])->orderBy('estimate.created_at', 'DESC')
                ->get();

                // dd($getinfo);

                if(count($getinfo) > 0){
                    $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($getinfo), 'action' => 'paystub'];
                }
                else{
                    $resData = ['res' => 'Record not found', 'message' => 'info'];
                }
        }
        else{
            $resData = ['res' => 'Record not found', 'message' => 'info'];
        }


        }

        return $this->returnJSON($resData);
    }


    public function processStub(Request $req){

        if($req->purpose == "processpaystub"){
            // Check if exist
        $checkstub = LabourPaystub::where('estimate_id', $req->estimate_id)->where('pay_stub', '2')->get();

        if(count($checkstub) > 0){
            $resData = ['res' => 'Labour payment already processed', 'message' => 'info'];
        }
        else{

            // Update
            $updtstub = LabourPaystub::where('estimate_id', $req->estimate_id)->where('pay_stub', '1')->get();
            if(count($updtstub) > 0){
                // Update
                // Insert
            $upssstub = LabourPaystub::where('estimate_id', $req->estimate_id)->where('pay_stub', '1')->update(['estimate_id' => $req->estimate_id, 'busID' => Auth::user()->busID, 'licence' => $req->licence, 'make' => $req->make, 'model' => $req->model, 'date' => $req->reportdate, 'service_type' => $req->service_type, 'service_option' => $req->service_option, 'hour' => $req->hour, 'rate' => $req->rate, 'pay_due' => $req->pay_due, 'technician' => $req->technician, 'pay_stub' => '2', 'start_date' => $req->start_date, 'end_date' => $req->end_date, 'deduction' => $req->deduction, 'balance' => $req->balance, 'total_pay' => $req->totalpay, 'cash_amount' => $req->cashamount, 'cheque_no' => $req->chequeno, 'cheque_date' => $req->chequedate, 'cheque_amout' => $req->chequeamount, 'creditcard_no' => $req->creditcardno, 'creditcard_cc' => $req->creditcardcc, 'creditcard_amount' => $req->creditcardamount, 'total_amount' => $req->totalamount]);

                if($upssstub == 1){
                    // Update Payshedule
                    PaySchedule::where('estimate_id', $req->estimate_id)->where('pay_stub', '1')->update(['pay_stub' => '2']);

                    $resData = ['res' => 'Payment Processed', 'message' => 'success', 'link' => 'userDashboard?c=labourschedule', 'action' => 'processpaystub', 'estimate_id' => $req->estimate_id];
                }
                else{
                    $resData = ['res' => 'Something went wrong. Cant process payment', 'message' => 'info'];
                }
            }
            else{
                // Insert
            $insstub = LabourPaystub::insert(['estimate_id' => $req->estimate_id, 'busID' => Auth::user()->busID, 'licence' => $req->licence, 'make' => $req->make, 'model' => $req->model, 'date' => $req->reportdate, 'service_type' => $req->service_type, 'service_option' => $req->service_option, 'hour' => $req->hour, 'rate' => $req->rate, 'pay_due' => $req->pay_due, 'technician' => $req->technician, 'pay_stub' => '2', 'start_date' => $req->start_date, 'end_date' => $req->end_date, 'deduction' => $req->deduction, 'balance' => $req->balance, 'total_pay' => $req->totalpay, 'cash_amount' => $req->cashamount, 'cheque_no' => $req->chequeno, 'cheque_date' => $req->chequedate, 'cheque_amout' => $req->chequeamount, 'creditcard_no' => $req->creditcardno, 'creditcard_cc' => $req->creditcardcc, 'creditcard_amount' => $req->creditcardamount, 'total_amount' => $req->totalamount]);

            if($insstub == true){

                // Update Payshedule
                    PaySchedule::where('estimate_id', $req->estimate_id)->where('pay_stub', '1')->update(['pay_stub' => '2']);

                $resData = ['res' => 'Payment Processed', 'message' => 'success', 'link' => 'userDashboard?c=labourschedule', 'action' => 'processpaystub'];
            }
            else{
                $resData = ['res' => 'Something went wrong. Cant process payment', 'message' => 'info'];
            }
            }

        }
        }
        elseif($req->purpose == "processpaystubmail"){
            // Check if exist
            $checkstubs = LabourPaystub::where('estimate_id', $req->estimate_id)->where('pay_stub', '2')->get();
            if(count($checkstubs) > 0){
                $resData = ['res' => 'Labour payment already processed', 'message' => 'info'];
            }
            else{

            // Update
            $updtstubs = LabourPaystub::where('estimate_id', $req->estimate_id)->where('pay_stub', '1')->get();
            if(count($updtstubs) > 0){
                // Update
                // Insert
            $upssstubs = LabourPaystub::where('estimate_id', $req->estimate_id)->where('pay_stub', '1')->update(['estimate_id' => $req->estimate_id, 'busID' => Auth::user()->busID, 'licence' => $req->licence, 'make' => $req->make, 'model' => $req->model, 'date' => $req->reportdate, 'service_type' => $req->service_type, 'service_option' => $req->service_option, 'hour' => $req->hour, 'rate' => $req->rate, 'pay_due' => $req->pay_due, 'technician' => $req->technician, 'pay_stub' => '1', 'start_date' => $req->start_date, 'end_date' => $req->end_date, 'deduction' => $req->deduction, 'balance' => $req->balance, 'total_pay' => $req->totalpay, 'cash_amount' => $req->cashamount, 'cheque_no' => $req->chequeno, 'cheque_date' => $req->chequedate, 'cheque_amout' => $req->chequeamount, 'creditcard_no' => $req->creditcardno, 'creditcard_cc' => $req->creditcardcc, 'creditcard_amount' => $req->creditcardamount, 'total_amount' => $req->totalamount]);

                if($upssstubs == 1){
                    $resData = ['res' => 'Processing Pay Invoice', 'message' => 'success', 'link' => $req->estimate_id, 'action' => 'processpaystubmail'];
                }
                else{
                    $resData = ['res' => 'Something went wrong. Cant process payment', 'message' => 'info'];
                }
            }
            else{
                // Insert
            $insstubs = LabourPaystub::insert(['estimate_id' => $req->estimate_id, 'busID' => Auth::user()->busID, 'licence' => $req->licence, 'make' => $req->make, 'model' => $req->model, 'date' => $req->reportdate, 'service_type' => $req->service_type, 'service_option' => $req->service_option, 'hour' => $req->hour, 'rate' => $req->rate, 'pay_due' => $req->pay_due, 'technician' => $req->technician, 'pay_stub' => '1', 'start_date' => $req->start_date, 'end_date' => $req->end_date, 'deduction' => $req->deduction, 'balance' => $req->balance, 'total_pay' => $req->totalpay, 'cash_amount' => $req->cashamount, 'cheque_no' => $req->chequeno, 'cheque_date' => $req->chequedate, 'cheque_amout' => $req->chequeamount, 'creditcard_no' => $req->creditcardno, 'creditcard_cc' => $req->creditcardcc, 'creditcard_amount' => $req->creditcardamount, 'total_amount' => $req->totalamount]);

            if($insstubs == true){
                $resData = ['res' => 'Processing Pay Invoice', 'message' => 'success', 'link' => $req->estimate_id, 'action' => 'processpaystubmail'];
            }
            else{
                $resData = ['res' => 'Something went wrong. Cant process payment', 'message' => 'info'];
            }
            }

        }
        }


        return $this->returnJSON($resData);
    }


    public function performsearchAction(Request $req){
        $getBusstations = Stations::where('station_phone', $req->phone)->get();

        if(count($getBusstations) > 0){
            if($req->action == "make call"){
            // Get Business Staff with that number
                $getbusStaff = BusinessStaffs::where('station', $getBusstations[0]->station_name)->get();

                if(count($getbusStaff) > 0){
                    // Get Mail Info here and send response
                    $this->to = $getBusstations[0]->email;
                    // $this->to = "info@vimfile.com";
                    $this->company = $getBusstations[0]->station;
                    $this->sender = Auth::user()->name;
                    $this->city = Auth::user()->city;
                    $this->state = Auth::user()->state;
                    $this->country = Auth::user()->country;

                    $this->sendEmail($this->to, 'VIM File - Search Appearance');

                    $resData = ['res' => 'Please wait...', 'message' => 'success', 'link' => $req->phone, 'action' => 'make call'];
                }
                else{
                    // Check Business table
                    $gettechStaff = Business::where('telephone', $req->phone)->get();

                    if(count($gettechStaff) > 0){
                        // Get Mail Info here and send response
                        $this->to = $gettechStaff[0]->email;
                        // $this->to = "info@vimfile.com";
                        $this->company = $gettechStaff[0]->name_of_company;
                        $this->sender = Auth::user()->name;
                        $this->city = Auth::user()->city;
                        $this->state = Auth::user()->state;
                        $this->country = Auth::user()->country;

                        $this->sendEmail($this->to, 'VIM File - Search Appearance');

                        $resData = ['res' => 'Please wait...', 'message' => 'success', 'link' => $req->phone, 'action' => 'make call'];
                    }
                    else{
                        $resData = ['res' => 'Invalid contact information', 'message' => 'info'];
                    }
                }
            }
            elseif($req->action == "send sms"){
                // Get Business Staff with that number
                $getbusStaff = BusinessStaffs::where('station', $getBusstations[0]->station_name)->get();

                if(count($getbusStaff) > 0){
                    // Get Mail Info here and send response
                    $this->to = $getBusstations[0]->email;
                    // $this->to = "info@vimfile.com";
                    $this->company = $getBusstations[0]->station;
                    $this->sender = Auth::user()->name;
                    $this->city = Auth::user()->city;
                    $this->state = Auth::user()->state;
                    $this->country = Auth::user()->country;

                    $this->sendEmail($this->to, 'VIM File - Search Appearance');

                    $resData = ['res' => 'Please wait...', 'message' => 'success', 'link' => $req->phone, 'action' => 'send sms'];
                }
                else{
                    // Check Business table
                    $gettechStaff = Business::where('telephone', $req->phone)->get();

                    if(count($gettechStaff) > 0){
                        // Get Mail Info here and send response
                        $this->to = $gettechStaff[0]->email;
                        // $this->to = "info@vimfile.com";
                        $this->company = $gettechStaff[0]->name_of_company;
                        $this->sender = Auth::user()->name;
                        $this->city = Auth::user()->city;
                        $this->state = Auth::user()->state;
                        $this->country = Auth::user()->country;

                        $this->sendEmail($this->to, 'VIM File - Search Appearance');

                        $resData = ['res' => 'Please wait...', 'message' => 'success', 'link' => $req->phone, 'action' => 'send sms'];
                    }
                    else{
                        $resData = ['res' => 'Invalid contact information', 'message' => 'info'];
                    }
                }
            }
            elseif($req->action == "book appointment"){
                // Get Business Staff with that number
                $getbusStaff = BusinessStaffs::where('station', $getBusstations[0]->station_name)->get();

                if(count($getbusStaff) > 0){
                    // Get Mail Info here and send response
                    $this->to = $getBusstations[0]->email;
                    // $this->to = "info@vimfile.com";
                    $this->company = $getBusstations[0]->station;
                    $this->sender = Auth::user()->name;
                    $this->city = Auth::user()->city;
                    $this->state = Auth::user()->state;
                    $this->country = Auth::user()->country;

                    $this->sendEmail($this->to, 'VIM File - Search Appearance');

                    $resData = ['res' => 'Message Sent', 'message' => 'success', 'action' => 'book appointment'];
                }
                else{
                    // Check Business table
                    $gettechStaff = Business::where('telephone', $req->phone)->get();

                    if(count($gettechStaff) > 0){
                        // Get Mail Info here and send response
                        $this->to = $gettechStaff[0]->email;
                        // $this->to = "info@vimfile.com";
                        $this->company = $gettechStaff[0]->name_of_company;
                        $this->sender = Auth::user()->name;
                        $this->city = Auth::user()->city;
                        $this->state = Auth::user()->state;
                        $this->country = Auth::user()->country;

                        $this->sendEmail($this->to, 'VIM File - Search Appearance');

                        $resData = ['res' => 'Message Sent', 'message' => 'success', 'action' => 'book appointment'];
                    }
                    else{
                        $resData = ['res' => 'Invalid contact information', 'message' => 'info'];
                    }
                }
            }
        }
        else{

            // Start Here

            $getBusiness = Business::where('telephone', $req->phone)->get();

            if(count($getBusiness) > 0){
                $number = explode(", ", $req->phone);
                $emails = explode(", ", $getBusiness[0]->email);
            if($req->action == "make call"){
                    // Get Mail Info here and send response
                    $this->to = $emails[0];
                // $this->to = "info@vimfile.com";
                    $this->company = $getBusiness[0]->name_of_company;
                    $this->sender = Auth::user()->name;
                    $this->city = Auth::user()->city;
                    $this->state = Auth::user()->state;
                    $this->country = Auth::user()->country;

                    $this->sendEmail($this->to, 'VIM File - Search Appearance');

                    $resData = ['res' => 'Please wait...', 'message' => 'success', 'link' => $number[0], 'action' => 'make call'];
            }
            elseif($req->action == "send sms"){
                    // Get Mail Info here and send response
                    $this->to = $emails[0];
                    // $this->to = "info@vimfile.com";
                    $this->company = $getBusiness[0]->name_of_company;
                    $this->sender = Auth::user()->name;
                    $this->city = Auth::user()->city;
                    $this->state = Auth::user()->state;
                    $this->country = Auth::user()->country;
                    $this->sendEmail($this->to, 'VIM File - Search Appearance');

                    $resData = ['res' => 'Please wait...', 'message' => 'success', 'link' => $number[0], 'action' => 'send sms'];

            }
            elseif($req->action == "book appointment"){
                    // Get Mail Info here and send response
                    $this->to = $emails[0];
                // $this->to = "info@vimfile.com";
                    $this->company = $getBusiness[0]->name_of_company;
                    $this->sender = Auth::user()->name;
                    $this->city = Auth::user()->city;
                    $this->state = Auth::user()->state;
                    $this->country = Auth::user()->country;

                    $this->sendEmail($this->to, 'VIM File - Search Appearance');

                    $resData = ['res' => 'Message Sent', 'message' => 'success', 'action' => 'book appointment'];
                }

            }
            else{
                $resData = ['res' => 'Invalid contact information', 'message' => 'info'];
            }

            // End Here

            // $resData = ['res' => 'Station Information not valid.', 'message' => 'info'];
        }

        return $this->returnJSON($resData);
    }


    public function editEstimates(Request $req){
        $getmyData = Estimate::where('estimate_id', $req->post_id)->where('estimate', '1')->get();

        if(count($getmyData) > 0){
            $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($getmyData)];
        }
        else{
            $resData = ['res' => 'Can not get this estimate information', 'message' => 'info'];
        }

        return $this->returnJSON($resData);
    }

    public function saveEdit(Request $req){
        $detail = Estimate::where('estimate_id', $req->estimate_id)->where('estimate', '1')->get();

        if(count($detail) > 0){
             // Save Record
             $req = request();

            if($req->file('file') != null)
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

                // $path = $req->file('file')->move(public_path('/uploads/'), $fileNameToStore);

                $path = $req->file('file')->move(public_path('../../uploads/'), $fileNameToStore);

            }
            else
            {
                $fileNameToStore = $detail[0]->file;
            }
            // Insert new record

            $estRecs = Estimate::where('estimate_id', $req->estimate_id)->where('estimate', '1')->update(['email' => $req->email, 'telephone' => $req->telephone, 'busID' => $req->busID, 'vehicle_licence' => $req->vehicle_licence, 'make' => $req->make, 'model' => $req->model, 'date' => $req->date, 'service_type' => $req->service_type, 'service_option' => $req->service_option, 'service_item_spec' => $req->service_item_spec, 'manufacturer' => $req->manufacturer, 'material_qty' => $req->material_qty, 'material_cost' => $req->material_cost, 'labour_qty' => $req->labour_qty, 'labour_cost' => $req->labour_cost,'material_qty2' => $req->material_qty2,'material_qty3' => $req->material_qty3,'material_qty4' => $req->material_qty4,'material_qty5' => $req->material_qty5,'material_qty6' => $req->material_qty6,'material_qty7' => $req->material_qty7,'material_qty8' => $req->material_qty8,'material_qty9' => $req->material_qty9,'material_qty10' => $req->material_qty10,'labour_qty2' => $req->labour_qty2,'labour_qty3' => $req->labour_qty3,'labour_qty4' => $req->labour_qty4,'labour_qty5' => $req->labour_qty5,'labour_qty6' => $req->labour_qty6,'labour_qty7' => $req->labour_qty7,'labour_qty8' => $req->labour_qty8,'labour_qty9' => $req->labour_qty9,'labour_qty10' => $req->labour_qty10,'material_cost2' => $req->material_cost2,'material_cost3' => $req->material_cost3,'material_cost4' => $req->material_cost4,'material_cost5' => $req->material_cost5,'material_cost6' => $req->material_cost6,'material_cost7' => $req->material_cost7,'material_cost8' => $req->material_cost8,'material_cost9' => $req->material_cost9,'material_cost10' => $req->material_cost10,'labour_cost2' => $req->labour_cost2,'labour_cost3' => $req->labour_cost3,'labour_cost4' => $req->labour_cost4,'labour_cost5' => $req->labour_cost5,'labour_cost6' => $req->labour_cost6,'labour_cost7' => $req->labour_cost7,'labour_cost8' => $req->labour_cost8,'labour_cost9' => $req->labour_cost9,'labour_cost10' => $req->labour_cost10, 'manufacturer2' => $req->manufacturer2, 'manufacturer3' => $req->manufacturer3, 'service_item_spec2' => $req->service_item_spec2, 'service_item_spec3' => $req->service_item_spec3, 'other_qty' => $req->other_qty, 'other_cost' => $req->other_cost, 'total_cost' => $req->total_cost, 'service_note' => $req->service_note, 'mileage' => $req->mileage, 'file' => $fileNameToStore, 'update_by' => $req->update_by, 'estimate' => '1', 'work_order' => '0', 'diagnostics' => '0', 'inventory_list' => $req->inventory_list1, 'inventory_amount' => $req->inventory_amount1, 'inventory_note' => $req->inventory_addnote1, 'inventory_list2' => $req->inventory_list2, 'inventory_amount2' => $req->inventory_amount2, 'inventory_note2' => $req->inventory_addnote2, 'inventory_list3' => $req->inventory_list3, 'inventory_amount3' => $req->inventory_amount3, 'inventory_note3' => $req->inventory_addnote3, 'technician' => $req->technician]);

            // dd($estRec);

            if($estRecs == 1){
                $getData = Estimate::where('estimate_id', $req->estimate_id)->where('estimate', '1')->get();

                $resData = ['res' => 'Maintenance Estimation Updated', 'message' => 'success', 'info' => $req->estimate_id, 'email' => $req->email, 'data' => json_encode($getData)];
            }
            else{
                $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
            }
        }
        else{
            $resData = ['res' => 'Can not get this estimate information', 'message' => 'info'];
        }



        return $this->returnJSON($resData);
    }

    public function monitorRecords(Request $req){

        if($req->purpose == "estimate"){
            $_CheckEstimate = Estimate::where('vehicle_licence', $req->licence)->where('estimate', '1')->get();
            if(count($_CheckEstimate) > 0){

                $resData = ['res' => 'Fetching', 'message' => 'success', 'action' => 'estimate', 'link' => $req->licence, 'data' => json_encode($_CheckEstimate)];
            }
            else{
                $resData = ['res' => 'No Estimate Record on vehicle', 'message' => 'info'];
            }

        }
        elseif($req->purpose == "workorder"){
            $_CheckWorkorder = Estimate::where('vehicle_licence', $req->licence)->where('work_order', '1')->get();
            if(count($_CheckWorkorder) > 0){

                $resData = ['res' => 'Fetching', 'message' => 'success', 'action' => 'workorder', 'link' => $req->licence, 'data' => json_encode($_CheckWorkorder)];
            }
            else{
                $resData = ['res' => 'No Work Order Record on vehicle', 'message' => 'info'];
            }
        }
        elseif($req->purpose == "maintenance"){
            $_CheckMaintenance = Vehicleinfo::where('vehicle_licence', $req->licence)->get();
            if(count($_CheckMaintenance) > 0){
                $resData = ['res' => 'Fetching', 'message' => 'success', 'action' => 'maintenance', 'link' => $req->licence, 'data' => json_encode($_CheckMaintenance)];
            }
            else{
                $resData = ['res' => 'No Maintenance Record on vehicle', 'message' => 'info'];
            }
        }
        elseif($req->purpose == "ownerrec"){
            $_CheckOwnerrec = Carrecord::where('vehicle_reg_no', $req->licence)->get();
            if(count($_CheckOwnerrec) > 0){
                $resData = ['res' => 'Fetching', 'message' => 'success', 'action' => 'ownerrec', 'link' => $_CheckOwnerrec[0]->email, 'data' => json_encode($_CheckOwnerrec)];
            }
            else{
                $resData = ['res' => 'No Owner Record found for this vehicle', 'message' => 'info'];
            }
        }
        elseif($req->purpose == "deleterec"){
            // Delete Car record
            $_DelCar = Carrecord::where('vehicle_reg_no', $req->licence)->get();

            if(count($_DelCar) > 0){
                // Deactivate User
                User::where('email', $_DelCar[0]->email)->delete();
                Carrecord::where('vehicle_reg_no', $req->licence)->delete();
                Estimate::where('vehicle_licence', $req->licence)->delete();
                Vehicleinfo::where('vehicle_licence', $req->licence)->delete();

                $resData = ['res' => 'Vehicle Information Deleted', 'message' => 'success', 'link' => 'userDashboard'];
            }
            else{
                $resData = ['res' => 'Cannot find record', 'message' => 'info'];
            }
        }

        return $this->returnJSON($resData);
    }

    public function bookingTicket(Request $req){

        // Insert Ticketing Records
        $req = request();


        if($req->file('ticketAttachment'))
        {
            //Get filename with extension
            $filenameWithExt = $req->file('ticketAttachment')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
            // Get just extension
            $extension = $req->file('ticketAttachment')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = rand().'_'.time().'.'.$extension;
            //Upload Image
            // $path = $req->file('ticketAttachment')->storeAs('public/uploads', $fileNameToStore);

            // $path = $req->file('ticketAttachment')->move(public_path('/ticketing_file/'), $fileNameToStore);

            $path = $req->file('ticketAttachment')->move(public_path('../../ticketing_file/'), $fileNameToStore);

        }
        else
        {
            $fileNameToStore = 'noImage.png';
        }

        $insTicket = Ticketing::insert(['ticketID' => $req->ticketID, 'ticketName' => $req->ticketName, 'ticketEmail' => $req->ticketEmail, 'ticketSubject' => $req->ticketSubject, 'ticketDepartment' => $req->ticketDepartment, 'ticketRelatedServices' => $req->ticketRelatedServices, 'ticketPriority' => $req->ticketPriority, 'ticketMessage' => $req->ticketMessage, 'ticketUsertype' => Auth::user()->userType, 'ticketAttachment' => $fileNameToStore]);

        if($insTicket == true){
            // Send Mail to Ticketing mail
            $this->to = "ticketing@vimfile.com";
            $this->sender = $req->ticketName;
            $this->email = $req->ticketEmail;
            $this->subject = $req->ticketSubject;
            $this->department = $req->ticketDepartment;
            $this->relatedService = $req->ticketRelatedServices;
            $this->message = $req->ticketMessage;
            $this->document = $fileNameToStore;

            $this->sendEmail($this->to, 'VIM File - Support Ticket Created');
            $resData = ['res' => 'Your ticket order with an id '.$req->ticketID.' was successfully generated', 'message' => 'success'];
        }
        else{
            $resData = ['res' => 'Could not send message at this time', 'message' => 'error'];
        }

        return $this->returnJSON($resData);
    }

    public function checkuserRegistration(Request $req){
        $checkreginfo = User::where('email', $req->email)->get();

        if(count($checkreginfo) > 0){
            $resData = ['res' => 'This account is already registered', 'message' => 'error'];
        }
        else{

            // Insert Carrecord
            $putCarrec = Carrecord::insert(['email' => $req->email, 'telephone' => $req->telephone, 'parentKey' => 'VIM_'.time(), 'vehicle_nickname' => $req->vehicle_nickname, 'date_added' => date('Y-m-d'), 'make' => $req->vehicle_make, 'model' => $req->vehicle_model, 'vehicle_reg_no' => $req->vehicle_licence, 'city' => $req->city, 'state' => $req->state, 'country_of_reg' => $req->country, 'zipcode' => $req->zipcode, 'purchase_type' => $req->purchase_type, 'year_owned_since' => $req->year_owned_since, 'current_mileage' => $req->mileage]);

            if($putCarrec == true){
                $resData = ['res' => 'Authentication Successfull, Signing up account!', 'message' => 'success'];
            }
            else{
                $resData = ['res' => 'Authentication Failed! Try again later', 'message' => 'error'];
            }


        }

        return $this->returnJSON($resData);
    }



    // CRON TO BE RUN FOR INVITED USERS
    public function triggeruser(Request $req){
        // Check user email if exist, if exist => update to registered, else goto mail and send invite mail

        $getgoogleContact = GoogleImport::inRandomOrder()->limit(50)->get();


        if(count($getgoogleContact) > 0){
            foreach ($getgoogleContact as $key) {
                $email = $key['email'];
                $invitee = $key['invite_from'];

                // Do check User table

                $userTable = User::where('email', $email)->get();

                // get Invitee name
                $invitee = User::where('ref_code', $invitee)->get();

                if(count($userTable) > 0){
                    // Update List
                    $updtTable = GoogleImport::where('email', $userTable[0]->email)->update(['status' => 'registered']);
                }
                else{
                    // Send Mail to Random 20
                    if(count($invitee) > 0){
                        $receiver = GoogleImport::where('status', 'not registered')->inRandomOrder()->limit(5)->get();

                        // $authToken = " 3840ff4d04e141cc3bec50d62467ac12";
                        // $xmldata = "<response>
                        //             <uri>/api/sendcampaign</uri>
                        //             <code>200</code>
                        //             <version>1</version>
                        //             <message></message>
                        //             <campaign_status>inprogress</campaign_status>
                        //         </response>";


                        //       $result = $this->zohoCampaign($authToken, $xmldata);

                        //       dd($result);

                        $emails = explode(", ", $receiver[0]->email);

                        $this->name = $invitee[0]->name;
                        $this->to = $emails[0];
                        // $this->to = "info@vimfile.com";
                        $this->ref_code = $invitee[0]->ref_code;
                        $this->sendEmail($this->to, 'VIM FILE -You can now do vehicle maintenance, wherever, whenever');
                    }
                    else{
                        $receivers = GoogleImport::where('status', 'not registered')->inRandomOrder()->limit(5)->get();

                        // $authToken = " 3840ff4d04e141cc3bec50d62467ac12";
                        // $xmldata = "<response><uri>/api/sendcampaign</uri><code>200</code><version>1</version><message>Hello Test</message><campaign_status>inprogress</campaign_status></response>";


                        //       $result = $this->zohoCampaign($authToken, $xmldata);

                        //       dd($result);

                        $email = explode(", ", $receivers[0]->email);

                        $this->name = "VIM File";
                        $this->to = $email[0];
                        // $this->to = "info@vimfile.com";
                        $this->ref_code = "VIM_1234";
                        $this->sendEmail($this->to, 'VIM FILE -You can now do vehicle maintenance, wherever, whenever');
                    }



                }
            }
            echo "Done";
        }
        else{
            // Do nothing
            echo 0;
        }

    }




    // Reminder to Register Vehicle
    public function registervehicleReminder(Request $req){

        // Get all users whose car record is absent
        $userget = User::where('userType', 'Individual')->orWhere('userType', 'Business')->orderBy('created_at', 'DESC')->get();

        if(count($userget) > 0){
            foreach ($userget as $key) {
                $email = $key['email'];
                $name = $key['name'];
                // Car record

                $getCarsrec = Carrecord::where('email', $email)->get();

                if(count($getCarsrec) > 0){
                    // Do noting
                    echo 0;
                }
                else{

                    // Get emails and send reminder
                    $this->name = $name;
                    $this->to = $email;
                    // $this->to = "info@vimfile.com";
                    $this->sendEmail($this->to, 'Register a Vehicle and start tracking all maintenance activities');
                }

            }

            echo "Done";
        }
        else{
            // Do nothing
            echo 0;
        }

    }


        // Reminder to Record Maintenance
    public function recordmaintenanceReminder(Request $req){

        // Get all users whose car record is absent
        $usergets = User::orderBy('created_at', 'DESC')->get();

        if(count($usergets) > 0){
            foreach ($usergets as $key) {
                $email = $key['email'];
                $name = $key['name'];
                // Car record

                $getvehclinfo = Vehicleinfo::where('email', $email)->get();

                if(count($getvehclinfo) > 0){
                    // Do noting
                    echo 0;
                }
                else{

                    // Get emails and send reminder
                    $this->name = $name;
                    $this->to = $email;
                    // $this->to = "info@vimfile.com";
                    $this->sendEmail($this->to, 'We have made it easier to track vehicle maintenance activities');
                }

            }

            echo "Done";
        }
        else{
            // Do nothing
            echo 0;
        }

    }



            // Reminder to Upload Contact
    public function uploadcontactReminder(Request $req){

        // Get all users whose car record is absent
        $userdets = User::orderBy('created_at', 'DESC')->get();

        if(count($userdets) > 0){
            foreach ($userdets as $key) {
                $email = $key['email'];
                $name = $key['name'];
                $ref_code = $key['ref_code'];
                // Car record

                $getimport = GoogleImport::where('invite_from', $ref_code)->get();

                if(count($getimport) > 0){
                    // Do noting
                    echo 0;
                }
                else{

                    // Get emails and send reminder
                    $this->name = $name;
                    $this->to = $email;
                    // $this->to = "info@vimfile.com";
                    $this->sendEmail($this->to, '1-Year Vehicle Oil Change is on Us');
                }

            }

            echo "Done";
        }
        else{
            // Do nothing
            echo 0;
        }

    }

            // Reminder to Update Vehicle Information
    public function vehicleinfoReminder(Request $req){

        // Get all users whose car record is absent
        $userinfdets = User::orderBy('created_at', 'DESC')->get();

        if(count($userinfdets) > 0){
            foreach ($userinfdets as $key) {
                $email = $key['email'];
                $name = $key['name'];
                $ref_code = $key['ref_code'];
                // Car record

                $getchasisimport = Carrecord::where('email', $email)->where('chassis_no', '!=', null)->get();

                if(count($getchasisimport) > 0){
                    // Do noting
                    echo 0;
                }
                else{

                    // Get emails and send reminder
                    $this->name = $name;
                    $this->to = $email;
                    // $this->to = "info@vimfile.com";

                    // echo $this->to;
                    $this->sendEmail($this->to, 'Your Vehicle Information is Missing');
                }

            }

            echo "Done";
        }
        else{
            // Do nothing
            echo 0;
        }

    }


    public function vehicleinfoSum($service){
        $data = Vehicleinfo::where('email', Auth::user()->email)->where('service_type', 'LIKE', '%'.$service.'%')->sum('total_cost');

        return $data;
    }



    // Reminder to Monthly Ivim Report
    public function ivimreportReminder(Request $req){

        // Get all users whose car record is absent
        $userinfdetails = User::orderBy('created_at', 'DESC')->get();



        if(count($userinfdetails) > 0){

            foreach ($userinfdetails as $key) {

                $email = $key['email'];
                // $email = 'adenugaadebambo41@gmail.com';
                $name = $key['name'];





                $carrecordx = Carrecord::where('email', $email)->get();



                if(count($carrecordx) > 0){



                    $oil = vehicleInfo::where('email', $email)->where('service_type', 'LIKE', '%Oil change%')->orderBy('created_at', 'DESC')->get();



                    if(count($oil) > 0){
                        $this->oilChange = $oil;
                        $this->oilChangedate = $oil[0]->created_at;
                        $this->mileage1 = $oil[0]->mileage;
                        $this->current_mileage = $carrecordx[0]->current_mileage;
                    }else{
                        $this->oilChange = 0;
                        $this->oilChangedate = 0;
                        $this->mileage1 = 0;
                        $this->current_mileage = 0;
                    }


                    $tyre = vehicleInfo::where('email', $email)->where('service_type', 'LIKE', '%Wheel balancing%')->orderBy('created_at', 'DESC')->take(1)->get();

                    if(count($tyre) > 0){
                        $this->tyreRotation = $tyre;
                        $this->tyredate = $tyre[0]->created_at;
                        $this->mileage2 = $tyre[0]->mileage;
                        $this->current_mileage = $carrecordx[0]->current_mileage;
                    }else{
                        $this->tyreRotation = 0;
                        $this->tyredate = 0;
                        $this->mileage2 = 0;
                        $this->current_mileage = 0;
                    }



                    // dd($this->tyreRotation);

                    $air = vehicleInfo::where('email', $email)->where('service_type', 'LIKE', '%Air Filter%')->orderBy('created_at', 'DESC')->take(1)->get();

                    if(count($air) > 0){
                        $this->airFilter = $air;
                        $this->airdate = $air[0]->created_at;
                        $this->mileage3 = $air[0]->mileage;
                        $this->current_mileage = $carrecordx[0]->current_mileage;
                    }else{
                        $this->airFilter = 0;
                        $this->airdate = 0;
                        $this->mileage3 = 0;
                        $this->current_mileage = 0;
                    }



                    $inspection = vehicleInfo::where('email', $email)->where('service_type', 'LIKE', '%Inspection%')->orderBy('created_at', 'DESC')->take(1)->get();

                    if(count($inspection) > 0){
                        $this->inspection = $inspection;
                        $this->inspectiondate = $inspection[0]->created_at;
                        $this->mileage4 = $inspection[0]->mileage;
                        $this->current_mileage = $carrecordx[0]->current_mileage;
                    }else{
                        $this->inspection = 0;
                        $this->inspectiondate = 0;
                        $this->mileage4 = 0;
                        $this->current_mileage = 0;
                    }

                    $registration = vehicleInfo::where('email', $email)->where('service_type', 'LIKE', '%Registration%')->orderBy('created_at', 'DESC')->take(1)->get();

                    if(count($registration) > 0){
                        $this->registration = $registration;
                        $this->registrationdate = $registration[0]->created_at;
                        $this->mileage5 = $registration[0]->mileage;
                        $this->current_mileage = $carrecordx[0]->current_mileage;
                    }else{
                        $this->registration = 0;
                        $this->registrationdate = 0;
                        $this->mileage5 = 0;
                        $this->current_mileage = 0;
                    }



                    // dd($this->registrationdate);

                // Get emails and send reminder
                $this->name = $name;
                $this->to = $email;
                // $this->to = "info@vimfile.com";
                $this->oilChange = $this->oilChange;
                $this->oilChangedate = $this->oilChangedate;
                $this->tyredate = $this->tyredate;
                $this->airdate = $this->airdate;
                $this->inspectiondate = $this->inspectiondate;
                $this->registrationdate = $this->registrationdate;
                $this->mileage1 = $this->mileage1;
                $this->mileage2 = $this->mileage2;
                $this->mileage3 = $this->mileage3;
                $this->mileage4 = $this->mileage4;
                $this->mileage5 = $this->mileage5;
                $this->tyreRotation = $this->tyreRotation;
                $this->airFilter = $this->airFilter;
                $this->inspection = $this->inspection;
                $this->registration = $this->registration;
                $this->current_mileage = $this->current_mileage;

                // echo $this->to;

                $this->sendEmail($this->to, 'This Month insights into your Vehicle Maintenance Activities');
                // $this->sendEmail('bambo@vimfile.com', 'This Month insights into your Vehicle Maintenance Activities');
                }
                else{
                    // Do nothing
                    echo "<hr>";
                    echo 0;
                }

            }

            echo "Done";
        }
        else{
            // Do nothing
            echo 0;
        }

    }


    public function resendInvites(Request $req){
        // Get Data fro Google Import
        $getImportinfo = GoogleImport::where('invite_from', $req->id)->where('status', 'not registered')->inRandomOrder()->limit(45)->get();

        if(count($getImportinfo) > 0){

            foreach ($getImportinfo as $key) {
               $this->name = Auth::user()->name;
                $this->to = $key['email'];
               // $this->to = "info@vimfile.com";
                $this->ref_code = Auth::user()->ref_code;
                $this->sendEmail($this->to, 'VIM FILE -You can now do vehicle maintenance, wherever, whenever');
            }


            $resData = ['res' => 'Successfully re-invited.', 'message' => 'success'];
        }
        else{
            $resData = ['res' => 'Invitation not sent at the moment', 'message' => 'info'];
        }

        return $this->returnJSON($resData);
    }

    public function redeemPoints(Request $req){
        // Route to Next page
        if($req->action == "start"){
            // Send route to claim and redeem points
            $resData = ['res' => 'Redirecting...', 'message' => 'success', 'action' => 'start', 'link' => 'Redeem'];
        }
        elseif($req->action == "claim"){
            // Activate claims and update redeem table to 1
            // update user-table
            $updtTableuser = User::where('referred_by', $req->ref_code)->where('redeem', '0')->update(['redeem' => '1']);

            if($updtTableuser){

                // Mail Admin and Mail User
                $getuserdetail = User::where('ref_code', $req->ref_code)->get();

                if(count($getuserdetail) > 0){
                    // Check Redeempoint table
                    $redPoint = RedeemPoints::where('ref_code', $req->ref_code)->get();

                    if(count($redPoint) > 0){
                        // Update record
                        RedeemPoints::where('ref_code', $req->ref_code)->update(['ref_code' => $req->ref_code, 'name' => $getuserdetail[0]->name, 'email' => $getuserdetail[0]->email, 'points' => count($getuserdetail), 'userType' => $getuserdetail[0]->userType]);
                    }
                    else{
                        // Insert
                        RedeemPoints::insert(['ref_code' => $req->ref_code, 'name' => $getuserdetail[0]->name, 'email' => $getuserdetail[0]->email, 'points' => count($getuserdetail), 'userType' => $getuserdetail[0]->userType]);
                    }

                    $this->email = $getuserdetail[0]->email;
                    $this->name = $getuserdetail[0]->name;
                    $this->userType = $getuserdetail[0]->userType;
                    $this->redeempoint = count($getuserdetail);

                    $this->sendEmail($this->email, 'VIM FILE - Redeem your points today');
                    $this->sendEmail($this->to, 'VIM FILE Admin- Client Redeemed points');


                    $resData = ['res' => 'We successfully acknowledge your action, we will get back to you shortly', 'message' => 'success', 'action' => 'claim', 'link' => 'userDashboard'];
                }
                else{
                    $resData = ['res' => 'You cannot claim points by this time', 'message' => 'info'];
                }



            }
            else{
                $resData = ['res' => 'Something went wrong', 'message' => 'error'];
            }
        }

        return $this->returnJSON($resData);
    }

    public function ajaxadvanceSearch(Request $req){

                // Get Search text by city
        $getAutocares = Stations::where('zipcode', 'LIKE', '%'.$req->zipcode.'%')->get();

        if(count($getAutocares) > 0){

            if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Technician" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Commercial"){


                if(Auth::user()->zipcode == $getAutocares[0]->zipcode){
                    $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Searched for Auto Care Centers via Postal Code '.$req->zipcode);


                $resData = ['res' => 'Success', 'message' => 'success', 'data' => json_encode($getAutocares), 'link' => 'Advancesearch/'.$req->zipcode];
                }

                else{
                    $resData = ['res' => 'Zip code does not match your area', 'message' => 'info'];
                }


            }


        }
        else{
            $getAutocenterz = Business::where('zipcode', 'LIKE', '%'.$req->zipcode.'%')->get();

                    if(count($getAutocenterz) > 0){
                        if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Auto Care" || Auth::user()->userType == "Technician" || Auth::user()->userType == "Certified Professional" || Auth::user()->userType == "Commercial"){

                            if(Auth::user()->zipcode == $getAutocenterz[0]->zipcode){
                                $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Searched for Auto Care Centers via Postal Code '.$req->zipcode);

                            $resData = ['res' => 'Success', 'message' => 'success', 'data' => json_encode($getAutocenterz), 'link' => 'Advancesearch/'.$req->zipcode];
                            }
                            else{
                                $resData = ['res' => 'Zip code does not match your area', 'message' => 'info'];
                            }
                        }

                    }

                    else{
                        $resData = ['res' => 'Record not found', 'message' => 'info'];
                    }

        }

         return $this->returnJSON($resData);
    }

    public function ajaxupdateactionOpport(Request $req){
        $updtPost = OpportunityPost::where('post_id', $req->post_id)->update(['post_id' => $req->post_id, 'post_subject' => $req->subject, 'service_option' => $req->service_option, 'post_licence' => $req->licence, 'post_make' => $req->make, 'post_model' => $req->model, 'post_mileage' => $req->mileage, 'post_curr_mileage' => $req->curr_mileage,'post_year' => $req->post_year, 'post_description' => $req->description, 'post_timeline' => $req->timeline, 'post_service_need' => $req->postserviceneeded]);

        if($updtPost == 1){
            $resData = ['res' => 'Successfully Updated', 'message' => 'success', 'link' => 'userDashboard'];
        }
        else{
            $resData = ['res' => 'Cannot update, please try again later', 'message' => 'error'];
        }

     return $this->returnJSON($resData);
    }

    public function ajaxcreatePost(Request $req){
        // Post Opprtunities
        $postOpport = OpportunityPost::insert(['post_id' => $req->post_id, 'ref_code' => $req->ref_code, 'email' => $req->email, 'post_subject' => $req->subject, 'service_option' => $req->service_option, 'post_licence' => $req->licence, 'post_make' => $req->make, 'post_model' => $req->model, 'post_mileage' => $req->mileage, 'post_curr_mileage' => $req->curr_mileage,'post_year' => $req->post_year, 'post_description' => $req->description, 'post_timeline' => $req->timeline, 'post_service_need' => $req->postserviceneeded, 'postcity' => $req->postcity, 'poststate' => $req->poststate, 'postzipcode' => $req->postzipcode]);

        if($postOpport == true){
            OpportunityPost::where('post_id', $req->post_id)->update(['state' => '1']);
            // Mail MM & Auto care within Postal Area

            if($req->postrequestby == "zipcode"){
                $infodata = Auth::user()->zipcode;
            }
            elseif($req->postrequestby == "city"){
                $infodata = Auth::user()->city;
            }

            $getReceive = User::where($req->postrequestby, 'LIKE', '%'.$infodata.'%')->where('userType', 'Certified Professional')->orWhere('userType', 'Auto Care')->get();
            if(count($getReceive) > 0){
                foreach ($getReceive as $key) {
                    $this->name = $key['name'];
                    $this->to = $key['email'];
                    // $this->to = "info@vimfile.com";
                    $this->sender = Auth::user()->name;
                    $this->subject = $req->subject;
                    $this->service_option = $req->service_option;
                    $this->message = $req->description;
                    $this->timeline = $req->timeline;
                    $this->location = $req->postserviceneeded;
                    $this->city = $req->postcity;
                    $this->state = $req->poststate;
                    $this->zipcode = $req->postzipcode;
                    $this->licence = $req->licence;
                    $this->make = $req->make;
                    $this->model = $req->model;
                    $this->date = $req->post_year;
                    $this->mileage = $req->mileage;
                    $this->curr_mileage = $req->curr_mileage;

                    $this->sendEmail($this->to, 'There is a new opportunity post within your proximity');
                }

                $resData = ['res' => 'Successfully Posted', 'message' => 'success', 'link' => 'userDashboard'];
            }
            else{
                echo "0";
            }

        }
        else{
            $resData = ['res' => 'Cannot post opportunity by this time', 'message' => 'error'];
        }

        return $this->returnJSON($resData);
    }

    public function ajaxfetchRequest(Request $req){
        // Get data
        switch ($req->search) {
            case 'city':
                $getdata = User::where('city', 'LIKE', '%'.Auth::user()->city.'%')->where('userType', 'Certified Professional')->orWhere('userType', 'Auto Care')->count();
                break;

            case 'zipcode':
                $getdata = User::where('zipcode', 'LIKE', '%'.Auth::user()->zipcode.'%')->where('userType', 'Certified Professional')->orWhere('userType', 'Auto Care')->count();
                break;

            default:
                $getdata = User::where('country', 'LIKE', '%'.Auth::user()->country.'%')->where('userType', 'Certified Professional')->orWhere('userType', 'Auto Care')->count();
                break;
        }

        $resData = ['res' => 'Fetching', 'message' => 'success', 'data' => json_encode($getdata).' result found'];

        return $this->returnJSON($resData);
    }


    public function ajaxprepareEstimate(Request $req){

        // Check if doesnt exist
        $checksEst = PrepareEstimate::where('post_id', $req->post_id)->where('ref_code', $req->ref_code)->get();

        // Get discounts
        $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', Auth::user()->busID)->get();

        $servicecharge = MinimumDiscount::where('discount', 'service')->get();

        if(count($discountcharge) > 0){
            $this->discount = $discountcharge[0]->percent;
            $servicePercent = $servicecharge[0]->percent;
        }
        else{
            // Get Admin Discount
            $getDiscount = MinimumDiscount::where('discount', 'discount')->get();

            $this->discount = $getDiscount[0]->percent;
            $servicePercent = $servicecharge[0]->percent;
        }

        if(count($checksEst) > 0){
            // Update
            $updateEst = PrepareEstimate::where('post_id', $req->post_id)->where('ref_code', $req->ref_code)->update(['post_id' => $req->post_id, 'email' => $req->email, 'ref_code' => $req->ref_code, 'state' => '1']);

            if($updateEst == 1){
                // Check for Estimation Table

                if($checksEst[0]->est_prepared == 1){

                    $resData = ['res' => 'You have already prepared your estimate for this post, Please hold on for it to be reviewed', 'message' => 'info'];
                }
                else{
                    // Insert Record
                    $prepEst = PrepareEstimate::where('post_id', $req->post_id)->get();

                    if(count($prepEst) > 0){

                        PrepareEstimate::where('post_id', $req->post_id)->update(['state' => '1']);
                        // Get Post owner details
                        $getcarowner = Carrecord::where('email', $req->email)->get();
                        // Get service type
                        $service_type = OpportunityPost::where('post_id', $req->post_id)->get();

                        $resData = ['res' => 'Successfully', 'message' => 'success', 'data' => json_encode($getcarowner), 'post_id' => $req->post_id, 'service_type' => $service_type[0]->post_subject, 'discountpercent' => $this->discount, 'servicepercent' => $servicePercent];
                    }
                    else{
                        $resData = ['res' => 'Cannot prepare by this time', 'message' => 'error'];
                    }
                }

            }
            else{
                // Insert Record
                $prepEst = PrepareEstimate::insert(['post_id' => $req->post_id, 'email' => $req->email, 'ref_code' => $req->ref_code]);

                if($prepEst ==  true){
                    PrepareEstimate::where('post_id', $req->post_id)->update(['state' => '1']);
                    // Get Post owner details
                    $getcarowner = Carrecord::where('email', $req->email)->get();

                    // Get service type
                        $service_type = OpportunityPost::where('post_id', $req->post_id)->get();

                    $resData = ['res' => 'Successfully', 'message' => 'success', 'data' => json_encode($getcarowner), 'post_id' => $req->post_id, 'service_type' => $service_type[0]->post_subject, 'discountpercent' => $this->discount, 'servicepercent' => $servicePercent];
                }
                else{
                    $resData = ['res' => 'Cannot prepare by this time', 'message' => 'error'];
                }
            }
        }
        else{
            // Insert Record
            $prepEst = PrepareEstimate::insert(['post_id' => $req->post_id, 'email' => $req->email, 'ref_code' => $req->ref_code]);
            if($prepEst ==  true){
                PrepareEstimate::where('post_id', $req->post_id)->update(['state' => '1']);
                // Get Post owner details
                $getcarowner = Carrecord::where('email', $req->email)->get();

                // Get service type
                $service_type = OpportunityPost::where('post_id', $req->post_id)->get();

                $resData = ['res' => 'Successfully', 'message' => 'success', 'data' => json_encode($getcarowner), 'post_id' => $req->post_id, 'service_type' => $service_type[0]->post_subject, 'discountpercent' => $this->discount, 'servicepercent' => $servicePercent];
            }
            else{
                $resData = ['res' => 'Cannot prepare by this time', 'message' => 'error'];
            }
        }



       return $this->returnJSON($resData);
    }


    public function ajaxnewestimatePrepare(Request $req){

        // Check if doesnt exist
        $checksEst = PrepareEstimate::where('post_id', $req->post_id)->where('ref_code', $req->ref_code)->get();

        // Get discounts
        $discountcharge = clientMinimum::where('discount', 'discount')->where('busID', Auth::user()->busID)->get();

        if(count($discountcharge) > 0){
            $this->discount = $discountcharge[0]->percent;
        }
        else{
            // Get Admin Discount
            $getDiscount = MinimumDiscount::where('discount', 'discount')->get();

            $this->discount = $getDiscount[0]->percent;
        }


        if(count($checksEst) > 0){
            // Update
            $updateEst = PrepareEstimate::where('post_id', $req->post_id)->where('ref_code', $req->ref_code)->update(['post_id' => $req->post_id, 'email' => $req->email, 'ref_code' => $req->ref_code, 'state' => '1']);

            if($updateEst == 1){
                // Check for Estimation Table

                if($checksEst[0]->est_prepared == 1){

                    $resData = ['res' => 'You have already prepared your estimate for this post, Please hold on for it to be reviewed', 'message' => 'info'];
                }
                else{
                    // Insert Record
                    $prepEst = PrepareEstimate::where('post_id', $req->post_id)->get();

                    if(count($prepEst) > 0){

                        PrepareEstimate::where('post_id', $req->post_id)->update(['state' => '1']);
                        // Get Post owner details
                        $getcarowner = Carrecord::where('email', $req->email)->get();
                        // Get service type
                $service_type = BookAppointment::where('ref_code', $req->post_id)->get();

                        $resData = ['res' => 'Successfully', 'message' => 'success', 'data' => json_encode($getcarowner), 'post_id' => $req->post_id, 'service_type' => $service_type[0]->service_type, 'service_option' => $service_type[0]->service_option, 'mileage' => $service_type[0]->current_mileage, 'discountpercent' => $this->discount];
                    }
                    else{
                        $resData = ['res' => 'Cannot prepare by this time', 'message' => 'error'];
                    }
                }

            }
            else{
                // Insert Record
                $prepEst = PrepareEstimate::insert(['post_id' => $req->post_id, 'email' => $req->email, 'ref_code' => $req->ref_code]);

                if($prepEst ==  true){
                    PrepareEstimate::where('post_id', $req->post_id)->update(['state' => '1']);
                    // Get Post owner details
                    $getcarowner = Carrecord::where('email', $req->email)->get();

                    // Get service type
                $service_type = BookAppointment::where('ref_code', $req->post_id)->get();

                    $resData = ['res' => 'Successfully', 'message' => 'success', 'data' => json_encode($getcarowner), 'post_id' => $req->post_id, 'service_type' => $service_type[0]->service_type, 'service_option' => $service_type[0]->service_option, 'mileage' => $service_type[0]->current_mileage, 'discountpercent' => $this->discount];
                }
                else{
                    $resData = ['res' => 'Cannot prepare by this time', 'message' => 'error'];
                }
            }
        }
        else{

            // Insert Record
            $prepEst = PrepareEstimate::insert(['post_id' => $req->post_id, 'email' => $req->email, 'ref_code' => $req->ref_code]);
            if($prepEst ==  true){
                PrepareEstimate::where('post_id', $req->post_id)->update(['state' => '1']);
                // Get Post owner details
                $getcarowner = Carrecord::where('email', $req->email)->get();


                // Get service type
                $service_type = BookAppointment::where('ref_code', $req->post_id)->get();



                $resData = ['res' => 'Successfully', 'message' => 'success', 'data' => json_encode($getcarowner), 'post_id' => $req->post_id, 'service_type' => $service_type[0]->service_type, 'service_option' => $service_type[0]->service_option, 'mileage' => $service_type[0]->current_mileage, 'discountpercent' => $this->discount];
            }
            else{
                $resData = ['res' => 'Cannot prepare by this time', 'message' => 'error'];
            }
        }


        return $this->returnJSON($resData);
    }

    public function ajaxprepareestimatePay(Request $req){
        // Save Details

        // Check if post id exist
        $chekpostid = EstimatePay::where('post_id', $req->post_id)->get();

        if(count($chekpostid) > 0){
            $resData = ['res' => 'You already have an active transaction on this estimate. Kindly contact the Administrator', 'message' => 'info'];
        }
        else{
            $insestPay = EstimatePay::insert(['transactionid' => $req->transactionid, 'name' => $req->name, 'email' => $req->email, 'amount' => $req->amount, 'currency' => $req->currency, 'station' => $req->station, 'post_id' => $req->post_id, 'estimate_id' => $req->estimate_id, 'gateway' => 'Paystack']);

            if($insestPay == true){
                OpportunityPost::where('post_id', $req->post_id)->update(['state' => 2]);
                $resData = ['res' => 'Payment successfully made with transaction id: '.$req->transactionid.', your service center will contact you soon', 'message' => 'success'];
            }
            else{
                $resData = ['res' => 'Something went wrong, Kindly contact the Administrator', 'message' => 'error'];
            }
        }

        return $this->returnJSON($resData);
    }

    public function ajaxJobsdone(Request $req){

        $getEstimate = Estimate::where('opportunity_id', $req->post_id)->get();

        // dd($req->post_id);

            if($req->role == "mechanic"){
                if(count($getEstimate) > 0){
                // Update Record
                $updEstimate = Estimate::where('opportunity_id', $req->post_id)->update(['maintenance' => '2']);
                if($updEstimate == 1){
                    $resData = ['res' => 'Work done and closed', 'message' => 'success', 'link' => 'userDashboard', 'action' => 'mechanic'];
                }
                else{
                    $resData = ['res' => 'Something went wrong, Kindly contact the Administrator', 'message' => 'info'];
                }
            }
            else{
                $resData = ['res' => 'Record not available', 'message' => 'error'];
            }
        }
        elseif($req->role == "owners"){


            if($req->val == "accept"){
                // Update Record
                $updEstimate = Estimate::where('opportunity_id', $req->post_id)->update(['maintenance' => '4']);
                if($updEstimate == 1){
                    $resData = ['res' => 'Work done and satisfied. Please take a moment to review mechanic', 'message' => 'success', 'link' => $req->post_id, 'action' => 'owners'];
                }
                else{
                    $resData = ['res' => 'Something went wrong, Kindly contact the Administrator', 'message' => 'info'];
                }
            }
            elseif($req->val == "reject"){
                // Update Record
                $updEstimate = Estimate::where('opportunity_id', $req->post_id)->update(['maintenance' => '5']);
                if($updEstimate == 1){
                    $resData = ['res' => 'Work Done and but not satisfied. Please take a moment to review mechanic', 'message' => 'success', 'link' => $req->post_id, 'action' => 'owners'];
                }
                else{
                    $resData = ['res' => 'Something went wrong, Kindly contact the Administrator', 'message' => 'info'];
                }
            }
        }

        return $this->returnJSON($resData);
    }

    public function ajaxcheckIvim(Request $req){
        // Get licence
        $getLicences = OpportunityPost::where('post_id', $req->post_id)->get();

        if(count($getLicences) > 0){
            $userlicence = Carrecord::where('email', $getLicences[0]->email)->get();
            if(count($userlicence) > 0){
                $resData = ['res' => 'Fetching...', 'message' => 'success', 'data' => $userlicence[0]->vehicle_reg_no];
            }
            else{
                $resData = ['res' => 'No record found for this vehicle', 'message' => 'info'];
            }
        }
        else{
                $resData = ['res' => 'Post doesnt exist', 'message' => 'error'];
        }

        return $this->returnJSON($resData);
    }

    public function ajaxuserIvim(Request $req){
        // Get licence
        $getLicences = Carrecord::where('vehicle_reg_no', $req->licence)->get();

        if(count($getLicences) > 0){
            $resData = ['res' => 'Fetching...', 'message' => 'success', 'data' => $getLicences[0]->vehicle_reg_no];
        }
        else{
                $resData = ['res' => 'Record doesnt exist', 'message' => 'error'];
        }

        return $this->returnJSON($resData);
    }

    public function ajaxactionOpport(Request $req){
        // Check
        $getrecord = OpportunityPost::where('post_id', $req->post_id)->get();
        if(count($getrecord) > 0){
            if($req->val == "edit"){

                $resData = ['res' => 'Fetching...', 'message' => 'success', 'data' => json_encode($getrecord), 'action' => 'edit'];
            }
            elseif($req->val == "delete"){
                OpportunityPost::where('post_id', $req->post_id)->delete();
                $resData = ['res' => 'Successfully deleted', 'message' => 'success', 'link' => 'userDashboard', 'action' => 'delete'];
            }
        }
        else{
            $resData = ['res' => 'Record not found', 'message' => 'info'];
        }

        return $this->returnJSON($resData);
    }

    public function ajaxgetLicence(Request $req){
        // Check
        $getrecord = Carrecord::where('vehicle_reg_no', $req->licence)->get();

        // dd($getMileage[0]->mileage);
        if(count($getrecord) > 0){
            $getMileage = Vehicleinfo::where('vehicle_licence', $req->licence)->orderBy('created_at', 'DESC')->get('mileage');
            if(count($getMileage) > 0){
                $resData = ['res' => 'Fetching...', 'message' => 'success', 'data' => json_encode($getrecord), 'mileage' => $getMileage[0]->mileage];
            }
            else{
                $resData = ['res' => 'Fetching...', 'message' => 'success', 'data' => json_encode($getrecord), 'mileage' => $getrecord[0]->current_mileage];
            }
        }
        else{
            $resData = ['res' => 'Record not found', 'message' => 'info'];
        }

        return $this->returnJSON($resData);
    }


    public function CloseAppoint(Request $req){
        // Check if Appointment code already present
        $checkfeedback = AppointmentFeedback::where('ref_code', $req->ref_code)->get();

        if(count($checkfeedback) > 0){
            $resData = ['res' => 'This file had already been closed.', 'message' => 'info'];
        }
        else{
            // Else Insert
            $indfeedback = AppointmentFeedback::insert(['ref_code' => $req->ref_code, 'visitation_info' => $req->visitation_info, 'receive_discount' => $req->receive_discount, 'quality_of_service' => $req->quality_of_service]);

            if($indfeedback == true){
                // Remove from BookAppointment
                BookAppointment::where('ref_code', $req->ref_code)->update(['state' => 1]);

                $resData = ['res' => 'Appointment successfully closed', 'message' => 'success', 'link' => 'userDashboard'];
            }
            else{
                $resData = ['res' => 'Something went wrong', 'message' => 'info'];
            }
        }

       return $this->returnJSON($resData);
    }


    public function AccCloseAppoint(Request $req){
        // Check if Appointment code already present
        $checkfeedback = AccAppointmentFeedback::where('ref_code', $req->ref_code)->get();

        if(count($checkfeedback) > 0){
            $resData = ['res' => 'This file had already been closed.', 'message' => 'info'];
        }
        else{
            // Else Insert
            $indfeedback = AccAppointmentFeedback::insert(['ref_code' => $req->ref_code, 'visitation_info' => $req->visitation_info, 'granted_discount' => $req->granted_discount]);

            if($indfeedback == true){
                // Remove from BookAppointment
                BookAppointment::where('ref_code', $req->ref_code)->update(['accstate' => 2]);

                $resData = ['res' => 'Appointment successfully closed', 'message' => 'success', 'link' => 'userDashboard'];
            }
            else{
                $resData = ['res' => 'Something went wrong', 'message' => 'info'];
            }
        }

       return $this->returnJSON($resData);
    }


    public function ajaxReviewmechanic(Request $req){


        // Insert Comment
        $userComment = Review::insert(['ref_code' => $req->ref_code, 'post_id' => $req->post_id, 'technician' => $req->technician, 'station_name' => $req->station_name, 'rating' => $req->rating, 'comment' => $req->comment]);

        if($userComment == true){
            $resData = ['res' => 'We appreciate your review', 'message' => 'success', 'link' => 'userDashboard'];
        }
        else{
            $resData = ['res' => 'Something went wrong!', 'message' => 'info'];
        }

        return $this->returnJSON($resData);
    }


    // Weekly point notification
    public function myweeklyPoints(Request $req){

        // Get all users whose car record is absent
        $userinf = Points::orderBy('created_at', 'DESC')->get();

        if(count($userinf) > 0){
            foreach ($userinf as $key) {
                $this->to = $key['email'];
                // $this->to = 'info@vimfile.com';
                $this->name = $key['name'];
                $this->point = $key['weekly_point'];

                $this->sendEmail($this->to, 'My weekly point achievement on Vimfile');

            }

            echo "Done";
        }
        else{
            // Do nothing
            echo 0;
        }

    }

    // Global point notification
    public function myglobalPoints(Request $req){

        // Get all users whose car record is absent
        $userinf = Points::orderBy('created_at', 'DESC')->get();

        if(count($userinf) > 0){
            foreach ($userinf as $key) {
                $this->to = $key['email'];
                // $this->to = 'info@vimfile.com';
                $this->name = $key['name'];
                $this->point = $key['global_point'];

                $this->sendEmail($this->to, 'My global point achievement on Vimfile');

            }

            echo "Done";
        }
        else{
            // Do nothing
            echo 0;
        }

    }

    public function subscribeNews(Request $req){
        // Check Newsletter
        $getData = Newsletter::where('email', $req->email)->get();
        if(count($getData) > 0){

            $resData = ['res' => 'You already sbuscribed with this email', 'message' => 'warning'];
        }
        else{
            // Insert
            $ins= Newsletter::insert(['email' => $req->email, 'state' => 1]);
            if($ins == true){
                $resData = ['res' => 'You will now receive the latest news and happenings on vimfile', 'message' => 'success'];
            }
            else{
                $resData = ['res' => 'Something went wrong!', 'message' => 'error'];
            }

        }



        return $this->returnJSON($resData);
    }


    public function checkNotifications(Request $req){
        $checkNotification = Notification::where('ref_code', $req->ref_code)->where('state', 0)->orderBy('created_at', 'DESC')->get();

        if(count($checkNotification) > 0){
            // Pop Up
            $resData = ['res' => $checkNotification[0]->about, 'message' => 'Success'];

            // Update rec
            Notification::where('ref_code', $req->ref_code)->where('state', 0)->update(['state' => 1]);
        }
        else{
            // Pop Up
            $resData = ['res' => 'No new notification', 'message' => 'Info'];
        }


        return $this->returnJSON($resData);
    }

    public function checkFeedbacks(Request $req){
        $checkFeedback = Feedback::where('ref_code', $req->ref_code)->where('state', 0)->get();

        if(count($checkFeedback) > 0 || count($checkFeedback) == 0){
            // Pop Up
            $resData = ['res' => 'Fetching', 'message' => 'Success'];
        }
        else{
            // Pop Up
            $resData = ['res' => 'Already taken feedback', 'message' => 'Info'];
        }


        return $this->returnJSON($resData);
    }

    public function updateFeedbacks(Request $req){
        $updtFeedback = Feedback::where('ref_code', $req->ref_code)->update(['state' => 0]);

        if($updtFeedback == 1){
            // Pop Up
            $resData = ['res' => 'Updated', 'message' => 'Success'];
        }
        else{
            // Pop Up
            $resData = ['res' => 'No feedback record', 'message' => 'Success'];
        }


        return $this->returnJSON($resData);
    }


    public function ajaxcheckappointment(Request $req, BookAppointment $booking){
        // Get Appointment
        $getAppointment = $booking->where('ref_code', $req->ref_code)->where('email', $req->email)->get();

        if(count($getAppointment) > 0){
            $resData = ['res' => 'fetching', 'message' => 'success', 'data' => json_encode($getAppointment), 'action' => 'appointment'];
        }
        else{
            $resData = ['res' => 'No record found', 'message' => 'error', 'title' => 'Oops'];
        }

        return $this->returnJSON($resData);
    }


    public function phoneappointment(Request $req, PhoneAppointment $phonebooking, BookAppointment $booking){

        // Insert
        $phonebooking->busID = Auth::user()->busID;
        $phonebooking->ref_code = $req->ref_code;
        $phonebooking->station_name = Auth::user()->station_name;
        $phonebooking->name = $req->name;
        $phonebooking->email = $req->email;
        $phonebooking->subject = $req->subject;
        $phonebooking->message = $req->my_message;
        $phonebooking->date_of_visit = $req->date_of_visit;
        $phonebooking->service_option = $req->service_option;
        $phonebooking->service_type = $req->my_service_type;
        $phonebooking->current_mileage = $req->current_mileage;

        $phonebooking->save();



        $booking->busID = Auth::user()->busID;
        $booking->ref_code = $req->ref_code;
        $booking->station_name = Auth::user()->station_name;
        $booking->name = $req->name;
        $booking->email = $req->email;
        $booking->subject = $req->subject;
        $booking->message = $req->my_message;
        $booking->date_of_visit = $req->date_of_visit;
        $booking->service_option = $req->service_option;
        $booking->service_type = $req->my_service_type;
        $booking->current_mileage = $req->current_mileage;

        $booking->save();

        // Send Mail
        $this->to = $req->email;
        // $this->to = "bambo@vimfile.com";
        $this->name = $req->name;
        $this->subject = "VIMFILE - PHONE APPOINTMENT";
        $this->message = $req->my_message;
        $this->file = NULL;

        $this->sendEmail($this->to, "Compose Mail");

        return redirect()->back()->with('success', 'Sent successfully');
    }



    public function phoneappointmentDetails(){
        $getAppoint = PhoneAppointment::where('station_name', Auth::user()->station_name)->get();

        return $getAppoint;
    }



    // public function updtCalc(Request $req){
    //     // get Highest


    //     $getUserstate = Points::orderBy('weekly_point', 'DESC')->groupBy('state')->get();
    //     $getUserspoint = Points::orderBy('weekly_point', 'DESC')->get();

    //     $i = 0;
    //     foreach($getUserstate as $userinfSt){
    //         // Update Points
    //         $getWeekpoint = $userinfSt['weekly_point'] + 50;
    //         $allpointacq = $userinfSt['alltime_point'] + $getWeekpoint;

    //      $updtPoint = Points::where('email', $userinfSt['email'])->update(['alltime_point' => $allpointacq, 'global_point' => $allpointacq]);

    //         if($updtPoint == true){

    //     foreach($getUserspoint as $key){
    //         $email = $key['email'];
    //         $indWeek = $key['weekly_point'];
    //         $alltWeek = $key['alltime_point'] + $indWeek;

    //         Points::where('email', $email)->update(['weekly_point' => 0, 'alltime_point' => $alltWeek, 'global_point' => $alltWeek]);
    //     }

    //             echo "Done!";
    //         }
    //         else{
    //            return 0;
    //         }


    //     }

    // }



/**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();

        // $user->token;
        // OAuth Two Providers
        $token = $user->token;
        $refreshToken = $user->refreshToken; // not always provided
        $expiresIn = $user->expiresIn;

        // OAuth One Providers
        $token = $user->token;
        $tokenSecret = $user->tokenSecret;


        // All Providers
        // $user->getId();
        // $user->getNickname();
        // $user->getName();
        // $user->getEmail();
        // $user->getAvatar();
    }


    


    public function returnJSON($data){
        return response()->json($data);
    }



    public function zohoCampaign($authToken, $xmldata){

        $curl_url = "https://campaigns.zoho.com/api/sendcampaign";
        $curl_post_field = "scope=CampaignsAPI&resfmt=".$xmldata."&version=1&authtoken=".$authToken."&campaignkey=inprogress";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curl_url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_field);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;

       // $result = $this->curl($curl_url, $curl_post_field);


    }

    public function preg_match($regex, $string, $match){
        // dd($match);
    }

    // Fetch Records for Commercial Added Fields
    public function moreRecords($email, $service_type){

        $recs = vehicleInfo::where('email', $email)->where('service_type', 'LIKE', '%'.$service_type.'%')->orderBy('created_at', 'DESC')->take(1)->get();

        return $recs;
    }

    // Notification Log
    public function notifications($ref_code, $about, $image_url){
        DB::table('notification')->insert(['ref_code' => $ref_code, 'about' => $about, 'image_url' => $image_url]);
    }


    // Achievement Log
    public function achievement($name, $email, $week, $global){
        DB::table('achievement')->updateOrCreate(['name' => $name, 'email' => $email, 'weekly_rank' => $week, 'global_rank' => $global]);
    }

    // OneSignal Activity Log
    public function onesignal($heading, $content, $category){
        DB::table('onesignal')->insert(['heading' => $heading, 'content' => $content, 'category' => $category]);
    }

    // Vehicle Log
    public function vehicleLogs($service_type, $post_id, $name){
        DB::table('vehiclelogs')->insert(['service_type' => $service_type, 'post_id' => $post_id, 'name' => $name]);
    }

    public function claimdata(){


        // Get all ACC we have their data
            $getbusiness = DB::table('business')->select('name_of_company as company', 'address', 'state as location', 'telephone', 'city as city', 'search_count')->distinct()->where('claims', 1)->where('state', 'LIKE', '%'.$this->arr_ip['city'].'%')->orWhere('city', 'LIKE', '%'.$this->arr_ip['city'].'%')->orderBy('created_at', 'DESC')->get();

            $crawled = DB::table('suggestedmechanics')->select('station_name as company', 'address', 'location', 'telephone', 'search_count')->distinct()->where('location', 'LIKE', '%'.$this->arr_ip['city'].'%')->orderBy('created_at', 'DESC')->get();


        // if(env('APP_ENV') == 'local'){

        //     $getbusiness = DB::table('business')->select('name_of_company as company', 'address', 'state as location', 'telephone', 'city as city', 'search_count')->distinct()->where('claims', 0)->where('state', 'LIKE', '%lagos%')->orWhere('city', 'LIKE', '%lagos%')->orderBy('created_at', 'DESC')->get();

        //     $crawled = DB::table('suggestedmechanics')->select('station_name as company', 'address', 'location', 'telephone', 'search_count')->distinct()->where('location', 'LIKE', '%lagos%')->orderBy('created_at', 'DESC')->get();
        // }
        // else{
        //     // Get all ACC we have their data
        //     $getbusiness = DB::table('business')->select('name_of_company as company', 'address', 'state as location', 'telephone', 'city as city', 'search_count')->distinct()->where('claims', 0)->where('state', 'LIKE', '%'.$this->arr_ip['city'].'%')->orWhere('city', 'LIKE', '%'.$this->arr_ip['city'].'%')->orderBy('created_at', 'DESC')->get();

        //     $crawled = DB::table('suggestedmechanics')->select('station_name as company', 'address', 'location', 'telephone', 'search_count')->distinct()->where('location', 'LIKE', '%'.$this->arr_ip['city'].'%')->orderBy('created_at', 'DESC')->get();
        // }


        $data = array_merge($crawled->toArray(), $getbusiness->toArray());


        return $data;
    }




     public function oauth(Request $req){

                if(Auth::user()){
            // Get Client Info
        
        $busInfo = $this->clientinfo();


        


            // Check for Asked questions
            $this->countQuest = AskExpert::where('state', 1)->count();

            $getQuest = AskExpert::all();

            if(count($getQuest) > 0){
                $this->askedQuest = $getQuest;
            }
            else{
                $this->askedQuest = "";
            }
        }
        $this->activities($this->arr_ip['ip'], $this->arr_ip['country'], $this->arr_ip['city'], $this->arr_ip['currency'], 'Import Google Contacts');



        return view('pages.googlecontact')->with(['pages' => 'Google Contacts', 'section' => 'Contacts', 'data' =>  session('data'), 'location' => $this->arr_ip, 'busInfo' => $busInfo, 'ref_code' => $this->ref_code, 'getRefs' => $this->getRefs, 'countQuest' => $this->countQuest, 'askedQuest' => $this->askedQuest]);
    }
    public function googlecontact(Request $req){

        if(1<0){
            return view('pages.oauthfail')->with('title', 'Google Signin Error')->with('error', $req->get('error'))->with('section', 'Signin');
        }
        else{
        // return $req->all();
        $currentUrl = $_SERVER['REQUEST_URI'];
        $currentUrl = explode('?', $currentUrl);
        $client_id='779231570694-3se2nma170k0rer6r82d2ogtudi5q32g.apps.googleusercontent.com';
        $client_secret='o7Wb9REruvipRliJr3I7H1xF';
        $redirect_uri='https://vimfile.com/google/oauth';
        $max_results = "1000";
        if(isset($_GET["code"]))
        {
            $auth_code = $_GET["code"];
            $fields=array(
                'code'=>  urlencode($auth_code),
                'client_id'=>  urlencode($client_id),
                'client_secret'=>  urlencode($client_secret),
                'redirect_uri'=>  urlencode($redirect_uri),
                'grant_type'=>  urlencode('authorization_code'),
                'scheme'=>  urlencode('authorization_code')
            );
            $post = '';
            foreach($fields as $key=>$value)
            {
                $post .= $key.'='.$value.'&';
            }
            $post = rtrim($post,'&');
            $result = $this->curl('https://accounts.google.com/o/oauth2/token',$post);
            $response = json_decode($result);

            $accesstoken = $response->access_token;
            $url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='.$max_results.'&alt=json&v=3.0&oauth_token='.$accesstoken;
            $xmlresponse =  $this->curl($url);
            $temp = json_decode($xmlresponse,true);
            // dd($temp['feed']['title']['$t']);
            return redirect()->route('main.app.oauth')->with('data', $temp['feed'])->with('title', 'Google Contacts')->with('section', 'Contacts');
            }
        }
    }


    public function curl($url,$post=""){
        $curl = curl_init();
        $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
        curl_setopt($curl,CURLOPT_URL,$url);    //The URL to fetch. This can also be set when initializing a session with curl_init().
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE); //TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
        curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5);    //The number of seconds to wait while trying to connect.
        if($post!="")
        {
            curl_setopt($curl,CURLOPT_POST,5);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
        }
        curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);  //The contents of the "User-Agent: " header to be used in a HTTP request.
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);   //To follow any "Location: " header that the server sends as part of the HTTP header.
        curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);  //To automatically set the Referer: field in requests where it follows a Location: redirect.
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);    //The maximum number of seconds to allow cURL functions to execute.
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);  //To stop cURL from verifying the peer's certificate.
        $contents = curl_exec($curl);
        curl_close($curl);
        return $contents;
    }





// Data Migrate
    // public function migrate(){

    // }

}
