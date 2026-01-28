@extends('layouts.admin')

@section('content')
<div class="max-w-md mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Ajouter un arôme</h1>

    <form method="POST" action="{{ route('admin.flavors.store') }}"
          class="bg-white p-8 rounded-xl shadow-md space-y-6">

        @csrf

        <!-- Nom de l'arôme -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Nom de l'arôme</label>
            <input name="name" placeholder="Nom de l'arôme"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-400 focus:outline-none">
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Bouton -->
        <div>
            <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg shadow transition">
                Enregistrer
            </button>
        </div>

    </form>
</div>
@endsection
