
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h3>Staff List</h3>
            @include('staffs.list')
        </div>

        <div class="col-md-4">
            <ul class="list-group">
	            <li class="list-group-item"><a href="/role">Role</a></li>
	            <li class="list-group-item"><a href="/permission">Permission</a></li>
			</ul>

            @include('staffs.add-staff')

        </div>
        
    </div>
@stop
