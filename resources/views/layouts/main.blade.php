<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Lakeland Financing Banking Services">
    <meta name="keywords" content="Lakeland Financing Banking Services">

    <title>@yield('title') - Bogota Credit Union</title>

    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontello.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('flat-font-icons/css/fontello.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('bogota_credit_union_logoonly.png') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.css') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CMerriweather:300,300i,400,400i,700,700i" rel="stylesheet">

    <!-- owl Carousel Css -->
    <link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.css') }}" rel="stylesheet">

    <!-- Flaticon -->
    <link href="{{ asset('css/flaticon.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body>
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                <!-- logo -->
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('bogota_credit_union_logo.png') }}" width="150" alt="Bogota Credit Union"></a>
                </div>
            </div>
            <!-- logo -->
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12">
                <div id="navigation">
                    <!-- navigation start-->
                    <ul>
                        <li><a href="{{ url('/') }}" class="animsition-link">Home</a></li>
                        <li><a href="{{ url('banking-services') }}" class="animsition-link">Banking Services</a></li>
                        <li><a href="{{ url('accounts') }}" class="animsition-link">Accounts</a></li>
                        <li><a href="{{ url('credit-cards') }}" class="animsition-link">Credit Cards</a></li>
                        <li><a href="{{ url('loans') }}" class="animsition-link">Loans</a></li>
                        <li style="background-color: #0a4587;">
                            <a style="color: #ffffff !important;" href="{{ route('register') }}" class="animsition-link">Sign up</a></li>
                        <li style="background-color: #0a4587;">
                            <a style="color: #ffffff !important;" href="{{ route('login') }}" class="animsition-link">Login</a></li>
                    </ul>
                </div>
                <!-- /.navigation start-->
            </div>
        </div>
    </div>
</div>

@yield('content')

<div class="footer section-space100">
    <!-- footer -->
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="footer-logo">
                    <!-- Footer Logo -->
                    <img src="{{ asset('bogota_credit_union_logo.png') }}" alt=""> </div>
                <!-- /.Footer Logo -->
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                        <h3 class="newsletter-title">Signup Our Newsletter</h3>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
                        <div class="newsletter-form">
                            <!-- Newsletter Form -->
                            <form action="" method="post">
                                <div class="input-group">
                                    <input type="email" class="form-control" id="newsletter" name="newsletter" placeholder="Write E-Mail Address" required>
                                    <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Go!</button>
                </span> </div>
                                <!-- /input-group -->
                            </form>
                        </div>
                        <!-- /.Newsletter Form -->
                    </div>
                </div>
                <!-- /.col-lg-6 -->
            </div>
        </div>
        <hr class="dark-line">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="widget-text mt40">
                    <!-- widget text -->
                    <p>Our goal at Bogota Credit Union is to provide access to superior banking services for businesses, personal loans and education loan, car loan at insight competitive interest rates.</p>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <p class="call-text"><span><i class="fa fa-envelope"></i></span>info@bogotacreditunion.com</p>

{{--                            <p class="address-text"><span><i class="icon-placeholder-3 icon-1x"></i> </span>--}}
{{--                                Australia: 2 Elm Drv, Oakbank, SA 5243 </p>--}}
{{--                            <p class="address-text"><span><i class="icon-placeholder-3 icon-1x"></i> </span>--}}
{{--                                United States: 1090 Hauer Dr, North Liberty, IA, 52317 </p>--}}

                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <p class="call-text"><span><i class="icon-phone-call icon-1x"></i></span>+12403431120</p>
                        </div>
                    </div>
                </div>
                <!-- /.widget text -->
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="widget-footer mt40">
                    <!-- widget footer -->
                    <ul class="listnone">
                        <li><a href="{{ url('/') }}" class="animsition-link">Home</a></li>
                        <li><a href="{{ url('banking-services') }}" class="animsition-link">Banking Services</a></li>
                        <li><a href="{{ url('accounts') }}" class="animsition-link">Accounts</a></li>
                        <li><a href="{{ url('loans') }}" class="animsition-link">Loans</a></li>
                    </ul>
                </div>
                <!-- /.widget footer -->
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="widget-footer mt40">
                    <!-- widget footer -->
                    <ul class="listnone">
                        <li><a href="{{ route('register') }}" class="animsition-link">Sign up</a></li>
                        <li><a href="{{ route('login') }}" class="animsition-link">Login</a></li>
                    </ul>
                </div>
                <!-- /.widget footer -->
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="widget-social mt40">
                    <!-- widget footer -->
                    <ul class="listnone">
                        <li><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i>Linked In</a></li>
                    </ul>
                </div>
                <!-- /.widget footer -->
            </div>
        </div>
    </div>
</div>
<!-- /.footer -->
<div class="tiny-footer">
    <!-- tiny footer -->
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                <p>© Copyright {{ date('Y') }} | Bogota Credit Union</p>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 text-right">
                <p>Terms of use | Privacy Policy</p>

            </div>
        </div>
    </div>
</div>
<!-- back to top icon -->
<a href="#0" class="cd-top" title="Go to top">Top</a>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/menumaker.js') }}"></script>

<!-- sticky header -->
<script type="text/javascript" src="{{ asset('js/jquery.sticky.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/sticky-header.js') }}"></script>
<!-- slider script -->
<script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/slider-carousel.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/service-carousel.js') }}"></script>
<!-- Back to top script -->
<script src="{{ asset('js/back-to-top.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script>
    $(function() {
        $("#slider-range-min").slider({
            range: "min",
            value: 3000,
            min: 1000,
            max: 5000,
            slide: function(event, ui) {
                $("#amount").val("$" + ui.value);
            }
        });
        $("#amount").val("$" + $("#slider-range-min").slider("value"));
    });
</script>
<script>
    $(function() {
        $("#slider-range-max").slider({
            range: "max",
            min: 1,
            max: 10,
            value: 2,
            slide: function(event, ui) {
                $("#j").val(ui.value);
            }
        });
        $("#j").val($("#slider-range-max").slider("value"));
    });
</script>
</body>


</html>
