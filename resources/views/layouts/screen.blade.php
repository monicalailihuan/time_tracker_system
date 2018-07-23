<!DOCTYPE html>
<html lang="{{ Auth::user()->language }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SmartStripe</title>
    {{-- <title>{{ config('app.name', 'Card Print') }}</title> --}}

    <!-- Styles -->
    <link rel="icon" href="/images/favicon.png" type="image/png" sizes="14x14">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/flag-icon.min.css" rel="stylesheet">
    <link href="/css/general.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @yield('style')

</head>
<body class="general-bg">
        <nav class="navbar navbar-default navbar-static-top">
            <div id="app" class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="{{ url('/') }}">
                        <span class="ss-icons ss-icon-logo"></span>
                    </a>
                </div>
                

                <div class="collapse navbar-collapse" id="app-navbar-collapse">

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                  <i class="fa fa-caret-down"></i>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}" 
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out pull-left"></i>
                                            {{ trans('index.logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
        <div class="bg-layout">
            <img src="/images/general-bg.png" alt="">
        </div>
        <div id="app" class="container-fluid">
            <div class="loading hide-item">
                <div class="loader"></div>
            </div>
            @include('flash::message')
            @yield('content')
            
        </div>
        
        <div id="app" class="noti_flash">
            <div class="row">
                <div class="col-xs-2 rightline-dark">
                    <div class="fa fa-bell"></div>
                </div>
                <div class="col-xs-10">
                    You got new notification.
                </div>
            </div>
        </div>

        <footer></footer>
        

    <!-- Scripts -->
    <script src="/js/app.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
          if (Notification.permission !== "granted")
            Notification.requestPermission();
        });

        function notifyMe() {
          if (!Notification) {
            alert('Desktop notifications not available in your browser. Try Chromium.'); 
            return;
          }

          if (Notification.permission !== "granted")
            Notification.requestPermission();
          else {
            var notification = new Notification('SmartStripe Notification', {
              icon: 'images/favicon.png',
              body: "Hey there! You've been notified!",
            });

            notification.onclick = function () {
              window.open("https://SmartStripe.io/");      
            };
            
          }

        }

        $('#flash-overlay-modal').modal();
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });

        $("button").click(function(ev){
          if($(this).data('dismiss')==null && $(this).data('toggle')==null && !$(this).hasClass("pswp__button")){
            $('form').submit(function(e){
              $('.loading').addClass('show');
            });
          }
        });



      

    </script>

    @yield('script')

</body>
</html>
