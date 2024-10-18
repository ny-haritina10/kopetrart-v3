@extends('templates.home')

@section('aside')
<x-navbar.main active="/sales"></x-navbar.main>
@endsection

@section('content')
    <div class="container">
        <h1>{{ isset($sale) ? 'Modifier la vente' : 'Créer une vente' }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($sale) ? route('sales.update', $sale->id) : route('sales.store') }}" method="POST">
            @csrf
            @if(isset($sale))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="id_product">Produit</label>
                <select name="id_product" class="form-control" required>
                    <option value="">Sélectionnez un produit</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ (isset($sale) && $sale->id_product == $product->id) || old('id_product') == $product->id ? 'selected' : '' }}>
                            {{ $product->label }}
                        </option>
                    @endforeach
                </select>
            </div> <br>
        
            <div class="form-group">
                <label for="id_customer">Client</label>
                <select name="id_customer" class="form-control" required>
                    <option value="">Sélectionnez un client</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ (isset($sale) && $sale->id_customer == $customer->id) || old('id_customer') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div> <br>

            <div class="form-group">
                <label for="quantity">Quantité</label>
                <input type="number" name="quantity" value="{{ isset($sale) ? $sale->quantity : old('quantity') }}" class="form-control" required min="1">
            </div> <br>

            <div class="form-group">
                <label for="sale_date">Date de vente</label>
                <input type="date" name="sale_date" value="{{ isset($sale) ? $sale->sale_date->format('Y-m-d') : old('sale_date') }}" class="form-control" required>
            </div> <br>

            <button type="submit" class="btn btn-primary mt-3">
                {{ isset($sale) ? 'Mettre à jour' : 'Créer' }}
            </button>
        </form>
    </div>
@endsection