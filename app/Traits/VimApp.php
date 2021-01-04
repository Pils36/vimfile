<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

use Session;

use App\User as User;
use App\Admin as Admin;
use App\PayPlan as PayPlan;

use App\WorkFlow as WorkFlow;
use App\PromotionalMaterial as PromotionalMaterial;


trait VimApp{

    public function getfreePlan(){

        $getFree = Admin::where('plan', 'Start Up')->orderBy('created_at', 'DESC')->get();

        return $getFree;
    }

    public function getfreePlancount(){

        $getFree = Admin::where('plan', 'Start Up')->orderBy('created_at', 'DESC')->count();

        return $getFree;
    }


    public function getFreetrial(){

        $today = date("Y-m-d");

        $getFree = Admin::where('free_trial_expire', '!=', null)->where('free_trial_expire', '>', $today)->orderBy('created_at', 'DESC')->get();

        return $getFree;
    }

    public function getFreetrialcount(){

        $today = date("Y-m-d");

        $getFree = Admin::where('free_trial_expire', '!=', null)->where('free_trial_expire', '>', $today)->orderBy('created_at', 'DESC')->count();

        return $getFree;
    }

    public function getPaidPlan(){
        $today = date("Y-m-d");
        // Join user and payplan
        $getPlans = DB::table('payment_plan')
        ->join('users', 'users.email', '=', 'payment_plan.email')
        ->where('payment_plan.payment_status', '!=', 'not paid')
        ->orderBy('payment_plan.created_at', 'DESC')->get();

        return $getPlans;
    }
    public function getPaidPlancount(){
        $today = date("Y-m-d");
        // Join user and payplan
        $getPlans = DB::table('payment_plan')
        ->join('users', 'users.email', '=', 'payment_plan.email')
        ->where('payment_plan.payment_status', '!=', 'not paid')
        ->orderBy('payment_plan.created_at', 'DESC')->count();

        return $getPlans;
    }


    public function promotionView($category){
        $data = PromotionalMaterial::where('category', $category)->get();

        return $data;
    }


    public function workflowView($category){
        $data = WorkFlow::where('category', $category)->get();

        return $data;
    }


    public function getWorkflowcount(){
        $A = WorkFlow::where('category', 'Portal Resource')->count();
        $B = WorkFlow::where('category', 'Engaging Mechanics')->count();
        $C = WorkFlow::where('category', 'More Resource')->count();

        $data = array(
            'portal_res' => $A,
            'engaging_mechs' => $B,
            'more_res' => $C,
        );

        return $data;
    }

}