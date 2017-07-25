<?php
/**
 * Created by PhpStorm.
 * User: sunilkumar
 * Date: 07/06/17
 * Time: 11:59 PM
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Validator;

class AjaxController extends Controller
{
    protected $mailer;
//Override following methods:
    public function __construct(Mailer $mailer)
    {

        $this->middleware('guest');
        $this->mailer = $mailer;

    }

    protected function validate_email(array $data)
    {

        return Validator::make($data, [

            'email' => 'required|email',

        ]);
    }

    public function register_code(Request $request)
    {
        $validator = $this->validate_email($request->all());

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);

        }



        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $request_code=$randomString;

        $message = "Hello,\n\nThis is your new temporary access code to register Metis Advantage. \n\n".$request_code."\n\n If you need help, contact 3082032";

        $request->session()->put('request_code', $request_code);

        $this->mailer->raw($message, function (Message $m) use ($request) {
            $m->to($request->input('email'))->subject('Confirmation Code from Medis');
        });

        return json_encode(array(
            'msg' => "Request Accepted, Kindly check your email to Request Code"
        ));
    }
    public function resend_code(Request $request)
    {
        $validator = $this->validate_email($request->all());

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()]);
            }




        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $request_code=$randomString;

        $message = "Hello,\n\nThis is your new temporary access code to register Metis Advantage. \n\n".$request_code."\n\n If you need help, contact 3082032";

        $request->session()->put('request_code', $request_code);

        $this->mailer->raw($message, function (Message $m) use ($request) {
            $m->to($request->input('email'))->subject('Confirmation Code from Medis');
        });

        return json_encode(array(
            'msg' => "Request Accepted, Kindly check your email to Request Code"
        ));
    }

    public function confirm_code(Request $request)
    {
        if($request->input('confirm_code') == $request->session()->get('request_code')){
            return json_encode(array(
                'verified' => 1

            ));
        }else{
            return json_encode(array(
                'verified' => 0
            ));
        }



    }



}