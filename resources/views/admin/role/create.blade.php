@extends('admin.layout')
@section('title')
Add New Role
@endsection
@section('content')
<div class="card-body">
    <div style="font: size 14px;">
        <a href="{{ route('users.index') }}" class="text-dark text-decoration-none"><i class="bi bi-house-door-fill"></i> Home</a>
        <span class="text-dark"> > </span>
        <a href="" class="text-dark text-decoration-none">Create New Role</a>
    </div>
    <h2>Create New Role</h2>
    <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8 border">
                <div class="form-group">
                    <label for="name" class="fw-bold">Role Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Role name">
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                </div>
                <div class="form-group">
                    <label for="description" class="fw-bold">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="10" placeholder="Description">{{ old('description') }}</textarea>
                    <p class="text-danger">{{ $errors->first('description') }}</p>
                </div>
                <div class="form-group">
                    <label for="status" class="fw-bold">Status</label>
                    <div class="radio p-2">
                        <input type="radio" name="status" value="1"> Active
                        <input type="radio" name="status" value="0"> Inactive
                    </div>
                    <p class="text-danger">{{ $errors->first('status') }}</p>
                </div>
            </div>
            <div class="col-md-4 border">
                <div class="form-group">
                    <label for="" class="fw-bold">Permission Type:</label>
                    <select class="form-select" id="multiple-select-custom-field" data-placeholder="Choose anything" name="permissions[]" multiple>
                        @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
        <button type="button" class="btn btn-danger m-3" style="width:100px;"><i class="bi bi-trash"></i> Cancel</button>
        <button type="submit" class="btn btn-primary" style="width:100px;"><i class="bi bi-save"></i> Save</button>
    </form>
</div>

@endsection