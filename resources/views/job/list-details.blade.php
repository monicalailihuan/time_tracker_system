
<div data-jobStatus="{{ $type }}" class="hide-item {{ ((request('f_st') && request('f_st') == $type)) || (!request('f_st') || request('f_st') == '') ? 'show' : '' }}">
	<div class="section_title row">
		<div class="section_key col-md-12" check="{{ ((!is_null(request('status'))) && (request('status')=='complete' || request('status')=='rejected')) || ($type != 'complete' && $type != 'reject') ? 'show' : 'hide' }}">
	    	{{ trans('job/index.'.$type) }}
			<i class="fa fa-caret-{{ ((!is_null(request('status'))) && (request('status')=='complete' || request('status')=='rejected')) || ($type != 'complete' && $type != 'reject') ? 'down' : 'right' }}"></i>
			<i class="fa fa-{{ $icon_set }} highlight pull-right" data-toggle="tooltip" title="{{ trans('job/index.'.$type) }}"></i> 
		</div>
	</div>
	<div class="{{ $type }} job_list hide-item {{ ((!is_null(request('status'))) && (request('status')=='complete' || request('status')=='rejected')) || ($type != 'complete' && $type != 'reject') ? 'show' : '' }}">
		@foreach ($jobs as $job)
			<span class="hide-item {{ (request('country') && $job->country->code == request('country')) || (!request()->exists("country")) ? 'show' : '' }}" data-country="{{ strtolower($job->country->name) }}">
				<div class="job_row row underline hide-item {{ (request()->exists("sample") && $job->sample == 1) || (!request()->exists("sample")) ? 'show' : '' }}" data-sample="{{ $job->sample == 1 ? 'sample' : 'not_sample' }}">
					<div class="col-md-1">
						{{ $loop->iteration }}
					</div>

					<div class="col-md-5">
						<div class="row">
							<div class="col-xs-6">
								<span class="fa-stack">
									<i class="fa fa-folder fa-stack-2x"></i>
									@if($job->sample == 1)
										<span class="fa-stack-1x sample_stack_color" data-toggle="tooltip" title="{{ trans('job/index.sample') }}">S</span>
									@endif
								</span>

						        <a href="/job/{{ $job->id }}" data-toggle="tooltip" title="{{ trans('job/index.job_title') }}"> {{ $job->title }} </a>
							</div>
						
							<div class="col-xs-6">
								@if(Auth()->user()->can('sales') || Auth()->user()->can('design') || Auth()->user()->can('admin'))
									<div class="progress" {!! count($job->job_stages->where('status', 'H')) > 0 ? "data-toggle='tooltip' title='".trans('job/index.assist')."'" : '' !!}>
							        	<a href="/job/{{$job->id}}/progress">
								        	<div class="progress-bar progress-bar-{{ count($job->job_stages->where('status', 'H')) > 0 ? 'red-alert' : $job->progress_type($job->progress) }} role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="{{ $job->progress }}" style="width:{{ $job->progress }}%">

												<div>{{ $job->progress }}%</div>
							                </div>
						                </a>
						            </div>
					           		
					            @endif
					        </div>

						</div>
					</div>



					<div class="col-md-6">
						<div class="row">
							<div class="col-xs-6">
								<i class="fa fa-building"></i> 
			    				<a href="/company/{{ $job->company->name }}" data-toggle="tooltip" title="{{ trans('job/index.company') }}">{{ $job->company->name }} </a>		
							</div>
							<div class="col-xs-2">
								<span class="flag-icon flag-icon-{{ $job->country->code }}"  data-toggle="tooltip" title="{{ trans('job/index.'.$job->country->code) }}"></span>
							</div>
							


							<div class="col-xs-4">		            		
								@if($type != 'complete')
									@if($job->expected_date_status == 'A')
										@if(Auth()->user()->can('sales') || Auth()->user()->can('design') || Auth()->user()->can('admin'))
											<span class="pull-right"  data-toggle="tooltip" title="{{ trans('job/index.expected') }}">
									        	<i class="fa fa-calendar-times-o" aria-hidden="true"></i>
									            <span class="expected_date {{ $job->expected_delivery_date && $job->expected_delivery_date <= date("Y-m-d H:i:s",strtotime("+5 days")) && $type != "reject" && $type != "complete" ? 'overdue-small' : '' }}">
									            	@if($job->expected_delivery_date)
									            		{{ date('M d, Y', strtotime($job->expected_delivery_date)) }}
									            	@else
									            		{{ trans('job/index.tba') }}
									            	@endif
									            </span>
											</span><br/>
										@endif


										<span class="pull-right"  data-toggle="tooltip" title="{{ trans('job/index.expected_complete') }}">
								        	<i class="fa fa-calendar-times-o" aria-hidden="true"></i>
								            <span class="expected_date {{ $job->expected_complete_date && $job->expected_complete_date <= date("Y-m-d H:i:s",strtotime("+5 days")) && $type != "reject" && $type != "complete" ? 'overdue-small' : '' }}">
								            	@if($job->expected_complete_date)
								            		{{ date('M d, Y', strtotime($job->expected_complete_date)) }}
								            	@else
								            		{{ trans('job/index.tba') }}
								            	@endif
								            </span>
										</span>
									@else

										<span class="pull-right"  data-toggle="tooltip" title="{{ trans('job/index.no_time_limit') }}">
								        	<span class="fa-stack">
												<i class="fa fa-calendar-o fa-stack-2x"></i>
												<span class="fa-stack-1x infinity_icon">&infin;</span>
											</span>
										</span>
									@endif
								@elseif($type == 'complete')
									<span class="pull-right"  data-toggle="tooltip" title="{{ trans('job/index.complete') }}">
							        	<i class="fa fa-calendar-times-o" aria-hidden="true"></i>
							            <span class="expected_date">
							            		{{ date('M d, Y', strtotime($job->last_work_date)) }}
							            </span>
									</span>

			            		@endif
							</div>

						</div>
					
					</div>
				</div>
			</span>
		@endforeach
	</div>
</div>