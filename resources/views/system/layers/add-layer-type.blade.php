<div class="col-md-4">
	<h3>Add Layer</h3>

	<div class="panel panel-default">
		<div class="panel-body">
			<form method="POST" action="/layer">
				{{ csrf_field() }}
				
				<div class="form-group {{ $errors->has('name') ? 'has-error': '' }}">
					<label for="name">Name:</label>
					<input type="text" 
						   class="form-control" 
						   id="name" name="name" 
						   placeholder="What is the name the layer?" 
						   value="{{ old('name') }}"
						   required>

					{!! $errors->first('name', '<span class="help-block">:message</span>' ) !!}
				</div>


				<div class="form-group {{ $errors->has('color') ? 'has-error': '' }}">
					<label for="name">Colour:</label>
					<div class="controlset">
						<input id="color" type="hidden" name="color" value="#FFFFFF" />
					</div>
				</div>


				<div class="form-group">
					<button class="btn btn-primary">Add Layer</button>
				</div>

			</form>
		</div>
		
	</div>
</div>

