
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
        	1.
			<a href="/revenue">Revenue Report</a>
 			{{-- report of total charge --}}
        </div>
        <div class="col-md-12">
        	2.
			<a href="/high_variance">Variance Report</a>
			{{-- list out staff with high variance, --}}
        </div>

        <div class="col-md-12">
        	3. 
			<a href="/staff_earn">Staff Total Earn Report</a>
			{{-- staff total earn --}}
        </div>

    </div>
@stop