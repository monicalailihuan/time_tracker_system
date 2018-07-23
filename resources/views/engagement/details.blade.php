<div class="col-md-12">
	<h3>
		<i class="fa fa-folder-open" data-toggle="tooltip" title="Engagement"></i>
		{{ $engagement->name }}
	</h3>
	<div class="row border">

		<div class="key-attribute col-md-4">
			<i class="fa fa-building-o" data-toggle="tooltip" title="Company"> </i>
			<a href="/company/{{ $engagement->company->name }}">{{ $engagement->company->name }}</a>
		</div>

		<div class="key-attribute col-md-4">
			<i class="fa fa-user" data-toggle="tooltip" title="Created By"> </i>
			{{ $engagement->user->name }}
		</div>


		<div class="key-attribute col-md-4">
			<i class="fa fa-calendar" data-toggle="tooltip" title="Engagement End Date"> </i>
			{{ date('d M Y', strtotime($engagement->end_date)) }}
		</div>

	</div>

	<div class="row border">
		<div class="col-md-12">
			<label class="attribute_title" for="remark">Remark</label>
			<div class="row border">
				<span class="value">
					{!! $engagement->remark ? $engagement->remark : 'N/A' !!}
				</span>
			</div>
		</div>
	</div>


	<div class="row border">
		<div class="col-md-12">
			<label class="attribute_title" for="remark"><i class="fa fa-list-alt"></i> Job <a href="/job/create?engagement={{ $engagement->id }}" class="btn btn-primary"><i class="fa fa-plus"></i> New Job</a></label>
			<div class="border">
				<span class="value">
					@if($engagement->jobs->count() > 0)
						<div class="row underline" style="border-bottom: 1px solid gray">
							<div class="col-md-2">
								No.
							</div>
							<div class="col-md-4">
								Title
							</div>
							<div class="col-md-6">
								Budget Hour
							</div>
						</div>
						@foreach($engagement->jobs as $job)
							<div class="row">
								<div class="col-md-2">
									{{ $loop->iteration }}
								</div>
								<div class="col-md-4">
									<a href="/job/{{ $job->id }}">{{ $job->title }}</a>
								</div>
								<div class="col-md-6">
									{{ $job->hour }}
								</div>
							</div>
						@endforeach
					@else
						No job for this engagement. 
					
					@endif
				</span>
			</div>
		</div>
	</div>
</div>


