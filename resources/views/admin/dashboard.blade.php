@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold mb-6">Dashboard</h1>

<!-- Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-gradient-to-r from-orange-400 to-orange-300 text-white p-6 rounded-2xl shadow-lg transform hover:scale-105 transition">
        <p class="text-sm font-medium opacity-80">Total Produits</p>
        <p class="text-3xl font-bold mt-2">{{ $productsCount }}</p>
        <div class="mt-2">
            <i data-feather="package" class="w-6 h-6"></i>
        </div>
    </div>

<div class="bg-gradient-to-r from-purple-400 to-purple-300 text-white p-6 rounded-2xl shadow-lg transform hover:scale-105 transition">
        <p class="text-sm font-medium opacity-80">Total Commandes</p>
        <p class="text-3xl font-bold mt-2">{{ $ordersCount }}</p>
        <div class="mt-2">
            <i data-feather="shopping-cart" class="w-6 h-6"></i>
        </div>
    </div>

    <div class="bg-gradient-to-r from-green-400 to-green-300 text-white p-6 rounded-2xl shadow-lg transform hover:scale-105 transition">
        <p class="text-sm font-medium opacity-80">Chiffre d'affaires</p>
        <p class="text-3xl font-bold mt-2">{{ number_format($revenue,0,'',' ') }} FCFA</p>
        <div class="mt-2">
            <i data-feather="dollar-sign" class="w-6 h-6"></i>
        </div>
    </div>
</div>

<!-- Graphique commandes -->
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Commandes par jour (7 derniers jours)</h2>
    <canvas id="ordersChart" class="w-full h-64"></canvas>
</div>

<script>
const ctx = document.getElementById('ordersChart').getContext('2d');
const ordersChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($chartLabels),
        datasets: [{
            label: 'Commandes',
            data: @json($chartData),
            backgroundColor: 'rgba(255, 159, 64, 0.2)',
            borderColor: 'rgba(255, 159, 64, 1)',
            borderWidth: 2,
            fill: true,
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
@endsection
