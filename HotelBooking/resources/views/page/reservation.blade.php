<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reservations</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/res.css') }}" rel="stylesheet">
    <link href="{{ asset('css/color/color.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/plugins.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><!--Jquery-->   
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="lds-ring" id="lds-ring"><div></div><div></div><div></div><div></div></div>
	<div class="container">
		<div id="date-pick" class="tab-pane active">
			<h4 class="text-center mt-1 color-white">Date picker</h4>
			<div class="row justify-content-center">
				<div class="col-10 mt-4">
					<div class="row mb-2">
						<div class="input-daterange input-group" id="flight-datepicker">
							<div class="row">	
								<div class="col-12 col-md-4 mb-2">
									<div class="form-item">
										<span class="fontawesome-calendar"></span>
										<input class="input-sm" type="text" autocomplete="off" id="start-date" name="start" placeholder="chech-in date" data-date-format="dd.mm.yyyy"/>
										<span class="date-text date-depart"></span>
									</div>
								</div>
								<div class="col-12 col-md-4 mb-2">
									<div class="form-item">
										<span class="fontawesome-calendar"></span>
										<input class="input-sm" type="text" autocomplete="off" id="end-date" name="end" placeholder="check-out date" data-date-format="dd.mm.yyyy"/>
										<span class="date-text date-return"></span>
									</div>
								</div>
								
								<button class="update-btn input-button col-12 col-md-4 mb-2" data-toggle="tab" href="#room-pick" >Update</button>
																
							</div>
						</div>
					</div>							
				</div>
			</div>
		</div>
	
		<div class="container">
			<form method="POST" action="{{ route('res') }}">
			@csrf
				<div class="page-bar" id="tabMenu">
				    <ul class="page-breadcrumb row">
				        <li class="col-6 active first" id="1st">
				            <span>
				                <span class="numberCircle checkLabel bg-green-jungle">
				                    <i class="fa fa-check"></i>
				                </span>
				                <span class="numberCircle numberLabel">1</span>
				                <b>Choose a room</b>
				            </span>
				        </li>
				        <li class="col-6 second" id="2nd">
				            <span>
				                <span class="numberCircle checkLabel bg-green-jungle">
				                    <i class="fa fa-check"></i>
				                </span>
				                <span class="numberCircle numberLabel">2</span>
				                <b>Information</b>
				            </span>
				        </li>
				    </ul>
				</div>
			</div>
			<div class="tab-content">
				<div id="room-pick" class="tab-pane active">
					<div class="row flex-row flex-nowrap justify-content-center">
				        <div class="mt-1 row container">
				        	<div class="col mt-3">
								<div class="card container" style="background-color: #00000059; color: #fff">
				        			<div class="row ml-1 col-9 p-0">
										<div class="col-4 card-ab">
											<span>Room Type</span>
										</div>
										<div class="col-2 card-ab">
											<span>Price From</span>
										</div>
										<div class="col-2 card-ab">
											<span>Price for 1 Night(s)</span>
										</div>
										<div class="col-2 card-ab">
											<span>Maximum people</span>
										</div>
										<div class="col-2 card-ab">
											<span>Rooms</span>
										</div>
				        			</div>
				        		</div>
			        		</div>
			        	</div>
			        </div>
					<div class="row flex-row flex-nowrap justify-content-center">
				        <div class="row mt-3 container">
				        	<div class="col-9">
				        		<input type="hidden" id="qty_room" value="{{$count}}" />
				        		@foreach($room as $r)
					        	<div class="card container mb-3" style="background-color: #00000059; color: #fff">
					        		<div class="row">
					        				<div class="col-2 room-img p-0">
												<img src="img/{{$r->image}}" class="card-img" alt="{{$r->name}}">
											</div>
											<div class="col-2 card-ab">
												<span id="{{$r->id}}-name">{{$r->name}}</span>
											</div>
											<div class="col-2 card-ab">
												<span>${{$r->price}}</span>
											</div>
											<div class="col-2 card-ab">
												<span>${{$r->price}}</span>
											</div>
											<div class="col-2 card-ab">
												<span>2</span>
											</div>
											<div class="col-2 card-sel">
												<select style="color: #000" class="sel-qty" id="{{$r->id}}">
													<option value="0">0</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
												</select>
											</div>
					        		</div>
					        	</div>
					        	@endforeach
					        </div>
					        <div class="col-3 mb-3" >
					        	<div class="container" style="background-color: #00000059; color: #fff; height: 100%">
					        		<div class="input-field mb-3 mt-0">
					        			<h5 class="pt-3 pl-3" style="color: #fff">Total</h5>
					        			<input type="text" class="pt-2" id="total" style="color: #fff; border: none; cursor: auto;     text-align: center;" readonly>
					        		</div>
					        		<button class="input-button mb-3" id="book-btn" data-toggle="tab" href="#info">Book Now</button>
					        		<a href="#" id="promo-code" style="text-align: center;display: block; color: #fff; text-decoration: underline;">Have a promo code?</a>
					        		<div class="content-collapse" style="display: none;">
					        			<div class="input-field mb-3 mt-1">
						        			<input type="text" class="pt-2" style = "color: #fff"required autofocus>
						        			<button class="input-button mt-3">Apply Code</button>
						        		</div>
					        		</div>
					        	</div>			        	
					        </div>
				        </div>
					</div>
				</div>
				<div id="info"  class="tab-pane" >
					<div class="payment row justify-content-center">
						<div class="customer-info col-10 col-lg-7 pl-5 pr-5 mb-5 mt-5">
							<h5 class="text-center color-white">Your infomation</h5>
							{{-- @guest --}}
								<div class="input-field"> 
	                                <label for="name">Full name:</label>
	                                <input id="name" name="name" type="text" class="{{ $errors->has('name') ? ' is-invalid' : '' }} color-white" value="" required>	                
	                            </div>
	                            <div class="input-field">
	                                <label for="email">Email:</label>
	                                <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }} color-white" name="email" value="" required>

	                                @if ($errors->has('email'))
	                                    <div class="alert-error text-center mt-4">
	                                        <strong>*{{ $errors->first('email') }}</strong>
	                                    </div>
	                                @endif
	                            </div>
	                            <div class="input-field">
	                        	<label for="phone_number">Phone number:</label>
	                            <input id="phone_number" type="text" class="color-white" name="phone_number" value="" required>   
	                        </div>
	                        {{-- @else
	                            <div class="input-field"> 
	                                <label for="name">Full name:</label>
	                                <input id="name" type="text" class="color-white" value="{{ Auth::user()->name }}" name="name" required>
	                            </div>
	                            <div class="input-field">
	                                <label for="email">Email:</label>
	                                <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }} color-white" name="email" value="{{ Auth::user()->email }}" required>

	                                @if ($errors->has('email'))
	                                    <div class="alert-error text-center mt-4">
	                                        <strong>*{{ $errors->first('email') }}</strong>
	                                    </div>
	                                @endif
	                            </div>
	                            <div class="input-field">
	                            	<label for="phone_number">Phone number:</label>
	                                <input id="phone_number" type="text" class="color-white" name="phone_number" value="{{$acc_info[0]->phone_number}}" required>   
	                            </div>
	                        @endguest --}}   
	                        <button type="submit" class="input-button">Complete Reservation</button>  
	                        {{-- <div class="button-div text-center col-12">
	                            <button type="submit" class="input-button p-3">Complete Reservation</button>
	                        </div>  --}}                      	
						</div>
						<div class="color-white col-10 col-lg-5 pl-5 pr-5 mb-5 mt-5">
							<h5 class="text-center color-ed">Your reservation</h5>
							<hr>
							<p class="bold">Room Selections:</p>
							<div id="room-sel">
								
							</div>
							<br>
							<div class="row">
								<p class="bold col-6">Arrival Date:</p>
								<p class="arr-date col-6"></p>
							</div>
							<br>
							<div class="row">
								<p class="bold col-6">Departure Date:</p>
								<p class="dep-date col-6"></p>
							</div>
							<br>
							<div class="row">
								<p class="bold col-6">Room Night:</p>
								<p class="night-qty col-6"></p>
							</div>
							<hr>
							<div class="row">
								<p class="bold col-6">Total:</p>
								<p id="g-total" class="col-6"></p>
							</div>						
						</div>					
					</div>
				</div>
			</div>
		</form>
	</div>
	<script type="text/javascript">
		$(document).ready(function() 
		{
			function fakeloading()
			{
				document.getElementById('lds-ring').style.display="block";
				setTimeout(function unwait() 
				{
					document.getElementById('lds-ring').style.display="none";
				}, 200);
			}

			function togglePagebar()
			{
				$("#1st").toggleClass("active");
				$("#2nd").toggleClass("active");
			}
			// function setDate()
			// {
			// 	$("#start-date").datepicker("update", new Date());
			// 	var tomorrow = new Date();
			// 	tomorrow.setDate(new Date().getDate()+1);
			// 	$("#end-date").datepicker("update", tomorrow);
			// };
			// setDate();

			function checkRoom()
			{
				var count = $("#qty_room").val();
				var bool = false;
				for ($i = 0; $i<count; $i++)
				{
					var string = "#"+($i+1);
					if($(string).val() != 0)
					{
						bool=true;
						break;
					}
				}
				if(!bool)
				{
					$("#book-btn").addClass("disabled-btn");
					$("#book-btn").prop("disabled", true);;
				}
				else
				{
					$("#book-btn").removeClass("disabled-btn");
					$("#book-btn").prop("disabled", false);;
				}
			}
			checkRoom();

			function genRoom()
			{
				var qty = [];
				var count = $("#qty_room").val();
				var bool = false;
				for ($i = 0; $i<count; $i++)
				{
					var string = "#"+($i+1);
					qty[$i]=$(string).val();
				}
				for($i = 0; $i<count; $i++)
				{	
					$("#room-sel").html();
					if(qty[$i] !=0 )
					{	
						var string = "#"+($i+1)+"-name";
						var temp = $(string).text() + " ( x" + calDate() +" ) " +"<br>";
						$("#room-sel").append(temp);
					}
				}
			}

			function calDate()
			{
				var st = $("#start-date").val().split(".");
				var start = new Date(st[2], st[1] - 1, st[0]);
				var et = $("#end-date").val().split(".");
				var end =  new Date(et[2], et[1] - 1, et[0]);
				var day = (end-start)/1000/60/60/24;
				if(Math.round(day) == 0)
				{
					return 1;
				}
				return Math.round(day);
			};
			function calTotal()
			{
				var qty = [];
				var ranger = calDate();
				var count = $("#qty_room").val();
				for ($i = 0; $i<count; $i++)
				{
					var string = "#"+($i+1);
					qty[$i]=$(string).val();
				}
					$.ajax(
					{
						url:"{{ route("r_get_total") }}",
						method:"GET",
						data:{qty},
						dataType:"json",
						success:function(data)
						{
							$("#total").val("$"+data*ranger);
							$("#g-total").html("$"+data*ranger)
						},
				      	// error: function (xhr, ajaxOptions, thrownError) {
				       //  	alert(xhr.status);
				       //  	alert(thrownError);
				      	// }
					});
			};
			$(document).on("change",".sel-qty", function()
			{
				checkRoom()
				calTotal();
			});			
			$("#book-btn").click(function()
			{
				fakeloading();
				togglePagebar();
				$(".arr-date").html($("#start-date").val());
				$(".dep-date").html($("#end-date").val());
				$(".night-qty").html(calDate());
				genRoom();
			});
			$(".update-btn").click(function()
			{
				fakeloading();
				// togglePagebar();
				calTotal();
			});

			$("#promo-code").click(function()
			{
			    $header = $(this);
			    $content = $(".content-collapse");
			    $content.slideToggle(500, function () {
			        $header.text(function () {
			            $content.is(":visible");
			        });
			    }); 
			});
		});
	</script>
</body>
</html>