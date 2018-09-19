<?php

namespace App\Http\Controllers;

use App\Category;

class BaseController extends Controller
{
    public function __construct()
    {
        //获取一级分类,非逻辑删除的
        $typeHeaderCols = Category::where('status', '<', 9)->where('pid', 0)->get();
        view()->share(['typeHeaderCols' => $typeHeaderCols]);
    }
}
