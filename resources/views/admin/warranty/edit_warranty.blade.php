@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    CHỈNH SỬA THÔNG PHIẾU BẢO HÀNH
                </header>
                <?php $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
                <div class="panel-body">

                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update_warranty/'.$edit_warranty->warranty_id)}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên khách hàng:</label>
                                <input type="text" value="{{$edit_warranty->customer_name}}" name="customer_name" class="form-control" id="exampleInputEmail1" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Số điện thoại:</label>
                                <input style="resize:none" rows="5" value="{{$edit_warranty->customer_phone}}" name="customer_phone" class="form-control" id="exampleInputPassword1" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email:</label>
                                <input style="resize:none" rows="5" value="{{$edit_warranty->customer_email}}" name="customer_email" class="form-control" id="exampleInputPassword1" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Địa chỉ:</label>
                                <input style="resize:none" rows="5" value="{{$edit_warranty->customer_address}}" name="customer_address" class="form-control" id="exampleInputPassword1" readonly>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputPassword1">Tên sản phẩm:</label>
                                <input style="resize:none" rows="5" value="{{$edit_warranty->product_name}}" name="product_name" class="form-control" id="exampleInputPassword1" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ngày nhận:</label>
                                <input type="date" style="resize:none" rows="5" value="{{$edit_warranty->warranty_date}}" name="warranty_date" class="form-control" id="exampleInputPassword1" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ngày dự kiến trả:</label>
                                <input type="date" style="resize:none" rows="5" value="{{$edit_warranty->return_date}}" name="return_date" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trạng thái</label>
                                <select name="warranty_status" class="form-control input-sm m-bot15" required>
                                    <option value="0">Tiếp nhận yêu cầu</option>
                                    <option value="1">Đang kiểm tra</option>
                                    <option value="2">Đã bảo hành xong</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info update_warranty_success">Cập nhật</button>
                            <button type="button" class="btn btn-info" onclick="window.location='{{ URL::previous() }}'">Quay lại</button>
                        </form>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection
