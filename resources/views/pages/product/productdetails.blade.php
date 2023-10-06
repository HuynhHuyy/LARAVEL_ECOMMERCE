@extends('layout')
@section('content')



    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">CHI TIẾT SẢN PHẨM</h1>

        </div>
    </div>
    <!-- Page Header End -->

    @foreach($product_details as $key=> $item)
    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <form>
            {{csrf_field()}}
            <input type="hidden" value="{{$item->product_id}}" class="cart_product_id_{{$item->product_id}}">
            <input type="hidden" value="{{$item->product_name}}" class="cart_product_name_{{$item->product_id}}">
            <input type="hidden" value="{{$item->product_image}}" class="cart_product_image_{{$item->product_id}}">
            <input type="hidden" value="{{$item->product_price}}" class="cart_product_price_{{$item->product_id}}">
            <input type="hidden" value="1" class="cart_product_qty_{{$item->product_id}}">
            <input type="hidden" value="{{$item->weight}}" class="cart_product_weight_{{$item->product_id}}">
         <div class="row px-xl-5">
            <div class="col-lg-6 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <img src="{{URL::to('upload/product/'.$item->product_image)}}" class="w-100 h-100">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pb-5">
                <h3 class="font-weight-semi-bold">{{$item->product_name}}</h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                </div>

                <h3 class="font-weight-semi-bold mb-4">{{number_format($item->product_price).'VNĐ'}}</h3>
                <p class="mb-4">{{$item->product_content}}</p>
                <div class="d-flex align-items-center mb-4 pt-2">
                        <input name="productid_hidden" type="hidden"  value="{{$item->product_id}}">
                    {{--check validate user login--}}
                    @if(Session::get('user_id'))
                        <button value="{{$item->product_id}}" id="data-id" onclick="add_cart({{$item->product_id}})" type="button" class="btn btn-primary px-3 add_cart"><i class="fa fa-shopping-cart mr-1"></i>THÊM VÀO GIỎ HÀNG</button>
                    @else
                        <button value="{{$item->product_id}}" id="data-id" type="button" class="btn btn-primary px-3 cart_login" onclick="cart_login()"><i class="fa fa-shopping-cart mr-1"></i>THÊM VÀO GIỎ HÀNG</button>
                    @endif
                </div>
            </div>
            </div>
            <div class="row px-xl-5">
                <div class="col">
                    <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                        <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Mô tả</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Thông tin sản phẩm</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Mô tả</h4>
                            <p>{{$item->product_desc}}</p>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Thông tin sản phẩm</h4>
                            <p>{{$item->product_content}}</p>
                        </div>

                    </div>
                </div>
            </div>
         </form>

    </div>
    <!-- Shop Detail End -->
    @endforeach
    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">SẢN PHẨM LIÊN QUAN</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach($related_product as $key=>$related_pd)
                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100 h-100" height="263" width="263" src="{{URL::to('upload/product/'.$related_pd->product_image)}}"  alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{$related_pd->product_name}}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>{{number_format($related_pd->product_price).'VNĐ'}}</h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem chi tiết</a>
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->



@endsection
