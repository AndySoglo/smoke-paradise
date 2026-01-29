@extends('layouts.front')

@section('title', ' - Tous nos produits')

@section('content')

<!-- ================= HERO ================= -->
<section class="relative pt-24 pb-20 md:pt-32 md:pb-28 overflow-hidden">

    <!-- Background image + smoke vibe -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-background.jpg') }}"
             class="w-full h-full object-cover opacity-40 scale-105 blur-sm"
             alt="Smoke Paradise">
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/60 to-black"></div>
    </div>

    <!-- Glow -->
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(249,115,22,0.25),transparent_60%)]"></div>

    <div class="relative max-w-6xl mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-6xl font-black tracking-wide text-orange-400 drop-shadow-lg mb-6">
            Tous nos produits
        </h1>
        <p class="text-lg md:text-xl text-gray-200 max-w-3xl mx-auto">
            Puffs, e-liquides et arômes premium.
            Qualité, style et gros nuages 💨
        </p>
    </div>
</section>

<!-- ================= PRODUCTS ================= -->
<section class="relative py-20 bg-gradient-to-b from-black to-orange-950">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Stats -->
        <div class="text-center mb-16">
            <p class="inline-block px-6 py-2 rounded-full bg-orange-500/10 border border-orange-500/30 text-orange-300 font-semibold">
                {{ $products->count() }} produits disponibles
            </p>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">

            @forelse($products as $product)

            <div class="group relative bg-black/60 backdrop-blur-xl border border-orange-500/20 rounded-3xl overflow-hidden shadow-[0_0_30px_rgba(0,0,0,0.8)] hover:shadow-[0_0_50px_rgba(249,115,22,0.35)] transition transform hover:-translate-y-3 flex flex-col">

                <!-- Glow on hover -->
                <div class="absolute inset-0 bg-gradient-to-t from-orange-500/10 to-transparent opacity-0 group-hover:opacity-100 transition"></div>

                <!-- Image -->
                <div class="relative overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-56 object-cover transition duration-700 group-hover:scale-110">
                    @else
                        <div class="h-56 flex items-center justify-center bg-gradient-to-br from-orange-900 to-black text-orange-300 font-semibold">
                            Pas d’image
                        </div>
                    @endif

                    @if($product->created_at->diffInDays() <= 14)
                        <span class="absolute top-4 left-4 bg-green-500 text-black text-xs font-black px-3 py-1 rounded-full shadow-lg">
                            NOUVEAU
                        </span>
                    @endif
                </div>

                <!-- Content -->
                <div class="relative p-6 flex-1 flex flex-col">
                    <h3 class="text-lg font-bold text-gray-100 mb-2 line-clamp-2">
                        {{ $product->name }}
                    </h3>

                    <p class="text-orange-400 font-extrabold text-xl mb-4">
                        {{ number_format($product->price, 0, '', ' ') }} FCFA
                    </p>

                    <!-- Flavors -->
                    @if($product->flavors->isNotEmpty())
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach($product->flavors->take(4) as $flavor)
                                <span class="text-xs px-3 py-1 rounded-full bg-orange-500/10 border border-orange-500/30 text-orange-300">
                                    {{ $flavor->name }}
                                </span>
                            @endforeach
                            @if($product->flavors->count() > 4)
                                <span class="text-xs text-gray-400">
                                    +{{ $product->flavors->count() - 4 }}
                                </span>
                            @endif
                        </div>
                    @endif

                    <!-- CTA -->
                    <a href="{{ route('order.create', $product) }}"
                       class="mt-auto group/btn relative overflow-hidden rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 text-black font-extrabold py-3 text-center transition transform hover:scale-105 shadow-lg">

                        <span class="absolute inset-0 bg-white/20 opacity-0 group-hover/btn:opacity-100 transition"></span>
                        <span class="relative flex items-center justify-center gap-2">
                            <i data-feather="shopping-cart"></i>
                            Commander
                        </span>
                    </a>
                </div>
            </div>

            @empty
                <div class="col-span-full text-center py-24">
                    <p class="text-2xl font-semibold text-gray-300 mb-4">
                        Aucun produit disponible
                    </p>
                    <p class="text-gray-500">
                        Revenez bientôt ou contactez-nous 🔥
                    </p>
                </div>
            @endforelse

        </div>
    </div>
</section>

@endsection
