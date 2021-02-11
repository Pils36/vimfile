<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
	Vehicle Inspection and Maintenance Pro-Filr
	 By: Adenuga Adebambo [- Pils36 -]
	 Created: Monday 12 - 08 - 2019

	 Time: 08:00AM
*/


// Application LOGS
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('caa/migratedata', ['uses' => 'CAAController@index', 'as' => 'migratedata']);
Route::get('admin/pdf/claimbusiness', ['uses' => 'HomeController@checkbusiness', 'as' => 'checkbusiness']);
Route::get('startup', ['uses' => 'HomeController@startup', 'as' => 'Startup']);
Route::get('promo_1', ['uses' => 'HomeController@promo_1', 'as' => 'Promo1']);
Route::get('promo_2', ['uses' => 'HomeController@promo_2', 'as' => 'Promo2']);
Route::get('/', ['uses' => 'HomeController@index', 'as' => 'Home']);
Route::get('About', ['uses' => 'HomeController@about', 'as' => 'About']);
Route::get('Features', ['uses' => 'HomeController@features', 'as' => 'Features']);
Route::get('Contact', ['uses' => 'HomeController@contact', 'as' => 'Contact']);
Route::get('webform', ['uses' => 'HomeController@webForm', 'as' => 'Webform']);
Route::get('Privacy', ['uses' => 'HomeController@privacy', 'as' => 'Privacy']);
Route::get('Terms', ['uses' => 'HomeController@terms', 'as' => 'Terms']);
Route::get('pricing', ['uses' => 'HomeController@pricing', 'as' => 'Pricing']);
Route::get('Autocares', ['uses' => 'HomeController@autocares', 'as' => 'Autocares']);
Route::get('Drivers', ['uses' => 'HomeController@drivers', 'as' => 'Drivers']);
Route::get('Businesses', ['uses' => 'HomeController@businesses', 'as' => 'Businesses']);
Route::get('Signupfree', ['uses' => 'HomeController@signupfree', 'as' => 'Signupfree']);
Route::get('Newsandhapenings', ['uses' => 'HomeController@newsandhapenings', 'as' => 'News and hapenings']);
Route::get('notifications', ['uses' => 'HomeController@notification', 'as' => 'Notifications']);
Route::get('newshappeningspost/{id}', ['uses' => 'HomeController@newshappeningspost', 'as' => 'News Happening Post']);


Route::get('claimbusiness', ['uses' => 'HomeController@claimbusiness', 'as' => 'claimbusiness']);

Route::get('businesspage', ['uses' => 'BusinessPageController@businesspage', 'as' => 'businesspage']);

Route::get('profileupdate/{key}', ['uses' => 'HomeController@profileupdate', 'as' => 'profileupdate']);

Route::get('Prices', ['uses' => 'HomeController@prices', 'as' => 'Prices']);

Route::get('askexpert', ['uses' => 'HomeController@askExpert', 'as' => 'AskExpert']);

Route::get('answerPost/{key}', ['uses' => 'HomeController@answerPost', 'as' => 'AnswerPost']);

Route::get('ranking', ['uses' => 'HomeController@ranking', 'as' => 'Ranking']);

Route::get('allquestions', ['uses' => 'HomeController@allQuestions', 'as' => 'allQuestions']);

// Redeem Points
Route::get('Redeem', ['uses' => 'HomeController@redeem', 'as' => 'Redeem']);

Route::get('SmartDrivers', ['uses' => 'HomeController@smartdriver', 'as' => 'SmartDrivers']);
Route::get('openticket', ['uses' => 'HomeController@openticket', 'as' => 'Openticket']);
Route::get('Opennewticket', ['uses' => 'HomeController@opennewticket', 'as' => 'Opennewticket']);
Route::get('Supportticket', ['uses' => 'HomeController@supportticket', 'as' => 'Supportticket']);

// Reset Password Routes
Route::get('ResetsPassword', ['uses' => 'HomeController@resetspassword', 'as' => 'ResetsPassword']);
Route::get('ResetPassword/{key}', ['uses' => 'HomeController@resetpassword', 'as' => 'ResetPassword']);
Route::get('MonitorRecord/{key}', ['uses' => 'HomeController@monitorecord', 'as' => 'MonitorRecord']);
Route::get('MonitoruserRecord/{key}', ['uses' => 'HomeController@monitoruserecord', 'as' => 'MonitoruserRecord']);
Route::get('Review/{key}', ['uses' => 'HomeController@review', 'as' => 'Review']);
Route::get('techniciandetail/{key}', ['uses' => 'HomeController@techniciandetail', 'as' => 'techniciandetail']);

Route::get('checkbooking/{key}', ['uses' => 'HomeController@checkbooking', 'as' => 'checkbooking']);

// Moneris API
Route::get('monerisconnect', ['uses' => 'MonerisController@index', 'as' => 'monerisconnect']);
Route::get('purchase', ['uses' => 'MonerisController@purchase', 'as' => 'purchase']);

// Web Scrapping
Route::get('Test', ['uses' => 'WebScrapper@scrape', 'as' => 'Test']);

// Long and Lat Test
Route::get('longlat', ['uses' => 'WebScrapper@getAddressinfo', 'as' => 'longlat']);





// In-store APPS
Route::get('monerispayinstore/{id}', ['uses' => 'HomeController@monerispaymentinstore', 'as' => 'Monerispayinstore']);

Route::get('paypalpayinstore/{id}', ['uses' => 'HomeController@paypalpayinstore', 'as' => 'Paypalpayinstore']);



// Data Run Migrates

Route::get('migrate', ['uses' => 'HomeController@migrate', 'as' => 'migrate']);


Auth::routes();

