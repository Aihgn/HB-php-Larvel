@extends('layouts.admin_app')
@section('content')
	<div class="container main">
		<div class="card p-2 mt-3">
			<h4>Room type lists</h4>
			<span id="mess_output"></span>
			<div class="table-responsive mt-2">
				<table class="table table-dark table-hover">
			    	<thead>
			    		<tr>
			    			<th>No.</th>	
			    			<th>Name</th>    			
			    			<th>Price</th>
			    			<th>Description</th>
			    			<th colspan="2" class="text-center"><button id="add_data"  type="button" data-toggle="modal" class="btn btn btn-primary">Add</button></th>
			    		</tr>
			    	</thead>
			    	<tbody id="tb-room-type">  
			    		@foreach($room_type as $i=>$row)
			    			<tr>
				    			<td>{{$i+1}}</td>
				    			<td>{{$row->name}}</td>
				    			<td>{{$row->price}}</td>   
				    			<td>{{$row->description}}</td>	
			    				<td><button id="{{$row->id}}"  type="button" data-toggle="modal" class="edit-type-btn btn btn btn-success">Edit</button></td>
				    			<td><button id="{{$row->id}}"  type="button" data-toggle="modal" class="del-type-btn btn btn btn-danger">Delete</button></td>
				    		</tr>
			    		@endforeach  			    		
			    	</tbody>
			    </table>
			</div>
		</div>
		<div id="roomTypeModal" class="modal fade" role="dialog">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <form method="post" id="room_type_form">
		                <div class="modal-header">
		                	<h4 class="modal-title">Edit Data</h4>
		                   	<button type="button" class="close" data-dismiss="modal">&times;</button>		                   
		                </div>
		                <div class="modal-body">
		                    {{csrf_field()}}		                   
		                    <div class="form-group">
		                        <label>Room Type</label>
		                        <input type="text" name="room_type" id="room_type" class="form-control" />
		                    </div>
		                    <div class="form-group">
		                        <label>Price</label>
		                        <input type="text" name="room_price" id="room_price" class="form-control" />
		                    </div>
		                    <div class="form-group">
		                        <label>Description</label>	
		                        <input type="text" name="room_description" id="room_description" class="form-control" />
		                    </div>
		                </div>
		                <div class="modal-footer">
		                    <input type="hidden" name="room_type_id" id="room_type_id" value="" />
		                     <input type="hidden" name="button_action" id="button_action" value="insert" />
                    		<input type="submit" name="submit" id="action" value="Add" class="btn btn-success" />
		                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		                </div>
		            </form>
		        </div>
		    </div>
		</div>
		<div class="card p-2 mt-3"> 
			<button class="room-type btn-admin col-5 p-2">+ Room manager</button>
			<div class="content-collapse mt-3">
				<div class="input-field mt-3 mb-2 col-5"> 
	                <label for="search">{{ __('Search') }}</label>
	                <input id="search" type="text" placeholder="Enter room id" required autofocus>
	            </div>
	            <div class="row">	            	
	            	<select class="m-3 col-5 sel-room-type">
						<option value="0" selected >Select room type</option>
						<option value="" disabled>------------------------</option>
						<option value="1">Family room</option>
						<option value="2">Couple room</option>
						<option value="3">Luxury room</option>
						<option value="4">Standard room</option>
					</select>
					<select class="m-3 col-5 sel-room-stt">
						<option value="0" selected >Select room status</option>
						<option value="" disabled >-------------------</option>
						<option value="1">Empty</option>
						<option value="2">Used</option>
						<option value="3">Booked</option>						
					</select>
	            </div>
	            
				<h4>Room lists</h4>
				<table class="table table-dark table-hover">
			    	<thead>
			    		<tr>
			    			<th>No.</th>	
			    			<th>Room ID</th>    			
			    			<th>Type</th>
			    			<th>Status</th>
			    			<th></th> 
			    		</tr>
			    	</thead>
			    	<tbody id="tb-room">    			    		
			    	</tbody>
			    </table>
			</div>
		</div>
		<div id="roomModal" class="modal fade" role="dialog">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <form method="post" id="room_form">
		                <div class="modal-header">
		                	<h4 class="modal-title">Edit Data</h4>
		                   	<button type="button" class="close" data-dismiss="modal">&times;</button>		                   
		                </div>
		                <div class="modal-body">
		                    {{csrf_field()}}
		                    <span id="form_output"></span>
		                    <div class="form-group">
		                        <label>Room ID</label>
		                        <input type="text" name="room_id" id="room_id" class="form-control" value="" disabled />
		                    </div>
		                    <div class="form-group">
		                        <label>Type</label>
		                        <select class="m-3 col-5" id="sel-room-type">			
									<option value="1">Family room</option>
									<option value="2">Couple room</option>
									<option value="3">Luxury room</option>
									<option value="4">Standard room</option>
								</select>
		                    </div>
		                    <div class="form-group">
		                        <label>Status</label>	
		                        <select class="m-3 col-5" id="sel-room-stt">			
									<option value="0">Empty</option>
									<option value="1">Used</option>
									<option value="2">Booked</option>
								</select>
		                    </div>
		                </div>
		                <div class="modal-footer">		
		                	<button type="submit" class="btn btn-success">Edit</button> 
		                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		                </div>
		            </form>
		        </div>
		    </div>
		</div>			
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".room-type").click(function () {
			    $header = $(this);
			    //getting the next element
			    $content = $header.next();
			    //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
			    $content.slideToggle(500, function () {
			        //execute this after slideToggle is done
			        //change text of header based on visibility of content div
			        $header.text(function () {
			            //change text based on condition
			            return $content.is(":visible") ? "- Collapse" : "+ Room manager";
			        });
			    });
			    getRoom();
			});

			function getRoomType()
			{
				$.ajax({
					url:"{{ route('get_room_type') }}",
					method:'GET',
					data:{},
					dataType:'json',
					success:function(data)
					{						
						$('#tb-room-type').html(data.table_data);			
					}
				})
			}

			function getRoom()
			{
				$.ajax({
					url:"{{ route('get_room') }}",
					method:'GET',
					data:{},
					dataType:'json',
					success:function(data)
					{						
						$('#tb-room').html(data.table_data);			
					}
				})
			};

			function fetch_room_data(query = '')
			{
				$.ajax({
					url:"{{ route('live_search_room') }}",
					method:'GET',
					data:{query:query},
					dataType:'json',
					success:function(data)
					{						
						$('#tb-room').html(data.table_data);				
					}
				});
			}

			$(document).on('keyup', '#search', function(){
				var query = $(this).val();
				fetch_room_data(query);
			});	

			$(document).on('change', '.sel-room-type', function (e) {
			    var optionSelected = $("option:selected", this);
			    var valueSelected = this.value;					   	  
			});

			$(document).on('change', '.sel-room-stt', function (e) {
			    var optionSelected = $("option:selected", this);
			    var valueSelected = this.value;			  
			});

			$(document).on('click', '.edit-type-btn', function(){
		        var id = this.id;
		        $('#mess_output').html('');
		        $.ajax({
		            url:"{{route('fetchdata_room_type')}}",
		            method:'GET',
		            data:{id:id},
		            dataType:'json',
		            success:function(data)
		            {
		                $('#room_type').val(data.type);
		                $('#room_price').val(data.price);
		                $('#room_description').val(data.description);
		                $('#room_type_id').val(id);
		                $('#roomTypeModal').modal('show');
		                $('#action').val('Edit');          
		                $('#button_action').val('update');
		            }
		        })
		    });

		    $(document).on('click', '#add_data',function(){
		        $('#roomTypeModal').modal('show');
		        $('#room_type_form')[0].reset();
		        $('#mess_output').html('');
		        $('#button_action').val('insert');
		        $('#action').val('Add');
		        $('.modal-title').text('Add Data');
		    });

		    $('#room_type_form').on('submit', function(event){
		        event.preventDefault();
		        $('#mess_output').html('');
		        var room_type = $('#room_type').val();
		        var room_price = $('#room_price').val();
		        var room_description = $('#room_description').val();
		        var room_type_id = $('#room_type_id').val();
		        var btn_action = $('#button_action').val();	          
		        $.ajax({
		            url:"{{ route('post_room_type') }}",
		            method:"POST",
		            data:{room_type, room_price, room_description,room_type_id,btn_action, _token: '{{csrf_token()}}'},
		            dataType:"json",
		            success:function(data)
		            {
		                if(data.error.length > 0)
		                {
		                    var error_html = '';
		                    for(var count = 0; count < data.error.length; count++)
		                    {
		                        error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
		                    }
		                    $('#form_output').html(error_html);
		                }
		                else
		                {
		                	getRoomType();
		                	$('#mess_output').html(data.success);
		                    $('#room_type_form')[0].reset();
		                    $('#roomTypeModal').modal('hide');
		                }
		            }
		        })
		    });

		    $(document).on('click', '.del-type-btn',function(){
		        var id = this.id;
		        $('#mess_output').html('');
				if(confirm("Are you sure you want to remove this records?"))
				{
					$.ajax({
						url:"{{route('del_room_type')}}",
						method:'POST',
						data:{id:id, _token: '{{csrf_token()}}'},
						dataType: 'json',
						success:function(data)
						{	
							$('#mess_output').html(data);
						}
					});					
					getRoomType();
				}
		    });

		    $(document).on('click', '.edit-room-btn', function(){
		    	var id = this.id;		        
		        $.ajax({
		            url:"{{route('fetchdata_room')}}",
		            method:'GET',
		            data:{id:id},
		            dataType:'json',
		            success:function(data)
		            {
		                $('#room_id').val(id);
		                $('#sel-room-type').val(data.type);
		                $('#sel-room-stt').val(data.status);	
		                $('#roomModal').modal('show');		                
		            }
		        })
		    });

		    $('#room_form').on('submit', function(event){
		        event.preventDefault();
		        $('#form_output').html('');
		        var id = $('#room_id').val();
		        var type = $('#sel-room-type').val();
		        var stt = $('#sel-room-stt').val(); 		              
		        $.ajax({
		            url:"{{ route('post_room') }}",
		            method:"POST",
		            data:{id, type, stt, _token: '{{csrf_token()}}'},
		            dataType:"json",
		            success:function(data)
		            {
	                	getRoom();
	                	$('#form_output').html(data);	                    
	                    // $('#roomTypeModal').modal('hide');
		            }
		        })
		    });
		});
	</script>
@endsection