<?php

namespace App\Http\Controllers\Auth;

use App\User;
//use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'pnumber' => 'required|min:10',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
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
        $user_data = $request->all();
        $validator = $this->validator($user_data);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($user_data);

        # $this->activationService->sendActivationMail($user);

        $user_id = $user->id;

        //send user confirm request email

        $user_email = $user_data['email'];

        //$code = base64_encode($user_id);
        $code = $user_id;

        $user_data['code'] = $code;

        if ($_SERVER['HTTP_HOST'] != "localhost") {
            Mail::send('emails.user_signup_confirm', $user_data, function ($message) use ($user_email) {
                $message->to($user_email)->subject('Welcome to Metis');
            });
        }

        return redirect('/login');
    }

    public function confirm_user_account($code)
    {
        //$user_id = base64_decode($code);
        $user_id = $code;
        $user = User::find($user_id);
        if ($user) {
            $user->activated = 1;
            $user->save();
        }
        return Redirect::to('/');
    }

}
