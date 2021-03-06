@extends('layouts.admin_app')
@section('content')

    <div class="card mt-3 p-2">       
        <h2 class="m-2 ">Pick date</h2> 
        <div class="col-3 m-3 ">
            <div class="row mb-4 input-field">
            <input type="text" id="date" name="date_pick" id="date"  value="" placeholder="" />
            </div>                          
        </div>
        <!--<div class="input-field mt-3 mb-2 col-5"> 
            <label for="search">{{ __('Search') }}</label>
            <input id="search" type="text" placeholder="" required autofocus>
        </div>-->
        <h2>List Reservations</h2>
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
            function fetch_res_out(){  
                var date = $("#date").val();
                var stt=0;
                $.ajax({
                    url:"{{route('res.pick-date')}}",
                    method:'GET',
                    data:{date:date, stt:stt},
                    dataType: 'json',
                    success:function(data)
                    {       
                        $("#tb-res-info").html(data);
                    }
                });                
            };
            $(document).on("change", "#date", function(){  
                fetch_res_out();
            });

            $(document).on("click", ".btn-check-out", function(){
                var id = this.id;
                $.ajax({
                    url:"{{route('check_out.action')}}",
                    method:'GET',
                    data:{id:id},
                    dataType: 'json',
                    success:function(data)
                    {    
                    }
                });
                fetch_res_out();
            });

            $(function() {               
                $('input[name="date_pick"]').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    autoUpdateInput: true,
                    locale: {
                      cancelLabel: 'Clear',
                      format: "DD-MM-YYYY",
                    }               
                });
            });
        });
    </script>
@endsection