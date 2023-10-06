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
        <h2>ĐĂNG NHẬP</h2>
        <form class="login-form" id="submitlogin" method="post" action="{{url('/checklogin_user')}}">
            <div class="input">
                <input class="input-field" type="text" name="user_email" id="username_login" required>
                <label class="input-label">Email</label>
            </div>
            <div class="input">
                <input class="input-field" type="password" name="user_password" id="password_login" required>
                <label class="input-label">Mật khẩu</label>
            </div>
            {{--        css alert log in--}}
            {{ csrf_field() }}
            @if($message = Session::get('error_user'))
                <div class="alert alert-danger alert-block">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if($message = Session::get('success_user'))
                <div class="alert alert-success alert-block">
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
            <div class="action">
                <button class="action-button">Đăng nhập</button>
            </div>
        
            <div class="action --between">
                <a href="{{URL::to('/user_register')}}" class="action-button">Đăng ký</a>
                <a href="{{URL::to('/forget_password')}}" class="action-button">Quên mật khẩu</a>
                <a href="{{URL::to('/')}}" class="action-button">Quay lại</a>
            </div>
       
           
        </form>
    </div>
</div>

</body>

</html>

