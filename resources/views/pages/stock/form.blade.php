@extends('templates.home')

@section('aside')
<x-navbar.main active="/stocks"></x-navbar.main>
@endsection

@section('content')
    <div class="container">
        <h1>{{ isset($stock) ? 'Modifier l\'entrée de stock' : 'Créer une entrée de stock' }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($stock) ? route('stocks.update', $stock->id_product) : route('stocks.store') }}" method="POST">
            @csrf
            @if(isset($stock))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="id_product">Produit</label>
                @if(isset($stock))
                    <input type="text" class="form-control" value="{{ $stock->product->label }}" readonly>
                    <input type="hidden" name="id_product" value="{{ $stock->id_product }}">
                @else
                    <select name="id_product" class="form-control" required>
                        <option value="">Sélectionnez un produit</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('id_product') == $product->id ? 'selected' : '' }}>
                                {{ $product->label }}
                            </option>
                        @endforeach
                    </select>
                @endif
            </div> <br>

            <div class="form-group">
                <label for="quantity">Quantité en stock</label>
                <input type="number" name="quantity" value="{{ isset($stock) ? $stock->quantity : old('quantity') }}" class="form-control" required min="0">
            </div> <br>

            <button type="submit" class="btn btn-primary mt-3">
                {{ isset($stock) ? 'Mettre à jour' : 'Créer' }}
            </button>
        </form>
    </div>
@endsection