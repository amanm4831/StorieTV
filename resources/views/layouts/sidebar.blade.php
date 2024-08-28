<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Users</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{route('users')}}">
                                <span data-key="t-calendar">User</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('user.stats')}}">
                                <span data-key="t-calendar">User Stats</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Blogs</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{route('blogs')}}">
                                <span data-key="t-calendar">Create Blog</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('editor')}}">
                                <span data-key="t-calendar">Blog Editor</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Event</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{route('event')}}">
                                <span data-key="t-calendar">Event Create</span>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>