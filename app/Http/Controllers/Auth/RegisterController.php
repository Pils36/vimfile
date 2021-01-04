<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Business as Business;
use App\Carrecord as Carrecord;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

        public $getIp;
        public $getLocation;

        public $arr_ip;

        public $country;
        public $continent; 
        public $status;
        public $market_place;
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = 'userDashboard';

   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // dd(request());
        $this->middleware('guest');

        $this->getIp = $_SERVER['REMOTE_ADDR'];

        $this->arr_ip = geoip()->getLocation($this->getIp);

        $this->country = $this->arr_ip['country'];
        $this->continent = $this->arr_ip['continent'];
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'phone_number' => ['required'],
            'state' => ['required'],
            'country' => ['required'],
            'zipcode' => ['required'],
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $request = request();

        if($request->userType == 'Commercial' && $request->plan != "Free"){
            $this->status = 2;
            $this->market_place = implode(',', $request->market_place);
        }
        elseif($request->userType == 'Commercial' && $request->plan == "Free"){
            $this->status = 1;
            $this->market_place = implode(',', $request->market_place);
        }
        else{
            $this->status = 1;
            $this->market_place = "";
        }

        $user  = User::create([
            'name' => $data['firstname'].' '.$data['lastname'],
            'userType' => $request->userType,
            'phone_number'=> $data['phone_number'],
            'city' => $request->city,
            'email' => $data['email'],
            'state' => $data['state'],
            'country' => $data['country'],
            'zipcode' => $data['zipcode'],
            'maiden_name' => $request->maiden_name,
            'parent_meet' => $request->parent_meet,
            'plan' => $request->plan,
            'password' => Hash::make($data['password']),
            'status' => $this->status,
            'market_place' => $this->market_place,
            'referred_by' => $request->referred_by,
            'know_about' => $request->know_about
        ]);

        if($user){
            if($request->userType == "Individual" || $request->userType == "Business" || $request->userType == "Commercial" || $request->userType == "Auto Dealer"){

                // Redirect to SOAR
                // dd($getUser);
                header('Location: https://soar.vimfile.com/login');
                exit;
            }
            else{

                // REDIRECT TO BW
                    // header('Location: https://busywrench.vimfile.com/login');
                    // exit;
                    header('Location: https://busywrench.vimfile.com/login');
                    exit;
            }
        }

        


        

        
    }
}
