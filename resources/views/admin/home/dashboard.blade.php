@extends('admin.layouts.layout')
@section('title')
    Dashboard
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card mb-4">
                <div class="card-body">Total Users</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h2>{{ $total_users }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card mb-4">
                <div class="card-body">Total Courses</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h2>{{ $total_courses }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card mb-4">
                <div class="card-body">Total Roles</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h2>{{ $total_roles }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card mb-4">
                <div class="card-body">Total Permissions</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h2>{{ $total_permissions }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection