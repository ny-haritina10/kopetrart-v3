@extends('templates.home')

@section('aside')
<x-navbar.main active="/purchases"></x-navbar.main>
@endsection

@section('content')
    <div class="container">
        <h1>{{ isset($purchase) ? 'Modifier l\'achat' : 'Créer un achat' }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($purchase) ? route('purchases.update', $purchase->id) : route('purchases.store') }}" method="POST">
            @csrf
            @if(isset($purchase))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="id_product">Produit</label>
                <select name="id_product" class="form-control" required>
                    <option value="">Sélectionnez un produit</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ (isset($purchase) && $purchase->id_product == $product->id) || old('id_product') == $product->id ? 'selected' : '' }}>
                            {{ $product->label }}
                        </option>
                    @endforeach
                </select>
            </div> <br>
            <div class="form-group">
                <label for="id_supplier">Fournisseur</label>
                <select name="id_supplier" class="form-control" required>
                    <option value="">Sélectionnez un fournisseur</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ (isset($purchase) && $purchase->id_supplier == $supplier->id) || old('id_supplier') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div> <br>
            <div class="form-group">
                <label for="quantity">Quantité</label>
                <input type="number" name="quantity" value="{{ isset($purchase) ? $purchase->quantity : old('quantity') }}" class="form-control" required min="1">
            </div> <br>
            <div class="form-group">
                <label for="purchase_date">Date d'achat</label>
                <input type="date" name="purchase_date" value="{{ isset($purchase) ? $purchase->purchase_date->format('Y-m-d') : old('purchase_date') }}" class="form-control" required>
            </div> <br>
            <button type="submit" class="btn btn-primary mt-3">
                {{ isset($purchase) ? 'Mettre à jour' : 'Créer' }}
            </button>
        </form>
    </div>
@endsection