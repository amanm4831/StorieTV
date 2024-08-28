<div class="main-content">
    <div >
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">User Details</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                <li class="breadcrumb-item active">Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div> <!-- container-fluid -->
    </div> <!-- End Page-content -->
</div>

<div class="row">
    <!-- Welcome Back Card -->
    <div class="col-lg-3 col-md-5 mb-3">
        <div class="card h-100" style="height: 290px ! important;">
            <div class="card-body">
                <h5 class="card-title">Welcome back</h5>
                <p class="card-text">We're glad to see you again!</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>
    </div>

    <!-- User Statistics Card -->
    <div class="col-lg-6 col-md-6 mb-4">
        <div class="card h-100" style="height: 290px ! important;">
            <div class="card-body">
                <h5 class="card-title">User Statistics</h5>
                <div class="row">
                    <div class="row">
                            <div class="col-lg-3">
                                <div class="card bg-primary border-primary text-white-50">
                                    <div class="card-body">
                                        <h5 class="mb-3 text-white" style="font-size: 12px;">Total Followers</h5>
                                        <p class="card-text" style="font-size: 12px;">{{ $user->total_followers }}</p>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col-lg-3">
                                <div class="card bg-primary border-primary text-white-50">
                                    <div class="card-body">
                                        <h5 class="mb-3 text-white" style="font-size: 12px;">Total Following</h5>
                                        <p class="card-text" style="font-size: 12px;">{{ $user->total_following }}</p>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col-lg-3">
                                <div class="card bg-primary border-primary text-white-50">
                                    <div class="card-body">
                                        <h5 class="mb-3 text-white" style="font-size: 12px;">Total Collabs</h5>
                                        <p class="card-text" style="font-size: 12px;">{{ $user->total_collabs }}</p>
                                    </div>
                                </div>
                            </div><!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Personal Information Card -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100" style="height: 300px ! important;">
            <div class="card-body">
                <h5 class="card-title" style="font-size: 12px;">Personal Information</h5>
                <p class="card-text mt-3" style="font-size: 12px;">Full name: {{ $user->full_name }}</p>
                <p class="card-text" style="font-size: 12px;">Username: {{ $user->user_name }}</p>
                <p class="card-text" style="font-size: 12px;">Phone Number: {{ $user->country_code }} {{ $user->phone_number }}</p>
                <p class="card-text" style="font-size: 12px;">Email: {{ $user->email_id }}</p>
                <p class="card-text" style="font-size: 12px;">Date of Birth: {{ $user->dob }}</p>
                <p class="card-text" style="font-size: 12px;">Bio: {{ $user->bio }}</p>
                <p class="card-text" style="font-size: 12px;">Characteristics: {{ $user->characteristics }}</p>
            </div>
        </div>
    </div>

    <!-- Followers name card -->

    <div class="col-lg-3">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="search-box">
                        <h5 class="mb-3">User's Follower Info</h5>
                        <div class="position-relative px-2">
                        </div>
                    </div>
                    <div class="mt-5">
                        <h6 class="mb-3">Name of User's Follower:</h6>
                        <ul class="list-unstyled fw-medium px-2">

                        @foreach($followers as $follower)
                            <li class="text-body py-2 border-bottom">{{ $follower->email_id }}</li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div> <!-- end card -->
        </div>
    </div>

    <!-- Posts Card -->

    <div class="col-lg-9">
        <div class="card">
            <div class="row g-0 align-items-center">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img class="card-img img-fluid" src="assets/images/small/img-3.jpg" alt="Card image">
                </div>
            </div>
        </div>
    </div><!-- end col -->
</div> <!-- end row -->
