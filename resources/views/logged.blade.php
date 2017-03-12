hello {{ Auth::user()->nickname }},

<a href="{{ url('logout') }}">logout</a>
