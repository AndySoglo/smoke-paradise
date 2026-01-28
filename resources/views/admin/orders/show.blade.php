@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Commande #{{ $order->id }}</h1>

<div class="mb-4">
    <p><strong>Client :</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
    <p><strong>Téléphone :</strong> {{ $order->phone }}</p>
    <p><strong>Adresse :</strong> {{ $order->address }}</p>
    <p><strong>Paiement :</strong> {{ $order->payment_method }}</p>
    <p><strong>Total :</strong> {{ $order->total }} FCFA</p>
</div>

<h2 class="text-xl font-semibold mb-2">Produits</h2>
<table class="w-full bg-white rounded shadow mb-4">
    <thead>
        <tr class="bg-gray-100 text-left">
            <th class="p-3">Produit</th>
            <th>Arôme</th>
            <th>Quantité</th>
            <th>Prix</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr class="border-t">
            <td class="p-3">{{ $item->product->name }}</td>
            <td>{{ $item->flavor->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->price }} FCFA</td>
        </tr>
        @endforeach
    </tbody>
</table>

<form method="POST" action="{{ route('orders.update', $order) }}">
    @csrf
    @method('PUT')
    <label class="block mb-2">Changer le statut :</label>
    <select name="status" class="border p-2 mb-2">
        <option value="en_attente" {{ $order->status=='en_attente'?'selected':'' }}>En attente</option>
        <option value="livré" {{ $order->status=='livré'?'selected':'' }}>Livré</option>
        <option value="annulé" {{ $order->status=='annulé'?'selected':'' }}>Annulé</option>
    </select>
    <button class="bg-black text-white px-4 py-2 rounded">Mettre à jour</button>
</form>

@endsection
