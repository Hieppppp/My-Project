<form id="delete-multiple-form" action="{{ route('users.deleteMultiRecord') }}" method="post">
    @csrf
    @method('DELETE')
    <table class="table table-hover border text-center">
        <caption>List of users</caption>
        <thead>
            <tr class="">
                <th><input type="checkbox" onclick="toggle(this);"></th>
                <th>Name</th>
                <th>Profile</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td><input type="checkbox" name="ids[]" value="{{ $user->id }}"></td>
                <td>{{ $user->name }}</td>
                <td>
                    <img width="50px" height="50px" class="img-fluid rounded-circle" src="/avatar/{{ $user->avatar }}" alt="">
                </td>
                <td>
                    @if (count($user->roles) > 0)
                    @foreach($user->roles as $role)
                    <span class="badge bg-success">{{ $role->name }}</span>
                    @endforeach
                    @else
                    <span class="badge bg-danger">No role</span>
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