@extends('layouts.template')

@section('content')
<div class="hero">
    <div>
        <h1>Subjects</h1>
        <p class="hero-sub">Manage subjects and lecturers</p>
    </div>
    <a href="{{ route('subjects.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-1"></i> Add New Subject</a>
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
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Lecturer Name</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subjects as $subject)
                        <tr>
                            <td>{{ $subject->id }}</td>
                            <td>{{ $subject->subject_code }}</td>
                            <td>{{ $subject->subject_name }}</td>
                            <td>{{ $subject->lecturer_name }}</td>
                            <td class="text-right" style="white-space: nowrap;">
                                <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="d-inline">
                                    <a class="btn btn-sm btn-info" href="{{ route('subjects.show', $subject->id) }}"><i class="fas fa-eye mr-1"></i>Show</a>
                                    <a class="btn btn-sm btn-primary" href="{{ route('subjects.edit', $subject->id) }}"><i class="fas fa-pen mr-1"></i>Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this subject?');"><i class="fas fa-trash mr-1"></i>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">No subjects yet. <a href="{{ route('subjects.create') }}">Add your first subject</a>.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
