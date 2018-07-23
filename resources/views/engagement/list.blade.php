@if (count($engagements) > 0)
	@if (count($engagements->where('status', 'A')) > 0)
		@if (is_null(request('status')) || request('status')=='active')
			@include('engagement.list-details', ['engagements' => 
				$engagements->where('status', 'A')->sortByDesc('created_at'), 'icon_set' => 'star  alert-small', 'type'  => 'urgent'])
		@endif
	@endif
@else
    No engagement yet.
@endif