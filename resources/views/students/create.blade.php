
@extends('layouts.template')

@section('content')
<div class="container-fluid student-create">

    <div class="hero">
        <div>
            <h1>Add New Student</h1>
            <p class="hero-sub">Enter the student's information below.</p>
        </div>
        <a href="{{ route('students.index') }}" class="btn ghost"><i class="fas fa-arrow-left mr-1"></i> Back</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please check your input.</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">

            <div class="card">
                <div class="card-body p-4">

                    <h5 class="font-weight-bold mb-1">Student Information</h5>
                    <p class="text-muted mb-4">Personal and account details</p>

                    <form action="{{ route('students.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="name">Full Name</label>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter full name"
                                value="{{ old('name') }}"
                                required
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="email">Email Address</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Enter email address"
                                value="{{ old('email') }}"
                                required
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="age">
                                Age <span class="text-muted font-weight-normal">(Optional)</span>
                            </label>
                            <input
                                id="age"
                                type="number"
                                name="age"
                                class="form-control @error('age') is-invalid @enderror"
                                placeholder="Enter age"
                                value="{{ old('age') }}"
                                min="1"
                            >
                            @error('age')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="address">Address</label>
                            <textarea
                                id="address"
                                name="address"
                                class="form-control @error('address') is-invalid @enderror"
                                placeholder="Enter address"
                                rows="3"
                            >{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Enter password"
                                required
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('students.index') }}"
                               class="btn btn-light border mr-2">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus mr-1"></i> Create Student
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
