<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, xtreme admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, material design, material dashboard bootstrap 4 dashboard template">
    <meta name="description" content="Xtreme is powerful and clean admin dashboard template, inpired from Google's Material Design">
    <meta name="robots" content="noindex,nofollow">
    <title>News Management</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/xtremeadmin/">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('assets\images\news.jpg')}}">
    <!-- This page plugin CSS -->
    <link href="{{url('assets\extra-libs\datatables.net-bs4\css\dataTables.bootstrap4.css')}}" rel="stylesheet">
    <!-- Custom CSS -->

    <link rel="stylesheet" type="text/css" href="{{url('assets\extra-libs\datatables.net-bs4\css\responsive.dataTables.min.css')}}">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Custom CSS -->
    <link href="{{url('dist\css\style.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{url('assets\libs\select2\dist\css\select2.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header">
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <a class="navbar-brand" href="{{url('/user')}}">
                    <!-- Logo icon -->
                    <b class="logo-icon">
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="{{url('assets\images\news.jpg')}}" width="50px" alt="homepage" class="dark-logo">
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span class="logo-text">
                        <h3 style="color: black; text-align: center; margin-top: 5px;">News </h3>
                    </span>
                </a>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Toggle which is visible on mobile only -->
                <!-- ============================================================== -->
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="sidebar-item">
                        <a href="{{url('news')}}"
                           class="sidebar-link waves-effect waves-dark sidebar-link @if(request()->is('news*')) active @endif">
                            <i class="fas fa-newspaper"></i>
                            <span class="hide-menu"><b> Xəbərlər</b></span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link @if(request()->is('language*')) active @endif"
                           href="{{url('language')}}" aria-expanded="false">
                            <i class="fas fa-language"></i>
                            <span class="hide-menu"><b>Dil Məlumatları</b></span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
    @include('messages')
    @yield('content')

        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center">
            All Rights Reserved by Xtreme admin.
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->

<script>

    $(".delete_right").click(function () {

        var function_id = $(this).val();
        var user_id = $(this).attr("data-value");

        $.ajax({
            type: "GET",
            url: "{{url('/right/ajax/delete_right')}}",
            data:{
                user_id: user_id,
                function_id: function_id
            },
            success: function()
            {
                location.reload();
            },
            // error: function(){
            // }
        });
    });

</script>

<script src="{{url('assets\libs\jquery\dist\jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{url('assets\libs\popper.js\dist\umd\popper.min.js')}}"></script>
<script src="{{url('assets\libs\bootstrap\dist\js\bootstrap.min.js')}}"></script>
<!-- This Page JS -->
<script src="{{url('assets\libs\select2\dist\js\select2.full.min.js')}}"></script>
<script src="{{url('assets\libs\select2\dist\js\select2.min.js')}}"></script>
<script src="{{url('dist\js\pages\forms\select2\select2.init.js')}}"></script>
<!-- apps -->
<script src="{{url('dist\js\app.min.js')}}"></script>
<script src="{{url('dist\js\app.init.js')}}"></script>
<script src="{{url('dist\js\app-style-switcher.js')}}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{url('assets\libs\perfect-scrollbar\dist\perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{url('assets\extra-libs\sparkline\sparkline.js')}}"></script>
<!--Wave Effects -->
<script src="{{url('dist\js\waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{url('dist\js\sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{url('dist\js\feather.min.js')}}"></script>
<script src="{{url('dist\js\custom.min.js')}}"></script>

<!--This page JavaScript -->
<script src="{{url('assets\libs\jquery.repeater\jquery.repeater.min.js')}}"></script>
<script src="{{url('assets\extra-libs\jquery.repeater\repeater-init.js')}}"></script>
<script src="{{url('assets\extra-libs\jquery.repeater\dff.js')}}"></script>

<script src="{{url('assets\extra-libs\datatables.net\js\jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets\extra-libs\datatables.net-bs4\js\dataTables.responsive.min.js')}}"></script>
<script src="{{url('dist\js\pages\datatable\datatable-basic.init.js')}}"></script>
<!-- This Page JS -->


@yield('fetch')
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            setTimeout(function () {
                $('.alert-success').slideUp(300);
            }, 3000); // <-- time in milliseconds
            setTimeout(function () {
                $('.alert-danger').slideUp(300);
            }, 3000);
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                        $('html, body').animate({scrollTop: 0}, 'slow');
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

</body>

</html>
