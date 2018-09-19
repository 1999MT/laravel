<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
</head>
<body>
@include('public.header')
<h1>{{$t}}</h1>
<hr/>
<div>{{$c}}</div>
<hr/>
{{$arr['t']}} @ {!!$arr['c']!!}
</body>
</html>
