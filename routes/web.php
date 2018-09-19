<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('cart/add', "CartController@add");
Route::get('/', "IndexController@index");
Route::get('captcha', "CaptchaController@index");
Route::get('product/lister/{tid}', "ProductController@lister");
Route::get('product/detail/{id}', "ProductController@detail");
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', "IndexController@index")->middleware('login');
    Route::get('login', "AuserController@login");
    Route::post('check', "AuserController@check");
    Route::get('type/add', "TypeController@add")
        ->middleware('login');
    Route::post('type/save', "TypeController@save")
        ->middleware('login');
    Route::get('type/oper', "TypeController@oper")
        ->middleware('login');
    Route::get('type/del/{id}', "TypeController@del")
        ->middleware('login');
    Route::get('type/update/{id?}', "TypeController@update")
        ->middleware('login');
    Route::post('type/usave', "TypeController@usave")
        ->middleware('login');
    Route::get('news/add', "NewsController@add")
        ->middleware('login');
    Route::post('news/save', "NewsController@save")
        ->middleware('login');
    Route::get('news/search', "NewsController@search");
    Route::get("news/del/{id}", "NewsController@del");
    Route::get("news/update/{id}", "NewsController@update");
    Route::post('news/usave', "NewsController@usave");
    Route::get("news/oper", "NewsController@oper")
        ->middleware('login');
    Route::get('product/add', "ProductController@add")
        ->middleware('login');
    Route::post('product/save', "ProductController@save")
        ->middleware('login');
    Route::get('product/getbrand', "ProductController@getbrand")
        ->middleware('login');
    Route::get('product/delimage', "ProductController@delimage")->middleware('login');
    Route::get('product/oper', "ProductController@oper")
        ->middleware('login');
    Route::get('product/del/{id}', "ProductController@del")
        ->middleware('login');
    Route::get('product/update/{id?}', "ProductController@update")
        ->middleware('login');
    Route::post('product/usave', "ProductController@usave")
        ->middleware('login');
    //品牌的路由
    Route::get('brand/add', "BrandController@add")
        ->middleware('login');
    Route::post('brand/save', "BrandController@save")
        ->middleware('login');
    Route::get('brand/oper', "BrandController@oper")
        ->middleware('login');
    Route::get('brand/del/{id}', "BrandController@del")
        ->middleware('login');
    Route::get('brand/update/{id?}', "BrandController@update")
        ->middleware('login');
    Route::post('brand/usave', "BrandController@usave")
        ->middleware('login');
});
