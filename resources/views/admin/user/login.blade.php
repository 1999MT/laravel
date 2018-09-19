<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录</title>
</head>
<body>
@if(session()->has('message'))
<div class="message">{{session()->get('message')}}</div>
@endif
<form action="{{url('admin/check')}}" method="post">
用户名:<input type="text" name="username"><br/>
密码:<input type="password" name="password"><br/>
验证码:<input type="text" name="captcha" size='4'>
<img src="{{url('captcha')}}"/>
<input type="submit" value="登录">
{{csrf_field()}}
</form>
{{--substr('abcabc',0,3)--}}
</body>
</html>
