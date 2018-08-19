
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="/report">< Report List</a>
        </div>
        <div class="col-md-12">
            <h3>Staff Chargeout Report</h3>
        </div>
    </div>

    <div class="row underline section_title">
        <div class="col-md-1">No. </div>
        <div class="col-md-4">Name</div>
        <div class="col-md-1">Job</div>
        <div class="col-md-2">Total Budget Hour</div>
        <div class="col-md-2">Total Working Hour</div>
        <div class="col-md-2">Total Chargeout  </div>
    </div>

        <?php $overall_budget_hour = 0; ?>
        <?php $overall_working_hour = 0; ?>
        <?php $overall_rate = 0; ?>
        <?php $job_count = 0; ?>
    @foreach($staffs as $staff)
        <div class="row underline">
            <div class="col-md-1">{{ $loop->iteration }}</div>
            <div class="col-md-4"><a href="/staff/{{ $staff->id }}">{{ $staff->name }}</a></div>
            <?php $job_count += $job_rates->whereIn('salary_id', $staff->salaries->pluck('id'))->unique('job_id')->count() ?>
            <div class="col-md-1">{{ $job_rates->whereIn('salary_id', $staff->salaries->pluck('id'))->unique('job_id')->count() }}</div>
            <div class="col-md-2">
                <?php $total_budget_hour = 0; ?>
                <?php $total_working_hour = 0; ?>
                <?php $total_rate = 0; ?>
                @foreach($job_rates->whereIn('salary_id', $staff->salaries->pluck('id'))->unique('job_id') as $job_rate)
                    <?php $total_budget_hour += $job_rate->job->hour; ?>
                    <?php $total_working_hour += $job_rate->hour; ?>
                    <?php $total_rate += $job_rate->rates->salary * $job_rate->hour; ?>
                @endforeach
                {{  $total_budget_hour  }}


                <?php $overall_budget_hour += $total_budget_hour; ?>
                <?php $overall_working_hour += $total_working_hour; ?>
                <?php $overall_rate += $total_rate; ?>
            </div>
            <div class="col-md-2">{{ $total_working_hour }}</div>
            <div class="col-md-2">{{ $total_rate }}</div>
        </div>
    @endforeach
        <div class="row underline section_title">
            <div class="col-md-5">Total:</div>
            <div class="col-md-1">{{ $job_count }}</div>
            <div class="col-md-2">{{ $overall_budget_hour }}</div>
            <div class="col-md-2">{{ $overall_working_hour }}</div>
            <div class="col-md-2">{{ $overall_rate }}</div>
        </div>
@stop
