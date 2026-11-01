<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Timetable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HallController extends Controller
{
    public function index(): View
    {
        $halls = Hall::all();

        return view('halls.index', compact('halls'));
    }

    public function create(): View
    {
        return view('halls.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'lecture_hall_name' => ['required', 'string', 'max:255'],
            'lecture_hall_place' => ['required', 'string', 'max:255'],
        ]);

        Hall::create($request->all());

        return redirect()->route('halls.index')
            ->with('success', 'Hall created successfully.');
    }

    public function show(Hall $hall): View
    {
        return view('halls.show', compact('hall'));
    }

    public function edit(Hall $hall): View
    {
        return view('halls.edit', compact('hall'));
    }

    public function update(Request $request, Hall $hall): RedirectResponse
    {
        $request->validate([
            'lecture_hall_name' => ['required', 'string', 'max:255'],
            'lecture_hall_place' => ['required', 'string', 'max:255'],
        ]);

        $hall->update($request->all());

        return redirect()->route('halls.index')
            ->with('success', 'Hall updated successfully.');
    }

    public function destroy(Hall $hall): RedirectResponse
    {
        Timetable::where('hall_id', $hall->id)->delete();

        $hall->delete();

        return redirect()->route('halls.index')
            ->with('success', 'Hall deleted successfully.');
    }
}
