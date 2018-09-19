<?php

namespace App\Http\Controllers;

use Gregwar\Captcha\CaptchaBuilder;

class CaptchaController
{
    public function index()
    {
        //输入验证码图片
        $builder = new CaptchaBuilder;
        $builder->build(); //生成验证码图片
        //创建session,存图片上的文字内容
        session()->put('captcha', $builder->getPhrase());
        header('Content-type: image/jpeg');
        $builder->output(); //输入给浏览器
    }
}
