@extends('admin.layout')
@section('title')
Edit Role
@endsection
@section('content')
<div class="card-body">
    <div class="mb-4">
        <div style="font: size 14px;">
            <a href="{{ route('users.index') }}" class="text-dark text-decoration-none"><i class="bi bi-house-door-fill"></i> Home</a>
            <span class="text-dark"> > </span>
            <a href="" class="text-dark text-decoration-none">Edit Role</a>
        </div>
    </div>
    <form action="{{ route('roles.update', $roles->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8 border">
                <div class="form-group">
                    <label for="name" class="fw-bold">Role Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $roles->name) }}" placeholder="Role name">
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                </div>
                <div class="form-group">
                    <label for="description" class="fw-bold">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="10" placeholder="Description">{{ old('description', $roles->description) }}</textarea>
                    <p class="text-danger">{{ $errors->first('description') }}</p>
                </div>
                <div class="form-group">
                    <label for="status" class="fw-bold">Status</label>
                    <div class="radio p-2">
                        <input type="radio" name="status" value="1" {{ old('status', $roles->status) == 1 ? 'checked' : '' }}> Active
                        <input type="radio" name="status" value="0" {{ old('status', $roles->status) == 0 ? 'checked' : '' }}> Inactive
                    </div>
                    <p class="text-danger">{{ $errors->first('status') }}</p>
                </div>
            </div>
            <div class="col-md-4 border">
                <div class="form-group">
                    <label for="courses" class="fw-bold">Permission Type</label>
                    <select class="form-select" name="permissions[]" id="multiple-select-custom-field" data-placeholder="Choose anything" multiple>
                        @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}" {{ in_array($permission->id, old('permissions', $selectedPermissions)) ? 'selected' : '' }}>
                            {{ $permission->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-danger m-3" style="width:100px;">Cancel</button>
        <button type="submit" class="btn btn-primary" style="width:100px;">Update</button>
    </form>
</div>
@endsection