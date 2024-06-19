@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Detail User</h1>
    <div class="card">
        <div class="card-header">
            {{ $users->name }}
        </div>
        <div class="card-body">
            <p>Email: {{ $users->email }}</p>
            <p>Date Birth: {{ $users->date_of_birth }}</p>
            <p>Phone: {{ $users->phone }}</p>
            <p>Profile: <img src="/avatar/{{ $users->avatar }}" alt="avatar" width="100"></p>
            <h3>List Courses:</h3>
            <ul>
                @foreach ($users->courses as $course)
                <li>
                    <p><strong>Courses:</strong> {{ $course->name }}</p>
                    <p><strong>Description:</strong> {{ $course->description }}</p>
                    <p><strong>Start Date:</strong> {{ $course->start_date }}</p>
                    <p><strong>End Date:</strong> {{ $course->end_date }}</p>
                </li>
                @endforeach
            </ul>
            
        </div>
    </div>
</div>
@endsection