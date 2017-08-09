<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DateTime;
use Auth;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        if(Auth::guest()){
            return redirect('login');
        }
        $this->user_id = Auth::user()->id;

    }

    protected function validator_password(array $data)
    {


        return Validator::make($data, [

            'opassword'     => 'required',
            'password'     => 'required|min:6',
            'cpassword' => 'required|same:password',

        ]);
    }


    protected function validate_provider(array $data)
    {

        return Validator::make($data, [
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'specialty' => 'required',
            'org' => 'required',
            'address' => 'required',
            'pemail' => 'required|email|max:255',
            'mnumber' => 'required',
            'pnumber' => 'required',
        ]);
    }

    protected function validate_emergency(array $data)
    {

        return Validator::make($data, [
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'cellno' => 'required',
            'relation' => 'required',

        ]);
    }

    protected function validate_medication(array $data)
    {

        return Validator::make($data, [
            'drugname' => 'required|max:255',
            'dosage' => 'required',
            'medschedule' => 'required',
            'medstart' => 'required',
            'presdoctor' => 'required',

        ]);
    }

    protected function validate_allergy(array $data)
    {

        return Validator::make($data, [
            'drugname' => 'required|max:255',
            'firstoccur' => 'required',
            'reaction' => 'required',
            'allergytreat' => 'required',

        ]);
    }

    protected function validate_event(array $data)
    {

        return Validator::make($data, [
            'eventtype' => 'required',
            'eventfrom' => 'required',
            'eventoccur' => 'required',


        ]);
    }
    protected function validate_insurance(array $data)
    {

        return Validator::make($data, [
            'insurancename' => 'required',
            'address1' => 'required',
            'phonenumber' => 'required',


        ]);
    }
    protected function validate_pharmacy(array $data)
    {

        return Validator::make($data, [
            'pharmacyname' => 'required',
            'address1' => 'required',
            'refillsnumber' => 'required',


        ]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function personal_info()
    {
        $user_data = DB::table('users')->where( 'id' ,$this->user_id)->get();
        $data = array(
            'pagetitle' =>  "Personal Information",
            'records'   =>  $user_data
        );

        return view('personal_info',['records'=>$user_data,'data' => $data]);
    }
    public function get_current_password()
    {
        $user_data = DB::table('users')->where( 'id' ,$this->user_id)->get();
        $data = array(
            'pagetitle' =>  "Password Settings",
            'records'   =>  $user_data
        );

        return view('current_password',['data' => $data,'error' => null ,'success' => null ]);
    }
    public function user_profile_pic(){
        if (Input::file('file')) {
            $file = Input::file('file');

            $file_name = $file->getClientOriginalName();
            $complete_path = 'images/profile/' . $file_name;

            $upload_success = $file->move(public_path('images/profile'), $file_name);

            if ($upload_success) {
                $data_doc = $complete_path;
                #DB::insert('insert into patient_documents (user_id,visit_id ,`module`, doc_path) values (?, ?, ?, ?)', [$this->user_id,$request->claim_id,'claims-bills', $data_doc ]);
                DB::update('update users set profile_pic = ? where id = ?', [$data_doc, $this->user_id]);
                return Response::json('success', 200);
            } else {
                return Response::json('error', 400);
            }

        }
    }
        public function post_current_password(Request $request)
    {
        $validator = $this->validator_password($request->all());

        if ($validator->fails()) {

            $this->throwValidationException(
                $request, $validator
            );
        }

        $data = $request->all();
        $user = Auth::user(auth()->user()->id);
        if(!Hash::check($data['opassword'], $user->password)){
            return back()->withInput($request->all())->with('error','The specified password does not match the database password');
        }else{
            $updated = DB::update('update users set password = ?  where id = ?', [Hash::make($request->password), $this->user_id]);
            if($updated){
                return redirect('personal-information')->with('success', 'Profile updated!');
            }else{
                return redirect('current-password')->withInput($request->all())->with('error','Error updating password');
            }

        }

    }

    public function save_personal_info(Request $request)
    {

        DB::update('update users set address1 = ?, address2 = ?, pnumber = ?, onumber = ?  where id = ?', [$request->address1, $request->address2, $request->pnumber, $request->onumber, $this->user_id]);

        if (!empty($request->password)){
            $validator = $this->validator_password($request->all());

        if ($validator->fails()) {

            $this->throwValidationException(
                $request, $validator
            );
        }

        $data = $request->all();
        $user = Auth::user(auth()->user()->id);
        if (!Hash::check($data['opassword'], $user->password)) {
            return back()->withInput($request->all())->with('error', 'The specified password does not match the database password');
        } else {
            $updated = DB::update('update users set password = ?  where id = ?', [Hash::make($request->password), $this->user_id]);
            if ($updated) {
                return redirect('personal-information')->with('success', 'Profile updated!');
            } else {
                return redirect('current-password')->withInput($request->all())->with('error', 'Error updating password');
            }

        }

    }

        return redirect('personal-information')->with('success', 'Profile updated!');
    }

    public function symptom_tracker()
    {
        $data = array(
            'pagetitle' =>  "Symptom Information"
        );
        return view('symptom_tracker')->with('data', $data);
    }
    public function emergency_information(Request $request)
    {

        $em_info = DB::table('patient_emergency_contact')->where( 'user_id' ,$this->user_id)->get();

        $data = array(
            'pagetitle' =>  "Emergency Information"
        );

        if(isset($request->id)){
            $cur_info = DB::table('patient_emergency_contact')->where( 'id' ,$request->id)->first();
            return view('emergency_information',['records'=>$em_info,'data' => $data,'current' => $cur_info]);
        }
        return view('emergency_information',['records'=>$em_info,'data' => $data,'current' => null]);
    }

    public function emergency_information_update(Request $request, $id)
    {
        $validator = $this->validate_emergency($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        if ($request->isMethod('post')) {

            $updated= DB::update('update patient_emergency_contact set first_name = ?, last_name = ?, cell_no = ?,email = ?,home_no = ?, work_no = ?, relation = ? where id = ?', [$request->fname, $request->lname, $request->cellno, $request->email ,$request->homeno, $request->workno, $request->relation ,$id]);
            if($updated){
                return redirect('emergency-information')->with('success', 'Profile updated!');
            }else{
                return redirect('emergency-information/edit/'.$id)->withInput($request->all())->with('error','Error updating information');
            }
        }


    }
    public function emergency_information_new(Request $request)
    {
        $validator = $this->validate_emergency($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $updated = DB::insert('insert into patient_emergency_contact (first_name, last_name,user_id, cell_no,email, home_no,work_no, relation) values (?, ?, ?, ?, ?,? ,?, ?)', [$request->fname, $request->lname,$this->user_id,$request->cellno, $request->email,$request->homeno,$request->workno,$request->relation]);

        if($updated){
            return redirect('emergency-information')->with('success', 'Contact Added!');
        }else{
            return redirect('emergency-information')->withInput($request->all())->with('error','Error adding details');
        }

    }

    public function emergency_information_delete(Request $request)
    {

        $deleted =  DB::table('patient_emergency_contact')->where('id', '=', $request->id)->delete();


        if($deleted){
            return redirect('emergency-information')->with('success', 'Deleted successfully');
        }else{
            return redirect('emergency-information')->withInput($request->all())->with('error','Error deleting details');
        }

    }
    public function providers(Request $request)
    {

        $providers = DB::table('patient_provider')->where( 'user_id' ,$this->user_id)->get();

        $data = array(
            'pagetitle' =>  "Providers"
        );

        if(isset($request->id)){
            $cur_info = DB::table('patient_provider')->where( 'id' ,$request->id)->first();
            return view('providers',['records'=>$providers,'data' => $data,'current' => $cur_info]);
        }
        return view('providers',['records'=>$providers,'data' => $data,'current' => null]);

    }

    public function providers_new(Request $request)
    {
        $validator = $this->validate_provider($request->all());

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(),'success' => 0]);

        }

       DB::insert('insert into patient_provider (first_name, last_name,user_id, provider_org, provider_address, provider_speciality, provider_email,provider_phone_no, provider_mobile_no) values (?, ?, ?, ?,?, ?, ?, ?, ?)', [$request->fname, $request->lname,$this->user_id,$request->org,$request->address,$request->specialty, $request->pemail,$request->pnumber,$request->mnumber]);

        return json_encode(array(
            'success' => 1
        ));
    }

    public function providers_update(Request $request, $id)
    {

        if ($request->isMethod('post')) {

            $validator = $this->validate_provider($request->all());

            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }


            $updated= DB::update('update patient_provider set first_name = ?, last_name = ?, provider_org = ?, provider_address = ?, provider_speciality = ?, provider_email = ?,provider_phone_no = ?, provider_mobile_no = ? where id = ?', [$request->fname, $request->lname, $request->org, $request->address, $request->specialty, $request->pemail,$request->pnumber,$request->mnumber ,$id]);
            if($updated){

                return redirect('providers')->with('success', 'Provider details updated!');
            }else{
                return redirect('providers/'.$id)->withInput($request->all())->with('error','Error adding details');
            }
        }


    }

    public function providers_delete(Request $request)
    {

        $deleted =  DB::table('patient_provider')->where('id', '=', $request->id)->delete();


        if($deleted){
            return redirect('providers')->with('success', 'Deleted successfully');
        }else{
            return redirect('providers')->withInput($request->all())->with('error','Error deleting details');
        }

    }

    public function medications(Request $request)
    {

        $med_info = DB::table('patient_medication')->where( 'user_id' ,$this->user_id)->get();

        $data = array(
            'pagetitle' =>  "Medications"
        );

        if(isset($request->id)){
            $cur_info = DB::table('patient_medication')->where( 'id' ,$request->id)->first();
            return view('medications',['records'=>$med_info,'data' => $data,'current' => $cur_info]);
        }
        return view('medications',['records'=>$med_info,'data' => $data,'current' => null]);
    }

    public function medications_new(Request $request)
    {
        $validator = $this->validate_medication($request->all());

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(),'success' => 0]);

        }
        $usableDate = DateTime::createFromFormat('m/d/Y', $request->medstart);
        $med_start= $usableDate->format('Y-m-d');
        DB::insert('insert into patient_medication (drug_name, dosage,user_id, med_schedule, med_start, pres_doctor) values (?, ?, ?, ?, ?, ?)', [$request->drugname, $request->dosage,$this->user_id,$request->medschedule,$med_start,$request->presdoctor]);

        return json_encode(array(
            'success' => 1
        ));
    }

    public function medications_update(Request $request, $id)
    {

        if ($request->isMethod('post')) {

            $validator = $this->validate_medication($request->all());

            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }

            $usableDate = DateTime::createFromFormat('m/d/Y', $request->medstart);
            $med_start= $usableDate->format('Y-m-d');

            $updated= DB::update('update patient_medication set drug_name =?,dosage =?,med_schedule=?, med_start=?, pres_doctor=? where id = ?', [$request->drugname, $request->dosage,$request->medschedule,$med_start,$request->presdoctor,$id]);
            if($updated){

                return redirect('medications')->with('success', 'Medication details updated!');
            }else{
                return redirect('medications/'.$id)->withInput($request->all())->with('error','Error adding details');
            }
        }


    }

    public function medications_delete(Request $request)
    {

        $deleted =  DB::table('patient_medication')->where('id', '=', $request->id)->delete();


        if($deleted){
            return redirect('medications')->with('success', 'Deleted successfully');
        }else{
            return redirect('medications')->withInput($request->all())->with('error','Error deleting details');
        }

    }

    public function allergies(Request $request)
    {
        $allergy_info = DB::table('patient_allergy')->where( 'user_id' ,$this->user_id)->get();

        $data = array(
            'pagetitle' =>  "Allergies"
        );

        if(isset($request->id)){
            $cur_info = DB::table('patient_allergy')->where( 'id' ,$request->id)->first();
            return view('allergies',['records'=>$allergy_info,'data' => $data,'current' => $cur_info]);
        }
        return view('allergies',['records'=>$allergy_info,'data' => $data,'current' => null]);
    }

    public function allergies_new(Request $request)
    {
        $validator = $this->validate_allergy($request->all());

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(),'success' => 0]);

        }
        $usableDate = DateTime::createFromFormat('m/d/Y', $request->firstoccur);
        $first_occur= $usableDate->format('Y-m-d');
        if($request->secondoccur){
        $secondDate = DateTime::createFromFormat('m/d/Y', $request->secondoccur);
        $second_occur= $secondDate->format('Y-m-d');
        }else{
            $second_occur='';
        }

        DB::insert('insert into patient_allergy (drug_name, first_occur, second_occur,user_id, reaction, allergy_treatment) values (?, ?, ?, ?, ?, ?)', [$request->drugname, $first_occur,$second_occur,$this->user_id,$request->reaction,$request->allergytreat]);

        return json_encode(array(
            'success' => 1
        ));
    }

    public function allergies_update(Request $request, $id)
    {

        if ($request->isMethod('post')) {

            $validator = $this->validate_allergy($request->all());

            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }

            $usableDate = DateTime::createFromFormat('m/d/Y', $request->firstoccur);
            $first_occur= $usableDate->format('Y-m-d');

            if($request->secondoccur){
                $secondDate = DateTime::createFromFormat('m/d/Y', $request->secondoccur);
                $second_occur= $secondDate->format('Y-m-d');
            }else{
                $second_occur='';
            }

            $updated= DB::update('update patient_allergy set drug_name =?, first_occur =?, second_occur =?, reaction =?, allergy_treatment =? where id = ?', [$request->drugname, $first_occur,$second_occur,$request->reaction,$request->allergytreat,$id]);
            if($updated){
                return redirect('allergies')->with('success', 'Allergy details updated!');
            }else{
                return redirect('allergies/'.$id)->withInput($request->all())->with('error','Error adding details');
            }
        }


    }

    public function allergies_delete(Request $request)
    {

        $deleted =  DB::table('patient_allergy')->where('id', '=', $request->id)->delete();


        if($deleted){
            return redirect('allergies')->with('success', 'Deleted successfully');
        }else{
            return redirect('allergies')->withInput($request->all())->with('error','Error deleting details');
        }

    }

    public function medical_history(Request $request)
    {
        $event_info = DB::table('patient_event')->where( 'user_id' ,$this->user_id)->get();
        $data = array(
            'pagetitle' =>  "Medical History"
        );

        if(isset($request->id)){
            $cur_info = DB::table('patient_event')->where( 'id' ,$request->id)->first();
            return view('medical_history',['records'=>$event_info,'data' => $data,'current' => $cur_info]);
        }
        return view('medical_history',['records'=>$event_info,'data' => $data,'current' => null]);
    }

    public function medical_history_new(Request $request)
    {
        $validator = $this->validate_event($request->all());

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(),'success' => 0]);

        }
        $usableDate = DateTime::createFromFormat('m/d/Y', $request->eventfrom);
        $event_from= $usableDate->format('Y-m-d');
        if($request->eventto){
            $secondDate = DateTime::createFromFormat('m/d/Y', $request->eventto);
            $event_to= $secondDate->format('Y-m-d');
        }else{
            $event_to='';
        }

        DB::insert('insert into patient_event (event_type, event_from, event_to,user_id, event_occur, event_treatment) values (?, ?, ?, ?, ?, ?)', [$request->eventtype, $event_from,$event_to,$this->user_id,$request->eventoccur,$request->eventtreatment]);

        return json_encode(array(
            'success' => 1
        ));
    }

    public function medical_history_update(Request $request, $id)
    {

        if ($request->isMethod('post')) {

            $validator = $this->validate_event($request->all());

            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }

            $usableDate = DateTime::createFromFormat('m/d/Y', $request->eventfrom);
            $event_from= $usableDate->format('Y-m-d');

            if($request->eventto){
                $secondDate = DateTime::createFromFormat('m/d/Y', $request->eventto);
                $event_to= $secondDate->format('Y-m-d');
            }else{
                $event_to='';
            }

            $updated= DB::update('update patient_event set event_type = ?, event_from = ?, event_to = ?,event_occur = ?, event_treatment = ? where id = ?', [$request->eventtype, $event_from,$event_to,$request->eventoccur,$request->eventtreatment,$id]);
            if($updated){
                return redirect('medical-history')->with('success', 'Event details updated!');
            }else{
                return redirect('medical-history/'.$id)->withInput($request->all())->with('error','Error adding details');
            }
        }


    }

    public function medical_history_delete(Request $request)
    {

        $deleted =  DB::table('patient_event')->where('id', '=', $request->id)->delete();


        if($deleted){
            return redirect('medical-history')->with('success', 'Deleted successfully');
        }else{
            return redirect('medical-history')->withInput($request->all())->with('error','Error deleting details');
        }

    }

    public function insurance_information(Request $request)
    {
        $event_info = DB::table('patient_insurance')->where( 'user_id' ,$this->user_id)->get();
        $data = array(
            'pagetitle' =>  "Insurance Information"
        );

        if(isset($request->id)){
            $cur_info = DB::table('patient_insurance')->where( 'id' ,$request->id)->first();
            return view('insurance_information',['records'=>$event_info,'data' => $data,'current' => $cur_info]);
        }
        return view('insurance_information',['records'=>$event_info,'data' => $data,'current' => null]);
    }

    public function insurance_information_new(Request $request)
    {
        $validator = $this->validate_insurance($request->all());

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(),'success' => 0]);

        }

        DB::insert('insert into patient_insurance (user_id, insurance_name, group_no, rxbin, rxpcn, rxgroup, phone_number,web_url,address1,address2) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$this->user_id, $request->insurancename, $request->groupno, $request->rxbin, $request->rxpcn, $request->rxgroup, $request->phonenumber,$request->weburl,$request->address1,$request->address2]);

        return json_encode(array(
            'success' => 1
        ));
    }

    public function insurance_information_update(Request $request, $id)
    {

        if ($request->isMethod('post')) {

            $validator = $this->validate_insurance($request->all());

            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }

            $updated= DB::update('update patient_insurance set insurance_name = ?, group_no = ?, rxbin = ?, rxpcn = ?, rxgroup = ?, phone_number = ?,web_url = ?,address1 = ?,address2 = ? where id = ?', [$request->insurancename, $request->groupno, $request->rxbin, $request->rxpcn, $request->rxgroup, $request->phonenumber,$request->weburl,$request->address1,$request->address2,$id]);
            if($updated){
                return redirect('insurance-information')->with('success', 'Insurance details updated!');
            }else{
                return redirect('insurance-information/'.$id)->withInput($request->all())->with('error','Error adding details');
            }
        }


    }

    public function insurance_information_delete(Request $request)
    {

        $deleted =  DB::table('patient_insurance')->where('id', '=', $request->id)->delete();


        if($deleted){
            return redirect('insurance-information')->with('success', 'Deleted successfully');
        }else{
            return redirect('insurance-information')->withInput($request->all())->with('error','Error deleting details');
        }

    }

    public function preferred_pharmacy(Request $request)
    {
        $pharmacy_info = DB::table('patient_pharmacy')->where( 'user_id' ,$this->user_id)->get();

        $data = array(
            'pagetitle' =>  "Preferred Pharmacy"
        );

        if(isset($request->id)){
            $cur_info = DB::table('patient_pharmacy')->where( 'id' ,$request->id)->first();
            return view('preferred_pharmacy',['records'=>$pharmacy_info,'data' => $data,'current' => $cur_info]);
        }
        return view('preferred_pharmacy',['records'=>$pharmacy_info,'data' => $data,'current' => null]);
    }

    public function preferred_pharmacy_new(Request $request)
    {
        $validator = $this->validate_pharmacy($request->all());

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(),'success' => 0]);

        }

        DB::insert('insert into patient_pharmacy (user_id, pharmacy_name, address1, address2, refills_number,toll_free) values (?, ?, ?, ?, ?, ?)', [$this->user_id, $request->pharmacyname, $request->address1, $request->address2, $request->refillsnumber, $request->tollfree]);

        return json_encode(array(
            'success' => 1
        ));
    }

    public function preferred_pharmacy_update(Request $request, $id)
    {

        if ($request->isMethod('post')) {

            $validator = $this->validate_pharmacy($request->all());

            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }

            $updated= DB::update('update patient_pharmacy set pharmacy_name = ?, address1 = ?, address2 = ?, refills_number = ?,toll_free = ? where id = ?', [$request->pharmacyname, $request->address1, $request->address2, $request->refillsnumber, $request->tollfree,$id]);
            if($updated){
                return redirect('preferred-pharmacy')->with('success', 'Preferred Pharmacy details updated!');
            }else{
                return redirect('preferred-pharmacy/'.$id)->withInput($request->all())->with('error','Error adding details');
            }
        }


    }

    public function preferred_pharmacy_delete(Request $request)
    {

        $deleted =  DB::table('patient_pharmacy')->where('id', '=', $request->id)->delete();


        if($deleted){
            return redirect('preferred-pharmacy')->with('success', 'Deleted successfully');
        }else{
            return redirect('preferred-pharmacy')->withInput($request->all())->with('error','Error deleting details');
        }

    }
    public function faq()
    {
        $data = array(
            'pagetitle' =>  "FAQ"
        );
        return view('faq')->with('data', $data);
    }
    public function about_metis()
    {
        $data = array(
            'pagetitle' =>  "About Metis Advantage"
        );
        return view('about_metis')->with('data', $data);
    }
    public function contact_us()
    {
        $data = array(
            'pagetitle' =>  "Contact US"
        );
        return view('contact_us')->with('data', $data);
    }
    public function privacy()
    {
        $data = array(
            'pagetitle' =>  "Privacy"
        );
        return view('privacy')->with('data', $data);
    }
    public function terms_of_use()
    {
        $data = array(
            'pagetitle' =>  "Terms Of Use"
        );
        return view('terms_of_use')->with('data', $data);
    }

    /* Auto suggestion */
    public function provider_auto(Request $request)
    {
        $data = DB::table('patient_provider')->orWhere("first_name","LIKE","%{$request->input('query')}%")->orWhere('last_name', "LIKE","%{$request->input('query')}%")->orWhere('provider_org', "LIKE","%{$request->input('query')}%")->get();


        return response()->json($data);
    }
    public function symptoms(Request $request)
    {
        $data = DB::table('symptoms')->where( 'status' ,1)->orWhere("name","LIKE","%{$request->input('query')}%")->get();


        return response()->json($data);
    }
    public function bodylocated(Request $request)
    {
        $data = DB::table('body_parts')->where( 'status' ,1)->orWhere("name","LIKE","%{$request->input('query')}%")->get();


        return response()->json($data);
    }
    public function impairedactivity(Request $request)
    {
        $data = DB::table('impaired_activity')->where( 'status' ,1)->orWhere("name","LIKE","%{$request->input('query')}%")->get();


        return response()->json($data);
    }
    public function explore(Request $request)
    {
        $data = DB::table('explore')->where( 'status' ,1)->orWhere("name","LIKE","%{$request->input('query')}%")->groupBy('name')->get();


        return response()->json($data);
    }
}