// Route::get('/google', 'HomeController@redirectToProvider', 'redirect');
// Route::get('/google', ['uses' => 'HomeController@redirectToProvider', 'as' => 'redirect']);
// Route::get('/google/oauth', ['uses' => 'HomeController@handleProviderCallback', 'as' => 'callback']);
// Route::get('/google/oauth', 'HomeController@handleProviderCallback', 'callback');

Route::get('/google', ['uses' => 'HomeController@oauth', 'as' => 'main.app.oauth']);
Route::get('/google/oauth', ['uses' => 'HomeController@googlecontact', 'as' => 'main.app.oauth.list']);


Route::get('Signup', ['uses' => 'HomeController@index', 'as' => 'Signup']);
Route::get('Login', ['uses' => 'HomeController@index', 'as' => 'Login']);
Route::get('userDashboard', ['uses' => 'HomeController@userDashboard', 'as' => 'userDashboard']);

Route::get('Search/{key}', ['uses' => 'HomeController@search', 'as' => 'Search']);

Route::get('Search2/{key}', ['uses' => 'HomeController@promosearch2', 'as' => 'Search2']);

Route::get('Advancesearch/{key}', ['uses' => 'HomeController@advancesearch', 'as' => 'Advancesearch']);

Route::get('Estimatedetail/{id}', ['uses' => 'HomeController@estimatedetail', 'as' => 'EstimateDetail']);

Route::get('monerispay/{id}', ['uses' => 'HomeController@monerispayment', 'as' => 'Monerispay']);

Route::get('paypalpay/{id}', ['uses' => 'HomeController@paypalpay', 'as' => 'Paypalpay']);


Route::get('proposalestimate/{id}', ['uses' => 'HomeController@proposalestimate', 'as' => 'proposalestimate']);
Route::get('invoicereport/{id}', ['uses' => 'HomeController@invoicereport', 'as' => 'invoicereport']);
Route::get('vendpaymentreport/{id}', ['uses' => 'HomeController@vendpaymentreport', 'as' => 'vendpaymentreport']);
Route::get('vendunpaidreport/{id}', ['uses' => 'HomeController@vendunpaidreport', 'as' => 'vendunpaidreport']);
Route::get('PurchaseOrderHistory/{id}', ['uses' => 'HomeController@purchaseorderhistory', 'as' => 'PurchaseOrderHistory']);
Route::get('clientbalance/{id}', ['uses' => 'HomeController@clientbalance', 'as' => 'clientbalance']);
Route::get('labourbalance/{id}', ['uses' => 'HomeController@labourbalance', 'as' => 'labourbalance']);
Route::get('purchaseprint/{id}', ['uses' => 'HomeController@purchaseprint', 'as' => 'purchaseprint']);
Route::get('Paystubmail/{id}', ['uses' => 'HomeController@Paystubmail', 'as' => 'Paystubmail']);
Route::get('technicianreport/{id}', ['uses' => 'HomeController@technicianreport', 'as' => 'technicianreport']);
Route::get('technicianpaidreport/{id}', ['uses' => 'HomeController@technicianpaidreport', 'as' => 'technicianpaidreport']);
Route::get('cashbalance/{id}', ['uses' => 'HomeController@cashbalance', 'as' => 'cashbalance']);
Route::get('creditcardbalance/{id}', ['uses' => 'HomeController@creditcardbalance', 'as' => 'creditcardbalance']);
Route::get('bankbalance/{id}', ['uses' => 'HomeController@bankbalance', 'as' => 'bankbalance']);


// Admin Route for Super, Staffs and Business Owners


Route::get('Admin', ['uses' => 'AdminController@index', 'as' => 'Admin']);

Route::get('Admin/createdmechanics', ['uses' => 'AdminController@createdMechanics', 'as' => 'createdmechanics']);

Route::get('Pricings', ['uses' => 'AdminController@pricing', 'as' => 'Pricings']);
Route::get('AdminLogin', ['uses' => 'AdminController@login', 'as' => 'AdminLogin']);

Route::get('reset/mypassword', ['uses' => 'PasswordResetController@index', 'as' => 'adminpasswordreset']);
Route::post('adminpasswordreset', ['uses' => 'PasswordResetController@adminpasswordreset', 'as' => 'mypasswordreset']);
Route::post('changepassword', ['uses' => 'PasswordResetController@changepassword', 'as' => 'changepassword']);
Route::get('reset/newpassword/{userid}', ['uses' => 'PasswordResetController@adminpasswordresetnew', 'as' => 'newpasswordreset']);

Route::get('ReadMessage/{key}', ['uses' => 'AdminController@readmessage', 'as' => 'ReadMessage']);
Route::get('Registeredclients', ['uses' => 'AdminController@registeredclients', 'as' => 'Registeredclients']);
Route::get('Unregisteredclients', ['uses' => 'AdminController@unregisteredclients', 'as' => 'Unregisteredclients']);
Route::get('Opportunity', ['uses' => 'AdminController@opportunity', 'as' => 'Opportunity']);
Route::get('Postedestimate', ['uses' => 'AdminController@postedEstimate', 'as' => 'Postedestimate']);
Route::get('workinprogress', ['uses' => 'AdminController@workinprogress', 'as' => 'Workinprogress']);
Route::get('jobdone', ['uses' => 'AdminController@jobdone', 'as' => 'Jobdone']);
Route::get('Feedback', ['uses' => 'AdminController@Feedback', 'as' => 'Feedback']);
Route::get('Admin/stationreviews', ['uses' => 'AdminController@stationReviews', 'as' => 'stationreviews']);

Route::get('Admin/crawledautodealer', ['uses' => 'AdminController@crawledautodealer', 'as' => 'crawled autodealers']);

