
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
<link rel="stylesheet" href="{{asset('public/admin/css/font.css')}}" type="text/css"/>
<link href="{{asset('admin/css/font-awesome.css')}}" rel="stylesheet">
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>ĐĂNG NHẬP</h2>
	<?php
		$message= Session::get('message');

		if($message)
		{
			Session::put('message',null);
		}
	?>
		<form action="{{url('checklogin')}}" method="post">

			<input type="text" class="ggg" name="admin_email" placeholder="Điền email" required="">
			<input type="password" class="ggg" name="admin_password" placeholder="Điền password" required="">
            {{--        css alert log in--}}
            {{ csrf_field() }}
            @if($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
				<div class="clearfix"></div>
				<input type="submit" value="Đăng nhập" name="login">
		</form>
</div>
</div>
<script src="{{asset('admin/js/bootstrap.js')}}"></script>
<script src="{{asset('admin/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('admin/js/scripts.js')}}"></script>
<script src="{{asset('admin/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('admin/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('admin/js/jquery.scrollTo.js')}}"></script>
</body>
</html>
