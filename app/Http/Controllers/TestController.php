<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TestController
{
    public function index()
    {
        //读数据库表cms_category
        $cols = DB::table('cms_category')->get(); //select * from 表名
        foreach ($cols as $v) {
            echo $v->id, '@', $v->cname;
            echo "<hr/>";
        }
    }
}
