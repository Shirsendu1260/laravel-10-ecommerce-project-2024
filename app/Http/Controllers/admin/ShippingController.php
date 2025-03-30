<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\ShippingCharge;
use DB;
use Illuminate\Http\Request;
use Validator;

class ShippingController extends Controller
{
    public function index(Request $request)
    {
        $shippings = ShippingCharge::select('shipping_charges.*', 'countries.name')
            ->join('countries', 'countries.id', 'shipping_charges.country_id');

        if (!empty($request->get('shipping_search'))) {
            $shippings = $shippings->where('name', 'like', '%' . $request->get('shipping_search') . '%');
        }

        $shippings = $shippings->paginate(7);
        // dd($shippings);

        return view("admin.shipping.list", compact("shippings"));
    }

    public function create()
    {
        $countries = Country::get();

        return view("admin.shipping.create", compact("countries"));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "country" => "required|integer",
            "amount" => "required|numeric",
        ]);

        if ($validator->passes()) {
            // Code to prevent repetitive insertion of shipping charge of a country (if it is already there in table)
            $count = ShippingCharge::where('country_id', $request->country)->count();
            if ($count > 0) {
                $request->session()->flash("error", "The shipping charge was already added.");

                return response()->json([
                    'status' => false,
                    'existingShippingChargeCount' => $count,
                    'msg' => 'The shipping charge was already added.',
                ]);
            }

            $shipping = new ShippingCharge();
            $shipping->country_id = $request->country;
            $shipping->amount = $request->amount;
            $shipping->save();

            $request->session()->flash("success", "Shipping created successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'Shipping created successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function edit(Request $request, $shipping_id)
    {
        $shipping = ShippingCharge::find($shipping_id);
        $countries = Country::get();

        if (empty($shipping)) {
            $request->session()->flash("error", "Shipping not found.");

            return redirect()->route('admin_view_shippings');
        }

        return view('admin.shipping.edit', compact('shipping', 'countries'));
    }

    public function update(Request $request, $shipping_id)
    {
        $shipping = ShippingCharge::find($shipping_id);

        if (empty($shipping)) {
            $request->session()->flash("error", "Shipping not found.");

            return response()->json([
                'status' => false,
                'notFound' => true,
                'msg' => 'Shipping not found.',
            ]);
        }

        $validator = Validator::make($request->all(), [
            "country" => "required|integer",
            "amount" => "required|numeric",
        ]);

        if ($validator->passes()) {
            $shipping->country_id = $request->country;
            $shipping->amount = $request->amount;
            $shipping->save();

            $request->session()->flash("success", "Shipping updated successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'Shipping updated successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ]);
        }
    }

    public function destroy(Request $request, $shipping_id)
    {
        $shipping = ShippingCharge::find($shipping_id);

        if (empty($shipping)) {
            $request->session()->flash("error", "Shipping not found.");

            return response()->json([
                'status' => false,
                'msg' => 'Shipping not found.',
            ]);
        }

        $shipping->delete();

        $request->session()->flash("success", "Shipping deleted successfully.");

        return response()->json([
            'status' => true,
            'msg' => 'Shipping deleted successfully.',
        ]);
    }
}
