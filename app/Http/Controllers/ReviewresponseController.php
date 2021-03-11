<?php

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

use App\Activity as Activity;

use App\Review as Review;


use App\ReplyRating as ReplyRating;


class ReviewresponseController extends Controller
{
    public function reviewResponse(Request $req){

        if(Auth::check() == true){
            $route = 'userDashboard';

        }
        else{
            $route = 'Admin/stationreviews';
        }


        $checkExist = Review::where('post_id', $req->post_message_id)->get();

        if(count($checkExist) > 0){
            
            // Insert
            ReplyRating::insert(['post_id' => $req->post_message_id, 'reply' => $req->review_reply, 'ref_code' => Auth::user()->ref_code]);

            

            // Send Mail
            $getUser = User::where('ref_code', $checkExist[0]->ref_code)->get();

            // Get Information


            $this->to = $getUser[0]->email;
            $this->name = $getUser[0]->name;
            $this->subject = "Service review";
            $this->message = $req->review_reply;
            $this->file = NULL;

            $this->sendEmail($this->to, "Compose Mail");

            $message = 'success';
            $response = 'Sent successfully!';

        }
        else{
            $message = 'error';
            $response = 'Something went wrong!';
        }

        return redirect($route)->with($message, $response);
    }

}
