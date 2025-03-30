<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\AccountUpdationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;

class UserListingController extends Controller
{
    public function index(Request $request, $user_type = null)
    {
        $users = null;

        if ($user_type != null) {
            if ($user_type == 'user') {
                $users = User::where('role', '0')->orderByDesc('id');
            } else {
                $users = User::where('role', '1')->orderByDesc('id');
            }
        } else {
            $users = User::latest();
        }

        if (!empty($request->get('user_search'))) {
            $users = $users->where('name', 'like', '%' . $request->get('user_search') . '%');
            $users = $users->orWhere('email', 'like', '%' . $request->get('user_search') . '%');
        }

        $users = $users->paginate(7);

        return view("admin.user.list", compact("users"));
    }

    public function create()
    {
        return view("admin.user.create");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|min:3",
            "role" => "required|in:1,0",
            "gender" => "required|in:M,F,O",
            "email" => "required|unique:users",
            "phone" => "required|digits:10|numeric",
            "status" => "required|in:1,0",
        ]);

        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->role = $request->role;
            $user->gender = $request->gender;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->status = $request->status;
            $user->password = 'XXXXXXXX';
            $user->save();

            /* Code for creating and saving a random 6 digit password for the user */
            // Define a string containing all possible characters for the password
            $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
            // Shuffle the characters in the string and extract a substring of length 6, starting from index 0
            $password = substr(str_shuffle($data), 0, length: 6);
            $user->password = bcrypt($password);
            $user->save();

            /* Code for sending user creation mail along with password */
            send_user_creation_mail($request->role, $request->name, $request->email, $password);

            $request->session()->flash("success", "User created successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'User created successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function edit(Request $request, $user_id)
    {
        $user = User::find($user_id);

        if (empty($user)) {
            $request->session()->flash("error", "User not found.");

            return redirect()->route('admin_view_users');
        }

        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $user_id)
    {
        $user = User::find($user_id);

        if (empty($user)) {
            $request->session()->flash("error", "User not found.");

            return response()->json([
                'status' => false,
                'notFound' => true,
                'msg' => 'User not found.',
            ]);
        }

        $validator = Validator::make($request->all(), [
            "name" => "required|min:3",
            "role" => "required|in:1,0",
            "gender" => "required|in:M,F,O",
            "email" => "required|unique:users,email," . $user->id . ",id",
            "phone" => "required|digits:10|numeric",
            "status" => "required|in:1,0",
        ]);

        if ($validator->passes()) {
            $user->name = $request->name;
            $user->role = $request->role;
            $user->gender = $request->gender;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->status = $request->status;
            $user->save();

            $mail_data = [
                'title' => 'Profile Updated Successfully - Laravel ECOM',
                'body' => '<p>Hi, <b>' . $request->name . '</b>,<br><br>Your profile information has been successfully updated by our admin team. Your updated information is now live.<br><br>Best wishes,<br>from <b>Laravel ECOM</b> Team</p>',
            ];
            Mail::to($request->email)->send(new AccountUpdationMail($mail_data));

            $request->session()->flash("success", "User updated successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'User updated successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function remove(Request $request, $user_id)
    {
        $user = User::find($user_id);

        if (empty($user)) {
            $request->session()->flash("error", "User not found.");

            return response()->json([
                'status' => false,
                'msg' => 'User not found.',
            ]);
        }

        $user->delete();

        $request->session()->flash("success", "User deleted successfully.");

        return response()->json([
            'status' => true,
            'msg' => 'User deleted successfully.',
        ]);
    }
}
