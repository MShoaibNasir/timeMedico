@extends('backend.layout.master')

@section('content')
@php
    $badgeClass = [
        'Pending' => 'bg-warning text-dark',
        'Processing' => 'bg-primary',
        'On The way' => 'bg-info text-dark',
        'Delivered' => 'bg-success',
        'Rejected' => 'bg-danger',
        'Returned' => 'bg-secondary',
    ];
@endphp

@push('specific_css')
<style>
    .tm-dash {
        --tm-ink: #0f2a3d;
        --tm-teal: #0d9488;
        --tm-teal-dark: #0f766e;
        --tm-sky: #0284c7;
        --tm-amber: #d97706;
        --tm-rose: #e11d48;
        --tm-slate: #64748b;
        --tm-bg: #f3f6f9;
        --tm-card: #ffffff;
        --tm-line: #e8eef3;
    }

    .tm-dash .app-content-header {
        padding-bottom: .25rem;
    }

    .tm-hero {
        background: linear-gradient(135deg, #0f2a3d 0%, #134e4a 48%, #0d9488 100%);
        border-radius: 18px;
        color: #fff;
        padding: 1.35rem 1.5rem;
        margin-bottom: 1.25rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 14px 40px rgba(15, 42, 61, .18);
    }

    .tm-hero::after {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        right: -60px;
        top: -90px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .08);
    }

    .tm-hero h2 {
        font-size: 1.45rem;
        font-weight: 700;
        margin: 0 0 .35rem;
        letter-spacing: -.02em;
    }

    .tm-hero p {
        margin: 0;
        opacity: .88;
        font-size: .95rem;
        max-width: 48rem;
    }

    .tm-hero-meta {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
        margin-top: 1rem;
    }

    .tm-pill {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        background: rgba(255, 255, 255, .14);
        border: 1px solid rgba(255, 255, 255, .18);
        border-radius: 999px;
        padding: .35rem .75rem;
        font-size: .8rem;
        font-weight: 600;
    }

    .tm-stat {
        background: var(--tm-card);
        border: 1px solid var(--tm-line);
        border-radius: 16px;
        padding: 1.1rem 1.15rem;
        height: 100%;
        transition: transform .2s ease, box-shadow .2s ease;
        position: relative;
        overflow: hidden;
    }

    .tm-stat:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(15, 42, 61, .08);
    }

    .tm-stat .label {
        color: var(--tm-slate);
        font-size: .82rem;
        font-weight: 600;
        margin-bottom: .35rem;
    }

    .tm-stat .value {
        color: var(--tm-ink);
        font-size: 1.55rem;
        font-weight: 800;
        letter-spacing: -.03em;
        line-height: 1.15;
        margin-bottom: .35rem;
    }

    .tm-stat .hint {
        font-size: .78rem;
        color: #94a3b8;
        margin: 0;
    }

    .tm-stat .icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1rem;
        margin-bottom: .85rem;
    }

    .tm-stat .icon.teal { background: linear-gradient(135deg, #14b8a6, #0d9488); }
    .tm-stat .icon.sky { background: linear-gradient(135deg, #38bdf8, #0284c7); }
    .tm-stat .icon.amber { background: linear-gradient(135deg, #fbbf24, #d97706); }
    .tm-stat .icon.rose { background: linear-gradient(135deg, #fb7185, #e11d48); }
    .tm-stat .icon.ink { background: linear-gradient(135deg, #334155, #0f2a3d); }
    .tm-stat .icon.violet { background: linear-gradient(135deg, #67e8f9, #0891b2); }

    .tm-growth {
        font-size: .78rem;
        font-weight: 700;
        border-radius: 999px;
        padding: .15rem .5rem;
    }

    .tm-growth.up { background: #dcfce7; color: #166534; }
    .tm-growth.down { background: #fee2e2; color: #991b1b; }

    .tm-card {
        background: var(--tm-card);
        border: 1px solid var(--tm-line);
        border-radius: 16px;
        height: 100%;
        box-shadow: 0 1px 2px rgba(15, 42, 61, .03);
    }

    .tm-card .tm-card-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .75rem;
        padding: 1rem 1.15rem;
        border-bottom: 1px solid var(--tm-line);
    }

    .tm-card .tm-card-head h5 {
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
        color: var(--tm-ink);
    }

    .tm-card .tm-card-body {
        padding: 1.15rem;
    }

    .tm-mini {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: .75rem;
    }

    .tm-mini-item {
        border: 1px solid var(--tm-line);
        border-radius: 12px;
        padding: .85rem;
        background: #f8fafc;
    }

    .tm-mini-item .k {
        font-size: .75rem;
        color: var(--tm-slate);
        font-weight: 600;
        margin-bottom: .2rem;
    }

    .tm-mini-item .v {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--tm-ink);
        margin: 0;
    }

    .tm-table {
        margin: 0;
    }

    .tm-table thead th {
        font-size: .75rem;
        text-transform: uppercase;
        letter-spacing: .04em;
        color: #64748b;
        border-bottom-width: 1px;
        background: #f8fafc;
        white-space: nowrap;
    }

    .tm-table td {
        vertical-align: middle;
        font-size: .9rem;
        color: #334155;
    }

    .tm-product {
        display: flex;
        align-items: center;
        gap: .75rem;
    }

    .tm-product img {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        object-fit: cover;
        background: #f1f5f9;
        border: 1px solid var(--tm-line);
    }

    .tm-product .name {
        font-weight: 650;
        color: var(--tm-ink);
        font-size: .9rem;
        margin: 0;
    }

    .tm-product .meta {
        font-size: .75rem;
        color: #94a3b8;
        margin: 0;
    }

    .tm-progress {
        height: 8px;
        border-radius: 999px;
        background: #e2e8f0;
        overflow: hidden;
    }

    .tm-progress > span {
        display: block;
        height: 100%;
        border-radius: inherit;
        background: linear-gradient(90deg, #14b8a6, #0284c7);
    }

    .tm-empty {
        text-align: center;
        color: #94a3b8;
        padding: 2rem 1rem;
        font-size: .9rem;
    }

    .tm-quick a {
        display: flex;
        align-items: center;
        gap: .75rem;
        padding: .85rem .95rem;
        border: 1px solid var(--tm-line);
        border-radius: 12px;
        text-decoration: none;
        color: var(--tm-ink);
        background: #fff;
        transition: .2s ease;
        margin-bottom: .65rem;
    }

    .tm-quick a:hover {
        border-color: #99f6e4;
        background: #f0fdfa;
        transform: translateX(3px);
    }

    .tm-quick .qi {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #ecfeff;
        color: var(--tm-teal-dark);
    }

    .tm-quick .qt {
        font-weight: 700;
        font-size: .9rem;
        margin: 0;
    }

    .tm-quick .qs {
        font-size: .75rem;
        color: #94a3b8;
        margin: 0;
    }

    .tm-chip-row {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
    }

    .tm-chip {
        border-radius: 999px;
        padding: .4rem .75rem;
        background: #f8fafc;
        border: 1px solid var(--tm-line);
        font-size: .8rem;
        color: #334155;
        font-weight: 600;
    }

    .tm-chip strong {
        color: var(--tm-ink);
    }

    @media (max-width: 576px) {
        .tm-stat .value { font-size: 1.3rem; }
        .tm-hero { padding: 1.1rem; }
    }
</style>
@endpush

<div class="tm-dash">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('manager.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="tm-hero">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 position-relative" style="z-index:1;">
                    <div>
                        <h2>Welcome back{{ Auth::guard('admin')->user()?->name ? ', ' . Auth::guard('admin')->user()->name : '' }}</h2>
                        <p>Live ecommerce overview for Times Medico — sales, fulfilment, stock health, and customer activity in one place.</p>
                        <div class="tm-hero-meta">
                            <span class="tm-pill"><i class="fa-regular fa-calendar"></i> {{ now()->format('D, d M Y') }}</span>
                            <span class="tm-pill"><i class="fa-solid fa-bag-shopping"></i> {{ $todayOrders }} orders today</span>
                            <span class="tm-pill"><i class="fa-solid fa-coins"></i> Rs {{ number_format((float) $todayRevenue, 0) }} today</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('manager.order.index') }}" class="btn btn-light btn-sm fw-semibold">
                            <i class="fa-solid fa-list me-1"></i> Orders
                        </a>
                        <a href="{{ route('manager.order.placeOrderPage') }}" class="btn btn-sm fw-semibold text-white" style="background:#0d9488;border:0;">
                            <i class="fa-solid fa-plus me-1"></i> Place Order
                        </a>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-xl-3 col-md-6">
                    <div class="tm-stat">
                        <div class="icon teal"><i class="fa-solid fa-chart-line"></i></div>
                        <div class="label">Total Revenue</div>
                        <div class="value">Rs {{ number_format((float) $totalRevenue, 0) }}</div>
                        <p class="hint d-flex align-items-center gap-2 flex-wrap mb-0">
                            This month: Rs {{ number_format((float) $monthRevenue, 0) }}
                            <span class="tm-growth {{ $revenueGrowth >= 0 ? 'up' : 'down' }}">
                                {{ $revenueGrowth >= 0 ? '+' : '' }}{{ $revenueGrowth }}%
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="tm-stat">
                        <div class="icon sky"><i class="fa-solid fa-receipt"></i></div>
                        <div class="label">Total Orders</div>
                        <div class="value">{{ number_format($totalOrders) }}</div>
                        <p class="hint mb-0">{{ $monthOrders }} this month · Avg Rs {{ number_format((float) $avgOrderValue, 0) }}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="tm-stat">
                        <div class="icon amber"><i class="fa-solid fa-users"></i></div>
                        <div class="label">Customers</div>
                        <div class="value">{{ number_format($totalCustomers) }}</div>
                        <p class="hint mb-0">{{ $newCustomersMonth }} new this month</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="tm-stat">
                        <div class="icon rose"><i class="fa-solid fa-clock"></i></div>
                        <div class="label">Pending Orders</div>
                        <div class="value">{{ number_format($pendingOrders) }}</div>
                        <p class="hint mb-0">{{ $processingOrders }} processing · {{ $onTheWayOrders }} on the way</p>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-xl-3 col-md-6">
                    <div class="tm-stat">
                        <div class="icon ink"><i class="fa-solid fa-box-open"></i></div>
                        <div class="label">Products</div>
                        <div class="value">{{ number_format($totalProducts) }}</div>
                        <p class="hint mb-0">{{ $activeProducts }} active · {{ $totalCategories }} categories</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="tm-stat">
                        <div class="icon violet"><i class="fa-solid fa-triangle-exclamation"></i></div>
                        <div class="label">Stock Alerts</div>
                        <div class="value">{{ number_format($lowStockProducts + $outOfStockProducts) }}</div>
                        <p class="hint mb-0">{{ $lowStockProducts }} low · {{ $outOfStockProducts }} out of stock</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="tm-stat">
                        <div class="icon teal"><i class="fa-solid fa-truck-fast"></i></div>
                        <div class="label">Delivered</div>
                        <div class="value">{{ number_format($deliveredOrders) }}</div>
                        <p class="hint mb-0">{{ $returnedOrders }} returned · {{ $rejectedOrders }} rejected</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="tm-stat">
                        <div class="icon sky"><i class="fa-solid fa-comments"></i></div>
                        <div class="label">Feedback</div>
                        <div class="value">{{ number_format($totalFeedback) }}</div>
                        <p class="hint mb-0">Customer messages & reviews</p>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-xl-8">
                    <div class="tm-card">
                        <div class="tm-card-head">
                            <h5>Sales Overview (14 days)</h5>
                            <span class="text-muted small">Revenue & order volume</span>
                        </div>
                        <div class="tm-card-body">
                            <canvas id="salesTrendChart" height="110"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="tm-card">
                        <div class="tm-card-head">
                            <h5>Order Status</h5>
                        </div>
                        <div class="tm-card-body">
                            <canvas id="statusChart" height="220"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-xl-4">
                    <div class="tm-card">
                        <div class="tm-card-head">
                            <h5>Monthly Revenue</h5>
                        </div>
                        <div class="tm-card-body">
                            <canvas id="monthlyRevenueChart" height="180"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="tm-card">
                        <div class="tm-card-head">
                            <h5>Fulfilment Snapshot</h5>
                        </div>
                        <div class="tm-card-body">
                            <div class="tm-mini">
                                <div class="tm-mini-item">
                                    <div class="k">Pending</div>
                                    <p class="v">{{ $pendingOrders }}</p>
                                </div>
                                <div class="tm-mini-item">
                                    <div class="k">Processing</div>
                                    <p class="v">{{ $processingOrders }}</p>
                                </div>
                                <div class="tm-mini-item">
                                    <div class="k">On The Way</div>
                                    <p class="v">{{ $onTheWayOrders }}</p>
                                </div>
                                <div class="tm-mini-item">
                                    <div class="k">Delivered</div>
                                    <p class="v">{{ $deliveredOrders }}</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-muted">Delivery success share</span>
                                    <strong>
                                        @php
                                            $done = $deliveredOrders + $returnedOrders + $rejectedOrders;
                                            $successRate = $done > 0 ? round(($deliveredOrders / $done) * 100) : 0;
                                        @endphp
                                        {{ $successRate }}%
                                    </strong>
                                </div>
                                <div class="tm-progress"><span style="width: {{ $successRate }}%"></span></div>
                            </div>
                            <div class="tm-chip-row mt-3">
                                @forelse($paymentBreakdown as $type => $count)
                                    <span class="tm-chip">{{ strtoupper($type ?: 'N/A') }}: <strong>{{ $count }}</strong></span>
                                @empty
                                    <span class="tm-chip">No payment data yet</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="tm-card">
                        <div class="tm-card-head">
                            <h5>Quick Actions</h5>
                        </div>
                        <div class="tm-card-body tm-quick">
                            <a href="{{ route('manager.order.index') }}">
                                <span class="qi"><i class="fa-solid fa-clipboard-list"></i></span>
                                <span>
                                    <p class="qt">Manage Orders</p>
                                    <p class="qs">{{ $pendingOrders }} waiting for action</p>
                                </span>
                            </a>
                            <a href="{{ route('manager.product.index') }}">
                                <span class="qi"><i class="fa-solid fa-pills"></i></span>
                                <span>
                                    <p class="qt">Products</p>
                                    <p class="qs">{{ $outOfStockProducts }} out of stock items</p>
                                </span>
                            </a>
                            <a href="{{ route('manager.order.placeOrderPage') }}">
                                <span class="qi"><i class="fa-solid fa-cart-plus"></i></span>
                                <span>
                                    <p class="qt">Place Admin Order</p>
                                    <p class="qs">Create order for a customer</p>
                                </span>
                            </a>
                            <a href="{{ route('manager.category.index') }}">
                                <span class="qi"><i class="fa-solid fa-tags"></i></span>
                                <span>
                                    <p class="qt">Categories</p>
                                    <p class="qs">{{ $totalCategories }} categories in catalog</p>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-xl-7">
                    <div class="tm-card">
                        <div class="tm-card-head">
                            <h5>Recent Orders</h5>
                            <a href="{{ route('manager.order.index') }}" class="small fw-semibold text-decoration-none" style="color:#0d9488;">View all</a>
                        </div>
                        <div class="tm-card-body p-0">
                            <div class="table-responsive">
                                <table class="table tm-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Order</th>
                                            <th>Customer</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentOrders as $order)
                                            <tr>
                                                <td>
                                                    <strong>#{{ $order->order_no }}</strong>
                                                    <div class="small text-muted">{{ strtoupper($order->payment_type ?? '-') }}</div>
                                                </td>
                                                <td>
                                                    <div>{{ $order->customer_name }}</div>
                                                    <div class="small text-muted">{{ $order->phone }}</div>
                                                </td>
                                                <td>Rs {{ number_format((float) $order->grand_total, 0) }}</td>
                                                <td>
                                                    <span class="badge {{ $badgeClass[$order->status] ?? 'bg-dark' }}">
                                                        {{ $order->status }}
                                                    </span>
                                                </td>
                                                <td class="small text-muted">{{ optional($order->created_at)->format('d M, h:i A') }}</td>
                                                <td>
                                                    <a href="{{ route('manager.order.view', encrypt($order->id)) }}" class="btn btn-sm btn-outline-secondary">
                                                        View
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="tm-empty">No orders yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5">
                    <div class="tm-card mb-3">
                        <div class="tm-card-head">
                            <h5>Top Selling Products</h5>
                        </div>
                        <div class="tm-card-body">
                            @forelse($topProducts as $item)
                                @php
                                    $image = $productImages[$item->product_id] ?? null;
                                    $maxSold = max(1, (int) ($topProducts->max('sold_qty') ?: 1));
                                    $pct = min(100, round(((int) $item->sold_qty / $maxSold) * 100));
                                @endphp
                                <div class="d-flex justify-content-between align-items-center gap-2 mb-2">
                                    <div class="tm-product">
                                        <img src="{{ $image ? asset('storage/'.$image) : asset('frontend/images/no-image.png') }}" alt="">
                                        <div>
                                            <p class="name">{{ $item->name }}</p>
                                            <p class="meta">{{ (int) $item->sold_qty }} sold · Rs {{ number_format((float) $item->sold_amount, 0) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tm-progress mb-3"><span style="width: {{ $pct }}%"></span></div>
                            @empty
                                <div class="tm-empty">No sales data yet.</div>
                            @endforelse
                        </div>
                    </div>

            
                </div>
            </div>


        </div>
    </div>
</div>

@push('specific_js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const salesLabels = @json($salesLabels);
    const salesRevenue = @json($salesRevenue);
    const salesOrders = @json($salesOrders);
    const monthLabels = @json($monthLabels);
    const monthRevenues = @json($monthRevenues);
    const statusLabels = @json($statusChart['labels']);
    const statusData = @json($statusChart['data']);

    const gridColor = 'rgba(148, 163, 184, .18)';

    new Chart(document.getElementById('salesTrendChart'), {
        type: 'line',
        data: {
            labels: salesLabels,
            datasets: [
                {
                    label: 'Revenue (Rs)',
                    data: salesRevenue,
                    borderColor: '#0d9488',
                    backgroundColor: 'rgba(13, 148, 136, .12)',
                    fill: true,
                    tension: .35,
                    borderWidth: 2.5,
                    pointRadius: 3,
                    pointBackgroundColor: '#0d9488',
                    yAxisID: 'y'
                },
                {
                    label: 'Orders',
                    data: salesOrders,
                    borderColor: '#0284c7',
                    backgroundColor: 'transparent',
                    tension: .35,
                    borderWidth: 2,
                    borderDash: [5, 4],
                    pointRadius: 2,
                    yAxisID: 'y1'
                }
            ]
        },
        options: {
            responsive: true,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth: 12, usePointStyle: true } }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: gridColor },
                    ticks: { callback: (v) => 'Rs ' + v }
                },
                y1: {
                    beginAtZero: true,
                    position: 'right',
                    grid: { drawOnChartArea: false },
                    ticks: { precision: 0 }
                },
                x: { grid: { display: false } }
            }
        }
    });

    new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: statusLabels,
            datasets: [{
                data: statusData,
                backgroundColor: ['#f59e0b', '#3b82f6', '#06b6d4', '#10b981', '#ef4444', '#94a3b8'],
                borderWidth: 0,
                hoverOffset: 6
            }]
        },
        options: {
            responsive: true,
            cutout: '62%',
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth: 10, usePointStyle: true } }
            }
        }
    });

    new Chart(document.getElementById('monthlyRevenueChart'), {
        type: 'bar',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Revenue',
                data: monthRevenues,
                backgroundColor: 'rgba(13, 148, 136, .75)',
                borderRadius: 8,
                maxBarThickness: 34
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: gridColor },
                    ticks: { callback: (v) => 'Rs ' + v }
                },
                x: { grid: { display: false } }
            }
        }
    });
});
</script>
@endpush
@endsection
