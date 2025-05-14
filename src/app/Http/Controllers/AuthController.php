<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function step1()
    {
        return view('auth.step1_register');
    }

    public function step2()
    {
        return view('auth.step2_register');
    }

}
