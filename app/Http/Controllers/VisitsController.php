<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use App\Visits;



class VisitsController extends Controller
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

        $this->middleware('auth');
        $this->user_id = Auth::user()->id;

    }

    protected function validate_visits(array $data)
    {

        return Validator::make($data, [
            'visitdate' => 'required',
            'visittime' => 'required',
            'providerid' => 'required',
            'visitreason' => 'required',
            'visitlocated' => 'required',
            'visitnote' => 'required',

        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        $sc_info = Visits::with('provider')->with('documents')->where( 'user_id','=',$this->user_id)->where('visit_date','>=',date("Y-m-d"))->orderBy('visit_date','asc')->get();
        $pt_info = Visits::with('provider')->with('documents')->where( 'user_id','=',$this->user_id)->where('visit_date','<',date("Y-m-d"))->orderBy('visit_date','asc')->get();
        /*echo "<pre>";
        print_r($sc_info);
        #echo $sc_info->provider->provider_org;
        echo "</pre>";*/
        $data = array(
            'pagetitle' =>  "Visits"
        );

        if(isset($request->id)){
            $cur_info = Visits::with('provider')->where( 'id' ,$request->id)->first();
            return view('visits',['sc_records'=>$sc_info,'pt_records'=>$pt_info,'data' => $data,'current' => $cur_info]);
        }
        return view('visits',['sc_records'=>$sc_info,'pt_records'=>$pt_info,'data' => $data,'current' => null]);

    }

    public function visits_new(Request $request)
    {

        if(Input::file('file')) {
            $file = Input::file('file');
            $file_name = $file->getClientOriginalName();
            $complete_path = 'images/documents/' . $file_name;

            $upload_success = $file->move(public_path('images/documents'), $file_name);


            if( $upload_success ) {
                $data_doc=$complete_path;
                Session::push('doc_path',$data_doc);


                return Response::json('success', 200);
            } else {
                return Response::json('error', 400);
            }

        }else{

            $validator = $this->validate_visits($request->all());

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors(),'success' => 0]);

            }

            $visit_id = DB::table('patient_visit_history')->insertGetId(['user_id'=> $this->user_id, 'provider_id'=> $request->providerid, 'visit_date'=> $request->visitdate,'visit_time'=> $request->visittime, 'visit_reason' =>$request-> visitreason, 'visit_located' => $request-> visitlocated,'visit_notes' => $request->visitnote]);
            if(Session::has('doc_path')){
                $document_path = Session::get('doc_path');
                if(count($document_path)==1)
                DB::insert('insert into patient_documents (user_id,visit_id ,`module`, doc_path) values (?, ?,?, ?)', [$this->user_id,$visit_id,'visits', $document_path[0] ]);
                else{
                    for($i=0; $i<count($document_path); $i++) {
                        DB::insert('insert into patient_documents(user_id,visit_id ,`module`, doc_path) values (?, ?,?, ?)', [$this->user_id,$visit_id,'visits', $document_path[$i] ]);

                    }
                }
                Session::forget('doc_path');
            }


        return json_encode(array(
            'success' => 1
        ));
        }

    }

    public function visits_update(Request $request, $id)
    {

        if ($request->isMethod('post')) {

            if (Input::file('file')) {
                $file = Input::file('file');
                $file_name = $file->getClientOriginalName();
                $complete_path = 'images/documents/' . $file_name;

                $upload_success = $file->move(public_path('images/documents'), $file_name);


                if ($upload_success) {
                    $data_doc = $complete_path;
                    Session::push('doc_path', $data_doc);


                    return Response::json('success', 200);
                } else {
                    return Response::json('error', 400);
                }

            } else {

                $validator = $this->validate_visits($request->all());

                if ($validator->fails()) {
                    $this->throwValidationException(
                        $request, $validator
                    );
                }


                $updated = DB::update('update patient_visit_history set provider_id=?, visit_date=?,visit_time=?, visit_reason=?, visit_located=?,visit_notes=? where id = ?', [$request->providerid, $request->visitdate, $request->visittime, $request->visitreason, $request->visitlocated, $request->visitnote, $id]);
                if ($updated) {

                    return redirect('visits')->with('success', 'Visit details updated!');
                } else {
                    return redirect('visits/' . $id)->withInput($request->all())->with('error', 'Error adding details');
                }
            }
        }

    }
}
