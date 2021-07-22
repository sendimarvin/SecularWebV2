
@extends('layouts/app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Terms</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Settings</a></li>
            <li class="breadcrumb-item active">Terms</li>
        </ol>
            {{ Form::open(array('method'=>'PUT','route' => ['/update_terms', $settings->id])) }}
                {{ csrf_field() }}
                <div class="mb-3">
                    <textarea class="form-control" id="terms" placeholder="Enter the terms" name="terms"
                    style="margin-top: 0px; margin-bottom: 0px; height: 315px;">{{ base64_decode($settings->terms) ?? ''}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="/" class="btn btn-default">Cancel</a>
            </form>
    </div>
@endsection


@section('custom_scripts')
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'terms' );
</script>
@endsection