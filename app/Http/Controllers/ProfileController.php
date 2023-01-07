<?php

namespace App\Http\Controllers;

use App\Models\IsFriendsWith;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Reply;
use App\Models\SubForum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $posts = Post::where('user_id', '=', $user->id)->get();
        $replies = Reply::where('user_id', '=', $user->id)->get();
        $following = $user->following;

        return view('forum.profile', [
            'user'=>$user,
            'posts'=>$posts,
            'replies'=>$replies,
            'following'=>$following,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('forum.profileSettings', ['user'=>$user]);
    }

    public function makeMod(User $user)
    {
        $user->update(['role_id'=>2]);

        $posts = Post::where('user_id', '=', $user->id)->get();
        $replies = Reply::where('user_id', '=', $user->id)->get();

        return view('forum.profile', [
            'user'=>$user,
            'posts'=>$posts,
            'replies'=>$replies,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'name' => $user->name, 
            'password' => $validated['password'],
        ])) {
            Auth::logout();
            Session::flush();
            $user->delete();

            return redirect()->route('forum.index');
        }
        return redirect()->route('profile.settings', ['user'=>$user])->withErrors([
            'password' => 'password is incorrect',
        ]);
    }
}
