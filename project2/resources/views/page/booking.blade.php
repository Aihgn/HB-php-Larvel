<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> X - Hotel Booking</title>   

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/plugins.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script><!--Jquery-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script><!--boostrap-->
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/color/color.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.transitions.css') }}" rel="stylesheet">

    <!-- Ioncion -->
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">

    <!-- Fontawsome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Boostrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<style type="text/css">		
		body{
			background-color: rgba(0,0,0,.85);
		}
		.menutab{
			/*display: flex;*/
			background-color: #ea254e;
			border:1px solid black;
			height: 80px;
			text-align: center;
		}
		.tab-pane{
			text-align: center;
		}
	</style>
</head>
<body>

	<div class="fluid-container">
		<div class="menuheader">
			<div class="row  ">
				<div class="menutab col-3" role="button">
					<a data-toggle="tab" href="#quantity">Adults & children</a>
				</div>
				<div class="menutab col-3" >
					<a data-toggle="tab" href="#menu1">Date of stay</a>
				</div>
				<div class="menutab col-3" >
					<a data-toggle="tab" href="#menu2">Accomodations</a>
				</div>
				<div class="menutab col-3" >
					<a data-toggle="tab" href="#home">Total</a>
				</div>
			</div>
		</div>
		
			<div class="tab-content">
				<div id="quantity" class="tab-pane active">
					<h1 class="text-center mb-4 mt-4 color-white">Guest & room</h1>
					<div class="row justify-content-center">
						<div class="col-5 mt-5">
							<div class="row mb-4">
								<div class="col-6">
									<select name="adults" class="wide">
										<option data-display="adults">adults</option>
										<option value="1">1</option>
										<option value="2">2</option>
									</select>
								</div>
								<div class="col-6">
									<select name="children" class="wide">
										<option data-display="children">adults</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
									</select>
								</div>
								<div class="col-4 mt-4">
									<a href="">Add a room</a>
								</div>
							</div>
							<div class="button-div text-center col-6  col-sm-4 col-lg-12">                                
                                <button type="submit" class="input-button">
                                    {{ __('Update room & guest') }}
                                </button>                                
                            </div>							
						</div>
					</div>
				</div>
				<div id="menu1" class="tab-pane">
					<h3>Menu 1</h3>
					<p>Some content in menu 1.</p>
				</div>
					<div id="menu2" class="tab-pane">
					<h3>Menu 2</h3>
				<p>Some content in menu 2.</p>
			</div>
	</div>

</body>
</html>
