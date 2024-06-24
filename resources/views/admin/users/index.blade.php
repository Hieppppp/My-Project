@extends('admin.layout')
@section('title')
User
@endsection
@section('content')
@if(Session::get('sms'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{Session::get('sms')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h1>List Users</h1>
        </div>
        <div class="col-md-9">
            <form method="get" class="">
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <div class="col-4 me-2">
                            <input type="search" name="keywords" class="form-control" placeholder="Search..." value="{{ request()->input('keywords') }}">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary btn-block">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-striple border text-center">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date Birth</th>
                <th>Phone</th>
                <th>Profile</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ \Carbon\Carbon::parse($user->date_of_birth)->format('d-m-Y') }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                    <img width="50px" height="50px" class="img-fluid rounded" src="/avatar/{{ $user->avatar }}" alt="">
                </td>
                <td>
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-info">
                        <i class="bi bi-emoji-neutral-fill" title="Click to views"></i>
                    </a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-info">
                        <i class="bi bi-pencil-square" title="Click to edit"></i>
                    </a>

                    <a class="btn btn-outline-danger" id="delete" href="{{ route('users.destroy', $user->id) }}" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) document.getElementById('delete-form-{{ $user->id }}').submit();">
                        <i class="bi bi-trash" title="Click to delete"></i>
                    </a>

                    <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection