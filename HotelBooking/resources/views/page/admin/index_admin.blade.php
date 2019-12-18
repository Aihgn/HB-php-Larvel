@extends('layouts.admin_app')
@section('content')
	<div class="container-fluid">    
    	<div class="row mt-3">
            <div class="col-6 col-md-4 col-xs-2">
                <div class="card pb-3">
                    <div class="card-body">
                        <a href="{{route('manager_acc')}}">
                            <h3>{{$countMng}}</h3>
                            <span>Manager</span>
                        </a>
                    </div>                        
                </div>
            </div>
            <div class="col-6 col-md-4 col-xs-2">
                <div class="card pb-3">
                    <div class="card-body">
                        <a href="#">
                            <h3>{{$countCus}}</h3>
                            <span>Reservations</span>
                        </a>
                    </div>                        
                </div>
            </div>                
            <div class="col-6 col-md-4 col-xs-2">
                <div class="card pb-3">
                    <div class="card-body">
                        <a href="{{route('all_res')}}">
                            <h3>{{$countUcf}}</h3>
                            <span>Pending Reservations</span>
                        </a>
                    </div>                        
                </div>
            </div>
            <div class="col-6 col-md-4 col-xs-2">
                
            </div>             
        </div>
    </div>

@endsection