<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') - Bogota Credit Union</title>

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
    <div class="page page--w-header">
        <!-- PAGE HEADER -->
        <header class="page__header">

            <div class="logo-holder">
            <a href="{{ url('account/dashboard') }}" class="logo-text d-none d-lg-block">
                    <img src="{{ asset('bogota_credit_union_logo.png') }}" width="100"/>
                </a>

                <a href="{{ url('account/dashboard') }}" class="logo-text d-lg-none">
                    <img src="{{ asset('bogota_credit_union_logo.png') }}" width="100"/>
                </a>
                <div class="rw-btn rw-btn--nav" data-action="aside-hide">
                    <span></span>
                </div>
            </div>

            <div class="box-fluid"></div>
            <div class="box">
                <div class="dropdown float-left">
                    <button class="btn btn-light btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="li-cog"></span></button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="page-heading">
                            <div class="page-heading__container">
                                <h1 class="title">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</h1>
                            </div>
                        </div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item padding-left-10 padding-right-10">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 {{ __('Logout') }}
                                 </a>

                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                     @csrf
                                 </form>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </header>
        <!-- //END PAGE HEADER -->

        <!-- PAGE CONTENT WRAPPER -->
        <div class="page__content page__content--w-aside-fixed" id="page-content">

            <!-- PAGE ASIDE PANEL -->
            <div class="page-aside invert" id="page-aside">
                <div class="scroll" style="max-height: 100%">
                    <div class="navigation" id="navigation-default">

                        <div class="user user--bordered user--lg user--w-lineunder user--controls">
                            <img src="/photos/{{Auth::user()->Image ? Auth::user()->image->img : 'noimage.png'}}">

                            <div class="user__name">
                                <strong>{{ Auth::user()->fname }} {{ Auth::user()->lname }}</strong><br>
                                <div class="user__controls">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-cog"></span></button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="user__lineunder">
                                <div class="buttons">
                                    <div class="dropdown">
                                        <button class="button button-settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Settings</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                    <div class="button button-minimize" data-action="aside-minimize" data-toggle="tooltip" data-placement="top" data-original-title="Minimize navigation"></div>
                                </div>
                            </div>

                        </div>
                        <ul>
                            <li><a href="{{ route('admin-dashboard') }}"><span class="icon li-home"></span>
                                <span class="text">Dashboards</span></a></li>

                            <li><a href="{{ route('manage-users') }}"><span class="icon li-users"></span>
                                <span class="text">Manage Users and Funds</span></a></li>

                            <li><a href="{{ route('fund-transfers') }}"><span class="icon li-cash-dollar"></span>
                                <span class="text">All Transfers</span></a></li>

                            <li><a href="{{ route('all-transactions') }}"><span class="icon li-cash-dollar"></span>
                                <span class="text">All Transactions</span></a></li>

                            <li><a href="{{ url('admin/admin-settings') }}"><span class="icon li-cog2"></span>
                                    <span class="text">Account Settings</span></a></li>

                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    <span class="icon li-exit-right"></span>
                                    <span class="text">Logout</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- //END PAGE ASIDE PANEL -->

            <div class="content" id="content" style="background-color: #068F8A;">
                <!-- PAGE HEADING -->

                <div class="container-fluid">
                    @yield('contents')
                </div>

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

    @yield('page-scripts')

    <!-- TEMPLATE SCRIPTS -->
    <script type="text/javascript" src="{{ asset('auth/js/app_admin.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/plugins.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/demo.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/settings.js') }}"></script>
    <!-- END TEMPLATE SCRIPTS -->

</body>

</html>
