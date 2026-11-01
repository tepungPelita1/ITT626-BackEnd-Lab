@extends('layouts.template')

@section('content')
<div class="container-fluid">

    <div class="hero">
        <div>
            <h1>Group Details</h1>
            <p class="hero-sub">View group information</p>
        </div>
        <a href="{{ route('groups.index') }}" class="btn ghost"><i class="fas fa-arrow-left mr-1"></i> Back</a>
    </div>

    <div class="card">
        <div class="card-body p-4">

            <div class="mb-4">
                <h4 class="font-weight-bold mb-1">{{ $group->name }}</h4>
                <p class="text-muted mb-0">Part {{ $group->part }}</p>
            </div>

            <hr>

            <h6 class="text-muted mb-3">Group information</h6>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <small class="text-muted d-block mb-1">Name</small>
                    <span>{{ $group->name }}</span>
                </div>
                <div class="col-md-6 mb-4">
                    <small class="text-muted d-block mb-1">Part</small>
                    <span>{{ $group->part }}</span>
                </div>
            </div>

        </div>

        <div class="card-footer border-top-0 text-right">
            <a href="{{ route('groups.index') }}" class="btn btn-primary">All Groups</a>
        </div>
    </div>

</div>
@endsection
