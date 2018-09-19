<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Productimage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function add()
    {
        //获取分类
        $category = new Category;
        $cArr     = $category->getCategoryToArray();
        //获取品牌
        $brandCols = Brand::where('status', '<', 9)->get();
        //呈现表单页面,显示模板
        return view('admin.product.add', ['carr' => $cArr, 'brandCols' => $brandCols]);
    }
    public function getbrand(Request $request)
    {
        $typeoneid = $request->get('typeoneid');
        //根据id,获取品牌
        $cols = Brand::where('typeid', $typeoneid)->where('status', '<', 9)->get();
        echo json_encode($cols);
    }
    public function save(Request $request)
    {
        //处理表单数据,  图片 +  文字内容
        //写产品表 使用数据模型类Product.php
        $arr       = $request->all();
        $uploadArr = isset($arr['upload']) ? $arr['upload'] : [];
        unset($arr['upload']);
        unset($arr['_token']);
        $product = new Product();
        foreach ($arr as $k => $v) {
            $product->$k = $v;
        }
        $re = $product->save();
        //要刚添加的记录的id值
        $productid = $product->id;
        //保存图片
        $imageMessage = "请选择图片";
        foreach ($uploadArr as $ob) {
            $path = $ob->store('product', 'my');
            Productimage::insert(['path' => $path, 'productid' => $productid]);
            $imageMessage = "图片上传成功";
        }
        $message = $re ? "保存成功" : "保存失败";
        return redirect('admin/product/oper')->with('message', $message . ',' . $imageMessage);
    }
    public function oper()
    {
        $cols = Product::orderBy('id', 'desc')
            ->paginate(2);
        return view('admin.product.oper', ['cols' => $cols]);
    }
    public function update($id)
    {
        //获取分类数据
        $category = new Category();
        $typeArr  = $category->getCategoryToArray();
        //获取品牌数据
        $brandCols = Brand::where('status', '<', 9)->get();

        //根据产品id,获取对应的数据--->产品记录 图片记录
        $product = Product::where('id', $id)->first();
        $images  = Productimage::where('productid', $id)->get();
        //传给模板,显示模板
        return view('admin.product.update', ['product' => $product, 'images' => $images, 'typeArr' => $typeArr, 'brandCols' => $brandCols]);
    }
    public function delimage(Request $request)
    {
        //获取图片id
        $imageid = $request->get('imageid');
        //根据图片的id,获取图片的路径
        $productimage = Productimage::where('id', $imageid)->first();
        //根据图片的id,删除图片,图片记录
        unlink('./upload/' . $productimage->path);
        $productimage->delete();
        echo json_encode(['status' => 'success']);
    }
    public function usave(Request $request)
    {
        //接收数据
        $arr = $request->all();
        //处理新上传的图片
        $imageMessage = "请选择图片";
        if (isset($arr['upload'])) {
            foreach ($arr['upload'] as $ob) {
                $path = $ob->store('product', 'my');
                Productimage::insert(['productid' => $arr['id'], 'path' => $path]);
            }
            $imageMessage = "图片上传成功";
        }
        //保存产品记录
        unset($arr['upload']);
        unset($arr['_token']);
        $re      = Product::where("id", $arr['id'])->update($arr);
        $message = $re ? "修改成功" : "修改失败";
        return redirect('admin/product/oper')->with('message', $message . "," . $imageMessage);
    }
    public function del($id)
    {

    }
}
