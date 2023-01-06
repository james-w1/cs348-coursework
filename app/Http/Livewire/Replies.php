<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\SubForum;
use App\Models\Post;
use App\Models\Reply;
use Livewire\WithPagination;

class Replies extends Component 
{
    use WithPagination;

    public $post;
    public $sub_forum;
    public $replies;
    public $show;
    public $body;
    public $user_id;

    public $editing_body;
    public $editing_id;
    public $editing;

    public function render()
    {
        $paginated = Reply::where('post_id', '=', $this->post->id)->paginate(7);
        $this->replies = collect($paginated->items());

        return view('livewire.replies', [
            'post'=>$this->post,
            'sub_forum'=>$this->sub_forum, 
            'paginated_replies'=>$paginated,
        ]);
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
        $r->user_id = auth()->user()->id;
        $r->post_id = $this->post->id;
        $r->save();

        $this->body = "";
        $this->replies[] = $r;
        $this->render();
    }
    
    public function remove(Reply $reply) {
        $reply->delete();
        $this->render();
    }

    public function edit(Reply $reply) {
        $this->editing_id = $reply->id;
        $this->editing_body = $reply->body;
        $this->editing = true;
    }

    public function closeEdit() {
        $this->editing_id = null;
        $this->editing = false;
    }

    public function update() {
        $validated = $this->validate([
            'editing_body' => 'required|max:1024',
        ]);

        $reply = Reply::where('id', '=', $this->editing_id)->first();
        $reply->update([
            'body' => $validated['editing_body'],
        ]);

        $this->closeEdit();
        $this->render();
    }

}

?>
