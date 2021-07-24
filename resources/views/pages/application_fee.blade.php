
@extends('layouts/app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Application Fee</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Application Fee</a></li>
            <li class="breadcrumb-item active">Update</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Application Fee
            </div>
            <div class="card-body">
                {{ Form::open(array('method'=>'PUT','route' => ['/update_application_fee', $settings->id])) }}
                  {{ csrf_field() }}
                    <div class="mb-3">
                      <label for="application_fee" class="form-label">Application Fee</label>
                      <input type="text" class="form-control" id="application_fee" name="application_fee" value="{{ $settings->application_fee ?? '' }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/question/categories" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection