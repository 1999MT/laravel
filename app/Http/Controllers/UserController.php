<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function reg()
    {
        //显示模板
        return view('user.reg');
    }
    public function save(Request $request)
    {
        //用户名必填
        //用户名不能数字开始4到20位英文字母数字,下划线组成
        //密码长度6-20位,非空字符组成,必填
        //确认密码
        //验证email 不填可以,填就要符合邮箱格式
        //验证手机,使用正则表达式
        //验证生日
        $this->validate($request, [
            'username'              => ['required', 'regex:/[a-z_]\w{3,19}/i', 'unique:cms_user'],
            'password_confirmation' => ['required', 'regex:/\S{6,20}/'],
            'password'              => ['required', 'confirmed'],
            'email'                 => ['email', 'nullable'],
            'mobile'                => ['nullable', 'regex:/1[35789]\d{9}/'],
            'birthday'              => ['nullable', 'date'],
        ], [
            'username.required'              => '用户名必填',
            'username.regex'                 => '格式错误',
            'username.unique'                => '用户名已经存在',
            'password_confirmation.required' => "密码必填",
            'password_confirmation.regex'    => '密码格式错误',
            'password.required'              => '请填写确认密码',
            'password.confirmed'             => '两次密码不一致',
            'email.email'                    => '邮箱格式不正确',
            'mobile.regex'                   => '手机格式错误',
            'birthday.date'                  => '日期格式错误',
        ]);
    }
}
