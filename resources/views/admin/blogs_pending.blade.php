@extends('layouts.main')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pending Blogs</h4>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Posted by</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                           
                                @foreach($blogs as $blog)
                              
                                 
                                <tr>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->posted_by }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="text-dark" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                                {{-- <li><a class="dropdown-item" href="{{ route('admin.blogs.show', $blog->blog_id) }}" >View</a></li> --}}
                                                {{-- <li> --}}
                                                    <a class="dropdown-item" href="{{ route('blogs.approve', $blog->blog_id) }}" >Approve</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('blogs.reject', $blog->blog_id) }}" >Reject</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                
                                
                                @endforeach
                                        
                                   
                                
                            </tbody>
                                        
                        </table>
    
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>
@endsection
