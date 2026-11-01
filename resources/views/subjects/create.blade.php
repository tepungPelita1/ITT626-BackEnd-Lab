@extends('layouts.template')

@section('content')
    <div class="hero">
    <div>
        <h1>Add New Subject</h1>
    </div>
    <a href="{{ route('subjects.index') }}" class="btn ghost">Back</a>
</div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subjects.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Subject Code:</strong>
                    <input type="text" name="subject_code" class="form-control" placeholder="Subject Code" value="{{ old('subject_code') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Subject Name:</strong>
                    <input type="text" name="subject_name" class="form-control" placeholder="Subject Name" value="{{ old('subject_name') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Lecturer Name:</strong>
                    <input type="text" name="lecturer_name" class="form-control" placeholder="Lecturer Name" value="{{ old('lecturer_name') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
