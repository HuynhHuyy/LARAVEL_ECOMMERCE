@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                DANH SÁCH THƯƠNG HIỆU
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
                            <th style="text-align: center;">Tên thương hiệu</th>
                            <th style="text-align: center;">Mô tả</th>
                            <th style="width:100px; text-align: center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($list_brand as $key => $brand)
                            <tr style="text-align: center;">
                                <td style="text-align: center;">{{$i}}</td>
                                <td style="text-align: center;">{{($brand->brand_name)}}</td>
                                <td style="text-align: center;"><span class="text-ellipsis">
                <?php
                                        if ($brand->brand_status == 1){
                                            ?>
                  <a href="{{URL::to('/unactive_brand/'.$brand->brand_id)}}"> <span class="fa fa-eye"
                                                                                    aria-hidden="true"></span></a>
                <?php
                                        }else{
                                            ?>
                  <a href="{{URL::to('/active_brand/'.$brand->brand_id)}}"> <span class="fa fa-eye-slash"
                                                                                  aria-hidden="true"></span></a>
                <?php
                                        }
                                            ?>
              </span></td>
                                {{--                                <td><span class="text-ellipsis">{{$brand->created_at}}</span></td>--}}
                                <td style="text-align: center;">
                                    <a href="{{URL::to('/edit_brand/'.$brand->brand_id)}}" class="btn btn-success"
                                       ui-toggle-class="">
                                        <i class="bi bi-check-square"></i> </a>
                                    <br>
                                    <br>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này không ?')"
                                       href="{{URL::to('/delete_brand/'.$brand->brand_id)}}" class="btn btn-danger"
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
