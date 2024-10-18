@extends('templates.home')

@section('aside')
    <x-navbar.main active="/proformat"></x-navbar.main>
@endsection

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Facture Proformat</h1>
        
        <!-- Seller and Buyer Information -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h4>Infomation du vendeur</h4>
                <p>
                    Kopetrart<br>
                    Lot II Bis Anodharanofotsy<br>
                    Antananarivo, 101<br>
                    Numéro: (261) 34 59 554 88<br>
                    Email: kopetrart@gmail.com
                </p>
            </div>
            <div class="col-md-6 text-md-right">
                <h4>Information client</h4>
                <p>
                    {{ $proforma->buyer_name }}<br>
                    {{ $proforma->buyer_address }}<br>
                    Numéro: {{ $proforma->buyer_phone }}<br>
                    Email: {{ $proforma->buyer_email }}
                </p>
            </div>
        </div>

        <!-- Invoice Details -->
        <div class="row mb-4">
            <div class="col-md-6">
                <strong>Date facture profomat:</strong> {{ $proforma->invoice_date ? $proforma->invoice_date->format('F d, Y') : 'N/A' }}
            </div>
            <div class="col-md-6 text-md-right">
                <strong>Facture proformat ID:</strong> {{ $proforma->invoice_number ?? 'N/A' }}
            </div>
        </div>

        <!-- Items Table -->
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Description</th>
                    <th>Prix unitaire</th>
                    <th>Prix total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proforma->items as $item)
                <tr>
                    <td>{{ $item->description }}</td>
                    <td>${{ number_format($item->unit_price, 2) }}</td>
                    <td>${{ number_format($item->total_price, 2) }}</td>
                </tr>
                @endforeach
                <!-- Subtotal and Totals -->
                <tr>
                    <td colspan="2" class="text-right"><strong>Subtotal</strong></td>
                    <td><strong>${{ number_format($proforma->total_amount - $proforma->shipping_cost, 2) }}</strong></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right">Livraison (Standard)</td>
                    <td>${{ number_format($proforma->shipping_cost, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right"><strong>Montant total</strong></td>
                    <td><strong>${{ number_format($proforma->total_amount, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection