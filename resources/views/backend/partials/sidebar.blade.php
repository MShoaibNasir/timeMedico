<style>
    .sidebar-brand {

        background: white !important;
    }
</style>

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <a href="{{ url('/manager') }}" class="brand-link">
            <img src="{{ asset('frontend/images/logo/timemedico.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow">

        </a>
    </div>
    <div class="sidebar-wrapper">
        @if (Auth::guard('admin')->check())
        <form id="logout-form" action="{{ route('manager.logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        @endif
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/manager') }}" class="nav-link"><i class="nav-icon fa-solid fa-house"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @canany(['admin-create', 'admin-list', 'role-create', 'role-list'])
                <li class="nav-item">
                    <a href="#" class="nav-link"> <i class="nav-icon fa-solid fa-user"></i>
                        <p>Authentication<i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('admin-create')
                        <li class="nav-item">
                            <a href="{{ route('manager.users.create') }}" class="nav-link"> <i
                                    class="nav-icon far fa-circle"></i>
                                <p>Add Admin User</p>
                            </a>
                        </li>
                        @endcan
                        @can('admin-list')
                        <li class="nav-item">
                            <a href="{{ route('manager.users.index') }}" class="nav-link"> <i
                                    class="nav-icon far fa-circle"></i>
                                <p>Manage Admin Users</p>
                            </a>
                        </li>
                        @endcan
                        @can('role-create')
                        <li class="nav-item">
                            <a href="{{ route('manager.roles.create') }}" class="nav-link"> <i
                                    class="nav-icon far fa-circle"></i>
                                <p>Add Role</p>
                            </a>
                        </li>
                        @endcan
                        @can('role-list')
                        <li class="nav-item">
                            <a href="{{ route('manager.roles.index') }}" class="nav-link"> <i
                                    class="nav-icon far fa-circle"></i>
                                <p>Manage Roles</p>
                            </a>
                        </li>
                        @endcan
                        @can('permission-create')
                        <li class="nav-item">
                            <a href="{{ route('manager.permissions.create') }}" class="nav-link"> <i
                                    class="nav-icon far fa-circle"></i>
                                <p>Add Permissions</p>
                            </a>
                        </li>
                        @endcan
                        @can('permission-list')
                        <li class="nav-item">
                            <a href="{{ route('manager.permissions.index') }}" class="nav-link"> <i
                                    class="nav-icon far fa-circle"></i>
                                <p>Manage Permissions</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                @canany(['department-create', 'department-list'])
                <li class="nav-item">
                    <a href="#" class="nav-link"> <i class="nav-icon fa-solid fa-user"></i>
                        <p>Department <br> Management<i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('department-create')
                        <li class="nav-item">
                            <a href="{{ route('manager.department.create') }}" class="nav-link"> <i
                                    class="nav-icon far fa-circle"></i>
                                <p>Add Department</p>
                            </a>
                        </li>
                        @endcan
                        @can('department-list')
                        <li class="nav-item">
                            <a href="{{ route('manager.department.index') }}" class="nav-link"> <i
                                    class="nav-icon far fa-circle"></i>
                                <p>Manage Department</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany
                @canany(['category-create', 'category-list'])
                <li class="nav-item">
                    <a href="#" class="nav-link"> <i class="nav-icon fa-solid fa-user"></i>
                        <p>Category <br> Management<i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('category-create')
                        <li class="nav-item">
                            <a href="{{ route('manager.category.create') }}" class="nav-link"> <i
                                    class="nav-icon far fa-circle"></i>
                                <p>Add Category</p>
                            </a>
                        </li>
                        @endcan
                        @can('category-list')
                        <li class="nav-item">
                            <a href="{{ route('manager.category.index') }}" class="nav-link"> <i
                                    class="nav-icon far fa-circle"></i>
                                <p>Manage Category</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                @canany(['product-create', 'product-list'])
                <li class="nav-item">
                    <a href="#" class="nav-link"> <i class="nav-icon fa-solid fa-user"></i>
                        <p>Product <br> Management<i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('product-create')
                        <li class="nav-item">
                            <a href="{{ route('manager.product.create') }}" class="nav-link"> <i
                                    class="nav-icon far fa-circle"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                        @endcan
                        @can('product-list')
                        <li class="nav-item">
                            <a href="{{ route('manager.product.filter') }}" class="nav-link"> <i
                                    class="nav-icon far fa-circle"></i>
                                <p>Manage Product</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany
                @canany(['slider-create', 'slider-list'])
                <li class="nav-item">
                    <a href="#" class="nav-link"> <i class="nav-icon fa-solid fa-user"></i>
                        <p>Slider <br> Management<i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('slider-create')
                        <li class="nav-item">
                            <a href="{{ route('manager.slider.create') }}" class="nav-link"> <i
                                    class="nav-icon far fa-circle"></i>
                                <p>Add Slider</p>
                            </a>
                        </li>
                        @endcan
                        @can('slider-list')
                        <li class="nav-item">
                            <a href="{{ route('manager.slider.index') }}" class="nav-link"> <i
                                    class="nav-icon far fa-circle"></i>
                                <p>Manage Slider</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany
                <li class="nav-item">
                    <a href="{{ route('manager.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="nav-link"> <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>