
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h3>Card Texture List</h3>
            @include('system.cards.card_texture.list')
        </div>
                
        @include('system.cards.card_texture.add')
    </div>
@stop
