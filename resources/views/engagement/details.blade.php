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
						<div class="row underline section_title" style="border-bottom: 1px solid gray">
							<div class="col-md-2">
								No.
							</div>
							<div class="col-md-4">
								Title
							</div>
							<div class="col-md-2">
								Budget Hour
							</div>
							<div class="col-md-2">
								Working Hour
							</div>
							<div class="col-md-2">
								Variance
							</div>
						</div>

						<?php 
							$total_engagement = 0; 
							$sum_budget_hour = 0;
							$sum_working_hour = 0;
							$variance_hour = 0;
						?>
						@foreach($engagement->jobs as $job)
							<div class="row">
								<div class="col-md-2">
									{{ $loop->iteration }}
								</div>
								<div class="col-md-4">
									<a href="/job/{{ $job->id }}">{{ $job->title }}</a>
										<?php $total = 0; ?>
										<?php $total_hour = 0; ?>
										<?php $user_collect = collect(); ?>
										@foreach($job->job_rates->sortBy('user_id') as $job_rate)
											<?php $user = collect(); ?>
											<?php 
												$user['user_id'] = $job_rate->rates->staff->id;
												$user['name'] = $job_rate->rates->staff->name;
												$user['working_hour'] = $job_rate->hour;
												$user['salary'] = $job_rate->rates->salary;
												$user['total_earn'] = $job_rate->hour * $job_rate->rates->salary;

												$user_collect->push($user->all());
											?>
										@endforeach

										@foreach($user_collect->groupBy('name') as $name => $uc)
											<div class="row">
												<div class="col-md-6">-{{ $name }}</div>
												<div class="col-md-6">{{ $uc->sum('total_earn') }}</div>
											</div>

											<?php $total_engagement += $uc->sum('total_earn') ?>
										@endforeach

									{{-- @foreach($staffs as $staff)
										<div class="row">
											@foreach($staff->salaries as $salary)
												@if(in_array($salary->id, $job->job_rates->pluck('salary_id')->toArray()))
													<div class="col-md-12">{{ $staff->name }} <i class="fa fa-arrow-long-right"></i>{{ $salary->salary }}</div>
												@endif
											@endforeach
										</div>
									@endforeach --}}
									


								</div>
								<div class="col-md-2">
									{{ $job->hour }}
									<?php $sum_budget_hour += $job->hour; ?>

								</div>
								<div class="col-md-2">
									{{ $job->job_rates->sum('hour') }}
									<?php $sum_working_hour += $job->job_rates->sum('hour'); ?>
								</div>
								 @if($job->stage_id==1)
					                <div class="col-md-2 "><span class="normal">TBD</span></div>
					            @else
					                <div class="col-md-2 "><span class="{{ $job->hour < $job->job_rates->sum('hour') ? 'danger' : 'ok' }}">{{ $job->hour - $job->job_rates->sum('hour') }}</span></div>
					                <?php $variance_hour += $job->hour - $job->job_rates->sum('hour')  ?>
					            @endif
							</div>
						@endforeach
						

						<div class="row underline section_title" style="border-bottom: 1px solid gray">
							<div class="col-md-2">
								Total
							</div>
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-6"></div>
									<div class="col-md-6">{{ $total_engagement }}</div>
								</div>
							</div>
							
							<div class="col-md-2">
								{{ $sum_budget_hour }}
							</div>
							<div class="col-md-2">
								{{ $sum_working_hour }}
							</div>
							<div class="col-md-2">
					            <span class="{{ $variance_hour < 0 ? 'danger' : 'ok' }}">{{ $variance_hour }}</span>
							</div>
						</div>
					@else
						No job for this engagement. 
					
					@endif
				</span>
			</div>
		</div>
	</div>
</div>


