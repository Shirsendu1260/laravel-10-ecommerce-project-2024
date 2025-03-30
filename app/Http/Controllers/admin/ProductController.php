<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductRating;
use App\Models\SubCategory;
use App\Models\TempImage;
use File;
use Validator;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Get products' data along with images using the defined relation 'get_product_images' from 'Product' model
        $products = Product::latest()->with('get_product_images');
        // dd($products->get());

        if (!empty($request->get('product_search'))) {
            $products = $products->where('title', 'like', '%' . $request->get('product_search') . '%');
        }

        $products = $products->paginate(7);
        // dd($products);

        return view("admin.product.list", compact("products"));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $sub_categories = SubCategory::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();

        return view('admin.product.create', compact('categories', 'sub_categories', 'brands'));
    }

    public function get_sub_categories_of_category(Request $request)
    {
        if (!empty($request->category_id)) {
            $sub_categories = SubCategory::where('category_id', $request->category_id)
                ->orderBy('name', 'ASC')
                ->get();

            return response()->json([
                'status' => true,
                'subCategories' => $sub_categories,
            ]);
        } else {
            return response()->json([
                'status' => true,
                'subCategories' => [],
            ]);
        }
    }

    public function store(Request $request)
    {
        // dd($request->img_ids);
        // exit();

        $rules = [
            "title" => "required",
            "slug" => "required|unique:products",
            "price" => "required|numeric",
            "sku" => "required|unique:products",
            "track_qty" => "required|in:1,0",
            "is_featured" => "required|in:1,0",
            "category_id" => "required|numeric",
        ];

        if (!empty($request->track_qty) && $request->track_qty == 1) {
            $rules["qty"] = "required|numeric";
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $product = new Product();
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->short_desc = $request->short_desc;
            $product->shipping_returns = $request->shipping_returns;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->brand_id = $request->brand_id;
            $product->is_featured = $request->is_featured;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->related_products = (!empty($request->related_products)) ? implode(",", $request->related_products) : "";
            $product->status = $request->status;
            $product->save();

            // Save product images
            if (!empty($request->img_ids)) {
                foreach ($request->img_ids as $temp_img_id) {
                    $temp_img = TempImage::find($temp_img_id);
                    $filename_array = explode('.', $temp_img->name);
                    $ext = last($filename_array);
                    // $filename = $filename_array[0];
                    $new_file_name = Carbon::now()->format('YmdHis') . '_' . rand(0, 999) . '.' . $ext;

                    $product_img = new ProductImage();
                    $product_img->name = $new_file_name;
                    $product_img->product_id = $product->id;
                    $product_img->save();

                    // For copying the image file
                    $source = public_path() . '/uploads/temp_images/' . $temp_img->name; // Image contains here

                    // Image Intervention implementation
                    $img_manager = new ImageManager(new Driver());
                    $image = $img_manager->read($source);
                    $image_thumb = $img_manager->read($source);

                    // Generate image thumbnail by resizing in dimension 200 X 200
                    $image_thumb->resize(200, 200);
                    $thumbnail_upload_path = public_path() . '/uploads/product/thumbnails/';
                    if (!file_exists($thumbnail_upload_path)) {
                        mkdir($thumbnail_upload_path, 0777, true);
                    }
                    $image_thumb->save($thumbnail_upload_path . $new_file_name);

                    // Generate product image by resizing in dimension 800 X 800
                    $image->resize(800, 800);
                    $upload_path = public_path() . '/uploads/product/';
                    if (!file_exists($upload_path)) {
                        mkdir($upload_path, 0777, true);
                    }
                    $image->save($upload_path . $new_file_name);

                    // Delete temporary image file from 'temp_images/' folder of local storage
                    File::delete(public_path() . '/uploads/temp_images/' . $temp_img->name);
                }
            }

            $request->session()->flash("success", "Product created successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'Product created successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function edit(Request $request, $product_id)
    {
        $product = Product::find($product_id);
        $categories = Category::orderBy('name', 'ASC')->get();
        $sub_categories = SubCategory::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();
        $related_products = null;
        // dd($product);

        // Fetch related products
        if ($product->related_products != "") {
            $related_products = Product::whereIn("id", explode(",", $product->related_products))->get();
        }

        if (empty($product)) {
            $request->session()->flash("error", "Product not found.");

            return redirect()->route('admin_view_products');
        }

        return view('admin.product.edit', compact('product', 'categories', 'sub_categories', 'brands', 'related_products'));
    }

    public function update(Request $request, $product_id)
    {
        $product = Product::find($product_id);
        // dd($product);

        if (empty($product)) {
            $request->session()->flash("error", "Product not found.");

            return response()->json([
                'status' => false,
                'notFound' => true,
                'msg' => 'Product not found.',
            ]);
        }

        $rules = [
            "title" => "required",
            "slug" => "required|unique:products,slug," . $product->id . ",id",
            "price" => "required|numeric",
            "sku" => "required|unique:products,sku," . $product->id . ",id",
            "track_qty" => "required|in:1,0",
            "is_featured" => "required|in:1,0",
            "category_id" => "required|numeric",
        ];

        if (!empty($request->track_qty) && $request->track_qty == 1) {
            $rules["qty"] = "required|numeric";
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->short_desc = $request->short_desc;
            $product->shipping_returns = $request->shipping_returns;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->brand_id = $request->brand_id;
            $product->is_featured = $request->is_featured;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->related_products = (!empty($request->related_products)) ? implode(",", $request->related_products) : "";
            $product->status = $request->status;
            $product->save();

            // Save product images
            if (!empty($request->img_ids)) {
                foreach ($request->img_ids as $temp_img_id) {
                    $temp_img = TempImage::find($temp_img_id);
                    $filename_array = explode('.', $temp_img->name);
                    $ext = last($filename_array);
                    // $filename = $filename_array[0];
                    $new_file_name = Carbon::now()->format('YmdHis') . '_' . rand(0, 999) . '.' . $ext;

                    $product_img = new ProductImage();
                    $product_img->name = $new_file_name;
                    $product_img->product_id = $product->id;
                    $product_img->save();

                    // For copying the image file
                    $source = public_path() . '/uploads/temp_images/' . $temp_img->name; // Image contains here

                    // Image Intervention implementation
                    $img_manager = new ImageManager(new Driver());
                    $image = $img_manager->read($source);
                    $image_thumb = $img_manager->read($source);

                    // Generate image thumbnail by resizing in dimension 200 X 200
                    $image_thumb->resize(200, 200);
                    $thumbnail_upload_path = public_path() . '/uploads/product/thumbnails/';
                    if (!file_exists($thumbnail_upload_path)) {
                        mkdir($thumbnail_upload_path, 0777, true);
                    }
                    $image_thumb->save($thumbnail_upload_path . $new_file_name);

                    // Generate product image by resizing in dimension 800 X 800
                    $image->resize(800, 800);
                    $upload_path = public_path() . '/uploads/product/';
                    if (!file_exists($upload_path)) {
                        mkdir($upload_path, 0777, true);
                    }
                    $image->save($upload_path . $new_file_name);

                    // Delete temporary image file from 'temp_images/' folder of local storage
                    File::delete(public_path() . '/uploads/temp_images/' . $temp_img->name);
                }
            }

            $request->session()->flash("success", "Product updated successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'Product updated successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function destroy(Request $request, $product_id)
    {
        $product = Product::find($product_id);

        if (empty($product)) {
            $request->session()->flash("error", "Product not found.");

            return response()->json([
                'status' => false,
                'msg' => 'Product not found.',
            ]);
        }

        $product_images = ProductImage::where('product_id', $product->id)->get();

        if (!empty($product_images)) {
            foreach ($product_images as $product_image) {
                File::delete(public_path() . '/uploads/product/thumbnails/' . $product_image->name);
                File::delete(public_path() . '/uploads/product/' . $product_image->name);

                $product_image->delete();
            }
        }

        $product->delete();

        $request->session()->flash("success", "Product deleted successfully.");

        return response()->json([
            'status' => true,
            'msg' => 'Product deleted successfully.',
        ]);
    }

    public function delete_product_image(Request $request)
    {
        $product_img_id = $request->product_img_id;

        if (!empty($product_img_id)) {
            $product_img = ProductImage::find($product_img_id);

            $is_deleted1 = File::delete(public_path() . '/uploads/product/thumbnails/' . $product_img->name);
            $is_deleted2 = File::delete(public_path() . '/uploads/product/' . $product_img->name);

            // Delete record from database
            $product_img->delete();

            if ($is_deleted1 == true && $is_deleted2 == true) {
                return response()->json([
                    'status' => true,
                    'msg' => 'Product images deleted successfully.',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => 'Unable to delete the product images.',
                ]);
            }
        }
    }

    public function get_products_for_related_products(Request $request)
    {
        $term = $request->input("term");
        $related_products = [];

        if ($term != "") {
            $products = Product::where("title", "like", "%" . $term . "%")->get();

            if ($products->isNotEmpty()) {
                foreach ($products as $product) {
                    array_push($related_products, array("id" => $product->id, "text" => $product->title));
                }
            }
        }

        // print_r($related_products);

        return response()->json([
            "status" => true,
            "tags" => $related_products,
        ]);
    }

    public function product_ratings(Request $request)
    {
        $product_ratings = ProductRating::join('users', 'users.id', '=', 'product_ratings.user_id')
            ->join('products', 'products.id', '=', 'product_ratings.product_id')
            ->orderBy('product_ratings.status', 'ASC')
            ->select('product_ratings.*', 'users.name as user_name', 'products.title as product_name', 'products.slug as product_slug');

        // dd($product_ratings);

        if (!empty($request->get('product_search'))) {
            $product_ratings = $product_ratings->where('products.title', 'like', '%' . $request->get('product_search') . '%');
            $product_ratings = $product_ratings->orWhere('users.name', 'like', '%' . $request->get('product_search') . '%');
        }

        $product_ratings = $product_ratings->paginate(7);

        return view('admin.product.ratings', compact("product_ratings"));
    }

    public function approve_product_rating($rating_id)
    {
        $rating = ProductRating::find($rating_id);

        if (empty($rating)) {
            session()->flash("error", "Review not found.");

            return response()->json([
                'status' => false,
                'msg' => 'Review not found.',
            ]);
        }

        $rating->status = 1;
        $rating->save();

        session()->flash("success", "Review approved successfully.");

        return response()->json([
            'status' => true,
            'msg' => 'Review approved successfully.',
        ]);
    }

    public function delete_product_rating($rating_id)
    {
        $rating = ProductRating::find($rating_id);

        if (empty($rating)) {
            session()->flash("error", "Review not found.");

            return response()->json([
                'status' => false,
                'msg' => 'Review not found.',
            ]);
        }

        $rating->delete();

        session()->flash("success", "Review deleted successfully.");

        return response()->json([
            'status' => true,
            'msg' => 'Review deleted successfully.',
        ]);
    }
}
