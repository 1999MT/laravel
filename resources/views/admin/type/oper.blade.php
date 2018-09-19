@extends('layouts.admin')
@section('title','管理分类')
@section('main')
			<div class="nav">当前操作:管理分类</div>
			<div class="content">
				<table width="100%" border="1">
					<tr>
						<td>id</td>
						<td>tname</td>
						<td>管理</td>
					</tr>
					@foreach($arr as $v)
					<tr>
						<td>{{$v['id']}}</td>
						<td>{{$v['cname']}}</td>
						<td><a href="{{url('admin/type/update',['id'=>$v['id']])}}">修改</a>&nbsp;|&nbsp;<a href="{{url('admin/type/del',['id'=>$v['id']])}}">删除</a></td>
					</tr>
					@endforeach

				</table>
			</div>
@endsection
