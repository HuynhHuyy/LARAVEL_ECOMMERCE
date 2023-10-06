@extends('layout')
@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">SẢN PHẨM</h1>

        </div>
    </div>
    <!-- Page Header End -->

    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Khoảng giá</h5>
                    <form>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input checkboxprice" value="0"
                                   data-max="1000000" id="price-1">
                            <label class="custom-control-label" for="price-1">0 - 1.000.000 VNĐ</label>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input checkboxprice" value="1000000"
                                   data-max="5000000" id="price-2">
                            <label class="custom-control-label" for="price-2">1.000.000 VNĐ - 5.000.000 VNĐ</label>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input checkboxprice" value="5000000"
                                   data-max="10000000" id="price-3">
                            <label class="custom-control-label" for="price-3">5.000.000 VNĐ - 10.000.000 VNĐ</label>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input checkboxprice" value="10000000"
                                   data-max="20000000" id="price-4">
                            <label class="custom-control-label" for="price-4">10.000.000 VNĐ - 20.000.000 VNĐ</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input checkboxprice" value="20000000"
                                   data-max="1000000000" id="price-5">
                            <label class="custom-control-label" for="price-5">Trên 20.000.000 VNĐ</label>
                        </div>
                    </form>
                </div>
                <!-- Price End -->
                <!-- Category -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Danh mục</h5>
                    <form>
                        @foreach($category as $cate)
                            <div
                                class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input checkboxcategory"
                                       value="{{$cate->category_id}}" id="cate_{{$cate->category_id}}">
                                <label class="custom-control-label"
                                       for="cate_{{$cate->category_id}}">{{$cate->category_name}}</label>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Category End -->
                <!-- Brand Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Thương hiệu</h5>
                    <form>
                        @foreach($brand as $br)
                            <div
                                class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input checkboxbrand"
                                       value="{{$br->brand_id}}" id="brand_{{$br->brand_id}}">
                                <label class="custom-control-label"
                                       for="brand_{{$br->brand_id}}">{{$br->brand_name}}</label>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Color End -->


            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12 ">
                <div class="row pb-3  display-search">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="dropdown ml-4">
                            </div>
                        </div>
                    </div>
                    @foreach($product as $key => $pd)
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <form>
                                    @csrf
                                    <input type="hidden" value="{{$pd->product_id}}"
                                           class="cart_product_id_{{$pd->product_id}}">
                                    <input type="hidden" value="{{$pd->product_name}}"
                                           class="cart_product_name_{{$pd->product_id}}">
                                    <input type="hidden" value="{{$pd->product_image}}"
                                           class="cart_product_image_{{$pd->product_id}}">
                                    <input type="hidden" value="{{$pd->product_price}}"
                                           class="cart_product_price_{{$pd->product_id}}">
                                    <input type="hidden" value="1" class="cart_product_qty_{{$pd->product_id}}">
                                    <input type="hidden" value="{{$pd->weight}}" class="cart_product_weight_{{$pd->product_id}}">
                                    <div
                                        class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        <img src="upload/product/{{($pd->product_image)}}" style="width:100%;object-fit:cover;" height="263" width="263">
                                    </div>
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                        <h6 class="text-truncate mb-3">{{$pd->product_name}}</h6>
                                        <div class="d-flex justify-content-center">
                                            <h6>{{number_format($pd->product_price).' VNĐ'}}</h6>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between bg-light border">
                                        <a href="{{URL::to('/product_details/'.$pd->product_id)}} "
                                           class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>XEM
                                            CHI TIẾT</a>
                                        {{--check validate user login--}}
                                        @if(Session::get('user_id'))
                                            <button value="{{$pd->product_id}}" id="data-id" type="button"
                                                    class="btn btn-sm text-dark p-0 add_cart"
                                                    onclick="add_cart({{$pd->product_id}})"><i
                                                    class="fas fa-shopping-cart text-primary mr-1"></i>THÊM VÀO GIỎ HÀNG
                                            </button>
                                        @else
                                            <button value="{{$pd->product_id}}" id="data-id" type="button"
                                                    class="btn btn-sm text-dark p-0 cart_login"
                                                    onclick="cart_login({{$pd->product_id}})">
                                                <i class="fas fa-shopping-cart text-primary mr-1"></i>THÊM VÀO GIỎ HÀNG
                                            </button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

@endsection
