@extends('layouts.template')

@section('content')
<div class="hero">
    <div>
        <h1>Timetables</h1>
        <p class="hero-sub">Manage timetable slots</p>
    </div>
    <a href="{{ route('timetables.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-1"></i> Add New Timetable</a>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">{{ $message }}</div>
@endif

<div class="panel">
    <div class="panel-body p-0">
        <div class="table-responsive">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Subject</th>
                        <th>Day</th>
                        <th>Hall</th>
                        <th>Group</th>
                        <th>Student</th>
                        <th>Time From</th>
                        <th>Time To</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($timetables as $timetable)
                        <tr>
                            <td>{{ $timetable->id }}</td>
                            <td>{{ $timetable->subject?->subject_name ?? '—' }}</td>
                            <td>{{ $timetable->day?->day_name ?? '—' }}</td>
                            <td>{{ $timetable->hall?->lecture_hall_name ?? '—' }}</td>
                            <td>{{ $timetable->group?->name ?? '—' }}</td>
                            <td>{{ $timetable->user?->name ?? '—' }}</td>
                            <td>{{ $timetable->time_from }}</td>
                            <td>{{ $timetable->time_to }}</td>
                            <td class="text-right" style="white-space: nowrap;">
                                <form action="{{ route('timetables.destroy', $timetable->id) }}" method="POST" class="d-inline">
                                    <a class="btn btn-sm btn-info" href="{{ route('timetables.show', $timetable->id) }}"><i class="fas fa-eye mr-1"></i>Show</a>
                                    <a class="btn btn-sm btn-primary" href="{{ route('timetables.edit', $timetable->id) }}"><i class="fas fa-pen mr-1"></i>Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this timetable slot?');"><i class="fas fa-trash mr-1"></i>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="empty-state">No timetable entries yet. <a href="{{ route('timetables.create') }}">Add your first one</a>.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
