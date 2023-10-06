<?php

namespace App\Http\Controllers;

use App\Mail\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Receipt;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
//Ajax
    public function addCart(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 25), 5);
        $cart = Session::get('cart');
        if ($cart == true) {
            $is_avaiable = 0;
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['cart_product_id']) {
                    $is_avaiable++;
                    $cart[$key] = array(
                        'session_id' => $val['session_id'],
                        'product_name' => $val['product_name'],
                        'product_id' => $val['product_id'],
                        'product_image' => $val['product_image'],
                        'product_qty' => $val['product_qty'] + $data['cart_product_qty'],
                        'product_price' => $val['product_price'],
                        'product_weight' => $val['product_weight'],
                    );
                    Session::put('cart', $cart);
                }
            }
            if ($is_avaiable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_id' => $data['cart_product_id'],
                    'product_name' => $data['cart_product_name'],
                    'product_image' => $data['cart_product_image'],
                    'product_price' => $data['cart_product_price'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_weight' => $data['cart_product_weight'],

                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_id' => $data['cart_product_id'],
                'product_name' => $data['cart_product_name'],
                'product_image' => $data['cart_product_image'],
                'product_price' => $data['cart_product_price'],
                'product_qty' => $data['cart_product_qty'],
                'product_weight' => $data['cart_product_weight'],
            );
        }
        Session::put('cart', $cart);
        Session::save();

        $count_cart = count(Session::get('cart'));
        return $count_cart;

    }

    public function showCart()
    {
        //get provice
        $city = Http::withHeaders([
            'Token' => '14c9ca8d-5ff8-11ed-8636-7617f3863de9',
            'Content-Type' => 'application/json'
        ])->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/province')->json(['data']);
        //get district
        $district = Http::withHeaders([
            'Token' => '14c9ca8d-5ff8-11ed-8636-7617f3863de9',
            'Content-Type' => 'application/json'
        ])->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/district')->json();
        $category = DB::table('tbl_category')->where('category_status', 1)->orderby('category_id', 'desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status', 1)->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.cart_ajax')->with('category', $category)->with('brand', $brand)->with('city', $city);
    }

    public function deleteCart($session_id)
    {
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($cart as $key => $val) {
                if ($val['session_id'] == $session_id)
                    unset($cart[$key]);
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', 'Xóa sản phẩm thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa sản phẩm thất bại');
        }
    }

    public function updateCart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($data['cart_qty'] as $key => $qty) {
                foreach ($cart as $session => $val) {
                    if ($val['session_id'] == $key) {
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            Session::put('cart', $cart);
            return redirect('/show_cart');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thất bại');
        }
    }

    public function deleteAllCart()
    {
        $cart = Session::get('cart');
        if ($cart == true) {
            Session::forget('cart');
            return redirect('/show_cart');
        }
    }

    public function selectDeliveryCart(Request $request)
    {
        $token_api = Http::withHeaders([
            'Token' => '14c9ca8d-5ff8-11ed-8636-7617f3863de9',
            'Content-Type' => 'application/json'
        ]);
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'city') {
                $select_district = $token_api->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/district', [
                    'province_id' => $data['ma_id']
                ])->json(['data']);
                $output .= '<option value="">--Chọn Quận/Huyện--</option>';
                foreach ($select_district as $key => $dist)
                    $output .= '<option value="' . $dist['DistrictID'] . '">' . $dist['DistrictName'] . '</option>';

            } elseif ($data['action'] == 'district') {

                $select_ward = $token_api->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/ward', [
                    'district_id' => $data['ma_id']

                ])->json(['data']);

                $output .= '<option value="">--Chọn Phường/Xã--</option>';
                foreach ($select_ward as $key => $ward)
                    $output .= '<option data-ward="' . $ward['WardCode'] . '" value="' . $ward['DistrictID'] . '">' . $ward['WardName'] . '</option>';
            } else {
                $select_service = $token_api->post('https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/available-services', [
                    'shop_id' => 3434289,
                    'from_district' => 1449,
                    'to_district' => (int)$data['ma_id'],
                ])->json(['data']);
                $output .= '<option value="">--Chọn Dịch Vụ--</option>';
                foreach ($select_service as $key => $service)
                    $output .= '<option value="' . $service['service_id'] . '">' . $service['short_name'] . '</option>';
            }
            echo $output;
        }
    }

    public function calculateDelivery(Request $request)
    {
        $data = $request->all();
        $token_api = Http::withHeaders([
            'Token' => '14c9ca8d-5ff8-11ed-8636-7617f3863de9',
            'Content-Type' => 'application/json'
        ]);
        //53321
        //quan7 1449
        $feeship = $token_api->post('https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee', [
            'service_id' => (int)$data['service'],
            'insurance_value' => (int)$data['total_order'],
            'coupon' => null,
            'from_district_id' => 1449,
            'to_district_id' => (int)$data['maqh'],
            'to_ward_code' => (int)$data['xaid'],
            'height' => 15,
            'length' => 15,
            'weight' => Session::get('product_weight'),
            'width' => 15,
        ])->json(['data']);
        Session::put('fee', $feeship['total']);
        Session::put('maqh', (int)$data['maqh']);
        Session::put('xaid', (int)$data['xaid']);
        Session::put('service', (int)$data['service']);
        Session::save();
    }

    public function showCheckout(Request $request, $customer_id)
    {
        $data = $request->all();
        $token_api = Http::withHeaders([
            'Token' => '14c9ca8d-5ff8-11ed-8636-7617f3863de9',
            'Content-Type' => 'application/json'
        ]);
        $district = $token_api->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/district')->json(['data']);
        foreach ($district as $key => $dist) {
            if ($dist['DistrictID'] == Session::get('maqh')) {
                Session::put('dist_name', $dist['DistrictName']);
                Session::put('id_city', $dist['ProvinceID']);
            }
        }
        $city = $token_api->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/province')->json(['data']);
        foreach ($city as $key => $city) {
            if ($city['ProvinceID'] == Session::get('id_city')) {
                Session::put('city_name', $city['ProvinceName']);
            }
        }
        $ward = $token_api->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/ward', [
            'district_id' => (int)Session::get('maqh')
        ])->json(['data']);
