@extends('layouts.main')
@section('content')   

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <!-- Page Title Here -->
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">User Info</h4>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Profile Picture</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>                        
                                    @foreach($admins as $admin)
                                            <tr>
                                                <td>{{ $admin->admin_name }}</td>
                                                <td>{{ $admin->admin_id }}</td>
                                                <td>{{ $admin->email_address }}</td>
                                                <td>
                                                    <img src="{{ $admin->profile_pic }}" alt="Profile Picture" style="width: 50px; height: 50px;">
                                                </td>
                                                <td>{{ $admin->admin_type}}</td>
                                                <td>{{ $admin->is_active }}</td>
                                            </tr>
                                    @endforeach
                                </tbody>
                                            
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
</div><!-- End Page-content -->

@endsection

