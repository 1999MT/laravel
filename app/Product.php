<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table   = 'cms_product';
    public $timestamps = true;
    const UPDATED_AT   = 'updatetime';
    const CREATED_AT   = "createtime";
    //根据产品的id,获取产品图片记录一条
    public function getOneImagePath($productId)
    {
        $ob = Productimage::where('productid', $productId)
            ->first();
        if ($ob) {
            return asset("upload") . "/" . $ob->path;
        } else {
            return asset('upload/no.png');
        }
    }
}
