@extends('layouts.admin')
@section('title',"管理产品")
@section('main')
<div>当前操作:管理产品</div>
<table width="100%" border=1>
	<tr>
		<td>id</td>
		<td>image</td>
		<td>title</td>
		<td>管理</td>
	</tr>
	@foreach($cols as $v)

	<tr>
		<td>{{$v->id}}</td>
		<td>
			<img width='150' src='{{$v->getOneImagePath($v->id)}}'/>
		</td>
		<td>
			{{$v->title}}
		</td>
		<td><a href="{{url('admin/product/update',['id'=>$v->id])}}">修改</a>&nbsp;|&nbsp;<a href="{{url('admin/product/del',['id'=>$v->id])}}">删除</a></td>
	</tr>
	@endforeach

</table>
<div class="page">{{$cols->appends($_GET)->links()}}</div>
@endsection
