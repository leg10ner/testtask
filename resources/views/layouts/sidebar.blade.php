<div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">

            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ (request()->routeIs('home')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('companies') }}" class="nav-link {{ (request()->routeIs('companies')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-building"></i>
                    <p>Companies</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('employees') }}" class="nav-link {{ (request()->routeIs('employees')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Employees</p>
                </a>
            </li>
        </ul>
    </nav>
</div>
