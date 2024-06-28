@extends('admin.layout')
@section('title')
Edit
@endsection
@section('content')


<div class="card-body">
    <form action="{{ route('users.update', $users->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="form-group col-md-6">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $users->name) }}" placeholder="Name">
                <p class="text-danger">{{ $errors->first('name') }}</p>
            </div>

            <div class="form-group col-md-6">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $users->email) }}" placeholder="Email">
                <p class="text-danger">{{ $errors->first('email') }}</p>
            </div>

            <div class="form-group col-md-6">
                <label for="date_of_birth">Date Birth:</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $users->date_of_birth) }}" placeholder="Date of birth">
                <p class="text-danger">{{ $errors->first('date_of_birth') }}</p>
            </div>

            <div class="form-group col-md-6">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $users->phone) }}" placeholder="Phone">
                <p class="text-danger">{{ $errors->first('phone') }}</p>
            </div>

            <div class="form-group col-md-6">
                <label for="avatar">Profile:</label>
                <input type="file" class="form-control" id="avatar" name="avatar" onchange="previewAvatar(event)">
                @if ($users->avatar)
                <img id="avatar-preview" src="{{ asset('avatar/' . $users->avatar) }}" alt="Avatar" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                @else
                <img id="avatar-preview" src="#" alt="Image Preview" style="display:none; max-width: 100px; margin-top: 10px;">
                @endif
            </div>
            <div class="form-group mb-4">
                <label for="courses" class="fw-bold">List Courses:</label>
                <select class="form-select" name="courses[]" id="multiple-select-custom-field" data-placeholder="Choose anything" multiple>
                    @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ in_array($course->id, old('courses', $selectedCourses)) ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button class="btn btn-outline-primary" type="submit">Update user</button>
    </form>
</div>
@endsection