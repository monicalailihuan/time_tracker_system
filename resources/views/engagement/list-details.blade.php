
<div>
	<div class="job_list">
		@foreach ($engagements as $engagement)
				<div class="job_row row underline">
					<div class="col-md-1">
						{{ $loop->iteration }}
					</div>

					<div class="col-md-5">
						<div class="row">
							<div class="col-xs-6">
						        <a href="/engagement/{{ $engagement->id }}" data-toggle="tooltip" title="Engagement"> {{ $engagement->name }} </a>
							</div>
						
							<div class="col-xs-6">
							
					        </div>

						</div>
					</div>



					<div class="col-md-6">
						<div class="row">
							<div class="col-xs-6">
								<i class="fa fa-building"></i> 
			    				<a href="/company/{{ $engagement->company->name }}" data-toggle="tooltip" title="Company">{{ $engagement->company->name }} </a>		
							</div>
							<div class="col-xs-2">
								{{-- <span class="flag-icon flag-icon-{{ $engagement->country->code }}"  data-toggle="tooltip" title="{{ trans('job/index.'.$engagement->country->code) }}"></span> --}}
							</div>
							


							<div class="col-xs-4">		            		
							{{-- 	@if($type != 'complete')
									@if($engagement->expected_date_status == 'A')
										@if(Auth()->user()->can('sales') || Auth()->user()->can('design') || Auth()->user()->can('admin'))
											<span class="pull-right"  data-toggle="tooltip" title="{{ trans('job/index.expected') }}">
									        	<i class="fa fa-calendar-times-o" aria-hidden="true"></i>
									            <span class="expected_date {{ $engagement->expected_delivery_date && $engagement->expected_delivery_date <= date("Y-m-d H:i:s",strtotime("+5 days")) && $type != "reject" && $type != "complete" ? 'overdue-small' : '' }}">
									            	@if($engagement->expected_delivery_date)
									            		{{ date('M d, Y', strtotime($engagement->expected_delivery_date)) }}
									            	@else
									            		{{ trans('job/index.tba') }}
									            	@endif
									            </span>
											</span><br/>
										@endif


										<span class="pull-right"  data-toggle="tooltip" title="{{ trans('job/index.expected_complete') }}">
								        	<i class="fa fa-calendar-times-o" aria-hidden="true"></i>
								            <span class="expected_date {{ $engagement->expected_complete_date && $engagement->expected_complete_date <= date("Y-m-d H:i:s",strtotime("+5 days")) && $type != "reject" && $type != "complete" ? 'overdue-small' : '' }}">
								            	@if($engagement->expected_complete_date)
								            		{{ date('M d, Y', strtotime($engagement->expected_complete_date)) }}
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
									<span class="pull-right" data-toggle="tooltip" title="{{ trans('job/index.complete') }}">
							        	<i class="fa fa-calendar-times-o" aria-hidden="true"></i>
							            <span class="expected_date">
							            		{{ date('M d, Y', strtotime($engagement->last_work_date)) }}
							            </span>
									</span>

			            		@endif --}}
							</div>

						</div>
					
					</div>
				</div>
			</span>
		@endforeach
	</div>
</div>