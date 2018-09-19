<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table   = "cms_category";
    public $timestamps = false; //告诉Category别产生两个时间值.
    //保留字数据的字段名 cname _token
    protected $fillable = ['cname', 'pid'];
    //加一个方法,获取分类
    //$strNum 代表 --的个数
    //$fstr 传递祖先的id串
    public function getCategoryToArray($pid = 0, $strNum = 0, $fstr = "")
    {
        $cols    = $this->where('pid', $pid)->where('status', '<', 9)->get();
        $arr     = [];
        $gangStr = str_repeat('--', $strNum);
        $strNum++;
        foreach ($cols as $ob) {
            $arr[] = ['id' => $ob->id, 'idstr' => $fstr . ">" . $ob->id . '>', 'cname' => $gangStr . $ob->cname, 'pid' => $ob->pid];
            //获取当前分类的子分类
            $sonArr = $this->getCategoryToArray($ob->id, $strNum, $fstr . ">" . $ob->id);
            //拼接两个数组
            $arr = array_merge($arr, $sonArr);
        }
        return $arr;
    }
}
