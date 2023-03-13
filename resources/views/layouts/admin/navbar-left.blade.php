<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/term**') || Request::is('admin/attribute**') || Request::is('admin/product**') || Request::is('admin/category**') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('admin/term**') || Request::is('admin/attribute**') || Request::is('admin/product**') || Request::is('admin/category**') ? 'active' : '' }}">
                <i class="nav-icon fas fa-box"></i>
                <p>
                    Products
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('product.list') }}" class="nav-link {{ Route::currentRouteName() == 'product.list' ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>All Products</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product.add-new') }}" class="nav-link {{ Route::currentRouteName() == 'product.add-new' ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Add New</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.page') }}" class="nav-link {{ Route::currentRouteName() == 'category.page' ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../index3.html" class="nav-link">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Tags</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('attribute.page') }}" class="nav-link {{ Route::currentRouteName() == 'attribute.page' ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Attributes</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
