<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>会员注册</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
</head>
<body>
@include("public.header")
<form action="{{url('user/save')}}" method="post">
<table width="100%">
	<tr>
		<td width="80">用户名:</td>
		<td width="300"><input type="text" value="{{old('username')}}" name="username"></td>
		<td>{{$errors->first('username')}}</td>
	</tr>
	<tr>
		<td>密码:</td>
		<td><input type="password" value="{{old('password_confirmation')}}" name="password_confirmation"></td>
		<td>{{$errors->first('password_confirmation')}}</td>
	</tr>
	<tr>
		<td>确认密码:</td>
		<td><input type="password" value="{{old('password')}}" name="password"></td>
		<td>{{$errors->first('password')}}</td>
	</tr>
	<tr>
		<td>Email:</td>
		<td><input type="text" value="{{old('email')}}" name="email"></td>
		<td>{{$errors->first('email')}}</td>
	</tr>
	<tr>
		<td>mobile:</td>
		<td><input type="text" value="{{old('mobile')}}" name="mobile"></td>
		<td>{{$errors->first('mobile')}}</td>
	</tr>
	<tr>
		<td>birthday:</td>
		<td><input type="text" value="{{old('birthday')}}" name="birthday"/></td>
		<td>{{$errors->first('birthday')}}</td>
	</tr>
	<tr>
		<td>intro:</td>
		<td><textarea name="intro" style="width:300px;height:150px;"></textarea></td>
		<td>{{$errors->first('intro')}}</td>
	</tr>
	<tr>
		<td colspan="3">
			{{csrf_field()}}
			<input type="submit" value="注册会员">
		</td>
	</tr>
</table>
</form>

</body>
</html>
