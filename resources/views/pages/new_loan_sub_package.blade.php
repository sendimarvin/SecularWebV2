
@extends('layouts/app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Create Sub Package</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Subscription Sub Packages</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Sub Package
            </div>
            <div class="card-body">
                @if(isset($sub_package))
                    {{ Form::open(array('method'=>'PUT','route' => ['/loans/update_sub_package', $sub_package->id])) }}
                @else
                    <form action="/loans/save_sub_package"  method="POST">
                @endif

                  {{ csrf_field() }}
                    <div class="mb-3">
                      <label for="name" class="form-label">Sub Loan</label>
                      <input type="text" class="form-control" id="sub_loan" name="sub_loan" value="{{ $sub_package->sub_loan ?? '' }}">
                    </div>
                    <div class="mb-3">
                      <label for="loan_package_id" class="form-label">Loan</label>
                      <select class="form-control" id="loan_package_id" name="loan_package_id">
                        @foreach ($loan_packages as $loans)
                        <option value="{{ $loans->id }}"  {{ isset($sub_package) && $sub_package->loan_package_id == $loans->id ? 'selected' : ''}}>{{ $loans->loan }}</option>                            
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="interest" class="form-label">Interest</label>
                      <input type="text" class="form-control" id="interest" name="interest" value="{{ $sub_package->interest ?? '' }}">
                    </div>
                    <div class="mb-3">
                      <label for="max_amount" class="form-label">Max. Amount</label>
                      <input type="text" class="form-control" id="max_amount" name="max_amount" value="{{ $sub_package->max_amount ?? '' }}">
                    </div>
                    <div class="mb-3">
                      <label for="max_period" class="form-label">Max Period</label>
                      <input type="text" class="form-control" id="max_period" name="max_period" value="{{ $sub_package->max_period ?? '' }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/loans/sub_packages" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection