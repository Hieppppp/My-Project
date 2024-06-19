@extends('admin.layout')
@section('title')
Edit
@endsection
@section('content')
@if(Session::get('sms'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{Session::get('sms')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card-body">
    <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="form-group mb-4">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $course->name }}" required>
            </div>

            <div class="form-group mb-4">
                <label for="description">Description:</label>
                <textarea type="description" class="form-control" id="description" name="description" value="{{ $course->description }}" rows="10" required>{{ $course->description }}</textarea>
            </div>

            <div class="form-group col-md-6 mb-4">
                <label for="start_date">Start Date:</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $course->start_date }}" required>
            </div>

            <div class="form-group col-md-6 mb-4">
                <label for="end_date">End Date:</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $course->end_date }}" required>
            </div>

        </div>
        <button class="btn btn-outline-primary" type="submit">Save</button>
    </form>
</div>

@endsection