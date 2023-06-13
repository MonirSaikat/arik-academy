<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center text-light" href="">
        <div class="sidebar-brand-icon">
            <img src="img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3"><span class="small">School Management</span></div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link {{ Request::is('setting*') ? '' : 'collapsed' }}" active
            href="{{ route('backend.student.dashboard') }}">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>{{ __('sidebar.dashboard') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('setting*') ? '' : 'collapsed' }}" active
            href="{{ route('backend.student.dashboard.profile') }}">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>{{ __('sidebar.profile') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('setting*') ? '' : 'collapsed' }}" active
            href="{{ route('backend.student.dashboard.fees') }}">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>{{ __('sidebar.fee_list') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('student/homework*') ? '' : 'collapsed' }}" active
            href="{{ route('students.homework') }}">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>{{ __('sidebar.homework') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('setting*') ? '' : 'collapsed' }}" active href="{{ route('logout') }}">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <input type="submit" value="Logout">
            </form>
        </a>
    </li>




</ul>
