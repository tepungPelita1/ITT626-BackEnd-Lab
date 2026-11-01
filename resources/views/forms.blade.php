@extends('layouts.template')

@section('content')
<div class="hero">
    <div>
        <h1>Forms</h1>
        <p class="hero-sub">Input data for your timetable system</p>
    </div>
</div>

<section class="content p-0">
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-header p-0" style="border-bottom:1px solid var(--line);">
                <ul class="nav nav-tabs" role="tablist" style="border-bottom:none;">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab-subject" role="tab">Subject</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-hall" role="tab">Hall</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-group" role="tab">Group</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-day" role="tab">Day</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-timetable" role="tab">Timetable</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">

                    {{-- Subject --}}
                    <div class="tab-pane active" id="tab-subject" role="tabpanel">
                        <form action="#" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Subject Code</label>
                                        <input type="text" name="subject_code" class="form-control" placeholder="e.g. CSC101">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Subject Name</label>
                                        <input type="text" name="subject_name" class="form-control" placeholder="e.g. Programming Fundamentals">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Lecturer Name</label>
                                        <input type="text" name="lecturer_name" class="form-control" placeholder="e.g. Dr. Ahmad">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Subject</button>
                        </form>
                    </div>

                    {{-- Hall --}}
                    <div class="tab-pane" id="tab-hall" role="tabpanel">
                        <form action="#" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Lecture Hall Name</label>
                                        <input type="text" name="lecture_hall_name" class="form-control" placeholder="e.g. Dewan Kuliah 1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Place</label>
                                        <input type="text" name="lecture_hall_place" class="form-control" placeholder="e.g. Blok A">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Hall</button>
                        </form>
                    </div>

                    {{-- Group --}}
                    <div class="tab-pane" id="tab-group" role="tabpanel">
                        <form action="#" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Group Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="e.g. Group A">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Part</label>
                                        <input type="text" name="part" class="form-control" placeholder="e.g. 1">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Group</button>
                        </form>
                    </div>

                    {{-- Day --}}
                    <div class="tab-pane" id="tab-day" role="tabpanel">
                        <form action="#" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Day Name</label>
                                <input type="text" name="day_name" class="form-control" placeholder="e.g. Monday">
                            </div>
                            <button type="submit" class="btn btn-primary">Save Day</button>
                        </form>
                    </div>

                    {{-- Timetable --}}
                    <div class="tab-pane" id="tab-timetable" role="tabpanel">
                        <form action="#" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <select name="subject_id" class="form-control">
                                            <option value="">-- Select Subject --</option>
                                            @foreach (\App\Models\Subject::orderBy('id')->get() as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Day</label>
                                        <select name="day_id" class="form-control">
                                            <option value="">-- Select Day --</option>
                                            @foreach (\App\Models\Day::orderBy('id')->get() as $day)
                                                <option value="{{ $day->id }}">{{ $day->day_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Hall</label>
                                        <select name="hall_id" class="form-control">
                                            <option value="">-- Select Hall --</option>
                                            @foreach (\App\Models\Hall::orderBy('id')->get() as $hall)
                                                <option value="{{ $hall->id }}">{{ $hall->lecture_hall_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Group</label>
                                        <select name="group_id" class="form-control">
                                            <option value="">-- Select Group --</option>
                                            @foreach (\App\Models\Group::orderBy('id')->get() as $group)
                                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Time From</label>
                                        <input type="time" name="time_from" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Time To</label>
                                        <input type="time" name="time_to" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Timetable</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
