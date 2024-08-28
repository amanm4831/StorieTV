<form action="" method="POST">
    @csrf
    <div>
        <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Form groups</h5>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Personal Info</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="formrow-firstname-input">First Name</label>
                                    <input type="text" class="form-control" id="formrow-firstname-input" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="formrow-secondname-input">Second Name</label>
                                    <input type="text" class="form-control" id="formrow-secondname-input" placeholder="Enter Name">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Event Info</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="editor-rules">Rules</label>
                                    <div class="col-sm-12">
                                        <div id="editor-rules"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="editor-prize">Prize</label>
                                    <div class="col-sm-12">
                                        <div id="editor-prize"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0"> Event Description & Media</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="editor-rules">Description</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" id="formrow-description-input" placeholder="Enter the description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="editor-prize">Upload Media</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control" id="formrow-media-input">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentDate = new Date().toISOString().split('T')[0];
        document.getElementById('formrow-startdate-input').value = currentDate;
    });

    const quillEditor1 = new Quill('#editor-rules', {
        theme: 'snow'
    });
    const quillEditor2 = new Quill('#editor-prize', {
        theme: 'snow'
    });
</script>
