
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
            <h3>Variance Report</h3>
        </div>
    </div>

    <div class="row underline section_title">
        <div class="col-md-1">No. </div>
        <div class="col-md-3">Engagement (Job)</div>
        <div class="col-md-3">Staff</div>
        <div class="col-md-1">Total Budget Hour</div>
        <div class="col-md-1">Total Working Hour</div>
        <div class="col-md-1 text-center">Variance</div>
        <div class="col-md-2">Stage</div>
    </div>

    @foreach($jobs as $job)
        <div class="row underline">
            <div class="col-md-1">{{ $loop->iteration }}</div>
            <div class="col-md-3"><a href="/job/{{ $job->id }}">{{ $job->engagement->name.' - '.$job->title }}</a></div>
             <div class="col-md-3">
                <?php $total_hour = 0; ?>
                @if($job->staffs && $job->staffs->count() > 0)
                    @foreach($job->staffs as $staff)
                        <div>{{ $loop->iteration }}. {{ $staff->name }}</a> |
                            <?php $this_user_earn = 0; ?>
                            @foreach($job->job_rates as $job_rate)
                                <?php $this_user_earn += in_array($job_rate->salary_id, $staff->salaries->pluck('id')->toArray()) ? $job_rate->hour * $job_rate->rates->salary : 0 ; ?>
                            @endforeach 
                            <span data-toggle="tooltip" title="Total earn for this job">{{ $this_user_earn }}</span>
                        </div>
                    @endforeach
                @else
                    <div>TBD</div>
                @endif
            </div>
            <div class="col-md-1">{{ $job->hour }}</div>
            <div class="col-md-1">{{ $job->job_rates->sum('hour') }}</div>
            @if($job->stage_id==1)
                <div class="col-md-1 text-center"><span class="normal">TBD</span></div>
            @else
                <div class="col-md-1 text-center"><span class="{{ $job->hour < $job->job_rates->sum('hour') ? 'danger' : 'ok' }}">{{ $job->hour - $job->job_rates->sum('hour') }}</span></div>
            @endif
            
            <div class="col-md-2">{{ $job->stage->name }}</div>
           
        </div>
    @endforeach
    
    <div class="row section_title underline">
        <div class="col-md-7">Total: </div>
        <div class="col-md-1">{{ $job->sum('hour') }}</div>
        <div class="col-md-1">{{ $job_rates->sum('hour') }}</div>
        <div class="col-md-3"></div>
    </div>

@stop
