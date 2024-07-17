@extends('admin.layout')
@section('title')
User Management
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
        <div class="row mb-3">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h3>List User</h3>
                @can(App\Enums\PermissionName::CREATE_USER, App\Enums\PermissionName::DELETE_USER, $users)
                <div>
                    <a href="{{ route('users.create') }}" class="btn btn-outline-primary border-0">
                        <i class="bi bi-plus-circle-fill" title="Click to add new user"></i>
                        <span>New User</span>
                    </a>
                    <button class="btn btn-outline-danger border-0" onclick="event.preventDefault(); document.getElementById('delete-multiple-form').submit();">
                        <i class="bi bi-trash" title="Click to delete all"></i>
                        <span>Delete All</span>
                    </button>
                </div>
                @endcan
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-2">
                <form action="" method="get">
                    <label>
                        Show
                        <select name="per_page" class="form-select d-inline w-auto" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page') == 10 ? ' selected ' : '' }}>10</option>
                            <option value="20" {{ request('per_page') == 20 ? ' selected ' : '' }}>20</option>
                            <option value="50" {{ request('per_page') == 50 ? ' selected ' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? ' selected ' : '' }}>100</option>
                        </select>
                        users
                    </label>
                </form>
            </div>
            <div class="col-md-2">
                <form action="" method="get">
                    <div class="d-flex">
                        <div class="me-2 w-100">
                            <select name="roles[]" id="roles" class="form-control">
                                <option value="0">Filter by Role</option>
                                @foreach($allRoles as $role)
                                <option value="{{ $role->name }}" {{ in_array($role->name, request()->input('roles', [])) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-filter"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <form method="get">
                    <div class="d-flex justify-content-end">
                        <div class="me-2 w-50">
                            <input type="search" name="keywords" class="form-control" placeholder="Search by email or name..." value="{{ request()->input('keywords') }}">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <form id="delete-multiple-form" action="{{ route('users.deleteMultiRecord')}}" method="post">
        @csrf
        @method('DELETE')
        <table id="dataTable" class="table table-hover border text-center">
            <caption>List of users</caption>
            <thead class="bg-light text-capitalize">
                <tr class="">
                    <th width="5%"><input type="checkbox" onclick="toggle(this);"></th>
                    <th width="10%">Name</th>
                    <th width="20%">Profile</th>
                    <th width="10%">Role</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td><input type="checkbox" name="ids[]" value="{{ $user->id }}"></t>
                    <td>{{ $user->name }}</td>
                    <td>
                        <img width="50px" height="50px" class="img-fluid rounded-circle" src="/avatar/{{ $user->avatar }}" alt="">
                    </td>
                    <td>
                        @if (count($user->roles)>0)
                        @foreach($user->roles as $role)
                        <span class="badge bg-info mr-1">{{ $role->name }}</span>
                        @endforeach
                        @else
                        <span class="badge bg-danger mr-1">No role</span>
                        @endif
                    </td>
                    <td>
                        @can(App\Enums\PermissionName::VIEW_USER, $user)
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-info border-0">
                            <i class="bi bi-eye" title="Click to views"></i>
                        </a>
                        @endcan
                        @can(App\Enums\PermissionName::DELETE_USER, $user)
                        <a class="btn btn-outline-danger border-0" id="delete" href="{{ route('users.destroy', $user->id) }}" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) document.getElementById('delete-form-{{ $user->id }}').submit();">
                            <i class="bi bi-trash" title="Click to delete"></i>
                        </a>
                        @endcan
                        <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
    {{ $users->appends(['per_page' => $itemsPerPage])->links() }}
</div>
@endsection 

