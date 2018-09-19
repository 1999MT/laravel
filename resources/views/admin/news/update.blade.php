@extends('layouts.admin')
@section('main')
<div>当前操作:修改文章</div>
<form action="{{url('admin/news/usave')}}" method="post" enctype="multipart/form-data">
<table width="100%">
	<tr>
		<td>标题:</td>
		<td><input type="text" name="title" value="{{$news->title}}"></td>
		<td></td>
	</tr>
	<tr>
		<td>图片:</td>
		<td>
			<input type="file" name="upload"/>
			@if(!empty($news->path))
			<img width="150" src="{{asset('upload')}}/{{$news->path}}"/>
			@endif
		</td>
		<td></td>
	</tr>
	<tr>
		<td>分类:</td>
		<td><select name="typeid">
			@foreach($cols as $v)
			<option @if($v->id == $news->typeid) selected='selected'@endif value="{{$v->id}}">{{$v->cname}}</option>
			@endforeach
		</select></td>
		<td></td>
	</tr>
	<tr>
		<td>内容:</td>
		<td><textarea name="content" style="width:500px;height:250px">{{$news->content}}</textarea></td>
		<td></td>
	</tr>
	<tr>
		<td colspan="3">
			{{csrf_field()}}
			<input type="hidden" name="id" value="{{$news->id}}">
			<input type="submit" value="提交"></td>
	</tr>
</table>
</form>
@endsection
