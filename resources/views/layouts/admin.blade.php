<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    @vite(['resources/css/app.css'])
    @stack('styles')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                @permission('dashboard.read')
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('admin.dashboard.index') }}" class="nav-link">{{ __('Dashboard') }}</a>
                    </li>
                @endpermission
            </ul>
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" data-widget="sidebar-search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}" target="_blank">
                        <i class="fas fa-globe"></i> View Site
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="javascript:void(0);" class="brand-link">
                {{-- <span class="brand-image">
                    {{ __('Foo') }}
                </span> --}}
                <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
            </a>

            <div class="sidebar">
                <!-- SidebarSearch Form -->
                <div class="form-inline mt-2 mb-3">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @permission('dashboard.read')
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard.index') }}" class="nav-link {{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>{{ __('Dashboard') }}</p>
                                </a>
                            </li>
                        @endpermission
                        @permission('roles.read')
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-shield-alt"></i>
                                    <p>{{ __('Roles') }}</p>
                                </a>
                            </li>
                        @endpermission
                        @permission('permissions.read')
                            <li class="nav-item">
                                <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-shield"></i>
                                    <p>{{ __('Permissions') }}</p>
                                </a>
                            </li>
                        @endpermission
                        @permission('users.read')
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>{{ __('Users') }}</p>
                                </a>
                            </li>
                        @endpermission
                        @permission('teams.read')
                            <li class="nav-item">
                                <a href="{{ route('admin.teams.index') }}" class="nav-link {{ request()->routeIs('admin.teams.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>{{ __('Team Members') }}</p>
                                </a>
                            </li>
                        @endpermission
                        @permission('brands.read')
                            <li class="nav-item">
                                <a href="{{ route('admin.brands.index') }}" class="nav-link {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tags"></i>
                                    <p>{{ __('Brands') }}</p>
                                </a>
                            </li>
                        @endpermission
                        @permission('contacts.read')
                            <li class="nav-item">
                                <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-envelope"></i>
                                    <p>
                                        {{ __('Contact Messages') }}
                                        @php
                                            $unreadCount = \App\Models\Contact::unread()->count();
                                        @endphp
                                        @if($unreadCount > 0)
                                            <span class="badge badge-warning right">{{ $unreadCount }}</span>
                                        @endif
                                    </p>
                                </a>
                            </li>
                        @endpermission
                        @permission('profile.read')
                            <li class="nav-item">
                                <a href="{{ route('profile.index') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>{{ __('My Profile') }}</p>
                                </a>
                            </li>
                        @endpermission
                        @permission('gallery_categories.read')
                            <li class="nav-item">
                                <a href="{{ route('admin.gallery-categories.index') }}" class="nav-link {{ request()->routeIs('admin.gallery-categories.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-folder"></i>
                                    <p>{{ __('Gallery Categories') }}</p>
                                </a>
                            </li>
                        @endpermission
                        @permission('galleries.read')
                            <li class="nav-item">
                                <a href="{{ route('admin.galleries.index') }}" class="nav-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-images"></i>
                                    <p>{{ __('Galleries') }}</p>
                                </a>
                            </li>
                        @endpermission
                        <li class="nav-item">
                            <a href="javascript:void(0);" id="logout-button" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>{{ __('Logout') }}</p>
                            </a>
                            <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">
                    @yield('main')
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2024 <a
                    href="{{ route('admin.dashboard.index') }}">{{ config('app.name') }}</a>.</strong>
            <span>{{ __('All rights reserved.') }}</span>
        </footer>
    </div>

    <script>
        window.jQuery = null;
        window.$ = null;
    </script>

    @vite(['resources/js/app.js'])
    @stack('scripts')

    <script>
        // Enable sidebar search
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.form-control-navbar');
            const menuItems = document.querySelectorAll('.nav-sidebar .nav-link');

            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();

                menuItems.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    const parent = item.closest('.nav-item');

                    if (text.includes(searchTerm)) {
                        parent.style.display = '';
                    } else {
                        parent.style.display = 'none';
                    }
                });
            });
        });
    </script>

</body>

</html>
