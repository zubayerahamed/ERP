<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function adminLoginPage()
    {
        return view('admin.login');
    }

    public function doLogin(Request $request)
    {

        $reqFields = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($reqFields)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', "Logged in successfully");
        }

        return redirect()->route('admin.login.form');
    }
}
