@extends('layout')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">SẢN PHẨM BẢO HÀNH</h1>
        </div>
    </div>
    <!-- Page Header End -->
    <div class="table-responsive">
        <form>
            @csrf
            <table id="myTables" class="table table-striped b-t b-light">
                <thead>
                <tr style="text-align: center;">
                    <th style="text-align: center;">STT</th>
                    <th style="text-align: center;">Tên khách hàng</th>
                    <th style="text-align: center;">Số điện thoại</th>
                    <th style="text-align: center;">Sản phẩm bảo hành</th>
                    <th style="text-align: center;">Trạng thái</th>
                    <th style="text-align: center;">Ngày nhận sản phẩm</th>
                    <th style="text-align: center;">Ngày trả sản phẩm</th>
                    <th style="text-align: center;">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list_warranty as $key => $warranty)
                    <tr style="text-align: center;">
                        <td style="text-align: center;"> {{ $key + 1}} </td>
                        <td style="text-align: center;">{{$warranty->customer_name}}</td>
                        <td style="text-align: center;">{{$warranty->customer_phone}}</td>
                        <td style="text-align: center;">{{$warranty->product_name}}</td>
                        <td style="text-align: center;">

                            @if($warranty->warranty_status == 0)
                                <span class="text-warning">Yêu cầu đã được tiếp nhận</span>

                            @elseif($warranty->warranty_status == 1)
                                <span class="text-warning">Đang xử lý</span>
                            @elseif($warranty->warranty_status == 2)
                                <span class="text-success">Đã bảo hành xong</span>
                            @endif
                        </td>
                        <td style="text-align: center;">{{$warranty->warranty_date}}</td>
                        <td style="text-align: center;">{{$warranty->return_date}}</td>
                            <td style="text-align: center;">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#warranty_details-{{$warranty->warranty_id}}">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="warranty_details-{{$warranty->warranty_id}}" tabindex="-1"
                         role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-uppercase font-weight-bold"
                                        id="exampleModalCenterTitle">Chi tiết phiếu bảo hành</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            Mã phiếu bảo hành:
                                        </div>
                                        <div class="col-md-6">
                                            {{$warranty->warranty_id}}
                                        </div>
                                        <div class="col-md-6 font-weight-bold">
                                            Tên khách hàng:
                                        </div>
                                        <div class="col-md-6">
                                            {{$warranty->customer_name}}
                                        </div>
                                        <div class="col-md-6 font-weight-bold">
                                            Số điện thoại:
                                        </div>
                                        <div class="col-md-6">
                                            {{$warranty->customer_phone}}
                                        </div>
                                        <div class="col-md-6 font-weight-bold">
                                            Địa chỉ:
                                        </div>
                                        <div class="col-md-6">
                                            {{$warranty->customer_address}}
                                        </div>
                                        <div class="col-md-6 font-weight-bold">
                                            Sản phẩm:
                                        </div>
                                        <div class="col-md-6">
                                            {{$warranty->product_name}}
                                        </div>
                                        <div class="col-md-6 font-weight-bold">
                                            Trạng thái:
                                        </div>
                                        <div class="col-md-6">
                                            @if($warranty->warranty_status == 0)
                                                <span class="text-warning">Yêu cầu đã được tiếp nhận</span>
                                            @elseif($warranty->warranty_status == 1)
                                                <span class="text-warning">Đang xử lý</span>
                                            @elseif($warranty->warranty_status == 2)
                                                <span class="text-success">Đã bảo hành xong</span>
                                            @endif
                                        </div>

                                        <div class="col-md-6 font-weight-bold">
                                            Ngày nhận sản phẩm:
                                        </div>
                                        <div class="col-md-6">
                                            {{$warranty->warranty_date}}
                                        </div>
                                        <div class="col-md-6 font-weight-bold">
                                            Ngày dự kiến trả sản phẩm
                                        </div>
                                        <div class="col-md-6">
                                            {{$warranty->return_date}}
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

    <!-- Profile End -->
@endsection
