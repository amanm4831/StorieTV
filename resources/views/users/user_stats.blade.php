<!-- resources/views/user_stats.blade.php -->
@extends('layouts.main')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">User Statistics</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                <li class="breadcrumb-item active">Statistics</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">User Statistics</h4>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Total Followers</th>
                                        <th>Total Following</th>
                                        <th>Total Collaborations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->email_id }}</td>
                                        <td><a href="javascript:void(0);" onclick="showUserDetails('followers', {{ $user->user_id }})">{{ $user->total_followers }}</a></td>
                                        <td><a href="javascript:void(0);" onclick="showUserDetails('following', {{ $user->user_id }})">{{ $user->total_following }}</a></td>
                                        <td>{{ $user->total_collabs }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>

@endsection

@section('javascript')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
@endsection

