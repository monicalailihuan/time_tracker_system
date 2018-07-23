@extends('layouts.app')

@section('content')
<div class="container">
       <div class="row underline">
            <div class="col-md-2">
                <h4 for="">No.</h4>
            </div>
            <div class="col-md-4">
                <h4 for="">Engagement - Job Title</h4>
            </div>

            <div class="col-md-2">
                <h4 for="">Stage</h4>
            </div>

            <div class="col-md-2">
                <h4 for="">Created At</h4>
            </div>
        </div>
    @foreach($jobs as $job)
        <div class="row underline">
            <div class="col-md-2">
                {{ $loop->iteration }}
            </div>
            <div class="col-md-4">
                <a href="/job/{{ $job->id }}">{{ $job->engagement->name.' - '.$job->title }}</a>
            </div>

            <div class="col-md-2">
                {{ $job->stage->name }}
            </div>

            <div class="col-md-2">
                {{ date('d M Y', strtotime($job->created_at)) }}
            </div>
        </div>
    @endforeach
</div>
@endsection
