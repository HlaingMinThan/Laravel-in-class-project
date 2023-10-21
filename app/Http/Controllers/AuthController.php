<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function login()
    {
        return view('login.create');
    }

    public function loginStore()
    {
        request()->validate([
            'email' => ['required', Rule::exists('users', 'email')],
            'password' => ['required', 'min:8']
        ]);
        if (auth()->attempt([
            'email' => request('email'),
            'password' => request('password'),
        ])) {
            return redirect('/');
        } else {
            return redirect('/login')->withErrors([
                'password' => 'your password is something wrong'
            ])->withInput();
        }
    }

    public function register()
    {
        return view('register.create');
    }

    public function registerStore()
    {
        $cleanData =  request()->validate([
            'name' => ['required', 'max:20'],
            'username' => ['required', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'max:20', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8'],
        ], [
            'name.max' => "name should not be more than 20 characters."
        ]);

        $user = User::create($cleanData);

        auth()->login($user);

        return redirect('/')->with('success', 'welcome from creativecoder. ' . auth()->user()->name);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
