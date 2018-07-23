@extends('layouts.app')

@section('style')
	<style>
		.underline{border-bottom: 1px solid #f1f1f1;}

		.legend-icon.colorPicker-picker{
			min-width: 25px;
			max-width: 25px;
			min-height: 25px;
			max-height: 25px;
			display: inline-block;
			border: 1px solid white;
			float:right;
		}

		.hide-item{
			display: none;
		}

		input[type="text"],
		input[type="number"]{
			margin-bottom: 10px;
		}
	</style>
	<link href="/css/colorPicker.css" rel="stylesheet">
@stop

@section('content')

	<div class="col-md-12 underline">
		<a href="/layer">< Back Layer Type</a>
		<h2>
			<form method="POST" action="/layer/{{ $layer_type->id }}">
				{{ csrf_field() }}
				{{ method_field('PATCH') }}

				{{ $layer_type->name }}
				<input type="hidden" id="color" name="color" value="{{ $layer_type->color }}" />
				<button id="layer_type_btn" class="hide-item btn btn-primary"></button>
			</form>

		</h2>

	</div>
	<div class="col-md-12">
		@include('system.layers.custom-attribute');
	</div>
@stop

@section('script')
	<script src="/js/jquery.colorPicker.min.js"></script>
	<script>
		$('#color').change(function() {
			$('#layer_type_btn').click();
		});
		$('#color').colorPicker();
		$('.colorPicker-picker').addClass('legend-icon');

		$( document ).ready(function() {
			var attr_type = $('#custom-type option:selected').attr('attr_type');
			attribute_list(attr_type);
		});

		$('#custom-type').change(function() {
			var attr_type = $('#custom-type option:selected').attr('attr_type');
			$('.custom_attr').removeClass('show');
			$('#new_custom_type_ck').prop( "checked", false)
			$('#new_custom_type').removeClass('show');
			attribute_list(attr_type);
		});

		$('#new_custom_type_ck').on( "click", function(){
			var attr_type = $('#custom-type option:selected').attr('attr_type');
			
			if($('#new_custom_type_ck').is(':checked')){
				attribute_list('New Attribute');
				$('#attr_type').html('');
				$('.custom_attr').removeClass('show');
				$('#new_custom_type').addClass('show');
			}else{
				attribute_list(attr_type);
				$('#new_custom_type').removeClass('show');
			}
		});

		function attribute_list(attr_type){
				$('#attr_type').html('('+attr_type+')');
				$('#type_' + attr_type).addClass('show');
				$('#attribute').val(attr_type);
				if(attr_type == 'Thickness'){
					attr_type += ' - i.e. (0.03)';
					$('.new_attr').prop('type', 'number');
					$('.new_attr').prop('step', '0.01');
					$('.new_attr').prop('min', '0.00');
					$('.new_attr').prop('max', '2.99');
				}else{
					$('.new_attr').prop('type', 'text');
					$('.new_attr').removeAttr('step');
					$('.new_attr').removeAttr('min');
					$('.new_attr').removeAttr('max');
				}
				$('.new_attr').attr('placeholder', attr_type);
		}



	</script>
@stop

