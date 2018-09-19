@extends('layouts.admin')
@section('title',"管理文章")
@section('main')
<div>当前操作:管理文章</div>
<form action="{{url("admin/news/search")}}" method="get">
搜索:<input type="text" name="k" value="@if(isset($_GET['k'])){{$_GET['k']}}@endif"><input type="submit" value="搜索">
</form>
<table width="100%" border=1>
	<tr>
		<td>id</td>
		<td>image</td>
		<td>title</td>
		<td>tname</td>
		<td>管理</td>
	</tr>
	@foreach($cols as $v)
	<tr>
		<td>{{$v->id}}</td>
		<td>
		@if(isset($_GET['k']))
			{!!str_replace($_GET['k'],"<font color='red'>".$_GET['k']."</font>",$v->title)!!}
		@else
			{{$v->title}}
		@endif
		</td>
		<td>
			@if(empty($v->path))
			<img src="{{asset('upload')}}/no.png" width=100/>
			@else
			<img src="{{asset('upload')}}/{{$v->path}}" width="100" />
			@endif
		</td>
		<td>{{$v->cname}}</td>
		<td><a href="{{url('admin/news/update',['id'=>$v->id])}}">修改</a>&nbsp;|&nbsp;<a href="{{url('admin/news/del',['id'=>$v->id])}}">删除</a></td>
	</tr>
	@endforeach

</table>
<div class="page">{{$cols->appends($_GET)->links()}}</div>
@endsection