// Promotional Materials
Route::get('Admin/promotionalmaterials', ['uses' => 'AdminController@promotionalmaterials', 'as' => 'promotional materials']);

Route::get('Admin/uploadedmaterials', ['uses' => 'AdminController@uploadedmaterials', 'as' => 'uploaded materials']);
Route::get('Admin/editpromotionalmaterial/{id}', ['uses' => 'AdminController@editpromotionalmaterial', 'as' => 'editpromotionalmaterial']);

Route::post('Admin/promotionupload', ['uses' => 'AdminController@promotionupload', 'as' => 'promotionupload']);
Route::post('Admin/editpromotionupload/{id}', ['uses' => 'AdminController@editpromotionupload', 'as' => 'editpromotionupload']);
Route::post('Admin/deletepromotionalmaterial/{id}', ['uses' => 'AdminController@deletepromotionalmaterial', 'as' => 'deletepromotionalmaterial']);



// Workflow Upload
Route::get('Admin/workflowupload', ['uses' => 'AdminController@workflowupload', 'as' => 'workflow upload']);
Route::post('Admin/uploadworkflow', ['uses' => 'AdminController@uploadworkflow', 'as' => 'uploadworkflow']);

Route::get('Admin/uploadedworkflow', ['uses' => 'AdminController@uploadedworkflow', 'as' => 'uploaded workflow']);

Route::get('Admin/editworkflowmaterial/{id}', ['uses' => 'AdminController@editworkflowmaterial', 'as' => 'editworkflowmaterial']);

Route::post('Admin/editworkflowupload/{id}', ['uses' => 'AdminController@editworkflowupload', 'as' => 'editworkflowupload']);

Route::post('Admin/deleteworkflowmaterial/{id}', ['uses' => 'AdminController@deleteworkflowmaterial', 'as' => 'deleteworkflowmaterial']);



// Agent Materials
Route::get('Admin/promotionmaterial/{category}', ['uses' => 'AdminController@promotionmaterial', 'as' => 'promotionmaterial']);
Route::get('Admin/workflowmaterials/{category}', ['uses' => 'AdminController@workflowmaterials', 'as' => 'workflowmaterials']);

// USer List
Route::get('adminnoncommercial', ['uses' => 'AdminController@adminnoncommercial', 'as' => 'adminnoncommercial']);
Route::get('admincommercial', ['uses' => 'AdminController@admincommercial', 'as' => 'admincommercial']);
Route::get('admincorporate', ['uses' => 'AdminController@admincorporate', 'as' => 'admincorporate']);
Route::get('adminautodeals', ['uses' => 'AdminController@adminautodeals', 'as' => 'adminautodeals']);
Route::get('adminmobilemechs', ['uses' => 'AdminController@adminmobilemechs', 'as' => 'adminmobilemechs']);
Route::get('adminautocare', ['uses' => 'AdminController@adminautocare', 'as' => 'adminautocare']);
Route::get('adminautocarestaff', ['uses' => 'AdminController@adminautocarestaff', 'as' => 'adminautocarestaff']);

Route::get('Admin/expertforum', ['uses' => 'AdminController@expertforum', 'as' => 'Expert Forum']);

Route::get('Admin/allmechanics', ['uses' => 'AdminController@allMechanics', 'as' => 'allmechanics']);


// Update Profile
Route::get('Admin/profile', ['uses' => 'AdminController@profile', 'as' => 'Profile']);
Route::get('Admin/supportticket', ['uses' => 'AdminController@supportticket', 'as' => 'supportticket']);

Route::get('Admin/support/profile/{busID}', ['uses' => 'AdminController@agentprofileInfo', 'as' => 'Profileinfo']);


Route::get('crawlcountry', ['uses' => 'AdminController@crawlcountry', 'as' => 'crawlcountry']);


Route::get('Admin/crawlstate', ['uses' => 'AdminController@crawlState', 'as' => 'crawlstate']);

Route::get('Admin/crawlsnomail', ['uses' => 'AdminController@crawlsnoMail', 'as' => 'crawlsnoMail']);

Route::get('Admin/crawlstoclaim', ['uses' => 'AdminController@crawlstoclaim', 'as' => 'crawlstoclaim']);

Route::get('Admin/crawlprint', ['uses' => 'AdminController@crawlprint', 'as' => 'crawlprint']);

Route::get('Admin/crawlletter', ['uses' => 'AdminController@crawlletter', 'as' => 'crawlletter']);

Route::get('Admin/mechanicsin/{country}', ['uses' => 'AdminController@mechanicsIn', 'as' => 'mechanicsin']);

Route::get('Admin/supportmechanicsin/{country}', ['uses' => 'AdminController@supportmechanicsIn', 'as' => 'supportmechanicsin']);


Route::get('Admin/support/claimbusiness/{station}', ['uses' => 'AdminController@claimSupport', 'as' => 'claimSupport']);

Route::get('Paymenthistory', ['uses' => 'AdminController@paymenthistory', 'as' => 'Paymenthistory']);


// Platform Product
Route::get('Admin/busywrench', ['uses' => 'AdminController@busywrench', 'as' => 'busywrench']);


// Export Route
Route::get('Stationreportexport/{search}/{dayz}/{dayzl}', ['uses' => 'AdminController@stationreportexport', 'as' => 'Stationreportexport']);
Route::get('Revenuereportexport/{search}/{dayz}/{dayzl}', ['uses' => 'AdminController@revenuereportexport', 'as' => 'Revenuereportexport']);

Route::get('Allnews', ['uses' => 'AdminController@allnews', 'as' => 'Allnews']);


