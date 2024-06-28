@extends('admin.layout')
@section('title')
Add Course
@endsection
@section('content')

<div class="card-body">
    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="form-group">
                <label for="name">Course Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Course name">
                <p class="text-danger">{{ $errors->first('name') }}</p>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="10" placeholder="Description">{{ old('description') }}</textarea>
                <p class="text-danger">{{ $errors->first('description') }}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" placeholder="Start date">
                <p class="text-danger">{{ $errors->first('start_date') }}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" placeholder="End date">
                <p class="text-danger">{{ $errors->first('end_date') }}</p>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Create Course</button>
    </form>

</div>
@endsection