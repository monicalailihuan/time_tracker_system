<div class="row underline">
	<div class="col-md-8">Name</div>
	<div class="col-md-4">
		<div class="text-center">Colour</div>
	</div> 
</div>	

@foreach($layer_types as $layer_type)
<div class="row">
	<div class="col-md-8">
		<a href="/layer/{{ $layer_type->id }}">
			{{ $layer_type->name }}
		</a>
	</div>
	<div class="col-md-4">
		<div class="text-center"><span class="legend-icon" style="background: {{ $layer_type->color  }}"></span> </div>
	</div> 
</div>
@endforeach