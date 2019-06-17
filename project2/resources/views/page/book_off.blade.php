@extends('layouts.admin_app')
@section('content')
	<div class="card mt-4">		
		<form method="POST" action="{{ route('book-off') }}">
		@csrf
			
		{{-- --}}
			<div id="date-pick mt-4" class="tab-pane">
				<h5 class="color-white mt-2 mb-3 ml-4">Pick Date</h5>
				<div class="row ml-5">
					<div class="col-3 mt-1">
						<div class="row mb-4 input-field">
						<input type="text" id="date" name="datefilter" value="" placeholder="pick date" />
						</div>							
					</div>
				</div>		
			</div>
		{{-- --}}
			<h5 class="color-white mt-2 mb-1 ml-4">Select Room</h5>
			<div class="container main">				
				<select class="mt-4 col-4">
					<option>Family room</option>
					<option>Couple room</option>
					<option>Luxury room</option>
					<option>Standard room</option>
				</select>
			</div>
			<div class="mb-1 ml-4 mt-4">
					<h5 class="color-white">Guest infomation</h5>
					<div class="input-field"> 
		                <label for="name">{{ __('Full name:')}}</label>
		                <input id="name" name="name" type="text" class="{{ $errors->has('name') ? ' is-invalid' : '' }} color-white" value="" required>	                
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
			            <input id="phone_number" type="text" class="color-white" name="phone_number" value="" required>   
			        </div>
			</div>
			<div class="ml-4 input-field">
	        	<h5 class="color-white">Total</h5>
	            <input id="total" type="text" class="color-white" name="total" value="" required readonly="">   
	        </div>
			<div class="button-div text-center mt-4 col-12 col-md-4">
		        <button type="submit" class="book btn-admin p-2 mb-4">
		            {{ __('Book now') }}
		        </button>                                
		    </div>
		</form>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			var i=0;
			var total = 0;
			$('.box-room').click(function(){
				var id = this.id;
				if($(this).css('backgroundColor') == 'rgba(0, 0, 0, 0)'){
		           $(this).css('background-color', 'rgb(153, 15, 15)');
		           i++;
		           $.ajax({
	                    url:"{{route('book-off.action')}}",
	                    method:'GET',
	                    data:{id:id},
	                    dataType: 'json',
	                    success:function(data)
	                    {                
	                       total += data[0].price*calDate();
	                       $('#total').val(total);
	                    }
	                });
		        } else {
		           $(this).css('background-color', 'rgba(0, 0, 0, 0)');
		           i--;
		           $.ajax({
	                    url:"{{route('book-off.action')}}",
	                    method:'GET',
	                    data:{id:id},
	                    dataType: 'json',
	                    success:function(data)
	                    {                
	                       total -= data[0].price*calDate();
	                       $('#total').val(total);
	                    }
	                });
		        }
			});
			function toDate(dateStr) {
			  var parts = dateStr.split(".")
			  return new Date(parts[2], parts[1] - 1, parts[0])
			}

			function calDate(startDate, endDate){
				var start= startDate;
				var end= endDate;
				var day = (end-start)/1000/60/60/24;				
				return Math.round(day);
			}

			function getFormattedDate(date) {			    
			    var day = date.getDate();
  				var month = date.getMonth()+1;
  				var year = date.getFullYear();
			    return day + "/" + month + "/" + year;
			}

			$(document).on('click', '.book', function(){
				var startDate = new Date($('#date').data('daterangepicker').startDate);
				var sc = getFormattedDate(startDate);

				var endDate =  new Date($('#date').data('daterangepicker').endDate);
				var ec = getFormattedDate(endDate);
				// var r = $("#date").val();
				// calDate(startDate,endDate)
				alert(calDate(startDate,endDate));
			});
		});

		$(function() {
			var dateToday = new Date();
		  $('input[name="datefilter"]').daterangepicker({
		      autoUpdateInput: false,
		      minDate: dateToday,
		      locale: {
		          cancelLabel: 'Clear'
		      }
		  });

		  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
		      $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
		  });

		  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
		      $(this).val('');
		  });

		});
		
	</script>
@endsection