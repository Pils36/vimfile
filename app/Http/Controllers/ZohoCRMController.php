<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZohoCRMController extends Controller
{
    
    // Do Curl
    public function doInset($auth, $xml){
    	// Setup CURL
    	$curl_url = "https://crm.zoho.com/crm/private/xml/Leads/insertRecords?";
    	$curl_post_fields = "authtoken=".$auth."&scope=crmapi&xmlData=".$xml;
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $curl_url);
    	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_fields);
    }
}
