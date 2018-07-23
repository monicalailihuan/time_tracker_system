{{-- @if (Auth::check()) --}}
<div class="col-md-4">
	<h3>Add Company</h3>

	<div class="panel panel-default">
		<div class="panel-body">
			<form method="POST" action="company">
				{{ csrf_field() }}
				
				<div class="form-group {{ $errors->has('name') ? 'has-error': '' }}">
					<label for="name">Name:</label>
					<input type="text" 
						   class="form-control" 
						   id="name" name="name" 
						   placeholder="What is the name the company?" 
						   value="{{ old('name') }}"
						   required>

					{!! $errors->first('name', '<span class="help-block">:message</span>' ) !!}
				</div>



				<div class="form-group {{ $errors->has('state') ? 'has-error': '' }}">
					<label for="state">State:</label>
					<input type="text" 
						   class="form-control" 
						   id="state" name="state" 
						   placeholder="State" 
						   value="{{ old('state') }}"
						   required>

					{!! $errors->first('state', '<span class="help-block">:message</span>' ) !!}
				</div>




				<div class="form-group {{ $errors->has('postcode') ? 'has-error': '' }}">
					<label for="postcode">Postcode:</label>
					<input type="text" 
						   class="form-control" 
						   id="postcode" name="postcode" 
						   placeholder="Postcode" 
						   value="{{ old('postcode') }}"
						   required>

					{!! $errors->first('postcode', '<span class="help-block">:message</span>' ) !!}
				</div>



			

				<div class="form-group {{ $errors->has('add1') ? 'has-error': '' }}">
					<label for="name">Address 1:</label>
					<input type="text" 
						   class="form-control" 
						   id="name" name="add1" 
						   placeholder="Address 1" 
						   value="{{ old('add1') }}"
						   required>

					{!! $errors->first('add1', '<span class="help-block">:message</span>' ) !!}
				</div>



				<div class="form-group {{ $errors->has('add2') ? 'has-error': '' }}">
					<label for="name">Address 2:</label>
					<input type="text" 
						   class="form-control" 
						   id="name" name="add2" 
						   placeholder="Address 2" 
						   value="{{ old('add2') }}"
						   required>

					{!! $errors->first('add2', '<span class="help-block">:message</span>' ) !!}
				</div>

			

				<div class="form-group">
					<button class="btn btn-primary">Add Company</button>
				</div>

			</form>
		</div>
		
	</div>
</div>
{{-- @else
	<h3>please sign in</h3>

@endif --}}