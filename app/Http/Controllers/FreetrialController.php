<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
//Mail

use App\Mail\sendEmail;

use App\GetFreeTrial as GetFreeTrial;

class FreetrialController extends Controller
{
    public function submission(Request $req, GetFreeTrial $getfreetrial){

        $useragent=$_SERVER['HTTP_USER_AGENT'];

        // Update or Insert
        $getfreetrial->updateOrInsert(['email' => $req->email], $req->all());

        // Send Mail to info@vimfile.com

        $this->to = "info@vimfile.com";
        
        $this->name = "VIMFile Admin";

        $this->subject = "Marketing Services Team";
        $this->message = "<p>You received a lead from your Website!</p><p>Do not reply to this email. If you have any questions or concerns, please contact our client success team. </p><p>Submitted Form Data</p><p>Full Name*:	".$req->name."</p><p>Work Email*:	".$req->email."</p><p>Phone Number *:	".$req->phone."</p><p>Country*:	".$req->country."</p><p>utm_source:	".$req->utm_source."</p><p>category:	".$req->category."</p><p>Page: Vimfile | Busy Wrench | Auto Repair</p><p>Variation: Variation A</p><p>Device: ".substr($useragent,0,7)."</p>";

        $this->file = NULL;

        $this->sendEmail($this->to, "Compose Mail");


        // Return Redirect to Register
        return redirect()->route('register');

    }
}
