<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Product;
use App\Models\Setting;
use App\Models\StaticPage;
use App\Models\User;
use App\Models\Wishlist;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;

class UserEndController extends Controller
{
    public function index()
    {
        $featured_products = Product::where('is_featured', 1)
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->limit(4)
            ->get();
        $featured_products_count = Product::where('is_featured', 1)->where('status', 1)->count();

        $latest_products = Product::orderBy('id', 'DESC')->limit(4)->get();
        $latest_products_count = Product::where('status', 1)->count();

        return view("user_end.home", compact('featured_products', 'featured_products_count', 'latest_products', 'latest_products_count'));
    }

    public function add_to_wishlist(Request $request)
    {
        if (Wishlist::where('product_id', $request->product_id)->where('user_id', Auth::user()->id)->exists()) {
            return response()->json([
                'status' => false,
                'msg' => 'Product was already added in your wishlist.',
            ]);
        } else {
            $wishlist = new Wishlist();
            $wishlist->product_id = $request->product_id;
            $wishlist->user_id = Auth::user()->id;
            $wishlist->save();

            return response()->json([
                'status' => true,
                'msg' => 'Product is added to your wishlist successfully.',
            ]);
        }
    }

    public function remove_from_wishlist(Request $request)
    {
        $wishlist_item = Wishlist::where('product_id', $request->product_id)->first();

        if (!empty($wishlist_item)) {
            $wishlist_item->delete();

            return response()->json([
                'status' => true,
                'msg' => 'Product is removed from your wishlist successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'Product was already added in your wishlist.',
            ]);
        }
    }

    public function static_page($page_slug)
    {
        $page_data = StaticPage::where('slug', $page_slug)->first();

        if (empty($page_data)) {
            abort(404);
        }

        return view("user_end.page", compact("page_data"));
    }

    public function send_contact_mail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'subject' => 'required|min:3',
            'message' => 'required|min:3',
        ]);

        if ($validator->passes()) {
            // $mail_data = [
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'subject' => $request->subject,
            //     'message' => $request->message,
            //     'mail_subject' => 'You have received a contact email - Laravel ECOM',
            // ];

            // // Send mail that user sent to main admin
            // $setting = Setting::find(1);
            // $admin = User::find($setting->main_admin_id);
            // Mail::to($admin->email)->send(new ContactMail($mail_data));

            session()->flash('success', 'Thanks for reaching out with us, we will get back to you soon.');

            return response()->json([
                'status' => true,
                'msg' => 'Contact Email sent successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }
}
