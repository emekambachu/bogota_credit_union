<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Account Login &mdash; Bogota Credit Union</title>

    <!-- META SECTION -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('bogota_credit_union_logoonly.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('bogota_credit_union_logoonly.png') }}" type="image/x-icon">
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" href="{{ asset('auth/css/styles2c70.css?v=1.0.3') }}">
    <!-- EOF CSS INCLUDE -->
</head>

<body>
<!-- PAGE WRAPPER -->
<div class="page">
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page__content" id="page-content">
        <!-- PAGE CONTENT CONTAINER -->
        <div class="content d-none d-lg-block" id="content" style="background: url( {{ asset('auth/assets/img/backgrounds/bridge.jpg') }} ) left center no-repeat; background-size: 100% auto"></div>
        <!-- //END PAGE CONTENT CONTAINER -->

        <!-- PAGE LOGIN CONTAINER -->
        <div class="important-container login-container" style="background-color:#a7d6fc;">
            <div class="content">
                @include('includes.alerts')
                <a style="margin-bottom:80px;" href="{{ url('/') }}" class="logo-holder logo-holder--lg logo-holder--wide">
                    <div class="logo-text">
                        <img src="{{ asset('bogota_credit_union_logo.png') }}" width="150"/>
                    </div>
                </a>

                <form action="{{ route('admin-login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="text-dark">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" name="username" required>
                        @error('accnum')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group margin-bottom-20">
                        <label class="text-dark">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Your password" name="password" autocomplete="new-password" required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group margin-bottom-30">
                        <div class="form-row">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <button type="submit" style='background-color: #003142; color: #fff;'
                                        class="btn btn-block">Login</button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
        <!-- PAGE LOGIN CONTAINER -->
    </div>
    <!-- //END PAGE CONTENT -->
</div>
<!-- //END PAGE WRAPPER -->

<!-- IMPORTANT SCRIPTS -->
<script type="text/javascript" src="{{ asset('auth/js/vendors/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('auth/js/vendors/jquery/jquery-migrate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('auth/js/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('auth/js/vendors/mcustomscrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<!-- END IMPORTANT SCRIPTS -->

<!-- TEMPLATE SCRIPTS -->
<script type="text/javascript" src="{{ asset('auth/js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('auth/js/plugins.js') }}"></script>
<script type="text/javascript" src="{{ asset('auth/js/demo.js') }}"></script>
<script type="text/javascript" src="{{ asset('auth/js/settings.js') }}"></script>
<!-- END TEMPLATE SCRIPTS -->
</body>

</html>
