<?php
/**
 * Created by PhpStorm.
 * User: sunilkumar
 * Date: 08/06/17
 * Time: 12:01 AM
 */

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;


class LoginController
{
    //Add protected variable:


//modify `__construct()`:
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);

    }


}