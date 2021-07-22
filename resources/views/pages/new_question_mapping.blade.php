
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
                @if(isset($mapping))
                    {{ Form::open(array('method'=>'PUT','route' => ['/question/update_question_mapping', $mapping->id])) }}
                @else
                    <form action="/question/save_question_mapping"  method="POST">
                @endif

                  {{ csrf_field() }}
                    <div class="mb-3">
                      <label for="category" class="form-label">Category</label>
                      <select class="form-control" id="category" name="category" >
                        @foreach ($categories as $category)
                        <option  value="{{ $category->id }}" {{ isset($mapping) && $category->id == $mapping->loan_questions_category_id ? 'selected' : ''}} >{{ $category->category }}</option>                            
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="subpackage" class="form-label">Subpackage</label>
                      <select class="form-control" id="subpackage" name="subpackage" value="{{ $mapping->subpackage ?? '' }}">
                        @foreach ($sub_packages as $sub_package)
                        <option value="{{ $sub_package->id }}"  {{ isset($mapping) && $mapping->id == $sub_package->id ? 'selected' : ''}}>{{ $sub_package->sub_loan }}</option>                            
                        @endforeach
                      </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/question/question_mappings" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection