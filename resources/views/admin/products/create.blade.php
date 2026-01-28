@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Ajouter un produit</h1>

    <form method="POST" enctype="multipart/form-data"
          action="{{ route('admin.products.store') }}"
          class="bg-white p-8 rounded-xl shadow-md space-y-6">

        @csrf

        <!-- Nom -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Nom du produit</label>
            <input name="name" placeholder="Nom du produit"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-400 focus:outline-none">
        </div>

        <!-- Description -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Description</label>
            <textarea name="description" placeholder="Description"
                      class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-400 focus:outline-none" rows="4"></textarea>
        </div>

        <!-- Prix -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Prix (FCFA)</label>
            <input name="price" type="number" placeholder="Prix"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-400 focus:outline-none">
        </div>

        <!-- Image -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Image du produit</label>
            <input name="image" type="file"
                   class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400 focus:outline-none">
        </div>

        <!-- Arôme (select) -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Arôme principal</label>
            <select name="flavors[]" multiple
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-400 focus:outline-none">
                @foreach($flavors as $flavor)
                    <option value="{{ $flavor->id }}">{{ $flavor->name }}</option>
                @endforeach
            </select>
            <p class="text-gray-400 text-sm mt-1">Maintenez Ctrl (Windows) ou Cmd (Mac) pour sélectionner plusieurs arômes.</p>
        </div>

        <!-- Status -->
        <div class="flex items-center space-x-2">
            <input type="checkbox" name="status" value="1" checked class="w-5 h-5 text-orange-500 rounded">
            <span class="text-gray-700 font-medium">Actif</span>
        </div>

        <!-- Bouton -->
        <div>
            <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg shadow">
                Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection
