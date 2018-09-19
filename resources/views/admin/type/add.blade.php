@extends('layouts.admin')
@section('title','添加分类内容')
@section('main')
			<div>当前操作:添加分类</div>
			<form action="{{url('admin/type/save')}}" method="post">
				名称:<input type="text" name="cname"><br>
				父分类:
				<select name="pid">
					<option value='0'>顶级</option>
					@foreach($arr as $v)
					<option value="{{$v['id']}}">{{$v['cname']}}</option>
					@endforeach
				</select><br>
				{{csrf_field()}}
				<input type="submit" value="提交">
			</form>
@endsection
