<!doctype html>
<html lang="en">

    
<!-- Mirrored from themesbrand.com/minia/layouts/form-advanced.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 01 Jun 2023 05:22:36 GMT -->
<head>
        
        <meta charset="utf-8" />
        <title>Forms Advanced Plugins | Minia - Minimal Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- choices css -->
        <link href="assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

        
        <!-- datepicker css -->
        <link rel="stylesheet" href="assets/libs/flatpickr/flatpickr.min.css">

        <!-- preloader css -->
        <link rel="stylesheet" href="assets/css/preloader.min.css" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            

            <!-- ========== Left Sidebar Start ========== -->
            

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <form action="" method="POST">
                            @csrf <!-- Include CSRF token for security -->
                            <div class="row mb-4">
                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Blog Title</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="horizontal-firstname-input" placeholder="Enter your Blog's Title"
                                        name="Blog Title">
                                </div>
                            </div>
                        
                            <div>
                                
                        
                        
                            <div class="mt-4">
                                <h5 class="font-size-14 mb-3">Multiple select input</h5>
                        
                                <div class="row">
                                    
                        
                                    {{-- <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="choices-multiple-remove-button" class="form-label font-size-13 text-muted">With
                                                remove button</label>
                                            <select class="form-control" name="choices-multiple-remove-button"
                                                id="choices-multiple-remove-button"
                                                placeholder="This is a placeholder" multiple>
                                                <option value="Choice 1" selected>Choice 1</option>
                                                <option value="Choice 2">Choice 2</option>
                                                <option value="Choice 3">Choice 3</option>
                                                <option value="Choice 4">Choice 4</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="container mt-5">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Multi-Select with Remove Button</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="multi-select-remove" class="form-label">Select Options</label>
                                                    <select class="form-control" id="multi-select-remove" multiple>
                                                        <option value="Choice 1" selected>Choice 1</option>
                                                        <option value="Choice 2">Choice 2</option>
                                                        <option value="Choice 3">Choice 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                    
                        
                                </div>
                                <!-- end row -->
                            </div>
                        
                        
                            <div class="row">
                                <div>
                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Upload Image</label>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                        
                                            <div>
                                                <form action="#" class="dropzone">
                                                    <div class="fallback">
                                                        <input name="file" type="file" multiple="multiple">
                                                    </div>
                                                    <div class="dz-message needsclick">
                                                        <div class="mb-3">
                                                            <i class="display-4 text-muted bx bx-cloud-upload"></i>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                        
                                            {{-- <div class="text-center mt-4">
                                                <button type="button" class="btn btn-primary waves-effect waves-light">Send
                                                    Files</button>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            {{-- <div class="row mb-4">
                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="horizontal-password-input" placeholder="Enter your password" name="password">
                                </div>
                            </div> --}}
                        
                            <div class="row justify-content-end">
                                <div class="col-sm-9">
                                    {{-- <div class="form-check mb-4">
                                        <input type="checkbox" class="form-check-input" id="horizontal-customCheck" name="remember">
                                        <label class="form-check-label" for="horizontal-customCheck">Remember me</label>
                                    </div> --}}
                        
                                    <div>
                                        {{-- <a href="{{ route('editor') }}"> --}}
                                            {{-- <button type="button" class="btn btn-primary w-md">Submit</button>
                                        </a> --}}
                                    </div>
                                </div>
                            </div>
                        </form>
                     

                       

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Choices</h4>
                                        <p class="card-title-desc">Choices.js is a lightweight, configurable select box/text input plugin.</p>
                                    </div>
                                    <!-- end card header -->

                                    <div class="card-body">
                                        <div>
                                            <h5 class="font-size-14 mb-3">Single select input Example</h5>

                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="choices-single-default" class="form-label font-size-13 text-muted">Default</label>
                                                        <select class="form-control" data-trigger name="choices-single-default"
                                                            id="choices-single-default"
                                                            placeholder="This is a search placeholder">
                                                            <option value="">This is a placeholder</option>
                                                            <option value="Choice 1">Choice 1</option>
                                                            <option value="Choice 2">Choice 2</option>
                                                            <option value="Choice 3">Choice 3</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="choices-single-groups" class="form-label font-size-13 text-muted">Option
                                                            groups</label>
                                                        <select class="form-control" data-trigger name="choices-single-groups"
                                                            id="choices-single-groups">
                                                            <option value="">Choose a city</option>
                                                            <optgroup label="UK">
                                                                <option value="London">London</option>
                                                                <option value="Manchester">Manchester</option>
                                                                <option value="Liverpool">Liverpool</option>
                                                            </optgroup>
                                                            <optgroup label="FR">
                                                                <option value="Paris">Paris</option>
                                                                <option value="Lyon">Lyon</option>
                                                                <option value="Marseille">Marseille</option>
                                                            </optgroup>
                                                            <optgroup label="DE" disabled>
                                                                <option value="Hamburg">Hamburg</option>
                                                                <option value="Munich">Munich</option>
                                                                <option value="Berlin">Berlin</option>
                                                            </optgroup>
                                                            <optgroup label="US">
                                                                <option value="New York">New York</option>
                                                                <option value="Washington" disabled>Washington</option>
                                                                <option value="Michigan">Michigan</option>
                                                            </optgroup>
                                                            <optgroup label="SP">
                                                                <option value="Madrid">Madrid</option>
                                                                <option value="Barcelona">Barcelona</option>
                                                                <option value="Malaga">Malaga</option>
                                                            </optgroup>
                                                            <optgroup label="CA">
                                                                <option value="Montreal">Montreal</option>
                                                                <option value="Toronto">Toronto</option>
                                                                <option value="Vancouver">Vancouver</option>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="choices-single-no-search" class="form-label font-size-13 text-muted">Options added
                                                            via config with no search</label>
                                                        <select class="form-control" name="choices-single-no-search"
                                                            id="choices-single-no-search">
                                                            <option value="0">Zero</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="choices-single-no-sorting" class="form-label font-size-13 text-muted">Options added
                                                            via config with no search</label>
                                                        <select class="form-control" name="choices-single-no-sorting"
                                                            id="choices-single-no-sorting">
                                                            <option value="Madrid">Madrid</option>
                                                            <option value="Toronto">Toronto</option>
                                                            <option value="Vancouver">Vancouver</option>
                                                            <option value="London">London</option>
                                                            <option value="Manchester">Manchester</option>
                                                            <option value="Liverpool">Liverpool</option>
                                                            <option value="Paris">Paris</option>
                                                            <option value="Malaga">Malaga</option>
                                                            <option value="Washington" disabled>Washington</option>
                                                            <option value="Lyon">Lyon</option>
                                                            <option value="Marseille">Marseille</option>
                                                            <option value="Hamburg">Hamburg</option>
                                                            <option value="Munich">Munich</option>
                                                            <option value="Barcelona">Barcelona</option>
                                                            <option value="Berlin">Berlin</option>
                                                            <option value="Montreal">Montreal</option>
                                                            <option value="New York">New York</option>
                                                            <option value="Michigan">Michigan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end row -->
                                        </div>
                                        <!-- Single select input Example -->


                                        <div class="mt-4">
                                            <h5 class="font-size-14 mb-3">Multiple select input</h5>
    
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="choices-multiple-default" class="form-label font-size-13 text-muted">Default</label>
                                                        <select class="form-control" data-trigger
                                                            name="choices-multiple-default" id="choices-multiple-default"
                                                            placeholder="This is a placeholder" multiple>
                                                            <option value="Choice 1" selected>Choice 1</option>
                                                            <option value="Choice 2">Choice 2</option>
                                                            <option value="Choice 3">Choice 3</option>
                                                            <option value="Choice 4" disabled>Choice 4</option>
                                                        </select>
                                                    </div>
                                                </div>
    
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="choices-multiple-remove-button" class="form-label font-size-13 text-muted">With
                                                            remove button</label>
                                                        <select class="form-control" name="choices-multiple-remove-button"
                                                            id="choices-multiple-remove-button"
                                                            placeholder="This is a placeholder" multiple>
                                                            <option value="Choice 1" selected>Choice 1</option>
                                                            <option value="Choice 2">Choice 2</option>
                                                            <option value="Choice 3">Choice 3</option>
                                                            <option value="Choice 4">Choice 4</option>
                                                        </select>
                                                    </div>
                                                </div>
    
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="choices-multiple-groups" class="form-label font-size-13 text-muted">Option
                                                            groups</label>
                                                        <select class="form-control" name="choices-multiple-groups"
                                                            id="choices-multiple-groups" placeholder="This is a placeholder"
                                                            multiple>
                                                            <option value="">Choose a city</option>
                                                            <optgroup label="UK">
                                                                <option value="London">London</option>
                                                                <option value="Manchester">Manchester</option>
                                                                <option value="Liverpool">Liverpool</option>
                                                            </optgroup>
                                                            <optgroup label="FR">
                                                                <option value="Paris">Paris</option>
                                                                <option value="Lyon">Lyon</option>
                                                                <option value="Marseille">Marseille</option>
                                                            </optgroup>
                                                            <optgroup label="DE" disabled>
                                                                <option value="Hamburg">Hamburg</option>
                                                                <option value="Munich">Munich</option>
                                                                <option value="Berlin">Berlin</option>
                                                            </optgroup>
                                                            <optgroup label="US">
                                                                <option value="New York">New York</option>
                                                                <option value="Washington" disabled>Washington</option>
                                                                <option value="Michigan">Michigan</option>
                                                            </optgroup>
                                                            <optgroup label="SP">
                                                                <option value="Madrid">Madrid</option>
                                                                <option value="Barcelona">Barcelona</option>
                                                                <option value="Malaga">Malaga</option>
                                                            </optgroup>
                                                            <optgroup label="CA">
                                                                <option value="Montreal">Montreal</option>
                                                                <option value="Toronto">Toronto</option>
                                                                <option value="Vancouver">Vancouver</option>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
    
                                            </div>
                                            <!-- end row -->
                                        </div>
                                        <!-- multi select input Example -->

                                        <div class="mt-4">
                                            <h5 class="font-size-14 mb-3">Text inputs</h5>
    
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="choices-text-remove-button" class="form-label font-size-13 text-muted">Limited to 5
                                                            values with remove button</label>
                                                        <input class="form-control" id="choices-text-remove-button" type="text"
                                                            value="Task-1,Task-2" placeholder="Enter something" />
                                                    </div>
                                                </div>
                                                <!-- end col -->
    
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="choices-text-unique-values" class="form-label font-size-13 text-muted">Unique values
                                                            only, no pasting</label>
                                                        <input class="form-control" id="choices-text-unique-values" type="text"
                                                            value="Project-A, Project-B" placeholder="This is a placeholder"
                                                            class="custom class" />
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            </div>
                                            <!-- end row -->
    
                                            <div>
                                                <label for="choices-text-disabled" class="form-label font-size-13 text-muted">Disabled</label>
                                                <input class="form-control" id="choices-text-disabled" type="text"
                                                    value="josh@joshuajohnson.co.uk, joe@bloggs.co.uk"
                                                    placeholder="This is a placeholder" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                     

                       
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Minia.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by <a href="#!" class="text-decoration-underline">Themesbrand</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        
        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center p-3">

                    <h5 class="m-0 me-2">Theme Customizer</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="m-0" />

                <div class="p-4">
                    <h6 class="mb-3">Layout</h6>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout"
                            id="layout-vertical" value="vertical">
                        <label class="form-check-label" for="layout-vertical">Vertical</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout"
                            id="layout-horizontal" value="horizontal">
                        <label class="form-check-label" for="layout-horizontal">Horizontal</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Mode</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode"
                            id="layout-mode-light" value="light">
                        <label class="form-check-label" for="layout-mode-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode"
                            id="layout-mode-dark" value="dark">
                        <label class="form-check-label" for="layout-mode-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Width</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width"
                            id="layout-width-fuild" value="fuild" onchange="document.body.setAttribute('data-layout-size', 'fluid')">
                        <label class="form-check-label" for="layout-width-fuild">Fluid</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width"
                            id="layout-width-boxed" value="boxed" onchange="document.body.setAttribute('data-layout-size', 'boxed')">
                        <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                            id="layout-position-fixed" value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                        <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                            id="layout-position-scrollable" value="scrollable" onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                        <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color"
                            id="topbar-color-light" value="light" onchange="document.body.setAttribute('data-topbar', 'light')">
                        <label class="form-check-label" for="topbar-color-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color"
                            id="topbar-color-dark" value="dark" onchange="document.body.setAttribute('data-topbar', 'dark')">
                        <label class="form-check-label" for="topbar-color-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Size</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-default" value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')">
                        <label class="form-check-label" for="sidebar-size-default">Default</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-compact" value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')">
                        <label class="form-check-label" for="sidebar-size-compact">Compact</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-small" value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')">
                        <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-light" value="light" onchange="document.body.setAttribute('data-sidebar', 'light')">
                        <label class="form-check-label" for="sidebar-color-light">Light</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-dark" value="dark" onchange="document.body.setAttribute('data-sidebar', 'dark')">
                        <label class="form-check-label" for="sidebar-color-dark">Dark</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-brand" value="brand" onchange="document.body.setAttribute('data-sidebar', 'brand')">
                        <label class="form-check-label" for="sidebar-color-brand">Brand</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Direction</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction"
                            id="layout-direction-ltr" value="ltr">
                        <label class="form-check-label" for="layout-direction-ltr">LTR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction"
                            id="layout-direction-rtl" value="rtl">
                        <label class="form-check-label" for="layout-direction-rtl">RTL</label>
                    </div>

                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>
        <!-- pace js -->
        <script src="assets/libs/pace-js/pace.min.js"></script>

        <!-- choices js -->
        <script src="assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

        <!-- color picker js -->
        <script src="assets/libs/%40simonwep/pickr/pickr.min.js"></script>
        <script src="assets/libs/%40simonwep/pickr/pickr.es5.min.js"></script>

        <!-- datepicker js -->
        <script src="assets/libs/flatpickr/flatpickr.min.js"></script>

        <!-- init js -->
        {{-- <script src="assets/js/pages/form-advanced.init.js"></script> --}}

        <script src="assets/js/app.js"></script>

    </body>
</html>