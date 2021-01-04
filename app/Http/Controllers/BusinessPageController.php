<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User as User;
use App\Business as Business;
use App\Review as Review;
use App\Admin as Admin;

class BusinessPageController extends Controller
{

    public function __construct(Request $request)
    {

        $this->middleware('auth')->except(['updatephoto', 'serviceoffered']);
    }

    

    public function businesspage(Request $req){

        $email = Auth::user()->email;

        $userDetails = User::where('email', $email)->get();
        $station = Business::where('email', $email)->get();

        $stationreviews = Review::where('station_name', $userDetails[0]->station_name)->get();

        $profileDetails = array_merge($userDetails->toArray(), $station->toArray());

        $getbusInfo = Business::where('busID', $userDetails[0]->busID)->get();


        return view('pages.businesspage')->with(['page' => 'Business Profile', 'profileDetails' => $profileDetails, 'stationreviews' => $stationreviews, 'busInfo' => $getbusInfo]);

    }

    public function ajaxupdatebusinessLogo(Request $req){
        // Update logo
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
            // $path = $req->file('file')->storeAs('public/company_logo', $fileNameToStore);

            // $path = $req->file('file')->move(public_path('/company_logo/'), $fileNameToStore);

            $path = $req->file('file')->move(public_path('../../company_logo/'), $fileNameToStore);


        }
        else
        {
            $fileNameToStore = 'noImage.png';
        }

        // Update Info
        $updt = User::where('email', $req->email)->update(['businesslogo' => $fileNameToStore]);

        if($updt){
            $resData = ['message' => 'success'];
        }
        else{
            $resData = ['message' => 'error'];
        }

        return $this->returnJSON($resData);
    }


    public function updatephoto(Request $req){

        $checkfile = Business::where('busID', $req->busID)->get();
        $checkphotos = User::where('busID', $req->busID)->get();

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
            User::where('busID', $req->busID)->update(['businesslogo' => $logoNameToStore]);
            Business::where('busID', $req->busID)->update(['file2' => $logoNameToStore]);
        }
        else
        {

            if($checkfile[0]->file2 != ""){
                $logoNameToStore = $checkfile[0]->file2;
            }
            else{
                $logoNameToStore = 'noImage.png';
            }

            User::where('busID', $req->busID)->update(['businesslogo' => $logoNameToStore]);
            Business::where('busID', $req->busID)->update(['file2' => $logoNameToStore]);

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
                User::where('busID', $req->busID)->update(['photo_video' => $fileToStore]);

        }
        else
        {

            if($checkphotos[0]->photo_video != ""){
                $fileToStore = $checkphotos[0]->photo_video;
            }
            else{
                $fileToStore = 'noImage.png';
            }

            User::where('busID', $req->busID)->update(['photo_video' => $fileToStore]);
        }


        return redirect()->back()->with('success', 'Photos Uploaded!');

    }


    public function serviceoffered(Request $req){

        // Get User
        $getUser = User::where('email', $req->email)->get();

        $service = "";
        $prevservice = "";
        if(count($req->service_offered) > 1){
            foreach($req->service_offered as $key => $value){
                $service .= $value.", ";
            }
        }
        else{
            $service = $req->service_offered;
        }
        

        if($req->addto == "1"){
            $prevservice = $getUser[0]->service_offered."".$service;
        }
        else{
            $prevservice = $service;
        }

        $updt = User::where('busID', $req->busID)->update(['service_offered' => $prevservice]);


        return redirect()->back()->with('success', 'Update Successful!');

    }


    // JSON Response
 	public function returnJSON($data){
        return response()->json($data);
    }

}