// Report Routes
Route::get('StationReport', ['uses' => 'AdminController@stationreport', 'as' => 'StationReport']);
Route::get('ServicetypesReport', ['uses' => 'AdminController@servicetypesreport', 'as' => 'ServicetypesReport']);
Route::get('ServiceOptionsReport', ['uses' => 'AdminController@serviceoptionsreport', 'as' => 'ServiceOptionsReport']);
Route::get('clientProfile', ['uses' => 'AdminController@clientprofile', 'as' => 'clientProfile']);
Route::get('RevenueReport', ['uses' => 'AdminController@revenuereport', 'as' => 'RevenueReport']);

Route::get('Allstaffs', ['uses' => 'AdminController@allstaffs', 'as' => 'Allstaffs']);
Route::get('Activitylog', ['uses' => 'AdminController@activity', 'as' => 'Activitylog']);
Route::get('SupportActivitylog', ['uses' => 'AdminController@supportactivity', 'as' => 'SupportActivitylog']);
Route::get('Allstations', ['uses' => 'AdminController@allstations', 'as' => 'Allstations']);
Route::get('Allcarrecords', ['uses' => 'AdminController@allcarrecords', 'as' => 'Allcarrecords']);
Route::get('registeredcars', ['uses' => 'AdminController@allregcars', 'as' => 'registeredcars']);
Route::get('Allmaintenancerecord', ['uses' => 'AdminController@allmaintenancerecord', 'as' => 'Allmaintenancerecord']);
Route::get('Question', ['uses' => 'AdminController@question', 'as' => 'Question']);

Route::get('MaintenanceServiceTypeReport', ['uses' => 'AdminController@maintenanceservicetypereport', 'as' => 'MaintenanceServiceTypeReport']);

Route::get('MaintenanceServiceOptionReport', ['uses' => 'AdminController@maintenanceserviceoptionreport', 'as' => 'MaintenanceServiceOptionReport']);

/*Paystack Route for Callback*/
Route::get('payment/callback', ['uses' => 'PaymentController@handleGatewayCallback']);
Route::get('MakePay/{id}', ['uses' => 'HomeController@makepay', 'as' => 'MakePay']);
Route::get('MakePays/{id}', ['uses' => 'AdminController@makepay', 'as' => 'MakePays']);
Route::get('QuestAns/{id}', ['uses' => 'AdminController@QuestAns', 'as' => 'QuestAns']);
/*PAYSTACK API ROUTE FOR PAYMENTS*/

Route::post('/pay', ['uses' => 'PaymentController@redirectToGateway','as' => 'pay']);


// Unsubscribe
// Route::get('unsubscribe/{action}', ['uses' => 'InappMessagingController@unsubscribe']);


// Agent Support Routes

Route::post('Admin/createagent', ['uses' => 'AgentController@store','as' => 'createagent']);
Route::post('Admin/updateagent', ['uses' => 'AgentController@update','as' => 'updateagent']);
Route::post('Admin/deleteagent', ['uses' => 'AgentController@delete','as' => 'delete_agent']);


Route::post('Admin/createnewusers', ['uses' => 'AgentController@createnewusers','as' => 'createnewusers']);

Route::get('Admin/supportagents', ['uses' => 'AdminController@supportagents','as' => 'supportagents']);
Route::get('Admin/agreementsigned', ['uses' => 'AdminController@agreementsigned','as' => 'agreement signed']);

Route::get('Admin/freeusers', ['uses' => 'AdminController@freeusers','as' => 'freeusers']);
Route::get('Admin/paidusers', ['uses' => 'AdminController@paidusers','as' => 'paidusers']);
Route::get('Admin/freeplanusers', ['uses' => 'AdminController@freeplanusers','as' => 'freeplanusers']);

Route::post('supportupdateme', ['uses' => 'AgentController@updateme', 'as' => 'supportupdateme']);


Route::get('support/login', ['uses' => 'AdminController@login', 'as' => 'SupportLogin']);


// Support Agent Login

Route::group(['prefix' => 'Admin/support'], function () {
	
	Route::get('agreementtemplate', ['uses' => 'SupportAgentController@agreementTemplate', 'as' => 'agreementtemplate']);
	Route::post('signagreement/{id}', ['uses' => 'SupportAgentController@signagreement', 'as' => 'signagreement']);

});


Route::post('phoneappointment', ['uses' => 'HomeController@phoneappointment', 'as' => 'phoneappointment']);

// Onesignal Notification
Route::get('/sendMessage', ['uses' => 'OneSignalController@sendMessage', 'as' => 'sendMessage']);
Route::get('/newNotifications', ['uses' => 'OneSignalController@newNotifications', 'as' => 'newNotifications']);

// Cron JOB
Route::get('/pointCalc', ['uses' => 'HomeController@pointCalc', 'as' => 'pointCalc']);
Route::get('/updtCalc', ['uses' => 'HomeController@updtCalc', 'as' => 'updtCalc']);
Route::get('/triggeruser', ['uses' => 'HomeController@triggeruser', 'as' => 'triggeruser']);
Route::get('/registervehicleReminder', ['uses' => 'HomeController@registervehicleReminder', 'as' => 'registervehicleReminder']);
Route::get('/recordmaintenanceReminder', ['uses' => 'HomeController@recordmaintenanceReminder', 'as' => 'recordmaintenanceReminder']);
Route::get('/uploadcontactReminder', ['uses' => 'HomeController@uploadcontactReminder', 'as' => 'uploadcontactReminder']);
Route::get('/vehicleinfoReminder', ['uses' => 'HomeController@vehicleinfoReminder', 'as' => 'vehicleinfoReminder']);
Route::get('/ivimreportReminder', ['uses' => 'HomeController@ivimreportReminder', 'as' => 'ivimreportReminder']);
Route::get('/myweeklyPoints', ['uses' => 'HomeController@myweeklyPoints', 'as' => 'myweeklyPoints']);
Route::get('/myglobalPoints', ['uses' => 'HomeController@myglobalPoints', 'as' => 'myglobalPoints']);
Route::get('/createdmechanics', ['uses' => 'AdminController@createdMechanicCrons', 'as' => 'createdmechanics']);

