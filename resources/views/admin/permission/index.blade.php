@extends('admin.layout')
@section('title')
Permission Management
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
                <h3>Permission Management</h3>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <form action="{{ route('permissions.index') }}" method="get">
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
    <table class="table table-hover border text-center">
        <caption>List of permissions</caption>
        <thead>
            <tr class="bg-primary text-white">
                <th>Permission</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
            <tr>
                <td>{{ $permission->name }}</td>
                <td>{!! $permission->description !!}</td>
                <td>
                    @if ($permission->status == 1)
                    <span style="color: green;">Active</span>
                    @else
                    <span style="color: red;">Inactive</span>
                    @endif
                </td>
                <td>
                    @if ($permission->status == 1)
                    <a href="{{ route('permission.deactivate', ['id' => $permission->id]) }}" class="btn btn-outline-success">
                        <i class="bi bi-arrow-up" title="Click to inactive"></i>
                    </a>
                    @else
                    <a href="{{ route('permission.activate', ['id' => $permission->id]) }}" class="btn btn-outline-info">
                        <i class="bi bi-arrow-down" title="Click to inactive"></i>
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $permissions->appends(['per_page' => $itemsPerPage])->links() }}
</div>

@endsection