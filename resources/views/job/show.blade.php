@extends('layouts.app')

@section('style')
    <style>
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

    
        .small_ico{
            font-size: 1em;
            margin-left: -2px;
        }

        .icon{
            font-size: 2em;
            padding: 10px 0;
        }






        /* function key */

        .stage{
            height: 75px;
        }

        .icon.ss-icons:not(.ss-icon-design):not(.ss-icon-stage){
            display: block;
            padding: 15px 0;
        }

        .ss-icon-design,
        .ss-icon-stage{
            display: block;
            padding: 8px 0 5px 0;
        }

        .border-warning{
            border: 3px solid red;
        }
        


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




        @keyframes pause {
            0% {opacity: 0;}
            50% {opacity: 1;}
            100% {opacity: 0;}
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
    	<div class="col-md-10">
    		@include('job.details')
		</div>

		<div class="col-md-2">
	    	@include('job.functions')
        </div>
    </div>
@stop

    
@section('script')
    <script>
      
        $('.assign').click(function(){
            $('.assign_form').addClass('show');
            $('.staff_list').removeClass('show');
        });

        $('.assign_cancel').click(function(){
            $('.staff_list').addClass('show');
            $('.assign_form').removeClass('show');
        });

    </script>
@stop