// PayPal Route
Route::post('/paypalpay', ['uses' => 'PaypalController@store', 'as' => 'paypalpay']);

// Free Trial Submission
Route::post('/submission', ['uses' => 'FreetrialController@submission', 'as' => 'freetrial submission']);



// Review Response
Route::post('reviewresponse', ['uses' => 'ReviewresponseController@reviewResponse', 'as' => 'reviewresponse']);

// Password change
Route::post('passwordchange', ['uses' => 'AdminController@passwordChange', 'as' => 'passwordchange']);

// Paypal API
Route::post('/paypal-transaction-complete', ['uses' => 'PaypalController@completeTransaction','as' => 'paypaltransaction']);

// Instore
Route::post('/paypal-transaction-instore', ['uses' => 'PaypalController@instoreTransaction','as' => 'paypaltransactioninstore']);


// Print Claims
Route::post('Admin/printLetter', ['uses' => 'AdminController@printLetter', 'as' => 'printLetter']);

// Mailbox
Route::get('Admin/composemail', ['uses' => 'AdminController@composemail', 'as' => 'Compose Mail']);
Route::get('Admin/inbox', ['uses' => 'AdminController@inbox', 'as' => 'Inbox']);
Route::get('Admin/sentmail', ['uses' => 'AdminController@sentmail', 'as' => 'Sent Mail']);
Route::get('Admin/drafts', ['uses' => 'AdminController@drafts', 'as' => 'Drafts']);
Route::get('Admin/trash', ['uses' => 'AdminController@trash', 'as' => 'Trash']);
Route::get('Admin/read/{id}', ['uses' => 'AdminController@readmail', 'as' => 'Read Mail']);

// Sending and Receiving Mail
Route::post('Admin/composemessage', ['uses' => 'InappMessagingController@composemessage', 'as' => 'composemessage']);

Route::post('Admin/answerquestions', ['uses' => 'AdminController@answerquestions', 'as' => 'answerquestions']);
Route::post('Admin/deletethismechanic', ['uses' => 'AdminController@deletethismechanic', 'as' => 'deletethismechanic']);


