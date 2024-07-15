@extends('admin.layout')
@section('title')
Edit
@endsection
@section('content')

<div class="card-body">
    <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="form-group mb-4">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $course->name) }}">
                <p class="text-danger">{{ $errors->first('name') }}</p>
            </div>

            <div class="form-group mb-4">
                <label for="description">Description:</label>
                <textarea type="description" class="form-control" id="description" name="description" value="{{ old('description', $course->description) }}" rows="10">{{ $course->description }}</textarea>
                <p class="text-danger">{{ $errors->first('description') }}</p>
            </div>

            <div class="form-group col-md-6 mb-4">
                <label for="start_date">Start Date:</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $course->start_date) }}">
                <p class="text-danger">{{ $errors->first('start_date') }}</p>
            </div>

            <div class="form-group col-md-6 mb-4">
                <label for="end_date">End Date:</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $course->end_date) }}">
                <p class="text-danger">{{ $errors->first('end_date') }}</p>
            </div>

        </div>
        <button type="button" class="btn btn-danger m-3" style="width:100px;" onclick="window.location='{{ URL::previous() }}'"><i class="bi bi-trash"></i> Cancel</button>
        <button type="submit" class="btn btn-primary" style="width:100px;"><i class="bi bi-save"></i> Update</button>
    </form>
</div>

@endsection