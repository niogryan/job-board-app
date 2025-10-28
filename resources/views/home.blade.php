@extends('layouts.app')

@section('content')
    <div class="job-list">
        <h2>Available Jobs</h2>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (!empty($jobs) || !empty($api_jobs))
            @foreach ($jobs as $job)
                <div class="job-list-item mb-3">
                    <h5 class="mb-1">{{ $job->title }}</h5>
                    <small class="text-muted">{{ $job->location }}</small><br />
                    <small class="text-muted">source: <b>JobBoard</b></small>
                    <p class="mt-2 mb-1">{{ substr($job->description, 0, 300) }} . . .</p>
                    <a href="{{ route('viewfulldetails', ['src' => 'jobboard', 'id' => $job->id]) }}"
                        class="btn btn-sm btn-primary mt-2" target="_Blank">View full
                        details </a>
                </div>
            @endforeach

            @foreach ($api_jobs as $job)
                <div class="job-list-item mb-3">
                    <h5 class="mb-1">{{ $job['name'] }}</h5>
                    <small class="text-muted">{{ $job['office'] }}</small><br />
                    <small class="text-muted">source: <b>Personio</b> </small>
                    <p class="mt-2 mb-1">
                        {{ substr(strip_tags($job['jobDescriptions']['jobDescription'][0]['value']), 0, 300) }} . . .
                    </p>
                    <a href="{{ route('viewfulldetails', ['src' => 'personio', 'id' => $job['id']]) }}"
                        class="btn btn-sm btn-primary mt-2" target="_Blank">View full details </a>
                </div>
            @endforeach
        @else
            <div class="alert alert-info text-center">
                No job post available at the moment.
            </div>
        @endif
    </div>
@endsection
