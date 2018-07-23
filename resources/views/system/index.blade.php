
@extends('layouts.app')

@section('style')
<style>
    .config{
        text-align: center;
        display: block;
        /*background: white;*/
        border: 1px solid white;
        margin: 15px;
    }

    .config a{
        color: white;
        position: relative;
    }

    .config .ss-icons{
        font-size: 2.4em;
        display: block;
        padding: 2.2px 0; 
    }

    .config .font{
        font-size: 1.75em;
        font-weight: bold;
    }

    .config .fa{
        /*border: 1px solid red;*/
        font-size: 2em;
        padding: 5px;
    }

    .label{
        background: rgba(100, 0, 0, 0.3);;
        border-radius: 0;
        font-size: 1.2em;
        width: 100%;
        display: block;
    }

</style>
@stop
@section('content')
	

@if(Auth()->user()->can('design') && Auth()->user()->can('admin'))
    <div class="row">
        <div class="col-md-12">
            <div class="underline">
                <h3><span class="fa fa-id-card-o"></span> Card Attributes</h3>
            </div>

            <div class="config btn-primary col-md-2">
                <a href="/layer">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="fa fa-object-ungroup"></span>
                        </div>
                        <div class="col-md-12 label">
                            Card Layer
                        </div>
                    </div>
                </a>
            </div>

            <div class="config btn-primary col-md-2">
                <a href="/card_thickness">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="ss-icons ss-icon-thickness"></span>
                        </div>
                        <div class="col-md-12 label">
                            Card Thickness
                        </div>
                    </div>
                </a>
            </div>


            <div class="config btn-primary col-md-2">
                <a href="/layer/2">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="ss-icons ss-icon-rfid"></span>
                        </div>
                        <div class="col-md-12 label">
                            RFID
                        </div>
                    </div>
                </a>
            </div>


            <div class="config btn-primary col-md-2">
                <a href="/card_texture">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="ss-icons ss-icon-texture"></span>
                        </div>
                        <div class="col-md-12 label">
                            Card Texture
                        </div>
                    </div>
                </a>
            </div>
            
            
            <div class="config btn-primary col-md-2">
                <a href="/card_type">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="fa fa-id-card"></span>
                        </div>
                        <div class="col-md-12 label">
                            Card Type
                        </div>
                    </div>
                </a>
            </div>


            <div class="config btn-primary col-md-2">
                <a href="/magstripe">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="fa fa-credit-card"></span>
                        </div>
                        <div class="col-md-12 label">
                            Magstripe
                        </div>
                    </div>
                </a>
            </div>

            <div class="config btn-primary col-md-2">
                <a href="/barcode">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="fa fa-barcode"></span>
                        </div>
                        <div class="col-md-12 label">
                            Barcode
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="config btn-primary col-md-2">
                <a href="/monochrome">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="ss-icons ss-icon-finishing"></span>
                        </div>
                        <div class="col-md-12 label">
                            Monochrome
                        </div>
                    </div>
                </a>
            </div> 

            <div class="config btn-primary col-md-2">
                <a href="/embossing">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="fa fa-certificate"></span>
                        </div>
                        <div class="col-md-12 label">
                            Embossing
                        </div>
                    </div>
                </a>
            </div>

            <div class="config btn-primary col-md-2">
                <a href="/arrangement">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="font"> 3 x 4</span>
                        </div>
                        <div class="col-md-12 label">
                            Arrangement
                        </div>
                    </div>
                </a>
            </div> 
        </div>
    </div>
@endif


<div class="row">
    <div class="col-md-12">
        <div class="underline">
            <h3><span class="fa fa-suitcase"></span> Others</h3>
        </div>
        @if(Auth()->user()->can('design') && Auth()->user()->can('admin') && Auth()->user()->can('sales'))
            <div class="config btn-primary col-md-2">
                <a href="/system/stage">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="ss-icons ss-icon-stage"></span>
                            {{-- <span class="fa fa-sitemap"></span> --}}
                        </div>
                        <div class="col-md-12 label">
                            Production Stage
                        </div>
                    </div>
                </a>
            </div>
        @endif
    	   
        <div class="config btn-primary col-md-2">
            <a href="/company">
                <div class="row">
                    <div class="col-md-12">
                        <span class="fa fa-building-o"></span>
                    </div>
                    <div class="col-md-12 label">
                        Company
                    </div>
                </div>
            </a>
        </div> 


        <div class="config btn-primary col-md-2">
            <a href="/agent">
                <div class="row">
                    <div class="col-md-12">
                        <span class="fa fa-address-book"></span>
                    </div>
                    <div class="col-md-12 label">
                        Agent
                    </div>
                </div>
            </a>
        </div>

        @if(Auth()->user()->can('admin'))
    	    <div class="config btn-primary col-md-2">
    	    	<a href="/staff">
    				<div class="row">
                        <div class="col-md-12">
    						<span class="fa fa-group"></span>
                        </div>
                        <div class="col-md-12 label">
                        	Staff Management
                        </div>
                    </div>
    	    	</a>
    	    </div>
        @endif
    </div>
<div class="row">

    
@stop
