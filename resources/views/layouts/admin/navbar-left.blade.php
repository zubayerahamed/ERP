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
        <li class="nav-item {{ Request::is('admin/post**') || Request::is('admin/category**') || Request::is('admin/tag**') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('admin/post**') || Request::is('admin/category**') || Request::is('admin/tag**') ? 'active' : '' }}">
                <i class="fas fa-pencil-alt nav-icon"></i>
                <p>
                    Posts
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('post') }}" class="nav-link {{ Route::currentRouteName() == 'post' ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>All Posts</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('post.add-new') }}" class="nav-link {{ Route::currentRouteName() == 'post.add-new' ? 'active' : '' }}">
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
                {{-- <li class="nav-item">
                    <a href="{{ route('tag.page') }}" class="nav-link {{ Route::currentRouteName() == 'tag.page' ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Tags</p>
                    </a>
                </li> --}}
            </ul>

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
        <li class="nav-item {{ Request::is('admin/media**') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('admin/media**') ? 'active' : '' }}">
                <i class="fas fa-photo-video nav-icon"></i>
                <p>
                    Media
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('media') }}" class="nav-link {{ Route::currentRouteName() == 'media' ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Library</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('media.add-new') }}" class="nav-link {{ Route::currentRouteName() == 'media.add-new' ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Add New</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('business.page') }}" class="nav-link {{ Route::currentRouteName() == 'business.page' || Route::currentRouteName() == 'outlet.page' || Route::currentRouteName() == 'shop.page' || Route::currentRouteName() == 'counter.page' ? 'active' : '' }}">
                <i class="fas fa-briefcase nav-icon"></i>
                <p>
                    Business
                </p>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/role**') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('admin/media**') ? 'active' : '' }}">
                <i class="fas fa-users-cog nav-icon"></i>
                <p>
                    Manage User
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('adminuser.list') }}" class="nav-link {{ Route::currentRouteName() == 'adminuser.list' ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>All Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('adminuser.add-new') }}" class="nav-link {{ Route::currentRouteName() == 'adminuser.add-new' ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Add New User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('role.list') }}" class="nav-link {{ Route::currentRouteName() == 'role.list' ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('role.add-new') }}" class="nav-link {{ Route::currentRouteName() == 'role.add-new' ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Add New Role</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cg.page') }}" class="nav-link {{ Route::currentRouteName() == 'cg.page' ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Capabilities Group</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
