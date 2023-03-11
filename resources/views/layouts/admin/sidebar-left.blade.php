<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('/assets/admin-assets/img/logo.png') }}" alt="KIT Admin" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">KIT Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar-menu -->
        @include('layouts.admin.navbar-left')
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
