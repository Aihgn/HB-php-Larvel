@extends('layouts.admin-app')
@section('content')

	<div class="container main">
		@for($i=0; $i<sizeof($room);$i+=10)
			<div class="row">
				@for($j=$i; $j<$i+10; $j++)
					@if($room[$j]->status == 0)
						@if($room[$j]->id_type == 1)
							<button class="box-room col-1 type-1 m-1 color-white" id="{{$room[$j]->id}}"> {{$room[$j]->id}}</button>
						
						@elseif($room[$j]->id_type == 2)
							<button class="box-room col-1 type-2 m-1 color-white" id="{{$room[$j]->id}}"> {{$room[$j]->id}}</button>
						
						@elseif($room[$j]->id_type == 3)
							<button class="box-room col-1 type-3 m-1 color-white" id="{{$room[$j]->id}}"> {{$room[$j]->id}}</button>
						
						@elseif($room[$j]->id_type == 4)
							<button class="box-room col-1 type-4 m-1 color-white" id="{{$room[$j]->id}}"> {{$room[$j]->id}}</button>
						@endif
					@else
						<div class="box-room col-1 used m-1 color-white" id="{{$room[$j]->id}}"> {{$room[$j]->id}}</div>
					@endif
				@endfor
			</div>
		@endfor

	</div>
	{{-- <div class="row"> 
		<div class="button-div text-center mt-4 col-12 col-md-4">
	        <button type="submit" class="input-button p-2">
	            {{ __('Use') }}
	        </button>                                
	    </div>
	    <div class="button-div text-center mt-4 col-12 col-md-4">
	        <button type="submit" class="input-button p-2">
	            {{ __('Empty') }}
	        </button>                                
	    </div>
	</div> --}}
	

	<script type="text/javascript">
		$(document).ready(function(){
			$('.box-room').click(function(){
				var id = this.id;				
				if($(this).css('backgroundColor') == 'rgba(0, 0, 0, 0)'){		           
		           var isCf=confirm('Do you want to set this room being used?');
				    if (isCf) {
				      	$.ajax({
		                    url:"{{route('setuse')}}",
		                    method:'GET',
		                    data:{id:id},
		                    dataType: 'json',
		                    success:function(data)
		                    {                
		                      $('#'+data).css('background-color', 'rgba(78, 78, 78, 1)');	
		                    }
		                });
				    }
		        }else{
		        	var isCf=confirm('Do you want to set this room being empty?');
				    if (isCf) {
				      	$.ajax({
		                    url:"{{route('setempty')}}",
		                    method:'GET',
		                    data:{id:id},
		                    dataType: 'json',
		                    success:function(data)
		                    {                
		                      $('#'+data).css('background-color', ' transparent');	
		                    }
		                });
				    }
		        }
			});
		});
	</script>
@endsection