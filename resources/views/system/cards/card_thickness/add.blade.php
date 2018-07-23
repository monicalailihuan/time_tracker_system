<div class="col-md-4">
	<h3>Add Card Thickness</h3>

	<div class="panel panel-default">
		<div class="panel-body">
			<form method="POST" action="card_thickness">
				{{ csrf_field() }}
				
				<div class="form-group {{ $errors->has('start_thickness') ? 'has-error': '' }}">
					<label for="start_thickness">Start:</label>
					<input type="text" 
						   class="form-control" 
						   id="start_thickness" name="start_thickness" 
						   placeholder="Card thickness start from?" 
						   value="{{ old('start_thickness') }}"
						   required>

					{!! $errors->first('start_thickness', '<span class="help-block">:message</span>' ) !!}
				</div>


				<div class="form-group {{ $errors->has('end_thickness') ? 'has-error': '' }}">
					<label for="end_thickness">End:</label>
					<input type="text" 
						   class="form-control" 
						   id="end_thickness" name="end_thickness" 
						   placeholder="Card thickness end at?" 
						   value="{{ old('end_thickness') }}"
						   required>

					{!! $errors->first('end_thickness', '<span class="help-block">:message</span>' ) !!}
				</div>




				<div class="form-group">
					<button class="btn btn-primary">Add Card Thickness</button>
				</div>

			</form>
		</div>
		
	</div>
</div>