<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
    <script type="text/javascript">
    //用户判断是否已经过去3秒
    var num=3;
    function fun1(){
        num--;
        if(num == 0){
            $(".message").hide(1000);
        }else{
            $("#s").html(num);
            setTimeout(fun1,1000);
        }
    }
    $(function(){
        setTimeout(fun1,1000);
    })
    </script>
</head>

<body>
    <div class="header" style="background-color: #f2f2f2;">
        <h1 style="margin:0;">PSD1804后台管理系统</h1>
    </div>
    <div class="container" style="width:100%;padding:0;">
        <div class="left">
            <div class="menu">
                <h3>分类管理</h3>
                <a href="{{url('admin/type/add')}}">添加</a>
                <a href="{{url('admin/type/oper')}}">管理</a>
                <h3>品牌管理</h3>
                <a href="{{url('admin/brand/add')}}">添加</a>
                <a href="{{url('admin/brand/oper')}}">管理</a>
                <h3>文章管理</h3>
                <a href="{{url('admin/news/add')}}">添加</a>
                <a href="{{url('admin/news/oper')}}">管理</a>
                <h3>产品管理</h3>
                <a href="{{url('admin/product/add')}}">添加</a>
                <a href="{{url('admin/product/oper')}}">管理</a>
            </div>
        </div>
        <div class="right">
            @if(session()->has('message'))
            <div class="message">{{session()->get('message')}}&nbsp;<b id='s'>3</b></div>
            @endif
            <div class="main">
                @yield('main')
            </div>
        </div>
    </div>
</body>
</html>
