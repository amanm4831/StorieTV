<form id="blogCreateForm" action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="title">Blog Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Blog's title">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="blog-type">Blog Type</label>
                    <select class="form-control" id="blog-type" name="blog_type">
                        <option value="T">Text</option>
                        <option value="V">Video</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="categories" class="form-label">Categories</label>
                    <select class="form-control choices" name="categories[]" id="categories" multiple>
                        <option value="Choice 1">Choice 1</option>
                        <option value="Choice 2">Choice 2</option>
                        <option value="Choice 3">Choice 3</option>
                        <option value="Choice 4">Choice 4</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="is-premium">Is Premium</label>
                    <select class="form-control" id="is-premium" name="is_premium">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div id="text-content" class="col-md-6">
            <div class="mb-3">
                <label for="editor-container" class="col-form-label">Content</label>
                <div>
                    <div id="editor-container" style="height: 80px;"></div>
                    <input type="hidden" name="blog_content" id="hidden-blog-content">
                </div>
            </div>
        </div>
        <div id="video-content" class="col-md-6" style="display: none;">
            <div class="mb-3">
                <label for="media-upload" class="col-form-label">Upload Video</label>
                <div>
                    <input name="file" id="media-upload" type="file" accept="video/*">
                    <div class="dz-message needsclick">
                        <div class="mb-4">
                            <i class="display-4 text-muted bx bx-cloud-upload"></i>
                        </div>
                        <h5>Drop files here or click to upload.</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label" for="description">Description</label>
                <textarea class="form-control" id="description" rows="5" placeholder="Enter your Blog Description" name="description"></textarea>
                <div id="word-count">0/200 words</div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <input type="hidden" name="status" id="statusField"> <!-- Hidden field for status -->
        <button type="button" class="btn btn-secondary" onclick="saveAsDraft()">Save as Draft</button>
        <button type="button" class="btn btn-primary" onclick="submitForApproval()">Submit for Approval</button>
    </div>
</form>

<script>
    // Toggle content type display based on blog type selection
    document.getElementById('blog-type').addEventListener('change', function() {
        var blogType = this.value;
        var textContent = document.getElementById('text-content');
        var videoContent = document.getElementById('video-content');
        if (blogType === 'T') {
            textContent.style.display = 'block';
            videoContent.style.display = 'none';
        } else if (blogType === 'V') {
            textContent.style.display = 'none';
            videoContent.style.display = 'block';
        }
    });

    // Word count functionality for description
    const textarea = document.getElementById('description');
    const wordCountDiv = document.getElementById('word-count');
    const maxWords = 200;

    textarea.addEventListener('input', function() {
        const words = this.value.split(/\s+/).filter(word => word.length > 0);
        const wordCount = words.length;

        if (wordCount > maxWords) {
            const trimmedWords = words.slice(0, maxWords);
            this.value = trimmedWords.join(' ');
            wordCountDiv.innerText = `${maxWords}/${maxWords} words`;
        } else {
            wordCountDiv.innerText = `${wordCount}/${maxWords} words`;
        }
    });

    // Handling Quill editor content
    // const quill = new Quill('#editor-container', { theme: 'snow' });

    const form = document.getElementById('blogCreateForm');
    form.onsubmit = function() {
        const blogContent = document.querySelector('input[name=blog_content]');
        // blogContent.value = quill.root.innerHTML;
    };

    // Handle saving as draft
    function saveAsDraft() {
        document.getElementById('statusField').value = 1;
        form.submit(); 
    }

    // Handle submitting for approval
    function submitForApproval() {
        document.getElementById('statusField').value = 2; 
        form.submit(); 
    }

    // Initialize Choices.js for categories
    document.addEventListener('DOMContentLoaded', function() {
        var multipleCancelButton = new Choices('#categories', {
            removeItemButton: true,
            maxItemCount: 5,
            searchResultLimit: 5,
            renderChoiceLimit: 5
        });
    });
</script>