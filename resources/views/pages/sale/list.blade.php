@extends('templates.home')

@section('aside')
<x-navbar.main active="/sales"></x-navbar.main>
@endsection

@section('content')
    <div class="container">
        <h1>Ventes</h1>
        <a href="{{ route('sales.create') }}" class="btn btn-primary">Ajouter une vente</a>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success mt-2">{{ $message }}</div>
        @endif

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produit</th>
                    <th>Client</th>
                    <th>Quantité</th>
                    <th>Date de vente</th>
                    <th>Prix de vente</th>
                    <th>Prix total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->product->label }}</td>
                        <td>{{ $sale->customer->name }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>{{ $sale->sale_date->format('Y-m-d') }}</td>
                        <td>${{ number_format($sale->sale_price, 2) }}</td>
                        <td>${{ number_format($sale->sale_price * $sale->quantity, 2) }}</td>
                        <td>
                            <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette vente ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection