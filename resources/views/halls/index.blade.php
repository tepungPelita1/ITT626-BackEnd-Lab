@extends('layouts.template')

@section('content')
<div class="hero">
    <div>
        <h1>Halls</h1>
        <p class="hero-sub">Manage lecture halls</p>
    </div>
    <a href="{{ route('halls.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-1"></i> Add New Hall</a>
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
                        <th>Hall Name</th>
                        <th>Place</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($halls as $hall)
                        <tr>
                            <td>{{ $hall->id }}</td>
                            <td>{{ $hall->lecture_hall_name }}</td>
                            <td>{{ $hall->lecture_hall_place }}</td>
                            <td class="text-right" style="white-space: nowrap;">
                                <form action="{{ route('halls.destroy', $hall->id) }}" method="POST" class="d-inline">
                                    <a class="btn btn-sm btn-info" href="{{ route('halls.show', $hall->id) }}"><i class="fas fa-eye mr-1"></i>Show</a>
                                    <a class="btn btn-sm btn-primary" href="{{ route('halls.edit', $hall->id) }}"><i class="fas fa-pen mr-1"></i>Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this hall?');"><i class="fas fa-trash mr-1"></i>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="empty-state">No halls yet. <a href="{{ route('halls.create') }}">Add your first hall</a>.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
