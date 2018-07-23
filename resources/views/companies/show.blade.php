@extends('layouts.app')

@section('content')

<div class="col-md-12 underline">
	<h2>
		General Info 
		<a class="btn btn-primary" id="edit" style="color: white">
			<span class="fa fa-edit" > </span>
			Edit
		</a>
		<a class="btn-primary btn" href="/engagement/create?company={{ $company->name }}">
            <span class="icon fa fa-plus"></span>
            New Engagement
    	</a>
	</h2>
	<div class="row">
		<div class="col-md-12">
			<a href="/engagement?company={{ $company->name }}">All Engagement ({{ count($company->engagements) }})</a>
		</div>
		<div class="col-md-12">
			<div class="details {{ count($errors) > 0 ? 'hide-item': '' }} ">
				<div>
					<label>Company Name: </label>
					{{ $company->name }}
				</div>

				<div>
					<label>State: </label>
					{{ $company->state }} 
				</div>

				<div>
					<label>Postcode: </label>
					{{ $company->postcode }} 
				</div>

				
				<div>
					<label>Address 1: </label>
					{{ $company->add1 }} 
				</div>


				<div>
					<label>Address 2: </label>
					{{ $company->add2 }} 
				</div>

				</div>
			</div>



		
			<div class="hide-item {{ count($errors) > 0 ? 'show': '' }} edit_form">
				<form action="/company/{{ $company->id }}" method="POST">
					{{ csrf_field() }}
					{{ method_field('PATCH') }}

					<div class="{{ $errors->has('name') ? 'has-error': '' }}">
						<label>Company Name: </label>
						<input type="text" name="name" value="{{ $company->name }}">
						
						{!! $errors->first('name', '<span class="help-block">:message</span>' ) !!}
					</div>

					<div class="{{ $errors->has('name') ? 'has-error': '' }}">
						<label>State: </label>
						<input type="text" name="state" value="{{ $company->state }}">
						
						{!! $errors->first('state', '<span class="help-block">:message</span>' ) !!}
					</div>

					<div class="{{ $errors->has('add1') ? 'has-error': '' }}">
						<label>Address 1: </label>
						<input type="text" name="add1" value="{{ $company->add1 }}">
						
						{!! $errors->first('add1', '<span class="help-block">:message</span>' ) !!}
					</div>


					<div class="{{ $errors->has('add2') ? 'has-error': '' }}">
						<label>Address 2: </label>
						<input type="text" name="add2" value="{{ $company->add2 }}">
						
						{!! $errors->first('add2', '<span class="help-block">:message</span>' ) !!}
					</div>

					<div>
						<button class="btn btn-primary">Update</button>
						<a id="cancel" class="btn btn-primary" style="color: white">Cancel</a>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>


@stop

@section('script')
	<script>
	

		$('#edit').click(function(){
			$('.details').addClass('hide-item');
			$('.edit_form').addClass('show');
		});

		$('#cancel').click(function(){
			$('.details').removeClass('hide-item');
			$('.edit_form').removeClass('show');
		});
	</script>
@stop
