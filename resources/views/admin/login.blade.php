<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Login </title>
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
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center">
                            <img src="https://www.codehunger.in/assets/image/logo.png" alt="logo" height="60" />
                        </div>
                        <!-- /Logo -->

                        <form id="formAuthentication" class="mb-3" action="{{ route('admin.login') }}" method="POST">

                            @if(Session::has('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                            @endif


                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="Enter your email"
                                    name="email" value="{{old('email')}}" autofocus />

                            </div>
                            <span class="text-danger">
                                @error('email')
                                {{$message}}
                                @enderror
                            </span>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <span class="text-danger">@error('password')
                                {{$message}}
                                @enderror
                            </span>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Log in</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <!-- / Content -->




    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
