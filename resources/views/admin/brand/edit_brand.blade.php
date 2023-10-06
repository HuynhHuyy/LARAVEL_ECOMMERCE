@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                   CHỈNH SỬA THƯƠNG HIỆU
                </header>
                <?php $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
                <div class="panel-body">

                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update_brand/'.$edit_brand->brand_id)}}" method="POST">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" value="{{$edit_brand->brand_name}}" name="brand_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên thương hệu" required>
                            </div>
                            <button type="submit" name="add_brand" class="btn btn-info">Cập nhật</button>
                            <button type="button" class="btn btn-info" onclick="window.location='{{ URL::previous() }}'">Quay lại</button>
                        </form>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection
