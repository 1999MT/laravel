<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台首页</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin.css')}}">
</head>
<body>
<div class="header">
	<h1>PSD1804后台管理系统</h1>
</div>
<div class="container">
	<div class="left">
		<div class="menu">
			<h3>分类管理</h3>
			<a href="{{url('admin/type/add')}}">添加</a>
			<a href="{{url('admin/type/oper')}}">管理</a>
			<h3>文章管理</h3>
			<a href="{{url('admin/news/add')}}">添加</a>
			<a href="{{url('admin/news/oper')}}">管理</a>
		</div>
	</div>
	<div class="right">
		<div class="main">
			<h1>欢迎[admin]登录</h1>
		</div>
	</div>
</div>
</body>
</html>
