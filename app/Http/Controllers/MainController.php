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
            'image' => 'image|mimes:jpg,png,gif,jpeg,svg|max:2048',
            'user_id' => 'required',
            'sub_forum_id' => 'required'
        ]);

        $p = new Post;
        $p->title = $validatedData['title'];
        $p->body = $validatedData['body'];

        if (in_array('image', $validatedData)) {
            $p->image_name = $validatedData['image']->getClientOriginalName();
            $p->image_path = $validatedData['image']->store('images', 'public');
        } else {
            $p->image_name = null;
            $p->image_path = null;
        }

        $p->user_id = $validatedData['user_id'];
        $p->sub_forum_id = $sub_forum->id;
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
     * @param  SubForum $sub_forum
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(SubForum $sub_forum, Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @param  SubForum $sub_forum
     * @param  Post $post
     */
    public function update(Request $request, SubForum $sub_forum, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  SubForum $sub_forum
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubForum $sub_forum, Post $post)
    {
        $post->delete();

        return redirect()->route('forum.show', ['sub_forum'=>$sub_forum])
            ->with('success', 'post deleted');
    }
}
