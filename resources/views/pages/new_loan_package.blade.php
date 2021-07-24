
@extends('layouts/app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Create package</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Loan Packages</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Package
            </div>
            <div class="card-body">
                @if(isset($loanpackage))
                    {{ Form::open(array('method'=>'PUT','route' => ['/loans/update_package', $loanpackage->id])) }}
                @else
                    <form action="/loans/save_package"  method="POST">
                @endif

                  {{ csrf_field() }}
                    <div class="mb-3">
                      <label for="loan" class="form-label">Package Name</label>
                      <input type="text" class="form-control" id="loan" name="loan" value="{{ $loanpackage->loan ?? '' }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/loans/packages" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection