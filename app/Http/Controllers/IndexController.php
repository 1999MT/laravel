<?php

namespace App\Http\Controllers;

class IndexController extends BaseController
{
    public function index()
    {
        return view('welcome');
    }
}
