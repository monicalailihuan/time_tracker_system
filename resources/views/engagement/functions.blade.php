
<div class="row function">
		
	<div class="stage btn-primary col-xs-4">
    	<a href="/job/{{ $job->id }}/workflow">
			<div class="row">
                <div class="col-md-12">
                    <span class="icon ss-icons ss-icon-stage"></span>
                </div>
                <div class="col-md-12 label">
                    {{ trans('job/index.workflow') }}
                </div>
            </div>
    	</a>
    </div>

	@can('edit-job')
	    <div class="stage btn-primary col-xs-4">
	    	<a href="/job/create?job={{ $job->id }}&type=3">
					<div class="row">
                    <div class="col-md-12">
                        <span class="icon fa fa-repeat"></span>
                    </div>
                    <div class="col-md-12 label">
                    	{{ trans('job/index.repeat') }}
                    </div>
                </div>
	    	</a>
	    </div>

		<div class="stage btn-primary col-xs-4">
	    	<a href="/job/{{$job->id}}/log">
				<div class="row">
		            <div class="col-md-12">
                        <span class="icon fa fa-list-alt"></span>
                    </div>
                    <div class="col-md-12 label">
                    	{{ trans('job/index.log') }}
                    </div>
                </div>
	    	</a>
	    </div>

										
	    <div class="stage btn-primary col-xs-4">
	    	<a href="/job/{{$job->id}}/progress" data-toggle="tooltip" title="{{ $progress }}%">
				<div class="row">
					<span class="progress" style="height: 5px; display: block; margin-bottom: -4px;">
			            <div class="progress-bar progress-bar-{{ count($job->job_stages->where('status', 'H')) > 0 ? 'red-alert' : 'success' }}" role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $progress }}%;">
			            </div>
			        </span>
		            <div class="col-md-12">
                        <span class="icon fa fa-tasks"></span>
                    </div>
                    
                    <div class="col-md-12 label">
                    	{{ trans('job/index.progress') }}
                    </div>
                </div>
	    	</a>
	    </div>

	    <div class="stage btn-primary col-xs-4">
	    	<a href="/job/{{ $job->id }}/path">
				<div class="row">
	                <div class="col-md-12">
	                    <span class="icon fa fa-sitemap"></span>
	                </div>
	                <div class="col-md-12 label">
	                    {{ trans('job/index.path') }}
	                </div>
	            </div>
	    	</a>
	    </div>

	    <div class="stage btn-primary col-xs-4">
	    	<a href="/job/{{ $job->id }}/pdf">
				<div class="row">
	                <div class="col-md-12">
	                    {{-- <span class="icon fa fa-file-pdf-o"></span> --}}
	                    <span class="icon_pdf fa-stack">
                            <i class="fa fa-file-o fa-stack-2x"></i>
                            <span class="fa-stack-1x fa fa-cloud-download small_ico"></span>
                        </span>
	                </div>
	                <div class="col-md-12 label">
	                    {{ trans('job/index.pdf') }}
	                </div>
	            </div>
	    	</a>
	    </div>



		@if($job->status!='B')
			<form action="/job/{{ $job->id }}/hold" method="POST">
	    		{{ csrf_field() }}
	    		{{ method_field('PATCH') }}
			    <button class="stage btn-primary col-xs-4">
					<div class="row">
	                    <div class="col-md-12">
	                        <span class="icon fa fa-{{ $job->status!="H" ? 'pause' : 'play' }}"></span>
	                    </div>
	                    <div class="col-md-12 label">
	                    	@if($job->status!="H")
	                    		{{ trans('job/index.pause') }}
	                    	@else
	                    		{{ trans('job/index.continue') }}
	                    	@endif
	                    </div>
	                </div>
			    </button>
			</form>

			<form action="/job/{{ $job->id }}/reject" method="POST">
	    		{{ csrf_field() }}
	    		{{ method_field('PATCH') }}
			    <button class="stage btn-primary col-xs-4">
					<div class="row">
	                     <div class="col-md-12">
	                        <span class="icon fa fa-times"></span>
	                    </div>
	                    <div class="col-md-12 label">
	                    	{{ trans('job/index.reject') }}
	                    </div>
	                </div>
			    </button>
			</form>

			@can('design')
				<form action="/job/{{ $job->id }}/priority" method="POST">
		    		{{ csrf_field() }}
		    		{{ method_field('PATCH') }}
				    <button class="stage btn-primary col-xs-4" width="100%">
						<div class="row">
			                <div class="col-md-12">
			                    <span class="icon fa fa-star {{ $job->priority->id == 1 ? '' : 'highlight_local' }}"></span>
			                </div>
			                <div class="col-md-12 label">
		                    	{{ trans('job/index.priority') }}
			                </div>
		                </div>
				    </button>
				</form>


				<form action="/job/{{ $job->id }}/pin" method="POST">
		    		{{ csrf_field() }}
		    		{{ method_field('PATCH') }}
				    <button class="stage btn-primary col-xs-4" width="100%">
						<div class="row">
			                <div class="col-md-12">
			                    <span class="icon fa fa-bookmark {{ $job->pin == 1 ? 'bookmark' : '' }}"></span>
			                </div>
			                <div class="col-md-12 label">
		                    	{{ trans('job/index.pin') }}
			                </div>
		                </div>
				    </button>
				</form>
			@endcan


			@if(count($job->job_stages()->withCount('completes')->get()->where('completes_count', '>', 0)) == 0)
				<div class="stage btn-primary col-xs-4">
			    	<a href="/job/{{ $job->id }}/edit">
						<div class="row">
		                    <div class="col-md-12">
		                        <span class="icon fa fa-edit"></span>
		                    </div>
		                    <div class="col-md-12 label">
		                    	{{ trans('job/index.edit') }}
		                    </div>
		                </div>
			    	</a>
			    </div>
		    @endif
		@else
			<form action="/job/{{ $job->id }}/reject" method="POST">
	    		{{ csrf_field() }}
	    		{{ method_field('PATCH') }}
			    <button class="stage btn-primary col-xs-12">
					<div class="row">
	                     <div class="col-md-12">
	                        <span class="icon fa fa-recycle"></span>
	                    </div>
	                    <div class="col-md-12 label">
	                        {{ trans('job/index.re-enable') }}
	                    </div>
	                </div>
			    </button>
			</form>
		@endif
    @endcan



    @can('quotation-po')
		<div class="stage account-bg col-xs-12 quotation_function">
			<div class="row">
		    	@if($job->quotation_purchase_order)
		            <div class="col-xs-6 sideline">
				    	<a href="{{ Storage::disk('s3')->url($job->quotation_purchase_order) }}"  target="_blank" data-toggle="tooltip" title="Download Quotation.">
							<span class="icon fa fa-download"></span>
						</a>
		            </div>
			    @endif

                <div class="col-xs-{{ $job->quotation_purchase_order ? '6 sideline' : '12' }}">
			    	<a class="upload_quotation" data-toggle="tooltip" title="Update Quotation.">
			    		<span class="icon fa fa-cloud-upload"></span>
					</a>
                </div>
                <div class="col-xs-12 label">
                	({{ trans('job/index.quotation / po') }}) {{ $job->quotation_purchase_order_num ? $job->quotation_purchase_order_num : 'None' }}
                </div>
            </div>
	    </div>


		<div class="row hide-item quotation_form">
			<div class="col-xs-12">
	            <form action="/job/{{ $job->id }}/quotation_update" method="POST" enctype="multipart/form-data">
		    		{{ csrf_field() }}
		    		{{ method_field('PATCH') }}

					<input type="file" class="form-control" id="quotation_purchase_orders" name="quotation_purchase_orders" required>
		    		<input type="text" class="form-control" id="quotation_purchase_order_num" name="quotation_purchase_order_num" value="{{ !empty($job->quotation_purchase_order_num) ? $job->quotation_purchase_order_num : old('quotation_purchase_order_num') }}" placeholder="Quotation / PO" required>

					<div class="row">
						<div class="col-xs-6">
							<button class="btn btn-primary quo_btn col-xs-12">{{ trans('job/index.upload') }}</button>
						</div>
						<div class="col-xs-6">
					    	<a id="cancel" class="btn btn-primary quo_btn col-xs-12">{{ trans('job/index.cancel') }}</a>
					    </div>
					</div>
				   
				</form>
			</div>
		</div><br/>
	@endcan

	@can('design')
		<div class="row">
			<div class="col-xs-12">
				@if($job->status != 'B' && count($job->job_stages()->withCount('completes')->get()->where('completes_count', '>', 0)) == 0)
					@if($job->preprinted == 1)
						<div class="stage design-bg col-xs-6">
					    	<a href="/job/{{ $job->id }}/initialise-custom">
								<div class="row">
				                    <div class="col-md-12">
										<span class="icon ss-icons ss-icon-design"></span>
				                    </div>
				                    <div class="col-md-12 label">
				                    	{{ trans('job/index.designer_setting') }}
				                    </div>
				                </div>
					    	</a>
					    </div>
					@endif

					<div class="stage design-bg col-xs-6">
				    	<a href="/job/{{ $job->id }}/set-stage">
							<div class="row">
			                    <div class="col-md-12">
						    		<span class="icon ss-icons ss-icon-stage"></span>
			                    </div>
			                    <div class="col-md-12 label">
			                    	{{ trans('job/index.stage_allocation') }}
			                    </div>
			                </div>
				    	</a>
						
				    </div>
					
				@endif

				
			</div>
		</div>
    @endcan

    @if(Auth()->user()->can('sales') || Auth()->user()->can('design'))
	    <div class="stage design-bg col-xs-12 {{ (Auth()->user()->can('design') || Auth()->user()->can('sales')) && ((is_null($job->expected_delivery_date) || is_null($job->expected_complete_date)) ||  ($job->expected_dates->where('status', 'A')->where('approved_by', null)->count() > 0) || ($job->expected_dates->count() == 0)) || ($job->expected_date_status !='A') ? 'border-warning' : '' }}">
	    	<a href="/job/{{ $job->id }}/expected_date">
				<div class="row">
	                <div class="col-md-12">
			    		<span class="icon fa fa-calendar-times-o"></span>
	                </div>
	                <div class="col-md-12 label">
	                	{{ trans('job/index.expected_date') }}
	                	<i class="fa {{ $job->expected_date_status !='A' ? 'fa-times-circle' : '' }}"></i>
	                </div>
	            </div>
	    	</a>
		</div>
	@endif

	@if($job->expected_complete_date || $job->expected_date_status == 'B')
		@foreach($job->job_stages_active->sortBy('step') as $job_stage)
        	@can('production-'.$job_stage->stage->label.'-div')
	    		<div class="stage {{ $job_stage->stage->label }}-bg col-xs-4" data-toggle="tooltip" title="{{ trans('job/index.'.strtolower($job_stage->stage->name)) }}">
	    	    	<a href="/job/{{ $job->id }}/stage/{{ $job_stage->stage->id }}/{{ $job_stage->step }}">
						<div class="row">
	                        <div class="col-md-12">
								<span class="icon ss-icons ss-icon-{{ $job_stage->stage->icon }}"></span>
	                        </div>
	                    </div>
	    	    	</a>
	    	    </div>
	        @endcan
		@endforeach
    @endif

</div>