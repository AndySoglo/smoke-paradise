@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Commandes</h1>

<table class="w-full bg-white rounded shadow">
    <thead>
        <tr class="bg-gray-100 text-left">
            <th class="p-3">Client</th>
            <th>Téléphone</th>
            <th>Total</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr class="border-t">
            <td class="p-3">{{ $order->first_name }} {{ $order->last_name }}</td>
            <td>{{ $order->phone }}</td>
            <td>{{ $order->total }} FCFA</td>
            <td>
                @if($order->status == 'en_attente')
                    <span class="text-yellow-500">En attente</span>
                @elseif($order->status == 'livré')
                    <span class="text-green-600">Livré</span>
                @else
                    <span class="text-red-600">Annulé</span>
                @endif
            </td>
            <td>
                <a href="{{ route('orders.show', $order) }}" class="text-blue-600">Voir</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $orders->links() }}
@endsection
