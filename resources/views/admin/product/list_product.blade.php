@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                DANH SÁCH SẢN PHẨM
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
                            <th style="text-align: center;">Tên sản phẩm</th>
                            <th style="text-align: center;">Số lượng</th>
                            <th style="text-align: center;">Giá</th>
                            <th style="text-align: center;">Hình ảnh</th>
                            <th style="text-align: center;">Danh mục</th>
                            <th style="text-align: center;">Khối lượng</th>
                            <th style="text-align: center;">Thương hiệu</th>
{{--                            <th style="text-align: center;">Tình trạng</th>--}}
                            <th style="width:100px; text-align: center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($list_product as $key => $product)
                            <tr style="text-align: center;">
                                <td style="text-align: center;"> {{ $i}} </td>
                                <td style="text-align: center;">{{($product->product_name)}}</td>
                                {{--                                <td><a href="{{URL::to('/add_gallery/'.$product->product_id)}}">Thêm sản phẩm trưng bày</a></td>--}}
                                <td style="text-align: center;">{{($product->product_quantity)}}</td>
                                <td style="text-align: center;">{{($product->product_price)}}</td>
                                <td style="text-align: center;"><img src="upload/product/{{($product->product_image)}}"
                                                                     height="100" width="100"></td>
                                <td style="text-align: center;">{{($product->category_name)}}</td>
                                <td style="text-align: center;">{{($product->weight)}}</td>
                                <td style="text-align: center;">{{$product->brand_name}}</td>
                                <td style="text-align: center;">
                                    <a href="{{URL::to('/edit_product/'.$product->product_id)}}" class="btn btn-success"
                                       ui-toggle-class="">
                                        <i class="bi bi-check-square"></i> </a>
                                    <br>
                                    <br>
                                    <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')"
                                       href="{{URL::to('/delete_product/'.$product->product_id)}}"
                                       class="btn btn-danger" ui-toggle-class="">
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
