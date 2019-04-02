<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservation</title>   

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/plugins.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script><!--Jquery-->   
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/ionicons@4.5.5/dist/ionicons.js"></script>
    
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style type="text/css">		
		body{
			background-color: rgba(0,0,0,.9);
		}
		.HearderButton{
			display: flex;
			background-color: #ed254e;
			border:1px solid black;
			height: 50px;
			text-align: center;
			padding: 0;
			color: #fff;
			padding-top:5px;
			width: 100%;
		}		
		.HearderButton:hover{
			text-decoration: none;
			background-color: #c22747;
			color: #fff;
		}
		.tab-pane{
			text-align: center;
		}

		#add-room{
			color:#ed254e;
		}

		#add-room:hover{
			text-decoration: none;
			color: #fcfcfc;
		}

		.card-horizontal {
		    display: flex;
		    flex: 1 1 auto;
		}
		.card-body{
			display: flex;
		}

		
		.price-sel{
			display: flex;
			position: absolute;
			bottom: 0;
			width: 80%;
    		right: 0;
		}
		.price-sel input{
			width: 100%;
		    border: 0;
		    color: #ffff;
		    background-color: #2c2c2ca1;
		    text-align: center;
		    flex-grow: 2;		    
		    user-select: none;
		    outline: none;
		    cursor: pointer;
		}
		.price-sel a{
			flex-grow: 1;
		}

		.payment{
			display: flex;
			color:#fff;
		}
		.customer_info{
			border-right: 1px dotted #ed254e;
			border-left: 1px dotted #ed254e;
		}
		.total-amount{
			border-top:1px dotted #ed254e;

		}
		.total-amount table{
			width: 100%;
		}

		.collapse-header{
			color: #ed254e;
		}

		.collapse-header:hover{
			color: #c22747;;
			text-decoration: none;
		}

		.collapse-content{
			display: none;
		}
		.form-check:checked{
			background-color: red;
		}
	</style>	
	
