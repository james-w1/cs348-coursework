<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SubForum;
use App\Models\Post;

class QuickReply extends Component {

    public $post;
    public $sub_forum;
    public $show = false;

    public function render() {
        return view('livewire.quick-reply', ['sub_forum'=>$this->sub_forum, 'post'=>$this->post]);
    }

    public function toggleShow() {
        $this->show =! $this->show;
    }
}

?>
