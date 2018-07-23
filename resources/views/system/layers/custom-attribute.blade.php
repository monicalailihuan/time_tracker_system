<form action="/layer/{{ $layer_type->id }}/attribute" method="POST">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}

	<input type="hidden" name="attribute" id="attribute" value="Thickness">
	<div class="row">
		<div class="col-md-9">
		<h4>Custom Attribute <span id="attr_type"></span></h4>
			@foreach($layer_setting_options->unique('layer_setting_id') as $attribute_type)
			<div class="row underline hide-item custom_attr" id="type_{{ str_replace(' ', '_', $attribute_type->layer_setting->name) }}">
				@foreach($layer_setting_options->where('layer_setting_id', $attribute_type->layer_setting_id)->sortBy('name') as $attribute)
					@if(count($other_attributes->where('layer_setting_option_id', $attribute->id))>0)
						<div class="col-md-3 text-center">
							<div>{{ $attribute->name }}</div>
							<input type="checkbox" name="{{ $attribute_type->layer_setting->name }}[]" value="{{ $attribute->id }}" 
							{{ $other_attributes->where('layer_setting_option_id', $attribute->id)->first()->status == 'A' ? 'checked': '' }}>

						</div>
					@endif
				@endforeach
			</div>
			@endforeach
		</div>


		<div class="col-md-3">
			<div class="underline">
				<h4>Attribute Type</h4>
				<select name="attribute_type" id="custom-type" class="attribute_type form-control">
					@foreach($layer_setting_options->unique('layer_setting_id') as $attribute_type)
						<option value="{{ $attribute_type->layer_setting_id }}" attr_type="{{ str_replace(' ', '_', $attribute_type->layer_setting->name) }}">{{ $attribute_type->layer_setting->name }}</option>
					@endforeach
				</select>

				<h4>New Attribute Type</h4>
				<div class="row">
					<div class="col-md-2">
						<input type="checkbox" id="new_custom_type_ck" name="new_custom_type_ck" class="form-control">
					</div>
					<div class="col-md-10">
						<input type="text" class="form-control hide-item" id="new_custom_type" name="new_custom_type" placeholder="Attribute Type"> 
					</div>
				</div>
					
			</div><br/><br/>
			
			<div>
				<h4>New Attribute</h4>
				<input type="text" class="form-control new_attr" name="name"> 
				{!! $errors->first('name', '<div class="alert alert-danger">:message</div>' ) !!}	
			</div>
			
			<button class="btn btn-primary">Update / Add New</button>
		</div>
	</div>
</form>