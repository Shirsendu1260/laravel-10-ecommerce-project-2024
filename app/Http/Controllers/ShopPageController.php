<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductRating;
use App\Models\SubCategory;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use Session;
use DB;

class ShopPageController extends Controller
{
    public function index(Request $request, $category_slug = null, $sub_category_slug = null)
    {
        $category_selected = "";
        $sub_category_selected = "";
        $sorting_type_selected = "";
        $brands_array = [];
        $price_min = 0;
        $price_max = 0;

        $price_min = intval($request->get("p1"));
        $price_max = (intval($request->get("p2")) == 0) ? 100000 : intval($request->get("p2"));

        $categories = Category::where('status', 1)
            ->orderBy('name', 'ASC')
            ->get();
        $brands = Brand::where('status', 1)
            ->orderBy('name', 'ASC')
            ->get();
        $products = Product::where('status', 1);

        if (($category_slug != null) || ($sub_category_slug != null)) {
            if (!empty($category_slug)) {
                $category = Category::where("slug", $category_slug)->first();
                $products = $products->where("category_id", $category->id);
                $category_selected = $category->id;
            }

            if (!empty($sub_category_slug)) {
                $sub_category = SubCategory::where("slug", $sub_category_slug)->first();
                $products = $products->where("sub_category_id", $sub_category->id);
                $sub_category_selected = $sub_category->id;
            }
        }

        // Filter products based on category
        if ($request->get("c") != "") {
            $category_id = urldecode(base64_decode($request->get("c"))); // Decode from Base64
            $products = $products->where('category_id', $category_id);
            $category_selected = $category_id;
        }

        // Filter products based on sub-category slug
        if ($request->get("sc") != "") {
            $sub_category_id = urldecode(base64_decode($request->get("sc"))); // Decode from Base64
            $products = $products->where('sub_category_id', $sub_category_id);
            $sub_category_selected = $sub_category_id;
        }

        // Filter products based on brands
        if ($request->get("b") != "") {
            $brands_str = urldecode(base64_decode($request->get("b"))); // Decode from Base64
            $brands_array = explode(",", $brands_str);
            $products = $products->whereIn("brand_id", $brands_array);
        }

        // Filter products based on price
        if ($request->get("p1") != "" && $request->get("p2") != "") {
            if ($request->get("p2") == 100000) {
                $products = $products->whereBetween("price", [intval($request->get("p1")), 10000000]);
            } else {
                $products = $products->whereBetween("price", [intval($request->get("p1")), intval($request->get("p2"))]);
            }
        }

        // Filter products based on sorting type
        if ($request->get("st") != "") {
            // dd($request->get("st"));
            $sorting_type = urldecode(base64_decode($request->get("st"))); // Decode from Base64

            if ($sorting_type == "latest") {
                $products = $products->orderBy('id', 'DESC');
                $sorting_type_selected = $sorting_type;
            } else if ($sorting_type == "price_desc") {
                $products = $products->orderBy('price', 'DESC');
                $sorting_type_selected = $sorting_type;
            } else {
                $products = $products->orderBy('price', 'ASC');
                $sorting_type_selected = $sorting_type;
            }
        }

        // Filter products based on searched keyword
        if ($request->get('search') != "") {
            $products = $products->where('title', 'like', '%' . $request->get('search') . '%');
        }

        // dd($products->toSql());

        // If sorting type filter is not applied
        if ($request->get("st") == "" || $request->get("st") == null) {
            $products = $products->orderBy('id', 'DESC');
            // dd($products->toSql());
        }

        $products = $products->paginate(12);

        return view("user_end.shop", compact("categories", "brands", "brands_array", "products", "category_selected", "sub_category_selected", "price_min", "price_max", "sorting_type_selected"));
    }

    public function product_details($product_slug)
    {
        $product = Product::where("slug", $product_slug)
            ->with("get_product_images")
            ->with("brand")
            ->withCount('get_product_ratings')
            ->withSum('get_product_ratings', 'rating')
            ->first();
        // dd($product);

        if (empty($product)) {
            abort(404);
        }

        $user_bought_product = null;
        if (Auth::check()) {
            $user_bought_product = Product::join('order_items', 'order_items.product_id', '=', 'products.id')
                ->join('orders', 'orders.id', '=', 'order_items.order_id')
                ->where("orders.user_id", Auth::user()->id)
                ->where("products.slug", $product_slug)
                ->exists();
            // dd($user_bought_product);
        }

        // Calculate average rating of the product
        $rating = 0;
        if ($product->get_product_ratings_count > 0) {
            $rating = $product->get_product_ratings_sum_rating / $product->get_product_ratings_count;
        }

        // Calculate percentage value based on 5 star rating
        // For example, 100% for 5 star rating, 80% for 4 star rating and so on
        $total_rating_perc = 0;
        if ($rating != 0) {
            $total_rating_perc = ($rating / 5) * 100;
        }

        /* Code for marking this product as recently viewed when user visits this product's page */
        // Create session id for the product if it doesn't exist, or else collect it from session
        $product_session_id = '';
        if (empty(Session::get('product_session_id'))) {
            $product_session_id = md5(uniqid(rand(), true));
            Session::put('product_session_id', $product_session_id);
        } else {
            $product_session_id = Session::get('product_session_id');
        }
        // List the product with the gathered session id in table if not already exists
        $flag = DB::table('recently_viewed_products')
            ->where('product_id', $product->id)
            ->where('product_session_id', $product_session_id)
            ->exists();
        if ($flag == false) {
            DB::table('recently_viewed_products')->insert([
                'product_id' => $product->id,
                'product_session_id' => $product_session_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        // Get the recently viewed products
        $recently_viewed_products = DB::table('recently_viewed_products')
            ->join('products', 'products.id', '=', 'recently_viewed_products.product_id')
            ->where('recently_viewed_products.product_id', '!=', $product->id)
            ->where('recently_viewed_products.product_session_id', $product_session_id)
            ->select('recently_viewed_products.*', 'products.title', 'products.slug', 'products.price', 'products.compare_price', 'products.track_qty', 'products.qty')
            ->orderBy('recently_viewed_products.id', 'DESC')
            ->limit(6)
            ->inRandomOrder()
            ->get();
        // dd($recently_viewed_products);

        return view("user_end.product", compact("product", "user_bought_product", "rating", "total_rating_perc", "recently_viewed_products"));
    }

    public function save_rating(Request $request, $product_id)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|numeric',
        ]);

        if ($validator->passes()) {
            if (ProductRating::where('product_id', $product_id)->where('user_id', Auth::user()->id)->exists()) {
                return response()->json([
                    'status' => true,
                    'success' => false,
                    'msg' => 'You have already rated this product before.',
                ]);
            } else {
                $rating = new ProductRating;
                $rating->product_id = $product_id;
                $rating->user_id = Auth::user()->id;
                $rating->rating = $request->rating;
                $rating->comment = $request->review;
                // Status is already 0 (INACTIVE) by default, so no need to hardcode it
                $rating->save();

                return response()->json([
                    'status' => true,
                    'success' => true,
                    'msg' => 'Thanks! Your review has been submitted.',
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
}
