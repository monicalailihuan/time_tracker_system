
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h3>Card Thickness List</h3>
            @include('system.cards.card_thickness.list')
        </div>
                
        @include('system.cards.card_thickness.add')
    </div>
@stop
