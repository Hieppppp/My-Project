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
    <form action="{{ route('users.update', $users->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="form-group col-md-6">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $users->name }}" required>
            </div>

            <div class="form-group col-md-6">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $users->email }}" required>
            </div>

            <div class="form-group col-md-6">
                <label for="date_of_birth">Date Birth:</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $users->date_of_birth }}" required>
            </div>

            <div class="form-group col-md-6">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $users->phone }}" required>
            </div>

            <div class="form-group col-md-6">
                <label for="avatar">Profile:</label>
                <input type="file" class="form-control" id="avatar" name="avatar">
                @if ($users->avatar)
                <img src="{{ asset('avatar/' . $users->avatar) }}" alt="Avatar" style="max-width: 100px; max-height: 100px;">
                @endif
            </div>

            <div class="form-group mb-4">
                <label class="fw-bold" for="courses">List Courses:</label><br>
                <div class="row">
                    @php $columnCount = 0; @endphp
                    @foreach ($courses as $course)
                    @if ($columnCount % 10 == 0 && $columnCount != 0)
                </div>
                <div class="row">
                    @endif
                    <div class="col-md-6">
                        <input type="checkbox" id="course_{{ $course->id }}" name="courses[]" value="{{ $course->id }}" @if (in_array($course->id, $selectedCourses)) checked @endif>
                        <label for="course_{{ $course->id }}">{{ $course->name }}</label><br>
                    </div>
                    @php $columnCount++; @endphp
                    @endforeach
                </div>
            </div>
        </div>
        <button class="btn btn-outline-primary" type="submit">Update user</button>
    </form>
    

</div>


@endsection