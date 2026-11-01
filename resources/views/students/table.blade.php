
<div class="student-list">

    <div class="hero">
        <div>
            <h1>Students</h1>
            <p class="hero-sub">Manage your student records</p>
        </div>
        <a href="{{ route('students.create') }}" class="btn"><i class="fas fa-plus mr-1"></i> Add Student</a>
    </div>

    {{-- Success Message --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success py-2 mb-3">
            {{ $message }}
        </div>
    @endif

    {{-- Student Table --}}
    <div class="card student-card">
        <div class="table-responsive">
            <table class="table mb-0">

                <thead>
                    <tr>
                        <th class="pl-4">No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined</th>
                        <th class="text-right pr-4">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($students as $s)
                        <tr>
                            <td class="pl-4 text-muted">
                                {{ $loop->iteration }}
                            </td>

                            <td class="student-name">
                                {{ $s->name }}
                            </td>

                            <td class="student-email">
                                {{ $s->email }}
                            </td>

                            <td class="text-muted">
                                {{ $s->created_at?->format('d M Y') ?? '—' }}
                            </td>

                            <td class="text-right pr-4">
                                <div class="student-actions">

                                    <a href="{{ route('students.show', $s->id) }}"
                                       class="action-link"
                                       title="View student">
                                        View
                                    </a>

                                    <a href="{{ route('students.edit', $s->id) }}"
                                       class="action-link"
                                       title="Edit student">
                                        Edit
                                    </a>

                                    <form action="{{ route('students.destroy', $s->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this student?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="action-link action-delete">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <p class="text-muted mb-2">
                                    No student records yet.
                                </p>
                                <a href="{{ route('students.create') }}"
                                   class="text-dark font-weight-bold">
                                    Add your first student
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        @if (method_exists($students, 'hasPages') && $students->hasPages())
            <div class="student-pagination">
                {{ $students->links() }}
            </div>
        @endif
    </div>

</div>

