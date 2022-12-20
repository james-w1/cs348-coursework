<div class="bg-slate">
    <p> Quick Reply: </p>
    <form method="POST" action=" {{ route('post.reply', ['sub_forum'=>$sub_forum, 'post'=>$post]) }}">
        @csrf
        <p>Body: <input type="text" name="body" value="{{ old('body') }}"></p>
        <p>UserID: <input type="text" name="user_id" value="{{ old('user_id ') }}"></p>
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <input type="submit" value="Submit">
    </form>

</div>
