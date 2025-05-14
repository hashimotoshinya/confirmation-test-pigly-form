<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\WeightTarget;
use App\Http\Requests\Step1RegisterRequest;
use App\Http\Requests\Step2RegisterRequest;
use App\Http\Requests\GoalUpdateRequest;

class RegisterUserController extends Controller
{
    public function showStep1Form()
    {
        return view('auth.step1_register');
    }

    public function storeStep1(Step1RegisterRequest $request)
    {
        if (User::where('email', $request->email)->exists()) {
            return redirect()->route('register.step1.form')->withErrors([
                'email' => 'このメールアドレスは既に登録されています。',]);
        }

        session([
            'register.name' => $request->name,
            'register.email' => $request->email,
            'register.password' => $request->password,
        ]);

        return redirect()->route('register.step2.form');
    }

    public function showStep2Form()
    {
        if (!session()->has('register.name') || !session()->has('register.email') || !session()->has('register.password'))
        {
            return redirect()->route('register.step1.form')->with('error', '最初からやり直してください。');
        }

        return view('auth.step2_register');
    }

    public function storeStep2(Step2RegisterRequest $request)
    {
        $name = session('register.name');
        $email = session('register.email');
        $rawPassword = session('register.password');

        if (!$name || !$email || !$rawPassword)
        {
            return redirect()->route('register.step1.form')->with('error', '最初からやり直してください。');
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($rawPassword),
        ]);

        WeightTarget::create([
            'user_id' => $user->id,
            'target_weight' => $request->target_weight,
        ]);

        Auth::login($user);

        session()->forget(['register.name', 'register.email', 'register.password']);

        return redirect()->route('weight_logs.index');
    }

}
