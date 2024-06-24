@extends('client.layout')
@section('title')
Home
@endsection
@section('content')
<div class="container-fluid">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-9">
                <div class="row justify-content-between">
                    <div class="col-lg-9">
                        <h5>List Coures</h5>
                    </div>
                    <div class="col-lg-2">
                        <a href="#" class="text-decoration-none">View More...</a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row g-4 justify-content-center">
                        @foreach ($courses as $course)
                        <div class="col-md-6 col-lg-6 col-xl-4">
                            <div class="card">
                                <img src="data:image/png;base64,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" class="card-img-top mb-1" alt="...">
                                <div class="card-body">
                                    <h6 class="card-title" style="height:40px;">{{ $course->name }}</h6>
                                    <p class="card-text">{!! Str::limit($course->description, 80) !!}</p>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <a href="{{ route('home.show', $course->id)}}" class="btn btn-light me-4">More View</a>
                                        </div>
                                        <div>
                                            <a href="#" class="btn btn-light">Join</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        {{ $courses->links() }}

                        <!-- <div class="col-12">
                            <nav aria-label="Page navigation example align-items-center">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <h4>Name</h4>
                            <ul class="list-unstyled">
                                <li>
                                    <div class="d-flex justify-content-between">
                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>ABC</a>
                                        <span>(3)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex justify-content-between">
                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>ABC</a>
                                        <span>(5)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex justify-content-between">
                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>ABC</a>
                                        <span>(2)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex justify-content-between">
                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>ABC</a>
                                        <span>(8)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex justify-content-between">
                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>ABC</a>
                                        <span>(5)</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <h4 class="mb-3">Other Courses</h4>
                        
                        @foreach ($courses as $course)
                            <div class="d-flex align-items-center justify-content-start">
                                Name
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection