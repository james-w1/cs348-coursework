<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forum.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'name'=> 'required',
            'password'=> 'required',
        ]);

        if (Auth::attempt($credentials, $request->get('remember'))) {
            return redirect()->route('forum.index');
        }

        dd(Auth::attempt($credentials));

        return back()->withErrors([
            'name' => 'name failed',
            'password' => 'pass failed'
        ]);
    }
}
