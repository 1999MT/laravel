@extends('layouts.admin')
@section('main')
<div>当前操作:添加品牌</div>
<form action="{{url('admin/brand/save')}}" method="post" enctype="multipart/form-data">
<table width="100%">
	<tr>
		<td>名称:</td>
		<td><input type="text" value="{{old('bname')}}" name="bname"></td>
		<td></td>
	</tr>
	<tr>
		<td>logo:</td>
		<td><input type="file"  name="upload"></td>
		<td></td>
	</tr>
	<tr>
		<td>分类:</td>
		<td><select name="typeid">
		@foreach($types as $v)
		<option value="{{$v->id}}">{{$v->cname}}</option>
		@endforeach
		</select></td>
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
