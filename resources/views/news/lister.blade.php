<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
	.ul2{
		list-style: none;
		border: 5px solid purple;
		padding: 0;
		margin: 0;
	}
	.ul2 li{
		border-bottom: 2px dashed orange;
	}
	</style>
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
</head>
<body>
@include('public.header')
<div>当前位置:首页 &gt; 文章列表</div>
<hr>
<ul>
	@foreach($arr as $k=>$v)
	@if($k % 2 ==0)
	<li style="background: #abcdef;"><a href="{{url('news/detail',['id'=>$v['id']])}}">
	{{$v['title']}}</a></li>
	@else
	<li style="background: #fedcba;"><a href="{{url('news/detail',['id'=>$v['id']])}}">
	{{$v['title']}}</a></li>
	@endif
	@endforeach
</ul>
<h1>效果2</h1>
<ul class="ul2">
	@foreach($arr as $k=>$v)

	<li @if($loop->last)style="border-bottom:0;"@endif><a href="{{url('news/detail',['id'=>$v['id']])}}">
	{{$loop->last}}--
	{{$v['title']}}</a></li>
	@endforeach
</ul>
</body>
</html>
