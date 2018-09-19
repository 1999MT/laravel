<?php
namespace App\Http\Controllers;

class NewsController extends BaseController
{
    public function detail($id)
    {

        //根据id,去数据库中查询
        $title   = "我们今天学习Laravel";
        $content = "哈哈哈";
        $arr     = [
            't' => '这是一个数组,t对应的值',
            'c' => '随便,很<b>随便</b>',
        ];
        return view('news/detail', [
            't'   => $title,
            'c'   => $content,
            'arr' => $arr,

        ]);
    }
    public function lister($tid = 0)
    {

        $arr = [
            ['id' => 1, 'title' => 't1', 'addtime' => 1451234567],
            ['id' => 2, 'title' => 't2', 'addtime' => 1451234667],
            ['id' => 3, 'title' => 't3', 'addtime' => 1451234767],
            ['id' => 4, 'title' => 't4', 'addtime' => 1451234867],
            ['id' => 5, 'title' => 't5', 'addtime' => 1451234967],
            ['id' => 6, 'title' => 't6', 'addtime' => 1451235067],
        ];
        return view('news/lister', [
            'arr' => $arr,
            'tid' => $tid,

        ]);
    }
}
