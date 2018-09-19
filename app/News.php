<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table    = "cms_news";
    public $timestamps  = true;
    protected $fillable = ['title', 'content', 'typeid', 'path'];
    const UPDATED_AT    = 'updatetime';
    const CREATED_AT    = 'addtime';
}
