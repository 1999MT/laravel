<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table   = "cms_user";
    public $timestamps = false;
}
