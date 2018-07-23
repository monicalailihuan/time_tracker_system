
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
            <h3>Revenue Report</h3>
        </div>
    </div>

    <div class="row underline">
        <div class="col-md-1">No. </div>
        <div class="col-md-3">Company</div>
        <div class="col-md-6">Engagement</div>
        <div class="col-md-2">Total</div>
    </div>

    @foreach($companies as $company)
        <div class="row underline">
            <div class="col-md-1">{{ $loop->iteration }}</div>
            <div class="col-md-3"><a href="/company/{{ $company->name }}">{{ $company->name }}</a></div>
            <div class="col-md-6">
                <?php $total_revenue= 0; ?>
                @if($company->engagements->count() > 0)
                    @foreach($company->engagements->sortByDesc('created_at') as $engagement)
                        <div>
                            {{ $loop->iteration }}. <a href="/engagement/{{ $engagement->id }}">{{ $engagement->name }}</a>: 
                            <span data-toggle="tooltip" title="Engagement Revenue">
                                <?php $total_engagement_revenue = 0; ?>
                                @foreach($engagement->jobs as $job)
                                    @foreach($job->staffs as $staff)
                                        <?php $total_engagement_revenue += $staff->salaries->count() > 0 ? $staff->salaries->where('status', 'A')->first()->salary * $staff->pivot->hour : 0 ?>
                                    @endforeach
                                @endforeach    
                                {{ $total_engagement_revenue }}
                                <?php $total_revenue += $total_engagement_revenue; ?>

                            </span> 
                        </div>
                    @endforeach
                @else
                    N/A
                @endif
            </div>
            <div class="col-md-2">
                {{ $total_revenue }}
            </div>

        </div>
    @endforeach
        
@stop
