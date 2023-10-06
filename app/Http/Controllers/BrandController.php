<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
class BrandController extends Controller
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

    public function addBrand()
    {
        $this->Authenticate();
        return view('admin.brand.add_brand');
    }

    public function saveBrand(Request $request)
    {
        $this->Authenticate();
        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_name'];
        $brand->brand_status = $data['brand_status'];
        $brand->created_at = date('Y-m-d H:i:s');
        //update data
        $brand->updated_at = NULL;
        $brand->save();
        if ($brand) {
            return Redirect::to('/add_brand?message=save_brand_success');
        } else {
            $message = "Thêm thương hiệu thất bại";
            Session::put('message', $message);
            return Redirect::to('/add_brand');
        }
    }

    public function listBrand()
    {
        $this->Authenticate();
        $list_brand = Brand::all();
        $show_brand= view('admin.brand.list_brand')->with('list_brand', $list_brand);
        return view('admin_layout')->with('admin.brand.list_brand', $show_brand);
    }

    public function activeBrand($brand_id)
    {
        $this->Authenticate();
        $brand = Brand::find($brand_id);
        $brand->brand_status = 1;
        $brand->save();
        if ($brand) {
            $message = "Hiển thị thương hiệu thành công";
            Session::put('message', $message);
            return Redirect::to('/list_brand');
        } else {
            $message = "Hiển thị thương hiệu thất bại";
            Session::put('message', $message);
            return Redirect::to('/list_brand');
        }
    }

    public function unactiveBrand($brand_id)
    {
        $this->Authenticate();
        $brand = Brand::find($brand_id);
        $brand->brand_status = 0;
        $brand->save();
        if ($brand) {
            $message = "Ẩn danh thương hiệu công";
            Session::put('message', $message);
            return Redirect::to('/list_brand');
        } else {
            $message = "Ẩn thương hiệu thất bại";
            Session::put('message', $message);
            return Redirect::to('/list_brand');
        }
    }


    public function editBrand($brand_id)
    {
        $this->Authenticate();
        $edit_brand = Brand::find($brand_id);
        $show_brand= view('admin.brand.edit_brand')->with('edit_brand', $edit_brand);
        return view('admin_layout')->with('admin\brand\edit.brand', $show_brand);
    }


    public function updateBrand(Request $request, $brand_id)
    {
        $this->Authenticate();
        $data = $request->all();
        $brand = Brand::find($brand_id);
        $brand->brand_name = $data['brand_name'];
        $brand->updated_at = date('Y-m-d H:i:s');
        $brand->save();
        if ($brand) {
            return Redirect::to('/list_brand?message=update_brand_success');
        } else {
            $message = "Cập nhật danh mục thất bại";
            Session::put('message', $message);
            return Redirect::to('list_brand');
        }
    }

    public function deleteBrand($brand_id)

    {
        $this->Authenticate();
        DB::table('tbl_brand')->where('brand_id', $brand_id)->delete();
        return Redirect::to('/list_brand?message=delete_brand_success');

    }
}
