<?php
/**
 * Created by PhpStorm.
 * User: sunilkumar
 * Date: 07/06/17
 * Time: 11:59 PM
 */
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;



class RegisterController
{
//Add protected variable:
    protected $activationService;

//Override following methods:
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');

    }

    protected function validator(array $data)
    {

        $messages = [
            'fname.required' => 'First Name is required.',
        ];
        return Validator::make($data, [
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'pnumber' => 'required|min:10',

        ],$messages);
    }

    protected function create(array $data)
    {
        return User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'pnumber' => $data['pnumber'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($request->all());

        #$this->activationService->sendActivationMail($user);

        return redirect('/login');
    }
}