<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Auth;

class AdminLogoutController extends KitController
{
    public function doLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.form')->with('success', 'Successfully logged out!');
    }
}
