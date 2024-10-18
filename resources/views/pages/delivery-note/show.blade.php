@extends('templates.home')

@section('aside')
    <x-navbar.main active="/bondelivraison"></x-navbar.main>
@endsection

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Bon de Livraison</h1>
        
        <!-- Delivery Information -->
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
                    Sophie Dupont<br>
                    45 Avenue des Champs-Élysées, 75008 Paris<br>
                    Téléphone: +33 6 78 90 12 34<br>
                    Email: sophie.dupont@example.com
                </p>
            </div>
        </div>

        <!-- Delivery Note Details -->
        <div class="row mb-4">
            <div class="col-md-6">
                <strong>N° de livraison:</strong> 00258
            </div>
            <div class="col-md-6 text-md-right">
                <strong>Date de livraison:</strong> 17/10/2024
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
                <tr>
                    <td>HB001</td>
                    <td>Sac à main en cuir noir</td>
                    <td>1</td>
                    <td>150.00</td>
                    <td>150.00</td>
                </tr>
                <tr>
                    <td>HB012</td>
                    <td>Pochette en daim beige</td>
                    <td>1</td>
                    <td>80.00</td>
                    <td>80.00</td>
                </tr>
                <!-- Subtotal and Total -->
                <tr>
                    <td colspan="4" class="text-right"><strong>Sous-total</strong></td>
                    <td>230.00 €</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right"><strong>Total Livraison</strong></td>
                    <td>230.00 €</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection