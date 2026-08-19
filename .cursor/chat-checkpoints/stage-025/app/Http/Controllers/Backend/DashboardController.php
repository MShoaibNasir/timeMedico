<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\MasterLog;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        $revenueStatuses = ['Pending', 'Processing', 'On The way', 'Delivered'];

        $totalOrders = Order::count();
        $totalRevenue = (float) Order::whereIn('status', $revenueStatuses)->sum('grand_total');
        $todayOrders = Order::whereDate('created_at', $today)->count();
        $todayRevenue = (float) Order::whereDate('created_at', $today)
            ->whereIn('status', $revenueStatuses)
            ->sum('grand_total');

        $monthOrders = Order::where('created_at', '>=', $startOfMonth)->count();
        $monthRevenue = (float) Order::where('created_at', '>=', $startOfMonth)
            ->whereIn('status', $revenueStatuses)
            ->sum('grand_total');

        $lastMonthRevenue = (float) Order::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->whereIn('status', $revenueStatuses)
            ->sum('grand_total');

        $revenueGrowth = $lastMonthRevenue > 0
            ? round((($monthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1)
            : ($monthRevenue > 0 ? 100 : 0);

        $statusCounts = Order::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $pendingOrders = (int) ($statusCounts['Pending'] ?? 0);
        $processingOrders = (int) ($statusCounts['Processing'] ?? 0);
        $onTheWayOrders = (int) ($statusCounts['On The way'] ?? 0);
        $deliveredOrders = (int) ($statusCounts['Delivered'] ?? 0);
        $rejectedOrders = (int) ($statusCounts['Rejected'] ?? 0);
        $returnedOrders = (int) ($statusCounts['Returned'] ?? 0);

        $totalCustomers = User::count();
        $newCustomersMonth = User::where('created_at', '>=', $startOfMonth)->count();
        $totalProducts = Product::count();
        $activeProducts = Product::where('status', 1)->count();
        $lowStockProducts = Product::where('status', 1)->where('quantity', '>', 0)->where('quantity', '<=', 10)->count();
        $outOfStockProducts = Product::where('status', 1)->where('quantity', '<=', 0)->count();
        $totalCategories = Category::count();
        $totalFeedback = 0;
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('feedback')) {
                $totalFeedback = Feedback::count();
            }
        } catch (\Throwable $e) {
            $totalFeedback = 0;
        }

        $totalMasterLogs = 0;
        $recentMasterLogs = collect();
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('master_logs')) {
                $totalMasterLogs = MasterLog::count();
                $recentMasterLogs = MasterLog::latest('id')->take(8)->get();
            }
        } catch (\Throwable $e) {
            $totalMasterLogs = 0;
            $recentMasterLogs = collect();
        }

        $avgOrderValue = $totalOrders > 0
            ? round((float) Order::whereIn('status', $revenueStatuses)->avg('grand_total'), 2)
            : 0;

        $recentOrders = Order::latest()->take(8)->get();

        $topProducts = OrderItem::query()
            ->select(
                'order_items.product_id',
                'order_items.name',
                DB::raw('SUM(order_items.quantity) as sold_qty'),
                DB::raw('SUM(order_items.subtotal) as sold_amount')
            )
            ->whereNotNull('order_items.product_id')
            ->groupBy('order_items.product_id', 'order_items.name')
            ->orderByDesc('sold_qty')
            ->take(6)
            ->get();

        $productImages = Product::whereIn('id', $topProducts->pluck('product_id')->filter())
            ->pluck('image', 'id');

        $lowStockList = Product::where('status', 1)
            ->where('quantity', '<=', 10)
            ->orderBy('quantity')
            ->take(6)
            ->get(['id', 'name', 'sku', 'quantity', 'image']);

        $paymentBreakdown = Order::select('payment_type', DB::raw('COUNT(*) as total'))
            ->groupBy('payment_type')
            ->pluck('total', 'payment_type');

        $sourceBreakdown = Order::select('order_source', DB::raw('COUNT(*) as total'))
            ->groupBy('order_source')
            ->pluck('total', 'order_source');

        // Last 14 days sales + orders (single grouped query)
        $salesLabels = [];
        $salesRevenue = [];
        $salesOrders = [];
        $fromDay = Carbon::today()->subDays(13)->startOfDay();

        $dailyRows = Order::query()
            ->select(
                DB::raw('DATE(created_at) as day'),
                DB::raw('COUNT(*) as orders_count'),
                DB::raw('SUM(CASE WHEN status IN ("Pending","Processing","On The way","Delivered") THEN grand_total ELSE 0 END) as revenue')
            )
            ->where('created_at', '>=', $fromDay)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get()
            ->keyBy('day');

        for ($i = 13; $i >= 0; $i--) {
            $day = Carbon::today()->subDays($i);
            $key = $day->toDateString();
            $salesLabels[] = $day->format('d M');
            $salesRevenue[] = (float) ($dailyRows[$key]->revenue ?? 0);
            $salesOrders[] = (int) ($dailyRows[$key]->orders_count ?? 0);
        }

        // Last 6 months revenue
        $monthLabels = [];
        $monthRevenues = [];
        $fromMonth = Carbon::now()->subMonths(5)->startOfMonth();
        $monthlyRows = Order::query()
            ->select(
                DB::raw('YEAR(created_at) as y'),
                DB::raw('MONTH(created_at) as m'),
                DB::raw('SUM(CASE WHEN status IN ("Pending","Processing","On The way","Delivered") THEN grand_total ELSE 0 END) as revenue')
            )
            ->where('created_at', '>=', $fromMonth)
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->get()
            ->keyBy(fn ($row) => $row->y . '-' . $row->m);

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthLabels[] = $month->format('M Y');
            $key = $month->year . '-' . $month->month;
            $monthRevenues[] = (float) ($monthlyRows[$key]->revenue ?? 0);
        }

        $statusChart = [
            'labels' => ['Pending', 'Processing', 'On The way', 'Delivered', 'Rejected', 'Returned'],
            'data' => [
                $pendingOrders,
                $processingOrders,
                $onTheWayOrders,
                $deliveredOrders,
                $rejectedOrders,
                $returnedOrders,
            ],
        ];

        return view('backend.pages.index', compact(
            'totalOrders',
            'totalRevenue',
            'todayOrders',
            'todayRevenue',
            'monthOrders',
            'monthRevenue',
            'revenueGrowth',
            'pendingOrders',
            'processingOrders',
            'onTheWayOrders',
            'deliveredOrders',
            'rejectedOrders',
            'returnedOrders',
            'totalCustomers',
            'newCustomersMonth',
            'totalProducts',
            'activeProducts',
            'lowStockProducts',
            'outOfStockProducts',
            'totalCategories',
            'totalFeedback',
            'totalMasterLogs',
            'recentMasterLogs',
            'avgOrderValue',
            'recentOrders',
            'topProducts',
            'productImages',
            'lowStockList',
            'paymentBreakdown',
            'sourceBreakdown',
            'salesLabels',
            'salesRevenue',
            'salesOrders',
            'monthLabels',
            'monthRevenues',
            'statusChart'
        ));
    }

    public function logs()
    {
        return redirect()->route('manager.master-logs.index');
    }

    public function cvReview()
    {
        return view('backend.curriculum-vitae.index');
    }
}
