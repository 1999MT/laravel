<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function add()
    {
        //获取分类表的数据
        $cols = Category::get();
        return view('admin.news.add', ['cols' => $cols]);
    }
    public function save(Request $request)
    {
        //验证数据
        $this->validate($request, [
            //'title' => "required|unique:cms_news",
            'title' => ['required', 'unique:cms_news'],
        ], [
            'title.required' => '请填写标题',
            'title.unique'   => '标题不唯一',
        ]);
        $arr = $request->all();

        //处理图片
        $imageMessage = "没有选择图片";
        if (isset($arr['upload'])) {
            //判断是否出错
            $error = $arr['upload']->getError();
            if ($error === 0) {

                //判断类型
                $type = $arr['upload']->getClientMimeType();
                //图片的类 mime值 image/png image/gif image/jpeg
                if ($type == "image/png" || $type == 'image/gif' || $type == 'image/jpeg') {
                    //判断大小

                    $size = $arr['upload']->getClientSize(); //单位字节
                    //要求大小下雨1M b kb mb
                    if ($size < 1024 * 1024) {
                        $path         = $arr['upload']->store('a', 'my');
                        $arr['path']  = $path;
                        $imageMessage = "图片保存成功";
                    } else {
                        $imageMessage = "文件太大了";
                    }
                } else {
                    $imageMessage = "图片类型错误";
                }

            } else {
                $imageMessage = "图片上传失败";
            }

        }

        $re      = News::create($arr);
        $message = $re ? "添加成功" : "添加失败";
        return redirect('admin/news/oper')->with('message', $message . "," . $imageMessage);
    }
    public function oper()
    {
        //获取所有文章数据
        $cols = News::join('cms_category as c', 'cms_news.typeid', '=', 'c.id')
            ->select("cms_news.*", 'c.cname')
            ->orderBy('id', 'desc')
            ->paginate(2);
        return view('admin.news.oper', ['cols' => $cols]);
    }
    public function search(Request $request)
    {
        //根据k传值,取文章表标题模糊查询
        $k = $request->get('k');
        //select * from cms_news where title like '%$k%'
        $cols = News::where('cms_news.title', 'like', "%$k%")
            ->join("cms_category as c", "c.id", '=', 'cms_news.typeid')
            ->select("cms_news.*", 'c.cname')
            ->paginate(2);
        return view('admin.news.oper', ['cols' => $cols]);
    }
    public function del($id)
    {
        //找文章对应的图片
        $news = News::where('id', $id)->first();
        //获取文章对应的图片
        $path = $news->path;
        if (!empty($path)) {
            unlink("./upload/" . $path);
        }
        $re = $news->delete();

        $message = $re ? "删除成功" : "删除失败";
        return redirect()->back()->with('message', $message);
    }
    public function update($id)
    {
        //根据id,获取文章记录
        $news = News::where('id', $id)->first();
        //文章分类
        $cols = Category::get();
        return view('admin.news.update', [
            'cols' => $cols,
            'news' => $news]);
    }
    public function usave(Request $request)
    {

        $id  = $request->get('id');
        $arr = $request->all();
        //保存图片
        $path = '';
        if (isset($arr['upload'])) {
            $upload = $arr['upload'];
            $path   = $upload->store(date('Y-m-d'), 'my'); //2018-08-07
        }

        unset($arr['id']);
        unset($arr['_token']);
        $news = News::where('id', $id)->first();
        //判断此文章有没有图片
        if (!empty($news->path)) {
            unlink("./upload/" . $news->path);
        }

        $news->title   = $arr['title'];
        $news->typeid  = $arr['typeid'];
        $news->content = $arr['content'];
        //用新的文件名称覆盖老的.
        if (!empty($path)) {
            $news->path = $path;
        }
        $re      = $news->save();
        $message = $re ? "修改成功" : "修改失败";
        return redirect('admin/news/oper')->with('message', $message);
    }
}
