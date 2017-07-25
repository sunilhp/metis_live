<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Tickets;
use Auth;
use App\User;
use App\Claimbill;
use App\MessageDetails;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class AdvocacyController extends Controller
{
    protected $mailer;


    protected function validate_cb(array $data)
    {

        return Validator::make($data, [
            'doctorname' => 'required',
            'amount' => 'required',
            'subject' => 'required',
            'claimdesc' => 'required',
            'claimnotes' => 'required',

        ]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->middleware('auth');
        if(Auth::guest()){
            return redirect('login');
        }
        $this->mailer = $mailer;
        $this->middleware('auth');
        $this->user_id = Auth::user()->id;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = array(
            'pagetitle' => "Advocacy"
        );

        return view('advocacy')->with('data', $data);
    }
    public function sessions(Request $request)
    {
        $sc_info = DB::table('advocay_video_session_req')->where( 'user_id','=',$this->user_id)->where('request_date','>=',date("Y-m-d"))->orderBy('request_date','asc')->get();
        $pt_info = DB::table('advocay_video_session_req')->where( 'user_id','=',$this->user_id)->where('request_date','<',date("Y-m-d"))->orderBy('request_date','asc')->get();

        $data = array(
            'pagetitle' =>  "My Session"
        );

        if(isset($request->id)){
            $cur_info = DB::table('advocay_video_session_req')->where( 'id' ,$request->id)->first();
            return view('sessions',['records'=>$sc_info,'data' => $data,'current' => $cur_info]);
        }
        return view('sessions',['sc_records'=>$sc_info,'pt_records'=>$pt_info,'data' => $data,'current' => null]);

    }

    public function video_new()
    {
        $data = array(
            'pagetitle' => "Video Sessions"
        );
        return view('video_new')->with('data', $data);
    }
    public function video_confirmation()
    {
        $data = array(
            'pagetitle' => "Video Chat"
        );
        return view('video_confirmation')->with('data', $data);
    }
    public function video_request_code(Request $request)
    {
        $characters = '0123456789$#@&%ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $request_code=$randomString;

        $request->session()->put('request_video_code', $request_code);

        DB::insert('insert into advocay_video_session_req (user_id, help, video_chat, video_call, chat_message,request_date, request_time, request_code) values (?, ?, ?, ?,?, ?, ?, ?)', [$this->user_id, $request->help, $request->video_chat,$request->video_call,$request->chat_message,$request->request_date, $request->request_time,$request_code]);
        $user=Auth::user();
        $message = "Hello,\n\nThis is your new temporary confirmation code for Metis Advantage Video Chat. \n\n".$request_code."\n\n If you need help, contact 3082032";

        $this->mailer->raw($message, function (Message $m) use ($user) {
            $m->to($user->email)->subject('Activation mail');
        });

        return json_encode(array(
            'msg' => "Request Accepted, Kindly check your email to Request Code"
        ));
    }

    public function video_resend_code()
    {

        $sc_info = DB::table('advocay_video_session_req')->where( 'user_id','=',$this->user_id)->where('request_date','>=',date("Y-m-d"))->orderBy('request_date','asc')->first();

        if(count($sc_info)){
            $user=Auth::user();
            $message = "Hello,\n\nThis is your new temporary confirmation code for Metis Advantage Video Chat. \n\n".$sc_info->request_code."\n\n If you need help, contact 3082032";

            $this->mailer->raw($message, function (Message $m) use ($user) {
                $m->to($user->email)->subject('Activation mail');
            });
            return json_encode(array(
                'success' => 1
            ));
        }else{
            return json_encode(array(
                'success' => 0
            ));
        }


    }
    public function video_confirm(Request $request)
    {

        $sc_info = DB::table('advocay_video_session_req')->where( 'user_id','=',$this->user_id)->where( 'request_code','=',$request->ccode)->where('request_date','>=',date("Y-m-d"))->orderBy('request_date','asc')->first();

        if(count($sc_info)){

            return json_encode(array(
                'success' => 1
            ));
        }else{
            return json_encode(array(
                'success' => 0
            ));
        }


    }

    public function start_video()
    {
        $data = array(
            'pagetitle' =>  "Video Sessions"
        );
        $user_id = Auth::user()->id;
        $currentuser = User::find($user_id);

        $tickets = new Tickets;
        $tickets->user_id = $user_id;

        $tickets->save();

        $response = Curl::to('https://metisadvantage.ladesk.com/api/v3/calls/'.$tickets->id)
            ->withData( array( 'callId' => $tickets->id,
                'to_number' => '9999999999',
                'from_number' => $currentuser->pnumber,
                'ticketId' => '',
                'direction' => 'in',
                'apikey' => '0fca7dccba1aed8517ad44399c01d966' ) )
            ->post();
        print_r($response);

        return view('start_video')->with('data', $data);
    }
    public function start_phone()
    {
        $data = array(
            'pagetitle' =>  "Advocacy"
        );
        return view('start_phone')->with('data', $data);
    }
    public function start_chat()
    {
        $data = array(
            'pagetitle' =>  "Live Chat Session"
        );
        return view('start_chat')->with('data', $data);
    }

    public function claims_bills(Request $request)
    {
        #$sc_info = DB::table('advocacy_claim_bills')->where( 'user_id','=',$this->user_id)->orderBy('created_at','asc')->get();

        $data = array(
            'pagetitle' =>  "Claims/Bills"
        );


        $sc_info  = Claimbill::with('document_cb')->where( 'user_id','=',$this->user_id)->orderBy('created_at','asc')->get();


        #$sc_info = DB::table('advocacy_claim_bills')->where( 'user_id','=',$this->user_id)->orderBy('created_at','asc')->get();

        if(isset($request->id)){
            $cur_info = DB::table('advocacy_claim_bills')->where( 'id' ,$request->id)->first();
            return view('claims-bills-new',['records'=>$sc_info,'data' => $data,'current' => $cur_info]);
        }


        return view('claims-bills',['sc_records'=>$sc_info,'data' => $data,'current' => null]);

    }

    public function claims_bills_y(Request $request)
    {
        #$sc_info = DB::table('advocacy_claim_bills')->where( 'user_id','=',$this->user_id)->orderBy('created_at','asc')->get();

        $data = array(
            'pagetitle' =>  "Claims/Bills"
        );

        $sc_info  = Claimbill::with('document_cb')->where( 'user_id','=',$this->user_id)->whereYear( 'created_at','=',$request->id)->orderBy('created_at','asc')->get();

        return view('claims-bills',['sc_records'=>$sc_info,'data' => $data,'current' => null]);

    }

    public function claims_bills_new(Request $request)
    {
        if ($request->isMethod('post')) {
            if (Input::file('file')) {
                $file = Input::file('file');

                $file_name = $file->getClientOriginalName();
                $complete_path = 'images/claims-bills/' . $file_name;

                $upload_success = $file->move(public_path('images/claims-bills'), $file_name);

                if ($upload_success) {
                    $data_doc = $complete_path;

                        DB::insert('insert into patient_documents (user_id,visit_id ,`module`, doc_path) values (?, ?, ?, ?)', [$this->user_id,$request->claim_id,'claims-bills', $data_doc ]);





                    return Response::json('success', 200);
                } else {
                    return Response::json('error', 400);
                }

            }


            $validator = $this->validate_cb($request->all());

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors(),'success' => 0]);

            }
            $claim_id = DB::table('advocacy_claim_bills')->insertGetId(['user_id' => $this->user_id,'cb_doctor_name' => $request->doctorname,'cb_amount' => $request->amount, 'cb_subject' =>$request->subject,'cb_desc' => $request->claimdesc ,'cb_notes' =>$request->claimnotes ]);
            if($claim_id){

                return json_encode(array(
                    'success' => 1,
                    'claim_id' => $claim_id
                ));
            }
        }
        $data = array(
            'pagetitle' =>  "Claims/Bills"
        );

        $sc_info = DB::table('advocacy_claim_bills')->where( 'user_id','=',$this->user_id)->orderBy('created_at','asc')->get();

        if(isset($request->id)){
            $cur_info = DB::table('advocacy_claim_bills')->where( 'id' ,$request->id)->first();
            return view('claims-bills-new',['records'=>$sc_info,'data' => $data,'current' => $cur_info]);
        }
        return view('claims-bills-new',['sc_records'=>$sc_info,'data' => $data,'current' => null]);

    }

    public function messages(Request $request)
    {
        $message_info = DB::table('advocacy_message')->where( 'user_id','=',$this->user_id)->orderBy('created_at','asc')->get();


        $data = array(
            'pagetitle' =>  "Message Inbox"
        );

        if($request->q){
            $message_info = DB::table('advocacy_message')->where( 'user_id','=',$this->user_id)->where('message_subject', 'like', '%'.$request->q.'%')->orderBy('created_at','asc')->get();
            return view('messages',['records'=>$message_info, 'data' => $data, 'search' => $request->q]);
        }

        if(isset($request->id)){
            DB::update('update advocacy_message set message_status = ? where id = ?', ['1', $request->id]);
            if ($request->isMethod('post')) {

                DB::insert('insert into advocacy_message_details (message_id,message_by,message_detail ,message_status,created_at) values (?, ?, ?, ?,?)', [$request->id,$this->user_id,$request->msgcontent, '0', Carbon::now()]);

                return json_encode(array(
                    'success' => 1
                ));
            }
            $cur_info = MessageDetails::with('message')->where( 'message_id' ,$request->id)->orderBy('created_at','asc')->get();

            $data = array(
                'pagetitle' => str_limit("Re: ".$cur_info[0]->message->message_subject,20)
            );

            #echo "<pre>";
            #print_r($cur_info);
            #echo "</pre>";
            return view('messages-reply',['records'=>$cur_info,'data' => $data]);
        }
        return view('messages',['records'=>$message_info, 'data' => $data,'search' => null]);

    }




}
