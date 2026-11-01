
@extends('layouts.template')

@section('content')
<div class="container-fluid student-edit">

    <div class="hero">
        <div>
            <h1>Edit Student</h1>
            <p class="hero-sub">Update student information</p>
        </div>
        <a href="{{ route('students.index') }}" class="btn ghost"><i class="fas fa-arrow-left mr-1"></i> Back</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">

            <div class="card">
                <div class="card-body p-4">

                    <div class="mb-4">
                        <h5 class="font-weight-bold mb-1">
                            Student Information
                        </h5>
                        <p class="text-muted mb-0">
                            Make changes to the fields below.
                        </p>
                    </div>

                    <hr class="mb-4">

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Please check your input.</strong>
                            <ul class="mb-0 mt-2 pl-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('students.update', $student->id) }}"
                          method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="form-group mb-4">
                            <label for="name">Full Name</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter student name"
                                value="{{ old('name', $student->name) }}"
                                required
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="form-group mb-4">
                            <label for="email">Email Address</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Enter email address"
                                value="{{ old('email', $student->email) }}"
                                required
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Age --}}
                        <div class="form-group mb-4">
                            <label for="age">Age <span class="text-muted font-weight-normal">(Optional)</span></label>
                            <input
                                type="number"
                                id="age"
                                name="age"
                                class="form-control @error('age') is-invalid @enderror"
                                placeholder="Enter age"
                                value="{{ old('age', $student->age) }}"
                                min="1"
                            >
                            @error('age')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Address --}}

{{-- Address --}}
<div class="form-group mb-4">
    <label for="address">Address</label>
    <textarea
        id="address"
        name="address"
        class="form-control @error('address') is-invalid @enderror"
        placeholder="Enter address"
        rows="3"
    >{{ old('address', $student->address) }}</textarea>

    @error('address')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                        
                        {{-- Password --}}
                        <div class="form-group mb-4">
                            <label for="password">
                                Password
                                <span class="text-muted font-weight-normal">(Optional)</span>
                            </label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Leave blank to keep current password"
                            >
                            <small class="form-text text-muted">
                                Only enter a password if you want to change it.
                            </small>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="mt-4 mb-4">

                        {{-- Actions --}}
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('students.index') }}"
                               class="btn btn-light border mr-2">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i>
                                Save Changes
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
