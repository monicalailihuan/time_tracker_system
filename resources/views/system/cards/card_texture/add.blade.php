<div class="col-md-4">
	<h3>Add Card Texture</h3>

	<div class="panel panel-default">
		<div class="panel-body">
			<form method="POST" action="card_texture">
				{{ csrf_field() }}
				
				<div class="form-group {{ $errors->has('name') ? 'has-error': '' }}">
					<label for="name">Name:</label>
					<input type="text" 
						   class="form-control" 
						   id="name" name="name" 
						   placeholder="What is the name the Card Texture?" 
						   value="{{ old('name') }}"
						   required>

					{!! $errors->first('name', '<span class="help-block">:message</span>' ) !!}
				</div>


				<div class="form-group">
					<button class="btn btn-primary">Add Card Texture</button>
				</div>

			</form>
		</div>
		
	</div>
</div>