<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Registration Complete &mdash; Bogota Credit Union</title>

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
        <div class="important-container login-container">

            <div class="content text-lg-center">
                @include('includes.alerts')
                <a style="margin-bottom:80px;" href="{{ url('/') }}" class="logo-holder logo-holder--lg logo-holder--wide">
                    <div class="logo-text">
                        <img src="{{ asset('bogota_credit_union_logo.png') }}" width="150"/>
                    </div>
                </a>

                <h1>Registration Complete</h1>
                <h3>Thank you {{ Session::get('firstname') }} {{ Session::get('lastname') }} for Opening an account with us</h3>
                <p>Your account will be active after approval</p>

                <div class="divider"></div>
                <div class="form-group text-center">
                    <div class="form-row">
                        <div class="col-4"><a href="{{ url('/') }}" class="text-muted">Home</a></div>
                        <div class="col-4"><a href="{{ route('login') }}" class="text-muted">Login</a></div>
                        <div class="col-4">info@bogotacreditunion.com</div>
                    </div>
                </div>
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
