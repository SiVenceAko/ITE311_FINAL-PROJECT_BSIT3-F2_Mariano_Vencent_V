
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') | Victoria Safe</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="vs-admin">

    <div class="vs-admin-layout">

        <!-- Mobile Header -->
        <header class="vs-mobile-header">
            <a href="{{ route('statamic.cp.victoria-safe.dashboard') }}" class="vs-mobile-brand">
                <span class="vs-brand-icon">VS</span>

                <span class="vs-brand-text">
                    <strong>Victoria Safe</strong>
                    <span>Crime Mapping System</span>
                </span>
            </a>

            <button
                type="button"
                class="vs-mobile-menu-toggle"
                id="vsMobileMenuToggle"
                aria-label="Open navigation menu"
                aria-controls="vsSidebar"
                aria-expanded="false"
            >
                <span class="vs-hamburger-line"></span>
                <span class="vs-hamburger-line"></span>
                <span class="vs-hamburger-line"></span>
            </button>
        </header>

        <!-- Mobile Overlay -->
        <div class="vs-sidebar-overlay" id="vsSidebarOverlay"></div>

        <!-- Sidebar -->
        <aside class="vs-sidebar" id="vsSidebar">

            <div class="vs-brand">
                <div class="vs-brand-icon">VS</div>

                <div class="vs-brand-text">
                    <strong>Victoria Safe</strong>
                    <span>Crime Mapping System</span>
                </div>

                <button
                    type="button"
                    class="vs-sidebar-close"
                    id="vsSidebarClose"
                    aria-label="Close navigation menu"
                >
                    &times;
                </button>
            </div>

            <div class="vs-nav-separator"></div>

            <nav class="vs-sidebar-nav">

                <div class="vs-nav-section">
                                        <a href="{{ route('statamic.cp.victoria-safe.dashboard') }}"
                       class="vs-nav-link {{ request()->routeIs('statamic.cp.victoria-safe.dashboard') ? 'active' : '' }}">
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('statamic.cp.victoria-safe.crime-requests') }}"
                       class="vs-nav-link {{ request()->routeIs('statamic.cp.victoria-safe.crime-requests') ? 'active' : '' }}">
                        <span>Crime Requests</span>
                    </a>

                    <a href="{{ route('statamic.cp.victoria-safe.duplicate-review') }}"
                       class="vs-nav-link {{ request()->routeIs('statamic.cp.victoria-safe.duplicate-review') ? 'active' : '' }}">
                        <span>Duplicate Review</span>
                    </a>

                    <a href="{{ route('statamic.cp.victoria-safe.approved-incidents') }}"
                       class="vs-nav-link {{ request()->routeIs('statamic.cp.victoria-safe.approved-incidents') ? 'active' : '' }}">
                        <span>Approved Incidents</span>
                    </a>
                </div>

                <div class="vs-nav-section">
                                        <a href="{{ route('statamic.cp.victoria-safe.crime-map') }}"
                       class="vs-nav-link {{ request()->routeIs('statamic.cp.victoria-safe.crime-map') ? 'active' : '' }}">
                        <span>Crime Map</span>
                    </a>

                    <a href="{{ route('statamic.cp.victoria-safe.analytics') }}"
                       class="vs-nav-link {{ request()->routeIs('statamic.cp.victoria-safe.analytics') ? 'active' : '' }}">
                        <span>Analytics</span>
                    </a>
                </div>

                <div class="vs-nav-section">
                                        <a href="{{ cp_route('dashboard') }}" class="vs-nav-link">
                        <span>Content Management</span>
                    </a>
                </div>

            </nav>

            <div class="vs-nav-separator"></div>

            <div class="vs-sidebar-bottom">
                <a href="{{ cp_route('logout') }}" class="vs-back-link vs-logout-button">
                    <span>⏻</span>
                    <span>Log Out</span>
                </a>
            </div>

        </aside>

        <!-- Main Area -->
        <main class="vs-main">

            <header class="vs-topbar">
                <div class="vs-breadcrumb">
                    <span>Victoria Safe</span>
                    <span>/</span>
                    <strong>@yield('page-label', 'Dashboard')</strong>
                </div>

                <div class="vs-topbar-right">
                    <span class="vs-system-status">
                        <span class="vs-status-dot"></span>
                        System Overview
                    </span>

                    <div class="vs-admin-profile">
                        <div class="vs-profile-avatar">A</div>

                        <div class="vs-profile-info">
                            <strong>Administrator</strong>
                            <span>Admin Workspace</span>
                        </div>
                    </div>
                </div>
            </header>

            <div class="vs-content">
                @yield('content')
            </div>

            <footer class="vs-admin-footer">
                <span>© {{ date('Y') }} Victoria City Crime Mapping System</span>
                <span>Victoria Safe · Admin Workspace</span>
            </footer>

        </main>

    </div>

    <!-- Mobile Navigation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const body = document.body;
            const toggle = document.getElementById('vsMobileMenuToggle');
            const sidebar = document.getElementById('vsSidebar');
            const overlay = document.getElementById('vsSidebarOverlay');
            const closeButton = document.getElementById('vsSidebarClose');

            if (!toggle || !sidebar || !overlay || !closeButton) {
                return;
            }

            function openMenu() {
                body.classList.add('vs-mobile-menu-open');
                toggle.setAttribute('aria-expanded', 'true');
                toggle.setAttribute('aria-label', 'Close navigation menu');
            }

            function closeMenu() {
                body.classList.remove('vs-mobile-menu-open');
                toggle.setAttribute('aria-expanded', 'false');
                toggle.setAttribute('aria-label', 'Open navigation menu');
            }

            toggle.addEventListener('click', function () {
                if (body.classList.contains('vs-mobile-menu-open')) {
                    closeMenu();
                } else {
                    openMenu();
                }
            });

            closeButton.addEventListener('click', closeMenu);
            overlay.addEventListener('click', closeMenu);

            sidebar.querySelectorAll('.vs-nav-link, .vs-back-link').forEach(function (link) {
                link.addEventListener('click', closeMenu);
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closeMenu();
                }
            });

            window.addEventListener('resize', function () {
                if (window.innerWidth > 700) {
                    closeMenu();
                }
            });
        });
    </script>

</body>
</html>
