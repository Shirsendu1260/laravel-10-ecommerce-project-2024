<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request, $start_date = null, $end_date = null)
    {
        $orders = Order::latest('created_at');

        if (!empty($request->get('order_search'))) {
            $orders = $orders->where('first_name', 'like', '%' . $request->get('order_search') . '%');
            $orders = $orders->orWhere('last_name', 'like', '%' . $request->get('order_search') . '%');
            $orders = $orders->orWhere('email', 'like', '%' . $request->get('order_search') . '%');
            $orders = $orders->orWhere('phone', 'like', '%' . $request->get('order_search') . '%');
            $orders = $orders->orWhere('unique_order_id', 'like', '%' . $request->get('order_search') . '%');
        }

        // dd(gettype($start_date));

        if ($start_date != null) {
            $start_date = date('Y-m-d', strtotime($start_date));
        }

        if ($end_date != null) {
            $end_date = date('Y-m-d', strtotime($end_date));
        }

        if ($start_date != null && $end_date != null) {
            $orders = $orders->whereDate('created_at', '>=', $start_date)
                ->whereDate('created_at', '<=', $end_date)
                ->paginate(7);
        } else {
            $orders = $orders->paginate(7);
        }

        return view("admin.order.list", compact("orders"));
    }

    public function order_details($unique_order_id)
    {
        $order_details = Order::join('countries', 'orders.country_id', '=', 'countries.id')
            ->where('orders.unique_order_id', $unique_order_id)
            ->select('orders.*', 'countries.name as country_name')
            ->first();
        $order_items = Order::where('unique_order_id', $unique_order_id)
            ->join("order_items", "orders.id", "=", "order_items.order_id")
            ->join("products", "products.id", "=", "order_items.product_id")
            ->select("products.id", "products.title", "order_items.qty", "products.price", "order_items.total", "products.slug")
            ->get();

        return view("admin.order.order-details", compact("order_details", "order_items"));
    }

    public function change_order_status(Request $request, $unique_order_id)
    {
        $order = Order::where('unique_order_id', $unique_order_id)->first();

        $order_status_update = Order::where('unique_order_id', $unique_order_id)
            ->update([
            'status' => $request->status,
            'shipped_date' => $request->shipped_date,
            'delivered_date' => $request->delivered_date,
        ]);

        // Update payment status for delivered cod order
        if ($order->payment_method == 'cod' && $request->status == 'delivered') {
            $order->payment_status = 'paid';
            $order->save();
        }

        $request->session()->flash("success", "Order status updated successfully.");

        if ($order_status_update > 0) {
            return response()->json([
                'status' => true,
                'msg' => 'Order status updated successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'Unable to update order status!',
            ]);
        }
    }

    public function send_invoice_email(Request $request, $unique_order_id)
    {
        $send_invoice_email_usertype = $request->send_invoice_email_usertype;

        if ($send_invoice_email_usertype == 'admin') {
            $admin = User::find(Auth::user()->id);
            // dd($admin->first());
            send_order_success_mail($unique_order_id, $admin->email, $send_invoice_email_usertype);

            $request->session()->flash("success", "Order success mail was sent to admin successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'Order success mail was sent to admin successfully.',
            ]);
        } else {
            $order = Order::where('unique_order_id', $unique_order_id)->first();
            // dd($order);
            send_order_success_mail($unique_order_id, $order->email, $send_invoice_email_usertype);

            $request->session()->flash("success", "Order success mail was sent to customer successfully.");

            return response()->json([
                'status' => true,
                'msg' => 'Order success mail was sent to customer successfully.',
            ]);
        }
    }
}
