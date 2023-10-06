<?php

namespace App\Http\Controllers;

use App\Models\Warranty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Customer;
use function Sodium\compare;
use App\Http\Controllers\CartController;


class HomeController extends Controller
{
    public function show_user_login(){
        return view('pages.user_login');
    }
    public function show_forget_password(){
        return view('pages.user_forget_password');
    }
    public function get_new_password(Request $request){
        $cart = new CartController();
        $email = $request->email;
        $customer = Customer::where('customer_email', $email)->first();
        if($customer) {
            $new_pass = rand(100000, 999999);
            $customer->customer_password = md5($new_pass);
            $customer->save();
            $mailData = [
                'subject' => 'Mật khẩu mới',
                'body' => 'Mật khẩu mới của bạn là: ' . $new_pass,
                'type' => 'resetpw',
            ];
            $cart->sendMail($email,$mailData);
            return Redirect::to('/user_login');
        }
    }


    public function checkLogin_user(Request $request)
    {
        $this->validate($request,[
            'user_email'=>'required', //validate email required
            'user_password'=>'required|min:6'
        ],
            //customize validate message
            [
                'user_email.required'=>'Vui lòng nhập tên đăng nhập',
                'user_password.required'=>'Vui lòng nhập mật khẩu',
                'user_password.min'=>'Mật khẩu phải có ít nhất 6 ký tự'
            ]);
        $data = $request->all();
        $email = $data['user_email'];
        $password= md5($data['user_password']);
        $user = Customer::where(['customer_email'=>$email,'customer_password'=>$password])->first();

        if($user){
            Session::put('user_email',$user->customer_email);
            Session::put('user_password',$user->customer_password);
            Session::put('user_id',$user->customer_id);
            Session::put('user_name',$user->customer_name);
            return redirect('/');
        }
        else{
            return redirect('/user_login')->with('error_user','Tên đăng nhập hoặc mật khẩu không đúng');
        }
    }

    public function logout_user()
    {
//        $this->Authenticate();
        Session::flush();
        return redirect('/user_login');
    }
    public function show_user_profile()
    {
        return view('pages.user_profile');
    }
    public function user_change_password()
    {
        return view('pages.user_change_password');
    }

    public function show_user_register()
    {
        return view('pages.user_register');
    }

    public function save_user_register(Request $request)
    {
//        $this->Authenticate();
        $data = $request->all();
        $user = new Customer();
        $user->customer_name = $data['user_name'];

        $check_email = Customer::where('customer_email',$data['user_email'])->first();
        if($check_email){
            return redirect('/user_register?message=register_fail');
        }
        else{
            $user->customer_email = $data['user_email'];
        }
        $user->customer_password = md5($data['user_password']);
        $user->customer_phone = $data['user_phone'];
        $user->customer_address = $data['user_address'];
        $user->created_at = date('Y-m-d H:i:s');
        //update data
        $user->updated_at = NULL;
        $user->save();
        if ($user) {
            $message = "Đăng ký thành công";
            Session::put('message', $message);
            return Redirect::to('/user_login')->with('success_user','Đăng ký tài khoản thành công, vui lòng đăng nhập');
        } else {
            $message = "Đăng ký thất bại";
            Session::put('message', $message);
            return Redirect::to('/user_login')->with('error_user','Đăng ký tài khoản thất bại vui lòng thử lại');
        }
    }
    public function changePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password1' => 'required|min:6',
            'new_password2' => 'required|min:6|same:new_password1'
        ],[
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ',
            'new_password1.required' => 'Vui lòng nhập mật khẩu mới',
            'new_password1.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'new_password2.required' => 'Vui lòng nhập lại mật khẩu mới',
            'new_password2.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'new_password2.same' => 'Mật khẩu nhập lại không khớp'
        ]);
        $data = $request->all();
        $email = Session::get('user_email');
        #Match The Old Password
        $old_password= md5($data['old_password']);
        $checkpass = Customer::where(['customer_email'=>$email,'customer_password'=>$old_password])->first();
        if($checkpass){
            $new_password = md5($data['new_password2']);
            $update = Customer::where('customer_email', $email)->update(['customer_password' => $new_password]);
            if ($update) {
                return redirect('/user_change_password?message=success');
            } else {
                return redirect('/user_change_password?message=fail');
            }
        }
        else{
            return redirect('/user_change_password?message=wrongoldpass');
        }
    }

    public function listReceipt(){
        $listReceipt = DB::table('tbl_receipt')->where('customer_email',Session::get('user_email'))->get();
        return view('pages.receipt.list_receipt')->with('listReceipt',$listReceipt);
    }
    public function show_user_warranty()
    {
        $show_warranty = DB::table('tbl_warranty')->where('customer_email',Session::get('user_email'))->get();
        return view('pages.warranty.list_warranty')->with('list_warranty',$show_warranty);
    }

}
