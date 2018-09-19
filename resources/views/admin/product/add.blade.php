@extends('layouts.admin')
@section('title',"添加产品")
@section('main')
<div>当前操作:添加产品</div>
<form action="{{url('admin/product/save')}}" method="post" enctype="multipart/form-data">
<table width="100%" border="0">
	<tr>
		<td>标题:</td>
		<td><input type="text" name="title"></td>
		<td></td>
	</tr>
	<tr>
		<td>分类:</td>
		<td><select name="typestr" onchange="getBrand();">
			@foreach($carr as $v)
			<option value="{!!$v['idstr']!!}">{{$v['cname']}}</option>
			@endforeach
		</select></td>
		<td></td>
	</tr>
	<tr>
		<td>品牌</td>
		<td>
			<select name="brandid">
			@foreach($brandCols as $v)
			<option value="{{$v->id}}">{{$v->bname}}</option>
			@endforeach
			</select>
		</td>
		<td></td>
	</tr>
	<tr>
		<td>图片</td>
		<td><input type="file" name="upload[]" multiple="multiple"></td>
		<td></td>
	</tr>
	<tr>
		<td>价格:</td>
		<td><input type="text" name="price"></td>
		<td></td>
	</tr>
	<tr>
		<td>会员价格:</td>
		<td><input type="text" name="userprice"></td>
		<td></td>
	</tr>
	<tr>
		<td>优惠数量:</td>
		<td><input type="text" name="salenum"></td>
		<td></td>
	</tr>
	<tr>
		<td>优惠价格:</td>
		<td><input type="text" name="saleprice"></td>
		<td></td>
	</tr>
	<tr>
		<td>库存量:</td>
		<td><input type="text" name="libnum"></td>
		<td></td>
	</tr>
	<tr>
		<td>内容:</td>
		<td><textarea style="width:350px;height:150px;" name="content"></textarea></td>
		<td></td>
	</tr>
	<tr>
		<td>规格参数:</td>
		<td><textarea style="width:350px;height:150px;" name="style"></textarea></td>
		<td></td>
	</tr>

	<tr>
		<td colspan="3">
			{{csrf_field()}}
			<input type="submit" value="提交" />
		</td>
	</tr>
</table>
</form>
<script type="text/javascript">
function getBrand(){
	//获取被选中的分类的value属性值,获取一级分类的id
	var str = $("[name='typestr']").val();
	str = str.replace(/^>|>$/g,'');
	var arr = str.split('>');
	var typeOneId = arr[0];
	//通过ajax请求一个控制器方法---M,读cms_brand
	$.ajax({
		url:'{{url("admin/product/getbrand")}}', //.../public/admin/product/getbrand
		data:'typeoneid='+typeOneId,
		dataType:'json',
		success:function(res){
			//把品牌下拉框中的option清掉
			$("[name='brandid']").empty();
			//解析json ,给品牌下拉框追加option
			for(var k=0;k<res.length;k++){
				$("[name='brandid']").append("<option value='"+res[k].id+"'>"+res[k].bname+"</option>");
			}
		}
	})
	//JQuery语句操作返回的结果,呈现下拉框.

}
</script>
@endsection
