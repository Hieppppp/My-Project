@extends('admin.layouts.layout')
@section('title')
Edit Permission
@endsection
@section('content')

<div class="card-body">
    <form action="{{ route('permissions.update', $permissions->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="border">
                <div class="form-group">
                    <label for="name" class="fw-bold">Permission Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $permissions->name) }}" placeholder="Permission name">
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                </div>
                <div class="form-group">
                    <label for="description" class="fw-bold">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="10" placeholder="Description">{{ old('description', $permissions->description) }}</textarea>
                    <p class="text-danger">{{ $errors->first('description') }}</p>
                </div>
                <div class="form-group">
                    <label for="status" class="fw-bold">Status</label>
                    <div class="radio p-2">
                        <input type="radio" name="status" value="1" {{ old('status', $permissions->status) == 1 ? 'checked' : '' }}> Active
                        <input type="radio" name="status" value="0" {{ old('status', $permissions->status) == 0 ? 'checked' : '' }}> Inactive
                    </div>
                    <p class="text-danger">{{ $errors->first('status') }}</p>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-danger m-3" style="width:100px;">Cancel</button>
        <button type="submit" class="btn btn-primary" style="width:100px;">Update</button>
    </form>
</div>

@endsection
