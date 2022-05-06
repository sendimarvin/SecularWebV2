
@extends('layouts/app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Create Notification</h1>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Package
            </div>
            <div class="card-body">
                    <form action="{{url("notifications/send")}}"  method="POST">

                    @csrf

                        @if($info_title != null)
                            <div class="card p-3 text-white mb-3 bg-primary">
                                <span class="h4">{{$info_title}}</span>
                                <span class="h6">{{$info_message}}</span>
                            </div>
                        @endif

                    <div class="mb-3">
                      <label for="loan" class="form-label">Applicant / User</label>
                        <select name="applicant_id" class="form-control" id="applicant_id">
                            @foreach($applicants as $applicant)
                                <option value="{{ $applicant->id }}">{{ $applicant->id }} || {{ $applicant->phoneNumber }} || {{ $applicant->firstName }} {{ $applicant->lastName }}  ({{ $applicant->playerId == null ? "Ineligible" : "Eligible" }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                      <label for="loan" class="form-label">Notification Title</label>
                      <input type="text" class="form-control" id="loan" name="notification_title">
                    </div>

                    <div class="mb-3">
                      <label for="loan" class="form-label">Notification Message</label>
                      <textarea type="text" class="form-control" id="loan" name="notification_message"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/loans/packages" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
