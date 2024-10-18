@extends('templates.home')

@section('aside')
<x-navbar.main active="/stocks"></x-navbar.main>
@endsection

@section('content')
    <div class="container">
        <h1>Stocks</h1>
        <a href="{{ route('stocks.create') }}" class="btn btn-primary">Ajouter une entrée de stock</a>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success mt-2">{{ $message }}</div>
        @endif

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité en stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                    <tr>
                        <td>{{ $stock->product->label }}</td>
                        <td>{{ $stock->quantity }}</td>
                        <td>
                            <a href="{{ route('stocks.edit', $stock->id_product) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('stocks.destroy', $stock->id_product) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entrée de stock ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection