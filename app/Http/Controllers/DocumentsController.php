<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Response;


class DocumentsController extends Controller
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

    protected function validate_notes(array $data)
    {

        return Validator::make($data, [
            'notes' => 'required'
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = array(
            'pagetitle' => "Documents"
        );

        return view('documents')->with('data', $data);
    }

    public function medical()
    {

        if (Input::file('file')) {
            $file = Input::file('file');

            $file_name = $file->getClientOriginalName();
            $complete_path = 'images/medical-documents/' . $file_name;

            $upload_success = $file->move(public_path('images/medical-documents'), $file_name);

            if ($upload_success) {
                $data_doc = $complete_path;
                DB::insert('insert into patient_documents (user_id,visit_id ,`module`, doc_path) values (?, ?, ?, ?)', [$this->user_id,0,'medical-documents', $data_doc ]);
               # DB::update('update users set profile_pic = ? where id = ?', [$data_doc, $this->user_id]);
                return Response::json('error', 200);
            } else {
                return Response::json('error', 400);
            }

        }
        $data = array(
            'pagetitle' => "Medical Documents"
        );

        $med_info = DB::table('patient_documents')->where( 'user_id' ,$this->user_id)->where( 'module' ,'medical-documents')->get();
        return view('document-upload',['records'=>$med_info,'data' => $data]);
    }

    public function claims()
    {

        $data = array(
            'pagetitle' => "Claims Documents"
        );

        if (Input::file('file')) {
            $file = Input::file('file');

            $file_name = $file->getClientOriginalName();
            $complete_path = 'images/claim-documents/' . $file_name;

            $upload_success = $file->move(public_path('images/claim-documents'), $file_name);

            if ($upload_success) {
                $data_doc = $complete_path;
                DB::insert('insert into patient_documents (user_id,visit_id ,`module`, doc_path) values (?, ?, ?, ?)', [$this->user_id,0,'claim-documents', $data_doc ]);
                # DB::update('update users set profile_pic = ? where id = ?', [$data_doc, $this->user_id]);
                return Response::json('error', 200);
            } else {
                return Response::json('error', 400);
            }

        }

        $claim_info = DB::table('patient_documents')->where( 'user_id' ,$this->user_id)->where( 'module' ,'claim-documents')->get();
        return view('document-upload',['records'=>$claim_info,'data' => $data]);
    }


    public function notes(Request $request)
    {

        $data = array(
            'pagetitle' => "Notes"
        );

        if ($request->isMethod('post')) {


            $updated = DB::update('update patient_notes set notes = ? where id = ?', [$request->notes, $request->id]);
            if($updated){
                return redirect('documents/notes')->with('success', 'Provider details updated!');
            }

        }

        if(isset($request->id)){
            $notes_info = DB::table('patient_notes')->where( 'user_id' ,$this->user_id)->where( 'id' ,$request->id)->first();
            return view('notes_new',['data' => $data,'current' => $notes_info]);
        }

        $notes_info = DB::table('patient_notes')->where( 'user_id' ,$this->user_id)->get();
        return view('notes',['records'=>$notes_info,'data' => $data]);

    }


    public function notes_new()
    {

        $data = array(
            'pagetitle' => "Notes"
        );



        return view('notes_new')->with('data', $data);
    }

    public function notes_save(Request $request)
    {

        $validator = $this->validate_notes($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $updated = DB::insert('insert into  patient_notes (user_id,notes) values (?,?)', [$this->user_id,$request->notes]);

        if($updated){
            return redirect('documents/notes')->with('success', 'Notes Added!');
        }else{
            return redirect('documents/notes_new')->withInput($request->all())->with('error','Error adding note');
        }

    }


    public function insurance()
    {

        $data = array(
            'pagetitle' => "Insurance Documents"
        );

        if (Input::file('file')) {
            $file = Input::file('file');

            $file_name = $file->getClientOriginalName();
            $complete_path = 'images/insurance-documents/' . $file_name;

            $upload_success = $file->move(public_path('images/insurance-documents'), $file_name);

            if ($upload_success) {
                $data_doc = $complete_path;
                DB::insert('insert into patient_documents (user_id,visit_id ,`module`, doc_path) values (?, ?, ?, ?)', [$this->user_id,0,'insurance-documents', $data_doc ]);
                # DB::update('update users set profile_pic = ? where id = ?', [$data_doc, $this->user_id]);
                return Response::json('error', 200);
            } else {
                return Response::json('error', 400);
            }

        }

        $ins_info = DB::table('patient_documents')->where( 'user_id' ,$this->user_id)->where( 'module' ,'insurance-documents')->get();
        return view('document-upload',['records'=>$ins_info,'data' => $data]);
    }
}
