@extends('layouts.front')

@section('title', ' - Accueil')

@section('content')

    <!-- Hero -->
<section class="relative h-screen flex items-center justify-center text-center overflow-hidden">
    <!-- Image de fond floue -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-background.jpg') }}"
             alt="Smoke Paradise"
             class="w-full h-full object-cover filter blur-sm brightness-75">
        <!-- Overlay léger -->
        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    </div>

    <!-- Contenu du Hero -->
    <div class="relative z-10 max-w-4xl px-6">
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-white mb-5 leading-tight drop-shadow-lg">
            Bienvenue chez <br>Smoke Paradise
        </h1>
        <p class="text-lg md:text-xl text-white mb-10 drop-shadow-md">
            Découvrez nos produits et arômes uniques, pensés pour une expérience de vapotage premium.
        </p>
        <a href="{{ route('products.index') }}"
           class="inline-block bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600
                  text-white px-10 py-5 rounded-2xl font-bold text-lg transition transform hover:scale-105 shadow-xl">
            Voir les produits
        </a>
    </div>

    <!-- Fumée subtile animée -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="w-full h-full">
            <img src="{{ asset('images/smoke.png') }}" alt="fumée" class="absolute w-full h-full object-cover opacity-30 animate-float-slow">
        </div>
    </div>
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
