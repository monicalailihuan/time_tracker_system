<div class="col-md-12">
	<h3>
		<i class="fa fa-list-alt" data-toggle="tooltip" title="Job"></i>
		{{ $job->title }}
		<div class="pull-right">
			@if($job->stage_id == 1)
				<form action="/job/{{ $job->id }}/complete" method="Post">
					{{ csrf_field() }}
					{{ method_field('PATCH') }}

					<button class="btn btn-primary">
						<div class="row">
			                <div class="col-md-12">
			                	Complete
			                    <span class="fa fa-check"></span>
			                </div>
			            </div>
					</button>
				</form>

			@elseif($job->stage_id == 2)
				@can('sa')
					<form action="/job/{{ $job->id }}/review" method="Post">
						{{ csrf_field() }}
						{{ method_field('PATCH') }}

						<button class="btn btn-primary">
							<div class="row">
				                <div class="col-md-12">
				                	Review
				                    <span class="fa fa-check"></span>
				                    <span class="fa fa-check"></span>
				                </div>
				            </div>
						</button>
					</form>
				@endcan
	    	@endif
		</div>
	</h3>

	<div class="row border">

		<div class="key-attribute col-md-3">
			<i class="fa fa-folder" data-toggle="tooltip" title="Engagement"> </i>
			<a href="/engagement/{{ $job->engagement->id }}">{{ $job->engagement->name }}</a>
		</div>

		<div class="key-attribute col-md-3">
			<i class="fa fa-user" data-toggle="tooltip" title="Created By"> </i>
			{{ $job->user->name }}
		</div>


		<div class="key-attribute col-md-3">
			<i class="fa fa-calendar" data-toggle="tooltip" title="Created At"> </i>
			{{ date('d M Y', strtotime($job->created_at)) }}
		</div>


		<div class="key-attribute col-md-3">
			<i class="fa fa-tasks" data-toggle="tooltip" title="Stage"> </i>
			{{ $job->stage->name }}
		</div>

		<div class="key-attribute col-md-3">
			<i class="fa fa-clock-o" data-toggle="tooltip" title="Budget Hour"> </i>
			{{ $job->hour }}
		</div>

	</div>

	<div class="row border">
		<div class="col-md-12">
			<label class="attribute_title" for="remark">Remark</label>
			<div class="row border">
				<span class="value">
					{!! $job->remark ? $job->remark : 'N/A' !!}
				</span>
			</div>
		</div>
	</div>


	<div class="row border">
		<div class="col-md-12">
			<label class="attribute_title" for="remark">Staff Assign</label>
			@if($job->stage_id == 1)
				<a class="btn btn-primary assign" style="color: white"><i class="fa fa-plus"></i> Assign Staff</a>
			@endif
		</div>
		<div class="col-md-12">
			<div class="row border">
				<div class="col-md-12 hide-item show staff_list">

					@if($job->staffs->count() > 0)
						<div class="row underline" style="border-bottom: 1px solid gray">
							<div class="col-md-1">
								No.
							</div>
							<div class="col-md-2">
								Staff
							</div>
							<div class="col-md-1">
								Hour Used
							</div>

							<div class="col-md-2">
								Rate x Hour (RM)
							</div>

							<div class="col-md-2">
								Status
							</div>
							<div class="col-md-4">
								Remark
							</div>
						</div>
							
						@foreach($job->staffs as $staff)
							<div class="row">
								<div class="col-md-1">
									{{ $loop->iteration }}
								</div>
								<div class="col-md-2">
									{{ $staff->name }}
								</div>
								<div class="col-md-1">
									{{ $staff->pivot->hour }}
								</div>
								<div class="col-md-2">
									<span data-toggle="tooltip" title="{{ $staff->salaries->count() > 0 ? $staff->salaries->where('status', 'A')->first()->salary.' x '.$staff->pivot->hour : 'N/A' }}">
										{{ $staff->salaries->count() > 0 ? $staff->salaries->where('status', 'A')->first()->salary * $staff->pivot->hour : 'N/A' }}
									</span>
								</div>
								<div class="col-md-2">
									{{ $staff->pivot->complete == 0 ? 'Ongoing' : 'Completed' }}
								</div>
								<div class="col-md-4">
									{{ $staff->pivot->remark ? $staff->pivot->remark : 'N/A' }}
								</div>
							</div>
						@endforeach

							<div class="row overline">
								<div class="col-md-3">
									<label for="">Total:</label>
								</div>
								<div class="col-md-1">
									@if($job->stage_id==3)
										<?php $total = 0; ?>
										<?php $total_rate = 0; ?>
										@foreach($job->staffs as $staff)
											<?php $total += $staff->pivot->hour; ?>
											<?php $total_rate += $staff->salaries->count() > 0 ? $staff->salaries->where('status', 'A')->first()->salary * $staff->pivot->hour : 0 ?>
										@endforeach
										{{ $total }}
									@else
										TBD
									@endif
								</div>
								<div class="col-md-1">
									@if($job->stage_id==3)
										{{ $total_rate  }}
									@else
										TBD
									@endif
								</div>

								<div class="col-md-2">
								</div>
								<div class="col-md-4">
								</div>
							</div>
					@else
						No staff assigned.
						{{-- <a href="/job/create?engagement={{ $job->id }}" class="btn btn-primary"><i class="fa fa-plus"></i> New Job</a> --}}
					@endif
				</div>
				<div class="col-md-12 hide-item assign_form">
					<form action="/job/{{ $job->id }}/assign" method="POST">
						{{ csrf_field() }}
						{{-- {{ method_field('PATCH') }} --}}
								@foreach($staffs as $staff)
									<div class="form-group col-md-4">
										<input type="checkbox" id="" name="user_id[]" value="{{ $staff->id }}" 
										@foreach($job->staffs as $this_job_staff)
											{{ $this_job_staff->id == $staff->id ? 'checked' : '' }}
										@endforeach
										>
										<span>{{ $staff->name }}</span>
									</div>
								@endforeach

						<button class="btn btn-primary">Assign</button>
						<a class="btn btn-primary assign_cancel" style="color: white">Cancel</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


