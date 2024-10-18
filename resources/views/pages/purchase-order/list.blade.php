@extends('templates.home')

@section('aside')
<x-navbar.main active="/purchase_order"></x-navbar.main>
@endsection

@section('content')

<h2>Bons de Commande</h2>

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif

<div class="mb-4">
    <x-button.add href="{{ route('purchase_order.create') }}">Créer un Nouveau Bon de Commande</x-button.add>
</div>

<x-table>
    <thead>
        <th>Actions</th>
        <th>Numéro de Commande</th>
        <th>Date</th>
        <th>Nom de l'Acheteur</th>
        <th>Montant Total</th>
        <th>Statut</th>
    </thead>

    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>
                    <x-button.show href="{{ route('purchase_order.show', $order->id) }}">Consulter</x-button.show>
                    @if (!$order->is_validated)
                        <x-button.accept href="{{ route('purchase_order.validate', $order->id) }}">Valider</x-button.accept>
                    @else
                        <x-button.accept href="{{ route('delivery_note.create', $order->id) }}">Bon de Livraison</x-button.accept>                    
                    @endif
                </td>
                <td>{{ $order->order_number }}</td>
                <td>{{ $order->order_date->format('Y-m-d') }}</td>
                <td>{{ $order->buyer_name }}</td>
                <td>{{ number_format($order->total_amount, 2) }} €</td>
                <td>
                    @if ($order->is_validated)
                        <span class="badge bg-success">Validé</span>
                    @else
                        <span class="badge bg-warning">En attente</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</x-table>
@endsection