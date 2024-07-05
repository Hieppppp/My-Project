@extends('admin.layout')
@section('title')
Add User
@endsection
@section('content')

<div class="card-body">
    <div style="font: size 14px;">
        <a href="{{ route('users.index') }}" class="text-dark text-decoration-none"><i class="bi bi-house-door-fill"></i> Home</a>
        <span class="text-dark"> > </span>
        <a href="" class="text-dark text-decoration-none">Create New User</a>
    </div>
    <h2>Create New User</h2>
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8 border p-3">
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="name" class="fw-bold">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Name">
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="email" class="fw-bold">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email">
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="password" class="fw-bold">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Password">
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="date_of_birth" class="fw-bold">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="Date of birth">
                        <p class="text-danger">{{ $errors->first('date_of_birth') }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="phone" class="fw-bold">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Phone number">
                        <p class="text-danger">{{ $errors->first('phone') }}</p>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="avatar" class="fw-bold">Avatar</label>
                        <input type="file" class="form-control" id="avatar" name="avatar" placeholder="Image" onchange="previewAvatar(event)">
                        <p class="text-danger">{{ $errors->first('avatar') }}</p>
                        <img id="avatar-preview" src="#" alt="Image Preview" style="display:none; max-width: 100px; margin-top: 10px;">
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="" class="fw-bold mb-1">List Courses:</label>
                    <select class="form-select" id="multiple-select-custom-field" data-placeholder="Choose anything" name="courses[]" multiple>
                        @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4 border">
                <div class="form-group">
                    <label for="" class="fw-bold">Role Type</label>
                    <div class="p-2">
                        @foreach ($roles as $role)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}">
                            <label class="form-check-label" for="check{{ $role->id }}">{{ $role->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-danger m-3" style="width:100px">Cancel</button>
        <button type="submit" class="btn btn-primary" style="width:100px">Save</button>
    </form>
</div>

@endsection