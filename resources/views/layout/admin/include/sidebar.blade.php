<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('asset_admin/images/faces/face1.jpg') }}" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{auth()->user()->name}}</span>
                    <span class="text-secondary text-small">Admin</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.dashboard')}}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <span class="menu-title">Master</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">

                    <li class="nav-item"> <a class="nav-link" href="{{route('admin.get.banner')}}">Banner</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin.get.blog.by.id')}}">Blog</a></li>   
                    <li class="nav-item"> <a class="nav-link"  href="{{route('admin.get.gallery')}}">Gallery</a></li>

                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#course-management" aria-expanded="false">
              <span class="menu-title">Course Management</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-book menu-icon"></i>
            </a>
            <div class="collapse" id="course-management">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.course.management.board.all')}}">Examination Board</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.course.management.class.all')}}">Classes</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.course.management.subject.all')}}">Subjects</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.course.management.lesson.all')}}">Lesson</a></li>
              </ul>
            </div>
        </li>
        {{-- <li class="nav-item {{ (request()->routeIs('admin.create.course')) ? 'active' : '' }}">
            <a class="nav-link" href="{{route('admin.get.course')}}">
                <span class="menu-title">Course</span>
                <i class="mdi mdi-book menu-icon"></i>
            </a>
        </li> --}}
        <li class="nav-item {{ (request()->routeIs('admin.insert.mcq.question')) ? 'active' : '' }}">
            <a class="nav-link" href="{{route('admin.index.multiple.choice')}}"><span class="menu-title">MCQ's</span>
                <i class="mdi  mdi-format-list-bulleted menu-icon"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('website.get.report.knowledge.post')}}"><span class="menu-title">Reported Posts</span>
                <i class="mdi  mdi-alert menu-icon"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('website.blog.report.get')}}"><span class="menu-title">Reported Blogs</span>
                <i class="mdi  mdi-alert menu-icon"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.get.enrolled.students')}}"><span class="menu-title">Enrolled Students</span>
                <i class="mdi  mdi-account-multiple menu-icon"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.get.enquiry.details')}}"><span class="menu-title">Enquiry Details</span>
                <i class="mdi mdi-account-network menu-icon"></i></a>
        </li>
        <li class="nav-item {{ (request()->routeIs('admin.create.time.table')) ? 'active' : '' }}">
            <a class="nav-link" href="{{route('admin.view.time.table')}}"><span class="menu-title">Time-Table</span>
                <i class="mdi  mdi-calendar-clock menu-icon"></i></a>
        </li>
    </ul>
</nav>
