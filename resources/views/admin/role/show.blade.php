@extends('admin.layout')
@section('title')
Views Role
@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>Role</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Permission</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $roles->name }}</td>
                        <td>
                            @if (count($roles->permissions)>0)
                                @foreach ($roles->permissions as $permission)
                                    <span class="badge bg-success">{{ $permission->name }}</span>
                                @endforeach
                            @else
                                <span class="badge bg-danger">No permission</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection