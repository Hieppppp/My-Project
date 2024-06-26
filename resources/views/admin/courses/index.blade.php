@extends('admin.layout')
@section('title')
Courses
@endsection
@section('content')
@if(Session::get('sms'))
    <div id="alert-container">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{Session::get('sms')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
<div class="container">
    <div class="row">
        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
                <div class="custom-file text-left">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                    <p class="text-danger">{{ $errors->first('file') }}</p>
                </div>
            </div>
            <button class="btn btn-primary"><i class="bi bi-cloud-arrow-down"></i> Import</button>

            <a class="btn btn-success" href="{{ route('export') }}"><i class="bi bi-file-excel"></i> Export</a>
        </form>
        <div class="col-md-3">
            <h1>List Courses</h1>
        </div>
        <div class="col-md-9">
            <form method="get" class="">
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <div class="col-4 me-2">
                            <input type="search" name="keywords" class="form-control" placeholder="Search..." value="{{ request()->input('keywords') }}">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary btn-block"><i class="bi bi-search"></i> Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-striple border text-center">
        <thead>
            <tr class="bg-primary text-white">
                <th><input type="checkbox"></th>
                <th>Name</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
            <tr>
                <td><input type="checkbox"></td>
                <td>{{ $course->name }}</td>
                <td>{!! Str::limit($course->description, 50) !!}</td>
                <td>{{ \Carbon\Carbon::parse($course->start_date)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($course->end_date)->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('courses.show', $course->id) }}" class="btn btn-outline-info">
                        <i class="bi bi-emoji-neutral-fill" title="Click to views"></i>
                    </a>
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-outline-info">
                        <i class="bi bi-pencil-square" title="Click to edit"></i>
                    </a>
                    <a class="btn btn-outline-danger" id="delete" href="{{ route('courses.destroy', $course->id) }}" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this course?')) document.getElementById('delete-form-{{ $course->id }}').submit();">
                        <i class="bi bi-trash" title="Click to delete"></i>
                    </a>
                    <form id="delete-form-{{ $course->id }}" action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $courses->links() }}
</div>
@endsection