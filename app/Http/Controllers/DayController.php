<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Timetable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DayController extends Controller
{
    public function index(): View
    {
        $days = Day::all();

        return view('days.index', compact('days'));
    }

    public function create(): View
    {
        return view('days.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'day_name' => ['required', 'string', 'max:255'],
        ]);

        Day::create($request->all());

        return redirect()->route('days.index')
            ->with('success', 'Day created successfully.');
    }

    public function show(Day $day): View
    {
        return view('days.show', compact('day'));
    }

    public function edit(Day $day): View
    {
        return view('days.edit', compact('day'));
    }

    public function update(Request $request, Day $day): RedirectResponse
    {
        $request->validate([
            'day_name' => ['required', 'string', 'max:255'],
        ]);

        $day->update($request->all());

        return redirect()->route('days.index')
            ->with('success', 'Day updated successfully.');
    }

    public function destroy(Day $day): RedirectResponse
    {
        Timetable::where('day_id', $day->id)->delete();

        $day->delete();

        return redirect()->route('days.index')
            ->with('success', 'Day deleted successfully.');
    }
}