// Ajax Route
Route::group(['prefix' => 'Ajax'], function(){

// Insert New Maintenance Record, Edit, and Search
Route::post('Newvehicle', ['uses' => 'HomeController@ajaxnewvehicle', 'as' => 'AjaxNewvehicle']);
Route::post('Carrecord', ['uses' => 'HomeController@ajaxcarrecord', 'as' => 'AjaxCarrecord']);
Route::post('Additionalemail', ['uses' => 'HomeController@ajaxadditionalemail', 'as' => 'AjaxAdditionalemail']);

// Mail Alert Action
Route::post('Alertaction', ['uses' => 'HomeController@ajaxalertaction', 'as' => 'AjaxAlertaction']);


Route::post('Remindersettings', ['uses' => 'HomeController@ajaxremindersettings', 'as' => 'AjaxRemindersettings']);
Route::post('Reminderbussettings', ['uses' => 'HomeController@ajaxreminderbussettings', 'as' => 'AjaxReminderbussettings']);
Route::post('Addreminderbussettings', ['uses' => 'HomeController@ajaxaddreminderbussettings', 'as' => 'AjaxAddreminderbussettings']);
Route::post('Vehiclesettings', ['uses' => 'HomeController@ajaxvehiclesettings', 'as' => 'AjaxVehiclesettings']);


Route::post('LicenseSearch', ['uses' => 'AjaxvehicleController@ajaxlicensesearch', 'as' => 'AjaxLicenseSearch']);
Route::post('LicenseSearches', ['uses' => 'AjaxvehicleController@ajaxlicensesearches', 'as' => 'AjaxLicenseSearches']);

Route::post('ivimSearch', ['uses' => 'HomeController@ajaxivimsearch', 'as' => 'AjaxivimSearch']);


Route::post('uploadStatement', ['uses' => 'HomeController@ajaxuploadstatement', 'as' => 'AjaxuploadStatement']);
Route::post('moreDetails', ['uses' => 'HomeController@ajaxmoredetails', 'as' => 'AjaxmoreDetails']);

Route::post('deactivateUser', ['uses' => 'HomeController@ajaxdeactivateuser', 'as' => 'AjaxdeactivateUser']);


Route::post('forgotPassword', ['uses' => 'HomeController@forgotPassword', 'as' => 'forgotPassword']);


// Contact Us
Route::post('Contactus', ['uses' => 'HomeController@ajaxcontactus', 'as' => 'AjaxContactus']);


// Auto Care, Book Appointment and Tow Truck
Route::post('AutoCare', ['uses' => 'HomeController@ajaxautocare', 'as' => 'AjaxAutoCare']);
Route::post('BookAppointment', ['uses' => 'HomeController@ajaxbookappointment', 'as' => 'AjaxBookAppointment']);

// Change Password
Route::post('Passwordchange', ['uses' => 'HomeController@ajaxpasswordchange', 'as' => 'AjaxPasswordchange']);


// Edit Maintenance Record
Route::post('MaintenanceSave', ['uses' => 'HomeController@ajaxmaintenancesave', 'as' => 'AjaxMaintenanceSave']);


// Financial Posts from Commercial Users
Route::post('commercialFinance', ['uses' => 'HomeController@ajaxcommercialfinance', 'as' => 'AjaxcommercialFinance']);


Route::post('moreReports', ['uses' => 'HomeController@ajaxmorereports', 'as' => 'AjaxmoreReports']);


// Admin Login...

Route::post('AdminLogin', ['uses' => 'AdminController@ajaxadminlogin', 'as' => 'AjaxAdminLogin']);
Route::post('AdminLogout', ['uses' => 'AdminController@ajaxadminLogout', 'as' => 'AjaxAdminLogout']);
Route::post('Createstaff', ['uses' => 'AdminController@ajaxcreatestaff', 'as' => 'AjaxCreateStaff']);
Route::post('Createstation', ['uses' => 'AdminController@ajaxcreatestation', 'as' => 'AjaxCreateStation']);


Route::post('BusinessCrud', ['uses' => 'AdminController@ajaxbusinesscrud', 'as' => 'AjaxBusinessCrud']);

// Reports
Route::post('StationReport', ['uses' => 'AdminController@ajaxstationreport', 'as' => 'AjaxStationReport']);

Route::post('ServicetypesReport', ['uses' => 'AdminController@ajaxservicetypesreport', 'as' => 'AjaxServicetypesReport']);
Route::post('ServiceOptionsReport', ['uses' => 'AdminController@ajaxserviceoptionsreport', 'as' => 'AjaxServiceOptionsReport']);

Route::post('RevenueReport', ['uses' => 'AdminController@ajaxRevenueReport', 'as' => 'AjaxRevenueReport']);






// Client Approval

Route::post('Approval', ['uses' => 'AdminController@ajaxapproval', 'as' => 'Ajaxapproval']);
Route::post('QuickMail', ['uses' => 'AdminController@ajaxquickmail', 'as' => 'AjaxQuickMail']);
Route::post('downgrade', ['uses' => 'AdminController@ajaxdowngrade', 'as' => 'Ajaxdowngrade']);

Route::post('postRevenue', ['uses' => 'AdminController@ajaxpostrevenue', 'as' => 'AjaxpostRevenue']);
Route::post('getclientProfile', ['uses' => 'AdminController@ajaxgetclientprofile', 'as' => 'AjaxgetclientProfile']);
Route::post('getstaffprofile', ['uses' => 'AdminController@ajaxgetstaffprofile', 'as' => 'Ajaxgetstaffprofile']);




// Make Pay
Route::post('MakePay', ['uses' => 'HomeController@ajaxmakePay', 'as' => 'AjaxMakePay']);

// Ask An Expert
Route::post('Expertise', ['uses' => 'HomeController@ajaxexpertise', 'as' => 'Ajaxexpertise']);

Route::post('myRank', ['uses' => 'HomeController@ajaxmyRank', 'as' => 'AjaxmyRank']);

Route::post('ansPost', ['uses' => 'HomeController@ajaxansPost', 'as' => 'AjaxansPost']);

Route::post('anscurrPost', ['uses' => 'HomeController@ajaxanscurrPost', 'as' => 'AjaxanscurrPost']);



Route::post('ajaxQuestions', ['uses' => 'AdminController@ajaxQuestions', 'as' => 'AjaxajaxQuestions']);
Route::post('acceptPoints', ['uses' => 'AdminController@acceptPoints', 'as' => 'AjaxacceptPoints']);
Route::post('contactRedeem', ['uses' => 'AdminController@contactRedeem', 'as' => 'AjaxcontactRedeem']);
Route::post('checkInformations', ['uses' => 'AdminController@checkInformations', 'as' => 'AjaxcheckInformations']);
Route::post('accountAction', ['uses' => 'AdminController@accountAction', 'as' => 'AjaxaccountAction']);

Route::post('ticketInformation', ['uses' => 'AdminController@ticketInformation', 'as' => 'AjaxticketInformation']);
Route::post('ticketActions', ['uses' => 'AdminController@ticketActions', 'as' => 'AjaxticketActions']);
Route::post('userfulldetails', ['uses' => 'AdminController@userfulldetails', 'as' => 'Ajaxuserfulldetails']);
Route::post('userautofulldetails', ['uses' => 'AdminController@userautofulldetails', 'as' => 'Ajaxuserautofulldetails']);

Route::post('getdetailEstimate', ['uses' => 'AdminController@getdetailEstimate', 'as' => 'AjaxgetdetailEstimate']);

Route::post('estimatePaydetails', ['uses' => 'AdminController@estimatePaydetails', 'as' => 'AjaxestimatePaydetails']);

Route::post('InviteContact', ['uses' => 'HomeController@InviteContact', 'as' => 'AjaxInviteContact']);

Route::post('uploadExcel', ['uses' => 'HomeController@uploadExcel', 'as' => 'AjaxuploadExcel']);


Route::post('Estimatemail', ['uses' => 'HomeController@estimateMail', 'as' => 'AjaxEstimatemail']);
Route::post('vehiclebalMails', ['uses' => 'HomeController@vehiclebalMails', 'as' => 'AjaxvehiclebalMails']);
Route::post('EstimatSave', ['uses' => 'HomeController@estimatSave', 'as' => 'AjaxEstimatSave']);
Route::post('WorkorderSave', ['uses' => 'HomeController@workorderSave', 'as' => 'AjaxWorkorderSave']);
Route::post('moveWorkorder', ['uses' => 'HomeController@moveWorkorder', 'as' => 'AjaxMoveWorkorder']);
Route::post('moveEstimateorder', ['uses' => 'HomeController@moveEstimateorder', 'as' => 'AjaxMoveEstimateorder']);
Route::post('diagnostics', ['uses' => 'HomeController@diagnostics', 'as' => 'AjaxDiagnostics']);
Route::post('processPayment', ['uses' => 'HomeController@processPayment', 'as' => 'AjaxProcessPayment']);

// Route::post('processPayment', ['uses' => 'MonerisController@processPayment', 'as' => 'AjaxProcessPayment']);

Route::post('movemaintenanceOrder', ['uses' => 'HomeController@movemaintenanceOrder', 'as' => 'AjaxmovemaintenanceOrder']);
Route::post('checkcompletedWorks', ['uses' => 'HomeController@checkcompletedWorks', 'as' => 'AjaxcheckcompletedWorks']);
Route::post('checkdiaginvoice', ['uses' => 'HomeController@checkdiaginvoice', 'as' => 'Ajaxcheckdiaginvoice']);
Route::post('getPaymentRec', ['uses' => 'HomeController@getPaymentRec', 'as' => 'AjaxgetPaymentRec']);
Route::post('addnewPart', ['uses' => 'HomeController@addnewPart', 'as' => 'AjaxaddnewPart']);
Route::post('createPO', ['uses' => 'HomeController@createPO', 'as' => 'AjaxcreatePO']);
Route::post('POemail', ['uses' => 'HomeController@POemail', 'as' => 'AjaxPOemail']);
Route::post('createVendor', ['uses' => 'HomeController@createVendor', 'as' => 'AjaxcreateVendor']);
Route::post('orderActions', ['uses' => 'HomeController@orderActions', 'as' => 'AjaxorderActions']);
Route::post('createInvItem', ['uses' => 'HomeController@createInvItem', 'as' => 'AjaxcreateInvItem']);
Route::post('poPayments', ['uses' => 'HomeController@poPayments', 'as' => 'AjaxpoPayments']);
Route::post('createCategory', ['uses' => 'HomeController@createCategory', 'as' => 'AjaxcreateCategory']);
Route::post('autoPayment', ['uses' => 'HomeController@autoPayment', 'as' => 'AjaxautoPayment']);
Route::post('manageLabour', ['uses' => 'HomeController@manageLabour', 'as' => 'AjaxmanageLabour']);
Route::post('manageTime', ['uses' => 'HomeController@manageTime', 'as' => 'AjaxmanageTime']);
Route::post('addLabour', ['uses' => 'HomeController@addLabour', 'as' => 'AjaxaddLabour']);
Route::post('fetchtheNeedful', ['uses' => 'HomeController@fetchtheNeedful', 'as' => 'AjaxfetchtheNeedful']);
Route::post('getvendors', ['uses' => 'HomeController@getvendors', 'as' => 'Ajaxgetvendors']);
Route::post('updatevendors', ['uses' => 'HomeController@updatevendors', 'as' => 'Ajaxupdatevendors']);
Route::post('vendormail', ['uses' => 'HomeController@vendormail', 'as' => 'Ajaxvendormail']);
Route::post('vendDetails', ['uses' => 'HomeController@vendDetails', 'as' => 'AjaxvendDetails']);
Route::post('balanceReview', ['uses' => 'HomeController@balanceReview', 'as' => 'AjaxbalanceReview']);
Route::post('paySchedule', ['uses' => 'HomeController@paySchedule', 'as' => 'AjaxpaySchedule']);
Route::post('processStub', ['uses' => 'HomeController@processStub', 'as' => 'AjaxprocessStub']);
Route::post('labourstubMails', ['uses' => 'HomeController@labourstubMails', 'as' => 'AjaxlabourstubMails']);
Route::post('performsearchAction', ['uses' => 'HomeController@performsearchAction', 'as' => 'AjaxperformsearchAction']);
Route::post('editEstimates', ['uses' => 'HomeController@editEstimates', 'as' => 'AjaxeditEstimates']);
Route::post('saveEdit', ['uses' => 'HomeController@saveEdit', 'as' => 'AjaxsaveEdit']);
Route::post('technicianEdit', ['uses' => 'HomeController@technicianEdit', 'as' => 'AjaxtechnicianEdit']);
Route::post('UpdateLabour', ['uses' => 'HomeController@UpdateLabour', 'as' => 'AjaxUpdateLabour']);
Route::post('monitorRecords', ['uses' => 'HomeController@monitorRecords', 'as' => 'AjaxmonitorRecords']);
Route::post('bookingTicket', ['uses' => 'HomeController@bookingTicket', 'as' => 'AjaxbookingTicket']);
Route::post('checkuserRegistration', ['uses' => 'HomeController@checkuserRegistration', 'as' => 'AjaxcheckuserRegistration']);
Route::post('resendInvites', ['uses' => 'HomeController@resendInvites', 'as' => 'AjaxresendInvites']);
Route::post('redeemPoints', ['uses' => 'HomeController@redeemPoints', 'as' => 'AjaxredeemPoints']);
Route::post('AdvanceSearch', ['uses' => 'HomeController@ajaxadvanceSearch', 'as' => 'AjaxAdvanceSearch']);
Route::post('createPost', ['uses' => 'HomeController@ajaxcreatePost', 'as' => 'AjaxcreatePost']);
Route::post('prepareEstimate', ['uses' => 'HomeController@ajaxprepareEstimate', 'as' => 'AjaxprepareEstimate']);

Route::post('newestimatePrepare', ['uses' => 'HomeController@ajaxnewestimatePrepare', 'as' => 'AjaxnewestimatePrepare']);


Route::post('prepareestimatePay', ['uses' => 'HomeController@ajaxprepareestimatePay', 'as' => 'AjaxprepareestimatePay']);
Route::post('Jobsdone', ['uses' => 'HomeController@ajaxJobsdone', 'as' => 'AjaxJobsdone']);
Route::post('Reviewmechanic', ['uses' => 'HomeController@ajaxReviewmechanic', 'as' => 'AjaxReviewmechanic']);
Route::post('fetchRequest', ['uses' => 'HomeController@ajaxfetchRequest', 'as' => 'AjaxfetchRequest']);
Route::post('checkIvim', ['uses' => 'HomeController@ajaxcheckIvim', 'as' => 'AjaxcheckIvim']);
Route::post('userIvim', ['uses' => 'HomeController@ajaxuserIvim', 'as' => 'AjaxuserIvim']);
Route::post('actionOpport', ['uses' => 'HomeController@ajaxactionOpport', 'as' => 'AjaxactionOpport']);
Route::post('updateactionOpport', ['uses' => 'HomeController@ajaxupdateactionOpport', 'as' => 'AjaxupdateactionOpport']);

Route::post('getLicence', ['uses' => 'HomeController@ajaxgetLicence', 'as' => 'AjaxgetLicence']);
Route::post('activateJobdone', ['uses' => 'AdminController@ajaxactivateJobdone', 'as' => 'AjaxactivateJobdone']);
Route::post('mailclient', ['uses' => 'AdminController@ajaxmailclient', 'as' => 'Ajaxmailclient']);


Route::post('monerisAPI', ['uses' => 'MonerisController@purchase', 'as' => 'AjaxmonerisAPI']);

Route::post('monerisAPIinstore', ['uses' => 'MonerisController@purchaseinstore', 'as' => 'AjaxmonerisAPIinstore']);

Route::post('informationCheck', ['uses' => 'HomeController@informationCheck', 'as' => 'AjaxinformationCheck']);

Route::post('subscribeNews', ['uses' => 'HomeController@subscribeNews', 'as' => 'AjaxsubscribeNews']);


Route::post('newsandhappenings', ['uses' => 'AdminController@newsandhappenings', 'as' => 'Ajaxnewsandhappenings']);

Route::post('newshappeningupdates', ['uses' => 'AdminController@newshappeningupdates', 'as' => 'Ajaxnewshappeningupdates']);

Route::post('allpostaction', ['uses' => 'AdminController@allpostaction', 'as' => 'Ajaxallpostaction']);

Route::post('updateUploadaction', ['uses' => 'AdminController@updateUploadaction', 'as' => 'AjaxupdateUploadaction']);

// Triplog API Test

Route::post('apiTripLogaccount', ['uses' => 'TriplogController@apiTripLog', 'as' => 'apiTripLogaccount']);


Route::post('checkNotifications', ['uses' => 'HomeController@checkNotifications', 'as' => 'checkNotifications']);

Route::post('stationDetails', ['uses' => 'HomeController@stationDetails', 'as' => 'stationDetails']);
Route::post('CloseAppoint', ['uses' => 'HomeController@CloseAppoint', 'as' => 'CloseAppoint']);
Route::post('AccCloseAppoint', ['uses' => 'HomeController@AccCloseAppoint', 'as' => 'AccCloseAppoint']);
Route::post('Feedbacks', ['uses' => 'HomeController@Feedbacks', 'as' => 'Feedbacks']);
Route::post('checkFeedbacks', ['uses' => 'HomeController@checkFeedbacks', 'as' => 'checkFeedbacks']);
Route::post('updateFeedbacks', ['uses' => 'HomeController@updateFeedbacks', 'as' => 'updateFeedbacks']);

Route::post('otherSearch', ['uses' => 'HomeController@otherSearch', 'as' => 'otherSearch']);

Route::post('setDiscount', ['uses' => 'AdminController@setDiscount', 'as' => 'setDiscount']);
Route::post('setDiscountCharges', ['uses' => 'AdminController@setDiscountCharges', 'as' => 'setDiscountCharges']);
Route::post('activateBW', ['uses' => 'AdminController@activateBW', 'as' => 'activateBW']);


Route::post('updateCrawls', ['uses' => 'AdminController@updateCrawls', 'as' => 'updateCrawls']);
Route::post('getCrawled', ['uses' => 'AdminController@getCrawled', 'as' => 'getCrawled']);


Route::post('extendtrial', ['uses' => 'AdminController@extendtrial', 'as' => 'extendtrial']);



// Update Business Info
Route::post('businessUpdate', ['uses' => 'AdminController@businessUpdate', 'as' => 'businessUpdate']);



Route::post('checkClaims', ['uses' => 'HomeController@ajaxcheckClaims', 'as' => 'checkClaims']);

Route::post('updateme', ['uses' => 'HomeController@ajaxupdateme', 'as' => 'updateme']);

Route::post('checkappointment', ['uses' => 'HomeController@ajaxcheckappointment', 'as' => 'checkappointment']);

Route::post('updatebusinessLogo', ['uses' => 'BusinessPageController@ajaxupdatebusinessLogo', 'as' => 'updatebusinessLogo']);

Route::post('updatephoto', ['uses' => 'BusinessPageController@updatephoto', 'as' => 'updatephoto']);
Route::post('serviceoffered', ['uses' => 'BusinessPageController@serviceoffered', 'as' => 'serviceoffered']);
Route::post('getAgent', ['uses' => 'AgentController@getAgent', 'as' => 'getAgent']);

Route::post('supportClaims', ['uses' => 'AgentController@ajaxcheckClaims', 'as' => 'supportClaims']);


// VIN Lookup
Route::post('vinlookup', ['uses' => 'VinController@decodeInfo', 'as' => 'vinlookup']);






});

// Prochatr Route
Route::group(['prefix' => 'Messaging'], function() {
	Route::post('index', ['uses' => 'MessagingController@index', 'as' => 'index']);
});

