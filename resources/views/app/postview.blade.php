{{ $post->body }}


<br><br><br>
<h1>Comments:</h1>
@foreach($post->comment as $comment)
    {{ $comment->user->nickname }} : {{ $comment->body }}<br><br>
@endforeach

<br><br><br><br>


@if(Auth::check())
    <h2>Add comment:</h2>
    <form action="{{ url('comment') }}" method="post">
        {{ csrf_field() }}
        <textarea name="body" id="" cols="30" rows="10"></textarea>
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <input type="submit" value="comment">
    </form>
@else
    <a href="{{ url('login') }}">Login</a>
    You are not signed in.
@endif
