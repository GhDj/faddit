<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .post {
            display: block;
            width: 100%;
            height: 100%;
            text-decoration: none;
            color: #000;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
    </script>
</head>
<body>
@if(Auth::check())
    @include('app.posts')
@else
    <a href="login">Login</a>
    You are not signed in.
@endif


@foreach($posts as $post)
    <a href="post/{{ $post->id }}" class="post">
        <div style="border: 1px solid; margin: 20px;">{{ $post->user->nickname }} : {{ $post->body }}</div>
    </a>
    <a href="#" id="postlike" post-id="{{ $post->id }}">Like</a>
        <a href="#" id="postdislike" post-id="{{ $post->id }}">Dislike</a>
    {{ Form::token() }}
@endforeach

<script>
    $('#postlike').click(function (e) {
         id = $(this).attr("post-id");
        console.log(id);
        $.get( "postlike/"+id, function( data ) {

            alert( data);
        });
    });

    $('#postdislike').click(function (e) {
        id = $(this).attr("post-id");
        $.ajax({
            url: 'removepostlike',
            type: 'post',
            data: {'id':id, '_token': $('input[name=_token]').val()},
            success: function(data){
                alert(data);
            }
        });
    });
</script>
</body>
</html>