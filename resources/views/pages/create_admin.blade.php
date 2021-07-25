

{{-- {{ dd($admin->id) }} --}}

@extends('layouts/app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Create Administrator</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Admins</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                New Admin
            </div>
            <div class="card-body">
                {{-- <form action="/admins/{{ $admin ? 'update' : 'save' }}"  method="POST"> --}}
                
                @if(isset($admin))
                    {{ Form::open(array('method'=>'PUT','route' => ['/admins/update', $admin->id])) }}
                    {{-- <form action="/admins/update/{{ $admin->id }}"  method="PUT"> --}}
                @else
                    {{-- {{ Form::open(['method' => 'POST', 'action' => ['/admins/save', $admin->id]]) }} --}}
                    <form action="/admins/save"  method="POST">
                @endif

                  {{ csrf_field() }}
                    <div class="mb-3">
                      <label for="exampleInputusername" class="form-label">Username</label>
                      <input type="text" class="form-control" id="exampleInputusername" name="username" value="{{ $admin->username ?? '' }}">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputfullname" class="form-label">Full Name</label>
                      <input type="text" class="form-control" id="exampleInputfullname" name="fullName" value="{{ $admin->fullName ?? '' }}">
                    </div>
                    <div class="mb-3">
                      <label for="role" class="form-label">Role</label>
                      <select class="form-control" id="role" name="role" >
                        @foreach ($roles as $role)
                        <option value="{{ $role->role_key }}"  {{ isset($admin) && $admin->role == $role->role_key ? 'selected' : ''}}>{{ $role->role_description }}</option>                            
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{ $admin->email ?? '' }}" aria-describedby="emailHelp">
                      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/admins" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection