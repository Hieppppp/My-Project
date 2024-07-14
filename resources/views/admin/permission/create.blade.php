@extends('admin.layout')
@section('title')
Add New Permission
@endsection
@section('content')

<div class="card-body">
    <div style="font: size 14px;">
        <a href="{{ route('users.index') }}" class="text-dark text-decoration-none"><i class="bi bi-house-door-fill"></i> Home</a>
        <span class="text-dark"> > </span>
        <a href="" class="text-dark text-decoration-none">Create New Permission</a>
    </div>
    <h2>Create New Permission</h2>
    <form action="{{ route('permissions.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <label for="name" class="fw-bold">Permission Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Permission name">
                <p class="text-danger">{{ $errors->first('name') }}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="status" class="fw-bold">Status</label>
                <div class="radio p-2">
                    <input type="radio" name="status" value="1"> Active
                    <input type="radio" name="status" value="0"> Inactive
                </div>
                <p class="text-danger">{{ $errors->first('status') }}</p>
            </div>
            <div class="form-group">
                <label for="description" class="fw-bold">Description</label>
                <textarea class="form-control" id="description" name="description" rows="10" placeholder="Description">{{ old('description') }}</textarea>
                <p class="text-danger">{{ $errors->first('description') }}</p>
            </div>
        </div>
        <button type="button" class="btn btn-danger m-3" style="width:100px;">Cancel</button>
        <button type="submit" class="btn btn-primary" style="width:100px;">Save</button>
    </form>
</div>

@endsection