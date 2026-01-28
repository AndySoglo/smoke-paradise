@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Arômes</h1>
    <a href="{{ route('admin.flavors.create') }}"
       class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-xl shadow font-medium transition">
        + Ajouter
    </a>
</div>

@if($flavors->count())
<table id="flavorsTable" class="min-w-full bg-white rounded-xl shadow overflow-hidden">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-6 py-3 text-left font-semibold text-gray-700">#</th>
            <th class="px-6 py-3 text-left font-semibold text-gray-700">Nom</th>
            <th class="px-6 py-3 text-left font-semibold text-gray-700">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($flavors as $index => $flavor)
        <tr class="border-t">
            <td class="px-6 py-3">
                {{ $loop->iteration + ($flavors->currentPage() - 1) * $flavors->perPage() }}
            </td>
            <td class="px-6 py-3">{{ $flavor->name }}</td>
            <td class="px-6 py-3 space-x-2">
                <a href="{{ route('admin.flavors.edit', $flavor) }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg shadow transition text-sm">
                   Modifier
                </a>
                <form action="{{ route('admin.flavors.destroy', $flavor) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow transition text-sm"
                            onclick="return confirm('Voulez-vous vraiment supprimer cet arôme ? Cette action est irréversible.')">
                        Supprimer
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $flavors->links() }}
</div>

@else
<div class="bg-white rounded-2xl shadow-md p-12 text-center">
    <div class="text-6xl mb-4">🍓</div>
    <h2 class="text-2xl font-bold text-gray-800 mb-2">Aucun arôme enregistré</h2>
    <p class="text-gray-500 mb-6">Ajoute des arômes pour les associer à tes produits.</p>
    <a href="{{ route('admin.flavors.create') }}"
       class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl shadow font-semibold transition">
        Ajouter un arôme
    </a>
</div>
@endif

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#flavorsTable').DataTable({
        pageLength: 10,
        ordering: false,
        language: {
            search: "Rechercher :",
            paginate: { previous: "Précédent", next: "Suivant" },
            lengthMenu: "Afficher _MENU_ entrées",
            zeroRecords: "Aucun arôme trouvé",
            info: "Affichage _START_ à _END_ sur _TOTAL_ arômes",
            infoEmpty: "Aucun arôme disponible",
            infoFiltered: "(filtré sur _MAX_ arômes)"
        }
    });
});
</script>
@endsection
