@extends('layout')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">GIỎ HÀNG</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @elseif(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <form action="{{url('/update_cart')}}" method="POST">
                    @csrf
                    <table class="table table-bordered text-center mb-0">
                        <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Hình ảnh</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                            <th>Xóa</th>
                        </tr>
                        </thead>
                        <tbody class="align-middle">
                        @php
                            $total =0;
                            $weight =0;
                        @endphp
                        @if(Session::get('cart') == true)
                            @foreach(Session::get('cart') as $key => $cart)
                                @php
                                    $sum = $cart['product_price'] * $cart['product_qty'];
                                    $total += $sum;
                                    $weight += $cart['product_weight'];
                                    Session::put('product_weight',$weight);
                                @endphp
                                <tr>
                                    <td class="align-middle">
                                        {{$cart['product_name']}}
                                        <img src="" alt="" style="width: 50px;">
                                    </td>
                                    <td class="align-middle">
                                        {{number_format($cart['product_price'])}}
                                    </td>
                                    <td class="align-middle">
                                        <img src="{{URL::to('upload/product/'.$cart['product_image'])}}" alt=""
                                             style="width: 50px;">
                                    </td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <input type="number" min="1"
                                                   class="form-control form-control-sm bg-secondary text-center"
                                                   name="cart_qty[{{$cart['session_id']}}]"
                                                   value="{{$cart['product_qty']}}">
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        {{number_format($sum)}}
                                    </td>
                                    <td class="cart_delete">
                                        <a class="btn btn-sm btn-primary"
                                           href="{{url('/delete_cart/'.$cart['session_id'])}}"><i
                                                class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <input type="submit" name="update_qty" value="Cập nhật giỏ hàng"
                                       class="btn btn-primary success_update_allcart ">
                                <a class="btn btn-primary success_delete_allcart">Xóa giỏ hàng</a>
                            </tr>
                        @else
                            <tr>
                                <td colspan="5">Giỏ hàng trống</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tỉnh/Thành phố:</label>
                        <select name="city" id="city" class="form-control input-sm m-bot15 choose city" required>
                            <option value="">--Chọn Tỉnh/Thành--</option>
                            @foreach($city as $key => $ci)
                                <option value="{{$ci['ProvinceID']}}">{{$ci['ProvinceName']}}</option>
                            @endforeach
                        </select>

                        <label for="exampleInputPassword1">Quận/Huyện:</label>
                        <select name="district" id="district" class="form-control input-sm m-bot15 choose district"
                                required>
                            <option value="">--Chọn Quận/Huyện--</option>
                        </select>

                        <label for="exampleInputPassword1">Phường/Xã:</label>
                        <select name="ward" id="ward" class="form-control input-sm m-bot15 choose ward" required>
                            <option value="">--Chọn Phường/Xã--</option>
                        </select>

                        <label for="exampleInputPassword1">Dịch vụ vận chuyển:</label>
                        <select name="service" id="service" class="form-control input-sm m-bot15 service" required>
                            <option value="">--Chọn dịch vụ vận chuyển--</option>
                        </select>
                    </div>
                </form>
                <button class="font-weight-medium calculate_delivery btn btn-block btn-primary" >Tính vận chuyển</button>

                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Thanh toán</h4>
                    </div>
                    <input value="{{$total}}" class="total" type="hidden">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Tổng tiền sản phẩm</h6>
                            <h6 class="font-weight-medium">  {{number_format($total)}}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Phí vận chuyển</h6>
                            @if($total > 0)
                                <h6 class="font-weight-medium fee">{{ number_format(Session::get('fee'))}}</h6>

                            @else
                                <h6 class="font-weight-medium fee">{{ number_format(Session::put('fee',0))}}</h6>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between">

                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Thành tiền</h5>
                            @if(Session::get('cart') == true)
                                <h5 class="font-weight-bold">{{ number_format(Session::get('fee') + $total)}}</h5>
                            @else
                                <h5 class="font-weight-bold"></h5>
                            @endif
                        </div>
                        @php
                            $customer_id = Session::get('user_id');
                        @endphp
                        @if(Session::get('fee')  == 0)
                            <a type="button" class="btn btn-block btn-primary my-3 py-3 check_payment">Thanh toán</a>
                        @else
                            <a href="{{URL::to('/show_checkout/'.$customer_id)}}"
                               class="btn btn-block btn-primary my-3 py-3">Thanh toán</a>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection
