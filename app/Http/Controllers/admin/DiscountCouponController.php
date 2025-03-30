<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCoupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountCouponController extends Controller
{
    public function index(Request $request)
    {
        $discount_coupons = DiscountCoupon::latest();

        if (!empty($request->get('discount_coupon_search'))) {
            $discount_coupons = $discount_coupons->where('name', 'like', '%' . $request->get('discount_coupon_search') . '%');
        }

        $discount_coupons = $discount_coupons->paginate(7);

        return view("admin.discount.list", compact("discount_coupons"));
    }

    public function create()
    {
        return view("admin.discount.create");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "code" => "required",
            "type" => "required|in:percent,fixed",
            "discount_amount" => "required|numeric",
            "status" => "required|in:1,0",
        ]);

        if ($validator->passes()) {
            // Starting date must be greater than the current date
            if ($request->starts_at != '') {
                $now = Carbon::now();
                $starts_at = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at);
                if ($starts_at->lte($now) == true) { // lte => Less than or equal to
                    return response()->json([
                        'status' => false,
                        'msg' => [
                            'starts_at' => 'Starting date cannot be less than or equal to the current date.',
                        ],
                    ]);
                }
            }

            // Expiring date must be greater than the starting date
            if ($request->expires_at != '' && $request->starts_at != '') {
                $starts_at = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at);
                $expires_at = Carbon::createFromFormat('Y-m-d H:i:s', $request->expires_at);
                if ($expires_at->lte($starts_at) == true) { // lte => Less than or equal to
                    return response()->json([
                        'status' => false,
                        'msg' => [
                            'expires_at' => 'Expiring date cannot be less than or equal to the starting date.',
                        ],
                    ]);
                }
            }

            $discount_coupon = new DiscountCoupon();
            $discount_coupon->code = $request->code;
            $discount_coupon->name = $request->name;
            $discount_coupon->description = $request->description;
            $discount_coupon->max_uses = $request->max_uses;
            $discount_coupon->max_uses_user = $request->max_uses_user;
            $discount_coupon->type = $request->type;
            $discount_coupon->discount_amount = $request->discount_amount;
            $discount_coupon->min_amount = $request->min_amount;
            $discount_coupon->starts_at = $request->starts_at;
            $discount_coupon->expires_at = $request->expires_at;
            $discount_coupon->status = $request->status;
            $discount_coupon->save();

            $request->session()->flash("success", "Discount Coupon created successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'Discount Coupon created successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function edit(Request $request, $discount_coupon_id)
    {
        $discount_coupon = DiscountCoupon::find($discount_coupon_id);

        if (empty($discount_coupon)) {
            $request->session()->flash("error", "Discount Coupon not found.");

            return redirect()->route('admin_view_discount_coupons');
        }

        return view('admin.discount.edit', compact('discount_coupon'));
    }

    public function update(Request $request, $discount_coupon_id)
    {
        $discount_coupon = DiscountCoupon::find($discount_coupon_id);

        if (empty($discount_coupon)) {
            $request->session()->flash("error", "Discount Coupon not found.");

            return response()->json([
                'status' => false,
                'notFound' => true,
                'msg' => 'Discount Coupon not found.',
            ]);
        }

        $validator = Validator::make($request->all(), [
            "code" => "required",
            "type" => "required|in:percent,fixed",
            "discount_amount" => "required|numeric",
            "status" => "required|in:1,0",
        ]);

        if ($validator->passes()) {
            // Expiring date must be greater than the starting date
            if ($request->expires_at != '' && $request->starts_at != '') {
                $starts_at = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at);
                $expires_at = Carbon::createFromFormat('Y-m-d H:i:s', $request->expires_at);
                if ($expires_at->lte($starts_at) == true) { // lte => Less than or equal to
                    return response()->json([
                        'status' => false,
                        'msg' => [
                            'expires_at' => 'Expiring date cannot be less than or equal to the starting date.',
                        ],
                    ]);
                }
            }

            $discount_coupon->code = $request->code;
            $discount_coupon->name = $request->name;
            $discount_coupon->description = $request->description;
            $discount_coupon->max_uses = $request->max_uses;
            $discount_coupon->max_uses_user = $request->max_uses_user;
            $discount_coupon->type = $request->type;
            $discount_coupon->discount_amount = $request->discount_amount;
            $discount_coupon->min_amount = $request->min_amount;
            $discount_coupon->starts_at = $request->starts_at;
            $discount_coupon->expires_at = $request->expires_at;
            $discount_coupon->status = $request->status;
            $discount_coupon->save();

            $request->session()->flash("success", "Discount Coupon updated successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'Discount Coupon updated successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function destroy(Request $request, $discount_coupon_id)
    {
        $discount_coupon = DiscountCoupon::find($discount_coupon_id);

        if (empty($discount_coupon)) {
            $request->session()->flash("error", "Discount Coupon not found.");

            return response()->json([
                'status' => false,
                'msg' => 'Discount Coupon not found.',
            ]);
        }

        $discount_coupon->delete();

        $request->session()->flash("success", "Discount Coupon deleted successfully.");

        return response()->json([
            'status' => true,
            'msg' => 'Discount Coupon deleted successfully.',
        ]);
    }
}
