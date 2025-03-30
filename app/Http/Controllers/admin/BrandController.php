<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Validator;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::latest();

        if (!empty($request->get('brand_search'))) {
            $brands = $brands->where('name', 'like', '%' . $request->get('brand_search') . '%');
        }

        $brands = $brands->paginate(7);
        // dd($brands);

        return view("admin.brand.list", compact("brands"));
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "slug" => "required|unique:brands",
            "status" => "required|in:1,0",
        ]);

        if ($validator->passes()) {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();

            $request->session()->flash("success", "Brand created successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'Brand created successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function edit(Request $request, $brand_id)
    {
        $brand = Brand::find($brand_id);

        if (empty($brand)) {
            $request->session()->flash("error", "Brand not found.");

            return redirect()->route('admin_view_brands');
        }

        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $brand_id)
    {
        $brand = Brand::find($brand_id);

        if (empty($brand)) {
            $request->session()->flash("error", "Brand not found.");

            return response()->json([
                'status' => false,
                'notFound' => true,
                'msg' => 'Brand not found.',
            ]);
        }

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "slug" => "required|unique:brands,slug," . $brand->id . ",id", // Ignoring the row with specified brand id in this validation rule
            "status" => "required|in:1,0",
        ]);

        if ($validator->passes()) {
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();

            $request->session()->flash("success", "Brand updated successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'Brand updated successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function destroy(Request $request, $brand_id)
    {
        $brand = Brand::find($brand_id);

        if (empty($brand)) {
            $request->session()->flash("error", "Brand not found.");

            return response()->json([
                'status' => false,
                'msg' => 'Brand not found.',
            ]);
        }

        $brand->delete();

        $request->session()->flash("success", "Brand deleted successfully.");

        return response()->json([
            'status' => true,
            'msg' => 'Brand deleted successfully.',
        ]);
    }
}
