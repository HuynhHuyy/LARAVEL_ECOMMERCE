<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    //
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        $category = DB::table('tbl_category')->where('category_status', 1)->orderby('category_id', 'desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status', 1)->orderby('brand_id', 'desc')->get();
        return view('pages.contact.contact')->with('category', $category)->with('brand', $brand);

    }
}
