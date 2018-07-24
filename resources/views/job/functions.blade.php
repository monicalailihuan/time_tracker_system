
<div class="row function">
	<div class="col-xs-12">
		@if($job->stage_id == 1)


			@if($job->staffs->count() > 0)
				@foreach($job->staffs as $staff)

					@if($staff->id == Auth()->id())
						<h3>Working Hour</h3>
						<form action="/job/{{ $job->id }}/track" method="Post">
							{{ csrf_field() }}
							
							<div class="form-group">
								<label for=""></label>
								<input type="number" class="form-control" id="" name="hour" value="" placeholder="Working Hour" required>
							</div>

							<input type="hidden" name="salary_id" value="{{ $staff->salaries->where('status', 'A')->first()->id }}">

							<textarea name="remark" class="form-control" id=""></textarea>
							<br/>

							<button class="btn-primary btn">Save</button>
						</form>
					@endif
				@endforeach
			@endif
    	@endif
    </div>

</div>