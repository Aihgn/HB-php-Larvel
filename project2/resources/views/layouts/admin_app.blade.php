<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>   

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


    <!-- Styles -->
    <link href="{{ asset('css/admin-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/color/color.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Boostrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="fluid-container">
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a href="#menu-toggle" id="menu-toggle" class="navbar-brand"><span class="navbar-toggler-icon"></span></a>             
            <div class="col-2">
                <a class="navbar-brand" href="#">X-Hotel</a>
            </div>
            
            <div class="col-8 col-md-9 text-right">
                @guest
                    <div class="px-0 px-md-3 pl-1 py-3">
                        <a href="#" class="account-top">log in</a>
                    </div>
                @else                       
                     <div class="btn-group">
                        <button type="button" id="navbarDropdown" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <strong>{{ Auth::user()->name }}</strong>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                           <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form></a>                          
                        </div>
                     </div>                        
                @endguest   
            </div>
        </nav>
    </div>
    <div id="wrapper" class="toggled background-dark">
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav col-12 col-md-3 col-lg-2">
                <li> <a href="{{route('admin')}}">Dashboard</a> </li>
                <li> <a href="{{route('manager_acc')}}">Manager Account</a> </li>
                <li> <a href="{{route('book_off')}}">Book room</a> </li>
                <li> <a href="{{route('check_in')}}">Check-in</a> </li>
                <li> <a href="#">Check-out</a> </li>
                <li> <a href="{{route('manager_room')}}">Manager room</a> </li>
            </ul>
        </div>
    </div>
    <div class="col-12 col-md-10 content"> @yield('content') </div>

    
    {{-- <div class="scroll-to-top" style="background-image: url('img/arrow-up.svg');"></div> --}}
    
<script>
    $(function(){
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

        $(window).resize(function(e) {
          if($(window).width()<=768){
            $("#wrapper").removeClass("toggled");
          }else{
            $("#wrapper").addClass("toggled");
          }
        });
    });

    $(document).ready(function() 
    {
        //get url
        var url = window.location.href;        
        $(".sidebar-nav a").each(function() {            
            if (url == (this.href)) {
                $(this).closest("li").addClass("active");                
                $(this).closest("li").parent().parent().addClass("active");
            }
        });
    });

   
</script>
</body>
</html>
