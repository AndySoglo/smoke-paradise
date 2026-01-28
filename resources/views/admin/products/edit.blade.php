@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Modifier le produit</h1>

    <form id="editProductForm" method="POST" enctype="multipart/form-data"
          action="{{ route('admin.products.update', $product) }}"
          class="bg-white p-8 rounded-2xl shadow-md space-y-6">

        @csrf
        @method('PUT')

        <!-- Nom du produit -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Nom du produit</label>
            <input name="name" type="text"
                   value="{{ old('name', $product->name) }}"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-400 focus:outline-none"
                   placeholder="Nom du produit" required>
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Description</label>
            <textarea name="description" rows="4"
                      class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-400 focus:outline-none"
                      placeholder="Description du produit">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Prix -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Prix (FCFA)</label>
            <input name="price" type="number"
                   value="{{ old('price', $product->price) }}"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-400 focus:outline-none"
                   placeholder="Prix du produit" required>
            @error('price')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Image -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Image du produit</label>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->name }}"
                     class="w-40 h-40 object-cover rounded-lg mb-2 border border-gray-200">
            @endif
            <input type="file" name="image"
                   class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400 focus:outline-none">
            @error('image')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Arômes -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Arômes</label>
            <select name="flavors[]" multiple
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-400 focus:outline-none">
                @foreach($flavors as $flavor)
                    <option value="{{ $flavor->id }}"
                        {{ in_array($flavor->id, old('flavors', $product->flavors->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $flavor->name }}
                    </option>
                @endforeach
            </select>
            <p class="text-gray-400 text-sm mt-1">
                Ctrl (Windows) ou Cmd (Mac) pour sélectionner plusieurs arômes.
            </p>
            @error('flavors')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div class="flex items-center space-x-2">
            <input type="checkbox" name="status" value="1"
                   {{ old('status', $product->status) ? 'checked' : '' }}
                   class="w-5 h-5 text-orange-500 rounded">
            <span class="text-gray-700 font-medium">Actif</span>
        </div>

        <!-- Boutons -->
        <div class="flex justify-end gap-3 mt-6">
            <a href="{{ route('admin.products.index') }}"
               class="px-6 py-3 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
               Annuler
            </a>
            <button type="button" onclick="openConfirmModal()"
                    class="px-6 py-3 rounded-lg bg-orange-500 hover:bg-orange-600 text-white font-semibold transition">
                Enregistrer
            </button>
        </div>
    </form>
</div>

<!-- Modal de confirmation -->
<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-2xl shadow-xl p-8 max-w-md w-full">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Confirmer la modification</h2>
        <p class="text-gray-600 mb-6">Voulez-vous vraiment enregistrer les modifications pour ce produit ?</p>
        <div class="flex justify-end gap-3">
            <button onclick="closeConfirmModal()"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                Annuler
            </button>
            <button onclick="submitEditForm()"
                    class="px-4 py-2 rounded-lg bg-orange-500 hover:bg-orange-600 text-white font-semibold transition">
                Confirmer
            </button>
        </div>
    </div>
</div>

<script>
function openConfirmModal() {
    document.getElementById('confirmModal').classList.remove('hidden');
}

function closeConfirmModal() {
    document.getElementById('confirmModal').classList.add('hidden');
}

function submitEditForm() {
    document.getElementById('editProductForm').submit();
}
</script>
@endsection
