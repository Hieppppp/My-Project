@extends('admin.layout')
@section('title')
Add User
@endsection
@section('content')
@if(Session::get('sms'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{Session::get('sms')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card-body">
    <!-- <h5 class="text-center">Create User</h5> -->
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Name">
                <p class="text-danger">{{ $errors->first('name') }}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email">
                <p class="text-danger">{{ $errors->first('email') }}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Password">
                <p class="text-danger">{{ $errors->first('password') }}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="Date of birth">
                <p class="text-danger">{{ $errors->first('date_of_birth') }}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Phone number">
                <p class="text-danger">{{ $errors->first('phone') }}</p>
            </div>
            <div class="form-group col-md-6 mb-2">
                <label for="avatar">Avatar</label>
                <input type="file" class="form-control" id="avatar" name="avatar" placeholder="Image" onchange="previewAvatar(event)">
                <p class="text-danger">{{ $errors->first('avatar') }}</p>
                <img id="avatar-preview" src="#" alt="Image Preview" style="display:none; max-width: 100px; margin-top: 10px;">
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
        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
</div>

@endsection