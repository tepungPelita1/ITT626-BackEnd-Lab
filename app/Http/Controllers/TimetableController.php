<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Group;
use App\Models\Hall;
use App\Models\Subject;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function index(): View
    {
        $timetables = Timetable::with(['subject', 'day', 'hall', 'group', 'user'])->get();

        return view('timetables.index', compact('timetables'));
    }

    public function create(): View
    {
        $subjects = Subject::all();
        $days = Day::all();
        $halls = Hall::all();
        $groups = Group::all();
        $users = User::all();

        return view('timetables.create', compact('subjects', 'days', 'halls', 'groups', 'users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'subject_id' => ['required', 'integer'],
            'day_id' => ['required', 'integer'],
            'hall_id' => ['required', 'integer'],
            'group_id' => ['required', 'integer'],
            'user_id' => ['nullable', 'integer'],
            'time_from' => ['required', 'string', 'max:255'],
            'time_to' => ['required', 'string', 'max:255'],
        ]);

        Timetable::create($request->all());

        return redirect()->route('timetables.index')
            ->with('success', 'Timetable created successfully.');
    }

    public function show(Timetable $timetable): View
    {
        return view('timetables.show', compact('timetable'));
    }

    public function edit(Timetable $timetable): View
    {
        $subjects = Subject::all();
        $days = Day::all();
        $halls = Hall::all();
        $groups = Group::all();
        $users = User::all();

        return view('timetables.edit', compact('timetable', 'subjects', 'days', 'halls', 'groups', 'users'));
    }

    public function update(Request $request, Timetable $timetable): RedirectResponse
    {
        $request->validate([
            'subject_id' => ['required', 'integer'],
            'day_id' => ['required', 'integer'],
            'hall_id' => ['required', 'integer'],
            'group_id' => ['required', 'integer'],
            'user_id' => ['nullable', 'integer'],
            'time_from' => ['required', 'string', 'max:255'],
            'time_to' => ['required', 'string', 'max:255'],
        ]);

        $timetable->update($request->all());

        return redirect()->route('timetables.index')
            ->with('success', 'Timetable updated successfully.');
    }

    public function destroy(Timetable $timetable): RedirectResponse
    {
        $timetable->delete();

        return redirect()->route('timetables.index')
            ->with('success', 'Timetable deleted successfully.');
    }
}
