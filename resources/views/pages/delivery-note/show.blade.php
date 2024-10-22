@extends('templates.home')

@section('aside')
<x-navbar.main active="/purchase_order"></x-navbar.main>
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Bon de Livraison</h1>
    
    <!-- Delivery Information -->
    <div class="row mb-4">
        @if ($delivery_note->purchaseOrder->type === 'VENTE')
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
                <h4>Destinataire</h4>
                <p>
                    {{ $delivery_note->purchaseOrder->buyer_name }}<br>
                    {{ $delivery_note->purchaseOrder->buyer_address }}<br>
                    Téléphone: {{ $delivery_note->purchaseOrder->buyer_phone }}<br>
                    Email: {{ $delivery_note->purchaseOrder->buyer_email }}
                </p>
            </div>

        @elseif ($delivery_note->purchaseOrder->type === 'ACHAT')
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

    <!-- Delivery Details -->
    <div class="row mb-4">
        <div class="col-md-4">
            <strong>N° de livraison:</strong> {{ $delivery_note->delivery_number }}
        </div>
        <div class="col-md-4">
            <strong>N° de commande:</strong> {{ $delivery_note->purchaseOrder->order_number }}
        </div>
        <div class="col-md-4 text-md-right">
            <strong>Date de livraison:</strong> {{ $delivery_note->delivery_date->format('d/m/Y') }}
        </div>
    </div>

    <!-- Items Table -->
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Nom produit</th>
                <th>Quantité</th>
            </tr>
        </thead>
        <tbody>
            @foreach($delivery_note->purchaseOrder->items as $item)
            <tr>
                <td>{{ $item->description }}</td>
                <td>{{ $item->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection