@extends('layouts.admin_app')
@section('content')

    <div class="card mt-3 p-2">       
        {{-- <h2 class="m-3">Pick date</h2> 
        <div class="col-3 m-3 ">
            <div class="row mb-4 input-field">
            <input type="text" id="date" name="date_pick" id="date"  value="" placeholder="" />
            </div>                          
        </div> --}}
        <h2 class="m-3">List Reservations</h2>
        {{-- <div class="input-field mt-3 mb-2 col-5"> 
            <label for="search">{{ __('Search') }}</label>
            <input id="search" type="text" placeholder="" required autofocus>
        </div> --}}
        <div class="sel-type m-4 mb-5 row">
            <div class="v-align">Status:</div>
            <select class="ml-4 col-4 col-md-4 sel-stt">
                    <option value="4">All</option>
                    <option value="1">Pending</option>
                    <option value="0">Confirm</option>
                    <option value="2">Cancel</option>
                    <option value="3">Done</option>
            </select>
        </div>
    	<table class="table table-hover">
        	<thead>
        		<tr>
        			<th>No.</th>	
        			<th>Name</th>
        			<th>Phone</th>
        			<th>Email</th>
        			<th>Date in</th>
                    <th>Date out</th>
        			<th>Status</th>
        			<th colspan="2"></th>
        		</tr>
        	</thead>
        	<tbody id="tb-res-info">
        	</tbody>
        </table>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            function fetch_res(){  
                // var date = $("#date").val();
                var stt=2;
                $.ajax({
                    url:"{{route('res.pick-date')}}",
                    method:'GET',
                    data:{stt},
                    dataType: 'json',
                    success:function(data)
                    {       
                        $("#tb-res-info").html(data);
                    }
                });                
            };
            fetch_res();
            // $(document).on("change", "#date", function(){  
            //     fetch_res();
            // });
            $(document).on("change", ".sel-stt", function(){  
                var stt = $(".sel-stt").val();
                if(stt!=4)
                {
                    $.ajax({
                        url:"{{route('res-stt')}}",
                        method:'GET',
                        data:{stt},
                        dataType: 'json',
                        success:function(data)
                        {       
                            $("#tb-res-info").html(data);
                        }
                    });   
                }
                else
                {
                    fetch_res();
                }
                
            });

            $(document).on("click", ".btn-confirm", function()
            {
                var id = this.id;
                $.ajax({
                    url:"{{route('confirm-res')}}",
                    method:'GET',
                    data:{id},
                    dataType: 'json',
                    success:function(data)
                    {       
                        
                    }
                });
                 fetch_res();
            });

            $(document).on("click", ".btn-cancel", function()
            {
                var id = this.id;
                $.ajax({
                    url:"{{route('cancel-ad-res')}}",
                    method:'GET',
                    data:{id},
                    dataType: 'json',
                    success:function(data)
                    {       
                        
                    }
                });
                fetch_res();
            });            

            // $(function() {               
            //     $('input[name="date_pick"]').daterangepicker({
            //         singleDatePicker: true,
            //         showDropdowns: true,
            //         autoUpdateInput: true,
            //         locale: {
            //           cancelLabel: 'Clear',
            //           format: "DD-MM-YYYY",
            //         }               
            //     });
            // });
        });
    </script>
@endsection