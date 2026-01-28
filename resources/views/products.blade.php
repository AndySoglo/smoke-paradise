@extends('layouts.front')

@section('title', ' - Tous nos produits')

@section('content')

    <!-- Hero / Titre de la page -->
    <section class="relative pt-20 pb-16 md:pt-28 md:pb-24 text-center overflow-hidden">
    <!-- Image de fond floue -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-background.jpg') }}"
             alt="Fond Smoke Paradise"
             class="w-full h-full object-cover filter blur-sm opacity-50">
        <!-- Overlay sombre pour que le texte ressorte -->
        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    </div>

    <div class="relative max-w-6xl mx-auto px-6">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 drop-shadow-lg">
            Tous nos produits
        </h1>
        <p class="text-lg md:text-xl text-white max-w-3xl mx-auto mb-8 drop-shadow-md">
            Découvrez notre sélection premium : e-liquides, arômes variés et produits de qualité supérieure.
        </p>

        
    </div>
</section>


    <!-- Liste des produits -->
    <section class="py-16 md:py-24 bg-white/60">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Stats / Info rapide (optionnel mais sympa) -->
            <div class="text-center mb-12">
                <p class="text-xl font-medium text-gray-700">
                    {{ $products->count() }} produits disponibles
                </p>
            </div>

            <!-- Grille des produits -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 md:gap-10">
                @forelse($products as $product)
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:-translate-y-3 hover:shadow-2xl transition duration-300 border border-orange-100/70 group flex flex-col">

    <!-- Image -->
    <div class="relative overflow-hidden">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                 class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
        @else
            <div class="h-56 bg-gradient-to-br from-orange-50 to-orange-100 flex items-center justify-center text-orange-300 text-xl font-medium">
                Pas d'image
            </div>
        @endif

        @if($product->created_at->diffInDays() <= 14)
            <span class="absolute top-3 left-3 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                Nouveau
            </span>
        @endif
    </div>

    <!-- Contenu -->
    <div class="p-6 flex-1 flex flex-col">
        <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">{{ $product->name }}</h3>
        <p class="text-orange-600 font-semibold text-lg mb-3">{{ number_format($product->price, 0, '', ' ') }} FCFA</p>

        <!-- Arômes -->
        @if($product->flavors->isNotEmpty())
            <div class="flex flex-wrap gap-2 mb-5">
                @foreach($product->flavors->take(4) as $flavor)
                    <span class="text-xs bg-orange-50 text-orange-700 px-3 py-1 rounded-full border border-orange-200">{{ $flavor->name }}</span>
                @endforeach
                @if($product->flavors->count() > 4)
                    <span class="text-xs text-gray-500">+{{ $product->flavors->count() - 4 }}</span>
                @endif
            </div>
        @endif

        <!-- Bouton -->
        <a href="{{ route('order.create', $product) }}"
           class="mt-auto bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600
                  text-white text-center py-3.5 rounded-xl font-semibold transition transform hover:scale-105 shadow-md">
            <i data-feather="shopping-cart" class="inline mr-2"></i> Commander
        </a>
    </div>
</div>

                @empty
                    <div class="col-span-full text-center py-20">
                        <p class="text-2xl text-gray-600 font-medium">
                            Aucun produit disponible pour le moment...
                        </p>
                        <p class="text-gray-500 mt-3">
                            Revenez bientôt ou contactez-nous !
                        </p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

@endsection
