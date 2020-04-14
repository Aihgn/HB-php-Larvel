@extends('layouts.admin_app')
@section('content')	
		<div class="card p-2 mt-3">
			<h2 class="m-3">Room Type Lists</h2>
			<button id="add_data"  type="button" data-toggle="modal" class="btn btn-dan-rev m-3 col-6 col-md-3">+ Add New Room Type</button>
			<div class="table-responsive mt-2">
				<table class="table table-striped">
			    	<thead>
			    		<tr>
			    			<th style="width:5%">No.</th>	
			    			<th>Name</th>    			
			    			<th style="width:12%">Price</th>
			    			<th style="width:10%">Quantity</th>
			    			<th style="width:10%">Available</th>
			    			<th>Description</th>
			    			<th style="width:15%">Action</th>
			    		</tr>
			    	</thead>
			    	<tbody id="tb-room-type">  
			    		@foreach($room_type as $i=>$rt)
			    			<tr>
				    			<td>{{$i+1}}</td>
				    			<td>{{$rt->name}}</td>
				    			<td>{{$rt->price}}</td>
				    			<td>{{$rt->quantity}}</td>   
				    			<td>{{$rt->available}}</td>
				    			<td>{{$rt->description}}</td>
			    				<td style="text-align:center;">
									<button id="{{$rt->id}}"  type="button" data-toggle="modal" class="edit-type-btn btn btn-success">
										<svg xmlns="http://www.w4.org/2000/svg" viewBox="0 0 576 512" class="icon-cont"><path d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"/></svg>
									</button>
									<button id="{{$rt->id}}"  type="button" data-toggle="modal" class="del-type-btn btn btn-danger">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="icon-cont"><path d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"/></svg>
									</button>
								</td>
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
		                    <div class="form-group m-3">
		                        <label>Room Type</label>
		                        <input type="text" name="room_type" id="room_type" class="form-control mt-3" />
		                    </div>
		                    <div class="form-group m-3">
		                        <label>Price</label>
		                        <input type="text" name="room_price" id="room_price" class="form-control mt-3" />
		                    </div>
		                    <div class="form-group m-3">
		                        <label>Quantity</label>	
		                        <input type="text" name="room_quantity" id="room_quantity" class="form-control mt-3" />
		                    </div>
		                    <div class="form-group m-3">
		                        <label>Available</label>	
		                        <input type="text" name="room_available" id="room_available" class="form-control mt-3" />
		                    </div>
		                    <div class="form-group m-3">
		                        <label>Description</label>	
		                        <input type="text" name="room_description" id="room_description" class="form-control mt-3" />
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

		<div id="messOutputModal" class="modal fade" role="dialog">
	   	<div class="modal-dialog">
				<div class="modal-content" style="text-align: center;">
					<div class="modal-header">
						<h2>Notification</h2>
					</div>
					<div class="modal-body">
						<span id="mess_output" class="m-3"></span>
					</div>
				 	<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
	     </div>
	  </div>
	
	<script type="text/javascript">
		$(document).ready(function(){	
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
			};			

			$(document).on('click', '.edit-type-btn', function()
			{
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
		                $('#room_quantity').val(data.quantity);
		                $('#room_available').val(data.available);
		                $('#room_description').val(data.description);
		                $('#room_type_id').val(id);
		                $('#roomTypeModal').modal('show');
		                $('#action').val('Edit');
		                $('.modal-title').html('Edit Data');
		                $('#button_action').val('update');
		            }
		        })
		   });

		   $(document).on('click', '#add_data',function()
		   {
		        $('#roomTypeModal').modal('show');
		        $('#room_type_form')[0].reset();
		        $('#mess_output').html('');
		        $('#button_action').val('insert');
		        $('#action').val('Add');
		        $('.modal-title').text('Add Data');
		   });

		   $('#room_type_form').on('submit', function(e)
		   {
		        e.preventDefault();
		        $('#mess_output').html('');
		        var room_type = $('#room_type').val();
		        var room_price = $('#room_price').val();
		        var room_quantity = $('#room_quantity').val();
		        var room_available = $('#room_available').val();
		        var room_description = $('#room_description').val();
		        var room_type_id = $('#room_type_id').val();
		        var btn_action = $('#button_action').val();
		        $.ajax({
		            url:"{{ route('post_room_type') }}",
		            method:"POST",
		            data:{room_type, room_price, room_quantity, room_available, room_description,room_type_id,btn_action, _token: '{{csrf_token()}}'},
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
		                    $('#messOutputModal').modal('show');
		                }
		            }
		        })
		   });

	    	$(document).on('click', '.del-type-btn',function()
	    	{
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
							getRoomType();
							$('#messOutputModal').modal('show');
						}
					});					
					getRoomType();
				}
	    	});
		});
	</script>
@endsection