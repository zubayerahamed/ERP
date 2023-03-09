<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

class CategoryController extends KitController
{
    public function index(){
        return view('admin.category');
    }
}
