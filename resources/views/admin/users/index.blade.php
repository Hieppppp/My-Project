@extends('admin.layout')
@section('title')
User
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
        <div class="row mb-3">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h3>List User</h3>
                <div>
                    <a href="{{ route('users.create') }}" class="btn btn-outline-primary">
                        <i class="bi bi-plus-circle-fill" title="Click to add new user"></i>
                        <span>New User</span>
                    </a>
                    <button class="btn btn-outline-danger">
                        <i class="bi bi-trash" title="Click to delete all"></i>
                        <span>Delete All</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <form action="{{ route('users.index') }}" method="get">
                    <label>
                        Show
                        <select name="per_page" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page') == 10 ? ' selected ' : '' }}>10</option>
                            <option value="20" {{ request('per_page') == 20 ? ' selected ' : '' }}>20</option>
                            <option value="50" {{ request('per_page') == 50 ? ' selected ' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? ' selected ' : '' }}>100</option>
                        </select>
                        users
                    </label>
                </form>
            </div>

            <div class="col-md-6">
                <form method="get" class="">
                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <div class="me-2 w-50">
                                <input type="search" name="keywords" class="form-control" placeholder="Search..." value="{{ request()->input('keywords') }}">
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary btn-block"><i class="bi bi-search"></i> Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-striple border text-center">
        <thead>
            <tr class="bg-primary text-white">
                <th><input type="checkbox"></th>
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
                <td><input type="checkbox"></td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ \Carbon\Carbon::parse($user->date_of_birth)->format('d-m-Y') }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                    <img width="50px" height="50px" class="img-fluid rounded" src="/avatar/{{ $user->avatar }}" alt="">
                </td>
                <td>
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-info">
                        <i class="bi bi-bookmark-check" title="Click to views"></i>
                    </a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-success">
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
    {{ $users->appends(['per_page' => $itemsPerPage])->links() }}
</div>
@endsection