<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function add()
    {
        //获取分类
        $category = new Category();
        $arr      = $category->getCategoryToArray(0);
        return view('admin.type.add', ['arr' => $arr]);
    }
    public function save(Request $request)
    {
        //使用数据模型类Category
        $re = Category::create($request->all());
        //产生提示语
        $message = is_object($re) ? "分类添加成功" : "分类添加失败";
        return redirect(url('admin/type/oper'))->with('message', $message);
    }
    public function oper()
    {
        //获取所有的分类数据
        $category = new Category();
        $arr      = $category->getCategoryToArray(0);
        return view("admin.type.oper", ['arr' => $arr]);
    }
    public function del($id)
    {
        $re = Category::where('id', $id)->update(['status' => 9]); //修改 status = 9
        //产生提示语
        $message = $re ? "删除成功" : "删除失败";
        //跳转
        return redirect()->back()->with('message', $message);
    }
    public function update($id)
    {
        //根据分类id,获取分类记录
        $ob = Category::where('id', $id)->first();
        //获取所有的分类,以array的形式传给模板
        $category = new Category;
        $arr      = $category->getCategoryToArray();
        return view("admin.type.update", ['ob' => $ob, 'arr' => $arr]);
    }
    public function usave(Request $request)
    {
        $id  = $request->get('id');
        $arr = $request->all();
        unset($arr['_token']);
        unset($arr['id']);
        $re      = Category::where('id', $id)->update($arr);
        $message = $re ? "修改成功" : "修改失败";
        return redirect(url('admin/type/oper'))->with('message', $message);
    }
}
