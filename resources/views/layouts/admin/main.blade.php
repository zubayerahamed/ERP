@include('layouts.admin.header')
@include('layouts.admin.sidebar-left')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    @stack('content-heading')

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                @yield('admin-main')

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('layouts.admin.sidebar-right')
@include('layouts.admin.footer')
