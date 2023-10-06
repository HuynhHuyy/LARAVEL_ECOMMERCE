@extends('layout')
@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">TÀI KHOẢN</h1>
        </div>
    </div>
    <!-- Page Header End -->
    <!-- Page Profile Start -->
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <span class="font-weight-bold">Edogaru</span>
                    <span class="text-black-50">edogaru@mail.com.my</span>
                    <span> </span>
                </div>
            </div>
            <div class="col-md-8 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">THÔNG TIN TÀI KHOẢN</h4>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Họ và tên:</label><input type="text" class="form-control"disabled  value=""></div>
                        <div class="col-md-6"><label class="labels">Email:</label><input type="text" class="form-control" disabled value="" ></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Số điện thoại:</label><input type="text" class="form-control" disabled value=""></div>
                        <div class="col-md-6"><label class="labels">Địa chỉ:</label><input type="text" class="form-control" disabled value="" ></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Mật khẩu:</label><input type="text" class="form-control" disabled value=""></div>
                    </div>
                  
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Quay lại</button></div>
                </div>
            </div>
           
        </div>
    </div>
    
    
    <!-- Profile End -->
@endsection
