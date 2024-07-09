@extends('admin.layout')
@section('title')
DETAI USER
@endsection
@section('content')
<div id="user-profile-2" class="user-profile">
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
                        <h4 class="blue">
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
                                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                                    <span>{{ $users->email }}</span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Phone </div>

                                <div class="profile-info-value">
                                    <span>{{ $users->phone }}</span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Birth </div>

                                <div class="profile-info-value">
                                    <i class="bi bi-map-marker light-orange bigger-110"></i>
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
                <div class="col-xs-12 col-sm-6 m-4">
                    <div class="widget-box transparent">
                        <h3>List Courses:</h3>
                        <ul>
                            @foreach ($users->courses as $course)
                            <li>
                                <p><strong>Courses:</strong> {{ $course->name }}</p>
                                <p><strong>Description:</strong> {!! $course->description !!}</p>
                                <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($course->start_date)->format('d-m-Y')  }}</p>
                                <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($course->end_date)->format('d-m-Y')  }}</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection