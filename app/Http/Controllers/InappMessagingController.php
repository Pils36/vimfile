<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;

use Illuminate\Routing\Redirector;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;

use App\Mail\sendEmail;

use App\User as User;

use App\Admin as Admin;

use App\Message as Message;

use App\SuggestedMechanics as SuggestedMechanics;

use App\Business as Business;

class InappMessagingController extends Controller
{


    public function composemessage(Request $req){

        $fileToStore = "";
        if($req->file('attachment') && count($req->file('attachment')) > 0)
        {

            $i = 0;
            foreach($req->file('attachment') as $key => $value){
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
                // $path = $value->storeAs('public/composemail', $manageNameToStore);

                // $path = $value->move(public_path('/composemail/'), $manageNameToStore);

                $path = $value->move(public_path('../../composemail/'), $manageNameToStore);
            }

            $filerec = explode(",", $fileToStore);

            $file = $filerec[0];

        }
        else
        {
            $fileToStore = NULL;
            $file = NULL;
        }

        $getReceiver = User::where('email', $req->sent_to)->get();

        if(count($getReceiver) > 0){
            $receiver_id = $getReceiver[0]->busID;
            $name = $getReceiver[0]->name;
        }
        else{
            $receiver_id = $req->sent_to;
            $name = "from VIMfile";
        }


        if($req->action == "send"){
            $sent = 1;
            $draft = 0;

            $ins = Message::insert(['sent_to' => $req->sent_to, 'subject' => $req->subject, 'message' => $req->message, 'file' => $fileToStore, 'msg_sent' => $sent, 'receiver_id' => $receiver_id, 'sender_id' => session('busID'), 'msg_draft' => $draft]);

            if($ins == true){
            $response = "success";
            $message = "Message sent!";

                $this->mailprocess($req->sent_to, $name, $req->subject, $req->message, $file);

            }
            else{
                $response = "warning";
                $message = "Something went wrong!";
            }

            return redirect()->back()->with($response, $message);

        }
        elseif($req->action == "draft"){
            $sent = 0;
            $draft = 1;

            $ins = Message::insert(['sent_to' => $req->sent_to, 'subject' => $req->subject, 'message' => $req->message, 'file' => $fileToStore, 'msg_sent' => $sent, 'receiver_id' => $receiver_id, 'sender_id' => Auth::user()->ref_code, 'msg_draft' => $draft]);

            return redirect('/Admin/drafts');

        }
        // Insert Record



    }

    public function mailprocess($email, $name, $subject, $message, $file){

    	$this->to = $email;
    	// $this->to = "bambo@vimfile.com";
        $this->name = $name;
        $this->subject = $subject;
        $this->message = $message." <hr><br> Kindly <a href='https://soar.vimfile.com/login'>login to your account now</a> to read and reply to the message <br><br> Thanks";
        $this->file = $file;

        $this->sendEmail($this->to, "Compose Mail");

        // return "Sent!";
    }


    // Unsubscribe Mail

    // public function unsubscribe($action){
    //     if($action == "claimbusiness"){
    //         // Remove from Business and User and Suggested Mechanics
    //     }
    //     else{

    //     }
    // } 


}
