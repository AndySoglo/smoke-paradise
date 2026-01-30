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



<!-- Graphique commandes -->


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
