@if (count($jobs) > 0)
	{{-- urgent --}}
	@if (count($jobs->where('status', 'A')) > 0)
		@if (is_null(request('status')) || request('status')=='active')
			@include('job.list-details', ['jobs' => 
				$jobs->where('status', 'A')->sortByDesc('created_at'), 'icon_set' => 'star  alert-small', 'type'  => 'urgent'])
		@endif
	@endif
@else
    No job yet.
@endif