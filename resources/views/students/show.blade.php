@extends('layouts.template')

@section('content')
<div class="container-fluid">

    <div class="hero">
        <div>
            <h1>Student Details</h1>
            <p class="hero-sub">View student information</p>
        </div>
        <a href="{{ route('students.index') }}" class="btn ghost"><i class="fas fa-arrow-left mr-1"></i> Back</a>
    </div>

    <div class="card">
        <div class="card-body p-4">

            <div class="mb-4">
                <h4 class="font-weight-bold mb-1">{{ $student->name }}</h4>
                <p class="text-muted mb-0">{{ $student->email }}</p>
            </div>

            <hr>

            <h6 class="text-muted mb-3">Personal information</h6>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <small class="text-muted d-block mb-1">Full Name</small>
                    <span>{{ $student->name }}</span>
                </div>
                <div class="col-md-6 mb-4">
                    <small class="text-muted d-block mb-1">Email Address</small>
                    <span>{{ $student->email }}</span>
                </div>
                <div class="col-md-6 mb-4">
                    <small class="text-muted d-block mb-1">Age</small>
                    <span>{{ $student->age ?? 'Not provided' }}</span>
                </div>
                <div class="col-md-6 mb-4">
                    <small class="text-muted d-block mb-1">Address</small>
                    <span>{{ $student->address ?? 'Not provided' }}</span>
                </div>
                <div class="col-md-6 mb-4">
                    <small class="text-muted d-block mb-1">Joined On</small>
                    <span>
                        {{ $student->created_at
                            ? $student->created_at->format('d M Y, h:i A')
                            : 'Not available' }}
                    </span>
                </div>
            </div>

        </div>

        <div class="card-footer border-top-0 text-right">
            <a href="{{ route('students.index') }}" class="btn btn-primary">All Students</a>
        </div>
    </div>

</div>
@endsection
