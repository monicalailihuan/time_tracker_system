@extends('layouts.app')

@section('style')
    <style>

        .danger{
            background: red;
            color: white;
        }

        .ok{
            background: green;
            color: white;
        }

        .ok,
        .danger{
            padding: 0 15px;
        }
  
        /* function key */




        /*job details*/
        .small_info{
            background: #286090;
            color: white;
            padding: 3px;
        }

        .select_start{
            padding: 20px;
        }


        .border label,
        .attribute_title{
            color: #646A6E;
        }


        .line-left-separator{
            border-left: 1px solid white;
        }


        .attribute_title{
            font-weight: bold;
        }



        i{
            cursor: default;
            white-space: pre-line;
        }

        .tooltip-inner{
            min-width: 200px;
        }


        
        .key-attribute {
            height: 20px;
            margin-bottom: 15px;
            padding-bottom: 35px;
        }

        .btm.key-attribute{
            margin-top: 15px;
            padding-bottom: 0;
        }

        .job_details .fa-stack{
            font-size: 0.5em;
            cursor: default;
        }
        .fa-stack-2x{
            margin: -2px 0 0 -2px;
        }
    
    </style>
@stop

@section('content')
    
    <div class="row">
	        
			{{-- <a href="/company/{{ $job->company->name }}/master_jobs" class="btn btn-link">< Back to master job</a> --}}

        	<div class="col-md-12">
        		@include('engagement.details')
			</div>

{{-- 
			<div class="col-md-3">
    	    	@include('engagement.functions')
	        </div> --}}


    </div>
@stop

    
@section('script')
    <script>
        $('.upload_quotation').click(function(){
            $('.quotation_function').hide();
            $('.quotation_form').addClass('show');
        });

        $('#cancel').click(function(){
            $('.quotation_function').show();
            $('.quotation_form').removeClass('show');
        });

        
        $('#notify_btn').click(function(){
            $('.notify_user').addClass('show');
        });

        $('#close_tag').click(function(){
            $('.notify_user').removeClass('show');
        });
        
        $('.group_title').click(function(){
            var role = $(this).attr("id");
            if($(this).is(':checked')){
                $('.' + role).prop('checked', true);
            }else{
                $('.' + role).prop('checked', false);
            }
        });

    </script>
@stop