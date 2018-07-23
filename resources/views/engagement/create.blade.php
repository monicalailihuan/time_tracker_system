@extends('layouts.app')


@section('style')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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

    @if(count($company)>0)

		<form method="POST" action="/engagement{{ count($company)==1 && request()->exists('company') ? '?company='.$company->name : '' }}" enctype="multipart/form-data">
			{{ csrf_field() }}
            <h3>Engagement Details</h3>
            <input type="hidden" name="prev_engagement" value="{{ count($engagement)==1 && request()->exists('engagement') ? $engagement->id : '' }}">
            <div class="row">
	            <div class="col-md-10">
					<div class="row border" >
			    		<div class="form-group col-md-6 {{ $errors->has('company_id') ? 'has-error': '' }}">
		        			<label for="company">Company </label>
			    			@if(count($company)==1 && request()->exists('company'))
		    					{{ $company->name }}
	                            <strong>{{ $errors->first('name') }}</strong>
	                            <input type="hidden" name="company_id" value="{{ $company->id }}">
			    			@elseif(count($company)>0 && !request()->exists('company'))
								<select class="form-control" name="company_id" id="company_id" data-country="" required>
										<option disabled selected value>- Select Company -</option>
			    					@foreach($company->sortBy('name') as $com)
			    						<option value="{{ $com->id }}" class="country_list country_{{ $com->country_id }}" data-country="country_{{ $com->country_id }}" {{ !empty($engagement->company_id) && $engagement->company_id==$com->id ? 'selected' : '' }}>{{ $com->name }}</option>
			    					@endforeach
			    				</select>
			    			@else
			    				<h4>You need to create company profile first.</h4>
			    			@endif
							{!! $errors->first('company_id', '<span class="help-block">Please select a company.</span>' ) !!}
			    		</div>

					
						<div class="form-group col-md-6 {{ $errors->has('name') ? 'has-error': '' }}">
		        			<label for="name">Engagement Name </label>
							<input type="text" class="form-control" id="name" name="name" value="{{ !empty($engagement->name) ? $engagement->name : old('name') }}" placeholder="Engagement Name" required>

							{!! $errors->first('name', '<span class="help-block">:message</span>' ) !!}
						</div>

						<div class="form-group col-md-6 {{ $errors->has('engagement_end_date') ? 'has-error': '' }}">
			      			<label for="engagement_end_date">Engagement End Date</label>
							<input type="text" class="form-control end_date" id="eta" autocomplete="off" name="engagement_end_date"  placeholder="dd-mm-yyyy" value="">
							{!! $errors->first('engagement_end_date', '<span class="help-block">:message</span>' ) !!}
				      	</div>

						<div class="form-group col-md-6 {{ $errors->has('remark') ? 'has-error': '' }}">
		        			<label for="hour">Remark </label>
							<textarea class="form-control" id="remark" name="remark" value="{{ !empty($engagement->hour) ? $engagement->hour : old('hour') }}" placeholder="Remark"></textarea>

							{!! $errors->first('remark', '<span class="help-block">:message</span>' ) !!}
						</div>

					</div>
	            </div>
				<div class="col-md-2">
					<div class="row">
						<div class="col-md-12 underline">
							<div class="row">
			            		<button class="col-md-12 btn btn-primary">Create Engagement</button><br/><br/>
							</div>
						</div>
		        	    
					</div>
				</div>
            </div>

        </form>
    @else
    	<h4>You need to create company profile first. <a href="/company">New company</a></h4>
    @endif



@stop


@section('script')
	<script src="/js/jquery-ui.min.js"></script>
    <script src="/js/assign.js"></script>

	<script>
		$(document).ready(function() {
            $('.design').prop('checked', true);
            $('#design').prop('checked', true);

			if($('#sample').is(':checked')){
				$('.sample').toggle();
				$('.not_sample').toggle();
			}

			if($('#reference_quotation').is(':checked')){
				$('.quotation').removeClass('show');
				$('#quotation_purchase_orders').val('');
				$('#quotation_purchase_orders').removeAttr('required');
				$('#quotation_purchase_order_num').val('');
				$('#quotation_purchase_order_num').removeAttr('required');
			}else{
				$('.quotation').addClass('show');
				$('#quotation_purchase_orders').attr('required', true);
				$('#quotation_purchase_order_num').attr('required', true);
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

		$('.country').change(function(){
			var id = $("input[name='country_id']:checked").val();

			if($('#company_id').data('country') != 'country_'+id){
				$('#company_id').val('');
			}
			$('.country_list').removeClass('hide-item');
			$('.country_list').addClass('hide-item');
			$('.country_list').removeClass('show');
			$('.country_'+id).addClass('show');	
		});

		$('#company_id').change(function(){
			var country = $(this).find(':selected').data('country'),
				value = country.replace("country_", "");
			$("input[name=country_id][value=" + value + "]").prop('checked', true);
			$('#company_id').attr('data-country', country);
		});


		$('#sample').change(function(){
			$('.sample').toggle();
			$('.not_sample').toggle();
			$('#sample_quantity').val('');
		});

		$('#reference_quotation').change(function(){
			if($('#reference_quotation').is(':checked')){
				$('.quotation').removeClass('show');
				$('#quotation_purchase_orders').val('');
				$('#quotation_purchase_orders').removeAttr('required');
				$('#quotation_purchase_order_num').val('');
				$('#quotation_purchase_order_num').removeAttr('required');
			}else{
				$('.quotation').addClass('show');
				$('#quotation_purchase_orders').attr('required', true);
				$('#quotation_purchase_order_num').attr('required', true);
			}
		});


		// comment
		// $('.group_title').click(function(){
  //           var role = $(this).attr("id");
  //           if($(this).is(':checked')){
  //               $('.' + role).prop('checked', true);
  //           }else{
  //               $('.' + role).prop('checked', false);
  //           }
  //       });

  //       $('#notify_btn').click(function(){
  //           $('.notify_user').addClass('show');
  //       });

  //       $('#close_tag').click(function(){
  //           $('.notify_user').removeClass('show');
  //       });

        // end comment

	</script>
@stop
