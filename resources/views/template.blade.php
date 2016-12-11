<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>Actinet</title>

        <link href = "{{{ asset('/css/bootstrap.css') }}}" rel = "stylesheet" />
        <link href = "{{{ asset('/css/style.css') }}}" rel = "stylesheet" />
        <script type = "text/javascript" src = "{{{ asset('/js/jquery.js') }}}" ></script>
        <script type = "text/javascript" src = "{{{ asset('/js/bootstrap.min.js') }}}" ></script>
        <script type="text/javascript" src = "{{{ asset('/js/helpers.js') }}}"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    </head>


    <div class = "navbar navbar-inverse navbar-static-top">
        <div class = "container">
            <div class = "navbar-header" style = "width: 100%;">
                <h3>Open Discussion and Activism Network</h3>

                <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                </button>

                <div class = "collapse navbar-collapse navHeaderCollapse">
                    <ul class = "nav navbar-nav navbar-left">
                        <li><a href = "/">Home</a></li>
                        <li><a href = "/make-post">Make a Post</a></li>
                        <li><a href = "about">About/Contact</a></li>
                    </ul>


                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href = "{{ url('/u/edit') }}">
                                            Manage User Info
                                        </a>
                                    </li>
                                
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                </ul>
                            </li>
                        @endif
                    </ul>

                </div>

            </div>
        </div>
    </div>


    <div class = "container" width = "100%">
        @yield('container')
    </div>

    <div class = "footer">
        @yield('footer')
    </div>


</html>