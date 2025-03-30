<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StaticPageController extends Controller
{
    public function index(Request $request)
    {
        $static_pages = StaticPage::latest();

        if (!empty($request->get('static_page_search'))) {
            $static_pages = $static_pages->where('name', 'like', '%' . $request->get('static_page_search') . '%');
        }

        $static_pages = $static_pages->paginate(7);

        return view("admin.static_page.list", compact("static_pages"));
    }

    public function create()
    {
        return view("admin.static_page.create");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "slug" => "required|unique:static_pages",
            "status" => "required|in:1,0",
        ]);

        if ($validator->passes()) {
            $static_page = new StaticPage();
            $static_page->name = $request->name;
            $static_page->slug = $request->slug;
            $static_page->content = $request->content;
            $static_page->status = $request->status;
            $static_page->save();

            $request->session()->flash("success", "Static Page created successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'Static Page created successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function edit(Request $request, $static_page_id)
    {
        $static_page = StaticPage::find($static_page_id);

        if (empty($static_page)) {
            $request->session()->flash("error", "Static Page not found.");

            return redirect()->route('admin_view_static_pages');
        }

        return view('admin.static_page.edit', compact('static_page'));
    }

    public function update(Request $request, $static_page_id)
    {
        $static_page = StaticPage::find($static_page_id);

        if (empty($static_page)) {
            $request->session()->flash("error", "Static Page not found.");

            return response()->json([
                'status' => false,
                'notFound' => true,
                'msg' => 'Static Page not found.',
            ]);
        }

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "slug" => "required|unique:static_pages,slug," . $static_page->id . ",id",
            "status" => "required|in:1,0",
        ]);

        if ($validator->passes()) {
            $static_page->name = $request->name;
            $static_page->slug = $request->slug;
            $static_page->content = $request->content;
            $static_page->status = $request->status;
            $static_page->save();

            $request->session()->flash("success", "Static Page updated successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'Static Page updated successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function destroy(Request $request, $static_page_id)
    {
        $static_page = StaticPage::find($static_page_id);

        if (empty($static_page)) {
            $request->session()->flash("error", "Static Page not found.");

            return response()->json([
                'status' => false,
                'msg' => 'Static Page not found.',
            ]);
        }

        $static_page->delete();

        $request->session()->flash("success", "Static Page deleted successfully.");

        return response()->json([
            'status' => true,
            'msg' => 'Static Page deleted successfully.',
        ]);
    }
}
