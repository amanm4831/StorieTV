@extends('layouts.main')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css" />
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Blogs</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-sm-flex align-items-center justify-content-between">
                                <h4 class="card-title">Blogs</h4>
                                <button type="button" data-id="1"
                                    class="btn btn-primary waves-effect waves-light blog-details">
                                    <i class="bx bx-smile font-size-16 align-middle me-2"></i> Create
                                </button>
                            </div>

                            <!-- Modal for Creating -->
                            <div id="exampleModalFullscreen" class="modal fade" tabindex="-1"
                                aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
                                <div class="modal-dialog modal-fullscreen">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalFullscreenLabel">Fullscreen Modal</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form content will be loaded here via AJAX -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary waves-effect"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </div>
                        <!-- end card -->
                    </div> <!-- end col -->
                </div> <!-- end row -->

                <div class="row">
                    @foreach ($blogDetails as $blogDetail)
                        <div class="col-md-4">
                            <a href="#" class="card blog-card" data-id="{{ $blogDetail->blog_id }}">
                                <img class="card-img-top img-fluid" src="{{url('assets/images/small/img-2.jpg')}}"
                                    alt="Card image">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h4 class="card-title">{{ $blogDetail->title }}</h4>
                                        <div class="dropdown">
                                            <a class="text-dark" href="#" role="button" id="dropdownMenuLink"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li>
                                                    <form action="{{ route('blogs.destroy', $blogDetail->blog_id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Are you sure you want to delete this event?');">Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p class="card-text">{{ $blogDetail->description }}</p>
                                    <div class="mt-auto d-flex justify-content-between text-muted opacity-75">
                                        <div>
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ \Carbon\Carbon::parse($blogDetail->created_datetime)->format('Y-m-d') }}
                                        </div>
                                        <div>
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $blogDetail->updated_datetime }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                    <!-- Modal for showing blog -->
                    <div class="modal fade bs-example-modal-lg" id="blog-show" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myLargeModalLabel">Blog Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Blog content will be loaded here via AJAX -->
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>

                <!-- Custom Pagination Links -->
                {{ $blogDetails->links('vendors.pagination.custom') }}
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
@endsection

@section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        $(document).ready(function() {
            // Handle creating new blog details
            $(document).on('click', '.blog-details', function() {
                var user_id = $(this).data('id');
                if (user_id != '') {
                    $.ajax({
                        type: 'GET',
                        url: '/blog-form',
                        success: function(response) {
                            $('#exampleModalFullscreen').modal('show');
                            $('.modal-body').html(response);

                            // Initialize Choices.js
                            var multipleCancelButton = new Choices('#categories', {
                                removeItemButton: true,
                                maxItemCount: 5,
                                searchResultLimit: 5,
                                renderChoiceLimit: 5
                            });

                            // Initialize Quill.js
                            const quill = new Quill('#editor-container', {
                                theme: 'snow'
                            });

                            // Ensure the form submission includes Quill.js content
                            const form = document.querySelector('form');
                            form.onsubmit = function() {
                                const blogContent = document.querySelector(
                                    'input[name=blog_content]');
                                blogContent.value = quill.root.innerHTML;
                            };

                            // Handle blog type selection
                            document.getElementById('blog-type').addEventListener('change',
                                function() {
                                    var blogType = this.value;
                                    var textContent = document.getElementById(
                                        'text-content');
                                    var videoContent = document.getElementById(
                                        'video-content');
                                    if (blogType === 'T') {
                                        textContent.style.display = 'block';
                                        videoContent.style.display = 'none';
                                    } else if (blogType === 'V') {
                                        textContent.style.display = 'none';
                                        videoContent.style.display = 'block';
                                    }
                                });

                            // Word count for description
                            const textarea = document.getElementById('description');
                            const wordCountDiv = document.getElementById('word-count');
                            const maxWords = 200;

                            textarea.addEventListener('input', function() {
                                const words = this.value.split(/\s+/).filter(word =>
                                    word.length > 0);
                                const wordCount = words.length;

                                if (wordCount > maxWords) {
                                    const trimmedWords = words.slice(0, maxWords);
                                    this.value = trimmedWords.join(' ');
                                    wordCountDiv.innerText =
                                        `${maxWords}/${maxWords} words`;
                                } else {
                                    wordCountDiv.innerText =
                                        `${wordCount}/${maxWords} words`;
                                }
                            });
                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });

            // Handle showing blog details
            $(document).on('click', '.blog-card', function() {
                var blog_id = $(this).data('id');
                if (blog_id != '') {
                   
                    $.ajax({
                        type: 'GET',
                    url: '/blog-show/${blog_id}',
                                      
                        success: function(response) {
                            $('#blog-show').modal('show');
                            $('.modal-body').html(response);
                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });

            // Handle blog creation form submission
            $(document).on('submit', '#blogCreateForm', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $('#exampleModalFullscreen').modal('hide');
                            // Optionally refresh the page or update the blog list
                        }
                    },
                    error: function(response) {
                        alert('There was an error with your request.');
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endsection