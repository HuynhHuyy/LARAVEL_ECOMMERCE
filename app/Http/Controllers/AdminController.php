<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Warranty;
use Barryvdh\DomPDF\Facade as PDF;

class AdminController extends Controller
{
    public function Authenticate()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('admin_home');
        } else {
            return Redirect::to('admin_login')->send();
        }
    }

    public function show_admin_login()
    {
        return view('admin_login');
    }

    public function list_admin_receipt()
    {
        $this->Authenticate();
        $list_receipt = Receipt::all();
        $show_receipt = view('admin.receipt.list_receipt')->with('list_receipt', $list_receipt);
        return view('admin_layout')->with('admin.receipt.list_receipt', $show_receipt);
    }
    public function print_warranty_pdf($code)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_warranty($code));
        return $pdf->stream();
    }
    public function print_receipt_pdf($code)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_receipt($code));
        return $pdf->stream();
    }
    public function convert_warranty($code)
    {
        $warranty = DB::table('tbl_warranty')->where('warranty_id', $code)->first();
        $output = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Document</title>
            <style>
                body{
                    font-family: DejaVu Sans;
                }
                .table{
                    width: 100%;
                    border-collapse: collapse;
                }
                .table, .table th, .table td{
                    border: 1px solid black;
                }
                .table th, .table td{
                    padding: 5px;
                    text-align: left;
                }
                .table tr:nth-child(even){
                    background-color: #f2f2f2;
                }
                .table tr:hover{
                    background-color: #ddd;
                }
                .table th{
                    background-color: #4CAF50;
                    color: white;
                }
            </style>
        </head>
        <body>
        <h3 align="center">Hóa đơn bảo hành</h3>
        <table width="100%" style="border-collapse: collapse; border: 0px;">
            <tr>
                <td style="border: 1px solid; padding:12px;" width="30%"><h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-danger font-weight-bold border px-3 mr-1">PC</span>SHOP</h1></td>
                <td style="border: 1px solid; padding:12px;" width="70%">
                    <p><b>Địa chỉ: </b> '.$warranty->customer_address.'</p>
                    <p><b>Số điện thoại: </b> '.$warranty->customer_phone.'</p>
                    <p><b>Email: </b>
                        <a href="mailto:'.$warranty->customer_email.'">'.$warranty->customer_email.'</a>
                    </p>
                    <p><b>Họ và Tên: </b>
                        '.$warranty->customer_name.'
                    </p>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding:12px;" width="30%"><b>Mã hóa đơn: </b> '.$warranty->warranty_id.'</td>
                <td style="border: 1px solid; padding:12px;" width="70%"><b>Ngày lập: </b> '.$warranty->created_at.'</td>
            </tr>
        </table>
        <table width="100%" style="border-collapse: collapse; border: 0px;">
            <tr>
                <th style="border: 1px solid; padding:12px;" width="5%">STT</th>
                <th style="border: 1px solid; padding:12px;" width="30%">Tên sản phẩm</th>
                <th style="border: 1px solid; padding:12px;" width="15%">Tình trạng</th>
            </tr>
            <tr>
                <td style="border: 1px solid; padding:12px;" width="5%">1</td>
                <td style="border: 1px solid; padding:12px;" width="30%">'.$warranty->product_name.'</td>
                <td style="border: 1px solid; padding:12px;" width="15%">'.$warranty->product_status.'</td>
            </tr>
        </table>
        <table width="100%" style="border-collapse: collapse; border: 0px;">
            <tr>
                <td style="border: 1px solid; padding:12px;" width="30%"><b>Người lập: </b> '.Session::get("admin_name").'</td>
                <td style="border: 1px solid; padding:12px;" width="70%"><b>Người nhận: </b> '.$warranty->customer_name.'</td>
            </tr>
        </table>
        </body>
        </html>';
        return $output;
    }

    public function convert_receipt($code){
        $receipt = DB::table('tbl_receipt')->where('receipt_id', $code)->first();
        $output = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Document</title>
            <style>
                body{
                    font-family: DejaVu Sans;
                }
                .table{
                    width: 100%;
                    border-collapse: collapse;
                }
                .table, .table th, .table td{
                    border: 1px solid black;
                }
                .table th, .table td{
                    padding: 5px;
                    text-align: left;
                }
                .table tr:nth-child(even){
                    background-color: #f2f2f2;
                }
                .table tr:hover{
                    background-color: #ddd;
                }
                .table th{
                    background-color: #4CAF50;
                    color: white;
                }
            </style>
        </head>
        <body>
        <h3 align="center">Hóa đơn bán hàng</h3>
        <table width="100%" style="border-collapse: collapse; border: 0px;">
            <tr>
                <td style="border: 1px solid; padding:12px;" width="30%"><h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-danger font-weight-bold border px-3 mr-1">PC</span>SHOP</h1></td>
                <td style="border: 1px solid; padding:12px;" width="100%">
                    <p><b>Địa chỉ: </b> '.$receipt->customer_address.'</p>
                    <p><b>Số điện thoại: </b> '.$receipt->customer_phone.'</p>
                    <p><b>Email: </b>
                        <a href="mailto:'.$receipt->customer_email.'">'.$receipt->customer_email.'</a>
                    </p>
                    <p><b>Họ và Tên: </b>
                        '.$receipt->customer_name.'
                    </p>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding:12px;" width="30%"><b>Mã hóa đơn: </b> '.$receipt->receipt_id.'</td>
                <td style="border: 1px solid; padding:12px;" width="70%"><b>Ngày lập: </b> '.$receipt->created_at.'</td>
            </tr>
        </table>
        <table width="100%" style="border-collapse: collapse; border: 0px;">
            <tr>
                <th style="border: 1px solid; padding:12px;" width="5%">STT</th>
                <th style="border: 1px solid; padding:12px;" width="30%">Tên sản phẩm</th>
                <th style="border: 1px solid; padding:12px;" width="15%">Thành tiền</th>
            </tr>
            <tr>
                <td style="border: 1px solid; padding:12px;" width="5%">1</td>
                <td style="border: 1px solid; padding:12px;" width="30%">'.$receipt->receipt_product.'</td>
                <td style="border: 1px solid; padding:12px;" width="15%">'.$receipt->total_money.'</td>
            </tr>
        </table>
        <table width="100%" style="border-collapse: collapse; border: 0px;">
            <tr>
                <td style="border: 1px solid; padding:12px;" width="30%"><b>Người lập: </b> '.Session::get("admin_name").'</td>
                <td style="border: 1px solid; padding:12px;" width="70%"><b>Người nhận: </b> '.$receipt->customer_name.'</td>
            </tr>
        </table>
        </body>
        </html>';
        return $output;
    }


    public function checklogin(Request $request)
    {
        $this->validate($request, [
            'admin_email' => 'required', //validate email required
            'admin_password' => 'required|min:6'
        ],
            //customize validate message
            [
                'admin_email.required' => 'Vui lòng nhập tên đăng nhập',
                'admin_password.required' => 'Vui lòng nhập mật khẩu',
                'admin_password.min' => 'Mật khẩu phải có ít nhất 6 ký tự'
            ]);
        $data = $request->all();
//        $password = $data['admin_password'];
        //hash md5 password
        $password = md5($data['admin_password']);
        $user = Admin::where(['admin_email' => $data['admin_email'], 'admin_password' => $password])->first();

        if ($user) {
            Session::put('admin_email', $user->admin_email);
            Session::put('admin_name', $user->admin_name);
            Session::put('admin_password', $user->admin_password);
            Session::put('admin_id', $user->admin_id);
            return redirect('/admin_receipt');
        } else {
            return redirect('/admin_login')->with('error', 'Tên đăng nhập hoặc mật khẩu không đúng');
        }
    }

    public function logout()
    {
        $this->Authenticate();
        Session::flush();
        return redirect('/admin_login');
    }