//        dd($ward);
        foreach ($ward as $key => $ward) {
            if ($ward['WardCode'] == (int)Session::get('xaid')) {
                Session::put('ward_name', $ward['WardName']);
            }
        }

        $service = $token_api->post('https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/available-services', [
            'shop_id' => 3434289,
            'from_district' => 1449,
            'to_district' => (int)Session::get('maqh'),
        ])->json(['data']);
//        dd($service);
        foreach ($service as $key => $service) {
            if ($service['service_id'] == (int)Session::get('service')) {
                Session::put('service_name', $service['short_name']);
            }
        }
        $cate = DB::table('tbl_category')->where('category_status', 1)->get();
        $brand = DB::table('tbl_brand')->where('brand_status', 1)->get();
        $customer = DB::table('tbl_customer')->where('customer_id', $customer_id)->get();
        return view('pages.checkout.checkout')->with('category', $cate)->with('brand', $brand)->with('customer', $customer)->with('city', $city)->with('district', $district);
    }

    public function savereceipt(Request $request){
        $data = $request->all();
        $receipt = new Receipt();
        $receipt->customer_name = $data['receipt_customer_name'];
        $receipt->customer_email = $data['receipt_customer_email'];
        $receipt->customer_phone = $data['receipt_customer_phone'];
        $receipt->customer_address = $data['receipt_customer_address'];
        $receipt->customer_note = $data['receipt_customer_note'];
        $receipt->shipping_method = $data['shipping_method'];
        $receipt->payment_method = $data['payment'];
        $receipt->total_money = $data['total_money'];
        $receipt_product = $data['receipt_product'];
        if ($receipt_product) {
            foreach ($receipt_product as $key => $receipted) {
                $receipts[] = $receipted;
            }
        }
        $receipt->receipt_product = implode(', ', $receipts);
        $receipt->created_at = date('Y-m-d H:i:s');
        $receipt->updated_at = NULL;
        $receipt->save();
        $mailData = [
            'subject' => 'Đặt hàng thành công',
            'body' => $data['total_money'],
            'type' => 'order_success',
            ];
        $receipt = DB::table('tbl_receipt')->where('customer_email', $data['receipt_customer_email'])->orderBy('receipt_id', 'desc')->first();
        $receipt_id = $receipt->receipt_id;
        Session::put('receipt_id', $receipt_id);
        if($data['payment'] == 'vnpay') {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            //localhost
//            $vnp_Returnurl = "http://127.0.0.1:8000/";
            //deploy
            $vnp_Returnurl = "https://webtdtu.herokuapp.com/";

            $vnp_TmnCode = "A0EDKFBX";//Mã website tại VNPAY
            $vnp_HashSecret = "EZQEDIXUKJWENVNBDXQDYYTFMJPZZOXU"; //Chuỗi bí mật
            $vnp_TxnRef = $receipt_id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thanh toán đơn hàng test';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = (int)$data['total_money'] * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
//Billing

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef
            );
            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

//var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
        }
        $this->sendMail(Session::get('user_email'),$mailData);
        $user_name_temp = Session::get('user_name');
        $user_id_temp = Session::get('user_id');
        $user_email_temp = Session::get('user_email');
        $user_password_temp = Session::get('user_password');
        Session::flush();
        Session::put('user_name', $user_name_temp);
        Session::put('user_email', $user_email_temp);
        Session::put('user_id', $user_id_temp);
        Session::put('user_password', $user_password_temp);
        return Redirect::to('/');
    }
    public function sendMail($emailAccount,$mailData){
        Mail::to($emailAccount)->queue(new MailController($mailData));
    }
}
