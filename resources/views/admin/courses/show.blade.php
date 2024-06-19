@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Detail Courses</h1>
    <div class="card">
        <div class="card-header">
            {{ $course->name }}
        </div>
        <div class="card-body">
            <p>Description: {{ $course->description }}</p>
            <p>Start Date: {{ $course->start_date }}</p>
            <p>End Date: {{ $course->end_date }}</p>
        </div>
    </div>
</div>
@endsection