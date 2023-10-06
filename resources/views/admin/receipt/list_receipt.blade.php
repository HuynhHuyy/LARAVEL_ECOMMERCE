@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="input-group">
            <input type="text" name="search" id="search-receipt" class="form-control search" placeholder="Tìm kiếm hóa đơn">
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                DANH SÁCH HÓA ĐƠN
            </div>

            <div class="table-responsive">
                <?php $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
                <form  action="{{URL::to('/save_warranty')}}" method="POST">
                    @csrf
                    <table id="myTables" class="table table-striped b-t b-light">
                        <thead>
                        <tr style="text-align: center;">
                            <th  style="width:20px; text-align: center">No</th>
                            <th style="text-align: center;">Tên khách hàng</th>
                            <th style="text-align: center;">Email khách hàng</th>
                            <th style="text-align: center;">Số điện thoại</th>
                            <th style="text-align: center;">Địa chỉ</th>
                            <th style="text-align: center;">Sản phẩm mua</th>
                            <th style="text-align: center;">Tống tiền thanh toán</th>
                            <th style="text-align: center;">Ngày mua</th>
                            <th style="text-align: center;">Trạng thái</th>
                            <th style="width:100px; text-align: center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody class="display-search-receipt">
                        @foreach($list_receipt as $key => $receipt)
                            <tr style="text-align: center;">
                                <td style="text-align: center;">{{$key + 1}}</td>
                                <td style="text-align: center;">{{($receipt->customer_name)}}</td>
                                <td style="text-align: center;">{{($receipt->customer_email)}}</td>
                                <td style="text-align: center;">{{($receipt->customer_phone)}}</td>
                                <td style="text-align: center;">{{($receipt->customer_address)}}</td>
                                <td style="text-align: center;">{{($receipt->receipt_product)}}</td>
                                <td style="text-align: center;">{{($receipt->total_money)}}</td>
                                <td style="text-align: center;">{{($receipt->receipt_date)}}</td>
                                <td>
                                    @if($receipt->receipt_status == 0)
                                        <span class="text-danger">Chưa xử lý</span>
                                    @elseif($receipt->receipt_status == 1)
                                        <span class="text-success">Đang chuẩn bị hàng</span>
                                    @elseif($receipt->receipt_status == 2)
                                        <span class="text-success">Đã giao cho đơn vị vận chuyển</span>
                                    @elseif($receipt->receipt_status == 3)
                                        <span class="text-success">Đã giao hàng</span>
                                    @elseif($receipt->receipt_status == 4)
                                        <span class="text-danger">Đã hủy</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <a type="button" class="btn btn-success" href="/show_warranty/{{$receipt->receipt_id}}">
                                        <i class="bi bi-capsule"></i> Bảo hành
                                    </a>
                                    <br>
                                    <br>

                                    <a href="{{URL::to('/edit_receipt/'.$receipt->receipt_id)}}" class="btn btn-success">
                                        <i class="bi bi-check-square"></i> </a>
                                    <br>
                                    <br>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa hóa đơn này không ?')"  href="{{URL::to('/delete_receipt/'.$receipt->receipt_id)}}" class="btn btn-danger delete_receipt_success" ui-toggle-class="">
                                        <i class="bi bi-trash"></i></a>
                                    <br>
                                    <br>
                                    <a href="{{URL::to('/print_receipt/'.$receipt->receipt_id)}}" class="btn btn-warning">
                                        <i class="bi bi-printer"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
