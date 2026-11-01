@extends('layouts.template')

@section('content')
<div class="container-fluid">

    <div class="hero">
        <div>
            <h1>Timetable Details</h1>
            <p class="hero-sub">View timetable slot information</p>
        </div>
        <a href="{{ route('timetables.index') }}" class="btn ghost"><i class="fas fa-arrow-left mr-1"></i> Back</a>
    </div>

    <div class="card">
        <div class="card-body p-4">

            <div class="mb-4">
                <h4 class="font-weight-bold mb-1">{{ $timetable->subject?->subject_name }}</h4>
                <p class="text-muted mb-0">{{ $timetable->day?->day_name }} · {{ $timetable->time_from }} – {{ $timetable->time_to }}</p>
            </div>

            <hr>

            <h6 class="text-muted mb-3">Session information</h6>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <small class="text-muted d-block mb-1">Subject</small>
                    <span>{{ $timetable->subject?->subject_name }}</span>
                </div>
                <div class="col-md-6 mb-4">
                    <small class="text-muted d-block mb-1">Day</small>
                    <span>{{ $timetable->day?->day_name }}</span>
                </div>
                <div class="col-md-6 mb-4">
                    <small class="text-muted d-block mb-1">Hall</small>
                    <span>{{ $timetable->hall?->lecture_hall_name }}</span>
                </div>
                <div class="col-md-6 mb-4">
                    <small class="text-muted d-block mb-1">Group</small>
                    <span>{{ $timetable->group?->name }}</span>
                </div>
                <div class="col-md-6 mb-4">
                    <small class="text-muted d-block mb-1">Student</small>
                    <span>{{ $timetable->user?->name }}</span>
                </div>
                <div class="col-md-6 mb-4">
                    <small class="text-muted d-block mb-1">Time From</small>
                    <span>{{ $timetable->time_from }}</span>
                </div>
                <div class="col-md-6 mb-4">
                    <small class="text-muted d-block mb-1">Time To</small>
                    <span>{{ $timetable->time_to }}</span>
                </div>
            </div>

        </div>

        <div class="card-footer border-top-0 text-right">
            <a href="{{ route('timetables.index') }}" class="btn btn-primary">All Timetables</a>
        </div>
    </div>

</div>
@endsection
