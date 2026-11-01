@extends('layouts.template')

@section('content')
<div class="hero">
    <div>
        <h1>Days</h1>
        <p class="hero-sub">Manage days</p>
    </div>
    <a href="{{ route('days.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-1"></i> Add New Day</a>
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
                        <th>Day Name</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($days as $day)
                        <tr>
                            <td>{{ $day->id }}</td>
                            <td>{{ $day->day_name }}</td>
                            <td class="text-right" style="white-space: nowrap;">
                                <form action="{{ route('days.destroy', $day->id) }}" method="POST" class="d-inline">
                                    <a class="btn btn-sm btn-info" href="{{ route('days.show', $day->id) }}"><i class="fas fa-eye mr-1"></i>Show</a>
                                    <a class="btn btn-sm btn-primary" href="{{ route('days.edit', $day->id) }}"><i class="fas fa-pen mr-1"></i>Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this day?');"><i class="fas fa-trash mr-1"></i>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="empty-state">No days yet. <a href="{{ route('days.create') }}">Add your first day</a>.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
