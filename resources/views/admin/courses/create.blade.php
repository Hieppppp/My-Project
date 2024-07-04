@extends('admin.layout')
@section('title')
Add Course
@endsection
@section('content')

<div class="card-body">
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
        <button type="button" class="btn btn-danger m-3" style="width:100px">Cancel</button>
        <button type="submit" class="btn btn-primary" style="width:100px">Save</button>
    </form>

</div>
@endsection