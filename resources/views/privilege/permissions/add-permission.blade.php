<div class="panel panel-default">
    <div class="panel-heading">Add Permission</div>
	<div class="panel-body">
		<form method="POST" action="permission">
			{{ csrf_field() }}
		

			<div class="form-group {{ $errors->has('name') ? 'has-error': '' }}">
				<label for="name">Name:</label>
				<input type="text" 
					   class="form-control" 
					   id="name" name="name" 
					   placeholder="What is the name the permission?" 
					   value="{{ old('name') }}"
					   required>

				{!! $errors->first('name', '<span class="help-block">:message</span>' ) !!}
			</div>


			<div class="form-group {{ $errors->has('label') ? 'has-error': '' }}">
				<label for="label">Label:</label>
				<input type="text" 
					   class="form-control" 
					   id="label" name="label" 
					   placeholder="What is the label?" 
					   value="{{ old('label') }}"
					   required>

				{!! $errors->first('label', '<span class="help-block">:message</span>' ) !!}
			</div>

			<div class="form-group">
				<button class="btn btn-primary">Add Permission</button>
			</div>

		</form>
	</div>
	
</div>