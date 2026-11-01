@extends('layouts.template')

@section('content')
    <div class="hero">
    <div>
        <h1>Add New Hall</h1>
    </div>
    <a href="{{ route('halls.index') }}" class="btn ghost">Back</a>
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

    <form action="{{ route('halls.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Hall Name:</strong>
                    <input type="text" name="lecture_hall_name" class="form-control" placeholder="Hall Name" value="{{ old('lecture_hall_name') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Place:</strong>
                    <input type="text" name="lecture_hall_place" class="form-control" placeholder="Place" value="{{ old('lecture_hall_place') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
