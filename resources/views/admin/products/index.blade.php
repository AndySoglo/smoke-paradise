@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Produits</h1>
    <a href="{{ route('admin.products.create') }}"
       class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-xl shadow font-medium transition">
        + Ajouter
    </a>
</div>

@if($products->count())

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($products as $product)
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 p-4 flex flex-col">

            <!-- Image -->
            @if($product->image)
                <div class="overflow-hidden rounded-xl mb-4">
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="h-40 w-full object-cover transform hover:scale-105 transition duration-300">
                </div>
            @else
                <div class="h-40 w-full bg-gray-200 flex items-center justify-center rounded-xl mb-4 text-gray-400">
                    Pas d'image
                </div>
            @endif

            <!-- Nom + Status -->
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h2>
                @if($product->status)
                    <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded-full">Actif</span>
                @else
                    <span class="bg-red-100 text-red-700 text-xs font-semibold px-2 py-1 rounded-full">Inactif</span>
                @endif
            </div>

            <!-- Prix -->
            <p class="text-gray-700 font-medium mb-2">{{ $product->price }} FCFA</p>

            <!-- Arômes -->
            <div class="mb-4 flex flex-wrap gap-2">
                @foreach($product->flavors as $flavor)
                    <span class="bg-orange-100 text-orange-700 text-xs px-2 py-1 rounded-full">
                        {{ $flavor->name }}
                    </span>
                @endforeach
            </div>

            <!-- Actions -->
            <div class="mt-auto flex justify-between items-center">
                <a href="{{ route('admin.products.edit', $product) }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded-lg shadow transition">
                    Modifier
                </a>

                <!-- Bouton suppression avec modal -->
                <button type="button"
                        onclick="openDeleteModal('{{ route('admin.products.destroy', $product) }}')"
                        class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded-lg shadow transition">
                    Supprimer
                </button>
            </div>

        </div>
    @endforeach
</div>

@else
<!-- EMPTY STATE -->
<div class="bg-white rounded-2xl shadow-md p-12 text-center">
    <div class="text-6xl mb-4">📦</div>
    <h2 class="text-2xl font-bold text-gray-800 mb-2">
        Aucun produit pour le moment
    </h2>
    <p class="text-gray-500 mb-6">
        Commence par ajouter ton premier produit à Smoke Paradise.
    </p>
    <a href="{{ route('admin.products.create') }}"
       class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl shadow font-semibold transition">
        Ajouter un produit
    </a>
</div>
@endif

<!-- MODAL DE SUPPRESSION -->
<div id="deleteModal"
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 animate-fade-in">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">
            Confirmer la suppression
        </h2>

        <p class="text-gray-600 mb-6">
            Cette action est <span class="font-semibold text-red-500">irréversible</span>.
            Voulez-vous vraiment supprimer ce produit ?
        </p>

        <div class="flex justify-end gap-3">
            <button onclick="closeDeleteModal()"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                Annuler
            </button>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white font-semibold transition">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
</div>

<!-- JS Modal -->
<script>
    function openDeleteModal(action) {
        document.getElementById('deleteForm').action = action;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>

@endsection
