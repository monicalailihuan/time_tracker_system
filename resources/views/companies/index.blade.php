
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h3>Companies List</h3>
            @include('companies.list')
        </div>
        @can('admin')
        @include('companies.add-companies')
        @endcan
    </div>
@stop
