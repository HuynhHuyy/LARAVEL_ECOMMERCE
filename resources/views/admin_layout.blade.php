{{--danh mục con trong sidebar admin--}}
<!DOCTYPE html>
<head>
<title>TRANG ADMIN</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('admin/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('admin/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('admin/css/font.css')}}" type="text/css"/>
<link href="{{asset('admin/css/font-awesome.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('admin/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('admin/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('admin/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('admin/js/raphael-min.js')}}"></script>
<script src="{{asset('admin/js/morris.js')}}"></script>
    {{--    import library sweetalert v2--}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{--    sweetaler v1--}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="/list_user" class="logo">
        ADMIN
    </a>
</div>

<!--logo end-->
<div class="top-nav clearfix">

    <!--search & user info start-->

    <ul class="nav pull-right top-menu">
        <!-- user login dropdown start-->

        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{asset('admin/images/admin.png')}}">
                <span class="username">
				<?php
                $admin_email = Session::get('admin_email');
					if($admin_email)
					{
						echo $admin_email;
					}
				?>
				</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i>Đăng xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->

    </ul>
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">


                <li class="sub-menu">
                    <a  href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục</span>
                    </a>
                    <ul class="sub">
						<li><a href="/add_category">Thêm danh mục</a></li>
						<li><a href="/list_category">Danh sách danh mục</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thương hiệu</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/add_brand">Thêm thương hiệu</a></li>
                        <li><a href="/list_brand">Danh sách thương hiệu</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/add_product">Thêm sản phẩm</a></li>
                        <li><a href="/list_product">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý khách hàng</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/add_user">Thêm khách hàng</a></li>
                        <li><a href="/list_user">Danh sách khách hàng</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="{{URL::to('/admin_receipt')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Quản lý hóa đơn</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a  href="{{URL::to('/list_warranty')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Quản lý phiếu bảo hành</span>
                    </a>
                </li>

                <li>
                    <a href="{{URL::to('/logout')}}">
                        <i class="fa fa-user"></i>
                        <span>Đăng xuất</span>
                    </a>
                </li>
            </ul>
		</div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		@yield('admin_content')
	</section>
 <!-- footer -->
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('admin/js/bootstrap.js')}}"></script>
<script src="{{asset('admin/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('admin/js/scripts.js')}}"></script>
{{--alert base on url--}}
<script src="{{asset('admin/js/alerturl.js')}}"></script>
{{--upload file js--}}
{{--<script src="{{asset('admin/js/script.js')}}"></script>--}}

<script src="{{asset('admin/js/jquery.slimscroll.js')}}"></script>
{{--<script src="js/jquery.nicescroll.js"></script>--}}
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('admin/js/jquery.scrollTo.js')}}"></script>
<!-- morris JavaScript -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

{{--    <!-- Back to Top -->--}}
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

{{--    <!-- JavaScript Libraries -->--}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

<script src="{{asset('user/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('user/lib/owlcarousel/owl.carousel.min.js')}}"></script>

<!-- Contact Javascript File -->
<script src="{{asset('user/mail/jqBootstrapValidation.min.js')}}"></script>
<script src="{{asset('user/mail/contact.js')}}"></script>

<!-- Template Javascript -->
<script src="{{asset('user/js/main.js')}}"></script>
<script>
	$(document).ready(function() {
        //BOX BUTTON SHOW AND CLOSE
        jQuery('.small-graph-box').hover(function () {
            jQuery(this).find('.box-button').fadeIn('fast');
        }, function () {
            jQuery(this).find('.box-button').fadeOut('fast');
        });
        jQuery('.small-graph-box .box-close').click(function () {
            jQuery(this).closest('.small-graph-box').fadeOut(200);
            return false;
        })
    });


</script>

</body>
</html>
