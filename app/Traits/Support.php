<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

use Session;

use App\User as User;
use App\Admin as Admin;
use App\PayPlan as PayPlan;



trait Support{

    public function agentdetails($userID){

        $getAdgent = Admin::where('userID', $userID)->get();

        return $getAdgent;
    }




}