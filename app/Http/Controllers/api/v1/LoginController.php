<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\User as User;

class LoginController extends Controller
{

    public $getIp;
    public $getLocation;

    public $arr_ip;
    public $country;
    public $continent;


    public function __construct(Request $request)
    {

        $this->getIp = $_SERVER['REMOTE_ADDR'];

        $this->arr_ip = geoip()->getLocation($this->getIp);
        // $this->arr_ip = geoip()->getLocation('154.120.86.96');
        // $this->arr_ip = geoip()->getLocation('206.189.30.235');
        // $this->arr_ip = geoip()->getLocation('165.227.36.202');
        // $this->arr_ip = geoip()->getLocation('64.235.204.107');

        $this->country = $this->arr_ip['country'];
        $this->continent = $this->arr_ip['continent'];

        // dd($this->arr_ip);

    }


    public function login(Request $request){


        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'

        ]);

        if(!Auth::attempt($login)){
            $resData = ['message' => 'Invalid login credential', 'status' => 200];
            $status = 200;
            return $this->returnJSON($resData, $status);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        $letter = chr(rand(65,90));
        $ref_code = $letter.mt_rand(1000, 9999);

        $checking = User::select('id', 'ref_code', 'name', 'email', 'userType', 'phone_number', 'address', 'city', 'state', 'country', 'lon', 'lat', 'zipcode', 'email1', 'email2', 'email3', 'plan', 'specialization', 'avatar as imageUrl')->where('email', $request->email)->get();

        if(count($checking) > 0 && $checking[0]->ref_code != null){

            $ref = User::where('email', $request->email)->update(['ref_code' => $checking[0]->ref_code]);

        }
        else{
            $ref = User::where('email', $request->email)->update(['ref_code' => $ref_code]);
        }



        $this->logTrial($request->email, $this->arr_ip['lon'], $this->arr_ip['lat']);
        

        $resData = ['data' => $checking, 'access_token' => $accessToken, 'status' => 200, 'message' => 'success', 'action' => 'login'];
        $status = 200;
        



        return $this->returnJSON($resData, $status);
    }


    public function returnJSON($data, $status){
        return response($data, $status)->header('Content-Type', 'application/json');
    }


    public function logTrial($email, $lon, $lat){


        $getUser = User::where('email', $email)->get();

        $times = $getUser[0]->login_times + 1;

        $trial_expire = date("Y-m-d", strtotime("+30 days"));

        if($getUser[0]->login_times > 0){
            User::where('email', $email)->update(['login_times' => $times, 'lon' => $lon, 'lat' => $lat]);
        }
        else{
            User::where('email', $email)->update(['login_times' => $times, 'free_trial_expire' => $trial_expire, 'lon' => $lon, 'lat' => $lat]);
        }

    }
}
