@extends('layouts.template')

@section('content')
<div class="container-fluid">

    <div class="hero">
        <div>
            <h1>Day Details</h1>
            <p class="hero-sub">View day information</p>
        </div>
        <a href="{{ route('days.index') }}" class="btn ghost"><i class="fas fa-arrow-left mr-1"></i> Back</a>
    </div>

    <div class="card">
        <div class="card-body p-4">

            <div class="mb-4">
                <h4 class="font-weight-bold mb-1">{{ $day->day_name }}</h4>
                <p class="text-muted mb-0">Scheduled day</p>
            </div>

            <hr>

            <h6 class="text-muted mb-3">Day information</h6>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <small class="text-muted d-block mb-1">Day Name</small>
                    <span>{{ $day->day_name }}</span>
                </div>
            </div>

        </div>

        <div class="card-footer border-top-0 text-right">
            <a href="{{ route('days.index') }}" class="btn btn-primary">All Days</a>
        </div>
    </div>

</div>
@endsection
