<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/vis4/dist/vis.css" rel="stylesheet">
    <link href="/vis4/dist/vis-timeline-graph2d.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <script src="/vis4/dist/vis.js"></script>
    <script src="/vis4/dist/vis-timeline-graph2d.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/theme{{ session('theme') }}.css">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script>
        function myFunction() {
            var x = document.getElementById("select");
            var i = x.selectedIndex;
            document.getElementById("price").value = x.options[i + 1].text;
        }
    </script>
</head>
<style>
    html{
      position:relative; 
      min-height: 100%;
    }

    #app{
      margin-bottom:80px;
    }

    .footer{
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60px;
        background:#ccc;
    }
</style>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    @if (!empty(session('id')))
                    @include('layouts.css')
                    @include('layouts.modules')
                    @else
                    <a href="{{ url('/main') }}" class="navbar-brand">Hinolux</a>
                    @endif
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (empty(session('id')))
                            <li><a href="{{ url('/session') }}">Iniciar sesión</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li><a href="{{ url('/customizes') }}">Personalización</a></li>
                            <li><a href="{{ url('/session/close') }}">Cerrar sesión</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <!--div class="navbar navbar-default navbar-fixed-bottom" height="10">
        <div class="container" style="height:10px">
              <p class="navbar-text pull-left">© 2014 - Site Built By Mr. M.
                   <a href="http://tinyurl.com/tbvalid" target="_blank" >HTML 5 Validation</a>
              </p>
              
              <a href="https://www.facebook.com/Hinolux-SRL-259362990924047/" class="navbar-btn btn-danger btn pull-right">Únete a nuestra página de Facebook</a>
        </div>
    </div-->
    <div class="footer">
        <div class="container">
            <p class="navbar-text pull-left">© 2014 - Site Built By Mr. M.
                <a href="http://tinyurl.com/tbvalid" target="_blank" >HTML 5 Validation</a>
            </p>
        </div>
    </div>
    
</body>
</html>
