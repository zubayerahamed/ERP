<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminRegisterController extends Controller
{
    public function adminRegisterPage()
    {
        return view('admin.register');
    }

    public function doRegistration(Request $request)
    {
        $reqFields = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('admins', 'email')],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        $reqFields['password'] = bcrypt($reqFields['password']);

        $admin = Admin::create($reqFields);

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.dashboard')->with('success', 'Account created successfully and successfully logged in!');
    }
}
