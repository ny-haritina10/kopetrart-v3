@extends('templates.home')

@section('aside')
<x-navbar.main active="/invoice"></x-navbar.main>
@endsection



@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container mt-4">
    <h1 class="text-center mb-4">Facture</h1>
    
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
                {{ $invoice->receiptNote->deliveryNote->purchaseOrder->buyer_name }}<br>
                {{ $invoice->receiptNote->deliveryNote->purchaseOrder->buyer_address }}<br>
                Téléphone: {{ $invoice->receiptNote->deliveryNote->purchaseOrder->buyer_phone }}<br>
                Email: {{ $invoice->receiptNote->deliveryNote->purchaseOrder->buyer_email }}
            </p>
        </div>
    </div>

    <!-- Invoice Details -->
    <div class="row mb-4">
        <div class="col-md-6">
            <strong>N° de Facture:</strong> {{ $invoice->invoice_number }}
        </div>
        <div class="col-md-6 text-md-right">
            <strong>Date de Facture:</strong> {{ $invoice->invoice_date->format('d/m/Y') }}
        </div>
    </div>

    <!-- Items Table -->
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Réf. Produit</th>
                <th>Description</th>
                <th>Quantité</th>
                <th>Prix Unitaire (€)</th>
                <th>Total (€)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->receiptNote->deliveryNote->purchaseOrder->items as $item)
                <tr>
                    <td>{{ $item->product_ref }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price, 2) }}</td>
                    <td>{{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-right"><strong>Sous-total</strong></td>
                <td>{{ number_format($invoice->subtotal, 2) }} €</td>
            </tr>
            <tr>
                <td colspan="4" class="text-right">TVA ({{ $invoice->tax_rate }}%)</td>
                <td>{{ number_format($invoice->tax_amount, 2) }} €</td>
            </tr>
            <tr>
                <td colspan="4" class="text-right"><strong>Total à payer</strong></td>
                <td><strong>{{ number_format($invoice->total_amount, 2) }} €</strong></td>
            </tr>
        </tbody>
    </table>

    <!-- Payment Information -->
    <div class="row mt-4">
        <div class="col-md-6">
            <h5>Informations de paiement</h5>
            <p>
                Mode de paiement: {{ $invoice->payment_method }}<br>
                Date d'échéance: {{ $invoice->payment_due_date->format('d/m/Y') }}<br>
                IBAN: FR76 1234 5678 9012 3456 7890 123<br>
                BIC: HDBKFRPP
            </p>
        </div>
        <div class="col-md-6 text-right">
            <h5>Statut</h5>
            <p>
                @if($invoice->is_paid)
                    <span class="badge bg-success">Payée</span>
                @else
                    <span class="badge bg-warning">En attente de paiement</span>
                @endif
            </p>
        </div>
    </div>

    @if(!$invoice->is_paid)
        <form action="{{ route('invoice.mark_paid', $invoice->id) }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-success" 
                    onclick="return confirm('Confirmer le paiement de cette facture?')">
                Marquer comme payée
            </button>
        </form>
    @endif
</div>
@endsection