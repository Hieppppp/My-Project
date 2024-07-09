@extends('admin.layout')
@section('title')
DETAI USER
@endsection
@section('content')
<div id="user-profile-2" class="user-profile">
    <div style="font: size 14px;">
        <a href="{{ route('users.index') }}" class="text-dark text-decoration-none"><i class="bi bi-house-door-fill"></i> Home</a>
        <span class="text-dark"> > </span>
        <a href="" class="text-dark text-decoration-none">Detail User</a>
    </div>
    <div class="tabbable">
        <div class="d-flex justify-content-end">
            @can(App\Enums\PermissionName::UPDATE, $users)
            <a href="{{ route('users.edit', $users->id) }}" class="btn btn-outline-primary">
                <i class="bi bi-pencil-square" title="Click to edit"></i>
                <span>Edit User</span>
            </a>
            @endcan
        </div>

        <div class="tab-content no-border padding-24">
            <div id="home" class="tab-pane in active">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 center">
                        <span class="profile-picture">
                            <img class="editable img-responsive w-100" alt=" Avatar" id="avatar2" src="/avatar/{{ $users->avatar }}">
                        </span>
                    </div>

                    <div class="col-xs-12 col-sm-9">
                        <h4 class="blue" style="margin-left:80px;">
                            <span class="middle">{{ $users->name }}</span>
                        </h4>

                        <div class="profile-user-info">
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Role </div>
                                @foreach ($users->roles as $role )
                                <div class="profile-info-value">
                                    <span>{{ $role->name}} </span>
                                </div>
                                @endforeach
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Email </div>
                                <div class="profile-info-value">
                                    <i class="bi bi-envelope light-orange bigger-110"></i>
                                    <span>{{ $users->email }}</span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Phone </div>
                                <div class="profile-info-value">
                                    <i class="bi bi-telephone-fill light-orange bigger-110"></i>
                                    <span>{{ $users->phone }}</span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Birth </div>
                                <div class="profile-info-value">
                                    <i class="bi bi-calendar-date light-orange bigger-110"></i>
                                    <span>{{ \Carbon\Carbon::parse($users->date_of_birth)->format('d-m-Y')  }}</span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Last Online </div>

                                <div class="profile-info-value">
                                    <span>3 hours ago</span>
                                </div>
                            </div>
                        </div>

                        <div class="hr hr-8 dotted"></div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-xs-12 col-sm-9 card-body">
                    <div class="widget-box transparent">
                        <h3>List Courses:</h3>
                        <table id="" class="table table-hover table-striped text-center ">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Courses</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @foreach($users->courses as $course)
                                <tr class='align-middle'>
                                    <td>{{$i++}}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>{!! $course->description !!}</td>
                                    <td>{{ \Carbon\Carbon::parse($course->start_date)->format('d-m-Y')  }}</td>
                                    <td>{{ \Carbon\Carbon::parse($course->end_date)->format('d-m-Y')  }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection