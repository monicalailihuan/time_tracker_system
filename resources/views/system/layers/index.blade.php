@extends('layouts.app')
@section('style')
	<style>
		.border{
			border: 1px solid white;
			min-height: 100px;
		}

		.underline{
			min-height: 25px;
			border-bottom: 1px solid white;
		}

		.legend-icon{
			min-width: 10px;
			max-width: 10px;
			padding: 5px;
			display: inline-block;
			border: 1px solid white;
		}

		.production_time_allocation{
			position: absolute;
		}

		.overlay_extra{
			border: 1px solid white;
			background: white;
		}
	</style>
    <link href="/css/colorPicker.css" rel="stylesheet">
@stop
@section('content')


        <div class="col-md-8">
            <h3>Type of Layers</h3>
            @include('system.layers.list')
        </div>
        
        @include('system.layers.add-layer-type')
        
@stop

@section('script')
	<script src="/js/jquery.colorPicker.min.js"></script>
	<script>
		$('#color').colorPicker();
	</script>
@stop



