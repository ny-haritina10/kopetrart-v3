@extends('templates.home')

@section('aside')
<x-navbar.main active="/receipt_notes"></x-navbar.main>
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Bon de Réception</h1>
    
    <!-- Seller and Buyer Information -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h4>Vendeur</h4>
            <p>
                Handbag Boutique<br>
                123 Rue de la Mode, 75001 Paris<br>
                Téléphone: +33 1 23 45 67 89<br>
                Email: contact@handbagboutique.fr
            </p>
        </div>
        <div class="col-md-6 text-md-right">
            <h4>Acheteur</h4>
            <p>
                {{ $receipt_note->deliveryNote->purchaseOrder->buyer_name }}<br>
                {{ $receipt_note->deliveryNote->purchaseOrder->buyer_address }}<br>
                Téléphone: {{ $receipt_note->deliveryNote->purchaseOrder->buyer_phone }}<br>
                Email: {{ $receipt_note->deliveryNote->purchaseOrder->buyer_email }}
            </p>
        </div>
    </div>

    <!-- Receipt Details -->
    <div class="row mb-4">
        <div class="col-md-4">
            <strong>N° de Réception:</strong> {{ $receipt_note->receipt_number }}
        </div>
        <div class="col-md-4">
            <strong>N° de Livraison:</strong> {{ $receipt_note->deliveryNote->delivery_number }}
        </div>
        <div class="col-md-4 text-md-right">
            <strong>Date de Réception:</strong> {{ $receipt_note->receipt_date->format('d/m/Y') }}
        </div>
    </div>

    <!-- Items Table -->
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Description</th>
                <th>Quantité</th>
                <th>Prix Unitaire (€)</th>
                <th>Total (€)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($receipt_note->deliveryNote->purchaseOrder->items as $item)
            <tr>
                <td>{{ $item->description }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->unit_price, 2) }}</td>
                <td>{{ number_format($item->quantity * $item->unit_price, 2) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-right"><strong>Total Réception</strong></td>
                <td>{{ number_format($receipt_note->deliveryNote->purchaseOrder->items->sum(function($item) {
                    return $item->quantity * $item->unit_price;
                }), 2) }} €</td>
            </tr>
        </tbody>
    </table>

    <!-- Signature Section -->
    <div class="row mt-4">
        <div class="col-md-6">
            <h5>Confirmation de réception</h5>
            <p>Je, soussigné(e), confirme avoir reçu les produits listés ci-dessus en bon état.</p>
        </div>
    </div>

    @if(!$receipt_note->is_signed)
        <form action="{{ route('receipt_note.sign', $receipt_note->id) }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-primary">Signer le bon de réception</button>
        </form>
    @else
        <div class="alert alert-success mt-3">
            Ce bon de réception a été signé.
        </div>
    @endif
</div>
@endsection