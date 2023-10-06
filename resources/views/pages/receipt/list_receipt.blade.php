@extends('layout')
@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">LỊCH SỬ ĐƠN HÀNG</h1>

        </div>
    </div>
    <!-- Page Header End -->

    <!-- Shop Start -->
    <div class="table-agile-info">
        <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Tất cả</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Chờ xác nhận</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Chờ lấy hàng</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-4">Đang giao</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-5">Đã huỷ</a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <div class="table-responsive">
                        <form>
                            @csrf
                            <table id="myTables" class="table table-striped b-t b-light">
                                <thead>
                                <tr style="text-align: center;">
                                    <th style="text-align: center;">STT</th>
                                    <th style="text-align: center;">Mã đơn hàng</th>
                                    <th style="text-align: center;">Sản phẩm</th>
                                    <th style="text-align: center;">Trạng thái</th>
                                    <th style="text-align: center;">Hình thức vận chuyển</th>
                                    <th style="text-align: center;">Loại thanh toán</th>
                                    <th style="text-align: center;">Ngày đặt</th>
                                    <th style="text-align: center;">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listReceipt as $key => $receipt)
                                    <tr style="text-align: center;">
                                        <td style="text-align: center;"> {{ $key + 1}} </td>
                                        <td style="text-align: center;">{{$receipt->receipt_id}}</td>
                                        <td style="text-align: center;">
                                            {{($receipt->receipt_product)}}
                                        </td>

                                        <td style="text-align: center;">
                                            {{--                                    Chờ xác nhận--}}
                                            @if($receipt->receipt_status == 0)
                                                <span class="text-danger">Chưa xử lý</span>
                                                {{--                                        Chờ lấy hàng--}}
                                            @elseif($receipt->receipt_status == 1)
                                                <span class="text-success">Đang chuẩn bị hàng</span>
                                                {{--                                        Đang giao--}}
                                            @elseif($receipt->receipt_status == 2)
                                                <span class="text-success">Đã giao cho bên vận chuyển</span>
                                            @elseif($receipt->receipt_status == 3)
                                                <span class="text-success">Giao hàng thành công</span>
                                                {{--                                        Hủy đơn--}}
                                            @elseif($receipt->receipt_status == 4)
                                                <span class="text-danger">Đã hủy</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            {{$receipt->shipping_method}}
                                        </td>
                                        <td style="text-align: center;">
                                            {{$receipt->payment_method}}
                                        </td>
                                        <td style="text-align: center;">{{$receipt->receipt_date}}</td>

                                        @if($receipt->receipt_status == 4 ||$receipt->receipt_status == 1 || $receipt->receipt_status == 2 || $receipt->receipt_status == 3)
                                            <td style="text-align: center;">
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target="#total-{{$receipt->receipt_id}}">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </td>
                                        @else
                                            <td style="text-align: center;">
                                                <a onclick="return confirm('Bạn có chắc chắn muốn hủy đơn này không ?')"
                                                   type="button"
                                                   href="{{URL::to('/cancel_receipt/'.$receipt->receipt_id)}}"
                                                   class="cancel_receipt btn btn-danger">
                                                    <i class="bi bi-trash"></i></a>

                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target="#total-{{$receipt->receipt_id}}">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="total-{{$receipt->receipt_id}}" tabindex="-1"
                                         role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-uppercase font-weight-bold"
                                                        id="exampleModalCenterTitle">Chi tiết hóa đơn</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 font-weight-bold">
                                                            Mã hóa đơn:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->receipt_id}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Người nhận:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_name}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Email:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_email}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Số điện thoại:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_phone}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Địa chỉ:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_address}}, {{$receipt->customer_note}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Sản phẩm:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->receipt_product}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Tổng tiền:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{number_format($receipt->total_money,0,',','.')}} VNĐ
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Phương thức thanh toán:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->payment_method}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Phương thức vận chuyển:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->shipping_method}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Trạng thái:
                                                        </div>
                                                        <div class="col-md-6">
                                                            @if($receipt->receipt_status == 0)
                                                                <span class="text-danger">Chưa xử lý</span>
                                                                {{--                                        Chờ lấy hàng--}}
                                                            @elseif($receipt->receipt_status == 1)
                                                                <span class="text-success">Đang chuẩn bị hàng</span>
                                                                {{--                                        Đang giao--}}
                                                            @elseif($receipt->receipt_status == 2)
                                                                <span
                                                                    class="text-success">Đã giao cho bên vận chuyển</span>
                                                            @elseif($receipt->receipt_status == 3)
                                                                <span class="text-success">Giao hàng thành công</span>
                                                                {{--                                        Hủy đơn--}}
                                                            @elseif($receipt->receipt_status == 4)
                                                                <span class="text-danger">Đã hủy</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Đóng
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade show" id="tab-pane-2">
                    <form>
                        @csrf
                        <table id="myTables" class="table table-striped b-t b-light">
                            <thead>
                            <tr style="text-align: center;">
                                <th style="text-align: center;">STT</th>
                                <th style="text-align: center;">Mã đơn hàng</th>
                                <th style="text-align: center;">Sản phẩm</th>
                                <th style="text-align: center;">Hình thức vận chuyển</th>
                                <th style="text-align: center;">Loại thanh toán</th>
                                <th style="text-align: center;">Ngày đặt</th>
                                <th style="text-align: center;">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listReceipt as $key => $receipt)
                                @if($receipt->receipt_status == 0)
                                    <tr style="text-align: center;">
                                        <td style="text-align: center;"> {{ $key + 1}} </td>
                                        <td style="text-align: center;">{{$receipt->receipt_id}}</td>
                                        <td style="text-align: center;">
                                            {{($receipt->receipt_product)}}
                                        </td>
                                        <td style="text-align: center;">
                                            {{$receipt->shipping_method}}
                                        </td>
                                        <td style="text-align: center;">
                                            {{$receipt->payment_method}}
                                        </td>
                                        <td style="text-align: center;">{{$receipt->receipt_date}}</td>
                                        <td style="text-align: center;">
                                            <a onclick="return confirm('Bạn có chắc chắn muốn hủy đơn này không ?')"
                                               type="button" href="{{URL::to('/cancel_receipt/'.$receipt->receipt_id)}}"
                                               class="cancel_receipt btn btn-danger">
                                                <i class="bi bi-trash"></i></a>

                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#wait_accept-{{$receipt->receipt_id}}">
                                                <i class="bi bi-eye"></i>
                                            </button>

                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="wait_accept-{{$receipt->receipt_id}}" tabindex="-1"
                                         role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-uppercase font-weight-bold"
                                                        id="exampleModalCenterTitle">Chi tiết hóa đơn</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 font-weight-bold">
                                                            Mã hóa đơn:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->receipt_id}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Người nhận:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_name}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Email:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_email}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Số điện thoại:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_phone}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Địa chỉ:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_address}}, {{$receipt->customer_note}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Sản phẩm:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->receipt_product}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Tổng tiền:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{number_format($receipt->total_money,0,',','.')}} VNĐ
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Phương thức thanh toán:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->payment_method}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Phương thức vận chuyển:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->shipping_method}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Trạng thái:
                                                        </div>
                                                        <div class="col-md-6">
                                                            @if($receipt->receipt_status == 0)
                                                                <span class="text-danger">Chưa xử lý</span>
                                                                {{--                                        Chờ lấy hàng--}}
                                                            @elseif($receipt->receipt_status == 1)
                                                                <span class="text-success">Đang chuẩn bị hàng</span>
                                                                {{--                                        Đang giao--}}
                                                            @elseif($receipt->receipt_status == 2)
                                                                <span
                                                                    class="text-success">Đã giao cho bên vận chuyển</span>
                                                            @elseif($receipt->receipt_status == 3)
                                                                <span class="text-success">Giao hàng thành công</span>
                                                                {{--                                        Hủy đơn--}}
                                                            @elseif($receipt->receipt_status == 4)
                                                                <span class="text-danger">Đã hủy</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Đóng
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="tab-pane fade show" id="tab-pane-3">
                    <form>
                        @csrf
                        <table id="myTables" class="table table-striped b-t b-light">
                            <thead>
                            <tr style="text-align: center;">
                                <th style="text-align: center;">STT</th>
                                <th style="text-align: center;">Mã đơn hàng</th>
                                <th style="text-align: center;">Sản phẩm</th>
                                <th>Trạng thái</th>
                                <th style="text-align: center;">Hình thức vận chuyển</th>
                                <th style="text-align: center;">Loại thanh toán</th>
                                <th style="text-align: center;">Ngày đặt</th>
                                <th style="text-align: center;">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listReceipt as $key => $receipt)
                                @if($receipt->receipt_status == 1)
                                    <tr style="text-align: center;">
                                        <td style="text-align: center;"> {{ $key + 1}} </td>
                                        <td style="text-align: center;">{{$receipt->receipt_id}}</td>
                                        <td style="text-align: center;">
                                            {{($receipt->receipt_product)}}
                                        </td>
                                        <td style="text-align: center;">
                                            @if($receipt->receipt_status == 0)
                                                <span class="text-danger">Chưa xử lý</span>
                                                {{--                                        Chờ lấy hàng--}}
                                            @elseif($receipt->receipt_status == 1)
                                                <span class="text-success">Đang chuẩn bị hàng</span>
                                                {{--                                        Đang giao--}}
                                            @elseif($receipt->receipt_status == 2)
                                                <span class="text-success">Đã giao cho bên vận chuyển</span>
                                            @elseif($receipt->receipt_status == 3)
                                                <span class="text-success">Giao hàng thành công</span>
                                                {{--                                        Hủy đơn--}}
                                            @elseif($receipt->receipt_status == 4)
                                                <span class="text-danger">Đã hủy</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            {{$receipt->shipping_method}}
                                        </td>
                                        <td style="text-align: center;">
                                            {{$receipt->payment_method}}
                                        </td>
                                        <td style="text-align: center;">{{$receipt->receipt_date}}</td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#wait_pickup-{{$receipt->receipt_id}}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="wait_pickup-{{$receipt->receipt_id}}" tabindex="-1"
                                         role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-uppercase font-weight-bold"
                                                        id="exampleModalCenterTitle">Chi tiết hóa đơn</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 font-weight-bold">
                                                            Mã hóa đơn:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->receipt_id}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Người nhận:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_name}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Email:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_email}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Số điện thoại:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_phone}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Địa chỉ:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_address}}, {{$receipt->customer_note}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Sản phẩm:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->receipt_product}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Tổng tiền:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{number_format($receipt->total_money,0,',','.')}} VNĐ
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Phương thức thanh toán:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->payment_method}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Phương thức vận chuyển:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->shipping_method}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Trạng thái:
                                                        </div>
                                                        <div class="col-md-6">
                                                            @if($receipt->receipt_status == 0)
                                                                <span class="text-danger">Chưa xử lý</span>
                                                                {{--                                        Chờ lấy hàng--}}
                                                            @elseif($receipt->receipt_status == 1)
                                                                <span class="text-success">Đang chuẩn bị hàng</span>
                                                                {{--                                        Đang giao--}}
                                                            @elseif($receipt->receipt_status == 2)
                                                                <span
                                                                    class="text-success">Đã giao cho bên vận chuyển</span>
                                                            @elseif($receipt->receipt_status == 3)
                                                                <span class="text-success">Giao hàng thành công</span>
                                                                {{--                                        Hủy đơn--}}
                                                            @elseif($receipt->receipt_status == 4)
                                                                <span class="text-danger">Đã hủy</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Đóng
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="tab-pane fade show" id="tab-pane-4">
                    <form>
                        @csrf
                        <table id="myTables" class="table table-striped b-t b-light">
                            <thead>
                            <tr style="text-align: center;">
                                <th style="text-align: center;">STT</th>
                                <th style="text-align: center;">Mã đơn hàng</th>
                                <th style="text-align: center;">Sản phẩm</th>
                                <th style="text-align: center;">Trạng thái</th>
                                <th style="text-align: center;">Hình thức vận chuyển</th>
                                <th style="text-align: center;">Loại thanh toán</th>
                                <th style="text-align: center;">Ngày đặt</th>
                                <th style="text-align: center;">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listReceipt as $key => $receipt)
                                @if($receipt->receipt_status == 2 || $receipt->receipt_status == 3)
                                    <tr style="text-align: center;">
                                        <td style="text-align: center;"> {{ $key + 1}} </td>
                                        <td style="text-align: center;">{{$receipt->receipt_id}}</td>
                                        <td style="text-align: center;">
                                            {{($receipt->receipt_product)}}
                                        </td>
                                        <td style="text-align: center;">
                                            @if($receipt->receipt_status == 0)
                                                <span class="text-danger">Chưa xử lý</span>
                                                {{--                                        Chờ lấy hàng--}}
                                            @elseif($receipt->receipt_status == 1)
                                                <span class="text-success">Đang chuẩn bị hàng</span>
                                                {{--                                        Đang giao--}}
                                            @elseif($receipt->receipt_status == 2)
                                                <span class="text-success">Đã giao cho bên vận chuyển</span>
                                            @elseif($receipt->receipt_status == 3)
                                                <span class="text-success">Giao hàng thành công</span>
                                                {{--                                        Hủy đơn--}}
                                            @elseif($receipt->receipt_status == 4)
                                                <span class="text-danger">Đã hủy</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            {{$receipt->shipping_method}}
                                        </td>
                                        <td style="text-align: center;">
                                            {{$receipt->payment_method}}
                                        </td>
                                        <td style="text-align: center;">{{$receipt->receipt_date}}</td>
                                        @if($receipt->receipt_status == 2)
                                            <td style="text-align: center;">
                                                <a onclick="return confirm('Bạn có chắc chắn xác nhận đơn này không ?')"
                                                   type="button"
                                                   href="{{URL::to('/confirm_receipt/'.$receipt->receipt_id)}}"
                                                   class="cancel_receipt btn btn-warning">
                                                    <i class="bi bi-check"></i></a>
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target="#delivering-{{$receipt->receipt_id}}">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </td>
                                        @else
                                            <td style="text-align: center;">
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target="#delivering-{{$receipt->receipt_id}}">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="delivering-{{$receipt->receipt_id}}" tabindex="-1"
                                         role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-uppercase font-weight-bold"
                                                        id="exampleModalCenterTitle">Chi tiết hóa đơn</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 font-weight-bold">
                                                            Mã hóa đơn:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->receipt_id}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Người nhận:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_name}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Email:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_email}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Số điện thoại:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_phone}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Địa chỉ:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_address}}, {{$receipt->customer_note}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Sản phẩm:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->receipt_product}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Tổng tiền:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{number_format($receipt->total_money,0,',','.')}} VNĐ
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Phương thức thanh toán:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->payment_method}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Phương thức vận chuyển:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->shipping_method}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Trạng thái:
                                                        </div>
                                                        <div class="col-md-6">
                                                            @if($receipt->receipt_status == 0)
                                                                <span class="text-danger">Chưa xử lý</span>
                                                                {{--                                        Chờ lấy hàng--}}
                                                            @elseif($receipt->receipt_status == 1)
                                                                <span class="text-success">Đang chuẩn bị hàng</span>
                                                                {{--                                        Đang giao--}}
                                                            @elseif($receipt->receipt_status == 2)
                                                                <span
                                                                    class="text-success">Đã giao cho bên vận chuyển</span>
                                                            @elseif($receipt->receipt_status == 3)
                                                                <span class="text-success">Giao hàng thành công</span>
                                                                {{--                                        Hủy đơn--}}
                                                            @elseif($receipt->receipt_status == 4)
                                                                <span class="text-danger">Đã hủy</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Đóng
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="tab-pane fade show" id="tab-pane-5">
                    <form>
                        @csrf
                        <table id="myTables" class="table table-striped b-t b-light">
                            <thead>
                            <tr style="text-align: center;">
                                <th style="text-align: center;">STT</th>
                                <th style="text-align: center;">Mã đơn hàng</th>
                                <th style="text-align: center;">Sản phẩm</th>
                                <th style="text-align: center;">Hình thức vận chuyển</th>
                                <th style="text-align: center;">Loại thanh toán</th>
                                <th style="text-align: center;">Ngày đặt</th>
                                <th style="text-align: center;">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listReceipt as $key => $receipt)
                                @if($receipt->receipt_status == 4)
                                    <tr style="text-align: center;">
                                        <td style="text-align: center;"> {{ $key + 1}} </td>
                                        <td style="text-align: center;">{{$receipt->receipt_id}}</td>
                                        <td style="text-align: center;">
                                            {{($receipt->receipt_product)}}
                                        </td>
                                        <td style="text-align: center;">
                                            {{$receipt->shipping_method}}
                                        </td>
                                        <td style="text-align: center;">
                                            {{$receipt->payment_method}}
                                        </td>
                                        <td>{{$receipt->receipt_date}}</td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#canceled-{{$receipt->receipt_id}}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="canceled-{{$receipt->receipt_id}}" tabindex="-1"
                                         role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-uppercase font-weight-bold"
                                                        id="exampleModalCenterTitle">Chi tiết hóa đơn</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 font-weight-bold">
                                                            Mã hóa đơn:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->receipt_id}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Người nhận:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_name}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Email:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_email}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Số điện thoại:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_phone}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Địa chỉ:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->customer_address}}, {{$receipt->customer_note}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Sản phẩm:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->receipt_product}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Tổng tiền:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{number_format($receipt->total_money,0,',','.')}} VNĐ
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Phương thức thanh toán:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->payment_method}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Phương thức vận chuyển:
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$receipt->shipping_method}}
                                                        </div>
                                                        <div class="col-md-6 font-weight-bold">
                                                            Trạng thái:
                                                        </div>
                                                        <div class="col-md-6">
                                                            @if($receipt->receipt_status == 0)
                                                                <span class="text-danger">Chưa xử lý</span>
                                                                {{--                                        Chờ lấy hàng--}}
                                                            @elseif($receipt->receipt_status == 1)
                                                                <span class="text-success">Đang chuẩn bị hàng</span>
                                                                {{--                                        Đang giao--}}
                                                            @elseif($receipt->receipt_status == 2)
                                                                <span
                                                                    class="text-success">Đã giao cho bên vận chuyển</span>
                                                            @elseif($receipt->receipt_status == 3)
                                                                <span class="text-success">Giao hàng thành công</span>
                                                                {{--                                        Hủy đơn--}}
                                                            @elseif($receipt->receipt_status == 4)
                                                                <span class="text-danger">Đã hủy</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Đóng
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop End -->
@endsection
