@extends('admin.layouts.layout')
@section('title')
Courses
@endsection
@section('content')
@if(Session::get('sms'))
<div id="alert-container">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{Session::get('sms')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

<div class="container">
    <div class="row">
        @can(\App\Enums\PermissionName::IMPORT_EXCEL, \App\Enums\PermissionName::EXPORT_EXCEL)
        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
                <div class="custom-file text-left">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                    <p class="text-danger">{{ $errors->first('file') }}</p>
                </div>
            </div>
            <button class="btn btn-primary border-0"><i class="bi bi-cloud-arrow-down"></i> Import</button>
            <a class="btn btn-success border-0" href="{{ route('export') }}"><i class="bi bi-file-excel"></i> Export</a>
            @if(session('error_message'))
            <p class="text-danger">{{ session('error_message') }}</p>
            @endif
        </form>
        @endcan

        <div class="row mb-3">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h3>List Courses</h3>
                <div>
                    @can(App\Enums\PermissionName::CREATE_COURSE, $courses)
                    <a href="{{ route('courses.create') }}" class="btn btn-outline-primary border-0">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>New Course</span>
                    </a>
                    <button class="btn btn-outline-danger border-0" onclick="event.preventDefault(); document.getElementById('delete-multiple-form').submit();">
                        <i class="bi bi-trash"></i>
                        <span>Delete All</span>
                    </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <form id="delete-multiple-form" action="{{ route('courses.deleteMultiRecord') }}" method="POST">
        @csrf
        @method('DELETE')
        <table id="courses" class="display table table-hover border text-center" cellspacing="0" width="100%">
            <thead class="text-capitalize">
                <tr class="text-center">
                    <th><input type="checkbox" onclick="toggle(this);"></th>
                    <th>Courses</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($courses as $course)
                <tr>
                    
                    <td><input type="checkbox" name="ids[]" value="{{ $course->id }}"></td>
                    <td>{{ $course->name }}</td>
                    <td>{!! Str::limit($course->description, 50) !!}</td>
                    <td>{{ \Carbon\Carbon::parse($course->start_date)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($course->end_date)->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-outline-info border-0">
                            <i class="bi bi-eye" title="Click to views"></i>
                        </a>
                        @can(App\Enums\PermissionName::UPDATE_COURSE, $course)
                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-outline-success border-0">
                            <i class="bi bi-pencil-square" title="Click to edit"></i>
                        </a>
                        @endcan
                        @can(App\Enums\PermissionName::DELETE_COURSE, $course)
                        <a class="btn btn-outline-danger border-0" id="delete" href="{{ route('courses.destroy', $course->id) }}" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this course?')) document.getElementById('delete-form-{{ $course->id }}').submit();">
                            <i class="bi bi-trash" title="Click to delete"></i>
                        </a>
                        @endcan
                        <form id="delete-form-{{ $course->id }}" action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>


@endsection