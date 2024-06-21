@extends('include.admin')

@section('title','Dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">


        <div class="col-lg-6 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Categories</h5>
                            <p class="mb-4 fs-1">
                                {{ $Category }}
                            </p>

                            <a href="{{route('categories')}}" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="assets/img/illustrations/man-with-laptop-light.png" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Companies</h5>
                            <p class="mb-4 fs-1">
                                {{ '$companies' }}
                            </p>

                            <a href="{{url('/companies')}}" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