//    Manage Customer

    public function addUser()
    {
        return view('admin.user.add_user');
    }


    public function saveUser(Request $request)
    {
        $this->Authenticate();
        $data = $request->all();
        $user = new Customer();
        $user->customer_name = $data['user_name'];
        $user->customer_email = $data['user_email'];
        $user->customer_password = $data['user_password'];
        $user->customer_phone = $data['user_phone'];
        $user->customer_address = $data['user_address'];
        $user->created_at = date('Y-m-d H:i:s');
        //update data
        $user->updated_at = NULL;
        $user->save();
        if ($user) {
            return Redirect::to('/add_user?message=save_user_success');
        } else {
            $message = "Thêm khách hàng thất bại";
            Session::put('message', $message);
            return Redirect::to('/add_user');
        }
    }

    public function listUser()
    {
        $this->Authenticate();
        $list_user = Customer::all();
        $show_user = view('admin.user.list_user')->with('list_user', $list_user);
        return view('admin_layout')->with('admin.user.list_user', $show_user);
    }

    public function editUser($customer_id)
    {
        $this->Authenticate();
        $edit_user = Customer::find($customer_id);
        $show_user = view('admin.user.edit_user')->with('edit_user', $edit_user);
        return view('admin_layout')->with('admin.user.edit_user', $show_user);
    }


    public function updateUser(Request $request, $customer_id)
    {
        $this->Authenticate();
        $data = $request->all();
        $user = Customer::find($customer_id);
        $user->customer_name = $data['user_name'];
        $user->customer_email = $data['user_email'];
        $user->customer_password = $data['user_password'];
        $user->customer_phone = $data['user_phone'];
        $user->customer_address = $data['user_address'];
        $user->updated_at = date('Y-m-d H:i:s');
        $user->save();
        if ($user) {
            return Redirect::to('/list_user?message=update_user_success');
        } else {
            $message = "Cập nhật thông tin khách hàng thất bại";
            Session::put('message', $message);
            return Redirect::to('list_user');
        }
    }

    public function deleteUser($customer_id)
    {
        $this->Authenticate();
        DB::table('tbl_customer')->where('customer_id', $customer_id)->delete();
        return Redirect::to('/list_user?message=delete_user_success');
    }

    public function admin_editReceipt($receipt_id)
    {
        $this->Authenticate();
        $receipt = DB::table('tbl_receipt')->where('receipt_id', $receipt_id)->get();
        $edit_receipt = view('admin.receipt.edit_receipt')->with('edit_receipt', $receipt);
        return view('admin_layout')->with('admin.receipt.edit_receipt', $edit_receipt);
    }

    public function admin_updateReceipt(Request $request, $receipt_id)
    {
        $this->Authenticate();
        $data = $request->all();
        $receipt = Receipt::find($receipt_id);
        $receipt->customer_name = $data['customer_name'];
        $receipt->customer_email = $data['customer_email'];
        $receipt->customer_phone = $data['customer_phone'];
        $receipt->customer_address = $data['customer_address'];
        $receipt->customer_note = $data['customer_note'];
        $receipt->receipt_product = $data['receipt_product'];
        $receipt->shipping_method = $data['shipping_method'];
        $receipt->payment_method = $data['payment_method'];
        $receipt->total_money = $data['total_money'];
        $receipt->receipt_status = $data['receipt_status'];
        $receipt->updated_at = date('Y-m-d H:i:s');
        $receipt->save();
        if ($receipt) {
            return Redirect::to('/admin_receipt?message=update_receipt_success');
        } else {
            $message = "Cập nhật trạng thái đơn hàng thất bại";
            Session::put('message', $message);
            return Redirect::to('admin_receipt');
        }
    }

    public function admin_deleteReceipt($receipt_id)
    {
        $this->Authenticate();
        DB::table('tbl_receipt')->where('receipt_id', $receipt_id)->delete();
        return Redirect::to('/admin_receipt');
   }
    //Receipt
    public function cancel_receipt($receipt_id){
        $receipt = Receipt::find($receipt_id);
        $receipt->receipt_status = 4;
        $receipt->save();
        return Redirect::to('/list_receipt?message=cancel_receipt_success');
    }
    public function confirm_receipt($receipt_id){
        $receipt = Receipt::find($receipt_id);
        $receipt->receipt_status = 3;
        $receipt->save();
        return Redirect::to('/list_receipt?message=confirm_receipt_success');
    }

