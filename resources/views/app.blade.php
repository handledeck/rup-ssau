<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Rup Ssau</title>

   <link rel="stylesheet" href="{{ asset('css/lib/bootstrap/bootstrap3.3.1.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/lib/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/lib/ionicons/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}" id="theme-css"/>
    <script src="{{ asset('js/lib/jquery/jquery-2.2.1.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/lib/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/lib/tabdrop/bootstrap-tabdrop.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/lib/slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts.min.js')}}" type="text/javascript"></script>
     <style>
        .dash-controls
                 {
                    padding-top: 1px;!important

                 }
                   .icon{
                             font-size:14px;!important
                          }

        </style>
</head>
<body>
@if(!Auth::guest())
<header>
    <nav class="navbar navbar-default navbar-transparent">
        <div class="container-fluid" id="nav-container">
            <div class="navbar-header">
                <button id="btnone" class="navbar-toggle navbar-toggle-settings" data-target="#top-navbar" data-toggle="collapse"
                        type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="ion ion-ios7-gear-outline"></i>
                </button>
                <a class="navbar-brand logo" href="#">
                    <h4 style="margin-left: 30px;text-shadow: 0 1px #ffffff"><b>Служба САУ</b></h4>
                </a>

                <div class="navbar-side-menu-toggle">
                    <button class="toggle-btn" type="button">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="top-navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> {{ Auth::user()->name }} <i
                                class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <!--<li><a href="app_settings.html">Account Settings</a></li>-->
                           <!-- <li class="divider"></li>-->
                            <li><a href={{ url('/auth/logout') }}>Выход</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="container-fluid" id="content-container">
    <div class="content-wrapper">
        <div class="row">
            <div class="side-nav-content">
                <div class="left-side-wrapper">
                    <div class="left-side sticky-left-side">
                        <div class="left-side-inner">
                             @include('menu\menu')
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-content-wrapper">    
                @yield('content')
            </div>   
        </div>          
    </div>
</div>
<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <ul class="list-inline">
                    <li>
                        <small>РУП Витебскэнерго</small>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
@else
 @yield('content')
@endif
<script>
</script>
</body>
</html>