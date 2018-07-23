@extends('layouts.app')

@section('style')
    <style>
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
            cursor: pointer;
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

        
        .icon_pdf{
            font-size: 1.2em;
            padding: 10px 0 38px 0;
        }

        .small_ico{
            font-size: 1em;
            margin-left: -2px;
        }

        .icon{
            font-size: 2em;
            padding: 10px 0;
        }

        .function div a:not(.quo_btn){
            display: block;
            min-height: 50px;
            /*line-height: 50px;*/
            text-align: center;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .quo_btn{
            min-height: 40px;
        }

        .progress-bar-red-alert{
            border: 2px solid red;
            background: red;
        }

        .sample_stack_color{
            color: red;
        }

        .pin_stack{
            font-size: 0.5em;
        }

        .comment_function{
            visibility: hidden;
        }

        .comments:hover .comment_function{
            visibility: visible;
        }
        
        .bookmark{
            color: #db7b2b;
        }


        /* Comment Panel */
        .comment_panel{
            z-index: 999; background: #9BBDE7; border-top: 2px solid white; border-left: 2px solid white; border-right: 2px solid white; padding: 10px;
        }

        .comment_user{
            border: 2px solid white; background: #9BBDE7; max-height: 300px; overflow: scroll; z-index: 999;
        }

        .group{
            background-color: rgba(255, 255, 255, 0.6)
        }

        textarea{
            resize: none;
        }
        .comments{
            margin-bottom: 15px;
        }

        .private_msg{
            background: rgba(225, 225, 0, 0.2);
            display: block;
        }
        
        .legend-box{
            position: absolute;
            margin-top: -50px;
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
        

        /*images*/
        .img_corner{
            background: white;
            padding: 10px;
            margin: 10px;
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



        .line-left-separator{
            border-left: 1px solid white;
        }


        .attribute_title{
            font-weight: bold;
        }

        .arrow-down {
            font-size: 20px;
            margin-top: 10px;
            position: absolute;
        }

        .danger{
            color:white;
            background: red;
            padding: 3px 10px;
            border-radius: 5px;
        }

        .highlight_local{
            color: #C70039;
        }

        .hold{
            color: #C70039;
            padding: 3px 10px;
            animation: pause linear 2s infinite alternate;
            opacity: 0;
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

        .production_expected_date{
            font-size: 0.8em;
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

        .sample{
            background: #EFCA8F;
        }

        .new_order{
            background: #3097D1;
            color: white;
        }

        .repeat{
            background: #ADD8E6;
        }
        .calendar-day{
            font-size: 0.8em;
            padding: 1px;
            margin: 0 0 0 -2px;
            font-weight: bold;
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