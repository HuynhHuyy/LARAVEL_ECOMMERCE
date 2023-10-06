@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    THÊM DANH MỤC
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save_category')}}" method="POST">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trạng thái</label>
                                <select name="category_status" class="form-control input-sm m-bot15" required>
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiện</option>
                                </select>
                            </div>
                            <button type="submit"  class="btn btn-info">Thêm danh mục</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
