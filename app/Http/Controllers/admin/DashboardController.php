<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

class DashboardController extends KitController
{
    public function index(){
        return view('admin.dashboard');
    }
}
