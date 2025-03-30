<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class AdminHomeController extends Controller
{
    public function index()
    {
        $order_count = Order::count();
        $products_count = Product::count();
        $customer_count = User::where('role', operator: '0')->count();

        // Total revenue till now
        $total_sale = Order::where('payment_status', 'paid')
            ->where('status', '!=', 'cancelled')
            ->sum('grand_total');

        // Generate this month's revenue
        $month_start_date = Carbon::now()->startOfMonth()->format('Y-m-d');
        $current_date = Carbon::now()->format('Y-m-d');
        $this_month_total_sale = Order::where('payment_status', 'paid')
            ->where('status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $month_start_date)
            ->whereDate('created_at', '<=', $current_date)
            ->sum('grand_total');

        // Generate last month's revenue
        $last_month_start_date = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $last_month_end_date = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
        $last_month_total_sale = Order::where('payment_status', 'paid')
            ->where('status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $last_month_start_date)
            ->whereDate('created_at', '<=', $last_month_end_date)
            ->sum('grand_total');

        // Generate revenue of last 30 days
        $last_30days_start_date = Carbon::now()->subDays(value: 30)->format('Y-m-d');
        $last_30days_total_sale = Order::where('payment_status', 'paid')
            ->where('status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $last_30days_start_date)
            ->whereDate('created_at', '<=', $current_date)
            ->sum('grand_total');

        // Generate revenue of last 6 months
        $last_6months_start_date = Carbon::now()->subMonths(value: 6)->format('Y-m-d');
        $last_6months_total_sale = Order::where('payment_status', 'paid')
            ->where('status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $last_6months_start_date)
            ->whereDate('created_at', '<=', $current_date)
            ->sum('grand_total');

        // Generate last year's revenue
        $last_year = Carbon::now()->subYear()->format('Y');
        $last_year_start_date = Carbon::now()->subYear()->startOfYear()->format('Y-m-d');
        $last_year_end_date = Carbon::now()->subYear()->endOfYear()->format('Y-m-d');
        $last_year_total_sale = Order::where('payment_status', 'paid')
            ->where('status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $last_year_start_date)
            ->whereDate('created_at', '<=', $last_year_end_date)
            ->sum('grand_total');

        // Generate this year's revenue till now
        $this_year_start_date = Carbon::now()->startOfYear()->format('Y-m-d');
        $this_year_total_sale = Order::where('payment_status', 'paid')
            ->where('status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $this_year_start_date)
            ->whereDate('created_at', '<=', $current_date)
            ->sum('grand_total');

        return view("admin.dashboard", compact(
            "order_count",
            "products_count",
            "customer_count",
            "total_sale",
            "this_month_total_sale",
            "month_start_date",
            "current_date",
            "last_month_total_sale",
            "last_month_start_date",
            "last_month_end_date",
            "last_30days_total_sale",
            "last_30days_start_date",
            "last_6months_total_sale",
            "last_6months_start_date",
            "last_year_total_sale",
            "last_year",
            "last_year_start_date",
            "last_year_end_date",
            "this_year_total_sale",
            "this_year_start_date"
        ));
    }
}
