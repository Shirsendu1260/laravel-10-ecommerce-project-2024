<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TempImage;
use File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::latest();

        if (!empty($request->get('category_search'))) {
            $categories = $categories->where('name', 'like', '%' . $request->get('category_search') . '%');
        }

        $categories = $categories->paginate(7);
        // dd($categories);

        return view("admin.category.list", compact("categories"));
    }

    public function create()
    {
        return view("admin.category.create");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "slug" => "required|unique:categories",
            "photo" => "sometimes|image:jpg,jpeg,png",
            "status" => "required|in:1,0",
            "show_on_homepage" => "required|in:1,0",
        ]);

        if ($validator->passes()) {
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->show_on_homepage = $request->show_on_homepage;
            $category->save();

            // For saving the category image
            if (!empty($request->image_id)) {
                $temp_image = TempImage::find($request->image_id);

                $file_name_array = explode('.', $temp_image->name);
                // $file_name = $file_name_array[0];
                $ext = last($file_name_array);

                $new_file_name = Carbon::now()->format('YmdHis') . '_' . rand(0, 999) . '.' . $ext;

                // For copying the image file
                $source = public_path() . '/uploads/temp_images/' . $temp_image->name; // Image contains here
                $upload_path = public_path() . '/uploads/category/';
                if (!file_exists($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }
                $destination = $upload_path . $new_file_name; // Image will be copied here
                File::copy($source, $destination);

                // Generate image thumbnail by resizing in dimension 200 X 200
                $img_manager = new ImageManager(new Driver());
                $image = $img_manager->read($source);
                $image->coverDown(200, 200);
                $thumbnail_upload_path = public_path() . '/uploads/category/thumbnails/';
                if (!file_exists($thumbnail_upload_path)) {
                    mkdir($thumbnail_upload_path, 0777, true);
                }
                $image->save($thumbnail_upload_path . $new_file_name);

                $category->image = $new_file_name;
                $category->save();

                // Delete temporary image file from 'temp_images/' folder of local storage
                File::delete(public_path() . '/uploads/temp_images/' . $temp_image->name);
            }

            $request->session()->flash("success", "Category created successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'Category created successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function edit(Request $request, $category_id)
    {
        $category = Category::find($category_id);
        // dd($category);

        if (empty($category)) {
            $request->session()->flash("error", "Category not found.");

            return redirect()->route('admin_view_categories');
        }

        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $category_id)
    {
        $category = Category::find($category_id);

        if (empty($category)) {
            $request->session()->flash("error", "Category not found.");

            return response()->json([
                'status' => false,
                'notFound' => true,
                'msg' => 'Category not found.',
            ]);
        }

        $old_image_file = $category->image;

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "slug" => "required|unique:categories,slug," . $category->id . ",id", // Ignoring the row with specified category id in this validation rule
            'photo' => 'sometimes|image:jpg,jpeg,png',
            "status" => "required|in:1,0",
            "show_on_homepage" => "required|in:1,0",
        ]);

        if ($validator->passes()) {
            // $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->show_on_homepage = $request->show_on_homepage;
            $category->save();

            // For saving the category image
            $new_file_name = '';
            if (!empty($request->image_id)) {
                $temp_image = TempImage::find($request->image_id);

                $file_name_array = explode('.', $temp_image->name);
                // $file_name = $file_name_array[0];
                $ext = last($file_name_array);

                $new_file_name = Carbon::now()->format('YmdHis') . '_' . rand(0, 999) . '.' . $ext;

                // For copying the image file
                $source = public_path() . '/uploads/temp_images/' . $temp_image->name; // Image contains here
                $upload_path = public_path() . '/uploads/category/';
                if (!file_exists($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }
                $destination = $upload_path . $new_file_name; // Image will be copied here
                File::copy($source, $destination);

                // Generate image thumbnail by resizing in dimension 200 X 200
                $img_manager = new ImageManager(new Driver());
                $image = $img_manager->read($source);
                $image->coverDown(200, 200);
                $thumbnail_upload_path = public_path() . '/uploads/category/thumbnails/';
                if (!file_exists($thumbnail_upload_path)) {
                    mkdir($thumbnail_upload_path, 0777, true);
                }
                $image->save($thumbnail_upload_path . $new_file_name);

                $category->image = $new_file_name;
                $category->save();

                // Delete old image file from 'category/' and 'thumbnails/' folder of local storage
                File::delete($thumbnail_upload_path . $old_image_file);
                File::delete($upload_path . $old_image_file);

                // Delete temporary image file from 'temp_images/' folder of local storage
                File::delete(public_path() . '/uploads/temp_images/' . $temp_image->name);
            }

            $request->session()->flash("success", "Category updated successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'Category updated successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function destroy(Request $request, $category_id)
    {
        $category = Category::find($category_id);

        if (empty($category)) {
            $request->session()->flash("error", "Category not found.");

            return response()->json([
                'status' => false,
                'msg' => 'Category not found.',
            ]);
        }

        if ($category->image != null) {
            File::delete(public_path() . '/uploads/category/thumbnails/' . $category->image);
            File::delete(public_path() . '/uploads/category/' . $category->image);
        }

        $category->delete();

        $request->session()->flash("success", "Category deleted successfully.");

        return response()->json([
            'status' => true,
            'msg' => 'Category deleted successfully.',
        ]);
    }
}
