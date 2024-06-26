@extends('admin.layout')
@section('title')
Detail Course
@endsection
@section('content')
<div class="container">
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