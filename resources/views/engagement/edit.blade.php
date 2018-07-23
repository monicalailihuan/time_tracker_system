@extends('layouts.app')

@section('style')
		<style>
			.small_info{
				background: #286090;
				color: white;
				padding: 3px;
			}

			.select_start{
				padding: 20px;
			}

			input[type="radio"], input[type="checkbox"]{
				margin-right: 10px;
			}

			textarea {
				margin: 0 10px;
			}

			.border{
				border: 1px solid white;
				margin: 2px;
			}

			.underline{
				min-height: 25px;
				border-bottom: 1px solid white;
			}

			.line-left-separator{
				border-left: 1px solid white;
			}

			.line-right-separator{
				border-right: 1px solid white;
			}

			.extra_padding{
				padding: 5px 10px;
			}


			.sample{
				display: none;
			}

			.side{
				font-weight: bold;
				font-size: 1.5em;
			}
		</style>

@stop

@section('content')

       
<div class="row">
    <a href="/job/{{ $job->id }}" class="btn btn-link">< Back to job details</a>
</div>
	    @if(count($company)>0)

			<form method="POST" action="/job/{{ $job->id }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				{{ method_field('PATCH') }}

	            <h3>Job Details</h3>
	            <input type="hidden" name="prev_job" value="{{ count($job)==1 && request()->exists('job') ? $job->id : '' }}">
	            <div class="col-md-10">
	            	<div class="row">
	            		
	            
			            <div class="form-group col-md-6">
		    				<h4>
		    					Company: {{ $company->name }}
	                            <strong>{{ $errors->first('name') }}</strong>
		    				</h4>
			    		</div>

			    		<div class="form-group col-md-6 {{ $errors->has('country_id') ? 'has-error': '' }}">
							<div class="row border" >
		        				<label class="col-md-12" for="country">Order from:</label>
								@foreach($countries as $country )
									<label class="col-md-6"><input type="radio" name="country_id" value="{{ $country->id }}" {{ !empty($job->country_id) && $job->country_id==$country->id ? 'checked' : '' }} required>
										{{ $country->name }}
									</label>
								@endforeach
							</div>
							{!! $errors->first('country_id', '<span class="help-block">Please select origin country of order.</span>' ) !!}
						</div>

			    		 <div class="form-group col-md-12">
			    		 	<div class="border">
		        				<label class="col-md-12" for="agent">Project Agent</label>
			    				<select class="form-control ddl" name="agent_id" id="agent_id">
										<option value>- Select Agent -</option>
			    					@foreach($agents as $agent)
			    						<option value="{{ $agent->id }}" {{ !empty($job->agent_id) && $job->agent_id==$agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>
			    					@endforeach
			    				</select>

			    				<input type="checkbox" class="other_agent_ck ck" name="other_agent_ck">Other: 
								<div class="hide-item-visible">
									<input type="text" class="form-control" name="other_agent" value="{{ old('other_agent') }}" placeholder="Agent Name">
								</div>
			    		 	</div>
			    		</div>

						<div class="form-group col-md-6 {{ $errors->has('title') ? 'has-error': '' }}">
							<div class="row border" >
		        				<label class="col-md-12" for="title">Job Title </label>
								<input type="text" class="form-control" id="title" name="title" value="{{ !empty($job->title) ? $job->title : old('title') }}" placeholder="Job Title" required>
							</div>
							{!! $errors->first('title', '<span class="help-block">:message</span>' ) !!}
						</div>


						<div class="form-group col-md-6 {{ $errors->has('quantity') ? 'has-error': '' }}">
							<div class="row border" >
		        				<label class="col-md-12" for="quantity">Quantity <i class="fa fa-info-circle" data-toggle="tooltip" title="This quantity will only be for current job. Even for sample job, it will not bring to final production job."></i></label>
								<input type="number" class="form-control" id="quantity" name="quantity" value="{{ $job->sample==1 ? $job->reference_quantity : $job->quantity }}" placeholder="Quantity" required>
							</div>
							{!! $errors->first('quantity', '<span class="help-block">:message</span>' ) !!}
						</div>




						<div class="form-group col-md-6 {{ $errors->has('card_thickness_id') ? 'has-error': '' }}">
							<div class="row border" >
		        				<label class="col-md-12" for="card_thickness">Card Thickness</label>

		        				<select class="form-control ddl" name="card_thickness_id" id="card_thickness_id">
									<option disabled selected value>- Select Card Thickness -</option>
									@foreach($card_thickness as $c_thickness )
										<option value="{{ $c_thickness->id }}" {{ !empty($job->card_thickness_id) && $job->card_thickness_id==$c_thickness->id ? 'selected' : '' }}>
										  	{{ $c_thickness->start_thickness }} ~ {{ $c_thickness->end_thickness }}
										</option>
									@endforeach
								</select>
							
								<input type="checkbox" radio="card_thickness" class="other_thickness_ck ck" name="other_thickness_ck">Other: 
								<div class="hide-item-visible row">
									<div class="col-md-6">
										<input type="text" class="form-control" name="start_thickness" value="{{ old('start_thickness') }}" placeholder="From">
									</div>
									<div class="col-md-6">
										<input type="text" class="form-control" name="end_thickness" value="{{ old('end_thickness') }}" placeholder="To">
									</div>
								</div>

							</div>
							{!! $errors->first('card_thickness_id', '<span class="help-block">Please select a card thickness.</span>' ) !!}
						</div>

						<div class="form-group col-md-6">
							<div class="row border" >
		        				<label class="col-md-12" for="card_feature">Card Type</label>
							

								<select class="form-control ddl" name="card_feature_id" id="card_feature_id">
									<option disabled selected value>- Select Card Type -</option>
									@foreach($card_features as $card_feature )
										<option value="{{ $card_feature->id }}" {{ !empty($job->card_feature_id) && $job->card_feature_id==$card_feature->id ? 'selected' : '' }}>{{ $card_feature->name }}</option>
									@endforeach
								</select>

								<input type="checkbox" radio="card_feature" class="other_card_feature_ck ck" id="other_card_feature_ck" name="other_card_feature_ck">Other: 
								<div class="hide-item-visible">
									<input type="text" class="form-control" name="other_card_feature" value="{{ old('other_card_feature') }}" placeholder="New Card Type">
								</div>
							</div>
						</div>



						<div class="form-group col-md-6">
							<div class="row border" >
		        				<label class="col-md-12" for="rfid">RFID</label>

								<select class="form-control ddl" name="rfid_type" id="rfid_type_id">
									<option disabled selected value>- Select RFID -</option>
									@foreach($rfid_types as $rfid_type )
										<option value="{{ $rfid_type->id }}" {{ !empty($rfid_selected->id) && $rfid_selected->id==$rfid_type->id ? 'selected' : '' }} {{ empty($rfid_selected->id) && !empty($job->rfid_type) && is_numeric($job->rfid_type) && $job->rfid_type==$rfid_type->id ? 'selected' : '' }}>{{ $rfid_type->name }}</option>
									@endforeach
								</select>
							
								<input type="checkbox" radio="rfid" class="other_rfid_ck ck" name="other_rfid_ck"
								{{ empty($rfid_selected->id) && !empty($job->rfid_type) && !is_numeric($job->rfid_type) ? 'checked' : '' }}>Other: 
								<div class="{{ empty($rfid_selected->id) && !empty($job->rfid_type) && !is_numeric($job->rfid_type) ? '' : 'hide-item-visible' }}">
									<input type="text" class="form-control" name="other_rfid" value="{{ empty($rfid_selected->id) && !empty($job->rfid_type) && !is_numeric($job->rfid_type) ? $job->rfid_type : '' }}" placeholder="New RFID">
								</div>

							</div>
						</div>

		        		<label class="col-md-12">Card Information</label>
						<div class="form-group col-md-12 ">
							<div class="row border">
								@for($card_face = 1; $card_face > -1; $card_face--)
									<div class="col-md-6 {{ $card_face==1 ? 'line-right-separator' : 'line-left-separator'}}">
										<div class="row">
											<div class="col-md-12 underline side">{{ $card_face==1 ? 'Front' : 'Back'}}</div>

											<div class="col-md-12 extra_padding underline">
												<label for="photo_image">Photo Imaging </label>
												<input type="checkbox" name="photo_image_{{ $card_face==1 ? 'front' : 'back'}}" id="photo_image_{{ $card_face==1 ? 'front' : 'back'}}" {{ count($job) > 0 && !empty($job->card_details->where('side', $card_face)->first()->photo_image) ? 'checked' : '' }}>
											</div>

											<label class="col-md-12 extra_padding" for="barcode">Barcode</label>
											<select class="form-control ddl" name="barcode_{{ $card_face==1 ? 'front' : 'back'}}" id="barcode_{{ $card_face==1 ? 'front' : 'back'}}">
												<option selected value>- Select Barcode -</option>
												@foreach($barcodes as $barcode)
													<option value="{{ $barcode->id }}" 
													{{ count($job) > 0 && !empty($job->card_details->where('side', $card_face)->first()->barcode_id) && $job->card_details->where('side', $card_face)->first()->barcode_id==$barcode->id ? 'selected' : '' }}>
														{{ $barcode->name }}
													</option>
												@endforeach
											</select>
										
											<label class="col-md-12 extra_padding" for="monochrome">Monochrome</label>
											<select class="form-control" name="monochrome_{{ $card_face==1 ? 'front' : 'back'}}" id="monochrome_{{ $card_face==1 ? 'front' : 'back'}}">
												<option selected value>- Select Monochrome -</option>
												@foreach($monochromes as $monochrome )
													<option value="{{ $monochrome->id }}" 
													{{ count($job) > 0 && !empty($job->card_details->where('side', $card_face)->first()->monochrome_id) && $job->card_details->where('side', $card_face)->first()->monochrome_id==$monochrome->id ? 'selected' : '' }}>
														{{ $monochrome->name }}
													</option>
												@endforeach
											</select>

											<label class="col-md-12 extra_padding" for="embosing">Embossing</label>
											<select class="form-control" name="embossing_{{ $card_face==1 ? 'front' : 'back'}}" id="embossing_{{ $card_face==1 ? 'front' : 'back'}}">
												<option selected value>- Select Embossing -</option>
												@foreach($embossings as $embossing )
													<option value="{{ $embossing->id }}"
													{{ count($job) > 0 && !empty($job->card_details->where('side', $card_face)->first()->embossing_id) && $job->card_details->where('side', $card_face)->first()->embossing_id==$embossing->id ? 'selected' : '' }}>
														{{ $embossing->name }}
													</option>
												@endforeach
											</select>

											
											<div class="col-md-12 extra_padding">
												<label for="magstripe">Magnetic Stripe </label>
												<input type="checkbox" class="magstripe_ck ck" name="magstripe_{{ $card_face==1 ? 'front' : 'back'}}"
												{{ count($job) > 0 && !empty($job->card_details->where('side', $card_face)->first()->magstripe_type_id) ? 'checked' : '' }}>

												<div class="hide-item-visible {{ count($job) > 0 && !empty($job->card_details->where('side', $card_face)->first()->magstripe_type_id) ? 'show' : '' }}">
													<select class="form-control" name="magstripe_type_{{ $card_face==1 ? 'front' : 'back'}}" id="magstripe_type_{{ $card_face==1 ? 'front' : 'back'}}">
														<option disabled selected value>- Select Magnetic Stripe -</option>
														@foreach($magstripe_types as $magstripe_type )
															<option value="{{ $magstripe_type->id }}"
															{{ count($job) > 0 && !empty($job->card_details->where('side', $card_face)->first()->magstripe_type_id) && $job->card_details->where('side', $card_face)->first()->magstripe_type_id==$magstripe_type->id ? 'selected' : '' }}>
																{{ $magstripe_type->name }}
															</option>
														@endforeach
													</select>
													
													<label class="col-md-4"><input type="checkbox" name="t1_{{ $card_face==1 ? 'front' : 'back'}}" value="1" {{ count($job) > 0 && !empty($job->card_details->where('side', $card_face)->first()->t1) ? 'checked' : '' }}>Track 1</label>
													<label class="col-md-4"><input type="checkbox" name="t2_{{ $card_face==1 ? 'front' : 'back'}}" value="1" {{ count($job) > 0 && !empty($job->card_details->where('side', $card_face)->first()->t2) ? 'checked' : '' }}>Track 2</label>
													<label class="col-md-4"><input type="checkbox" name="t3_{{ $card_face==1 ? 'front' : 'back'}}" value="1" {{ count($job) > 0 && !empty($job->card_details->where('side', $card_face)->first()->t3) ? 'checked' : '' }}>Track 3</label>
												</div>
											</div>
											
										</div>
									</div>
								@endfor
								


		        				
							</div>
						</div>



						<label class="col-md-12">Miscellaneous</label>
						<div class="form-group col-md-12 ">
							<div class="row border">
								
								<div class="col-md-6">
									<div class="row">
										<label class="col-md-12 extra_padding  {{ $errors->has('card_texture_id') ? 'has-error': '' }}" for="card_texture">Card Texture</label>
										{!! $errors->first('card_texture_id', '<span class="help-block">Please select a card texture.</span>' ) !!}
					        			@foreach($card_textures as $card_texture )
										  <label class="col-md-6">
												<input type="radio" name="card_texture_id" value="{{ $card_texture->id }}" {{ (count($job) > 0 && $job->card_texture_id==$card_texture->id) || (count($job) == 0 && $card_texture->name == 'none') ? 'checked' : '' }}>{{ ucwords($card_texture->name) }}
										  </label>
										@endforeach

										<label class="col-md-12 extra_padding" for="signature_panel">Signature Panel</label>
										<label class="col-md-6"><input type="radio" name="signature_panel" value="2" required {{ !empty($job->signature_panel) && $job->signature_panel==2 ? 'checked' : '' }}>Opaque</label>
										<label class="col-md-6"><input type="radio" name="signature_panel" value="1" required {{ !empty($job->signature_panel) && $job->signature_panel==1 ? 'checked' : '' }}>Translucent</label>
										<label class="col-md-6"><input type="radio" name="signature_panel" value="0" required {{ !empty($job->signature_panel) && $job->signature_panel!=0 ? '' : 'checked' }}>None</label>

									
										<label class="col-md-12 extra_padding" for="slot_punch">Slot Punch</label>
										<label class="col-md-6"><input type="radio" name="slot_punch" value="1" required {{ !empty($job->slot_punch) && $job->slot_punch==1 ? 'checked' : '' }}>Yes</label>
										<label class="col-md-6"><input type="radio" name="slot_punch" value="0" required {{ !empty($job->slot_punch) && $job->slot_punch!=0 ? '' : 'checked' }}>No</label>

									</div>
								</div>


								<div class="col-md-6">
									<div class="row">
										<label class="col-md-12 extra_padding" for="barcode">Remark</label><br/>
		        						<textarea class="col-md-11" name="remark" class="form-control" id="remark" cols="25" rows="5" placeholder="Enter your remark...">{{ $job->remark }}</textarea>
									</div>
								</div>
		        				
							</div>
						</div>
					
					</div>
	            </div>
				<div class="col-md-2">
					<div class="row">
						<div class="col-md-12 underline">
							<div class="row">
			            		<button class="col-md-12 btn btn-primary">Edit Job</button><br/><br/>
		            			
		            			<div class="col-md-12">
									<label>Preprinted: </label> 
			            			<span class="preprinted pull-right"><input type="checkbox" id="preprinted" value="1" name="preprinted" {{ (count($job) > 0 && $job->preprinted != 0) || (count($job) == 0) ? 'checked' : ''}}></span>
								</div>

		            			<div class="col-md-12">
									<label>Urgent: </label> 
			            			<span class="urgent pull-right"><input type="checkbox" value="1" name="urgent" {{ count($job) > 0 && $job->priority_id == 2 ? 'checked' : ''}}></span>
			            			{{ $job->proirity_id  }}
								</div>

								<div class="col-md-12">
									<label>Sample: </label> 
			            			<span class="urgent pull-right"><input type="checkbox" id="sample" name="sample" value="1" {{ $job->sample==1 ? 'checked' : '' }}></span>
								</div>
								
								<div class="form-group sample col-md-12 {{ $errors->has('sample_quantity') ? 'has-error': '' }}">
									<input type="number" class="form-control" id="sample_quantity" name="sample_quantity" placeholder="Sample Quantity" value="{{ $job->quantity }}">
								</div>
							</div>

						</div>

						
						@if(count($job->job)==1)
						<div class="col-md-12 underline">
	            			<label>Reference: </label> <br/>
	            			<span>
	            				{{ count($job->job)==1 ? $job->job->title : '' }}
	            			</span>
		        	    </div>
		        	    @endif



		        	    <div class="col-md-12">
	            			<label>Job Type: </label> 
	            			<span class="pull-right job_type">
	            				<span class="sample">Sample</span>
	            				<span class="not_sample">{{ count($job->job)==1 ? 'Repeat' : 'New Job' }}</span>
	            			</span>
		        	    </div>
					</div>
					

				</div>
	        </form>
	    @else
	    	<h4>You need to create company profile first. <a href="/company">New company</a></h4>
	    @endif



@stop


@section('script')
	<script>
		$(document).ready(function() {
			if($('#sample').is(':checked')){
				$('.sample').toggle();
				$('.not_sample').toggle();
			}
		});

		$('.ddl').change(function(){
			$(this).next('.ck').prop('checked', false);
			$(this).next('.ck').next('div').find('input:text, select').removeAttr('required');
			if($(this).attr('id') == 'card_thickness_id'){
		    	$(this).attr('required', 'true');
		    }
			$(this).next('.ck').next('div').removeClass('show');
		});

		$('.ck').change(function() {
			if($(this).is(':checked')){
				var respective_radio = $(this).attr('radio');
				$('.'+respective_radio).prop('checked', false);
			    $(this).next('div').addClass('show');
			    $(this).next('div').find('input:text, select').attr('required', 'true');
			    if($(this).prev('select').attr('id') == 'card_thickness_id'){
			    	$(this).prev('select').removeAttr('required');
			    }
			    $(this).prev('select').val('');
			}else{
				if($(this).prev('select').attr('id') == 'card_thickness_id'){
			    	$(this).prev('select').attr('required', 'true');
			    }
			    $(this).next('div').removeClass('show');
			    $(this).next('div').find('input:text, select').removeAttr('required');
			}
		});

		$('#card_feature_id').change(function(){
			$('#preprinted').prop('checked', false);
		});
		

		$('#other_card_feature_ck').change(function(){
			if($(this).is(':checked')){
				$('#preprinted').prop('checked', false);
			}else{
				$('#preprinted').prop('checked', true);
			}
		});


		$('#sample').change(function(){
			$('.sample').toggle();
			$('.not_sample').toggle();
			$('#sample_quantity').val('');
		});

	</script>
@stop
