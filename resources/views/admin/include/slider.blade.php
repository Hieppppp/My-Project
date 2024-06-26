<div class="col-lg-2 bg-secondary border-top border-3 border-secondary" id="dashboard-menu">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-2 text-center text-light">ADMIN</h4>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column mt-2 align-items-stretch" id="adminDropdown">
                <ul class="list-unstyled">
                    <li class="mb-4">
                        <a class="btn btn-outline-light text-decoration-none w-100 mb-2" data-bs-toggle="collapse" href="#courseDropdown"  aria-expanded="false" aria-controls="multiCollapseExample1"><i class="bi bi-bookmark-heart-fill"></i> Course</a>
                        <ul id="courseDropdown" class="collapse list-unstyled">
                            <!-- <li class="mb-3 btn w-100"><a class="text-decoration-none text-dark btn-hover" href=" {{ route('courses.create') }} ">Add Course</a></li> -->
                            <li class="mb-3 btn w-100"><a class="text-decoration-none text-dark" href=" {{ route('courses.store') }} ">Manage Courses</a></li>
                        </ul>
                    </li>
                    <li class="mb-4">
                        <a class="btn btn-outline-light text-decoration-none w-100 mb-2" data-bs-toggle="collapse" href="#userDropdown" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="bi bi-person-circle"></i> User</a>
                        <ul id="userDropdown" class="collapse list-unstyled">
                            <!-- <li class="mb-3 btn w-100"><a class="text-decoration-none text-dark btn-hover" href=" {{ route('users.create') }} ">Add User</a></li> -->
                            <li class="mb-3 btn w-100"><a class="text-decoration-none text-dark btn-hover" href=" {{ route('users.store') }} ">Manage Users</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>