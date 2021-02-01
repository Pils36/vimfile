<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


use App\Mail\sendEmail;

use App\BookAppointment as BookAppointment;
use App\User as User;
use App\Stations as Stations;
use App\Business as Business;
use App\MinimumDiscount as MinimumDiscount;
use App\BusinessStaffs as BusinessStaffs;
use App\OpportunityPost as OpportunityPost;
use App\Addpart as Addpart;
use App\Estimate as Estimate;
use App\Carrecord as Carrecord;

class EstimateController extends Controller
{


	public $to;
	public $name;
	public $sender;
	public $email;
	public $subject;
	public $service_option;
	public $message;
	public $date;
	public $service_type;
	public $company;
	public $company_name;
	public $station_address;
	public $ref_code;
	public $discount;
	public $timeline;
	public $location;
	public $city;
	public $state;
	public $zipcode;
	public $licence;
	public $make;
	public $model;
	public $curr_mileage;
	public $mileage;
    public $estimate_id;
    public $post_id;


    public function requestEstimate(Request $req){


    	$validator = Validator::make($req->all(), [
             'vehicle_licence' => 'required|string',
             'make' => 'required|string',
             'model' => 'required|string',
             'previous_mileage' => 'required|string',
             'subject' => 'required|string',
             'service_option' => 'required|string',
             'current_mileage' => 'required|string',
             'year' => 'required|string',
             'description' => 'required|string',
             'timeline' => 'required|string',
             'service_need' => 'required|string',
             'city' => 'required|string',
             'state' => 'required|string',
             'request_by' => 'required|string',
        ]);


        if($validator->passes()){

            $post_id = "POST_".mt_rand(00001, 99999);

            $user = User::where('email', $req->email)->get();

        // Post Opprtunities
        $postOpport = OpportunityPost::insert(['post_id' => $post_id, 'ref_code' => $user[0]->ref_code, 'email' => $req->email, 'post_subject' => $req->subject, 'service_option' => $req->service_option, 'post_licence' => $req->vehicle_licence, 'post_make' => $req->make, 'post_model' => $req->model, 'post_mileage' => $req->previous_mileage, 'post_curr_mileage' => $req->current_mileage,'post_year' => $req->year, 'post_description' => $req->description, 'post_timeline' => $req->timeline, 'post_service_need' => $req->service_need, 'postcity' => $req->city, 'poststate' => $req->state, 'postzipcode' => $req->zipcode]);

        if($postOpport == true){
            OpportunityPost::where('post_id', $post_id)->update(['state' => '1']);
            // Mail MM & Auto care within Postal Area

            if($req->request_by == "zipcode"){
                $infodata = $user[0]->zipcode;
            }
            elseif($req->request_by == "city"){
                $infodata = $user[0]->city;
            }
            else{
                $infodata = $user[0]->city;
            }

            $getReceive = User::where($req->request_by, 'LIKE', '%'.$infodata.'%')->where('userType', 'Certified Professional')->orWhere('userType', 'Auto Care')->limit(5)->inRandomOrder()->get();
            if(count($getReceive) > 0){
                foreach ($getReceive as $key) {
                    $this->name = $key['name'];
                    $this->to = $key['email'];
                    // $this->to = "bambo@vimfile.com";
                    $this->sender = $user[0]->name;
                    $this->subject = $req->subject;
                    $this->service_option = $req->service_option;
                    $this->message = $req->description;
                    $this->timeline = $req->timeline;
                    $this->location = $req->service_need;
                    $this->city = $req->city;
                    $this->state = $req->state;
                    $this->zipcode = $req->zipcode;
                    $this->licence = $req->vehicle_licence;
                    $this->make = $req->make;
                    $this->model = $req->model;
                    $this->date = $req->year;
                    $this->mileage = $req->previous_mileage;
                    $this->curr_mileage = $req->current_mileage;

                    // $this->sendEmail($this->to, 'There is a new opportunity post within your proximity');
                }

                $resData = ['data' => $postOpport, 'message' => 'success', 'status' => 200];
                $status = 200;
            }

        }
        else{
        	$resData = ['data' => [], 'message' => 'Something went wrong!', 'status' => 400];
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

    // Request Listings

    public function listEstimate(Request $req){

      // Get my estimates

      // $getEstimates = OpportunityPost::where('email', Auth::user()->email)->get();
      $getEstimates = OpportunityPost::where('email', $req->email)->get();

      if(count($getEstimates) > 0){


        $resData = ['data' => $getEstimates, 'message' => 'Successfull', 'status' => 200];
        $status = 200;
      }
      else{
        $resData = ['data' => [], 'message' => "No estimate request", 'status' => 400];
        $status = 400;
      }


      return $this->returnJSON($resData, $status);
    }


    public function additionalpart(Request $req){

      $this->estimate_id = $req->estimate_id;
      $this->post_id = $req->post_id;

      $platform = 'others';

      if($req->platform == $platform){

          $fileNameToStore = $req->file;
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
              $filenamestore = rand().'_'.time().'.'.$extension;

              $fileNameToStore = "http://".$_SERVER['HTTP_HOST']."/partsDocs/".$filenamestore;

              // $path = $req->file('file')->move(public_path('/partsDocs/'), $filenamestore);

              $path = $req->file('file')->move(public_path('../../partsDocs/'), $filenamestore);


          }
          else{

              $fileNameToStore = 'https://vimfile.com/img/icon/vimlogo.png';
          }
      }

      // Check if already exist
      $check = Addpart::where('post_id', $this->post_id)->where('busID', $req->busID)->get();

      if(count($check) > 0){
        $resData = ['message' => "You have already created this part", 'status' => 200];
        $status = 200;
      }
      else{
          // Insert new record
          $addnewPart = Addpart::insert(['busID' => $req->busID, 'post_id' => $this->post_id, 'part_no' => $req->part_number, 'description' => $req->description, 'category' => $req->part_category, 'upload' => $fileNameToStore, 'vendor_code' => $req->vendor_code, 'vendor' => $req->vendor, 'manufacturer' => $req->vendor_manufacturer, 'location' => $req->vendor_location, 'quantity' => $req->item_quantity, 'unit_cost' => $req->item_unitcost, 'total_cost' => $req->item_totalcost, 'mark_up' => $req->item_markup, 'discount' => $req->item_discount, 'unit_price' => $req->item_unitprice, 'total_discount' => $req->item_totaldiscount, 'tax_rate' => $req->item_taxrate, 'total_price' => $req->item_totalprice, 'technician' => $req->assigned_technician]);

          if($addnewPart == true){
            $resData = ['data' => $addnewPart, 'message' => 'Part Successfully Added!', 'status' => 200, 'action' => 'addpart'];
            $status = 200;
          }
          else{
            $resData = ['data' => [], 'message' => "Something went wrong", 'status' => 400];
            $status = 400;
          }
      }



      return $this->returnJSON($resData, $status);

    }


    public function prepareestimate(Request $req){

      $this->estimate_id = $req->estimate_id;
      $this->post_id = $req->post_id;

      $platform = 'others';

      if($req->platform == $platform){

          $fileNameToStore = $req->file;
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
              // $fileNameToStore = rand().'_'.time().'.'.$extension;

              $filenamestore = rand().'_'.time().'.'.$extension;

              $fileNameToStore = "http://".$_SERVER['HTTP_HOST']."/uploads/".$filenamestore;

              // $path = $req->file('file')->move(public_path('/uploads/'), $filenamestore);

              $path = $req->file('file')->move(public_path('../../uploads/'), $filenamestore);


          }
          else{

              $fileNameToStore = 'https://vimfile.com/img/icon/vimlogo.png';
          }
      }


      // Check if already exist
      $getpart = Addpart::where('post_id', $this->post_id)->where('busID', $req->busID)->get();



      if(count($getpart) > 0){

            $this->post_id = $getpart[0]->post_id;

            $check = Estimate::where('post_id', $this->post_id)->where('busID', $req->busID)->get();

            if(count($check) > 0){
              // Already exist
              $resData = ['message' => "You have already prepared this estimate", 'status' => 200];
              $status = 200;
            }
            else{

              $userInfo = Carrecord::where('vehicle_reg_no', $req->vehicle_licence)->get();

              if(count($userInfo) > 0){

                    if($req->request_action == "save_to_diagnostic"){
                      // Insert new
                    $estRec = Estimate::insert(['estimate_id' => $this->estimate_id, 'opportunity_id' => $this->post_id, 'email' => $userInfo[0]->email, 'telephone' => $userInfo[0]->telephone, 'busID' => $req->busID, 'vehicle_licence' => $req->vehicle_licence, 'make' => $userInfo[0]->make, 'model' => $userInfo[0]->model, 'date' => $req->date, 'service_type' => $req->service_type, 'service_option' => $req->service_option, 'service_item_spec' => $req->item_spec1, 'manufacturer' => $req->manufacturer1, 'material_qty' => $req->quantity1, 'material_cost' => $req->material_cost1, 'labour_cost' => $req->labour_cost1, 'material_qty2' => $req->quantity2, 'material_qty3' => $req->quantity3, 'material_cost2' => $req->material_cost2, 'material_cost3' => $req->material_cost3, 'labour_cost2' => $req->labour_cost2, 'labour_hour' => $req->labour_hour1, 'labour_rate' => $req->labour_rate1, 'manufacturer2' => $req->manufacturer2, 'manufacturer3' => $req->manufacturer3, 'service_item_spec2' => $req->item_spec2, 'service_item_spec3' => $req->item_spec3, 'other_cost' => $req->other_cost, 'total_cost' => $req->total_cost, 'service_note' => $req->service_note, 'mileage' => $req->mileage, 'file' => $fileNameToStore, 'update_by' => $req->updated_by, 'estimate' => '0', 'work_order' => '0', 'diagnostics' => '1', 'technician' => $getpart[0]->technician]);
                    }


                    elseif($req->request_action == "save_to_estimate"){
                      // Insert new
                    $estRec = Estimate::insert(['estimate_id' => $this->estimate_id, 'opportunity_id' => $this->post_id, 'email' => $userInfo[0]->email, 'telephone' => $userInfo[0]->telephone, 'busID' => $req->busID, 'vehicle_licence' => $req->vehicle_licence, 'make' => $userInfo[0]->make, 'model' => $userInfo[0]->model, 'date' => $req->date, 'service_type' => $req->service_type, 'service_option' => $req->service_option, 'service_item_spec' => $req->item_spec1, 'manufacturer' => $req->manufacturer1, 'material_qty' => $req->quantity1, 'material_cost' => $req->material_cost1, 'labour_cost' => $req->labour_cost1, 'material_qty2' => $req->quantity2, 'material_qty3' => $req->quantity3, 'material_cost2' => $req->material_cost2, 'material_cost3' => $req->material_cost3, 'labour_cost2' => $req->labour_cost2, 'labour_hour' => $req->labour_hour1, 'labour_rate' => $req->labour_rate1, 'manufacturer2' => $req->manufacturer2, 'manufacturer3' => $req->manufacturer3, 'service_item_spec2' => $req->item_spec2, 'service_item_spec3' => $req->item_spec3, 'other_cost' => $req->other_cost, 'total_cost' => $req->total_cost, 'service_note' => $req->service_note, 'mileage' => $req->mileage, 'file' => $fileNameToStore, 'update_by' => $req->updated_by, 'estimate' => '1', 'work_order' => '0', 'diagnostics' => '0', 'technician' => $getpart[0]->technician]);
                    }


                    elseif($req->request_action == "save_to_workorder"){
                      // Insert new
                    $estRec = Estimate::insert(['estimate_id' => $this->estimate_id, 'opportunity_id' => $this->post_id, 'email' => $userInfo[0]->email, 'telephone' => $userInfo[0]->telephone, 'busID' => $req->busID, 'vehicle_licence' => $req->vehicle_licence, 'make' => $userInfo[0]->make, 'model' => $userInfo[0]->model, 'date' => $req->date, 'service_type' => $req->service_type, 'service_option' => $req->service_option, 'service_item_spec' => $req->item_spec1, 'manufacturer' => $req->manufacturer1, 'material_qty' => $req->quantity1, 'material_cost' => $req->material_cost1, 'labour_cost' => $req->labour_cost1, 'material_qty2' => $req->quantity2, 'material_qty3' => $req->quantity3, 'material_cost2' => $req->material_cost2, 'material_cost3' => $req->material_cost3, 'labour_cost2' => $req->labour_cost2, 'labour_hour' => $req->labour_hour1, 'labour_rate' => $req->labour_rate1, 'manufacturer2' => $req->manufacturer2, 'manufacturer3' => $req->manufacturer3, 'service_item_spec2' => $req->item_spec2, 'service_item_spec3' => $req->item_spec3, 'other_cost' => $req->other_cost, 'total_cost' => $req->total_cost, 'service_note' => $req->service_note, 'mileage' => $req->mileage, 'file' => $fileNameToStore, 'update_by' => $req->updated_by, 'estimate' => '0', 'work_order' => '1', 'diagnostics' => '0', 'technician' => $getpart[0]->technician]);
                    }


                    else{

                      // Insert new
                      $estRec = Estimate::insert(['estimate_id' => $this->estimate_id, 'opportunity_id' => $this->post_id, 'email' => $userInfo[0]->email, 'telephone' => $userInfo[0]->telephone, 'busID' => $req->busID, 'vehicle_licence' => $req->vehicle_licence, 'make' => $userInfo[0]->make, 'model' => $userInfo[0]->model, 'date' => $req->date, 'service_type' => $req->service_type, 'service_option' => $req->service_option, 'service_item_spec' => $req->item_spec1, 'manufacturer' => $req->manufacturer1, 'material_qty' => $req->quantity1, 'material_cost' => $req->material_cost1, 'labour_cost' => $req->labour_cost1, 'material_qty2' => $req->quantity2, 'material_qty3' => $req->quantity3, 'material_cost2' => $req->material_cost2, 'material_cost3' => $req->material_cost3, 'labour_cost2' => $req->labour_cost2, 'labour_hour' => $req->labour_hour1, 'labour_rate' => $req->labour_rate1, 'manufacturer2' => $req->manufacturer2, 'manufacturer3' => $req->manufacturer3, 'service_item_spec2' => $req->item_spec2, 'service_item_spec3' => $req->item_spec3, 'other_cost' => $req->other_cost, 'total_cost' => $req->total_cost, 'service_note' => $req->service_note, 'mileage' => $req->mileage, 'file' => $fileNameToStore, 'update_by' => $req->updated_by, 'estimate' => '1', 'work_order' => '0', 'diagnostics' => '0', 'technician' => $getpart[0]->technician]);

                    }


                    if($estRec == true){
                      $resData = ['data' => $estRec, 'message' => 'success', 'status' => 200];
                      $status = 200;
                    }
                    else{
                      $resData = ['data' => [], 'message' => "Something went wrong", 'status' => 400];
                      $status = 400;
                    }



              }
              else{
                $resData = ['data' => [], 'message' => "Kindly register this vehicle before you can prepare estimate", 'status' => 400];
                $status = 400;
              }


            }



      }
      else{
        // Insert Fresh


        $userInfo = Carrecord::where('vehicle_reg_no', $req->vehicle_licence)->get();

              if(count($userInfo) > 0){

                    if($req->request_action == "save_to_diagnostic"){
                      // Insert new
                    $estRec = Estimate::insert(['estimate_id' => $this->estimate_id, 'opportunity_id' => $this->post_id, 'email' => $userInfo[0]->email, 'telephone' => $userInfo[0]->telephone, 'busID' => $req->busID, 'vehicle_licence' => $req->vehicle_licence, 'make' => $userInfo[0]->make, 'model' => $userInfo[0]->model, 'date' => $req->date, 'service_type' => $req->service_type, 'service_option' => $req->service_option, 'service_item_spec' => $req->item_spec1, 'manufacturer' => $req->manufacturer1, 'material_qty' => $req->quantity1, 'material_cost' => $req->material_cost1, 'labour_cost' => $req->labour_cost1, 'material_qty2' => $req->quantity2, 'material_qty3' => $req->quantity3, 'material_cost2' => $req->material_cost2, 'material_cost3' => $req->material_cost3, 'labour_cost2' => $req->labour_cost2, 'labour_hour' => $req->labour_hour1, 'labour_rate' => $req->labour_rate1, 'manufacturer2' => $req->manufacturer2, 'manufacturer3' => $req->manufacturer3, 'service_item_spec2' => $req->item_spec2, 'service_item_spec3' => $req->item_spec3, 'other_cost' => $req->other_cost, 'total_cost' => $req->total_cost, 'service_note' => $req->service_note, 'mileage' => $req->mileage, 'file' => $fileNameToStore, 'update_by' => $req->updated_by, 'estimate' => '0', 'work_order' => '0', 'diagnostics' => '1', 'technician' => $req->updated_by]);
                    }


                    elseif($req->request_action == "save_to_estimate"){
                      // Insert new
                    $estRec = Estimate::insert(['estimate_id' => $this->estimate_id, 'opportunity_id' => $this->post_id, 'email' => $userInfo[0]->email, 'telephone' => $userInfo[0]->telephone, 'busID' => $req->busID, 'vehicle_licence' => $req->vehicle_licence, 'make' => $userInfo[0]->make, 'model' => $userInfo[0]->model, 'date' => $req->date, 'service_type' => $req->service_type, 'service_option' => $req->service_option, 'service_item_spec' => $req->item_spec1, 'manufacturer' => $req->manufacturer1, 'material_qty' => $req->quantity1, 'material_cost' => $req->material_cost1, 'labour_cost' => $req->labour_cost1, 'material_qty2' => $req->quantity2, 'material_qty3' => $req->quantity3, 'material_cost2' => $req->material_cost2, 'material_cost3' => $req->material_cost3, 'labour_cost2' => $req->labour_cost2, 'labour_hour' => $req->labour_hour1, 'labour_rate' => $req->labour_rate1, 'manufacturer2' => $req->manufacturer2, 'manufacturer3' => $req->manufacturer3, 'service_item_spec2' => $req->item_spec2, 'service_item_spec3' => $req->item_spec3, 'other_cost' => $req->other_cost, 'total_cost' => $req->total_cost, 'service_note' => $req->service_note, 'mileage' => $req->mileage, 'file' => $fileNameToStore, 'update_by' => $req->updated_by, 'estimate' => '1', 'work_order' => '0', 'diagnostics' => '0', 'technician' => $req->updated_by]);
                    }


                    elseif($req->request_action == "save_to_workorder"){
                      // Insert new
                    $estRec = Estimate::insert(['estimate_id' => $this->estimate_id, 'opportunity_id' => $this->post_id, 'email' => $userInfo[0]->email, 'telephone' => $userInfo[0]->telephone, 'busID' => $req->busID, 'vehicle_licence' => $req->vehicle_licence, 'make' => $userInfo[0]->make, 'model' => $userInfo[0]->model, 'date' => $req->date, 'service_type' => $req->service_type, 'service_option' => $req->service_option, 'service_item_spec' => $req->item_spec1, 'manufacturer' => $req->manufacturer1, 'material_qty' => $req->quantity1, 'material_cost' => $req->material_cost1, 'labour_cost' => $req->labour_cost1, 'material_qty2' => $req->quantity2, 'material_qty3' => $req->quantity3, 'material_cost2' => $req->material_cost2, 'material_cost3' => $req->material_cost3, 'labour_cost2' => $req->labour_cost2, 'labour_hour' => $req->labour_hour1, 'labour_rate' => $req->labour_rate1, 'manufacturer2' => $req->manufacturer2, 'manufacturer3' => $req->manufacturer3, 'service_item_spec2' => $req->item_spec2, 'service_item_spec3' => $req->item_spec3, 'other_cost' => $req->other_cost, 'total_cost' => $req->total_cost, 'service_note' => $req->service_note, 'mileage' => $req->mileage, 'file' => $fileNameToStore, 'update_by' => $req->updated_by, 'estimate' => '0', 'work_order' => '1', 'diagnostics' => '0', 'technician' => $req->updated_by]);
                    }


                    else{

                      // Insert new
                      $estRec = Estimate::insert(['estimate_id' => $this->estimate_id, 'opportunity_id' => $this->post_id, 'email' => $userInfo[0]->email, 'telephone' => $userInfo[0]->telephone, 'busID' => $req->busID, 'vehicle_licence' => $req->vehicle_licence, 'make' => $userInfo[0]->make, 'model' => $userInfo[0]->model, 'date' => $req->date, 'service_type' => $req->service_type, 'service_option' => $req->service_option, 'service_item_spec' => $req->item_spec1, 'manufacturer' => $req->manufacturer1, 'material_qty' => $req->quantity1, 'material_cost' => $req->material_cost1, 'labour_cost' => $req->labour_cost1, 'material_qty2' => $req->quantity2, 'material_qty3' => $req->quantity3, 'material_cost2' => $req->material_cost2, 'material_cost3' => $req->material_cost3, 'labour_cost2' => $req->labour_cost2, 'labour_hour' => $req->labour_hour1, 'labour_rate' => $req->labour_rate1, 'manufacturer2' => $req->manufacturer2, 'manufacturer3' => $req->manufacturer3, 'service_item_spec2' => $req->item_spec2, 'service_item_spec3' => $req->item_spec3, 'other_cost' => $req->other_cost, 'total_cost' => $req->total_cost, 'service_note' => $req->service_note, 'mileage' => $req->mileage, 'file' => $fileNameToStore, 'update_by' => $req->updated_by, 'estimate' => '1', 'work_order' => '0', 'diagnostics' => '0', 'technician' => $req->updated_by]);

                    }


                    if($estRec == true){
                      $resData = ['data' => $estRec, 'message' => 'success', 'status' => 200];
                      $status = 200;
                    }
                    else{
                      $resData = ['data' => [], 'message' => "Something went wrong", 'status' => 400];
                      $status = 400;
                    }



              }
              else{
                $resData = ['data' => [], 'message' => "Kindly register this vehicle before you can prepare estimate", 'status' => 400];
                $status = 400;
              }



      }


      return $this->returnJSON($resData, $status);
    }


    public function returnJSON($data, $status){
        return response($data, $status)->header('Content-Type', 'application/json');
    }
}
