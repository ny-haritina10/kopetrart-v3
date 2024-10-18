@extends('templates.home')

@section('aside')
<x-navbar.main active="/invoice"></x-navbar.main>
@endsection

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Créer une Facture</h2>
                </div>
                <div class="card-body">
                    <!-- Receipt Note Information -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h4>Informations du Bon de Réception</h4>
                            <p>
                                <strong>Client:</strong> {{ $receipt_note->deliveryNote->purchaseOrder->buyer_name }}<br>
                                <strong>Adresse:</strong> {{ $receipt_note->deliveryNote->purchaseOrder->buyer_address }}<br>
                                <strong>Email:</strong> {{ $receipt_note->deliveryNote->purchaseOrder->buyer_email }}
                            </p>
                        </div>
                    </div>

                    <!-- Items Table -->
                    <div class="table-responsive mb-4">
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
                                @php
                                    $subtotal = 0;
                                @endphp
                                @foreach($receipt_note->deliveryNote->purchaseOrder->items as $item)
                                    @php
                                        $itemTotal = $item->quantity * $item->unit_price;
                                        $subtotal += $itemTotal;
                                    @endphp
                                    <tr>
                                        <td>{{ $item->product_ref }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->unit_price, 2) }}</td>
                                        <td>{{ number_format($itemTotal, 2) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Sous-total</strong></td>
                                    <td><strong>{{ number_format($subtotal, 2) }} €</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Invoice Form -->
                    <form action="{{ route('invoice.store', $receipt_note->id) }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="payment_method">Mode de Paiement</label>
                                    <select name="payment_method" id="payment_method" class="form-control @error('payment_method') is-invalid @enderror" required>
                                        <option value="">Sélectionner...</option>
                                        <option value="Virement bancaire">Virement bancaire</option>
                                        <option value="Chèque">Chèque</option>
                                        <option value="Carte bancaire">Carte bancaire</option>
                                    </select>
                                    @error('payment_method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="payment_due_date">Date d'Échéance</label>
                                    <input type="date" 
                                           name="payment_due_date" 
                                           id="payment_due_date" 
                                           class="form-control @error('payment_due_date') is-invalid @enderror"
                                           required
                                           min="{{ date('Y-m-d') }}">
                                    @error('payment_due_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tax_rate">Taux de TVA (%)</label>
                                    <input type="number" 
                                           name="tax_rate" 
                                           id="tax_rate" 
                                           class="form-control @error('tax_rate') is-invalid @enderror"
                                           required
                                           min="0"
                                           max="100"
                                           step="0.1"
                                           value="20">
                                    @error('tax_rate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    Créer la Facture
                                </button>
                                <a href="{{ route('invoice.index') }}" class="btn btn-secondary">
                                    Annuler
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection