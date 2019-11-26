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
			
			<h2 class="m-3">Pick Date</h2>
			<div id="date-pick" class="tab-pane">
				<div class="m-4 input-field col-md-4">
					<input type="text" id="date" name="datefilter" value="" placeholder="Select Date*"/>
				</div>	
			</div>

			
		
			<h2 class="m-3">Select Room</h2>
			<input type="hidden" name="qty_room" id="qty_room" value="" />
			<div class="container mb-4 ml-0">
				<div class="sel-type mt-3">
					<div class="m-2">
						<select class="ml-4 col-4 sel-room-type" name="sel_0" id="sel_0">
							@foreach($room_type as $rt)
								<option value="{{$rt->id}}">{{$rt->name}}</option>
							@endforeach	
						</select>	
					</div>
				</div>
				<button class="btn btn-danger ml-4 mt-3" type="button" id="add_room">Add room</button>
			</div>


			
			<h2 class="m-3">Guest infomation</h2>
			<div class="row">
				<div class="input-field m-4 col-md-5"> 
					<label for="name">Full name:</label>
					<input id="name" name="name" type="text" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Enter name*" required>	                
				</div>
				<div class="input-field m-4 col-md-5">
					<label for="email">Email:</label>
					<input id="email" type="email" class="{{$errors->has('email') ? ' is-invalid' : '' }} " name="email" placeholder="Enter email*" required>
					@if ($errors->has('email'))
						<div class="alert-error text-center mt-4">
							<strong>*{{ $errors->first('email') }}</strong>
						</div>
					@endif
				</div>
				<div class="input-field m-4 col-md-5">
					<label for="phone_number">Phone number:</label>
					<input id="phone_number" type="text" class="" name="phone_number" placeholder="Enter phone number*" required>   
				</div>
				<div class="input-field m-4 col-md-5">
					<label for="address">Address:</label>
					<input id="address" type="text" class="" name="address" placeholder="Enter address*" required>
				</div>
			</div>
		
			
			<div class="input-field m-4 row">
				<h2 class="m-3">Total</h2>
				<input id="total" type="text" class="ml-4 col-md-5" name="total" readonly>
			</div>


			<button type="submit" class="book btn btn-danger m-3 col-6 col-md-3">Book now</button>
			
		</form>
	</div>
	
	<script type="text/javascript">
		$(document).ready(function(){

			var i_room = 0;
			$(document).on("click","#add_room",function(){
				i_room++;
				var id_r ='sel_'+i_room;				
				var data = '<div class="m-2"><select class="ml-4 col-4 sel-room-type" name="'+id_r+'" id="'+id_r+'"><option value="1">Grand king</option><option value="2">Luxury</option><option value="3">Deluxe</option><option value="4">Superior</option></select><button class="btn btn-danger rm_room ml-4" type="button">Remove</button></div>';
				$(".sel-type").append(data);
				calTotal();
			});

			$(document).on("click",".rm_room",function(){
				i_room--;calTotal();
				$(this).closest('div').remove();
				
			});

			$(document).on("change",".sel-room-type", function(){
				calTotal();
			});
			
			var i=0;
			var total = 0;			

			function calDate(){
				var start = new Date($('#date').data('daterangepicker').startDate);
				var end =  new Date($('#date').data('daterangepicker').endDate);
				var day = (end-start)/1000/60/60/24;				
				return Math.round(day);
			}

			function getFormattedDate(date) {			    
				var day = date.getDate();
				var month = date.getMonth()+1;
				var year = date.getFullYear();
				return day + "/" + month + "/" + year;
			}

			$("#qty_room").val(i_room+1);
			function calTotal(){
				
				var ranger = calDate();	
				$("#qty_room").val(i_room+1);
				for(i=0;i<=i_room;i++)
				{
					var id='#sel_'+i;
					var p_id = $(id).val();
					var id=id;$('#total').val(0);
					// if(temp==0)
					// {
						$.ajax({
							url:"{{ route('get_price') }}",
							method:'GET',
							data:{p_id},
							dataType:'json',
							success:function(data)
							{		
								var t = parseInt($('#total').val());						
								t+=data*ranger;
								$('#total').val(t);		
							}
						});	
					// }	
					// else if(temp == 1)
					// {
					// 	$.ajax({
					// 		url:"{{ route('get_price') }}",
					// 		method:'GET',
					// 		data:{p_id},
					// 		dataType:'json',
					// 		success:function(data)
					// 		{									
					// 				total-=data;
					// 		}
					// 	});
					// }
					
				}
			}
			$(document).on('submit', '#post-book', function(){
				var data = $('#post-book').serialize();
				
				$.ajax({
					url:"{{ route('book_off') }}",
					method:'POST',
					data:{data,  _token: '{{csrf_token()}}'},
					dataType:'json',
					success:function(data)
					{		
							
					}
				});	
				
				
			});

			$(function() {
				var dateToday = new Date();
				$('input[name="datefilter"]').daterangepicker({
					autoUpdateInput: true,				
					minDate: dateToday,
					locale: {
					  cancelLabel: 'Clear',
					  format: "DD-MM-YYYY",
					}
				  });

				$('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
					$(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
				 });

				$('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
				  $(this).val('');
				});
			});
		});

		
		
	</script>
@endsection