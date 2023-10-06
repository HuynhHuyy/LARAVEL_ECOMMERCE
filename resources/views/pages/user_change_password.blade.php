@extends('layout')
@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">TÀI KHOẢN</h1>
        </div>
    </div>
    <!-- Page Header End -->
    <!-- Page Profile Start -->
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-8 border-right">
                <div class="p-3 py-5">
                    <form action="/change_password" method="post">
                        @csrf
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">ĐỔI MẬT KHẨU</h4>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Mật khẩu cũ:</label><input type="password" name="old_password" class="form-control"  value=""></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Mật khẩu mới:</label><input type="password" name="new_password1" class="form-control"  value=""></div>
                        <div class="col-md-6"><label class="labels">Nhập lại mật khẩu mới:</label><input type="password" name="new_password2" class="form-control"  value=""></div>
                    </div>
                        @if(count($errors) > 0)
                            <div class="alert alert-danger mt-2">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Xác nhận</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(isset($_GET['message']))
    @if($_GET['message'] == 'success')
        <script>
            swal("Đổi mật khẩu thành công!", "Vui lòng đăng nhập lại!", "success");
        </script>
    @endif
    @if($_GET['message'] == 'fail')
        <script>
            swal("Đổi mật khẩu thất bại!", "Vui lòng thử lại!", "error");
        </script>
    @endif
    @if($_GET['message'] == 'wrongoldpass')
        <script>
            swal("Đổi mật khẩu thất bại!", "Mật khẩu cũ không đúng!", "error");
        </script>
    @endif
    @endif

    <!-- Profile End -->
@endsection
