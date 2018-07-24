
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
    </style>
@stop


@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="/report">< Report List</a>
        </div>
        <div class="col-md-12">
            <h3>Engagement Report</h3>
        </div>
    </div>

    <div class="row underline section_title">
        <div class="col-md-1">No. </div>
        <div class="col-md-3">Engagement</div>
        <div class="col-md-6">Job</div>
        <div class="col-md-2">Total Revenue</div>
    </div>
    
    <?php $total = 0; ?>
    @foreach($engagements as $engagement)
        <div class="row underline">
            <div class="col-md-1">{{ $loop->iteration }}</div>
            <div class="col-md-3"><a href="/engagement/{{ $engagement->id }}">{{ $engagement->name }}</a></div>
            <div class="col-md-6">
                <?php $total_revenue = 0; ?>
                @if($engagement->jobs->count() > 0)
                    @foreach($engagement->jobs as $job)
                        <div>{{ $loop->iteration }}. <a href="/job/{{ $job->id }}">{{ $job->title }}</a> | 
                            <?php $current = 0; ?>
                            @foreach($job->job_rates as $job_rate)
                                <?php $current += $job_rate->hour * $job_rate->rates->salary; ?>
                                <?php $total_revenue += $job_rate->hour * $job_rate->rates->salary; ?>
                                <?php $total += $job_rate->hour * $job_rate->rates->salary; ?>
                            @endforeach
                            {{ $current }}
                        </div>
                    @endforeach
                @else
                    TBD
                @endif
            </div>
            <div class="col-md-2">
                {{ $total_revenue }}
            </div>

        </div>
    @endforeach
        <div class="row underline section_title">
            <div class="col-md-10">Total:</div>
            <div class="col-md-2">{{ $total }}</div>
        </div>
        
@stop
