<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\SubForum;
use App\Models\Post;
use App\Models\Reply;

class QuickReply extends Component {

    public $post;
    public $sub_forum;
    public $show = false;
    public $body;
    public $post_id;
    public $user_id;

    public function render() {
        $this->user_id = auth()->user()->id;
        return view('livewire.quick-reply', ['sub_forum'=>$this->sub_forum, 'post'=>$this->post]);
    }

    public function toggleShow() {
        $this->show =! $this->show;
    }

    public function submit() {
        $validated = $this->validate([
            'body' => 'required',
        ]);

        $r = new Reply;
        $r->body = $validated['body'];
        $r->user_id = $this->user_id;
        $r->post_id = $this->post->id;
        $r->save();

        return redirect()->route('post.show', ['sub_forum'=>$this->sub_forum, 'post'=>$this->post]);
    }
}

?>
