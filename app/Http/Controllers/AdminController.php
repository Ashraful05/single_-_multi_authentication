<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth:admin')->except('AdminLogin');
//    }
    public function AdminLogin()
    {
        return view('admin.login');
    }
    public function AdminLoginSubmit(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if(Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('dashboard_admin');
//            return view('admin.dashboard');
        }
        else {
            return redirect()->route('login');
        }
    }
    public function dashboardAdmin()
    {
        return view('admin.dashboard');
    }
    public function Settings()
    {
        return view('admin.settings');
    }
    public function Logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_logout');
    }
}
