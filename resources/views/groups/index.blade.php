@extends('layouts.template')

@section('content')
<div class="hero">
    <div>
        <h1>Groups</h1>
        <p class="hero-sub">Manage groups</p>
    </div>
    <a href="{{ route('groups.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-1"></i> Add New Group</a>
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
                        <th>Name</th>
                        <th>Part</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($groups as $group)
                        <tr>
                            <td>{{ $group->id }}</td>
                            <td>{{ $group->name }}</td>
                            <td>{{ $group->part }}</td>
                            <td class="text-right" style="white-space: nowrap;">
                                <form action="{{ route('groups.destroy', $group->id) }}" method="POST" class="d-inline">
                                    <a class="btn btn-sm btn-info" href="{{ route('groups.show', $group->id) }}"><i class="fas fa-eye mr-1"></i>Show</a>
                                    <a class="btn btn-sm btn-primary" href="{{ route('groups.edit', $group->id) }}"><i class="fas fa-pen mr-1"></i>Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this group?');"><i class="fas fa-trash mr-1"></i>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="empty-state">No groups yet. <a href="{{ route('groups.create') }}">Add your first group</a>.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
