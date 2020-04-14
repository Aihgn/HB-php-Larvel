@extends('layouts.admin_app')
@section('content')


	<div class="card p-2 mt-3">
		<h2 class="m-3">Team Manager</h2>
		<button id="add_data"  type="button" data-toggle="modal" class="btn btn-dan-rev m-3 col-6 col-md-3">+ Add New Manager</button>
		<span id="mess_output" class="m-3"></span>
		<div class="table-responsive">
			<table class="table table-striped">
		    	<thead>
		    		<tr>
		    			<th style="width:5%">No.</th>	
		    			<th>Name</th>    			
		    			<th>Email</th>
		    			<th style="width:15%">Group</th>    			
		    			<th style="width:15%">Action</th>
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
							<td style="text-align:center;">
								<a href="#" id='{{$r->id}}' class="remove-role btn btn-danger "><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon-cont"><path d="M497.941 273.941c18.745-18.745 18.745-49.137 0-67.882l-160-160c-18.745-18.745-49.136-18.746-67.883 0l-256 256c-18.745 18.745-18.745 49.137 0 67.882l96 96A48.004 48.004 0 0 0 144 480h356c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12H355.883l142.058-142.059zm-302.627-62.627l137.373 137.373L265.373 416H150.628l-80-80 124.686-124.686z"/></svg></a>
								<a href="#" id='{{$r->id}}' class="delete-acc btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="icon-cont"><path d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"/></svg></a>
							</td> 			
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