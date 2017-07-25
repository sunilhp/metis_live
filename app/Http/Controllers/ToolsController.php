<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\MessageDetails;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;



class ToolsController extends Controller
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

    protected function validate_symptoms(array $data)
    {

        return Validator::make($data, [
            'symdate' => 'required',
            'symtime' => 'required',
            'symptoms' => 'required',
            'howbad' => 'required',
            'located' => 'required',
            'icant' => 'required',

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
            'pagetitle' => "Tools"
        );

        return view('tools')->with('data', $data);
    }
    public function symptom_tracker(Request $request)
    {

        if ($request->isMethod('post')) {
            $validator = $this->validate_symptoms($request->all());

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'success' => 0]);

            }

            $symptom_id = DB::table('symptom_tracker')->insertGetId(['user_id' => $this->user_id, 'symptom_title' => $request->symptoms, 'how_bad' => $request->howbad, 'sym_time' => $request->symtime, 'sym_date' => $request->symdate, 'symptom_located' => $request->located, 'symptom_cant' => $request->icant, 'created_at' => Carbon::now() ]);
            if ($symptom_id) {
                return json_encode(array(
                    'success' => 1
                ));
            }



        }
        $sc_info = DB::table('symptom_tracker')->where( 'user_id','=',$this->user_id)->orderBy('created_at','asc')->get();
        $data = array(
            'pagetitle' => "Symptom Tracker"
        );

        return view('symptom_tracker',['records'=>$sc_info,'data' => $data,'current' => null]);
    }

    public function symptom_tracker_query(Request $request)
    {

        if($request->id != "All")
            $sc_info = DB::table('symptom_tracker')->where('created_at', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL '.$request->id.' DAY)'))->where( 'user_id','=',$this->user_id)->orderBy('created_at','asc')->get();
        else
            $sc_info = DB::table('symptom_tracker')->where( 'user_id','=',$this->user_id)->orderBy('created_at','asc')->get();

        $data = array(
            'pagetitle' => "Symptom Tracker"
        );

        return view('symptom_tracker',['records'=>$sc_info,'data' => $data,'current' => null]);
    }

    public function explore(Request $request)
    {

        if ($request->isMethod('post')) {
            $validator = $this->validate_symptoms($request->all());

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'success' => 0]);

            }

            $symptom_id = DB::table('symptom_tracker')->insertGetId(['user_id' => $this->user_id, 'symptom_title' => $request->symptoms, 'how_bad' => $request->howbad, 'sym_time' => $request->symtime, 'sym_date' => $request->symdate, 'symptom_located' => $request->located, 'symptom_cant' => $request->icant, 'created_at' => Carbon::now() ]);
            if ($symptom_id) {
                return json_encode(array(
                    'success' => 1
                ));
            }



        }
        $sc_info = DB::table('symptom_tracker')->where( 'user_id','=',$this->user_id)->orderBy('created_at','asc')->get();
        $data = array(
            'pagetitle' => "Explore"
        );

        return view('explore',['records'=>$sc_info,'data' => $data,'current' => null]);
    }

}
