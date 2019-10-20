@extends('layouts.admin_app')
@section('content')
	
	<div class="card mt-3">
		<h5 class="m-2">Activity statistics</h5>
		<div class="row p-3">
			<div class="col-4">
				<div>Today so far</div>
				<span id="profit-td-in">0$</span>
			</div>
			<div class="col-4">
				<div>Last 7 days</div>
				<span id="profit-7d-in">0$</span>
			</div>
			<div class="col-4">
				<div>This month so far</div>
				<span id="profit-m-in">0$</span>
			</div>
		</div>
		<div class="row p-3">
			<div class="col-4">
				<div>Book rate last 7 days</div>
				<div id="book-rate">
					<div>Family room:  %</div>
                	<div>Luxury room:  %</div>
                	<div>Couple room:  %</div>
                	<div>Standard room:  %</div>

				</div>
			</div>
		</div>
	</div>
	<!-- <script type="text/javascript">
		$(document).ready(function(){
			getProfitToday();
			getProfit7days();
			function getProfitToday(){				
				$.ajax({
					url:"{{ route('get_profit_td') }}",
					method:'GET',
					data:{},
					dataType:'json',
					success:function(data)
					{		
						$('#profit-td-in').html(data);
						$('#profit-td-in').append('$');
					}
				});
			}
			function getProfit7days(){				
				$.ajax({
					url:"{{ route('get_profit_7d') }}",
					method:'GET',
					data:{},
					dataType:'json',
					success:function(data)
					{		
						$('#profit-7d-in').html(data);
						$('#profit-7d-in').append('$');
					}
				});
			}
			// function getProfitToday(){				
			// 	$.ajax({
			// 		url:"{ route('get_profit_m') }}",
			// 		method:'GET',
			// 		data:{},
			// 		dataType:'json',
			// 		success:function(data)
			// 		{		
			// 			$('#profit-m-in').html(data);
			// 			$('#profit-m-in').append('$');
			// 		}
			// 	});
			// }
			getBookRate7d();
			function getBookRate7d(){				
				$.ajax({
					url:"{{ route('get_br_7d') }}",
					method:'GET',
					data:{},
					dataType:'json',
					success:function(data)
					{		
						$('#book-rate').html(data);
					}
				});
			}

		});
    
	</script> -->

@endsection