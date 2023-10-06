@extends('layout')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">THANH TOÁN</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <form id="formCheckout" action="{{URL::to('/save_receipt')}}" method="POST">
            @csrf
            <div class="row px-xl-5">
                <div class="col-lg-8">

                    <div class="mb-4">
                        <h4 class="font-weight-semi-bold mb-4">Đơn thanh toán</h4>

                        <div class="row">
                            {{--                        select information customer by id--}}
                            @foreach($customer as $key => $customer)
                                <div class="col-md-6 form-group">
                                    <label>Họ và tên</label>
                                    <input class="form-control" name="receipt_customer_name" type="text"
                                           value="{{$customer->customer_name}}" readonly>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Email</label>
                                    <input class="form-control" name="receipt_customer_email" type="text"
                                           value="{{$customer->customer_email}}" readonly>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Số điện thoại</label>
                                    <input class="form-control" name="receipt_customer_phone" type="text"
                                           value="{{$customer->customer_phone}}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Địa chỉ</label>
                                    <input class="form-control" name="receipt_customer_address" type="text"
                                           value="{{Session::get('city_name')}}, {{Session::get('dist_name')}}, {{Session::get('ward_name')}}"
                                           readonly>
                                </div>

                            @endforeach
                            <div class="col-md-6 form-group">
                                <label>Hình thức vận chuyển</label>
                                <input class="form-control" name="shipping_method" type="text"
                                       value="{{Session::get('service_name')}}"
                                       readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Ghi chú</label>
                                <textarea class="form-control" name="receipt_customer_note" id="order_notes" cols="30"
                                          rows="5"
                                          placeholder="Chú thích thêm cho người vận chuyển(ví dụ: tên đường, thôn, ấp,đặc điểm nơi nhận hàng,...)"></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="payment">Phương thức thanh toán:</label>
                                <select class="form-control" name="payment" id="payment">
                                    <option value="cod_payment">COD(Thanh toán khi nhận hàng)</option>
                                    <option value="vnpay">VNPAY</option>
                                </select>


                            </div>


                        </div>

                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Tổng thanh toán</h4>
                        </div>
                        <div class="card-body">
                            <h5 class="font-weight-medium mb-3">Sản phẩm đã chọn</h5>
                            @php
                                $total =0;
                                $count = 1;
                            @endphp
                            @foreach(Session::get('cart') as $key => $cart)

                                <div class="d-flex justify-content-between">
                                    <input type="hidden" value="{{$cart['product_name']}}" name="receipt_product[]">
                                    <p name="receipt_product"> {{$cart['product_name']}}</p>
                                    <p> {{number_format($cart['product_price'])}}</p>
                                </div>
                                <hr class="mt-0">
                                @php
                                    $sum = $cart['product_price'] * $cart['product_qty'];
                                    $total += $sum;
                                @endphp
                            @endforeach
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-medium">Tổng giá trị</h6>
                                <h6 class="font-weight-medium"> {{number_format($total)}}</h6>
{{--                                <h6 class="font-weight-medium"> {{number_format(Session::get('product_weight'))}}</h6>--}}
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Phí vận chuyển</h6>
                                <h6 class="font-weight-medium">{{ number_format(Session::get('fee'))}}</h6>
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-bold">Chi phí cần thanh toán</h5>
                                <input type="hidden" value="{{Session::get('fee') + $total}}" name="total_money">
                                <h5 class="font-weight-bold">{{ number_format(Session::get('fee') + $total)}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card border-secondary mb-5">
                        <div class="card-footer border-secondary bg-transparent">
                            <button name="redirect" id="btn_payment" type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3 paymentsuccess">
                                Thanh toán
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
{{--        <form action="/vnpay_payment" method="post">--}}
{{--            @csrf--}}
{{--            <button type="submit" class="btn btn-primary" name="redirect" >VNPAY</button>--}}
{{--        </form>--}}
    </div>

    <!-- Checkout End -->
@endsection
