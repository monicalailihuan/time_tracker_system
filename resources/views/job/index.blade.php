
@extends('layouts.app')

@section('style')
	<style>
        .infinity_icon{
            margin-top: 2.5px;
            font-size: 2.5em;
        }

        .stage{
            text-align: center;
            display: block;
            /*background: white;*/
            border: 1px solid white;
			margin: 0 0 15px 0;
        }

        .stage a{
            color: white;
            position: relative;
        }

        .stage .ss-icons{
            font-size: 2.5em; 
        }

        .label{
            background: rgba(100, 0, 0, 0.3);;
            border-radius: 0;
            font-size: 1.2em;
            width: 100%;
            display: block;
        }

        .icon{
			font-size: 2em;
			padding: 10px 0;
        }


        .function div a{
			display: block;
			/*border: 1px solid grey;*/
			min-height: 50px;
			/*line-height: 50px;*/
			text-align: center;
			color: white;
			text-decoration: none;
			font-weight: bold;
		}



	    .job_type{
	    	padding: 1px 10px; 
            border: 1px solid white;
	    }



	    .danger{
			color:white;
			background: red;
			padding: 3px 10px;
			border-radius: 5px;
	    }

	    a{
	    	cursor: pointer;
	    }

	    a:hover{
	    	cursor: pointer;
	    	text-decoration: none;
	    }

	    #filter{
		  -webkit-user-select: none;  
		  -moz-user-select: none;    
		  -ms-user-select: none;      
		  user-select: none;
	    }



		/* job list*/
		.section_key{
            cursor: pointer;
            font-weight: bold;
            font-size: 1.5em;
        }


        .job_list a{
            color: #636B6F;
        }

        .job_list a:hover{
            color: #3097D1;
        }


        .highlight{
            padding: 3px 10px;
        }
        
        .alert-small{
            color: #C70039;
        }

        .overdue-small{
            color: #db7b2b;
        }
        
        .expected_date{
            font-weight: 800;
        }


        .progress-bar-red-alert{
            border: 2px solid red;
            background: red;
        }


        .progress-bar{
            font-family: arial;
            font-weight: bold;
            color: black;
            text-shadow: -1px 0 white, 0 1px , 1px 0 white, 0 -1px white;
        }

        .progress-bar-success{
            color: white;
            text-shadow: none;
        }

        .progress-bar div{
            width: 95%;
            text-align: center;
            position: absolute;
        }

        .sample_stack_color{
            color: white;
            font-weight: bold;
        }

        .fa-stack{
            font-size: 0.8em;
            cursor: default;
        }

        .summary_stack_icon{
            font-size: 0.57em;
        }

        .flag-icon,
        .summary_stack_icon{
            margin: 3px 10px;
        }
        /*end*/
	</style>
@stop

@section('content')

    <div class="row">

        <div class="col-md-9">
    	    @include('job.list')
        </div>

    	<div class="col-md-3">
        	<div class="row">
    	    	@can('sa')
            	    <div class="stage btn-primary col-md-12">
            	    	<a href="/job/create{{ request('company') ? '?company='.request('company') : '' }}">
    						<div class="row">
                                <div class="col-md-12"><span class="icon fa fa-plus"></span></div>
                                <div class="col-md-12 label"><i class="fa fa-plus"></i> New Job</div>
                            </div>
            	    	</a>
            	    </div>
    			@endcan
    			
    			
    		</div>
    	</div>

    </div>
@stop


@section('script')
	<script>
		$('.section_key').click(function(){
			if($(this).attr('check') == 'show'){
				$(this).parent().next('.job_list').removeClass('show');
				$(this).attr('check', 'hide');
				$(this).find('.fa-caret-down').addClass('fa-caret-right');
                $(this).find('.fa-caret-down').removeClass('fa-caret-down'); 
            }else{
                $(this).parent().next('.job_list').addClass('show');
                $(this).attr('check', 'show');
                $(this).find('.fa-caret-right').addClass('fa-caret-down');    
                $(this).find('.fa-caret-right').removeClass('fa-caret-right');
			}
		});

		$('#filter').click(function(){
			if($('#filter_function').hasClass('show')){
				$('#filter_function').removeClass('show');
			}else{
				$('#filter_function').addClass('show');
			}
		});

		$('.filter_key :checkbox').change(function(){
			var function_key = $(this).parents('.filter_key').data('function'),
				value = $(this).attr('id');

			if($(this).is(':checked')){
				$("[data-" + function_key + "='" + value + "']").addClass('show');
			}else{
				$("[data-" + function_key + "='" + value + "']").removeClass('show');
			}
		});

	</script>
@stop



