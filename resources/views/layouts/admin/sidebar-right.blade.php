<!-- Control Sidebar -->
@if (Auth::guard('admin')->check())
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="user-panel mt-3 pb-3 d-flex">
            <div class="image">
                <img src="{{ asset('/assets/admin-assets/img/zubayer.jpg') }}" class="img-circle elevation-2" alt="{{ Auth::guard('admin')->user()->name }}">
            </div>
            <div class="info">
                <a href="#" class="d-block">Zubayer Ahamed</a>
            </div>
        </div>

        <div class="p-3">
            <a href="{{ url(route('admin.logout')) }}">Logout</a>
        </div>
    </aside>
@endif
