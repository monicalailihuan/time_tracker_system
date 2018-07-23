
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h3>Card Type List</h3>
            @include('system.cards.card_type.list')
        </div>
                
        @include('system.cards.card_type.add')
    </div>
@stop
