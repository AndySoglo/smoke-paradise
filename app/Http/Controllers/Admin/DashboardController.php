<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats cards
        $productsCount = Product::count();
        $ordersCount = Order::count();
        $revenue = Order::sum('total');

        // Graphique 7 derniers jours
        $labels = [];
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->format('Y-m-d');
            $labels[] = Carbon::parse($date)->format('d/m');
            $data[] = Order::whereDate('created_at', $date)->count();
        }

        return view('admin.dashboard', [
            'productsCount' => $productsCount,
            'ordersCount'   => $ordersCount,
            'revenue'       => $revenue,
            'chartLabels'   => $labels,
            'chartData'     => $data,
        ]);
    }
}
