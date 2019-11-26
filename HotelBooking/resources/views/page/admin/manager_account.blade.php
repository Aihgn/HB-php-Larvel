@extends('layouts.admin_app')
@section('content')


	<div class="card p-2 mt-3">
		<h2 class="m-3">Team manager</h2>
		<button id="add_data"  type="button" data-toggle="modal" class="btn btn-danger m-3 col-6 col-md-3">+ Add New Manager</button>
		<span id="mess_output" class="m-3"></span>
		<div class="table-responsive">
			<table class="table table-striped">
		    	<thead>
		    		<tr>
		    			<th>No.</th>	
		    			<th>Name</th>    			
		    			<th>Email</th>
		    			<th>Group</th>    			
		    			<th colspan="2">Action</th>
		    		</tr>
		    	</thead>
		    	<tbody id='account-manager'>    		
		    		@foreach($acc as $i=>$r)    
		    		<tr>
		    			<td>{{$i+1}}</td>
		    			<td>{{$r->name}}</td>
		    			<td>{{$r->email}}</td>   
		    			@if($r->group_id == 2) 			
		    				<td>{{$r->group_name}}</td>
		    				<td><a href="#" id='{{$r->id}}' class="remove-role btn btn-danger pb-2 pt-2 pl-1 pr-1">Remove</a></td>
		    				<td><a href="#" id='{{$r->id}}' class="delete-acc btn btn-danger pb-2 pt-2 pl-1 pr-1">Delete</a></td> 			
		    			@else
		    				<td>{{$r->group_name}}</td>
		    				<td colspan="2"></td>
		    			@endif	
		    		</tr>    		
		    		@endforeach
		    	</tbody>
		    </table>
	    </div>
    </div>


    <div id="managerModal" class="modal fade" role="dialog">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <form method="post" id="manager_form">
		                <div class="modal-header">
		                	<h4>Add Manager</h4>
		                   	<button type="button" class="close" data-dismiss="modal">&times;</button>
		                </div>
		                <div class="modal-body">
		                    {{csrf_field()}}		                   
		                    <div class="form-group m-3">
		                        <label>Full name:</label>
		                        <input type="text" name="full_name" id="full_name" class="form-control mt-3" />
		                    </div>
		                    <div class="form-group m-3">
		                        <label>Email</label>
		                        <input type="text" name="email" id="email" class="form-control mt-3" />
		                    </div>               
		                    <div class="form-group m-3">
				                <label for="select_gr">Group</label>
				                <select id="select_gr" class="ml-0 form-control">
				                    <option value="1">Admin</option>
				                    <option value="2">Manager</option>
				                </select>           
				            </div>
		                </div>
		                <div class="modal-footer">
                    		<button type="submit" class="btn btn-success">Add</button>
		                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		                </div>
		            </form>
		        </div>
		    </div>
		</div>

    <script type="text/javascript">
    	$(document).ready(function(){    		

			function getAccount()
			{
				$.ajax({
					url:"{{ route('get_account') }}",
					method:'GET',
					data:{},
					dataType:'json',
					success:function(data)
					{						
						$('#account-manager').html(data.table_data);			
					}
				})
			};

			$(document).on('click', '.remove-role', function(){
				var id = this.id;
				$('#mess_output').html('');
				if(confirm("Are you sure you want to remove role of this records?"))
				{
					$.ajax({
						url:"{{route('remove_role')}}",
						method:'POST',
						data:{id:id, _token: '{{csrf_token()}}'},
						dataType: 'json',
						success:function(data)
						{	
							$('#mess_output').html(data);
						}
					});
					getAccount();
				}
			});

			$(document).on('click', '.delete-acc', function(){
				var id = this.id;
				$('#mess_output').html('');
				if(confirm("Are you sure you want to delete this records?"))
  				{
					$.ajax({
						url:"{{route('delete_acc')}}",
						method:'POST',
						data:{id:id, _token: '{{csrf_token()}}'},
						dataType: 'json',
						success:function(data)
						{	
							$('#mess_output').html(data);
						}
					});
					getAccount();
				}
			});

			$(document).on('click', '#add_data',function(){
		        $('#managerModal').modal('show');
		        $('#manager_form')[0].reset();
		        $('#mess_output').html('');
		    });

		    $('#manager_form').on('submit', function(e){
		        e.preventDefault();
		        $('#mess_output').html('');
		        var name = $('#full_name').val();
		        var email = $('#email').val();
		        var group = $('#select_gr').val();
		        $.ajax({
		            url:"{{ route('add_manager') }}",
		            method:"POST",
		            data:{name, email, group, _token: '{{csrf_token()}}'},
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
		                	getAccount();
		                	$('#mess_output').html(data.success);
		                    $('#managerModal').modal('hide');
		                    // getAccount();
		                }
		            }
		        })
		    });
		});
			

    </script>
@endsection