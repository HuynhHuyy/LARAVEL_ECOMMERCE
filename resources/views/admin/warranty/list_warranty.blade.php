@extends('admin_layout')
@section('admin_content')

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                DANH SÁCH PHIẾU BẢO HÀNH
            </div>

            <div class="table-responsive">
                <?php $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <form>
                    @csrf
                    <table id="myTables" class="table table-striped b-t b-light">
                        <thead>
                        <tr>
                            <th style="width:20px; text-align: center">No</th>
                            <th style="text-align: center;">Tên khách hàng</th>
                            <th style="text-align: center;">Số điện thoại</th>
                            <th style="width:100px; text-align: center">Email</th>
                            <th style="width:100px; text-align: center">Địa chỉ</th>
                            <th style="width:100px; text-align: center">Sản phẩm</th>
                            <th style="width:100px; text-align: center">Tình trạng</th>
                            <th style="width:100px; text-align: center">Ngày nhận</th>
                            <th style="width:100px; text-align: center">Ngày dự kiến trả</th>
                            <th style="width:100px; text-align: center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($list_warranty as $key => $warranty)
                            <tr style="text-align: center;">
                                <td style="text-align: center;">{{$i}}</td>
                                <td style="text-align: center;">{{($warranty->customer_name)}}</td>
                                <td style="text-align: center;">{{($warranty->customer_phone)}}</td>
                                <td style="text-align: center;">{{($warranty->customer_email)}}</td>
                                <td style="text-align: center;">{{($warranty->customer_address)}}</td>
                                <td style="text-align: center;">{{($warranty->product_name)}}</td>
                                <td>
                                    @if($warranty->warranty_status == 0)
                                        <span class="text-warning">Tiếp nhận yêu cầu</span>
                                    @elseif($warranty->warranty_status == 1)
                                        <span class="text-warning">Đang bảo hành</span>
                                    @elseif($warranty->warranty_status == 2)
                                        <span class="text-success">Đã bảo hành xong</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">{{($warranty->warranty_date)}}</td>
                                <td style="text-align: center;">{{($warranty->return_date)}}</td>

                                <td style="text-align: center;">
                                    <a href="{{URL::to('/edit_warranty/'.$warranty->warranty_id)}}" class="btn btn-success">
                                        <i class="bi bi-check-square"></i> </a>
                                    <br>
                                    <br>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa phiếu bảo hành này không ?')"
                                       href="{{URL::to('/delete_warranty/'.$warranty->warranty_id)}}" class="btn btn-danger delete_warranty_success">
                                        <i class="bi bi-trash"></i></a>
                                    <br>
                                    <br>
                                    <a href="{{URL::to('/print_warranty/'.$warranty->warranty_id)}}" class="btn btn-warning">
                                        <i class="bi bi-printer"></i></a>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
