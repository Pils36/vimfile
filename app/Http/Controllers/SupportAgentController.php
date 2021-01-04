<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\RedirectResponse;

use Illuminate\Routing\Redirector;

use Session;

use App\User as User;

use App\Admin as Admin;

use App\WorkFlow as WorkFlow;

use App\PromotionalMaterial as PromotionalMaterial;

use App\Traits\Support;

class SupportAgentController extends Controller
{

    use Support;

    public function agreementTemplate(){

        // Get Agent Details
        $data = array(
            'agentdetails' => $this->agentdetails(session('userID'))
        );


        return view('admin.pages.supportagent.agreement')->with(['data' => $data]);
    }

    public function signagreement(Request $req, $id){

        Admin::where('id', $id)->update(['signed_agreement' => 1]);

        return redirect()->back()->with('success', 'Signed');
    }


}
