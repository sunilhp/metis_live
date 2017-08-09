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
Route::get('/emergency-information/delete/{id}', 'HomeController@emergency_information_delete');
Route::post('/emergency-information/edit/{id}', 'HomeController@emergency_information_update');

Route::get('/visits', 'VisitsController@index');
Route::post('/visits', 'VisitsController@visits_new');
Route::get('/visits/{id}', 'VisitsController@index');
Route::post('/visits/{id}', 'VisitsController@visits_update');


Route::get('/documents', 'DocumentsController@index');
Route::get('/documents/medical', 'DocumentsController@medical');
Route::post('/documents/medical', 'DocumentsController@medical');
Route::get('/documents/claims', 'DocumentsController@claims');
Route::post('/documents/claims', 'DocumentsController@claims');
Route::get('/documents/insurance', 'DocumentsController@insurance');
Route::post('/documents/insurance', 'DocumentsController@insurance');
Route::get('/documents/notes', 'DocumentsController@notes');
Route::post('/documents/notes/{id}', 'DocumentsController@notes');
Route::get('/documents/notes/{id}', 'DocumentsController@notes');
Route::get('/documents/notes/new', 'DocumentsController@notes_new');
Route::post('/documents/notes/save', 'DocumentsController@notes_save');



Route::get('/advocacy', 'AdvocacyController@index');
Route::get('/advocacy/sessions', 'AdvocacyController@sessions');
Route::get('/advocacy/start-video', 'AdvocacyController@start_video');
Route::get('/advocacy/video-confirmation', 'AdvocacyController@video_confirmation');
Route::post('/advocacy/video-request-code', 'AdvocacyController@video_request_code');
Route::post('/advocacy/video-resend-code', 'AdvocacyController@video_resend_code');
Route::post('/advocacy/video-confirm', 'AdvocacyController@video_confirm');
Route::get('/advocacy/video-new', 'AdvocacyController@video_new');
Route::get('/advocacy/start-phone', 'AdvocacyController@start_phone');
Route::get('/advocacy/start-chat', 'AdvocacyController@start_chat');
Route::get('/advocacy/claims-bills', 'AdvocacyController@claims_bills');
Route::get('/advocacy/claims-bills/y/{id}', 'AdvocacyController@claims_bills_y');
Route::get('/advocacy/claims-bills-new', 'AdvocacyController@claims_bills_new');
Route::post('/advocacy/claims-bills-new', 'AdvocacyController@claims_bills_new');
Route::get('/advocacy/messages', 'AdvocacyController@messages');
Route::post('/advocacy/messages', 'AdvocacyController@messages');
Route::get('/advocacy/messages/{id}', 'AdvocacyController@messages');
Route::post('/advocacy/messages/{id}', 'AdvocacyController@messages');
Route::get('/advocacy/messages/{id}', 'AdvocacyController@messages');


Route::get('/tools', 'ToolsController@index');
Route::get('/tools/symptom-tracker', 'ToolsController@symptom_tracker');
Route::post('/tools/symptom-tracker', 'ToolsController@symptom_tracker');
Route::get('/tools/symptom-tracker/q/{id}', 'ToolsController@symptom_tracker_query');
Route::get('/tools/explore', 'ToolsController@explore');
Route::post('/tools/explore', 'ToolsController@explore');

Route::get('/providers', 'HomeController@providers');
Route::get('/providers/{id}', 'HomeController@providers');
Route::get('/providers/delete/{id}', 'HomeController@providers_delete');
Route::post('/providers/new', 'HomeController@providers_new');
Route::post('/providers/{id}', 'HomeController@providers_update');
Route::post('/emergency-information/{id}', 'HomeController@providers');
Route::get('/medications', 'HomeController@medications');
Route::get('/medications/{id}', 'HomeController@medications');
Route::post('/medications/new', 'HomeController@medications_new');
Route::get('/medications/delete/{id}', 'HomeController@medications_delete');
Route::post('/medications/{id}', 'HomeController@medications_update');
Route::get('/allergies', 'HomeController@allergies');
Route::get('/allergies/{id}', 'HomeController@allergies');
Route::post('/allergies/new', 'HomeController@allergies_new');
Route::post('/allergies/{id}', 'HomeController@allergies_update');
Route::get('/allergies/delete/{id}', 'HomeController@allergies_delete');
Route::get('/medical-history', 'HomeController@medical_history');
Route::get('/medical-history/{id}', 'HomeController@medical_history');
Route::post('/medical-history/new', 'HomeController@medical_history_new');
Route::post('/medical-history/{id}', 'HomeController@medical_history_update');
Route::get('/medical-history/delete/{id}', 'HomeController@medical_history_delete');
Route::get('/insurance-information', 'HomeController@insurance_information');
Route::get('/insurance-information/{id}', 'HomeController@insurance_information');
Route::post('/insurance-information/new', 'HomeController@insurance_information_new');
Route::post('/insurance-information/{id}', 'HomeController@insurance_information_update');
Route::get('/insurance-information/delete/{id}', 'HomeController@insurance_information_delete');
Route::get('/preferred-pharmacy', 'HomeController@preferred_pharmacy');
Route::get('/preferred-pharmacy/{id}', 'HomeController@preferred_pharmacy');
Route::post('/preferred-pharmacy/new', 'HomeController@preferred_pharmacy_new');
Route::post('/preferred-pharmacy/{id}', 'HomeController@preferred_pharmacy_update');
Route::get('/preferred-pharmacy/delete/{id}', 'HomeController@preferred_pharmacy_delete');
Route::get('/faq', 'HomeController@faq');
Route::get('/about-metis', 'HomeController@about_metis');
Route::get('/contact-us', 'HomeController@contact_us');
Route::get('/privacy', 'HomeController@privacy');
Route::get('/terms-of-use', 'HomeController@terms_of_use');


/*Ajax Call */
Route::get('provider-auto',array('as'=>'providerauto','uses'=>'HomeController@provider_auto'));
Route::get('symptoms',array('as'=>'symptoms','uses'=>'HomeController@symptoms'));
Route::get('impaired-activity',array('as'=>'impaired-activity','uses'=>'HomeController@impairedactivity'));
Route::get('body-located',array('as'=>'body-located','uses'=>'HomeController@bodylocated'));
Route::get('explore-list',array('as'=>'explore-list','uses'=>'HomeController@explore'));



