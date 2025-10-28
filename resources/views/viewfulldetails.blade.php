@extends('layouts.app')


@section('content')
    <div class="job-list">
        <div class="d-flex justify-content-end">
            <a href="{{ route('home') }}" class="btn btn-sm btn-primary">Back</a>
        </div>
        @if ($src == 'personio')
            <h2>{{ $details['name'] }}</h2>

            <h3 class="mt-2 mb-2">Job details</h3>
            <div class="data-group">
                <label>Location:</label>
                <span>{{ $details['office'] }}</span>
            </div>
            <div class="data-group">
                <label>Employment Type:</label>
                <span>{{ $details['employmentType'] ?? ($details['employmentType'] ?? 'N/A') }}</span>
            </div>
            <div class="data-group">
                <label>Years of Experience:</label>
                <span>{{ $details['yearsOfExperience'] ?? ($details['yearsOfExperience'] ?? 'N/A') }}</span>
            </div>
            <div class="data-group">
                <label>Schedule:</label>
                <span>{{ $details['schedule'] ?? ($details['schedule'] ?? 'N/A') }}</span>
            </div>

            <br />
            <b class="mt-2">Description</b>
            <div class="data-group mt-2">
                <span>

                    @foreach ($details['jobDescriptions']['jobDescription'] as $jd)
                        <b> {!! $jd['name'] !!} </b>
                        <p>
                            {!! $jd['value'] !!}

                        </p>
                    @endforeach
                </span>
            </div>
        @else
            <h2>{{ $details['title'] }}</h2>

            <h3 class="mt-2 mb-2">Job details</h3>
            <div class="data-group">
                <label>Location:</label>
                <span>{{ $details['location'] }}</span>
            </div>

            <br />
            <b class="mt-2">Description</b>
            <div class="data-group mt-2">
                <span>
                    {{ $details['description'] }}
                </span>
            </div>
        @endif
    </div>
@endsection
