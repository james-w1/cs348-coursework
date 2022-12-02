<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubForum;
use App\Models\Post;
use App\Models\Reply;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'body' => 'required',
            'post_id' => 'required',
            'user_id' => 'required',
        ]);

        $r = new Reply;
        $r->body = $validatedData['body'];
        $r->post_id = $validatedData['post_id'];
        $r->user_id = $validatedData['user_id'];
        $r->save();

        $post = Post::where('id', '=', $r->post_id)->first();
        $sub_forum = SubForum::where('id', '=', $post->sub_forum_id)->first();

        session()->flash('message', 'Reply was created');
        return redirect()->route('post.show', ['sub_forum'=>$sub_forum, 'post'=>$post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $pid
     * @return \Illuminate\Http\Response
     */
    public function show(SubForum $sub_forum, Post $post)
    {
        $replies = Reply::where('post_id', '=', $post->id)->paginate(7);
        $op = User::where('id', '=', $post->user_id)->first();
        return view('forum.post', ['subForum'=>$sub_forum, 'post'=>$post, 'replies'=>$replies, 'op'=>$op]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
