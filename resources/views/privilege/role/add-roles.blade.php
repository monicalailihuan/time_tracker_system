<div class="panel panel-default">
     <div class="panel-heading">Add Role</div>
	<div class="panel-body">
		<form method="POST" action="role">
			{{ csrf_field() }}
			
			<div class="form-group {{ $errors->has('company_id') ? 'has-error': '' }}" style="display:none">
				<label for="Company">Company:</label>
				<select class="form-control" name="company_id">
					<option value="1" selected></option>
				</select>

				{!! $errors->first('company_id', '<span class="help-block">:message</span>' ) !!}
			</div>

			<div class="form-group {{ $errors->has('name') ? 'has-error': '' }}">
				<label for="name">Name:</label>
				<input type="text" 
					   class="form-control" 
					   id="name" name="name" 
					   placeholder="What is the name the role?" 
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
				<label for="permissions">Permissions</label>
				@foreach($permissions as $permission)
					<br/><input type="checkbox" id="permission" name="permission[]" value="{{ $permission->id }}"> {{ $permission->name }}
				@endforeach
			</div>

			<div class="form-group">
				<button class="btn btn-primary">Add Role</button>
			</div>



		</form>
	</div>
</div>