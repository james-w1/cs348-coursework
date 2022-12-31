<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubForum;
use App\Models\Post;
use App\Models\User;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_forums = SubForum::paginate();
        return view('forum.index', ['sub_forums' => $sub_forums]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SubForum $sub_forum)
    {
        #$subForum = SubForum::findOrFail($id);
        return view('forum.createPost', ['sub_forum'=>$sub_forum]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SubForum $sub_forum)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'user_id' => 'required',
            'sub_forum_id' => 'required'
        ]);

        $p = new Post;
        $p->title = $validatedData['title'];
        $p->body = $validatedData['body'];
        $p->user_id = $validatedData['user_id'];
        $p->sub_forum_id = $validatedData['sub_forum_id'];
        $p->save();

        session()->flash('message', 'Post was created');
        return redirect()->route('forum.show', ['sub_forum'=>$sub_forum]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SubForum $sub_forum)
    {
        $posts = Post::where('sub_forum_id', '=', $sub_forum->id)->orderBy('created_at', 'desc')->paginate(7);
        return view('forum.subForum', ['sub_forum'=>$sub_forum, 'posts'=>$posts]);
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
