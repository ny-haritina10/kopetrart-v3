@extends('templates.home')

@section('aside')
<x-navbar.main active="/stocks"></x-navbar.main>
@endsection

@php
    use App\Models\Misc\Product;    
@endphp

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
                    <th>Montant</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalAmount = 0; // Initialize total amount variable
                @endphp

                @foreach($stocks as $stock)
                    @php
                        // Calculate individual amount and add to total
                        $individualAmount = $stock->quantity * Product::get_selling_price($stock->product->id)->selling_price;
                        $totalAmount += $individualAmount;
                    @endphp
                    <tr>
                        <td>{{ $stock->product->label }}</td>
                        <td>{{ $stock->quantity }}</td>
                        <td>${{ number_format($individualAmount, 2) }}</td>
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
            <tfoot>
                <tr>
                    <td colspan="2" class="text-right"><strong>Etat Total de stock:</strong></td>
                    <td>${{ number_format($totalAmount, 2) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <p>
            @php
                
            @endphp
        </p>
    </div>
@endsection
