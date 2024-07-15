@extends('admin.layout')
@section('title')
Add Course
@endsection
@section('content')

<div class="card-body">
    <div style="font: size 14px;">
        <a href="{{ route('courses.index') }}" class="text-dark text-decoration-none"><i class="bi bi-house-door-fill"></i> Home</a>
        <span class="text-dark"> > </span>
        <a href="" class="text-dark text-decoration-none">Create New Course</a>
    </div>
    <h2>Create New Course</h2>
    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="form-group">
                <label for="name" class="fw-bold">Course Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Course name">
                <p class="text-danger">{{ $errors->first('name') }}</p>
            </div>
            <div class="form-group">
                <label for="description" class="fw-bold">Description</label>
                <textarea class="form-control" id="description" name="description" rows="10" placeholder="Description">{{ old('description') }}</textarea>
                <p class="text-danger">{{ $errors->first('description') }}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="start_date" class="fw-bold">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" placeholder="Start date">
                <p class="text-danger">{{ $errors->first('start_date') }}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="end_date" class="fw-bold">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" placeholder="End date">
                <p class="text-danger">{{ $errors->first('end_date') }}</p>
            </div>
        </div>
        <button type="button" class="btn btn-danger m-3" style="width:100px" onclick="window.location='{{ URL::previous() }}'"><i class="bi bi-trash"></i> Cancel</button>
        <button type="submit" class="btn btn-primary" style="width:100px"><i class="bi bi-save"></i> Save</button>
    </form>

</div>
@endsection