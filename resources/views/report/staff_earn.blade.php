
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="/report">< Report List</a>
        </div>
        <div class="col-md-12">
            <h3>Staff Earn Report</h3>
        </div>
    </div>

    <div class="row underline">
        <div class="col-md-1">No. </div>
        <div class="col-md-2">Name</div>
        <div class="col-md-1">Engagement (Job)</div>
        <div class="col-md-2">Total Budget Hour</div>
        <div class="col-md-2">Total Working Hour</div>
        <div class="col-md-2">Rate</div>
        <div class="col-md-2">Total Rate</div>
    </div>
    @foreach($staffs as $staff)
        <?php $total_hour = 0; ?>
        <?php $total_given_hour = 0; ?>
        <?php $total_rate = 0; ?>
        @foreach($staff->jobs as $job)
            <?php $total_given_hour += $job->hour; ?>
            <?php $total_hour += $job->pivot->hour; ?>
            <?php $total_rate += $staff->salaries->count() > 0 ? $staff->salaries->where('status', 'A')->first()->salary * $job->pivot->hour : 0 ?>
        @endforeach
        <div class="row">
            <div class="col-md-1">{{ $loop->iteration }}</div>
            <div class="col-md-2"><a href="/staff/{{ $staff->id }}">{{ $staff->name }}</a></div>
            <div class="col-md-1">{{ $staff->jobs->groupBy('engagement_id')->count() }} ({{ $staff->jobs->count() }})</div>
            <div class="col-md-2">{{ $total_given_hour }}</div>
            <div class="col-md-2">{{ $total_hour }}</div>
            <div class="col-md-2">{{ $staff->salaries && $staff->salaries->count() > 0 ? $staff->salaries->where('status', 'A')->first()->salary : 0 }}</div>
            <div class="col-md-2">{{ $total_rate }}</div>
        </div>
    @endforeach
        
@stop
