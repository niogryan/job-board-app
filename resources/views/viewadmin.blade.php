@extends('layouts.app')

@section('content')
    <div class="job-list">
        <h2>Jobs Posts for Approval</h2>


        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($pending->count() > 0)
            <div class="list-group">
                @foreach ($pending as $pen)
                    <div class="list-group-item mb-3">
                        <h2 class="mb-1">{{ $pen->title }}</h2>
                        <small class="text-muted">{{ $pen->location }}</small>
                        <p class="mt-2 mb-1">{{ $pen->description }}</p>
                        <small>Submitted By: <b>{{ $pen->email }}</b></small><br />
                        <small>{{ $pen->created_at }}</small>
                        <div class="block mt-3">
                            <a href="{{ route('approvepost', ['id' => $pen->id]) }}" class="btn btn-primary">Approve</a>
                            <a href="{{ route('spampost', ['id' => $pen->id]) }}" class="btn btn-warning">Mark as spam</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">
                No pending job post
            </div>
        @endif
    </div>
@endsection
