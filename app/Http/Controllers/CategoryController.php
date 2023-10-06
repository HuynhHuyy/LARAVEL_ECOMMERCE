<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
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

    public function addCategory()
    {
        $this->Authenticate();
        return view('admin.category.add_category');
    }


    public function saveCategory(Request $request)
    {
        $this->Authenticate();
        $data = $request->all();
        $category = new Category();
        $category->category_name = $data['category_name'];
        $category->category_status = $data['category_status'];
        $category->created_at = date('Y-m-d H:i:s');
        //update data
        $category->updated_at = NULL;
        $category->save();
        if ($category) {
            $message = "Thêm danh mục thành công";
            Session::put('message', $message);
            return Redirect::to('/add_category?message=save_cate_success');
        } else {
            $message = "Thêm danh mục thất bại";
            Session::put('message', $message);
            return Redirect::to('/add_category');
        }
    }



    public function listCategory()
    {
        $this->Authenticate();
        $list_category = Category::all();
        $show_category = view('admin.category.list_category')->with('list_category', $list_category);
        return view('admin_layout')->with('admin.category.list_category', $show_category);
    }


    public function activeCategory($category_id)
    {
        $this->Authenticate();
        $category = Category::find($category_id);
        $category->category_status = 1;
        $category->save();
        if ($category) {
            $message = "Hiển thị danh mục thành công";
            Session::put('message', $message);
            return Redirect::to('/list_category');
        } else {
            $message = "Hiển thị danh mục thất bại";
            Session::put('message', $message);
            return Redirect::to('/list_category');
        }
    }

    public function unactiveCategory($category_id)
    {
        $this->Authenticate();
        $category = Category::find($category_id);
        $category->category_status = 0;
        $category->save();
        if ($category) {
            $message = "Ẩn danh mục thành công";
            Session::put('message', $message);
            return Redirect::to('/list_category');
        } else {
            $message = "Ẩn danh mục thất bại";
            Session::put('message', $message);
            return Redirect::to('/list_category');
        }
    }

    public function editCategory($category_id)
    {
        $this->Authenticate();
        $edit_category = Category::find($category_id);
        $show_category = view('admin.category.edit_category')->with('edit_category', $edit_category);
        return view('admin_layout')->with('admin\category\edit.category', $show_category);
    }


    public function updateCategory(Request $request, $category_id)
    {
        $this->Authenticate();
        $data = $request->all();
        $category = Category::find($category_id);
        $category->category_name = $data['category_name'];
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();
        if ($category) {
            return Redirect::to('/list_category?message=update_cate_success');
        } else {
            $message = "Cập nhật danh mục thất bại";
            Session::put('message', $message);
            return Redirect::to('list_category');
        }
    }

    public function deleteCategory($category_id)
    {
        $this->Authenticate();
        DB::table('tbl_category')->where('category_id', $category_id)->delete();
        return Redirect::to('/list_category?message=delete_cate_success');
    }

}
