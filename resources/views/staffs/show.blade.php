@extends('layouts.app')

@section('content')

		<a href="/staff" class="btn btn-link">< Back to staff list</a><br/>
		<h2>General Info </h2>
		<form action="/staff/{{ $staff->id }}/status" method="POST">
			{{ csrf_field() }}
			{{ method_field('PATCH') }}

			<button class="btn btn-primary">{{ $staff->status == 'A' ? 'Block' : 'Activate' }} Account</button>
		</form>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Staff Name</label><br/>
					{{ $staff->name }}
				</div>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					<label>Username / Login ID</label><br/>
					{{ $staff->email }}
				</div>
			</div>


			<div class="col-md-2">
				<div class="form-group">
					<label>Status</label><br/>
					{{ $staff->status }}
				</div>
			</div>


			<div class="col-md-6">
				<div class="form-group">
					<form action="/staff/{{ $staff->id }}/edit_position" method="POST">
          {{ csrf_field() }}
                    {{ method_field('PATCH') }}

						<select name="position_id" class="form-control">
							@foreach($positions as $position)
								<option value="{{ $position->id }}" {{ $position->id == $staff->position_id ? 'selected' : '' }}>{{ $position->name }}</option>
							@endforeach
						</select>
						<button class="btn btn-primary">Update Position</button>
					</form>
				</div>
			</div>

			<div class="col-md-12">
				<div class="form-group">
					<label>Assigned Role</label><br/>
					@if(count($staff->roles) > 0)
						<div class="row">
						@foreach($staff->roles as $staff_role)
							<div class="col-md-4">
								{{ $staff_role->name }}
							</div>
						@endforeach
						</div>
					@else
						N/A
					@endif
					
				</div>
			</div>
			


			<div class="col-md-12 overline underline">
				
				<form action="/staff/{{ $staff->id }}/assign_role" method="POST">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="roles">Assign Roles</label>
						<div class="row">
						@foreach($roles as $role)
							<div class="col-md-4">
								<input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $staff->roles->contains('id', $role->id) ? 'checked' : '' }}> {{ $role->name }}
							</div>
						@endforeach
						</div>
					</div>

					<div class="form-group">
						<button class="btn btn-primary">Update Staff's Role</button>
					</div>

				</form>

			</div>




			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<h3>Salary Details</h3>
					</div>
					<div class="col-md-8">
							<div class="row underline">
								<div class="col-md-2"></div>
								<div class="col-md-4">Salary</div>
								<div class="col-md-2">Status</div>
								<div class="col-md-2">Start</div>
								<div class="col-md-2">End</div>
							</div>
						@foreach($staff->salaries->sortByDesc('id') as $salary)
							<div class="row underline">
								<div class="col-md-2">{{ $loop->iteration }}</div>
								<div class="col-md-4">{{ $salary->salary }}</div>
								<div class="col-md-2">{{ $salary->status }}</div>
								<div class="col-md-2">{{ date('d M Y ',strtotime($salary->created_at)) }}</div>
								<div class="col-md-2">{{ $salary->status != 'A' ? date('d M Y ',strtotime($salary->updated_at)) : '-' }}</div>
							</div>
						@endforeach
					</div>


					<div class="col-md-4">
						<h3 class="underline">Staff Salary</h3>
						<form action="/staff/{{ $staff->id }}/salary" method="POST">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="salary">Salary</label>
								<input type="text" class="form-control" id="salary" name="salary" value="{{ old('salary') }}" placeholder="Salary per hour" required>
							</div>

							<div class="form-group">
								<button class="btn btn-primary">Update Staff's Salary</button>
							</div>

						</form>
					</div>
				</div>
				

			</div>


			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<h3>Engagement and Job Details</h3>
					</div>
					<div class="col-md-12">
						<div class="row underline">
							<div class="col-md-2"></div>
							<div class="col-md-4">Engagement - Job</div>
							<div class="col-md-2">Status</div>
							<div class="col-md-2">Budget Hour</div>
						</div>
						@foreach($staff->assigned_jobs->sortByDesc('created_at') as $job)
							<div class="row underline">
								<div class="col-md-2">{{ $loop->iteration }}</div>
								<div class="col-md-4"><a href="/job/{{ $job->id }}">{{ $job->engagement->name.' - '.$job->title }}</a></div>
								<div class="col-md-2">{{ $job->stage->name }}</div>
								<div class="col-md-2">{{ $job->hour }}</div>
							</div>
						@endforeach
					</div>


				</div>
				

			</div>


		</div>

@stop