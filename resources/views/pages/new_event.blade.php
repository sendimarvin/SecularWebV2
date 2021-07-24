
@extends('layouts/app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Create Event</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Loan Event</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Events
            </div>
            <div class="card-body">
                @if(isset($event))
                    {{ Form::open(array('method'=>'PUT','route' => ['/events/update_event', $event->id])) }}
                @else
                    <form action="/events/save_event"  method="POST">
                @endif

                  {{ csrf_field() }}
                    <div class="mb-3">
                      <label for="title" class="form-label">Title</label>
                      <input type="text" class="form-control" id="title" name="title" value="{{ $event->title ?? '' }}">
                    </div>
                    <div class="mb-3">
                      <label for="start_date" class="form-label">Start Date</label>
                      <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $event->start_date ?? '' }}">
                    </div>
                    <div class="mb-3">
                      <label for="start_time" class="form-label">Start Time</label>
                      <input type="time" class="form-control" id="start_time" name="start_time" value="{{ $event->start_time ?? '' }}">
                    </div>
                    <div class="mb-3">
                      <label for="end_date" class="form-label">End Date</label>
                      <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $event->end_date ?? '' }}">
                    </div>
                    <div class="mb-3">
                      <label for="end_time" class="form-label">End Time</label>
                      <input type="time" class="form-control" id="end_time" name="end_time" value="{{ $event->end_time ?? '' }}">
                    </div>
                    <div class="mb-3">
                      <label for="location" class="form-label">Location</label>
                      <input type="text" class="form-control" id="location" name="location" value="{{ $event->location ?? '' }}">
                    </div>
                    <div class="mb-3">
                      <label for="attendance_fee" class="form-label">Fee</label>
                      <input type="number" class="form-control" id="attendance_fee" name="attendance_fee" value="{{ $event->attendance_fee ?? '' }}">
                    </div>
                    <div class="mb-3">
                      <label for="picture" class="form-label">Picture</label>
                      <input type="file" class="form-control" id="picture" name="picture" value="{{ $event->picture ?? '' }}">
                    </div>
                    <div class="mb-3">
                      <label for="about" class="form-label">About</label>
                      <textarea type="text" class="form-control" id="about" name="about"
                        style="margin-top: 0px; margin-bottom: 0px; height: 99px;">{{ $event->about ?? '' }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/events" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection