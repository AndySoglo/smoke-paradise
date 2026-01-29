@extends('layouts.front')

@section('title', ' - Accueil')

@section('content')

    <!-- Hero -->
  <section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden">

    <!-- Background -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-background.jpg') }}"
             class="w-full h-full object-cover scale-110 opacity-40 blur-sm"
             alt="Smoke Paradise">
        <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/60 to-black"></div>
    </div>

    <!-- Glow -->
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(249,115,22,0.35),transparent_65%)]"></div>

    <!-- Smoke blobs -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-orange-500/10 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-orange-400/10 rounded-full blur-3xl animate-pulse"></div>

    <!-- Content -->
    <div class="relative z-10 max-w-6xl mx-auto px-6 text-center">

        <div class="inline-flex items-center gap-2 px-5 py-2 mb-6 rounded-full bg-orange-500/10 border border-orange-500/30 text-orange-300 font-semibold">
            💨 Premium Vape Shop
        </div>

        <h1 class="text-4xl md:text-6xl lg:text-7xl font-black leading-tight mb-6">
            <span class="block text-white">Entrez dans</span>
            <span class="block bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600 bg-clip-text text-transparent drop-shadow-[0_0_30px_rgba(249,115,22,0.8)]">
                Smoke Paradise
            </span>
        </h1>

        <p class="max-w-3xl mx-auto text-lg md:text-xl text-gray-300 mb-10">
            La référence du vapotage au Bénin.
            Produits premium, arômes puissants et nuages sans limites.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-5">
            <a href="{{ route('products.index') }}"
               class="relative group overflow-hidden rounded-xl px-10 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-black font-extrabold text-lg shadow-[0_0_40px_rgba(249,115,22,0.6)] transition hover:scale-105">
                <span class="absolute inset-0 bg-white/30 opacity-0 group-hover:opacity-100 transition"></span>
                <span class="relative">🔥 Découvrir les produits</span>
            </a>

           
        </div>

    </div>

    <div class="absolute bottom-0 inset-x-0 h-32 bg-gradient-to-t from-black to-transparent"></div>
</section>

<style>
/* Animation légère de fumée */
@keyframes float-slow {
    0% { transform: translateY(0) translateX(0); opacity: 0.3; }
    50% { transform: translateY(-30px) translateX(20px); opacity: 0.4; }
    100% { transform: translateY(0) translateX(0); opacity: 0.3; }
}

.animate-float-slow {
    animation: float-slow 12s ease-in-out infinite;
}
</style>


    <!-- Nos produits – seulement 3 + bouton Voir plus -->
   <section id="products" class="py-20 relative overflow-hidden bg-gradient-to-b from-white/80 via-orange-50/60 to-white/40">

    <!-- Fond fumée animée -->
    <div class="absolute inset-0 pointer-events-none z-0">
        <!-- Couche 1 -->
        <div class="absolute inset-0 bg-[radial-gradient(#e0e0e0_1px,transparent_1px)] bg-[length:40px_40px] opacity-30 animate-smoke-slow"></div>

        <!-- Couche 2 (plus rapide, plus fine) -->
        <div class="absolute inset-0 bg-[radial-gradient(#d0d0d0_1px,transparent_1px)] bg-[length:60px_60px] opacity-20 animate-smoke-fast mix-blend-difference"></div>

        <!-- Couche overlay légère pour adoucir -->
        <div class="absolute inset-0 bg-gradient-to-t from-orange-100/20 via-transparent to-orange-50/10"></div>
    </div>

    <!-- Contenu principal (z-index supérieur) -->
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center text-gray-800 mb-16">Nos Produits</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($products->take(3) as $product)
                <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden transform hover:-translate-y-3 hover:shadow-2xl transition duration-300 border border-orange-100/70">
                    @if($product->image)
                        <img
                            src="{{ asset('storage/'.$product->image) }}"
                            alt="{{ $product->name }}"
                            class="w-full h-56 object-cover transition-transform duration-500 hover:scale-105"
                            loading="lazy"
                        >
                    @else
                        <div class="h-56 bg-gradient-to-br from-orange-100 to-orange-50 flex items-center justify-center text-orange-400 text-xl">
                            Pas d'image
                        </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $product->name }}</h3>
                        <p class="text-orange-600 font-semibold text-lg mb-4">
                            {{ number_format($product->price, 0, '', ' ') }} FCFA
                        </p>
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach($product->flavors as $flavor)
                                <span class="text-xs bg-orange-100/80 text-orange-700 px-3 py-1 rounded-full backdrop-blur-sm">
                                    {{ $flavor->name }}
                                </span>
                            @endforeach
                        </div>
                        <a href="{{ route('order.create', $product) }}"
                           class="block bg-orange-500 hover:bg-orange-600 text-white text-center py-3 rounded-lg font-semibold transition">
                            Commander
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @if($products->count() > 3)
            <div class="text-center mt-16">
                <a href="{{ route('products.index') }}"
                   class="inline-block bg-white border-2 border-orange-500 text-orange-600 hover:bg-orange-50 px-10 py-4 rounded-xl font-bold transition hover:shadow-md">
                    Voir tous les produits →
                </a>
            </div>
        @endif
    </div>
</section>

    <!-- Section À propos -->
    <section class="py-20 bg-gradient-to-b from-white to-orange-50">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-10">À propos de Smoke Paradise</h2>
            <p class="text-lg text-gray-700 leading-relaxed max-w-3xl mx-auto mb-10">
                Smoke Paradise est né d'une passion pour le vapotage de qualité. Nous sélectionnons rigoureusement nos produits et arômes pour vous offrir une expérience unique, sûre et savoureuse. Que vous soyez débutant ou expert, notre objectif est de vous accompagner avec des produits premium et un service attentionné.
            </p>
            <div class="inline-block bg-orange-100 text-orange-700 px-8 py-4 rounded-xl text-lg font-medium">
                Qualité • Saveurs authentiques • Service local
            </div>
        </div>
    </section>

@endsection
