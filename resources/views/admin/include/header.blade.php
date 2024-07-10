<div class="container-fluid bg-secondary text-light p-3 d-flex align-items-center justify-content-between sticky-top">
    <h6 class="mb-0 text-light h-font" data-bs-toggle="modal" data-bs-target="#editProfileModal{{ Auth::user()->id }}">
        <img width="50px" height="50px" class="rounded-circle" src="/avatar/{{ Auth::user()->avatar }}" alt="Avatar">
        {{ Auth::user()->name }}
    </h6>
    <form method="POST" action="{{ url('logout') }}">
        @csrf
        <button class="btn btn-warning" type="submit"><i class="bi bi-box-arrow-in-right"></i> Logout</button>
    </form>
</div>

<div class="modal fade" id="editProfileModal{{ Auth::user()->id }}" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.update', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-4">
                        <div class="col form-group">
                            <label for="name">Name *</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        </div>
                        <div class="col form-group">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col form-group">
                            <label for="date">Date of Birth *</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ Auth::user()->date_of_birth }}">
                            <p class="text-danger">{{ $errors->first('date_of_birth') }}</p>
                        </div>
                        <div class="col form-group">
                            <label for="phone">Phone *</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}">
                            <p class="text-danger">{{ $errors->first('phone') }}</p>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="avatar">Avatar *</label>
                        <input type="file" class="form-control" id="avatar" name="avatar" onchange="previewAvatar(event)">
                        @if (Auth::user()->avatar)
                            <img id="avatar-preview" src="{{ asset('avatar/' . Auth::user()->avatar) }}" alt="Avatar" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                        @else
                            <img id="avatar-preview" src="#" alt="Image Preview" style="display:none; max-width: 100px; margin-top: 10px;">
                        @endif
                    </div>

                    <button type="button" class="btn btn-danger m-3" data-bs-dismiss="modal" style="width:100px;">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="width:100px;">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>