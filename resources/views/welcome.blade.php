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
@endforeach


</body>
</html>