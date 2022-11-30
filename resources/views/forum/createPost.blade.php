
<form method="POST" action=" {{ route('forum.store', ['id'=>$subForum->id]) }}">
    @csrf
    <p>Title: <input type="text" name="title"></p>
    <p>Body: <input type="text" name="body"></p>
    <p>UserID: <input type="text" name="userID"></p>
    <input type="hidden" name="subForum" value="{{ $subForum->id }}">

    <input type="submit" value="Submit">
</form>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p style="color: red;">{{ $error }}</p>
    @endforeach
@endif
