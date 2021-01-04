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

use App\PrepareEstimate as PrepareEstimate;

use App\EstimatePay as EstimatePay;

use App\OpportunityPost as OpportunityPost;

use App\InstorePayment as InstorePayment;

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

use Illuminate\Support\Facades\Redirect;

class PaypalController extends Controller
{
    public $price;
    public $plan;
    public $duration;
    public $payto;
    public $postid;
    public $estimate_id;
    public $name;
    public $transactionid;
    public $currency;

    public $url;

    public $userType;

    public function store(Request $req){


        $vars = array(
            'cmd' => $req->cmd,
            'hosted_button_id' => $req->hosted_button_id,
            'currency_code' => $req->currency_code,
            'on0' => $req->on0,
            'os0' => $req->os0
        );


        if($req->os0 == "BusyWrench-Monthly"){
            $this->price = "10";
            $this->plan = "Basic";
            $this->duration = "monthly";
            $this->url = "https://www.paypal.com/cgi-bin/webscr?". http_build_query($vars);
        }
        if($req->os0 == "BusyWrench-Annually"){
            $this->price = "100";
            $this->plan = "Basic";
            $this->duration = "yearly";
            $this->url = "https://www.paypal.com/cgi-bin/webscr?". http_build_query($vars);
        }

        if($req->os0 == "Personal-Free"){
            $this->price = "0";
            $this->plan = "Free";
            $this->duration = "yearly";
            $this->url = "userDashboard";
        }
        if($req->os0 == "Business-StartUp"){
            $this->price = "0";
            $this->plan = "Start-Up";
            $this->duration = "yearly";
            $this->url = "Admin";
        }
        if($req->os0 == "Personal-Lite (M)"){
            $this->price = "5";
            $this->plan = "Lite";
            $this->duration = "monthly";
            $this->url = "https://www.paypal.com/cgi-bin/webscr?". http_build_query($vars);
        }
        if($req->os0 == "Personal-Lite (A)"){
            $this->price = "50";
            $this->plan = "Lite";
            $this->duration = "yearly";
            $this->url = "https://www.paypal.com/cgi-bin/webscr?". http_build_query($vars);
        }
        if($req->os0 == "Personal-Lite (Commercial) (M)"){
            $this->price = "10";
            $this->plan = "Commercial";
            $this->duration = "monthly";
            $this->url = "https://www.paypal.com/cgi-bin/webscr?". http_build_query($vars);
        }
        if($req->os0 == "Personal-Lite (Commercial) (A)"){
            $this->price = "100";
            $this->plan = "Commercial";
            $this->duration = "yearly";
            $this->url = "https://www.paypal.com/cgi-bin/webscr?". http_build_query($vars);
        }
        if($req->os0 == "Basic  Plan (M)"){
            $this->price = "10";
            $this->plan = "Basic";
            $this->duration = "monthly";
            $this->url = "https://www.paypal.com/cgi-bin/webscr?". http_build_query($vars);
        }
        if($req->os0 == "Basic Plan  (A)"){
            $this->price = "100";
            $this->plan = "Basic";
            $this->duration = "yearly";
            $this->url = "https://www.paypal.com/cgi-bin/webscr?". http_build_query($vars);
        }
        
        if($req->os0 == "Classic Plan  (M)"){
            $this->price = "20";
            $this->plan = "Classic";
            $this->duration = "monthly";
            $this->url = "https://www.paypal.com/cgi-bin/webscr?". http_build_query($vars);
        }
        if($req->os0 == "Classic Plan  (A)"){
            $this->price = "200";
            $this->plan = "Classic";
            $this->duration = "yearly";
            $this->url = "https://www.paypal.com/cgi-bin/webscr?". http_build_query($vars);
        }
        if($req->os0 == "Super Plan (M)"){
            $this->price = "36";
            $this->plan = "Super";
            $this->duration = "monthly";
            $this->url = "https://www.paypal.com/cgi-bin/webscr?". http_build_query($vars);
        }
        if($req->os0 == "Super Plan (A)"){
            $this->price = "360";
            $this->plan = "Super";
            $this->duration = "yearly";
            $this->url = "https://www.paypal.com/cgi-bin/webscr?". http_build_query($vars);
        }
        if($req->os0 == "Gold Plan (M)"){
            $this->price = "60";
            $this->plan = "Gold";
            $this->url = "https://www.paypal.com/cgi-bin/webscr?". http_build_query($vars);
        }
        if($req->os0 == "Gold Plan (A)"){
            $this->price = "600";
            $this->plan = "Gold";
            $this->url = "https://www.paypal.com/cgi-bin/webscr?". http_build_query($vars);
        }

        if($req->os0 == "Payment for Estimate"){
            $this->price = $req->price;
            $this->payto = $req->payto;
            $this->postid = $req->postid;
            $this->estimate_id = $req->estimate_id;
            $this->name = $req->name;
            $this->currency = $req->currency;
            $this->transactionid = $req->transactionid;
            $this->url = "https://www.paypal.com/cgi-bin/webscr?". http_build_query($vars);
        }

        if(Auth::check() == true){
            $this->userType = Auth::user()->userType;
        }
        else{
            $this->userType = session('accountType');
        }

        if($req->os0 == "Basic  Plan (M)"){
            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '',  'lite' => '', 'litecommercial' => '', 'basic'=> $this->price, 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $this->userType, 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayUpt == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }

                
            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => '', 'basic'=> $this->price, 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $this->userType, 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayIns == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }
            }
        }
        
        
        elseif($req->os0 == "BusyWrench-Monthly"){
            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '',  'lite' => '', 'litecommercial' => '', 'basic'=> $this->price, 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $this->userType, 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayUpt == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }

                
            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => '', 'basic'=> $this->price, 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $this->userType, 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayIns == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }
            }
        }

        elseif($req->os0 == "Basic Plan  (A)"){
            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '',  'lite' => '', 'litecommercial' => '', 'basic'=> $this->price, 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $this->userType, 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayUpt == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }

                
            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => '', 'basic'=> $this->price, 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $this->userType, 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayIns == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }
            }
        }
        
        
        
        elseif($req->os0 == "BusyWrench-Annually"){
            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '',  'lite' => '', 'litecommercial' => '', 'basic'=> $this->price, 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $this->userType, 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayUpt == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }

                
            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => '', 'basic'=> $this->price, 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $this->userType, 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayIns == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }
            }
        }

        elseif($req->os0 == "Classic Plan  (M)"){

            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => '', 'basic'=> '', 'classic' => $this->price, 'super' => '', 'gold' => '', 'userType' => $this->userType, 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayUpt == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }

                
            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => '', 'basic'=> '', 'classic' => $this->price, 'super' => '', 'gold' => '', 'userType' => $this->userType, 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayIns == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }
            }
            
        }

        elseif($req->os0 == "Classic Plan  (A)"){

            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => '', 'basic'=> '', 'classic' => $this->price, 'super' => '', 'gold' => '', 'userType' => $this->userType, 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayUpt == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }

                
            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => '', 'basic'=> '', 'classic' => $this->price, 'super' => '', 'gold' => '', 'userType' => $this->userType, 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayIns == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }
            }
            
        }

        elseif($req->os0 == "Super Plan (M)"){

            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => '', 'basic'=> '', 'classic' => '', 'super' => $this->price, 'gold' => '', 'userType' => $this->userType, 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayUpt == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }

                
            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => '', 'basic'=> '', 'classic' => '', 'super' => $this->price, 'gold' => '', 'userType' => $this->userType, 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayIns == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }
            }
            
        }

        elseif($req->os0 == "Super Plan (A)"){

            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => '', 'basic'=> '', 'classic' => '', 'super' => $this->price, 'gold' => '', 'userType' => $this->userType, 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayUpt == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }

                
            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => '', 'basic'=> '', 'classic' => '', 'super' => $this->price, 'gold' => '', 'userType' => $this->userType, 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayIns == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }
            }
            
        }

        elseif($req->os0 == "Gold Plan (M)"){
            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => $this->price, 'userType' => $this->userType, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayUpt == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }

                
            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => $this->price, 'userType' => $this->userType, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayIns == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }
            }
        }
        elseif($req->os0 == "Gold Plan (A)"){
            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => $this->price, 'userType' => $this->userType, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayUpt == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }

                
            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => $this->price, 'userType' => $this->userType, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayIns == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }
            }
        }

        elseif($req->os0 == "Personal-Lite (M)"){
            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => $this->price, 'litecommercial' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => 'Individual', 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayUpt == true){
                    User::where('email', $req->email)->update(['userType' => 'Individual', 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }

                
            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => $this->price, 'litecommercial' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => 'Individual', 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayIns == true){
                    User::where('email', $req->email)->update(['userType' => 'Individual', 'plan' => $this->plan]);

                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }
            }
        }

        elseif($req->os0 == "Personal-Lite (A)"){
            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => $this->price, 'litecommercial' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => 'Individual', 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayUpt == true){
                    User::where('email', $req->email)->update(['userType' => 'Individual', 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }

                
            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => $this->price, 'litecommercial' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => 'Individual', 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayIns == true){
                    User::where('email', $req->email)->update(['userType' => 'Individual', 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }
            }
        }

        
        elseif($req->os0 == "Personal-Lite (Commercial) (M)"){
            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => $this->price, 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => 'Commercial', 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayUpt == true){
                    User::where('email', $req->email)->update(['userType' => 'Commercial', 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }

                
            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => $this->price, 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => 'Commercial', 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayIns == true){
                    User::where('email', $req->email)->update(['userType' => 'Commercial', 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }
            }
        }

        elseif($req->os0 == "Personal-Lite (Commercial) (A)"){
            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => $this->price, 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => 'Commercial', 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayUpt == true){
                    User::where('email', $req->email)->update(['userType' => 'Commercial', 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }

                
            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => '', 'lite' => '', 'litecommercial' => $this->price, 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => 'Commercial', 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayIns == true){
                    User::where('email', $req->email)->update(['userType' => 'Commercial', 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }
            }
        } 

        elseif($req->os0 == "Personal-Free"){
            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => $this->price, 'lite' => '', 'litecommercial' => '', 'startup' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => 'Individual', 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayUpt == true){
                    User::where('email', $req->email)->update(['userType' => 'Individual', 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }

                
            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => $this->price, 'lite' => '', 'litecommercial' => '', 'startup' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => 'Individual', 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayIns == true){
                    User::where('email', $req->email)->update(['userType' => 'Individual', 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                    // Redirect to Paypal Gateway
                    return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }
            }
        }


        // DO Some Logics here to migerate user info from Individual to Business, Generate Username and Password from User info for login.... Delete user personal account.

        elseif($req->os0 == "Business-StartUp"){
            // Get User if exist
            $checkUser = PayPlan::where('email', $req->email)->get();

            if(count($checkUser) > 0){
                // Update User Payment Plan
                $douserpayUpt = PayPlan::where('email', $req->email)->update(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'startup' => $this->price, 'lite' => '', 'litecommercial' => '', 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $this->userType, 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayUpt == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                     // Redirect to Paypal Gateway
                     return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }

                
            }
            else{
                // insert
                $douserpayIns = PayPlan::insert(['email' => $req->email, 'transaction_id' => mt_rand().''.time(), 'plan' => $this->plan, 'free' => '', 'lite' => '', 'litecommercial' => '', 'startup' => $this->price, 'basic'=> '', 'classic' => '', 'super' => '', 'gold' => '', 'userType' => $this->userType, 'subscription_plan' => $this->duration, 'date_from' => date('Y-m-d'), 'currency' => $req->currency_code ]);

                if($douserpayIns == true){
                    User::where('email', $req->email)->update(['userType' => $this->userType, 'plan' => $this->plan]);
                    $getTrans = PayPlan::where('email', $req->email)->get();

                     // Redirect to Paypal Gateway
                     return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong. Please check payment form and try again');
                }
            }
        }

        elseif($req->os0 == "Payment for Estimate"){
            // Check if post id exist
            $chekpostid = EstimatePay::where('post_id', $req->post_id)->get();

            if(count($chekpostid) > 0){
                // Return to PayPal Form
                    return redirect()->back()->with('error', 'You already have an active transaction on this estimate. Kindly contact the Administrator');
            }
            else{
                $insestPay = EstimatePay::insert(['transactionid' => $req->transactionid, 'name' => $req->name, 'email' => $req->email, 'amount' => $req->price, 'currency' => $req->currency, 'station' => $req->payto, 'post_id' => $req->postid, 'estimate_id' => $req->estimate_id]);
            
                if($insestPay == true){
                    // Redirect to Paypal Gateway
                     return Redirect::to($this->url);
                }
                else{
                    // Return to PayPal Form
                    return redirect()->back()->with('error', 'Something went wrong, Kindly contact the Administrator');
                }
            }
        }
        // dd($req->all());
    }


    public function completeTransaction(Request $req){
        // dd($req->all());
        // Check if record already exist
    $getPay = EstimatePay::where('estimate_id', $req->estimate_id)->get();
    if(count($getPay) > 0){
        // Payment already made for this estimate
        $resData = ['res' => 'You have already made payment for this transaction, contact Admin', 'message' => 'info'];
    }
    else{
        // Insert Record to DB...
        $insPay = EstimatePay::insert(['transactionid' => $req->orderID, 'name' => $req->name, 'email' => $req->email, 'amount' => $req->amount, 'station' => $req->station, 'post_id' => $req->post_id, 'estimate_id' => $req->estimate_id, 'gateway' => 'Paypal']);
        if($insPay == true){
            // Update OpportunityPost
            OpportunityPost::where('post_id', $req->post_id)->update(['state' => 2]);

            $amount = $req->amount;
            $this->to = $req->email;
            $this->name = Auth::user()->name;
            $this->subject = "Payment of ".$amount." successfull";
            $this->message = "We have recevied your payment of ".$amount.". <br><br> Thank you.";
            $this->file = NULL;

            $this->sendEmail($this->to, "Compose Mail");


            $resData = ['res' => 'Payment Approved', 'message' => 'success', 'link' => 'userDashboard'];
        }
        else{
            $resData = ['res' => 'Information not documented, contact Admin', 'message' => 'info'];
        }
    }

        return $this->returnJSON($resData); 

    }    


    public function instoreTransaction(Request $req){
        // dd($req->all());
        // Check if record already exist
    $getPay = InstorePayment::where('estimate_id', $req->estimate_id)->get();

    if(count($getPay) > 0){
        // Payment already made for this estimate
        $resData = ['res' => 'You have already made payment for this transaction', 'message' => 'info'];
    }
    else{
        // Insert Record to DB...
        $insPay = InstorePayment::insert(['transactionid' => $req->orderID, 'estimate_id' => $req->estimate_id, 'name' => $req->name, 'email' => $req->email, 'amount' => $req->amount, 'station' => $req->station, 'technician' => $req->technician, 'purpose' => $req->purpose, 'gateway' => 'Paypal']);
        if($insPay == true){

            $amount = $req->amount;
            $this->to = $req->email;
            $this->name = Auth::user()->name;
            $this->subject = "Payment of ".$amount." successfull";
            $this->message = "We have recevied your payment of ".$amount.". <br><br> Thank you.";
            $this->file = NULL;

            $this->sendEmail($this->to, "Compose Mail");

            $resData = ['res' => 'Payment Made', 'message' => 'success', 'link' => 'userDashboard'];
        }
        else{
            $resData = ['res' => 'Information not documented, contact Admin', 'message' => 'info'];
        }
    }

        return $this->returnJSON($resData); 

    }

    public function returnJSON($data){
        return response()->json($data);
    }

}
