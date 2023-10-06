<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class HomeProductController extends Controller
{
    public function product(Request $request)
    {
        $list_product = DB::table('tbl_product')->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
               ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->orderBy('product_price', 'desc')->get();
        $category = DB::table('tbl_category')->where('category_status', 1)->orderby('category_id', 'desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status', 1)->get();
        return view('pages.product.product')->with('category', $category)->with('brand', $brand)->with('product', $list_product);
    }
    public function product_details($product_id)
    {
        $details_item = DB::table('tbl_product')->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_product.product_id',$product_id)->get();
            $category = DB::table('tbl_category')->where('category_status', 1)->orderby('category_id', 'desc')->get();
            $brand = DB::table('tbl_brand')->where('brand_status', 1)->orderby('brand_id', 'desc')->get();

        // sản phẩm liên quan
        foreach($details_item as $key => $item){
           $category_id=$item->category_id;
        }
        $related_product = DB::table('tbl_product')->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_category.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();
        return view('pages.product.productdetails')->with('product_details',$details_item)->with('category', $category)->with('brand', $brand)->with('related_product',$related_product);
    }
}
