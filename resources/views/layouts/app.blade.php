<!DOCTYPE html>
<html lang="{{ Auth::user()->language }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Staff Management</title>

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

    <style>
        .head_link li{
            font-size: 1.2em;
            padding: 0 10px;
        }


        .head_link li a:hover{
            text-decoration: none;
        }
    </style>
    @yield('style')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Staff Management') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto head_link">
                        <li><a class="nav navbar-nav" title="Company" href="{{ url('/company') }}"><i class="fa fa-building"></i></a></li>
                        <li><a class="nav navbar-nav" title="Engagement" href="{{ url('/engagement') }}"><i class="fa fa-folder"></i></a></li>
                        @can('admin')
                            <li><a class="nav navbar-nav" title="Staff" href="{{ url('/staff') }}"><i class="fa fa-user"></i></a></li>
                        @endcan
                        @can('sa')
                            <li><a class="nav navbar-nav" title="Report" href="{{ url('/report') }}"><i class="fa fa-line-chart"></i></a></li>
                        @endcan
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
      
    <div id="app" class="container" style="min-height: 600px;">
        @include('flash::message')
        @yield('content')

    </div>
    <footer>
        <div class="underline">
            <span class="pull-right">Copyright by Monica 2018, All Right Reserved.</span>
        </div>
    </footer>  

       
    <!-- Scripts -->
    <script src="/js/app.js"></script>

    <script>

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
