@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                   THÊM SẢN PHẨM
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save_product')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên sp" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục</label>
                                <select name="product_category" class="form-control input-sm m-bot15" required>
                                    @foreach($category as $key => $category)
                                        <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thương hiệu</label>
                                <select name="product_brand" class="form-control input-sm m-bot15" required>
                                    @foreach($brand as $key => $brand)
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ckeditor1">Mô tả sản phẩm </label>
                                <textarea style="resize:none" rows="5" name="product_desc" class="form-control" id="ckeditor1" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội dung</label>
                                <textarea style="resize:none" rows="5" name="product_content" class="form-control" id="exampleInputPassword1" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Khối lượng</label>
                                <input style="resize:none" rows="5" name="weight" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Giá sản phẩm</label>
                                <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Nập giá sản phẩm" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Số lượng</label>
                                <input type="number" name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Nhập số lượng" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hình ảnh</label>
                                <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" required>
                            </div>
                            <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
