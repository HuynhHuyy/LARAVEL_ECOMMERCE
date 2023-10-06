@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    THÊM KHÁCH HÀNG
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save_user')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên khách hàng</label>
                                <input type="text" name="user_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên khách hàng" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" name="user_email" class="form-control" id="exampleInputEmail1" placeholder="Nhập email" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại</label>
                                <input type="text" name=user_phone class="form-control" id="exampleInputEmail1" placeholder="Nhập số điện thoại" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mật khẩu</label>
                                <input type="text" name="user_password" class="form-control" id="exampleInputEmail1" placeholder="Nhập mật khẩu" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ</label>
                                <input type="text" name="user_address" class="form-control" id="exampleInputEmail1" placeholder="Nhập địa chỉ" required>
                            </div>

                            <?php $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                            <button type="submit" class="btn btn-info">Thêm khách hàng</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
@endsection
