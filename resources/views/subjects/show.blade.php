@extends('layouts.template')

@section('content')
<div class="container-fluid">

    <div class="hero">
        <div>
            <h1>Subject Details</h1>
            <p class="hero-sub">View subject information</p>
        </div>
        <a href="{{ route('subjects.index') }}" class="btn ghost"><i class="fas fa-arrow-left mr-1"></i> Back</a>
    </div>

    <div class="card">
        <div class="card-body p-4">

            <div class="mb-4">
                <h4 class="font-weight-bold mb-1">{{ $subject->subject_name }}</h4>
                <p class="text-muted mb-0">{{ $subject->subject_code }}</p>
            </div>

            <hr>

            <h6 class="text-muted mb-3">Subject information</h6>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <small class="text-muted d-block mb-1">Subject Code</small>
                    <span>{{ $subject->subject_code }}</span>
                </div>
                <div class="col-md-6 mb-4">
                    <small class="text-muted d-block mb-1">Subject Name</small>
                    <span>{{ $subject->subject_name }}</span>
                </div>
                <div class="col-md-6 mb-4">
                    <small class="text-muted d-block mb-1">Lecturer Name</small>
                    <span>{{ $subject->lecturer_name }}</span>
                </div>
            </div>

        </div>

        <div class="card-footer border-top-0 text-right">
            <a href="{{ route('subjects.index') }}" class="btn btn-primary">All Subjects</a>
        </div>
    </div>

</div>
@endsection
