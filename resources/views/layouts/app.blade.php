<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">


    <!-- Styles -->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="icon" href="{{ url('/') }}/img/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ url('/resources/assets/img/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ url('/resources/assets/img/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ url('/resources/assets/img/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('/resources/assets/img/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url('/resources/assets/img/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url('/resources/assets/img/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ url('/resources/assets/img/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('/resources/assets/img/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/resources/assets/img/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ url('/resources/assets/img/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('/resources/assets/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ url('/resources/assets/img/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/resources/assets/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ url('/resources/assets/img/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ url('/resources/assets/img/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <title>Metis Advantage</title>
    <!-- Bootstrap core CSS -->
    <script src="//use.fontawesome.com/21e3f594d0.js"></script>
    <link href="{{ url('/resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('/resources/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('/resources/assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">

</head>
<body id="app-layout">
@if( Auth::check() )
    @include('layouts.menu')
<header>
    <div class="container">
        <span class="mob_nav" id="menu_click"></span>
        @if(Request::path() === '/')
        <a href="{{ url('/') }}" class="logo"><img src="{{ url('/resources/assets/img/logo.png') }}" alt="logo"/></a>
        @else
        <h1>{{ $data['pagetitle'] }}</h1>
        <a href="{{ url('/') }}" class="home"><img src="{{ url('/resources/assets/img/home.png') }}" alt="logo"/></a>
        @endif

    </div>
</header>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <span class="error">@if(isset($error)) {{ $error }}  @endif @if (session('error')) {{session('error')}} @endif</span>
    <span class="success">@if(isset($success)) {{ $success }} @endif @if (session('success')) {{session('success')}} @endif</span>
@endif

<?php /*

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Laravel
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
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
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
*/ ?>
@if (Auth::guest())
<section class="@if(Request::path() === 'register') reg_page @else login @endif">
    <div class="container">
        <a href="javascript:void(0);" class="backbtn" onclick="window.history.back();">Back</a>
        <div class="clearfix"></div>
        <a href="{{ url('/') }}" class="loginLogo"><img src="{{ url('/resources/assets/img/loginLogo.png') }}" alt="logo"/></a>
        <div class="clearfix"></div>
@endif
    @yield('content')
@if (Auth::guest())
    </div>
</section>
@endif

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="{{ url('/resources/assets/js/typeahead.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="{{ url('/resources/assets/js/custom.js') }}"></script>
    <script src="{{ url('/resources/assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

<script type="text/javascript">
    $(".faq_ul li h2").click(function(){
        $(this).parent().toggleClass("open" , 1000);
    });
</script>

@yield('js')

<div class="modal myModal5 fade" tabindex="-1" role="dialog" id="logout">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">




                <h3>Are you sure you want to log out?</h3>



                <div class="btns">
                    <a href="#" class="cancel" data-dismiss="modal">No</a>
                    <a href="{{ url('/logout') }}" class="submit_btn" id="symptoms-submit">Yes</a>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>
