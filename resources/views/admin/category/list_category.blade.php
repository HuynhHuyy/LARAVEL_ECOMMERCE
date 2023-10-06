@extends('admin_layout')
@section('admin_content')

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                DANH SÁCH DANH MỤC
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
                            <th style="text-align: center;">Tên danh mục</th>
                            <th style="text-align: center;">Hiển thị</th>
                            <th style="width:100px; text-align: center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($list_category as $key => $cate)
                            <tr style="text-align: center;">
                                <td style="text-align: center;">{{$i}}</td>
                                <td style="text-align: center;">{{($cate->category_name)}}</td>
                                <td style="text-align: center;"><span class="text-ellipsis">
                      <?php
                                        if ($cate->category_status == 1){
                                            ?>
                  <a href="{{URL::to('/unactive_category/'.$cate->category_id)}}"> <span class="fa fa-eye"
                                                                                         aria-hidden="true"></span></a>
                <?php
                                        }else{
                                            ?>
                  <a href="{{URL::to('/active_category/'.$cate->category_id)}}"> <span class="fa fa-eye-slash"
                                                                                       aria-hidden="true"></span></a>
                <?php
                                        }
                                            ?>
              </span></td>
                                <td style="text-align: center;">
                                    <a href="{{URL::to('/edit_category/'.$cate->category_id)}}" class="btn btn-success">
                                        <i class="bi bi-check-square"></i> </a>
                                    <br>
                                    <br>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không ?')"
                                       href="{{URL::to('/delete_category/'.$cate->category_id)}}" class="btn btn-danger">
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
