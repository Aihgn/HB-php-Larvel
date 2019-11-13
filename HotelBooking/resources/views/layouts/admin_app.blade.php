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
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->


    <!-- Styles -->
    <link href="{{ asset('css/admin-style.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/color/color.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

 
</head>
<body>
    <div class="wrap">                
        <div id ="side-menu">
            <a href="#"class="hide-menu-btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" class="icon-2"><path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"/></svg>
            </a>         
            <nav class="nav-menu">
                <a href="{{route('admin')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="icon"><path d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z"/></svg>
                    <span>Home</span>
                </a>
                <a href="{{route('book_off')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="icon"><path d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm64-192c0-8.8 7.2-16 16-16h288c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16v-64zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"/></svg>
                    <span>Book Room</span>
                </a>
                <a href="{{route('check_in')}}">
                    <span>Check-in</span>
                </a>
                <a href="{{route('check_out')}}">
                    <span>Check-out</span>
                </a>
                <a href="{{route('all_res')}}">
                    <span>Reservation</span>
                </a>
                <a href="{{route('manager_acc')}}">
                    <span>Manager Account</span>
                </a>
                <a href="{{route('manager_room')}}">
                    <span>Manager Room</span>
                </a>  
            </nav>
        </div>
        <header class="container-fluid">
            <div class="row">               
           
                <a href="#" class="show-menu-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="icon-2"><path d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"/></svg>
                </a>      

                <div class="search-area row col-12 col-md-8">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon-header"><path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/></svg>
                    <input type="text" name="" value="" placeholder="Search" class="col-10 col-md-8">
                </div>

                <div class="user-area row">
                    <a href="#" class="notification">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="icon-header"><path d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z"/></svg>
                        <span class="circle">3</span>
                    </a>
                    <a href="#">                
                        <div class="user-img">Admin
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="icon-header"><path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"/></svg>
                        </div>
                    </a>            
                </div>          

            </div>
            
        </header>

        <div class="content"> @yield('content') </div>
    </div>
    
<script type="text/javascript">
    $(document).ready(function(){
        var url = window.location.href;  
        $(".nav-menu a").each(function(){
            if (url == (this.href)) {
                    $(this).closest("a").addClass("active");
                }
        });
        $(".show-menu-btn").click(function(e){
            e.preventDefault();
            $("#side-menu").addClass("toggled");
        });
        $(".hide-menu-btn").click(function(e){
            e.preventDefault();
            $("#side-menu").removeClass("toggled");               
        });
        $(document).mouseup(function(e) 
        {
            var container = $("#side-menu");

            if (!container.is(e.target) && container.has(e.target).length === 0) 
            {
                container.removeClass("toggled");
            }
        });
    });
</script>
</body>
</html>
