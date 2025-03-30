<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index()
    {
        $admins = User::where('role', '1')->select('id', 'name')->get();
        $settings = Setting::find(1);

        return view('admin.settings', compact('admins', 'settings'));
    }

    public function change_password_page()
    {
        return view('admin.change-password');
    }

    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:4',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->passes()) {
            $admin = User::find(Auth::guard('admin')->user()->id);

            // If entered old password is incorrect with the actual old password stored in the database
            if (!Hash::check($request->old_password, $admin->password)) {
                session()->flash('error', 'You have entered wrong old password, please try again.');

                return response()->json([
                    'status' => true,
                ]);
            }
            // If entered old password is correct with the actual old password stored in the database
            else {
                if ($request->old_password == $request->new_password) {
                    return response()->json([
                        'status' => false,
                        'msg' => [
                            'new_password' => 'The new password cannot be same as the old password.',
                        ],
                    ]);
                } else {
                    $admin->password = Hash::make($request->new_password);
                    $admin->save();

                    session()->flash('success', 'Password changed successfully.');

                    return response()->json([
                        'status' => true,
                        'msg' => 'Password changed successfully.',
                    ]);
                }
            }
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function save_settings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "main_admin_id" => "required|numeric",
            "company_text" => "required|min:3",
            "company_default_email" => "required|email",
            "company_default_address" => "required|min:3",
            "company_default_phone" => "required|digits:10|numeric",
            "company_default_phone_country_code" => "required",
        ]);

        if ($validator->passes()) {
            $setting = Setting::find(1);
            $setting->main_admin_id = $request->main_admin_id;
            $setting->company_text = $request->company_text;
            $setting->company_default_email = $request->company_default_email;
            $setting->company_default_address = $request->company_default_address;
            $setting->company_default_phone = $request->company_default_phone;
            $setting->company_default_phone_country_code = $request->company_default_phone_country_code;
            $setting->save();

            $request->session()->flash("success", "Settings saved successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'Settings saved successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }
}
