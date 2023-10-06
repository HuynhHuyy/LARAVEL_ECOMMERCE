@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    TRẠNG THÁI HÓA ĐƠN
                </header>
                <?php $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach($edit_receipt as $key => $receipt)
                            <form role="form" action="{{URL::to('/update_receipt/' .$receipt->receipt_id)}}"
                                  method="POST">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên khách hàng</label>
                                    <input type="text" name="customer_name" class="form-control" id="exampleInputEmail1"
                                           value="{{$receipt->customer_name}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type="text" name="customer_email" class="form-control"
                                           id="exampleInputEmail1" value="{{$receipt->customer_email}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số điện thoại</label>
                                    <input type="text" name="customer_phone" class="form-control"
                                           id="exampleInputEmail1" value="{{$receipt->customer_phone}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ</label>
                                    <input type="text" name="customer_address" class="form-control"
                                           id="exampleInputEmail1" value="{{$receipt->customer_address}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ghi chú</label>
                                    <input type="text" name="customer_note" class="form-control" id="exampleInputEmail1"
                                           value="{{$receipt->customer_note}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Sản phẩm mua</label>
                                    <input type="text" name="receipt_product" class="form-control"
                                           id="exampleInputEmail1" value="{{$receipt->receipt_product}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hình thức vận chuyển</label>
                                    <input type="text" name="shipping_method" class="form-control"
                                           id="exampleInputEmail1" value="{{$receipt->shipping_method}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Phương thức thanh toán</label>
                                    <input type="text" name="payment_method" class="form-control"
                                           id="exampleInputEmail1" value="{{$receipt->payment_method}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tổng số tiền</label>
                                    <input type="text" name="total_money" class="form-control" id="exampleInputEmail1"
                                           value="{{$receipt->total_money}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ngày mua</label>
                                    <input type="text" name="total_money" class="form-control" id="exampleInputEmail1"
                                           value="{{$receipt->receipt_date}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Trạng thái</label>
                                    <select name="receipt_status" class="form-control input-sm m-bot15" required>
                                        <option value="1">Xác nhận</option>
                                        <option value="2">Đã giao cho đơn vị vận chuyển</option>
                                        <option value="3">Đã giao hàng</option>
                                        <option value="4">Hủy đơn hàng</option>
                                    </select>
                                </div>
                                <button type="submit" name="admin_edit_receipt"
                                        class="btn btn-info update_receipt_success">Cập nhật
                                </button>
                                {{--                                button back to href--}}
                                <button type="button" class="btn btn-info"
                                        onclick="window.location='{{ URL::previous() }}'">Quay lại
                                </button>
                            </form>
                        @endforeach
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
