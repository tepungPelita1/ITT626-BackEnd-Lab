@extends('layouts.template')

@section('content')
    <div class="hero">
    <div>
        <h1>Edit Timetable</h1>
    </div>
    <a href="{{ route('timetables.index') }}" class="btn ghost">Back</a>
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

    <form action="{{ route('timetables.update', $timetable->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Subject:</strong>
                    <select name="subject_id" class="form-control">
                        <option value="">-- Select Subject --</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id', $timetable->subject_id) == $subject->id ? 'selected' : '' }}>{{ $subject->subject_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Day:</strong>
                    <select name="day_id" class="form-control">
                        <option value="">-- Select Day --</option>
                        @foreach ($days as $day)
                            <option value="{{ $day->id }}" {{ old('day_id', $timetable->day_id) == $day->id ? 'selected' : '' }}>{{ $day->day_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Hall:</strong>
                    <select name="hall_id" class="form-control">
                        <option value="">-- Select Hall --</option>
                        @foreach ($halls as $hall)
                            <option value="{{ $hall->id }}" {{ old('hall_id', $timetable->hall_id) == $hall->id ? 'selected' : '' }}>{{ $hall->lecture_hall_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Group:</strong>
                    <select name="group_id" class="form-control">
                        <option value="">-- Select Group --</option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}" {{ old('group_id', $timetable->group_id) == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Student:</strong>
                    <select name="user_id" class="form-control">
                        <option value="">-- Select Student --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $timetable->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <strong>Time From:</strong>
                    <input type="text" name="time_from" class="form-control" placeholder="e.g. 08:00" value="{{ old('time_from', $timetable->time_from) }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <strong>Time To:</strong>
                    <input type="text" name="time_to" class="form-control" placeholder="e.g. 10:00" value="{{ old('time_to', $timetable->time_to) }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
