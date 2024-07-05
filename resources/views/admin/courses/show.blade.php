@extends('admin.layout')
@section('title')
Detail Course
@endsection
@section('content')
<div class="container">
    <div style="font: size 14px;">
        <a href="{{ route('courses.index') }}" class="text-dark text-decoration-none"><i class="bi bi-house-door-fill"></i> Home</a>
        <span class="text-dark"> > </span>
        <a href="" class="text-dark text-decoration-none">Detail Courses</a>
    </div>
    <h1>Detail Courses</h1>
    <div class="card">
        <div class="card-header">
            {{ $course->name }}
        </div>
        <div class="card-body">
            <p>Description: {!! $course->description !!}</p>
            <p>Start Date: {{ \Carbon\Carbon::parse($course->start_date)->format('d-m-Y') }}</p>
            <p>End Date: {{ \Carbon\Carbon::parse($course->end_date)->format('d-m-Y') }}</p>
        </div>
    </div>
</div>
@endsection