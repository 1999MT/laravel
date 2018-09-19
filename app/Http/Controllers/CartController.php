<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends BaseController
{
    public function add(Request $request)
    {
        //接收产品id和购买数量
        $arr       = $request->all();
        $productid = $request->get('productid');
        $number    = $request->get('number');
        var_dump($arr);

    }
}
