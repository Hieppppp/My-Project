@extends('admin.layout')
@section('title')
Detail User
@endsection
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center w-100 mb-3">
        <div style="font: size 14px;">
            <a href="{{ route('users.index') }}" class="text-dark text-decoration-none"><i class="bi bi-house-door-fill"></i> Home</a>
            <span class="text-dark"> > </span>
            <a href="" class="text-dark text-decoration-none">Detail User</a>
        </div>
        <div>
            @can(App\Enums\PermissionName::UPDATE, $users)
            <a href="{{ route('users.edit', $users->id) }}" class="btn btn-outline-primary">
                <i class="bi bi-pencil-square" title="Click to edit"></i>
                <span>Edit User</span>
            </a>
            @endcan
        </div>

    </div>


    <div class="card">
        <div class="card-header">
            Name: {{ $users->name }}
        </div>
        <div class="card-body">
            <p>Email: {{ $users->email }}</p>
            <p>Date Birth: {{ \Carbon\Carbon::parse($users->date_of_birth)->format('d-m-Y')  }}</p>
            <p>Phone: {{ $users->phone }}</p>
            <p>Profile: <img src="/avatar/{{ $users->avatar }}" alt="avatar" width="100"></p>
            <h3>List Courses:</h3>
            <ul>
                @foreach ($users->courses as $course)
                <li>
                    <p><strong>Courses:</strong> {{ $course->name }}</p>
                    <p><strong>Description:</strong> {!! $course->description !!}</p>
                    <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($course->start_date)->format('d-m-Y')  }}</p>
                    <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($course->end_date)->format('d-m-Y')  }}</p>
                </li>
                @endforeach
            </ul>

        </div>
    </div>
</div>
@endsection