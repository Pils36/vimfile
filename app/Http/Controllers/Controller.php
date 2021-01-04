<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use App\Mail\sendEmail;



use App\Message as Message;
use App\User as User;
use App\Admin as Admin;
use App\Notification as Notification;
use App\Business as Business;
use App\SuggestedDealers as SuggestedDealers;
use App\SuggestedMechanics as SuggestedMechanics;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $name = ""; public $to = "info@vimfile.com"; public $email = ""; public $subject = ""; public $message = ""; public $password = "";
    public $sender = ""; public $mechanic = ""; public $city = ""; public $state = ""; public $zipcode = ""; public $station_name = "";
    public $station_address = ""; public $heading = ""; public $file; public $data; public $description;
	public $getPayment; public $getIp; public $getLocation; public $arr_ip; public $country;
    public $service_offer; public $discount; public $continent; public $transID; public $payment_status;


    public $myName; public $getName; public $otherUsers; public $ticketing; public $getAD; public $RegClient;
	public $unregisteredClients; public $refree; public $refreePoint; public $error = ""; public $difference = "";

    public $from;
    public $material_cost;
    public $labour_cost;
    public $other_cost;
    public $total_cost;
    public $Page;
    public $vendor;


    public $curr_mileage;
    public $company;
    public $report;
    public $department;
    public $relatedService;
    public $document;
    public $userType;
    public $redeempoint;
    public $location;
    public $point;

    public $make;
    public $model;
    public $date;
    public $service_type;
    public $service_option;
    public $service_item_spec;
    public $manufacturer;
    public $material_qty;
    public $labour_qty;
    public $material_qty2;
    public $material_qty3;
    public $material_qty4;
    public $material_qty5;
    public $material_qty6;
    public $material_qty7;
    public $material_qty8;
    public $material_qty9;
    public $material_qty10;
    public $labour_qty2;
    public $labour_qty3;
    public $labour_qty4;
    public $labour_qty5;
    public $labour_qty6;
    public $labour_qty7;
    public $labour_qty8;
    public $labour_qty9;
    public $labour_qty10;
    public $material_cost2;
    public $material_cost3;
    public $material_cost4;
    public $material_cost5;
    public $material_cost6;
    public $material_cost7;
    public $material_cost8;
    public $material_cost9;
    public $material_cost10;
    public $labour_cost2;
    public $labour_cost3;
    public $labour_cost4;
    public $labour_cost5;
    public $labour_cost6;
    public $labour_cost7;
    public $labour_cost8;
    public $labour_cost9;
    public $labour_cost10;
    public $manufacturer2;
    public $manufacturer3;
    public $service_item_spec2;
    public $service_item_spec3;
    public $other_qty;
    public $service_note;
    public $mileage;
    public $mileage1;
    public $mileage2;
    public $mileage3;
    public $mileage4;
    public $mileage5;
    public $current_mileage;


    public $busInfo;
    public $regex;
    public $string;
    public $match;

    public $company_name;

    public $oilChange;
    public $oilChangedate;
    public $tyredate;
    public $airdate;
    public $inspectiondate;
    public $registrationdate;
    public $tyreRotation;
    public $airFilter;
    public $inspection;
    public $registration;
    public $totMiles;
    public $avgMiles;
    public $totMaint;
    public $avgMaint;
    public $licence;
    public $post;
    public $getEarn;
    public $ITC;
    public $addedRec;
    public $new_rec;
    public $earnStart;
    public $earnEnd;
    public $totTaxing;

    public $content1;
    public $content2;
    public $content3;
    public $content4;
    public $content5;

    // Payment Plans
    public $free;
    public $startup;
    public $lite;
    public $liteCommercial;
    public $basic;
    public $classic;
    public $super;



    public $regExp;
    public $repairExpence;

    public $totEarnings;
    public $resFuel;
    public $resIns;
    public $resReg;
    public $resRepair;
    public $resWash;
    public $resRsa;
    public $fuelITC;
    public $insITC;
    public $regITC;
    public $repITC;
    public $washITC;
    public $rsaITC;
    public $totalPro;
    public $totalITC;
    public $bizProfit;
    public $taxProfit;
    public $notify = "0";


    // Service Types - Admin
    public $inspect;
    public $regs;
    public $roadasstExpence;
    public $busTax;
    public $insuranceExp;
    public $inspITC;
    public $resInsp;
    public $resRegs;
    public $regsITC;

    // Service Types - Fuel
    public $washExpence;
    public $fuelExp;

    // Service Types - Maintenance
    public $resairFilter;
    public $airFilters;
    public $airfilterITC;
    public $batterys;
    public $resBattery;
    public $batteryITC;
    public $brakefluids;
    public $resBrakefluid;
    public $brakefluidITC;
    public $brakepads;
    public $resBrakepad;
    public $brakepadITC;
    public $brakerotors;
    public $resBrakerotor;
    public $brakerotorITC;
    public $coolantwash;
    public $resCoolantwash;
    public $coolantwashITC;
    public $distcap;
    public $resDistcap;
    public $distcapITC;
    public $fuelfilters;
    public $resFuelfilter;
    public $fuelfilterITC;
    public $headlights;
    public $resHeadlight;
    public $headlightITC;
    public $oilchanges;
    public $resoilchange;
    public $oilchangeITC;
    public $powersteers;
    public $respowersteer;
    public $powersteerITC;
    public $sparkplugs;
    public $ressparkplug;
    public $sparkplugITC;
    public $timingbelts;
    public $restimingbelt;
    public $timingbeltITC;
    public $tirenews;
    public $restirenew;
    public $tirenewITC;
    public $tirebalancings;
    public $restirebalancing;
    public $tirebalancingITC;
    public $tireinflations;
    public $restireinflation;
    public $tireinflationITC;
    public $tirerotations;
    public $restirerotation;
    public $tirerotationITC;
    public $wheelrotations;
    public $reswheelrotation;
    public $wheelrotationITC;
    public $transfluidflushs;
    public $restransfluidflush;
    public $transfluidflushITC;
    public $wheelalignments;
    public $reswheelalignment;
    public $wheelalignmentITC;
    public $wiperblades;
    public $reswiperblade;
    public $wiperbladeITC;
    public $cabinairs;
    public $rescabinair;
    public $cabinairITC;
    public $smogchecks;
    public $ressmogcheck;
    public $smogcheckITC;
    public $alternators;
    public $resalternator;
    public $alternatorITC;
    public $belts;
    public $resbelt;
    public $beltITC;
    public $bodyworks;
    public $resbodywork;
    public $bodyworkITC;
    public $brakecalipers;
    public $resbrakecaliper;
    public $brakecaliperITC;
    public $carburetors;
    public $rescarburetor;
    public $carburetorITC;
    public $catalytics;
    public $rescatalytic;
    public $catalyticITC;
    public $clutchs;
    public $resclutch;
    public $clutchITC;
    public $controlarms;
    public $rescontrolarm;
    public $controlarmITC;
    public $coolanttemps;
    public $rescoolanttemp;
    public $coolanttempITC;
    public $exhausts;
    public $resexhaust;
    public $exhaustITC;
    public $fuelinjections;
    public $resfuelinjection;
    public $fuelinjectionITC;
    public $fueltanks;
    public $resfueltank;
    public $fueltankITC;
    public $headgaskets;
    public $resheadgasket;
    public $headgasketITC;
    public $heatercores;
    public $resheatercore;
    public $heatercoreITC;
    public $hoses;
    public $reshose;
    public $hoseITC;
    public $lines;
    public $resline;
    public $lineITC;
    public $massairs;
    public $resmassair;
    public $massairITC;
    public $mufflers;
    public $resmuffler;
    public $mufflerITC;
    public $oxygensensors;
    public $resoxygensensor;
    public $oxygensensorITC;
    public $radiators;
    public $resradiator;
    public $radiatorITC;
    public $shocks;
    public $resshock;
    public $shockITC;
    public $starters;
    public $resstarter;
    public $starterITC;
    public $thermostats;
    public $resthermostat;
    public $thermostatITC;
    public $tierods;
    public $restierod;
    public $tierodITC;
    public $transmissions;
    public $restransmission;
    public $transmissionITC;
    public $waterpumps;
    public $reswaterpump;
    public $waterpumpITC;
    public $wheelbearings;
    public $reswheelbearing;
    public $wheelbearingITC;
    public $windows;
    public $reswindow;
    public $windowITC;
    public $windshields;
    public $reswindshield;
    public $windshieldITC;
    public $sensors;
    public $ressensor;
    public $sensorITC;
    public $others;
    public $resother;
    public $otherITC;
    public $getVats;
    public $getProf;


    public $askExpert;
    public $ansfromExpert;
    public $relatedFeeds;
    public $alltimepoints;
    public $mypoints;
    public $globalpoints;

    public $askedQuest;
    public $countQuest;



    public $ref_code;
    public $getRefs;

    public $purchase_order_no;
    public $order_date;
    public $expected_date;
    public $purchase_order_inventory_item;
    public $purchase_order_qty;
    public $purchase_order_rate;
    public $purchase_order_totcost;
    public $purchase_order_shippingcost;
    public $purchase_order_discount;
    public $purchase_order_othercost;
    public $purchase_order_tax;
    public $purchase_order_totalpurchaseorder;
    public $purchase_order_shipto;
    public $purchase_order_address1;
    public $purchase_order_address2;
    public  $purchase_order_city;
    public $purchase_order_state;
    public $purchase_order_country;
    public $purchase_order_zip;
    public $purchase_order_destphone;
    public $purchase_order_destfax;
    public $purchase_order_destmail;
    public $purchase_order_orderby;
    public $purchaseOrder;
    public $invItem;
    public $categoryItem;
    public $inventoryItem;
    public $myLabourCategory;
    public $jobdescription;
    public $resultData;
    public $timesheets;
    public $vendpayment;
    public $pay_po_number;
    public $pay_order_date;
    public $pay_date_expected;
    public $pay_invent_item;
    public $pay_description_of_item;
    public $pay_quantity;
    public $pay_rate;
    public $pay_tot_cost;
    public $pay_shipping_cost;
    public $pay_discount;
    public $pay_othercosts;
    public $pay_tax;
    public $pay_po_total;
    public $pay_advance;
    public $pay_balance;
    public $pay_cashamount;
    public $pay_chequeno;
    public $pay_chequedate;
    public $pay_chequeamount;
    public $pay_credit;
    public $pay_cc;
    public $pay_cardamount;
    public $getPart;
    public $vehicleRecs;
    public $technician;
    public $payschedules;
    public $techpayStub;


    public $hour;
    public $rate;
    public $pay_due;
    public $start_date;
    public $end_date;
    public $deduction;
    public $balance;
    public $total_pay;
    public $cash_amount;
    public $cheque_amout;
    public $creditcard_amount;
    public $pay_grandtotal;
    public $dealervehicle;
    public $getRes;
    public $vehicle_inf;
    public $timeline;
    public $sub_total;
    public $admin_fee;


    public function __construct(Request $request){

        $this->getIp = $_SERVER['REMOTE_ADDR'];


        $this->arr_ip = geoip()->getLocation($this->getIp);
        // $this->arr_ip = geoip()->getLocation('154.120.86.96');
        // $this->arr_ip = geoip()->getLocation('206.189.30.235');
        // $this->arr_ip = geoip()->getLocation('165.227.36.202');
        // $this->arr_ip = geoip()->getLocation('64.235.204.107');

        $this->country = $this->arr_ip['country'];
        $this->continent = $this->arr_ip['continent'];
    }



    public function newMails($sent_to){
        $getnew = Message::where('sent_to', $sent_to)->where('msg_read', 0)->get();

        return $getnew;
    }

    public function receivedMails($sent_to){
        $getreceived = Message::where('sent_to', $sent_to)->get();

        return $getreceived;
    }

    public function readMails($id){
        $getread = Message::where('id', $id)->get();

        Message::where('id', $id)->update(['msg_read' => 1]);

        return $getread;
    }

    public function sentMails($ref_code){
        $getsent = Message::where('sender_id', $ref_code)->where('msg_sent', 1)->get();

        return $getsent;
    }

    public function draftMails($ref_code){
        $getdraft = Message::where('sender_id', $ref_code)->where('msg_draft', 1)->get();

        return $getdraft;
    }

    public function trashMails($ref_code){
        $gettrash = Message::where('sender_id', $ref_code)->where('msg_trash', 1)->get();

        return $gettrash;
    }


    public function suggestedDealers(){
        $getInfo = SuggestedDealers::orderBy('created_at', 'DESC')->get();

        return $getInfo;
    }

    public function suggestedMechanic($station){
        $getInfo = SuggestedMechanics::where('station_name', $station)->orderBy('created_at', 'DESC')->get();

        return $getInfo;
    }


    public function supportagent($busid){
        $getInfo = Admin::where('busID', $busid)->where('role', 'Agent')->orderBy('created_at', 'DESC')->get();

        return $getInfo;
    }

    public function notify(){

        if(Auth::check() == true){
            $notifier = Notification::where('ref_code', Auth::user()->ref_code)->where('read_state', 0)->orderBy('created_at', 'DESC')->get();
        }
        else{
            $notifier = "";
        }


        return $notifier;
    }

    public function clientinfo(){
        if(Auth::check() == true){
            $client = User::where('email', Auth::user()->email)->get();

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
        }
        else{
            $this->busInfo = "";
        }


        return $this->busInfo;
    }


    public function generateRefcode(){

        $letter = chr(rand(65,90));
        $ref_code = $letter.mt_rand(1000, 9999);

        $checking = User::where('email', Auth::user()->email)->get();
        $this->ref_code = $checking[0]->ref_code;

            if(count($checking) > 0 && $checking[0]->ref_code != null){

                $ref = User::where('email', Auth::user()->email)->update(['ref_code' => $this->ref_code]);

                // Get all affiliated with ref_code;
                $getRefs = User::where('referred_by', $this->ref_code)->where('redeem', '0')->get();

                if(count($getRefs) > 0){
                    $this->getRefs = count($getRefs);
                }
                else{
                    $this->getRefs = 0;
                }
            }
            else{
                $ref = User::where('email', Auth::user()->email)->update(['ref_code' => $ref_code]);
                $this->ref_code = "";
            }

            $data = array(
                'ref_code' => $this->ref_code,
                'get_ref' => $this->getRefs
            );


            return $data;

    }



    // Activity Log
    public function activities($ip, $country, $city, $currency, $action){
        DB::table('activity')->insert(['ipaddress' => $ip, 'country' => $country, 'city' => $city, 'currency' => $currency, 'action' => $action]);
    }

    

    // Send Mail Function

    public function sendEmail($objDemoa, $purpose){


      $objDemo = new \stdClass();
      $objDemo->purpose = $purpose;
    if($purpose == "VIM File - Account Approval"){
        $objDemo->name = $this->name;
      }
      elseif($purpose == "VIM File - Account Declined"){
        $objDemo->name = $this->name;
      }
      elseif($purpose == "VIM File - New Message"){
        $objDemo->sender = $this->sender;
        $objDemo->subject = $this->subject;
        $objDemo->message = $this->message;
	  }
	  elseif($purpose == "VIM File - Payment Acknowledged"){
        $objDemo->name = $this->name;
      }
      elseif($purpose == "Payment Successfully processed"){
        $objDemo->name = $this->name;
        $objDemo->to = $this->to;
        $objDemo->message = $this->message;
      }
      elseif($purpose == "Your vehicle maintenance is completed"){
        $objDemo->name = $this->name;
        $objDemo->to = $this->to;
      }
      elseif($purpose == "A new mobile mechanic just signed up on VIM File"){
        $objDemo->name = $this->name;
        $objDemo->to = $this->to;
        $objDemo->mechanic = $this->mechanic;
        $objDemo->city = $this->city;
        $objDemo->state = $this->state;
        $objDemo->zipcode = $this->zipcode;
        $objDemo->service_offer = $this->service_offer;
        $objDemo->discount = $this->discount;
        $objDemo->country = $this->country;
        $objDemo->station_name = $this->station_name;
        $objDemo->station_address = $this->station_address;
      }
      elseif($purpose == "A new auto care center just signed up on VIM File"){
        $objDemo->name = $this->name;
        $objDemo->to = $this->to;
        $objDemo->mechanic = $this->mechanic;
        $objDemo->city = $this->city;
        $objDemo->state = $this->state;
        $objDemo->zipcode = $this->zipcode;
        $objDemo->country = $this->country;
        $objDemo->station_name = $this->station_name;
        $objDemo->service_offer = $this->service_offer;
        $objDemo->discount = $this->discount;
        $objDemo->station_address = $this->station_address;
      }
      elseif($purpose == "Vehicle maintenance"){
        $objDemo->to = $this->to;
        $objDemo->subject = $this->subject;
        $objDemo->heading = $this->heading;
        $objDemo->message = $this->message;
      }

      elseif($purpose == "Profile Reviewed and Account Activated" || $purpose == "Profile Reviewed and Account Declined"){
        $objDemo->to = $this->to;
        $objDemo->name = $this->name;
        $objDemo->subject = $this->subject;
        $objDemo->description = $this->description;
        $objDemo->file = $this->file;
      }
      elseif($purpose == "VIM File - Contact Us"){
        $objDemo->name = $this->name;
        $objDemo->subject = $this->subject;
        $objDemo->message = $this->message;
        $objDemo->email = $this->email;
      }
      elseif($purpose == "Admin Team - Contact"){
        $objDemo->name = $this->name;
        $objDemo->subject = $this->subject;
        $objDemo->message = $this->message;
        $objDemo->email = $this->email;
      }
      elseif($purpose == "VIM File - Password Change"){
        $objDemo->name = $this->name;
        $objDemo->email = $this->email;
        $objDemo->password = $this->password;
      }
      elseif($purpose == "VIM File - New Vehicle Registration"){
        $objDemo->name = $this->name;
        $objDemo->email = $this->email;
        $objDemo->licence = $this->licence;
        $objDemo->from = $this->from;
      }
      elseif($purpose == "VIM File - Account Declined"){
        $objDemo->name = $this->name;
      }
      elseif($purpose == "VIM File - Additional Email Update"){
        $objDemo->name = $this->name;
        $objDemo->sender = $this->sender;
        $objDemo->content1 = $this->content1;
        $objDemo->content2 = $this->content2;
        $objDemo->content3 = $this->content3;
      }

      elseif($purpose == "VIM File - Reminder Settings Update"){
        $objDemo->name = $this->name;
        $objDemo->sender = $this->sender;
        $objDemo->content1 = $this->content1;
        $objDemo->content2 = $this->content2;
        $objDemo->content3 = $this->content3;
        $objDemo->content4 = $this->content4;
        $objDemo->content5 = $this->content5;
      }

      elseif($purpose == "VIM File - New Maintenace Record"){
        $objDemo->to = $this->to;
        $objDemo->name = $this->name;
        $objDemo->email = $this->email;
        $objDemo->licence = $this->licence;
        $objDemo->from = $this->from;
        $objDemo->content1 = $this->content1;
        $objDemo->content2 = $this->content2;
        $objDemo->content3 = $this->content3;
      }

      elseif($purpose == "VIM FILE -You can now do vehicle maintenance, wherever, whenever"){
        $objDemo->name = $this->name;
        $objDemo->ref_code = $this->ref_code;
      }

      elseif($purpose == "VIM File - Estimate Process"){
        $objDemo->name = $this->name;
        $objDemo->licence = $this->licence;
        $objDemo->to = $this->to;
        $objDemo->phone = $this->phone;
        $objDemo->material_cost = $this->material_cost;
        $objDemo->labour_cost = $this->labour_cost;
        $objDemo->other_cost = $this->other_cost;
        $objDemo->total_cost = $this->total_cost;
        $objDemo->make = $this->make;
        $objDemo->model = $this->model;
        $objDemo->date = $this->date;
        $objDemo->service_type = $this->service_type;
        $objDemo->service_option = $this->service_option;
        $objDemo->service_item_spec = $this->service_item_spec;
        $objDemo->manufacturer = $this->manufacturer;
        $objDemo->material_qty = $this->material_qty;
        $objDemo->labour_qty = $this->labour_qty;
        $objDemo->material_qty2 = $this->material_qty2;
        $objDemo->material_qty3 = $this->material_qty3;
        $objDemo->material_qty4 = $this->material_qty4;
        $objDemo->material_qty5 = $this->material_qty5;
        $objDemo->material_qty6 = $this->material_qty6;
        $objDemo->material_qty7 = $this->material_qty7;
        $objDemo->material_qty8 = $this->material_qty8;
        $objDemo->material_qty9 = $this->material_qty9;
        $objDemo->material_qty10 = $this->material_qty10;
        $objDemo->labour_qty2 = $this->labour_qty2;
        $objDemo->labour_qty3 = $this->labour_qty3;
        $objDemo->labour_qty4 = $this->labour_qty4;
        $objDemo->labour_qty5 = $this->labour_qty5;
        $objDemo->labour_qty6 = $this->labour_qty6;
        $objDemo->labour_qty7 = $this->labour_qty7;
        $objDemo->labour_qty8 = $this->labour_qty8;
        $objDemo->labour_qty9 = $this->labour_qty9;
        $objDemo->labour_qty10 = $this->labour_qty10;
        $objDemo->material_cost2 = $this->material_cost2;
        $objDemo->material_cost3 = $this->material_cost3;
        $objDemo->material_cost4 = $this->material_cost4;
        $objDemo->material_cost5 = $this->material_cost5;
        $objDemo->material_cost6 = $this->material_cost6;
        $objDemo->material_cost7 = $this->material_cost7;
        $objDemo->material_cost8 = $this->material_cost8;
        $objDemo->material_cost9 = $this->material_cost9;
        $objDemo->material_cost10 = $this->material_cost10;
        $objDemo->labour_cost2 = $this->labour_cost2;
        $objDemo->labour_cost3 = $this->labour_cost3;
        $objDemo->labour_cost4 = $this->labour_cost4;
        $objDemo->labour_cost5 = $this->labour_cost5;
        $objDemo->labour_cost6 = $this->labour_cost6;
        $objDemo->labour_cost7 = $this->labour_cost7;
        $objDemo->labour_cost8 = $this->labour_cost8;
        $objDemo->labour_cost9 = $this->labour_cost9;
        $objDemo->labour_cost10 = $this->labour_cost10;
        $objDemo->manufacturer2 = $this->manufacturer2;
        $objDemo->manufacturer3 = $this->manufacturer3;
        $objDemo->service_item_spec2 = $this->service_item_spec2;
        $objDemo->service_item_spec3 = $this->service_item_spec3;
        $objDemo->other_qty = $this->other_qty;
        $objDemo->sub_total = $this->sub_total;
        $objDemo->discount = $this->discount;
        $objDemo->admin_fee = $this->admin_fee;
        $objDemo->service_note = $this->service_note;
        $objDemo->mileage = $this->mileage;
        $objDemo->file = $this->file;

      }

      elseif($purpose == "VIM File - Labour Payment Invoice"){
        $objDemo->name = $this->name;
        $objDemo->licence = $this->licence;
        $objDemo->to = $this->to;
        $objDemo->make = $this->make;
        $objDemo->model = $this->model;
        $objDemo->date = $this->date;
        $objDemo->service_type = $this->service_type;
        $objDemo->service_option = $this->service_option;
        $objDemo->hour = $this->hour;
        $objDemo->rate = $this->rate;
        $objDemo->pay_due = $this->pay_due;
        $objDemo->start_date = $this->start_date;
        $objDemo->end_date = $this->end_date;
        $objDemo->deduction = $this->deduction;
        $objDemo->balance = $this->balance;
        $objDemo->total_pay = $this->total_pay;
        $objDemo->cash_amount = $this->cash_amount;
        $objDemo->cheque_amount = $this->cheque_amount;
        $objDemo->creditcard_amount = $this->creditcard_amount;
        $objDemo->total_cost = $this->total_cost;

      }

    elseif($purpose == "VIM File - Payment Receipt"){
        $objDemo->name = $this->name;
        $objDemo->licence = $this->licence;
        $objDemo->to = $this->to;
        $objDemo->phone = $this->phone;
        $objDemo->material_cost = $this->material_cost;
        $objDemo->labour_cost = $this->labour_cost;
        $objDemo->other_cost = $this->other_cost;
        $objDemo->total_cost = $this->total_cost;
        $objDemo->make = $this->make;
        $objDemo->model = $this->model;
        $objDemo->date = $this->date;
        $objDemo->service_type = $this->service_type;
        $objDemo->service_option = $this->service_option;
        $objDemo->service_item_spec = $this->service_item_spec;
        $objDemo->manufacturer = $this->manufacturer;
        $objDemo->material_qty = $this->material_qty;
        $objDemo->labour_qty = $this->labour_qty;
        $objDemo->material_qty2 = $this->material_qty2;
        $objDemo->material_qty3 = $this->material_qty3;
        $objDemo->labour_qty2 = $this->labour_qty2;
        $objDemo->material_cost2 = $this->material_cost2;
        $objDemo->material_cost3 = $this->material_cost3;
        $objDemo->labour_cost2 = $this->labour_cost2;
        $objDemo->manufacturer2 = $this->manufacturer2;
        $objDemo->manufacturer3 = $this->manufacturer3;
        $objDemo->service_item_spec2 = $this->service_item_spec2;
        $objDemo->service_item_spec3 = $this->service_item_spec3;
        $objDemo->other_qty = $this->other_qty;
        $objDemo->service_note = $this->service_note;
        $objDemo->mileage = $this->mileage;
        $objDemo->file = $this->file;

      }

      elseif($purpose == "VIM File - Purchase Order"){
        $objDemo->name = $this->name;
        $objDemo->vendor = $this->vendor;
        $objDemo->to = $this->to;
        $objDemo->purchase_order_no = $this->purchase_order_no;
        $objDemo->order_date = $this->order_date;
        $objDemo->expected_date = $this->expected_date;
        $objDemo->purchase_order_inventory_item = $this->purchase_order_inventory_item;
        $objDemo->purchase_order_qty = $this->purchase_order_qty;
        $objDemo->purchase_order_rate = $this->purchase_order_rate;
        $objDemo->purchase_order_totcost = $this->purchase_order_totcost;
        $objDemo->purchase_order_shippingcost = $this->purchase_order_shippingcost;
        $objDemo->purchase_order_discount = $this->purchase_order_discount;
        $objDemo->purchase_order_othercost = $this->purchase_order_othercost;
        $objDemo->purchase_order_tax = $this->purchase_order_tax;
        $objDemo->purchase_order_totalpurchaseorder = $this->purchase_order_totalpurchaseorder;
        $objDemo->purchase_order_shipto = $this->purchase_order_shipto;
        $objDemo->purchase_order_address1 = $this->purchase_order_address1;
        $objDemo->purchase_order_address2 = $this->purchase_order_address2;
        $objDemo->purchase_order_city = $this->purchase_order_city;
        $objDemo->purchase_order_state = $this->purchase_order_state;
        $objDemo->purchase_order_country = $this->purchase_order_country;
        $objDemo->purchase_order_zip = $this->purchase_order_zip;
        $objDemo->purchase_order_destphone = $this->purchase_order_destphone;
        $objDemo->purchase_order_destfax = $this->purchase_order_destfax;
        $objDemo->purchase_order_orderby = $this->purchase_order_orderby;

      }

      elseif($purpose == "VIM File - Vendor Invoice"){
        $objDemo->name = $this->name;
        $objDemo->pay_po_number = $this->pay_po_number;
        $objDemo->to = $this->to;
        $objDemo->pay_order_date = $this->pay_order_date;
        $objDemo->pay_date_expected = $this->pay_date_expected;
        $objDemo->pay_invent_item = $this->pay_invent_item;
        $objDemo->pay_description_of_item = $this->pay_description_of_item;
        $objDemo->pay_quantity = $this->pay_quantity;
        $objDemo->pay_rate = $this->pay_rate;
        $objDemo->pay_tot_cost = $this->pay_tot_cost;
        $objDemo->pay_shipping_cost = $this->pay_shipping_cost;
        $objDemo->pay_discount = $this->pay_discount;
        $objDemo->pay_othercosts = $this->pay_othercosts;
        $objDemo->pay_tax = $this->pay_tax;
        $objDemo->pay_po_total = $this->pay_po_total;
        $objDemo->pay_advance = $this->pay_advance;
        $objDemo->pay_balance = $this->pay_balance;
        $objDemo->pay_cashamount = $this->pay_cashamount;
        $objDemo->pay_chequeno = $this->pay_chequeno;
        $objDemo->pay_chequedate = $this->pay_chequedate;
        $objDemo->pay_chequeamount = $this->pay_chequeamount;
        $objDemo->pay_credit = $this->pay_credit;
        $objDemo->pay_cc = $this->pay_cc;
        $objDemo->pay_cardamount = $this->pay_cardamount;
        $objDemo->pay_grandtotal = $this->pay_grandtotal;

      }

      elseif($purpose == "VIM File - Search Appearance"){
        $objDemo->to = $this->to;
        $objDemo->sender = $this->sender;
        $objDemo->company = $this->company;
        $objDemo->city = $this->city;
        $objDemo->state = $this->state;
        $objDemo->country = $this->country;
      }

      elseif($purpose == "VIM File - A client wants to book an appointment with you"){
        $objDemo->to = $this->to;
        $objDemo->sender = $this->sender;
        $objDemo->email = $this->email;
        $objDemo->subject = $this->subject;
        $objDemo->message = $this->message;
        $objDemo->date = $this->date;
        $objDemo->service_option = $this->service_option;
        $objDemo->service_type = $this->service_type;
        $objDemo->current_mileage = $this->current_mileage;
        $objDemo->company = $this->company;
      }

      elseif($purpose == "VIM File - Book an Appointment"){
        $objDemo->to = Auth::user()->email;
        $objDemo->sender = $this->sender;
        $objDemo->ref_code = $this->ref_code;
        $objDemo->subject = $this->subject;
        $objDemo->date = $this->date;
        $objDemo->discount = $this->discount;
        $objDemo->service_option = $this->service_option;
        $objDemo->service_type = $this->service_type;
        $objDemo->current_mileage = $this->current_mileage;
        $objDemo->company = $this->company;
        $objDemo->company_name = $this->company_name;
        $objDemo->station_address = $this->station_address;
      }

      elseif($purpose == "VIM File - Support Ticket Created"){
        $objDemo->to = $this->to;
        $objDemo->sender = $this->sender;
        $objDemo->email = $this->email;
        $objDemo->subject = $this->subject;
        $objDemo->message = $this->message;
        $objDemo->department = $this->department;
        $objDemo->document = $this->document;
        $objDemo->relatedService = $this->relatedService;
      }

      elseif($purpose == "VIM FILE - Redeem your points today"){
        $objDemo->redeempoint = $this->redeempoint;
        $objDemo->email = $this->email;
        $objDemo->name = $this->name;
      }

      elseif($purpose == "VIM FILE Admin- Client Redeemed points"){
        $objDemo->to = $this->to;
        $objDemo->email = $this->email;
        $objDemo->name = $this->name;
        $objDemo->redeempoint = $this->redeempoint;
        $objDemo->userType = $this->userType;
      }

      elseif($purpose == "Register a Vehicle and start tracking all maintenance activities" || $purpose == "We have made it easier to track vehicle maintenance activities"){
        $objDemo->to = $this->to;
        $objDemo->name = $this->name;
      }

      elseif($purpose == "1-Year Vehicle Oil Change is on Us" || $purpose == "Your Vehicle Information is Missing"){
        $objDemo->to = $this->to;
        $objDemo->name = $this->name;
      }

      elseif($purpose == "This Month insights into your Vehicle Maintenance Activities"){
        $objDemo->to = $this->to;
        $objDemo->name = $this->name;
        $objDemo->oilChange = $this->oilChange;
        $objDemo->oilChangedate = $this->oilChangedate;
        $objDemo->tyredate = $this->tyredate;
        $objDemo->airdate = $this->airdate;
        $objDemo->inspectiondate = $this->inspectiondate;
        $objDemo->registrationdate = $this->registrationdate;
        $objDemo->mileage1 = $this->mileage1;
        $objDemo->mileage2 = $this->mileage2;
        $objDemo->mileage3 = $this->mileage3;
        $objDemo->mileage4 = $this->mileage4;
        $objDemo->mileage5 = $this->mileage5;
        $objDemo->current_mileage = $this->current_mileage;
        $objDemo->tyreRotation = $this->tyreRotation;
        $objDemo->airFilter = $this->airFilter;
        $objDemo->inspection = $this->inspection;
        $objDemo->registration = $this->registration;
      }

      elseif($purpose == "There is a new opportunity post within your proximity"){
        $objDemo->to = $this->to;
        $objDemo->name = $this->name;
        $objDemo->sender = $this->sender;
        $objDemo->subject = $this->subject;
        $objDemo->service_option = $this->service_option;
        $objDemo->message = $this->message;
        $objDemo->timeline = $this->timeline;
        $objDemo->location = $this->location;
        $objDemo->city = $this->city;
        $objDemo->state = $this->state;
        $objDemo->zipcode = $this->zipcode;
        $objDemo->licence = $this->licence;
        $objDemo->make = $this->make;
        $objDemo->model = $this->model;
        $objDemo->date = $this->date;
        $objDemo->mileage = $this->mileage;
        $objDemo->curr_mileage = $this->curr_mileage;
      }

      elseif($purpose == "Your vehicle maintenance is completed"){
        $objDemo->to = $this->to;
        $objDemo->name = $this->name;
        $objDemo->email = $this->email;
        $objDemo->licence = $this->licence;
        $objDemo->make = $this->make;
        $objDemo->model = $this->model;
        $objDemo->mileage = $this->mileage;
        $objDemo->date = $this->date;
        $objDemo->from = $this->from;
        $objDemo->content1 = $this->content1;
        $objDemo->content2 = $this->content2;
        $objDemo->content3 = $this->content3;
      }

      elseif($purpose == "My weekly point achievement on Vimfile" || $purpose == "My global point achievement on Vimfile"){
        $objDemo->name = $this->name;
        $objDemo->to = $this->to;
        $objDemo->point = $this->point;
      }
    elseif($purpose == "Profile updated and will be reviewed" || $purpose == "Compose Mail"){
        $objDemo->to = $this->to;
        $objDemo->name = $this->name;
        $objDemo->subject = $this->subject;
        $objDemo->file = $this->file;
        $objDemo->message = $this->message;
    }

      elseif($purpose == $this->subject){
        $objDemo->to = $this->to;
        $objDemo->name = $this->name;
        $objDemo->subject = $this->subject;
        $objDemo->description = $this->description;
        $objDemo->file = $this->file;
      }
      

      Mail::to($objDemoa)
            ->send(new sendEmail($objDemo));
   }


}
