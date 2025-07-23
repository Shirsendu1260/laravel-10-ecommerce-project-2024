<?php

namespace App\Http\Controllers;

use App\Mail\ProfileUpdateMail;
use App\Mail\ResetPasswordMail;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\TempImage;
use App\Models\User;
use App\Models\Wishlist;
use Carbon\Carbon;
use DB;
use File;
use Hash;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\SendWelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AuthController extends Controller
{
    public function login()
    {
        return view("user_end.login");
    }

    public function authenticate(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                if (session()->has('url.intended')) {
                    return redirect(session()->get('url.intended'))->with('login_success', "Welcome back! You're now signed in.");
                }

                return redirect()->route('user_dashboard')->with('login_success', "Welcome back! You're now signed in.");
            } else {
                return redirect()->route('userend_login_page')->withInput($request->only("email"))->with('error', 'Incorrect login credentials.');
            }
        } else {
            return redirect()->route('userend_login_page')->withErrors($validator)->withInput($request->only("email"))->with('error', "Login validation failed! Try again.");
        }
    }

    public function sign_up()
    {
        return view("user_end.sign_up");
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'gender' => 'required|in:M,F,O',
            'email' => 'required|email|unique:users',
            'phone' => 'sometimes|digits:10|numeric',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required',
        ]);

        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->role = '0'; // '0' => User
            $user->gender = $request->gender;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();

            $msg = "Welcome, " . $request->name . "! Thank you for signing up.";

            // // Code for sending welcome mail
            // $mail_data = [
            //     'title' => 'Welcome to our online store - Laravel ECOM',
            //     'body' => '<p>Welcome, <b>' . $request->name . '</b>,<br><br>Thank you for signing up with us! Visit our shop page and start your shopping journey now.<br><br>Best wishes,<br>from <b>Laravel ECOM</b> Team</p>',
            // ];
            // Mail::to($request->email)->send(new SendWelcomeMail($mail_data));

            $request->session()->flash("success", $msg);

            return response()->json([
                'status' => true,
                'msg' => $msg,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function sign_out()
    {
        Auth::logout();
        return redirect()->route('userend_home');
    }

    public function dashboard()
    {
        $customer_address = CustomerAddress::where('user_id', Auth::user()->id)->first();
        $countries = Country::get();

        return view("user_end.dashboard", compact("customer_address", "countries"));
    }

    public function update_profile(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if (empty($user)) {
            $request->session()->flash("error", "User not found.");

            return response()->json([
                'status' => false,
                'notFound' => true,
                'msg' => 'User not found.',
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'gender' => 'required|in:M,F,O',
            'email' => 'required|email|unique:users,email,' . $user->id . ',id',
            'phone' => 'sometimes|digits:10|numeric',
        ]);

        if ($validator->passes()) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->phone = $request->phone;
            $user->save();

            // For saving the user profile image
            if (!empty($request->image_id)) {
                $temp_image = TempImage::find($request->image_id);

                $file_name_array = explode('.', $temp_image->name);
                // $file_name = $file_name_array[0];
                $ext = last($file_name_array);
                $new_file_name = Carbon::now()->format('YmdHis') . '_' . rand(0, 999) . '.' . $ext;
                $source = public_path() . '/uploads/temp_images/' . $temp_image->name; // Image contains here

                // Generate image thumbnail by resizing in dimension 200 X 200
                $img_manager = new ImageManager(new Driver());
                $image = $img_manager->read($source);
                $image->coverDown(200, 200);
                $thumbnail_upload_path = public_path() . '/uploads/user/thumbnails/';
                if (!file_exists($thumbnail_upload_path)) {
                    mkdir($thumbnail_upload_path, 0777, true);
                }
                $image->save($thumbnail_upload_path . $new_file_name);

                $user->image = $new_file_name;
                $user->save();

                // Delete temporary image file from 'temp_images/' folder of local storage
                File::delete(public_path() . '/uploads/temp_images/' . $temp_image->name);
            }

            $msg = 'Profile updated successfully.';

            // // Code for sending welcome mail
            // $mail_data = [
            //     'title' => 'Profile Updated Successfully - Laravel ECOM',
            //     'body' => '<p>Dear, <b>' . $request->name . '</b>,<br><br>Your profile information has been successfully updated. Your updated information is now live.<br><br>Best wishes,<br>from <b>Laravel ECOM</b> Team</p>',
            // ];
            // Mail::to($request->email)->send(new ProfileUpdateMail($mail_data));

            $request->session()->flash("success", $msg);

            return response()->json([
                'status' => true,
                'msg' => $msg,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function delete_profile_picture($user_id)
    {
        if (!empty($user_id)) {
            $user = User::find($user_id);

            $is_deleted = File::delete(public_path() . '/uploads/user/thumbnails/' . $user->image);

            // Delete image record from row
            $user->image = null;
            $user->save();

            if ($is_deleted == true) {
                return response()->json([
                    'status' => true,
                    'msg' => 'Profile picture deleted successfully.',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => 'Unable to delete your profile picture.',
                ]);
            }
        }
    }

    public function save_billing_address(Request $request)
    {
        // Apply validation
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:2',
            'last_name' => 'required',
            'email' => 'required|email',
            'country_code' => 'required',
            'phone' => 'required|digits:10|numeric',
            'country' => 'required|integer',
            'address' => 'required|min:5',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required|digits:6|numeric',
        ]);

        // dd($request->all());

        if ($validator->fails()) {
            session()->flash('error', 'Unable to save the billing address.');

            return response()->json([
                'status' => false,
                'msg' => 'Unable to save the billing address.',
                'errors' => $validator->errors(),
            ]);
        }

        // Save customer address
        $user = Auth::user();

        CustomerAddress::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'country_code' => $request->country_code,
                'phone' => $request->phone,
                'country_id' => $request->country,
                'address' => $request->address,
                'house' => $request->house,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
            ],
        );

        session()->flash('success', 'The billing address is saved successfully.');

        return response()->json([
            'status' => true,
            'msg' => 'The billing address is saved successfully.',
        ]);
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

        return view("user_end.my-orders", compact("orders"));
    }

    public function order_details($unique_order_id)
    {
        $order_details = Order::where('unique_order_id', $unique_order_id)->first();
        $order_items = Order::where('unique_order_id', $unique_order_id)
            ->join("order_items", "orders.id", "=", "order_items.order_id")
            ->join("products", "products.id", "=", "order_items.product_id")
            ->select("products.id", "products.title", "order_items.qty", "products.price", "order_items.total", "products.slug")
            ->get();

        return view("user_end.order-details", compact("order_details", "order_items"));
    }

    public function wishlist()
    {
        $wishlist_items = Wishlist::join('products', 'wishlists.product_id', '=', 'products.id')
            ->where('wishlists.user_id', Auth::user()->id)
            ->select('wishlists.id as wishlist_id', 'products.id', 'products.title', 'products.slug', 'products.price', 'products.compare_price', 'products.status', 'wishlists.user_id')
            ->orderByDesc('wishlists.created_at')
            ->paginate(5);

        return view("user_end.wishlist", compact("wishlist_items"));
    }

    public function change_password_page()
    {
        return view('user_end.change-password');
    }

    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:4',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->passes()) {
            $user = User::find(Auth::user()->id);

            // If entered old password is incorrect with the actual old password stored in the database
            if (!Hash::check($request->old_password, $user->password)) {
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
                    $user->password = Hash::make($request->new_password);
                    $user->save();

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

    public function forgot_password_page()
    {
        return view('user_end.forgot-password');
    }

    public function forgot_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->passes()) {
            $user = User::where('email', $request->email)->first();

            if ($user->role == 0) {
                // Generate password reset token
                $token = Str::random(60);

                // Check if any password reset token for this email exists in the table or not
                // If exists, delete the old one and re-create a new
                $reset_token = DB::table('password_reset_tokens')->where('email', $request->email);
                if ($reset_token->exists()) {
                    $reset_token->delete();
                    DB::table('password_reset_tokens')->insert([
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => Carbon::now(),
                    ]);
                } else {
                    DB::table('password_reset_tokens')->insert([
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => Carbon::now(),
                    ]);
                }

                // $mail_data = [
                //     'title' => 'Reset Your Password - Laravel ECOM',
                //     'body' => '<p>Hi, <b>' . $user->name . '</b>,<br><br>We have sent you this email because you have requested a password reset. Click <a href=' . route('user_reset_password_page', $token) . '>here</a> to create a new password.<br>If you didn\'t request a password reset, you can safely ignore this email. Only a person with access to your email address can reset your account password.<br><br>Best wishes,<br>from <b>Laravel ECOM</b> Team</p>',
                //     'token' => $token,
                // ];
                // Mail::to($request->email)->send(new ResetPasswordMail($mail_data));

                return redirect()->route('user_forgot_password_page')
                    ->with('success', "We have sent you a password reset mail to you email address.");
            } else {
                return redirect()->route('user_forgot_password_page')
                    ->withErrors($validator)
                    ->with('error', "Failed to send password reset mail, please try again.");
            }
        } else {
            return redirect()->route('user_forgot_password_page')
                ->withErrors($validator)
                ->withInput($request->only("email"));
        }
    }

    public function reset_password_page($token)
    {
        $reset_token_data = DB::table('password_reset_tokens')
            ->join('users', 'users.email', '=', 'password_reset_tokens.email')
            ->where('password_reset_tokens.token', $token)
            ->select('users.id', 'users.email', 'password_reset_tokens.token')
            ->first();

        return view('user_end.reset-password', compact('reset_token_data'));
    }

    public function reset_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'new_password' => 'required|min:4',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->passes()) {
            $user = User::where('email', $request->email)->first();
            $user->password = Hash::make($request->new_password);
            $user->save();

            session()->flash('success', 'Password reset successfully.');

            return response()->json([
                'status' => true,
                'msg' => 'Password reset successfully.',
            ]);
        } else {
            $user = User::where('email', $request->email)->first();

            if (empty($user)) {
                session()->flash('error', 'User not found against the email address, please try again.');

                return response()->json([
                    'status' => true,
                ]);
            }

            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }
}
