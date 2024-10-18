@extends('templates.home')

@section('aside')
<x-navbar.main active="/delivery_note"></x-navbar.main>
@endsection

@section('content')

<h2>Bons de Livraison</h2>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<x-table>
    <thead>
        <th>Actions</th>
        <th>Bon de Livraison</th>
        <th>Numéro de Livraison</th>
        <th>Numéro de Commande</th>
        <th>Date de Livraison</th>
        <th>Nom du Destinataire</th>
        <th>Statut</th>
    </thead>

    <tbody>
        @foreach ($delivery_notes as $note)
            <tr>
                <td>
                    <x-button.show href="{{ route('delivery_note.show', $note->id) }}">Consulter</x-button.show>
                    @if (!$note->is_sent)
                        <x-button.accept href="{{ route('delivery_note.send', $note->id) }}" 
                            onclick="return confirm('Êtes-vous sûr de vouloir envoyer ce bon de livraison ?')">
                            Envoyer
                        </x-button.accept>
                    @endif                  
                </td>
                <td>
                    @if(!$note->receiptNote)
                        <x-button.accept href="{{ route('receipt_note.create', $note->id) }}" >
                            Créer Bon de Réception
                        </x-button.accept>
                    @else
                        <x-button.accept href="{{ route('receipt_note.show', $note->receiptNote->id) }}" >
                            Voir Bon de Réception
                        </x-button.accept>
                    @endif
                </td>
                <td>{{ $note->delivery_number }}</td>
                <td>
                    <a href="{{ route('purchase_order.show', $note->purchaseOrder->id) }}">
                        {{ $note->purchaseOrder->order_number }}
                    </a>
                </td>
                <td>{{ $note->delivery_date->format('d/m/Y') }}</td>
                <td>{{ $note->purchaseOrder->buyer_name }}</td>
                <td>
                    @if ($note->is_sent)
                        <span class="badge bg-success">Envoyé</span>
                    @else
                        <span class="badge bg-warning">En attente</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</x-table>
@endsection