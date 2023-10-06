<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{asset('user/css/style.css')}}" rel="stylesheet">
</head>

<body>

<div class="container">
    <div class="login">
        <h2>ĐĂNG KÝ TÀI KHOẢN</h2>
        <form class="login-form" id="submitlogin" method="post" action="{{URL::to('/save_user_register')}}">
            <div class="form-group">
                {{ csrf_field() }}
                <label for="exampleInputEmail1">Tên khách hàng</label>
                <input type="text" name="user_name" class="form-control"  placeholder="Nhập tên khách hàng" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="text" name="user_email" class="form-control" placeholder="Nhập email" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Số điện thoại</label>
                <input type="text" name=user_phone class="form-control"  placeholder="Nhập số điện thoại" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mật khẩu</label>
                <input type="text" name="user_password" class="form-control"  placeholder="Nhập mật khẩu" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Địa chỉ</label>
                <input type="text" name="user_address" class="form-control"  placeholder="Nhập địa chỉ" required>
            </div>
            <div class="action">
                <button class="action-button">Đăng ký</button>

            </div>
            <div class="action">
                <a href="{{URL::to('/')}}" class="action-button --back">Quay lại</a>
            </div>
        </form>
    </div>

</div>
<script>

    function getIdDetails2() {
        var urlParams;
        (window.onpopstate = function () {
            var match,
                pl = /\+/g, // Regex for replacing addition symbol with a space
                search = /([^&=]+)=?([^&]*)/g,
                decode = function (s) {
                    return decodeURIComponent(s.replace(pl, " "));
                },
                query = window.location.search.substring(1);

            urlParams = {};
            while ((match = search.exec(query)))
                urlParams[decode(match[1])] = decode(match[2]);
        })();
        return urlParams;
    }
    if (getIdDetails2().message == "register_fail") {
        alert("Email này đã được đăng ký, vui lòng sử dụng email khác!");
    }
</script>

</body>

</html>

