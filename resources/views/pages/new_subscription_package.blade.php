
@extends('layouts/app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Create package</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Subscription Packages</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Package
            </div>
            <div class="card-body">
                @if(isset($subscriptionpackage))
                    {{ Form::open(array('method'=>'PUT','route' => ['/subscription/update_subscription_package', $subscriptionpackage->id])) }}
                @else
                    <form action="/subscription/save_subscription_package"  method="POST">
                @endif

                  {{ csrf_field() }}
                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{ $subscriptionpackage->name ?? '' }}">
                    </div>
                    <div class="mb-3">
                      <label for="period" class="form-label">Period</label>
                      <input type="text" class="form-control" id="period" name="period" value="{{ $subscriptionpackage->period ?? '' }}">
                    </div>
                    <div class="mb-3">
                      <label for="amount" class="form-label">Amount</label>
                      <input type="text" class="form-control" id="amount" name="amount" value="{{ $subscriptionpackage->amount ?? '' }}">
                    </div>
                    <div class="mb-3">
                      <label for="benefits" class="form-label">Benefits</label>
                      <textarea type="text" class="form-control" id="benefits" name="benefits" 
                        style="margin-top: 0px; margin-bottom: 0px; height: 92px;">{{ $subscriptionpackage->benefits ?? '' }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/subscription/subscription_packages" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection