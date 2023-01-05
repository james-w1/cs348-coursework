<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubForum;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
            'image' => 'nullable|image|mimes:jpg,png,gif,jpeg,svg|max:2048',
            'user_id' => 'required',
            'sub_forum_id' => 'required'
        ]);

        $p = new Post;
        $p->title = $validatedData['title'];
        $p->body = $validatedData['body'];
        $p->user_id = $validatedData['user_id'];
        $p->sub_forum_id = $sub_forum->id;

        if (array_key_exists('image', $validatedData)) {
            $p->image_name = $validatedData['image']->getClientOriginalName();
            $p->image_path = $validatedData['image']->store('images', 'public');
        }

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
        return view('forum.editPost', ['sub_forum'=>$sub_forum, 'post'=>$post]);
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
        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,gif,jpeg,svg|max:2048',
            'user_id' => 'required',
            'sub_forum_id' => 'required'
        ]);

        if (Auth::user()->id == $validatedData['user_id']) {
            if (array_key_exists('image', $validatedData)) {
                $post->update([
                    'image_name' => $validatedData['image']->getClientOriginalName(),
                    'image_path' => $validatedData['image']->store('images', 'public'),
                ]); 
                unset($validatedData['image']);
            } else {
                unset($validatedData['image']);
            }

            $post->update($validatedData);

            session()->flash('message', 'Post was edited');
            return redirect()->route('forum.show', ['sub_forum'=>$sub_forum]);
        } else {
            return redirect()->route('forum.show', ['sub_forum'=>$sub_forum])->withErrors('Auth', 'Not authorised to edit this.');
        }
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
