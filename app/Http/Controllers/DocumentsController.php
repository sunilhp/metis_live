<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;



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

        $data = array(
            'pagetitle' => "Documents"
        );

        return view('documents')->with('data', $data);
    }

    public function claims()
    {

        $data = array(
            'pagetitle' => "Documents"
        );

        return view('documents')->with('data', $data);
    }


    public function notes()
    {

        $data = array(
            'pagetitle' => "Notes"
        );

        return view('notes')->with('data', $data);
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
            'pagetitle' => "Documents"
        );

        return view('documents')->with('data', $data);
    }
}
