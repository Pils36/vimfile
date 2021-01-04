<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Hash;

//Mail

use App\Mail\sendEmail;

use App\Admin as Admin;
use App\User as User;

class PasswordResetController extends Controller
{


    public function index(){

        return view('admin.passwordreset');
    }


    public function adminpasswordreset(Request $req){

        // Check user email
        $email = Admin::where('email', $req->email)->get();

        if(count($email) > 0){

            $this->to = $req->email;
            // $this->to = "bambo@vimfile.com";
            $this->sender = 'info@vimfile.com';
            $this->subject = 'Password Reset';
            $this->message = 'Hi, <br><br> Kindly click on the link below to reset your password <br> https://vimfile.com/reset/newpassword/'.$email[0]->userID;

            $this->sendEmail($this->to, 'VIM File - New Message');

            return redirect()->back()->with('success', 'Reset password link sent to your mail');
        }
        else{
            return redirect()->back()->with('error', 'Email address does not exist');
        }

        
    }


    public function adminpasswordresetnew(Request $req, $userid){
        // Reset Password
        $check = Admin::where('userID', $userid)->get();

        if(count($check) > 0){

            return view('admin.passwordresetnew')->with(['data' => $userid]);
        }
        else{
            return redirect('reset/mypassword')->with('error', 'Invalid username');
        }
        
    }
    
    
    public function changepassword(Request $req){
        // Reset Password
        $check = Admin::where('userID', $req->userid)->get();

        if(count($check) > 0){

            Admin::where('userID', $req->userid)->update(['password' => Hash::make($req->newpassword)]);
            User::where('email', $check[0]->email)->update(['password' => Hash::make($req->newpassword)]);

            return redirect('AdminLogin')->with('success', 'Password updated. Login to account');
        }
        else{
            return redirect('reset/mypassword')->with('error', 'Unable to update password!');
        }
        
    }



}
