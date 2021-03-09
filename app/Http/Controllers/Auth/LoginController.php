<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\User as User;

class LoginController extends Controller
{

    public $getIp;
    public $getLocation;

    public $arr_ip;
    public $country;
    public $continent;

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'userDashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        $this->getIp = $_SERVER['REMOTE_ADDR'];

        $this->arr_ip = geoip()->getLocation($this->getIp);
        // $this->arr_ip = geoip()->getLocation('154.120.86.96');
        // $this->arr_ip = geoip()->getLocation('206.189.30.235');
        // $this->arr_ip = geoip()->getLocation('165.227.36.202');
        // $this->arr_ip = geoip()->getLocation('64.235.204.107');

        $this->country = $this->arr_ip['country'];
        $this->continent = $this->arr_ip['continent'];

        $this->username = $this->findUsername();

        // dd($this->arr_ip);

    }


    public function findUsername(){
        $email = request()->input('email');

        $this->logTrial($email, $this->arr_ip['lon'], $this->arr_ip['lat']);

    }


    public function logTrial($email, $lon, $lat){


        $getUser = User::where('email', $email)->get();

        if(count($getUser) > 0){
            $times = $getUser[0]->login_times + 1;

            $trial_expire = date("Y-m-d", strtotime("+30 days"));

            if($getUser[0]->login_times > 0){
                User::where('email', $email)->update(['login_times' => $times, 'lon' => $lon, 'lat' => $lat]);
            }
            else{
                User::where('email', $email)->update(['login_times' => $times, 'free_trial_expire' => $trial_expire, 'lon' => $lon, 'lat' => $lat]);
            }
        }
        else{


            $response = 'error';
            $message = 'Your credentials do not match our records!';
            

            return redirect()->back()->with($response, $message);
        }


        

    }

}
