@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    TẠO PHIẾU BẢO HÀNH
                </header>
                <?php $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
                <div class="panel-body">
                    @foreach($edit_warranty as $key => $warranty)
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save_warranty')}}" method="POST">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-6 font-weight-bold">
                                    Tên khách hàng
                                </div>
                                <div class="col-md-6 font-weight-bold">
                                    <input  class="form-control" name="customer_name" value="{{$warranty->customer_name}}" readonly>
                                </div>
                                <div class="col-md-6 font-weight-bold">
                                    Email:
                                </div>
                                <div class="col-md-6 font-weight-bold">
                                    <input class="form-control" name="customer_email" value="{{$warranty->customer_email}}" readonly>

                                </div>
                                <div class="col-md-6 font-weight-bold">
                                    Số điện thoại:
                                </div>
                                <div class="col-md-6 font-weight-bold">

                                    <input class="form-control" name="customer_phone" value="{{$warranty->customer_phone}}" readonly>
                                </div>
                                <div class="col-md-6 font-weight-bold">
                                    Địa chỉ:
                                </div>
                                <div class="col-md-6 font-weight-bold">
                                    <input class="form-control" name="customer_address" value="{{$warranty->customer_address}}, {{$warranty->customer_note}}" readonly>

                                </div>
                                <div class="col-md-6 font-weight-bold">
                                    Sản phẩm cần bảo hành:
                                </div>
                                <div class="col-md-6 font-weight-bold">
                                    <input type="text" name="product_name" class="form-control" placeholder="Nhập sản phẩm" required >
                                </div>
                                <div class="col-md-6 font-weight-bold">
                                    Tình trạng sản phẩm:
                                </div>
                                <div class="col-md-6 font-weight-bold">
                                    <input type="text" name="product_status" class="form-control" placeholder="Nhập tình trạng sản phẩm" required >
                                </div>
                                <div class="col-md-6 font-weight-bold">
                                    Ngày tạo phiếu
                                </div>
                                <div class="col-md-6 font-weight-bold">
                                    <input type="date" name="warranty_date" class="form-control" id="exampleInputEmail1"  required >
                                </div>
                                <div class="col-md-6 font-weight-bold">
                                    Ngày dự kiến trả sản phẩm
                                </div>
                                <div class="col-md-6 font-weight-bold">
                                    <input type="date" name="return_date" class="form-control" id="exampleInputEmail1"required >
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success ">
                            <i class="bi bi-capsule"></i>Tạo phiếu bảo hành
                        </button>
                            <button type="button" class="btn btn-info" onclick="window.location='{{ URL::previous() }}'">Quay lại</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </section>

        </div>
    </div>
@endsection
