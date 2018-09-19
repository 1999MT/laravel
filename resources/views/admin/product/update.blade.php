@extends('layouts.admin')
@section('title',"修改产品")
@section('main')
<div>当前操作:修改产品</div>
<form action="{{url('admin/product/usave')}}" method="post" enctype="multipart/form-data">
<table width="100%" border="0">
	<tr>
		<td>标题:</td>
		<td><input type="text" value="{{$product->title}}" name="title"></td>
		<td></td>
	</tr>
	<tr>
		<td>分类:</td>
		<td><select name="typestr" onchange="getBrand();">
		@foreach($typeArr as $v)
		<option @if($v['idstr'] == $product->typestr)selected='selected'@endif value="{!!$v['idstr']!!}">{{$v['cname']}}</option>
		@endforeach
		</select></td>
		<td></td>
	</tr>
	<tr>
		<td>品牌</td>
		<td>
			<select name="brandid">
			@foreach($brandCols as $v)
			<option @if($v->id == $product->brandid) selected='selected'@endif value="{{$v->id}}">{{$v->bname}}</option>
			@endforeach
			</select>
		</td>
		<td></td>
	</tr>
	<tr>
		<td>图片</td>
		<td><input type="file" name="upload[]" multiple="multiple"></td>
		<td>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="2"><table>
				<tr>
					@foreach($images as $v)
					<td id="td_{{$v->id}}">
						<img src="{{asset('upload')}}/{{$v->path}}" width="100"/>
						<div><a onclick="deleteImage({{$v->id}})" href="javascript:void(0);">删除</a></div>
					</td>
					@endforeach
				</tr>
			</table></td>
	</tr>
	<tr>
		<td>价格:</td>
		<td><input type="text"  value="{{$product->price}}" name="price"></td>
		<td></td>
	</tr>
	<tr>
		<td>会员价格:</td>
		<td><input type="text"  value="{{$product->userprice}}" name="userprice"></td>
		<td></td>
	</tr>
	<tr>
		<td>优惠数量:</td>
		<td><input type="text"  value="{{$product->salenum}}" name="salenum"></td>
		<td></td>
	</tr>
	<tr>
		<td>优惠价格:</td>
		<td><input type="text"  value="{{$product->saleprice}}" name="saleprice"></td>
		<td></td>
	</tr>
	<tr>
		<td>库存量:</td>
		<td><input type="text" value="{{$product->libnum}}" name="libnum"></td>
		<td></td>
	</tr>
	<tr>
		<td>内容:</td>
		<td><textarea style="width:350px;height:150px;" name="content">{{$product->content}}</textarea></td>
		<td></td>
	</tr>
	<tr>
		<td>规格参数:</td>
		<td><textarea style="width:350px;height:150px;" name="style">{{$product->style}}</textarea></td>
		<td></td>
	</tr>

	<tr>
		<td colspan="3">
			{{csrf_field()}}
			<input type="hidden" name="id" value="{{$product->id}}"/>
			<input type="submit" value="提交" />
		</td>
	</tr>
</table>
</form>
<script type="text/javascript">
function deleteImage(imageId)
{
	$.ajax({
		type:'get',
		data:'imageid='+imageId,
		url:'{{url("admin/product/delimage")}}',
		dataType:'json',
		success:function(re){
			//根据图片的id,删除td节点
			$("#td_"+imageId).remove();
		}
	})
}
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
