@extends('templates.home')

@section('aside')
<x-navbar.main active="/purchase_order"></x-navbar.main>
@endsection

@section('content')
<div class="container mt-4">
    <h2>Créer un Bon de Livraison</h2>
    <h4>Bon de Commande: {{ $purchase_order->order_number }}</h4>

    <form action="{{ route('delivery_note.store', $purchase_order->id) }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="delivery_date">Date de Livraison</label>
            <input type="date" 
                   class="form-control @error('delivery_date') is-invalid @enderror" 
                   id="delivery_date" 
                   name="delivery_date" 
                   required>
            @error('delivery_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Créer le Bon de Livraison</button>
    </form>
</div>
@endsection