<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3">
            Hollydice Palace
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    @if(Auth::user()->role->permission->whereIn('id', [1, 2, 3, 4])->count() > 0)
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User
    </div>

    <!-- Nav Item - Charts -->
    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users') }}">
            <i class="fas fa-users"></i>
            <span>Users</span>
        </a>
    </li>
    @endif

    @if(Auth::user()->role->permission->contains('id', 5))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('deleted-users') }}">
            <i class="fas fa-users"></i>
            <span>Deleted Users</span>
        </a>
    </li>
    @endif

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
        Role and Permission Management
     </div>

    <!-- Nav Item - Tables -->
    @if(Auth::user()->role->permission->whereIn('id', [6, 7, 8, 9])->count() > 0)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('roles') }}">
            <i class="fas fa-user-tie"></i>
            <span>Roles</span>
        </a>
    </li>
    @endif

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('permissions') }}">
            <i class="fas fa-tools"></i>
            <span>Permissions</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @if(Auth::user()->role->permission->contains('id', 10))
    <!-- Heading -->
    <div class="sidebar-heading">
       Gitlab
    </div>

   <!-- Nav Item - Tables -->
   <li class="nav-item">
       <a class="nav-link" href="{{ route('repositories') }}">
            <i class="fas fa-book"></i>
           <span>Repositories</span>
        </a>
   </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
