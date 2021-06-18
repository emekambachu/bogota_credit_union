<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Registration &mdash; Bogota Credit Union</title>

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- EOF CSS INCLUDE -->

    <script src="{{ asset('auth/js/countries.js') }}" type="text/javascript"></script>
</head>

<body>
<!-- PAGE WRAPPER -->
<div class="page">
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page__content" id="page-content">
        <!-- PAGE CONTENT CONTAINER -->
        <div class="content d-none d-lg-block" id="content"
             style="background: url( {{ asset('auth/assets/img/backgrounds/bridge.jpg') }} ) left center no-repeat;
                 background-size: 100% auto"></div>
        <!-- //END PAGE CONTENT CONTAINER -->

        <!-- PAGE LOGIN CONTAINER -->
        <div class="important-container login-container" style="background-color: #0C908C;">

            <div class="content">
                @include('includes.alerts')
                <a style="margin-bottom:40px;" href="{{ url('/') }}" class="logo-holder logo-holder--lg logo-holder--wide">
                    <div class="logo-text">
                        <img src="{{ asset('bogota_credit_union_logo.png') }}" width="200"/>
                    </div>
                </a>

                <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-light">First Name</label>
                                <input type="text" class="form-control @error('fname') is-invalid @enderror"
                                       value="{{ old('fname') }}" name="fname" required>
                                @error('fname')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-light">Last Name</label>
                                <input type="text" class="form-control @error('lname') is-invalid @enderror"
                                       value="{{ old('lname') }}" name="lname" required>
                                @error('lname')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-light">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" name="email" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-light">Mobile Number (International)</label>
                                <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                       value="{{ old('mobile') }}" name="mobile" required>
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-light">Photo</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo">
                                @error('photo')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-light">Zip Code</label>
                                <input type="number" class="form-control @error('zip') is-invalid @enderror"
                                       value="{{ old('zip') }}" name="zip" required>
                                @error('zip')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-light">Pin (4 Digits Max)</label>
                                <input type="number" class="form-control @error('pin') is-invalid @enderror"
                                       value="{{ old('pin') }}" name="pin" maxlength="4" minlength="4" required>
                                @error('pin')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-light">Account Type</label>
                                <select class="form-control @error('acctype') is-invalid @enderror" name="acctype" required>
                                    <option value="">Select Account Type</option>
                                    <option value="Savings Account">Savings Account</option>
                                    <option value="Fixed Deposit Account">Fixed Deposit Account</option>
                                    <option value="Current Account">Current Account</option>
                                    <option value="Checking Account">Checking Account</option>
                                </select>
                                @error('acctype')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group margin-bottom-20">
                                <label class="text-light">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Your password" name="password" autocomplete="new-password" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-light">Date of Birth</label>
                                <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                       value="{{ old('dob') }}" name="dob" required>
                                @error('dob')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-light">Gender</label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                    <option>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-light">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                       value="{{ old('address') }}" name="address" required>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-light">Country</label>
                                <select id="country" name="country"
                                        class="form-control @error('country') is-invalid @enderror" required>
                                </select>
                                @error('country')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-light">State</label>
                                <select id="state" name="state"
                                        class="form-control @error('state') is-invalid @enderror" required>
                                </select>
                                @error('state')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <script language="javascript">
                                populateCountries("country", "state");
                                populateCountries("country2");
                            </script>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group margin-bottom-30">
                                <div class="form-row">
                                    <div class="col-2"></div>
                                    <div class="col-8">
                                        <button type="submit" style='background-color: #D36729; color: #fff;'
                                                class="btn btn-block">Create Your Account</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                </form>

                <div class="divider"></div>

                <div class="form-group text-center">
                    <div class="form-row">
                        <div class="col-4">
                            <a href="{{ url('/') }}" class="text-light">Home</a></div>
                        <div class="col-4">
                            <a href="{{ route('login') }}" class="text-light">
                                Login</a></div>
                        <div class="col-4">
                            <a class="text-light" href="mailto:info@bogotacreditunion.com">
                                info@bogotacreditunion.com</a></div>
                    </div>
                </div>

            </div>
        </div>
        <!-- PAGE LOGIN CONTAINER -->
    </div>
    <!-- //END PAGE CONTENT -->
</div>
<!-- //END PAGE WRAPPER -->

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"
        integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>

<!-- IMPORTANT SCRIPTS -->
<script type="text/javascript" src="{{ asset('js/vendors/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vendors/jquery/jquery-migrate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vendors/mcustomscrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<!-- END IMPORTANT SCRIPTS -->

<!-- TEMPLATE SCRIPTS -->
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/demo.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/settings.js') }}"></script>
<!-- END TEMPLATE SCRIPTS -->
</body>

</html>
