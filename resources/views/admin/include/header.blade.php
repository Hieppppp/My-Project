<div class="container-fluid bg-secondary text-light p-3 d-flex align-items-center justify-content-between sticky-top">
    <h3 class="mb-0 text-light h-font">LOGO</h3>
    <h2 class="header-name">Welcome, {{ Auth::user()->name }}</h2>
        <form method="POST" action="{{ url('logout') }}">
            @csrf
            <button class="btn btn-warning" type="submit"><i class="bi bi-box-arrow-in-right"></i> Logout</button>
        </form>
</div>