<form action="post" method="post">
    {{ csrf_field() }}

    <textarea name="body" id="" cols="30" rows="10"></textarea>
    <input type="submit" value="publish">
</form>