@extends('admin.layout')
@section('title')
Role Management
@endsection
@section('content')

@if (Session::get('sms'))
<div id="alert-container">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ Session::get('sms') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

<div class="container">
    <div class="row">
        <div class="row mb-3">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h3>Role Management</h3>
                <div>
                    <a href="{{ route('roles.create') }}" class="btn btn-outline-primary border-0">
                        <i class="bi bi-plus-circle-fill" title="Click to add new"></i>
                        <span>New Role</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-hover border text-center">
        <caption>List of roles</caption>
        <thead class="bg-light text-capitalize">
            <tr class="">
                <th>Role</th>
                <th>Permission</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td style="width:70%;">
                    @if (count($role->permissions)>0)
                        @foreach ($role->permissions as $permission)
                            <span class="badge bg-info mr-1">{{ $permission->name }}</span>
                        @endforeach
                    @else
                        <span class="badge bg-danger mr-1">No permission</span>
                    @endif
                </td>
                <td>
                    @if ($role->status == 1)
                    <span style="color: green;">Active</span>
                    @else
                    <span style="color: red;">Inactive</span>
                    @endif
                </td>
                <td>
                    @if ($role->status == 1)
                    <a href="{{ route('roles.deactivate', ['id' => $role->id]) }}" class="btn btn-outline-success border-0">
                        <i class="bi bi-arrow-up" title="Click to inactive"></i>
                    </a>
                    @else
                    <a href="{{ route('roles.activate', ['id' => $role->id]) }}" class="btn btn-outline-info border-0">
                        <i class="bi bi-arrow-down" title="Click to inactive"></i>
                    </a>
                    @endif

                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-outline-info border-0">
                        <i class="bi bi-pencil-square" title="Click to edit"></i>
                    </a>

                    <a href="{{ route('roles.destroy', $role->id) }}" class="btn btn-outline-danger border-0" id="delete" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) document.getElementById('delete-form-{{ $role->id }}').submit();">
                        <i class="bi bi-trash" title="Click to delete"></i>
                    </a>

                    <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>

@endsection