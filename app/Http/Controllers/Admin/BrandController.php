<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use Illuminate\Http\Request;

class BrandController
{
    public function add()
    {
        //获取一级分类
        $typeCols = Category::where('pid', 0)->where('status', '<', 9)->get();
        return view('admin.brand.add', ['types' => $typeCols]);
    }
    public function save(Request $request)
    {
        $arr = $request->all();
        // 名称  分类id  logo图片
        //处理图片
        if (isset($arr['upload'])) {
            $path        = $arr['upload']->store('brand', 'my');
            $arr['path'] = $path;
        }
        unset($arr['_token']);
        unset($arr['upload']);
        //写表数据
        $re      = Brand::insert($arr);
        $message = $re ? "添加成功" : "添加失败";
        return redirect()->back()->with('message', $message);
    }
}
