<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubForum;
use App\Models\Post;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subForums = SubForum::all();
        return view('forum.index', ['subForums' => $subForums]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $subForum = SubForum::findOrFail($id);
        return view('forum.createPost', ['subForum'=>$subForum]);
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
            'title' => 'required',
            'body' => 'required',
            'user_id' => 'required',
            'sub_forum_id' => 'required',
        ]);

        $p = new Post;
        $p->title = $validatedData['title'];
        $p->body = $validatedData['body'];
        $p->user_id = $validatedData['user_id'];
        $p->sub_forum_id = $validatedData['sub_forum_id'];
        $p->save();

        session()->flash('message', 'Post was created');
        return redirect()->route('forum.show', ['id'=>$validatedData['sub_forum_id']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subForum = SubForum::findOrFail($id);
        $posts = Post::all()->where('sub_forum_id', '=', $subForum->id);
        return view('forum.subForum', ['subForum'=>$subForum, 'posts'=>$posts]);
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
