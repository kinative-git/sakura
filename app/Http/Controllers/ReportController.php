<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\CommissionHistory;
use App\Wallet;
use App\Seller;
use App\User;
use App\Search;
use App\Order;
use Auth;
use Excel;
use App\Exports\OrdersExport;
use App\Exports\ProductsExport;
use App\Exports\StocksExport;
use App\Exports\ComissionsExport;
use App\Exports\SellersExport;
class ReportController extends Controller

{
    public function sale_report(Request $request)
    {
        $date = $request->date;
        $net = 0;
        $profit = 0;
        $items = 0;
        $num_orders = 0;
        $tax = 0;
        $shipping = 0;
        $coupon = 0;
        $orders = Order::query();

        if ($date != null) {
            $orders = $orders->where('delivery_status','delivered')->where('payment_status','paid')->whereDate('created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
        }
        if($request->has('seller') && $request->seller!=''){
            $orders = $orders->where('seller_id',$request->seller);
        }
        foreach ($orders->where('delivery_status','delivered')->get()  as $key => $order) {
            $net += $order->grand_total;
            $num_orders += 1;
            $coupon += $order->coupon_discount;
            if($order->orderDetails != null){
                $items += $order->orderDetails->count();
                $shipping += $order->orderDetails->sum('shipping_cost');
                $tax += $order->orderDetails->sum('tax');
                $profit += $order->orderDetails->sum('profit');
            }
        }
        if($request->button == 'export'){
            return Excel::download(new OrdersExport($orders->latest()->get()), 'orders.xlsx');
        }
        $orders=$orders->where('delivery_status','delivered')->where('payment_status','paid')->latest()->get();
        return view('backend.reports.sale_report', compact('date', 'net', 'profit', 'items', 'num_orders', 'tax', 'shipping', 'coupon','orders'));
    }
    public function stock_report(Request $request)
    {
        $sort_by =null;
        $products = Product::orderBy('created_at', 'desc');
        if ($request->has('category_id')){
            $sort_by = $request->category_id;
            $products = $products->where('category_id', $sort_by);
        }
        if($request->button == 'export'){
            return Excel::download(new StocksExport($products->latest()->get()), 'product_stocks.xlsx');
        }
        $products = $products->paginate(15);
        return view('backend.reports.stock_report', compact('products','sort_by'));
    }

    public function in_house_sale_report(Request $request)
    {
        $sort_by =null;
        $products = Product::orderBy('num_of_sale', 'desc')->where('added_by', 'admin');
        if ($request->has('category_id')){
            $sort_by = $request->category_id;
            $products = $products->where('category_id', $sort_by);
        }
        if($request->button == 'export'){

            return Excel::download(new ProductsExport($products->latest()->get()), 'inhouse_products_sale.xlsx');
        }
        $products = $products->paginate(15);

        return view('backend.reports.in_house_sale_report', compact('products','sort_by'));
    }

    public function seller_sale_report(Request $request)
    {
        $sort_by =null;
        $date = $request->date;
        $sellers = Seller::orderBy('created_at', 'desc');
        if ($request->has('verification_status')){
            $sort_by = $request->verification_status;
            $sellers = $sellers->where('verification_status', $sort_by);
        }
        // $orders = $orders->where('delivery_status','delivered')->where('payment_status','paid')->whereDate('created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
        if($request->button == 'export'){
            return Excel::download(new SellersExport($sellers->latest()->get(),$date), 'sellers_sales.xlsx');
        }
        $sellers = $sellers->paginate(10);
        return view('backend.reports.seller_sale_report', compact('sellers','sort_by','date'));
    }

    public function wish_report(Request $request)
    {
        $sort_by =null;
        $products = Product::orderBy('created_at', 'desc');
        if ($request->has('category_id')){
            $sort_by = $request->category_id;
            $products = $products->where('category_id', $sort_by);
        }
        $products = $products->paginate(10);
        return view('backend.reports.wish_report', compact('products','sort_by'));
    }

    public function user_search_report(Request $request){
        $searches = Search::orderBy('count', 'desc')->paginate(10);
        return view('backend.reports.user_search_report', compact('searches'));
    }

    public function commission_history(Request $request) {
        $seller_id = null;
        $date_range = null;

        if(Auth::user()->user_type == 'seller') {
            $seller_id = Auth::user()->id;
        } if($request->seller_id) {
            $seller_id = $request->seller_id;
        }

        $commission_history = CommissionHistory::orderBy('created_at', 'desc');
        if($request->button == 'export'){

            return Excel::download(new ComissionsExport($commission_history->latest()->get()), 'commsions_history.xlsx');
        }
        if ($request->date_range) {
            $date_range = $request->date_range;
            $date_range1 = explode(" / ", $request->date_range);
            $commission_history = $commission_history->where('created_at', '>=', $date_range1[0]);
            $commission_history = $commission_history->where('created_at', '<=', $date_range1[1]);
        }
        if ($seller_id){

            $commission_history = $commission_history->where('seller_id', '=', $seller_id);
        }

        $commission_history = $commission_history->paginate(10);
        if(Auth::user()->user_type == 'seller') {
            return view('frontend.user.seller.reports.commission_history_report', compact('commission_history', 'seller_id', 'date_range'));
        }

        return view('backend.reports.commission_history_report', compact('commission_history', 'seller_id', 'date_range'));
    }

    public function wallet_transaction_history(Request $request) {
        $user_id = null;
        $date_range = null;

        if($request->user_id) {
            $user_id = $request->user_id;
        }

        $users_with_wallet = User::whereIn('id', function($query) {
            $query->select('user_id')->from(with(new Wallet)->getTable());
        })->get();

        $wallet_history = Wallet::orderBy('created_at', 'desc');

        if ($request->date_range) {
            $date_range = $request->date_range;
            $date_range1 = explode(" / ", $request->date_range);
            $wallet_history = $wallet_history->where('created_at', '>=', $date_range1[0]);
            $wallet_history = $wallet_history->where('created_at', '<=', $date_range1[1]);
        }
        if ($user_id){
            $wallet_history = $wallet_history->where('user_id', '=', $user_id);
        }

        $wallets = $wallet_history->paginate(10);

        return view('backend.reports.wallet_history_report', compact('wallets', 'users_with_wallet', 'user_id', 'date_range'));
    }
    public function sale_report_print(){
        $orders = Order::query();
          $orders=$orders->where('delivery_status','delivered')->latest()->get();


        return view('backend.reports.sales_stat_print', compact('orders'));
    }
}
