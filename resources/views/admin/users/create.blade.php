@extends('admin.layout')
@section('title')
Add User
@endsection
@section('content')
@if(Session::get('sms'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{Session::get('sms')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card-body">
    <h5 class="text-center">Create User</h5>
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" >
                <p class="text-danger">{{ $errors->first('name') }}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" >
                <p class="text-danger">{{ $errors->first('email') }}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" >
                <p class="text-danger">{{ $errors->first('password') }}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" >
                <p class="text-danger">{{ $errors->first('date_of_birth') }}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" >
                <p class="text-danger">{{ $errors->first('phone') }}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="avatar">Avatar</label>
                <input type="file" class="form-control" id="avatar" name="avatar">
                <p class="text-danger">{{ $errors->first('avatar') }}</p>
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
                        <input type="checkbox" id="course_{{ $course->id }}" name="courses[]" value="{{ $course->id }}">
                        <label for="course_{{ $course->id }}">{{ $course->name }}</label><br>
                    </div>
                    @php $columnCount++; @endphp
                    @endforeach
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Create User</button>
    </form>

</div>
@endsection