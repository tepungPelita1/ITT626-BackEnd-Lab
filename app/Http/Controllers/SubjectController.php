<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Timetable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(): View
    {
        $subjects = Subject::all();

        return view('subjects.index', compact('subjects'));
    }

    public function create(): View
    {
        return view('subjects.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'subject_code' => ['required', 'string', 'max:255'],
            'subject_name' => ['required', 'string', 'max:255'],
            'lecturer_name' => ['required', 'string', 'max:255'],
        ]);

        Subject::create($request->all());

        return redirect()->route('subjects.index')
            ->with('success', 'Subject created successfully.');
    }

    public function show(Subject $subject): View
    {
        return view('subjects.show', compact('subject'));
    }

    public function edit(Subject $subject): View
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject): RedirectResponse
    {
        $request->validate([
            'subject_code' => ['required', 'string', 'max:255'],
            'subject_name' => ['required', 'string', 'max:255'],
            'lecturer_name' => ['required', 'string', 'max:255'],
        ]);

        $subject->update($request->all());

        return redirect()->route('subjects.index')
            ->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject): RedirectResponse
    {
        Timetable::where('subject_id', $subject->id)->delete();

        $subject->delete();

        return redirect()->route('subjects.index')
            ->with('success', 'Subject deleted successfully.');
    }
}
