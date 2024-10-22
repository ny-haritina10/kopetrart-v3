@extends('templates.home')

@section('aside')
<x-navbar.main active="/purchase_order"></x-navbar.main>
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Bon de Commande</h1>
    
    <!-- Order Information -->
    <div class="row mb-4">
        @if ($purchase_order->type === 'VENTE')
            <div class="col-md-6">
                <h4>Vendeur</h4>
                    <p>
                        Kopetrart Company Inc.<br>
                        Andoharanofotsy Lot II Bis TR, Tana 101<br>
                        Téléphone: +33 123 45 67 89<br>
                        Email: kopetart.company@gmail.com
                    </p>    
                </div>
            <div class="col-md-6 text-md-right">
                <h4>Acheteur</h4>
                <p>
                    {{ $purchase_order->buyer_name }}<br>
                    {{ $purchase_order->buyer_address }}<br>
                    Téléphone: {{ $purchase_order->buyer_phone }}<br>
                    Email: {{ $purchase_order->buyer_email }}
                </p>
            </div>
        @elseif ($purchase_order->type === 'ACHAT')
            <div class="col-md-6">
                <h4>Vendeur</h4>
                    <p>
                        Fournisseurs Sac de Luxe Company<br>
                        Behoririka, Tana 101<br>
                        Téléphone: +34 65 477 33<br>
                        Email: fournisseurs.company@gmail.com
                    </p>    
                
            </div>
            <div class="col-md-6 text-md-right">
                <h4>Acheteur</h4>
                <p>
                    Kopetrart Company Inc.<br>
                    Andoharanofotsy Lot II Bis TR, Tana 101<br>
                    Téléphone: +33 123 45 67 89<br>
                    Email: kopetart.company@gmail.com
                </p>    
            </div>
        @endif
    </div>

    <!-- Order Details -->
    <div class="row mb-4">
        <div class="col-md-6">
            <strong>N° de commande:</strong> {{ $purchase_order->order_number }}
        </div>
        
        <div class="col-md-6 text-md-right">
            <strong>Date:</strong> {{ $purchase_order->order_date->format('d/m/Y') }}
        </div>
        <div class="col-md-6">
            <strong>Type:</strong> {{ $purchase_order->type }}
        </div>
    </div>

    <!-- Items Table -->
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Nom produit</th>
                <th>Quantité</th>
                <th>Prix Unitaire (€)</th>
                <th>Total (€)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchase_order->items as $item)
            <tr>
                <td>{{ $item->description }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->unit_price, 2) }}</td>
                <td>{{ number_format($item->total_price, 2) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-right"><strong>Total à payer</strong></td>
                <td>{{ number_format($purchase_order->total_amount, 2) }} €</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection 