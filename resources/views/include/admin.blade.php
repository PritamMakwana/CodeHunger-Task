<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title') | {{ config('app.name', 'Admin') }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAAXVBMVEVHcEyTbWUsKiofHR0aGRkVFRUVFBQFBAQTEBAYFRQbGBgkIiI3LisAAAEeGxshICBJODUZFxZpIhNoHAuWNyS+Ox+8MxS/PyW/QCa7MhLBRy/MalfBRi7EUDrIWkNDvmbxAAAAH3RSTlMADVOPst7p//XYwW46/6SZIOPs/pfw/82q/3IjhVk0w2QZowAAAPVJREFUeAGlz4GORDAQBuApKJhl725aU7ve/zGPzi7lMskl+5FIM7/fgJTJ8qKsrK3Lpi3yrjdw0pUWD3a76j4Zr9Ptbm9DUa2zCLu9vEFcz1X2OrZ4DozxFRxgd0MJnOY5JEpMAnU8NJDqJZDU2RFOKnwHRtmnhQuzgo1sjBkojBWg6aTgDppCAgVo7hIYQGMl0OkB+2kAhR74+o5+QEMu8qCZOAYINEECzoBilgAH0NA/v8EPuDD+qIiecPJ0TLLY4l7SjtmztKY/wvRY5JXgmR0fncG9I3w8mGbYLSQjIZHL0oF4I0NmCvDHHCZP65z8FI7yX1mzGKFoi7UWAAAAAElFTkSuQmCC" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css')}}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js')}}"></script>
    <script src="{{ asset('assets/js/config.js')}}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar ">
    <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="{{url('/dashboard')}}" class="app-brand-link">

                    <img src="https://www.codehunger.in/assets/image/logo.png" alt="Logo" height="50" />
                    <!-- </span> -->
                    <!-- <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span> -->
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>
            <ul class="menu-inner py-1">
                <!-- Dashboard -->
                <li class="menu-item {{Request::is('dashboard') ? 'active':''}} {{Request::is('/') ? 'active':''}}">
                    <a href="{{ route('dashboard') }}" class="menu-link ">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">Dashboard </div>
                    </a>
                </li>

                {{-- categories --}}
                <li class="menu-item {{Request::is('categories*') ? 'active':''}} ">
                    <a href="{{ route('categories') }}" class="menu-link">
                        <i class='menu-icon tf-icons bx bx-wallet-alt'></i>
                        <div>Categories</div>
                    </a>
                </li>


                {{-- <li class="menu-item {{Request::is('companies*') ? 'active':''}} ">
                    <a href="{{url('/companies')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-collection"></i>
                        <div>Companies</div>
                    </a>
                </li> --}}

            </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                id="layout-navbar">
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="bx bx-menu bx-sm"></i>
                    </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <!-- Search -->

                    <!-- /Search -->

                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <!-- Place this tag where you want the button to render. -->


                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="https://img.icons8.com/?size=512&id=43964&format=png" alt
                                        class="w-px-40 h-auto rounded-circle" />
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{route('admin.logout')}}">
                                        <i class="bx bx-power-off me-2"></i>
                                        <span class="align-middle">Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--/ User -->
                    </ul>
                </div>
            </nav>

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                @yield('content')
                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            , made with ❤️ by
                            <a href="https://www.linkedin.com/in/pritam-makwana-82497423a/" target="_blank"
                                class="footer-link fw-bolder">Pritam Makwana</a>
                        </div>

                    </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->


<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js')}}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

<script src="{{ asset('assets/vendor/js/menu.js')}}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js')}}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/dashboards-analytics.js')}}"></script>

<!-- Place this tag in your head or just before your close body tag. -->

<script type="{{ asset('text/javascript')}}">


</script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

@yield('script')

</body>

</html>
