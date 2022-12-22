<div>
    <button 
        class="px-4 rounded-md bg-primary-200 hover:bg-secondary-300 hover:text-primary-100"
        wire:click="toggleShow"
    >Quick Reply</button>
    
    @if ($show)
    <div class="absolute flex p-2 rounded-md bg-primary-300">
        <form method="POST" action=" {{ route('post.reply', ['sub_forum'=>$sub_forum, 'post'=>$post]) }}">
            @csrf
            <p>Body: <input class="rounded-md bg-primary-100" type="text" name="body" value="{{ old('body') }}"></p>
            <p>UserID: <input class="rounded-md outline-primary-800 bg-primary-100" type="text" name="user_id" value="{{ old('user_id ') }}"></p>
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input wire:click="toggleShow" class="p-1 rounded-lg bg-primary-100" type="submit" value="Submit">
        </form>
    </div>
    @endif
</div>
