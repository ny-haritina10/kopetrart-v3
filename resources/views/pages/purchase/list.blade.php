@extends('templates.home')

@section('aside')
<x-navbar.main active="/purchases"></x-navbar.main>
@endsection

@section('content')
    <div class="container">
        <h1>Achats</h1>
        <a href="{{ route('purchases.create') }}" class="btn btn-primary">Ajouter un achat</a>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success mt-2">{{ $message }}</div>
        @endif

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produit</th>
                    <th>Fournisseur</th>
                    <th>Quantité</th>
                    <th>Date d'achat</th>
                    <th>Coût unitaire</th>
                    <th>Coût total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->id }}</td>
                        <td>{{ $purchase->product->name }}</td>
                        <td>{{ $purchase->supplier->name }}</td>
                        <td>{{ $purchase->quantity }}</td>
                        <td>{{ $purchase->purchase_date->format('Y-m-d') }}</td>
                        <td>${{ number_format($purchase->unit_cost, 2) }}</td>
                        <td>${{ number_format($purchase->unit_cost * $purchase->quantity, 2)}}</td>
                        <td>
                            <a href="{{ route('purchases.edit', $purchase->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet achat ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection