<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// USER ROUTE
Route::group(['prefix' => 'user'], function(){

	Route::post('login', 'api\v1\LoginController@login');
	Route::post('register', 'api\v1\RegisterController@register');
	Route::post('avatar', 'api\v1\RegisterController@avatarUpload');
	Route::middleware('auth:api')->get('all', 'api\v1\UserController@index');
	Route::get('accountType', 'api\v1\UserController@accountType');
	Route::post('redeempoint', 'api\v1\UserController@redeempoint');
	Route::post('openticket', 'api\v1\UserController@openticket');
	Route::post('opportunitypost', 'api\v1\UserController@opportunitypost');
	Route::post('passwordchange', 'api\v1\UserController@passwordchange');
	Route::get('achievement/{email}', 'api\v1\UserController@myachievement');
	Route::get('allachievement', 'api\v1\UserController@allachievement');
	Route::post('weeklyranking', 'api\v1\UserController@weeklyranking');
	Route::post('alltimeranking', 'api\v1\UserController@alltimeranking');
	Route::post('globalranking', 'api\v1\UserController@globalranking');
	Route::post('subscriptionplan', 'api\v1\UserController@subscriptionplan');
	Route::post('stations', 'api\v1\UserController@stations');
	Route::post('staffs', 'api\v1\UserController@staffs');
	Route::post('opportunitypostlist', 'api\v1\UserController@opportunitypostlist');
	Route::post('reviewpost', 'api\v1\UserController@reviewpost');
	Route::post('replyreview', 'api\v1\UserController@replyreview');
	Route::post('connections', 'api\v1\UserController@connections');
	Route::post('deactivate', 'api\v1\UserController@deactivate');
	Route::post('questionforexperts', 'api\v1\UserController@questionforexperts');
	Route::post('answerfromexpert', 'api\v1\UserController@answerfromexpert');
	Route::post('askexpertquestions', 'api\v1\UserController@askexpertquestions');
	Route::post('answerexpertquestions', 'api\v1\UserController@answerexpertquestions');
	Route::post('mystations', 'api\v1\UserController@mystations');
	Route::post('createstaff', 'api\v1\UserController@createstaff');
	Route::post('createstation', 'api\v1\UserController@createstation');

	Route::post('editprofile/{id}', 'api\v1\UserController@editProfile');


});





// VEHICLE ROUTE
Route::group(['prefix' => 'vehicle'], function(){
	Route::post('newvehicle', 'api\v1\VehicleController@vehicleregistration');
	Route::post('updatevehicle', 'api\v1\VehicleController@updatevehicle');
	Route::post('vehicleupload', 'api\v1\VehicleController@uploadvehicleImage');
	Route::post('maintenancerecord', 'api\v1\VehicleController@maintenancerecord');
	Route::post('maintenancerecordlist', 'api\v1\VehicleController@maintenancerecordlist');
	Route::post('carrecord', 'api\v1\VehicleController@mycarrecord');
	Route::get('mycarrecord/{email}', 'api\v1\VehicleController@usercarrecord');
	Route::post('request_by', 'api\v1\VehicleController@myRequestBy');
	Route::get('performance', 'api\v1\VehicleController@myperformance');
	Route::post('workorderlist', 'api\v1\VehicleController@workorderlist');
	Route::post('diagnosticlist', 'api\v1\VehicleController@diagnosticlist');
	Route::post('ongoingmaintenance', 'api\v1\VehicleController@ongoingmaintenance');
	Route::post('updateongoingmaintenance', 'api\v1\VehicleController@updateongoingmaintenance');
	Route::post('receivedquotations', 'api\v1\VehicleController@receivedquotations');
	Route::post('jobsdone', 'api\v1\VehicleController@jobsdone');
	Route::post('additionalemail', 'api\v1\VehicleController@additionalemail');
	Route::post('remindersettings', 'api\v1\VehicleController@remindersettings');
	Route::post('getreminder', 'api\v1\VehicleController@getremindersettings');
	Route::post('movetodiagnostic', 'api\v1\VehicleController@movetodiagnostic');
	Route::post('proceedtoworkorder', 'api\v1\VehicleController@proceedtoworkorder');

	Route::get('listrecord/{email}', 'api\v1\VehicleController@recordListing');


});



// MECHANICS INFO
Route::group(['prefix' => 'mechanics'], function(){
	Route::get('nearby', 'api\v1\VehicleController@getnearby');
	Route::get('search', 'api\v1\VehicleController@getmechanicbyCity');
});




// OTP
Route::group(['prefix' => 'otp'], function(){
	Route::post('validate', 'api\v1\RegisterController@validateotp');
	Route::post('resend', 'api\v1\RegisterController@resendotp');
});



// APPOINTMENT
Route::group(['prefix' => 'appointment'], function(){
	Route::post('booking', 'api\v1\AppointmentController@bookAppointment');
	// Route::middleware('auth:api')->post('booking', 'api\v1\AppointmentController@bookAppointment');
	Route::get('list', 'api\v1\AppointmentController@appointmentList');
});




// ESTIMATES
Route::group(['prefix' => 'estimate'], function(){
	Route::post('request', 'api\v1\EstimateController@requestEstimate');
	Route::get('list', 'api\v1\EstimateController@listEstimate');

	Route::post('additionalpart', 'api\v1\EstimateController@additionalpart');
	Route::post('prepareestimate', 'api\v1\EstimateController@prepareestimate');
});

// MESSAGES
Route::group(['prefix' => 'message'], function(){
	Route::post('create', 'api\v1\UserController@createMessage');
	Route::get('listing/{email}', 'api\v1\UserController@listMessage');
});

