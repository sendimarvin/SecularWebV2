
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
                @if(isset($question))
                    {{ Form::open(array('method'=>'PUT','route' => ['/question/update_question', $question->id])) }}
                @else
                    <form action="/question/save_question"  method="POST">
                @endif

                  {{ csrf_field() }}
                    <div class="mb-3">
                      <label for="category" class="form-label">Category</label>
                      <select class="form-control" id="category" name="category" >
                        @foreach ($categories as $category)
                        <option  value="{{ $category->id }}" {{ isset($question) && $category->id == $question->loan_questions_category_id ? 'selected' : ''}} >{{ $category->category }}</option>                            
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="question" class="form-label">Question</label>
                      <input type="text" class="form-control" id="question" name="question" value="{{ $question->question ?? '' }}">
                    </div>
                    <div class="mb-3">
                      <label for="question_type" class="form-label">Type</label>
                      <select class="form-control" id="question_type" name="question_type" value="{{ $question->question_type ?? '' }}">
                        @foreach ($question_types as $question_type)
                        <option value="{{ $question_type->type_key }}"  {{ isset($question) && $question_type->type_key == $question->question_type ? 'selected' : ''}}>{{ $question_type->type_value }}</option>                            
                        @endforeach
                      </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/question/questions" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection