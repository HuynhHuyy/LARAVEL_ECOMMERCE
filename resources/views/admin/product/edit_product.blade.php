@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    CHỈNH SỬA SẢN PHẨM
                </header>
                <?php $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach($edit_product as $key => $pro)
                        <form role="form" action="{{URL::to('/update_product/' .$pro->product_id)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{$pro->product_name}}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục</label>
                                <select name="product_category" class="form-control input-sm m-bot15" required>
                                    @foreach($category as $key => $category)
                                        @if($category->category_id == $pro->category_id)
                                        <option selected value="{{$category->category_id}}">{{$category->category_name}}</option>
                                        @else
                                            <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thương hiệu</label>
                                <select name="product_brand" class="form-control input-sm m-bot15" required>
                                    @foreach($brand as $key => $brand)
                                        @if($brand->brand_id == $pro->brand_id)
                                        <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        @else
                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ckeditor1">Mô tả sản phẩm </label>
                                <textarea style="resize:none" rows="5" name="product_desc" class="form-control" id="ckeditor1"  required>{{$pro->product_desc}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội dung</label>
                                <textarea style="resize:none" rows="5" name="product_content" class="form-control" id="exampleInputPassword1" required> {{$pro->product_content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Giá sản phẩm</label>
                                <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" value="{{$pro->product_price}}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Khối lượng</label>
                                <input type="text" name="weight" class="form-control" id="exampleInputEmail1" value="{{$pro->weight}}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Số lượng</label>
                                <input type="number" name="product_quantity" class="form-control" id="exampleInputEmail1" value="{{$pro->product_quantity}}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hình ảnh</label>
                                <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" required>
                                <img src="{{URL::to('upload/product/'.$pro->product_image)}}" height="100" width="100">
                            </div>
                            <button type="submit" name="add_product" class="btn btn-info">Cập nhật</button>
                            <button type="button" class="btn btn-info" onclick="window.location='{{ URL::previous() }}'">Quay lại</button>
                        </form>
                        @endforeach
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
