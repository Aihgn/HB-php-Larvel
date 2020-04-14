@extends('layouts.admin_app')
@section('content')
	<div class="card p-2 mt-3">		
		@if (Session::has('success'))
			<span class="alert alert-success">
				{!! \Session::get('success') !!}
			</span>
		@endif
		<form method="POST" id="post-book" action="{{ route('book_off') }}">
		@csrf
			<div class="input-field m-3 row">
				<h2>Pick Date</h2>
				<input id="date" class="ml-4 col-sm-5 col-md-4 col-lg-3" name="datefilter" placeholder="Select Date*"/>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<h2 class="m-3">Guest infomation</h2>
						<div class="input-field m-4"> 
							<label for="name">Full name:</label>
							<input id="name" name="name" type="text" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Enter name*" required>	                
						</div>
						<div class="input-field m-4">
							<label for="email">Email:</label>
							<input id="email" type="email" class="{{$errors->has('email') ? ' is-invalid' : '' }} " name="email" placeholder="Enter email*" required>
							@if ($errors->has('email'))
								<div class="alert-error text-center mt-4">
									<strong>*{{ $errors->first('email') }}</strong>
								</div>
							@endif
						</div>
						<div class="input-field m-4">
							<label for="phone_number">Phone number:</label>
							<input id="phone_number" type="text" class="" name="phone_number" placeholder="Enter phone number*" required>   
						</div>
						<div class="input-field m-4">
							<label for="address">Address:</label>
							<input id="address" type="text" class="" name="address" placeholder="Enter address*" required>
						</div>
				</div>

				<div class="col-md-6">
					<h2 class="m-3">Select Room</h2>
					<input type="hidden" id="qty_room" value="{{$count}}" />
					@foreach($room_type as $i=>$rt)
						@if($rt->available > 0)
						<div class="sel-type m-4 mb-5 row">
							<div class="v-align">{{$rt->name}}</div>
							<select class="ml-4 col-4 col-md-4 sel-room-type" name="sel_{{$rt->id}}" id="{{$rt->id}}">
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
							</select>
						</div>
						@endif
					@endforeach					
				</div>
			</div>
			
			<div class="input-field m-3 row">
				<h2 class="m-3">Total</h2>
				<input id="total" type="text" class="ml-4 col-md-5" name="total" readonly>
			</div>

			<div class="c-div">
				<button type="submit" class="book btn btn-danger m-3 col-6 col-md-3">Book now</button>
			</div>
			
		</form>
		<div id="messOutputModal" class="modal fade" role="dialog">
	   	<div class="modal-dialog">
				<div class="modal-content" style="text-align: center;">
					<div class="modal-header">
						<h2>Notification</h2>
					</div>
					<div class="modal-body">
						<span id="mess_output" class="m-3">Booking room success</span>
					</div>
				 	<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
	     </div>
	  </div>
	</div>
	
	<script type="text/javascript">
		$(document).ready(function(){		

			function calDate()
			{
				var start = new Date($("#date").data("daterangepicker").startDate);
				var end =  new Date($("#date").data("daterangepicker").endDate);
				var day = (end-start)/1000/60/60/24;
				return Math.round(day)-1;
			}
			
			function calTotal()
			{				
				var qty = [];
				var ranger = calDate();
				var count = $("#qty_room").val();
				for ($i = 0; $i<count+2; $i++)
				{
					var string = "#"+($i+1);					
					if($(string).val()== null)
					{
						qty[$i]=0;
					}
					else
					{
						qty[$i]=$(string).val();
					}
				}
					$.ajax(
					{
						url:"{{ route("get_total") }}",
						method:"GET",
						data:{qty},
						dataType:"json",
						success:function(data)
						{
							$("#total").val(data*ranger);
						},
				      	error: function (xhr, ajaxOptions, thrownError) {
				        	alert(xhr.status);
				        	alert(thrownError);
				      	}
					});
					
			}

			$(document).on("submit", "#post-book", function()
			{
				$("#messOutputModal").modal("show");
			});

			$("#date").on("apply.daterangepicker", function()
			{
				calTotal();
			})
			
			$(document).on("change",".sel-room-type", function()
			{
				calTotal();	
			});


			$(function setUpDateRanger() {
				var dateToday = new Date();
				var tomorrow = new Date();
				tomorrow.setDate(new Date().getDate()+1);
				$('input[name="datefilter"]').daterangepicker({
					autoUpdateInput: true,				
					"autoApply": true,
					minDate: dateToday,
					endDate: tomorrow,
					locale: {
					  cancelLabel: 'Clear',
					  format: "DD/MM/YYYY",
					}
				  });
			});
		});
	</script>
@endsection