</head>
<body>

	<div class="fluid-container">
		
		<div class="nav nav-tabs border-bottom-0">
			<a class="HearderButton col-1 justify-content-center" href="{{route('home')}}" target="_blank" >Home</a>
			<a class="HearderButton col-3 justify-content-center active"data-toggle="tab" href="#qty">Adults & children</a>
			<a class="HearderButton col-3 justify-content-center" data-toggle="tab" href="#date-pick">Date of stay</a>
			<a class="HearderButton col-3 justify-content-center" data-toggle="tab" href="#room-pick">Accomodations</a>
			<a class="HearderButton col-2 justify-content-center" data-toggle="tab" href="#total">Total</a>
		</div>	
			
		</div>
			<form method="POST" action="{{ route('booking') }}">
				 @csrf
				<div class="tab-content">
					<div id="qty" class="tab-pane active">
						<h1 class="text-center mb-4 mt-4 color-white">Guest & room</h1>
						<div  id="container-add-room" >
							<div class="guest-room row justify-content-center">
								<div class="row col-6 mt-5 justify-content-center">
									<a href="#" class="remove" id="remove-room" style="visibility: hidden;"><ion-icon name="close" style="font-size: 40px; color:#fff;"></ion-icon></a>
									<div class="col-5">
										<select name="adults" class="wide">
											<option data-display="1 adults" value="1">1 adults</option>
											<option value="2">2 adults</option>
											<option value="3">3 adults</option>
										</select>
									</div>
									<div class="col-5">
										<select name="children" class="wide">
											<option data-display="1 children" value="1">1 children</option>
											<option value="2">2 children</option>
											<option value="3">3 children</option>
										</select>
									</div>								
								</div>
							</div>		
						</div>				
						<div class="mb-5 mt-4 text-center">
							<a href="#" id="add-room">Add a room</a>
						</div>						                       
                        <a class="input-button  text-center col-6  col-sm-4 col-lg-12 pl-5 pr-5" data-toggle="tab" href="#date-pick">{{ __('Update room & guest') }}</a>                                
                            
					</div>
					<div id="date-pick" class="tab-pane">
						<h1 class="text-center mb-4 mt-4 color-white">Date picker</h1>
						<div class="row justify-content-center">
							<div class="col-5 mt-5">
								<div class="row mb-4">
									<div class="input-daterange input-group" id="flight-datepicker">
										<div class="row">	
											<div class="col-6">
												<div class="form-item">
													<span class="fontawesome-calendar"></span>
													<input class="input-sm" type="text" autocomplete="off" id="start-date" name="start" placeholder="chech-in date" data-date-format="dd/mm/yyyy"/>
													<span class="date-text date-depart"></span>
												</div>
											</div>
											<div class="col-6">
												<div class="form-item">
													<span class="fontawesome-calendar"></span>
													<input class="input-sm" type="text" autocomplete="off" id="end-date" name="end" placeholder="check-out date" data-date-format="dd/mm/yyyy"/>
													<span class="date-text date-return"></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								 <a class="input-button" data-toggle="tab" href="#room-pick">
	                                    {{ __('Update date of stay') }}
	                            </a>
	                            
							</div>
						</div>
					</div>
					<div id="room-pick" class="tab-pane">
						<h1 class="text-center mb-4 mt-4 color-white">Rooms</h1>
						<div class="row flex-row flex-nowrap justify-content-center">
					        <div class="col-10">	
					        @foreach($room as $r)		

				            	<div class="card mb-4">			            		
					                <div class="card-horizontal">
					                    <div class="img-square-wrapper">
					                        <img class="room-img" src="img/{{$r->image}}" alt="Card image cap">
					                    </div>
					                    <div class="card-body">
					                    	<div class="col-6">
					                    		<h4 class="card-title">{{$r->name}}</h4>
						                        <p class="mt-3">{{$r->description}}</p>
																			
					                    	</div>
					                        <div class="col-6 text-md-left">
					                        	<ul class="text-md-left">
													<li>Max: 4 Person(s)</li>
													<li>View: City</li>
													<li>Size: 35m2/ 376ft2</li>		
												</ul>             
					                        	
					                        	<div class="price-sel">
					                        		
			                        				<input type="text" value="${{$r->price}}" />
					                        		 <a class="input-button" data-toggle="tab" href="#total">book</a>
					                        	</div>
					                        </div>
					                    </div>
					                </div>		
					            </div>	
					            @endforeach				           
					        </div>
						</div>
					</div>
					<div id="total" class="tab-pane">
						<h1 class="text-center mb-4 mt-4 color-white">Total</h1>
						<div class="payment">
							<div class="col-xs-12 col-4  pl-5 pr-5">
								<h5 class="text-center color-white">Your reservation</h5>
								<div class="detail mt-2 mb-3">
									
									<a href="#" class="collapse-header">bill detail</a>
									<div id="bill" class="collapse-content">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit,
									sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
									</div>
								</div>
								<div class="total-amount" >
									<table >
										<td>
											<span>Total reservation amount</span>
											
										</td>
										<td class="text-right">
											<span>$11111</span>
										</td>
									</table>
								</div>
							</div>
							<div class="customer_info col-xs-12 col-4 pl-5 pr-5">
								<h5 class="text-center color-white">Your infomation</h5>
								@guest
									<div class="input-field"> 
		                                <label for="name">{{ __('Full name:')}}</label>
		                                <input id="name" type="text" class="{{ $errors->has('name') ? ' is-invalid' : '' }} color-white" value="" required>
		                                @if ($errors->has('name'))
		                                    <div class="alert-error text-center mt-4">
		                                        <strong>*{{ $errors->first('name') }}</strong>
		                                    </div>
	                               		 @endif 
		                            </div>
		                            <div class="input-field">
		                                <label for="email">{{__('Email:')}}</label>
		                                <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }} color-white" name="email" value="" required>

		                                @if ($errors->has('email'))
		                                    <div class="alert-error text-center mt-4">
		                                        <strong>*{{ $errors->first('email') }}</strong>
		                                    </div>
		                                @endif
		                            </div>
		                            <div class="input-field">
	                            	<label for="phone_number">{{ __('Phone number:')}}</label>
	                                <input id="phone_number" type="text" class="color-white" value="" required>   
	                            </div>
	                            @else
		                            <div class="input-field"> 
		                                <label for="name">{{ __('Full name:')}}</label>
		                                <input id="name" type="text" class="{{ $errors->has('name') ? ' is-invalid' : '' }} color-white" value="{{ Auth::user()->name }}" required>
		                                @if ($errors->has('name'))
		                                    <div class="alert-error text-center mt-4">
		                                        <strong>*{{ $errors->first('name') }}</strong>
		                                    </div>
	                               		 @endif 
		                            </div>
		                            <div class="input-field">
		                                <label for="email">{{__('Email:')}}</label>
		                                <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }} color-white" name="email" value="{{ Auth::user()->email }}" required>

		                                @if ($errors->has('email'))
		                                    <div class="alert-error text-center mt-4">
		                                        <strong>*{{ $errors->first('email') }}</strong>
		                                    </div>
		                                @endif
		                            </div>
		                            <div class="input-field">
		                            	<label for="phone_number">{{ __('Phone number:')}}</label>
		                                <input id="phone_number" type="text" class="color-white" value="{{$acc_info[0]->phone_number}}" required>   
		                            </div>
	                            @endguest
	                            	
							</div>
							<div class="col-xs-12 col-4 pl-5 pr-5">
								<h5 class="text-center color-white">Payment Method</h5>
								<div class="input-field">
	                            	<label for="name-on-card">{{ __('Name on Card:')}}</label>
	                                <input id="name-on-card" type="text" class="color-white" required>   
	                            </div>	
	                            <div class="input-field">
	                            	<label for="card_number">{{ __('Card number:')}}</label>
	                                <input id="card_number" type="text" class="color-white" required>   
	                            </div>	
	                            <div class="input-field">
	                            	<label for="expiration-date">{{ __('Expiration date:')}}</label>
	                                <input id="expiration-date" type="text" class="color-white" placeholder="MM/YY" required>   
	                            </div>	
								<div class="button-div text-center col-6  col-sm-4 col-lg-12">                                
                                <button type="submit" class="input-button pr-3 pl-3">
                                    {{ __('Book now') }}
                                </button>                                
                            </div>
							</div>
						</div>
					</div>
				</div>
			</form>
	</div>
	<script type="text/javascript">
		

		document.getElementById("radio-value").addEventListener("mousedown", function(event){
				event.preventDefault();
			});


		//sel-qty-room
		$(document).ready(function() {
			var max_rooms=5;
			var i=0;
			$('#add-room').on('click', function() {

				if(i<max_rooms) {
					document.getElementById("remove-room").style.visibility = "visible";
					var source = $('.guest-room:first'), clone = source.clone();
			    	clone.appendTo('#container-add-room');
			    	document.getElementById("remove-room").style.visibility = "visible";
			    	i++;
				}
				if(i==max_rooms-1){
					document.getElementById("add-room").style.display = 'none'; 
				}						    
			});
			
			$(document).on("click",".remove",function() {
				if(i>0){
					$(this).closest(".guest-room").remove();
					i--;				
					document.getElementById("add-room").style.display = 'block';
				}
				if(i<1){
					document.getElementById("remove-room").style.visibility = "hidden";
				}
			});			
		});		

		//collapse
		$(".collapse-header").click(function () {
		    $header = $(this);		    
		    $content = $header.next();		   
		    $content.slideToggle(500, function () {
		        $header.text(function () {		         
		            $content.is(":visible");
		        });
		    });
		});

	</script>


</body>
</html>
