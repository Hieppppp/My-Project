@extends('admin.layout')
@section('title')
Edit User
@endsection
@section('content')
<div class="card-body">
    <form action="{{ route('users.update', $users->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8 border p-3">
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
                </div>

                <div class="row">
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
            <div class="col-md-4 border p-3">
                <div class="form-group mb-3">
                    <label for="role" class="fw-bold">Role Type</label>
                    <div class="p-2">
                        @foreach ($roles as $role)
                        <div class="form-check">
                            @if (auth()->user()->isAdmin())
                                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" {{ in_array($role->id, old('roles', $selectedRoles)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="check{{ $role->id }}">{{ $role->name }}</label>
                            @else
                                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" {{ in_array($role->id, old('roles', $selectedRoles)) ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="check{{ $role->id }}">{{ $role->name }}</label>
                                @endif
                        </div>
                        @endforeach
                    </div>
                    <p class="text-danger">{{ $errors->first('roles') }}</p>
                </div>
            </div>

        </div>
        <button type="button" class="btn btn-danger m-3" style="width:100px;">Cancel</button>
        <button type="submit" class="btn btn-primary" style="width:100px;">Update</button>
    </form>
</div>
@endsection