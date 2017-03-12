<form action="nickname" method="post">
    {{ csrf_field() }}
    <input type="text" name="nickname" placeholder="Create nickname">
    <input type="submit" value="Create">
</form>
or <a href="logout">logout</a>


@if($errors->any())
    <h4>{{$errors->first()}}</h4>
@endif