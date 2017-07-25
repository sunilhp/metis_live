<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    if(Auth::check())
        return view('home');
    else
        return view('welcome');
});
Route::auth();

Route::post('/ajax/register-request-otp', 'AjaxController@register_code');



Route::post('/ajax/register-confirm-otp', 'AjaxController@confirm_code');
Route::post('/ajax/resend-otp', 'AjaxController@resend_code');
Route::get('/home', 'HomeController@index');
Route::get('user/activation/{token}', 'Auth\LoginController@activateUser')->name('user.activate');
Route::get('/personal-information', 'HomeController@personal_info');
Route::get('/current-password', 'HomeController@get_current_password');
Route::post('/current-password', 'HomeController@post_current_password');
Route::get('/personal-information/edit', 'HomeController@personal_info');
Route::post('/personal-information/edit', 'HomeController@user_profile_pic');
Route::post('/save-personal-information', 'HomeController@save_personal_info');
Route::get('/emergency-information', 'HomeController@emergency_information');
Route::post('/emergency-information', 'HomeController@emergency_information_new');
Route::get('/emergency-information/edit/{id}', 'HomeController@emergency_information');
Route::post('/emergency-information/edit/{id}', 'HomeController@emergency_information_update');


Route::get('/visits', 'VisitsController@index');
Route::post('/visits', 'VisitsController@visits_new');
Route::get('/visits/{id}', 'VisitsController@index');

Route::auth();

Route::post('/visits/{id}', 'VisitsController@visits_update');






Route::auth();

Route::get('/documents', 'DocumentsController@index');


Route::auth();

Route::get('/documents/notes', 'DocumentsController@notes');

Route::auth();

Route::get('/documents/notes/new', 'DocumentsController@notes_new');

Route::auth();

Route::post('/documents/notes/save', 'DocumentsController@notes_save');


Route::auth();

Route::get('/advocacy', 'AdvocacyController@index');

Route::auth();

Route::get('/advocacy/sessions', 'AdvocacyController@sessions');

Route::auth();

Route::get('/advocacy/start-video', 'AdvocacyController@start_video');

Route::auth();

Route::get('/advocacy/video-confirmation', 'AdvocacyController@video_confirmation');


Route::auth();

Route::post('/advocacy/video-request-code', 'AdvocacyController@video_request_code');

Route::auth();

Route::post('/advocacy/video-resend-code', 'AdvocacyController@video_resend_code');

Route::auth();

Route::post('/advocacy/video-confirm', 'AdvocacyController@video_confirm');

Route::auth();

Route::get('/advocacy/video-new', 'AdvocacyController@video_new');

Route::auth();

Route::get('/advocacy/start-phone', 'AdvocacyController@start_phone');

Route::auth();

Route::get('/advocacy/start-chat', 'AdvocacyController@start_chat');

Route::auth();

Route::get('/advocacy/claims-bills', 'AdvocacyController@claims_bills');

Route::auth();

Route::get('/advocacy/claims-bills/y/{id}', 'AdvocacyController@claims_bills_y');

Route::auth();

Route::get('/advocacy/claims-bills-new', 'AdvocacyController@claims_bills_new');


Route::auth();

Route::post('/advocacy/claims-bills-new', 'AdvocacyController@claims_bills_new');

Route::auth();

Route::get('/advocacy/messages', 'AdvocacyController@messages');

Route::auth();

Route::post('/advocacy/messages', 'AdvocacyController@messages');

Route::auth();

Route::get('/advocacy/messages/{id}', 'AdvocacyController@messages');

Route::auth();

Route::post('/advocacy/messages/{id}', 'AdvocacyController@messages');

Route::auth();

Route::get('/advocacy/messages/{id}', 'AdvocacyController@messages');

Route::auth();

Route::get('/tools', 'ToolsController@index');

Route::auth();

Route::get('/tools/symptom-tracker', 'ToolsController@symptom_tracker');

Route::auth();

Route::post('/tools/symptom-tracker', 'ToolsController@symptom_tracker');

Route::auth();

Route::get('/tools/symptom-tracker/q/{id}', 'ToolsController@symptom_tracker_query');

Route::auth();

Route::get('/tools/explore', 'ToolsController@explore');

Route::auth();

Route::get('/providers', 'HomeController@providers');

Route::auth();

Route::get('/providers/{id}', 'HomeController@providers');

Route::auth();

Route::post('/providers/new', 'HomeController@providers_new');

Route::auth();

Route::post('/providers/{id}', 'HomeController@providers_update');


Route::auth();

Route::post('/emergency-information/{id}', 'HomeController@providers');




Route::auth();

Route::get('/medications', 'HomeController@medications');

Route::auth();

Route::get('/medications/{id}', 'HomeController@medications');

Route::auth();

Route::post('/medications/new', 'HomeController@medications_new');

Route::auth();

Route::post('/medications/{id}', 'HomeController@medications_update');

Route::auth();

Route::get('/allergies', 'HomeController@allergies');

Route::auth();

Route::get('/allergies/{id}', 'HomeController@allergies');

Route::auth();

Route::post('/allergies/new', 'HomeController@allergies_new');

Route::auth();

Route::post('/allergies/{id}', 'HomeController@allergies_update');

Route::auth();

Route::get('/medical-history', 'HomeController@medical_history');

Route::auth();

Route::get('/medical-history/{id}', 'HomeController@medical_history');

Route::auth();

Route::post('/medical-history/new', 'HomeController@medical_history_new');

Route::auth();

Route::post('/medical-history/{id}', 'HomeController@medical_history_update');


Route::auth();

Route::get('/insurance-information', 'HomeController@insurance_information');

Route::auth();

Route::get('/insurance-information/{id}', 'HomeController@insurance_information');

Route::auth();

Route::post('/insurance-information/new', 'HomeController@insurance_information_new');

Route::auth();

Route::post('/insurance-information/{id}', 'HomeController@insurance_information_update');

Route::auth();

Route::get('/preferred-pharmacy', 'HomeController@preferred_pharmacy');

Route::auth();

Route::get('/preferred-pharmacy/{id}', 'HomeController@preferred_pharmacy');

Route::auth();

Route::post('/preferred-pharmacy/new', 'HomeController@preferred_pharmacy_new');

Route::auth();

Route::post('/preferred-pharmacy/{id}', 'HomeController@preferred_pharmacy_update');





Route::auth();

Route::get('/faq', 'HomeController@faq');

Route::auth();

Route::get('/about-metis', 'HomeController@about_metis');

Route::auth();

Route::get('/contact-us', 'HomeController@contact_us');

Route::auth();

Route::get('/privacy', 'HomeController@privacy');

Route::auth();

Route::get('/terms-of-use', 'HomeController@terms_of_use');

/*Ajax Call */
Route::get('provider-auto',array('as'=>'providerauto','uses'=>'HomeController@provider_auto'));
Route::get('symptoms',array('as'=>'symptoms','uses'=>'HomeController@symptoms'));
Route::get('impaired-activity',array('as'=>'impaired-activity','uses'=>'HomeController@impairedactivity'));
Route::get('body-located',array('as'=>'body-located','uses'=>'HomeController@bodylocated'));



