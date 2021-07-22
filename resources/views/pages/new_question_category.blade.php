

{{-- {{ dd($admin->id) }} --}}

@extends('layouts/app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Create Question</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Admins</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Question
            </div>
            <div class="card-body">
                @if(isset($category))
                    {{ Form::open(array('method'=>'PUT','route' => ['/question/update_category', $category->id])) }}
                @else
                    <form action="/question/save_category"  method="POST">
                @endif

                  {{ csrf_field() }}
                    <div class="mb-3">
                      <label for="exampleInputcategory" class="form-label">Question Category</label>
                      <input type="text" class="form-control" id="exampleInputcategory" name="category" value="{{ $category->category ?? '' }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/question/categories" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection