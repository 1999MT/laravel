<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuserController
{
    public function login()
    {
        return view('admin.user.login');
    }
    public function check(Request $request)
    {
        //判断验证码是否正确  一个在session中,一个表单传过来的
        $captcha = $request->get('captcha');
        if (strtolower($captcha) == strtolower(session()->get('captcha'))) {
            $username = $request->get('username');
            $password = $request->get('password');
            //select * from cms_admin where username='$username' and password='$password'

            $ob = DB::table('cms_admin')
                ->where('username', $username)
                ->where('password', $password)
                ->first();

            //检验用户名密码是否正确.
            if ($ob === null) {
                return redirect()->back()->with('message', "哥,用户名或密码错误.");
            } else {
                //创建会话变量 session
                $re = session()->put('adminid', 1);
                session()->put('username', $username);
                //跳转
                return redirect(url('admin'));

            }
        } else {
            return redirect()->back()->with('message', "验证码错误");
        }

    }
}
