@extends('layouts.app')
@section('content')

	<section class="underline">
			<a href="/role" class="btn btn-link">< Back to role list</a>
			<h2>General Info </h2>
			<form action="/role/{{ $role->id }}/status" method="POST">
				{{ csrf_field() }}
				{{ method_field('PATCH') }}

				<button class="btn btn-primary">{{ $role->status == 'A' ? 'Block' : 'Activate' }} Role</button>
			</form>
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<div class="underline"><label>Role Name</label></div>
								{{ $role->name }}
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<div class="underline"><label>Status</label></div>
								{{ trans('job/index.status'.$role->status) }}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<div class="underline"><label>Assigned Permissions</label></div>
								@foreach($role->permissions as $permission)
									<div>{{ $permission->name }}</div>
								@endforeach
							</div>
						</div>

						<div class="col-md-6">
							<div class="underline"><label>Staffs</label></div>
							@foreach($staffs as $staff)
								<div><a href="/staff/{{ $staff->id }}">{{ $staff->name }}</a></div>
							@endforeach
						</div>

					</div>
					
				</div>
				
				<div class="col-md-6">
					
					<form action="/role/{{ $role->id }}/assign_permission" method="POST">
						{{ csrf_field() }}
						<div class="form-group">
							<div class="underline"><label for="permissions">Assign Permissions</label></div>
							<div class="row">
							@foreach($permissions as $permission)
								<div class="col-md-4">
									<input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}> {{ $permission->name }}
								</div>
							@endforeach
							</div>
						</div>

						<div class="form-group">
							<button class="btn btn-primary">Update Role's Permissions</button>
						</div>

					</form>

				</div>
			</div>

	
	</section>

@stop


