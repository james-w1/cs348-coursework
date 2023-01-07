<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\IsFriendsWith;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class FollowingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $ifw = new IsFriendsWith;
        $ifw->user_id = Auth::user()->id;
        $ifw->friend_id = $user->id;
        $ifw->save();

        return redirect()->route('profile.show', ['user'=>$user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $ifw = IsFriendsWith::where([
            ['user_id', '=', Auth::user()->id],
            ['friend_id', '=', $user->id],
        ])->delete();

        return redirect()->route('profile.show', ['user'=>$user]);
    }
}
