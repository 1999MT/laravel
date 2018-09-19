@extends('layouts/admin')
@section('title',"修改分类")
@section('main')
    <div>当前操作:修改分类</div>
    <form action="{{url('admin/type/usave')}}" method="post">
    名称:<input type="text" value="{{$ob->cname}}" name="cname"><br>
    父分类:<select disabled="disabled" name="pid">
    	@foreach($arr as $v)
    	<option @if($ob->pid == $v['id']) selected='selected' @endif value="{{$v['id']}}">{{$v['cname']}}</option>
    	@endforeach
    </select><br/>
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$ob->id}}">
    <input type="submit" value="提交">
    </form>
@endsection
