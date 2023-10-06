<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trang chủ</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('user/img/favicon.ico') }}">
    {{-- <link rel="icon" href="{{url('favicon.ico')}}"> --}}

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('user/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('user/css/style.css')}}" rel="stylesheet">
{{--    import library sweetalert v2--}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{--    sweetaler v1--}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

       <!-- Topbar Start -->
       <div class="container-fluid">
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">PC</span>SHOP</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control search" placeholder="Tìm kiếm sản phẩm">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-3 col-6 text-right">
                <a href="{{URL::to('/show_cart')}}" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">
                        <div id="count_cart">0</div>
                    </span>
                </a>
            </div>
        </div>
         </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
              </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{URL::to('/')}}" class="nav-item nav-link btn-primar">Sản phẩm</a>
                            {{--check validate user login--}}
                            @if(Session::get('user_id'))
                                <div class="navbar-nav mr-auto py-0">
                                            <a href="{{URL::to('/show_cart')}}" class="nav-item nav-link">Thông tin giỏ hàng</a>
                                </div>
                            @else
                                <div class="navbar-nav mr-auto py-0">
                                    <a  type="button" class="nav-item nav-link cart_login" onclick="cart_login()">Thông tin giỏ hàng</a>
                                </div>
                            @endif
                            @if(Session::get('user_id'))
                                <div class="navbar-nav mr-auto py-0">
                                    <a href="{{URL::to('/list_receipt')}}" class="nav-item nav-link">Lịch sử đơn hàng</a>
                                </div>
                            @else
                                <div class="navbar-nav mr-auto py-0">
                                    <a  type="button" class="nav-item nav-link cart_login" onclick="cart_login()">Lịch sử đơn hàng</a>
                                </div>
                            @endif
                            <div class="navbar-nav mr-auto py-0">
                            <a href="{{URL::to('/contact')}}" class="nav-item nav-link">Liên hệ</a>
                            </div>
                        </div>
                            {{--                        condition display after login--}}
                        <div class="navbar-nav ml-auto py-0">
                            @if(Session::get('user_id'))
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" aria-expanded="false">
                                    <img alt="" src="{{asset('admin/images/user.png')}}">
                                    <span class="username">
                                            <?php
                                            $user_email = Session::get('user_email');
                                            if($user_email)
                                            {
                                                echo $user_email;
                                            }
                                            ?>
				                    </span>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu extended logout">
                                    <li><a href="{{URL::to('/user_warranty')}}"><i class=" fa fa-suitcase"></i>Tình trạng bảo hành</a></li>
                                    <li><a href="{{URL::to('/user_change_password')}}"><i class=" fa fa-key"></i>Đổi mật khẩu</a></li>
                                    <li><a href="{{URL::to('/logout_user')}}"><i class="fa fa-sign"></i>Đăng xuất</a></li>
                                </ul>
                            </li>
                            @else
                            <a href="{{URL::to('/user_login')}}" class="nav-item nav-link">Đăng nhập</a>
                            <a href="{{URL::to('/user_register')}}" class="nav-item nav-link">Đăng ký</a>
                           @endif
                        </div>
                    </div>
                </nav>

                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-7 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">PC</span>SHOP</h1>
                </a>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>19, Nguyễn Hữu Thọ, Tân Phong, Q7, TP.HCM</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>thepc@gmail.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+84(123 456 789)</p>
            </div>
            <div class="col-lg-5 col-md-12">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Các trang</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>SẢN PHẨM</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>GIỎ HÀNG</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>LIÊN HỆ</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- Footer End -->

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
       <?php
       if(isset($_GET['vnp_ResponseCode'])){
           if($_GET['vnp_ResponseCode'] == '00'){
               $user_name_temp = Session::get('user_name');
               $user_id_temp = Session::get('user_id');
               $user_email_temp = Session::get('user_email');
               $user_password_temp = Session::get('user_password');
               echo '<script>swal("Thành công", "Thanh toán thành công", "success");</script>';
               Session::flush();
               Session::put('user_name', $user_name_temp);
               Session::put('user_email', $user_email_temp);
               Session::put('user_id', $user_id_temp);
               Session::put('user_password', $user_password_temp);
           }else{
               echo '<script>swal("Thất bại", "Thanh toán thất bại", "error");</script>';
               Session::forget('fee');
           }
       }
       ?>
</body>

</html>
