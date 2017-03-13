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
        .liked {
            background-color : red;
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
    <?php $liked = $post->user->like->where('el_id', $post->id)->where('category', 'post'); ?>
    @if(count($liked) == 0)
        <a href="#" id="like" like-id="{{ $post->id }}" class="" like-category='post'>Like</a>
    @else
        <a href="#" id="like" like-id="{{ $post->id }}" class="liked" like-category='post'>Like</a>
    @endif


@endforeach

<script>
    $('#like').click(function (e) {
        el = $(this);
        id = el.attr("like-id");
        category = el.attr('like-category');
        $.get( "like/"+id+"/"+category, function( data ) {
            console.log(data);
            if(data.liked){
                el.addClass('liked');
            }else{
                el.removeClass('liked');
            }
        });
    });
</script>
</body>
</html>