@extends('admin_layout')
@section('admin_content')

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                DANH SÁCH KHÁCH HÀNG
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
                        <tr style="text-align: center;">
                            <th style="width:20px; text-align: center">No</th>
                            <th style="text-align: center;">Tên khách hàng</th>
                            <th style="text-align: center;">Email</th>
                            <th style="text-align: center;">Mật khẩu</th>
                            <th style="text-align: center;">Số điện thoại</th>
                            <th style="text-align: center;">Địa chỉ</th>
                            <th style="width:100px; text-align: center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($list_user as $key => $user)
                            <tr style="text-align: center;">
                                <td style="text-align: center;">{{$i}}</td>
                                <td style="text-align: center;">{{($user->customer_name)}}</td>
                                <td style="text-align: center;"><span
                                        class="text-ellipsis">{{$user->customer_email}}</span></td>
                                <td style="text-align: center;"><span
                                        class="text-ellipsis">{{$user->customer_password}}</span></td>
                                <td style="text-align: center;"><span
                                        class="text-ellipsis">{{$user->customer_phone}}</span></td>
                                <td style="text-align: center;"><span
                                        class="text-ellipsis">{{$user->customer_address}}</span></td>
                                <td style="text-align: center;">
                                    <a href="{{URL::to('/edit_user/'.$user->customer_id)}}" class="btn btn-success"
                                       ui-toggle-class="">
                                        <i class="bi bi-check-square"></i> </a>
                                    <br>
                                    <br>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa khách hàng này không ?')"
                                       href="{{URL::to('/delete_user/'.$user->customer_id)}}" class="btn btn-danger"
                                       ui-toggle-class="">
                                        <i class="bi bi-trash"></i></a>
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
