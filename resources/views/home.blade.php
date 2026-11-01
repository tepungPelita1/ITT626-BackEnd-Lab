@extends('layouts.template')

@php
    $hour = now()->hour;
    $greeting = $hour < 12 ? 'Good morning' : ($hour < 18 ? 'Good afternoon' : 'Good evening');

    $totalSubjects = \App\Models\Subject::count();
    $totalHalls    = \App\Models\Hall::count();
    $totalGroups   = \App\Models\Group::count();
    $totalSessions = \App\Models\Timetable::count();

    $subjectNames = \App\Models\Subject::pluck('subject_name', 'id');
    $dayNames     = \App\Models\Day::pluck('day_name', 'id');
    $hallNames    = \App\Models\Hall::pluck('lecture_hall_name', 'id');

    $recent = \App\Models\Timetable::orderByDesc('id')->take(8)->get();
    $next   = $recent->first();

    $daysList        = \App\Models\Day::orderBy('id')->get();
    $timetablesByDay = \App\Models\Timetable::orderBy('day_id')->orderBy('time_from')->get()->groupBy('day_id');
@endphp

@section('content')

<div class="hero">
    <div>
        <h1>{{ $greeting }},<br>{{ auth()->user()->name }}</h1>
        <p class="hero-sub">Overview of your timetable — subjects, halls, groups and days.</p>
    </div>
    <a href="{{ route('timetables.create') }}" class="btn">
        <i class="fas fa-plus"></i> New timetable
    </a>
</div>

<div class="grid">

    {{-- Week overview (hero tile) --}}
    <div class="tile tile-lav tile-week">
        <div class="tile-head">
            <h3 class="tile-title">Weekly overview</h3>
            <span class="tag">This week</span>
        </div>
        <div class="days">
            @foreach ($daysList as $day)
                <div class="day">
                    <div class="day-name">{{ \Illuminate\Support\Str::substr($day->day_name, 0, 3) }}</div>
                    <div class="slots">
                        @forelse ($timetablesByDay->get($day->id, collect()) as $t)
                            <div class="slot">
                                <span class="slot-name">{{ $subjectNames[$t->subject_id] ?? '—' }}</span>
                                <span class="slot-time">{{ $t->time_from }}</span>
                            </div>
                        @empty
                            <div class="slot free"></div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Next class --}}
    <div class="tile tile-pink tile-next">
        <div class="tile-head">
            <h3 class="tile-title">Next class</h3>
        </div>
        @if ($next)
            <div class="tile-next-name">{{ $subjectNames[$next->subject_id] ?? '—' }}</div>
            <p class="tile-sub">{{ $dayNames[$next->day_id] ?? '' }} · {{ $next->time_from }} – {{ $next->time_to }}</p>
            <p class="tile-sub" style="margin-top: 2px;">{{ $hallNames[$next->hall_id] ?? '' }}</p>
        @else
            <p class="tile-sub">No classes scheduled yet.</p>
        @endif
    </div>

    {{-- Halls --}}
    <a href="{{ route('halls.index') }}" class="tile tile-green tile-halls">
        <div class="tile-head">
            <h3 class="tile-title">Halls</h3>
            <span class="arrow"><i class="fas fa-arrow-right"></i></span>
        </div>
        <div class="tile-num">{{ $totalHalls }}</div>
        <p class="tile-sub">Lecture halls</p>
    </a>

    {{-- Groups --}}
    <a href="{{ route('groups.index') }}" class="tile tile-yellow tile-groups">
        <div class="tile-head">
            <h3 class="tile-title">Groups</h3>
            <span class="arrow"><i class="fas fa-arrow-right"></i></span>
        </div>
        <div class="tile-num">{{ $totalGroups }}</div>
        <p class="tile-sub">Student groups</p>
    </a>

    {{-- Subjects --}}
    <a href="{{ route('subjects.index') }}" class="tile tile-orange tile-subjects">
        <div class="tile-head">
            <h3 class="tile-title">Subjects</h3>
            <span class="arrow"><i class="fas fa-arrow-right"></i></span>
        </div>
        <div class="tile-num">{{ $totalSubjects }}</div>
        <div class="chips">
            @foreach (\App\Models\Subject::orderBy('id')->take(4)->get() as $subject)
                <span class="chip">{{ $subject->subject_name }}</span>
            @endforeach
        </div>
    </a>

    {{-- Sessions --}}
    <a href="{{ route('timetables.index') }}" class="tile tile-blue tile-sessions">
        <div class="tile-head">
            <h3 class="tile-title">Timetable slots</h3>
            <span class="arrow"><i class="fas fa-arrow-right"></i></span>
        </div>
        <div class="tile-num">{{ $totalSessions }}</div>
        <p class="tile-sub">Scheduled across the week</p>
    </a>

</div>

{{-- Upcoming schedule --}}
<div class="panel">
    <div class="panel-head">
        <h3>Upcoming schedule</h3>
        <p>Latest timetable entries</p>
    </div>
    <div class="panel-body" style="padding-top: 8px;">
        <table class="tbl">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Day</th>
                    <th>Hall</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recent as $t)
                    <tr>
                        <td>{{ $subjectNames[$t->subject_id] ?? '—' }}</td>
                        <td>{{ $dayNames[$t->day_id] ?? '—' }}</td>
                        <td>{{ $hallNames[$t->hall_id] ?? '—' }}</td>
                        <td><span class="time-badge">{{ $t->time_from }} – {{ $t->time_to }}</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                No timetable entries yet. <a href="{{ route('timetables.create') }}">Add your first one</a>.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
