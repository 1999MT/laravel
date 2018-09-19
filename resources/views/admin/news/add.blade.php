@extends('layouts.admin')
@section('main')
<div>当前操作:添加文章</div>
<form action="{{url('admin/news/save')}}" method="post" enctype="multipart/form-data">
<table width="100%">
	<tr>
		<td>标题:</td>
		<td><input type="text" value="{{old('title')}}" name="title"></td>
		<td>{{$errors->first('title')}}</td>
	</tr>
	<tr>
		<td>图片:</td>
		<td><input type="file"  name="upload"></td>
		<td></td>
	</tr>
	<tr>
		<td>分类:</td>
		<td><select name="typeid">
			@foreach($cols as $v)
			<option @if(old('typeid') == $v->id)selected='selected'@endif value="{{$v->id}}">{{$v->cname}}</option>
			@endforeach
		</select></td>
		<td></td>
	</tr>
	<tr>
		<td>内容:</td>
		<td><textarea name="content" style="width:500px;height:250px">{{old('content')}}</textarea></td>
		<td></td>
	</tr>
	<tr>
		<td colspan="3">
			{{csrf_field()}}
			<input type="submit" value="提交"></td>
	</tr>
</table>
</form>
@endsection
