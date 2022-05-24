<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Session;


class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        // $top_sell = OrderDetail::with(['product'])
        //     ->select('product_id', DB::raw('SUM(qty) as count'))
        //     ->groupBy('product_id')
        //     ->orderBy("count", 'desc')
        //     ->take(6)
        //     ->get();

        // $most_rated_products = Product::rightJoin('reviews', 'reviews.product_id', '=', 'products.id')
        //     ->groupBy('product_id')
        //     ->select(['product_id',
        //         DB::raw('AVG(reviews.rating) as ratings_average'),
        //         DB::raw('count(*) as total')
        //     ])
        //     ->orderBy('total', 'desc')
        //     ->take(6)
        //     ->get();

        // $top_store_by_earning = SellerWalletHistory::select('seller_id', DB::raw('SUM(amount) as count'))
        //     ->groupBy('seller_id')
        //     ->orderBy("count", 'desc')
        //     ->take(6)
        //     ->get();

        // $top_customer = Order::with(['customer'])
        //     ->select('customer_id', DB::raw('COUNT(customer_id) as count'))
        //     ->groupBy('customer_id')
        //     ->orderBy("count", 'desc')
        //     ->take(6)
        //     ->get();

        // $top_store_by_order_received = Order::where('seller_is', 'seller')
        //     ->select('seller_id', DB::raw('COUNT(id) as count'))
        //     ->groupBy('seller_id')
        //     ->orderBy("count", 'desc')
        //     ->take(6)
        //     ->get();

        // $from = Carbon::now()->startOfYear()->format('Y-m-d');
        // $to = Carbon::now()->endOfYear()->format('Y-m-d');

        // $inhouse_data = [];
        // $inhouse_earning = OrderTransaction::where([
        //     'seller_is' => 'admin',
        //     'status' => 'disburse'
        // ])->select(
        //     DB::raw('IFNULL(sum(seller_amount),0) as sums'),
        //     DB::raw('YEAR(created_at) year, MONTH(created_at) month')
        // )->whereBetween('created_at', [$from, $to])->groupby('year', 'month')->get()->toArray();
        // for ($inc = 1; $inc <= 12; $inc++) {
        //     $inhouse_data[$inc] = 0;
        //     foreach ($inhouse_earning as $match) {
        //         if ($match['month'] == $inc) {
        //             $inhouse_data[$inc] = $match['sums'];
        //         }
        //     }
        // }

        // $seller_data = [];
        // $seller_earnings = OrderTransaction::where([
        //     'seller_is' => 'seller',
        //     'status' => 'disburse'
        // ])->select(
        //     DB::raw('IFNULL(sum(seller_amount),0) as sums'),
        //     DB::raw('YEAR(created_at) year, MONTH(created_at) month')
        // )->whereBetween('created_at', [$from, $to])->groupby('year', 'month')->get()->toArray();
        // for ($inc = 1; $inc <= 12; $inc++) {
        //     $seller_data[$inc] = 0;
        //     foreach ($seller_earnings as $match) {
        //         if ($match['month'] == $inc) {
        //             $seller_data[$inc] = $match['sums'];
        //         }
        //     }
        // }

        // $commission_data = [];
        // $commission_earnings = OrderTransaction::where([
        //     'status' => 'disburse'
        // ])->select(
        //     DB::raw('IFNULL(sum(admin_commission),0) as sums'),
        //     DB::raw('YEAR(created_at) year, MONTH(created_at) month')
        // )->whereBetween('created_at', [$from, $to])->groupby('year', 'month')->get()->toArray();
        // for ($inc = 1; $inc <= 12; $inc++) {
        //     $commission_data[$inc] = 0;
        //     foreach ($commission_earnings as $match) {
        //         if ($match['month'] == $inc) {
        //             $commission_data[$inc] = $match['sums'];
        //         }
        //     }
        // }

        // $data = self::order_stats_data();
        // $data['customer'] = User::count();
        // $data['store'] = Shop::count();
        // $data['product'] = Product::count();
        // $data['order'] = Order::count();
        // $data['brand'] = Brand::count();

        // $data['top_sell'] = $top_sell;
        // $data['most_rated_products'] = $most_rated_products;
        // $data['top_store_by_earning'] = $top_store_by_earning;
        // $data['top_customer'] = $top_customer;
        // $data['top_store_by_order_received'] = $top_store_by_order_received;

        // $admin_wallet = AdminWallet::where('admin_id', 1)->first();
        // $data['inhouse_earning'] = $admin_wallet->inhouse_earning;
        // $data['commission_earned'] = $admin_wallet->commission_earned;
        // $data['delivery_charge_earned'] = $admin_wallet->delivery_charge_earned;
        // $data['pending_amount'] = $admin_wallet->pending_amount;
        // $data['total_tax_collected'] = $admin_wallet->total_tax_collected;

        return view('System.dashboard');
        // return view('System.dashboard');

    }

}
