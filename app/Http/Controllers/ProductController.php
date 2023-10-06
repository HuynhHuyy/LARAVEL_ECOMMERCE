<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Gallery;
use Illuminate\Support\Facades\File;

function showProduct(mixed $pd)
{
    $checklogin = Session::get('user_id') ? '<button value=' . $pd->product_id . ' id="' . $pd->product_id . '"  type="button"  class="btn btn-sm text-dark p-0" onclick="add_cart(' . $pd->product_id . ')"><i class="fas fa-shopping-cart text-primary mr-1"></i>THÊM VÀO GIỎ HÀNG</button>' : '<button data-id="{{' . $pd->product_id . '}}" type="button"  class="btn btn-sm text-dark p-0 cart_login" onclick="cart_login()"><i class="fas fa-shopping-cart text-primary mr-1"></i>THÊM VÀO GIỎ HÀNG</button>';
    return '
                            <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                        <form>
                                ' . csrf_field() . '
                                    <input type="hidden" value=' . $pd->product_id . ' class=cart_product_id_' . $pd->product_id . '>
                                    <input type="hidden" value=' . $pd->product_name . ' class=cart_product_name_' . $pd->product_id . '>
                                    <input type="hidden" value=' . $pd->product_image . ' class=cart_product_image_' . $pd->product_id . '>
                                    <input type="hidden" value=' . $pd->product_price . ' class=cart_product_price_' . $pd->product_id . '>
                                    <input type="hidden" value="1" class=cart_product_qty_' . $pd->product_id . '>
                                    <input type="hidden" value=' . $pd->weight . ' class=cart_product_weight_' . $pd->product_id . '>
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img src="upload/product/' . $pd->product_image . '"  height="263" width="263">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                  <h6 class="text-truncate mb-3">' . $pd->product_name . '</h6>
                                <div class="d-flex justify-content-center">
                                    <h6>' . number_format($pd->product_price) . ' VNĐ</h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="/product_details/' . $pd->product_id . '"  class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>XEM CHI TIẾT</a>
                                ' . $checklogin . '
                            </div>
                        </form>
                        </div>
                    </div>';
}

class ProductController extends Controller
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

    public function addProduct()
    {
      $this->Authenticate();
        $cate = Category::all();
        $brand = Brand::all();
        return view('admin.product.add_product')->with('category', $cate)->with('brand', $brand);
    }

    public function saveProduct(Request $request)
    {
        $this->Authenticate();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_sold'] = 0;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['weight'] = $request->weight;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $data['product_image'] = $request->product_image;
        //get image address from folder
        //created at
        $path = 'upload\product';
        $data['created_at'] = new \DateTime();
        $image = $request->file('product_image');
        if ($image) {
            $image_name = $image->getClientOriginalName();
            $name_image = current(explode('.', $image_name));
            $new_name = rand(123456789, 923456789) . rand( 0, time() ) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($path), $new_name);
            $data['product_image'] = $new_name;
            DB::table('tbl_product')->insert($data);
            return Redirect::to('/add_product?message=save_product_success');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        return Redirect::to('/add_product?message=save_product_success');
    }

    public function listProduct()
    {
        $this->Authenticate();
        $list_product = DB::table('tbl_product')->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->orderBy('tbl_product.product_id', 'desc')->get();
        $show_product= view('admin.product.list_product')->with('list_product', $list_product);
        return view('admin_layout')->with('admin.product.list_product', $show_product);
    }


    public function editProduct($product_id)
    {
        $this->Authenticate();
        $cate = DB::table('tbl_category')->where('category_status', 1)->get();
        $brand = DB::table('tbl_brand')->where('brand_status', 1)->get();
        $product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $edit_product = view('admin.product.edit_product')->with('edit_product', $product)->with('category', $cate)->with('brand', $brand);
        return view('admin_layout')->with('admin.product.edit_product', $edit_product);

    }

    public function updateProduct(Request $request, $product_id)
    {
        $this->Authenticate();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $data['weight'] = $request->weight;
        $data['product_image'] = $request->product_image;
        //get image address from folder
        //created at
        $data['created_at'] = new \DateTime();
        $image = $request->file('product_image');
        if($image) {
            //$image_name = $image->getClientOriginalName();
            //$name_image = current(explode('.', $image_name));
            $new_name = rand(123456789, 923456789) . rand( 0, time() ) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/upload/product'), $new_name);
            $data['product_image'] = $new_name;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            return Redirect::to('/list_product?message=update_product_success');
        } else {
            $old_image = DB::table('tbl_product')->where('product_id', $product_id)->first();
            $old_image_name = $old_image->product_image;
            $data['product_image'] = $old_image_name;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công');
            return Redirect::to('/list_product');
        }
    }

    public function deleteProduct($product_id)
    {
        $this->Authenticate();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        return Redirect::to('/list_product?message=delete_product_success');
    }

    public function search(Request $request){
            $output="";
            $price = $request->price;
            if($request->action) {
                if ($request->type === 'brand') {
                    foreach ($request->brand as $brand) {
                        $products = DB::table('tbl_product')->where('brand_id', $brand)->orderBy('product_price','asc')->get();
                        foreach ($products as $pd) {
                            $output .= showProduct($pd);
                        }
                    }
                } else if ($request->type === 'category') {
                    foreach ($request->category as $cate) {
                        $products = DB::table('tbl_product')->where('category_id', $cate)->orderBy('product_price','asc')->get();
                        foreach ($products as $pd) {
                            $output .= showProduct($pd);
                        }
                    }
                } else if ($request->type === 'price') {
                    for ($i = 0; $i < count($price); $i += 2) {
                        $min = $price[$i];
                        $max = $price[$i + 1];
                        $products = DB::table('tbl_product')->whereBetween('product_price', [(int)$min, (int)$max])->orderBy('product_price','asc')->get();
                        foreach ($products as $pd) {
                            $output .= showProduct($pd);
                        }
                    }
                }else if($request->type === 'search'){
                    $products = DB::table('tbl_product')->where('product_name', 'Like', '%' . $request->search . '%')
                        ->orWhere('product_price', 'Like', '%' . $request->search . '%')->orderBy('product_price','asc')->get();
                    if ($products) {
                        foreach ($products as $pd) {
                            $output .= showProduct($pd);
                        }
                    }
                }else{
                    $products = DB::table('tbl_product')->orderBy('product_price','asc')->get();
                    foreach ($products as $pd) {
                        $output .= showProduct($pd);
                    }
                }
                return response($output);
            }else{
                $products = DB::table('tbl_product')->orderBy('product_price','asc')->get();
                foreach ($products as $pd) {
                    $output .= showProduct($pd);
                }
                return response($output);
            }
    }
}

