
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h3>Magnetic Stripe List</h3>
            @include('system.cards.magstripe.list')
        </div>
                
        @include('system.cards.magstripe.add')
    </div>
@stop
