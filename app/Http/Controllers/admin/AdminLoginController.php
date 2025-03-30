<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Artisan;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        if ($validator->passes()) {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('adminRemember'))) {
                if (Auth::guard('admin')->user()->role != 1) {
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin_login')->with('error', 'You are not authorized to access the page.');
                }
                return redirect()->route('admin_dashboard');
            } else {
                return redirect()->route('admin_login')->with('error', 'Incorrect login credentials.');
            }
        } else {
            return redirect()->route('admin_login')->withErrors($validator)->withInput($request->only('email'));
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login')->with('success', 'You have successfully logged out of the system.');
    }
}
