<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Productimage;

class ProductController extends BaseController
{

    public function lister($tid)
    {
        //根据$tid,读产品记录(带分页)
        $cols = Product::where('status', '<', 9)
            ->where('typestr', 'like', ">$tid>%")
            ->paginate(2);
        $arr = [];
        foreach ($cols as $v) {
            $imageOb = Productimage::where('productid', $v->id)->first();
            if (is_object($imageOb)) {
                $path = $imageOb->path;
            } else {
                $path = "images/no_picture.gif";
            }
            $arr[] = ['id' => $v->id, 'title' => $v->title, 'price' => $v->price, 'userprice' => $v->userprice, 'path' => $path];
        }
        $htmlStr = $this->getCategory();
        return view('product.lister', ['tid' => $tid, 'cols' => $cols, 'htmlStr' => $htmlStr]);
    }
    public function detail($id)
    {
        //根据产品id,获取产品记录
        $product = Product::where('id', $id)->first();
        //根据产品id,获取产品的图片
        $imageCols = Productimage::where('productid', $id)->get();
        //传分类字符串给模板
        $htmlStr = $this->getCategory();
        return view('product.detail', ['htmlStr' => $htmlStr, 'product' => $product, 'imageCols' => $imageCols]);
    }
    protected function getCategory()
    {
        //返回值,字符串
        $htmlStr = "";
        //获取第一级分类  C
        $oneCols = Category::where('status', '<', 9)->where('pid', 0)->get();
        foreach ($oneCols as $v1) {
            $htmlStr .= "<h2> <a target=\"_blank\" href=\"\">" . $v1->cname . " </a></h2>";
            //马上找当前分类的子分类
            $twoCols = Category::where('status', '<', 9)
                ->where('pid', $v1->id)->get();
            foreach ($twoCols as $v2) {
                $htmlStr .= "<div class=\"h2_cat\" onmouseover=\"this.className='h2_cat active_cat'\" onmouseout=\"this.className='h2_cat'\">
<h3>
<div class=\"xianzhi\">
<a target=\"_blank\" href=\"\">" . $v2->cname . "</a>
</div>
</h3>
<div class=\"h3_cat\">
<div class=\"shadow\">
<div class=\"shadow_border\">
<ul>";
                //找第三级
                $threeCols = Category::where('status', '<', 9)->where('pid', $v2->id)->get();
                foreach ($threeCols as $v3) {
                    $htmlStr .= "<li><a href=\"\">" . $v3->cname . "</a></li>";
                }
                $htmlStr .= "
</ul></div></div></div></div>";
            }
        }
        return $htmlStr;
    }
}
