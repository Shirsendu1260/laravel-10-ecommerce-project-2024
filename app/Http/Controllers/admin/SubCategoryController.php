<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Validator;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        $sub_categories = SubCategory::select('sub_categories.*', 'categories.name as category')
            ->latest()
            ->leftJoin('categories', 'categories.id', 'sub_categories.category_id');

        if (!empty($request->get('sub_category_search'))) {
            $sub_categories = $sub_categories->where('sub_categories.name', 'like', '%' . $request->get('sub_category_search') . '%');
        }

        $sub_categories = $sub_categories->paginate(7);

        return view("admin.sub_category.list", compact("sub_categories"));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        // dd($categories);

        return view('admin.sub_category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "slug" => "required|unique:sub_categories",
            "status" => "required|in:1,0",
            "show_on_homepage" => "required|in:1,0",
            "category_id" => "required|numeric",
        ]);

        if ($validator->passes()) {
            $sub_category = new SubCategory();
            $sub_category->name = $request->name;
            $sub_category->slug = $request->slug;
            $sub_category->status = $request->status;
            $sub_category->show_on_homepage = $request->show_on_homepage;
            $sub_category->category_id = $request->category_id;
            $sub_category->save();

            $request->session()->flash("success", "Sub-category created successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'Sub-category created successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function edit(Request $request, $sub_category_id)
    {
        $sub_category = SubCategory::find($sub_category_id);
        $categories = Category::orderBy('name', 'ASC')->get();

        if (empty($sub_category)) {
            $request->session()->flash("error", "Sub-category not found.");

            return redirect()->route('admin_view_sub_categories');
        }

        return view('admin.sub_category.edit', compact('sub_category', 'categories'));
    }

    public function update(Request $request, $sub_category_id)
    {
        $sub_category = SubCategory::find($sub_category_id);

        if (empty($sub_category)) {
            $request->session()->flash("error", "Sub-category not found.");

            return response()->json([
                'status' => false,
                'notFound' => true,
                'msg' => 'Sub-category not found.',
            ]);
        }

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "slug" => "required|unique:sub_categories,slug," . $sub_category->id . ",id", // Ignoring the row with specified sub-category id in this validation rule
            "status" => "required|in:1,0",
            "show_on_homepage" => "required|in:1,0",
            "category_id" => "required|numeric",
        ]);

        if ($validator->passes()) {
            $sub_category->name = $request->name;
            $sub_category->slug = $request->slug;
            $sub_category->status = $request->status;
            $sub_category->show_on_homepage = $request->show_on_homepage;
            $sub_category->category_id = $request->category_id;
            $sub_category->save();

            $request->session()->flash("success", "Sub-category updated successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'Sub-category updated successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function destroy(Request $request, $sub_category_id)
    {
        $sub_category = SubCategory::find($sub_category_id);

        if (empty($sub_category)) {
            $request->session()->flash("error", "Sub-category not found.");

            return response()->json([
                'status' => false,
                'msg' => 'Sub-category not found.',
            ]);
        }

        $sub_category->delete();

        $request->session()->flash("success", "Sub-category deleted successfully.");

        return response()->json([
            'status' => true,
            'msg' => 'Sub-category deleted successfully.',
        ]);
    }
}