//    Warranty

    public function show_warranty($receipt_id){
        $this->Authenticate();
        $receipt = DB::table('tbl_receipt')->where('receipt_id', $receipt_id)->get();
        $edit_warranty = view('admin.receipt.edit_warranty')->with('edit_warranty', $receipt);
        return view('admin_layout')->with('admin.receipt.edit_warranty', $edit_warranty);
    }

    public function add_warranty(Request $request){
        $this->Authenticate();
        $data = $request->all();
        $warranty = new Warranty();
        $warranty->customer_name = $data['customer_name'];
        $warranty->customer_phone = $data['customer_phone'];
        $warranty->customer_email = $data['customer_email'];
        $warranty->customer_address = $data['customer_address'];
        $warranty->product_status = $data['product_status'];
        $warranty->product_name = $data['product_name'];
        $warranty->warranty_date=$data['warranty_date'];
        $warranty->return_date = $data['return_date'];
        $warranty->created_at = date('Y-m-d H:i:s');
        //update data
        $warranty->updated_at = NULL;
        $warranty->save();
        if ($warranty) {
            $message = "Tạo phiếu bảo hành thành công";
            Session::put('message', $message);
            return Redirect::to('/admin_receipt?message=add_warranty_success');
        }
    }
    public function searchReceipt(Request $request){
        $output = '';
        $receipt = DB::table('tbl_receipt')->where('receipt_id', 'Like', '%' . $request->search . '%')
            ->orWhere('customer_name', 'Like', '%' . $request->search . '%')
            ->orWhere('customer_email', 'Like', '%' . $request->search . '%')
            ->orWhere('customer_phone', 'Like', '%' . $request->search . '%')->get();


        if ($receipt) {
            foreach ($receipt as  $value) {
                $check_status_receipt = '';
                if($value->receipt_status == 0){
                    $check_status_receipt .= '<span class="text-danger">Chưa xử lý</span>';
                }elseif($value->receipt_status == 1){
                    $check_status_receipt .= '<span class="text-primary">Đang chuẩn bị hàng</span>';
                }elseif ($value->receipt_status == 2){
                    $check_status_receipt .= '<span class="text-success">Đã giao cho đơn vị vận chuyển</span>';
                }elseif ($value->receipt_status == 3){
                    $check_status_receipt .= '<span class="text-warning">Đã giao hàng</span>';
                }else{
                    $check_status_receipt .= '<span class="text-danger">Đã hủy</span>';
                }
                $output .= '<tr style="text-align: center;">
                                <td style="text-align: center;">'.  $value->receipt_id .'</td>
                                <td style="text-align: center;">'. $value->customer_name .'</td>
                                <td style="text-align: center;">'. $value->customer_email .'</td>
                                <td style="text-align: center;">'. $value->customer_phone .'</td>
                                <td style="text-align: center;">'. $value->customer_address .'</td>
                                <td style="text-align: center;">'. $value->receipt_product .'</td>
                                <td style="text-align: center;">'. $value->total_money .'</td>
                                <td style="text-align: center;">'. $value->receipt_date .'</td>
                                <td>
                                        '. $check_status_receipt .'
                                </td>
                                <td style="text-align: center;">
                                    <a type="button" class="btn btn-success" href="/show_warranty/'.$value->receipt_id.'">
                                        <i class="bi bi-capsule"></i> Bảo hành
                                    </a>
                                    <br>
                                    <br>

                                    <a href="/edit_receipt/'.$value->receipt_id.'" class="btn btn-success">
                                        <i class="bi bi-check-square"></i> </a>
                                    <br>
                                    <br>
                                    <a onclick="return confirm("Bạn có chắc chắn muốn xóa hóa đơn này không ?")"  href="/delete_receipt/'.$value->receipt_id.'" class="btn btn-danger delete_receipt_success" ui-toggle-class="">
                                        <i class="bi bi-trash"></i></a>
                                        <br>
                                    <br>
                                    <a href="/print_receipt/'.$value->receipt_id.'" class="btn btn-warning">
                                        <i class="bi bi-printer"></i></a>
                                </td>
                            </tr>';
            }

        }
        return response($output);
    }

    public function list_warranty(){
        $this->Authenticate();
        $warranty = Warranty::all();
        $show_warranty = view('admin.warranty.list_warranty')->with('list_warranty', $warranty);
        return view('admin_layout')->with('admin.warranty.list_warranty', $show_warranty);
    }

    public function edit_warranty($warranty_id){
        $this->Authenticate();
        $edit_warranty = Warranty::find($warranty_id);
        $show_warranty= view('admin.warranty.edit_warranty')->with('edit_warranty', $edit_warranty);
        return view('admin_layout')->with('admin.warranty.edit_warranty', $show_warranty);
    }

    public function update_warranty(Request $request, $warranty_id){
        $this->Authenticate();
        $data = $request->all();
        $warranty = Warranty::find($warranty_id);
        $warranty->customer_name = $data['customer_name'];
        $warranty->customer_phone = $data['customer_phone'];
        $warranty->customer_email = $data['customer_email'];
        $warranty->customer_address = $data['customer_address'];
        $warranty->warranty_status = $data['warranty_status'];
        $warranty->product_name = $data['product_name'];
        $warranty->warranty_date=$data['warranty_date'];
        $warranty->return_date = $data['return_date'];
        $warranty->updated_at = date('Y-m-d H:i:s');
        $warranty->save();
        if ($warranty) {
            return Redirect::to('/list_warranty');
        } else {
            $message = "Cập nhật trạng thái đơn hàng thất bại";
            Session::put('message', $message);
            return Redirect::to('list_warranty');
        }
    }

    public function delete_warranty($warranty_id)
    {
        $this->Authenticate();
        DB::table('tbl_warranty')->where('warranty_id', $warranty_id)->delete();
        return Redirect::to('/list_warranty');
    }

}

