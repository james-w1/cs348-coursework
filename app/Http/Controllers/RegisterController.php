<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forum.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $u = new User;
        $u->name = $validatedData['user_name'];
        $u->email = $validatedData['email'];
        $u->password = Hash::make($validatedData['password']);
        $u->role_id = 3;
        $u->save();

        Auth::login($u);

        session()->flash('message', 'New user registered');
        return redirect()->route('forum.index');
    }
}
