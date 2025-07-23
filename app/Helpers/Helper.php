<?php

use App\Mail\AdminCreationMail;
use App\Mail\UserCreationMail;
use App\Models\ProductRating;
use App\Models\StaticPage;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccessfulMail;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use Carbon\Carbon;

// echo "Hello, World!";

function get_categories_for_navbar()
{
    return Category::where('status', 1)
        ->where('show_on_homepage', 1)
        ->orderBy('name', 'ASC')
        ->get();
}

function get_sub_categories_for_navbar($category_id)
{
    return SubCategory::where('status', 1)
        ->where('show_on_homepage', 1)
        ->where('category_id', $category_id)
        ->orderBy('name', 'ASC')
        ->get();
}

function get_categories()
{
    return Category::where('status', 1)
        ->orderBy('name', 'ASC')
        ->get();
}

function get_sub_categories($category_id)
{
    return SubCategory::where('status', 1)
        ->where('category_id', $category_id)
        ->orderBy('name', 'ASC')
        ->get();
}

function count_products_of_category($category_id)
{
    return Product::where('category_id', $category_id)->count();
}

function get_related_products($related_products_str)
{
    $related_products = explode(",", $related_products_str);

    return Product::whereIn("id", $related_products)->get();
}

function get_product_image($product_id)
{
    return ProductImage::where('product_id', $product_id)->first();
}

// function send_order_success_mail($unique_order_id, $email, $user_type)
// {
//     // Fetch saved order items and order details
//     $order_items = Order::where('unique_order_id', $unique_order_id)
//         ->join("order_items", "orders.id", "=", "order_items.order_id")
//         ->join("products", "products.id", "=", "order_items.product_id")
//         ->select("products.id", "products.title", "order_items.qty", "products.price", "order_items.total", "products.slug")
//         ->get();
//     $order_details = Order::join('countries', 'orders.country_id', '=', 'countries.id')
//         ->where('orders.unique_order_id', $unique_order_id)
//         ->select('orders.*', 'countries.name as country_name')
//         ->first();

//     // Code for order successful mail
//     $mail_data = [
//         'title' => 'Order Placed Successfully - Laravel ECOM',
//         'body' => '<p>Dear, <b>' . $order_details->first_name . ' ' . $order_details->last_name . '</b>,<br><br>Your order is successfully placed. We\'re processing your order and will update you soon.<br><br>Best wishes,<br>from <b>Laravel ECOM</b> Team</p>',
//         'user_type' => $user_type,
//         'order_items' => $order_items,
//         'order_details' => $order_details,
//         'unique_order_id' => $order_details->unique_order_id,
//         'order_price' => $order_details->grand_total,
//         'order_date' => Carbon::now()->format('d-m-Y'),
//         'payment_method' => ($order_details->payment_method == 'cod') ? 'Cash On Delivery' : 'Razorpay',
//     ];
//     // dd($mail_data);
//     Mail::to($email)->send(new OrderSuccessfulMail($mail_data));
// }

// function send_user_creation_mail($role, $name, $email, $password)
// {
//     if ($role == 0) {
//         $mail_data = [
//             'title' => 'Welcome to our online store - Laravel ECOM',
//             'body' => '<p>Welcome, <b>' . $name . '</b>,<br><br>Thank you for signing up with us! Visit our shop page and start your shopping journey now.<br><br>Best wishes,<br>from <b>Laravel ECOM</b> Team</p>',
//             'note' => '[<b>Note: </b>Your login credentials are given below. Please login to your account and change your password for security purposes.]',
//             'email' => $email,
//             'password' => $password,
//         ];
//         Mail::to($email)->send(new UserCreationMail($mail_data));
//     } else {
//         $mail_data = [
//             'title' => 'Your Admin Account Creation - Laravel ECOM',
//             'body' => '<p>Welcome, <b>' . $name . '</b>,<br><br>We are pleased to inform you that an admin account has been created for you on our online store, Laravel ECOM.<br><br>Best wishes,<br>from <b>Laravel ECOM</b> Team</p>',
//             'note' => '[<b>Note: </b>Your login credentials are given below. Please login to your account and change your password for security purposes.]',
//             'email' => $email,
//             'password' => $password,
//         ];
//         Mail::to($email)->send(new AdminCreationMail($mail_data));
//     }
// }

function static_pages()
{
    return StaticPage::orderBy('name', 'ASC')->get();
}

function get_ratings($product_id)
{
    return ProductRating::join('users', 'users.id', '=', 'product_ratings.user_id')
        ->where('product_ratings.product_id', $product_id)
        ->where('product_ratings.status', '1')
        ->orderBy('product_ratings.rating', 'DESC')
        ->select('product_ratings.*', 'users.name')
        ->get();
}

?>
