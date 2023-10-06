@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    CHỈNH SỬA THÔNG TIN KHÁCH HÀNG
                </header>
                <?php $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
                <div class="panel-body">

                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update_user/'.$edit_user->customer_id)}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên khách hàng:</label>
                                <input type="text" value="{{$edit_user->customer_name}}" name="user_name" class="form-control" id="exampleInputEmail1" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email:</label>
                                <input style="resize:none" rows="5" value="{{$edit_user->customer_email}}" name="user_email" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mật khẩu:</label>
                                <input style="resize:none" rows="5" value="{{$edit_user->customer_password}}" name="user_password" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Điện thoại:</label>
                                <input style="resize:none" rows="5" value="{{$edit_user->customer_phone}}" name="user_phone" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Địa chỉ:</label>
                                <input style="resize:none" rows="5" value="{{$edit_user->customer_address}}" name="user_address" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <button type="submit" class="btn btn-info">Cập nhật</button>
                            <button type="button" class="btn btn-info" onclick="window.location='{{ URL::previous() }}'">Quay lại</button>
                        </form>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection
